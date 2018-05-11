<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}
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

if (isset($_REQUEST['SetAccessModel'])) {

    $data = array();
    parse_str($_REQUEST['Formdata'], $data);
    $fields = array();

    $access_level = $data['access_level'];
    $idsArray = $data['ids_set_access_model'];
    $countsArray = $data['counts_set_access_model'];
    $array = explode(",", $idsArray);

    if ($array[0] == "on") {
        unset($array[0]);
    }
    $array = array_values($array);

    for ($i = 0; $i <= $countsArray; $i++) {
        if ($array[$i] == "on") {
            
        } else {
            $ID = $array[$i];


            $fields['access_level'] = $data['access_level'];
// d( $data['access_level']);
            $st1 = qu("tb_employee", $fields, "id='$ID'");
        }
    }
// die;
    if (!empty($st1)) {
        $success = "1";
        $msg = "Record Update Successfull";
    } else {
        $success = "0";
        $msg = "Record Update Failed";
    }
    $PostResult = q("select * from tb_employee " . helper::onlyOfficeid());

//    include _PATH . 'instance/front/tpl/people_data.php';
//    d($v);
//    die;
    echo json_encode(array("model" => "set_access_model", "success" => $success, "msg" => $msg));
    die;
}
if (isset($_REQUEST['StreesProfileModel'])) {

    $data = array();
    parse_str($_REQUEST['Formdata'], $data);
    $fields = array();

    $idsArray = $data['ids_strees_profile_model'];
    $countsArray = $data['counts_strees_profile_model'];
    $array = explode(",", $idsArray);
    if ($array[0] == "on") {
        unset($array[0]);
    }
    $array = array_values($array);

    for ($i = 0; $i <= $countsArray; $i++) {
        if ($array[$i] == "on") {
            
        } else {
            $ID = $array[$i];
            $fields['stress_profile'] = $data['stress_profile_model'];

            $st1 = qu("tb_employee", $fields, "id='$ID'");
        }
    }

    if (!empty($st1)) {
        $success = "1";
        $msg = "Record Update Successfull";
    } else {
        $success = "0";
        $msg = "Record Update Failed";
    }
    echo json_encode(array("model" => "strees_profile_model", "success" => $success, "msg" => $msg));

    die;
}
if (isset($_REQUEST['AddTrainingModel'])) {

    $data = array();
    parse_str($_REQUEST['Formdata'], $data);
    $fields = array();

    $idsArray = $data['ids_add_training_model'];
    $countsArray = $data['counts_add_training_model'];
    $array = explode(",", $idsArray);
    if ($array[0] == "on") {
        unset($array[0]);
    }
    $array = array_values($array);

    for ($i = 0; $i <= $countsArray; $i++) {
        if ($array[$i] == "on") {
            
        } else {
            $ID = $array[$i];
            $fields['training'] = implode(',', $data['training_model']);

            $st1 = qu("tb_employee", $fields, "id='$ID'");
        }
    }

    if (!empty($st1)) {
        $success = "1";
        $msg = "Record Update Successfull";
    } else {
        $success = "0";
        $msg = "Record Update Failed";
    }
    echo json_encode(array("model" => "add_training_model", "success" => $success, "msg" => $msg));

    die;
}
if (isset($_REQUEST['RefereshPeople'])) {
    $PostResult = q("select * from tb_employee  " . helper::onlyOfficeid());
    $CompanyWork = q("select * from tb_company_works");
    $StreetProfile = q("select * from tb_stress_profile");
    include _PATH . 'instance/front/tpl/people_data.php';
    die;
}
if (isset($_REQUEST['bindviewPeople'])) {
    $id = $_REQUEST['id'];
    $query = qs("select * from tb_employee where id='$id'");
//    d($query);
    echo json_encode($query);
    die;
}
if (isset($_REQUEST['discardPeople'])) {
    $id = $_REQUEST['id'];
    $fields = array();
    $fields['status'] = '1';
    $st1 = qu("tb_employee", $fields, "id='$id'");
    if (!empty($st1)) {
        $success = "1";
        $msg = "This Employee Discard Successfull";
    } else {
        $success = "0";
        $msg = "This Employee Discard Failed";
    }
    echo json_encode(array("model" => "add_training_model", "success" => $success, "msg" => $msg));

    die;
}
if (isset($_REQUEST['SetRateModel'])) {

    $data = array();
    parse_str($_REQUEST['Formdata'], $data);
    $fields = array();

    $idsArray = $data['ids_set_rate_model'];
    $countsArray = $data['counts_set_rate_model'];
    $array = explode(",", $idsArray);
    if ($array[0] == "on") {
        unset($array[0]);
    }
    $array = array_values($array);

    for ($i = 0; $i <= $countsArray; $i++) {
        if ($array[$i] == "on") {
            
        } else {
            $ID = $array[$i];
            $fields['pay_rates'] = $data['pay_rates_model'];
            $fields['weekday_rate'] = $data['weekday_rate_model'];
            $fields['saturday_rate'] = $data['saturday_rate_model'];
            $fields['sunday_rate'] = $data['sunday_rate_model'];
            $fields['public_h_rate'] = $data['public_h_rate_model'];
            $fields['hourly_rate'] = $data['hourly_rate_model'];
            $fields['overtime_rate'] = $data['overtime_rate_model'];
            $fields['monday_rate'] = $data['day_m_rate_model'];
            $fields['tuesday_rate'] = $data['day_t_rate_model'];
            $fields['wednesday_rate'] = $data['day_w_rate_model'];
            $fields['thursday_rate'] = $data['day_th_rate_model'];
            $fields['friday_rate'] = $data['day_f_rate_model'];
            $fields['day_saturday_rate'] = $data['day_sat_rate_model'];
            $fields['day_sunday_rate'] = $data['day_sun_rate_model'];
            $fields['day_holiday_rate'] = $data['day_holi_rate_model'];

            $st1 = qu("tb_employee", $fields, "id='$ID'");
        }
    }

    if (!empty($st1)) {
        $success = "1";
        $msg = "Record Update Successfull";
    } else {
        $success = "0";
        $msg = "Record Update Failed";
    }
    echo json_encode(array("model" => "set_rate_model", "success" => $success, "msg" => $msg));

    die;
}

//$PostResult = q("select tp.* , tu.fname , tu.lname , tu.email , tu.id as userid from tb_post tp, tb_users tu  where tp.create_post_id=tu.id;");
$PostResult = q("select * from tb_employee  " . helper::onlyOfficeid());
$CompanyWork = q("select * from tb_company_works");
$StreetProfile = q("select * from tb_stress_profile");
$jsInclude = 'people.js.php';
_cg("page_title", "People");

