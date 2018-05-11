<?php

if ($_POST['deleteShift'] == 1) {
    $condition = 'id=' . $_POST['deleteShiftId'];
    qd('tb_assign_shift', $condition);
}
if ($_REQUEST['getDate'] == 1) {
    if ($_REQUEST['data'] == 'month') {
        echo date('Y-m-t');
    }
    if ($_REQUEST['data'] == '+3month') {
        echo date('Y-m-t', strtotime("+3 month"));
    }
    if ($_REQUEST['data'] == '+6month') {
        echo date('Y-m-t', strtotime("+6 month"));
    }
    die;
}
if ($_REQUEST['submitData'] == 1) {
    if ($_REQUEST['endDate'] == '') {
        if ($_REQUEST['shiftForm'] == 'MonthForm') {
            if (date('D') == 'Sun')
                $endDate = date("Y-m-d", strtotime("+21 days"));
            else
                $endDate = date("Y-m-d", strtotime("+21 days", strtotime("next sunday")));
        } else if ($_REQUEST['shiftForm'] == '2weekForm') {
            if (date('D') == 'Sun')
                $endDate = date("Y-m-d", strtotime("+7 days"));
            else
                $endDate = date("Y-m-d", strtotime("+7 days", strtotime("next sunday")));
        }else {
            if (date('D') == 'Sun')
                $endDate = date("Y-m-d");
            else
                $endDate = date("Y-m-d", strtotime("next sunday"));
        }
    }else {
        $endDate = date("Y-m-d", strtotime($_REQUEST['endDate']));
    }



    if (date('D') == 'Mon')
        $startDate = date("Y-m-d");
    else
        $startDate = date("Y-m-d", strtotime("previous monday"));

    $first = new DateTime($endDate);
    $second = new DateTime($startDate);
    $diff = $first->diff($second);
    $leave = 0;
    for ($i = 0; $i < $diff->days + 1; $i++) {
        $sdate = date("Y-m-d", strtotime("+" . $i . " Days", strtotime($startDate)));
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
if ($_REQUEST['dataEntry'] == 1) {
    parse_str($_REQUEST['allowDates'], $checkDatesAllow);
    $checkDatesAllow = $checkDatesAllow['chk'];
    parse_str($_REQUEST['data'], $parm);
    foreach ($parm['week'] as $key => $valueWeek) {
        foreach ($valueWeek as $keyWeek => $value) {
            $parm['week'][$key][$keyWeek] = strtolower($value);
        }
    }
    if (date('D') == 'Mon')
        $startDate = date("Y-m-d");
    else
        $startDate = date("Y-m-d", strtotime("previous monday"));

    $shift = array();
    if (count($parm['week']) == 4) {
        if ($_REQUEST['endDate'] == '') {
            if (date('D') == 'Sun')
                $endDate = date("Y-m-d", strtotime("+21 days"));
            else
                $endDate = date("Y-m-d", strtotime("+21 days", strtotime("next sunday")));
        }else {
            $endDate = date("Y-m-d", strtotime($_REQUEST['endDate']));
        }
        //Month logic completed
    } else if (count($parm['week']) == 2) {
        if ($_REQUEST['endDate'] == '') {
            if (date('D') == 'Sun')
                $endDate = date("Y-m-d", strtotime("+7 days"));
            else
                $endDate = date("Y-m-d", strtotime("+7 days", strtotime("next sunday")));
        }else {
            $endDate = date("Y-m-d", strtotime($_REQUEST['endDate']));
        }

        //end 2 week logic
    } else if (count($parm['week']) == '1') {
        if ($_REQUEST['endDate'] == '') {
            if (date('D') == 'Sun')
                $endDate = date("Y-m-d");
            else
                $endDate = date("Y-m-d", strtotime("next sunday"));
        }else {
            $endDate = date("Y-m-d", strtotime($_REQUEST['endDate']));
        }
    }

    $first = new DateTime($startDate);
    $second = new DateTime($endDate);
    $diff = $first->diff($second);
    $week = 1;
    for ($i = 0; $i < $diff->days + 1; $i++) {
        $sdate = date("Y-m-d", strtotime("+" . $i . " Days", strtotime($startDate)));
        $checkDate = q("select * from tb_assign_shift where start_date='$sdate' and end_date='$sdate' AND user_id='{$_REQUEST['empId']}'");
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
            $sDateDay = date("D", strtotime($sdate));
            if (in_array(strtolower($sDateDay), $parm['week'][$week])) {
                $employees = qs("SELECT * From tb_employee where id='{$_REQUEST['empId']}'");
                $company = qs("SELECT * FROM `tb_company_works` where id='{$employees['work_at']}'");
                $random_id = substr(md5(microtime()), rand(0, 26), 5);
                $unique_id = array();
                $unique_id[] = str_replace(" ", "_", $company['name']);
                $unique_id[] = str_replace(" ", "_", $employees['fname'] . "_" . $employees['lname']);
                $unique_id[] = strtotime(date('Y-m-d', strtotime($sdate)));

                $unique_id[] = $random_id;
                $unique_id = array_filter($unique_id);
                $unique_id = implode("_", $unique_id);

                $shift['unique_id'] = $unique_id;
                $shift['user_id'] = $_REQUEST['empId'];


                $keyTime = array_search(strtolower($sDateDay), $parm['week'][$week]);
                $time = explode("-", $parm['time'][$week][$keyTime]);
                $stime = date("Y-m-d H:i:s", strtotime($sdate." ".$time[0]));
                if ($time[0] > $time[1]) {
                    $etime = date("Y-m-d H:i:s", strtotime("+1 day", strtotime($sdate." ".$time[1])));
                } else {
                    $etime = date("Y-m-d H:i:s", strtotime($sdate." ".$time[1]));
                }
               
                $first = new DateTime($stime);
                $second = new DateTime($etime);
                $diffTime = $first->diff($second);

                $shift['end_date'] = date("Y-m-d", strtotime($etime));
                $shift['start_date'] = date("Y-m-d", strtotime($sdate));

                $hour = $diffTime->h;
                $minute = $diffTime->i;
                $second = $diffTime->s;

                $shift['start_time'] = date("H:i:s", strtotime($stime));$stime;
                $shift['end_time'] = date("H:i:s", strtotime($etime));$etime;
                $shift['total_hour'] = $hour . ":" . $minute . ":" . $second;
                $shift['area_of_work'] = $employees['location'];
                if (empty($checkDate)) {
                    qi("tb_assign_shift", _escapeArray($shift));
                } else {
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
                }
            }
            if (strtolower($sDateDay) == 'sun') {
                if (count($parm['week']) == 4) {
                    $week++;
                    if ($week == 5) {
                        $week = 1;
                    }
                } else if (count($parm['week']) == 2) {
                    $week = $week == 1 ? 2 : 1;
                }
            }
        }
    }
    $shift_list = q("select tb_employee.fname,tb_employee.lname,tb_assign_shift.* from tb_assign_shift join tb_employee on tb_assign_shift.user_id=tb_employee.id order by tb_assign_shift.id desc limit 0,20");
    include _PATH . "instance/front/tpl/add_shift_data.php";
    die;
}
$shift_list = q("select tb_employee.mobile, tb_employee.fname,tb_employee.lname,tb_assign_shift.* from tb_assign_shift join tb_employee on tb_assign_shift.user_id=tb_employee.id order by tb_assign_shift.id desc limit 0,20");
$employee = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'");

$jsInclude = "add_shift_new.js.php";
_cg("page_tilte", "Add Shift");
