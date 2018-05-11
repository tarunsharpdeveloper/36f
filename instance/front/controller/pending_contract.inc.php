<?php

if (!isset($_SESSION['user']) || !(in_array('Station-5-Agent', $_SESSION['user']['roles'])) && !(in_array('Manager', $_SESSION['user']['roles'])) && !(in_array('Master-Admin', $_SESSION['user']['roles'])) && !(in_array('Admin', $_SESSION['user']['roles']))) {
    _R('login');
}
//d($_REQUEST);
//_errors_on();
$station = $_GET['set'];
if (!empty($station)) {
    $query = q("select *,d.modified_at as rejdate, vd.driver_id, d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no, v.make_modal ,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage='$station' and v.ins_status='pass' and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and d.doc_signed_contract=''" . helper::officeCond() . helper::OrderByDesc());
    $query_data = q("select * from tb_station_touch_log where station_stage='3'");
    
    foreach($query_data as $dataRow){
        $data_uname[$dataRow['driver_id']] = $dataRow['uname'];
        $data_touch_note[$dataRow['driver_id']] = $dataRow['touch_note'];
        $data_station_stage[$dataRow['driver_id']] = $dataRow['station_stage'];
       
    }
    
} else {
    $query = q("select *,d.modified_at as rejdate, vd.driver_id, d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no, v.make_modal ,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=5 and v.ins_status='pass' and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and d.doc_signed_contract=''" . helper::officeCond() . helper::OrderByDesc());
    $query_data = q("select * from tb_station_touch_log where station_stage='3'");
    
    foreach($query_data as $dataRow){
        $data_uname[$dataRow['driver_id']] = $dataRow['uname'];
        $data_touch_note[$dataRow['driver_id']] = $dataRow['touch_note'];
        $data_station_stage[$dataRow['driver_id']] = $dataRow['station_stage'];
       
    }

}
//$query2 = qs("select * from tb_driver d, tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=4 and d.license_plate=v.license_plate and d.id=9");
//d($query);
//die();
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
        $v_id = qs("select v.id from tb_vehicle v, tb_driver d where d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and d.id='$d_id'");
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
        $query = q("select *, vd.driver_id, d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no, v.make_modal ,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=4 and v.ins_status='pass' and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4" . helper::officeCond());
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
if (isset($_REQUEST['getData5'])) {
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
    echo json_encode($query2);
    die;
}
if (isset($_REQUEST['getInfo'])) {
    $driver_id = $_REQUEST['id'];
    $driver_stage = $_REQUEST['stage'];
    $st = qs("select *,d.id as did ,v.id AS vid from tb_driver d, tb_vehicle v where d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and d.id='$driver_id' and d.stage='$driver_stage'");
    echo json_encode($st);
//    d($st);
    die();
}
if (isset($_REQUEST['saveRejNote'])) {
    $unm = $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'];
    $u_id = $_SESSION['user']['id'];
    $fields['uname'] = $unm;
    $fields['user_id'] = $u_id;
    $fields['driver_id'] = $_REQUEST['d_id'];
    $fields['vehicle_id'] = $_REQUEST['v_id'];
    $fields['station_stage'] = "4";
    $fields['operation_type'] = "REJECT";
    $date = date('m/d/Y h:i:s a', time());
    $fields['touch_date'] = $date;
    $fields['touch_note'] = $_REQUEST['note'];
    $insert_id = qi("tb_station_touch_log", _escapeArray($fields));
    qd("tb_vehicle_ins_detail", "vehicle_id='{$_REQUEST['v_id']}' AND driver_id='{$_REQUEST['d_id']}'");
    qu("tb_vehicle", array("ins_status" => "reject"), "id='{$_REQUEST['v_id']}'");
    qu("tb_driver", array("stage" => "reject", "old_stage" => "4"), "id='{$_REQUEST['d_id']}'");
//    qu("tb_driver", array("stage" => $_REQUEST['stage']), "id='{$_REQUEST['d_id']}'");
//    foreach ($_REQUEST['checked_que_ans'] as $key => $value) {
//        $_fields2 = array();
//        $_fields2['vehicle_id'] = $_REQUEST['v_id'];
//        $_fields2['driver_id'] = $_REQUEST['d_id'];
//        $_fields2['user_id'] = $u_id;
//        $_fields2['question_no'] = $key;
//        $_fields2['qusetion'] = $q[$key - 1];
//        $_fields2['answer'] = $value;
//        $add3_1 = qi("tb_vehicle_ins_detail", _escapeArray($_fields2));
//    }
    if ($insert_id > 1) {
//        $_fields6['driver_id'] = $_REQUEST['d_id'];
//        $_SESSION['endTime'] = date('Y-m-d H:i:s', time());
//        $_fields6['end_time'] = $_SESSION['endTime'];
//        $starttime = $_SESSION['startTime'];
//        $endtime = strtotime($_SESSION['endTime']);
//        $start = strtotime($_SESSION['startTime']);
//        $total_time = $endtime - $start;
//        $differenceInSeconds = $endtime - $start;
//        $differenceInHours = $differenceInSeconds / 60;
//    d($total_time);
//        $_fields6['total_time'] = $differenceInHours;
//        $_fields6['station_id'] = '2';
//        $t_id = qs("select id from tb_time_spend where start_time='$starttime'");
//        $driver_data = qs("SELECT * FROM tb_driver WHERE id='{$_REQUEST['d_id']}' ");
//
//        $_SESSION['driver_id'] = $driver_data;
//        $d_id = $_SESSION['driver_id']['id'];
//        $unm = $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'];
//        $u_id = $_SESSION['user']['id'];
//        $_fields4['uname'] = $unm;
//        $_fields4['user_id'] = $u_id;
//        $_fields4['driver_id'] = $d_id;
//        $_fields4['vehicle_id'] = $v_id['id'];
//        $_SESSION['did'] = $d_id;
//        $_SESSION['vid'] = $v_id['id'];
////        d($d_id);
////        die();
//        $_fields4['station_stage'] = "2";
//        $_fields4['operation_type'] = "reject";
//        date_default_timezone_get();
//        $date = date('m/d/Y h:i:s a', time());
//        $_fields4['touch_date'] = $date;
//        $_fields4['touch_note'] = "";
//
//        $s1 = qi("tb_station_touch_log", $_fields4);

        $_SESSION['success'] = '1';
        $_SESSION['msg'] = "Note added successfully";
        echo json_encode(array("success" => "1", "msg" => "Note added successfully"));


//    d($t_id);
//    die();
        $up_time = qu("tb_time_spend", $_fields6, "id='{$t_id['id']}'");
    } else
        echo json_encode(array("success" => "0", "msg" => "Note can't be added.Please try again."));
    die;
}
if (isset($_REQUEST['getUser'])) {
    $d_id = $_REQUEST['id'];
    $stage = $_REQUEST['stage'];
//    echo $_REQUEST['id'] .'-'.$_REQUEST['stage'];
    $st1 = qs("SELECT * FROM `tb_station_touch_log` where driver_id='$d_id' and station_stage='$stage' ORDER BY `tb_station_touch_log`.`touch_date` DESC LIMIT 1  ");
//    d($stage);
    echo json_encode($st1);
    die;
//    die();
}
//if (isset($_REQUEST['getData5'])) {
//    $select_id = $_REQUEST['id'];
//    $query2 = qs("select * from tb_driver d, tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=4 and d.license_plate=v.license_plate and d.id='$select_id'");
////     d($query2);
////    
//    echo json_encode($query2);
//    die;
//}
if (isset($_REQUEST['getNote'])) {
    $d_id = $_REQUEST['id'];
    $stage = $_REQUEST['stage'];
    $ques = qs("SELECT * from tb_station_touch_log st, tb_driver d,tb_vehicle v, tb_vehicle_driver vd WHERE vd.vehicle_id=v.id and vd.driver_id= d.id and st.driver_id=vd.driver_id and st.vehicle_id=vd.vehicle_id and st.station_stage='2' and st.driver_id='$d_id'");
    echo json_encode($ques);
//    d($ques);
    die();
}
if (isset($_REQUEST['getQuestion'])) {
    $d_id = $_REQUEST['id'];
    $stage = $_REQUEST['stage'];
    $ques = q("select vid.question_no,vid.qusetion,vid.answer from tb_vehicle_ins_detail vid, tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vid.driver_id=vd.driver_id and vd.driver_id=d.id and vd.vehicle_id=v.id  and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and vid.driver_id='$d_id' and d.stage='$stage'  ORDER BY `vid`.`id` ASC");
    foreach ($ques as $value) {
        $a[$value['question_no']] = $value['answer'];
        $b[$value['question_no']] = $value['qusetion'];
    }
    echo json_encode(array("found" => count($a), 'record' => $a, 'qusetion' => $b));
//   d($a);
    die();
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
    if (empty($check_ph) == TRUE && empty($check_melli) == TRUE) {
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
        //        if (!empty($check_veh_lic)) {
////            $success = '1';
//            $model = '1';
//            $msg .= " Vehicle plate number is alredy exists..Please Try Different Vehicle Plate Number";
//            $veh_l = "";
//        }
    }
    echo json_encode(array("success" => $success, "msg" => $msg, "duplicate" => $val_pm));
    die();
}
if (isset($_REQUEST['edit_pending_contract'])) {
    $did = $_REQUEST['d_id'];
    $ph = $_REQUEST['phone'];
    $melli = $_REQUEST['melli_no'];

    $_fields['fname'] = $_REQUEST['fName'];
    $_fields['lname'] = $_REQUEST['lName'];
    $_fields['email'] = $_REQUEST['email'];
    $_fields['phone'] = $_REQUEST['phone'];
    $_fields['melli_no'] = $_REQUEST['melli_no'];
    $_fields['chassis_no'] = $_REQUEST['vin_no'];
//    $_fields['license_plate'] = $_REQUEST['veh_lic_no1'] . '-' . $_REQUEST['veh_lic_no2'] . '-' . $_REQUEST['veh_lic_no3'];
    $_fields['license_plate1'] = $_REQUEST['veh_lic_no1'];
    $_fields['license_plate2'] = $_REQUEST['veh_lic_no2'];
    $_fields['license_plate3'] = $_REQUEST['veh_lic_no3'];
    $_fields['license_plate4'] = $_REQUEST['veh_lic_no4'];
    $_fields['cell_provider'] = $_REQUEST['cell_provider'];
//    $_fields['license_expiry_date'] = date('Y-m-d', strtotime($_REQUEST['license_expiry_date']));
    $licExDate = $_REQUEST['ddl_year'] . '-' . $_REQUEST['ddl_month'] . '-' . $_REQUEST['ddl_date'];
//    d($licExDate);
//    die();
    $_fields['license_expiry_date'] = $licExDate;
//    $_fields['chassis_no'] = $_REQUEST['vin_no'];
//    $_fields['license_plate'] = $_REQUEST['veh_lic_no1'];
    $_fields['username'] = $_REQUEST['uname'];
    $_fields['password'] = $_REQUEST['psw'];
    $up_d = qu("tb_driver", $_fields, "id='{$_REQUEST['d_id']}'");

    $_fields1['make_modal'] = $_REQUEST['car_make'];
    $_fields1['make_modal_other'] = $_REQUEST['other_car'];
//    $_fields1['license_plate'] = $_REQUEST['veh_lic_no1'] . '-' . $_REQUEST['veh_lic_no2'] . '-' . $_REQUEST['veh_lic_no3'];
    $_fields1['license_plate1'] = $_REQUEST['veh_lic_no1'];
    $_fields1['license_plate2'] = $_REQUEST['veh_lic_no2'];
    $_fields1['license_plate3'] = $_REQUEST['veh_lic_no3'];
    $_fields1['license_plate4'] = $_REQUEST['veh_lic_no4'];
    $_fields1['year'] = $_REQUEST['car_year'];
    $up_v = qu("tb_vehicle", $_fields1, "id='{$_REQUEST['v_id']}'");
//    $combinVehi_lic_plate = $_REQUEST['veh_lic_no1'] . '-' . $_REQUEST['veh_lic_no2'] . '-' . $_REQUEST['veh_lic_no3'];
    $combinVehi_lic_plate1 = $_REQUEST['veh_lic_no1'];
    $combinVehi_lic_plate2 = $_REQUEST['veh_lic_no2'];
    $combinVehi_lic_plate3 = $_REQUEST['veh_lic_no3'];
    $combinVehi_lic_plate4 = $_REQUEST['veh_lic_no4'];
    $v_id = qs("select id from tb_vehicle where license_plate1='$combinVehi_lic_plate1' and license_plate2='$combinVehi_lic_plate2' and license_plate3='$combinVehi_lic_plate3' and license_plate4='$combinVehi_lic_plate4'");
//    d($_REQUEST['veh_lic_no']);
//    d($_REQUEST['d_id']);
//    die();
//    $ans[] = $_POST["ans1"];
//    $ans[] = $_POST["ans2"];
//    $ans[] = $_POST["ans3"];
//    $ans[] = $_POST["ans4"];
//    $ans[] = $_POST["ans5"];
//    $ans[] = $_POST["ans6"];
//    $ans[] = $_POST["ans7"];
//    $ans[] = $_POST["ans8"];
//    $ans[] = $_POST["ans9"];
//    $ans[] = $_POST["ans10"];
//    $ans[] = $_POST["ans11"];
//    $ans[] = $_POST["ans12"];
//    $ans[] = $_POST["ans13"];
//    $ans[] = $_POST["ans14"];
//    $ans[] = $_POST["ans15"];
//    $ans[] = $_POST["ans16"];
//    $ans[] = $_POST["ans17"];
//    $ans[] = $_POST["ans18"];
//    $ans[] = $_POST["ans19"];
//    $ans[] = $_POST["ans20"];
//    $ans[] = $_POST["ans21"];
//    $ans[] = $_POST["ans22"];
//    $ans[] = $_POST["ans23"];
//    $ans[] = $_POST["ans24"];
//    $ans[] = $_POST["ans25"];
//    $ans[] = $_POST["ans26"];
//    $ans[] = $_POST["ans27"];
//    $ans[] = $_POST["ans28"];
//    $ans[] = $_POST["ans29"];
    $u_id = $_SESSION['user']['id'];
//    echo $_REQUEST['v_id'] . " - " . $_REQUEST['d_id'];
    $a_id = q("SELECT id  FROM tb_vehicle_ins_detail WHERE vehicle_id='{$_REQUEST['v_id']}' and driver_id='{$_REQUEST['d_id']}'  ORDER BY tb_vehicle_ins_detail.id ASC");
//    d($a_id);
//    die;
//    for ($i = 0; $i < 29; $i++) {
//        $_fields2['vehicle_id'] = $_REQUEST['v_id'];
//        $_fields2['driver_id'] = $_REQUEST['d_id'];
//        $_fields2['user_id'] = $u_id;
////        $_fields2['qusetion'] = $q[$i];
////        d($ans);
////        d("id is-" .$a_id[$i]. " .");
//        //die();
//        $_fields2['answer'] = $ans[$i];
////        d($_REQUEST['d_id']);
////        d($_REQUEST['v_id']);
////        d($ans[$i]);
//        $answer = $a_id[$i];
////        d($a_id[$i]);
////        die();
////       $set= q("UPDATE tb_vehicle_ins_detail SET answer = '{$ans[$i]}' WHERE id = '{$answer['id']}' and driver_id= '{$_REQUEST['d_id']}' and vehicle_id='{$_REQUEST['v_id']}';");
////       d($set); 
//        $up_vid = qu("tb_vehicle_ins_detail", $_fields2, "driver_id=' {$_REQUEST['d_id']}' and vehicle_id ='{$_REQUEST['v_id']}' and id='{$answer['id']}'");
////        die;
//    }
//    d($up_vid);
//    die();

    if (!empty($up_d)) {
        $get_id = $_REQUEST['d_id'];
        $driver_data = qs("SELECT * FROM tb_driver WHERE id='$get_id' ");

        $_SESSION['driver_id'] = $driver_data;
        $d_id = $_SESSION['driver_id']['id'];
        $v_id = qs("select v.id from tb_vehicle v, tb_driver d where d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and d.id='$d_id'");
        $unm = $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'];
        $u_id = $_SESSION['user']['id'];
        $_fields4['uname'] = $unm;
        $_fields4['user_id'] = $u_id;
        $_fields4['driver_id'] = $d_id;
        $_fields4['vehicle_id'] = $v_id['id'];
//        d($d_id);
//        die();

        $_fields4['station_stage'] = "4";
        $_fields4['operation_type'] = "UPDATE";
        date_default_timezone_get();
        $date = date('m/d/Y h:i:s a', time());
        $_fields4['touch_date'] = $date;
        $_fields4['touch_note'] = "";

        $s1 = qi("tb_station_touch_log", $_fields4);
        $success = '1';
        $msg = "Record updated successfully";
        $query = q("select *, vd.driver_id, d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no, v.make_modal ,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=4 and v.ins_status='pass' and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4" . helper::officeCond());
//        if (!empty($s1)) {
//            _R('pending_contract');
//        }
    } else {
        $success = '-1';
        $msg = "Record can't updated. Please try again.";
    }
}
if (isset($_REQUEST['save'])) {
//    d($_REQUEST['d_id']);
//    d($_REQUEST['v_id']);
//    die();
    $_fields['fname'] = $_REQUEST['fName'];
    $_fields['lname'] = $_REQUEST['lName'];
    $_fields['email'] = $_REQUEST['email'];
    $_fields['phone'] = $_REQUEST['phone'];
    $_fields['melli_no'] = $_REQUEST['melli_no'];
    $_fields['chassis_no'] = $_REQUEST['vin_no'];
//    $_fields['license_plate'] = $_REQUEST['veh_lic_no1'] . '-' . $_REQUEST['veh_lic_no2'] . '-' . $_REQUEST['veh_lic_no3'];
    $_fields['license_plate1'] = $_REQUEST['veh_lic_no1'];
    $_fields['license_plate2'] = $_REQUEST['veh_lic_no2'];
    $_fields['license_plate3'] = $_REQUEST['veh_lic_no3'];
    $_fields['license_plate4'] = $_REQUEST['veh_lic_no4'];
    $_fields['cell_provider'] = $_REQUEST['cell_provider'];
//    $_fields['license_expiry_date'] = date('Y-m-d', strtotime($_REQUEST['license_expiry_date']));
    $licExDate = $_REQUEST['ddl_year'] . '-' . $_REQUEST['ddl_month'] . '-' . $_REQUEST['ddl_date'];
//    d($licExDate);
//    die();
    $_fields['license_expiry_date'] = $licExDate;
//    $_fields['chassis_no'] = $_REQUEST['vin_no'];
//    $_fields['license_plate'] = $_REQUEST['veh_lic_no1'];
    $_fields['username'] = $_REQUEST['uname'];
    $_fields['password'] = $_REQUEST['psw'];
    $up_d = qu("tb_driver", $_fields, "id='{$_REQUEST['d_id']}'");

    $_fields1['make_modal'] = $_REQUEST['car_make'];
    $_fields1['make_modal_other'] = $_REQUEST['other_car'];
//    $_fields1['license_plate'] = $_REQUEST['veh_lic_no1'] . '-' . $_REQUEST['veh_lic_no2'] . '-' . $_REQUEST['veh_lic_no3'];
    $_fields1['license_plate1'] = $_REQUEST['veh_lic_no1'];
    $_fields1['license_plate2'] = $_REQUEST['veh_lic_no2'];
    $_fields1['license_plate3'] = $_REQUEST['veh_lic_no3'];
    $_fields1['license_plate4'] = $_REQUEST['veh_lic_no4'];
    $_fields1['year'] = $_REQUEST['car_year'];
    $up_v = qu("tb_vehicle", $_fields1, "id='{$_REQUEST['v_id']}'");
//    $combinVehi_lic_plate = $_REQUEST['veh_lic_no1'] . '-' . $_REQUEST['veh_lic_no2'] . '-' . $_REQUEST['veh_lic_no3'];
    $combinVehi_lic_plate1 = $_REQUEST['veh_lic_no1'];
    $combinVehi_lic_plate2 = $_REQUEST['veh_lic_no2'];
    $combinVehi_lic_plate3 = $_REQUEST['veh_lic_no3'];
    $combinVehi_lic_plate4 = $_REQUEST['veh_lic_no4'];
    $v_id = qs("select id from tb_vehicle where license_plate1='$combinVehi_lic_plate1' and license_plate2='$combinVehi_lic_plate2' and license_plate3='$combinVehi_lic_plate3' and license_plate4='$combinVehi_lic_plate4'");
//    d($_REQUEST['veh_lic_no']);
//    d($_REQUEST['d_id']);
//    die();
//    $ans[] = $_POST["ans1"];
//    $ans[] = $_POST["ans2"];
//    $ans[] = $_POST["ans3"];
//    $ans[] = $_POST["ans4"];
//    $ans[] = $_POST["ans5"];
//    $ans[] = $_POST["ans6"];
//    $ans[] = $_POST["ans7"];
//    $ans[] = $_POST["ans8"];
//    $ans[] = $_POST["ans9"];
//    $ans[] = $_POST["ans10"];
//    $ans[] = $_POST["ans11"];
//    $ans[] = $_POST["ans12"];
//    $ans[] = $_POST["ans13"];
//    $ans[] = $_POST["ans14"];
//    $ans[] = $_POST["ans15"];
//    $ans[] = $_POST["ans16"];
//    $ans[] = $_POST["ans17"];
//    $ans[] = $_POST["ans18"];
//    $ans[] = $_POST["ans19"];
//    $ans[] = $_POST["ans20"];
//    $ans[] = $_POST["ans21"];
//    $ans[] = $_POST["ans22"];
//    $ans[] = $_POST["ans23"];
//    $ans[] = $_POST["ans24"];
//    $ans[] = $_POST["ans25"];
//    $ans[] = $_POST["ans26"];
//    $ans[] = $_POST["ans27"];
//    $ans[] = $_POST["ans28"];
//    $ans[] = $_POST["ans29"];
    $u_id = $_SESSION['user']['id'];
//    echo $_REQUEST['v_id'] . " - " . $_REQUEST['d_id'];
    $a_id = q("SELECT id  FROM tb_vehicle_ins_detail WHERE vehicle_id='{$_REQUEST['v_id']}' and driver_id='{$_REQUEST['d_id']}'  ORDER BY tb_vehicle_ins_detail.id ASC");
//    d($a_id);
//    die;
//    for ($i = 0; $i < 29; $i++) {
//        $_fields2['vehicle_id'] = $_REQUEST['v_id'];
//        $_fields2['driver_id'] = $_REQUEST['d_id'];
//        $_fields2['user_id'] = $u_id;
////        $_fields2['qusetion'] = $q[$i];
////        d($ans);
////        d("id is-" .$a_id[$i]. " .");
//        //die();
//        $_fields2['answer'] = $ans[$i];
////        d($_REQUEST['d_id']);
////        d($_REQUEST['v_id']);
////        d($ans[$i]);
//        $answer = $a_id[$i];
////        d($a_id[$i]);
////        die();
////       $set= q("UPDATE tb_vehicle_ins_detail SET answer = '{$ans[$i]}' WHERE id = '{$answer['id']}' and driver_id= '{$_REQUEST['d_id']}' and vehicle_id='{$_REQUEST['v_id']}';");
////       d($set); 
//        $up_vid = qu("tb_vehicle_ins_detail", $_fields2, "driver_id=' {$_REQUEST['d_id']}' and vehicle_id ='{$_REQUEST['v_id']}' and id='{$answer['id']}'");
////        die;
//    }
//    d($up_vid);
//    die();

    if (!empty($up_d)) {
        $get_id = $_REQUEST['d_id'];
        $driver_data = qs("SELECT * FROM tb_driver WHERE id='$get_id' ");

        $_SESSION['driver_id'] = $driver_data;
        $d_id = $_SESSION['driver_id']['id'];
        $v_id = qs("select v.id from tb_vehicle v, tb_driver d where d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and d.id='$d_id'");
        $unm = $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'];
        $u_id = $_SESSION['user']['id'];
        $_fields4['uname'] = $unm;
        $_fields4['user_id'] = $u_id;
        $_fields4['driver_id'] = $d_id;
        $_fields4['vehicle_id'] = $v_id['id'];
//        d($d_id);
//        die();

        $_fields4['station_stage'] = "4";
        $_fields4['operation_type'] = "UPDATE";
        date_default_timezone_get();
        $date = date('m/d/Y h:i:s a', time());
        $_fields4['touch_date'] = $date;
        $_fields4['touch_note'] = "";

        $s1 = qi("tb_station_touch_log", $_fields4);
        $success = '1';
        $msg = "Record updated successfully";
        $query = q("select *, vd.driver_id, d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no, v.make_modal ,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=5 and v.ins_status='pass' and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and d.doc_signed_contract='" . helper::officeCond());
//        if (!empty($s1)) {
//            _R('pending_contract');
//        }
    } else {
        $success = '-1';
        $msg = "Record can't updated. Please try again.";
    }
}

