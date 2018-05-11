<?php

$id = $_REQUEST['id'];
$status = $_REQUEST['status'];
$is_exist = qs("SELECT id FROM tb_shift_time WHERE id='{$id}'");

if (!empty($is_exist)) {
    $field = array();
    $field['status'] = $status;
    $condition = 'id=' . $id;
    qu('tb_shift_time', $field, $condition);
    $fields = array();
    $fields['result'] = "success";
    echo json_encode($fields);
    exit;
} else {
    $fields = array();
    $fields['result'] = "error";
    echo json_encode($fields);
    exit;
}

