<?php

if ($_REQUEST['getNotification'] == 1) {
    foreach ($_REQUEST['id'] as $value) {
        Notifications::changeNotificationStatus($value);
    }
    echo Notifications::GetEmployeeNotificationsCount($_SESSION['user']['id']);
    die;
}


if (isset($_REQUEST['setShowNotification']) && $_REQUEST['setShowNotification'] == 1) {
    $emp_id = $_REQUEST["userId"];
    $fields = array();
    $fields["is_user_view"] = 1;
    qu("tb_notifications", $fields, " emp_id = '{$emp_id}' AND is_user_view = 0 ");
    $res['success'] = 1;
    json_die(1, $res);
    die;
}
?>
