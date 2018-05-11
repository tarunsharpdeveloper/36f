<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}
if (isset($_REQUEST['bindKardex'])) {
    $settings = q("SELECT * FROM settings_leave_master where settings_type='KARDEX_SETTINGS' and company_id={$_SESSION['company']['id']}");
//    d($settings);
//    die;
    echo json_encode($settings);
    die;
}
if (isset($_REQUEST['bindLogged'])) {
    $logged = q("SELECT lg.*,DATE_FORMAT(lg.created_at,  '%m/%d/%Y %h:%i:%s %p') as touchdate, cp.name as cname,CONCAT(e.fname,' ',e.lname) as name FROM settings_leave_master_logs lg, tb_employee e, tb_company_works cp where e.id=lg.employer_user_id and cp.id=lg.company_id and lg.company_id='{$_SESSION['company']['id']}' ORDER BY `lg`.`id` DESC ");
    echo json_encode($logged);
    die;
}
if (isset($_REQUEST['kardex_setting_save'])) {
    $data = array();
    $st1 = "";
    parse_str($_REQUEST['ladelData'], $data);
//    d($data);
//    die;
    if ($data['isUpdated'] == "yes") {
//        qd("settings_leave_master", "settings_type='KARDEX_SETTINGS' and company_id={$_SESSION['company']['id']}");
        $fields = array();
//        $fields['short_code'] = "DAYS_OFF_PER_MONTH_YEAR";
        $fields['settings_type'] = "KARDEX_SETTINGS";
        $fields['param_1'] = "PER_MONTH";
        $fields['param_2'] = "PER_YEAR";
        $fields['value_1'] = $data['txtPerMonth'];
        $fields['value_2'] = $data['txtPerYear'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='DAYS_OFF_PER_MONTH_YEAR' and settings_type='KARDEX_SETTINGS' and company_id={$_SESSION['company']['id']}");

        $fields = array();
//        $fields['short_code'] = "ROLL_OVER_END";
        $fields['settings_type'] = "KARDEX_SETTINGS";
        $fields['param_1'] = "";
        $fields['param_2'] = "";
        $fields['value_1'] = $data['txtrollyear'];
        $fields['value_2'] = "";
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='ROLL_OVER_END' and settings_type='KARDEX_SETTINGS' and company_id={$_SESSION['company']['id']}");

        $fields = array();
//        $fields['short_code'] = "ROLL_OVER_EXCESS";
        $fields['settings_type'] = "KARDEX_SETTINGS";
        $fields['param_1'] = "";
        $fields['param_2'] = "";
        $fields['value_1'] = $data['excess'];
        $fields['value_2'] = "";
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='ROLL_OVER_EXCESS' and settings_type='KARDEX_SETTINGS' and company_id={$_SESSION['company']['id']}");

//    *******NEgative task remain*******
        $fields = array();
//        $fields['short_code'] = "ALLOW_NEGATIVE_VACATION";
        $fields['settings_type'] = "KARDEX_SETTINGS";
        $fields['param_1'] = "";
        $fields['param_2'] = "";
        $fields['value_1'] = $data['accruals'];
        if ($data['rbtQ'] == "QA") {
            $fields['value_2'] = "ALLOW";
            if ($data['rbtcapA'] == "on") {
                $fields['value_3'] = "CUSTOM_CAP";
                $fields['value_4'] = $data['txtcapA'];
            } else {
                $fields['value_3'] = "NO_CAP";
            }
        } else if ($data['rbtQ'] == "QB") {

            $fields['value_2'] = "DEDUCT";
            if ($data['rbtceilingB'] == "on") {
                $fields['value_3'] = "CUSTOM_CAP";
                $fields['value_4'] = $data['txtceilingB'];
                if ($data['rbtOT'] == "OT1") {
                    $fields['value_5'] = "ALLOW_WITH_NO_CAP";
                } else if ($data['rbtOT'] == "OT2") {
                    $fields['value_5'] = "ALLOW_WITH_CAP_OFF";
                    $fields['value_6'] = $data['txtOT2B'];
                } else if ($data['rbtOT'] == "OT3") {
                    $fields['value_5'] = "TIME_OFF_WITHOUT_PAYMENT";
                }
            } else {
                $fields['value_3'] = "NO_MAX_TIMEOFF";
                if ($data['rbtOT'] == "OT1") {
                    $fields['value_4'] = "ALLOW_WITH_NO_CAP";
                } else if ($data['rbtOT'] == "OT2") {
                    $fields['value_4'] = "ALLOW_WITH_CAP_OFF";
                    $fields['value_5'] = $data['txtOT2B'];
                } else if ($data['rbtOT'] == "OT3") {
                    $fields['value_4'] = "TIME_OFF_WITHOUT_PAYMENT";
                }
            }
        } else if ($data['rbtQ'] == "QC") {
            $fields['value_2'] = "WITHOUT_PAYMENT";
            $fields['value_3'] = "";
            $fields['value_4'] = "";
            $fields['value_5'] = "";
            $fields['value_6'] = "";
        }
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='ALLOW_NEGATIVE_VACATION' and settings_type='KARDEX_SETTINGS' and company_id={$_SESSION['company']['id']}");

        $fields = array();
//        $fields['short_code'] = "HOURLY_TIME_OFF";
        $fields['settings_type'] = "KARDEX_SETTINGS";
        $fields['param_1'] = "";
        $fields['param_2'] = "";
        $fields['value_1'] = $data['rbtHRTimeOff'];
        $fields['value_2'] = $data['txtHRTimeOff'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='HOURLY_TIME_OFF' and settings_type='KARDEX_SETTINGS' and company_id={$_SESSION['company']['id']}");

        $fields = array();
//        $fields['short_code'] = "ILLNESS_PREGNANT_LEAVE";
        $fields['settings_type'] = "KARDEX_SETTINGS";
        $fields['param_1'] = "";
        $fields['param_2'] = "";
        $fields['value_1'] = $data['rbtipa'];
        $fields['value_2'] = "";
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='ILLNESS_PREGNANT_LEAVE' and settings_type='KARDEX_SETTINGS' and company_id={$_SESSION['company']['id']}");

        $fields = array();
        $fields['company_id'] = $_SESSION['company']['id'];
        $fields['employer_user_id'] = $_SESSION['user']['id'];
        $fields['activityLog'] = "update";
        $fields['activityDetail'] = "";
        qi("settings_leave_master_logs", $fields);
        if (!empty($st1)) {
            $success = "1";
            $msg = "Congratulation! You have successfully Updated DATA";
        } else {
            $success = "0";
            $msg = "Oops! Sorry Something Wrong.Try Again";
        }
    } else {
        $fields = array();
        $fields['short_code'] = "DAYS_OFF_PER_MONTH_YEAR";
        $fields['settings_type'] = "KARDEX_SETTINGS";
        $fields['param_1'] = "PER_MONTH";
        $fields['param_2'] = "PER_YEAR";
        $fields['value_1'] = $data['txtPerMonth'];
        $fields['value_2'] = $data['txtPerYear'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qi("settings_leave_master", $fields);

        $fields = array();
        $fields['short_code'] = "ROLL_OVER_END";
        $fields['settings_type'] = "KARDEX_SETTINGS";
        $fields['param_1'] = "";
        $fields['param_2'] = "";
        $fields['value_1'] = $data['txtrollyear'];
        $fields['value_2'] = "";
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qi("settings_leave_master", $fields);

        $fields = array();
        $fields['short_code'] = "ROLL_OVER_EXCESS";
        $fields['settings_type'] = "KARDEX_SETTINGS";
        $fields['param_1'] = "";
        $fields['param_2'] = "";
        $fields['value_1'] = $data['excess'];
        $fields['value_2'] = "";
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qi("settings_leave_master", $fields);

//    *******NEgative task remain*******
        $fields = array();
        $fields['short_code'] = "ALLOW_NEGATIVE_VACATION";
        $fields['settings_type'] = "KARDEX_SETTINGS";
        $fields['param_1'] = "";
        $fields['param_2'] = "";
        $fields['value_1'] = $data['accruals'];
        if ($data['rbtQ'] == "QA") {
            $fields['value_2'] = "ALLOW";
            if ($data['rbtcapA'] == "on") {
                $fields['value_3'] = "CUSTOM_CAP";
                $fields['value_4'] = $data['txtcapA'];
            } else {
                $fields['value_3'] = "NO_CAP";
            }
        } else if ($data['rbtQ'] == "QB") {

            $fields['value_2'] = "DEDUCT";
            if ($data['rbtceilingB'] == "on") {
                $fields['value_3'] = "CUSTOM_CAP";
                $fields['value_4'] = $data['txtceilingB'];
                if ($data['rbtOT'] == "OT1") {
                    $fields['value_5'] = "ALLOW_WITH_NO_CAP";
                } else if ($data['rbtOT'] == "OT2") {
                    $fields['value_5'] = "ALLOW_WITH_CAP_OFF";
                    $fields['value_6'] = $data['txtOT2B'];
                } else if ($data['rbtOT'] == "OT3") {
                    $fields['value_5'] = "TIME_OFF_WITHOUT_PAYMENT";
                }
            } else {
                $fields['value_3'] = "NO_MAX_TIMEOFF";
                if ($data['rbtOT'] == "OT1") {
                    $fields['value_4'] = "ALLOW_WITH_NO_CAP";
                } else if ($data['rbtOT'] == "OT2") {
                    $fields['value_4'] = "ALLOW_WITH_CAP_OFF";
                    $fields['value_5'] = $data['txtOT2B'];
                } else if ($data['rbtOT'] == "OT3") {
                    $fields['value_4'] = "TIME_OFF_WITHOUT_PAYMENT";
                }
            }
        } else if ($data['rbtQ'] == "QC") {
            $fields['value_2'] = "WITHOUT_PAYMENT";
            $fields['value_3'] = "";
            $fields['value_4'] = "";
            $fields['value_5'] = "";
            $fields['value_6'] = "";
        }
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qi("settings_leave_master", $fields);

        $fields = array();
        $fields['short_code'] = "HOURLY_TIME_OFF";
        $fields['settings_type'] = "KARDEX_SETTINGS";
        $fields['param_1'] = "";
        $fields['param_2'] = "";
        $fields['value_1'] = $data['rbtHRTimeOff'];
        $fields['value_2'] = $data['txtHRTimeOff'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qi("settings_leave_master", $fields);

        $fields = array();
        $fields['short_code'] = "ILLNESS_PREGNANT_LEAVE";
        $fields['settings_type'] = "KARDEX_SETTINGS";
        $fields['param_1'] = "";
        $fields['param_2'] = "";
        $fields['value_1'] = $data['rbtipa'];
        $fields['value_2'] = "";
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qi("settings_leave_master", $fields);
        $fields = array();
        $fields['company_id'] = $_SESSION['company']['id'];
        $fields['employer_user_id'] = $_SESSION['user']['id'];
        $fields['activityLog'] = "insert";
        $fields['activityDetail'] = "";
        qi("settings_leave_master_logs", $fields);
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

$jsInclude = 'kardex.js.php';
_cg("page_title", "Kardex Tool and Settings");
