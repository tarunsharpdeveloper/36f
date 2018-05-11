<?php

$total_hour = '08:00:00';
$total_shift_time = '09:30:30';
$first = new DateTime($total_hour);
$second = new DateTime($total_shift_time);
$diffirenceTime = $first->diff($second);

if ($diffirenceTime->invert == 0) {
    $fields['is_shift_completed'] = true;
    $fields['ot_total_time'] = str_pad($diffirenceTime->h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($diffirenceTime->i, 2, "0", STR_PAD_LEFT) . ":" . str_pad($diffirenceTime->s, 2, "0", STR_PAD_LEFT);
} else {
    $fields['is_shift_completed'] = false;
    $fields['ot_total_time'] = '00:00:00';
}
die;
