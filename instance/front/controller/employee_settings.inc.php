<?php 
if (!isset($_SESSION['user'])) {
    _R('login');
}

$isAdmin = 0;
$companyId = 0;
$teamId = $_SESSION['user']['team_id'];
$companyId = $_SESSION['user']['work_at'];

if (strtolower($_SESSION['user']['access_level']) == 'admin' || strtolower($_SESSION['user']['access_level']) == 'manager') {
    $isAdmin = 1;
}
   
$whereRelatedEmployee = '';
$whereRelatedEmpIds = '';
if ($teamId > 0 && $isAdmin == 0) {
    if (strtolower($_SESSION['user']['access_level']) == 'employee') {
        $whereRelatedEmployee = ' AND id IN (' . $_SESSION['user']['id'] . ')';
        $whereRelatedEmpIds = ' AND emp_id IN (' . $_SESSION['user']['id'] . ')';
    } else {
        $employeeIdsList = employee::getTeamEmployeesIds($companyId, $teamId);
        if (empty($employeeIdsList)) {
            $employeeIdsList[] = 0;
        }
        $employeeIdsListStr = implode(",", $employeeIdsList);
        $whereRelatedEmployee = ' AND id IN (' . $employeeIdsListStr . ')';
        $whereRelatedEmpIds = ' AND emp_id IN (' . $employeeIdsListStr . ')'; 
    }
}



//$emp = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'");
//echo  helper::officeCond() . helper::OrderByDesc();
if (isset($_REQUEST['bindAllSettings'])) {
    $exist = qs("select * from tb_setting where company_id ='{$_SESSION['company']['id']}'");

    echo json_encode($exist);

    die;
}

if (isset($_REQUEST['time_limit'])) {
    $limit = intval($_REQUEST['time_limit']);
    $id = _e($_SESSION['user']['id'], 0);
    qu("tb_employee_settings", array('time_limit_time_stamp_abandon' => $limit), " emp_id = '{$id}' ");
    die;
}
if (isset($_REQUEST['BindEmployee'])) {
    $searchKey = $_REQUEST['searchKey'];
    if ($searchKey == "*") {
        $emp = q("select * from tb_employee where work_at ='{$_SESSION['company']['id']}'".$whereRelatedEmployee);
        $lastQuery = "";
    } else {
        $emp = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}' and access_level LIKE '%" . $searchKey . "%'".$whereRelatedEmployee);
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
        $emp = q("select * from tb_employee where work_at ='{$_SESSION['company']['id']}'".$whereRelatedEmployee);
        $lastQuery = "";
    } else {
        $emp = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}' and access_level LIKE '%" . $searchKey . "%'".$whereRelatedEmployee);
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
        //$fields['tolrance_timeIn'] = strtotime($_REQUEST['t_clockIn']);
        $fields['tolrance_timeIn'] = trim($_REQUEST['t_clockIn']);
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
        $fields['tolrance_timeOut'] = trim($_REQUEST['t_clockOut']);
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
        $fields['paidroll'] = $_REQUEST['paidroll'];
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
        $fields['vacationroll'] = $_REQUEST['vacationroll'];
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
        $fields['sickroll'] = $_REQUEST['sickroll'];
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



$settings_data = qs("select * from tb_employee_settings where emp_id = '{$UserId}'");    

if (empty($settings_data)) {
    qi('tb_employee_settings', array("emp_id" => $UserId, "company_id" => $_SESSION['company']['id']));
} 



$jsInclude = 'employee_settings.js.php';
_cg("page_title", "Settings");


