<?php

if (isset($_REQUEST['doc_helper'])) {
    include _PATH . "instance/front/controller/api_set_lunch_in_doc_helper.php";
    die;
}

#when they have completed the lunch for the lunch

$error = "";
$user_data = "";
$isShift = "";
$flag = "false";
//$timeZone = $_REQUEST['timezone'];
//date_default_timezone_set($timeZone);
$ShiftId = $_REQUEST['shiftid'];
$lunch_end = date("H:i:s");
$user_lat = $_REQUEST['user_lat'];
$user_long = $_REQUEST['user_long'];

if (!$ShiftId) {
    $fields = array();
    $fields['result'] = "error";
    $fields['msg'] = "INVALID_SHIFT_ID";
    echo _api_response($fields);
    die;
}

$isShift = qs("SELECT * FROM tb_shift_time WHERE id='$ShiftId'");
if (!empty($isShift)) {
    $last_status = q("select * from tb_shift_check_inout where shiftid='$ShiftId'  ORDER BY `tb_shift_check_inout`.`timestamp` DESC LIMIT 0,2 ");
    $last_meetings_start = qs("select * from tb_shift_check_inout where shiftid='$ShiftId'  ORDER BY `tb_shift_check_inout`.`timestamp` DESC LIMIT 1 ");
    $in = date('Y-m-d H:i', strtotime($last_meetings_start['timestamp']));
    $sdate = date('Y-m-d', strtotime($last_meetings_start['sDate']));
    $Out = date('Y-m-d H:i', strtotime($sdate . " " . $lunch_end));
    if ($in > $Out) {
        $sdate = date('Y-m-d', strtotime($last_meetings_start['sDate']));
        $timestamp = date('Y-m-d H:i:s', strtotime($sdate . " " . $lunch_end . " +1 Day"));
    } else {
        $sdate = date('Y-m-d', strtotime($last_meetings_start['sDate']));
        $timestamp = date('Y-m-d H:i:s', strtotime($sdate . " " . $lunch_end));
    }
    $fields = array();

    $fields['shift_status'] = "LUNCHIN";
    $isShiftUpdate = qu("tb_shift_time", $fields, "id='$ShiftId'");
    $fields = array();
    $fields['user_id'] = $isShift['user_id'];
    $fields['shiftid'] = $isShift['id'];
    $fields['sDate'] = ($sdate);
    $fields['lat'] = $user_lat;
    $fields['lng'] = $user_long;
    $fields['timestamp'] = ($timestamp);
    $fields['type'] = "LUNCHIN";
    $isShiftUpdate = qi("tb_shift_check_inout", $fields);
}
if (!empty($isShiftUpdate)) {
    $is_lunch = qs("SELECT * from tb_employee_settings where emp_id='{$isShift['user_id']}'");
    $flag = "true";
    $fieldsCheck['lunch_add'] = ($is_lunch['lunch_time_counted'] == 'yes' ? true : false);

    $fields = array();
    $totalTime = checkLunchTime($ShiftId);
    $totalTime = calculateOT($ShiftId, $totalTime, $fieldsCheck['lunch_add']);
    $totalTime = explode(":", $totalTime);
    //$fields['total_time'] = str_pad($totalTime[0], 2, "0", STR_PAD_LEFT) . ":" . str_pad($totalTime[1], 2, "0", STR_PAD_LEFT) . ":" . str_pad($totalTime[2], 2, "0", STR_PAD_LEFT);
    $startDate = date('Y-m-d', strtotime($isShift['sDate']));
    $shift_assign_data = qs("SELECT * FROM  `tb_assign_shift` WHERE  `user_id` ='{$isShift['user_id']}' AND  `start_date` LIKE  '{$startDate}%'");

    $total_shift_time = explode(":", $shift_assign_data['total_hour']);
    //$fields['total_shift_time'] = str_pad($total_shift_time[0], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[1], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[2], 2, "0", STR_PAD_LEFT);
    //$fields['total_shift_time'] = _ts($fields['total_shift_time']);
    //Over Time Logic Strat

    if (!empty($shift_assign_data)) {
        $first = new DateTime($shift_assign_data['total_hour']);
        $second = new DateTime($fields['total_time']);
        $diffirenceTime = $first->diff($second);

        if ($diffirenceTime->invert == 0) {
            //$fields['is_shift_completed'] = true;
            //$fields['ot_total_time'] = str_pad($diffirenceTime->h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($diffirenceTime->i, 2, "0", STR_PAD_LEFT) . ":" . str_pad($diffirenceTime->s, 2, "0", STR_PAD_LEFT);
        } else {
           // $fields['is_shift_completed'] = false;
           // $fields['ot_total_time'] = '00:00:00';
        }
        //$fields['ot_total_time'] = _ts($fields['ot_total_time']);
    }
    //$fields['ot_total_time_timestemp'] = _ts(strtotime($fields['ot_total_time']));
    //$fields['result'] = "success";
    //$fields['is_added'] = $flag;
    $fields['shiftid'] = $ShiftId;
    //$fields['lunch_add'] = ($is_lunch['lunch_time_counted'] == 'yes' ? true : false);
    //$fields['lunch_donotadd'] = ($is_lunch['lunch_time_counted'] == 'yes' ? false : true);
//as per devloper requiremeint 
    //$fields['shift_status'] = "CHECKEDIN";
    //$fields['lunch_break'] = $timestamp;
    //$fields['lunch_break_timestemp'] = strtotime($timestamp);
    //$fields['total_time'] = _ts(checkLunchTime($ShiftId));
    //$fields['total_time_timestemp'] = strtotime($fields['total_time']);
    //$fields['last_status'] = $last_status[0]['type'] == 'BRIEFCASEOUT' || $last_status[0]['type'] == 'BRIEFCASEIN' ? 'briefcase' : 'clock';
    $fields['msg'] = "Lunch Time was Updated";
    $fields['current_time_stamp_utc'] = time();

    $current_time = time();
    $summary = shift::get_summary($ShiftId);
    #for total elapsed time
    $first_check_in_timestamp = shift::get_first_checkin_time($ShiftId);
    $fields['total_overtime'] = $summary['total_overtime'];
    $fields['last_status'] = shift::employee_in_office_or_metting($ShiftId);
    $fields['total_elapsed_time'] = $current_time - strtotime($first_check_in_timestamp);


    echo _api_response($fields);
} else {

    $fields = array();
    $fields['result'] = "error";
    $fields['is_added'] = $flag;
    $fields['shiftid'] = $ShiftId;
    $fields['shift_status'] = $isShift['shift_status'];
    $fields['lunch_break'] = "-1";
    $fields['total_time'] = _ts(checkLunchTime($ShiftId));
    //$fields['total_time_timestemp'] = strtotime($fields['total_time']);
    if (!empty($error)) {
        $fields['msg'] = "Maximum Lunch Time Used";
    } else {
        $fields['msg'] = "Lunch Time was not Updated";
    }
    $fields['current_time_stamp_utc'] = time();
    echo _api_response($fields);
}

die;
?>