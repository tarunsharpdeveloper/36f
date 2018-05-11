<?php

if ($_POST['deleteShift'] == 1) {
    $condition = 'id=' . $_POST['deleteShiftId'];
    qd('tb_assign_shift', $condition);
}
if ($_REQUEST['submitEditData'] == 1) {
    parse_str($_REQUEST['allowDates'], $checkDatesAllow);
    $checkDatesAllow = $checkDatesAllow['chk'];
    parse_str($_REQUEST['data'], $_POST);
    $sdate = date("Y-m-d", strtotime($_POST['shift_start_date']));
    $id = $_POST['editShiftID'];
    $empID = $_POST['employeeID'];
    $checkDate = q("select * from tb_assign_shift where start_date='$sdate' and end_date='$sdate' AND id!='{$id}' AND user_id='{$empID}'");

    $shift = array();
    $shift['start_time'] = date('H:i:s', strtotime($_POST['shift_start_time']));
    $shift['start_date'] = date("Y-m-d", strtotime($_POST['shift_start_date']));
    $minutes = explode(':', $_POST['shift_end_time']);
    $totalMinutes = $minutes[1] + ($minutes[0] * 60);
    $shift['end_time'] = date('H:i:s', strtotime("+" . $totalMinutes . " minutes", strtotime($shift['start_date'] . " " . $shift['start_time'])));
    $shift['end_date'] = date("Y-m-d", strtotime("+" . $totalMinutes . " minutes", strtotime($shift['start_date'] . " " . $shift['start_time'])));
    $shift['total_hour'] = date('H:i:s', strtotime($_POST['shift_end_time']));

    $condition = "id='" . $_POST['editShiftID'] . "'";
    $checkAllowLeave = 0;
    $checkLeave = qs("select * from timesheet_leave where leave_date='{$sdate}' ");
    if (!empty($checkLeave)) {
        if (in_array($sdate, $checkDatesAllow)) {
            $checkAllowLeave = 0;
        } else {
            $checkAllowLeave = 1;
        }
    }
    if ($checkAllowLeave == 0) {
        $isInsert = '1';
        foreach ($checkDate as $shiftValue) {
            if ((strtotime($shift['start_time']) <= strtotime($shiftValue['start_time'])) && (strtotime($shift['end_time']) <= strtotime($shiftValue['start_time']))) {
                $isInsert = '1';
            } else if ((strtotime($shift['start_time']) >= strtotime($shiftValue['end_time'])) && (strtotime($shift['end_time']) >= strtotime($shiftValue['end_time']))) {
                $isInsert = '1';
            } else {
                $isInsert = '0';
                break;
            }
        }
        if ($isInsert == '1') {
            qu("tb_assign_shift", _escapeArray($shift), $condition);
        } else {
            echo '0';
            die;
        }
    }
    $shift_list = q("select tb_employee.fname,tb_employee.lname,tb_assign_shift.* from tb_assign_shift join tb_employee on tb_assign_shift.user_id=tb_employee.id order by tb_assign_shift.id desc limit 0,20");
    include _PATH . "instance/front/tpl/add_shift_data.php";
    die;
}
if ($_REQUEST['submitDataCheck'] == '1') {
    $parm = array();
    $shift = array();
    parse_str($_REQUEST['data'], $parm);
    $startDate = date("Y-m-d", strtotime($parm['shift_start_date']));
    $endDate = date("Y-m-d", strtotime($parm['shift_end_date']));
    $first = new DateTime($endDate);
    $second = new DateTime($startDate);
    $diff = $first->diff($second);
    $leave = 0;
    for ($i = 0; $i < $diff->days + 1; $i++) {
        $sdate = date("Y-m-d", strtotime("+" . $i . " Days", strtotime($parm['shift_start_date'])));
        $checkDate = q("select * from tb_assign_shift where start_date='$sdate' and end_date='$sdate' AND user_id='{$parm['employee']}'");
        $checkLeave = qs("select * from timesheet_leave where leave_date='{$sdate}' ");
        if (!empty($checkLeave)) {# Unique id
            $leave = 1;
            $leaveData[$i]['date'] = $checkLeave['leave_date'];
            $leaveData[$i]['reason'] = $checkLeave['reason'];
        }
    }
    if ($leave == 1) {
        include _PATH . "instance/front/tpl/add_shift_leave_data.php";
    } else {
        echo 'Pass';
    }
    die;
}

