<?php

_cg('token_state', 'INVALID_TOKEN');
_cg('token_message', 'dear user, seems as someone has logged in with your creds, if this is in error, contact your HR immediately');


$public_apis = array();
$public_apis[] = 'api/help';
$public_apis[] = "api/login";
$public_apis[] = "api/login_s";
$public_apis[] = "api/logout";
$public_apis[] = "api/signup";
$public_apis[] = "api/forgot_password";
$public_apis[] = "api/create_password";
$public_apis[] = "api/user_exist";
$public_apis[] = "api/truncate";
$public_apis[] = "api/set_password";
$public_apis[] = "api/resend_otp";
$public_apis[] = "api/send_otp";
$public_apis[] = "api/validate_otp";
$public_apis[] = "api/add_test_data";
$public_apis[] = "api/proceed_leave";

if (!in_array($_REQUEST['q'], $public_apis)) {
    if (!$session_token) {
        apiSlack::pingSlack("TOKEN MISSING IN REQUEST");
        echo _api_response(array());
    }

    // create logic for the tokens
    // get the current token data 
    $user_logged_in_data = qs("select * from tb_user_devices_log where session_token = '{$session_token}' and token_status = 'VALID' ");

    if (!empty($user_logged_in_data)) {
        _cg('token_state', 'VALID_TOKEN');
        _cg('token_message', '');
    }
} else {
    _cg('token_state', 'VALID');
    _cg('token_message', '');
}
?>