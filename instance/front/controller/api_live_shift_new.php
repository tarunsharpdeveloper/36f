<?php

$user_data = "";
$flag = "true";
//date_default_timezone_set('Asia/Kolkata');
//$timeZone = $_REQUEST['timezone'];
//date_default_timezone_set($timeZone);
$userId = $_REQUEST['userid'];
$shiftid = $_REQUEST['shiftid'];
$today = date('Y-m-d');
$yesterday = date('Y-m-d ', strtotime($today . "-1 days"));
$time = date("H:i");

$isShift = qs("SELECT * FROM tb_shift_time WHERE id='$shiftid'  ORDER BY  `tb_shift_time`.`created_at` DESC LIMIT 1 ");
$sdate = date("Y-m-d", strtotime($isShift['sDate']));
$start_time = date("Y-m-d ", strtotime($isShift['sDate'])) . " " . $isShift['start_time'];
$current_time = date('Y-m-d H:i');
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
    $data['BRIEFCASEOUT'] = is_null($data['BRIEFCASEOUT']) ? "" : $data['BRIEFCASEOUT'];
    //$meetingData['Meeting_' . $m] = array($data);
    $endTime = date_create($meeting_start[$i]['timestamp']);
    $startTime = date_create(is_null($data['BRIEFCASEOUT']) ? date("Y-m-d H:i:s") : $data['BRIEFCASEOUT']);

    $diffirenceTime = date_diff($endTime, $startTime);
    $data['total_time'] = str_pad($diffirenceTime->h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($diffirenceTime->i, 2, "0", STR_PAD_LEFT) . ":" . str_pad($diffirenceTime->s, 2, "0", STR_PAD_LEFT);
    $data['total_time'] = _ts($data['total_time']);

//    $data['total_time'] = $diffirenceTime->h . ":" . $diffirenceTime->i . ":" . $diffirenceTime->s;
    $meetingData[] = ($data);
    $m++;
}


/* lunch array start */
$lunch_start = q("select id,timestamp,type from tb_shift_check_inout where shiftid='$shiftid' and type='LUNCHIN' ");
$lunch_end = q("select id,timestamp,type from tb_shift_check_inout where shiftid='$shiftid' and type='LUNCHOUT'");
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
    //$meetingData['Meeting_' . $m] = array($data);
    $endTime = date_create($lunch_start[$i]['timestamp']);
    $startTime = date_create(is_null($data['lunch_break_end']) ? date("Y-m-d H:i:s") : $data['lunch_break_end']);

    $diffirenceTime = date_diff($endTime, $startTime);
    $data['lunch_break_total'] = str_pad($diffirenceTime->h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($diffirenceTime->i, 2, "0", STR_PAD_LEFT) . ":" . str_pad($diffirenceTime->s, 2, "0", STR_PAD_LEFT);
//    $data['lunch_break_total'] = $diffirenceTime->h . ":" . $diffirenceTime->i . ":" . $diffirenceTime->s;
    $lunchData[] = ($data);
    $m++;
}
/* lunch array end */



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
    if (isset($isShift['sDate']) && !empty($isShift['sDate'])) {
        $isShift['sDate'] = gtj_datetime($isShift['sDate']);
    }

    unset($isShift['lunch_break_total_1']);
    unset($isShift['lunch_break_total_2']);
    unset($isShift['lunch_break_total_3']);
    unset($isShift['area_of_work']);
    unset($isShift['break_time']);
    unset($isShift['briefcase']);
    unset($isShift['created_at']);
    unset($isShift['end_break_time']);
    unset($isShift['end_time']);
    unset($isShift['lat_clockend']);
    unset($isShift['lng_clockend']);
    unset($isShift['lat_clockstart']);
    unset($isShift['lng_clockstart']);
    unset($isShift['modified_at']);

    unset($isShift['note']);
    unset($isShift['progress']);
    unset($isShift['start_break_time']);
    unset($isShift['modified_at']);

    unset($isShift['lunch_break_end_1']);
    unset($isShift['lunch_break_end_2']);
    unset($isShift['lunch_break_end_3']);

    unset($isShift['lunch_break_start_1']);
    unset($isShift['lunch_break_start_2']);
    unset($isShift['lunch_break_start_3']);
    $fields['result'] = "success";
    $fields['is_started_shift'] = $flag;
    $fields['shiftData'] = $isShift;
//    $fields['shift_lapsed_time'] = $Formate;
//    $fields['shift_lapsed_tot_minutes'] = $totalTime;
//    $fields['shift_lapsed_hour_minute'] = $Hours . $Minutes;

    $to_time = strtotime($lastTime);
    $from_time = strtotime($current_time);

    $totalTime = round(abs($from_time - $to_time) / 60, 2);
    $fields['last_status'] = $lastStatus;
//    $fields['last_two_statuses'] = $lastTwoStatus;
//    $fields['firstCheckIN'] = gtj_datetime($firstCheckIN);
//    $fields['firstCheckINStatus'] = $firstCheckINStatus;
//    $fields['last_status_time'] = gtj_datetime($lastTime);
    //$fields['last_status_time'] = date("Y-m-d H:i", strtotime($lastTime));
//    $fields['last_status_time_stamp'] = strtotime($lastTime);
//    $fields['last_lapsed_tot_minutes'] = $totalTime;
    $fieldslunch = array();
    $fieldslunch['lunch_add'] = ($is_lunch['lunch_time_counted'] == 'yes' ? true : false);
