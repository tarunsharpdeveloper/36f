<?php

$currentDate = date('Y-m-d');
if (isset($_REQUEST['unique_id'])) {
    $unique_id = trim($_REQUEST['unique_id']);
}

$status = "Delete";
$comment = '';
if (isset($_REQUEST['commnet']) && $_REQUEST['commnet'] != '') {
    $comment = $_REQUEST['commnet'];
}
if (!$unique_id || !$status) {
    $fields['status'] = '0';
    $fields['msg'] = 'INVALID ID OR STATUS';
    echo _api_response($fields);
    die;
}
//TimeOff Id
$getTimeOffId = qs("SELECT id FROM tb_timeoff WHERE unique_id = '{$unique_id}' ORDER BY id DESC LIMIT 0,1");

if (!empty($getTimeOffId)) {
    $timeOffId = $getTimeOffId["id"];
    $getHoursData = qs("SELECT * FROM tb_timeoff WHERE id = '{$timeOffId}'");
    $totalLeaveMinutes = 0;

    $emp_id = $getHoursData["emp_id"];
    $leaveType = $getHoursData["reason"];
    $empWorkingHours = employeeDetail::GetEmployeePerDayWorkingHours($emp_id, $leaveType);

    if ($currentDate >= date('Y-m-d', strtotime($getHoursData["from_date"]))) {
        unset($fields['error']);
        $fields['success'] = '0';
        $fields['msg'] = '.تغییر برای درخواست مورد نظر امکان پذیر نیست. در صورت نیاز با منابع انسانی سازمان تماس بگیرید';
        echo _api_response($fields);
        die;
    }


    $fromDate = $getHoursData["from_date"];
    $toDate = $getHoursData["to_date"];
    $date1 = date_create($fromDate);
    $date2 = date_create($toDate);
    $diffMin = date_diff($date1, $date2); 
    if ($getHoursData["absence_type"] == "hourly" && $diffMin->invert == 1) {
        $nextDay = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($toDate))); 
        $toDate = $nextDay;
        $nextDate = date_create($nextDay);
        $diffMin = date_diff($date1, $nextDate);
    }
    if ($getHoursData["absence_type"] == "entireDay") {
        $totalLeaveMinutes = (($diffMin->days + 1) * $empWorkingHours);
    } else if ($getHoursData["absence_type"] == "hourly") {
        $totalLeaveMinutes = ($diffMin->i + ($diffMin->h * 60));
    }

    $getLeaveBalances = qs("SELECT * FROM employee_leave_balance WHERE employee_id = '{$getHoursData["emp_id"]}'");
    $getLeaveMainBalance = $getLeaveBalances["leave_balance"];
    $getLeavePendingBalance = $getLeaveBalances["leave_pending_balance"];
    $setLeaveMainBalance = $getLeaveMainBalance;
    $setLeavePendingBalance = $getLeavePendingBalance;

    $setLeaveMainBalance = ($setLeaveMainBalance + $totalLeaveMinutes);
    $setLeavePendingBalance = ($setLeavePendingBalance - $totalLeaveMinutes);


    unset($fieldBalance);
    $fieldBalance['leave_balance'] = $setLeaveMainBalance;
    $fieldBalance['leave_pending_balance'] = $setLeavePendingBalance;
    qu("employee_leave_balance", $fieldBalance, " employee_id = '{$getHoursData["emp_id"]}' ");

    $old_fields_data = qs("SELECT emp_id,company_id,from_date,to_date,reason,status,employee_notes,manager_notes FROM tb_timeoff WHERE id = '{$timeOffId}'");
    $field['employee_notes'] = $comment;
    $field['status'] = $status;
    $field['isEdited'] = 1;
    $condition = 'id=' . $timeOffId;
    qu('tb_timeoff', _escapeArray($field), $condition);

    $notifyField = array();
    $adminId = 0;
    if ($old_fields_data["company_id"] > 0) {
        $adminId = employeeDetail::getAdminIdFromCopmanyId($old_fields_data["company_id"]);
    }
    $notifyField['emp_id'] = $adminId;
    $notifyField['company_id'] = $old_fields_data['company_id'];
    $notifyField['type_add_edit'] = 'edit';
    $notifyField['module_name'] = 'timeoff';
    $notifyField['module_rec_id'] = $timeOffId;
    $empData = employeeDetail::GetEmployeeNameAndEmail($old_fields_data['emp_id']);
    // $notifyField['display_text'] = 'Timeoff request for ' . $empData['full_name'] . ' has been ' . strtolower($status) . 'ed by ' . $loggedInUserName;
    $displayText = '<div style="text-align: left;">';
    $notifyField['display_text'] = $displayText .= $empData['full_name'] . " requested a cancel for timeoff request </div>";
    $notifyField['add_edit_by_userid'] = $old_fields_data['emp_id'];
    qi('tb_notifications', _escapeArray($notifyField));

    unset($update_fields);
    $update_fields = qs("SELECT * FROM tb_timeoff WHERE id = '{$timeOffId}'");
    unset($update_fields["id"]);
    unset($update_fields["created_at"]);
    unset($update_fields["modified_at"]);
    unset($update_fields["isEdited"]);
    unset($update_fields["add_by_manager"]);
    unset($update_fields["added_by_id"]);
    unset($update_fields["unique_id"]);
    unset($update_fields["processed_leave_date"]);
    unset($update_fields["processed_leave_status"]);

    # Unique id
    $companyDetail = qs("SELECT * FROM `tb_company_works` where id='{$update_fields['company_id']}'");

    $unique_id = array();
    $unique_id[] = str_replace(" ", "_", $companyDetail['name']);
    $unique_id[] = str_replace(" ", "_", $empData['full_name']);
    $unique_id[] = strtotime($update_fields['from_date']);
    $unique_id[] = clearNumber(substr($update_fields['reason'], 0, 10));
    $unique_id[] = substr(md5(microtime()), rand(0, 26), 5);
    $unique_id = array_filter($unique_id);
    $unique_id = implode("_", $unique_id);
    $update_fields['unique_id'] = $unique_id;

    $update_fields['edit_id'] = $timeOffId;
    $update_fields['edited_by_user_type'] = 'employee';
    $update_fields['edited_by_id'] = $old_fields_data['emp_id'];
    $update_fields['edited_field_text'] = json_encode($old_fields_data);
    qi('tb_timeoff_edit_history', _escapeArray($update_fields));

    unset($fieldsComment);
    $fieldsComment['timeoff_id'] = $timeOffId;
    $fieldsComment['user_type'] = 'employee';
    $fieldsComment['comment_text'] = $comment;
    qi("tb_timeoff_comments", $fieldsComment);

    $responseArr = array();
    $responseArr['success'] = '1';
    $responseArr['msg'] = 'DELETED SUCCESSFULLY';
} else {
    $responseArr = array();
    $responseArr['success'] = '0';
    $responseArr['msg'] = 'TIMEOFF ID NOT AVAILABLE';
}

echo _api_response($responseArr);
die;
?>