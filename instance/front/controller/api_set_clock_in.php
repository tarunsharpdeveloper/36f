<?php

if (!is_ios()) {
    include _PATH . "instance/front/controller/api_set_clock_in_v2.php";
    return;
}


$user_data = "";
$isShift = "";
$flag = "false";
$user_id = _e($_REQUEST['user_id'], 0);
$start_time = date('H:i:s');
$sDate = date("Y-m-d");
$user_lat = $_REQUEST['user_lat'];
$user_long = $_REQUEST['user_long'];
$today = date('Y-m-d');
$yesterday = date('Y-m-d ', strtotime($today . "-1 days"));
$time = date("H:i:s");

if (!$user_id) {
    $fields = array();
    $fields['result'] = "error";
    $fields['msg'] = "INVALID_USER_ID";
    echo _api_response($fields);
    die;
}


if (empty($user_id) == FALSE && empty($start_time) == FALSE && empty($sDate) == FALSE) {
    $isHavingShift = qs("SELECT * FROM tb_shift_time WHERE user_id='$user_id' and sDate<='$sDate' and sDate>='$sDate' and end_time is NULL ORDER BY sDate DESC, `tb_shift_time`.`created_at` DESC LIMIT 1 ");

    if (empty($isHavingShift)) {
        $fields = array();
        $fields['user_id'] = $user_id;
        $fields['sDate'] = date('Y-m-d', strtotime($sDate));
        $fields['start_time'] = date('H:i:s');
        $fields['lat_clockstart'] = $user_lat;
        $fields['lng_clockstart'] = $user_long;
        $t = date('Y-m-d H:i:s', strtotime($sDate . " " . $start_time));
        $fields['shift_status'] = $briefcase == 1 ? "BRIEFCASEOUT" : "CHECKEDIN";
        $startDate = date('Y-m-d');

        $shift_assign_data = qs("SELECT * FROM  `tb_assign_shift` WHERE  `user_id` ='{$user_id}' AND  `start_date` LIKE  '{$startDate}%'");

        if ($shift_assign_data['id'] != '') {
            $fields['assign_shift_id'] = $shift_assign_data['id'];
        } else {
            $fields['assign_shift_id'] = '-1';
        }
        $isShift = qi("tb_shift_time", $fields);

        $isHavingShift = qs("SELECT * FROM tb_shift_time WHERE user_id='$user_id' and sDate<='$sDate' and sDate>='$sDate' and end_time is NULL ORDER BY sDate DESC, `tb_shift_time`.`created_at` DESC LIMIT 1 ");
        $fields = array();
        $fields['user_id'] = $user_id;
        $fields['shiftid'] = $isHavingShift['id'];
        $fields['sDate'] = date('Y-m-d', strtotime($sDate));
        $fields['lat'] = $user_lat;
        $fields['lng'] = $user_long;
        $fields['timestamp'] = date('Y-m-d H:i:s', strtotime($sDate . " " . $start_time));
        $fields['type'] = $briefcase == 1 ? "BRIEFCASEOUT" : "CHECKEDIN";
        $fields['briefcase'] = $briefcase == 1 ? "1" : "0";

        $isShift = qi("tb_shift_check_inout", $fields);
    } else {
        if (!empty($briefcase)) {
            $last_meetings_start = qs("select * from tb_shift_check_inout where shiftid='{$isHavingShift['id']}'  ORDER BY `tb_shift_check_inout`.`timestamp` DESC LIMIT 1 ");
            $in = date('Y-m-d H:i:s', strtotime($last_meetings_start['timestamp']));
            $sdate = date('Y-m-d', strtotime($last_meetings_start['sDate']));
            $Out = date('Y-m-d H:i:s', strtotime($sdate . " " . $start_time));
            if ($in > $Out) {
                $sdate = date('Y-m-d', strtotime($last_meetings_start['sDate']));
                $timestamp = date('Y-m-d H:i:s', strtotime($sdate . " " . $start_time . " +1 Day"));
            } else {
                $sdate = date('Y-m-d', strtotime($last_meetings_start['sDate']));
                $timestamp = date('Y-m-d H:i:s', strtotime($sdate . " " . $start_time));
            }

            $fields = array();
            $fields['user_id'] = $user_id;
            $fields['shiftid'] = $isHavingShift['id'];
            $fields['sDate'] = $sdate;
            if ($briefcase == "1") {
                $fields['briefcase'] = "1";
                $fields['type'] = "BRIEFCASEOUT";
            }
            $fields['timestamp'] = $timestamp;
            $fields['lat'] = $user_lat;
            $fields['lng'] = $user_long;
            $isShift = qi("tb_shift_check_inout", $fields);
            $fields = array();

            if ($briefcase == "1") {
                $fields['shift_status'] = "BRIEFCASEOUT";
            }
            qu("tb_shift_time", $fields, "id='{$isHavingShift['id']}'");
        } else {
            $last_meetings_start = qs("select * from tb_shift_check_inout where shiftid='{$isHavingShift['id']}'  ORDER BY `tb_shift_check_inout`.`timestamp` DESC LIMIT 1 ");

            $in = date('Y-m-d H:i:s', strtotime($last_meetings_start['timestamp']));
            $sdate = date('Y-m-d', strtotime($last_meetings_start['sDate']));
            $Out = date('Y-m-d H:i:s', strtotime($sdate . " " . $start_time));

            if ($in > $Out) {
                $sdate = date('Y-m-d', strtotime($last_meetings_start['sDate']));
                $timestamp = date('Y-m-d H:i:s', strtotime($sdate . " " . $start_time . " +1 Day"));
            } else {
                $sdate = date('Y-m-d', strtotime($last_meetings_start['sDate']));
                $timestamp = date('Y-m-d H:i:s', strtotime($sdate . " " . $start_time));
            }
            $fields = array();
            $fields['user_id'] = $user_id;
            $fields['shiftid'] = $isHavingShift['id'];
            $fields['sDate'] = $sdate;

            $fields['type'] = "CHECKEDIN";

            $fields['timestamp'] = $timestamp;
            $fields['lat'] = $user_lat;
            $fields['lng'] = $user_long;
            $isShift = qi("tb_shift_check_inout", $fields);
            $fields = array();

            $fields['shift_status'] = "CHECKEDIN";
            qu("tb_shift_time", $fields, "id='{$isHavingShift['id']}'");
        }
    }
}