//    $fields['lunch_donotadd'] = ($is_lunch['lunch_time_counted'] == 'yes' ? false : true);
    $fields['Meetings'] = $meetingData;
    $fields['Lunch'] = $lunchData;
    $fields['msg'] = "Live Shift Found";
    //Static Field 
    $fields['allow_intermediate_meetings_time'] = 'true';

    $totalTime = checkLunchTime($shiftid);
    /*
      if ($fields['lunch_add'] == false) {
      $hour = 0;
      $minute = 0;
      $second = 0;
      foreach ($lunchData as $value) {
      $lunchtime = explode(":", $value['lunch_break_total']);
      $hour = $hour + $lunchtime[0];
      $minute = $minute + $lunchtime[1];
      $second = $second + $lunchtime[2];
      }

      if ($second >= 60) {
      $minute = $minute + floor($second / 60);
      $second = $second % 60;
      }
      if ($minute >= 60) {
      $hour = $hour + floor($minute / 60);
      $minute = $minute % 60;
      }
      $lunchTime = $hour . ":" . $minute . ":" . $second;
      $first = new DateTime($totalTime);
      $second = new DateTime($lunchTime);
      $diff = $first->diff($second);
      $totalTime = $diff->h . ":" . $diff->i . ":" . $diff->s;
      }


      if ($fields['allow_intermediate_meetings_time'] == 'false') {
      $checkInOutTime = q("SELECT timestamp,type FROM `tb_shift_check_inout` WHERE `shiftid` = '$shiftid' order by id ");
      $hour = 0;
      $minute = 0;
      $second = 0;
      $outFlag = 0;
      foreach ($checkInOutTime as $key => $value) {
      if ($value['type'] == 'BRIEFCASEIN') {
      $outFlag = 1;
      if ($checkInOutTime[$key + 1]['timestamp'] != '') {
      $endTime = date_create($value['timestamp']);
      $startTime = date_create($checkInOutTime[$key + 1]['timestamp']);
      $diffirenceTime = date_diff($endTime, $startTime);
      $hour = $hour + $diffirenceTime->h;
      $minute = $minute + $diffirenceTime->i;
      $second = $second + $diffirenceTime->s;
      }
      }
      if ($value['type'] == 'LUNCHIN' && $outFlag == 1) {
      if ($checkInOutTime[$key + 1]['timestamp'] != '') {
      $endTime = date_create($value['timestamp']);
      $startTime = date_create($checkInOutTime[$key + 1]['timestamp']);
      $diffirenceTime = date_diff($endTime, $startTime);
      $hour = $hour + $diffirenceTime->h;
      $minute = $minute + $diffirenceTime->i;
      $second = $second + $diffirenceTime->s;
      }
      }
      if ($value['type'] == 'CHECKEDIN') {
      $outFlag = 0;
      }
      }
      if ($second >= 60) {
      $minute = $minute + floor($second / 60);
      $second = $second % 60;
      }
      if ($minute >= 60) {
      $hour = $hour + floor($minute / 60);
      $minute = $minute % 60;
      }
      $meetingTime = $hour . ":" . $minute . ":" . $second;
      $fields['total_time_between_meetings'] = $meetingTime;
      $first = new DateTime($totalTime);
      $second = new DateTime($meetingTime);
      $diff = $first->diff($second);
      $totalTime = $diff->h . ":" . $diff->i . ":" . $diff->s;
      }
     */
    $totalTime = calculateOT($shiftid, $totalTime, $fieldslunch['lunch_add']);

    $totalTime = explode(":", $totalTime);
    $fields['total_time'] = str_pad($totalTime[0], 2, "0", STR_PAD_LEFT) . ":" . str_pad($totalTime[1], 2, "0", STR_PAD_LEFT) . ":" . str_pad($totalTime[2], 2, "0", STR_PAD_LEFT);

    $fields['total_time'] = ($fields['total_time']);
    
    $startDate = date('Y-m-d', strtotime($isShift['sDate']));
    $shift_assign_data = qs("SELECT * FROM  `tb_assign_shift` WHERE  `user_id` ='{$isShift['user_id']}' AND  `start_date` LIKE  '{$startDate}%'");
    $total_shift_time = explode(":", $shift_assign_data['total_hour']);
    $fields['total_shift_time'] = str_pad($total_shift_time[0], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[1], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[2], 2, "0", STR_PAD_LEFT);
    //Over Time Logic Strat

    $fields['total_shift_time']= _ts($fields['total_shift_time']);
    
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
    $LastCheckIN = q("SELECT timestamp,type FROM tb_shift_check_inout WHERE shiftid='{$isShift['id']}' ORDER BY id DESC LIMIT 0,3 ");

    $fields['last_clock_status'] = $LastCheckIN[3]['type'] == 'BRIEFCASEOUT' || $LastCheckIN[3]['type'] == 'BRIEFCASEIN' ? 'briefcase' : 'clock';
    //Over Time Logic End
    $fields['total_time'] = _ts($fields['total_time']);
    $fields['current_time_stamp_utc'] = time();
    echo _api_response($fields);
} else {
    $fields = array();
    $fields['result'] = "error";
    $fields['is_started_shift'] = "false";
    $fields['shiftData'] = "-1";
    $fields['shift_lapsed_time'] = "-1";
    $fields['shift_lapsed_tot_minutes'] = "-1";
    $fields['shift_lapsed_hour_minute'] = "-1";
    $fields['current_time_stamp_utc'] = time();
    $fields['msg'] = "Live Shift Not Found";
    echo _api_response($fields);
}

die;
?>