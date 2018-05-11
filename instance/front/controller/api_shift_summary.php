<?php

$user_data = "";
$flag = "true";
date_default_timezone_set('Asia/Kolkata');
$userId = $_REQUEST['userid'];
$shiftid = $_REQUEST['shiftid'];
$today = date('Y-m-d ');
$yesterday = date('Y-m-d ', strtotime($today . "-1 days"));
$time = date("H:i");
//$p = "SELECT * FROM tb_shift_time WHERE user_id='$userId' and sDate<='$today' and sDate>='$yesterday' and end_time is null  ORDER BY sDate DESC, `tb_shift_time`.`created_at` DESC LIMIT 1 ";
//$isShift = qs("SELECT * FROM tb_shift_time WHERE user_id='$userId' and sDate<='$today' and sDate>='$yesterday' and end_time is null ORDER BY sDate DESC, `tb_shift_time`.`created_at` DESC LIMIT 1 ");
$isShift = qs("SELECT * FROM tb_shift_time WHERE id='$shiftid'  ORDER BY  `tb_shift_time`.`created_at` DESC LIMIT 1 ");

$is_lunch = qs("SELECT * from tb_employee_settings where emp_id='{$isShift['user_id']}'");
if (!empty($isShift)) {
//d($isShift);
//die;
    $sdate = date("Y-m-d", strtotime($isShift['sDate']));
    $start_time = date("Y-m-d ", strtotime($isShift['sDate'])) . " " . $isShift['start_time'];
    $current_time = date('Y-m-d H:i');
//die;
//d($isShift['shift_status']);
//$isHavingShift = qs("SELECT * FROM tb_shift_time WHERE id='$shiftid'  ORDER BY sDate DESC, `tb_shift_time`.`created_at` DESC LIMIT 1 ");

    $Pass = array();

    $meeting_start = q("select id,timestamp,type from tb_shift_check_inout where shiftid='$shiftid' and type='BRIEFCASEIN' ");
    $meeting_end = q("select id,timestamp,type from tb_shift_check_inout where shiftid='$shiftid' and type='BRIEFCASEOUT'");
    $meeting = array();
    $meeting['Start'] = $meeting_start;
    $meeting['End'] = $meeting_end;
    $meetingData = array();
    $max = max(sizeof($meeting_start), sizeof($meeting_end));
    $m = "1";
    $meetingTotal = "0";

    for ($i = '0'; $i < $max; $i++) {
        $data = array();
        $data['BRIEFCASEIN'] = $meeting_start[$i]['timestamp'];
        $data['BRIEFCASEOUT'] = $meeting_end[$i]['timestamp'];
        if ($meeting_start[$i]['timestamp'] < $meeting_end[$i]['timestamp']) {
            $data['Total_Hour'] = countTime($meeting_start[$i]['timestamp'], $meeting_end[$i]['timestamp']);
            $meetingTotal = $meetingTotal + countTime($meeting_start[$i]['timestamp'], $meeting_end[$i]['timestamp']);
        } else {
            $data['Total_Hour'] = "00000";
            $meetingTotal = $meetingTotal + "0";
        }
        $meetingData['Meeting_' . $m] = $data;

        $m++;
    }
//d($meetingTotal);

    $meetingFormat = hourFormated($meetingTotal);
//d($meetingFormat);
    $Pass['meeting_TotalHour'] = $meetingFormat;

    if (empty($isShift['end_time'])) {
//    $isShift['end_time'] = date("Y-m-d", strtotime($isShift['sDate'])) . " " . date("H:i", strtotime(time()));
        $isShift['end_time'] = date('Y-m-d H:i');
    } else {
        $last_meetings_start = qs("select * from tb_shift_check_inout where shiftid='$shiftid'  ORDER BY `tb_shift_check_inout`.`timestamp` DESC LIMIT 1 ");
//  d($last_meetings_start);
        if ($last_meetings_start['type'] == "CHECKOUT" || $last_meetings_start['type'] == "TIMEOUTOUT") {
            $isShift['end_time'] = $last_meetings_start['timestamp'];
//        d($isShift['end_time']);
//        die;
        }
    }
//d($isShift['end_time']);
    $AllTimeBreaks = $isShift['lunch_break_total_1'] + $isShift['lunch_break_total_2'] + $isShift['lunch_break_total_3'];
    $lunchTimeFormate = hourFormated($AllTimeBreaks);
    $Pass['lunchBreak_TotalHour'] = $lunchTimeFormate;
    $start_time = date("Y-m-d ", strtotime($isShift['sDate'])) . " " . $isShift['start_time']; // pulled from DB
//$finish_time = date("Y-m-d H:i", strtotime($isShift['end_time']));
    $finish_time = date("Y-m-d H:i", strtotime($isShift['end_time']));

    $starttime = strtotime($start_time); // convert to timestring
    $endtime = strtotime($finish_time); // convert to timestring
    $diff = $endtime - $starttime; // do the math
//d($isShift['end_time']);
//d($start_time);
//d($finish_time);
//d("DIFF " . $diff);
//die;
    $hours = ($diff ) / 60; // do the math converting seconds to hours
    if ($is_lunch['lunch_time_counted'] == 'yes') {
        $totalhours = $hours - $AllTimeBreaks;
    } else {
        $totalhours = $hours;
    }
    $d = floor($totalhours / 1440);
    $h = floor(($totalhours - $d * 1440) / 60);
    $m = $totalhours - ($d * 1440) - ($h * 60);
    if ($h == "" OR $h == null) {
        $time = "$m m";
    } else {
        $time = "$h h $m m";
    }
}

