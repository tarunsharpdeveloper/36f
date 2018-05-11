<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}
$PostResult = q("select * from tb_shift_type");
//$emp = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'");
//echo  helper::officeCond() . helper::OrderByDesc();
if (isset($_REQUEST['countTotalHour'])) {
    $startlen = "";
    $endlen = "";
    $starttime = $_REQUEST['starttime'];
    $endtime = $_REQUEST['endtime'];
    if ((strlen($starttime)) <= 2) {
        $starttime = $starttime * 100;
        $startlen = $starttime;
        $starttime = round($starttime / 100, 2);
        $starttime = number_format($starttime, 2, ':', '');
    } else {
        $starttime = str_replace(":", "", $starttime);
//        $start_time = $start_time / 100;
        $startlen = $starttime;
        $starttime = round($starttime / 100, 2);
        $starttime = number_format($starttime, 2, ':', '');
    }
    if ((strlen($endtime)) <= 2) {
        $endtime = $endtime * 100;
        $endlen = $endtime;
        $endtime = round($endtime / 100, 2);
        $endtime = number_format($endtime, 2, ':', '');
    } else {
        $endtime = str_replace(":", "", $endtime);
//        $start_time = $start_time / 100;
        $endlen = $endtime;
        $endtime = round($endtime / 100, 2);
        $endtime = number_format($endtime, 2, ':', '');
    }
    $sTime = $starttime;
    $eTime = $endtime;
    $start = date("Y-m-d H:i", strtotime($starttime));
    $end = date("Y-m-d H:i", strtotime($endtime));

    if ($startlen >= $endlen || $startlen == $endlen) {
        $end = date("Y-m-d H:i", strtotime($end . "+1 days"));
    }
    $to_time = strtotime($start);
    $from_time = strtotime($end);
////echo $v / 60;
    $totalTime = round(abs($to_time - $from_time) / 60, 2);
    $totalTime = number_format(round($totalTime / 60, 2), 2, '.', '');
//    d($start);
//    d($end);
//    d($totalTime);
//    d($tot);
//    die;
    echo json_encode(array("start" => $sTime, "end" => $eTime, "total" => $totalTime));
    die;
}
if (isset($_REQUEST['isNewType'])) {
//    d($_REQUEST);
    $fields = array();
    $fields['shift_name'] = $_REQUEST['a_shiftName'];
    $fields['shift_time'] = $_REQUEST['a_shiftTime'];
    $fields['deduction'] = $_REQUEST['a_deductTime'];
    $fields['start_time'] = $_REQUEST['a_start_time'];
    $fields['end_time'] = $_REQUEST['a_end_time'];
    $st = qi("tb_shift_type", $fields);
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

if (isset($_REQUEST['tableReload'])) {
    $PostResult = q("select * from tb_shift_type");
    include _PATH . 'instance/front/tpl/shift_type_data.php';
    die;
}

if (isset($_REQUEST['bindType'])) {
    $id = $_REQUEST['shifttypeid'];
    $query = qs("select * from tb_shift_type where id='$id'");
//    d($query);
//    include _PATH . 'instance/front/tpl/shift_type_data.php';
    echo json_encode($query);
    die;
}
if (isset($_REQUEST['isUpdateType'])) {

    $id = $_REQUEST['shiftid'];
    $fields = array();
    $fields['shift_name'] = $_REQUEST['e_shiftName'];
    $fields['shift_time'] = $_REQUEST['e_shiftTime'];
    $fields['deduction'] = $_REQUEST['e_deductTime'];
    $fields['start_time'] = $_REQUEST['e_start_time'];
    $fields['end_time'] = $_REQUEST['e_end_time'];
    $st = qu("tb_shift_type", $fields, "id='$id'");
    if (!empty($st)) {
        $success = "1";
        $msg = "Record Updated Successfull";
    } else {
        $success = "0";
        $msg = "Record Not Updated Successfull";
    }
    echo json_encode(array("success" => $success, "msg" => $msg));
    die;
}
if (isset($_REQUEST['deleteType'])) {

    $id = $_REQUEST['shifttypeid'];
    $st = qd("tb_shift_type", "id='$id'");

    if (!empty($st)) {
        $success = "1";
        $msg = "Record Deleted Successfull";
    } else {
        $success = "0";
        $msg = "Record Not Deleted Successfull";
    }
    echo json_encode(array("success" => $success, "msg" => $msg));
    die;
}
if (isset($_REQUEST['bindAllSettings'])) {
    $exist = qs("select * from tb_setting where company_id ='{$_SESSION['company']['id']}'");

    echo json_encode($exist);

    die;
}
if (isset($_REQUEST['BindEmployee'])) {
    $searchKey = $_REQUEST['searchKey'];
    if ($searchKey == "*") {
        $emp = q("select * from tb_employee where work_at ='{$_SESSION['company']['id']}'");
        $lastQuery = "";
    } else {
        $emp = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}' and access_level LIKE '%" . $searchKey . "%'");
        $lastQuery = "and access_level LIKE '%" . $searchKey . "%'";
    }
//    include _PATH . 'instance/front/tpl/employee_settings_data.php';
//    die;
    echo json_encode($emp);
//
    die;
}
if (isset($_REQUEST['BindEmployees'])) {
    $searchKey = $_REQUEST['searchKey'];
    if ($searchKey == "*") {
        $emp = q("select * from tb_employee where work_at ='{$_SESSION['company']['id']}'");
        $lastQuery = "";
    } else {
        $emp = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}' and access_level LIKE '%" . $searchKey . "%'");
        $lastQuery = "and access_level LIKE '%" . $searchKey . "%'";
    }
    include _PATH . 'instance/front/tpl/employee_settings_data.php';
