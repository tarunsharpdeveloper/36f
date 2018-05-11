<?php

$emplist = "";
$flag = "false";
$empId = $_REQUEST['userid'];
$selecteDate = explode("/", $_REQUEST['date']);
$Date = date("F Y", strtotime(jtg_datetime($selecteDate[0] . "-" . $selecteDate[1] . "-" . $selecteDate[2])));

$timestamp = strtotime($Date);
$startDate = date('Y-m-d 00:00:00 ', $timestamp);
$endDate = date('Y-m-t 00:00:00', $timestamp); // A leap year!
//d($startDate);
//d($endDate);
//$isuserhavingshift = q("select * from tb_assign_shift asf,tb_shift_time wsf where wsf.user_id=asf.user_id and wsf.user_id='$empId' and wsf.sDate>='$selecteDate' and asf.start_date='$selecteDate'");
$isuserhavingshift = q("select * from tb_shift_time wsf where wsf.user_id='$empId' and wsf.sDate>='$startDate' and wsf.sDate<='$endDate'  ORDER BY wsf.sDate ASC");
//d($isuserhavingshift);
$Details = array();
$TotData = array();
$i = '0';
$m_tot_hr_a = "0";
$m_tot_hr_p = "0";
$m_ot_a = "0";
$m_ot_p = "0";
$m_la_depat_a = "0";
$m_la_depat_p = "0";
foreach ($isuserhavingshift as $value) {

    $data = array();



    $dt = date('Y-m-d', strtotime($value['sDate']));
    $ass_shift = qs("select * from tb_assign_shift where user_id='$empId' AND start_date='$dt'");
    if (empty($ass_shift)) {
        
    } else {
        $data['assign_shift_id'] = $ass_shift['id'];
        $data['assign_start_time'] = $ass_shift['start_time'];
        $data['assign_end_time'] = $ass_shift['end_time'];

        $timesheet = qs("select sf.*, sf.id as sfid,e.fname,e.lname from tb_employee e, tb_shift_time sf where e.id=sf.user_id and e.id='$empId' AND e.work_at='{$_SESSION['company']['id']}' AND sf.sDate='{$value['sDate']}'");
//    d($timesheet);
//    die;
        $data['fname'] = $timesheet['fname'];
        $data['lname'] = $timesheet['lname'];
        $data['work_shift_date'] = $timesheet['sDate'];
        $data['work_shift_id'] = $timesheet['sfid'];

        $data['work_start_time'] = $timesheet['start_time'];
        $data['work_end_time'] = $timesheet['end_time'];
        $data['lunch_break_start_1'] = $timesheet['lunch_break_start_1'];
        $data['lunch_break_end_1'] = $timesheet['lunch_break_end_1'];
        $data['lunch_break_total_1'] = $timesheet['lunch_break_total_1'];
        $data['lunch_break_start_2'] = $timesheet['lunch_break_start_2'];
        $data['lunch_break_end_2'] = $timesheet['lunch_break_end_2'];
        $data['lunch_break_total_2'] = $timesheet['lunch_break_total_2'];
        $data['lunch_break_start_3'] = $timesheet['lunch_break_start_3'];
        $data['lunch_break_end_3'] = $timesheet['lunch_break_end_3'];
        $data['lunch_break_total_3'] = $timesheet['lunch_break_total_3'];
        $data['lat_clockstart'] = $timesheet['lat_clockstart'];
        $data['lng_clockstart'] = $timesheet['lng_clockstart'];
        $data['total_break_time'] = $timesheet['break_time'];
        $data['total_hours'] = $timesheet['total_hours'];
//        d($timesheet['total_hours']);
        $total_decr = str_replace(" m", "", $timesheet['total_hours']);
        $total_decr = str_replace(" h ", ".", $total_decr);
        $tot_exp = explode(".", $total_decr);
        $totHR = $tot_exp[0] + (round(abs($tot_exp[1] / 60), 2));
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
//        d("Early " . $minuteEarly . "Late " . $minuteLate);
        $LEDepa = $minuteEarly + $minuteLate;
        if ($timesheet['status'] == 0) {
            $m_tot_hr_p = $m_tot_hr_p + $totHR;
            $m_ot_p = $m_ot_p + $OTtime;
            $m_la_depat_p = $m_la_depat_p + $LEDepa;
        } else {
            $m_tot_hr_a = $m_tot_hr_a + $totHR;
            $m_ot_a = $m_ot_a + $OTtime;
            $m_la_depat_a = $m_la_depat_a + $LEDepa;
        }
        $Details[$i] = $data;
        $i++;
    }
}
//d($Details);
//d(convert_hours($m_tot_hr_p));
//die;
$fields_data = array();
if (!empty($isuserhavingshift)) {
    $flag = "true";
    $fields = array();
    $fields['status'] = "1";
    $fields_data['is_shift'] = $flag;
    $fields_data['timesheet_data'] = $Details;
    $fields_data['total_hour_approve'] = convert_hours($m_tot_hr_a);
    $fields_data['total_hour_pending'] = convert_hours($m_tot_hr_p);
    $fields_data['overtime_approve'] = $m_ot_a;
    $fields_data['overtime_pending'] = $m_ot_p;
    $fields_data['late_early_dept_approve'] = $m_la_depat_a;
    $fields_data['late_early_dept_pending'] = $m_la_depat_p;
    $fields['message'] = "Timesheet data existing";
    $fields['data'] = $fields_data;
    echo _api_response($fields);
} else {
    $fields = array();
    $fields['status'] = "0";
    $fields_data['is_shift'] = $flag;
    $fields_data['timesheet_data'] = array();
    $fields['message'] = "Timesheet data not existing";
    $fields['data'] = $fields_data;
    echo _api_response($fields);
}

function convert_hours($value) {
    $times = explode(".", $value);
    $t = $times[0] . " h " . (round(abs($times[1] * 0.60), 0)) . " m";
    return $t;
}

die;
?>