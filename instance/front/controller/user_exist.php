<?php

$mobile = (trim(_escape($_REQUEST['mobile'])));
//$password = md5(trim(_escape($_REQUEST['password'])));

$user_data = qs("SELECT * FROM tb_employee WHERE mobile='{$mobile}' and status='0'");

if (!empty($user_data)) {

    $fields = array();
    $fields['result'] = "success";
    $fields['is_user'] = "true";

    if (!empty($user_data['password'])) {
        $fields['is_password'] = "true";
    } else {
        $fields['is_password'] = "false";
    }
    $fields['msg'] = "user exist successful";
    echo json_encode($fields);
} else {
    $fields['result'] = "error";
    $fields['is_user'] = "false";
    $fields['msg'] = "user not exist";
    echo json_encode($fields);
}
die;
?>