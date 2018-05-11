<?php

/**
 * shift Class
 * 
 * Class to shift related functions
 * 
 * @author Hardik Panchal 
 * @version 1.0
 * @package Whozoor
 * 
 */
class employee {

    public function __construct() {
        
    }

# returns the max check in tolerance in minutes

    public static function get_check_in_tolerance($employee_id) {
        $data = qs("select * from tb_employee_settings  where emp_id = '{$employee_id}' ");
        return empty($data) ? 0 : $data['time_limit_time_stamp_abandon'];
    }

    public static function getCompanyIdFromShiftId($shift_id) {
        $shift_data = qs("select user_id from tb_shift_time where id = '{$shift_id}' ");
        if (empty($shift_data)) {
            return "0";
        }
        $employee_id = $shift_data['user_id'];
        $employee_data = employee::getEmployeeData($employee_id);
        return isset($employee_data['work_at']) ? $employee_data['work_at'] : 0;
    }

    public static function getEmployeeData($employee_id) {
        $employee_data = qs("select * from tb_employee where id = '{$employee_id}' ");
        if (empty($employee_data)) {
            return array();
        }
        return $employee_data;
    }

    public static function getEmployeeDataByPhone($mobile) {
        $employee_data = qs("select * from tb_employee where mobile = '{$mobile}' ");
        if (empty($employee_data)) {
            return array();
        }
        return $employee_data;
    }

    public static function getEmployeeTeamName($employee_id) {
        $employee_data = employee::getEmployeeData($employee_id);
        $name = qs("select * from tb_team where id = '{$employee_data['team_id']}' ");
        return empty($name) ? "" : $name['name'];
    }

    public static function getEmployeeLocationName($employee_id) {
        $employee_data = employee::getEmployeeData($employee_id);
        $name = qs("select * from tb_location where id = '{$employee_data['location']}' ");
        return empty($name) ? "" : $name['name'];
    }

    public static function getEmployeeCompanyName($employee_id) {
        $employee_data = employee::getEmployeeData($employee_id);
        $name = qs("select * from tb_company_works where id = '{$employee_data['work_at']}' ");
        return empty($name) ? "" : $name['name'];
    }

    public static function getTeamEmployeesIds($companyId, $teamId) {
        $employeeIdsList = array();
        $employeeIds = q("SELECT id FROM tb_employee WHERE work_at = '{$companyId}' AND team_id = '{$teamId}'");
        if (!empty($employeeIds)) {
            foreach ($employeeIds as $eachId):
                $employeeIdsList[] = $eachId['id'];
            endforeach;
        }
        return $employeeIdsList;
    }

    public function matchPassword($user_id, $password) {
        if ($password == '') {
            return false;
        }
        $password = md5($password);
        $data = qs("select id from tb_employee where id = '{$user_id}' and password = '{$password}' ");
        return empty($data) ? false : true;
    }

    public static function resetTokenForDevice($device_token, $user_id) {

        qu('tb_user_devices_log', array(
            'logout_date' => date('Y-m-d H:i:s'),
            'token_status' => 'INVALID',
            'extra_notes' => 'RESET_TOKEN'
                ), " token_status = 'VALID' and user_id = '{$user_id}'    ");
    }

    public static function generateToken() {
        return md5(random_string());
    }

}
