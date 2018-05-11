<?php

class Notifications {

    public function __construct() {
        
    }

    public static function GetEmployeeNotifications($emp_id) {
        $res = q("SELECT * FROM tb_notifications WHERE emp_id = '{$emp_id}' AND is_user_view = 0 ORDER BY id DESC");
        $newArray = array();
        foreach ($res as $value) {
            $newArray[] = $value;
        }
        return $newArray;
    }

    public static function GetEmployeeNotificationsCount($emp_id) {
        $res = qs("SELECT count(id) as total FROM tb_notifications WHERE emp_id = '{$emp_id}' AND is_user_view = 0 ");
        return $res['total'];
    }

    public function changeNotificationStatus($id) {
        $field['is_user_view'] = '1';
        $condition = "id =" . $id;
        qu('tb_notifications', $field, $condition);
        //$res = q("SELECT * FROM tb_notifications WHERE emp_id = '{$emp_id}' AND is_user_view = 0 ORDER BY id DESC limit 0,9");
        return TRUE;
    }

    public static function _check_radius_at_checkout($user_id, $lat, $lng, $shift_id = 0) {
        $locationData = qs("SELECT location FROM tb_employee WHERE id = '{$user_id}'");
        $locationId = $locationData['location'];
        $locationDetail = qs("SELECT latlng FROM tb_location WHERE id = '{$locationId}'");
        $locationDetailLatlngArr = array();
        $locationLatVal = '';
        $locationLngVal = '';
        $distanceVal = 0;
        if ($locationDetail['latlng'] != '') {
            $locationDetailLatlngArr = explode(",", $locationDetail['latlng']);
        }
        if (count($locationDetailLatlngArr) > 1) {
            $locationLatVal = str_replace('(', '', $locationDetailLatlngArr[0]);
            $locationLngVal = str_replace(')', '', $locationDetailLatlngArr[1]);
            $distanceVal = distance($lat, $lng, $locationLatVal, $locationLngVal, 'M');
        }
        return $distanceVal;
    }

