<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}
if (isset($_REQUEST['bindOt'])) {
    $settings = q("SELECT * FROM settings_leave_master where settings_type='OT_SETTINGS' and company_id={$_SESSION['company']['id']}");
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
if (isset($_REQUEST['settings_ot_setting_save'])) {
    $data = array();
    $st1 = "";
    parse_str($_REQUEST['ladelData'], $data);
//    d($data);
//    die;
    if ($data['isUpdated'] == "yes") {
//        qd("settings_leave_master", "settings_type='KARDEX_SETTINGS' and company_id={$_SESSION['company']['id']}");
        $fields = array();
//        $fields['short_code'] = "DAYS_OFF_PER_MONTH_YEAR";
        $fields['settings_type'] = "OT_SETTINGS";
        $fields['param_1'] = "PER_MONTH";
        $fields['param_2'] = "PER_YEAR";
        $fields['value_1'] = $data['txtPerMonth'];
        $fields['value_2'] = $data['txtPerYear'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='DAYS_OFF_PER_MONTH_YEAR' and settings_type='KARDEX_SETTINGS' and company_id={$_SESSION['company']['id']}");
        $fields = array();
        $fields['short_code'] = "AUTH_OT";
        $fields['settings_type'] = "OT_SETTINGS";
        $fields['param_1'] = "AUTH";

        $fields['value_1'] = $data['rbt_auth'];
        if ($data['rbt_auth'] == "yes") {
            $fields['value_2'] = $data['rbt_month'];
            $fields['param_2'] = "PER_MONTH";
            if ($data['rbt_month'] == "yes") {
                $fields['value_3'] = $data['txt_months'];
                $fields['param_3'] = "TXT_MONTH";
            } else {
                $fields['value_3'] = "";
            }
            if ($data['rtb_min'] == "entday") {

                $fields['value_4'] = $data['rtb_min'];
                $fields['param_4'] = "MIN_DAY_ENTDAY";
                $fields['value_5'] = $data['txt_min_entday'];
                $fields['param_5'] = "MIN_TXT_ENTDAY";
                $fields['value_6'] = "";
            } else if ($data['rtb_min'] == "sep") {

                $fields['value_4'] = $data['rtb_min'];
                $fields['param_4'] = "MIN_SEPRATE";
                $fields['value_5'] = $data['txt_min_prior'];
                $fields['param_5'] = "MIN_TXT_PRIOR";
                $fields['value_6'] = $data['txt_min_post'];
                $fields['param_6'] = "MIN_TXT_POST";
            } else {
                $fields['value_4'] = $data['rtb_min'];
                $fields['param_4'] = "NO_MIN";
                $fields['value_5'] = "";
                $fields['value_6'] = "";
            }
            if ($data['rtb_max'] == "entday") {

                $fields['value_7'] = $data['rtb_max'];
                $fields['param_7'] = "MAX_DAY_ENTDAY";
                $fields['value_8'] = $data['txt_max_entday'];
                $fields['param_8'] = "MAX_TXT_ENTDAY";
                $fields['value_9'] = "";
            } else if ($data['rtb_max'] == "sep") {

                $fields['value_7'] = $data['rtb_max'];
                $fields['param_7'] = "MAX_SEPRATE";
                $fields['value_8'] = $data['txt_max_prior'];
                $fields['param_8'] = "TXT_PRIOR";
                $fields['value_9'] = $data['txt_max_post'];
                $fields['param_9'] = "MAX_TXT_POST";
            } else {
                $fields['value_7'] = $data['rtb_max'];
                $fields['param_7'] = "NO_MAX";
                $fields['value_8'] = "";
                $fields['value_9'] = "";
            }
        } else {
            $fields['value_2'] = "";
            $fields['value_3'] = "";
            $fields['value_4'] = "";
            $fields['value_5'] = "";
            $fields['value_6'] = "";
            $fields['value_7'] = "";
            $fields['value_8'] = "";
            $fields['value_9'] = "";
        }
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qu("settings_leave_master", $fields, "short_code='AUTH_OT' and settings_type='OT_SETTINGS' and company_id={$_SESSION['company']['id']}");

        $fields = array();
        $fields['company_id'] = $_SESSION['company']['id'];
        $fields['employer_user_id'] = $_SESSION['user']['id'];
        $fields['activityLog'] = "update";
        $fields['activityDetail'] = "";
//        qi("settings_leave_master_logs", $fields);
        if (!empty($st1)) {
            $success = "1";
            $msg = "Congratulation! You have successfully Updated DATA";
        } else {
            $success = "0";
            $msg = "Oops! Sorry Something Wrong.Try Again";
        }
    } else {
        $fields = array();
        $fields['short_code'] = "AUTH_OT";
        $fields['settings_type'] = "OT_SETTINGS";
        $fields['param_1'] = "AUTH";

        $fields['value_1'] = $data['rbt_auth'];
        if ($data['rbt_auth'] == "yes") {
            $fields['value_2'] = $data['rbt_month'];
            $fields['param_2'] = "PER_MONTH";
            if ($data['rbt_month'] == "yes") {
                $fields['value_3'] = $data['txt_months'];
                $fields['param_3'] = "TXT_MONTH";
            } else {
                $fields['value_3'] = "";
            }
            if ($data['rtb_min'] == "entday") {

                $fields['value_4'] = $data['rtb_min'];
                $fields['param_4'] = "MIN_DAY_ENTDAY";
                $fields['value_5'] = $data['txt_min_entday'];
                $fields['param_5'] = "MIN_TXT_ENTDAY";
            } else if ($data['rtb_min'] == "sep") {

                $fields['value_4'] = $data['rtb_min'];
                $fields['param_4'] = "MIN_SEPRATE";
                $fields['value_5'] = $data['txt_min_prior'];
                $fields['param_5'] = "MIN_TXT_PRIOR";
                $fields['value_6'] = $data['txt_min_post'];
                $fields['param_6'] = "MIN_TXT_POST";
            } else {
                $fields['value_4'] = $data['rtb_min'];
                $fields['param_4'] = "NO_MIN";
            }
            if ($data['rtb_max'] == "entday") {

                $fields['value_7'] = $data['rtb_max'];
                $fields['param_7'] = "MAX_DAY_ENTDAY";
                $fields['value_8'] = $data['txt_max_entday'];
                $fields['param_8'] = "MAX_TXT_ENTDAY";
            } else if ($data['rtb_max'] == "sep") {

                $fields['value_7'] = $data['rtb_max'];
                $fields['param_7'] = "MAX_SEPRATE";
                $fields['value_8'] = $data['txt_max_prior'];
                $fields['param_8'] = "TXT_PRIOR";
                $fields['value_9'] = $data['txt_max_post'];
                $fields['param_9'] = "MAX_TXT_POST";
            } else {
                $fields['value_7'] = $data['rtb_max'];
                $fields['param_7'] = "NO_MAX";
            }
        } else {
            $fields['value_2'] = "";
            $fields['value_3'] = "";
            $fields['value_4'] = "";
            $fields['value_5'] = "";
            $fields['value_6'] = "";
            $fields['value_7'] = "";
            $fields['value_8'] = "";
            $fields['value_9'] = "";
        }
        $fields['company_id'] = $_SESSION['company']['id'];
        $st1 = qi("settings_leave_master", $fields);

        $fields = array();
        $fields['company_id'] = $_SESSION['company']['id'];
        $fields['employer_user_id'] = $_SESSION['user']['id'];
        $fields['activityLog'] = "insert";
        $fields['activityDetail'] = "";
//        qi("settings_leave_master_logs", $fields);
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

$jsInclude = 'settings_ot.js.php';
_cg("page_title", "OT Settings");
