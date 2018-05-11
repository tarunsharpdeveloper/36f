<?php
if (isset($_REQUEST['resetCountNotify'])) {
    $fields = array();
    $counts = qs("SELECT COUNT(id) as counted FROM tb_employee_log");
    $fields['lastCountNotify'] = $counts['counted'];
    $fields['notifyStatus'] = "1";
    qu("tb_employee", $fields, "id='{$_SESSION['user']['id']}'");
    $pass = "";
    echo json_encode($pass);
    die;
}
if (isset($_REQUEST['countNotification'])) {
    if ($_SESSION['user']['access_level'] == "manager" || $_SESSION['user']['access_level'] == "Location_Manager" || $_SESSION['user']['access_level'] == "Admin") {
//        $counts = qs("SELECT COUNT(id) as counted FROM tb_employee_log");
        $counts = qs("select COUNT(empl.id) as counted from tb_employee_log empl,tb_employee emp where emp.id=empl.emp_id and empl.company_id='{$_SESSION['user']['work_at']}' Order by empl.id DESC");
    } else {
        $counts = qs("select COUNT(empl.id) as counted from tb_employee_log empl,tb_employee emp where emp.id=empl.emp_id  and empl.company_id='{$_SESSION['user']['work_at']}' and Not empl.task_to=0 Order by empl.id DESC");
    }
    $emp = qs("select lastCountNotify,notifyStatus from tb_employee where id='{$_SESSION['user']['id']}'  ");
    $counted = $counts['counted'];
    $empCount = $emp['lastCountNotify'];
    $empStatus = $emp['notifyStatus'];
    if ($empStatus == "1") {
        if ($empCount < $counted) {
            $pass = $counted - $empCount;
            $fields = array();
//            $fields['lastCountNotify'] = $counts['counted'];
//            $fields['notifyStatus'] = "1";
//            qu("tb_employee", $fields, "id='{$_SESSION['user']['id']}'");
        } else {
            $pass = "";
        }
    } else {
        if ($empCount < $counted) {
            $pass = $counted - $empCount;
            $fields = array();
            $fields['lastCountNotify'] = $counts['counted'];
            $fields['notifyStatus'] = "0";
            qu("tb_employee", $fields, "id='{$_SESSION['user']['id']}'");
        } else {
            $pass = $counted;
        }
    }
    echo json_encode($pass);
    die;
}
if (isset($_REQUEST['addOnline'])) {
    $fields = array();
    $fields['lastActiveTime'] = date("Y-m-d H:i:s");
    qu("tb_employee", $fields, "id='{$_SESSION['user']['id']}'");
    die;
}
if (isset($_REQUEST['getOnline'])) {
    $dt = date("Y-m-d H:i:s", time() - 10);
    $online = q("select * from tb_employee where lastActiveTime >='$dt' and not id='{$_SESSION['user']['id']}' and work_at='{$_SESSION['user']['work_at']}'");
//    d(date("Y-m-d H:i:s a"));
//    d($dt);
//    d($online);
    if ($_SESSION['user']['access_level'] == "Admin" || $_SESSION['user']['access_level'] == "Admin") {
        $hedColor = "white";
        $btnColor = " btn-black";
    } else {
        $hedColor = "black";
        $btnColor = "btn-gray-alt";
    }
    $output = " <div class='divider-header' style='color:" . $hedColor . "'><b>ONLINE</b></div> <ul class='chat-box'>";
    foreach ($online as $list):
        if (empty($list['photo'])) {
            $image = 'user.jpg';
        } else {
            $image = $list['photo'];
        }
        $output .= "<li><div class = 'status-badge'>";
        $output .= " <img class='img-circle' width='40' src='docs/" . $image . "' alt='' style='min-width:40px'> ";
        $output .= "<div class = 'small-badge bg-green'></div></div>";
        $output .= "<b>" . $list['fname'] . ' ' . $list['lname'] . "</b>";
        $output .= "<p> " . $list['access_level'] . "</p>";
//        $output .= " <a href = '#' class = 'btn btn-md no-border radius-all-100 " . $btnColor . "' onclick='callModel(". $list['id'] . "," .$list['fname']. ")'><i class = 'glyph-icon icon-comments-o' style='font-size:18px;'></i></a>";
        $output .= " <a href = '#' class = 'btn btn-md no-border radius-all-100 " . $btnColor . "' onclick='callModel(" . $list['id'] . ")'><i class = 'glyph-icon icon-comments-o' style='font-size:18px;'></i></a>";
        $output .= "</li>";
    endforeach;
    $output .= "</ul>";
    echo json_encode($output);
    die;
}
if (isset($_REQUEST['getChatt'])) {
    $id = $_REQUEST['id'];
    $query = qs("select * from tb_employee where id='$id'");
    echo json_encode($query);
    die;
}
if (isset($_REQUEST['chatboxmsg'])) {
    $you = $_REQUEST['id']; //receiver_id
    $me = $_SESSION['user']['id']; //sender_id
    $chat = q("SELECT * FROM tb_chatting where (sender_id='$me' and receiver_id='$you') or (sender_id='$you' AND receiver_id='$me')");
    $content = "<ul class='chat-box' >";
    foreach ($chat as $data):
        if ($you == $data['sender_id']) {
            $side = "right";
            $float = "float-left";
        } else {
            $side = "left";
            $float = "";
        }
        $content .= "<li class='" . $float . "'><div class='chat-author'>";
        $content .= "<img width='36' src='assets-minified/dummy-images/gravatar.jpg' alt=''></div>";
        $content .= "<div class='popover " . $side . " no-shadow'>";
        $content .= "<div class='arrow'></div>";
        $content .= "<div class='popover-content'>" . $data['message'];
        $content .= "<div class='chat-time'><i class='glyph-icon icon-clock-o'></i>a few seconds ago</div></div></div></li>";
    endforeach;
    $output .= "</ul>";
    echo json_encode($content);
    die;
}
if (isset($_REQUEST['sendMessage'])) {
    $fields = array();
    $fields['receiver_id'] = $_REQUEST['rid'];
    $fields['message'] = _escape($_REQUEST['msg']);
    $fields['company_id'] = $_SESSION['user']['work_at'];
    $fields['sender_id'] = $_SESSION['user']['id'];
    $fields['msgDate'] = date("Y-m-d H:i:s");
    $st1 = qi("tb_chatting", $fields);
    if (!empty($st1)) {
        $success = "1";
    } else {
        $success = "0";
    }
    echo json_encode($success);
    die;
}
?>
<!--SELECT * FROM `tb_chatting` where (sender_id="43" and receiver_id="2") or (sender_id="2" AND receiver_id="43")-->