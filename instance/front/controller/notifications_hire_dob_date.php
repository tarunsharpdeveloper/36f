<?php
$persianDate = new persian_date();
$persianNumbers = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
$tomorrowDateVal = date('Y-m-d', strtotime("+1 day"));
$tomorrowMonth = date('m', strtotime($tomorrowDateVal));
$tomorrowDate = date('d', strtotime($tomorrowDateVal));

$employeeList = q("SELECT id,fname,lname,email,DATE(dob) as dob,work_at,team_id,DATE(hired_on) as hired_on
                     FROM tb_employee 
                 ORDER BY id ASC");
foreach ($employeeList as $eachEmployee):
    $dobMonth = '';
    $dobDate = '';
    $display_name = '';
    $adminId = 0;
    if ($eachEmployee['dob'] != '' && $eachEmployee['dob'] != '0000-00-00') {
        $dobMonth = date('m', strtotime($eachEmployee['dob']));
        $dobDate = date('d', strtotime($eachEmployee['dob']));

        if ($tomorrowMonth == $dobMonth && $tomorrowDate == $dobDate) {
            if (intval($eachEmployee['work_at']) > 0) {
                $adminId = employeeDetail::getAdminIdFromCopmanyId($eachEmployee['work_at']);
            }
            $display_name = $eachEmployee["fname"] . " " . $eachEmployee["lname"];
            /*
            $persianDateTextArr = array();
            $dobYear = date("Y", strtotime($tomorrowDateVal));
            $dobMonth = date("m", strtotime($tomorrowDateVal));
            $dobDay = date("d", strtotime($tomorrowDateVal));   
            $persianDateTextArr = $persianDate->gregorian_to_jalali($dobYear, $dobMonth, $dobDay);
            */
            $persianMonthName = '';
            $persianDayName = '';
            $persianMonthName = $persianDate->to_date($tomorrowDateVal,'M');
            $persianDayName = $persianDate->to_date($tomorrowDateVal,'d');
            $persianNoDate = '';
            $persianNumbers1 = substr($persianDayName, 0, 1);
            $persianNumbers2 = substr($persianDayName, 1, 1);
            if($persianNumbers1 != ''){
                $persianNoDate.=$persianNumbers[$persianNumbers1];
            }
            if($persianNumbers2 != ''){
                $persianNoDate.=$persianNumbers[$persianNumbers2];
            }  
            
            $notifyField = array();
            $notifyField['emp_id'] = $adminId;
            $notifyField['company_id'] = _e($eachEmployee['work_at'], 0);
            $notifyField['type_add_edit'] = 'add';
            $notifyField['module_name'] = 'employee birth day';
            $notifyField['module_rec_id'] = $eachEmployee["id"]; 
            $notifyField['display_text'] = '<div><div style="float:left;width:auto;height:1px;">'.$display_name . ' have a birth day at tomorrow, </div><div style="float:left;margin-left:6px;"><div style="float:left;">' .$persianMonthName.'</div><div style="float:right;margin-left:6px;">'.$persianNoDate.'</div><div class="clearfix"></div></div><div class="clearfix"></div></div>';   
            $notifyField['add_edit_by_userid'] = _e($eachEmployee["id"], 0);
            qi('tb_notifications', _escapeArray($notifyField));
        }
    }



    $hiredMonth = '';
    $hiredDate = '';
    if ($eachEmployee['hired_on'] != '' && $eachEmployee['hired_on'] != '0000-00-00') {
        $hiredMonth = date('m', strtotime($eachEmployee['hired_on']));
        $hiredDate = date('d', strtotime($eachEmployee['hired_on']));

        if ($tomorrowMonth == $hiredMonth && $tomorrowDate == $hiredDate) {
            if (intval($eachEmployee['work_at']) > 0 && $adminId == 0) {
                $adminId = employeeDetail::getAdminIdFromCopmanyId($eachEmployee['work_at']);
            }
            $display_name = $eachEmployee["fname"] . " " . $eachEmployee["lname"];
            $persianMonthName = '';
            $persianDayName = '';
            $persianMonthName = $persianDate->to_date($tomorrowDateVal,'M');
            $persianDayName = $persianDate->to_date($tomorrowDateVal,'d');
            $persianNoDate = '';
            $persianNumbers1 = substr($persianDayName, 0, 1);
            $persianNumbers2 = substr($persianDayName, 1, 1);
            if($persianNumbers1 != ''){
                $persianNoDate.=$persianNumbers[$persianNumbers1];
            }
            if($persianNumbers2 != ''){
                $persianNoDate.=$persianNumbers[$persianNumbers2];
            }
            $notifyField = array();
            $notifyField['emp_id'] = $adminId;
            $notifyField['company_id'] = _e($eachEmployee['work_at'], 0);
            $notifyField['type_add_edit'] = 'add';
            $notifyField['module_name'] = 'employee hired anniversary day';
            $notifyField['module_rec_id'] = $eachEmployee["id"];
            //$notifyField['display_text'] = $display_name . ' have a hired anniversary day at tomorrow, ' . $persianDateTextArr[0]."-".$persianDateTextArr[1]."-".$persianDateTextArr[2]; 
            //$notifyField['display_text'] = $display_name . ' have a hired anniversary day at tomorrow, ' .$persianMonthName." ".$persianNoDate;
            $notifyField['display_text'] = '<div><div style="float:left;width:auto;height:1px;">'.$display_name . ' have a hired anniversary day at tomorrow, </div><div style="float:left;margin-left:6px;"><div style="float:left;">' .$persianMonthName.'</div><div style="float:right;margin-left:6px;">'.$persianNoDate.'</div><div class="clearfix"></div></div><div class="clearfix"></div></div>';
            $notifyField['add_edit_by_userid'] = _e($eachEmployee["id"], 0);
            qi('tb_notifications', _escapeArray($notifyField)); 
        }
    }
endforeach;
die;
?>

