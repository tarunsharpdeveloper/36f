<?php

$emp_id = $_REQUEST['emp_id'];

if (!$emp_id) {
    $fields = array();
    $fields['result'] = "error";
    $fields['msg'] = "INVALID_EMP_ID";
    echo _api_response($fields);
    die;
}

$notifications = q("SELECT id,display_text FROM tb_notifications WHERE emp_id = '{$emp_id}' AND is_user_view = 0");
$notificationIds = array();
$notificationTexts = array();
$notificationIdsText = '';
$notificationIdsText.='0,';
foreach ($notifications as $eachNotifications):
    $notificationIds[] = $eachNotifications['id'];
    $notificationIdsText .= $eachNotifications['id'] . ',';
    $notificationTexts[] = $eachNotifications['display_text'];
endforeach;

$notificationIdsForInQuery = substr($notificationIdsText, 0, -1); 
$responseArr = array();
$responseArr['success'] = '1';
$responseArr['msg'] = 'GET SUCCESSFULLY';
$responseArr['notifications'] = $notificationTexts;

$fields = array();
$fields['is_user_view'] = 1;
$condition = ' id IN(' . $notificationIdsForInQuery . ')'; 
qu("tb_notifications", $fields, $condition);     

echo _api_response($responseArr);
die;
?>