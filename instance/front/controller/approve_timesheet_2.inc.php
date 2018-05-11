<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}
$emp = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'");
//d($emp);
//die;
if (isset($_REQUEST['deleteShift'])) {
    $shiftId = $_REQUEST['shiftId'];
    $std = qd("tb_shift_time", "id='$shiftId'");
    echo json_encode($std);
    die;
}
if (isset($_REQUEST['getshifts'])) {
    $id = $_REQUEST['id'];
    $data = array();
    $data = qs("select * from tb_shift_time where id='$id'");
    echo json_encode($data);
    die;
}
if (isset($_REQUEST['getTotalTime'])) {
    //$id = $_REQUEST['id'];

    $start_time = $_REQUEST["startTime"]; // pulled from DB
    $finish_time = $_REQUEST["endTime"];
    // pulled from DB
    $starttime = strtotime($start_time); // convert to timestring
    $endtime = strtotime($finish_time); // convert to timestring
    $diff = $endtime - $starttime; // do the math

    $total_breaks = strtotime($_REQUEST["breakTime"]); // pulled from DB
    $breaks = $total_breaks * 60; // minutes * seconds per minute
    $hours = ($diff - $breaks) / 60; // do the math converting seconds to hours

    $totalhours = $hours - $_REQUEST["breakTime"];


    $d = floor($totalhours / 1440);
    $h = floor(($totalhours - $d * 1440) / 60);
    $m = $totalhours - ($d * 1440) - ($h * 60);

    if ($h == "" OR $h == null) {
        $time = "$m m";
    } else {
        $time = "$h h $m m";
    }


    echo json_encode(array("Hours" => $time));
    die;
}
if (isset($_REQUEST['editShift'])) {

    $start_time = date("H:i", strtotime($_REQUEST['start_time']));
    $end_time = date("H:i", strtotime($_REQUEST['end_time']));
//    d($start_time);
//    d($end_time);
//    die;
    $break_time = $_REQUEST['break_time'];
    $shiftId = $_REQUEST['shiftId'];
    $note = $_REQUEST['note'];


//    if ((strlen($start_time)) <= 2) {
//        $start_time = $time[0] * 100;
//        $startlen = $start_time;
//        $start_time = round($start_time / 100, 2);
//        $start_time = number_format($start_time, 2, ':', '');
//    } else {
//        $start_time = str_replace(":", "", $start_time);
////        $start_time = $start_time / 100;
//        $startlen = $start_time;
//        $start_time = round($start_time / 100, 2);
//        $start_time = number_format($start_time, 2, ':', '');
//    }
//    if (strlen($end_time) <= 2) {
//        $end_time = $time[1] * 100;
//        $endlen = $end_time;
//        $end_time = round($end_time / 100, 2);
//        $end_time = number_format($end_time, 2, ':', '');
//    } else {
//        $end_time = str_replace(":", "", $end_time);
////        $end_time = $end_time / 100;
//        $endlen = $end_time;
//        $end_time = round($end_time / 100, 2);
//        $end_time = number_format($end_time, 2, ':', '');
//    }
//    d($start_time);
//    d($end_time);





    $starttime = strtotime($start_time); // convert to timestring
    $endtime = strtotime($end_time); // convert to timestring
    if ($starttime <= $endtime) {
        $diff = $endtime - $starttime; // do the math
    } else {
        $diff = $starttime - $endtime; // do the math
    }
    $tot_min = $diff / 60;
    $tot_min = $tot_min - $break_time;


//
//    d($start_time);
//    d($end_time);
//    d($tot_min);
//    die;
    if ($tot_min >= 15) {
        $error = 0;
        $_fields['start_time'] = $start_time;
        $_fields['end_time'] = $end_time;
        $_fields['break_time'] = $break_time;
        $_fields['note'] = $note;

        $start_time = $start_time; // pulled from DB
        $finish_time = $end_time; // pulled from DB
//        d($start_time);
//        d($end_time);
//        die;
        $starttime = strtotime($start_time); // convert to timestring
        $endtime = strtotime($finish_time); // convert to timestring
        $diff = $endtime - $starttime; // do the math

        $total_breaks = strtotime($break_time); // pulled from DB
        $breaks = $total_breaks * 60; // minutes * seconds per minute
        $hours = ($diff - $breaks) / 60; // do the math converting seconds to hours

        $totalhours = $hours - $break_time;

        $d = floor($totalhours / 1440);
        $h = floor(($totalhours - $d * 1440) / 60);
        $m = $totalhours - ($d * 1440) - ($h * 60);

        if ($h == "" OR $h == null) {
            $time = "$m m";
        } else {
            $time = "$h h $m m";
        }
        $_fields['total_hours'] = $time;
//        d($start_time);
//        d($end_time);
//        d($shiftId);
//        d($time);
//        die;
        $shift_u = qu("tb_shift_time", $_fields, "id = '$shiftId'");
//        if ($shift_u > 0) {
//            $fields = array();
//            $fields['company_id'] = $_SESSION['user']['work_at'];
//            $fields['emp_id'] = $_SESSION['user']['id'];
//            $fields['log'] = " Shift Ended At " . date("Y-m-d h:m:a");
//            qi("tb_employee_log", $fields);
//        }

        $_SESSION["start_break"] = "";
        $_SESSION["end_break"] = "";
        $_SESSION["break_time"] = "";
        $_SESSION["shiftId"] = "";
    } else {
        $error = 1;
        $msg = "This timesheet might be deleted because its length is less than minimum length requirement of 15 minutes. Are you sure?";
    }

    $value["error"] = $error;

    echo json_encode($value);
    die;
}
if (isset($_REQUEST['UpdateStatus'])) {
    $id = $_REQUEST['id'];
    $status = $_REQUEST['status'];
    if ($status == "0") {
        $liveshift = qs("select * from tb_shift_time where id='$id'");
//        d($liveshift['total_hours']);
        $sDate = date("Y-m-d", strtotime($liveshift['sDate']));
        $assShift = qs("select * from tb_assign_shift where user_id='{$liveshift['user_id']}' AND start_date='$sDate'");
        $shiftType = qs("select * from tb_shift_type where id='{$assShift['shift_type_id']}'");
//        d($sDate);
//        d($shiftType['per_hour_leave_credit']);
        $workHours = rtrim($liveshift['total_hours']);
        $workHours = explode("h", $liveshift['total_hours']);
        $mm = explode("m", rtrim($workHours[1]));
        $workHours = $workHours[0] + ($mm[0] / 60);
//        d($workHours);
//        d($workHours * $shiftType['per_hour_leave_credit']);

        $fields = array();
        $fields['emp_id'] = $liveshift['user_id'];
        $fields['date'] = date("Y-m-d H:i");
        $fields['assign_shift_id'] = $assShift['id'];
        $fields['work_shift_id'] = $id;
        $fields['approved_id'] = $_SESSION['user']['id'];
        $fields['leave_minutes_credited'] = $workHours;
//        die;
        qi("tb_employee_leave_credit_history", $fields);
    }


    $fields = array();
    if ($status == "0") {
        $fields['status'] = "1";
    } else {
        $fields['status'] = "0";
    }
    $stu = qu("tb_shift_time", $fields, "id='$id'");
    if ($stu >= 1) {
        $success = "1";
    } else {
        $success = "-1";
    }
    echo json_encode($success);
    die;
}
if (isset($_REQUEST['getEMPTimesheet'])) {

    $dt = $_REQUEST['sDate'];
    $empID = $_REQUEST['empID'];
    $status = $_REQUEST['status'];
    if (!$status == "" || $status == "0") {
        $status = "AND sf.status='$status'";
    }
    if (!$empID == "") {
        $empID = "AND e.id='$empID'";
    }
    $lastQuery = $empID . " " . $status;
//    d($lastQuery);
//    die;
//    d($dt);
    $ddt = explode("-", $dt);
    $start_dt = date("Y-m-d", strtotime($ddt[0]));
    $end_dt = date("Y-m-d", strtotime($ddt[1] . "+1 days"));

    $getStartDT = date_create($start_dt);
    $getEndDT = date_create($end_dt);
    $diff = date_diff($getStartDT, $getEndDT);

    $getDiff = $diff->format("%a");

    $arrayDate = array();
    for ($i = 0; $i < $getDiff; $i++) {
        $arrayDate[$i] = date("Y-m-d", strtotime($start_dt . "+" . $i . " days"));
    }
//    d($arrayDate);
    $timesheet = q("select sf.*,e.fname,e.lname from tb_employee e, tb_shift_time sf where e.id=sf.user_id AND e.work_at='{$_SESSION['company']['id']}' AND (sf.created_at BETWEEN '$start_dt' AND '$end_dt') " . $lastQuery);
//    d($start_dt);
//    d($end_dt);
//    include _PATH . 'instance/front/tpl/approve_timesheet_data_2.php';
    include _PATH . 'instance/front/tpl/approve_timesheet_data_emp.php';
    die;
//    echo json_encode(1);
//    die;
}
if (isset($_REQUEST['getTimesheet'])) {

    $dt = $_REQUEST['sDate'];
//    d($dt);
    $ddt = explode("-", $dt);
    $start_dt = date("Y-m-d", strtotime($ddt[0]));
    $end_dt = date("Y-m-d", strtotime($ddt[1] . "+1 days"));
    $timesheet = q("select sf.*,e.fname,e.lname from tb_employee e, tb_shift_time sf where e.id=sf.user_id AND e.work_at='{$_SESSION['company']['id']}' AND (sf.created_at BETWEEN '$start_dt' AND '$end_dt')");
//    d($start_dt);
//    d($end_dt);
    include _PATH . 'instance/front/tpl/approve_timesheet_data_2.php';
    die;
//    echo json_encode(1);
//    die;
}
if (isset($_REQUEST['AfterWeek'])) {
    $selectDate = $_REQUEST['selectDate'];
    $Dayjump = $_REQUEST['Dayjump'];
    $week_start = "";
    $week_end = "";
    $weeks = array();
    $weeks_Day = array();
    $weeksday = array();
    $weeks_month = array();
    $emp_nm = array();
    $weekStart = array();

//    $test = date();
    $test = date('Y-m-d', strtotime($selectDate));
    $test = date('Y-m-d', strtotime($test . '+' . $Dayjump . ' days'));
    echo json_encode($test);
    die;
}
if (isset($_REQUEST['BeforeWeek'])) {
    $selectDate = $_REQUEST['selectDate'];
    $Dayjump = $_REQUEST['Dayjump'];
    $week_start = "";
    $week_end = "";
    $weeks = array();
    $weeks_Day = array();
    $weeksday = array();
    $weeks_month = array();
    $emp_nm = array();
    $weekStart = array();

//    $test = date();
    $test = date('Y-m-d', strtotime($selectDate));
    $test = date('Y-m-d', strtotime($test . '-' . $Dayjump . ' days'));
    echo json_encode($test);
    die;
}
if (isset($_REQUEST['DivsDate'])) {
    $selectDate = $_REQUEST['selectDate'];
    $week_start = "";
    $week_end = "";
    $weeks = array();
    $weeks_Day = array();
    $weeksday = array();
    $weeks_month = array();
    $emp_nm = array();
    $weekStart = array();

//    $test = date();
    $test = date('Y-m-d', strtotime($selectDate));
//    d($test);
    $s_day = Date("w", strtotime($test));
//    d("Test Day COunt week ".$dayt);
//    $day = date("w", strtotime("2017-03-30"));
//    d("Day Of the  Week" . $s_day);
//        $day = date('w');
    $week_start = date('Y-m-d', strtotime($test . '-' . $s_day . ' days'));
    $week_end = date('Y-m-d', strtotime($test . '+' . (6 - $s_day) . ' days'));
//    echo "Selecetd Date = " . $day . " Start Week Date is = " . $week_start . " Week End Date is = " . $week_end;
//    d("Week Start " . $week_start);
//    d("Week End " . $week_end);
//    d("selectd Date" . $selectDate);
    for ($i = 0; $i < 7; $i++) {
        $c = $i;
//        $Days1 = strtotime("+" . $c . " days", strtotime($week_start));
        $weeks[] = date('Y-m-d', strtotime($week_start . $i . " day"));
        $weekStart[] = date('M d Y', strtotime($week_start . $i . " day"));
        $weeks_month[] = date('M d', strtotime($week_start . $i . " day"));
        $weeks_day[] = date('d', strtotime($week_start . $i . " day"));
        $weeks_Day[] = date('D', strtotime($week_start . $i . " day"));
    }
    $emp = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'");
    foreach ($emp as $row) {
        $emp_nm[] = $row['fname'] . ' ' . $row['lname'];
    }
//    d($weeks);
//    d($weeks_month);
//    die;
    echo json_encode(array("weekStart" => $weekStart, "weeks" => $weeks, "weeks_month" => $weeks_month, "dayno" => $weeks_day, "dayname" => $weeks_Day, "emp_nm" => $emp));
    die;
}
if (isset($_REQUEST['DivsDate2Week'])) {
    $selectDate = $_REQUEST['selectDate'];
    $week_start = "";
    $week_end = "";
    $weeks = array();
    $weeks_Day = array();
    $weeksday = array();
    $weeks_month = array();
    $emp_nm = array();
    $weekStart = array();
//    $test = date();
    $test = date('Y-m-d', strtotime($selectDate));
//    d($test);
    $s_day = Date("w", strtotime($test));
//    d("Test Day COunt week ".$dayt);
//    $day = date("w", strtotime("2017-03-30"));
//    d("Day Of the  Week" . $s_day);
//        $day = date('w');
    $week_start = date('Y-m-d', strtotime($test . '-' . $s_day . ' days'));
    $week_end = date('Y-m-d', strtotime($test . '+' . (6 - $s_day) . ' days'));
//    echo "Selecetd Date = " . $day . " Start Week Date is = " . $week_start . " Week End Date is = " . $week_end;
//    d("Week Start " . $week_start);
//    d("Week End " . $week_end);
//    d("selectd Date" . $selectDate);
    for ($i = 0; $i < 14; $i++) {
        $c = $i;
//        $Days1 = strtotime("+" . $c . " days", strtotime($week_start));
        $weeks[] = date('Y-m-d', strtotime($week_start . $i . " day"));
        $weekStart[] = date('M d Y', strtotime($week_start . $i . " day"));
        $weeks_month[] = date('M d', strtotime($week_start . $i . " day"));
        $weeks_day[] = date('d', strtotime($week_start . $i . " day"));
        $weeks_Day[] = date('D', strtotime($week_start . $i . " day"));
    }
    $emp = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'");
    foreach ($emp as $row) {
        $emp_nm[] = $row['fname'] . ' ' . $row['lname'];
    }
//    d($weeks);
//    d($weeks_month);
//    die;
    echo json_encode(array("weekStart" => $weekStart, "weeks" => $weeks, "weeks_month" => $weeks_month, "dayno" => $weeks_day, "dayname" => $weeks_Day, "emp_nm" => $emp));
    die;
}
if (isset($_REQUEST['DivsDate4Week'])) {
    $selectDate = $_REQUEST['selectDate'];
    $week_start = "";
    $week_end = "";
    $weeks = array();
    $weeks_Day = array();
    $weeksday = array();
    $weeks_month = array();
    $weekStart = array();
    $emp_nm = array();

//    $test = date();
    $test = date('Y-m-d', strtotime($selectDate));
//    d($test);
    $s_day = Date("w", strtotime($test));
//    d("Test Day COunt week ".$dayt);
//    $day = date("w", strtotime("2017-03-30"));
//    d("Day Of the  Week" . $s_day);
//        $day = date('w');
    $week_start = date('Y-m-d', strtotime($test . '-' . $s_day . ' days'));
    $week_end = date('Y-m-d', strtotime($test . '+' . (6 - $s_day) . ' days'));
//    echo "Selecetd Date = " . $day . " Start Week Date is = " . $week_start . " Week End Date is = " . $week_end;
//    d("Week Start " . $week_start);
//    d("Week End " . $week_end);
//    d("selectd Date" . $selectDate);
    for ($i = 0; $i < 29; $i++) {
        $c = $i;
//        $Days1 = strtotime("+" . $c . " days", strtotime($week_start));
        $weeks[] = date('Y-m-d', strtotime($week_start . $i . " day"));
        $weekStart[] = date('M d Y', strtotime($week_start . $i . " day"));
        $weeks_month[] = date('M d', strtotime($week_start . $i . " day"));
        $weeks_day[] = date('d', strtotime($week_start . $i . " day"));
        $weeks_Day[] = date('D', strtotime($week_start . $i . " day"));
    }
    $emp = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'");
    foreach ($emp as $row) {
        $emp_nm[] = $row['fname'] . ' ' . $row['lname'];
    }
//    d($weeks);
//    d($weeks_month);
//    die;
    echo json_encode(array("weekStart" => $weekStart, "weeks" => $weeks, "weeks_month" => $weeks_month, "dayno" => $weeks_day, "dayname" => $weeks_Day, "emp_nm" => $emp));
    die;
}
$jsInclude = 'approve_timesheet_2.js.php';
_cg("page_title", "Timesheet");
//if (($_REQUEST[' car_modal']) != '') {
//        d($_REQUEST);
//        die;
//}

            