<?php

$stage1 = q("select * from tb_driver where stage=1 ");
$stage2 = q("select * ,d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no,v.make_modal,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=3  and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4");
//$stage3 = q("select * from tb_driver where stage=3 ");
$stage4 = q("select * ,d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no,v.make_modal,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=4  and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4");

$stage5 = q("select * ,d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no,v.make_modal,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=5  and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4");
// d($stage1);
// die();
if (isset($_REQUEST['getData1'])) {
    $select_id = $_REQUEST['id'];
    $query2 = qs("select * from tb_driver d, tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=1 and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and d.id='$select_id'");
//    d($query2);
//    die();
    $vin_arr = explode('-', $query2["license_plate"]);
    $query2["vin_lic_no1"] = $vin_arr[0];
    $query2["vin_lic_no2"] = $vin_arr[1];
    $query2["vin_lic_no3"] = $vin_arr[2];

    $arr = explode('-', $query2["license_expiry_date"]);
    $query2["years"] = $arr[0];
    $query2["months"] = $arr[1] + 0;
    $query2["date"] = $arr[2] + 0;


    $darr = explode('-', $query2["dob"]);
    $query2["dyears"] = $darr[0];
    $query2["dmonths"] = $darr[1] + 0;
    $query2["ddate"] = $darr[2] + 0;

    $marr = explode('-', $query2["melli_expiry_date"]);
    $query2["myears"] = $marr[0];
    $query2["mmonths"] = $marr[1] + 0;
    $query2["mdate"] = $marr[2] + 0;

    $iarr = explode('-', $query2["insurance_expiration_date"]);
    $query2["iyears"] = $iarr[0];
    $query2["imonths"] = $iarr[1] + 0;
    $query2["idate"] = $iarr[2] + 0;

    $sarr = explode('-', $query2["smog_expiry_date"]);
    $query2["syears"] = $sarr[0];
    $query2["smonths"] = $sarr[1] + 0;
    $query2["sdate"] = $sarr[2] + 0;

    echo json_encode($query2);
    die;
//    die();
}
//if (isset($_REQUEST['save'])) {
//
//    $driver_id = $_REQUEST['d_id'];
////    d($driver_id);
////    die();
//    $_fields['fname'] = $_REQUEST['fName'];
//    $_fields['lname'] = $_REQUEST['lName'];
//    $_fields['melli_no'] = $_REQUEST['melli_no'];
//    $_fields['license_plate'] = $_REQUEST['veh_lic_no1'];
//    $_fields['phone'] = $_REQUEST['phone'];
//    $_fields['email'] = $_REQUEST['email'];
//    $up = qu("tb_driver", $_fields, "id='$driver_id'");
////    d($up);
////    die();
//    if (!empty($up)) {
//        _R('manager');
//    } else {
//        return error_reporting();
//    }
//}

