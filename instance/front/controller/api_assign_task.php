<?php
//d($_REQUEST);
$emplist = "";
$flag = "false";
$boolemp = "0";
$sdate = explode("-",$_REQUEST['due_date']);
$gdate = jalali_to_gregorian($sdate[0], ltrim($sdate[1], "0"), ltrim($sdate[2], "0"));
foreach ($_REQUEST['assign_to'] as $emps) {
    if ($emps == "*") {
        $boolemp = "1";
    }
}

if ($boolemp == "1") {
//        d($boolemp);
    $listemp = q("select * from tb_employee where not id='{$_REQUEST['create_by']}' and work_at = '{$_REQUEST['company_id']}'");
    foreach ($listemp as $EMP) {
//            d($EMP);

        $_fields['title'] = $_REQUEST['title'];
        $_fields['company_id'] = $_REQUEST['company_id'];
        $_fields['due_date'] = $gdate[0]."-".str_pad($gdate[1],"2","0",STR_PAD_LEFT)."-".str_pad($gdate[2],"2","0",STR_PAD_LEFT);
        $_fields['created_by'] = $_REQUEST['create_by'];
        $_fields['assign_to'] = $EMP['id'];
        $_fields['notes'] = _escape($_REQUEST['notes']);
        $st1 = qi("tb_task", $_fields);

//        
//        $emplist .= "" . $EMP . "-";
    }

    if (!empty($st1)) {
        $fields = array();
        $fields['company_id'] = $_REQUEST['company_id'];
        $fields['emp_id'] = $_REQUEST['create_by'];
        $fields['log'] = "Created New Task as " . $_REQUEST['title'];
        $fields['task_to'] = "*";
        qi("tb_employee_log", $fields);
    }
} else {
    foreach ($_REQUEST['assign_to'] as $EMP) {

        $_fields['title'] = $_REQUEST['title'];
        $_fields['company_id'] = $_REQUEST['company_id'];
        $_fields['due_date'] = $gdate[0]."-".str_pad($gdate[1],"2","0",STR_PAD_LEFT)."-".str_pad($gdate[2],"2","0",STR_PAD_LEFT);
        $_fields['created_by'] = $_REQUEST['create_by'];
        $_fields['assign_to'] = $EMP;
        $_fields['notes'] = _escape($_REQUEST['notes']);


        $st1 = qi("tb_task", $_fields);
        if (!empty($st1)) {
            $fields = array();
            $fields['company_id'] = $_REQUEST['company_id'];
            $fields['emp_id'] = $_REQUEST['create_by'];
            $fields['log'] = "Created New Task as " . $_REQUEST['title'];
            $fields['task_to'] = $EMP;
            qi("tb_employee_log", $fields);
        }
//        
//        $emplist .= "" . $EMP . "-";
    }
}
if (!empty($st1)) {
    $flag = "true";
    $fields = array();
    $fields['result'] = "success";
    $fields['is_added'] = $flag;
//    $fields['shiftid'] = $Shift['id'];

    $fields['msg'] = "task was Added";
    echo _api_response($fields);
} else {
    $fields = array();
    $fields['result'] = "error";
    $fields['is_added'] = $flag;
//    $fields['shiftid'] = "-1";
    $fields['msg'] = "task was not added";
    echo _api_response($fields);
}
die;
?>