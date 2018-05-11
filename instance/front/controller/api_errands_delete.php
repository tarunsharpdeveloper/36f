<?php

$currentDate = date('Y-m-d');
if (isset($_REQUEST['unique_id'])) {
    $unique_id = trim($_REQUEST['unique_id']);
}

$status = "Delete";

if (!$unique_id || !$status) {
    $fields['success'] = '0';
    $fields['msg'] = 'INVALID ID OR STATUS';
    echo _api_response($fields);
    die;
}
//$errandId
$getErrandId = qs("SELECT id FROM errands WHERE unique_id = '{$unique_id}' ORDER BY id DESC LIMIT 0,1");

if (!empty($getErrandId)) {
    $errandId = $getErrandId["id"];
    $old_fields_data = qs("SELECT errands_type,
                                  subject,
                                  from_date_time,
                                  to_date_time,
                                  day_request_submitted,
                                  requested_by,
                                  starting_point,
                                  destination,
                                  overnight_compensation,
                                  food_authorization,
                                  transportation_method,
                                  lodging,
                                  expences,
                                  manager_comments,
                                  total_days,
                                  status,
                                  employee_id,
                                  company_id 
                             FROM errands 
                            WHERE id = '{$errandId}'");



    if ($currentDate >= date('Y-m-d', strtotime($old_fields_data['from_date_time']))) {
        unset($fields['error']);    
        $fields['success'] = '0';  
        $fields['msg'] = '.تغییر برای درخواست مورد نظر امکان پذیر نیست. در صورت نیاز با منابع انسانی سازمان تماس بگیرید';
        echo _api_response($fields);   
        die;   
    }

    $persianDate = new persian_date();
    $persianNumbers = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

    $comment = '';
    if (isset($_REQUEST['commnet']) && $_REQUEST['commnet'] != '') {
        $comment = $_REQUEST['commnet'];
    }
    $field['employee_comments'] = $comment;
    $field['status'] = $status;
    $condition = 'id=' . $errandId;

    qu('errands', _escapeArray($field), $condition);

    $data = qs("select * from errands where id = '{$errandId}' ");
    $errandData = $data;

    $adminId = 0;
    if ($errandData["company_id"] > 0) {
        $adminId = employeeDetail::getAdminIdFromCopmanyId($errandData["company_id"]);
    }

    $employeeInfo = array();
    $display_name = '';
    if ($errandData['employee_id'] > 0) {
        $employeeInfo = employeeDetail::GetEmployeeNameAndEmail($errandData['employee_id']);
        $display_name = $employeeInfo['full_name'];
    }

    $displayText = '<div style="text-align: left;">';
    $displayText .= $display_name . " requested a cancel for errand request </div>";

    /* Start Notification entry code */

    $notifyField = array();
    $notifyField['emp_id'] = $adminId;
    $notifyField['company_id'] = _e($errandData["company_id"], 0);
    $notifyField['type_add_edit'] = 'edit';
    $notifyField['module_name'] = 'errand';
    $notifyField['module_rec_id'] = $errandData['id'];
    $notifyField['display_text'] = $displayText;
    $notifyField['add_edit_by_userid'] = _e($errandData['employee_id'], 0);
    qi('tb_notifications', _escapeArray($notifyField));

    /* End Notification entry code */

    unset($update_fields);
    $update_fields = $errandData;
    unset($update_fields["id"]);
    unset($update_fields["created_at"]);
    unset($update_fields["modified_at"]);
    unset($update_fields["isEdited"]);
    unset($update_fields["add_by_manager"]);
    unset($update_fields["added_by_id"]);
    unset($update_fields["unique_id"]);

# Unique id
    $companyDetail = qs("SELECT * FROM `tb_company_works` where id='{$update_fields['company_id']}'");

    $unique_id = array();
    $unique_id[] = str_replace(" ", "_", $companyDetail['name']);
    $unique_id[] = str_replace(" ", "_", $display_name);
    $unique_id[] = strtotime($update_fields['from_date_time']);
    $unique_id[] = $update_fields['errands_type'];
    $unique_id[] = substr(md5(microtime()), rand(0, 26), 5);
    $unique_id = array_filter($unique_id);
    $unique_id = implode("_", $unique_id);
    $update_fields['unique_id'] = $unique_id;

    $update_fields['edit_id'] = $errandId;
    $update_fields['edited_by_user_type'] = 'manager';
    $update_fields['edited_by_id'] = $errandData['employee_id'];
    $update_fields['edited_field_text'] = json_encode($old_fields_data);
    qi('errands_edit_history', _escapeArray($update_fields));


    unset($fieldsComment);
    $fieldsComment['errand_id'] = $errandId;
    $fieldsComment['user_type'] = 'employee';
    $fieldsComment['comment_text'] = $comment;
    qi("errands_comments", $fieldsComment);


    $responseArr = array();
    $responseArr['success'] = '1';
    $responseArr['msg'] = 'DELETED SUCCESSFULLY';
} else {
    $responseArr = array();
    $responseArr['success'] = '0';
    $responseArr['msg'] = 'ERRAND ID NOT AVAILABLE';
}


echo _api_response($responseArr);
die;
?>