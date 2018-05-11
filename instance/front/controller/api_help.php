<?php

$tile = strtolower(_e($_REQUEST['tile'], ''));

$shift_id = _e($_REQUEST['shift_id'], 0);


$return = array();

if ($shift_id) {
    $last_status = shift::get_shift_last_status($shift_id);
}

if ($tile == 'clock') {
    if ($shift_id == 0) {
        $return['message'] = "[2]";// clock - before clock in";
    } else {
        if ($last_status == "BRIEFCASEIN") {
            $return['message'] = "[6]";// clock - after period after";
        } else if ($last_status == "LUNCHOUT") {
            $return['message'] = "[4]";// clock - user at lunch";
        } else if ($last_status == "BRIEFCASEOUT") {
            $return['message'] = "[5]";// clock - user in meeting (bc button)";
        } else {
            $return['message'] = "[3]";// after clock in (during shift @ office)";
        }
    }
}

if ($tile == 'lunch') {
    if ($shift_id == 0) {
        $return['message'] = "[14]";// lunch - before user clocked in";
    } else {
        if ($last_status == "BRIEFCASEIN") {
            $return['message'] = "[18]";// lunch - period after";
        } else if ($last_status == "LUNCHOUT") {
            $return['message'] = "[16]";// lunch - during lunch";
        } else if ($last_status == "BRIEFCASEOUT") {
            $return['message'] = "[17]";// lunch - when user in meeting";
        } else {
            $return['message'] = "[15]";// lunch - after user clocked in";
        }
    }
}

if ($tile == 'briefcase') {
    if ($shift_id == 0) {
        $return['message'] = "[8]";// briefcase - before clock in/start shift";
    } else {
        if ($last_status == "BRIEFCASEIN") {
            $return['message'] = "[11]";// briefcase - period after";
        } else if ($last_status == "LUNCHOUT") {
            $return['message'] = "[12]";// briefcase - user at lunch ";
        } else if ($last_status == "BRIEFCASEOUT") {
            $return['message'] = "[10]";// briefcase - during meeting ";
        } else {
            $return['message'] = "[9]";// briefcase - after clocked in (via clock)";
        }
    }
}


if ($tile == 'timeout') {
    if ($shift_id == 0) {
        $return['message'] = "[20]";// timeout - before user starts shift/clocked in";
    } else {
        if ($last_status == "BRIEFCASEIN") {
            $return['message'] = "[23]";// timeout - period after";
        } else if ($last_status == "LUNCHOUT") {
            $return['message'] = "[21]";// timeout - when user is at lunch ";
        } else if ($last_status == "BRIEFCASEOUT") {
            $return['message'] = "[22]";// timeout - when user is in meeting ";
        } else {
            $return['message'] = "[24]";// timeout - when user is clocked in ";
        }
    }
}
_api_response($return);
