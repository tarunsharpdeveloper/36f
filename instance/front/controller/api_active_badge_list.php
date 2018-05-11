<?php

$user_id = _e($_REQUEST['user_id'], 0);

if (!$user_id) {
    $fields = array();
    $fields['status'] = '0';
    $fields['message'] = 'INVALID_USER_ID';
    _api_response($fields);
}

$fields = array();
$fields['status'] = '1';

$status = array();
$status['name'] = "test notification 1";
$status['message'] = "Message 1";
$status['type'] = "timeoff";
$status['status'] = "APPROVED";
$status['date'] = _get_day_persian(date("Y-m-d"));

$status_1 = array();
$status_1['name'] = "test notification 2";
$status_1['message'] = "Message 2";
$status_1['status'] = "REJECTED";
$status_1['type'] = "errand";
$status_1['date'] = _get_day_persian(date("Y-m-d"));

$status_2 = array();
$status_2['name'] = "test notification 3";
$status_2['message'] = "Message 3";
$status_2['type'] = "schedule";
$status_2['status'] = "0";
$status_2['date'] = _get_day_persian(date("Y-m-d"));

$fields['data'] = array($status, $status_1, $status_2);

_api_response($fields);

