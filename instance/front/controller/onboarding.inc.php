<?php

$no_visible_elements = 1;

if(!isset($_SESSION['selected_lang']) || $_SESSION['selected_lang'] == ''){
    $_SESSION['selected_lang'] = 'fa'; 
}

if ($_REQUEST['editEmployee'] == 1) {
    $editEmployee = $_REQUEST['editEmployee'];
    $type = $_REQUEST['type'];
    $employee = qs("SELECT * FROM tb_employee WHERE id='{$_REQUEST['id']}'");
    include _PATH . 'instance/front/tpl/addEmployee.php';
    die;
}
if ($_REQUEST['editEmployeeDetail'] == 1) {
    parse_str($_REQUEST['ladelData'], $data);
    $fields['fname'] = $data['fname'][0];
    $fields['lname'] = $data['lname'][0];
    $fields['email'] = $data['email'][0];
    $fields['mobile'] = $data['phone_no'][0];
    $fields['access_level'] = $data['access'][0];
    if ($data['location'][0]) {
        $fields['location'] = $data['location'][0];
    }
    if ($data['team'][0]) {
        $fields['team_id'] = $data['team'][0];
    }
    if ($data['remote'][0]) {
        $fields['is_remote'] = $data['remote'][0];
    } else {
        $fields['is_remote'] = 0;
    }
    $data = qu('tb_employee', $fields, 'id=' . $data['employeeId']);
    if ($data >= 1) {
        echo json_encode(array("success" => '1', "msg" => 'Employee data updated'));
    } else {
        echo json_encode(array("success" => '0', "msg" => 'Employee data fail to update'));
    }
    die;
}
if ($_REQUEST['checkEmail'] == 1) {
    $checkEmail = qs("select * from tb_employee where email like '{$_REQUEST['data']}'");
    if ($checkEmail['id']) {
        echo json_encode(array("success" => '0', "msg" => 'Email Already Available'));
    } else {
        echo json_encode(array("success" => '1'));
    }
    die;
}
if (isset($_REQUEST['screenTwo'])) {

    $data = array();
    parse_str($_REQUEST['ladelData'], $data);

    $fields = array();
    $kiosk_pin = rand(1000, 9999);
    $checkDuplicate = qs("select * from tb_employee where kiosk_pin='{$kiosk_pin}'");
    if (!empty($checkDuplicate)) {
        $kiosk_pin = rand(1000, 9999);
    }
   

    $password = md5($data['password']);
    $fields['fname'] = $data['fname'];
    $fields['lname'] = $data['lname'];
    $fields['email'] = $data['hidemail'];
    $fields['password'] = $password;
    $fields['mobile'] = $data['c_mobile'];
    $fields['kiosk_pin'] = $kiosk_pin;
    $fields['gender'] = 'male';
    $fields['access_level'] = $data['access'];
    $fields['stress_profile'] = _escape('24/7');
    $fields['pay_rates'] = 'Hourely';
    $fields['hired_on'] = date('Y-m-d h:m:s');
    $fields['mail_code'] = rand(100000, 999999);
   
    $st1 = qi("tb_employee", $fields);
    $fields = array();
    $fields['default_page'] = "newschedule_2";
    $fields['name'] = $data['hidbname'];
    $fields['email'] = $data['hidemail'];
    $fields['created_by'] = $st1;
    $st2 = qi("tb_company_works", $fields);
    $fields = array();
    $fields['work_at'] = $st2;
    $st3 = qu("tb_employee", $fields, "id= '{$st1}'");
    $user_data = qs("select * from tb_employee where  id='{$st1}'");

    if (!empty($st1) && !empty($st2)) {
        sendMail_code($user_data);
        $success = "1";
        $msg = "Record Inserted Successfull";
    } else {
        $success = "0";
        $msg = "Record Not Inserted Successfull";
    }
    echo json_encode(array("success" => $success, "msg" => $msg, "work_at" => $st2, "empid" => $user_data));
    die;
}
if (isset($_REQUEST['resend'])) {
    $data = array();
    $fields = array();
    parse_str($_REQUEST['ladelData'], $data);
//    $emp = qs("select * from tb_employee where id='{$data['hidempid']}'");
    $user_data = qs("select * from tb_employee where  id='{$data['hidempid']}'");
    $fields['mail_code'] = rand(100000, 999999);
    $st1 = qu("tb_employee", $fields, "id='{$user_data['id']}'");
    sendMail_code($user_data);
    if (!empty($st1)) {
        $success = "1";
        $msg = "code sent in Your Email!";
    } else {
        $success = "0";
        $msg = "Sorry! Something Wrong";
    }
    echo json_encode(array("success" => $success, "msg" => $msg));
    die;
}
if (isset($_REQUEST['changeMail'])) {
    $data = array();
    $fields = array();
    parse_str($_REQUEST['ladelData'], $data);
    $user_data = qs("select * from tb_employee where  id='{$data['hidempid']}'");
    $fields['mail_code'] = rand(100000, 999999);
    $fields['email'] = $data['changeEmail'];
    $st1 = qu("tb_employee", $fields, "id='{$user_data['id']}'");
    $fields = array();
    $fields['email'] = $data['changeEmail'];
    qu("tb_company_works", $fields, "id='{$data['hidcompid']}'");
//    sendMail_code($user_data);
    if (!empty($st1)) {
        $success = "1";
        $msg = "code sent in Your new Email!";
    } else {
        $success = "0";
        $msg = "Sorry! Something Wrong";
    }
    echo json_encode(array("success" => $success, "msg" => $msg, "work_at" => $data['hidcompid'], "empid" => $user_data));
    die;
}
if (isset($_REQUEST['screenThree'])) {
    $data = array();
    parse_str($_REQUEST['ladelData'], $data);
    $st1 = "";
    $fields = array();
    $emp = qs("select * from tb_employee where id='{$data['hidempid']}'");
    if ($data['code'] == $emp['mail_code']) {
        $fields['verify_mail'] = "1";
        $st1 = qu("tb_employee", $fields, "id='{$data['hidempid']}'");
        $success = "1";
        $msg = "Congratulation! You have successfully verified your email address";
    } else {
        $error = "1";
        $success = "0";
        $msg = "Oops! Sorry Email Not Verified, enter correct code";
    }
    echo json_encode(array("success" => $success, "msg" => $msg, "work_at" => $emp['work_at'], "empid" => $emp));
    die;
}
if (isset($_REQUEST['screenFour'])) {
    $data = array();
    parse_str($_REQUEST['ladelData'], $data);
    $st1 = '1';
    if ($data['locAddress'] != '') {
        $fields = array();
        $fields['latlng'] = $data['latlang'];
        $fields['company_id'] = $data['hidcompid'];
        $fields['name'] = _escape($data['locName']);
        $fields['address'] = _escape($data['locAddress']);
        $fields['week_starton'] = $data['locWeekStart'];

        $st1 = qi("tb_location", $fields);
    }
    $emp = qs("select * from tb_employee where id='{$data['hidempid']}'");
    $locs = q("select * from tb_location where company_id='{$data['hidcompid']}'");
    if (!empty($st1)) {
        $success = "1";
        $msg = "Congratulation! You have successfully Added location address";
    } else {
        $success = "0";
        $msg = "Oops! Sorry Something Wrong.Try Again";
    }
    echo json_encode(array("success" => $success, "msg" => $msg, "work_at" => $emp['work_at'], "empid" => $emp, "loc" => $locs));
    die;
}
if (isset($_REQUEST['saveTeam'])) {
    $data = array();
    parse_str($_REQUEST['ladelData'], $data);
    $st1 = 0;
    $areawork_values_array = $data['area'];
    $fields = array();
    $fields['is_remote'] = $data['hidisremote'];
    $st2 = qu("tb_company_works", $fields, "id='{$data['hidcompid']}'");
    foreach ($areawork_values_array as $team) {
        if (!empty($team)) {
            $fields = array();
            $fields['company_id'] = $data['hidcompid'];
            $fields['name'] = _escape($team);
            qi('tb_team', _escapeArray($fields));
            $st1++;
        }
    }
    $team = q("select * from tb_team where company_id='{$data['hidcompid']}'");
    if ($st1 == count($team)) {
        $success = "1";
        $msg = "Congratulation! You have successfully Added Team";
    } else {
        $success = "0";
        $msg = "Oops! Sorry Something Wrong.Try Again";
    }
    echo json_encode(array("success" => $success, "msg" => $msg, "isremote" => $data['hidisremote']));
    die;
}
if ($_REQUEST['loadEmployeeForm'] == 1) {
    $locationId = $_REQUEST['locationId'];
    $isremote = $_REQUEST['isremote'];
    $compId = $_REQUEST['companyId'];
    $isFirst = $_REQUEST['isFirst'];
    include _PATH . 'instance/front/tpl/loadForm.php';
    die;
}
if ($_REQUEST['loadAllSummary'] == 1) {
//    $location = "-1";
    $company_id = $_REQUEST['companyId'];
//    $company_id = "275";

    include _PATH . 'instance/front/tpl/temp_summary.php';
    die;
}
if ($_REQUEST['duplicatePhone'] == 1) {
//    $location = "-1";
    $phone = $_REQUEST['phone'];
//     d($phone);
//     die;
    $isphone = q("select * from tb_employee where mobile='$phone'");
//    d($isphone);
    if (count($isphone) >= 1) {
        $error = "-1";
        $msg = "duplicate number..please try new.";
    } else {
        $error = "1";
        $msg = "";
    }
    echo json_encode(array("error" => $error, "msg" => $msg, "phone" => $phone));
    die;
}
if ($_REQUEST['loadMoreEmp'] == 1) {
    $locationId = $_REQUEST['locationId'];
    $isremote = $_REQUEST['isremote'];
    $compId = $_REQUEST['compId'];
    $checkIsremote = $isremote == 1 ? "Checked" : "";
    $remoteClass = $isremote == 0 || $locationId != -1 ? "hidden" : "";
    $limit = ($locationId - 1) . ",1";
    if ($limit < 0) {
        $location = "0";
        $team = "0";
    } else {
        $location = qs("select * from tb_location where company_id='{$compId}' limit {$limit}");
        $teams = q("select * from tb_team where company_id='{$compId}' AND location_id='{$location['id']}'");
    }
    include _PATH . 'instance/front/tpl/addEmployee.php';

    die;
}
if (isset($_REQUEST['addTeam'])) {

    $st1 = "";
    $fields = array();
    $fields['company_id'] = $_REQUEST['compId'];
    $fields['name'] = $_REQUEST['teamName'];
    if (!empty($_REQUEST['teamName'])) {
        $st1 = qi('tb_team', _escapeArray($fields));
    } else {
        $st1 = "-1";
    }
    $team = q("select * from tb_team where company_id='{$_REQUEST['compId']}'");
    if (!empty($st1)) {
        $success = "1";
        $msg = "Congratulation! You have successfully Added Team";
    } else {
        $success = "0";
        $msg = "Oops! Sorry Something Wrong.Try Again";
    }
    echo json_encode(array("success" => $success, "msg" => $msg, "work_at" => $_REQUEST['compId'], 'team' => $team));
    die;
}
if (isset($_REQUEST['screenSix'])) {
    $data = array();
    parse_str($_REQUEST['ladelData'], $data);
    $st1 = "";
    $locationId = $data['locationId'];
    $fname_values_array = $data['fname'];
    $lname_values_array = $data['lname'];
    $email_values_array = $data['email'];
    $phone_values_array = $data['phone_no'];
    $access_values_array = $data['access'];
    $send_invitation = $data['send_invitation'];
    $team = $data['team'];
    $remote = $data['remote'];
    for ($i = 0; $i < count($fname_values_array); $i++) {
        if (!empty($fname_values_array[$i])) {
            $fields['fname'] = _escape($fname_values_array[$i]);
            $fields['lname'] = _escape($lname_values_array[$i]);
            $fields['email'] = _escape($email_values_array[$i]);
            $fields['mobile'] = _escape($phone_values_array[$i]);
            $fields['access_level'] = _escape($access_values_array[$i]);
            $teamData = qs("select * from tb_team where id='{$team}'");
            $fields['work_at'] = $teamData['company_id'];
            $fields['location'] = $locationId;
            $fields['team_id'] = _escape($team);
            $fields['password'] = md5(12345);
            $kiosk_pin = rand(1000, 9999);
            $checkDuplicate = q("select * from tb_employee where kiosk_pin='$kiosk_pin'");
            if (!empty($checkDuplicate)) {
                $kiosk_pin = rand(1000, 9999);
            }
            $fields['kiosk_pin'] = $kiosk_pin;
            $fields['gender'] = 'male';
            $fields['stress_profile'] = _escape('24/7');
            $fields['pay_rates'] = 'Hourely';
            $fields['hired_on'] = date('Y-m-d h:m:s');
            $fields['is_remote'] = $remote[$i];
            $st1 = qi('tb_employee', _escapeArray($fields));
        }
    }
    if ($_REQUEST['locationId'] != '-1') {
        $limit = ($_REQUEST['locationId'] - 1) . ",1";
        $location = qs("select * from tb_location where company_id='{$data['hidcompid']}' limit {$limit}");
        $nextlocation = $location['id'] != '' ? 1 : 0;
    } else {
        $nextlocation = -2;
    }
    $success = "1";
    $msg = "Congratulation! You have successfully Added Employees";
    echo json_encode(array("success" => $success, "msg" => $msg, "nextlocation" => $nextlocation));
    die;
}
if (isset($_REQUEST['screenSeven'])) {
    $data = array();
    parse_str($_REQUEST['ladelData'], $data);
    $st1 = "";
    $cmp_id = $data['hidcompid'];
    $emp_id = $data['hidempid'];
    $fields = array();
    $fields['default_page'] = $data['set_default_page'];
    $st1 = qu("tb_company_works", $fields, "id='$cmp_id'");

    $_SESSION['company'] = '';
    $_SESSION['user'] = '';
    $company_data = qs("select * from tb_company_works where id='{$cmp_id}'");
    $_SESSION['company'] = $company_data;
    $user_data = qs("SELECT * FROM tb_employee WHERE id='{$emp_id}'");
    $_SESSION['user'] = $user_data;
    if (!empty($st1)) {
        $success = "1";
        $msg = "Congratulation! You have successfully Set Default Page";
    } else {
        $success = "0";
        $msg = "Oops! Sorry Something Wrong.Try Again";
    }
    $unm = $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'];

    /* Delete Record from the temporary table */
    qd("tb_onboarding_lost_data", " employee_id = '{$emp_id}' ");

    echo json_encode(array("success" => $success, "msg" => $msg, "user" => $unm));
    die;
}
if (isset($_REQUEST['removeEmp'])) {
    $id = $_REQUEST['id'];
    $st1 = qd("tb_employee", "id='$id'");
    if (!empty($st1)) {
        $success = "1";
        $msg = "Record Was Deleted!";
    } else {
        $success = "0";
        $msg = "Oops! Sorry Something Wrong.Try Again";
    }
    echo json_encode(array("success" => $success, "msg" => $msg));
    die;
}
if (isset($_REQUEST['loadEmployeeList'])) {
    $company_id = _e($_REQUEST['company_id']);
    $company_locations = q(" select * from tb_location where company_id = '{$company_id}' ");
    $company_teams = q("select * from  tb_team where company_id = '{$company_id}' ");
    include _PATH . "instance/front/tpl/employee_list.php";
    die;
}

