<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}

if (isset($_REQUEST['callDaysHour'])) {
    $selectDate = $_REQUEST['selectDate'];
    $Hours = array();
    for ($i = 0; $i < 24; $i++) {
        if ((strlen($i)) <= 2) {
            $start_time = $i * 100;
            $startlen = $start_time;
            $start_time = round($start_time / 100, 2);
            $start_time = number_format($start_time, 2, ':', '');
        }
        if ($i == 0) {
            $Hours[$i] = date("H:i", strtotime($start_time));
        }
        $Hours[$i] = date("H:i", strtotime($start_time));
    }
//    d($Hours);
//    die;

    $emp = q("select id,fname,lname from tb_employee where work_at = '{$_SESSION['company']['id']}'");
    foreach ($emp as $row) {
        $emp_nm[] = $row['fname'] . ' ' . $row['lname'];
    }
//    d($weeks);
//    d($weeks_month);
//    die;
    echo json_encode(array("hours" => $Hours, "emp_nm" => $emp, "today" => $selectDate));
    die;
}
if (isset($_REQUEST['deleteShift'])) {
//    d($_REQUEST);
//    die;
    $shiftId = $_REQUEST['shiftId'];
//    d(qs("select  * from tb_assign_shift where id='$shiftId'"));
//    die;
    $st = qd("tb_assign_shift", "id='$shiftId'");
//    d($st);
    if ($st >= 1) {
        $success = "1";
        $msg = "Shift was Deleted!";
    } else {
        $success = "-1";
        $msg = "Shift Not Deleted!";
    }
    echo json_encode(array("success" => $success, "msg" => $msg));
    die;
}
if (isset($_REQUEST['updateShift'])) {

//    d($_REQUEST);
//    die;
    $success = "";
    $area_of_work = "";
    $shiftId = $_REQUEST["shiftId"];
    $start_time = $_REQUEST["start_time"];
    $end_time = $_REQUEST["end_time"];
    $location = $_REQUEST["location"];
    $deduction = $_REQUEST["deduction"];
    $shiftcolor = $_REQUEST["shiftcolor"];

    foreach ($location as $value) {
        $area_of_work .= $value . ',';
    }
    $area_of_work = rtrim($area_of_work, ',');
//    d($area_of_work);
//    die;
    if ((strlen($start_time)) <= 2) {
        $start_time = $start_time * 100;
        $startlen = $start_time;
        $start_time = round($start_time / 100, 2);
        $start_time = number_format($start_time, 2, ':', '');
    } else {
        $start_time = str_replace(":", "", $start_time);
//        $start_time = $start_time / 100;
        $startlen = $start_time;
        $start_time = round($start_time / 100, 2);
        $start_time = number_format($start_time, 2, ':', '');
    }
    if (strlen($end_time) <= 2) {
        $end_time = $end_time * 100;
        $endlen = $end_time;
        $end_time = round($end_time / 100, 2);
        $end_time = number_format($end_time, 2, ':', '');
    } else {
        $end_time = str_replace(":", "", $end_time);
//        $end_time = $end_time / 100;
        $endlen = $end_time;
        $end_time = round($end_time / 100, 2);
        $end_time = number_format($end_time, 2, ':', '');
    }

    $fields = array();
    $fields['shift_type_id'] = $_REQUEST["shifttype"];
    $fields["title"] = $_REQUEST["title"];
    $fields["start_time"] = date("H:i", strtotime($start_time));
    $fields["end_time"] = date("H:i", strtotime($end_time));
    $fields["start_date"] = $_REQUEST["start_date"];
    $fields["end_date"] = $_REQUEST["end_date"];
    $fields["total_hour"] = $_REQUEST["totalHour"];
    $fields["notes"] = _escapeArray($_REQUEST["note"]);
    $fields["area_of_work"] = $area_of_work;
    $fields["deduction"] = $deduction;
    $fields["shiftcolor"] = $shiftcolor;
//    d($fields);
    $st = qu("tb_assign_shift", $fields, "id='$shiftId'");
    if ($st >= 1) {
        $success = "1";
        $msg = "Shift was Updated";
    } else {
        $success = "-1";
        $msg = "Shift Not Updated";
    }
    echo json_encode(array("success" => $success, "msg" => $msg));
    die;
}
if (isset($_REQUEST['getStartDateWithDiff'])) {
//    OLD LOGIIC AS PER SAME AS HUMANITY
//    $endDate = $_REQUEST['endDate'];
//    $diff = $_REQUEST['diff'];
//    $diff = str_replace("+", "-", $diff);
//    $startDate = date("Y-m-d", strtotime($endDate . $diff));
//    echo json_encode($startDate);

    $endDate = $_REQUEST['endDate'];
    $startDate = $_REQUEST['startDate'];
    $start_time = $_REQUEST['startTime'];
    $end_time = $_REQUEST['endTime'];
    $shiftId = $_REQUEST['shiftID'];
    $userId = $_REQUEST['userID'];
//    d($start_time);
//    d($end_time);
    $isShift = q("SELECT * FROM tb_assign_shift WHERE not id='{$shiftId}' and user_id='$userId' and (start_date >= '$startDate' and start_date <= '$endDate') and (end_date >= '$startDate' and end_date <= '$endDate')");
//    d($isShift);
//    die;

    if ((strlen($start_time)) <= 2) {
        $start_time = $start_time * 100;
        $startlen = $start_time;
        $start_time = round($start_time / 100, 2);
        $start_time = number_format($start_time, 2, ':', '');
    } else {
        $start_time = str_replace(":", "", $start_time);
//        $start_time = $start_time / 100;
        $startlen = $start_time;
        $start_time = round($start_time / 100, 2);
        $start_time = number_format($start_time, 2, ':', '');
    }
    if (strlen($end_time) <= 2) {
        $end_time = $end_time * 100;
        $endlen = $end_time;
        $end_time = round($end_time / 100, 2);
        $end_time = number_format($end_time, 2, ':', '');
    } else {
        $end_time = str_replace(":", "", $end_time);
//        $end_time = $end_time / 100;
        $endlen = $end_time;
        $end_time = round($end_time / 100, 2);
        $end_time = number_format($end_time, 2, ':', '');
    }
    $strStart = date("Y-m-d H:i", strtotime($startDate . " " . $start_time));
    $strEnd = date("Y-m-d H:i", strtotime($endDate . " " . $end_time));


    $to_time = strtotime($strStart);
    $from_time = strtotime($strEnd);
    $totalTime = round(abs($to_time - $from_time) / 60, 2);
    $total_hour = number_format(round($totalTime / 60, 2), 2, '.', '');
//    d($strStart);
//    d($strEnd);
//    d($to_time);
//    d($from_time);
//    d($total_hour);
//    d($totalTime);
//    die;

    $HR = explode(".", $total_hour);
    $H = $HR[0];
    $min = round(abs(($HR[1] / 100) * 60));
    $TotalHr = $H . " H " . $min . " M";

    $start_date = date("Y-m-d", strtotime($startDate));
    $end_date = date("Y-m-d", strtotime($endDate));

    $date1 = date_create($start_date);
    $date2 = date_create($end_date);
    $diff = date_diff($date1, $date2);

    $isDay = $diff->format("%R%a");
    if ($isDay <= -1) {
        $isDay = $diff->format("%R%a");
    } else {
        $isDay = $diff->format("%a");
    }
    $diff = $diff->format("%R%a days");

//    d($isDay);
//    die;

    echo json_encode(array("TotalHr" => $TotalHr, "total_hour" => $total_hour, "endDate" => $endDate, "diff" => $diff, "isDays" => $isDay, "isShift" => $isShift));
//    echo json_encode($startDate);
    die;
}
if (isset($_REQUEST['getdateWithDiff'])) {
    $startDate = $_REQUEST['startDate'];
    $diff = $_REQUEST['diff'];
    $endDate = date("Y-m-d", strtotime($startDate . $diff));
//    d($endDate);
//    die;
    echo json_encode($endDate);
    die;
}
if (isset($_REQUEST['getEndTimeHoursDiff'])) {
    $start_time = $_REQUEST['start_time'];
    $end_time = $_REQUEST['end_time'];
    $diff = $_REQUEST['diff'];
    $startDate = $_REQUEST['startDate'];
    $endDate = $_REQUEST['endDate'];

    if ((strlen($start_time)) <= 2) {
        $start_time = $start_time * 100;
        $startlen = $start_time;
        $start_time = round($start_time / 100, 2);
        $start_time = number_format($start_time, 2, ':', '');
    } else {
        $start_time = str_replace(":", "", $start_time);
//        $start_time = $start_time / 100;
        $startlen = $start_time;
        $start_time = round($start_time / 100, 2);
        $start_time = number_format($start_time, 2, ':', '');
    }
    if (strlen($end_time) <= 2) {
        $end_time = $end_time * 100;
        $endlen = $end_time;
        $end_time = round($end_time / 100, 2);
        $end_time = number_format($end_time, 2, ':', '');
    } else {
        $end_time = str_replace(":", "", $end_time);
//        $end_time = $end_time / 100;
        $endlen = $end_time;
        $end_time = round($end_time / 100, 2);
        $end_time = number_format($end_time, 2, ':', '');
    }
//    if ($startDate >= $endDate) {
//        if ($startlen >= $endlen || $startlen == $endlen) {
//            $endDate = date("Y-m-d", strtotime($startDate . "+1 days"));
//        }
//    } else {
//        if ($startlen < $endlen) {
//            $endDate = date("Y-m-d", strtotime($endDate . "-1 days"));
//        }
//    }
    $strStart = $startDate . " " . $start_time;
    $strEnd = $endDate . " " . $end_time;


    $to_time = strtotime($strStart);
    $from_time = strtotime($strEnd);
    $totalTime = round(abs($to_time - $from_time) / 60, 2);
    $total_hour = number_format(round($totalTime / 60, 2), 2, '.', '');
//    d($total_hour);
//    d($endDate);
//    die;

    $HR = explode(".", $total_hour);
    $H = $HR[0];
    $min = round(abs(($HR[1] / 100) * 60));
    $TotalHr = $H . " H " . $min . " M";

    $start_date = date("Y-m-d", strtotime($startDate));
    $end_date = date("Y-m-d", strtotime($endDate));

    $date1 = date_create($start_date);
    $date2 = date_create($end_date);
    $diff = date_diff($date1, $date2);
    $diff = $diff->format("%R%a days");


    echo json_encode(array("TotalHr" => $TotalHr, "total_hour" => $total_hour, "endDate" => $endDate, "diff" => $diff));
    die;
}
if (isset($_REQUEST['getHoursWithDiff'])) {
    $start_time = $_REQUEST['start_time'];
//    $end_time = date("Y-m-d", strtotime($_REQUEST['end_time']));
    $diff = $_REQUEST['diff'];
//    $diff = number_format($diff, 2, '.', '');
    $df = explode(".", $diff);
    $diff = "+" . $df[0] . " hour +" . round(($df[1] / 100) * 60, 0) . " minutes";
//    d($df);
//    d(abs(($df[1] / 100) * 60));
//    $end_time = date('H:i', strtotime($start_time . '+1 hour +20 minutes'));
    if ((strlen($start_time)) <= 2) {
        $start_time = $start_time * 100;
        $startlen = $start_time;
        $start_time = round($start_time / 100, 2);
        $start_time = number_format($start_time, 2, ':', '');
    }
    $end_time = date('H:i', strtotime($start_time . $diff));

//    d($end_time);
//    die;

    echo json_encode($end_time);
    die;
}
if (isset($_REQUEST['GetShiftdata'])) {
    $shiftId = $_REQUEST['shiftId'];
//    $selecetdDate = $_REQUEST['date'];
//    d($_REQUEST);
//    die;
    $shift = qs("SELECT * FROM `tb_assign_shift` WHERE id = '$shiftId'");
//    d($shift);
    $start_date = date("Y-m-d", strtotime($shift['start_date']));
    $end_date = date("Y-m-d", strtotime($shift['end_date']));

    $date1 = date_create($start_date);
    $date2 = date_create($end_date);
    $diff = date_diff($date1, $date2);
    $diff = $diff->format("%R%a days");
    $shift["date_diff"] = $diff;


    $HR = explode(".", $shift['total_hour']);
    $H = $HR[0];
    $min = round(abs(($HR[1] / 100) * 60));
    $shift["TotalHr"] = $H . " H " . $min . " M";
    echo json_encode($shift);
    die;
}
if (isset($_REQUEST['eventCall'])) {
    $empId = $_REQUEST['id'];
    $selecetdDate = $_REQUEST['date'];
//    d($_REQUEST);
    $evnt = q("SELECT * FROM `tb_assign_shift` WHERE user_id = '$empId' and start_date = '$selecetdDate' ");
//    d($evnt);
//    die;
    echo json_encode($evnt);
    die;
}
if (isset($_REQUEST['updateAssignShift'])) {
//    d($_REQUEST);
//    die;
    $sep = explode("_", $_REQUEST['dateId']);
    $eventID = $_REQUEST['eventID'];
    $selecetdDate = $sep[0];
    $startDate = $selecetdDate;
    $endDate = $selecetdDate;

    $getevent = qs("select * from tb_assign_shift where id = '$eventID'");
    $getStartDT = date_create($getevent['start_date']);
    $getEndDT = date_create($getevent['end_date']);
    $diff = date_diff($getStartDT, $getEndDT);

    $getDiff = $diff->format("%R%a days");
    $endDate = date("Y-m-d", strtotime($startDate . $getDiff));
//    d($endDate);
//    die;

    $empId = $sep[1];
    $fields = array();
    $fields['user_id'] = $empId;

    $fields['start_date'] = $startDate;
    $fields['end_date'] = $endDate;

    $st1 = qu("tb_assign_shift", $fields, "id = '$eventID'");

    if (!empty($st1)) {
        $success = "1";
        $msg = "Shift Update Successfull";
    } else {
        $success = "0";
        $msg = "Shift Not Updated Successfull";
    }
    echo json_encode(array("success" => $success, "msg" => $msg));
    die;
}
if (isset($_REQUEST ['saveAssignShift'])) {
//    d($_REQUEST);
    $sep = explode("_", $_REQUEST['dateId']);
    $selecetdDate = $sep[0];
    $startDate = $selecetdDate;
    $endDate = $selecetdDate;
    $empId = $sep[1];
    $time = explode("-", $_REQUEST['time']);
    $start_time = $time[0];
    $end_time = $time[1];
    $startlen = "";
    $endlen = "";
    $isGreater = 0;
//    d($endlen);
    if ((strlen($start_time)) <= 2) {
        $start_time = $time[0] * 100;
        $startlen = $start_time;
        $start_time = round($start_time / 100, 2);
        $start_time = number_format($start_time, 2, ':', '');
    } else {
        $start_time = str_replace(": ", "", $start_time);
//        $start_time = $start_time / 100;
        $startlen = $start_time;
        $start_time = round($start_time / 100, 2);
        $start_time = number_format($start_time, 2, ':', '');
    }
    if (strlen($end_time) <= 2) {
        $end_time = $time[1] * 100;
        $endlen = $end_time;
        $end_time = round($end_time / 100, 2);
        $end_time = number_format($end_time, 2, ':', '');
    } else {
        $end_time = str_replace(": ", "", $end_time);
//        $end_time = $end_time / 100;
        $endlen = $end_time;
        $end_time = round($end_time / 100, 2);
        $end_time = number_format($end_time, 2, ':', '');
    }
    if ($startlen >= $endlen || $startlen == $endlen) {
        $endDate = date("Y-m-d", strtotime($startDate . "+1 days"));
    }
    $strStart = $startDate . " " . $start_time;
    $strEnd = $endDate . " " . $end_time;


    $to_time = strtotime($strStart);
    $from_time = strtotime($strEnd);
    $totalTime = round(abs($to_time - $from_time) / 60, 2);
    $total_hour = number_format(round($totalTime / 60, 2), 2, '.', '');
//        $dteStart = new DateTime($strStart);
//    $dteEnd = new DateTime($strEnd);
//    $dteDiff = $dteStart->diff($dteEnd);
//    $total_hour = $dteDiff->format("%H:%I");
    if ($total_hour >= 16) {
        $deduction = 16 * 55;
    } else {
        $deduction = $total_hour * 55;
    }

    $shifttypeID = qs("select id from tb_shift_type ORDER BY `tb_shift_type`.`id` ASC LIMIT 1 ");
    $fields = array();
    $fields['user_id'] = $empId;
    $fields['shift_type_id'] = $shifttypeID['id'];
    $fields['title'] = "";
    $fields['start_date'] = $startDate;
    $fields['start_time'] = date("H:i", strtotime($start_time));
    $fields['end_date'] = $endDate;
    $fields['end_time'] = date("H:i", strtotime($end_time));
    $fields['total_hour'] = $total_hour;
    $fields['deduction'] = $deduction;
    $fields["shiftcolor"] = "#A6D06E";

    $location = qs("select * from  tb_location where company_id='{$_SESSION['company']['id']}' and name='Main Office'");
//    $fields['location_id'] = $location['id'];
    $fields['area_of_work'] = $location['id'];
    $fields['notes'] = "";
    $st1 = qi("tb_assign_shift", $fields);
    if ($st1 >= 1) {
        $success = "1";
    } else {
        $success = "0";
    }
    $ShiftId = qs("select id from tb_assign_shift where user_id = '$empId' and start_date = '$startDate' and start_time = '$start_time' and end_date = '$endDate' and end_time = '$end_time' and total_hour = '$total_hour'");
//    d("select id from tb_assign_shift where user_id = '$empId' and start_date = '$startDate' and start_time = '$start_time' and end_date = '$endDate' and end_time = '$end_time' and total_hour = '$total_hour'");
//    d($ShiftId['id']);
//    die;
    echo json_encode(array("success" => $success, "startT" => $start_time, "endT" => $end_time, "ShiftId" => $ShiftId['id']));
//    $htm = "<span class = 'label label-success ui-widget-content filediv ui-icon ui-icon-document-b'>" . $start_time . "-" . $endDate . " </span>";
//    echo json_encode($htm);
    die;
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
if (isset($_REQUEST['BeforeDays'])) {
    $selectDate = $_REQUEST['selectDate'];
    $Dayjump = $_REQUEST['Dayjump'];

    $test = date('Y-m-d', strtotime($selectDate));
    $test = date('Y-m-d', strtotime($test . '-' . $Dayjump . ' days'));
    echo json_encode($test);
    die;
}
if (isset($_REQUEST['AfterDays'])) {
    $selectDate = $_REQUEST['selectDate'];
    $Dayjump = $_REQUEST['Dayjump'];

    $test = date('Y-m-d', strtotime($selectDate));
    $test = date('Y-m-d', strtotime($test . '+' . $Dayjump . ' days'));
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
//    d("Day Of the Week" . $s_day);
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
        $weeks_day[] = date('d', strtotime($week_start . $i . " day "));
        $weeks_Day[] = date('D', strtotime($week_start . $i . " day"));
    }
    $emp = q("select id,fname,lname from tb_employee where work_at = '{$_SESSION['company']['id']}'");
    foreach ($emp as $row) {
        $emp_nm[] = $row['fname'] . ' ' . $row['lname'];
    }

//    d($emp);
//    die;
    echo json_encode(array("weekStart" => $weekStart, "weeks" => $weeks, "weeks_month" => $weeks_month, "dayno" => $weeks_day, "dayname" => $weeks_Day, "emp_nm" => $emp));
    die;
}
if (isset($_REQUEST ['DivsDate2Week'])) {
    $selectDate = $_REQUEST ['selectDate'];
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
//    d("Day Of the Week" . $s_day);
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
        $weeks_month[] = date('M d', strtotime($week_start . $i . " day "));
        $weeks_day[] = date('d', strtotime($week_start . $i . " day"));
        $weeks_Day[] = date('D', strtotime($week_start . $i . " day"));
    }
    $emp = q("select id,fname,lname from tb_employee where work_at = '{$_SESSION['company']['id']}'");
    foreach ($emp as $row) {
        $emp_nm[] = $row['fname'] . ' ' . $row['lname'];
    }
