<?php

if (!isset($_SESSION['user']) && !(in_array('Manager', $_SESSION['user']['roles'])) && !(in_array('Admin', $_SESSION['user']['roles']))) {
    _R('login');
}

//d($_REQUEST);
//_errors_on();
//$query = q("select *,"
//        . "d.modified_at as rejdate, d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no,"
//        . "v.make_modal,v.make_modal_other "
//        . "from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd, "
//        . "tb_station_touch_log st "
//        . "where vd.driver_id=d.id and "
//        . "vd.vehicle_id=v.id and d.stage='reject'  "
//        . "and st.operation_type='reject' "
//        . "and st.driver_id=vd.driver_id and st.vehicle_id=vd.vehicle_id" . helper::OrderByDesc());
//        
//select * from tb_driver td left join tb_station_touch_log tsl on tsl.driver_id=td.id where tsl.operation_type='reject'
//$query = q("SELECT *,modified_at as rejdate from tb_driver WHERE tb_driver.stage='reject' and office='Gandhi' UNION DISTINCTROW select * from tb_station_touch_log WHERE station_stage='reject' ");
//
//$query = q("select * from tb_driver td JOIN tb_station_touch_log tsl ON tsl.driver_id = td.id AND tsl.id in (select max(id) from tb_station_touch_log where tb_station_touch_log.operation_type='reject' group by driver_id having operation_type='reject' order by id DESC) and td.office='Gandhi' and td.stage='reject' ");

$query = q("select *,d.modified_at as rejdate, vd.driver_id, d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no, v.make_modal ,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage='reject'  and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 " . helper::officeCond() . helper::OrderByDesc());
$query_data = q("select * from tb_station_touch_log ");

foreach ($query_data as $dataRow) {
    $data_uname[$dataRow['driver_id']] = $dataRow['uname'];
    $data_touch_note[$dataRow['driver_id']] = $dataRow['touch_note'];
    $data_station_stage[$dataRow['driver_id']] = $dataRow['station_stage'];
}
//d($data_touch_note);
//die();
//$data['driver_id'] = > $note
//. "and d.license_plate=v.license_plate "
//$query2 = qs("select * from tb_driver d, tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=4 and d.license_plate=v.license_plate and d.id=9");
//d($query);
//die();

if (isset($_REQUEST['submit'])) {
//    d($_REQUEST);
//die();
    _R('rejected_driver');
}
if (isset($_REQUEST['getInfo'])) {
    $driver_id = $_REQUEST['id'];
    $driver_stage = $_REQUEST['stage'];
    $st = qs("select *,d.id as did ,v.id AS vid from tb_driver d, tb_vehicle v ,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and d.id='$driver_id' ");
    echo json_encode($st);
//    d($st);
    die();
}

