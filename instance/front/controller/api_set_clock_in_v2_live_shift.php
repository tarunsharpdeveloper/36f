<?php

$last_status = shift::get_shift_last_status($shift_id);

$check_in_status = $briefcase == 1 ? "BRIEFCASEOUT" : "CHECKEDIN";
#just log the entry
shift::log_shift_entry($user_id, $shift_id, $check_in_status, $user_lat, $user_lng, $briefcase);

#for total elapsed time
$first_check_in_timestamp = shift::get_first_checkin_time($shift_id);


$summary = shift::get_summary($shift_id);

$fields = array();
$fields['shift_id'] = $shift_id;
$fields['total_assigned_shift_duration'] = shift::hisToSeconds($hasShift['total_hour']);
$fields['total_elapsed_time'] = $current_time - strtotime($first_check_in_timestamp);
$fields['total_overtime'] = $summary['total_overtime'];
$fields['last_status'] = $last_status;
$fields['current_time'] = $current_time;

echo _api_response($fields);
die;
