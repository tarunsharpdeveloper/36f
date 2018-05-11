<?php

$mobile = (trim(_escape($_REQUEST['mobile'])));
$device_token = (trim(_escape($_REQUEST['device_token'])));



//if (!$device_token) {
//    $fields['status'] = "0";
//    $fields['message'] = "INVALID_DEVICE_TOKEN";
//    _api_response($fields);
//}
if (!$mobile) {
    $fields['status'] = "0";
    $fields['message'] = "INVALID_MOBILE NUMBER";
    _api_response($fields);
}

# Please check if the employee exists into the system
$employee_exists = employee::getEmployeeDataByPhone($mobile);
if (empty($employee_exists)) {
    $fields['status'] = "0";
    $fields['message'] = "Sorry, we don't show you in system";
    _api_response($fields);
}

/*
# CHECK FOR LAST 10 MINUTES
$current_time = date('Y-m-d H:i:s');
$last_ten_seconds = time() - 10 * 60;
$last_ten_time = date("Y-m-d H:i:s", $last_ten_seconds);

$qry = "SELECT id FROM otp_logs WHERE user_id='{$employee_exists['id']}' AND (created_at >= '{$last_ten_time}' and created_at<= '{$current_time}')  and device_token = '{$device_token}' ";
$res = q($qry);

if (count($res) > 5) {
    $fields['status'] = "2";
    $fields['message'] = "You can try 10 minutes later";
    $fields['user_id'] = $employee_exists['id'];
    $fields['otp'] = "";
    _api_response($fields);
    exit;
}*/

# CHECK FOR LAST 60 MINUTES FOR DISABLING THE DEVICE
# CHECK FOR LAST 10 MINUTES
$current_time = date('Y-m-d H:i:s');
$last_ten_seconds = time() - 20 * 60;
$last_ten_time = date("Y-m-d H:i:s", $last_ten_seconds);

$qry = "SELECT id FROM otp_logs WHERE user_id='{$employee_exists['id']}' AND (created_at >= '{$last_ten_time}' and created_at<= '{$current_time}') and device_token = '{$device_token}'  ";
$res = q($qry);

/**
 * english:
    dear user, we have detected unusual activity with this device. 
    If you feel it is in error, please contact us at 021-22225464
 */

//if (count($res) > 10) {
//    $fields['status'] = "3";
//    $fields['message'] = "حساب کاربری شما مسدود شده است لطفا با پشتیبانی365 تماس بگیرید ";
//    $fields['user_id'] = $employee_exists['id'];
//    $fields['otp'] = "";
//    _api_response($fields);
//    exit;
//}



$otp = otp::create_otp($mobile, $employee_exists['id'],$device_token);

$fields['status'] = "1";
$fields['message'] = "OTP_GENERATED";
$fields['user_id'] = $employee_exists['id'];
$fields['otp'] = $otp;
_api_response($fields);

die;
?>