if (isset($_REQUEST['getData2'])) {
    $d_id = $_REQUEST['id'];
    $st3 = qs("select * from tb_driver d, tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=3 and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and d.id='$d_id'");
//  d($st3);
    $vin_arr = explode('-', $st3["license_plate"]);
    $st3["vin_lic_no1"] = $vin_arr[0];
    $st3["vin_lic_no2"] = $vin_arr[1];
    $st3["vin_lic_no3"] = $vin_arr[2];

    $arr = explode('-', $st3["license_expiry_date"]);
    $st3["years"] = $arr[0];
    $st3["months"] = $arr[1] + 0;
    $st3["date"] = $arr[2] + 0;


    $darr = explode('-', $st3["dob"]);
    $st3["dyears"] = $darr[0];
    $st3["dmonths"] = $darr[1] + 0;
    $st3["ddate"] = $darr[2] + 0;

    $marr = explode('-', $st3["melli_expiry_date"]);
    $st3["myears"] = $marr[0];
    $st3["mmonths"] = $marr[1] + 0;
    $st3["mdate"] = $marr[2] + 0;

    $iarr = explode('-', $st3["insurance_expiration_date"]);
    $st3["iyears"] = $iarr[0];
    $st3["imonths"] = $iarr[1] + 0;
    $st3["idate"] = $iarr[2] + 0;

    $sarr = explode('-', $st3["smog_expiry_date"]);
    $st3["syears"] = $sarr[0];
    $st3["smonths"] = $sarr[1] + 0;
    $st3["sdate"] = $sarr[2] + 0;

    echo json_encode($st3);
    die();
//    die();
}
if (isset($_REQUEST['move'])) {
    $d_id = $_REQUEST['did'];
    foreach ($_POST['station'] as $key => $value) {
        $_fields['stage'] = $value;
        $station_stage = $value;
    }
    $st_up = qu("tb_driver", $_fields, "id='$d_id'");
//    d($d_id);
//    die();
    if (!empty($st_up)) {
//        echo "its run";
        $get_id = $_REQUEST['did'];
        $driver_data = qs("SELECT * FROM tb_driver WHERE id='$get_id' ");

        $_SESSION['driver_id'] = $driver_data;
        $d_id = $_SESSION['driver_id']['id'];
        $unm = $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'];
        $u_id = $_SESSION['user']['id'];
        $v_id = qs("select v.id from tb_vehicle v, tb_driver d where d.license_plate=v.license_plate and d.id='$d_id'");
        $_fields4['uname'] = $unm;
        $_fields4['user_id'] = $u_id;
        $_fields4['driver_id'] = $d_id;
        $_fields4['vehicle_id'] = $v_id['id'];
//        d($u_id);
//        die();

        $_fields4['station_stage'] = $station_stage;
        $_fields4['operation_type'] = "UPDATE";
        date_default_timezone_get();
        $date = date('m/d/Y h:i:s a', time());
        $_fields4['touch_date'] = $date;
        $_fields4['touch_note'] = "";

        $s1 = qi("tb_station_touch_log", $_fields4);
        $success = '1';
        $msg = "Record updated successfully";
        $query = q("select *,d.stage as stage, d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no,v.make_modal,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=2 and v.ins_status='pass' and d.license_plate=v.license_plate");
        $stage1 = q("select * from tb_driver where stage=1 ");
        $stage2 = q("select * from tb_driver where stage=3 ");
        $stage3 = q("select * from tb_driver where stage=3 ");
        $stage4 = q("select * from tb_driver where stage=4 ");
        $stage5 = q("select * from tb_driver where stage=5 ");
//        _R('station3');
//        d($_fields4);
//        die();
//        if (!empty($s1)) {
//        }
    } else {
        $success = '-1';
        $msg = "Record can't updated. Please try again.";
    }
}
//if (isset($_REQUEST['getQuestion'])) {
//    $d_id = $_REQUEST['id'];
//    $stage = $_REQUEST['stage'];
//    $ques = q("select * from tb_vehicle_ins_detail vid, tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vid.driver_id=vd.driver_id and vd.driver_id=d.id and vd.vehicle_id=v.id  and d.license_plate=v.license_plate and vid.driver_id='$d_id' and d.stage='$stage'");
//    foreach ($ques as $value) {
//        $a[] = $value['answer'];
//    }
//    echo json_encode($a);
////   d($a);
//    die();
//}
if (isset($_REQUEST['getQuestion'])) {
    $d_id = $_REQUEST['id'];
    $stage = $_REQUEST['stage'];
    $ques = q("select vid.question_no,vid.qusetion,vid.answer from tb_vehicle_ins_detail vid, tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vid.driver_id=vd.driver_id and vd.driver_id=d.id and vd.vehicle_id=v.id  and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and vid.driver_id='$d_id' and d.stage='$stage'  ORDER BY `vid`.`id` ASC");
    foreach ($ques as $value) {
        $a[$value['question_no']] = $value['answer'];
        $b[$value['question_no']] = $value['qusetion'];
    }
//    d($ques);
    echo json_encode(array("found" => count($a), 'record' => $a, 'qusetion' => $b));
//   d($a);
    die();
}
if (isset($_REQUEST['getNote'])) {
    $d_id = $_REQUEST['id'];
    $stage = $_REQUEST['stage'];
    $st1 = qs("SELECT * from tb_station_touch_log st, tb_driver d,tb_vehicle v, tb_vehicle_driver vd WHERE vd.vehicle_id=v.id and vd.driver_id= d.id and st.driver_id=vd.driver_id and st.vehicle_id=vd.vehicle_id and st.station_stage='3' and d.id='$d_id' and d.stage='$stage'");

    $Dates = date('d M, Y', strtotime($st1['touch_date']));
    $yy = date('Y', strtotime($st1['touch_date']));
    $mm = date('m', strtotime($st1['touch_date']));
    $dd = date('d', strtotime($st1['touch_date']));
    $dt = gregorian_to_jalali($yy, $mm, $dd, 1);
    $hh = date('H', strtotime($st1['touch_date']));
    $ii = date('i', strtotime($st1['touch_date']));
    $ss = date('s', strtotime($st1['touch_date']));
    $dt = gregorian_to_jalali($yy, $mm, $dd, 1);
//    d($hh . '-' . $ii . '-' . $ss);
//    d($st1['touch_date']);
    $dt .= ' ' . $hh . ':' . $ii . ':' . $ss;
//    d($dt);
//    d($st1['touch_date']);
//    d($yy . '-' . $mm . '-' . $dd);
    echo json_encode(array("row" => $st1, "Tdate" => $dt));
//    d($ques);
    die();
}
if (isset($_REQUEST['getUser'])) {
    $d_id = $_REQUEST['id'];
    $stage = $_REQUEST['stage'];
//    echo $_REQUEST['id'] .'-'.$_REQUEST['stage'];
    $st1 = qs("SELECT * FROM `tb_station_touch_log` where driver_id='$d_id' and station_stage='$stage' ORDER BY `tb_station_touch_log`.`touch_date` DESC LIMIT 1  ");
//    d($stage);
    $Dates = date('d M, Y', strtotime($st1['touch_date']));
    $yy = date('Y', strtotime($st1['touch_date']));
    $mm = date('m', strtotime($st1['touch_date']));
    $dd = date('d', strtotime($st1['touch_date']));
    $hh = date('H', strtotime($st1['touch_date']));
    $ii = date('i', strtotime($st1['touch_date']));
    $ss = date('s', strtotime($st1['touch_date']));
    $dt = gregorian_to_jalali($yy, $mm, $dd, 1);
//    d($hh . '-' . $ii . '-' . $ss);
//    d($st1['touch_date']);
    $dt .= ' ' . $hh . ':' . $ii . ':' . $ss;
//    d($yy . '-' . $mm . '-' . $dd);
    echo json_encode(array("row" => $st1, "Tdate" => $dt));
//    echo json_encode($st1);
    die;
//    die();
}
if (isset($_REQUEST['save'])) {

    $driver_id = $_REQUEST['d_id'];
    $vehicle = $_REQUEST['v_id'];
//    d($driver_id);
//    die();
    $_fields['fname'] = $_REQUEST['fName'];
    $_fields['lname'] = $_REQUEST['lName'];
    $_fields['email'] = $_REQUEST['email'];
    $_fields['phone'] = $_REQUEST['phone'];
    $_fields['cell_provider'] = $_REQUEST['cell_provider'];
    $_fields['melli_no'] = $_REQUEST['melli_no'];
    $licExDate = $_REQUEST['ddl_year'] . '-' . $_REQUEST['ddl_month'] . '-' . $_REQUEST['ddl_date'];
//        d($_REQUEST['ddl_year']);
//        d($_REQUEST['ddl_month']);
//        d($_REQUEST['ddl_date']);
//        $CKLS = date('Y-M-d', strtotime($licExDate));
//        d($licExDate);
//        d($CKLS);
//
//        die();
//        $_fields['license_expiry_date'] = date('Y-m-d', strtotime($licExDate));
    $_fields['license_expiry_date'] = $licExDate;
    $_fields['melli_expiry_date'] = $_REQUEST['melli_expr_year'] . '-' . $_REQUEST['melli_expr_month'] . '-' . $_REQUEST['melli_expr_date'];
//        $_fields['license_plate'] = $_REQUEST['veh_lic_no1'] . '-' . $_REQUEST['veh_lic_no2'] . '-' . $_REQUEST['veh_lic_no3'];
    $_fields['license_plate1'] = $_REQUEST['veh_lic_no1'];
    $_fields['license_plate2'] = $_REQUEST['veh_lic_no2'];
    $_fields['license_plate3'] = $_REQUEST['veh_lic_no3'];
    $_fields['license_plate4'] = $_REQUEST['veh_lic_no4'];
//        $_fields['license_plate_type'] = $_REQUEST['l_p_type'];
//        $_fields['chassis_no'] = $_REQUEST['vin_no'];

    $_fields['father_name'] = $_REQUEST['fatherName'];
    $_fields['gender'] = $_REQUEST['gender'];
    $_fields['marital_status'] = $_REQUEST['marital_status'];
    $_fields['dob'] = $_REQUEST['dob_year'] . '-' . $_REQUEST['dob_month'] . '-' . $_REQUEST['dob_date'];

    $_fields['birth_cert_number'] = $_REQUEST['bod_no'];
    $_fields['home_address'] = $_REQUEST['home_address'];
    $_fields['city'] = $_REQUEST['city'];
//        $_fields['state'] = $_REQUEST['state'];
    $_fields['postal_code'] = $_REQUEST['post_code'];
    $_fields['home_phone'] = $_REQUEST['home_phone'];

    $up_d = qu("tb_driver", $_fields, "id='{$_REQUEST['d_id']}'");

    $_fields2['license_plate1'] = $_REQUEST['veh_lic_no1'];
    $_fields2['license_plate2'] = $_REQUEST['veh_lic_no2'];
    $_fields2['license_plate3'] = $_REQUEST['veh_lic_no3'];
    $_fields2['license_plate4'] = $_REQUEST['veh_lic_no4'];

//    $_fields2['colors'] = implode(",", $_REQUEST['color_id']);
    $_fields2['colors'] = $_REQUEST['color_id'];
    $_fields2['new_color'] = $_REQUEST['other_color'];
    $_fields2['is_applicant_owner'] = $_REQUEST['non_owner'];

    $_fields2['make_modal'] = $_REQUEST['car_make'];
    $_fields2['make_modal_other'] = $_REQUEST['other_car'];
    $_fields2['year'] = $_REQUEST['car_year'];
    $_fields2['vehicle_type'] = $_REQUEST['v_type'];
    $_fields2['insurance_expiration_date'] = $_REQUEST['insurance_expr_year'] . '-' . $_REQUEST['insurance_expr_month'] . '-' . $_REQUEST['insurance_expr_date'];
    $_fields2['smog_expiry_date'] = $_REQUEST['smog_expr_year'] . '-' . $_REQUEST['smog_expr_month'] . '-' . $_REQUEST['smog_expr_date'];
    $_fields2['smog_check'] = $_REQUEST['smog_check'];
    $_fields2['vehicle_card_number'] = $_REQUEST['veh_card_no'];

    if ($_REQUEST['car_make'] == "other" && trim($_REQUEST['other_car']) != "") {
        $content = "<html>";
        $content .= "<body>";
        $content .= "<div style = 'font-family:verdana;'>";
        $content .= "<div style = 'font-family: verdana;'>Hi Admin, </div>";
        $content .= "<br>";
        $content .= "<div>New car model <span style = 'color: black;background-color:yellow; font-family: verdana; font-weight: bold; font-size: 14px;'>" . strtoupper($_REQUEST['other_car']) . "</span> is added.</div>";
        $content .= "</div>";
        $content .= "</body>";
        $content .= "</html>";
        _mail("amirrnaderi@hotmail.com ", "New Car Model is added", $content);
    }
//    d($_REQUEST['v_id']);
//    die;
    $up_v = qu("tb_vehicle", $_fields2, "id='{$_REQUEST['v_id']}'");
    $v_id = $_REQUEST['v_id'];
    if (!empty($up_d) && !empty($up_v)) {
        $get_id = $_REQUEST['d_id'];
        $driver_data = qs("SELECT * FROM tb_driver WHERE id='$get_id' ");

        $_SESSION['driver_id'] = $driver_data;
        $d_id = $_SESSION['driver_id']['id'];
        $unm = $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'];
        $u_id = $_SESSION['user']['id'];
        $_fields4['uname'] = $unm;
        $_fields4['user_id'] = $u_id;
        $_fields4['driver_id'] = $d_id;
        $_fields4['vehicle_id'] = $v_id;
//        d($d_id);
//        die();

        $_fields4['station_stage'] = "Manager";
        $_fields4['operation_type'] = "UPDATE";
        date_default_timezone_get();
        $date = date('m/d/Y h:i:s a', time());
        $_fields4['touch_date'] = $date;
        $_fields4['touch_note'] = "";

        $s1 = qi("tb_station_touch_log", $_fields4);
//        if (!empty($s1)) {
//            _R('station2');
//        }
        $success = '1';
        $msg = _t('385', "Record updated successfully");
//        $query = q("select *, d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no,v.make_modal,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=1 and d.license_plate=v.license_plate" . helper::officeCond());
    } else {
        $success = '-1';
        $msg = "Record can't updated. Please try again.";
    }
    $stage1 = q("select * from tb_driver where stage=1 ");
    $stage2 = q("select * ,d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no,v.make_modal,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=3  and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4");
//$stage3 = q("select * from tb_driver where stage=3 ");
    $stage4 = q("select * ,d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no,v.make_modal,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=4  and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4");

    $stage5 = q("select * ,d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no,v.make_modal,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=5  and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4");
    _R('manager');
}
if (isset($_REQUEST['getData3'])) {
    $d_id = $_REQUEST['id'];
    $st3 = qs("select * from tb_driver d, tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=3 and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and d.id='$d_id'");
//  d($st3);
    $vin_arr = explode('-', $st3["license_plate"]);
    $st3["vin_lic_no1"] = $vin_arr[0];
    $st3["vin_lic_no2"] = $vin_arr[1];
    $st3["vin_lic_no3"] = $vin_arr[2];

    $arr = explode('-', $st3["license_expiry_date"]);
    $st3["years"] = $arr[0];
    $st3["months"] = $arr[1] + 0;
    $st3["date"] = $arr[2] + 0;


    $darr = explode('-', $st3["dob"]);
    $st3["dyears"] = $darr[0];
    $st3["dmonths"] = $darr[1] + 0;
    $st3["ddate"] = $darr[2] + 0;

    $marr = explode('-', $st3["melli_expiry_date"]);
    $st3["myears"] = $marr[0];
    $st3["mmonths"] = $marr[1] + 0;
    $st3["mdate"] = $marr[2] + 0;

    $iarr = explode('-', $st3["insurance_expiration_date"]);
    $st3["iyears"] = $iarr[0];
    $st3["imonths"] = $iarr[1] + 0;
    $st3["idate"] = $iarr[2] + 0;

    $sarr = explode('-', $st3["smog_expiry_date"]);
    $st3["syears"] = $sarr[0];
    $st3["smonths"] = $sarr[1] + 0;
    $st3["sdate"] = $sarr[2] + 0;

    echo json_encode($st3);
    die();
}
if (isset($_REQUEST['getData4'])) {
    $select_id = $_REQUEST['id'];
    $query2 = qs("select * from tb_driver d, tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=4 and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and d.id='$select_id'");
//    d($select_id);
//    die();
    $vin_arr = explode('-', $query2["license_plate"]);
    $query2["vin_lic_no1"] = $vin_arr[0];
    $query2["vin_lic_no2"] = $vin_arr[1];
    $query2["vin_lic_no3"] = $vin_arr[2];

    $arr = explode('-', $query2["license_expiry_date"]);
    $query2["years"] = $arr[0];
    $query2["months"] = $arr[1] + 0;
    $query2["date"] = $arr[2] + 0;


    $darr = explode('-', $query2["dob"]);
    $query2["dyears"] = $darr[0];
    $query2["dmonths"] = $darr[1] + 0;
    $query2["ddate"] = $darr[2] + 0;

    $marr = explode('-', $query2["melli_expiry_date"]);
    $query2["myears"] = $marr[0];
    $query2["mmonths"] = $marr[1] + 0;
    $query2["mdate"] = $marr[2] + 0;

    $iarr = explode('-', $query2["insurance_expiration_date"]);
    $query2["iyears"] = $iarr[0];
    $query2["imonths"] = $iarr[1] + 0;
    $query2["idate"] = $iarr[2] + 0;

    $sarr = explode('-', $query2["smog_expiry_date"]);
    $query2["syears"] = $sarr[0];
    $query2["smonths"] = $sarr[1] + 0;
    $query2["sdate"] = $sarr[2] + 0;

    echo json_encode($query2);
    die;
}
if (isset($_REQUEST['getData5'])) {
    $select_id = $_REQUEST['id'];
    $query2 = qs("select * from tb_driver d, tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=5 and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and d.id='$select_id'");
//    d($select_id);
//    die();
    $vin_arr = explode('-', $query2["license_plate"]);
    $query2["vin_lic_no1"] = $vin_arr[0];
    $query2["vin_lic_no2"] = $vin_arr[1];
    $query2["vin_lic_no3"] = $vin_arr[2];

    $arr = explode('-', $query2["license_expiry_date"]);
    $query2["years"] = $arr[0];
    $query2["months"] = $arr[1] + 0;
    $query2["date"] = $arr[2] + 0;


    $darr = explode('-', $query2["dob"]);
    $query2["dyears"] = $darr[0];
    $query2["dmonths"] = $darr[1] + 0;
    $query2["ddate"] = $darr[2] + 0;

    $marr = explode('-', $query2["melli_expiry_date"]);
    $query2["myears"] = $marr[0];
    $query2["mmonths"] = $marr[1] + 0;
    $query2["mdate"] = $marr[2] + 0;

    $iarr = explode('-', $query2["insurance_expiration_date"]);
    $query2["iyears"] = $iarr[0];
    $query2["imonths"] = $iarr[1] + 0;
    $query2["idate"] = $iarr[2] + 0;

    $sarr = explode('-', $query2["smog_expiry_date"]);
    $query2["syears"] = $sarr[0];
    $query2["smonths"] = $sarr[1] + 0;
    $query2["sdate"] = $sarr[2] + 0;

    echo json_encode($query2);
    die;
}
if (isset($_REQUEST['duplication'])) {
    $did = $_REQUEST['ID'];
//    d($did);
//    die();
    $ph = $_REQUEST['phoneno'];
    $melli = $_REQUEST['mellino'];

    $veh_lic = $_REQUEST['veh_lic_no1'] . '-' . $_REQUEST['veh_lic_no2'] . '-' . $_REQUEST['veh_lic_no3'];
//    $check_ph = qs("select phone from tb_driver where phone='$ph'");
    $check_ph = q("select * from tb_driver d, tb_station_touch_log  st where NOT(d.id ='$did') and d.phone='$ph' and st.driver_id=d.id  ORDER BY `st`.`touch_date` DESC LIMIT 1");
    $check_melli = q("select * from tb_driver d, tb_station_touch_log  st where NOT(d.id ='$did') and d.melli_no='$melli' and st.driver_id=d.id  ORDER BY `st`.`touch_date` DESC LIMIT 1");
    $check_veh_lic = q("select * from tb_driver d, tb_station_touch_log  st where NOT(d.id ='$did') and d.license_plate1 = '{$_REQUEST['veh_lic_no1']}' and d.license_plate2 = '{$_REQUEST['veh_lic_no2']}' and d.license_plate3 = '{$_REQUEST['veh_lic_no3']}' and d.license_plate4 = '{$_REQUEST['veh_lic_no4']}' and st.driver_id=d.id  ORDER BY `st`.`touch_date` DESC LIMIT 1");
    if (empty($check_ph) == TRUE && empty($check_melli) == TRUE && empty($check_veh_lic) == TRUE) {
        $success = '1';
//        $msg = "Document deleted successfully";
    } else {
        $fnm = $_REQUEST['fName'];
        $lnm = $_REQUEST['lName'];
        $em = $_REQUEST['email'];
        $pho = $_REQUEST['phone'];
        $mel = $_REQUEST['melli_no'];
        $veh_l1 = $_REQUEST['veh_lic_no1'];
        $veh_l2 = $_REQUEST['veh_lic_no2'];
        $veh_l3 = $_REQUEST['veh_lic_no3'];
        $veh_l4 = $_REQUEST['veh_lic_no4'];
        $chassis = $_REQUEST['vin_no'];
        $mkmodal = $_REQUEST['car_make'];
        $mkyear = $_REQUEST['ddl_year'];
        $mkmonth = $_REQUEST['ddl_month'];
        $mkdate = $_REQUEST['ddl_date'];
        $mkprovider = $_REQUEST['cell_provider'];
        $other_car = $_REQUEST['other_car'];
        $year = $_REQUEST['car_year'];
        if (!empty($check_ph)) {
            $success = '-1';
            $model = '1';
            $msg .= "Phone number already exists. Kindly check the number<br/>";
            $pho = "";
            $val_pm .= "p";
        }
        if (!empty($check_melli)) {
//            $success = '1';
            $model = '-1';
            $msg .= " Melli number is alredy exists..Please Try Different Melli Number<br/>";
            $mel = "";
            $val_pm .= "m";
        }
        if (!empty($check_veh_lic)) {
//            $success = '1';
            $model = '1';
            $msg .= " Vehicle plate number is alredy exists..Please Try Different Vehicle Plate Number";
            $val_pm = "l";
        }
    }
    echo json_encode(array("success" => $success, "msg" => $msg, "duplicate" => $val_pm));
    die();
}

$jsInclude = "manager.js.php";
_cg("page_title", "Manage Driver");
?>


