<?php

$persianDate = new persian_date();
$persianNumbers = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
$loggedInUserName = $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'];

/* Add the hour balance just for the testing please remove after code will be live  */
/*
  $getEmployeeListFromTimeOff = q("SELECT DISTINCT(emp_id) FROM tb_timeoff WHERE emp_id > 0 ORDER BY emp_id ASC");
  foreach ($getEmployeeListFromTimeOff as $eachRec):
  $checkEmpAvailable = qs("SELECT id FROM employee_leave_balance WHERE employee_id = '{$eachRec['emp_id']}'");
  if (empty($checkEmpAvailable)) {
  unset($fields);
  $fields['employee_id'] = $eachRec['emp_id'];
  $fields['leave_balance'] = '5000';
  $fields['leave_pending_balance'] = '0';
  qi("employee_leave_balance", $fields);
  }
  endforeach;
 */
/* * * End the code ** */


if (isset($_REQUEST['requestAdd']) && $_REQUEST['requestAdd'] == 1) {

    if ($_POST['add_absence_type'] == 'hourly') {
        $fromDate = date('Y-m-d H:i:s', strtotime(trim($_POST['add_leave_date']) . " " . trim($_POST['add_start_date'])));
        $toDate = date('Y-m-d H:i:s', strtotime(trim($_POST['add_leave_date']) . " " . trim($_POST['add_end_date'])));
    } else {
        $fromDate = date('Y-m-d H:i:s', strtotime(trim($_POST['add_start_date'])));
        $toDate = date('Y-m-d H:i:s', strtotime(trim($_POST['add_end_date'])));
    }
    $absentReason = trim($_POST['add_absent_choice']);
    $managerNotes = trim($_POST['managerNewComment']);
    $absence_type = $_POST['add_absence_type'];
    $fields = array();
    $date1 = date_create($fromDate);
    $date2 = date_create($toDate);
    $diff = date_diff($date1, $date2);

    if ($_POST['add_absence_type'] == 'hourly' && $diff->invert == 1) {
        $nextDay = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($toDate)));
        $toDate = $nextDay; 
        $nextDate = date_create($nextDay);
        $diff = date_diff($date1, $nextDate); 
    } 

    $emp_id = trim($_POST['add_emp_id']);
    $leaveType = $absentReason;
    $empWorkingHours = employeeDetail::GetEmployeePerDayWorkingHours($emp_id, $leaveType);
    $total_days_applied = 0;
    if ($_POST['add_absence_type'] == 'entireDay') {
        $leave = 0;
        for ($i = 0; $i < $diff->days + 1; $i++) {
            $sdate = date("Y-m-d", strtotime("+" . $i . " Days", strtotime($fromDate)));
            $checkLeave = qs("select * from timesheet_leave where leave_date='{$sdate}' ");
            if (!empty($checkLeave)) {
                $leave++;
            }
        }
        $total_days = ($diff->days + 1);
        $total_days = ($total_days - $leave);
        $total_days_applied = $total_days;
        $total_days = ($total_days * $empWorkingHours);
    } else if ($_POST['add_absence_type'] == 'hourly') {
        $total_days = ($diff->i + ($diff->h * 60));
    }

    //$unique_id = array();
    //$unique_id[] = str_replace(" ", "_", $_SESSION['company']['name']);
    //$unique_id[] = str_replace(" ", "_", $_SESSION['user']['fname'] . "_" . $_SESSION['user']['lname']);
    //$unique_id[] = strtotime($fromDate);
    //$unique_id[] = clearNumber(substr($absentReason, 0, 10));
    //$unique_id[] = substr(md5(microtime()), rand(0, 26), 5);
    //$unique_id = array_filter($unique_id);
    //$unique_id = implode("_", $unique_id);
    //$fields['unique_id'] = $unique_id;
    $unique_id = getTimeOffDisplayId(); 
    $fields['unique_id'] = $unique_id;
    $fields['company_id'] = $_SESSION['company']['id'];
    $fields['emp_id'] = $_POST['add_emp_id'];
    $fields['total_days'] = $total_days;
    $fields['total_days_applied'] = $total_days_applied;
    $fields['from_date'] = $fromDate;
    $fields['to_date'] = $toDate;
    $fields['reason'] = $absentReason;
    $fields['manager_notes'] = $managerNotes;
    $fields['status'] = "Accept";
    $fields['subject'] = $_POST['add_subject'];
    $fields['absence_type'] = $absence_type;
    $fields['add_by_manager'] = 1;
    $fields['added_by_id'] = $_SESSION['user']['id'];
    // d($fields);
    $id = qi("tb_timeoff", _escapeArray($fields));
    $employee = qs("select * from tb_employee where id='{$_POST['add_emp_id']}'");
    $display_name = $employee["fname"] . " " . $employee["lname"];
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
    $notifyField = array();
    $notifyField['emp_id'] = $_SESSION['user']['id'];
    $notifyField['company_id'] = $_SESSION['company']['id'];
    $notifyField['type_add_edit'] = 'add';
    $notifyField['module_name'] = 'timeoff';
    $notifyField['module_rec_id'] = $id;
    //$notifyField['display_text'] = $employee["fname"] . " " . $employee["lname"] . ' want to new timeoff request at ' . date("M d,Y", strtotime($fromDate));
    $notifyField['display_text'] = '<div><div style="float:left;width:auto;height:1px;">' . $display_name . ' want to new timeoff request at, </div><div style="float:left;margin-left:6px;"><div style="float:left;">' . $persianMonthName . '</div><div style="float:right;margin-left:6px;">' . $persianNoDate . '</div><div class="clearfix"></div></div><div class="clearfix"></div></div>';
    $notifyField['add_edit_by_userid'] = $_POST['add_emp_id'];
    qi('tb_notifications', _escapeArray($notifyField));

    /* Start Notification for employee */
    $notifyField = array();
    $notifyField['emp_id'] = $_POST['add_emp_id'];
    $notifyField['company_id'] = $_SESSION['company']['id'];
    $notifyField['type_add_edit'] = 'add';
    $notifyField['module_name'] = 'timeoff';
    $notifyField['module_rec_id'] = $id;
    //$notifyField['display_text'] = $employee["fname"] . " " . $employee["lname"] . ' want to new timeoff request at ' . date("M d,Y", strtotime($fromDate));
    $notifyField['display_text'] = '<div><div style="float:left;width:auto;height:1px;">Admin added new timeoff request at, </div><div style="float:left;margin-left:6px;"><div style="float:left;">' . $persianMonthName . '</div><div style="float:right;margin-left:6px;">' . $persianNoDate . '</div><div class="clearfix"></div></div><div class="clearfix"></div></div>';
    $notifyField['add_edit_by_userid'] = $_SESSION['user']['id'];
    qi('tb_notifications', _escapeArray($notifyField));
    /* End Notification for employee */


    unset($fieldsComment);
    $fieldsComment['timeoff_id'] = $id;
    $fieldsComment['user_type'] = 'manager';
    $fieldsComment['comment_text'] = $managerNotes;
    qi("tb_timeoff_comments", $fieldsComment);

    $getBalance = qs("SELECT * FROM employee_leave_balance WHERE employee_id = '{$_POST['add_emp_id']}'");
    $fieldsBalance["leave_pending_balance"] = ($getBalance["leave_pending_balance"] + $total_days);
    $fieldsBalance["leave_balance"] = ($getBalance["leave_balance"] - $total_days);
    qu("employee_leave_balance", $fieldsBalance, " employee_id = '{$_POST['add_emp_id']}' ");
}