if (isset($_REQUEST['submit'])) {
    foreach ($query as $result) {
        if (isset($_REQUEST['chk' . $result['id']]) && $_REQUEST['chk' . $result['id']] != "") {
            //  echo 'checkbox is checked'; 
            $a[] = $result['id'];
            $p[] = $_REQUEST['chk' . $result['id']];
        }
    }
    foreach ($a as $value) {
        $_fields['id'] = $value;
        $_fields['stage'] = '5';
        $add4 = qu("tb_driver", $_fields, "id = '$value'");
//        d($value);
//        die();
    }
    if (!empty($add4)) {
        $success = '1';
        $msg = "Record updated successfully";
        $query = q("select *, vd.driver_id, d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no, v.make_modal ,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=5 and v.ins_status='pass' and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and d.doc_signed_contract='" . helper::officeCond());
//        _R('pending_contract');
    } else {
        $success = '-1';
        $msg = "Record can't updated. Please try again.";
    }

////if (isset($_POST['chk' . $row['id']]) && $_POST['chk' . $row['id']] != "") {
//    //  echo 'checkbox is checked'; 
//    $p = $_REQUEST['chk' . $row['id']];
}
//foreach ($query1 as $r) {
//    if (isset($_REQUEST['modal' . $row['id']])) {
//         $a[] = $result['id'];
//         d($a);
//         die();
////    q("select * from tb_driver d, tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=4 and d.license_plate=v.license_plate ");
//    }
//}