if (!empty($isShift)) {

    if(isset($isShift['sDate']) && !empty($isShift['sDate'])){
        $isShift['sDate'] = gtj_datetime($isShift['sDate']);
    }
    if(isset($isShift['end_time']) && !empty($isShift['end_time'])){
        $isShift['end_time'] = gtj_datetime($isShift['end_time']);
    }
    if(isset($isShift['lunch_break_start_1']) && !empty($isShift['lunch_break_start_1'])){
        $isShift['lunch_break_start_1'] = gtj_datetime($isShift['lunch_break_start_1']);
    }
    if(isset($isShift['lunch_break_end_1']) && !empty($isShift['lunch_break_end_1'])){
        $isShift['lunch_break_end_1'] = gtj_datetime($isShift['lunch_break_end_1']);
    }
    if(isset($isShift['lunch_break_start_2']) && !empty($isShift['lunch_break_start_2'])){
        $isShift['lunch_break_start_2'] = gtj_datetime($isShift['lunch_break_start_2']);
    }
    if(isset($isShift['lunch_break_end_2']) && !empty($isShift['lunch_break_end_2'])){
        $isShift['lunch_break_end_2'] = gtj_datetime($isShift['lunch_break_end_2']);
    }
    if(isset($isShift['lunch_break_start_3']) && !empty($isShift['lunch_break_start_3'])){
        $isShift['lunch_break_start_3'] = gtj_datetime($isShift['lunch_break_start_3']);
    }
    if(isset($isShift['lunch_break_end_3']) && !empty($isShift['lunch_break_end_3'])){
        $isShift['lunch_break_end_3'] = gtj_datetime($isShift['lunch_break_end_3']);
    }
    
    $fields = array();
    $fields['result'] = "success";
    $fields['shiftData'] = $isShift;
    $fields['lunch_add'] = ($is_lunch['lunch_time_counted'] == 'yes' ? true : false);
    $fields['lunch_donotadd'] = ($is_lunch['lunch_time_counted'] == 'yes' ? false : true);
    $fields['work_total_minute'] = $totalhours;
    $fields['work_total_hours'] = $time;

    $fields['meetings_total_minute'] = $meetingTotal;
    $fields['meetings_total_hours'] = $meetingFormat;

    $fields['lunchbreak_total_minute'] = $AllTimeBreaks;
    $fields['lunchbreak_total_hours'] = $lunchTimeFormate;
    $fields['msg'] = "Shift Found";
//    d($fields);
//    die;
    echo _api_response($fields);
} else {
    $fields = array();
    $fields['result'] = "error";
//    $fields['is_started_shift'] = "false";
    $fields['shiftData'] = "-1";
    $fields['lunch_add'] = "-1";
    $fields['lunch_donotadd'] = "-1";
    $fields['work_total_minute'] = "-1";
    $fields['work_total_hours'] = "-1";

    $fields['meetings_total_minute'] = "-1";
    $fields['meetings_total_hours'] = "-1";

    $fields['lunchbreak_total_minute'] = "-1";
    $fields['lunchbreak_total_hours'] = "-1";
    $fields['msg'] = "Shift Not Found";
    echo _api_response($fields);
}

function hourFormated($total_minute) {
    $totalhours = $total_minute;
    $d = floor($totalhours / 1440);
    $h = floor(($totalhours - $d * 1440) / 60);
    $m = $totalhours - ($d * 1440) - ($h * 60);
    if ($h == "" OR $h == null) {
        $time = "$m m";
    } else {
        $time = "$h h $m m";
    }
    return $time;
}

function countTime($start, $end) {
    $starttime = strtotime($start); // convert to timestring
    $endtime = strtotime($end); // convert to timestring
    $diff = $endtime - $starttime; // do the math
    $hours = ($diff ) / 60;
    $totalhours = $hours;
    $d = floor($totalhours / 1440);
    $h = floor(($totalhours - $d * 1440) / 60);
    $m = $totalhours - ($d * 1440) - ($h * 60);
    if ($h == "" OR $h == null) {
        $time = "$m m";
    } else {
        $time = "$h h $m m";
    }
    return $hours;
}

die;
?>