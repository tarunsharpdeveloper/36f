<?php

$user_data = "";
$locations = "";
$flag = "false";
//date_default_timezone_set('Asia/Kolkata');
$userId = $_REQUEST['userid'];
//$startDate = date('Y-m-d', strtotime($_REQUEST['startdate']));
//$endDate = date('Y-m-d', strtotime($_REQUEST['enddate']));
$startDate = jtg_datetime($_REQUEST['startdate']);
$endDate = jtg_datetime($_REQUEST['enddate']);
//$test = date('Y-m-d', strtotime($selectDate));
////    d($test);
//$s_day = Date("w", strtotime($test));
//$week_start = date('Y-m-d', strtotime($test . '-' . $s_day . ' days'));
//$week_end = date('Y-m-d', strtotime($test . '+' . (6 - $s_day) . ' days'));
//d("select * from `tb_assign_shift` WHERE user_id='$userId' and start_date>='$startDate' and start_date<='$endDate' ");
$PasingData = array();
$assignShiftData = q("select * from `tb_assign_shift` WHERE user_id='$userId' and start_date>='$startDate' and start_date<='$endDate' ");
//echo _api_response($assignShiftData);
//foreach ($assignShiftData as $ASFdata) {
$i = "";
$shiftStatus = "";
for ($i = 0; $i < count($assignShiftData); $i++) {

    $emp = qs("select * from tb_employee where id='{$assignShiftData[$i]['user_id']}' ");
//    d("select id,name,address,latlng from tb_location where id IN ({$assignShiftData[$i]['area_of_work']}) ");
    $locations = q("select id,name,address,latlng from tb_location where id IN ({$assignShiftData[$i]['area_of_work']}) ");
//    foreach ($locations as $Location_data) {
//        $location = $Location_data;
//    }
    //
    $PasingData[$i] = $assignShiftData[$i];

    $PasingData[$i]['username'] = $emp['fname'] . " " . $emp['lname'];
    $isHavingShift = qs("SELECT * FROM tb_shift_time WHERE user_id='{$assignShiftData[$i]['user_id']}' and sDate<='{$assignShiftData[$i]['start_date']}' and sDate>='{$assignShiftData[$i]['start_date']}' ORDER BY sDate DESC, `tb_shift_time`.`created_at` DESC LIMIT 1 ");

//    $start_time = date("Y-m-d ", strtotime($isHavingShift['sDate'])) . " " . $isHavingShift['start_time'];
    $current_time = date('Y-m-d H:i');
    $start_time = $assignShiftData[$i]['start_date'] . " " . $assignShiftData[$i]['start_time'];
    $end_time = $assignShiftData[$i]['end_date'] . " " . $assignShiftData[$i]['end_time'];
    $start_time = date("Y-m-d H:i", strtotime($start_time));
    $end_time = date("Y-m-d H:i", strtotime($end_time));
//    d($current_time);
//    d($start_time);
//    d($end_time);
    if (empty($isHavingShift["start_time"]) && empty($isHavingShift["end_time"])) {

        if ($current_time < $start_time) {
            $shiftStatus = "UPCOMMING";
        } else {
            if ($current_time > $start_time && $current_time < $end_time) {
                $shiftStatus = "LATE";
            }
            if ($current_time > $start_time && $current_time > $end_time) {
                $shiftStatus = "MISSED";
            }
        }
    } else {
        if (!empty($isHavingShift["start_time"]) && !empty($isHavingShift["end_time"])) {
            if ($isHavingShift["shift_status"] == "IN_LUNCH") {
                $shiftStatus = "ON LUNCH";
            } elseif ($isHavingShift["shift_status"] == "CHECKEDOUT") {
                $shiftStatus = "COMPLETED";
            } else {
                $shiftStatus = "ON SHIFT";
            }
        }
        if (!empty($isHavingShift["start_time"]) && empty($isHavingShift["end_time"])) {

            $shiftStatus = "ON SHIFT";
        }
    }
    $PasingData[$i]['status'] = $shiftStatus;
    $PasingData[$i]['photo'] = base64_encode($emp['b_photo']);

    $PasingData[$i]['location_data'] = $locations;
    $PasingData[$i]['team_name'] = $emp['access_level'];
    $coWorkerData = array();
    $coemp = q("select * from `tb_assign_shift` WHERE not user_id='{$assignShiftData[$i]['user_id']}' and start_date>='{$assignShiftData[$i]['start_date']}' and start_date<='{$assignShiftData[$i]['start_date']}'  ");
    for ($j = 0; $j < count($coemp); $j++) {
        $colocations = q("select id,name,address,latlng from tb_location where id IN ({$assignShiftData[$i]['area_of_work']}) ");
        $co = qs("select * from tb_employee where id='{$coemp[$j]['user_id']}' and work_at = '{$emp['work_at']}'");
        $coWorkerData[$j] = $coemp[$j];

        $coWorkerData[$j]['username'] = $co['fname'] . " " . $co['lname'];
//        $coWorkerData[$j]['photo'] = base64_encode($co['b_photo']);
//        $coWorkerData[$j]['photo'] = "BLOB";

        $coWorkerData[$j]['location_data'] = $colocations;
    }
    $PasingData[$i]['co-workers'] = $coWorkerData;
    $PasingData[$i]['start_date'] = gtj_datetime($PasingData[$i]['start_date']);
    $PasingData[$i]['end_date'] = gtj_datetime($PasingData[$i]['end_date']);
    $PasingData[$i]['created_at'] = gtj_datetime($PasingData[$i]['created_at']);
    $PasingData[$i]['modified_at'] = gtj_datetime($PasingData[$i]['modified_at']);
}

//}
//d($PasingData);
//die;
if (!empty($assignShiftData)) {
    $flag = "true";
    $fields = array();
    $fields['result'] = "success";
    $fields['is_shift'] = "true";
    $fields['shiftData'] = $PasingData;
//    $fields['shift_location'] = $locations;

    $fields['msg'] = "Assign Shift Found";

    echo _api_response($fields);
} else {
    $fields = array();
    $fields['result'] = "error";
    $fields['is_shift'] = "flase";
    $fields['shiftData'] = "-1";
//    $fields['shift_location'] = "-1";
    $fields['msg'] = "Assign Shift Not Found";
    echo _api_response($fields);
}

die;
?>