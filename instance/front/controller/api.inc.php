<?php

//_errors_on();


$from_browser = false;
$app_post_data = json_decode(file_get_contents('php://input'), true);


if (!empty($app_post_data)) {
    $from_browser = true;
    $_REQUEST = array_merge($app_post_data, $_REQUEST);
}

Config::$from_ios = isset($_REQUEST['fromIOS']) ? "1" : "0";

header('Content-Type: application/json; charset=utf-8');
$timeZone = _e($_REQUEST['timezone'], 'Asia/Kolkata');
//date_default_timezone_set($timeZone);
date_default_timezone_set('UTC');

$session_token = $_REQUEST['token_36five'];

helper::_api_log($_REQUEST, 'REQUEST');
//apiSlack::pingSlack("REQUEST_RECEIVED_FROM_APP");


if (!_isLocalHost() ) {
    include _PATH . "instance/front/controller/api_token_init.php";
}
if ($session_token == '36five') {
    _cg('token_state', 'VALID_TOKEN');
    _cg('token_message', '');
}


if ($_REQUEST['q'] == "api/login_s") {
    include _PATH . "instance/front/controller/api_login_s.php";
}

if ($_REQUEST['q'] == "api/login") {
    include _PATH . "instance/front/controller/api_login.php";
}
if ($_REQUEST['q'] == "api/logout") {
    include _PATH . "instance/front/controller/api_logout.php";
}


if ($_REQUEST['q'] == "api/signup") {
    include _PATH . "instance/front/controller/api_signup.php";
}


if ($_REQUEST['q'] == "api/set_password") {
    include _PATH . "instance/front/controller/api_set_password.php";
}
if ($_REQUEST['q'] == "api/send_otp" || $_REQUEST['q'] == "api/resend_otp") {
    include _PATH . "instance/front/controller/api_send_otp.php";
}
if ($_REQUEST['q'] == "api/validate_otp") {
    include _PATH . "instance/front/controller/api_validate_otp.php";
}

if ($_REQUEST['q'] == "api/forgot_password") {
    include _PATH . "instance/front/controller/api_forgot_password.php";
}
if ($_REQUEST['q'] == "api/change_password") {
    include _PATH . "instance/front/controller/api_change_password.php";
}


if ($_REQUEST['q'] == "api/user_exist") {
    include _PATH . "instance/front/controller/user_exist.php";
}

if (_cg('token_state') == 'INVALID_TOKEN') {
    if (!_isLocalHost()) {
        echo _api_response(array());
    }
}


if ($_REQUEST['q'] == "api/active_badge_list") {
    include _PATH . "instance/front/controller/api_active_badge_list.php";
}

if ($_REQUEST['q'] == "api/having_shift") {
    include _PATH . "instance/front/controller/api_having_shift.php";
}


if ($_REQUEST['q'] == "api/set_clock_in" || $_REQUEST['q'] == "api/clock_in_via_clock") {
    include _PATH . "instance/front/controller/api_set_clock_in.php";
}

# clock_in_via_bc is not used
if ($_REQUEST['q'] == "api/clock_in_via_bc" || $_REQUEST['q'] == "api/start_current_meeting") {
    $briefcase = 1;
    include _PATH . "instance/front/controller/api_set_clock_in.php";
}

if ($_REQUEST['q'] == "api/set_clock_out") {
    include _PATH . "instance/front/controller/api_set_clock_out.php";
}
if ($_REQUEST['q'] == "api/clock_out_via_clock") {
    $end_day_normally = 1;
    include _PATH . "instance/front/controller/api_set_clock_out.php";
}
if ($_REQUEST['q'] == "api/clock_out_via_bc") {
    $end_meeting_and_day_also = 1;
    include _PATH . "instance/front/controller/api_set_clock_out.php";
}
if ($_REQUEST['q'] == "api/clock_out_via_timeout") {
    $end_day_by_timeout = 1;
    include _PATH . "instance/front/controller/api_set_clock_out.php";
}

if ($_REQUEST['q'] == "api/end_current_meeting") {
    $end_meeting_only = 1;
    include _PATH . "instance/front/controller/api_set_clock_out.php";
}
if ($_REQUEST['q'] == "api/set_lunch_out") {
    include _PATH . "instance/front/controller/api_set_lunch_out.php";
}
if ($_REQUEST['q'] == "api/set_lunch_in") {
    include _PATH . "instance/front/controller/api_set_lunch_in.php";
}
if ($_REQUEST['q'] == "api/assign_task") {
    include _PATH . "instance/front/controller/api_assign_task.php";
}

if ($_REQUEST['q'] == "api/user_profile") {
    include _PATH . "instance/front/controller/api_user_profile.php";
}
if ($_REQUEST['q'] == "api/timesheet") {
    include _PATH . "instance/front/controller/api_timesheet.php";
}
if ($_REQUEST['q'] == "api/month_timecard") {
    include _PATH . "instance/front/controller/api_month_timecard.php";
}
if ($_REQUEST['q'] == "api/live_shift") {
    include _PATH . "instance/front/controller/api_live_shift.php";
}

if ($_REQUEST['q'] == "api/calendar") {
    include _PATH . "instance/front/controller/api_calendar.php";
}