if (isset($_REQUEST['getHistoryRecord']) && $_REQUEST['getHistoryRecord'] == 1) {
    $getMainRecord = qs("SELECT * FROM tb_timeoff WHERE id = '{$_REQUEST["recordId"]}'");
    $changedText = '';
    if ($getMainRecord["add_by_manager"] == 1 && $getMainRecord["added_by_id"] > 0) {
        $employeeInfo = employeeDetail::GetEmployeeNameAndEmail($getMainRecord["added_by_id"]);
    } else {
        $employeeInfo = employeeDetail::GetEmployeeNameAndEmail($getMainRecord["emp_id"]);
    }

    if (!empty($getMainRecord)) {
        $changedText .= '<div class="alert alert-warning alert-margin-bottom">Time off request <b>' . $getMainRecord["unique_id"] . '</b> submitted on <b>' . date('F d Y, h:i A', strtotime($getMainRecord["created_at"])) . '</b> by <b>' . $employeeInfo["full_name"] . '</b></div>';
    }

    $getChangesList = q("Select * FROM tb_timeoff_edit_history WHERE edit_id = '{$_REQUEST["recordId"]}'");
    if (empty($getChangesList)) {
        
    } else {
        foreach ($getChangesList as $eachChangeData):
            $decodeOldData = json_decode($eachChangeData['edited_field_text'], true);

            $changedText .= '<div class="alert alert-warning alert-margin-bottom">';
            $editedByUserInfo = array();
            $editedByUserInfo = employeeDetail::GetEmployeeNameAndEmail($eachChangeData["edited_by_id"]);
            $changedText .= 'Time off request <b>' . $eachChangeData["unique_id"] . '</b> Edited on <b>' . date('F d Y, h:i A', strtotime($eachChangeData["created_at"])) . '</b> by <b>' . $editedByUserInfo["full_name"] . '</b>';
            $changedText .= '<div>&nbsp;</div>';
            if ($eachChangeData['from_date'] != $decodeOldData['from_date']) {
                $changedText .= '<div><b>Old From Date:</b> ' . $decodeOldData['from_date'] . '</div>';
                $changedText .= '<div><b>New From Date:</b> ' . $eachChangeData['from_date'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if ($eachChangeData['to_date'] != $decodeOldData['to_date']) {
                $changedText .= '<div><b>Old To Date:</b> ' . $decodeOldData['to_date'] . '</div>';
                $changedText .= '<div><b>New To Date:</b> ' . $eachChangeData['to_date'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if ($eachChangeData['reason'] != $decodeOldData['reason']) {
                $changedText .= '<div><b>Old Reason:</b> ' . $decodeOldData['reason'] . '</div>';
                $changedText .= '<div><b>New Reason:</b> ' . $eachChangeData['reason'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if ($eachChangeData['status'] != $decodeOldData['status']) {
                $changedText .= '<div><b>Old Status:</b> ' . (($decodeOldData['status'] != '') ? $decodeOldData['status'] : "New") . '</div>';
                $changedText .= '<div><b>New Status:</b> ' . $eachChangeData['status'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if ($eachChangeData['employee_notes'] != '' && $decodeOldData['employee_notes'] != '') {
                if ($eachChangeData['employee_notes'] != $decodeOldData['employee_notes']) {
                    $changedText .= '<div><b>Old Employee Note:</b> ' . $decodeOldData['employee_notes'] . '</div>';
                    $changedText .= '<div><b>New Employee Note:</b> ' . $eachChangeData['employee_notes'] . '</div>';
                    $changedText .= '<div>&nbsp;</div>';
                }
            }

            if ($eachChangeData['manager_notes'] != $decodeOldData['manager_notes']) {
                $changedText .= '<div><b>Old Manager Note:</b> ' . $decodeOldData['manager_notes'] . '</div>';
                $changedText .= '<div><b>New Manager Note:</b> ' . $eachChangeData['manager_notes'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }
            $changedText .= '</div>';
        endforeach;
    }
    echo $changedText;
    die;
}

if (isset($_REQUEST['requestEdit']) && $_REQUEST['requestEdit'] == 1) {
    unset($fields);
    $recordId = trim($_REQUEST['editRecordId']);
    $getOldDetail = qs("SELECT * FROM tb_timeoff WHERE id = '{$recordId}'");
    if ($getOldDetail['absence_type'] == 'hourly') {
        $fromDate = date('Y-m-d H:i:s', strtotime(trim($_POST['edit_leave_date']) . " " . trim($_POST['edit_start_date'])));
        $toDate = date('Y-m-d H:i:s', strtotime(trim($_POST['edit_leave_date']) . " " . trim($_POST['edit_end_date'])));
    } else {
        $fromDate = date('Y-m-d H:i:s', strtotime(trim($_POST['edit_start_date'])));
        $toDate = date('Y-m-d H:i:s', strtotime(trim($_POST['edit_end_date'])));
    }

    $absentReason = trim($_REQUEST['edit_absent_choice']);
    $managerNotes = trim($_REQUEST['commnet']);
    $absence_type = $getOldDetail['absence_type'];
    $date1 = date_create($fromDate);
    $date2 = date_create($toDate);
    $diff = date_diff($date1, $date2);
    if ($getOldDetail['absence_type'] == 'hourly' && $diff->invert == 1) {
        $nextDay = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($toDate)));
        $toDate = $nextDay;
        $nextDate = date_create($nextDay);
        $diff = date_diff($date1, $nextDate);
    }
    $emp_id = $getOldDetail["emp_id"];
    $leaveTypeOld = $getOldDetail['reason'];
    $leaveTypeNew = $absentReason;
    $empWorkingHoursOld = employeeDetail::GetEmployeePerDayWorkingHours($emp_id, $leaveTypeOld);
    $empWorkingHoursNew = employeeDetail::GetEmployeePerDayWorkingHours($emp_id, $leaveTypeNew);
    $total_days_applied = 0;
    if ($getOldDetail['absence_type'] == 'entireDay') {
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
        $fields['total_days'] = ($total_days * $empWorkingHoursNew);
    } else if ($getOldDetail['absence_type'] == 'hourly') {
        $total_minutes_new = ($diff->i + ($diff->h * 60));
        $fields['total_days'] = $total_minutes_new;
    }

    $fields['total_days_applied'] = $total_days_applied;
    $old_fields_data = qs("SELECT emp_id,company_id,from_date,to_date,reason,status,employee_notes,manager_notes FROM tb_timeoff WHERE id = '{$recordId}'");
    $fields['from_date'] = $fromDate;
    $fields['to_date'] = $toDate;
    $fields['reason'] = $absentReason;
    $fields['manager_notes'] = $managerNotes;
    $fields['isEdited'] = 1;

    $fields['status'] = "Accept";
    qu("tb_timeoff", $fields, "id='{$recordId}'");
    $employee = qs("select * from tb_employee where id='{$old_fields_data['emp_id']}'");

    $displayText = '<div style="text-align: left;">';
    $displayText .= $employee["fname"] . " " . $employee["lname"] . " requested a change to time off request </div>";

//    $displayText = "";
//    $displayText .= $employee["fname"] . " " . $employee["lname"] . " requested a change to time off request ";
    $editAvailable = 0;
    if ($getOldDetail["reason"] != $absentReason) {
        $displayText .= "<div style='text-align: left;'> absence type = " . $absentReason . "</div>";
        $editAvailable = 1;
    }

    if ($getOldDetail['absence_type'] != 'hourly') {
        if (date('Y-m-d', strtotime($getOldDetail["from_date"])) != date('Y-m-d', strtotime($fromDate))) {
            $displayText .= '<div><div style="float:left;width:auto;height:1px;">';
            if ($editAvailable == 1) {
                $displayText .= ' and&nbsp; ';
            }
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
            $displayText .= ' start date =  </div>'
                    . '<div style="float:left;margin-left:6px;">'
                    . '<div style="float:left;">' . $persianMonthName . '</div>'
                    . '<div style="float:right;margin-left:6px;">' . $persianNoDate . '</div>'
                    . '<div class="clearfix"></div>'
                    . '</div>'
                    . '<div class="clearfix"></div>'
                    . '</div>';
            //    $displayText .= " = " . date('M d,Y', strtotime($fromDate));
            $editAvailable = 1;
        }
        if (date('Y-m-d', strtotime($getOldDetail["to_date"])) != date('Y-m-d', strtotime($toDate))) {
            $displayText .= '<div><div style="float:left;width:auto;height:1px;">';
            if ($editAvailable == 1) {
                $displayText .= ' and&nbsp; ';
            }
            $persianMonthName = '';
            $persianDayName = '';
            $persianMonthName = $persianDate->to_date($toDate, 'M');
            $persianDayName = $persianDate->to_date($toDate, 'd');
            $persianNoDate = '';
            $persianNumbers1 = substr($persianDayName, 0, 1);
            $persianNumbers2 = substr($persianDayName, 1, 1);
            if ($persianNumbers1 != '') {
                $persianNoDate .= $persianNumbers[$persianNumbers1];
            }
            if ($persianNumbers2 != '') {
                $persianNoDate .= $persianNumbers[$persianNumbers2];
            }
            $displayText .= ' end date = </div>'
                    . '<div style="float:left;margin-left:6px;">'
                    . '<div style="float:left;">' . $persianMonthName . '</div>'
                    . '<div style="float:right;margin-left:6px;">' . $persianNoDate . '</div>'
                    . '<div class="clearfix"></div>'
                    . '</div>'
                    . '<div class="clearfix"></div>'
                    . '</div>';
            //    $displayText .= " end date = " . date('M d,Y', strtotime($toDate));
            $editAvailable = 1;
        }
    } else {
        if (date('Y-m-d', strtotime($getOldDetail["from_date"])) != date('Y-m-d', strtotime($fromDate))) {
            $displayText .= '<div><div style="float:left;width:auto;height:1px;">';
            if ($editAvailable == 1) {
                $displayText .= ' and&nbsp; ';
            }
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
            $displayText .= ' leave date = </div>'
                    . '<div style="float:left;margin-left:6px;">'
                    . '<div style="float:left;">' . $persianMonthName . '</div>'
                    . '<div style="float:right;margin-left:6px;">' . $persianNoDate . '</div>'
                    . '<div class="clearfix"></div>'
                    . '</div>'
                    . '<div class="clearfix"></div>'
                    . '</div>';
//  $displayText .= " leave date = " . date('M d,Y', strtotime($fromDate));
            $editAvailable = 1;
        }

        $displayText .= '<div style="text-align:left;">';
        if (date('H:i:s', strtotime($getOldDetail["from_date"])) != date('H:i:s', strtotime($fromDate))) {

            if ($editAvailable == 1) {
                $displayText .= ' and ';
            }
            $startTimeEnglish = date('H:i', strtotime($fromDate));
            $startTimeEnglishArr = explode(":", $startTimeEnglish);
            $persianHours1 = '';
            $persianHours2 = '';
            $persianMinutes1 = '';
            $persianMinutes2 = '';
            $persianHours1 = substr($startTimeEnglishArr[0], 0, 1);
            $persianHours2 = substr($startTimeEnglishArr[0], 1, 1);
            $persianMinutes1 = substr($startTimeEnglishArr[1], 0, 1);
            $persianMinutes2 = substr($startTimeEnglishArr[1], 1, 1);
            $displayStartTime = '';
            if ($persianHours1 != '') {
                $displayStartTime .= $persianNumbers[$persianHours1];
            }
            if ($persianHours2 != '') {
                $displayStartTime .= $persianNumbers[$persianHours2];
            }
            if ($displayStartTime != '') {
                $displayStartTime .= ":";
            }
            if ($persianMinutes1 != '') {
                $displayStartTime .= $persianNumbers[$persianMinutes1];
            }
            if ($persianMinutes2 != '') {
                $displayStartTime .= $persianNumbers[$persianMinutes2];
            }

            $displayText .= ' start time = ' . $displayStartTime;
            //$displayText .= " start time = " . date('H:i:s', strtotime($fromDate)); 
            $editAvailable = 1;
        }

        if (date('H:i:s', strtotime($getOldDetail["to_date"])) != date('H:i:s', strtotime($toDate))) {

            if ($editAvailable == 1) {
                $displayText .= ' and ';
            }

            $endTimeEnglish = date('H:i', strtotime($toDate));
            $startTimeEnglishArr = explode(":", $endTimeEnglish);
            $persianHours1 = '';
            $persianHours2 = '';
            $persianMinutes1 = '';
            $persianMinutes2 = '';
            $persianHours1 = substr($startTimeEnglishArr[0], 0, 1);
            $persianHours2 = substr($startTimeEnglishArr[0], 1, 1);
            $persianMinutes1 = substr($startTimeEnglishArr[1], 0, 1);
            $persianMinutes2 = substr($startTimeEnglishArr[1], 1, 1);
            $displayEndTime = '';
            if ($persianHours1 != '') {
                $displayEndTime .= $persianNumbers[$persianHours1];
            }
            if ($persianHours2 != '') {
                $displayEndTime .= $persianNumbers[$persianHours2];
            }
            if ($displayStartTime != '') {
                $displayEndTime .= ":";
            }
            if ($persianMinutes1 != '') {
                $displayEndTime .= $persianNumbers[$persianMinutes1];
            }
            if ($persianMinutes2 != '') {
                $displayEndTime .= $persianNumbers[$persianMinutes2];
            }
            $displayText .= ' end time =  ' . $displayEndTime;
            $editAvailable = 1;
        }
        $displayText .= '</div>';
    }



    $notifyField = array();
    $notifyField['emp_id'] = $_SESSION['user']['id'];
    $notifyField['company_id'] = $old_fields_data['company_id'];
    $notifyField['type_add_edit'] = 'edit';
    $notifyField['module_name'] = 'timeoff';
    $notifyField['module_rec_id'] = $recordId;
    $notifyField['display_text'] = $displayText;
    $notifyField['add_edit_by_userid'] = $old_fields_data['emp_id'];
    qi('tb_notifications', _escapeArray($notifyField));
//$notifyField['display_text'] = 'Timeoff request has been updated by ' . $loggedInUserName;

    /* Start Notification for employee */
    $notifyField = array();
    $notifyField['emp_id'] = $old_fields_data['emp_id'];
    $notifyField['company_id'] = $old_fields_data['company_id'];
    $notifyField['type_add_edit'] = 'edit';
    $notifyField['module_name'] = 'timeoff';
    $notifyField['module_rec_id'] = $recordId;
    $notifyField['display_text'] = $displayText;
    $notifyField['add_edit_by_userid'] = $_SESSION['user']['id'];
    qi('tb_notifications', _escapeArray($notifyField));
    /* End Notification for employee */

    unset($update_fields);
    $update_fields = qs("SELECT * FROM tb_timeoff WHERE id = '{$recordId}'");
    unset($update_fields["id"]);
    unset($update_fields["created_at"]);
    unset($update_fields["modified_at"]);
    unset($update_fields["isEdited"]);
    unset($update_fields["add_by_manager"]);
    unset($update_fields["added_by_id"]);
    //unset($update_fields["unique_id"]);
    unset($update_fields["processed_leave_date"]);
    unset($update_fields["processed_leave_status"]); 

    # Unique id
    $companyDetail = qs("SELECT * FROM `tb_company_works` where id='{$update_fields['company_id']}'");

    //$unique_id = array();
    //$unique_id[] = str_replace(" ", "_", $companyDetail['name']);
    //$unique_id[] = str_replace(" ", "_", $_SESSION['user']['fname'] . "_" . $_SESSION['user']['lname']);
    //$unique_id[] = strtotime($update_fields['from_date']);
    //$unique_id[] = clearNumber(substr($update_fields['reason'], 0, 10));
    //$unique_id[] = substr(md5(microtime()), rand(0, 26), 5);
    //$unique_id = array_filter($unique_id);
    //$unique_id = implode("_", $unique_id);
    //$update_fields['unique_id'] = $unique_id;

    $update_fields['edit_id'] = $recordId;
    $update_fields['edited_by_user_type'] = 'manager';
    $update_fields['edited_by_id'] = $_SESSION['user']['id'];
    $update_fields['edited_field_text'] = json_encode($old_fields_data);
    qi('tb_timeoff_edit_history', _escapeArray($update_fields));


    unset($fieldsComment);
    $fieldsComment['timeoff_id'] = $recordId;
    $fieldsComment['user_type'] = 'manager';
    $fieldsComment['comment_text'] = $managerNotes;
    qi("tb_timeoff_comments", $fieldsComment);

    $dateStart = date_create($getOldDetail["from_date"]);
    $dateEnd = date_create($getOldDetail["to_date"]);
    $diffOld = date_diff($dateStart, $dateEnd);

    if ($getOldDetail['absence_type'] == 'hourly' && $diffOld->invert == 1) {
        $nextDay = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($getOldDetail["to_date"]))); 
        $nextDate = date_create($nextDay);
        $diffOld = date_diff($dateStart, $nextDate); 
    }
    $totalOldMinutes = 0;
    $totalNewMinutes = 0;

    if ($getOldDetail['absence_type'] == 'entireDay') {

        $total_days_old = ($diffOld->days + 1);
        $totalOldMinutes = ($total_days_old * $empWorkingHoursOld);
        $totalNewMinutes = ($total_days * $empWorkingHoursNew);
    } else if ($getOldDetail['absence_type'] == 'hourly') {
        $totalOldMinutes = ($diffOld->i + ($diffOld->h * 60));
        $totalNewMinutes = $total_minutes_new;
    }

    $getBalanceDetail = qs("SELECT * FROM employee_leave_balance WHERE employee_id = '{$getOldDetail["emp_id"]}'");

    $oldPendingBalance = $getBalanceDetail["leave_pending_balance"];
    $oldMainBalance = $getBalanceDetail["leave_balance"];
    if ($getOldDetail['status'] == 'Accept' || $getOldDetail['status'] == '') {

        $oldPendingRemove = ($oldPendingBalance - $totalOldMinutes);
        $setNewPendingBalance = ($oldPendingRemove + $totalNewMinutes);

        $oldMainRmove = ($oldMainBalance + $totalOldMinutes);
        $setNewMainBalance = ($oldMainRmove - $totalNewMinutes);


        $fieldsBalance["leave_pending_balance"] = $setNewPendingBalance;
        $fieldsBalance["leave_balance"] = $setNewMainBalance;

        qu("employee_leave_balance", $fieldsBalance, " employee_id = '{$getOldDetail["emp_id"]}' ");
    }
}

if (isset($_REQUEST['getRecordData']) && $_REQUEST['getRecordData'] == 1) {
    $editId = trim($_REQUEST['editId']);
    $detail = qs("SELECT * FROM tb_timeoff WHERE id = '{$editId}'");
    if ($detail['absence_type'] == 'hourly') {
        $detail['leave_date'] = date("Y-m-d", strtotime($detail['from_date']));
        $detail['from_date'] = date("H:i:s", strtotime($detail['from_date']));
        $detail['to_date'] = date("H:i:s", strtotime($detail['to_date']));
    } else {
        $detail['from_date'] = date("Y-m-d", strtotime($detail['from_date']));
        $detail['to_date'] = date("Y-m-d", strtotime($detail['to_date']));
    }
    $detail['available_hours'] = '00:00';
    $detail['pending_hours'] = '00:00';
    $detail['proceed_hours'] = '00:00';
    $getTimeDetail = qs("SELECT * FROM employee_leave_balance WHERE employee_id = '{$detail["emp_id"]}'");

    if (!empty($getTimeDetail)) {
        $detail['available_hours'] = convertMinutesToHourMinuteFormat($getTimeDetail['leave_balance']);
        $detail['pending_hours'] = convertMinutesToHourMinuteFormat($getTimeDetail['leave_pending_balance']);
        $detail['proceed_hours'] = convertMinutesToHourMinuteFormat($getTimeDetail['proceed_leave']);
    }

    $previousRecords = '';
    $detailPrev = q("SELECT * FROM tb_timeoff WHERE emp_id = '{$detail["emp_id"]}' ORDER BY id DESC LIMIT 1,3");

    foreach ($detailPrev as $eachPreviousRec) {
        $statusVal = $eachPreviousRec['status'];
        $displayStatusVal = '';
        if ($statusVal == '' || strtolower($statusVal) == 'new_request') {
            $displayStatusVal = "pending";
        } else if (strtolower($statusVal) == 'cancel') {
            $displayStatusVal = "canceled";
        } else if (strtolower($statusVal) == 'reject') {
            $displayStatusVal = "rejected";
        } else if (strtolower($statusVal) == 'accept') {
            $displayStatusVal = "accepted";
        } else if (strtolower($statusVal) == 'delete') {
            $displayStatusVal = "deleted";
        }

        $editedByName = '';
        $detailEditRec = qs("SELECT * FROM tb_timeoff_edit_history WHERE edit_id = '{$eachPreviousRec["id"]}' ORDER BY id DESC LIMIT 0,1");
        if (!empty($detailEditRec)) {
            $empDetail = employeeDetail::GetEmployeeNameAndEmail($detailEditRec['edited_by_id']);
            $editedByName = ' by ' . $detailEditRec['edited_by_user_type'] . " " . $empDetail['full_name'];
        }


        $dateStartDetail = date_create($eachPreviousRec["from_date"]);
        $dateEndDetail = date_create($eachPreviousRec["to_date"]);
        $diffDate = date_diff($dateStartDetail, $dateEndDetail);

        if ($eachPreviousRec['absence_type'] == 'hourly' && $diffDate->invert == 1) {
            $nextDay = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($eachPreviousRec["to_date"])));
             
            $nextDate = date_create($nextDay);
            $diffDate = date_diff($dateStartDetail, $nextDate);
        }

        $emp_id = $detail["emp_id"];
        $leaveType = $detail["reason"];
        $empWorkingHours = employeeDetail::GetEmployeePerDayWorkingHours($emp_id, $leaveType);

        if ($eachPreviousRec["absence_type"] == 'entireDay') {
            $totalDisplayMinutes = (($diffDate->days + 1) * $empWorkingHours);
        } else if ($eachPreviousRec["absence_type"] == 'hourly') {
            $totalDisplayMinutes = ($diffDate->i + ($diffDate->h * 60));
        }

        $previousRecords .= '<div>' . date('F d', strtotime($eachPreviousRec['from_date'])) . ' ' . $eachPreviousRec['reason'] . ' <b>' . convertMinutesToHourMinuteFormat($totalDisplayMinutes) . ' hours</b> ' . $displayStatusVal . $editedByName . '</div>';
    }

    if ($previousRecords != '') {
        $detail['previousRecords'] = $previousRecords;
    } else {
        $detail['previousRecords'] = "Previous record is not available";
    }

    json_die(1, $detail);
    die;
}

if ($_POST['requestResult'] == 1) {

    $getHoursData = qs("SELECT * FROM tb_timeoff WHERE id = '{$_REQUEST['requestId']}'");
    $totalLeaveMinutes = 0;

    $emp_id = $getHoursData["emp_id"];
    $leaveType = $getHoursData["reason"];
    $empWorkingHours = employeeDetail::GetEmployeePerDayWorkingHours($emp_id, $leaveType);

    $fromDate = $getHoursData["from_date"];
    $toDate = $getHoursData["to_date"];
    $date1 = date_create($fromDate);
    $date2 = date_create($toDate);
    $diffMin = date_diff($date1, $date2);
    
    if ($getHoursData['absence_type'] == 'hourly' && $diffMin->invert == 1) {
        $nextDay = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($getHoursData["to_date"])));
       
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
    if (trim($_POST['reason']) == "Accept") {
        
    } else if (trim($_POST['reason']) == "Reject" || trim($_POST['reason']) == "Cancel" || trim(strtolower($_POST['reason'])) == "delete") {
        $setLeaveMainBalance = ($setLeaveMainBalance + $totalLeaveMinutes);
        $setLeavePendingBalance = ($setLeavePendingBalance - $totalLeaveMinutes);
    }

    unset($fieldBalance);
    $fieldBalance['leave_balance'] = $setLeaveMainBalance;
    $fieldBalance['leave_pending_balance'] = $setLeavePendingBalance;
    qu("employee_leave_balance", $fieldBalance, " employee_id = '{$getHoursData["emp_id"]}' ");

    $old_fields_data = qs("SELECT emp_id,company_id,from_date,to_date,reason,status,employee_notes,manager_notes FROM tb_timeoff WHERE id = '{$_POST['requestId']}'");


    $field['manager_notes'] = $_POST['commnet'];
    $field['status'] = $_POST['reason'];
    $field['isEdited'] = 1;
    $condition = 'id=' . $_POST['requestId'];
    qu('tb_timeoff', _escapeArray($field), $condition);

    $notifyField = array();
    $notifyField['emp_id'] = $_SESSION['user']['id'];
    //$old_fields_data['emp_id'];
    $notifyField['company_id'] = $old_fields_data['company_id'];
    $notifyField['type_add_edit'] = 'edit';
    $notifyField['module_name'] = 'timeoff';
    $notifyField['module_rec_id'] = $_POST['requestId'];
    //$notifyField['display_text'] = 'Timeoff request has been ' . strtolower($_POST['reason']) . 'ed by ' . $loggedInUserName;

    $empData = employeeDetail::GetEmployeeNameAndEmail($old_fields_data['emp_id']);
    $notifyField['display_text'] = 'Timeoff request for ' . $empData['full_name'] . ' has been ' . strtolower($_POST['reason']) . 'ed by ' . $loggedInUserName;
    $notifyField['add_edit_by_userid'] = $old_fields_data['emp_id'];
    //$_SESSION['user']['id'];
    qi('tb_notifications', _escapeArray($notifyField));

    /* Start Notification for employee */
    $notifyField = array();
    $notifyField['emp_id'] = $old_fields_data['emp_id'];
    $notifyField['company_id'] = $old_fields_data['company_id'];
    $notifyField['type_add_edit'] = 'edit';
    $notifyField['module_name'] = 'timeoff';
    $notifyField['module_rec_id'] = $_POST['requestId'];
    $empData = employeeDetail::GetEmployeeNameAndEmail($old_fields_data['emp_id']);
    //$notifyField['display_text'] = 'Timeoff request for ' . $empData['full_name'] . ' has been ' . strtolower($_POST['reason']) . 'ed by ' . $loggedInUserName;
    $notifyField['display_text'] = 'Your timeoff request has been ' . strtolower($_POST['reason']) . 'ed by ' . $loggedInUserName;
    $notifyField['add_edit_by_userid'] = $_SESSION['user']['id'];
    qi('tb_notifications', _escapeArray($notifyField));
    /* End Notification for employee */


    unset($update_fields);
    $update_fields = qs("SELECT * FROM tb_timeoff WHERE id = '{$_POST['requestId']}'");
    unset($update_fields["id"]);
    unset($update_fields["created_at"]);
    unset($update_fields["modified_at"]);
    unset($update_fields["isEdited"]);
    unset($update_fields["add_by_manager"]);
    unset($update_fields["added_by_id"]);
    //unset($update_fields["unique_id"]);
    unset($update_fields["processed_leave_date"]);
    unset($update_fields["processed_leave_status"]);

    # Unique id
    $companyDetail = qs("SELECT * FROM `tb_company_works` where id='{$update_fields['company_id']}'");

    //$unique_id = array();
    //$unique_id[] = str_replace(" ", "_", $companyDetail['name']);
    //$unique_id[] = str_replace(" ", "_", $_SESSION['user']['fname'] . "_" . $_SESSION['user']['lname']);
    //$unique_id[] = strtotime($update_fields['from_date']);
    //$unique_id[] = clearNumber(substr($update_fields['reason'], 0, 10));
    //$unique_id[] = substr(md5(microtime()), rand(0, 26), 5);
    //$unique_id = array_filter($unique_id);
    //$unique_id = implode("_", $unique_id);
    //$update_fields['unique_id'] = $unique_id;

    $update_fields['edit_id'] = $_POST['requestId'];
    $update_fields['edited_by_user_type'] = 'manager';
    $update_fields['edited_by_id'] = $_SESSION['user']['id'];
    $update_fields['edited_field_text'] = json_encode($old_fields_data);
    qi('tb_timeoff_edit_history', _escapeArray($update_fields));

    unset($fieldsComment);
    $fieldsComment['timeoff_id'] = $_POST['requestId'];
    $fieldsComment['user_type'] = 'manager';
    $fieldsComment['comment_text'] = $_POST['commnet'];
    qi("tb_timeoff_comments", $fieldsComment);
}


$isAdmin = 0;
$companyId = 0;
$teamId = $_SESSION['user']['team_id'];
$companyId = $_SESSION['user']['work_at'];
if (strtolower($_SESSION['user']['access_level']) == 'admin' || strtolower($_SESSION['user']['access_level']) == 'manager') {
    $isAdmin = 1;
}

$whereWithTeam = '';
$whereRelatedEmployee = '';
if ($teamId > 0 && $isAdmin == 0) {
    if (strtolower($_SESSION['user']['access_level']) == 'employee') {
        $whereWithTeam = ' AND emp_id IN (' . $_SESSION['user']['id'] . ')';
        $whereRelatedEmployee = ' AND id IN (' . $_SESSION['user']['id'] . ')';
    } else {
        $employeeIdsList = employee::getTeamEmployeesIds($companyId, $teamId);
        if (empty($employeeIdsList)) {
            $employeeIdsList[] = 0;
        }
        $employeeIdsListStr = implode(",", $employeeIdsList);
        $whereWithTeam = ' AND emp_id IN (' . $employeeIdsListStr . ')';
        $whereRelatedEmployee = ' AND id IN (' . $employeeIdsListStr . ')';
    }
}



$employee = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}' " . $whereRelatedEmployee);

$jsInclude = 'request_time_off.js.php';
_cg("page_title", "Request Time Off");     
?>