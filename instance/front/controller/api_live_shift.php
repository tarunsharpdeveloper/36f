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
//d($isShift);`
//die;
$sdate = date("Y-m-d", strtotime($isShift['sDate']));
$start_time = date("Y-m-d ", strtotime($isShift['sDate'])) . " " . $isShift['start_time'];
$current_time = date('Y-m-d H:i');
//die;
$LastCheckIN = q("SELECT timestamp,type FROM tb_shift_check_inout WHERE shiftid='{$isShift['id']}' ORDER BY id DESC LIMIT 0,2 ");
$lastTime = $LastCheckIN['0']['timestamp'];
$lastStatus = $LastCheckIN['0']['type'];
//$lastStatus = $isShift['shift_status'];
$lastTwoStatus = $LastCheckIN['0']['type'];

if (isset($LastCheckIN['1'])) {
    $lastTwoStatus = $LastCheckIN['1']['type'] . "_" . $LastCheckIN['0']['type'];
}

$firstCheckINData = qs("SELECT timestamp,type FROM tb_shift_check_inout WHERE shiftid='{$isShift['id']}' ORDER BY id ASC LIMIT 0,1 ");
$firstCheckIN = $firstCheckINData['timestamp'];
$firstCheckINStatus = $firstCheckINData['type'];

/*

  if ($isShift['shift_status'] == "CHECKEDIN" || $isShift['shift_status'] == "CHECKEDIN_R") {
  $LastCheckIN = qs("SELECT * FROM tb_shift_check_inout WHERE shiftid='{$isShift['id']}' and created_at>='{$isShift['created_at']}' and type='CHECKEDIN' ORDER BY sDate DESC, `tb_shift_check_inout`.`created_at` DESC LIMIT 1 ");
  $lastTime = $LastCheckIN['timestamp'];
  $lastStatus = $isShift['shift_status'];
  } elseif ($isShift['shift_status'] == "BRIEFCASEIN") {
  $LastCheckIN = qs("SELECT * FROM tb_shift_check_inout WHERE shiftid='{$isShift['id']}' and created_at>='{$isShift['created_at']}' and type='BRIEFCASEIN' ORDER BY sDate DESC, `tb_shift_check_inout`.`created_at` DESC LIMIT 1 ");
  $lastTime = $LastCheckIN['timestamp'];
  $lastStatus = $isShift['shift_status'];
  } elseif ($isShift['shift_status'] == "TIMEOUTIN") {
  $LastCheckIN = qs("SELECT * FROM tb_shift_check_inout WHERE shiftid='{$isShift['id']}' and created_at>='{$isShift['created_at']}' and type='TIMEOUTIN' ORDER BY sDate DESC, `tb_shift_check_inout`.`created_at` DESC LIMIT 1 ");
  $lastTime = $LastCheckIN['timestamp'];
  $lastStatus = $isShift['shift_status'];
  } elseif ($isShift['shift_status'] == "CHECKEDOUT") {
  $LastCheckIN = qs("SELECT * FROM tb_shift_check_inout WHERE shiftid='{$isShift['id']}' and created_at>='{$isShift['created_at']}' and type='CHECKOUT' ORDER BY sDate DESC, `tb_shift_check_inout`.`created_at` DESC LIMIT 1 ");
  $flag = 'false';
  $lastTime = $LastCheckIN['timestamp'];
  $lastStatus = $isShift['shift_status'];
  } elseif ($isShift['shift_status'] == "BRIEFCASEOUT") {
  $LastCheckIN = qs("SELECT * FROM tb_shift_check_inout WHERE shiftid='{$isShift['id']}' and created_at>='{$isShift['created_at']}' and type='BRIEFCASEOUT' ORDER BY sDate DESC, `tb_shift_check_inout`.`created_at` DESC LIMIT 1 ");
  $lastTime = $LastCheckIN['timestamp'];
  $lastStatus = $isShift['shift_status'];
  } elseif ($isShift['shift_status'] == "TIMEOUTOUT") {
  $LastCheckIN = qs("SELECT * FROM tb_shift_check_inout WHERE shiftid='{$isShift['id']}' and created_at>='{$isShift['created_at']}' and type='TIMEOUTOUT' ORDER BY sDate DESC, `tb_shift_check_inout`.`created_at` DESC LIMIT 1 ");
  $lastTime = $LastCheckIN['timestamp'];
  $lastStatus = $isShift['shift_status'];
  } elseif ($isShift['shift_status'] == "LUNCHIN") {
  if (empty($isShift['lunch_break_start_2']) && empty($isShift['lunch_break_start_3']) && empty($isShift['lunch_break_end_1']) && empty($isShift['lunch_break_end_2']) && empty($isShift['lunch_break_end_3'])) {
  $lastTime = $isShift['lunch_break_start_1'];
  } else {
  if (empty($isShift['lunch_break_start_3']) && empty($isShift['lunch_break_end_2']) && empty($isShift['lunch_break_end_3'])) {
  $lastTime = $isShift['lunch_break_start_2'];
  } else {
  $lastTime = $isShift['lunch_break_start_3'];
  }
  }
  $LastCheckIN = qs("SELECT * FROM tb_shift_check_inout WHERE shiftid='{$isShift['id']}' and created_at>='{$isShift['created_at']}' and type='LUNCHIN' ORDER BY sDate DESC, `tb_shift_check_inout`.`created_at` DESC LIMIT 1 ");
  $lastTime = $LastCheckIN['timestamp'];
  $lastStatus = $isShift['shift_status'];

  } elseif ($isShift['shift_status'] == "SCHEDULED") {
  if (empty($isShift['lunch_break_end_2']) && empty($isShift['lunch_break_end_3'])) {
  $lastTime = $isShift['lunch_break_end_1'];
  } else {
  if (empty($isShift['lunch_break_end_3'])) {
  $lastTime = $isShift['lunch_break_end_2'];
  } else {
  $lastTime = $isShift['lunch_break_end_3'];
  }
  }
  $lastStatus = $isShift['shift_status'];
  } */

