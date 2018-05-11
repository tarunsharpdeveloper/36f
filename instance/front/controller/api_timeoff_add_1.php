<?php

$user_id = $_REQUEST['emp_id'];
$fields = array();

if (!$user_id) {
    $fields['error'] = '1';
    $fields['msg'] = 'invalid userid';
    echo _api_response($fields);
    die;
}

$db_fields = array();

$db_fields['company_id'] = _e($_REQUEST['company_id'], 0);
$db_fields['emp_id'] = _e($_REQUEST['emp_id'], 0);
$db_fields['absence_type'] = _e($_REQUEST['absence_type'], 'DEFAULT');
$db_fields['status'] = 'NEW_REQUESTED';
$db_fields['reason'] = _e($_REQUEST['reason'], 'DEFAULT');
$db_fields['total_days'] = _e($_REQUEST['total_days'], 1);
$db_fields['day_hourly'] = _e($_REQUEST['day_hourly'], 'DEFAULT');
$db_fields['employee_notes'] = _e($_REQUEST['employee_notes'], 'DEFAULT');
$db_fields['manager_notes'] = _e($_REQUEST['manager_notes'], 'DEFAULT');
$db_fields['subject'] = _e($_REQUEST['subject'], 'DEFAULT');

$db_fields['from_date_timestamp'] = _e($_REQUEST['from_date_timestamp'], time());
$db_fields['to_date_timestamp'] = _e($_REQUEST['to_date_timestamp'], time());

$db_fields['from_date'] = date("Y-m-d H:i:s", ($db_fields['from_date_timestamp']));
$db_fields['to_date'] = date("Y-m-d H:i:s", ($db_fields['to_date_timestamp']));

$id = qi("tb_timeoff", $db_fields);

$fields['success'] = '1';
$fields['msg'] = 'ADDED SUCCESSFULLY';
$fields['data'] = $id;


/* Start Notification entry code */
/*
  Admin
  Manager
  Supervisor
 */

$adminId = 0;
if ($_REQUEST['company_id'] > 0) {
    $adminId = employeeDetail::getAdminIdFromCopmanyId($_REQUEST['company_id']);
}

$employeeInfo = array();
$display_name = '';
if ($_REQUEST['emp_id'] > 0) {
    $employeeInfo = employeeDetail::GetEmployeeNameAndEmail($_REQUEST['emp_id']);
    $display_name = $employeeInfo['full_name'];
}

$persianDate = new persian_date();
$persianNumbers = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
$persianMonthName = '';
$persianDayName = '';
$persianMonthName = $persianDate->to_date($db_fields['from_date'], 'M');
$persianDayName = $persianDate->to_date($db_fields['from_date'], 'd');
$persianNoDate = '';
$persianNumbers1 = substr($persianDayName, 0, 1);
$persianNumbers2 = substr($persianDayName, 1, 1);
if ($persianNumbers1 != '') {
    $persianNoDate .= $persianNumbers[$persianNumbers1];
}
if ($persianNumbers2 != '') {
    $persianNoDate .= $persianNumbers[$persianNumbers2];
}
$notifyField = array();
$notifyField['emp_id'] = $adminId;
$notifyField['company_id'] = _e($_REQUEST['company_id'], 0);
$notifyField['type_add_edit'] = 'add';
$notifyField['module_name'] = 'timeoff';
$notifyField['module_rec_id'] = $id; 
$notifyField['display_text'] = '<div><div style="float:left;width:auto;height:1px;">' . $display_name . ' want to new timeoff request at, </div><div style="float:left;margin-left:6px;"><div style="float:left;">' . $persianMonthName . '</div><div style="float:right;margin-left:6px;">' . $persianNoDate . '</div><div class="clearfix"></div></div><div class="clearfix"></div></div>';
//$notifyField['display_text'] = $display_name . ' want to new timeoff request at ' . date("M d,Y", ($db_fields['from_date']));
$notifyField['add_edit_by_userid'] = _e($_REQUEST['emp_id'], 0);
qi('tb_notifications', _escapeArray($notifyField));

/* End Notification entry code */

echo _api_response($fields);
die;