function sendMail_code($user_data) {
    $sendemail = _escape($user_data['email']);
    $subject = "Confirm email";
    ob_start();
    include _PATH . 'instance/front/tpl/mail_verify_formate.php';
    $content = ob_get_contents();
    ob_end_clean();
    // _mail($sendemail, $subject, $content);
}

if (isset($_REQUEST['savingUnsavedData']) && $_REQUEST['savingUnsavedData'] == 1) {
    $lostFields = array();
    $lostFields['employee_id'] = trim($_REQUEST['employee_id']);
    $lostFields['company_id'] = trim($_REQUEST['company_id']);
    $lostFields['stage_no'] = trim($_REQUEST['stage_no']);
    $lostFields['active_tab'] = trim($_REQUEST['active_tab']);

    $lostRes = array();
    $lostResId = 0;
    $lostRes = qs("SELECT id from tb_onboarding_lost_data WHERE employee_id = '{$lostFields['employee_id']}'");
    if (!empty($lostRes)) {
        if ($lostRes["id"] > 0) {
            $lostResId = $lostRes["id"];
        }
    }

    if ($lostFields['stage_no'] != 'mod_8') {
        if ($lostResId > 0) {
            $updateLostRecord = qu("tb_onboarding_lost_data", $lostFields, "id='{$lostResId}'");
            $insertLostId = $lostResId;
        } else {
            $insertLostId = qi("tb_onboarding_lost_data", $lostFields);
        }
    }

    $getEmployeeDetail = qs("Select * FROM tb_employee WHERE id = '{$lostFields['employee_id']}'");
    if (!empty($getEmployeeDetail)) {
        $empEmail = $getEmployeeDetail['email'];
        if ($empEmail != '') {
            $firstName = $getEmployeeDetail['fname'];
            $lastName = $getEmployeeDetail['lname'];
            $empId = $getEmployeeDetail['id']; 
            $sendemail = _escape($empEmail); 
            $subject = "Complete your Onboarding process into WHOzoor";
            ob_start();
            include _PATH . 'instance/front/tpl/mail_onboarding_complete_process_alert.php';
            $contentAlert = ob_get_contents();
            ob_end_clean();
            _mail($sendemail, $subject, $contentAlert);
        }
    }
    json_die(true, array("success" => $insertLostId));
    die;
}

$jsInclude = 'onboarding.js.php';
_cg("page_title", "onboarding");
