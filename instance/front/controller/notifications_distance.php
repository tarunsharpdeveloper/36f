<?php

$user_id = 23;

//$lat = '22.2649';
//$lng = '70.7845'; 

$lat = '22.2903';
$lng = '70.7785';

$awayDistance = Notifications::_check_radius_at_checkout($user_id, $lat, $lng);

if ($awayDistance > 599) {
    $adminId = 0;
    $employeeDetail = qs("SELECT id,fname,lname,work_at FROM tb_employee WHERE id = '{$user_id}'");
    if ($employeeDetail['work_at'] > 0) {
        $adminId = employeeDetail::getAdminIdFromCopmanyId($employeeDetail['work_at']);
    }
    $display_name = $employeeDetail["fname"] . " " . $employeeDetail["lname"];

    $notifyField = array();
    $notifyField['emp_id'] = $adminId;
    $notifyField['company_id'] = _e($employeeDetail['work_at'], 0);
    $notifyField['type_add_edit'] = 'add';
    $notifyField['module_name'] = 'employee away from the office';
    $notifyField['module_rec_id'] = $employeeDetail["id"];
    $notifyField['display_text'] = $display_name.' away '.round($awayDistance).' meters distance from the office';    
    $notifyField['add_edit_by_userid'] = _e($employeeDetail["id"], 0); 
    qi('tb_notifications', _escapeArray($notifyField)); 
}
die;
?>

