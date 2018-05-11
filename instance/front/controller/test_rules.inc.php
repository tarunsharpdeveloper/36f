<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}

if (isset($_REQUEST['tableCall'])) {
    $userId = $_REQUEST['id'];
    $employeeID = $userId;
    $subq = q("SELECT * FROM `tb_shift_check_inout` where user_id='$userId' ORDER BY `id` DESC ");
    include _PATH . "instance/front/tpl/test_rules_summary.php";
    die;
}
if (isset($_REQUEST['bindApplyRules'])) {
    $userId = $_REQUEST['id'];
    $employeeID = $userId;
    $data = array();


//    $startTime = date("H:i:s ", strtotime($_REQUEST['startTime']));
//    $endTime = date("H:i:s ", strtotime($_REQUEST['endTime']));
    $startTime = $_REQUEST['startTime'];
    $endTime = $_REQUEST['endTime'];
    $isOvertimeSchedule = $_REQUEST['overnight_schedule'];

    if ($isOvertimeSchedule == "1" || 1) {
        $getDates = q("SELECT * FROM `tb_shift_check_inout` where user_id='$userId' GROUP BY user_id ORDER BY `id` DESC ");

        foreach ($getDates as $key => $value) {
            $data[$key]['userid'] = $value['user_id'];
            $data[$key]['date'] = $value['sDate'];
            $tempKey = $key;
            $getsub = q("SELECT * FROM `tb_shift_check_inout` where user_id='{$value['user_id']}'  ORDER BY `id` DESC ");

            foreach ($getsub as $val) {
                if ($val['type'] == "CHECKEDIN") {
                    $data[$tempKey][$val['type']] = $val['timestamp'];
                } else if ($val['type'] == "CHECKOUT") {
                    $data[$tempKey][$val['type']] = $val['timestamp'];
                }
            }
        }
    } else {

        $getDates = q("SELECT * FROM `tb_shift_check_inout` where user_id='$userId' GROUP BY sDate ORDER BY `id` DESC ");

        foreach ($getDates as $key => $value) {
            $data[$key]['userid'] = $value['user_id'];
            $data[$key]['date'] = $value['sDate'];
            $tempKey = $key;
            $getsub = q("SELECT * FROM `tb_shift_check_inout` where user_id='{$value['user_id']}' and sDate='{$value['sDate']}' ORDER BY `id` DESC ");
            foreach ($getsub as $val) {
                if ($val['type'] == "CHECKEDIN") {
                    $data[$tempKey][$val['type']] = $val['timestamp'];
                } else if ($val['type'] == "CHECKOUT") {
                    $data[$tempKey][$val['type']] = $val['timestamp'];
                }
            }
        }
    }

    include _PATH . "instance/front/tpl/test_rules_apply.php";
    die;
}
if (isset($_REQUEST['deleteRecords'])) {
    $Id = $_REQUEST['id'];
    $is = qd("tb_shift_check_inout", "id='$Id'");
    if (!empty($is)) {
        $success = "1";
        $msg = "Your Record Deleted successfully ";
    } else {
        $success = "0";
        $msg = "Oops! Sorry Something Wrong.Try Again";
    }
    echo json_encode(array("success" => $success, "msg" => $msg));
    die();
}
if (isset($_REQUEST['deleteall'])) {
    $Id = $_REQUEST['id'];
    $is = qd("tb_shift_check_inout", "user_id='$Id'");
    if (!empty($is)) {
        $success = "1";
        $msg = "Your Record Deleted successfully ";
    } else {
        $success = "0";
        $msg = "Oops! Sorry Something Wrong.Try Again";
    }
    echo json_encode(array("success" => $success, "msg" => $msg));
    die();
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
if (isset($_REQUEST['bindLocation'])) {
//    d($_REQUEST);
    $companyID = $_REQUEST['companyid'];
    $locations = q("SELECT * From tb_location where company_id='$companyID'");
    echo json_encode($locations);
    die;
}
if (isset($_REQUEST['bindTeam'])) {
//    d($_REQUEST);
    $companyID = $_REQUEST['companyid'];
    $teams = q("SELECT * From tb_team where company_id='$companyID'");
    echo json_encode($teams);
    die;
}
if (isset($_REQUEST['bindEmployees'])) {
//    d($_REQUEST);
    $companyID = $_REQUEST['companyid'];
    $locationsID = $_REQUEST['locationid'];
    $teamID = $_REQUEST['teamid'];
    $employees = q("SELECT * From tb_employee where work_at='$companyID' and location='$locationsID' and team_id='$teamID'");
    echo json_encode($employees);
    die;
}
if (isset($_REQUEST['test_rules_save'])) {
    $data = array();
    $st1 = "";
    parse_str($_REQUEST['ladelData'], $data);
//    d($data);
//    die;
    $user_lat = "";
    $user_long = "";
    if ($data['status'] == "CHECKEDIN") {
        $user_id = $data['ser_employee'];
        $start_time = date('H:i', strtotime($data['txttime']));
        $sDate = $data['dateofshift'];

        $fields = array();
        $fields['user_id'] = $user_id;
        $fields['shiftid'] = "-2";
        $sdate = date('Y-m-d', strtotime($sDate));
        $timestamp = date('Y-m-d H:i', strtotime($sdate . " " . $start_time));
        $fields['sDate'] = $sdate;

        //$fields['type'] = "CHECKEDIN_R";
        $fields['type'] = "CHECKEDIN";

        $fields['timestamp'] = $timestamp;
        $fields['lat'] = $user_lat;
        $fields['lng'] = $user_long;
        $isShift = qi("tb_shift_check_inout", $fields);
    }
    if ($data['status'] == "CHECKOUT") {

        $timestamp = date('H:i', strtotime($data['txttime']));
        $sDate = $data['dateofshift'];
        $user_id = $data['ser_employee'];

        $fields = array();
        $fields['user_id'] = $user_id;
        $fields['shiftid'] = "-2";
        $sdate = date('Y-m-d', strtotime($sDate));
        $timestamp = date('Y-m-d H:i', strtotime($sdate . " " . $timestamp));
        $fields['sDate'] = $sdate;

        $fields['type'] = "CHECKOUT";
        $fields['timestamp'] = $timestamp;
        $fields['lat'] = $user_lat;
        $fields['lng'] = $user_long;
        $isShift = qi("tb_shift_check_inout", $fields);
    }
    if ($data['status'] == "LUNCHOUT") {
        $timestamp = date('H:i', strtotime($data['txttime']));
        $sDate = $data['dateofshift'];
        $user_id = $data['ser_employee'];

        $fields = array();
        $fields['user_id'] = $user_id;
        $fields['shiftid'] = "-2";
        $sdate = date('Y-m-d', strtotime($sDate));
        $timestamp = date('Y-m-d H:i', strtotime($sdate . " " . $timestamp));
        $fields['sDate'] = $sdate;

        $fields['type'] = "LUNCHOUT";
        $fields['timestamp'] = $timestamp;
        $fields['lat'] = $user_lat;
        $fields['lng'] = $user_long;
        $isShift = qi("tb_shift_check_inout", $fields);
    }
    if ($data['status'] == "LUNCHIN") {
        $timestamp = date('H:i', strtotime($data['txttime']));
        $sDate = $data['dateofshift'];
        $user_id = $data['ser_employee'];

        $fields = array();
        $fields['user_id'] = $user_id;
        $fields['shiftid'] = "-2";
        $sdate = date('Y-m-d', strtotime($sDate));
        $timestamp = date('Y-m-d H:i', strtotime($sdate . " " . $timestamp));
        $fields['sDate'] = $sdate;

        $fields['type'] = "LUNCHIN";
        $fields['timestamp'] = $timestamp;
        $fields['lat'] = $user_lat;
        $fields['lng'] = $user_long;
        $isShift = qi("tb_shift_check_inout", $fields);
    }

    if ($data['status'] == "BRIEFCASEIN") {
        $timestamp = date('H:i', strtotime($data['txttime']));
        $sDate = $data['dateofshift'];
        $user_id = $data['ser_employee'];

        $fields = array();
        $fields['user_id'] = $user_id;
        $fields['shiftid'] = "-2";
        $sdate = date('Y-m-d', strtotime($sDate));
        $timestamp = date('Y-m-d H:i', strtotime($sdate . " " . $timestamp));
        $fields['sDate'] = $sdate;
        $fields['type'] = "BRIEFCASEIN";
        $fields['timestamp'] = $timestamp;
        $fields['lat'] = $user_lat;
        $fields['lng'] = $user_long;
        $isShift = qi("tb_shift_check_inout", $fields);
    }
    if ($data['status'] == "TIMEOUTIN") {
        $timestamp = date('H:i', strtotime($data['txttime']));
        $sDate = $data['dateofshift'];
        $user_id = $data['ser_employee'];

        $fields = array();
        $fields['user_id'] = $user_id;
        $fields['shiftid'] = "-2";
        $sdate = date('Y-m-d', strtotime($sDate));
        $timestamp = date('Y-m-d H:i', strtotime($sdate . " " . $timestamp));
        $fields['sDate'] = $sdate;

        $fields['type'] = "TIMEOUTIN";
        $fields['timestamp'] = $timestamp;
        $fields['lat'] = $user_lat;
        $fields['lng'] = $user_long;
        $isShift = qi("tb_shift_check_inout", $fields);
    }
    if ($data['status'] == "BRIEFCASEOUT") {
        $timestamp = date('H:i', strtotime($data['txttime']));
        $sDate = $data['dateofshift'];
        $user_id = $data['ser_employee'];

        $fields = array();
        $fields['user_id'] = $user_id;
        $fields['shiftid'] = "-2";
        $sdate = date('Y-m-d', strtotime($sDate));
        $timestamp = date('Y-m-d H:i', strtotime($sdate . " " . $timestamp));
        $fields['sDate'] = $sdate;
        $fields['type'] = "BRIEFCASEOUT";
        $fields['timestamp'] = $timestamp;
        $fields['lat'] = $user_lat;
        $fields['lng'] = $user_long;
        $isShift = qi("tb_shift_check_inout", $fields);
    }
    if ($data['status'] == "TIMEOUTOUT") {
        $timestamp = date('H:i', strtotime($data['txttime']));
        $sDate = $data['dateofshift'];
        $user_id = $data['ser_employee'];

        $fields = array();
        $fields['user_id'] = $user_id;
        $fields['shiftid'] = "-2";
        $sdate = date('Y-m-d', strtotime($sDate));
        $timestamp = date('Y-m-d H:i', strtotime($sdate . " " . $timestamp));
        $fields['sDate'] = $sdate;
        $fields['type'] = "TIMEOUTOUT";
        $fields['timestamp'] = $timestamp;
        $fields['lat'] = $user_lat;
        $fields['lng'] = $user_long;
        $isShift = qi("tb_shift_check_inout", $fields);
    }
    if (!empty($isShift)) {
        $success = "1";
        $msg = "Congratulation! You have successfully Added DATA";
    } else {
        $success = "0";
        $msg = "Oops! Sorry Something Wrong.Try Again";
    }

    echo json_encode(array("success" => $success, "msg" => $msg));
    die;
}

$jsInclude = 'test_rules.js.php';
_cg("page_title", "RULES");