if (!empty($isShift)) {
    $SDate = date('Y-m-d H:i:s', strtotime($sDate));
    $Shift = qs("SELECT * FROM tb_shift_time WHERE user_id='$user_id' and sDate='$SDate' and end_time is NULL ORDER BY `id` DESC LIMIT 1");
    $is_lunch = qs("SELECT * from tb_employee_settings where emp_id='$user_id'");

    $flag = "true";
    $fields = array();
    $fields['result'] = "success";
    $fields['is_added'] = $flag;
    $fields['shiftid'] = $Shift['id'];
    $fields['lunch_add'] = ($is_lunch['lunch_time_counted'] == 'yes' ? true : false);
    $fields['lunch_donotadd'] = ($is_lunch['lunch_time_counted'] == 'yes' ? false : true);
    $fields['shift_status'] = $Shift['shift_status'];
    $fields['msg'] = "Shift was Added";
    $shiftId = $Shift['id'];
    $checkShiftTime = q("SELECT timestamp FROM `tb_shift_check_inout` WHERE `shiftid` = '$shiftId' order by id ");

    if (count($checkShiftTime) == 1) {
        $fields['total_time'] = "00:00:00";
    } else {
        $fields['total_time'] = checkLunchTime($Shift['id']);
    }
    $totalTime = $fields['total_time'];
    $totalTime = calculateOT($shiftid, $totalTime, $fields['lunch_add']);
    $totalTime = explode(":", $totalTime);
    $fields['total_time'] = str_pad($totalTime[0], 2, "0", STR_PAD_LEFT) . ":" . str_pad($totalTime[1], 2, "0", STR_PAD_LEFT) . ":" . str_pad($totalTime[2], 2, "0", STR_PAD_LEFT);

    if (!empty($shift_assign_data)) {
        $total_shift_time = explode(":", $shift_assign_data['total_hour']);
        $fields['total_shift_time'] = str_pad($total_shift_time[0], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[1], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[2], 2, "0", STR_PAD_LEFT);
        $fields['total_shift_time'] = _ts($fields['total_shift_time']);
    } else {
        $fields['total_shift_time'] = '-1';
    }
    if (!empty($shift_assign_data)) {
        $first = new DateTime($shift_assign_data['total_hour']);
        $second = new DateTime($fields['total_time']);
        $diffirenceTime = $first->diff($second);
        if ($diffirenceTime->invert == 0) {
            $fields['is_shift_completed'] = true;
            $fields['ot_total_time'] = str_pad($diffirenceTime->h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($diffirenceTime->i, 2, "0", STR_PAD_LEFT) . ":" . str_pad($diffirenceTime->s, 2, "0", STR_PAD_LEFT);
        } else {
            $fields['is_shift_completed'] = false;
            $fields['ot_total_time'] = '00:00:00';
        }
        $fields['ot_total_time'] = _ts($fields['ot_total_time']);
    }
    $shiftId = $Shift['id'];
    $meeting_start = q("select id,timestamp,type from tb_shift_check_inout where shiftid='$shiftId' and type='BRIEFCASEIN' ");
    $meeting_end = q("select id,timestamp,type from tb_shift_check_inout where shiftid='$shiftId' and type='BRIEFCASEOUT'");
    $meeting = array();
    $meeting['Start'] = $meeting_start;
    $meeting['End'] = $meeting_end;
    $meetingData = array();
    $max = max(sizeof($meeting_start), sizeof($meeting_end));
    $m = "1";
    for ($i = '0'; $i < $max; $i++) {
        $data = array();
        $data['BRIEFCASEIN'] = gtj_datetime($meeting_start[$i]['timestamp']);
        $data['BRIEFCASEOUT'] = gtj_datetime($meeting_end[$i]['timestamp']);
        $data['BRIEFCASEOUT'] = is_null($data['BRIEFCASEOUT']) ? "" : $data['BRIEFCASEOUT'];
        $endTime = date_create($meeting_start[$i]['timestamp']);
        $startTime = date_create(is_null($data['BRIEFCASEOUT']) ? date("Y-m-d H:i:s") : $data['BRIEFCASEOUT']);
        $diffirenceTime = date_diff($endTime, $startTime);
        $data['total_time'] = str_pad($diffirenceTime->h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($diffirenceTime->i, 2, "0", STR_PAD_LEFT) . ":" . str_pad($diffirenceTime->s, 2, "0", STR_PAD_LEFT);
        $data['total_time'] = _ts($data['total_time']);
        $meetingData[] = ($data);
        $m++;
    }

    /* lunch array start */
    $lunch_start = q("select id,timestamp,type from tb_shift_check_inout where shiftid='$shiftId' and type='LUNCHIN' ");
    $lunch_end = q("select id,timestamp,type from tb_shift_check_inout where shiftid='$shiftId' and type='LUNCHOUT'");
    $lunch = array();
    $lunch['Start'] = $lunch_start;
    $lunch['End'] = $lunch_end;
    $lunchData = array();
    $max = max(sizeof($lunch_start), sizeof($lunch_end));
    $m = "1";
    for ($i = '0'; $i < $max; $i++) {
        $data = array();
        $data['lunch_break_start'] = gtj_datetime($lunch_start[$i]['timestamp']);
        $data['lunch_break_end'] = gtj_datetime($lunch_end[$i]['timestamp']);
        $data['lunch_break_end'] = is_null($data['lunch_break_end']) ? "" : $data['lunch_break_end'];
        $endTime = date_create($lunch_start[$i]['timestamp']);
        $startTime = date_create(is_null($data['lunch_break_end']) ? date("Y-m-d H:i:s") : $data['lunch_break_end']);
        $diffirenceTime = date_diff($endTime, $startTime);
        $data['lunch_break_total'] = str_pad($diffirenceTime->h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($diffirenceTime->i, 2, "0", STR_PAD_LEFT) . ":" . str_pad($diffirenceTime->s, 2, "0", STR_PAD_LEFT);
        $lunchData[] = ($data);
        $m++;
    }
    /* lunch array end */
    $fields['meeting'] = $meetingData;
    $fields['lunch'] = $lunchData;
    if (count($checkShiftTime) == 1) {
        $fields['total_time'] = "00:00:00";
    } else {
        $fields['total_time'] = _ts(checkLunchTime($Shift['id']));
    }
    $fields['total_time'] = _ts($fields['total_time']);
    $fields['current_time_stamp_utc'] = time();
    echo _api_response($fields);
} else {
    $fields = array();
    $fields['result'] = "error";
    $fields['is_added'] = $flag;
    $fields['shiftid'] = "-1";
    $fields['shift_status'] = "-1";
    $fields['msg'] = "Shift was not added";
    //static Data
    $fields['total_time'] = '00:00:00';
    $fields['current_time_stamp_utc'] = time();
    echo _api_response($fields);
}

die;
?>