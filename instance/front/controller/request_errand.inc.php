<?php

//checkAccessLevel($_SESSION['user']['access_level'], 'errand', 'delete');
$loggedInUserName = $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'];
$persianDate = new persian_date();
$persianNumbers = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

if ($_POST['requestResult'] == '1') {
    $old_fields_data = qs("SELECT errands_type,
                                  absence_type,
                                  subject,
                                  from_date_time,
                                  to_date_time,
                                  day_request_submitted,
                                  requested_by,
                                  starting_point,
                                  destination,
                                  overnight_compensation,
                                  food_authorization,
                                  transportation_method,
                                  lodging,
                                  expences,
                                  manager_comments,
                                  total_days,
                                  status,
                                  employee_id,
                                  company_id 
                             FROM errands 
                            WHERE id = '{$_POST['requestId']}'");

    $field['manager_comments'] = $_POST['commnet'];
    $field['status'] = $_POST['reason'];
    $condition = 'id=' . $_POST['requestId'];
    qu('errands', _escapeArray($field), $condition);


    /* Start Notification entry code */
    /*
      Admin
      Manager
      Supervisor
     */
    $editId = '';
    $editId = $_POST['requestId'];
    $data = qs("select * from errands where id = '{$editId}' ");
    $errandData = $data;
    $oldData = $old_fields_data;

    $adminId = 0;
    if ($errandData["company_id"] > 0) {
        $adminId = employeeDetail::getAdminIdFromCopmanyId($errandData["company_id"]);
    }

    $employeeInfo = array();
    $display_name = '';
    if ($errandData['employee_id'] > 0) {
        $employeeInfo = employeeDetail::GetEmployeeNameAndEmail($errandData['employee_id']);
        $display_name = $employeeInfo['full_name'];
    }

    $displayText = '<div style="text-align: left;">';
    $displayText .= $display_name . " requested a change to errand request </div>";
    $editAvailable = 0;
    if ($oldData["subject"] != $errandData["subject"]) {
        $displayText .= "<div style='text-align: left;'> subject = " . $errandData["subject"] . "</div><div class='clearfix'></div>";
        $editAvailable = 1;
    }
    if ($oldData["from_date_time"] != $errandData["from_date_time"]) {
        $displayText .= '<div>';
        if ($editAvailable == 1) {
            $displayText .= '<div style="float:left;width:auto;height:1px;">  and&nbsp; </div>';
        }
        $persianMonthName = '';
        $persianDayName = '';
        $persianMonthName = $persianDate->to_date($errandData["from_date_time"], 'M');
        $persianDayName = $persianDate->to_date($errandData["from_date_time"], 'd');
        $persianNoDate = '';
        $persianNumbers1 = substr($persianDayName, 0, 1);
        $persianNumbers2 = substr($persianDayName, 1, 1);
        if ($persianNumbers1 != '') {
            $persianNoDate .= $persianNumbers[$persianNumbers1];
        }
        if ($persianNumbers2 != '') {
            $persianNoDate .= $persianNumbers[$persianNumbers2];
        }
        $displayText .= '<div style="float:left;width:auto;height:1px;"> start date = </div><div style="float:left;margin-left:6px;"><div style="float:left;">' . $persianMonthName . '</div><div style="float:right;margin-left:6px;">' . $persianNoDate . '</div><div class="clearfix"></div></div><div class="clearfix"></div></div>';
        //     $displayText .= " start date = " . date('M d,Y', strtotime($errandData["from_date_time"]));
        $editAvailable = 1;
    }
    if ($oldData["to_date_time"] != $errandData["to_date_time"]) {
        $displayText .= '<div>';
        if ($editAvailable == 1) {
            $displayText .= '<div style="float:left;width:auto;height:1px;">  and&nbsp; </div>';
        }
        $persianMonthName = '';
        $persianDayName = '';
        $persianMonthName = $persianDate->to_date($errandData["to_date_time"], 'M');
        $persianDayName = $persianDate->to_date($errandData["to_date_time"], 'd');
        $persianNoDate = '';
        $persianNumbers1 = substr($persianDayName, 0, 1);
        $persianNumbers2 = substr($persianDayName, 1, 1);
        if ($persianNumbers1 != '') {
            $persianNoDate .= $persianNumbers[$persianNumbers1];
        }
        if ($persianNumbers2 != '') {
            $persianNoDate .= $persianNumbers[$persianNumbers2];
        }
        $displayText .= '<div style="float:left;width:auto;height:1px;"> end date =  </div><div style="float:left;margin-left:6px;"><div style="float:left;">' . $persianMonthName . '</div><div style="float:right;margin-left:6px;">' . $persianNoDate . '</div><div class="clearfix"></div></div><div class="clearfix"></div></div>';
//         $displayText .= " end date = " . date('M d,Y', strtotime($errandData["to_date_time"]));
        $editAvailable = 1;
    }

    $notifyField = array();
    $notifyField['emp_id'] = $adminId;
    $notifyField['company_id'] = _e($errandData["company_id"], 0);
    $notifyField['type_add_edit'] = 'edit';
    $notifyField['module_name'] = 'errand';
    $notifyField['module_rec_id'] = $errandData['id'];
    $notifyField['display_text'] = $displayText;
    $notifyField['add_edit_by_userid'] = _e($errandData['employee_id'], 0);
    qi('tb_notifications', _escapeArray($notifyField));

    /* End Notification entry code */

    unset($update_fields);
    $update_fields = qs("SELECT * FROM errands WHERE id = '{$_POST['requestId']}'");
    unset($update_fields["id"]);
    unset($update_fields["created_at"]);
    unset($update_fields["modified_at"]);
    unset($update_fields["isEdited"]);
    unset($update_fields["add_by_manager"]);
    unset($update_fields["added_by_id"]);
    //unset($update_fields["unique_id"]);
    # Unique id
    $companyDetail = qs("SELECT * FROM `tb_company_works` where id='{$update_fields['company_id']}'");

    //$unique_id = array();
    //$unique_id[] = str_replace(" ", "_", $companyDetail['name']);
    //$unique_id[] = str_replace(" ", "_", $_SESSION['user']['fname'] . "_" . $_SESSION['user']['lname']);
    //$unique_id[] = strtotime($update_fields['from_date_time']);
    //$unique_id[] = $update_fields['errands_type'];
    //$unique_id[] = substr(md5(microtime()), rand(0, 26), 5);
    //$unique_id = array_filter($unique_id);
    //$unique_id = implode("_", $unique_id);
    //$update_fields['unique_id'] = $unique_id;

    $update_fields['edit_id'] = $_POST['requestId'];
    $update_fields['edited_by_user_type'] = 'manager';
    $update_fields['edited_by_id'] = $_SESSION['user']['id'];
    $update_fields['edited_field_text'] = json_encode($old_fields_data);
    qi('errands_edit_history', _escapeArray($update_fields));


    unset($fieldsComment);
    $fieldsComment['errand_id'] = $_POST['requestId'];
    $fieldsComment['user_type'] = 'manager';
    $fieldsComment['comment_text'] = $_POST['commnet'];
    qi("errands_comments", $fieldsComment);
}

if (isset($_REQUEST['getHistoryRecord']) && $_REQUEST['getHistoryRecord'] == 1) {
    $getMainRecord = qs("SELECT * FROM errands WHERE id = '{$_REQUEST["recordId"]}'");
    $changedText = '';

    if ($getMainRecord["add_by_manager"] == 1 && $getMainRecord["added_by_id"] > 0) {
        $employeeInfo = employeeDetail::GetEmployeeNameAndEmail($getMainRecord["added_by_id"]);
    } else {
        $employeeInfo = employeeDetail::GetEmployeeNameAndEmail($getMainRecord["employee_id"]);
    }

    if (!empty($getMainRecord)) {
        $changedText .= '<div class="alert alert-warning alert-margin-bottom">Errand request <b>' . $getMainRecord["unique_id"] . '</b> submitted on <b>' . date('F d Y, h:i A', strtotime($getMainRecord["created_at"])) . '</b> by <b>' . $employeeInfo["full_name"] . '</b></div>';
    }

    $getChangesList = q("Select * FROM errands_edit_history WHERE edit_id = '{$_REQUEST["recordId"]}'");
    if (empty($getChangesList)) {
        
    } else {
        foreach ($getChangesList as $eachChangeData):
            $decodeOldData = json_decode($eachChangeData['edited_field_text'], true);

            $changedText .= '<div class="alert alert-warning alert-margin-bottom">';
            $editedByUserInfo = array();
            $editedByUserInfo = employeeDetail::GetEmployeeNameAndEmail($eachChangeData["edited_by_id"]);
            $changedText .= 'Errand request <b>' . $eachChangeData["unique_id"] . '</b> Edited on <b>' . date('F d Y, h:i A', strtotime($eachChangeData["created_at"])) . '</b> by <b>' . $editedByUserInfo["full_name"] . '</b>';
            $changedText .= '<div>&nbsp;</div>';

            if ($eachChangeData['status'] != $decodeOldData['status']) {
                $changedText .= '<div><b>Old Status:</b> ' . (($decodeOldData['status'] != '') ? $decodeOldData['status'] : "New") . '</div>';
                $changedText .= '<div><b>New Status:</b> ' . $eachChangeData['status'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if ($eachChangeData['from_date_time'] != $decodeOldData['from_date_time']) {
                $changedText .= '<div><b>Old From Date & Time:</b> ' . $decodeOldData['from_date_time'] . '</div>';
                $changedText .= '<div><b>New From Date & Time:</b> ' . $eachChangeData['from_date_time'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if ($eachChangeData['to_date_time'] != $decodeOldData['to_date_time']) {
                $changedText .= '<div><b>Old To Date & Time:</b> ' . $decodeOldData['to_date_time'] . '</div>';
                $changedText .= '<div><b>New To Date & Time:</b> ' . $eachChangeData['to_date_time'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if ($eachChangeData['errands_type'] != $decodeOldData['errands_type']) {
                $changedText .= '<div><b>Old Type:</b> ' . $decodeOldData['errands_type'] . '</div>';
                $changedText .= '<div><b>New Type:</b> ' . $eachChangeData['errands_type'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if (isset($eachChangeData['absence_type']) && isset($decodeOldData['absence_type'])) {
                if (trim($eachChangeData['absence_type']) != '' && trim($decodeOldData['absence_type']) != '') {
                    if ($eachChangeData['absence_type'] != $decodeOldData['absence_type']) {
                        $changedText .= '<div><b>Old Absent Type:</b> ' . $decodeOldData['absence_type'] . '</div>';
                        $changedText .= '<div><b>New Absent Type:</b> ' . $eachChangeData['absence_type'] . '</div>';
                        $changedText .= '<div>&nbsp;</div>';
                    }
                }
            } 


            if ($eachChangeData['subject'] != $decodeOldData['subject']) {
                $changedText .= '<div><b>Old Subject:</b> ' . $decodeOldData['subject'] . '</div>';
                $changedText .= '<div><b>New Subject:</b> ' . $eachChangeData['subject'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if ($eachChangeData['day_request_submitted'] != $decodeOldData['day_request_submitted']) {
                $changedText .= '<div><b>Old Day Request:</b> ' . $decodeOldData['day_request_submitted'] . '</div>';
                $changedText .= '<div><b>New Day Request:</b> ' . $eachChangeData['day_request_submitted'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if ($eachChangeData['requested_by'] != $decodeOldData['requested_by']) {
                $changedText .= '<div><b>Old Request By:</b> ' . $decodeOldData['requested_by'] . '</div>';
                $changedText .= '<div><b>New Request By:</b> ' . $eachChangeData['requested_by'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if ($eachChangeData['starting_point'] != $decodeOldData['starting_point']) {
                $changedText .= '<div><b>Old Starting Point:</b> ' . $decodeOldData['starting_point'] . '</div>';
                $changedText .= '<div><b>New Starting Point:</b> ' . $eachChangeData['starting_point'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if ($eachChangeData['destination'] != $decodeOldData['destination']) {
                $changedText .= '<div><b>Old Destination:</b> ' . $decodeOldData['destination'] . '</div>';
                $changedText .= '<div><b>New Destination:</b> ' . $eachChangeData['destination'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if ($eachChangeData['overnight_compensation'] != $decodeOldData['overnight_compensation']) {
                $changedText .= '<div><b>Old Overnight Compensation:</b> ' . $decodeOldData['overnight_compensation'] . '</div>';
                $changedText .= '<div><b>New Overnight Compensation:</b> ' . $eachChangeData['overnight_compensation'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if ($eachChangeData['food_authorization'] != $decodeOldData['food_authorization']) {
                $changedText .= '<div><b>Old Food Authorization:</b> ' . $decodeOldData['food_authorization'] . '</div>';
                $changedText .= '<div><b>New Food Authorization:</b> ' . $eachChangeData['food_authorization'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if ($eachChangeData['transportation_method'] != $decodeOldData['transportation_method']) {
                $changedText .= '<div><b>Old Transportation Method:</b> ' . $decodeOldData['transportation_method'] . '</div>';
                $changedText .= '<div><b>New Transportation Method:</b> ' . $eachChangeData['transportation_method'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if ($eachChangeData['lodging'] != $decodeOldData['lodging']) {
                $changedText .= '<div><b>Old Lodging:</b> ' . $decodeOldData['lodging'] . '</div>';
                $changedText .= '<div><b>New Lodging:</b> ' . $eachChangeData['lodging'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if ($eachChangeData['expences'] != $decodeOldData['expences']) {
                $changedText .= '<div><b>Old Expences:</b> ' . $decodeOldData['expences'] . '</div>';
                $changedText .= '<div><b>New Expences:</b> ' . $eachChangeData['expences'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }

            if ($eachChangeData['employee_comments'] != '' && $decodeOldData['employee_comments'] != '') {
                if ($eachChangeData['employee_comments'] != $decodeOldData['employee_comments']) {
                    $changedText .= '<div><b>Old Employee Comment:</b> ' . $decodeOldData['employee_comments'] . '</div>';
                    $changedText .= '<div><b>New Employee Comment:</b> ' . $eachChangeData['employee_comments'] . '</div>';
                    $changedText .= '<div>&nbsp;</div>';
                }
            }

            if ($eachChangeData['manager_comments'] != $decodeOldData['manager_comments']) {
                $changedText .= '<div><b>Old Manager Comments:</b> ' . $decodeOldData['manager_comments'] . '</div>';
                $changedText .= '<div><b>New Manager Comments:</b> ' . $eachChangeData['manager_comments'] . '</div>';
                $changedText .= '<div>&nbsp;</div>';
            }
            $changedText .= '</div>';
        endforeach;
    }
    echo $changedText;
    die;
}


if (isset($_REQUEST['getRecordData']) && $_REQUEST['getRecordData'] == 1) {
    $editId = trim($_REQUEST['editId']);
    $detail = qs("SELECT * FROM errands WHERE id = '{$editId}'");
    if (!empty($detail)) {
        if ($detail['absence_type'] == 'hourly') {
            $startDateTimeArr = explode(' ', trim($detail['from_date_time']));
            $toDateTimeArr = explode(' ', trim($detail['to_date_time']));
            $detail['hourly_date'] = $startDateTimeArr[0];
            $detail['hourly_start_time'] = $startDateTimeArr[1];
            $detail['hourly_end_time'] = $toDateTimeArr[1];
        } else {
            $detail['entire_start_date'] = date('Y-m-d', strtotime(trim($detail['from_date_time'])));
            $detail['entire_end_date'] = date('Y-m-d', strtotime(trim($detail['to_date_time'])));
        }
    }
    json_die(1, $detail);
    die;
}

if (isset($_REQUEST['requestEdit']) && $_REQUEST['requestEdit'] == 1) {

    $old_fields_data = qs("SELECT errands_type,
                                  absence_type, 
                                  subject,
                                  from_date_time,
                                  to_date_time,
                                  day_request_submitted,
                                  requested_by,
                                  starting_point,
                                  destination,
                                  overnight_compensation,
                                  food_authorization,
                                  transportation_method,
                                  lodging,
                                  expences,
                                  manager_comments,
                                  total_days,
                                  status,
                                  employee_id
                             FROM errands 
                            WHERE id = '{$_REQUEST['editRecordId']}'");

    if (trim($_REQUEST['edit_absence_type']) == 'hourly') {
        $fromErrandEditDate = date('Y-m-d H:i:s', strtotime(trim($_REQUEST['edit_leave_date']) . " " . trim($_REQUEST['edit_start_date'])));
        $toErrandEditDate = date('Y-m-d H:i:s', strtotime(trim($_REQUEST['edit_leave_date']) . " " . trim($_REQUEST['edit_end_date'])));
    } else {
        $fromErrandEditDate = date('Y-m-d H:i:s', strtotime(trim($_REQUEST['edit_start_date'])));
        $toErrandEditDate = date('Y-m-d H:i:s', strtotime(trim($_REQUEST['edit_end_date'])));
    }

    $fromDate = date('Y-m-d H:i:s', strtotime(trim($fromErrandEditDate)));
    $toDate = date('Y-m-d H:i:s', strtotime(trim($toErrandEditDate)));
    $fromDateOnly = date('Y-m-d', strtotime(trim($fromErrandEditDate)));
    $toDateOnly = date('Y-m-d', strtotime(trim($toErrandEditDate)));
    $date1 = date_create($fromDate);
    $date2 = date_create($toDate);
    $diff = date_diff($date1, $date2);
    if ($diff->invert == 1 && $fromDateOnly == $toDateOnly) {
        $nextDay = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($toDate)));
        $toDate = $nextDay;
        $toErrandEditDate = $nextDay;
        $nextDate = date_create($nextDay);
        $diff = date_diff($date1, $nextDate);
    }

    unset($fields);
    $editId = $_REQUEST['editRecordId'];
    $fields['status'] = 'Accept';
    $fields['errands_type'] = trim($_REQUEST['edit_errand_type']);
    $fields['absence_type'] = trim($_REQUEST['edit_absence_type']);
    $fields['subject'] = trim($_REQUEST['edit_subject']);
    $fields['from_date_time'] = trim($fromErrandEditDate);
    $fields['to_date_time'] = trim($toErrandEditDate);
    $fields['day_request_submitted'] = trim($_REQUEST['edit_day_request']);
    $fields['requested_by'] = trim($_REQUEST['edit_request_by']);
    $fields['starting_point'] = trim($_REQUEST['edit_starting_point']);
    $fields['destination'] = trim($_REQUEST['edit_destination']);
    $fields['overnight_compensation'] = trim($_REQUEST['edit_overnight']);
    $fields['food_authorization'] = trim($_REQUEST['edit_food']);
    $fields['transportation_method'] = trim($_REQUEST['edit_transportation']);
    $fields['lodging'] = trim($_REQUEST['edit_lodging']);
    $fields['expences'] = trim($_REQUEST['edit_expences']);
    $fields['manager_comments'] = trim($_REQUEST['edit_manager_commnet']);

    $totalDaysMins = 0;

    $emp_id = $old_fields_data['employee_id'];
    $empWorkingHours = employeeDetail::GetEmployeePerDayWorkingHours($emp_id);

    $total_days_applied = 0;
    $leave = 0;
    for ($i = 0; $i < $diff->days + 1; $i++) {
        $sdate = '';
        $sdate = date("Y-m-d", strtotime("+" . $i . " Days", strtotime(trim($fromErrandEditDate))));
        $checkLeave = qs("select * from timesheet_leave where leave_date='{$sdate}' ");
        if (!empty($checkLeave)) {
            $leave++;
        }
    }

    $total_days = 0;
    $total_days = ($diff->days + 1);
    $total_days = ($total_days - $leave);
    $total_days_applied = $total_days;
    $total_days = ($total_days * $empWorkingHours);


    /*
      if (date('Y-m-d', strtotime(trim($fromErrandEditDate))) != date('Y-m-d', strtotime(trim($toErrandEditDate)))) {
      if ($diff->days == 0) {
      $total_minutes_new = ($diff->i + ($diff->h * 60));
      } else if (($diff->days + 1) > 0) {
      $totalDaysMins = ($empWorkingHours * ($total_days_applied));
      $total_minutes_new = $totalDaysMins;
      }
      } else {
      $total_minutes_new = $totalDaysMins + ($diff->i + ($diff->h * 60));
      }
     */

    if (trim($_REQUEST['edit_absence_type']) == 'hourly') {
        $total_minutes_new = ($diff->i + ($diff->h * 60));
    } else {
        $totalDaysMins = ($empWorkingHours * $total_days_applied);
        $total_minutes_new = $totalDaysMins;
    }

    $fields['total_days'] = $total_minutes_new;
    $fields['total_days_applied'] = $total_days_applied;
    qu("errands", $fields, "id='{$editId}'");

    /* Start Notification entry code */
    /*
      Admin
      Manager
      Supervisor
     */
    $data = qs("select * from errands where id = '{$editId}' ");
    $errandData = $data;
    $oldData = $old_fields_data;

    $adminId = 0;
    if ($errandData["company_id"] > 0) {
        $adminId = employeeDetail::getAdminIdFromCopmanyId($errandData["company_id"]);
    }

    $employeeInfo = array();
    $display_name = '';
    if ($errandData['employee_id'] > 0) {
        $employeeInfo = employeeDetail::GetEmployeeNameAndEmail($errandData['employee_id']);
        $display_name = $employeeInfo['full_name'];
    }

    $displayText = '<div style="text-align: left;">';
    $displayText .= $display_name . " requested a change to errand request </div>";
    $editAvailable = 0;
    if ($oldData["subject"] != $errandData["subject"]) {
        $displayText .= "<div style='text-align: left;'> subject = " . $errandData["subject"] . "</div><div class='clearfix'></div>";
        $editAvailable = 1;
    }
    if ($oldData["from_date_time"] != $errandData["from_date_time"]) {
        $displayText .= '<div>';
        if ($editAvailable == 1) {
            $displayText .= '<div style="float:left;width:auto;height:1px;">  and&nbsp; </div>';
        }
        $persianMonthName = '';
        $persianDayName = '';
        $persianMonthName = $persianDate->to_date($errandData["from_date_time"], 'M');
        $persianDayName = $persianDate->to_date($errandData["from_date_time"], 'd');
        $persianNoDate = '';
        $persianNumbers1 = substr($persianDayName, 0, 1);
        $persianNumbers2 = substr($persianDayName, 1, 1);
        if ($persianNumbers1 != '') {
            $persianNoDate .= $persianNumbers[$persianNumbers1];
        }
        if ($persianNumbers2 != '') {
            $persianNoDate .= $persianNumbers[$persianNumbers2];
        }
        $displayText .= '<div style="float:left;width:auto;height:1px;"> start date = </div><div style="float:left;margin-left:6px;"><div style="float:left;">' . $persianMonthName . '</div><div style="float:right;margin-left:6px;">' . $persianNoDate . '</div><div class="clearfix"></div></div><div class="clearfix"></div></div>';
        //     $displayText .= " start date = " . date('M d,Y', strtotime($errandData["from_date_time"]));
        $editAvailable = 1;
    }
    if ($oldData["to_date_time"] != $errandData["to_date_time"]) {
        $displayText .= '<div>';
        if ($editAvailable == 1) {
            $displayText .= '<div style="float:left;width:auto;height:1px;">  and&nbsp; </div>';
        }
        $persianMonthName = '';
        $persianDayName = '';
        $persianMonthName = $persianDate->to_date($errandData["to_date_time"], 'M');
        $persianDayName = $persianDate->to_date($errandData["to_date_time"], 'd');
        $persianNoDate = '';
        $persianNumbers1 = substr($persianDayName, 0, 1);
        $persianNumbers2 = substr($persianDayName, 1, 1);
        if ($persianNumbers1 != '') {
            $persianNoDate .= $persianNumbers[$persianNumbers1];
        }
        if ($persianNumbers2 != '') {
            $persianNoDate .= $persianNumbers[$persianNumbers2];
        }
        $displayText .= '<div style="float:left;width:auto;height:1px;"> end date =  </div><div style="float:left;margin-left:6px;"><div style="float:left;">' . $persianMonthName . '</div><div style="float:right;margin-left:6px;">' . $persianNoDate . '</div><div class="clearfix"></div></div><div class="clearfix"></div></div>';
//         $displayText .= " end date = " . date('M d,Y', strtotime($errandData["to_date_time"]));
        $editAvailable = 1;
    }

    $notifyField = array();
    $notifyField['emp_id'] = $adminId;
    $notifyField['company_id'] = _e($errandData["company_id"], 0);
    $notifyField['type_add_edit'] = 'edit';
    $notifyField['module_name'] = 'errand';
    $notifyField['module_rec_id'] = $errandData['id'];
    $notifyField['display_text'] = $displayText;
    $notifyField['add_edit_by_userid'] = _e($errandData['employee_id'], 0);
    qi('tb_notifications', _escapeArray($notifyField));

    /* End Notification entry code */

    unset($update_fields);
    $update_fields = qs("SELECT * FROM errands WHERE id = '{$_REQUEST['editRecordId']}'");
    unset($update_fields["id"]);
    unset($update_fields["created_at"]);
    unset($update_fields["modified_at"]);
    unset($update_fields["isEdited"]);
    unset($update_fields["add_by_manager"]);
    unset($update_fields["added_by_id"]);
    //unset($update_fields["unique_id"]);
    # Unique id
    $companyDetail = qs("SELECT * FROM `tb_company_works` where id='{$update_fields['company_id']}'");

    //$unique_id = array();
    //$unique_id[] = str_replace(" ", "_", $companyDetail['name']);
    //$unique_id[] = str_replace(" ", "_", $_SESSION['user']['fname'] . "_" . $_SESSION['user']['lname']);
    //$unique_id[] = strtotime($update_fields['from_date_time']);
    //$unique_id[] = $update_fields['errands_type'];
    //$unique_id[] = substr(md5(microtime()), rand(0, 26), 5);
    //$unique_id = array_filter($unique_id);
    //$unique_id = implode("_", $unique_id);
    //$update_fields['unique_id'] = $unique_id;

    $update_fields['edit_id'] = $_REQUEST['editRecordId'];
    $update_fields['edited_by_user_type'] = 'manager';
    $update_fields['edited_by_id'] = $_SESSION['user']['id'];
    $update_fields['edited_field_text'] = json_encode($old_fields_data);
    qi('errands_edit_history', _escapeArray($update_fields));

    unset($fieldsComment);
    $fieldsComment['errand_id'] = $editId;
    $fieldsComment['user_type'] = 'manager';
    $fieldsComment['comment_text'] = trim($_REQUEST['edit_manager_commnet']);
    qi("errands_comments", $fieldsComment);
}
if (isset($_REQUEST['requestAdd']) && $_REQUEST['requestAdd'] == 1) {

    if (trim($_REQUEST['add_absence_type']) == 'hourly') {
        $fromErrandDate = date('Y-m-d H:i:s', strtotime(trim($_REQUEST['add_leave_date']) . " " . trim($_REQUEST['add_start_date'])));
        $toErrandDate = date('Y-m-d H:i:s', strtotime(trim($_REQUEST['add_leave_date']) . " " . trim($_REQUEST['add_end_date'])));
    } else {
        $fromErrandDate = date('Y-m-d H:i:s', strtotime(trim($_REQUEST['add_start_date'])));
        $toErrandDate = date('Y-m-d H:i:s', strtotime(trim($_REQUEST['add_end_date'])));
    }

    $fromDate = date('Y-m-d H:i:s', strtotime($fromErrandDate));
    $toDate = date('Y-m-d H:i:s', strtotime(trim($toErrandDate)));
    $fromDateOnly = date('Y-m-d', strtotime($fromErrandDate));
    $toDateOnly = date('Y-m-d', strtotime(trim($toErrandDate)));
    $date1 = date_create($fromDate);
    $date2 = date_create($toDate);
    $diff = date_diff($date1, $date2);
    if ($diff->invert == 1 && $fromDateOnly == $toDateOnly) {
        $nextDay = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($toDate)));
        $toDate = $nextDay;
        $toErrandDate = $nextDay;
        $nextDate = date_create($nextDay);
        $diff = date_diff($date1, $nextDate);
    }

    unset($fields);
    //$unique_id = array();
    //$unique_id[] = str_replace(" ", "_", $_SESSION['company']['name']);
    //$unique_id[] = str_replace(" ", "_", $_SESSION['user']['fname'] . "_" . $_SESSION['user']['lname']);
    //$unique_id[] = strtotime($update_fields['from_date_time']);
    //$unique_id[] = $update_fields['errands_type'];
    //$unique_id[] = substr(md5(microtime()), rand(0, 26), 5);
    //$unique_id = array_filter($unique_id);
    //$unique_id = implode("_", $unique_id);
    $unique_id = getErrandsDisplayId();
    $fields['unique_id'] = $unique_id;
    $fields['company_id'] = $_SESSION['company']['id'];
    $fields['employee_id'] = $_POST['add_emp_id'];
    $fields['status'] = 'Accept';
    $fields['errands_type'] = trim($_REQUEST['add_errand_type']);
    $fields['absence_type'] = trim($_REQUEST['add_absence_type']);
    $fields['subject'] = trim($_REQUEST['add_subject']);
    $fields['from_date_time'] = $fromErrandDate;
    $fields['to_date_time'] = $toErrandDate;
    $fields['day_request_submitted'] = trim($_REQUEST['add_day_request']);
    $fields['requested_by'] = trim($_REQUEST['add_request_by']);
    $fields['starting_point'] = trim($_REQUEST['add_starting_point']);
    $fields['destination'] = trim($_REQUEST['add_destination']);
    $fields['overnight_compensation'] = trim($_REQUEST['add_overnight']);
    $fields['food_authorization'] = trim($_REQUEST['add_food']);
    $fields['transportation_method'] = trim($_REQUEST['add_transportation']);
    $fields['lodging'] = trim($_REQUEST['add_lodging']);
    $fields['expences'] = trim($_REQUEST['add_expences']);
    $fields['manager_comments'] = trim($_REQUEST['add_manager_commnet']);

    $totalDaysMins = 0;

    $emp_id = $_POST['add_emp_id'];
    $empWorkingHours = employeeDetail::GetEmployeePerDayWorkingHours($emp_id);

    $total_days_applied = 0;
    $leave = 0;
    for ($i = 0; $i < $diff->days + 1; $i++) {
        $sdate = '';
        $sdate = date("Y-m-d", strtotime("+" . $i . " Days", strtotime($fromErrandDate)));
        $checkLeave = qs("select * from timesheet_leave where leave_date='{$sdate}' ");
        if (!empty($checkLeave)) {
            $leave++;
        }
    }

    $total_days = 0;
    $total_days = ($diff->days + 1);
    $total_days = ($total_days - $leave);
    $total_days_applied = $total_days;
    //$total_days = ($total_days * $empWorkingHours); 

    if (trim($_REQUEST['add_absence_type']) == 'hourly') {
        $total_minutes_new = ($diff->i + ($diff->h * 60));
    } else {
        $totalDaysMins = ($empWorkingHours * $total_days_applied);
        $total_minutes_new = $totalDaysMins;
    }

    $fields['total_days'] = $total_minutes_new;
    $fields['total_days_applied'] = $total_days_applied;
    $fields['add_by_manager'] = 1;
    $fields['added_by_id'] = $_SESSION['user']['id'];
    $id = qi("errands", $fields);


    /* Start Notification entry code */
    /*
      Admin
      Manager
      Supervisor
     */


    $employeeInfo = array();
    $display_name = '';
    if ($emp_id > 0) {
        $employeeInfo = employeeDetail::GetEmployeeNameAndEmail($emp_id);
        $display_name = $employeeInfo['full_name'];
    }

    $persianMonthName = '';
    $persianDayName = '';
    $persianMonthName = $persianDate->to_date($fromErrandDate, 'M');
    $persianDayName = $persianDate->to_date($fromErrandDate, 'd');
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
    $notifyField['company_id'] = _e($_SESSION['company']['id'], 0);
    $notifyField['type_add_edit'] = 'add';
    $notifyField['module_name'] = 'errand';
    $notifyField['module_rec_id'] = $id;
    $notifyField['display_text'] = '<div><div style="float:left;width:auto;height:1px;">' . $display_name . ' want to new errand request at, </div><div style="float:left;margin-left:6px;"><div style="float:left;">' . $persianMonthName . '</div><div style="float:right;margin-left:6px;">' . $persianNoDate . '</div><div class="clearfix"></div></div><div class="clearfix"></div></div>';
    $notifyField['add_edit_by_userid'] = _e($emp_id, 0);
    qi('tb_notifications', _escapeArray($notifyField));

    /* End Notification entry code */



    unset($fieldsComment);
    $fieldsComment['errand_id'] = $id;
    $fieldsComment['user_type'] = 'manager';
    $fieldsComment['comment_text'] = trim($_REQUEST['add_manager_commnet']);
    qi("errands_comments", $fieldsComment);
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
        $whereWithTeam = ' AND employee_id IN (' . $_SESSION['user']['id'] . ')';
        $whereRelatedEmployee = ' AND id IN (' . $_SESSION['user']['id'] . ')';
    } else {
        $employeeIdsList = employee::getTeamEmployeesIds($companyId, $teamId);
        if (empty($employeeIdsList)) {
            $employeeIdsList[] = 0;
        }
        $employeeIdsListStr = implode(",", $employeeIdsList);
        $whereWithTeam = ' AND employee_id IN (' . $employeeIdsListStr . ')';
        $whereRelatedEmployee = ' AND id IN (' . $employeeIdsListStr . ')';
    }
}


$employee = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}' " . $whereRelatedEmployee);


$jsInclude = 'request_errand.js.php';
_cg("page_title", "Request Errand");  
?>