if (isset($_REQUEST['saveRecord'])) {
    $get_id = $_REQUEST['id'];
    $_fields3['stage'] = '5';
//   d($get_id);

    $add4 = qu("tb_driver", $_fields3, "id = '$get_id'");
    if (!empty($add4)) {
        $driver_data = qs("SELECT * FROM tb_driver WHERE id='$get_id' ");

        $_SESSION['driver_id'] = $driver_data;
        $d_id = $_SESSION['driver_id']['id'];
        $v_id = qs("select v.id from tb_vehicle v, tb_driver d where d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and d.id='$d_id'");
        $unm = $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'];
        $u_id = $_SESSION['user']['id'];
        $_fields4['uname'] = $unm;
        $_fields4['user_id'] = $u_id;
        $_fields4['driver_id'] = $d_id;
        $_fields4['vehicle_id'] = $v_id['id'];
//        d($d_id);
//        die();

        $_fields4['station_stage'] = "5";
        $_fields4['operation_type'] = "ADD";
        date_default_timezone_get();
        $date = date('m/d/Y h:i:s a', time());
        $_fields4['touch_date'] = $date;
        $_fields4['touch_note'] = "";

        $s1 = qi("tb_station_touch_log", $_fields4);
        $_SESSION['success'] = '1';
        $_SESSION['msg'] = "Record updated successfully";
        echo json_encode(array("msg" => ""));
    } else {
        $_SESSION['success'] = '-1';
        $_SESSION['msg'] = "Record can't updated. Please try again.";
        echo json_encode(array("msg" => ""));
    }
    die();
}
if ($_REQUEST['name_startsWith'] != '') {
    $data = array();
    $name = $_REQUEST['name_startsWith'];
    $data = q("select * from customer where first_name like '%{$name}%'");
    $resultdata = array();
    foreach ($data as $row) {
        $name = $row['first_name'] . '|' . $row['last_name'] . '|' . $row['phone'] . '|' . $row['email'];
        array_push($resultdata, $name);
    }
    echo json_encode($resultdata);
    die;
}
//if ($_REQUEST['id'] != "0") {
//    $obj = new calculatePrice1();
//    $obj->getValue(_escape($_REQUEST['id']));
//}
if (isset($_REQUEST['_doLoadDynamicDays'])) {


    if ($_REQUEST['id'] != "0") {
        $obj = new calculatePrice1();
        $obj->getValue(_escape($_REQUEST['id']));
    }
    include _PATH . "instance/front/tpl/step1_dynamic_steps.php";

    die;
}

