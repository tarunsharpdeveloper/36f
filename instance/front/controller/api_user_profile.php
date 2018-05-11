<?php

//d($_REQUEST);
$emplist = "";
$flag = "false";
$empId = $_REQUEST['userid'];

$isuser = qs("select * from tb_employee where id='$empId'");


if (!empty($isuser)) {
    if(isset($isuser['dob']) && !empty($isuser['dob']) && $isuser['dob']!='0000-00-00 00:00:00'){
        $isuser['dob'] = gtj_datetime($isuser['dob']);
    }
    if(isset($isuser['terminate_date']) && !empty($isuser['terminate_date']) && $isuser['terminate_date']!='0000-00-00 00:00:00'){
        $isuser['terminate_date'] = gtj_datetime($isuser['terminate_date']);
    }
    if(isset($isuser['lastActiveTime']) && !empty($isuser['lastActiveTime']) && $isuser['lastActiveTime']!='0000-00-00 00:00:00'){
        $isuser['lastActiveTime'] = gtj_datetime($isuser['lastActiveTime']);
    }
    if(isset($isuser['created_at']) && !empty($isuser['created_at']) && $isuser['created_at']!='0000-00-00 00:00:00'){
        $isuser['created_at'] = gtj_datetime($isuser['created_at']);
    }
    if(isset($isuser['modified_at']) && !empty($isuser['modified_at']) && $isuser['modified_at']!='0000-00-00 00:00:00'){
        $isuser['modified_at'] = gtj_datetime($isuser['modified_at']);
    }
    $flag = "true";
    $fields = array();
    $fields['result'] = "success";
    $fields['is_user'] = $flag;
    $fields['profileData'] = $isuser;

    $fields['msg'] = "User profile existing";
    echo _api_response($fields);
} else {
    $fields = array();
    $fields['result'] = "error";
    $fields['is_user'] = $flag;
    $fields['profileData'] = "-1";
    $fields['msg'] = "User profile not existing";
    echo _api_response($fields);
}
die;
?>