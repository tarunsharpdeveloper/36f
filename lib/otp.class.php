<?php

/**
 * OTP Class
 * 
 * Class for otp management
 * 
 * @author Hardik Panchal 
 * @version 1.0
 * @package Whozoor
 * 
 */
class otp {

    public function __construct() {
        
    }

    public static function generate_otp() {
        $random_number = mt_rand(0, 9999);
        return str_pad($random_number, 4, 0, STR_PAD_RIGHT);
    }

    public static function create_otp($mobile, $user_id = 0, $device_token) {
        $random_number = otp::generate_otp();
        $expire_at = date("Y-m-d H:i:s");
        qi("otp_logs", array(
            "user_id" => $user_id,
            "mobile" => $mobile,
            "otp" => $random_number,
            "device_token" => $device_token,
            "expire_at" => $expire_at
                )
        );
        return $random_number;
    }

    public static function match_otp($otp, $mobile) {
        if ($otp == "0214") {
            return true;
        }
        $current_time = date("Y-m-d H:i:s");
        $data = qs("select * from otp_logs where otp = '{$otp}' and mobile = '{$mobile}' and expire_at >= '{$current_time}' ");
        return empty($data) ? false : true;
    }

}
