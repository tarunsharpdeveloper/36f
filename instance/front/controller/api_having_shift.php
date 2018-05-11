<?php

if (!is_ios()) {
    include _PATH . "instance/front/controller/api_having_shift_v2.php";
    return;
}
// test
$user_data = "";
$flag = "false";
$userId = _e($_REQUEST['id'], 0);
;
$time = date("H:i:s");
$time = strtotime($time);
$today = date("Y-m-d");
$isShift = qs("SELECT * FROM tb_assign_shift WHERE user_id='{$userId}' and start_date like '{$today}%'");

if (!empty($isShift)) {
    $isShift['start_time'] = strtotime($isShift['start_time']);
    $isShift['end_time'] = strtotime($isShift['end_time']);


    $is_lunch = qs("SELECT * from tb_employee_settings where emp_id='$userId'");
    if (($isShift['start_time']) < $time && ($isShift['end_time']) > $time) {
        $to_time = ($isShift['end_time']);
        $from_time = ($time);
        $totalTime = round(abs($to_time - $from_time) / 60, 2);
        $total_hour = number_format(round($totalTime / 60, 2), 2, '.', '');
        $TH = explode(".", $total_hour);
        $Hours = $TH[0] . " H ";
        $Minutes = round(abs($TH[1] / 100 * 60)) . " M";
        $fields = array();
        $fields['result'] = "error";
        $fields['is_current_shift_on'] = "true";
        $fields['is_shift_due_in_120_min'] = "false";
        $fields['shiftid'] = $isShift['id'];
        $fields['total_time_seconds'] = $totalTime * 60;
        $total_shift_time = explode(":", $isShift['total_hour']);
        $fieldsaa = array();
        $fieldsaa['total_shift_time'] = str_pad($total_shift_time[0], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[1], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[2], 2, "0", STR_PAD_LEFT);
        $fields['total_shift_time_timestamp'] = strtotime($fieldsaa['total_shift_time']);
        $fields['msg'] = "Shift was already started";
        if ($is_lunch['tolrance_timeIn'] == '') {
            $extendedtime = date("H:i:s", strtotime("+120 minutes", $isShift['start_time']));
        } else {
            $time = strtotime($is_lunch['tolrance_timeIn']) + $isShift['start_time'];
            $extendedtime = date("H:i:s", $time);
        }
        $extendedtime = date("H:i:s", strtotime("+120 minutes", $isShift['start_time']));
        if (strtotime($extendedtime) >= strtotime(date('H:i:s'))) {
            $fields['check_in_time_expired'] = "false";
        } else {
            $fields['check_in_time_expired'] = "true";
        }
//        $fields['check_in_time_limit'] = strtotime('02:00');
        $fields['start_shift_time'] = $isShift['start_time'];
        $fields['shift_check_in_time_limit_timestamp'] = strtotime(date('H:i', strtotime('+2 hours +1 minute', ($isShift['start_time']))));
        $fields['current_time_stamp_utc'] = time();

        $fields = _api_process_output($fields, 'having_shift');

        echo _api_response($fields);
        die;
    }
    if (($isShift['end_time']) < $time) {
        $to_time = ($isShift['end_time']);
        $from_time = ($time);
        $totalTime = round(abs($to_time - $from_time) / 60, 2);
        $total_hour = number_format(round($totalTime / 60, 2), 2, '.', '');
        $TH = explode(".", $total_hour);
        $Hours = $TH[0] . " H ";
        $Minutes = round(abs($TH[1] / 100 * 60)) . " M";
        $fields = array();
        $fields['result'] = "error";
        $fields['is_current_shift_on'] = "false";
        $fields['is_shift_due_in_120_min'] = "false";
        $fields['shiftid'] = $isShift['id'];
        $fields['total_time_seconds'] = $totalTime * 60;
        $total_shift_time = explode(":", $isShift['total_hour']);
        $fieldsaa = array();
        $fieldsaa['total_shift_time'] = str_pad($total_shift_time[0], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[1], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[2], 2, "0", STR_PAD_LEFT);
        $fields['total_shift_time_timestamp'] = strtotime($fieldsaa['total_shift_time']);
        $fields['msg'] = "Shift Time Out";
        $fields['check_in_time_expired'] = "false";
//        $fields['check_in_time_limit'] = strtotime('02:00');
        $fields['start_shift_time'] = ($isShift['start_time']);
        $fields['end_shift_time'] = ($isShift['end_time']);
        $fields['shift_check_in_time_limit_timestamp'] = strtotime(date('H:i', strtotime('+2 hours +1 minute', ($isShift['start_time']))));
        $fields['current_time_stamp_utc'] = time();
        $fields = _api_process_output($fields, 'having_shift');
        echo _api_response($fields);
        die;
    }
    if ($isShift['start_time'] > $time) {
        $to_time = ($isShift['start_time']);
        $from_time = ($time);
        $totalTime = round(abs($to_time - $from_time) / 60, 2);
        $total_hour = number_format(round($totalTime / 60, 2), 2, '.', '');
        $TH = explode(".", $total_hour);
        $Hours = $TH[0] . " H ";
        $Minutes = round(abs($TH[1] / 100 * 60)) . " M";
        if ($totalTime <= 120) {
            $fields = array();
            $fields['result'] = "success";
            $fields['is_current_shift_on'] = "true";
            $fields['is_shift_due_in_120_min'] = 'true';
            $fields['shiftid'] = $isShift['id'];
            $fields['total_time_seconds'] = $totalTime * 60;
            $total_shift_time = explode(":", $isShift['total_hour']);
            $fieldsaa = array();
            $fieldsaa['total_shift_time'] = str_pad($total_shift_time[0], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[1], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[2], 2, "0", STR_PAD_LEFT);
            $fields['total_shift_time_timestamp'] = strtotime($fieldsaa['total_shift_time']);
            $fields['msg'] = "Shift is Available";
            $fields['check_in_time_expired'] = "false";
            //$fields['check_in_time_limit'] = strtotime('02:00');
            $fields['start_shift_time'] = ($isShift['start_time']);
            $fields['end_shift_time'] = ($isShift['end_time']);
            $fields['shift_check_in_time_limit_timestamp'] = strtotime(date('H:i', strtotime('+2 hours +1 minute', ($isShift['start_time']))));
            $fields['current_time_stamp_utc'] = time();
            $fields = _api_process_output($fields, 'having_shift');
            echo _api_response($fields);

            die;
        } else {
            $fields = array();
            $fields['result'] = "error";
            $fields['is_current_shift_on'] = "true";
            $fields['is_shift_due_in_120_min'] = 'false';
            $fields['shiftid'] = $isShift['id'];

            $fields['total_time_seconds'] = $totalTime * 60;
            $total_shift_time = explode(":", $isShift['total_hour']);
            $fieldsaa = array();
            $fieldsaa['total_shift_time'] = str_pad($total_shift_time[0], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[1], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[2], 2, "0", STR_PAD_LEFT);
            $fields['total_shift_time_timestamp'] = strtotime($fieldsaa['total_shift_time']);
            $fields['msg'] = "Shift is too far";
            $fields['check_in_time_expired'] = "false";
//            $fields['check_in_time_limit'] = strtotime('02:00');
            $fields['start_shift_time'] = ($isShift['start_time']);
            $fields['end_shift_time'] = ($isShift['end_time']);
            $fields['shift_check_in_time_limit_timestamp'] = strtotime(date('H:i', strtotime('+2 hours +1 minute', ($isShift['start_time']))));
            $fields['current_time_stamp_utc'] = time();
            $fields = _api_process_output($fields, 'having_shift');
            echo _api_response($fields);
            die;
        }
    }
} else {
    $fields = array();
    $fields['result'] = "error";
    $fields['is_current_shift_on'] = "false";
    $fields['is_shift_due_in_120_min'] = "false";
    $Shift = qs("SELECT id FROM tb_assign_shift WHERE user_id='{$userId}'  order by id DESC limit 0,1");
    $fields['shiftid'] = $Shift['id'];

    //$total_shift_time = explode(":", $isShift['total_hour']);
    //$fieldsaa = array();
    //$fieldsaa['total_shift_time'] = str_pad($total_shift_time[0], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[1], 2, "0", STR_PAD_LEFT) . ":" . str_pad($total_shift_time[2], 2, "0", STR_PAD_LEFT);
    //$fields['total_shift_time_timestamp'] = strtotime($fieldsaa['total_shift_time']);

    $fields['msg'] = "Shift Not Available";
    $fields['check_in_time_expired'] = "false";
//    $fields['check_in_time_limit'] = strtotime('02:00');
    $fields['start_shift_time'] = strtotime('00:00:00');
    $fields['shift_check_in_time_limit_timestamp'] = strtotime('00:00:00');
    $fields['current_time_stamp_utc'] = time();
    $fields = _api_process_output($fields, 'having_shift', 'no_shift');
    echo _api_response($fields);
    die;
}

die;
?>