//    d($weeks);
//    d($weeks_month);
//    die;
    echo json_encode(array("weekStart" => $weekStart, "weeks" => $weeks, "weeks_month" => $weeks_month, "dayno" => $weeks_day, "dayname" => $weeks_Day, "emp_nm" => $emp));
    die;
}
if (isset($_REQUEST ['DivsDate4Week'])) {
    $selectDate = $_REQUEST ['selectDate'];
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
//    d("Day Of the Week" . $s_day);
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
        $weeks_month[] = date('M d', strtotime($week_start . $i . " day "));
        $weeks_day[] = date('d', strtotime($week_start . $i . " day"));
        $weeks_Day[] = date('D', strtotime($week_start . $i . " day"));
    }
    $emp = q("select id,fname,lname from tb_employee where work_at = '{$_SESSION['company']['id']}'");
    foreach ($emp as $row) {
        $emp_nm[] = $row['fname'] . ' ' . $row['lname'];
    }
//    d($weeks);
//    d($weeks_month);
//    die;
    echo json_encode(array("weekStart" => $weekStart, "weeks" => $weeks, "weeks_month" => $weeks_month, "dayno" => $weeks_day, "dayname" => $weeks_Day, "emp_nm" => $emp));
    die;
}
$jsInclude = 'newschedule_2.js.php';
_cg("page_title", "newschedule");
//if (($_REQUEST [ ' car_modal']) != '') {
//        d($_REQUEST  );
//        die;
//}

            