    public static function employee_late_arrival($user_id, $date, $time) {
        $startDate = date("Y-m-d", strtotime($date));
        $endDate = date("Y-m-d", strtotime($date . ' +1 day'));
        $userShift = q("SELECT id,start_date,start_time,end_date,end_time 
                           FROM tb_assign_shift 
                           WHERE DATE(start_date) = '{$date}' OR DATE(end_date) = '{$date}' 
                           AND user_id='{$user_id}'
                        ");

        foreach ($userShift as $value) {
            $comapareDate = date("Y-m-d H:i:s", strtotime($startDate . " " . $time));
            $shiftStartDate = date("Y-m-d H:i:s", strtotime($value['start_date'] . " " . $value['start_time']));
            $shiftEndDate = date("Y-m-d H:i:s", strtotime($value['end_date'] . " " . $value['end_time']));
            if (strtotime($comapareDate) >= strtotime($shiftStartDate) && strtotime($comapareDate) <= strtotime($shiftEndDate)) {
                $first = new DateTime($shiftStartDate);
                $second = new DateTime($comapareDate);
                $diff = $first->diff($second);
                $minutes = ($diff->h * 60) + $diff->i;
                if ($diff->invert == 0 && $minutes >= 60) {
                    $totalTime = $diff->h . ":" . $diff->i . ":" . $diff->s;
                    $timeMessage = "";
                    if ($diff->h > 0) {
                        $timeMessage .= " " . $diff->h . " hour";
                        if ($diff->h > 1) {
                            $timeMessage .= "s";
                        }
                    }
                    if ($timeMessage != '') {
                        $timeMessage .= ' and ';
                    }
                    if ($diff->i > 0) {
                        $timeMessage .= " " . $diff->i . " minute";
                        if (intval($diff->i) > 1) {
                            $timeMessage .= "s";
                        }
                    }
                    $eachEmployee = qs("SELECT id,fname,lname,email,DATE(dob) as dob,work_at,team_id
                                            FROM tb_employee 
                                            WHERE id={$user_id}");
                    $adminId = 0;
                    if (intval($eachEmployee['work_at']) > 0 && $adminId == 0) {
                        $adminId = employeeDetail::getAdminIdFromCopmanyId($eachEmployee['work_at']);
                    }
                    $notifyField = array();
                    $notifyField['emp_id'] = $adminId;
                    $notifyField['company_id'] = _e($eachEmployee['work_at'], 0);
                    $notifyField['type_add_edit'] = 'add';
                    $notifyField['module_name'] = 'assign shift';
                    $notifyField['module_rec_id'] = $user_id;
                    $notifyField['display_text'] = $eachEmployee["fname"] . " " . $eachEmployee["lname"] . " came late " . $timeMessage;
                    $notifyField['add_edit_by_userid'] = _e($user_id, 0);
                    qi('tb_notifications', _escapeArray($notifyField));
                }
            }
        }
        return 1;
    }

    public static function employee_early_departure($user_id, $date, $time) {
        $startDate = date("Y-m-d", strtotime($date));
        $endDate = date("Y-m-d", strtotime($date . ' +1 day'));
        $userShift = q("SELECT id,start_date,start_time,end_date,end_time 
                           FROM tb_assign_shift 
                           WHERE DATE(start_date) = '{$date}' OR DATE(end_date) = '{$date}' 
                           AND user_id='{$user_id}'
                        ");

        foreach ($userShift as $value) {
            $comapareDate = date("Y-m-d H:i:s", strtotime($startDate . " " . $time));
            $shiftStartDate = date("Y-m-d H:i:s", strtotime($value['start_date'] . " " . $value['start_time']));
            $shiftEndDate = date("Y-m-d H:i:s", strtotime($value['end_date'] . " " . $value['end_time']));

            if (strtotime($comapareDate) >= strtotime($shiftStartDate) && strtotime($comapareDate) <= strtotime($shiftEndDate)) {
                $second = new DateTime($shiftEndDate);
                $first = new DateTime($comapareDate);
                $diff = $first->diff($second);
                $minutes = ($diff->h * 60) + $diff->i;
                if ($diff->invert == 0 && $minutes >= 60) {
                    $totalTime = $diff->h . ":" . $diff->i . ":" . $diff->s;
                    $timeMessage = "";
                    if ($diff->h > 0) {
                        $timeMessage .= " " . $diff->h . " hour";
                        if ($diff->h > 1) {
                            $timeMessage .= "s";
                        }
                    }
                    if ($timeMessage != '') {
                        $timeMessage .= ' and ';
                    }
                    if ($diff->i > 0) {
                        $timeMessage .= " " . $diff->i . " minute";
                        if (intval($diff->i) > 1) {
                            $timeMessage .= "s";
                        }
                    }
                    $eachEmployee = qs("SELECT id,fname,lname,email,DATE(dob) as dob,work_at,team_id
                                            FROM tb_employee 
                                            WHERE id={$user_id}");
                    $adminId = 0;
                    if (intval($eachEmployee['work_at']) > 0 && $adminId == 0) {
                        $adminId = employeeDetail::getAdminIdFromCopmanyId($eachEmployee['work_at']);
                    }
                    $notifyField = array();
                    $notifyField['emp_id'] = $adminId;
                    $notifyField['company_id'] = _e($eachEmployee['work_at'], 0);
                    $notifyField['type_add_edit'] = 'add';
                    $notifyField['module_name'] = 'assign shift';
                    $notifyField['module_rec_id'] = $user_id;
                    $notifyField['display_text'] = $eachEmployee["fname"] . " " . $eachEmployee["lname"] . " early leave " . $timeMessage;
                    $notifyField['add_edit_by_userid'] = _e($user_id, 0);
                    qi('tb_notifications', _escapeArray($notifyField));
                }
            }
        }
        return 1;
    }

}

?>
