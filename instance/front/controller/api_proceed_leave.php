<?php
return;
$currentDate = date('Y-m-d');
$currentTime = date('H:i:s');
$currentDateAndTime = date('Y-m-d H:i:s');

$checkLeave = qs("select * from timesheet_leave where leave_date='{$currentDate}' ");
if (!empty($checkLeave)) {
    die;
}

/* Logic for entire day */
$timeOffRequest = q("select * from tb_timeoff where status='Accept' AND absence_type = 'entireDay' AND processed_leave_date != '{$currentDate}' AND (processed_leave_status = 0 OR processed_leave_status = 1) ORDER BY id ASC");
foreach ($timeOffRequest as $eachTimeOffReq):
    $employeeId = $eachTimeOffReq['emp_id'];
    $dateStart = date_create($eachTimeOffReq['from_date']);
    $dateEnd = date_create($eachTimeOffReq['to_date']);
    $diffDays = date_diff($dateStart, $dateEnd);
    $total_days = ($diffDays->days + 1);
    $leaveType = $eachTimeOffReq['reason'];

    for ($i = 0; $i < $total_days; $i++) {
        $eachDate = date('Y-m-d', strtotime("+" . $i . " days", strtotime($eachTimeOffReq['from_date'])));
        if ($eachDate == $currentDate) {

            $leaveStartTime = "00:00:01";
            $checkShift = qs("SELECT * FROM tb_assign_shift WHERE user_id = '{$employeeId}' AND DATE(start_date) = '{$currentDate}' ORDER BY STR_TO_DATE(start_time, '%H:%i:%s') ASC LIMIT 0,1");
            if (!empty($checkShift)) {
                $leaveStartTime = $checkShift['start_time'];
            }

            $emp_id = $employeeId;
            $empWorkingHours = employeeDetail::GetEmployeePerDayWorkingHours($emp_id, $leaveType);


            if ($currentTime >= $leaveStartTime) {
                $eachDayTime = $empWorkingHours;
                $field = array();
                $valueLeave = qs("select * from employee_leave_balance where employee_id='{$employeeId}'");
                $field['leave_pending_balance'] = $valueLeave['leave_pending_balance'] - $eachDayTime;
                $field['proceed_leave'] = $valueLeave['proceed_leave'] + $eachDayTime;
                qu('employee_leave_balance', _escapeArray($field), "employee_id='{$employeeId}'");

                $timeOffFields = array();
                $timeOffFields['processed_leave_status'] = 1;
                if (date('Y-m-d', strtotime($eachTimeOffReq['to_date'])) == $currentDate) {
                    $timeOffFields['processed_leave_status'] = 2;
                }
                $timeOffFields['processed_leave_date'] = $currentDate;
                qu('tb_timeoff', _escapeArray($timeOffFields), "id='{$eachTimeOffReq["id"]}'");
            }
        }
    }
endforeach;


/* Logic for hourly */
$hourlyRequest = q("select * from tb_timeoff where status='Accept' AND absence_type = 'hourly' AND processed_leave_date != '{$currentDate}' AND (processed_leave_status = 0 OR processed_leave_status = 1) ORDER BY id ASC");
foreach ($hourlyRequest as $eachHourlyReq):

    if (date('Y-m-d', strtotime($eachHourlyReq["from_date"])) == $currentDate) {
        //$currentTime >= date('H:i:s',  strtotime($eachHourlyReq["from_date"]))
        $employeeId = $eachHourlyReq['emp_id'];
        $dateStart = date_create($eachHourlyReq['from_date']);
        $dateEnd = date_create($eachHourlyReq['to_date']);
        $diffDays = date_diff($dateStart, $dateEnd);
        $totalMinutes = ($diffDays->i + ($diffDays->h * 60));

        $field = array();
        $valueLeave = qs("select * from employee_leave_balance where employee_id='{$employeeId}'");
        $field['leave_pending_balance'] = $valueLeave['leave_pending_balance'] - $totalMinutes;
        $field['proceed_leave'] = $valueLeave['proceed_leave'] + $totalMinutes;
        qu('employee_leave_balance', _escapeArray($field), "employee_id='{$employeeId}'");

        $timeOffFields = array();
        $timeOffFields['processed_leave_status'] = 2;
        $timeOffFields['processed_leave_date'] = $currentDate;
        qu('tb_timeoff', _escapeArray($timeOffFields), "id='{$eachHourlyReq["id"]}'");
    }
endforeach;
die;
