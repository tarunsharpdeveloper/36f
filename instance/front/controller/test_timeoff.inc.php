<?php

if (isset($_REQUEST['bindLocation'])) {
    $companyID = $_REQUEST['companyid'];
    $locations = q("SELECT * From tb_location where company_id='$companyID'");
    echo json_encode($locations);
    die;
}
if (isset($_REQUEST['bindTeam'])) {
    $companyID = $_REQUEST['companyid'];
    $teams = q("SELECT * From tb_team where company_id='$companyID'");
    echo json_encode($teams);
    die;
}
if (isset($_REQUEST['bindEmployees'])) {
    $companyID = $_REQUEST['companyid'];
    $locationsID = $_REQUEST['locationid'];
    $teamID = $_REQUEST['teamid'];
    $employees = q("SELECT * From tb_employee where work_at='$companyID' and location='$locationsID' and team_id='$teamID'");
    echo json_encode($employees);
    die;
}
if ($_REQUEST['dataUpdate'] == 1) {
    parse_str($_REQUEST['data'], $arr);

    $random_id = substr(md5(microtime()), rand(0, 26), 5);

    $id_date = clearNumber(date("ymd", strtotime($fields['fromDate'])));
    $id_reason = clearNumber(substr($arr['reason'], 0, 10));



    $fields = array();
    $fields['company_id'] = $_SESSION['company']['id'];
    $fields['emp_id'] = $arr['ser_employee'];
    $fields['absence_type'] = $arr['absentType'];

    if ($arr['absentType'] == 'entireDay') {
        $fields['from_date'] = $arr['fromDate'];
        $fields['to_date'] = $arr['toDate'];
    } else {
        $fields['from_date'] = $arr['fromDateTime'];
        $fields['to_date'] = $arr['toDateTime'];
    }
    $fields['reason'] = $arr['reason'];

    # Unique id
    $employees = qs("SELECT * From tb_employee where id='{$fields['emp_id']}'");
    $company = qs("SELECT * FROM `tb_company_works` where id='{$fields['company_id']}'");

    $unique_id = array();
    $unique_id[] = str_replace(" ", "_", $company['name']);
    $unique_id[] = str_replace(" ", "_", $employees['fname'] . "_" . $employees['lname']);
    $unique_id[] = strtotime($fields['from_date']);
    $unique_id[] = $id_reason;
    $unique_id[] = $random_id;
    $unique_id = array_filter($unique_id);
    $unique_id = implode("_", $unique_id);
    $fields['unique_id'] = $unique_id;
    
    $id = qi('tb_timeoff', _escapeArray($fields));


    $date1 = date_create($fields['from_date']);
    $date2 = date_create($fields['to_date']);
    $diff = date_diff($date1, $date2);

    $day = $diff->format("%a");
    $emp_id = $arr['ser_employee'];
    $check = qs("SELECT * FROM `employee_leave_balance` where employee_id='{$emp_id}'");

    if (isset($check['leave_pending_balance'])) {
        $fields = array();
        $fields['leave_pending_balance'] = $check['leave_pending_balance'] + $day;
        qu('employee_leave_balance', _escapeArray($fields), "employee_id=" . $emp_id);
    } else {
        $fields = array();
        $fields['employee_id'] = $emp_id;
        $fields['leave_pending_balance'] = $check['leave_pending_balance'] + $day;
        qi('employee_leave_balance', _escapeArray($fields));
    }


    $leaveData = q("select * from tb_timeoff where company_id=" . $_SESSION['company']['id'] . " ORDER BY created_at DESC ");
    include _PATH . 'instance/front/tpl/test_timeoff_data.php';
    die;
}
if ($_REQUEST['leaveManage'] == 1) {
    $fields['status'] = $_REQUEST['status'] == 1 ? "Approved" : "Decline";
    qu('tb_timeoff', _escapeArray($fields), "id=" . $_REQUEST['id']);
    $check = qs("SELECT * FROM `employee_leave_balance` where employee_id='{$_REQUEST['empid']}'");
    if ($_REQUEST['status'] == 1) {
        if (isset($check['leave_pending_balance'])) {
            $fields = array();
            $fields['leave_pending_balance'] = $check['leave_pending_balance'] - $_REQUEST['day'];
            $fields['leave_balance'] = $check['leave_balance'] + $_REQUEST['day'];
            qu('employee_leave_balance', _escapeArray($fields), "employee_id=" . $_REQUEST['empid']);
        }
    } else {
        if (isset($check['leave_pending_balance'])) {
            $fields = array();
            $fields['leave_pending_balance'] = $check['leave_pending_balance'] - $_REQUEST['day'];
            qu('employee_leave_balance', _escapeArray($fields), "employee_id=" . $_REQUEST['empid']);
        }
    }
    $leaveData = q("select * from tb_timeoff where company_id=" . $_SESSION['company']['id'] . " ORDER BY created_at DESC ");
    include _PATH . 'instance/front/tpl/test_timeoff_data.php';
    die;
}
$leaveData = q("select * from tb_timeoff where company_id=" . $_SESSION['company']['id'] . " ORDER BY created_at DESC ");
$gego_date = explode("-", date("Y-m-d"));
$jala_date = gregorian_to_jalali($gego_date[0], $gego_date[1], $gego_date[2]);
$jsInclude = 'test_timeoff.js.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

