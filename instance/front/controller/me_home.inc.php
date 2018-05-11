<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}
//echo  helper::officeCond() . helper::OrderByDesc();
if (isset($_REQUEST['DivsDate'])) {


    $week_start = date('Y-m-d', strtotime('monday this week'));
    $week_end = date('Y-m-d', strtotime('sunday this week'));

    for ($i = 0; $i < 7; $i++) {
        $c = $i;
        $Days1 = strtotime("+" . $c . " days", strtotime($week_start));
        if (date('Y-m-d') > date('Y-m-d', strtotime($week_start . $i . "day"))) {

            $checkDate = date('Y-m-d', strtotime($week_start . $i . "day"));
            $GetShift = q("select * from tb_shift_time where DATE_FORMAT(created_at, '%Y-%m-%d') ='{$checkDate}' and user_id='{$_SESSION['user']['id']}'");
            $Result = "";
            if (empty($GetShift)) {
                $test = "Unscheduled";
            } else {
                foreach ($GetShift as $GetShiftRow) {


                    if ($GetShiftRow['status'] == 0) {
                        $stat = "Pending";
                    } else if ($GetShiftRow['status'] == 1) {
                        $stat = "Approved";
                    } else if ($GetShiftRow['status'] == 2) {
                        $stat = "Declined";
                    } else {
                        $stat = "";
                    }

                    $Result .= '<div class="panel" style="border: #e89600 2px solid; height:100%"><div class="panel-body teal white-text testing">'
                            . '<span>' . $GetShiftRow['total_hours'] . '</span><br><span style="color: #e89600;">' . $stat . '</span><br><span>' . $GetShiftRow['start_time'] . '-' . $GetShiftRow['end_time'] . '</span><br><span>' . $GetShiftRow['break_time'] . ' break</span><br><span>' . $GetShiftRow['area_of_work'] . '</span></div></div>';
                    //$Result.="<span>".$totalhours."</span><br><span>".$stat."</span><br><span>".$GetShiftRow['start_time'].'-'.$GetShiftRow['end_time']."</span><br><span>".$GetShiftRow['break_time']." break</span><br><span>".$GetShiftRow['area_of_work']."</span><hr>";
                }
                $test = $Result;
            }
        } elseif (date('Y-m-d') == date('Y-m-d', strtotime($week_start . $i . "day"))) {

            $checkDate2 = date('Y-m-d', strtotime($week_start . $i . "day"));
            $GetShift2 = q("select * from tb_shift_time where DATE_FORMAT(created_at, '%Y-%m-%d') = '{$checkDate2}' and user_id='{$_SESSION['user']['id']}'");

            $Result2 = "";
            if (empty($GetShift2)) {
                $test = "Today";
            } else {
                foreach ($GetShift2 as $GetShiftRow2) {


                    //echo "{$startMinutes}min converts to {$d}d {$h}h {$m}m";

                    if ($GetShiftRow2['status'] == 0) {
                        $stat = "Pending";
                    } else if ($GetShiftRow2['status'] == 1) {
                        $stat = "Approved";
                    } else if ($GetShiftRow2['status'] == 2) {
                        $stat = "Declined";
                    } else {
                        $stat = "";
                    }

                    $Result2 .= '<div class="panel" style="border-color: #e89600;"><div class="card-panel teal white-text testing">'
                            . '<span>' . $GetShiftRow2['total_hours'] . '</span><br><span style="color: #e89600;">' . $stat . '</span><br><span>' . $GetShiftRow2['start_time'] . '-' . $GetShiftRow2['end_time'] . '</span><br><span>' . $GetShiftRow2['break_time'] . ' M break</span><br><span>' . $GetShiftRow2['area_of_work'] . '</span></div></div>';
                    //$Result2.="<span>".$m."m</span><br><span>".$stat."</span><br><span>".$GetShiftRow2['start_time'].'-'.$GetShiftRow2['end_time']."</span><br><span>".$GetShiftRow2['break_time']." break</span><br><span>".$GetShiftRow2['area_of_work']."</span><hr>";
                }
                $test = $Result2;
            }
        } else {
            $test = "Unpublished";
        }

        $status[] = $test;
        $weeks[] = date('m-d-Y', strtotime($week_start . $i . " day"));
        $weeks_month[] = date('D d M', strtotime($week_start . $i . " day"));
        $weeks_day[] = date('d', strtotime($week_start . $i . " day"));
        $weeks_Day[] = date('D', strtotime($week_start . $i . " day"));
    }


//    d($weeks);
//    d($weeks_month);
    echo json_encode(array("weeks" => $weeks, "weeks_month" => $weeks_month, "dayno" => $weeks_day, "dayname" => $weeks_Day, "status" => $status));
    die;
}
if (isset($_REQUEST['StartShift'])) {
    $shift = $_REQUEST['id'];
    if ($shift == 0) {
//        date_default_timezone_set('Asia/Kolkata');
        $_fields['user_id'] = $_SESSION['user']['id'];
        $_fields['start_time'] = date("h:ia");
        $_fields['progress'] = "Started";
        $_fields['sDate'] = date("Y-m-d");

        $LastId = qi("tb_shift_time", $_fields);
        if ($LastId > 0) {
            $fields = array();
            $fields['company_id'] = $_SESSION['user']['work_at'];
            $fields['emp_id'] = $_SESSION['user']['id'];
            $fields['log'] = " Shift Started At " . date("Y-m-d h:m:a");
            qi("tb_employee_log", $fields);
        }
        $_SESSION["shiftId"] = $LastId;
        $_SESSION["Timecount"] = $_fields['start_time'];
    } else if ($shift == 1) {
        date_default_timezone_set('Asia/Kolkata');
        $_fields['end_time'] = date("h:ia");

        $_fields['break_time'] = $_SESSION["break_time"];
        $_fields['progress'] = "Submitted";

        qu("tb_shift_time", $_fields, "id = '{$_SESSION["shiftId"]}'");
        $_SESSION["shiftId"] = "";
        $_SESSION["Timecount"] = "";
        $_SESSION["start_break"] = "";
        $_SESSION["end_break"] = "";
        $_SESSION["break_time"] = "";
    } else {
        
    }
    $value["starttime"] = $_fields['start_time'];
    $value["shift"] = $_SESSION["shiftId"];
    echo json_encode($value);
    die;
}
if (isset($_REQUEST['BreakShift'])) {
//    d($_REQUEST);
//    die;
    $shift = $_REQUEST['id'];
    if ($shift == 0) {
        date_default_timezone_set('Asia/Kolkata');
        $_SESSION["start_break"] = date("H:i");
        $_fields['start_break_time'] = date("Y-m-d h:i:s");

        qu("tb_shift_time", $_fields, "id = '{$_SESSION["shiftId"]}'");
        $test = 0;
    } else if ($shift == 1) {
        date_default_timezone_set('Asia/Kolkata');
        $getBreak = qs("select * from tb_shift_time where id='{$_SESSION["shiftId"]}'");
//        d($getBreak);


        $_SESSION["end_break"] = date("H:i");

        $_SESSION["break_time"] = ( strtotime($_SESSION["end_break"]) - strtotime($_SESSION["start_break"]) ) / 60;
        if ($getBreak['break_time'] == "") {
            $_fields['break_time'] = $_SESSION["break_time"];
        } else {
            $_fields['break_time'] = $_SESSION["break_time"] + $getBreak['break_time'];
        }
        $_fields['end_break_time'] = date("Y-m-d h:i:s");

        qu("tb_shift_time", $_fields, "id = '{$_SESSION["shiftId"]}'");

        $_SESSION["start_break"] = "";
        $_SESSION["end_break"] = "";
        $_SESSION["break_time"] = "";
        $test = "";
    } else {
        
    }

    $value["starttime"] = $_SESSION["Timecount"];
    $value["shift"] = $_SESSION["start_break"];

    echo json_encode($value);

    die;
}
if (isset($_REQUEST['AddShift'])) {

    $start_time = date("H:i", strtotime($_REQUEST['start_time']));
    $end_time = date("H:i", strtotime($_REQUEST['end_time']));
    
    $break_time = $_REQUEST['break_time'];
    $note = $_REQUEST['note'];

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
    if ($tot_min >= 15) {
        $error = 0;
        $_fields['start_time'] = $start_time;
        $_fields['end_time'] = $end_time;
        $_fields['break_time'] = $break_time;
        $_fields['note'] = $note;

        $start_time = $start_time; // pulled from DB
        $finish_time = $end_time; // pulled from DB
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

        $shift_u = qu("tb_shift_time", $_fields, "id = '{$_SESSION["shiftId"]}'");
        if ($shift_u > 0) {
            $fields = array();
            $fields['company_id'] = $_SESSION['user']['work_at'];
            $fields['emp_id'] = $_SESSION['user']['id'];
            $fields['log'] = " Shift Ended At " . date("Y-m-d h:m:a");
            qi("tb_employee_log", $fields);
        }

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
if (isset($_REQUEST['getShiftDetail'])) {
    //$id = $_REQUEST['id'];
    $UserData = qs("select id from tb_shift_time where user_id=" . $_SESSION['user']['id'] . " order by id desc");

    if ($_SESSION["shiftId"] == "" OR $_SESSION["shiftId"] == Null) {
        $id = $UserData['id'];
    } else {
        $id = $_SESSION["shiftId"];
    }

    $Data = qs("select * from tb_shift_time where id='$id'");


    date_default_timezone_set('Asia/Kolkata');
    $endvalue = date("h:ia");

    $start_time = $_SESSION["Timecount"]; // pulled from DB
    $finish_time = $endvalue; // pulled from DB
    $starttime = strtotime($start_time); // convert to timestring
    $endtime = strtotime($finish_time); // convert to timestring
    $diff = $endtime - $starttime; // do the math

    $total_breaks = strtotime($_SESSION["break_time"]); // pulled from DB
    $breaks = $total_breaks * 60; // minutes * seconds per minute
    $hours = ($diff - $breaks) / 60; // do the math converting seconds to hours

    $totalhours = $hours - $Data['break_time'];


    $d = floor($totalhours / 1440);
    $h = floor(($totalhours - $d * 1440) / 60);
    $m = $totalhours - ($d * 1440) - ($h * 60);

    if ($h == "" OR $h == null) {
        $time = "$m m";
    } else {
        $time = "$h h $m m";
    }


    echo json_encode(array("data" => $Data, "end_times" => $endvalue, "Hours" => $time));
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
$UserId = $_SESSION['user']['id'];
$ProfileData = qs("select * from tb_employee where id='$UserId'");


$jsInclude = 'me_home.js.php';
_cg("page_title", "Me Home");


