<?php

/** to logout the user * */
$device_token = $_REQUEST['device_token'];
$user_id = $_REQUEST['id'];
$status = $_REQUEST['status'];
$session_token = $_REQUEST['token_36five'];


# to logout the user - just add an entry into the tb_user_devices_log with the logout_date and extra notes
$fields = array();
//$fields['device_token'] = $device_token;
//$fields['user_id'] = $user_id;
$fields['extra_notes'] = $status;
$fields['token_status'] = 'INVALID';
$fields['logout_date'] = date("Y-m-d H:i");
qu("tb_user_devices_log", $fields, " session_token = '{$session_token}'  ");


$fields = array();
$fields['status'] = "1";
$fields['message'] = "success";
echo _api_response($fields);
die;
?>