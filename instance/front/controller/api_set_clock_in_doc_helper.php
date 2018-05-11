<?php

$fields = array();
$current_time = time();
switch ($_REQUEST['doc_helper']) {
    case "error":
        $fields['result'] = "error";
        $fields['msg'] = "INVALID_USER_ID";
        break;
    case "has_shift":
        $fields['shift_id'] = 11;
        $fields['total_assigned_shift_duration'] = shift::hisToSeconds('08:00:00');
        break;
    case "no_published_shift":
        $fields['shift_id'] = 11;
        $fields['total_assigned_shift_duration'] = 0;
        break;
    case "period_after":
        $fields['shift_id'] = 11;
        $fields['total_assigned_shift_duration'] = 0;
        $fields['total_elapsed_time'] = $current_time - strtotime("-1 hour");
        $fields['total_overtime'] = shift::hisToSeconds('00:10:00');
        $fields['last_status'] = 'CHECKEDIN';
        $fields['current_time'] = $current_time;
        break;
    case "bc_has_shift":
        $fields['shift_id'] = 11;
        $fields['total_assigned_shift_duration'] = shift::hisToSeconds('08:00:00');
        break;
    case "bc_no_published_shift":
        $fields['shift_id'] = 11;
        $fields['total_assigned_shift_duration'] = 0;
        break;
    case "bc_period_after":
        $fields['shift_id'] = 11;
        $fields['total_assigned_shift_duration'] = 0;
        $fields['total_elapsed_time'] = $current_time - strtotime("-1 hour");
        $fields['total_overtime'] = shift::hisToSeconds('00:10:00');
        $fields['last_status'] = 'BRIEFCASEOUT';
        $fields['current_time'] = $current_time;
        break;
}

echo _api_response($fields);
die;

