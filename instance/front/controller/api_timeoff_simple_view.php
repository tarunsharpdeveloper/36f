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
  $filter_condition = " AND date(to_date) >= '{$todays_date}' ";
  }
  if ($filter == 'archive') {
  $filter_condition = " AND date(to_date) <  '{$todays_date}'  ";
  }
  }
 */
/*
  if (isset($_REQUEST['start_time']) && isset($_REQUEST['end_time'])) {
  $filter_date_start = _j2g_full(_persianToDigits($_REQUEST['start_time']));
  $filter_end_start = _j2g_full(_persianToDigits($_REQUEST['end_time']));
  $filter_condition .= " AND ( date(to_date) >= '{$filter_date_start}' and date(to_date) <= '{$filter_end_start}' ) ";
  } */


$totalRecArr = qs("select count(id) as total_rec from tb_timeoff where status != 'Delete' and emp_id = '{$user_id}' {$filter_condition} order by id desc ");
$data = q("select * from tb_timeoff where status != 'Delete' and emp_id = '{$user_id}' {$filter_condition} ORDER BY `from_date` DESC limit {$page}, {$page_size}");

if (empty($data)) {
    $fields = array();
    $fields['success'] = '0';
    $fields['data'] = array();
    $fields['msg'] = 'NO_DATA_EXISTS_FOR_TIMEOFF';
    echo _api_response($fields);
    die;
}
$return = array();
foreach ($data as $each_data) {
    $timeoff_data = array();
    $timeoff_data['start_date'] = _DigitsTopersian(_gj(strtotime($each_data['from_date'])));
    $timeoff_data['start_date_circle'] = _get_day_persian(date("Y-m-d", strtotime($each_data['from_date'])));
    $timeoff_data['end_date'] = _DigitsTopersian(_gj(strtotime($each_data['to_date'])));
    $timeoff_data['time_off_type'] = _get_timeoff_farsi($each_data['reason_id']);
    $timeoff_data['time_off_type_id'] = $each_data['reason_id'];
    $timeoff_data['total_time_off_time'] = $each_data['absence_type'] == 'hourly' ? _s2p($each_data['total_days'] * 60) : _DigitsTopersian(($each_data['total_days'] / 440) * 60);
    $timeoff_data['absence_type'] = ($each_data['absence_type'] == 'hourly') ? 1 : 2;
    $timeoff_data['request_status'] = language::leave_status($each_data['status']);
    $timeoff_data['unique_id'] = $each_data['unique_id'];
    $timeoff_data['total_hours'] = $each_data['absence_type'] == 'hourly' ? _s2p($each_data['total_days']) : _DigitsTopersian(($each_data['total_days'] / 440));
    $timeoff_data['total_days'] = 0;
    $timeoff_data['start_time'] = _tt($each_data['from_date']);
    $timeoff_data['end_time'] = _tt(($each_data['to_date']));
    $timeoff_data['filter'] = strtotime($each_data['to_date']) > time() ? "active" : "archive";
    $timeoff_data['user_comment'] = $each_data['employee_notes'] == 'DEFAULT' ? '' : $each_data['employee_notes'];
    $timeoff_data['manager_comment'] = $each_data['manager_notes'] == 'DEFAULT' ? '' : $each_data['manager_notes'];


    if (strtolower($each_data['absence_type']) == 'hourly') {
        $timeoff_data['total_hours'] = _s2p($each_data['total_days'] * 60);
    } else {
        $timeoff_data['total_days'] = _DigitsTopersian($each_data['total_days_applied']);
    }
    $timeoff_data['is_deleted'] = 1;

    $currentDate = date('Y-m-d');
    if ($currentDate >= date('Y-m-d', strtotime($each_data["from_date"]))) {
        $is_deleted = 0;
        $timeoff_data['is_deleted'] = 0;
    }



    $return[] = $timeoff_data;
}
$fields = array();
$fields['total_record'] = $totalRecArr['total_rec'];
$fields['msg'] = 'success';
$fields['success'] = '1';
$fields['data'] = $return;
echo _api_response($fields);
die;
