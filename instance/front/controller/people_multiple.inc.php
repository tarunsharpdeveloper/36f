<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}
if (isset($_REQUEST['Add_multiple_people'])) {

    $name_values_array = $_REQUEST['name'];
    $email_values_array = $_REQUEST['email'];
    $phone_values_array = $_REQUEST['phone_no'];
    $send_invitation = $_REQUEST['send_invitation'];

    for ($i = 0; $i < count($name_values_array); $i++) {

        $fields['fname'] = _escape($name_values_array[$i]);
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

    _R('people');
}


$jsInclude = 'people_multiple.js.php';
_cg("page_title", "People Multiple");

