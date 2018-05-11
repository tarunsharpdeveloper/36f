<?php

$ShiftId = _e($_REQUEST['shiftid'], 0);

if ($ShiftId == 0) {
    $user_id = _e($_REQUEST['user_id'], 0);
    $today = date("Y-m-d");
    $shift_id_data = qs(" select id from tb_shift_time where user_id = '{$user_id}' and date(sDate) = '{$today}'  ");
    if (!empty($shift_id_data)) {
        $ShiftId = $shift_id_data['id'];
    }
}


$message = $_REQUEST['msg'];
$isHavingShift = qs("SELECT * FROM tb_shift_time WHERE id='$ShiftId'  ORDER BY sDate DESC, `tb_shift_time`.`created_at` DESC LIMIT 1 ");
if (!empty($isHavingShift)) {
    $field = array();
    $field['checkout_summary_message'] = $message;
    $condition = 'id=' . $isHavingShift['id'];
    qu(tb_shift_time, $field, $condition);
    $fields = array();
    $fields['result'] = "success";
    $fields['msg'] = "Shift Checkout Summary Message Was Added";
    echo json_encode($fields);
} else {
    $fields = array();
    $fields['result'] = "error";
    $fields['msg'] = "Shift Checkout Summary Message Was Not Added";
    echo json_encode($fields);
}

die;
