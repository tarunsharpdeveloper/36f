<?php

$user_id = _e($_REQUEST['user_id'], 0);
$old_password = (trim(_escape($_REQUEST['current_password'])));
$new_password = (trim(_escape($_REQUEST['new_password'])));
$device_token = $_REQUEST['device_token'];


if (!$user_id) {
    $fields['status'] = "0";
    $fields['message'] = "INVALID_USER_ID";
    _api_response($fields);
}

if (!validate_password($new_password)) {
    $fields['status'] = "0";
    $fields['message'] = "INVALID_NEW_PASSWORD_FORMAT";
    _api_response($fields);
}

if ($device_token == '') {
    $fields['status'] = "0";
    $fields['message'] = 'INVALID_DEVICE_TOKEN';
    _api_response($fields);
}

$password_match = employee::matchPassword($user_id, $old_password);

if (!$password_match) {
    $fields['status'] = "0";
    $fields['message'] = "INVALID_OLD_PASSWORD";
    _api_response($fields);
}

$new_password = md5($new_password);
qu("tb_employee", array('password' => $new_password), " id = '{$user_id}'  ");
$fields['status'] = "1";
$fields['message'] = "PASSWORD_UPDATED";
_api_response($fields);
die;



$user_data = qs("SELECT * FROM tb_employee WHERE id= '{$user_id}' ");

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
$fields['message'] = "PASSWORD_UPDATED";


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
_api_response($fields);


die;
?>