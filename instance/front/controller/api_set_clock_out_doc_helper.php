<?php

$fields = array();
$current_time = time();
switch ($_REQUEST['doc_helper']) {
    case "error":
        $fields['result'] = "error";
        $fields['msg'] = "INVALID_SHIFT_ID";
        break;
    case "by_clock":
    case "by_bc":
    case "by_to":

        $fields['shift_id'] = 11;
        $fields['logged_shift_summary'] = array();
        $fields['logged_shift_summary']['date'] = time();
        $fields['logged_shift_summary']['start_time'] = $current_time - (8 * 60 * 60);
        $fields['logged_shift_summary']['end_time'] = $current_time;
        $fields['logged_shift_summary']['total_shift_logged_time'] = shift::hisToSeconds('08:00:00');
        $fields['logged_shift_summary']['total_lunch_time'] = shift::hisToSeconds('02:00:00');
        $fields['logged_shift_summary']['total_meeting_time'] = shift::hisToSeconds('03:00:00');
        //$fields['logged_shift_summary']['total_in_between_meetings_time'] = shift::hisToSeconds('00:10:00');
        //$fields['logged_shift_summary']['total_in_office_working_time'] = shift::hisToSeconds('00:11:00');
        $fields['logged_shift_summary']['total_published_shift_time'] = shift::hisToSeconds('00:20:00');
        $fields['logged_shift_summary']['total_overtime'] = shift::hisToSeconds('00:30:00');
        //$fields['logged_shift_summary']['total_late_arrival'] = shift::hisToSeconds('00:07:00');
//        $fields['logged_shift_summary']['total_early_departure'] = shift::hisToSeconds('00:15:00');
        $fields['logged_shift_summary']['total_bad_boy'] = shift::hisToSeconds('00:15:00');

        #todo
        /* $fields['logged_shift_summary']['late_arrival'] = shift::hisToSeconds('08:00:00');
          $fields['logged_shift_summary']['early_departure'] = shift::hisToSeconds('08:00:00');
          $fields['logged_shift_summary']['abandon'] = shift::hisToSeconds('08:00:00'); */

        /**
         *  Total ot
          Total meeting
          Total lunch
         *  Early departure 
         * late arrival
         */
        break;
    case "end_meeting":
        $fields['shift_id'] = 11;
        $fields['last_status'] = 'LUNCHIN';
        $fields['current_time'] = $current_time;
        break;
    case "set_message":
        $fields['msg'] = 'SUCCESS';
        break;
}

echo _api_response($fields);
die;

