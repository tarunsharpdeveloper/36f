<?php

//if (!isset($_SESSION['user']) ) {
//    _R('login');
//}
if (isset($_REQUEST['save'])) {
    $ph = $_REQUEST['phone'];
    $melli = $_REQUEST['melli_no'];
    $veh_lic = $_REQUEST['veh_lic_no1'] . '-' . $_REQUEST['veh_lic_no2'] . '-' . $_REQUEST['veh_lic_no3'];

//    d($veh_lic);
//    die();
//    $check_ph = qs("select phone from tb_driver where phone='$ph'");
    $check_ph = q("select * from tb_driver d, tb_station_touch_log  st where d.phone='$ph' and st.driver_id=d.id  ORDER BY `st`.`touch_date` DESC LIMIT 1");
    $check_melli = q("select * from tb_driver d, tb_station_touch_log  st where d.melli_no='$melli' and st.driver_id=d.id  ORDER BY `st`.`touch_date` DESC LIMIT 1");
    $check_veh_lic = q("select * from tb_driver d, tb_station_touch_log  st where d.license_plate1 = '{$_REQUEST['veh_lic_no1']}' and d.license_plate2 = '{$_REQUEST['veh_lic_no2']}' and d.license_plate3 = '{$_REQUEST['veh_lic_no3']}' and d.license_plate4 = '{$_REQUEST['veh_lic_no4']}' and st.driver_id=d.id  ORDER BY `st`.`touch_date` DESC LIMIT 1");
//    d("ph = " . $check_ph);
//    d("melli = " . $check_melli);
//    d("Vehi = " . $check_veh_lic);
//    d(empty($check_ph));
//    die();
    if (empty($check_ph) == TRUE && empty($check_melli) == TRUE && empty($check_veh_lic) == TRUE) {
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
        $_fields['office'] = $_SESSION['office'];
//        $_fields['speaks_english'] = $_REQUEST['rd_speak_en'];
//        $_fields['smoker'] = $_REQUEST['rd_smoker'];
//        $_fields['background_check_received'] = $_REQUEST['rd_bcr'];
//        $_fields['permit_type_a'] = $_REQUEST['rd_permit_a'];
//        $_fields['permit_expire_date'] = date('Y-m-d',  strtotime($_REQUEST['permit_expire_date']));
        $_fields['stage'] = '1';
        $s = qi("tb_driver", $_fields);
//        $_fields2['license_plate'] = $_REQUEST['veh_lic_no1'] . '-' . $_REQUEST['veh_lic_no2'] . '-' . $_REQUEST['veh_lic_no3'];
        $_fields2['license_plate1'] = $_REQUEST['veh_lic_no1'];
        $_fields2['license_plate2'] = $_REQUEST['veh_lic_no2'];
        $_fields2['license_plate3'] = $_REQUEST['veh_lic_no3'];
        $_fields2['license_plate4'] = $_REQUEST['veh_lic_no4'];

//        $_fields2['colors'] = implode(",", $_REQUEST['color_id']);
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
//    date_default_timezone_get();
//    $date = date('m/d/Y h:i:s a', time());
//    $_fields['created_at'] = $date;
//    $_fields['modified_at'] = $date;
        $add = qi("tb_vehicle", $_fields2);

        $vehicle_plate = $_REQUEST['veh_lic_no1'] . '-' . $_REQUEST['veh_lic_no2'] . '-' . $_REQUEST['veh_lic_no3'];
//     

        $v_id = qs("select id from tb_vehicle where license_plate1 = '{$_REQUEST['veh_lic_no1']}' and license_plate2 = '{$_REQUEST['veh_lic_no2']}' and license_plate3 = '{$_REQUEST['veh_lic_no3']}' and license_plate4 = '{$_REQUEST['veh_lic_no4']}'");
        $d_id = qs("select id from tb_driver where license_plate1 = '{$_REQUEST['veh_lic_no1']}' and license_plate2 = '{$_REQUEST['veh_lic_no2']}' and license_plate3 = '{$_REQUEST['veh_lic_no3']}' and license_plate4 = '{$_REQUEST['veh_lic_no4']}'");
//        d($d_id);
//        d($v_id);
//        die();
        $_SESSION['v_id'] = qs("select id from tb_vehicle where license_plate1 = '{$_REQUEST['veh_lic_no1']}' and license_plate2 = '{$_REQUEST['veh_lic_no2']}' and license_plate3 = '{$_REQUEST['veh_lic_no3']}' and license_plate4 = '{$_REQUEST['veh_lic_no4']}'");

        $_fields3['vehicle_id'] = $v_id['id'];
        $_fields3['driver_id'] = $d_id['id'];
        $add2 = qi("tb_vehicle_driver", $_fields3);

        $_fields5['driver_id'] = $d_id['id'];
        $_SESSION['endTime'] = date('Y-m-d H:i:s', time());
        $_fields5['end_time'] = $_SESSION['endTime'];
        $starttime = $_SESSION['startTime'];
        $endtime = strtotime($_SESSION['endTime']);
        $start = strtotime($_SESSION['startTime']);
        $total_time = $endtime - $start;
        $differenceInSeconds = $endtime - $start;
        $differenceInHours = $differenceInSeconds / 60;
//    d($total_time);
        $_fields5['total_time'] = $differenceInHours;
        $t_id = qs("select id from tb_time_spend where start_time = '$starttime'");
//    d($t_id);
//    die();
        $up_time = qu("tb_time_spend", $_fields5, "id = '{$t_id['id']}'");


        if (!empty($s) && !empty($add) && !empty($add2)) {
            $melli_no = (trim(_escape($_REQUEST['melli_no'])));
//            $vehlicno = $_REQUEST['veh_lic_no1'] . '-' . $_REQUEST['veh_lic_no2'] . '-' . $_REQUEST['veh_lic_no3'];
            $driver_data = qs("SELECT * FROM tb_driver WHERE license_plate1 = '{$_REQUEST['veh_lic_no1']}' and license_plate2 = '{$_REQUEST['veh_lic_no2']}' and license_plate3 = '{$_REQUEST['veh_lic_no3']}' and license_plate4 = '{$_REQUEST['veh_lic_no4']}' ");
            $_SESSION['driver_id'] = $driver_data;
            $d_id = $_SESSION['driver_id']['id'];
            $unm = $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'];
            $u_id = $_SESSION['user']['id'];
            $_fields1['uname'] = $unm;
            $_fields1['user_id'] = $u_id;
            $_fields1['driver_id'] = $d_id;
            $_fields1['vehicle_id'] = $v_id['id'];
//        d($d_id);
//        die();

            $_fields1['station_stage'] = "1";
            $_fields1['operation_type'] = "ADD";

            date_default_timezone_get();
            $date = date('m/d/Y h:i:s a', time());
            $_fields1['touch_date'] = $date;
            $_fields1['touch_note'] = "";

            $s1 = qi("tb_station_touch_log", $_fields1);

            $Slack = new apiSlack();
            $message = "*" . $_REQUEST['fName'] . " " . $_REQUEST['lName'] . "*  Added By *" . $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'] . "* At " . $date . " to *Station 1-" . $_SESSION['office'] . "* Office ";
            $Slack->pingStationSlack($message);

            if (!empty($s1)) {
                
            }
            $success = '1';
            $msg = _t('385', "Record added successfully");
        } else {
            $success = '-1';
            $msg = "Record can't added. please try again.";
        }
    } else {
        $fnm = $_REQUEST['fName'];
        $lnm = $_REQUEST['lName'];
        $fathnm = $_REQUEST['fatherName'];

        $em = $_REQUEST['email'];
        $pho = $_REQUEST['phone'];
        $hpho = $_REQUEST['home_phone'];
        $address = $_REQUEST['home_address'];
        $mcity = $_REQUEST['city'];
        $mpostal = $_REQUEST['post_code'];
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
        $melliyear = $_REQUEST['melli_expr_year'];
        $mellimonth = $_REQUEST['melli_expr_month'];
        $mellidate = $_REQUEST['melli_expr_date'];
        $insuyear = $_REQUEST['insurance_expr_year'];
        $insumonth = $_REQUEST['insurance_expr_month'];
        $insudate = $_REQUEST['insurance_expr_date'];
        $mkcolor = $_REQUEST['color_id'];
        $data['gender'] = $_REQUEST['gender'];
        $data['marital_status'] = $_REQUEST['marital_status'];
        $data['v_type'] = $_REQUEST['v_type'];
        $data['non_owner'] = $_REQUEST['non_owner'];

        $data['vehicle_card_number'] = $_REQUEST['veh_card_no'];
        $dobyear = $_REQUEST['dob_year'];
        $dobmonth = $_REQUEST['dob_month'];
        $dobdate = $_REQUEST['dob_date'];

        $mkprovider = $_REQUEST['cell_provider'];
        $other_car = $_REQUEST['other_car'];
        $year = $_REQUEST['car_year'];

        $bodno = $_REQUEST['bod_no'];

        $is_applicant_owner = $_REQUEST['gender'];
        if (!empty($check_ph)) {
//            $success = '1';
            $model = '1';
            $msg .= "Phone number is alredy exists. Please Try Different Phone Number<br/>";
            //$pho = "";
        }
        if (!empty($check_melli)) {
//            $success = '1';
            $model = '1';
            $msg .= " Melli number is alredy exists..Please Try Different Melli Number<br/>";
            //$mel = "";
        }
        if (!empty($check_veh_lic)) {
//            $success = '1';
            $model = '1';
            $msg .= " Vehicle plate number is alredy exists..Please Try Different Vehicle Plate Number";
            // $veh_l1 = "";
            // $veh_l2 = "";
            // $veh_l3 = "";
            //$veh_l4 = "";
        }
    }
}
//if (isset($_REQUEST['duplication'])) {
//    //$did = $_REQUEST['ID'];
////    d($did);
////    die();
//    $ph = $_REQUEST['phoneno'];
//    $melli = $_REQUEST['mellino'];
//
//    $veh_lic = $_REQUEST['veh_lic_no1'] . '-' . $_REQUEST['veh_lic_no2'] . '-' . $_REQUEST['veh_lic_no3'];
////    $check_ph = qs("select phone from tb_driver where phone='$ph'");
//    $check_ph = q("select * from tb_driver d, tb_station_touch_log  st where d.phone='$ph' and st.driver_id=d.id  ORDER BY `st`.`touch_date` DESC LIMIT 1");
//    $check_melli = q("select * from tb_driver d, tb_station_touch_log  st where d.melli_no='$melli' and st.driver_id=d.id  ORDER BY `st`.`touch_date` DESC LIMIT 1");
//    $check_veh_lic = q("select * from tb_driver d, tb_station_touch_log  st where d.license_plate1 = '{$_REQUEST['veh_lic_no1']}' and d.license_plate2 = '{$_REQUEST['veh_lic_no2']}' and d.license_plate3 = '{$_REQUEST['veh_lic_no3']}' and d.license_plate4 = '{$_REQUEST['veh_lic_no4']}' and st.driver_id=d.id  ORDER BY `st`.`touch_date` DESC LIMIT 1");
//    if (empty($check_ph) == TRUE && empty($check_melli) == TRUE && empty($check_veh_lic) == TRUE) {
//        $success = '1';
////        $msg = "Document deleted successfully";
//    } else {
//        $fnm = $_REQUEST['fName'];
//        $lnm = $_REQUEST['lName'];
//        $em = $_REQUEST['email'];
//        $pho = $_REQUEST['phone'];
//        $mel = $_REQUEST['melli_no'];
//        $veh_l1 = $_REQUEST['veh_lic_no1'];
//        $veh_l2 = $_REQUEST['veh_lic_no2'];
//        $veh_l3 = $_REQUEST['veh_lic_no3'];
//        $veh_l4 = $_REQUEST['veh_lic_no4'];
//        $chassis = $_REQUEST['vin_no'];
//        $mkmodal = $_REQUEST['car_make'];
//        $mkyear = $_REQUEST['ddl_year'];
//        $mkmonth = $_REQUEST['ddl_month'];
//        $mkdate = $_REQUEST['ddl_date'];
//        $mkprovider = $_REQUEST['cell_provider'];
//        $other_car = $_REQUEST['other_car'];
//        $year = $_REQUEST['car_year'];
//        if (!empty($check_ph)) {
//            $success = '-1';
//            $model = '1';
//            $msg .= "Cell number already exists. Kindly check the number<br/>";
//            $pho = "";
//            $val_pm .= "p";
//        }
//        if (!empty($check_melli)) {
//            $success = '-1';
//            $model = '1';
//            $msg .= " Melli number is alredy exists..Please Try Different Melli Number<br/>";
//            $mel = "";
//            $val_pm .= "m";
//        }
//        if (!empty($check_veh_lic)) {
//            $success = '-1';
//            $model = '1';
//            $msg .= " Vehicle plate number is alredy exists..Please Try Different Vehicle Plate Number";
//            $val_pm = "l";
//        }
//    }
//    echo json_encode(array("success" => $success,"model" => $model, "msg" => $msg, "duplicate" => $val_pm));
//    die();
//}
if (isset($_REQUEST['getTime'])) {
    $unm = $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'];
    $u_id = $_SESSION['user']['id'];
    $station_id = '1';
    $office_nm = $_SESSION['office'];
    $office_id = qs("select id from tb_office where name='$office_nm'");
//    $_SESSION['startTime'] = date('Y-m-d H:i:s').time();
//    $_SESSION['startTime'] = date('Y-m-d H : i : s');
    $_SESSION['startTime'] = date('Y-m-d H:i:s ', time());
    $_fields['start_time'] = $_SESSION['startTime'];
    $_fields['user_id'] = $u_id;
    $_fields['office_id'] = $office_id['id'];
    $_fields['office_name'] = $office_nm;
    $_fields['station_id'] = $station_id;
    $add = qi("tb_time_spend", $_fields);
    d($add);
    die;
}
//$query = "SELECT * FROM fleet WHERE tenant_id=' {$_SESSION['user']['id']}'";
//$fleet_data = q($query);

$jsInclude = 'new_timesheet.js.php';
_cg("page_title", "new_timesheet");
//if (($_REQUEST[' car_modal']) != '') {
//        d($_REQUEST);
//        die;
//}

            