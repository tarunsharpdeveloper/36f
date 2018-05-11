<?php

//$isemail = $_GET['email'];
//if (!isset($_GET['email'])) {
//    _R('login');
//}
$no_visible_elements = 1;
$sign_in_error = '';
global $office;
//$_REQUEST['name'] = 'abc';
if (isset($_REQUEST['Checking'])) {
    if ($_REQUEST['ufname'] == "") {
        _R('login');
    }
    if ($_REQUEST['ulname'] == "") {
        _R('login');
    }
    if ($_REQUEST['email'] == "") {
        _R('login');
    } else {
        d($_REQUEST);
    }
//    die;
//    echo json_encode(array("success" => $success, "msg" => $msg));
//    die();
}
if (isset($_REQUEST['Add_multiple_people'])) {
//    d($_REQUEST);
//    die;
    $fname_values_array = $_REQUEST['fname'];
    $lname_values_array = $_REQUEST['lname'];
    $email_values_array = $_REQUEST['email'];
    $phone_values_array = $_REQUEST['phone_no'];
    $send_invitation = $_REQUEST['send_invitation'];

    for ($i = 0; $i < count($fname_values_array); $i++) {

        $fields['fname'] = _escape($fname_values_array[$i]);
        $fields['lname'] = _escape($lname_values_array[$i]);
        $fields['email'] = _escape($email_values_array[$i]);
        $fields['mobile'] = _escape($phone_values_array[$i]);
        $fields['work_at'] = $_REQUEST['work_at'];
        $fields['password'] = md5(12345);

        $kiosk_pin = rand(1000, 9999);
        $checkDuplicate = q("select * from tb_employee where kiosk_pin='$kiosk_pin'");
        if (!empty($checkDuplicate)) {
            $kiosk_pin = rand(1000, 9999);
        }
        $fields['kiosk_pin'] = $kiosk_pin;
        $fields['gender'] = 'male';
        $fields['access_level'] = 'Employee';
        $fields['stress_profile'] = _escape('24/7');
        $fields['pay_rates'] = 'Hourely';
        $fields['hired_on'] = date('Y-m-d h:m:s');
        qi('tb_employee', _escapeArray($fields));

//        if($send_invitation == "on"){
//            Send Invitation Code Here
//        }else{
//            nothing
//        }
    }

    _R($_SESSION['company']['default_page']);
}
if (isset($_REQUEST['SigninApprove'])) {

    $data = array();
    parse_str($_REQUEST['ladelData'], $data);
    $fields = array();
//    d(date('m-d-Y h:m:a'));
//    d($data);
//    die;


    $kiosk_pin = rand(1000, 9999);
    $checkDuplicate = q("select * from tb_employee where kiosk_pin='$kiosk_pin'");
    if (!empty($checkDuplicate)) {
        $kiosk_pin = rand(1000, 9999);
    }
    $password = md5('123456');
    $fields['fname'] = $data['emp_fname'];
    $fields['lname'] = $data['emp_lname'];
    $fields['email'] = $data['email'];
    $fields['password'] = $password;
    $fields['mobile'] = $data['c_mobile'];
    $fields['kiosk_pin'] = $kiosk_pin;
    $fields['gender'] = 'male';
    $fields['access_level'] = $data['b_title'];
    $fields['stress_profile'] = _escape('24/7');
    $fields['pay_rates'] = 'Hourely';
    $fields['hired_on'] = date('Y-m-d h:m:s');
    $st1 = qi("tb_employee", $fields);

    $fields = array();
    $EMP = qs("select * from tb_employee where kiosk_pin='$kiosk_pin'");

    $fields['default_page'] = $data['set_default_page'];
    $fields['name'] = $data['bname'];
    $fields['email'] = $data['email'];
    $fields['location'] = $data['bcity'];
    $fields['created_by'] = $EMP['id'];
    $fields['c_type'] = $data['c_type'];
    $fields['total_emp'] = $data['b_emp'];
    $fields['position'] = $data['b_title'];
    $fields['mobile_no'] = $data['c_mobile'];
    $st2 = qi("tb_company_works", $fields);

    $CMP_ID = qs("select * from tb_company_works where name='{$data['bname']}' and created_by='{$EMP['id']}' ");
    $fields = array();
    $fields['work_at'] = $CMP_ID['id'];

    $st3 = qu("tb_employee", $fields, "id= '{$EMP['id']}'");

    $user_data = qs("select * from tb_employee where  id='{$EMP['id']}' and kiosk_pin='$kiosk_pin' and email='{$data['email']}'");
    $_SESSION['user'] = $user_data;

    $company_data = qs("select * from tb_company_works where  id='{$CMP_ID['id']}'");
    $_SESSION['company'] = $company_data;
//    d($_SESSION['company']);
    if (!empty($st1) && !empty($st2) && !empty($st3)) {
        $success = "1";
        $msg = "Record Updated Successfull";
    } else {
        $success = "0";
        $msg = "Record Not Updated Successfull";
    }
    echo json_encode(array("success" => $success, "msg" => $msg, "work_at" => $CMP_ID['id']));
    die();
}
$jsInclude = 'sign_in.js.php';
_cg("page_title", "sign_in");
