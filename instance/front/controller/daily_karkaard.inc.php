<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}
if (isset($_REQUEST['lunch_setting_save'])) {
    $data = array();
    parse_str($_REQUEST['ladelData'], $data);
//    d($data);
//    die;
    if ($data['isUpdated'] == "yes") {
        $fields = array();
//        $fields['short_code'] = "LUNCH_DURATION";
        $fields['settings_type'] = "DAILY_KARKAARD_LUNCH";
        $fields['param_1'] = "";
        $fields['value_1'] = $data['rbtLunch'];
        if ($data['rbtLunch'] == "on") {
            $fields['value_2'] = $data['set_lunch_time'];
        }
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='LUNCH_DURATION' and settings_type='DAILY_KARKAARD_LUNCH' and company_id={$_SESSION['company']['id']}");

        $fields = array();
//        $fields['short_code'] = "LUNCH_DURATION";
        $fields['settings_type'] = "DAILY_KARKAARD_LUNCH";
        $fields['param_1'] = "";
        $fields['value_1'] = $data['rbtLunchTime'];
        if ($data['rbtLunchTime'] == "on") {
            $fields['value_2'] = $data['lunch_start_time'];
            $fields['value_3'] = $data['lunch_end_time'];
        }
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='LUNCH_SPECIFIC_TIME' and settings_type='DAILY_KARKAARD_LUNCH' and company_id={$_SESSION['company']['id']}");

        $fields = array();
//        $fields['short_code'] = "LUNCH_DEDUCTED";
        $fields['settings_type'] = "DAILY_KARKAARD_LUNCH";
        $fields['param_1'] = "";
        $fields['value_1'] = $data['rbtLunchdeduct'];

        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='LUNCH_DEDUCTED' and settings_type='DAILY_KARKAARD_LUNCH' and company_id={$_SESSION['company']['id']}");


        if (!empty($st1)) {
            $success = "1";
            $msg = "Congratulation! You have successfully Added DATA";
        } else {
            $success = "0";
            $msg = "Oops! Sorry Something Wrong.Try Again";
        }
    } else {
        $fields = array();
        $fields['short_code'] = "LUNCH_DURATION";
        $fields['settings_type'] = "DAILY_KARKAARD_LUNCH";
        $fields['param_1'] = "";
        $fields['value_1'] = $data['rbtLunch'];
        if ($data['rbtLunch'] == "on") {
            $fields['value_2'] = $data['set_lunch_time'];
        }
        $fields['company_id'] = $_SESSION['company']['id'];

        $st1 = qi("settings_leave_master", $fields);
        $fields = array();
        $fields['short_code'] = "LUNCH_SPECIFIC_TIME";
        $fields['settings_type'] = "DAILY_KARKAARD_LUNCH";
        $fields['param_1'] = "";
        $fields['value_1'] = $data['rbtLunchTime'];
        if ($data['rbtLunchTime'] == "on") {
            $fields['value_2'] = $data['lunch_start_time'];
            $fields['value_3'] = $data['lunch_end_time'];
        }
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qi("settings_leave_master", $fields);

        $fields = array();
        $fields['short_code'] = "LUNCH_DEDUCTED";
        $fields['settings_type'] = "DAILY_KARKAARD_LUNCH";
        $fields['param_1'] = "";
        $fields['value_1'] = $data['rbtLunchdeduct'];

        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qi("settings_leave_master", $fields);


        if (!empty($st1)) {
            $success = "1";
            $msg = "Congratulation! You have successfully Added DATA";
        } else {
            $success = "0";
            $msg = "Oops! Sorry Something Wrong.Try Again";
        }
    }
    echo json_encode(array("success" => $success, "msg" => $msg));
    die;
}
if (isset($_REQUEST['karkaard_save'])) {
    $data = array();
    parse_str($_REQUEST['ladelData'], $data);
//    d($data);
    if ($data['isUpdated'] == "yes") {
        $fields = array();
//        $fields['short_code'] = "DEFAULT_DAILY_KARKAARD";
        $fields['settings_type'] = "DAILY_KARKAARD_KASHRE";
        $fields['param_1'] = "";
        $fields['value_1'] = $data['default_kakaard'];
        $fields['value_2'] = $data['chkAllDefault'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='DEFAULT_DAILY_KARKAARD' and settings_type='DAILY_KARKAARD_KASHRE' and company_id={$_SESSION['company']['id']}");

        $fields = array();
//        $fields['short_code'] = "ILLNESS_EXTENDED";
        $fields['settings_type'] = "DAILY_KARKAARD_KASHRE";
        $fields['param_1'] = "";
        if ($data['rbtIllness'] == "off") {
            $fields['value_1'] = "CUSTOM";
            $fields['value_2'] = $data['txt_custome_illness'];
        } else {
            $fields['value_1'] = "AS_SHIFT";
            $fields['value_2'] = $data[""];
        }
        if ($data['rbtIllnessDeduct'] == "off") {
            $fields['value_3'] = "DONT_DEDUCT";
           
        } else {
            $fields['value_3'] = "DEDUCT";
          
        }
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='ILLNESS_EXTENDED' and settings_type='DAILY_KARKAARD_KASHRE' and company_id={$_SESSION['company']['id']}");
        $fields = array();
//        $fields['short_code'] = "TIMEOFF_WITHOUT_PAYMENT";
        $fields['settings_type'] = "DAILY_KARKAARD_KASHRE";
        $fields['param_1'] = "";
        if ($data['rbtTimeOff'] == "off") {
            $fields['value_1'] = "CUSTOM";
            $fields['value_2'] = $data['txt_custome_deduct'];
        } else {
            $fields['value_1'] = "AS_SHIFT";
        }
        if ($data['rbtTimeOffDeduct'] == "off") {
            $fields['value_3'] = "DONT_DEDUCT";
           
        } else {
            $fields['value_3'] = "DEDUCT";
          
        }
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='TIMEOFF_WITHOUT_PAYMENT' and settings_type='DAILY_KARKAARD_KASHRE' and company_id={$_SESSION['company']['id']}");

        $fields = array();
//        $fields['short_code'] = "SICK_TIME";
        $fields['settings_type'] = "DAILY_KARKAARD_KASHRE";
        $fields['param_1'] = "";
        if ($data['rbtSick'] == "off") {
            $fields['value_1'] = "CUSTOM";
            $fields['value_2'] = $data['txt_custome_sick'];
        } else {
            $fields['value_1'] = "AS_SHIFT";
        }
        if ($data['rbtSickDeduct'] == "off") {
            $fields['value_3'] = "DONT_DEDUCT";
           
        } else {
            $fields['value_3'] = "DEDUCT";
            
        }
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='SICK_TIME' and settings_type='DAILY_KARKAARD_KASHRE' and company_id={$_SESSION['company']['id']}");

        $fields = array();
//        $fields['short_code'] = "JOB_ABNDONMENT";
        $fields['settings_type'] = "DAILY_KARKAARD_KASHRE";
        $fields['param_1'] = "";
        if ($data['rbtJob'] == "off") {
            $fields['value_1'] = "CUSTOM";
            $fields['value_2'] = $data['txt_custome_job'];
        } else {
            $fields['value_1'] = "AS_SHIFT";
        }
        if ($data['rbtJobDeduct'] == "off") {
            $fields['value_3'] = "DONT_DEDUCT";
        } else {
            $fields['value_3'] = "DEDUCT";
        }
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='JOB_ABNDONMENT' and settings_type='DAILY_KARKAARD_KASHRE' and company_id={$_SESSION['company']['id']}");

        $fields = array();
//        $fields['short_code'] = "DAY_OFF_WITH_PAYMENT";
        $fields['settings_type'] = "DAILY_KARKAARD_KASHRE";
        $fields['param_1'] = "";
        if ($data['rbtDayoff'] == "off") {
            $fields['value_1'] = "CUSTOM";
            $fields['value_2'] = $data['txt_custome_dayoff'];
        } else {
            $fields['value_1'] = "AS_SHIFT";
        }
        if ($data['rbtDayoffDeduct'] == "off") {
            $fields['value_3'] = "DONT_DEDUCT";
           
        } else {
            $fields['value_3'] = "DEDUCT";
            
        }
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='DAY_OFF_WITH_PAYMENT' and settings_type='DAILY_KARKAARD_KASHRE' and company_id={$_SESSION['company']['id']}");

        if (!empty($st1)) {
            $success = "1";
            $msg = "Congratulation! You have successfully Updated DATA";
        } else {
            $success = "0";
            $msg = "Oops! Sorry Something Wrong.Try Again";
        }
    } else {
        $fields = array();
        $fields['short_code'] = "DEFAULT_DAILY_KARKAARD";
        $fields['settings_type'] = "DAILY_KARKAARD_KASHRE";
        $fields['param_1'] = "";
        $fields['value_1'] = $data['default_kakaard'];
        $fields['value_2'] = $data['chkAllDefault'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qi("settings_leave_master", $fields);

        $fields = array();
        $fields['short_code'] = "ILLNESS_EXTENDED";
        $fields['settings_type'] = "DAILY_KARKAARD_KASHRE";
        $fields['param_1'] = "";
        if ($data['rbtIllness'] == "off") {
            $fields['value_1'] = "CUSTOM";
            $fields['value_2'] = $data['txt_custome_illness'];
        } else {
            $fields['value_1'] = "AS_SHIFT";
        }
        if ($data['rbtIllnessDeduct'] == "off") {
            $fields['value_3'] = "DONT_DEDUCT";
        } else {
            $fields['value_3'] = "DEDUCT";
        }
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qi("settings_leave_master", $fields);

        $fields = array();
        $fields['short_code'] = "TIMEOFF_WITHOUT_PAYMENT";
        $fields['settings_type'] = "DAILY_KARKAARD_KASHRE";
        $fields['param_1'] = "";
        if ($data['rbtTimeOff'] == "off") {
            $fields['value_1'] = "CUSTOM";
            $fields['value_2'] = $data['txt_custome_deduct'];
        } else {
            $fields['value_1'] = "AS_SHIFT";
        }
        if ($data['rbtTimeOffDeduct'] == "off") {
            $fields['value_3'] = "DONT_DEDUCT";
        } else {
            $fields['value_3'] = "DEDUCT";
        }
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qi("settings_leave_master", $fields);

        $fields = array();
        $fields['short_code'] = "SICK_TIME";
        $fields['settings_type'] = "DAILY_KARKAARD_KASHRE";
        $fields['param_1'] = "";
        if ($data['rbtSick'] == "off") {
            $fields['value_1'] = "CUSTOM";
            $fields['value_2'] = $data['txt_custome_sick'];
        } else {
            $fields['value_1'] = "AS_SHIFT";
        }
        if ($data['rbtSickDeduct'] == "off") {
            $fields['value_3'] = "DONT_DEDUCT";
        } else {
            $fields['value_3'] = "DEDUCT";
        }
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qi("settings_leave_master", $fields);

        $fields = array();
        $fields['short_code'] = "JOB_ABNDONMENT";
        $fields['settings_type'] = "DAILY_KARKAARD_KASHRE";
        $fields['param_1'] = "";
        if ($data['rbtJob'] == "off") {
            $fields['value_1'] = "CUSTOM";
            $fields['value_2'] = $data['txt_custome_job'];
        } else {
            $fields['value_1'] = "AS_SHIFT";
        }
        if ($data['rbtJobDeduct'] == "off") {
            $fields['value_3'] = "DONT_DEDUCT";
        } else {
            $fields['value_3'] = "DEDUCT";
        }
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qi("settings_leave_master", $fields);

        $fields = array();
        $fields['short_code'] = "DAY_OFF_WITH_PAYMENT";
        $fields['settings_type'] = "DAILY_KARKAARD_KASHRE";
        $fields['param_1'] = "";
        if ($data['rbtDayoff'] == "off") {
            $fields['value_1'] = "CUSTOM";
            $fields['value_2'] = $data['txt_custome_dayoff'];
        } else {
            $fields['value_1'] = "AS_SHIFT";
        }
        if ($data['rbtDayoffDeduct'] == "off") {
            $fields['value_3'] = "DONT_DEDUCT";
        } else {
            $fields['value_3'] = "DEDUCT";
        }
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qi("settings_leave_master", $fields);

        if (!empty($st1)) {
            $success = "1";
            $msg = "Congratulation! You have successfully Added DATA";
        } else {
            $success = "0";
            $msg = "Oops! Sorry Something Wrong.Try Again";
        }
    }
    echo json_encode(array("success" => $success, "msg" => $msg));
//    die;
    die;
}
if (isset($_REQUEST['bindOtherSettings'])) {
    $othersettings = q("SELECT * FROM settings_leave_master where settings_type='DAILY_KARKAARD_OTHER' and company_id={$_SESSION['company']['id']}");
    echo json_encode($othersettings);
    die;
}
if (isset($_REQUEST['bindLunchSettings'])) {
    $lunchsettings = q("SELECT * FROM settings_leave_master where settings_type='DAILY_KARKAARD_LUNCH' and company_id={$_SESSION['company']['id']}");
    echo json_encode($lunchsettings);
    die;
}
if (isset($_REQUEST['bindKarkaardSettings'])) {
    $karkaardsettings = q("SELECT * FROM settings_leave_master where settings_type='DAILY_KARKAARD_KASHRE' and company_id={$_SESSION['company']['id']}");
    echo json_encode($karkaardsettings);
    die;
}
if (isset($_REQUEST['other_save'])) {
    $data = array();
    parse_str($_REQUEST['ladelData'], $data);
//    d($data);
//    die;
    if ($data['isUpdated'] == "yes") {
        $fields = array();
//        $fields['short_code'] = "THUSDAY_DEDUCT_AS_DAY";
        $fields['settings_type'] = "DAILY_KARKAARD_OTHER";
        $fields['param_1'] = "";
        $fields['value_1'] = $data['rbtvaction'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='THUSDAY_DEDUCT_AS_DAY' and settings_type='DAILY_KARKAARD_OTHER' and company_id={$_SESSION['company']['id']}");

        $fields = array();
//        $fields['short_code'] = "SICK_TIME_CEILING";
        $fields['settings_type'] = "DAILY_KARKAARD_OTHER";
        $fields['param_1'] = "DAY_PER_MONTH";
        $fields['param_2'] = "DAY_PER_YEAR";
        $fields['value_1'] = $data['day_permonth'];
        $fields['value_2'] = $data['day_peryear'];
        $fields['value_3'] = $data['types'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='SICK_TIME_CEILING' and settings_type='DAILY_KARKAARD_OTHER' and company_id={$_SESSION['company']['id']}");
        if (!empty($st1)) {
            $success = "1";
            $msg = "Congratulation! You have successfully Added DATA";
        } else {
            $success = "0";
            $msg = "Oops! Sorry Something Wrong.Try Again";
        }
    } else {
        $fields = array();
        $fields['short_code'] = "THUSDAY_DEDUCT_AS_DAY";
        $fields['settings_type'] = "DAILY_KARKAARD_OTHER";
        $fields['param_1'] = "";
        $fields['value_1'] = $data['rbtvaction'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qi("settings_leave_master", $fields);

        $fields = array();
        $fields['short_code'] = "SICK_TIME_CEILING";
        $fields['settings_type'] = "DAILY_KARKAARD_OTHER";
        $fields['param_1'] = "DAY_PER_MONTH";
        $fields['param_2'] = "DAY_PER_YEAR";
        $fields['value_1'] = $data['day_permonth'];
        $fields['value_2'] = $data['day_peryear'];
        $fields['value_3'] = $data['types'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qi("settings_leave_master", $fields);

        if (!empty($st1)) {
            $success = "1";
            $msg = "Congratulation! You have successfully Added DATA";
        } else {
            $success = "0";
            $msg = "Oops! Sorry Something Wrong.Try Again";
        }
    }
    echo json_encode(array("success" => $success, "msg" => $msg));
    die;
}
$jsInclude = 'daily_karkaard.js.php';
_cg("page_title", "Daily Karkaard");

//select * from tb_team t,tb_team_locations tl where tl.team_id=t.id and t.id=79 
