<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}
if (isset($_REQUEST['deleteTask'])) {
    $ID = $_REQUEST['id'];
//    d($_REQUEST['id']);
//    die();
    $st = qd("tb_task", "id='$ID'");
//    d($st);
//    die;
//    _R(task);
    if (!$st == "") {
        $success = "1";
        $msg = "Record Discard Successfull";
    } else {
        $success = "0";
        $msg = "Record Not Discard Successfull";
    }

    $TaskData = q("select tt.*,te.fname,te.lname from tb_task tt,tb_employee te where tt.created_by=te.id and tt.status='0'" . helper::officeid());
    $AssignTaskData = q("select tt.*,te.fname,te.lname from tb_task tt,tb_employee te where tt.assign_to=te.id and tt.status='0' " . helper::officeid());
    $TaskCompleted = q("select tt.*,te.fname,te.lname from tb_task tt,tb_employee te where tt.assign_to=te.id and tt.status='1' " . helper::officeid());

//    d($msg);
//    echo json_encode(array("success" => $success, "msg" => $msg));
//        _R('task');
    include _PATH . 'instance/front/tpl/task_data.php';
    die;
}
if (isset($_REQUEST['doneTask'])) {
    $ID = $_REQUEST['id'];
    $taskDetail = qs("select * from tb_task where id='$ID'");

    $fields = array();
    $fields['status'] = 1;
    $fields['task_doneby'] = $_SESSION['user']['id'];

    $st1 = qu("tb_task", $fields, "id='{$taskDetail['id']}'");
// d($st1);
//    die;
    if (!empty($st1)) {
        $fields = array();
        $fields['company_id'] = $_SESSION['user']['work_at'];
        $fields['emp_id'] = $_SESSION['user']['id'];
        $fields['log'] = "Task[ <b>" . $taskDetail['title'] . "</b> ] Compelted";
        $fields['task_to'] = $ID;
        qi("tb_employee_log", $fields);
    }
    if (!$st == "") {
        $success = "1";
        $msg = "Record Updated Successfull";
    } else {
        $success = "0";
        $msg = "Record Not Updated Successfull";
    }

    $EmployeeData = q("select * from tb_employee" . helper::onlyOfficeid());

    $TaskData = q("select tt.*,te.fname,te.lname from tb_task tt,tb_employee te where tt.created_by=te.id and tt.status='0'" . helper::officeid());
    $AssignTaskData = q("select tt.*,te.fname,te.lname from tb_task tt,tb_employee te where tt.assign_to=te.id and tt.status='0' " . helper::officeid());
    $TaskCompleted = q("select tt.*,te.fname,te.lname from tb_task tt,tb_employee te where tt.assign_to=te.id and tt.status='1' " . helper::officeid());

//    d($msg);
//    echo json_encode(array("success" => $success, "msg" => $msg));
//        _R('task');
    include _PATH . 'instance/front/tpl/task_data.php';
    die;
}
if (isset($_REQUEST['save_task'])) {
//    d($_REQUEST);
//    die;
    $emplist = "";
    $boolemp = "0";
    foreach ($_REQUEST['assign_to'] as $emps) {
        if ($emps == "*") {
            $boolemp = "1";
        }
    }

    if ($boolemp == "1") {
//        d($boolemp);
        $listemp = q("select * from tb_employee where not id='{$_SESSION['user']['id']}' " . helper::officeid());
        foreach ($listemp as $EMP) {
//            d($EMP);

            $_fields['title'] = $_REQUEST['title'];
            $_fields['company_id'] = $_SESSION['company']['id'];
            $_fields['due_date'] = $_REQUEST['due_date'];
            $_fields['created_by'] = $_REQUEST['create_by'];
            $_fields['assign_to'] = $EMP['id'];
            $_fields['notes'] = _escape($_REQUEST['notes']);
            $st1 = qi("tb_task", $_fields);


//        
//        $emplist .= "" . $EMP . "-";
        }

        if (!empty($st1)) {
            $fields = array();
            $fields['company_id'] = $_SESSION['user']['work_at'];
            $fields['emp_id'] = $_SESSION['user']['id'];
            $fields['log'] = "Created New Task as " . $_REQUEST['title'];
            $fields['task_to'] = "*";
            qi("tb_employee_log", $fields);
        }
    } else {
        foreach ($_REQUEST['assign_to'] as $EMP) {

            $_fields['title'] = $_REQUEST['title'];
            $_fields['company_id'] = $_SESSION['company']['id'];
            $_fields['due_date'] = $_REQUEST['due_date'];
            $_fields['created_by'] = $_REQUEST['create_by'];
            $_fields['assign_to'] = $EMP;
            $_fields['notes'] = _escape($_REQUEST['notes']);


            $st1 = qi("tb_task", $_fields);
            if (!empty($st1)) {
                $fields = array();
                $fields['company_id'] = $_SESSION['user']['work_at'];
                $fields['emp_id'] = $_SESSION['user']['id'];
                $fields['log'] = "Created New Task as " . $_REQUEST['title'];
                $fields['task_to'] = $EMP;
                qi("tb_employee_log", $fields);
            }
//        
//        $emplist .= "" . $EMP . "-";
        }
    }





//    $st1 = qi("tb_task", $_fields);
//    if (!empty($st1)) {
//        $fields = array();
//        $fields['company_id'] = $_SESSION['user']['work_at'];
//        $fields['emp_id'] = $_SESSION['user']['id'];
//        $fields['log'] = "Created New Task as " . $_REQUEST['title'];
//        $fields['task_to'] = $_REQUEST['assign_to'];
//        qi("tb_employee_log", $fields);
//    }
    _R('task');
}

$EmployeeData = q("select * from tb_employee" . helper::onlyOfficeid());
$TaskData = q("select tt.*,te.fname,te.lname from tb_task tt,tb_employee te where tt.created_by=te.id and tt.status='0'" . helper::officeid());
$AssignTaskData = q("select tt.*,te.fname,te.lname from tb_task tt,tb_employee te where tt.assign_to=te.id and tt.status='0' " . helper::officeid());
$TaskCompleted = q("select tt.*,te.fname,te.lname from tb_task tt,tb_employee te where tt.assign_to=te.id and tt.status='1' " . helper::officeid());

$jsInclude = 'task.js.php';
_cg("page_title", "Task");


