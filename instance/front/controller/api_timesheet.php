<?php

$emplist = "";
$flag = "false";
$empId = $_REQUEST['userid'];
$selecteDate = jtg_datetime($_REQUEST['date']);

$isuserhavingshift = qs("select * from tb_assign_shift asf,tb_shift_time wsf where wsf.user_id=asf.user_id and wsf.user_id='$empId' and wsf.sDate='$selecteDate' and asf.start_date='$selecteDate'");
//d($isuserhavingshift);
//die;
$data = array();
$ass_shift = qs("select * from tb_assign_shift where user_id='$empId' AND start_date='$selecteDate'");
$data['assign_shift_id'] = $ass_shift['id'];
$data['assign_start_time'] = $ass_shift['start_time'];
$data['assign_end_time'] = $ass_shift['end_time'];

//$timesheet = qs("select sf.*, sf.id as sfid,e.fname,e.lname from tb_employee e, tb_shift_time sf where e.id=sf.user_id and e.id='$empId' AND e.work_at='{$_SESSION['company']['id']}' AND sf.sDate='$selecteDate'");
$timesheet = qs("select sf.*, sf.id as sfid,e.fname,e.lname from tb_employee e, tb_shift_time sf where e.id=sf.user_id and e.id='$empId' AND sf.sDate='$selecteDate'");
$data['fname'] = $timesheet['fname'];
$data['lname'] = $timesheet['lname'];
$data['work_shift_id'] = $timesheet['sfid'];

$data['work_start_time'] = $timesheet['start_time'];
$data['work_end_time'] = $timesheet['end_time'];
$data['lunch_break_start_1'] = gtj_datetime($timesheet['lunch_break_start_1']);
$data['lunch_break_end_1'] = gtj_datetime($timesheet['lunch_break_end_1']);
$data['lunch_break_total_1'] = $timesheet['lunch_break_total_1'];
$data['lunch_break_start_2'] = gtj_datetime($timesheet['lunch_break_start_2']);
$data['lunch_break_end_2'] = gtj_datetime($timesheet['lunch_break_end_2']);
$data['lunch_break_total_2'] = $timesheet['lunch_break_total_2'];
$data['lunch_break_start_3'] = gtj_datetime($timesheet['lunch_break_start_3']);
$data['lunch_break_end_3'] = gtj_datetime($timesheet['lunch_break_end_3']);
$data['lunch_break_total_3'] = $timesheet['lunch_break_total_3'];
$data['lat_clockstart'] = $timesheet['lat_clockstart'];
$data['lng_clockstart'] = $timesheet['lng_clockstart'];
$data['total_break_time'] = $timesheet['break_time'];
$data['total_hours'] = $timesheet['total_hours'];
//************OVERTIME COUNT***********
$OTtime = "0";
if (!empty($ass_shift['start_time'])) {
    if (!empty($timesheet['start_time'])) {
        $diff = strtotime($ass_shift['start_time']) - strtotime($timesheet['start_time']); // do the math
        $tot_min = $diff / 60;
        $AllowOT = qs("select * from tb_employee_settings where emp_id=' {$timesheet['user_id']}' and company_id='{$_SESSION['company']['id']}'");

        $OTtime = "0";
        if ($tot_min >= 0) {
            if ($tot_min <= $AllowOT['before_time']) {
                $OTtime = $OTtime + $tot_min;
            } else {
                $OTtime = $OTtime + $AllowOT['before_time'];
            }
        }
    }
} if (!empty($ass_shift['end_time'])) {
    if (!empty($timesheet['end_time'])) {
        $diff = strtotime($timesheet['end_time']) - strtotime($ass_shift['end_time']); // do the math
        $tot_min = $diff / 60;
//                                echo '|' . $tot_min;
        if ($tot_min >= 0) {
            if ($tot_min <= $AllowOT['after_time']) {
                $OTtime = $OTtime + $tot_min;
            } else {
                $OTtime = $OTtime + $AllowOT['after_time'];
            }
        }
    }
}
//                        echo $OTtime . " M";
$data["overtime"] = $OTtime;

//***************LATE ARRIVAL COUNT**********
if (!empty($ass_shift['start_time'])) {
    if (!empty($timesheet['start_time'])) {
        $diff = strtotime($timesheet['start_time']) - strtotime($ass_shift['start_time']); // do the math
        $tot_min = $diff / 60;
        $AllowLetStart = qs("select * from tb_employee_settings where emp_id=' {$timesheet['user_id']}' and company_id='{$_SESSION['company']['id']}'");
        $minuteLate = $tot_min - $AllowLetStart['tolrance_timeIn'];
        if ($minuteLate >= 1) {
            $minuteLate = $minuteLate . " M";
        } else {
            $minuteLate = "0";
        }
    } else {
        $minuteLate = "0";
    }
}
$data["late_arrival"] = $minuteLate;
$data["late_penalize"] = $minuteLate = $minuteLate * $AllowLetStart['penalize'] . " M";


//********EARLY DEPT********
if (!empty($ass_shift['end_time'])) {
    if (!empty($work['end_time'])) {
        $diff = strtotime($ass_shift['end_time']) - strtotime($work['end_time']); // do the math
        $tot_min = $diff / 60;
        $AllowEarlyEnd = qs("select * from tb_employee_settings where emp_id=' {$work['user_id']}' and company_id='{$_SESSION['company']['id']}'");
        $minuteEarly = $tot_min - $AllowEarlyEnd['tolrance_timeOut'];
        if ($minuteEarly >= 1) {
            $minuteEarly = $minuteEarly . " M";
        } else {
            $minuteEarly = "0";
        }
    } else {
        $minuteEarly = "0";
    }
}
$data["early_dept"] = $minuteEarly;
$data["early_penalize"] = $minuteEarly = $minuteEarly * $AllowEarlyEnd['penalize'] . " M";
$data["time_off"] = $minuteEarly + $minuteLate . " M";

//d($_REQUEST);
//d($ass_shift);
//d($data);
//d($timesheet);
//die;
if (!empty($isuserhavingshift)) {
    $flag = "true";
    $fields = array();
    $fields['result'] = "success";
    $fields['is_shift'] = $flag;
    $fields['timesheet_data'] = $data;

    $fields['msg'] = "Timesheet data existing";
    echo _api_response($fields);
} else {
    $fields = array();
    $fields['result'] = "error";
    $fields['is_shift'] = $flag;
    $fields['timesheet_data'] = "-1";
    $fields['msg'] = "Timesheet data not existing";
    echo _api_response($fields);
}
die;
?>