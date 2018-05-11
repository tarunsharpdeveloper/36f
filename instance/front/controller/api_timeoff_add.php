<?php

$persianDate = new persian_date();
$persianNumbers = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

$emp_id = _e(trim($_REQUEST['user_id']),0);
$employeeDetail = employeeDetail::GetEmployeeNameAndEmail($emp_id);

$_REQUEST['start_time'] = _e($_REQUEST['start_time'],"00:00:00");
$_REQUEST['end_time'] = _e($_REQUEST['end_time'],"00:00:00");

$fields = array();
if ($_REQUEST['absence_type'] == '1') {
    //$fromDate = date('Y-m-d H:i:s', strtotime(trim($_REQUEST['leave_date']) . " " . trim($_REQUEST['start_time'])));
    //$toDate = date('Y-m-d H:i:s', strtotime(trim($_REQUEST['leave_date']) . " " . trim($_REQUEST['end_time'])));
    $fromDate = _j2g_full(_persianToDigits("{$_REQUEST['leave_date']} {$_REQUEST['start_time']}"));
    $toDate = _j2g_full(_persianToDigits("{$_REQUEST['leave_date']} {$_REQUEST['end_time']}"));
} else {
    //$fromDate = date('Y-m-d H:i:s', strtotime(trim($_REQUEST['start_date'])));
    //$toDate = date('Y-m-d H:i:s', strtotime(trim($_REQUEST['end_date'])));
    $fromDate = _j2g_full(_persianToDigits("{$_REQUEST['start_date']} 00:00:00"));
    $toDate = _j2g_full(_persianToDigits("{$_REQUEST['end_date']} 00:00:00"));
}

$managerNotes = trim($_REQUEST['manager_notes']);
$absence_type = $_REQUEST['absence_type'] == '1' ? "hourly" : 'entireDay';
$fields = array();
$date1 = date_create($fromDate);
$date2 = date_create($toDate);
$diff = date_diff($date1, $date2);
if ($absence_type == 'hourly' && $diff->invert == 1) {
    $nextDay = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($toDate)));
    $toDate = $nextDay;
    $nextDate = date_create($nextDay);
    $diff = date_diff($date1, $nextDate); 
}

$leaveType = trim($_REQUEST['reason']);
if ($leaveType == 2) {
    $leaveType = 'Day Off (With Payment)';
} else if ($leaveType == 3) {
    $leaveType = 'Time Off (Without Payment)';
} else if ($leaveType == 4) {
    $leaveType = 'Sick Time';
}   

$empWorkingHours = employeeDetail::GetEmployeePerDayWorkingHours($emp_id, $leaveType);
$total_days_applied = 0;
if ($_REQUEST['absence_type'] == '2') {
    $leave = 0;
    for ($i = 0; $i < $diff->days + 1; $i++) {
        $sdate = date("Y-m-d", strtotime("+" . $i . " Days", strtotime($fromDate)));
        $checkLeave = qs("select * from timesheet_leave where leave_date='{$sdate}' ");
        if (!empty($checkLeave)) {
            $leave++;
        }
    }

    $total_days = ($diff->days + 1);
    $total_days = $total_days - $leave;
    $total_days_applied = $total_days;
    $total_days = ($total_days * $empWorkingHours);
} else if ($_REQUEST['absence_type'] == '1') {
    $total_days = ($diff->i + ($diff->h * 60));
}

$unique_id = array();
$companyName = qs("select name from tb_company_works where id='{$_REQUEST['company_id']}'");

$unique_id[] = str_replace(" ", "_", $companyName['name']);
$unique_id[] = str_replace(" ", "_", $employeeDetail['full_name']);
$unique_id[] = strtotime($fromDate);
$unique_id[] = clearNumber(substr($leaveType, 0, 10));
$unique_id[] = substr(md5(microtime()), rand(0, 26), 5);
$unique_id = array_filter($unique_id);
$unique_id = implode("_", $unique_id);

$unique_id = getTimeOffDisplayId();

$fields['unique_id'] = $unique_id;
$fields['company_id'] = $_REQUEST['company_id'];
$fields['emp_id'] = $emp_id;
$fields['total_days'] = $total_days;
$fields['total_days_applied'] = $total_days_applied;
$fields['from_date'] = $fromDate;
$fields['to_date'] = $toDate;
$fields['reason'] = _get_timeoff_farsi($_REQUEST['reason']);
$fields['reason_id'] = $_REQUEST['reason'];
$fields['status'] = "NEW_REQUEST";
$fields['subject'] = $_REQUEST['subject'];
$fields['absence_type'] = $absence_type;
$fields['employee_notes'] = _e($_REQUEST['employee_notes'], 'DEFAULT');
$fields['manager_notes'] = _e($managerNotes, 'DEFAULT');
$fields['added_by_id'] = $emp_id;

$id = qi("tb_timeoff", _escapeArray($fields));

$display_name = $employeeDetail['full_name'];
$persianMonthName = '';
$persianDayName = '';
$persianMonthName = $persianDate->to_date($fromDate, 'M');
$persianDayName = $persianDate->to_date($fromDate, 'd');
$persianNoDate = '';
$persianNumbers1 = substr($persianDayName, 0, 1);
$persianNumbers2 = substr($persianDayName, 1, 1);
if ($persianNumbers1 != '') {
    $persianNoDate .= $persianNumbers[$persianNumbers1];
}
if ($persianNumbers2 != '') {
    $persianNoDate .= $persianNumbers[$persianNumbers2];
}

$adminId = 0;
if ($_REQUEST['company_id'] > 0) {
    $adminId = employeeDetail::getAdminIdFromCopmanyId($_REQUEST['company_id']);
}

$notifyField = array();
$notifyField['emp_id'] = $adminId;
$notifyField['company_id'] = $_REQUEST['company_id'];
$notifyField['type_add_edit'] = 'add';
$notifyField['module_name'] = 'timeoff';
$notifyField['module_rec_id'] = $id;
$notifyField['display_text'] = '<div><div style="float:left;width:auto;height:1px;">' . $display_name . ' want to new timeoff request at, </div><div style="float:left;margin-left:6px;"><div style="float:left;">' . $persianMonthName . '</div><div style="float:right;margin-left:6px;">' . $persianNoDate . '</div><div class="clearfix"></div></div><div class="clearfix"></div></div>';
$notifyField['add_edit_by_userid'] = $emp_id;
qi('tb_notifications', _escapeArray($notifyField));

unset($fieldsComment);
$fieldsComment['timeoff_id'] = $id;
$fieldsComment['user_type'] = 'employee';
$fieldsComment['comment_text'] = $_REQUEST['employee_notes'];
qi("tb_timeoff_comments", $fieldsComment);

$getBalance = qs("SELECT * FROM employee_leave_balance WHERE employee_id = '{$emp_id}'");
$fieldsBalance["leave_pending_balance"] = ($getBalance["leave_pending_balance"] + $total_days);
$fieldsBalance["leave_balance"] = ($getBalance["leave_balance"] - $total_days);
qu("employee_leave_balance", $fieldsBalance, " employee_id = '{$emp_id}' ");

$fields['success'] = '1';
$fields['msg'] = 'ADDED SUCCESSFULLY';
$fields['data'] = $id;

$responseArr = array();
$responseArr['success'] = '1';
$responseArr['msg'] = 'ADDED SUCCESSFULLY';


echo _api_response($responseArr);
die;
