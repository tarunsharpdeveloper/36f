<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}

if (isset($_REQUEST['update_designated']) && $_REQUEST['update_designated'] == 1) {
  
    foreach ($_REQUEST['id'] as $reqKey => $eachReq):
        $field = array();
        $field['designated_approver'] = $_REQUEST['empVal'][$reqKey];
        $condition = 'id=' . $eachReq;
        qu('tb_employee', _escapeArray($field), $condition);
    endforeach;
    
}

$companyId = $_SESSION['user']['work_at'];
include 'api_designated_approver.php';  

$designatedApproverList = q("SELECT id,access_level,team_id FROM tb_employee 
                              WHERE work_at = '{$companyId}' 
                               AND (LOWER(access_level) = 'admin' OR LOWER(access_level) = 'supervisor' OR LOWER(access_level) = 'manager')");
$jsInclude = 'designated_approver.js.php';
_cg("page_title", "Designated Approver");
?>