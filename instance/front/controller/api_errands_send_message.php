<?php

$unique_id = _e($_REQUEST['unique_id'], 0);
$user_id = _e($_REQUEST['user_id'], 0);
$message = _e($_REQUEST['message'], '');

$errandData = qs("select * from  errands where unique_id = '{$unique_id}' ");

if (!$unique_id) {
    $fields['error'] = '1';
    $fields['msg'] = 'INVALID_UNIQUE_ID';
    _api_response($fields);
}
if (empty($errandData)) {
    $fields['error'] = '1';
    $fields['msg'] = 'NO_ERRANDS_FOUND_FOR_GIVEN_UNIQUE_ID';
    _api_response($fields);
}
if (!$user_id) {
    $fields['error'] = '1';
    $fields['msg'] = 'INVALID_USER_ID';
    _api_response($fields);
}
if (!$message) {
    $fields['error'] = '1';
    $fields['msg'] = 'INVALID_MESSAGE';
    _api_response($fields);
}



qu("errands", array('employee_comments' => $message), "  unique_id = '{$unique_id}' ");


$errandData = qs("select * from  errands where unique_id = '{$unique_id}' ");
if (!empty($errandData)) {
    qi('errands_comments', array(
        'comment_text' => $message,
        'user_type' => 'employee',
        'errand_id' => $errandData['id']
    ));
}


$fields['success'] = '1';
$fields['msg'] = 'ERRANDS_MESSAGE_SENT';
_api_response($fields);
?>

