<?php

if (isset($_REQUEST['doc_helper'])) {
    include _PATH . "instance/front/controller/api_timesheet_page_helper.php";
    die;
}

$user_id = _e($_REQUEST['user_id'], 0);
ts::$_page = _e($_REQUEST['page'], 1);
ts::$_limit = _e($_REQUEST['page_size'], 5);

#in the format of 01-month-year
$month = _e($_REQUEST['month'], 0);

if (!$user_id) {
    $fields = array();
    $fields['success'] = "0";
    $fields['msg'] = "INVALID_USER_ID";
    echo _api_response($fields);
    die;
}

# So, 01/05 - the month will be now into the format of
# shamsey - yyyy-mm
# i have to write a logic to get the start and end date equivalent of the shamsey month's first to shamsey's last
# https://calendar.zoznam.sk/persian_calendar-en.php?ly=2025
/*

$months_data = ts::get_month_start_end_from_jalali_yyyymm($month);
if ($months_data === FALSE) {
    $fields = array();
    $fields['success'] = "0";
    $fields['msg'] = "INVALID_MONTH_ID";
    echo _api_response($fields);
    die;
}

//$month_start = date("Y-m-01", strtotime($month));
//$month_end = date("Y-m-31", strtotime($month));

$month_start = $months_data['start'];
$month_end = $months_data['end'];

if ($month == "0000-00") {
    $month_start = date("Y-m-01");
    $month_end = date("Y-m-31");
}
*/


# if it is current month - then we have to calculate till only current day - 1 day.
$current_month_end = date("Y-m-31");
if ($month_end == $current_month_end) {
    //$month_end = date("Y-m-d", strtotime("-1 Day"));
}

$calendar_data = ts::get_calendar_data($month_start, 30,$user_id);

$fields = array();
$fields['success'] = "1";
$fields['utc'] = time();
$fields['calendar'] = $calendar_data;

echo _api_response($fields);
die;
