<?php

# get the first checkin to calculate the total time elapsed
$first_check_in_timestamp = shift::get_first_checkin_time($shift_id);

# get the current time
$current_time = time();

#get the last status
$last_status = shift::get_shift_last_status($shift_id);

$summary = shift::get_summary($shift_id);
$fields = array();
$fields['shift_id'] = $shift_id;
$fields['total_assigned_shift_duration'] = shift::hisToSeconds($isShift['total_hour']);
$fields['total_elapsed_time'] = $current_time - strtotime($first_check_in_timestamp);
$fields['total_overtime'] = $summary['total_overtime'];
$fields['last_status'] = $last_status;
$fields['last_clock_status'] = shift::employee_in_office_or_metting($shift_id);
$fields['current_time'] = $current_time;

if ($last_status == 'BRIEFCASEOUT') {
    $total_current_meeting_time = shift::get_current_meeting_time($shift_id);
    $fields['total_current_meeting'] = $total_current_meeting_time;
}
if ($last_status == 'LUNCHOUT') {
    $total_current_lunch_time = shift::get_current_lunch_time($shift_id);
    $fields['total_current_lunch'] = $total_current_lunch_time;
}
$fields['shift_status'] = 'MID_SHIFT';
$fields['active_badge'] = mt_rand(0,99);

echo _api_response($fields);
die;
