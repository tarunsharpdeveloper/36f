<?php

if (isset($_REQUEST['doc_helper'])) {
    include _PATH . "instance/front/controller/api_schedule_doc_helper.php";
    die;
}

//_errors_on();
$user_id = $_REQUEST['user_id'];

if (!$user_id) {
    $fields = array();
    $fields['success'] = "0";
    $fields['msg'] = "INVALID_USER_ID";
    $fields['utc'] = time();
    echo _api_response($fields);
    die;
}

$start_date = $_REQUEST['start_date'];
if (!$start_date) {
    $fields = array();
    $fields['success'] = "0";
    $fields['msg'] = "INVALID_START_DATE";
    $fields['utc'] = time();
    echo _api_response($fields);
    die;
}
#start date will be into the yyyy-mm-dd format from parsi
$start_date = _persianToDigits($start_date);


if ($start_date == "0000-00-00" || $start_date == "0000-00") {
    $start_date = substr(_gj(strtotime(date("Y-m-d"))),0,7);
}

$start_date_parts = explode("-", $start_date);
# convert the date into the gregorian 
$start_date = _jg($start_date_parts[0], $start_date_parts[1], $start_date_parts[2]);


if (strtotime($start_date) == false) {
    $fields = array();
    $fields['success'] = "0";
    $fields['msg'] = "INVALID_START_DATE_FORMAT";
    $fields['utc'] = time();
    echo _api_response($fields);
    die;
}


$end_date = date("Y-m-d", strtotime("+6 days", strtotime($start_date)));


$schedule_data = q("select * from `tb_assign_shift` WHERE user_id='{$user_id}' and start_date>='{$start_date}' ");

if (empty($schedule_data)) {
    $fields = array();
    $fields['success'] = "0";
    $fields['msg'] = "NO SCHEDULE DATA FOUND";
    $fields['utc'] = time();
    echo _api_response($fields);
    die;
}

$return = array();
foreach ($schedule_data as $each_data) {
    $array = array();
    $array['name'] = _e($each_data['title'], "NORMAL_SHIFT");
    $array['location'] = _e($each_data['location'], "TEHRAN");
    $array['team_name'] = _e($each_data['team'], "MARKETING");
    $array['shift_start_date'] = _DigitsTopersian(substr(_gj(strtotime($each_data['start_date'])), 2));
    $array['shift_start_time'] = _tt(date("Y-m-d H:i:s", strtotime("{$each_data['start_date']} {$each_data['start_time']}")), "G:i");
    $array['shift_end_date'] = $each_data['start_date'] == $each_data['end_date'] ? "0" : _DigitsTopersian(substr(_gj(strtotime($each_data['end_date'])), 2));
    $array['shift_end_time'] = _tt(date("Y-m-d H:i:s", strtotime("{$each_data['end_date']} {$each_data['end_time']}")), "G:i");
    $return[] = $array;
}
$fields = array();
$fields['success'] = "1";
$fields['utc'] = time();
$fields['shifts'] = $return;
echo _api_response($fields);
die;


die;
?>