if (isset($_REQUEST['saveNotes'])) {
    $unm = $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'];
    $u_id = $_SESSION['user']['id'];
    $fields['uname'] = $unm;
    $fields['user_id'] = $u_id;
    $fields['driver_id'] = $_REQUEST['driver_id'];
    $fields['vehicle_id'] = $_REQUEST['vehicle_id'];
    foreach ($_POST['station'] as $key => $value) {
        $val_stage = $value;
        $station_stage = $value;
    }
    $fields['station_stage'] = "reject";

    $fields['operation_type'] = "CHANGE";
    $date = date('m/d/Y h:i:s a', time());
    $fields['touch_date'] = $date;
    $fields['touch_note'] = $_REQUEST['v_note1'];
    $insert_id = qi("tb_station_touch_log", _escapeArray($fields));

    if ($station_stage == 1) {
//        qd("tb_vehicle_ins_detail", "vehicle_id='{$_REQUEST['vehicle_id']}' AND driver_id='{$_REQUEST['driver_id']}'");

        qu("tb_vehicle", array("ins_status" => ""), "id='{$_REQUEST['vehicle_id']}'");
//        qu("tb_driver", array("stage" => $val_stage, "old_stage" => "reject"), "id='{$_REQUEST['driver_id']}'");
        qu("tb_driver", array("stage" => "1", "old_stage" => "reject", "office" => "{$_SESSION['office']}"), "id='{$_REQUEST['driver_id']}'");
    } else {

        qu("tb_vehicle", array("ins_status" => "pass"), "id='{$_REQUEST['vehicle_id']}'");

//        qu("tb_driver", array("stage" => $station_stage, "old_stage" => "reject"), "id='{$_REQUEST['driver_id']}'");
        qu("tb_driver", array("stage" => "1", "old_stage" => "reject", "office" => "{$_SESSION['office']}"), "id='{$_REQUEST['driver_id']}'");
    }

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
//        $_SESSION['success'] = '1';
//        $_SESSION['msg'] = "Note added successfully";
        $success = '1';
        $msg = "Note added successfully";
//        echo json_encode(array("success" => "1", "msg" => "Note added successfully"));
//    d($t_id);
//    die();
        $up_time = qu("tb_time_spend", $_fields6, "id='{$t_id['id']}'");
    } else {
//        echo json_encode(array("success" => "0", "msg" => "Note can't be added.Please try again."));
//        $_SESSION['success'] = '0';
//        $_SESSION['msg'] = "Note can't be added.Please try again.";
        $success = '-1';
        $msg = "Record can't updated. Please try again.";
//    die;
    }
