<?php

if (!isset($_SESSION['user'])) {
//if (!isset($_SESSION['user']) || !in_array('Cs-Agent', $_SESSION['user']['roles'])) {
    _R('login');
}

$complaints[] = array("code" => "TRIP", "key" => "151", "name" => "Complaint/inquiry about trip", "user_type" => "0");
$complaints[] = array("code" => "DRIVER", "key" => "149", "name" => "Complaint/inquiry about Driver", "user_type" => "0");
$complaints[] = array("code" => "CAR", "key" => "150", "name" => "Complaint/inquiry about Car", "user_type" => "0");
$complaints[] = array("code" => "COST", "key" => "153", "name" => "Complaint/inquiry about Cost", "user_type" => "0");
$complaints[] = array("code" => "APP", "key" => "152", "name" => "About App", "user_type" => "0");
$complaints[] = array("code" => "OTH", "key" => "122", "name" => "Other", "user_type" => "0");

$complaints[] = array("code" => "RULE", "key" => "", "name" => "Rules", "user_type" => "2");
$complaints[] = array("code" => "COST", "key" => "153", "name" => "Complaint/inquiry about Cost", "user_type" => "2");
$complaints[] = array("code" => "TRIP", "key" => "151", "name" => "Complaint/inquiry about trip", "user_type" => "2");
$complaints[] = array("code" => "APP", "key" => "152", "name" => "About App", "user_type" => "2");
$complaints[] = array("code" => "OTH", "key" => "122", "name" => "Other", "user_type" => "2");

