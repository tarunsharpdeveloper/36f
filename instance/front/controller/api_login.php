<?php

$password = md5(trim(_escape($_REQUEST['password'])));
$mobile = (trim(_escape($_REQUEST['mobile'])));
$device_token = $_REQUEST['device_token'];

if ($device_token == '') {
    $fields['status'] = "2";
    $fields['message'] = 'INVALID_DEVICE_TOKEN';
    _api_response($fields);
}

# Please check if the employee exists into the system
$employee_exists = employee::getEmployeeDataByPhone($mobile);
if (empty($employee_exists)) {
    $fields['status'] = "2";
    $fields['message'] = "شماره موبایل وارد شده در سیستم موجود نمی باشد. لطفا با منابع انسانی سازمان خود تماس بگیرید";
    _api_response($fields);
}



$user_data = qs("SELECT * FROM tb_employee WHERE mobile='{$mobile}' AND password='{$password}' and status='0'");




if (!empty($user_data)) {

    $company = qs("select * from tb_company_works where id='{$user_data['work_at']}'");
    $team = qs("select * from tb_company_works where id='{$user_data['team_id']}'");
    $fields = array();
    $fields_data = array();


    employee::resetTokenForDevice($device_token, $user_data['id']);
    $random_number = employee::generateToken();

    $fields['device_token'] = $device_token;
    $fields['user_id'] = $user_data['id'];
    $fields['log_date'] = date("Y-m-d H:i");
    $fields['session_token'] = $random_number;
    $fields['token_status'] = 'VALID';
    qi("tb_user_devices_log", $fields);

    $fields = array();

    $fields['shift_id'] = 0;
    $shift_data = shift::is_having_live_shift($user_data['id']);
    if (!empty($shift_data)) {
        $fields['shift_id'] = $shift_data['id'];
    }

    $user_data = arrayRemoveNull($user_data);

    $fields['status'] = "1";
    $fields['message'] = "";


    $fields['user_id'] = $user_data['id'];
    $fields['name'] = $user_data['fname'];
    $fields['family'] = $user_data['lname'];
    $fields['email'] = $user_data['email'];
    $fields['team'] = $team['name'];
    $fields['company_id'] = $user_data['work_at'];
    $fields['birthday'] = $user_data['birth_cert'];
    $fields['gender'] = $user_data['gender'];
    $fields['mobile'] = $user_data['mobile'];
    $fields['device_token'] = $device_token;
    $fields['token_36five'] = $random_number;



    echo _api_response($fields);
} else {
    $fields['status'] = "3";
    $fields['message'] = "رمز عبور وارد شده نادرست است";
    $fields_data['user_id'] = "-1";
    $fields['data'] = $user_data;
    $user_data = (arrayRemoveNull($user_data));
    echo _api_response($fields);
}
die;
?>