//    $query = q("select *,d.modified_at as rejdate, d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no,v.make_modal,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd, tb_station_touch_log st where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage='reject'  and d.license_plate=v.license_plate and st.operation_type='reject' and st.driver_id=vd.driver_id and st.vehicle_id=vd.vehicle_id;");
//    $query = q("SELECT *,d.id as did, d.modified_at as rejdate from tb_driver d, tb_vehicle v ,tb_vehicle_driver vd WHERE vd.driver_id=d.id and vd.vehicle_id=v.id and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4 and d.stage='reject' and d.office='Gandhi'");
    $query = q("select *,d.modified_at as rejdate, vd.driver_id, d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no, v.make_modal ,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage='reject'  and d.license_plate1=v.license_plate1 and d.license_plate2=v.license_plate2 and d.license_plate3=v.license_plate3 and d.license_plate4=v.license_plate4" . helper::officeCond() . helper::OrderByDesc());
    $query_data = q("select * from tb_station_touch_log ");

    foreach ($query_data as $dataRow) {
        $data_uname[$dataRow['driver_id']] = $dataRow['uname'];
        $data_touch_note[$dataRow['driver_id']] = $dataRow['touch_note'];
        $data_station_stage[$dataRow['driver_id']] = $dataRow['station_stage'];
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
//    $_fields['license_plate'] = $_REQUEST['veh_lic_no1'];
//    $_fields['username'] = $_REQUEST['uname'];
//    $_fields['password'] = $_REQUEST['psw'];
    $up_d = qu("tb_driver", $_fields, "id='{$_REQUEST['d_id']}'");

//    $_fields1['make_modal'] = $_REQUEST['car_make'];
//    $_fields1['make_modal_other'] = $_REQUEST['other_car'];
////    $_fields1['license_plate'] = $_REQUEST['veh_lic_no2'];
//    $_fields1['year'] = $_REQUEST['car_year'];
//    $up_v = qu("tb_vehicle", $_fields1, "id='{$_REQUEST['v_id']}'");
    $v_id = qs("select id from tb_vehicle where license_plate='{$_REQUEST['veh_lic_no']}'");
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
//        echo "its run";
        $get_id = $_REQUEST['d_id'];
        $driver_data = qs("SELECT * FROM tb_driver WHERE id='$get_id' ");

        $_SESSION['driver_id'] = $driver_data;
        $d_id = $_SESSION['driver_id']['id'];
        $v_id = qs("select v.id from tb_vehicle v, tb_driver d where d.license_plate=v.license_plate and d.id='$d_id'");
        $unm = $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'];
        $u_id = $_SESSION['user']['id'];
        $_fields4['uname'] = $unm;
        $_fields4['user_id'] = $u_id;
        $_fields4['driver_id'] = $d_id;
        $_fields4['vehicle_id'] = $v_id['id'];
//        d($u_id);
//        die();

        $_fields4['station_stage'] = "2";
        $_fields4['operation_type'] = "UPDATE";
        date_default_timezone_get();
        $date = date('m/d/Y h:i:s a', time());
        $_fields4['touch_date'] = $date;
        $_fields4['touch_note'] = "";

        $s1 = qi("tb_station_touch_log", $_fields4);
        $success = '1';
        $msg = "Record updated successfully";
//        $query = q("select *, d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no,v.make_modal,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=2 and v.ins_status='fail' and d.license_plate=v.license_plate");
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
if (isset($_REQUEST['getNote'])) {
    $d_id = $_REQUEST['id'];
    $stage = $_REQUEST['stage'];
    $ques = qs("SELECT * from tb_station_touch_log st, tb_driver d,tb_vehicle v, tb_vehicle_driver vd WHERE vd.vehicle_id=v.id and vd.driver_id= d.id and st.driver_id=vd.driver_id and st.vehicle_id=vd.vehicle_id and d.stage=st.station_stage and d.id='$d_id' and d.stage='$stage'");
    echo json_encode($ques);
//    d($ques);
    die();
}
if (isset($_REQUEST['getData2'])) {
    $d_id = $_REQUEST['id'];
    $st2 = qs("select *, d.id, d.fname, d.lname,d.license_plate,d.phone,d.melli_no,v.make_modal,v.make_modal_other from tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vd.driver_id=d.id and vd.vehicle_id=v.id and d.stage=2 and d.license_plate=v.license_plate and driver_id='$d_id'");
//   d($st2);
    echo json_encode($st2);
    die();
//    die();
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
//if (isset($_REQUEST['getQuestion'])) {
//    $d_id = $_REQUEST['d_id'];
//    $v_id = $_REQUEST['vid'];
////    d($v_id);
////    die();
//    $stage = $_REQUEST['stage'];
////    $ques = q("select * from tb_vehicle_ins_detail where driver_id='{$d_id}' and vehicle_id='{$v_id}' order by id asc");
//    $ques = q("select * from tb_vehicle_ins_detail vid, tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vid.driver_id=vd.driver_id and vd.driver_id=d.id and vd.vehicle_id=v.id  and d.license_plate=v.license_plate and vid.driver_id='$d_id' and d.stage='$stage'  ORDER BY `vid`.`id` ASC");
//    foreach ($ques as $value) {
//        $a[$value['question_no']] = $value['answer'];
//    }
//    echo json_encode(array("found" => count($a), 'record' => $a));
////    d($ques['question_no']);
//    die;
//}
if (isset($_REQUEST['getQuestion'])) {
    $d_id = $_REQUEST['id'];
    $stage = $_REQUEST['stage'];
    $ques = q("select * from tb_vehicle_ins_detail vid, tb_driver d,  tb_vehicle v,tb_vehicle_driver vd where vid.driver_id=vd.driver_id and vd.driver_id=d.id and vd.vehicle_id=v.id  and d.license_plate=v.license_plate and vid.driver_id='$d_id' and d.stage='$stage'  ORDER BY `vid`.`id` ASC");
    foreach ($ques as $value) {
        $a[$value['question_no']] = $value['answer'];
    }
    echo json_encode(array("found" => count($a), 'record' => $a));
//   d($a);
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
if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    $msg = $_SESSION['msg'];
    unset($_SESSION['success']);
    unset($_SESSION['msg']);
}

$jsInclude = 'rejected_driver.js.php';
_cg("page_title", "Rejected Driver");
