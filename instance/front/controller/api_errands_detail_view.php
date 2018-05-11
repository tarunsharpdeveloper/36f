<?php

$user_id = $_REQUEST['user_id'];

$unique_id = _e($_REQUEST['errands_id'], 0);


if (!$user_id) {
    $fields = array();
    $fields['success'] = '0';
    $fields['data'] = array();
    $fields['msg'] = "INVALID_USER_ID";
    echo _api_response($fields);
    die;
}

$persianDate = new persian_date();
$persianNumbers = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

if (!$unique_id) {
    $fields = array();
    $fields['msg'] = "INVALID_ERRANDS_ID";
    $fields['success'] = '0';
    $fields['data'] = array();
    echo _api_response($fields);
    die;
}

$fields = array();


$each_data = qs("select * from errands where employee_id = '{$user_id}' and unique_id = '{$unique_id}'  ");


if (empty($each_data)) {
    $fields['error'] = '1';
    $fields['msg'] = 'NO_DATA_FOUND';
    echo _api_response($fields);
    die;
}
$errands_data = array();
$errands_data['start_date'] = _DigitsTopersian(_gj(strtotime($each_data['from_date_time'])));
$errands_data['end_date'] = _DigitsTopersian(_gj(strtotime($each_data['to_date_time'])));
$errands_data['start_time'] = _tt($each_data['from_date_time']);
$errands_data['end_time'] = _tt($each_data['to_date_time']);
//$errands_data['errands_type'] = $each_data['errands_type'] == "local" ? 1 : 2;
$errands_data['errands_type'] = $each_data['errands_type'] == 'local' ? 'درون شهری' : 'برون شهری';
//$errands_data['total_errands_time'] = _DigitsTopersian($each_data['total_days']);
$errands_data['total_errands_time'] = $each_data['absence_type'] == 'hourly' ? _s2p($each_data['total_days'] * 60) : _DigitsTopersian(($each_data['total_days'] / 440) * 60); 
$errands_data['request_status'] = language::leave_status($each_data['status']);
$errands_data['subject'] = $each_data['subject'];
$errands_data['absence_type'] = $each_data['absence_type'] == 'hourly' ? 1 : 2;
$errands_data['transportation_method'] = language::transportation_type($each_data['transportation_method']);
$errands_data['transportation_method_type'] = language::transportation_type_id($each_data['transportation_method']);
$errands_data['day_request_submitted'] = $each_data['day_request_submitted'];
$request_date_db = $each_data['day_request_submitted'];
if (strtolower($request_date_db) != 'default') {
    $year1 = substr($request_date_db, 0, 1);
    $year2 = substr($request_date_db, 1, 1);
    $year3 = substr($request_date_db, 2, 1);
    $year4 = substr($request_date_db, 3, 1);
    $parsainYear = $persianNumbers[$year1] . $persianNumbers[$year2] . $persianNumbers[$year3] . $persianNumbers[$year4];

    $month1 = substr($request_date_db, 5, 1);
    $month2 = substr($request_date_db, 6, 1);
    $parsainMonth = $persianNumbers[$month1] . $persianNumbers[$month2];

    $date1 = substr($request_date_db, 8, 1);
    $date1 = substr($request_date_db, 9, 1);
    $parsainDate = $persianNumbers[$date1] . $persianNumbers[$date1];

    $request_date = $parsainYear . "-" . $parsainMonth . "-" . $parsainDate;
} else {
    $request_date = '';
}

$errands_data['request_date'] = $request_date;
$errands_data['requested_by'] = $each_data['requested_by'];
$errands_data['destination'] = $each_data['destination'];
$errands_data['origin'] = $each_data['starting_point'];
$errands_data['food'] = language::food_auth($each_data['food_authorization']);
$errands_data['overnight_compensation'] = ($each_data['overnight_compensation'] == 'yes') ? 1 : 0;


if ($each_data['errands_type'] == 'local') {
    //$errands_data['start_time'] = _tt(date("Y-m-d H:i:s", $each_data['from_date_time_seconds']));
    //$errands_data['end_time'] = _tt(date("Y-m-d H:i:s", $each_data['to_date_time_seconds']));
} else {
    $errands_data['lodging'] = $each_data['lodging'];
}
$errands_data['id'] = $each_data['id'];
$errands_data['unique_id'] = $each_data['unique_id'];
$errands_data['user_comment'] = $each_data['employee_comments'];
$errands_data['manager_comment'] = $each_data['manager_comments'];
$errands_data['circle_data'] = _get_day_persian(date("Y-m-d", strtotime($each_data['from_date_time'])));
if (strtolower($each_data['absence_type']) == 'entireday') {
    $totalDaysApplied = $each_data['total_days_applied'];
    if ($totalDaysApplied == 0) {
        $totalDaysApplied = 1;
    }
    //$errands_data['total_days'] = convertInFarsi($totalDaysApplied);
    $errands_data['total_days'] = _DigitsTopersian($totalDaysApplied); 
} else {
    //$errands_data['total_hours'] = convertInFarsi(convertMinutesToHourMinuteFormat($each_data['total_days']));
    $errands_data['total_hours'] = _s2p($each_data['total_days'] * 60); 
}


$errands_data['is_deleted'] = 1;
if (!empty($each_data)) {
    $currentDate = date('Y-m-d');
    $errandId = $each_data["id"];
    $old_fields_data = qs("SELECT from_date_time  FROM errands WHERE id = '{$errandId}'");
    if ($currentDate >= date('Y-m-d', strtotime($old_fields_data['from_date_time']))) {
        $is_deleted = 0;
        $errands_data['is_deleted'] = 0;
    }
}

$fields['success'] = '1';
$fields['data'] = $errands_data;

echo _api_response($fields);  
die;
