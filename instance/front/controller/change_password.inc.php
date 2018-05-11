<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}
if (isset($_REQUEST['save'])) {
//    _errors_on();
    $ID = $_SESSION['user']['id'];
    $_fields1['password'] = md5($_REQUEST['psw']);
//    d($ID);
//    die();
    $updated = qu("tb_users", $_fields1, "id='$ID'");
    if (!empty($updated)) {
        $success = '1';
        $msg = "Password Was Updated";
    } else {
        $success = '-1';
        $msg = "Password Was Not Updated";
    }
//    _R("change_password");
}
$jsInclude = 'change_password.js.php';
_cg("page_title", "Change Password");
