<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}
//$_SESSION['user']['access_level']; 

if (isset($_REQUEST['add_people'])) {

    $_fields['fname'] = $_REQUEST['fname'];
    $_fields['lname'] = $_REQUEST['lname'];
    $_fields['email'] = $_REQUEST['email'];
    $_fields['mobile'] = $_REQUEST['mobile'];
    $_fields['access_level'] = $_REQUEST['access_level'];

    $_fields['work_at'] = $_REQUEST['work_at'];
    $_fields['work_at'] = implode(',', $_REQUEST['work_at']);

    $_fields['stress_profile'] = $_REQUEST['stress_profile'];
    $_fields['training'] = implode(',', $_REQUEST['training']);
    $_fields['pay_rates'] = $_REQUEST['pay_rates'];
    $_fields['weekday_rate'] = $_REQUEST['weekday_rate'];

    $_fields['saturday_rate'] = $_REQUEST['saturday_rate'];
    $_fields['sunday_rate'] = $_REQUEST['sunday_rate'];
    $_fields['public_h_rate'] = $_REQUEST['public_h_rate'];

    $_fields['hourly_rate'] = $_REQUEST['hourly_rate'];
    $_fields['overtime_rate'] = $_REQUEST['overtime_rate'];
    $_fields['annual_salary'] = $_REQUEST['annual_salary'];
    $_fields['monday_rate'] = $_REQUEST['day_m_rate'];
    $_fields['tuesday_rate'] = $_REQUEST['day_t_rate'];
    $_fields['wednesday_rate'] = $_REQUEST['day_w_rate'];
    $_fields['thursday_rate'] = $_REQUEST['day_th_rate'];
    $_fields['friday_rate'] = $_REQUEST['day_f_rate'];
    $_fields['day_saturday_rate'] = $_REQUEST['day_sat_rate'];
    $_fields['day_sunday_rate'] = $_REQUEST['day_sun_rate'];
    $_fields['day_holiday_rate'] = $_REQUEST['day_holi_rate'];

    $_fields['time_s_e_code'] = $_REQUEST['time_s_e_code'];
    $_fields['gender'] = $_REQUEST['gender'];

    $_fields['dob'] = $_REQUEST['d_o_b'];
    $_fields['hired_on'] = $_REQUEST['hired_on'];
    $_fields['address'] = $_REQUEST['address'];
    $_fields['city'] = $_REQUEST['city'];
    $_fields['country'] = $_REQUEST['country'];

    $_fields['post_code'] = $_REQUEST['postcode'];
    $_fields['em_contact_name'] = $_REQUEST['e_c_name'];
    $_fields['em_phone'] = $_REQUEST['e_phone'];
    $fields['password'] = md5(12345);
    $ap = qi("tb_employee", $_fields);

    if (!empty($ap)) {
        $success = "1";
        $msg = "People inserted Successfull";
    } else {
        $success = "0";
        $msg = "People Not inserted Successfull";
    }
    //echo json_encode(array("success" => $success, "msg" => $msg));

    _R('people');
}
if (isset($_REQUEST['isEditLoc'])) {
//    d($_REQUEST);
//    die;
    $data = array();
    parse_str($_REQUEST['ladelData'], $data);
    $id = $data['hidlocid'];
    $fields = array();
    $fields['company_id'] = $_SESSION['company']['id'];
    $fields['name'] = $data['locName'];
    $fields['address'] = $data['locAddress'];
    $fields['week_starton'] = $data['locWeekStart'];
    $fields['latlng'] = $data['latlang'];
    $fields['timezone'] = $data['locTimeZone'];
    $st = qu("tb_location", $fields, "id='$id'");
    $loc = qs("select * from tb_location where id='$id' and company_id='{$_SESSION['company']['id']}'");
    if (!empty($st)) {
        $success = "1";
        $msg = "This Location Updated Successfull";
    } else {
        $success = "0";
        $msg = "This Location Update Failed";
    }
    echo json_encode(array("success" => $success, "msg" => $msg, "loc" => $loc));
    die;
}

if (isset($_REQUEST['discardLocation'])) {
    $id = $_REQUEST['id'];
    if (!checkAccessLevel($_SESSION['user']['access_level'], 'locations', 'delete')) {
        $success = "0";
        $msg = "You have no permission for delete the location.";  
    } else {
        $st1 = qd("tb_location", "id='$id'");
        if (!empty($st1)) {
            $success = "1";
            $msg = "This Location Discard Successfull";
        } else {
            $success = "0";
            $msg = "This Location Discard Failed";
        }
    } 

    echo json_encode(array("success" => $success, "msg" => $msg));

    die;
}
if (isset($_REQUEST['bindLocation'])) {
    $id = $_REQUEST['id'];
    $loc = qs("select * from tb_location where id='$id' and company_id='{$_SESSION['company']['id']}'");
//    d($loc);
//    die;
    echo json_encode($loc);

    die;
}
//$PostResult = q("select tp.* , tu.fname , tu.lname , tu.email , tu.id as userid from tb_post tp, tb_users tu  where tp.create_post_id=tu.id;");
$PostResult = q("select * from tb_employee  " . helper::onlyOfficeid());
$CompanyWork = q("select * from tb_company_works");
$StreetProfile = q("select * from tb_stress_profile");
$locations = q("select * from tb_location where company_id='{$_SESSION['company']['id']}'");
$jsInclude = 'location.js.php';
_cg("page_title", "Location");

