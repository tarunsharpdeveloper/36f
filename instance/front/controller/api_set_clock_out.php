<?php

if (!is_ios()) {
    include _PATH . "instance/front/controller/api_set_clock_out_v2.php";
    return;
}
$user_data = "";
$isShift = "";
$flag = "false";
$ShiftId = $_REQUEST['shiftid'];
$end_time = date('H:i:s');
$user_lat = $_REQUEST['user_lat'];
$user_long = $_REQUEST['user_long'];

if (empty($ShiftId) == FALSE && empty($end_time) == FALSE) {
    $isHavingShift = qs("SELECT * FROM tb_shift_time WHERE id='$ShiftId' and end_time is NULL ORDER BY sDate DESC, `tb_shift_time`.`created_at` DESC LIMIT 1 ");
    $is_lunch = qs("SELECT * from tb_employee_settings where emp_id='{$isHavingShift['user_id']}'");
    if (!empty($isHavingShift)) {
        $last_meetings_start = qs("select * from tb_shift_check_inout where shiftid='$ShiftId'  ORDER BY `tb_shift_check_inout`.`timestamp` DESC LIMIT 1 ");
        $in = date('Y-m-d H:i:s', strtotime($last_meetings_start['timestamp']));
        $sdate = date('Y-m-d', strtotime($last_meetings_start['sDate']));
        $Out = date('Y-m-d H:i:s', strtotime($sdate . " " . $end_time));
        if ($in > $Out) {
            $sdate = date('Y-m-d', strtotime($last_meetings_start['sDate']));
            $timestamp = date('Y-m-d H:i:s', strtotime($sdate . " " . $end_time . " +1 Day"));
        } else {
            $sdate = date('Y-m-d', strtotime($last_meetings_start['sDate']));
            $timestamp = date('Y-m-d H:i:s', strtotime($sdate . " " . $end_time));
        }
        if (!empty($timeout) || !empty($briefcase)) {
            $fields = array();
            $fields['user_id'] = $isHavingShift['user_id'];
            $fields['shiftid'] = $isHavingShift['id'];
            $fields['sDate'] = $sdate;
            if ($briefcase == "1") {
                $fields['timestamp'] = $timestamp;
                $fields['briefcase'] = "1";
                $fields['type'] = "BRIEFCASEIN";
                $fields['lat'] = $user_lat;
                $fields['lng'] = $user_long;
                $isShift = qi("tb_shift_check_inout", $fields);
                $fields = array();
                $fields['shift_status'] = "BRIEFCASEIN";
                $isShift = qu("tb_shift_time", $fields, "id='$ShiftId'");
            }
            if ($timeout == "1") {
                $lastCheck = qs("SELECT * FROM `tb_shift_check_inout` where shiftid='$ShiftId' ORDER BY `id`  DESC LIMIT 1");
                if ($lastCheck['type'] == "BRIEFCASEOUT") {
                    $fields['briefcase'] = "1";
                    $fields['type'] = "BRIEFCASEIN";
                    $fields['timestamp'] = $timestamp;
                    $fields['lat'] = $user_lat;
                    $fields['lng'] = $user_long;
                    $isShift = qi("tb_shift_check_inout", $fields);
                }
                $fields['briefcase'] = "0";
                $fields['timeout'] = "1";
                $fields['type'] = "TIMEOUTOUT";
                $fields['timestamp'] = $timestamp;
                $fields['lat'] = $user_lat;
                $fields['lng'] = $user_long;
                $isShift = qi("tb_shift_check_inout", $fields);

                $totalTime = checkLunchTime($isHavingShift['id']);
                if ($is_lunch['lunch_time_counted'] == 'yes') {
                    $lunchFlag = true;
                } else {
                    $lunchFlag = false;
                }
                $totalTime = calculateOT($isHavingShift['id'], $totalTime, $fieldslunch['lunch_add']);
                $totalTime = explode(":", $totalTime);
                $fields = array();
                $fields['end_time'] = date('H:i:s', strtotime($end_time));
                $fields['lat_clockend'] = $user_lat;
                $fields['lng_clockend'] = $user_long;
                $fields['break_time'] = $AllTimeBreaks;
                $fields['total_hours'] = str_pad($totalTime[0], 2, "0", STR_PAD_LEFT) . ":" . str_pad($totalTime[1], 2, "0", STR_PAD_LEFT) . ":" . str_pad($totalTime[2], 2, "0", STR_PAD_LEFT);
                $fields['shift_status'] = "TIMEOUTOUT";
                $isShift = qu("tb_shift_time", $fields, "id='$ShiftId'");
            }
        } else {
            $fields['user_id'] = $isHavingShift['user_id'];
            $fields['shiftid'] = $isHavingShift['id'];
            $fields['sDate'] = $sdate;
            $lastCheck = qs("SELECT * FROM `tb_shift_check_inout` where shiftid='$ShiftId' ORDER BY `id`  DESC LIMIT 1");
            if ($lastCheck['type'] == "BRIEFCASEOUT") {
                $fields['briefcase'] = "1";
                $fields['type'] = "BRIEFCASEIN";
                $fields['timestamp'] = $timestamp;
                $fields['lat'] = $user_lat;
                $fields['lng'] = $user_long;
                $isShift = qi("tb_shift_check_inout", $fields);
            }
            if ($lastCheck['type'] == "TIMEOUTIN") {
                $fields['timeout'] = "1";
                $fields['type'] = "TIMEOUTOUT";
                $fields['timestamp'] = $timestamp;
                $fields['lat'] = $user_lat;
                $fields['lng'] = $user_long;
                $isShift = qi("tb_shift_check_inout", $fields);
            }
            $fields = array();
            $fields['user_id'] = $isHavingShift['user_id'];
            $fields['shiftid'] = $isHavingShift['id'];
            $fields['sDate'] = $sdate;
            $fields['type'] = "CHECKOUT";
            $fields['timestamp'] = $timestamp;
            $fields['lat'] = $user_lat;
            $fields['lng'] = $user_long;
            $isShift = qi("tb_shift_check_inout", $fields);

            $totalTime = checkLunchTime($isHavingShift['id']);
            if ($is_lunch['lunch_time_counted'] == 'yes') {
                $lunchFlag = true;
            } else {
                $lunchFlag = false;
            }
            $totalTime = calculateOT($isHavingShift['id'], $totalTime, $fieldslunch['lunch_add']);
            $totalTime = explode(":", $totalTime);
            $fields = array();
            $fields['end_time'] = (date('H:i:s', strtotime($end_time)));
            $fields['lat_clockend'] = $user_lat;
            $fields['lng_clockend'] = $user_long;
            $fields['break_time'] = $AllTimeBreaks;
            $fields['total_hours'] = str_pad($totalTime[0], 2, "0", STR_PAD_LEFT) . ":" . str_pad($totalTime[1], 2, "0", STR_PAD_LEFT) . ":" . str_pad($totalTime[2], 2, "0", STR_PAD_LEFT);
            $fields['shift_status'] = "CHECKEDOUT";
            $isShift = qu("tb_shift_time", $fields, "id='$ShiftId'");
        }
    } else {
        $fields = array();
        $fields['result'] = "error";
        $fields['is_added'] = $flag;
        $fields['shiftid'] = $ShiftId;
        $fields['shift_status'] = $isHavingShift['shift_status'];
        $fields['msg'] = "Shift was alredy Checkout";
        $fields['total_time'] = '00:00:00';
        $fields['total_time_timestemp'] = strtotime('00:00:00');
        $fields['current_time_stamp_utc'] = time();
        echo _api_response($fields);
        die;
    }
}
$isHavingShift = qs("SELECT * FROM tb_shift_time WHERE id='$ShiftId'  ORDER BY sDate DESC, `tb_shift_time`.`created_at` DESC LIMIT 1 ");
if (!empty($isShift)) {
    $flag = "true";
    $fields = array();
    $fields['result'] = "success";
    $fields['is_added'] = $flag;
    $fields['shiftid'] = $ShiftId;
    $fields['lunch_add'] = ($is_lunch['lunch_time_counted'] == 'yes' ? true : false);
    $fields['lunch_donotadd'] = ($is_lunch['lunch_time_counted'] == 'yes' ? false : true);
    $fields['shift_status'] = $isHavingShift['shift_status'];
    $fields['msg'] = "Shift was Added";

    $meeting_start = q("select id,timestamp,type from tb_shift_check_inout where shiftid='$ShiftId' and type='BRIEFCASEIN' ");
    $meeting_end = q("select id,timestamp,type from tb_shift_check_inout where shiftid='$ShiftId' and type='BRIEFCASEOUT'");
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
    $shift_assign_data = qs("SELECT * FROM  `tb_assign_shift` WHERE  `id` ='{$isHavingShift['assign_shift_id']}'");
    if (!empty($shift_assign_data) && $shift_assign_data['total_hour'] != '-1') {
        $total_shift_time = explode(":", $shift_assign_data['total_hour']);
        $fields['total_shift_time'] = str_pad($total_shift_time[0], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[1], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[2], 2, "0", STR_PAD_LEFT);
        $fields['total_shift_time'] = _ts($fields['total_shift_time']);
    } else {
        $fields['total_shift_time'] = '-1';
    }
    if (!empty($shift_assign_data)) {
        $first = new DateTime($shift_assign_data['total_hour']);
        $second = new DateTime(checkLunchTime($ShiftId));
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


    /* lunch array start */
    $lunch_start = q("select id,timestamp,type from tb_shift_check_inout where shiftid='$ShiftId' and type='LUNCHIN' ");
    $lunch_end = q("select id,timestamp,type from tb_shift_check_inout where shiftid='$ShiftId' and type='LUNCHOUT'");
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
    $fields['total_time'] = _ts(checkLunchTime($ShiftId));
    $fields['current_time_stamp_utc'] = time();
    if ($isHavingShift['shift_status'] == 'TIMEOUTOUT' || $isHavingShift['shift_status'] == 'CHECKEDOUT') {
        if ($isHavingShift['assign_shift_id'] == '-1') {
            # Unique id
            $employees = qs("SELECT * From tb_employee where id='{$isHavingShift['user_id']}'");
            $company = qs("SELECT * FROM `tb_company_works` where id='{$employees['work_at']}'");

            $random_id = substr(md5(microtime()), rand(0, 26), 5);
            $unique_id = array();
            $unique_id[] = str_replace(" ", "_", $company['name']);
            $unique_id[] = str_replace(" ", "_", $employees['fname'] . "_" . $employees['lname']);
            $unique_id[] = strtotime(date('Y-m-d', strtotime($isHavingShift['sDate'])));
            $unique_id[] = $random_id;
            $unique_id = array_filter($unique_id);
            $unique_id = implode("_", $unique_id);

            $shift['unique_id'] = $unique_id;
            $shift['user_id'] = $isHavingShift['user_id'];
            $shift['start_date'] = date("Y-m-d", strtotime($isHavingShift['sDate']));
            $shift['start_time'] = $isHavingShift['start_time'];
            $shift['end_date'] = date("Y-m-d", strtotime($isHavingShift['sDate']));
            $shift['end_time'] = $isHavingShift['end_time'];
            $shift['area_of_work'] = $employees['location'];
            $shift['notes'] = 'UNPUBLISHED';
            $shift['total_hour'] = $isHavingShift['total_hours'];
            $currntShiftAss = array();
            $currntShiftAss['assign_shift_id'] = qi("tb_assign_shift", _escapeArray($shift));
            qu('tb_shift_time', _escapeArray($currntShiftAss), 'id=' . $isHavingShift['id']);
        }
    }

    echo _api_response($fields);
} else {
    $fields = array();
    $fields['result'] = "error";
    $fields['is_added'] = $flag;
    $fields['shiftid'] = $ShiftId;
    $fields['shift_status'] = $isHavingShift['shift_status'];
    $fields['msg'] = "Shift was not added";
    //static Data
    $fields['total_time'] = _ts('00:00:00');
    //$fields['total_time_timestemp'] = strtotime('00:00:00');
    $fields['current_time_stamp_utc'] = time();
    echo _api_response($fields);
}

die;
?>