if ($_REQUEST['submitData'] == '1') {
    parse_str($_REQUEST['allowDates'], $checkDatesAllow);
    $checkDatesAllow = $checkDatesAllow['chk'];
    $parm = array();
    $shift = array();
    parse_str($_REQUEST['data'], $parm);
    $startDate = date("Y-m-d", strtotime($parm['shift_start_date']));
    $endDate = date("Y-m-d", strtotime($parm['shift_end_date']));
    $first = new DateTime($endDate);
    $second = new DateTime($startDate);
    $diff = $first->diff($second);
    $leave = 0;
    for ($i = 0; $i < $diff->days + 1; $i++) {
        $sdate = date("Y-m-d", strtotime("+" . $i . " Days", strtotime($parm['shift_start_date'])));
        $checkDate = q("select * from tb_assign_shift where start_date='$sdate' and end_date='$sdate' AND user_id='{$parm['employee']}'");
        $checkAllowLeave = 0;
        $checkLeave = qs("select * from timesheet_leave where leave_date='{$sdate}' ");
        if (!empty($checkLeave)) {
            if (in_array($sdate, $checkDatesAllow)) {
                $checkAllowLeave = 0;
            } else {
                $checkAllowLeave = 1;
            }
        }
        if ($checkAllowLeave == 0) {
            # Unique id
            $employees = qs("SELECT * From tb_employee where id='{$parm['employee']}'");
            $company = qs("SELECT * FROM `tb_company_works` where id='{$employees['work_at']}'");

            $random_id = substr(md5(microtime()), rand(0, 26), 5);
            $unique_id = array();
            $unique_id[] = str_replace(" ", "_", $company['name']);
            $unique_id[] = str_replace(" ", "_", $employees['fname'] . "_" . $employees['lname']);
            $unique_id[] = strtotime(date('Y-m-d', strtotime($parm['shift_end_date'])));
            // $unique_id[] = $id_reason;
            $unique_id[] = $random_id;
            $unique_id = array_filter($unique_id);
            $unique_id = implode("_", $unique_id);
            if (empty($checkDate)) {
                $shift['unique_id'] = $unique_id;
                $shift['user_id'] = $parm['employee'];
                $shift['start_time'] = date('H:i:s', strtotime($parm['shift_start_time']));
                $shift['start_date'] = date("Y-m-d", strtotime("+" . $i . " Days", strtotime($parm['shift_start_date'] . " " . $shift['start_time'])));
                $minutes = explode(':', $parm['shift_end_time']);
                $totalMinutes = $minutes[1] + ($minutes[0] * 60);
                $shift['end_time'] = date('H:i:s', strtotime("+" . $totalMinutes . " minutes", strtotime($shift['start_date'] . " " . $shift['start_time'])));
                $shift['end_date'] = date("Y-m-d", strtotime("+" . $totalMinutes . " minutes", strtotime($shift['start_date'] . " " . $shift['start_time'])));
                $shift['total_hour'] = date('H:i:s', strtotime($parm['shift_end_time']));
                $shift['area_of_work'] = $employees['location'];
                qi("tb_assign_shift", _escapeArray($shift));
            } else {
                $shift['unique_id'] = $unique_id;
                $shift['user_id'] = $parm['employee'];
                $shift['start_time'] = date('H:i:s', strtotime($parm['shift_start_time']));
                $shift['start_date'] = date("Y-m-d", strtotime("+" . $i . " Days", strtotime($parm['shift_start_date'] . " " . $shift['start_time'])));
                $minutes = explode(':', $parm['shift_end_time']);
                $totalMinutes = $minutes[1] + ($minutes[0] * 60);
                $shift['end_time'] = date('H:i:s', strtotime("+" . $totalMinutes . " minutes", strtotime($shift['start_date'] . " " . $shift['start_time'])));
                $shift['end_date'] = date("Y-m-d", strtotime("+" . $totalMinutes . " minutes", strtotime($shift['start_date'] . " " . $shift['start_time'])));
                $shift['total_hour'] = date('H:i:s', strtotime($parm['shift_end_time']));
                $shift['area_of_work'] = $employees['location'];

                $isInsert = '1';
                foreach ($checkDate as $shiftValue) {
                    if ((strtotime($shift['start_time']) <= strtotime($shiftValue['start_time'])) && (strtotime($shift['end_time']) <= strtotime($shiftValue['start_time']))) {
                        $isInsert = '1';
                    } else if ((strtotime($shift['start_time']) >= strtotime($shiftValue['end_time'])) && (strtotime($shift['end_time']) >= strtotime($shiftValue['end_time']))) {
                        $isInsert = '1';
                    } else {
                        $isInsert = '0';
                        break;
                    }
                }

                if ($isInsert == '1') {
                    qi("tb_assign_shift", _escapeArray($shift));
                } else {
                    echo '0';
                    die;
                }
                //   
            }
        }
    }
    $shift_list = q("select tb_employee.fname,tb_employee.lname,tb_assign_shift.* from tb_assign_shift join tb_employee on tb_assign_shift.user_id=tb_employee.id order by tb_assign_shift.id desc limit 0,20");
    include _PATH . "instance/front/tpl/add_shift_data.php";

    die;
}
if ($_REQUEST['getShiftData'] == '1') {
    $shift = qs("select * from tb_assign_shift where id='" . $_REQUEST['id'] . "'");
    json_die('1', $shift);
    die;
}


if ($_REQUEST['submitDataCheckEdit'] == '1') {
    $parm = array();
    $shift = array();
    parse_str($_REQUEST['data'], $parm);
    $startDate = date("Y-m-d", strtotime($parm['shift_start_date']));

    $leave = 0;
    $checkLeave = qs("select * from timesheet_leave where leave_date='{$startDate}' ");
    if (!empty($checkLeave)) {# Unique id
        $leave = 1;
        $leaveData[$i]['date'] = $checkLeave['leave_date'];
        $leaveData[$i]['reason'] = $checkLeave['reason'];
    }

    if ($leave == 1) {
        include _PATH . "instance/front/tpl/add_shift_leave_data.php";
    } else {
        echo 'Pass';
    }
    die;
}



$shift_list = q("select tb_employee.mobile, tb_employee.fname,tb_employee.lname,tb_assign_shift.* from tb_assign_shift join tb_employee on tb_assign_shift.user_id=tb_employee.id order by tb_assign_shift.id desc limit 0,20");
$employee = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'");

$jsInclude = "add_shift.js.php";
_cg("page_tilte", "Add Shift");
?>