if (isset($_REQUEST['submit'])) {
   
    //$uname = $_REQUEST['uName']=='' OR $_REQUEST['uName']==null ?$_REQUEST['cName']:$_REQUEST['uName'];
    $unamecheck = $_REQUEST['uName'];
    if($unamecheck == "" OR $unamecheck == null OR $unamecheck==0){
        $uname = $_REQUEST['cName'];
    }else{
        $uname = $_REQUEST['uName'];
    }
    $cname = $_REQUEST['cName'];
    $phone = str_replace(array(" ", "(", ")", "-", "_"), "", $_REQUEST['phone']);
    $email = $_REQUEST['email'];
    $is_caller_other = $_REQUEST['rd_caller-other'];
    $caller_fname = $_REQUEST['caller_fName'];
    $caller_lname = $_REQUEST['caller_lName'];
    $caller_phone = str_replace(array(" ", "(", ")", "-", "_"), "", $_REQUEST['caller_phone']);
    $chk_dept = $_REQUEST['chk_dept'];
    $rd_prio = $_REQUEST['rd_prio'];
    $subj = $_REQUEST['subject'];
    $desc = $_REQUEST['description'];
    $hidTaskId = $_REQUEST['hidTaskId'];
    $error = 0;

    $taskId = '0';

    $fields = array();
    //$fields['fname'] = $fname;
    //$fields['lname'] = $lname;
    $fields['user_name'] = $uname;
    $fields['client_name'] = $cname;
    $fields['phone'] = $phone;
    $fields['email'] = $email;
    $fields['is_caller_other'] = $is_caller_other;
    $fields['caller_fname'] = $caller_fname;
    $fields['caller_lname'] = $caller_lname;
    $fields['caller_phone'] = $caller_phone;
    $fields['type_of_complaint'] = implode(",", $_REQUEST['rd_comp']);
    $fields['caller_tone'] = $_REQUEST['rd_caller_tone'];
    $fields['ticket_type'] = ((isset($_REQUEST['rd_ticket_type']) && $_REQUEST['rd_ticket_type'] == "1") ? "create ticket" : "save only");
    
    $fields['ticket_status'] = $_REQUEST['rd_status'];
    $fields['agent_feel_about_call'] = $_REQUEST['hidAgentFeelAboutCall'];
    $fields['subcategory_id'] = implode(",", $_REQUEST['rd_subcat']);
    $fields['priority'] = $_REQUEST['rd_prio'];
    $fields['department'] = implode(",", $chk_dept);
    $fields['subject'] = $subj;
    $fields['description'] = $desc;
    $fields['trip_id'] = $_REQUEST['hidTripId'];


    if ($_REQUEST['hidTicketId'] != '') {
        $_REQUEST['ticket_id'] = $_REQUEST['hidTicketId'];
        $fields['type_of_complaint'] = $_REQUEST['hidtype_of_complaint'];
        $fields['caller_tone'] = $_REQUEST['hidcaller_tone'];
        $fields['ticket_type'] = $_REQUEST['hidticket_type'];
        $fields['agent_feel_about_call'] = $_REQUEST['hidagent_feel_about_call'];
        $fields['subcategory_id'] = $_REQUEST['hidsubcategory_id'];
        $insert_id = qu("tb_ticket", _escapeArray($fields), "id='{$_REQUEST['hidTicketId']}'");
     
        /* START - Touch Note */
        $touch_log['key'] = $_REQUEST['ticket_id'];
        $touch_log['identifier'] = "ticket_id";
        $touch_log['user_id'] = $_SESSION['user']['id'];
        $touch_log['user_name'] = $_SESSION['user']['fname'] . ' ' . $_SESSION['user']['lname'];
        $touch_log['operation_type'] = "EDIT_TICKET";
        $touch_log['touch_note'] = "Ticket was updated.";
        $touch_log['time'] = date('Y-m-d H:i:s');
        qi("tb_activity_note", _escapeArray($touch_log));
        /* END - Touch Note */
    } else {
        /**  CS-Profile */
        $profile_id = '';
        if ($_REQUEST['hidOriginalPhone'] != '') {
            $profile_data = qs("select * from tb_cs_profile where cell='" . $_REQUEST['hidOriginalPhone'] . "'");
            if (empty($profile_data)) {
                $profile_data = array();
                $profile_data['user_type'] = $_REQUEST['hidUserType'];
                $profile_data['fname'] = $_REQUEST['hidOriginalFname'];
                $profile_data['lname'] = $_REQUEST['hidOriginalLname'];
                $profile_data['user_name'] = $uname;
                $profile_data['client_name'] = $cname;
                $profile_data['cell'] = $_REQUEST['hidOriginalPhone'];
                $profile_data['alternate_cell'] = $phone;
                $profile_data['email'] = $_REQUEST['hidOriginalEmail'];
                $profile_id = qi("tb_cs_profile", _escapeArray($profile_data));
            }
        } else {
            $profile_data = array();
            //$profile_data['fname'] = $fname;
            //$profile_data['lname'] = $lname;
            $profile_data['user_name'] = $uname;
            $profile_data['client_name'] = $cname;
            $profile_data['cell'] = $phone;
            $profile_data['email'] = $email;
            $profile_id = qi("tb_cs_profile", _escapeArray($profile_data));
        }
        /**  CS-Profile */
        if ($_REQUEST['rd_ticket_type'] != '1') {
            //$fields['ticket_status'] = 'OPEN';
            $fields['ticket_status'] = 'CLOSED';
        }
        $fields['task_id'] = "0";
        $fields['cs_profile_id'] = $profile_id;
        $fields['agent_id'] = $_SESSION['user']['id'];
        $fields['agent_name'] = $_SESSION['user']['fname'] . ' ' . $_SESSION['user']['lname'];
        $_REQUEST['ticket_id'] = $insert_id = qi("tb_ticket", _escapeArray($fields));
        if ($_REQUEST['rd_ticket_type'] == '1') {
            //Send SMS on creation of ticket, not when editing or closing
            if ($_REQUEST['rd_status'] != 'CLOSED') {
                sendSMS($phone, ' عزیز' . $lname . 'پیگیری شما در خصوص مورد اعلام شده ثبت گردید. کد پیگیری' . 'A' . $_REQUEST['ticket_id'] . ' تیم آبر');
            }
        }

        /* START - Touch Note */
        $touch_log['key'] = $_REQUEST['ticket_id'];
        $touch_log['identifier'] = "ticket_id";
        $touch_log['user_id'] = $_SESSION['user']['id'];
        $touch_log['user_name'] = $_SESSION['user']['fname'] . ' ' . $_SESSION['user']['lname'];
        $touch_log['operation_type'] = "ADD_TICKET";
        $touch_log['touch_note'] = "Ticket was created.";
        $touch_log['time'] = date('Y-m-d H:i:s');
        qi("tb_activity_note", _escapeArray($touch_log));
        /* END - Touch Note */
    }
    if ($insert_id > 0) {

        if ($_REQUEST['rd_ticket_type'] == '1') { //($rd_prio != 1 || $_REQUEST['rd_caller_tone'] == 'angry' )
            include _PATH . "instance/front/controller/asana_task.inc.php";
        }
        if ($error == 0) {
            qu("tb_ticket", array("task_id" => $taskId, "reference_number" => "A" . $_REQUEST['ticket_id']), "id='{$_REQUEST['ticket_id']}'");
            $_SESSION['success'] = '1';
            $msgs = _t('339', 'Ticket generated successfully');
            $_SESSION['msg'] = "'$msgs'. <br>Ref No: A" . $_REQUEST['ticket_id'];
            if ($_REQUEST['hidOriginalPhone'] != '')
                _R('cs-dashboard?phone=' . $_REQUEST['hidOriginalPhone']);
            else
                _R('cs-dashboard');
        }
    } else {
        $_SESSION['success'] = '-1';
        $_SESSION['msg'] = "Ticket can't be generated";
    }
}
if (isset($_REQUEST['Comments'])) {
    $comment = $_REQUEST['comment'];
    $ticket_id = $_REQUEST['ticket_id'];
    $get_comment = 0;
    $is_push = 0;
    $comment_id = '';
    include _PATH . "instance/front/controller/asana_comments.inc.php";
    
    $username = $_SESSION['user']['fname'].$_SESSION['user']['lname'];
    $fields = array();
    $fields['username'] =$username;
    $fields['ticket_id'] = $ticket_id;
    $fields['comment_id'] = $comment_id;
    $fields['comments'] = $comment;
    $fields['is_push'] = $is_push;
    $fields['is_api_comment'] = '1';
    qi("tb_ticket_comments", _escapeArray($fields));
    
    $success = '1';
    $msg = "Comment add successfully";
    echo json_encode(array("success" => $success, "msg" => $msg));
    die();
}
if (isset($_REQUEST['GetComments'])) {
    $ticket_id = $_REQUEST['ticket_id'];
    $get_comment = 1;
    include _PATH . "instance/front/controller/asana_comments.inc.php";
    
    $commentdata = q("select * from tb_ticket_comments where ticket_id = $ticket_id");
    
    
        


        $lastRe = '';
        if (empty($commentdata)) {
            $foo = new stdClass();
            $lastRe = '';
        } else {
            $a = '<div class="collapsible-header active"><div class="row" style="margin-top: 0px; margin-bottom: 0px;"><i class="fa fa-ticket prefix small"></i>&nbsp;<span style="font-weight:bold;font-size:16px; ">List Of Comment</span></div></div><br>';
            $b = '';
            $c = '';
            foreach ($commentdata as $row) {
                $b = '<div id="Comments_list_sub"><div style="border-bottom: 1px solid gray; margin-bottom: 10px; padding-bottom: 6px; " class="">'
                        . '<span style="color:#42A5F5;"><b>'.$row["username"] .'&nbsp;&nbsp;&nbsp;</b></span><span style="color: #222; "><b> Added a comment - &nbsp;'.$row["created_at"] .'</b></span>';
                
                
                $c = '</div><div class="col l6"><div class="col l8"><span class="help-spans">'.$row["comments"] .'</span></div><br><div style="clear:both;"></div></div></div>';

                $lastRe = $lastRe . $b . $c;
            }
        }

        $lastRe = $a . $lastRe;
        
        $foo = new stdClass();
        $foo->ReturnHtml = $lastRe;

        echo json_encode($foo);
    
    die();
}
if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    $msg = $_SESSION['msg'];
    unset($_SESSION['success']);
    unset($_SESSION['msg']);
}
if (isset($_REQUEST['fillTicketDetail'])) {
    $old_ticket = qs("select * from tb_ticket where id='{$_REQUEST['ticket_id']}' order by id desc limit 0,1");
    if (!empty($old_ticket)) {
        $old_ticket['found'] = '1';
    } else {
        $old_ticket = qs("select * from tb_ticket where trip_id='{$_REQUEST['trip_id']}' order by id desc limit 0,1");
        if (!empty($old_ticket)) {
            $old_ticket['found'] = '1';
        } else {
            $old_ticket['found'] = '0';
        }
    }

    echo json_encode($old_ticket);
    die;
}
$user_type = ((isset($_REQUEST['user_type']) && $_REQUEST['user_type'] != '') ? $_REQUEST['user_type'] : '0');

$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$email = $_REQUEST['email_add'];
$phone = ((strlen($_REQUEST['cell']) == 11 && substr($_REQUEST['cell'], 0, 2) == '09') ? (substr($_REQUEST['cell'], 2, 9)) : $_REQUEST['cell']);
$phone_org = $_REQUEST['cell'];

$profile_data = qs("select * from tb_cs_profile where cell='" . $phone_org . "'");
if (!empty($profile_data)) {
    $profile_id = $profile_data['id'];
    $cname = (trim($profile_data['client_name']) == "" ? ($fname . ' ' . $lname) : $profile_data['client_name']);
} else {
    $cname = trim($fname . ' ' . $lname);
}
$departments = q("select * from tb_departments");
$sub_category_prio = q("select * from tb_subcategories");

foreach ($sub_category_prio as $each_sub_cat) {
    $group_subcat[$each_sub_cat['comp_code']][] = $each_sub_cat;
}

$subsubcats = q("select sub_comp_code,comp_code from  tb_subcategories where sub_comp_code!= '' and user_type = '{$user_type}' group by sub_comp_code");

$jsInclude = "tickets.js.php";
_cg("current_page", "tickets");
_cg("page_title", "Tickets");


