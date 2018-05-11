<?php

$fields = array();
$current_time = time();
switch ($_REQUEST['doc_helper']) {
    case "error":
        $fields['result'] = "error";
        $fields['msg'] = "INVALID_USER_ID";
        break;
    case "no_shift":
        $fields['result'] = "error";
        $fields['msg'] = "Shift Not Available";
        break;
    case "has_published_shift":
        $fields['current_time'] = $current_time;
        $fields['shift_start_time'] = $current_time + (60 * 60); //after one hour
        $fields['shift_checkin_max_time_limit'] = $current_time + (10 * 60 * 60);
        break;
    case "has_live_shift":
        $fields['shift_id'] = 1;
        $fields['total_assigned_shift_duration'] = shift::hisToSeconds('08:00:00');
        $fields['total_elapsed_time'] = $current_time - strtotime("-1 hour");
        $fields['last_status'] = 'CHECKEDIN';
        $fields['current_time'] = $current_time;
        break;
    case "has_live_shift_last_meeting":
        $fields['shift_id'] = 1;
        $fields['total_assigned_shift_duration'] = shift::hisToSeconds('08:00:00');
        $fields['total_elapsed_time'] = $current_time - strtotime("-1 hour");
        $fields['last_status'] = 'BRIEFCASEOUT';
        $fields['current_time'] = $current_time;
        $fields['total_current_meeting'] = 60 * 60;
        break;
    case "has_live_shift_last_lunch":
        $fields['shift_id'] = 1;
        $fields['total_assigned_shift_duration'] = shift::hisToSeconds('08:00:00');
        $fields['total_elapsed_time'] = $current_time - strtotime("-1 hour");
        $fields['last_status'] = 'LUNCHIN';
        $fields['current_time'] = $current_time;
        $fields['total_current_lunch'] = 60 * 60;
        break;
    default:
        $fields['result'] = "error";
        $fields['msg'] = "INVALID_USER_ID";
        break;
}

echo _api_response($fields);
die;
