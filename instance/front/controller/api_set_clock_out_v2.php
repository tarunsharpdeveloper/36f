<?php

// requirement document 
// https://docs.google.com/document/d/13KC8GxZ88lJvYSHUBhxrsaJhlA0XzNcSYUrUfAiqo3Y/edit
if (isset($_REQUEST['doc_helper'])) {
    include _PATH . "instance/front/controller/api_set_clock_out_doc_helper.php";
    die;
}

$shift_id = _e($_REQUEST['shiftid'], 0);

$user_lat = $_REQUEST['user_lat'];
$user_long = $_REQUEST['user_long'];

$user_id = shift::get_user_id_from_shift_id($shift_id);

if (!$shift_id) {
    $fields = array();
    $fields['result'] = "error";
    $fields['msg'] = "INVALID_SHIFT_ID";
    echo _api_response($fields);
    die;
}


if ($end_meeting_only) {
    # just end the meeting and return the summary
    shift::end_meeting($user_id, $shift_id, $user_lat, $user_long);
    $fields = array();
    $fields['shift_id'] = $shift_id;
    $fields['last_status'] = shift::get_shift_last_status($shift_id);
    $fields['current_time'] = $current_time;
    echo _api_response($fields);
    die;
}

# if we need to end the meeting and also the day
if ($end_meeting_and_day_also) {
    shift::end_meeting($user_id, $shift_id, $user_lat, $user_long);
    shift::end_day($user_id, $shift_id, $user_lat, $user_long,'BRIEFCASE');
    $summary = shift::get_summary($shift_id);
    shift::update_shift_times_after_end_day($shift_id);
    $fields['shift_id'] = $shift_id;
    $fields['logged_shift_summary'] = $summary;
    $fields['circle_data'] = _get_day_persian();
    echo _api_response($fields);
    die;
}

if ($end_day_normally) {
    shift::end_day($user_id, $shift_id, $user_lat, $user_long,'NORMAL');
    $summary = shift::get_summary($shift_id);
    shift::update_shift_times_after_end_day($shift_id);
    $fields['shift_id'] = $shift_id;
    $fields['logged_shift_summary'] = $summary;
    $fields['circle_data'] = _get_day_persian();
    echo _api_response($fields);
    die;
}
if ($end_day_by_timeout) {
    $summary = shift::get_summary($shift_id);
    shift::end_day($user_id, $shift_id, $user_lat, $user_long, 'TIMEOUT');
    shift::update_shift_times_after_end_day($shift_id);

    # 01/22/2018
    # Amir wanted a new feature for end day by timeout
    # for published shift only
    # if 9-5 is published shfit and user times out at 3 pm - we need to store - that 2 pm was not logged
    # later needs to be approved by manager
    # this is basically the timeoff module integration 
    # however, for now just a quick implementation
    shift::timeout_log_remaining_hours($user_id, $shift_id);


    $fields['shift_id'] = $shift_id;
    $fields['logged_shift_summary'] = $summary;
    $fields['circle_data'] = _get_day_persian();
    echo _api_response($fields);
    die;
}