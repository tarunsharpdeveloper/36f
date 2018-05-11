<?php

$mobile = (trim(_escape($_REQUEST['mobile'])));
$device_token = $_REQUEST['device_token'];
$password = md5(trim(_escape($_REQUEST['password'])));

$user_data = qs("SELECT * FROM tb_employee WHERE mobile='{$mobile}' and status='0'");

if (!empty($user_data)) {
    $fields = array();
    $fields['device_token'] = $device_token;
    $fields['user_id'] = $user_data['id'];
    $fields['log_date'] = date("Y-m-d H:i");


    qi("tb_user_devices_log", $fields);

    $fields = array();
    $fields['password'] = $password;
    $fields['b_photo'] = $_REQUEST['image'];

    $st = qu("tb_employee", $fields, "id='{$user_data['id']}'");
}
if (!empty($st)) {
    $fields = array();
    $fields['result'] = "success";
    $fields['user_id'] = $user_data['id'];
    $fields['msg'] = "";
    echo json_encode($fields);
} else {
    $fields['result'] = "error";
    $fields['user_id'] = "-1";
    $fields['msg'] = "Invalid credentials provided";
    echo json_encode($fields);
}
die;
?>