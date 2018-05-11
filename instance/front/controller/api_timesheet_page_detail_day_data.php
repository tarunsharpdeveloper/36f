<?php

if (isset($_REQUEST['doc_helper'])) {
    include _PATH . "instance/front/controller/api_timesheet_page_helper.php";
    die;
}

$user_id = _e($_REQUEST['user_id'], 0);
$shift_id = _e($_REQUEST['shift_id'], 0);

#in the format of 01-month-year
$date = _e($_REQUEST['date'], 0);
$date = _persianToDigits($date);


$date_parts = explode("-", $date);
$g_date = _jg($date_parts[0], $date_parts[1], $date_parts[2]);

if (!$user_id) {
    $fields = array();
    $fields['success'] = "0";
    $fields['msg'] = "INVALID_USER_ID";
    echo _api_response($fields);
    die;
}
if (!$shift_id) {
    $fields = array();
    $fields['success'] = "0";
    $fields['msg'] = "INVALID_SHIFT_ID";
    echo _api_response($fields);
    die;
}
/*
# please check if it does have the shift data for the month at all
# if not - then we do not proceed to the rest of the calculations at all
$has_shift_data = ts::has_shift_data_for_month($g_date, $g_date, $user_id);

if (!$has_shift_data) {
    $fields = array();
    $fields['success'] = "0";
    $fields['msg'] = "NO_SHIFT_DATA_FOUND";
    echo _api_response($fields);
    die;
}*/

# get the daily data
$shift_daily_data = ts::get_timesheet_daily_data($g_date, $g_date, $user_id,$shift_id);



$fields = array();
$fields['success'] = "1";
$fields['daily_data'] = $shift_daily_data[0];

echo _api_response($fields);
die;
