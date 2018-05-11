<?php

/*
 * Class file for asana api integration
 * http://developers.asana.com — here is all the info you need to review.
 *
 * api key: lbToJaK.0h1vux8YRG3p9DaKZcsmqLHB : Brilliant
 * 
 * Keys for Raj: ( Test Account )
 * public $key = "2Ba7cu7K.GHUSdSlRGgZFjOtAsXIS76a";
 * public $workspace = "9170437901315";
 * 
 */

class apiSlack {

    public function __construct() {
        
    }

    public static function doCurl($slack_channel_url, $data) {
        $ch = curl_init($slack_channel_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($ch);
        $errors = curl_error($ch);
        curl_close($ch);
    }

    public static function pingSlack($message) {
        if (_isLocalMachine()) {
            # Local Link
            $slack_channel_url = "https://hooks.slack.com/services/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";
        } else {
            # Live Link
            $slack_channel_url = "https://hooks.slack.com/services/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";
        }

        $extra_data = '';
        if (isset($_REQUEST['user_id'])) {
            $extra_data .= " \r\n USER ID: {$_REQUEST['user_id']}";
        }
        if (isset($_REQUEST['id'])) {
            $extra_data .= " \r\n USER ID: {$_REQUEST['id']}";
        }
        if (isset($_REQUEST['emp_id'])) {
            $extra_data .= " \r\n USER ID: {$_REQUEST['emp_id']}";
        }
        if (isset($_REQUEST['company_id'])) {
            $extra_data .= " \r\n COMPANY ID: {$_REQUEST['company_id']}";
        }
        if (isset($_REQUEST['mobile'])) {
            $extra_data .= " \r\n MOBILE: {$_REQUEST['mobile']}";
        }
        if (isset($_REQUEST['q'])) {
            $extra_data .= " \r\n API_URL: {$_REQUEST['q']}";
        }
        if (isset($_REQUEST['device_token'])) {
            $extra_data .= " \r\n DEVICE_TOKEN: {$_REQUEST['device_token']}";
        }
        $extra_data .= "\r\n Time: " . date("H:i:s");
        
        $message .=  $extra_data;

        $data = "payload=" . json_encode(array(
                    "text" => $message
        ));
        apiSlack::doCurl($slack_channel_url, $data);
    }

}

?>
