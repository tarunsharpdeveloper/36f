<?php

$mobile = (trim(_escape($_REQUEST['mobile'])));

# Please check if the employee exists into the system
$employee_exists = employee::getEmployeeDataByPhone($mobile);
if (empty($employee_exists)) {
    $fields['status'] = "0";
    $fields['message'] = "Sorry, we don't show you in system";
    _api_response($fields);
}


$mobile = (trim(_escape($_REQUEST['mobile'])));

$user_data = qs("SELECT * FROM tb_employee WHERE mobile='{$mobile}' and status='0'");
//d($user_data);

if (!empty($user_data)) {
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