//d($isShift['shift_status']);
//$isHavingShift = qs("SELECT * FROM tb_shift_time WHERE id='$shiftid'  ORDER BY sDate DESC, `tb_shift_time`.`created_at` DESC LIMIT 1 ");
$meeting_start = q("select id,timestamp,type from tb_shift_check_inout where shiftid='$shiftid' and type='BRIEFCASEIN' ");
$meeting_end = q("select id,timestamp,type from tb_shift_check_inout where shiftid='$shiftid' and type='BRIEFCASEOUT'");
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
	$data['BRIEFCASEOUT'] = is_null($data['BRIEFCASEOUT']) ? "":$data['BRIEFCASEOUT'];
    //$meetingData['Meeting_' . $m] = array($data);
    $meetingData[] = ($data);
    $m++;
}
if (!empty($isShift)) {
    $is_lunch = qs("SELECT * from tb_employee_settings where emp_id='{$isShift['user_id']}'");
    $fields = array();

    $to_time = strtotime($start_time);
    $from_time = strtotime($current_time);
    $totalTime = round(abs($from_time - $to_time) / 60, 2);
    $total_hour = number_format(round($totalTime / 60, 2), 2, '.', '');
//    $Print = number_format(round($totalTime / 60, 2), 2, ':', '');
    $TH = explode(".", $total_hour);
    $Hours = $TH[0] . " H ";
    $Minutes = round(abs($TH[1] / 100 * 60)) . " M";
    $Formate = $TH[0] . ":" . round(abs($TH[1] / 100 * 60));

    $Formate = date('H:i', strtotime($Formate));
    if(isset($isShift['sDate']) && !empty($isShift['sDate'])){
        $isShift['sDate'] = gtj_datetime($isShift['sDate']);
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
    

    
    $fields['result'] = "success";
    $fields['is_started_shift'] = $flag;
    $fields['shiftData'] = $isShift;
    $fields['shift_lapsed_time'] = $Formate;
    $fields['shift_lapsed_tot_minutes'] = $totalTime;
    $fields['shift_lapsed_hour_minute'] = $Hours . $Minutes;
//    d($current_time);
//    d($lastTime);
    $to_time = strtotime($lastTime);
    $from_time = strtotime($current_time);
//    d($lastTime);
//    d($current_time);
    $totalTime = round(abs($from_time - $to_time) / 60, 2);
    $fields['last_status'] = $lastStatus;
    $fields['last_two_statuses'] = $lastTwoStatus;

    $fields['firstCheckIN'] = gtj_datetime($firstCheckIN);
    $fields['firstCheckINStatus'] = $firstCheckINStatus;

    $fields['last_status_time'] = gtj_datetime($lastTime);
    //$fields['last_status_time'] = date("Y-m-d H:i", strtotime($lastTime));
    $fields['last_status_time_stamp'] = strtotime($lastTime);
    $fields['last_lapsed_tot_minutes'] = $totalTime;
    $fields['lunch_add'] = ($is_lunch['lunch_time_counted'] == 'yes' ? true : false);
    $fields['lunch_donotadd'] = ($is_lunch['lunch_time_counted'] == 'yes' ? false : true);
    $fields['Meetings'] = $meetingData;
    $fields['msg'] = "Live Shift Found";
//    d($fields);
//    die;
    echo _api_response($fields);
} else {
    $fields = array();
    $fields['result'] = "error";
    $fields['is_started_shift'] = "false";
    $fields['shiftData'] = "-1";
    $fields['shift_lapsed_time'] = "-1";
    $fields['shift_lapsed_tot_minutes'] = "-1";
    $fields['shift_lapsed_hour_minute'] = "-1";

    $fields['msg'] = "Live Shift Not Found";
    echo _api_response($fields);
}

die;
?>