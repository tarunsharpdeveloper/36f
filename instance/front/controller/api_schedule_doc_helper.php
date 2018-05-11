<?php

$fields = array();
$current_time = time();
switch ($_REQUEST['doc_helper']) {
    case "INVALID_START_DATE":
        $fields = array();
        $fields['result'] = "error";
        $fields['msg'] = "INVALID_START_DATE";
        break;

    case "GET_SCHEDULE":
        $return = array();

        $array = array();
        $array['name'] = _e($each_data['title'], "NORMAL_SHIFT");
        $array['location'] = _e($each_data['location'], "TEHRAN");
        $array['team_name'] = _e($each_data['team'], "MARKETING");
        $array['shift_start_date'] = _DigitsTopersian(_gj(strtotime("Today")));
        $array['shift_start_time'] = _tt(date("Y-m-d H:i:s", strtotime("Today")));
        $array['shift_end_date'] = _DigitsTopersian(_gj(strtotime($each_data['end_date'])));
        $array['shift_end_time'] = _tt(date("Y-m-d H:i:s", strtotime("{$each_data['end_date']} {$each_data['end_time']}")));
        $return[] = $array;

        $array = array();
        $array['name'] = _e($each_data['title'], "NORMAL_SHIFT");
        $array['location'] = _e($each_data['location'], "TEHRAN");
        $array['team_name'] = _e($each_data['team'], "MARKETING");
        $array['shift_start_date'] = _DigitsTopersian(_gj(strtotime("+1 Day")));
        $array['shift_start_time'] = _tt(date("Y-m-d H:i:s", strtotime("+1 Day")));
        $array['shift_end_date'] = _DigitsTopersian(_gj(strtotime("+1 Day")));
        $array['shift_end_time'] = _tt(date("Y-m-d H:i:s", strtotime("+1 Day")));
        $return[] = $array;

        $fields = array();
        $fields['success'] = "1";
        $fields['utc'] = time();
        $fields['shifts'] = $return;
        break;
}

echo _api_response($fields);
die;

