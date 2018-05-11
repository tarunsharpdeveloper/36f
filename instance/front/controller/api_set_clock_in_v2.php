<?php

// requirement documenbt 
// https://docs.google.com/document/d/13KC8GxZ88lJvYSHUBhxrsaJhlA0XzNcSYUrUfAiqo3Y/edit
if (isset($_REQUEST['doc_helper'])) {
    include _PATH . "instance/front/controller/api_set_clock_in_doc_helper.php";
    die;
}

$user_id = _e($_REQUEST['user_id'], 0);
$user_lat = $_REQUEST['user_lat'];
$user_lng = $_REQUEST['user_long'];
$current_time = time();

if (!$user_id) {
    $fields = array();
    $fields['result'] = "error";
    $fields['msg'] = "INVALID_USER_ID";
    echo _api_response($fields);
    die;
}

# please check if user does have the published shift
$hasShift = shift::has_published_shift($user_id);
$hasOnDemandShift = shift::has_on_demand_shift($user_id);

if (!empty($hasOnDemandShift)) {
    # man, if we have unpublished shift - in progress - just take that. 
    # no need to create a new one or other cases.
    $shift_id = $hasOnDemandShift['id'];
    include _PATH . "instance/front/controller/api_set_clock_in_v2_live_shift.php";
    die;
} else if (!empty($hasShift)) {

    # if user does have the shift - then please return the duration of the shift and shift id
    # now, please check if user has started the shift or need to start
    $has_checked_in = shift::has_started_shift($hasShift['id']);

    if (!empty($has_checked_in)) {
        # user already checked in - so this is second time checkin
        # like user went for meeting and then came back to office
        $shift_id = $has_checked_in['id'];
        include _PATH . "instance/front/controller/api_set_clock_in_v2_live_shift.php";
        die;
    } else {
        # okay - so this is the first time 
        # Lets get the shift started $briefcase == 1 ? "BRIEFCASEOUT" : "CHECKEDIN";
        $check_in_status = $briefcase == 1 ? "BRIEFCASEOUT" : "CHECKEDIN";
        $shift_id = shift::start_shift($user_id, $user_lat, $user_lng, $check_in_status, $hasShift['id']);

        # now add a second entry into child table
        shift::log_shift_entry($user_id, $shift_id, $check_in_status, $user_lat, $user_lng, $briefcase);
        $fields = array();
        $fields['shift_id'] = $shift_id;
        $fields['total_assigned_shift_duration'] = shift::hisToSeconds($hasShift['total_hour']);
        echo _api_response($fields);
        die;
    }
} else {
    # ONDEMAND SHIFT SCENARIO
    # user doesn't have the shift and he wants to clock in/ start the meeting
    # okay - so this is the first time 
    # Lets get the shift started $briefcase == 1 ? "BRIEFCASEOUT" : "CHECKEDIN";
    $check_in_status = $briefcase == 1 ? "BRIEFCASEOUT" : "CHECKEDIN";
    $shift_id = shift::start_shift($user_id, $user_lat, $user_lng, $check_in_status, "-1");

    # now add a second entry into child table
    shift::log_shift_entry($user_id, $shift_id, $check_in_status, $user_lat, $user_lng, $briefcase);

    $fields = array();
    $fields['total_assigned_shift_duration'] = 0;
    $fields['shift_id'] = $shift_id;
    echo _api_response($fields);
    die;
}


die;
?>