//    die;
//    echo json_encode($emp);
//
    die;
}
if (isset($_REQUEST['bindRules'])) {
    $rules = qs("select * from tb_employee_settings where emp_id='{$_REQUEST['id']}'");
    echo json_encode($rules);
    die;
}
if (isset($_REQUEST['shiftAllowClock'])) {
    $idsArray = $_REQUEST['selectEmp'];
    $array = explode(",", $idsArray);
    if ($array[0] == "on") {
        unset($array[0]);
    }
    $array = array_values($array);
    $emplist = "";
    $boolemp = "0";
    foreach ($array as $emps) {
        $exist = qs("select * from tb_employee_settings where emp_id = '$emps' and company_id = '{$_SESSION['company']['id']}'");
        $fields = array();
        $fields['before_time'] = $_REQUEST['clockIn'];
        $fields['after_time'] = $_REQUEST['clockOut'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $fields['emp_id'] = $emps;
        if (empty($exist)) {
            $st = qi("tb_employee_settings", $fields);
        } else {
            $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
        }
    }
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
if (isset($_REQUEST['workAllowHoliday'])) {
    $idsArray = $_REQUEST['selectEmp'];
    $array = explode(",", $idsArray);
    if ($array[0] == "on") {
        unset($array[0]);
    }
    $array = array_values($array);
    $emplist = "";
    $boolemp = "0";
    foreach ($array as $emps) {
        $exist = qs("select * from tb_employee_settings where emp_id = '$emps' and company_id = '{$_SESSION['company']['id']}'");
        $fields = array();
        $fields['holiday_time'] = $_REQUEST['hTime'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $fields['emp_id'] = $emps;

        if (empty($exist)) {

            $st = qi("tb_employee_settings", $fields);
        } else {
            $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
        }
    }
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
if (isset($_REQUEST['toleranceAllowIn'])) {
    $idsArray = $_REQUEST['selectEmp'];
    $array = explode(",", $idsArray);
    if ($array[0] == "on") {
        unset($array[0]);
    }
    $array = array_values($array);
    $emplist = "";
    $boolemp = "0";
    foreach ($array as $emps) {
        $exist = qs("select * from tb_employee_settings where emp_id = '$emps' and company_id = '{$_SESSION['company']['id']}'");
        $fields = array();
        $fields['tolrance_timeIn'] = $_REQUEST['t_clockIn'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $fields['emp_id'] = $emps;

        if (empty($exist)) {

            $st = qi("tb_employee_settings", $fields);
        } else {
            $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
        }
    }
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
if (isset($_REQUEST['toleranceAllowOut'])) {
    $idsArray = $_REQUEST['selectEmp'];
    $array = explode(",", $idsArray);
    if ($array[0] == "on") {
        unset($array[0]);
    }
    $array = array_values($array);
    $emplist = "";
    $boolemp = "0";
    foreach ($array as $emps) {
        $exist = qs("select * from tb_employee_settings where emp_id = '$emps' and company_id = '{$_SESSION['company']['id']}'");
        $fields = array();
        $fields['tolrance_timeOut'] = $_REQUEST['t_clockOut'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $fields['emp_id'] = $emps;

        if (empty($exist)) {

            $st = qi("tb_employee_settings", $fields);
        } else {
            $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
        }
    }
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
if (isset($_REQUEST['tolerancePenalize'])) {
    $idsArray = $_REQUEST['selectEmp'];
    $array = explode(",", $idsArray);
    if ($array[0] == "on") {
        unset($array[0]);
    }
    $array = array_values($array);
    $emplist = "";
    $boolemp = "0";
    foreach ($array as $emps) {
        $exist = qs("select * from tb_employee_settings where emp_id = '$emps' and company_id = '{$_SESSION['company']['id']}'");
        $fields = array();
        $fields['penalize'] = $_REQUEST['t_penalize'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $fields['emp_id'] = $emps;

        if (empty($exist)) {

            $st = qi("tb_employee_settings", $fields);
        } else {
            $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
        }
    }
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
if (isset($_REQUEST['allowPadiDayOff'])) {
    $idsArray = $_REQUEST['selectEmp'];
    $array = explode(",", $idsArray);
    if ($array[0] == "on") {
        unset($array[0]);
    }
    $array = array_values($array);
    $emplist = "";
    $boolemp = "0";
    foreach ($array as $emps) {
        $exist = qs("select * from tb_employee_settings where emp_id = '$emps' and company_id = '{$_SESSION['company']['id']}'");
        $fields = array();
        $fields['paidDayOff'] = $_REQUEST['paidDayOff'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $fields['emp_id'] = $emps;

        if (empty($exist)) {

            $st = qi("tb_employee_settings", $fields);
        } else {
            $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
        }
    }
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
if (isset($_REQUEST['allowvacationFalls'])) {
    $idsArray = $_REQUEST['selectEmp'];
    $array = explode(",", $idsArray);
    if ($array[0] == "on") {
        unset($array[0]);
    }
    $array = array_values($array);
    $emplist = "";
    $boolemp = "0";
    foreach ($array as $emps) {
        $exist = qs("select * from tb_employee_settings where emp_id = '$emps' and company_id = '{$_SESSION['company']['id']}'");
        $fields = array();
        $fields['vacationDay'] = $_REQUEST['vacationFalls'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $fields['emp_id'] = $emps;

        if (empty($exist)) {

            $st = qi("tb_employee_settings", $fields);
        } else {
            $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
        }
    }
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
if (isset($_REQUEST['allowsickDate'])) {
    $idsArray = $_REQUEST['selectEmp'];
    $array = explode(",", $idsArray);
    if ($array[0] == "on") {
        unset($array[0]);
    }
    $array = array_values($array);
    $emplist = "";
    $boolemp = "0";
    foreach ($array as $emps) {
        $exist = qs("select * from tb_employee_settings where emp_id = '$emps' and company_id = '{$_SESSION['company']['id']}'");
        $fields = array();
        $fields['sick_day'] = $_REQUEST['sickDate'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $fields['emp_id'] = $emps;

        if (empty($exist)) {

            $st = qi("tb_employee_settings", $fields);
        } else {
            $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
        }
    }
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
if (isset($_REQUEST['allowLunchBreak'])) {
    $idsArray = $_REQUEST['selectEmp'];
    $array = explode(",", $idsArray);
    if ($array[0] == "on") {
        unset($array[0]);
    }
    $array = array_values($array);
    $emplist = "";
    $boolemp = "0";
    foreach ($array as $emps) {
        $exist = qs("select * from tb_employee_settings where emp_id = '$emps' and company_id = '{$_SESSION['company']['id']}'");
        $fields = array();
        $fields['lunch_time_counted'] = $_REQUEST['islunch'];
        $fields['company_id'] = $_SESSION['company']['id'];
        $fields['emp_id'] = $emps;

        if (empty($exist)) {

            $st = qi("tb_employee_settings", $fields);
        } else {
            $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
        }
    }
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
$UserId = $_SESSION['user']['id'];
$ProfileData = qs("select * from tb_employee where id = '$UserId'");


$jsInclude = 'shift_type.js.php';
_cg("page_title", "Shift Type");


