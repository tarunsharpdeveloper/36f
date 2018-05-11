<?php

/**
 * User Class
 * 
 * User login
 * 
 * @author Hardik Panchal 
 * @version 1.0
 * @package Whozoor
 * 
 */
class User {
    # constructor

    public static $user_data = array();

    public function __construct() {
        
    }

    /**
     *
     * @param array $fields
     * @param integer $id
     * @return boolean 
     */
    public static function update_driver_flage($id, $Flag) {

        $fields['driver_app_id_flag'] = $Flag;
        qu("tb_driver", $fields, "id = '" . $id . "'");
    }

    public static function update_driver_flage_api($id, $Status) {


        $body = array('driver_id' => $id, 'status' => $Status);

        $apiCore = new apiCore();
        $url = "http://91.232.66.67/Admin/api/UserNew/setDriverStatus";
        $data1 = $apiCore->doPostCall($url, $body);
    }

    public static function update($fields, $id) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();
        $map['admin_email'] = 'user_name';

        if ($fields['admin_password'] != '') {
            $data['admin_password'] = md5($data['admin_password']);
            $map['admin_password'] = 'password';
        }

        $ds = _bindArray($data, $map);
        $condition = " id = " . $id;
        return qu('admin_users', $ds, $condition);
    }

    /**
     *
     * @param array $fields
     * @param integer $id
     * @return boolean 
     */
    public static function updatePassword($password, $email) {
        // Escape array for sql hijacking prevention
        $data = _escapeArray($fields);
        $map = array();
        $data['admin_password'] = md5($password);
        $map['admin_password'] = 'password';
        $ds = _bindArray($data, $map);
        $condition = " user_name = '" . $email . "'";
        return qu('admin_users', $ds, $condition);
    }

    /**
     * Checks the login
     * @param String $user_name
     * @param String $password
     * @return boolean
     */
    public static function doLogin($user_name, $password) {
        $password = md5($password);
        self::$user_data = qs("select * from manifest_user where (user_name = '{$user_name}' OR email = '{$user_name}') and password = '{$password}'");
        if (!empty(self::$user_data)) {

            self::$user_data['user_type'] = 'manifest_user';
        } else {
            self::$user_data = qs("select * from role where (user_name = '{$user_name}' OR email = '{$user_name}') and password = '{$password}'");
            if (!empty(self::$user_data)) {
                self::$user_data['user_type_original'] = self::$user_data['user_type'];
                self::$user_data['user_type'] = 'role_user';
                self::$user_data['first_name'] = self::$user_data['user_name'];
            } else {
                self::$user_data = qs("select msu.*,mu.limo_acc_no,mu.company from manifest_sub_users msu join manifest_user mu on mu.id=msu.main_user_id where (msu.user_name = '{$user_name}' OR msu.email = '{$user_name}') and msu.password = '{$password}'");
                if (!empty(self::$user_data)) {
                    self::$user_data['user_type'] = 'manifest_user';
                    self::$user_data['isSubUser'] = '1';
                }
            }
        }

        return empty(self::$user_data) ? false : true;
    }

    /**
     * Direct the login
     * @param String $user_name
     * @param String $password
     * @return boolean
     */
    public static function doDirectQuoteLogin($user_name) {

        self::$user_data = qs("select * from role where (user_name = '{$user_name}' OR email = '{$user_name}')");
        if (!empty(self::$user_data)) {
            self::$user_data['user_type'] = 'role_user';
            self::$user_data['first_name'] = self::$user_data['user_name'];
        }

        return empty(self::$user_data) ? false : true;
    }

    /**
     * Checks the login
     * @param String $user_name
     * @param String $OTP
     * @return boolean
     */
    public static function OperatorCommonLogin($user_name, $OTP) {

        self::$user_data = qs("select * from role where (user_name = '{$user_name}' OR email = '{$user_name}') and otp_value = '{$OTP}'");
        if (!empty(self::$user_data)) {
            self::$user_data['user_type'] = 'role_user';
            self::$user_data['first_name'] = self::$user_data['user_name'];
        }

        return empty(self::$user_data) ? false : true;
    }

    /**
     * Checks the email
     * @param String $user_name
     * @return boolean
     */
    public static function ForgotPassword($user_name) {
        return qs(sprintf("select * from admin_users where user_name = '%s'", $user_name));
    }

    /**
     *
     * @param String $user_name
     */
    public static function setSession($user_name) {
        // d(self::$user_data);
        $_SESSION['user'] = self::$user_data;
    }

    /**
     *  Kill the session
     */
    public static function killSession() {
        //session destroy flag change
        $condition = "session_id='" . session_id()."'";
        $fields['message_flag'] = '1';
        $fields['flag'] = '1';
        qu('login_session_log', _escapeArray($fields), $condition);
        $cookieName = "user_previous_session_id";
        unset($_COOKIE[$cookieName]);
        setcookie($cookieName, '', time() - 3600);   
        session_destroy();
        unset($_SESSION);
    }

    function generate_password($length = 12, $special_chars = true) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        if ($special_chars)
            $chars .= '!@#$%^&*()';
        $password = '';
        for ($i = 0; $i < $length; $i++)
            $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        return $password;
    }

    public static function initUserSession($user_name) {
        self::$user_data = qs("select * from admin_users where user_name = '{$user_name}'");
        self::$user_data['user_type'] = 'admin';
        User::setSession($user_name);
        session_regenerate_id();
        $user_activity['session_id'] = session_id();
        $user_activity['user_id'] = $_SESSION['user']['id'];
        $user_activity['user_type'] = $_SESSION['user']['user_type'];
        User_activity::add($user_activity);
    }

    public static function getCurrentUserName() {
        $userName = $_SESSION['user']['user_name'];
        if ($_SESSION['user']['user_name'] == "admin@admin.com") {
            $userName = "Master Admin";
        }
        if ($_SESSION['user']['user_type'] == 'dispatchers') {
            $userName = "Dispatcher " . $_SESSION['user']['name'];
        }
        return $userName;
    }

    public static function GetManifestUserInfo($user_id) {
        return qs("SELECT * FROM manifest_user WHERE id = '{$user_id}'");
    }

}

?>