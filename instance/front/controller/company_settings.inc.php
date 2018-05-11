<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}
//$emp = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'");
//echo  helper::officeCond() . helper::OrderByDesc();
if (isset($_REQUEST['bindAllSettings'])) {
    $exist = qs("select * from tb_setting where company_id ='{$_SESSION['company']['id']}'");
    echo json_encode($exist);
    die;
}
if (isset($_REQUEST['BindEmployee'])) {
    $searchKey = $_REQUEST['searchKey'];
    if ($searchKey == "*") {
        $emp = q("select * from tb_employee where work_at ='{$_SESSION['company']['id']}'");
//        $lastQuery = "";
    } else {
        $emp = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}' and access_level LIKE '%" . $searchKey . "%'");
//        $lastQuery = "and access_level LIKE '%" . $searchKey . "%'";
    }
//    include _PATH . 'instance/front/tpl/company_settings_data.php';
//    die;
    echo json_encode($emp);
    die;
}
if (isset($_REQUEST['shiftAllowClock'])) {
    $selectGroup = $_REQUEST['selectGroup'];
    $emplist = "";
    $boolemp = "0";
    foreach ($_REQUEST['selectEmp'] as $emps) {
        if ($emps == "*") {
            $boolemp = "1";
        }
    }
    if ($boolemp == "1") {
//        d($boolemp);
        if ($selectGroup == "*") {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}'");
        } else {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        }
//        $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        foreach ($listemp as $EMP) {
            $exist = qs("select * from tb_employee_settings where emp_id = '{$EMP['id']}' and company_id = '{$_SESSION['company']['id']}'");
            $fields = array();
            $fields['before_time'] = $_REQUEST['clockIn'];
            $fields['after_time'] = $_REQUEST['clockOut'];
            $fields['company_id'] = $_SESSION['company']['id'];
            $fields['emp_id'] = $EMP['id'];
            if (empty($exist)) {
                $st = qi("tb_employee_settings", $fields);
            } else {
                $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
            }
        }
    } else {
        foreach ($_REQUEST['selectEmp'] as $emps) {
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
    }
//     dd($_REQUEST);
//    die;
//    $exist = qs("select * from tb_setting where company_id = '{$_SESSION['company']['id']}'");
//    $fields = array();
//    $fields['before_time'] = $_REQUEST['clockIn'];
//    $fields['after_time'] = $_REQUEST['clockOut'];
//    $fields['company_id'] = $_SESSION['company']['id'];
//    if (empty($exist)) {
//
//        $st = qi("tb_setting", $fields);
//    } else {
//        $st = qu("tb_setting", $fields, "id = '{$exist[id]}'");
//    }
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
    $selectGroup = $_REQUEST['selectGroup'];
    $emplist = "";
    $boolemp = "0";
    foreach ($_REQUEST['selectEmp'] as $emps) {
        if ($emps == "*") {
            $boolemp = "1";
        }
    }
    if ($boolemp == "1") {
//        d($boolemp);
        if ($selectGroup == "*") {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}'");
        } else {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        }
//        $listemp = q("select id from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        foreach ($listemp as $EMP) {
//            d($EMP);
//            die;
            $exist = qs("select * from tb_employee_settings where emp_id = '{$EMP['id']}' and company_id = '{$_SESSION['company']['id']}'");
            $fields = array();
            $fields['holiday_time'] = $_REQUEST['hTime'];
            $fields['company_id'] = $_SESSION['company']['id'];
            $fields['emp_id'] = $EMP['id'];
            if (empty($exist)) {

                $st = qi("tb_employee_settings", $fields);
            } else {
                $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
            }
        }