# step1 data save
//if ($_POST['fName'] != '') {
////    d($_POST);
//    calculatePrice1::$fname = trim($_POST['fName']);
//    calculatePrice1::$lname = trim($_POST['lName']);
//    calculatePrice1::$phone = trim($_POST['phone']);
//    calculatePrice1::$email = trim($_POST['email']);
//    calculatePrice1::$tax = trim($_POST['tax']);
//    calculatePrice1::$gratuity = trim($_POST['gratuity']);
//    calculatePrice1::$internal_notes = trim($_POST['internal_notes']);
//    calculatePrice1::$customer_notes = trim($_POST['cust_notes']);
//    $obj = new calculatePrice1();
//    $c = 0;
//    foreach ($_POST['day'] as $key => $days) {
//// d(($days));
//        if (trim($days['pickup']) != '') {
//            calculatePrice1::$days[$c]['pu'] = calculatePrice1::$pu = trim($days['pickup']);
//            calculatePrice1::$days[$c]['do'] = calculatePrice1::$do = trim($days['dropoff']);
//            calculatePrice1::$days[$c]['pDate'] = calculatePrice1::$pickupDate = date("Y-m-d", strtotime(trim($days['pDate'])));
//            calculatePrice1::$days[$c]['pTime'] = calculatePrice1::$pickupTime = trim($days['pTime']);
//            calculatePrice1::$days[$c]['stops'] = $days['stop'];
////            $hours = $obj->calcBillableHours();
////            calculatePrice1::$days[$c]['puDH'] = calculatePrice1::$puDeadHead;
////            calculatePrice1::$days[$c]['doDH'] = calculatePrice1::$doDeadHead;
////            calculatePrice1::$days[$c]['doBH'] = calculatePrice1::$billableHours;
//
//            unset($test);
//            $test = array();
//            $vehicles_selected = array_filter($days['vehicle']);
//            foreach ($vehicles_selected as $key => $value) {
//
//                $carId = $value; // value is car id now
//
//                $hours = clearDecimal($days['min_hours'][$key]);
//                $rate = clearDecimal($days['rate_value'][$key]);
//
//                $total_vehicle = clearDecimal($days['total_vehicle'][$key]);
//
//                $carName = $carId == 'other' ? $days['custom_vehicle'][$key] : helper::getCarName($carId);
//
//                $tax = intval(clearDecimal($_POST['tax'])) > 0 ? clearDecimal($_POST['tax']) / 100 : 0;
//                $gratuity = intval(clearDecimal($_POST['gratuity'])) > 0 ? clearDecimal($_POST['gratuity']) / 100 : 0;
//                $baseAmount1 = $days['rate_type'][$key] == 'flat' ? clearDecimal($days['rate_value'][$key]) * $total_vehicle : $total_vehicle * $rate * $hours;
//
//                if ($gratuity > 0) {
//                    $gratuity = (($gratuity * $baseAmount1) );
//                }
//                if ($tax > 0) {
//                    $tax = (($tax * $baseAmount1) );
//                }
//
//                $amount1 = $baseAmount1 + $tax + $gratuity;
//                if (!is_array($days['vehicle'][$key])) {
//                    $test[$key]['rate_type'] = $days['rate_type'][$key];
//                    $test[$key]['vehicle'] = $carId;
//                    $test[$key]['car_name'] = $carName;
//                    $test[$key]['hourly_rate'] = clearDecimal($days['rate_value'][$key]);
//                    $test[$key]['min_hours'] = $hours;
//                    $test[$key]['quantity'] = $total_vehicle;
//                    $test[$key]['baseAmount'] = $baseAmount1;
//                    $test[$key]['gratuity'] = $gratuity;
//                    $test[$key]['tax'] = $tax;
//                    $test[$key]['amount'] = $amount1;
//                }
//                foreach ($days['vehicle']['option'][$key] as $option => $optionValue) {
//                    if (isset($optionValue) && $optionValue != '') {
//                        $carId = $optionValue; // value is car id now
//                        $hours = clearDecimal($days['min_hours']['option'][$key][$option]);
//                        $rate = clearDecimal($days['rate_value']['option'][$key][$option]);
//
//                        $total_vehicle = clearDecimal($days['total_vehicle']['option'][$key][$option]);
//
//                        $carName = $carId == 'other' ? $days['custom_vehicle']['option'][$key][$option] : helper::getCarName($carId);
//
//                        $tax = intval(clearDecimal($_POST['tax'])) > 0 ? clearDecimal($_POST['tax']) / 100 : 0;
//                        $gratuity = intval(clearDecimal($_POST['gratuity'])) > 0 ? clearDecimal($_POST['gratuity']) / 100 : 0;
//
//                        $baseAmount1 = $days['rate_type']['option'][$key][$option] == 'flat' ? clearDecimal($days['rate_value']['option'][$key][$option]) * $total_vehicle : $total_vehicle * $rate * $hours;
//
//                        if ($gratuity > 0) {
//                            $gratuity = (($gratuity * $baseAmount1) );
//                        }
//                        if ($tax > 0) {
//                            $tax = (($tax * $baseAmount1) );
//                        }
//
//                        $amount1 = $baseAmount1 + $tax + $gratuity;
//
//                        $test1 = array();
////                        echo $days['rate_value']['option'][$option][$key]; 
//                        $test1['rate_type'] = $days['rate_type']['option'][$key][$option];
//                        $test1['vehicle'] = $carId;
//                        $test1['car_name'] = $carName;
//                        $test1['hourly_rate'] = clearDecimal($days['rate_value']['option'][$key][$option]);
//                        $test1['min_hours'] = $hours;
//                        $test1['quantity'] = $total_vehicle;
//                        $test1['baseAmount'] = $baseAmount1;
//                        $test1['gratuity'] = $gratuity;
//                        $test1['tax'] = $tax;
//                        $test1['amount'] = $amount1;
//                        $test[$key]['option'][] = $test1;
//                    }
//                }
//
//                # if flat rate - then - flat rate * total vehicle
//                # if hourly rate - then - total vehicle * rate * hours
//            }
//            calculatePrice1::$days[$c]['car'] = $test;
//
//            $c++;
//        }
//    }
//    // chnages logic
//    $charges = array_filter($_POST['cname']['c_name']);
//    $chargeArray = array();
//    $c = 0;
//    foreach ($charges as $chargeKey => $chargeValue) {
//        $chargeArray[$c]['name'] = $chargeValue;
//        $chargeArray[$c]['value'] = clearDecimal($_POST['cname']['c_value'][$chargeKey]);
//        $c++;
//    }
//    calculatePrice1::$charge = $chargeArray;
//
//    if ($_REQUEST['id'] != '') {
//        $id = $obj->setValue($_REQUEST['id']);
//        $string = "quote_step2?id=" . $id;
//    } else {
//        $id = $obj->setValue();
//        $string = "quote_step2?id=" . $id;
//    }
//    _R(lr($string));
//    //die;
//}
//$query = "SELECT * FROM fleet WHERE tenant_id='{$_SESSION['user']['id']}'";
//$fleet_data = q($query);
if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    $msg = $_SESSION['msg'];
    unset($_SESSION['success']);
    unset($_SESSION['msg']);
}
$jsInclude = 'pending_contract.js.php';
_cg("page_title", "Pending Contract");