if ($_REQUEST['q'] == "api/live_shift_new") {
    include _PATH . "instance/front/controller/api_live_shift_new.php";
}
if ($_REQUEST['q'] == "api/schedule") {
    include _PATH . "instance/front/controller/api_schedule.php";
}
if ($_REQUEST['q'] == "api/schedule_details") {
    include _PATH . "instance/front/controller/api_schedule_details.php";
}

if ($_REQUEST['q'] == "api/summary") {
    include _PATH . "instance/front/controller/api_shift_summary.php";
}

if ($_REQUEST['q'] == "api/timesheet_page_month_data") {
    include _PATH . "instance/front/controller/api_timesheet_page_month_data.php";
}
if ($_REQUEST['q'] == "api/timesheet_page_detail_day_data") {
    include _PATH . "instance/front/controller/api_timesheet_page_detail_day_data.php";
}


/* Errands Starts */
if ($_REQUEST['q'] == "api/errands_simple_view") {
    include _PATH . "instance/front/controller/api_errands_simple_view.php";
}
if ($_REQUEST['q'] == "api/errands_detail_view") {
    include _PATH . "instance/front/controller/api_errands_detail_view.php";
}
if ($_REQUEST['q'] == "api/errands_add") {
    include _PATH . "instance/front/controller/api_errands_add.php";
}
if ($_REQUEST['q'] == "api/errands_edit") {
    include _PATH . "instance/front/controller/api_errands_edit.php";
}
if ($_REQUEST['q'] == "api/errands_cancel") {
    include _PATH . "instance/front/controller/api_errands_cancel.php";
}
if ($_REQUEST['q'] == "api/errands_delete") {
    include _PATH . "instance/front/controller/api_errands_delete.php";
}
if ($_REQUEST['q'] == "api/errands_send_message") {
    include _PATH . "instance/front/controller/api_errands_send_message.php";
}


/* Timeoff Starts */
if ($_REQUEST['q'] == "api/timeoff_simple_view") {
    include _PATH . "instance/front/controller/api_timeoff_simple_view.php";
}
if ($_REQUEST['q'] == "api/timeoff_detail_view") {
    include _PATH . "instance/front/controller/api_timeoff_detail_view.php";
}
if ($_REQUEST['q'] == "api/timeoff_add") {
    include _PATH . "instance/front/controller/api_timeoff_add.php";
}
if ($_REQUEST['q'] == "api/timeoff_edit") {
    include _PATH . "instance/front/controller/api_timeoff_edit.php";
}
if ($_REQUEST['q'] == "api/timeoff_cancel") {
    include _PATH . "instance/front/controller/api_timeoff_cancel.php";
}
if ($_REQUEST['q'] == "api/timeoff_delete") {
    include _PATH . "instance/front/controller/api_timeoff_delete.php";
}

/* Mail send for not complete onboardning process */
if ($_REQUEST['q'] == "api/alert_mail_onboarding_process") {
    include _PATH . "instance/front/controller/api_alert_mail_onboarding_process.php";
}

if ($_REQUEST['q'] == 'api/proceed_leave') {
    include _PATH . "instance/front/controller/api_proceed_leave.php";
}
if ($_REQUEST['q'] == 'api/notifications_hire_dob_date') {
    include _PATH . "instance/front/controller/notifications_hire_dob_date.php";
}
if ($_REQUEST['q'] == 'api/set_checkout_summary_message') {
    include _PATH . "instance/front/controller/set_checkout_summary_message.php";
}

if ($_REQUEST['q'] == "api/notifications_distance") {
    include _PATH . "instance/front/controller/notifications_distance.php";
}

if ($_REQUEST['q'] == "api/notifications_get") {
    include _PATH . "instance/front/controller/api_notifications_get.php";
}

if ($_REQUEST['q'] == "api/help") {
    include _PATH . "instance/front/controller/api_help.php";
}


if ($_REQUEST['q'] == "api/add_test_data") {
    include _PATH . "instance/front/controller/apiTest_add_sample_timesheet_data.php";
    print "Sample data added";
    ;
    die;
}
if ($_REQUEST['q'] == "api/truncate") {
    if (isset($_REQUEST['user_id'])) {
        qd("tb_shift_check_inout", " user_id = '{$_REQUEST['user_id']}'  ");
        qd("tb_shift_time", " user_id =  '{$_REQUEST['user_id']}' ");
        qd("tb_assign_shift", " user_id =  '{$_REQUEST['user_id']}' ");
        qd("tb_user_devices_log", " user_id =  '{$_REQUEST['user_id']}' ");
        qd("errands", " employee_id =  '{$_REQUEST['user_id']}' ");
        qd("tb_timeoff", " emp_id =  '{$_REQUEST['user_id']}' ");
        print "Data truncated";
    } else {
        print "No Data truncated";
    }
    die;
}

//$inputJSON = file_get_contents('php://input');
//$url_args = _cg('url_vars');
//if(count($url_args)>0){
//    if($url_args[0]=='SetDrivers'){
//        $fields = json_decode($inputJSON,true);        
//        $data = qs("select * from tb_driver where license_plate='{$fields['license_plate']}'");
//        echo _api_response(array("success"=>'1','records'=>$data));
//    }else{
//        echo _api_response(array("success"=>'0','message'=>'Invalid API Call'));        
//    }
//}else{
//    echo _api_response(array("success"=>'0','message'=>'Invalid API Call'));
//}
//die;
echo _api_response(array("success" => '0', 'message' => 'Invalid API Call'));
die;
?>