<?php

$id = $_REQUEST['id'];
$status = $_REQUEST['status'];
$is_exist = qs("SELECT id,user_id FROM tb_shift_time WHERE id='{$id}'");
if($status == "1") {
    $action = "approve";   
}
if($status == "2") {
    $action = "reject";   
}

if (!empty($is_exist)) {
    $field = array();
    $field['status'] = $status;
    $condition = 'id=' . $id;
    qu('tb_shift_time', $field, $condition);

    $fields['time_shift_id'] = $is_exist['id'];
    $fields['modified_by'] = $_SESSION['user']['id'];
    $fields['user_id'] = $is_exist['user_id'];
    //$fields['old_json'] = $old_val_json;
    //$fields['new_json'] = $new_val_json;
    //$fields['updated_fields'] = $updated_val_json;
    $fields['action'] = $action;
    
    qi("timesheet_log",$fields);

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

