<?php

$user_id = $_REQUEST['user_id'];

$unique_id = _e($_REQUEST['timeoff_id'], 0);



if (!$user_id) {
    $fields = array();
    $fields['success'] = '0';
    $fields['data'] = array();
    $fields['msg'] = "INVALID_USER_ID";
    echo _api_response($fields);
    die;
}

if (!$unique_id) {
    $fields = array();
    $fields['success'] = '0';
    $fields['data'] = array();
    $fields['msg'] = "INVALID_TIMEOFF_ID";
    echo _api_response($fields);
    die;
}

$fields = array();


$each_data = qs("select * from tb_timeoff where emp_id = '{$user_id}' and unique_id = '{$unique_id}'  ");

if (empty($each_data)) {
    $fields['error'] = '1';
    $fields['msg'] = 'NO_DATA_FOUND';
    echo _api_response($fields);
    die;
}
$timeoff_data = array();
$timeoff_data['start_date'] = _DigitsTopersian(_gj(strtotime($each_data['from_date'])));
$timeoff_data['end_date'] = _DigitsTopersian(_gj(strtotime($each_data['to_date'])));
$timeoff_data['start_time'] = _tt($each_data['from_date']);
$timeoff_data['end_time'] = _tt(($each_data['to_date']));
$timeoff_data['time_off_type_id'] = $each_data['reason_id'];
$timeoff_data['time_off_type'] = _get_timeoff_farsi($each_data['reason_id']);
$timeoff_data['total_time_off_time'] = $each_data['absence_type'] == 'hourly' ? _s2p($each_data['total_days'] * 60) : _DigitsTopersian(($each_data['total_days'] / 440) * 60);
$timeoff_data['request_status'] = language::leave_status($each_data['status']);
$timeoff_data['absence_type'] = $each_data['absence_type'] == 'hourly' ? 1 : 2;

if ($each_data['day_hourly'] != 'DEFAULT') {
    $timeoff_data['start_time'] = _tt($each_data['from_date']);
    $timeoff_data['end_time'] = _tt($each_data['to_date']);
}
$timeoff_data['id'] = $each_data['id'];
$timeoff_data['unique_id'] = $each_data['unique_id'];
$timeoff_data['user_comment'] = $each_data['employee_notes'] == 'DEFAULT' ? '' : $each_data['employee_notes'];
$timeoff_data['manager_comment'] = $each_data['manager_notes'] == 'DEFAULT' ? '' : $each_data['manager_notes'];
$timeoff_data['circle_data'] = _get_day_persian(date("Y-m-d", strtotime($each_data['from_date'])));


if (strtolower($each_data['absence_type']) == 'hourly') {
    $timeoff_data['total_hours'] = _s2p($each_data['total_days'] * 60);
} else {
    $timeoff_data['total_days'] = _DigitsTopersian($each_data['total_days_applied']);
}

$timeoff_data['is_deleted'] = 1;
if (!empty($each_data)) {
    $currentDate = date('Y-m-d');
    if ($currentDate >= date('Y-m-d', strtotime($each_data["from_date"]))) {
        $is_deleted = 0;
        $timeoff_data['is_deleted'] = 0;
    }    
}



$fields['success'] = '1';
$fields['data'] = $timeoff_data;

echo _api_response($fields);
die;
