<?php

$user_id = $_REQUEST['user_id'];
$filter = _e($_REQUEST['filter'], '');

$page_size = _e($_REQUEST['page_size'],5);

$page = _e($_REQUEST['page'], 1);
$page = ($page - 1) * $page_size;

if (!$user_id) {
    $fields = array();
    $fields['success'] = '0';
    $fields['data'] = array();
    $fields['msg'] = "INVALID_USER_ID";
    echo _api_response($fields);
    die;
}

$filter_condition = " AND 1=1 ";
$todays_date = date("Y-m-d");
/* if ($filter) {
  if ($filter == 'active') {
  $filter_condition = " AND date(to_date_time) >= '{$todays_date} 00:00:00' ";
  }
  if ($filter == 'archive') {
  $filter_condition = " AND date(to_date_time) <  '{$todays_date}'  ";
  }
  } */

$data = q("select * from errands where status != 'Delete' and  employee_id = '{$user_id}' {$filter_condition} order by from_date_time desc limit {$page},{$page_size} ");
$total_rec = qs("select count(id) as total_rec from errands where status != 'Delete' AND  employee_id = '{$user_id}' {$filter_condition} ");

if (empty($data)) {
    $fields = array();
    $fields['success'] = '0';
    $fields['data'] = array();
    $fields['msg'] = 'failure';
    echo _api_response($fields);
    die;
}
$return = array();
foreach ($data as $each_data) {
    $timeoff_data = array();
    $timeoff_data['start_date'] = _DigitsTopersian(_gj(strtotime($each_data['from_date_time'])));
    $timeoff_data['start_date_circle'] = _get_day_persian(date("Y-m-d", strtotime($each_data['from_date_time'])));
    $timeoff_data['end_date'] = _DigitsTopersian(_gj(strtotime($each_data['to_date_time'])));
    $timeoff_data['start_time'] = _tt($each_data['from_date_time']);
    $timeoff_data['end_time'] = _tt($each_data['to_date_time']);
    $timeoff_data['day_request_submitted'] = ($each_data['day_request_submitted']);
    //$timeoff_data['errands_type'] = $each_data['errands_type'] == 'local' ? 1 : 2;
    $timeoff_data['errands_type'] = $each_data['errands_type'] == 'local' ? 'درون شهری' : 'برون شهری';
    //$timeoff_data['total_errands_time'] = _DigitsTopersian($each_data['total_days']);
    $timeoff_data['total_errands_time'] = $each_data['absence_type'] == 'hourly' ? _s2p($each_data['total_days'] * 60) : _DigitsTopersian(($each_data['total_days'] / 440) * 60);    
    $timeoff_data['request_status'] = language::leave_status($each_data['status']);  
    $errands_data['transportation_method'] = language::transportation_type($each_data['transportation_method']);
    $errands_data['transportation_method_type'] = language::transportation_type_id($each_data['transportation_method']);
    $timeoff_data['unique_id'] = $each_data['unique_id'];
	
	$errands_data['user_comment'] = $each_data['employee_comments'];
	$errands_data['manager_comment'] = $each_data['manager_comments'];	
	
    $timeoff_data['absence_type'] = $each_data['absence_type'] == 'hourly' ? 1 : 2;
    $timeoff_data['filter'] = strtotime($each_data['to_date_time']) > time() ? "active" : "archive";
    $timeoff_data['total_hours'] = "0";
    $timeoff_data['total_days'] = '0';

    //$each_data['total_days_applied'] > 1
    if (strtolower($each_data['absence_type']) == 'entireday') {
        $totalDaysApplied = $each_data['total_days_applied'];
        if ($totalDaysApplied == 0) {
            $totalDaysApplied = 1;
        }
        //$timeoff_data['total_days'] = convertInFarsi($totalDaysApplied);
        $timeoff_data['total_days'] = _DigitsTopersian($totalDaysApplied); 
    } else {
        //$timeoff_data['total_hours'] = convertInFarsi(convertMinutesToHourMinuteFormat($each_data['total_days']));
        $timeoff_data['total_hours'] = _s2p($each_data['total_days'] * 60); 
    }     

    $return[] = $timeoff_data;
}
$fields = array();
$fields['total_record'] = $total_rec['total_rec'];
$fields['data'] = $return;
$fields['success'] = '1';
$fields['msg'] = 'success';
echo _api_response($fields);
die;
