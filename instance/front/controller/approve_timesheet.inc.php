<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}
//if (!isset($_SESSION['user']) ) {
//    _R('login');
//}
//$timesheet = "";


if (checkAccessLevel($_SESSION['user']['access_level'], 'timesheet', 'export')) {
    if (isset($_REQUEST['ajaxapproveNext'])) {
//    d($_REQUEST);
//    die;
        $ID = $_REQUEST['shiftid'];
        $id = $_REQUEST['empid'];
        $dt = $_REQUEST['sDate'];
        $ddt = explode("-", $dt);
        $start_dt = date("Y-m-d", strtotime($ddt[0]));
        $end_dt = date("Y-m-d", strtotime($ddt[1]));

//    d($ddt);
//    d($start_dt);
//    d($end_dt);
//    die;
        $fields['progress'] = "Approved";
        $fields['status'] = "1";
//    SELECT * FROM `tb_shift_time` WHERE user_id = "1" and status NOT IN("2") ORDER BY `id` ASC
        $st = qu("tb_shift_time", $fields, "id='$ID' ");
        $timesheet = q("select * from tb_shift_time where user_id='$id' and created_at BETWEEN '$start_dt' AND '$end_dt'");
//   d($timesheet);
        include _PATH . 'instance/front/tpl/approve_timesheet_data.php';
        die;
    }
    if (isset($_REQUEST['ajaxUnapproveAll'])) {
//    d($_REQUEST);
//    die;
        $id = $_REQUEST['empid'];
        $dt = $_REQUEST['sDate'];
        $ddt = explode("-", $dt);
        $start_dt = date("Y-m-d", strtotime($ddt[0]));
        $end_dt = date("Y-m-d", strtotime($ddt[1]));

//    d($ddt);
//    d($start_dt);
//    d($end_dt);
//    die;
        $fields['progress'] = "Waitting";
        $fields['status'] = "0";
//    SELECT * FROM `tb_shift_time` WHERE user_id = "1" and status NOT IN("2") ORDER BY `id` ASC
        $st = qu("tb_shift_time", $fields, "user_id='$id' and created_at BETWEEN '$start_dt' AND '$end_dt' and status NOT IN('2') ORDER BY `id` ASC");
        $timesheet = q("select * from tb_shift_time where user_id='$id' and created_at BETWEEN '$start_dt' AND '$end_dt'");
//   d($timesheet);
        include _PATH . 'instance/front/tpl/approve_timesheet_data.php';
        die;
    }
    if (isset($_REQUEST['ajaxApproveAll'])) {
//    d($_REQUEST);
//    die;
        $id = $_REQUEST['empid'];
        $dt = $_REQUEST['sDate'];
        $ddt = explode("-", $dt);
        $start_dt = date("Y-m-d", strtotime($ddt[0]));
        $end_dt = date("Y-m-d", strtotime($ddt[1]));

//    d($ddt);
//    d($start_dt);
//    d($end_dt);
//    die;
        $fields['progress'] = "Approved";
        $fields['status'] = "1";
//    SELECT * FROM `tb_shift_time` WHERE user_id = "1" and status NOT IN("2") ORDER BY `id` ASC
        $st = qu("tb_shift_time", $fields, "user_id='$id' and created_at BETWEEN '$start_dt' AND '$end_dt' and status NOT IN('2') ORDER BY `id` ASC");
        $timesheet = q("select * from tb_shift_time where user_id='$id' and created_at BETWEEN '$start_dt' AND '$end_dt'");
//   d($timesheet);
        include _PATH . 'instance/front/tpl/approve_timesheet_data.php';
        die;
    }
    if (isset($_REQUEST['shiftDiscard'])) {
//    d($_REQUEST);die;
        $data = array();
        parse_str($_REQUEST['ladelData'], $data);
        $fields = array();
        $ID = $data['shift_id'];
        $fields['progress'] = "Discard";
        $fields['status'] = "2";

        $id = $_REQUEST['empid'];
        $dt = $_REQUEST['sDate'];
        $ddt = explode("-", $dt);
        $start_dt = date("Y-m-d", strtotime($ddt[0]));
        $end_dt = date("Y-m-d", strtotime($ddt[1]));

//    d($ddt);
//    d($start_dt);
//    d($end_dt);

        $timesheet = q("select * from tb_shift_time where user_id='$id' and created_at BETWEEN '$start_dt' AND '$end_dt'");
//   d($timesheet);
        include _PATH . 'instance/front/tpl/approve_timesheet_data.php';
        $st1 = qu("tb_shift_time", $fields, "id='$ID'");

//    d($st1);
        if (!empty($st1)) {
            $success = "1";
            $msg = "Record Discard Successfull";
        } else {
            $success = "0";
            $msg = "Record Not Discard Successfull";
        }
        echo json_encode(array("success" => $success, "msg" => $msg));
        die();
    }
    if (isset($_REQUEST['shiftApprove'])) {
        $data = array();
        parse_str($_REQUEST['ladelData'], $data);
        $fields = array();
//    d($data['e_time']);
        $ID = $data['shift_id'];
//    d($ID);
        $fields['area_of_work'] = $data['area'];
        $fields['start_time'] = $data['s_time'];
        $fields['end_time'] = $data['e_time'];
        $fields['break_time'] = $data['b_time'];
        $fields['progress'] = "Approved";
        $fields['status'] = "1";
//        $fields['id'] = $value['shift_id'];
//    foreach ($data as $value) {
//        d($value);
//        $fields[''] = $value[''];
//    }
        $st1 = qu("tb_shift_time", $fields, "id='$ID'");

//    d($st1);
        if (!empty($st1)) {
            $success = "1";
            $msg = "Record Updated Successfull";
        } else {
            $success = "0";
            $msg = "Record Not Updated Successfull";
        }
        echo json_encode(array("success" => $success, "msg" => $msg));
        die();
    }
    if (isset($_REQUEST['NewSchedulesave'])) {
//    d($_REQUEST);
        $fields = array();
        $fields['user_id'] = $_REQUEST['user_id'];
        $fields['sDate'] = date("Y-m-d H:i:s", strtotime($_REQUEST['shiftdt']));
        $fields['note'] = $_REQUEST['md_notes'];
        $st = qi("tb_shift_time", $fields);
        if (!empty($st)) {
            $success = "1";
            $msg = "Record inserted Successfull";
        } else {
            $success = "0";
            $msg = "Record Not inserted Successfull";
        }
        echo json_encode(array("success" => $success, "msg" => $msg));

        die;
    }
    if (isset($_REQUEST['getSchedule'])) {
        $id = $_REQUEST['id'];
        $timesheetData = qs("select * from tb_shift_time where id='$id' ");
        $cDate = date("l, jS F Y ", strtotime($timesheetData['created_at']));

//    d($cDate);
        echo json_encode(array("data" => $timesheetData, "Cdate" => $cDate));
        die;
    }
    if (isset($_REQUEST['getTimesheet'])) {
        $id = $_REQUEST['id'];
        $dt = $_REQUEST['dates'];
        $ddt = explode("-", $dt);
        $start_dt = date("Y-m-d", strtotime($ddt[0]));
        $end_dt = date("Y-m-d", strtotime($ddt[1]));

//    d($ddt);
//    d($start_dt);
//    d($end_dt);

        $timesheet = q("select * from tb_shift_time where user_id='$id' and created_at BETWEEN '$start_dt' AND '$end_dt'");
//   d($timesheet);
        include _PATH . 'instance/front/tpl/approve_timesheet_data.php';
//    $_SESSION["timesheetData"] = $timesheetdata;
        die;
    }
//$timesheet = $_SESSION["timesheetData"];
    $employee = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'");
    $positions = q("select * from tb_position  ORDER BY `tb_position`.`c_name` ASC");
}
$jsInclude = 'approve_timesheet.js.php';
_cg("page_title", "approve_timesheet");
//if (($_REQUEST[' car_modal']) != '') {
//        d($_REQUEST);
//        die;
//}

