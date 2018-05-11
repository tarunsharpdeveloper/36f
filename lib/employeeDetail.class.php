<?php

class employeeDetail {

    public function __construct() {
        
    }

    public static function GetEmployeeNameAndEmail($emp_id) {
        $res = qs("SELECT fname,lname,email,work_at FROM tb_employee WHERE id = '{$emp_id}'");
        $res['full_name'] = $res["fname"] . " " . $res["lname"];
        return $res;
    }
    
    public static function getAdminIdFromCopmanyId($companyId){ 
        $adminId = '';
        $res = qs("SELECT id FROM tb_employee WHERE access_level = 'Admin' AND work_at = '{$companyId}' ORDER BY id DESC LIMIT 0,1"); 
        if(!empty($res)){
           $adminId = $res['id'];    
        }
        return $adminId;    
    }

    public static function GetEmployeePerDayWorkingHours($emp_id, $leaveType = 'DEFAULT_DAILY_KARKAARD') {
        
        if($leaveType == 'Day Off (With Payment)'){
            $leaveType = 'DAY_OFF_WITH_PAYMENT';
        } else if($leaveType == 'Time Off (Without Payment)'){
            $leaveType = 'TIMEOFF_WITHOUT_PAYMENT';
        } else if($leaveType == 'Sick Time'){
            $leaveType = 'SICK_TIME';
        } else if($leaveType == 'Job Abandonment'){
            $leaveType = 'JOB_ABNDONMENT';
        } else if($leaveType == 'Illness (Extended)'){
            $leaveType = 'ILLNESS_EXTENDED';
        }
        
        $leaveTypeArr = array('TIMEOFF_WITHOUT_PAYMENT', 'SICK_TIME', 'JOB_ABNDONMENT', 'DAY_OFF_WITH_PAYMENT', 'ILLNESS_EXTENDED');

        $totalDailyHours = 440;
        $companyIdArr = qs("SELECT work_at FROM tb_employee WHERE id = '{$emp_id}'");
        if (!empty($companyIdArr)) {
            $companyIdVal = $companyIdArr["work_at"];
            if ($companyIdVal > 0) {
                $companyLeaveDetail = qs("SELECT value_1,value_2,value_3,value_4,value_5,value_6 FROM settings_leave_master WHERE company_id = '{$companyIdVal}' AND short_code = 'DEFAULT_DAILY_KARKAARD' ORDER BY id ASC LIMIT 0,1");
                if (!empty($companyLeaveDetail)) {
                    $workingHours = $companyLeaveDetail["value_1"];
                }

                // Working Hours value update if any special leave type and its have custom value
                if (in_array($leaveType, $leaveTypeArr)) {
                    $companySpecialLeaveDetail = qs("SELECT value_1,value_2,value_3,value_4,value_5,value_6 FROM settings_leave_master WHERE company_id = '{$companyIdVal}' AND short_code = '{$leaveType}' ORDER BY id ASC LIMIT 0,1");
                    if (!empty($companySpecialLeaveDetail)) {
                        if ($companySpecialLeaveDetail['value_1'] == 'CUSTOM') {
                            if (trim($companySpecialLeaveDetail["value_2"]) != '') {
                                $workingHours = trim($companySpecialLeaveDetail["value_2"]);
                            }
                        }
                    }
                }



                if ($workingHours != '' && $workingHours != '00:00') {
                    if (is_numeric($workingHours)) {
                        $totalDailyHours = $workingHours;
                    } else {
                        $totalDailyHours = convertHourMinuteToMinuteFormat($workingHours);
                    }
                }
            }
        }
        if (!is_numeric($totalDailyHours) || $totalDailyHours == '' || $totalDailyHours == '0') {
            $totalDailyHours = 440;
        }
        return $totalDailyHours;
    }
    
    public static function getCompanyNameFromCopmanyId($companyId){ 
        $companyName = '';
        $res = qs("SELECT name FROM tb_company_works WHERE id = '{$companyId}' ORDER BY id DESC LIMIT 0,1"); 
        if(!empty($res)){
           $companyName = $res['name'];     
        }
        return $companyName;     
    }

}

?>