//        die;
    } else {
        foreach ($_REQUEST['selectEmp'] as $emps) {
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
    }
//    d($_REQUEST);
//    die;
//    $exist = qs("select * from tb_setting where company_id = '{$_SESSION['company']['id']}'");
//    $fields = array();
//    $fields['holiday_time'] = $_REQUEST['hTime'];
//    $fields['company_id'] = $_SESSION['company']['id'];
//    if (empty($exist)) {
//        $st = qi("tb_setting", $fields);
//    } else {
//        $st = qu("tb_setting", $fields, "id = '{$exist[id]}'");
//    }
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
    $selectGroup = $_REQUEST['selectGroup'];
    $emplist = "";
    $boolemp = "0";
    foreach ($_REQUEST['selectEmp'] as $emps) {
        if ($emps == "*") {
            $boolemp = "1";
        }
    }
    if ($boolemp == "1") {
//        d($boolemp);
        if ($selectGroup == "*") {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}'");
        } else {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        }
//        $listemp = q("select id from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        foreach ($listemp as $EMP) {
            $exist = qs("select * from tb_employee_settings where emp_id = '{$EMP['id']}' and company_id = '{$_SESSION['company']['id']}'");
            $fields = array();
            $fields['tolrance_timeIn'] = $_REQUEST['t_clockIn'];
            $fields['company_id'] = $_SESSION['company']['id'];
            $fields['emp_id'] = $EMP['id'];
            if (empty($exist)) {
                $st = qi("tb_employee_settings", $fields);
            } else {
                $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
            }
        }
    } else {
        foreach ($_REQUEST['selectEmp'] as $emps) {
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
    }
//    d($_REQUEST);
//    die;
//    $exist = qs("select * from tb_setting where company_id = '{$_SESSION['company']['id']}'");
//    $fields = array();
//    $fields['tolrance_timeIn'] = $_REQUEST['t_clockIn'];
//    $fields['company_id'] = $_SESSION['company']['id'];
//    if (empty($exist)) {
//        $st = qi("tb_setting", $fields);
//    } else {
//        $st = qu("tb_setting", $fields, "id = '{$exist[id]}'");
//    }
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
    $emplist = "";
    $boolemp = "0";
    $selectGroup = $_REQUEST['selectGroup'];
    foreach ($_REQUEST['selectEmp'] as $emps) {
        if ($emps == "*") {
            $boolemp = "1";
        }
    }
    if ($boolemp == "1") {
//        d($boolemp);
        if ($selectGroup == "*") {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}'");
        } else {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        }
//        $listemp = q("select id from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        foreach ($listemp as $EMP) {
            $exist = qs("select * from tb_employee_settings where emp_id = '{$EMP['id']}' and company_id = '{$_SESSION['company']['id']}'");
            $fields = array();
            $fields['tolrance_timeOut'] = $_REQUEST['t_clockOut'];
            $fields['company_id'] = $_SESSION['company']['id'];
            $fields['emp_id'] = $EMP['id'];
            if (empty($exist)) {
                $st = qi("tb_employee_settings", $fields);
            } else {
                $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
            }
        }
    } else {
        foreach ($_REQUEST['selectEmp'] as $emps) {
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
    }
//    d($_REQUEST);
//    die;
//    $exist = qs("select * from tb_setting where company_id = '{$_SESSION['company']['id']}'");
//    $fields = array();
//    $fields['tolrance_timeOut'] = $_REQUEST['t_clockOut'];
//    $fields['company_id'] = $_SESSION['company']['id'];
//    if (empty($exist)) {
//        $st = qi("tb_setting", $fields);
//    } else {
//        $st = qu("tb_setting", $fields, "id = '{$exist[id]}'");
//    }
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
    $emplist = "";
    $boolemp = "0";
    $selectGroup = $_REQUEST['selectGroup'];
    foreach ($_REQUEST['selectEmp'] as $emps) {
        if ($emps == "*") {
            $boolemp = "1";
        }
    }
    if ($boolemp == "1") {
//        d($boolemp);
        if ($selectGroup == "*") {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}'");
        } else {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        }
//        $listemp = q("select id from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        foreach ($listemp as $EMP) {
            $exist = qs("select * from tb_employee_settings where emp_id = '{$EMP['id']}' and company_id = '{$_SESSION['company']['id']}'");
            $fields = array();
            $fields['penalize'] = $_REQUEST['t_penalize'];
            $fields['company_id'] = $_SESSION['company']['id'];
            $fields['emp_id'] = $EMP['id'];
            if (empty($exist)) {
                $st = qi("tb_employee_settings", $fields);
            } else {
                $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
            }
        }
    } else {
        foreach ($_REQUEST['selectEmp'] as $emps) {
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
    }
//    d($_REQUEST);
//    die;
//    $exist = qs("select * from tb_setting where company_id = '{$_SESSION['company']['id']}'");
//    $fields = array();
//    $fields['tolrance_timeOut'] = $_REQUEST['t_clockOut'];
//    $fields['company_id'] = $_SESSION['company']['id'];
//    if (empty($exist)) {
//        $st = qi("tb_setting", $fields);
//    } else {
//        $st = qu("tb_setting", $fields, "id = '{$exist[id]}'");
//    }
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
    $emplist = "";
    $boolemp = "0";
    $selectGroup = $_REQUEST['selectGroup'];
    foreach ($_REQUEST['selectEmp'] as $emps) {
        if ($emps == "*") {
            $boolemp = "1";
        }
    }
    if ($boolemp == "1") {
//        d($boolemp);
        if ($selectGroup == "*") {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}'");
        } else {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        }
//        $listemp = q("select id from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        foreach ($listemp as $EMP) {
            $exist = qs("select * from tb_employee_settings where emp_id = '{$EMP['id']}' and company_id = '{$_SESSION['company']['id']}'");
            $fields = array();
            $fields['paidDayOff'] = $_REQUEST['paidDayOff'];
            $fields['company_id'] = $_SESSION['company']['id'];
            $fields['emp_id'] = $EMP['id'];
            if (empty($exist)) {
                $st = qi("tb_employee_settings", $fields);
            } else {
                $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
            }
        }
    } else {
        foreach ($_REQUEST['selectEmp'] as $emps) {
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
    }
//    d($_REQUEST);
//    die;
//    $exist = qs("select * from tb_setting where company_id = '{$_SESSION['company']['id']}'");
//    $fields = array();
//    $fields['paidDayOff'] = $_REQUEST['paidDayOff'];
//    $fields['company_id'] = $_SESSION['company']['id'];
//    if (empty($exist)) {
//        $st = qi("tb_setting", $fields);
//    } else {
//        $st = qu("tb_setting", $fields, "id = '{$exist[id]}'");
//    }
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
    $emplist = "";
    $boolemp = "0";
    $selectGroup = $_REQUEST['selectGroup'];
    foreach ($_REQUEST['selectEmp'] as $emps) {
        if ($emps == "*") {
            $boolemp = "1";
        }
    }
    if ($boolemp == "1") {
//        d($boolemp);
        if ($selectGroup == "*") {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}'");
        } else {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        }
//        $listemp = q("select id from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        foreach ($listemp as $EMP) {
            $exist = qs("select * from tb_employee_settings where emp_id = '{$EMP['id']}' and company_id = '{$_SESSION['company']['id']}'");
            $fields = array();
            $fields['vacationDay'] = $_REQUEST['vacationFalls'];
            $fields['company_id'] = $_SESSION['company']['id'];
            $fields['emp_id'] = $EMP['id'];
            if (empty($exist)) {
                $st = qi("tb_employee_settings", $fields);
            } else {
                $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
            }
        }
    } else {
        foreach ($_REQUEST['selectEmp'] as $emps) {
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
    }
//    d($_REQUEST);
//    die;
//    $exist = qs("select * from tb_setting where company_id = '{$_SESSION['company']['id']}'");
//    $fields = array();
//    $fields['vacationDay'] = $_REQUEST['vacationFalls'];
//    $fields['company_id'] = $_SESSION['company']['id'];
//    if (empty($exist)) {
//        $st = qi("tb_setting", $fields);
//    } else {
//        $st = qu("tb_setting", $fields, "id = '{$exist[id]}'");
//    }
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
    $emplist = "";
    $boolemp = "0";
    $selectGroup = $_REQUEST['selectGroup'];
    foreach ($_REQUEST['selectEmp'] as $emps) {
        if ($emps == "*") {
            $boolemp = "1";
        }
    }
    if ($boolemp == "1") {
//        d($boolemp);
        if ($selectGroup == "*") {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}'");
        } else {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        }
//        $listemp = q("select id from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        foreach ($listemp as $EMP) {
            $exist = qs("select * from tb_employee_settings where emp_id = '{$EMP['id']}' and company_id = '{$_SESSION['company']['id']}'");
            $fields = array();
            $fields['sick_day'] = $_REQUEST['sickDate'];
            $fields['company_id'] = $_SESSION['company']['id'];
            $fields['emp_id'] = $EMP['id'];
            if (empty($exist)) {
                $st = qi("tb_employee_settings", $fields);
            } else {
                $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
            }
        }
    } else {
        foreach ($_REQUEST['selectEmp'] as $emps) {
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
    }
//    d($_REQUEST);
//    die;
//    $exist = qs("select * from tb_setting where company_id = '{$_SESSION['company']['id']}'");
//    $fields = array();
//    $fields['sick_day'] = $_REQUEST['sickDate'];
//    $fields['company_id'] = $_SESSION['company']['id'];
//    if (empty($exist)) {
//        $st = qi("tb_setting", $fields);
//    } else {
//        $st = qu("tb_setting", $fields, "id = '{$exist[id]}'");
//    }
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
//    d($_REQUEST);
//    die;
    $emplist = "";
    $boolemp = "0";
    $selectGroup = $_REQUEST['selectGroup'];
    foreach ($_REQUEST['selectEmp'] as $emps) {
        if ($emps == "*") {
            $boolemp = "1";
        }
    }
    if ($boolemp == "1") {
//        d($boolemp);
        if ($selectGroup == "*") {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}'");
        } else {
            $listemp = q("select * from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        }
//        $listemp = q("select id from tb_employee where work_at = '{$_SESSION['company']['id']}' and access_level LIKE '%" . $selectGroup . "%'");
        foreach ($listemp as $EMP) {
            $exist = qs("select * from tb_employee_settings where emp_id = '{$EMP['id']}' and company_id = '{$_SESSION['company']['id']}'");
            $fields = array();
            $fields['lunch_time_counted'] = $_REQUEST['islunch'];
            $fields['company_id'] = $_SESSION['company']['id'];
            $fields['emp_id'] = $EMP['id'];
            if (empty($exist)) {
                $st = qi("tb_employee_settings", $fields);
            } else {
                $st = qu("tb_employee_settings", $fields, "id = '{$exist[id]}'");
            }
        }
    } else {
        foreach ($_REQUEST['selectEmp'] as $emps) {
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


$jsInclude = 'company_settings.js.php';
_cg("page_title", "Settings");


