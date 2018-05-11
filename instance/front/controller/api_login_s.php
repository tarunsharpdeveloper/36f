<?php

$password = md5(trim(_escape($_REQUEST['password'])));
$mobile = (trim(_escape($_REQUEST['mobile'])));
$device_token = $_REQUEST['device_token'];

$user_data = qs("SELECT * FROM tb_employee WHERE mobile='{$mobile}' AND password='{$password}' and status='0'");
$company = qs("select * from tb_company_works where id='{$user_data['work_at']}'");
$team = qs("select * from tb_company_works where id='{$user_data['team_id']}'");
$fields = array();
$fields_data = array();

employee::resetTokenForDevice($device_token,$user_data['id']);
$random_number = employee::generateToken();

if (!empty($user_data)) {
    $fields['device_token'] = $device_token;
    $fields['user_id'] = $user_data['id'];
    $fields['log_date'] = date("Y-m-d H:i");
    $fields['session_token'] = $random_number;
    $fields['token_status'] = 'VALID';
    qi("tb_user_devices_log", $fields);



    $user_data = arrayRemoveNull($user_data);
    $fields = array();
    $fields['status'] = "1";
    $fields['message'] = "";
    $user_data['company_id'] = $user_data['work_at'];
    $user_data['company_name'] = $company['name'];
    $user_data['team_name'] = $team['name'];
    $user_data['company_id'] = $user_data['work_at'];
    $user_data['profile_image'] = 'user.jpg';
    $user_data['token_36five'] = $random_number;
    $user_data['token_state'] = _cg('token_state');
    $user_data['token_message'] = _cg('token_message');

    $user_data['shift_id'] = 0;
    $shift_data = shift::is_having_live_shift($user_data['id']);
    if (!empty($shift_id)) {
        $user_data['shift_id'] = $shift_data['id'];
    }


    $fields['data'] = ($user_data);



    echo json_encode($fields, JSON_UNESCAPED_UNICODE);
    die;
} else {
    $fields['status'] = "0";
    $fields['message'] = "Invalid credentials provided";
    $fields_data['user_id'] = "-1";
    $fields['data'] = $user_data;
    $user_data = (arrayRemoveNull($user_data));
    echo _api_response($fields);
}
die;
?>