<?php

$user_data = "";
$mobile = (trim(_escape($_REQUEST['mobile'])));

$employee_exists = employee::getEmployeeDataByPhone($mobile);
if (empty($employee_exists)) {
    $fields['status'] = "1";
    $fields['message'] = "شماره موبایل وارد شده در سیستم موجود نمی باشد. لطفا با منابع انسانی سازمان خود تماس بگیرید";
    _api_response($fields);
}

if ($employee_exists['password'] != '') { 
    $fields['status'] = "2";
    $fields['message'] = "حساب کاربری شما فعال است، لطفا رمز عبور خود را وارد نمایید";
    _api_response($fields);
}
if ($employee_exists['password'] == '') {
    $fields = array();
    $fields['status'] = "3";
    $fields['user_id'] = $employee_exists['id'];
    $fields['msg'] = "SUCCESS";
    _api_response($fields);
}
$fields = array();
$fields['status'] = "4";
$fields['msg'] = "UNKNOWN";
_api_response($fields);



die;
?>