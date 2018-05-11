<?php

$apiAsana = new authAsana();
$note.= _t("289", "Reference Number") . ": A" .$_REQUEST['ticket_id'] . "\n";
if (trim($cname) != '') {
    $note.= _t("32", "Name") . ": " . trim($cname) . "\n";
}
if (trim($phone) != '') {
    $note.= _t("13", "Cell Number") . ": " . trim($phone) . "\n";
}
if (trim($email) != '') {
    $note.= _t("14", "E-Mail") . ": " . trim($email) . "\n";
}
$note .= "\n" . trim($desc);
$department_cond = implode("','", $chk_dept);
if($department_cond==''){
    $department_cond = 'OTH';
}
$department_cond = "'" . $department_cond . "'";
$data = qs("SELECT group_concat(asana_id) as asana_depts FROM `tb_departments` where code IN ({$department_cond}) group by 'all'");
$token_data = qs("select * from tb_asana_token");
$token = $token_data['access_token'];
$authorization_code = $token_data['authorization_code'];


if ($hidTaskId != '') {
    if($_REQUEST['rd_caller_tone']=='angry'){
        $data = array("data" => array("workspace" => ASN_WORKSPACE, "notes" => $note, "tags" => ASN_TG_ANGRY));        
    }else{
        $data = array("data" => array("workspace" => ASN_WORKSPACE, "notes" => $note));        
    }
    $data1 = $apiAsana->UpdateTask($hidTaskId, $token, $data);
} else {
    $tags = array("0" => ASN_TG_INFO, "2" => ASN_TG_DIVERT, "4" => ASN_TG_DIVERT, "6" => ASN_TG_REGU, "8" => ASN_TG_HIGH, "10" => ASN_TG_CALL);
    $tags_to_add = $tags[$rd_prio];
    $project_to_add = $data['asana_depts'];
    if($_REQUEST['rd_caller_tone']=='angry'){
        if($rd_prio<4){
            $tags_to_add = ASN_TG_ANGRY;
            $data_add = qs("SELECT group_concat(asana_id) as asana_depts FROM `tb_departments` where code IN ('B') group by 'all'");
            $project_to_add = $data_add['asana_depts'];
        } else{
            $tags_to_add .= ",".ASN_TG_ANGRY;
        }
    }
    $data = array("data" => array("workspace" => ASN_WORKSPACE, "name" => $subj, "notes" => $note, "projects" => $project_to_add, "tags" => $tags_to_add));
    $data1 = $apiAsana->CreateTask($token, $data);
}
$data2 = json_decode($data1, true);

if (!isset($data2['data']['id'])) {
    if (isset($data2['errors'][0]['message']) && stripos($data2['errors'][0]['message'], "expired") !== FALSE) {
        $new_token = $apiAsana->refreshToken($authorization_code);
        if (isset($new_token['access_token'])) {
            $token = $new_token['access_token'];
            if ($hidTaskId != '') {
                $data1 = $apiAsana->UpdateTask($hidTaskId, $token, $data);
            } else {
                $data1 = $apiAsana->CreateTask($token, $data);
            }
            $data2 = json_decode($data1, true);
            if (!isset($data2['data']['id'])) {
                writeLog($data1);
                $error = 1;
                $_SESSION['success'] = '-1';
                $_SESSION['msg'] = "Ticket can't be generated. Something being wrong!";
            } else {
                $taskId = $data2['data']['id'];
            }
        } else {
            writeLog($new_token);
            $error = 1;
            $_SESSION['success'] = '-1';
            $_SESSION['msg'] = "Ticket can't be generated. Something being wrong!";
        }
    } else {
        writeLog($data1);
        $error = 1;
        $_SESSION['success'] = '-1';
        $_SESSION['msg'] = "Ticket can't be generated. Please try again.";
    }
} else {
    $taskId = $data2['data']['id'];
}
?>