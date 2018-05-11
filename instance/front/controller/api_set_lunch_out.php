<?php

if (isset($_REQUEST['doc_helper'])) {
    include _PATH . "instance/front/controller/api_set_lunch_out_doc_helper.php";
    die;
}

#when they are going out for the lunch

$error = "";
$user_data = "";
$isShift = "";
$flag = "false";
$ShiftId = _e($_REQUEST['shiftid'],0);
$user_lat = $_REQUEST['user_lat'];
$user_long = $_REQUEST['user_long'];
$lunch_start = date("H:i:s");

if (!$ShiftId) {
    $fields = array();
    $fields['result'] = "error";
    $fields['msg'] = "INVALID_SHIFT_ID";
    echo _api_response($fields);
    die;
}
$isShift = qs("SELECT * FROM tb_shift_time WHERE id='$ShiftId'");

if (!empty($isShift)) {
    $last_meetings_start = qs("select * from tb_shift_check_inout where shiftid='$ShiftId'  ORDER BY `tb_shift_check_inout`.`timestamp` DESC LIMIT 1 ");
    $in = date('Y-m-d H:i:s', strtotime($last_meetings_start['timestamp']));
    $sdate = date('Y-m-d', strtotime($last_meetings_start['sDate']));
    $Out = date('Y-m-d H:i:s', strtotime($sdate . " " . $lunch_start));
    if ($in > $Out) {
        $sdate = date('Y-m-d', strtotime($last_meetings_start['sDate']));
        $timestamp = date('Y-m-d H:i:s', strtotime($sdate . " " . $lunch_start . " +1 Day"));
//            d($timestamp);
    } else {
        $sdate = date('Y-m-d', strtotime($last_meetings_start['sDate']));
        $timestamp = date('Y-m-d H:i:s', strtotime($sdate . " " . $lunch_start));
    }
    $fields = array();
    $fields['shift_status'] = "LUNCHOUT";
    $isShiftUpdate = qu("tb_shift_time", $fields, "id='$ShiftId'");
    $fields = array();

    $fields['user_id'] = $isShift['user_id'];
    $fields['shiftid'] = $isShift['id'];
    $fields['sDate'] = $sdate;
    $lastCheck = qs("SELECT * FROM `tb_shift_check_inout` where shiftid='$ShiftId' ORDER BY `id`  DESC LIMIT 1");
    if ($lastCheck['type'] == "BRIEFCASEIN") {
        $fields['briefcase'] = "1";
        $fields['type'] = "BRIEFCASEOUT";
        $fields['timestamp'] = $timestamp;
        $fields['lat'] = $user_lat;
        $fields['lng'] = $user_long;
        $isShift = qi("tb_shift_check_inout", $fields);
    }
    $fields['lat'] = $user_lat;
    $fields['lng'] = $user_long;
    $fields['timestamp'] = $timestamp;
    $fields['type'] = "LUNCHOUT";

    qi("tb_shift_check_inout", $fields);
}
$isShift = qs("SELECT * FROM tb_shift_time WHERE id='$ShiftId'");
if (!empty($isShiftUpdate)) {
    $is_lunch = qs("SELECT * from tb_employee_settings where emp_id='{$isShift['user_id']}'");
    $flag = "true";
    $fields = array();
    $fields['result'] = "success";
    //$fields['is_added'] = $flag;
    $fields['shiftid'] = $ShiftId;
    //$fields['lunch_add'] = ($is_lunch['lunch_time_counted'] == 'yes' ? true : false);
    //$fields['lunch_donotadd'] = ($is_lunch['lunch_time_counted'] == 'yes' ? false : true);
    //$fields['shift_status'] = $isShift['shift_status'];
    //$fields['total_time'] = _ts(checkLunchTime($ShiftId));
    //$fields['total_time_timestemp'] = strtotime($fields['total_time']);
    $fields['msg'] = "Lunch Time was Updated";
    //$fields['current_time_stamp_utc'] = time();
    echo _api_response($fields);
} else {

    $fields = array();
    $fields['result'] = "error";
    //$fields['is_added'] = $flag;
    //$fields['shiftid'] = $ShiftId;
    //$fields['shift_status'] = $isShift['shift_status'];
    //$fields['total_time'] = _ts(checkLunchTime($ShiftId));
    //$fields['total_time_timestemp'] = strtotime($fields['total_time']);
    if (!empty($error)) {
        $fields['msg'] = "Maximum Lunch Time Used";
    } else {
        $fields['msg'] = "Lunch Time was not Updated";
    }
    //$fields['current_time_stamp_utc'] = time();
    echo _api_response($fields);
}

die;
?>