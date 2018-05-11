<?php

for ($i = 1; $i < 72; $i++) {

    $date = date("Y-m-d", strtotime("+{$i} day", strtotime("-30 days")));

    $assign_data = array();
    $assign_data['user_id'] = _e($_REQUEST['user_id'],300);
    $assign_data['start_date'] = $date;
    $assign_data['start_time'] = '10:10:00';
    $assign_data['end_date'] = $date;
    $assign_data['end_time'] = '20:10:00';
    $assign_data['total_hour'] = '10:00:00';
    $assign_data['area_of_work'] = '12';

    $assign_id = qi("tb_assign_shift", $assign_data);

    $array = array();
    $array['user_id'] = _e($_REQUEST['user_id'],300);
    $array['sDate'] = "{$date} 00:00:00";
    $array['start_time'] = "10:10";
    $array['end_date'] = $date;
    $array['end_time'] = "20:10";
    $array['total_hours'] = "12 h";
    $array['status'] = "APPROVED";
    $array['shift_status'] = "CHECKEDOUT";
    $array['location'] = "Tehran";
    $array['team'] = "Marketing";
    $array['briefcase'] = "0";
    $array['timeout'] = "0";
    $array['is_holiday'] = "0";
    $array['holiday_id'] = "0";
    $array['holiday_farsi'] = "0";
    $array['is_abandon'] = "0";
    $array['is_weekend'] = shift::_is_weekend($date);
    $array['is_timeoff'] = "0";
    $array['timeoff_code'] = "0";
    $array['timeoff_farsi_text'] = "0";
    $array['total_pending_time'] = "0";
    $array['total_approved_time'] = mt_rand(28800, 38000);
    $array['pending_ot'] = "0";
    $array['approved_ot'] = mt_rand(0, 10);
    $array['pending_bad_boy'] = "0";
    $array['approved_bad_boy'] = mt_rand(0, 10);
    $array['assign_shift_id'] = $assign_id;

    $random = mt_rand(1, 10);

    if ($random == 4) {
        $array['timeoff_code'] = "3";
        $array['timeoff_farsi_text'] = "مرخصی استعلاجی";
    }

    if ($random == 8) {
        $array['is_holiday'] = "1";
        $array['holiday_farsi'] = "نوروز‎";
    }

    if ($random == 3) {
        $array['is_abandon'] = "1";
        $array['start_time'] = "12:10";
    }

    if ($i > 60) {
        $array['status'] = "PENDING";
        $array['total_pending_time'] = mt_rand(28800, 32800);
        $array['total_approved_time'] = "0";
        $array['pending_ot'] = mt_rand(0, 100);
        $array['approved_ot'] = "0";
        $array['pending_bad_boy'] = mt_rand(0, 15);
        $array['approved_bad_boy'] = "00";
    }

    $shift_id = qi("tb_shift_time", $array);
}
