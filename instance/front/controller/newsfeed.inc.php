<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}
$success = "";
$btnclick = "2";
if (isset($_REQUEST['deleteposts'])) {
    $tbposts_id = $_REQUEST['posts'];

    $sub_records = q("select id from tb_comments where post_id='$tbposts_id'");
    if (!empty($sub_records)) {
        foreach ($sub_records as $tbcomments) {
            qd("tb_comments", "id='{$tbcomments['id']}'");
        }
    }
    $st = qd("tb_post", "id='$tbposts_id'");
//    d($st);
//    die();

    if (!empty($st)) {
        $success = "1";
        $msg = "Record's are deleted successful";
    } else {
        $success = "0";
        $msg = "Record's are not deleted successful";
    }
    include _PATH . 'instance/front/tpl/newsfeed_data.php';
    die;
}
if (isset($_REQUEST['deletecomments'])) {
    $tbcomment_id = $_REQUEST['tbcommentid'];
    $st = qd("tb_comments", "id='$tbcomment_id'");
    if (!empty($st)) {
        $success = "1";
        $msg = "Record deleted successful";
    } else {
        $success = "0";
        $msg = "Record not deleted successful";
    }
    include _PATH . 'instance/front/tpl/newsfeed_data.php';
    die;
}
if (isset($_REQUEST['clicktobtnview'])) {
    $btnclick = $_REQUEST['btn'];
    include _PATH . 'instance/front/tpl/newsfeed_data.php';
    die;
}
if (isset($_REQUEST['SaveSubComment'])) {
//    d($_REQUEST);
//    die;
    $_fields['post_id'] = $_REQUEST['postid'];
    $_fields['comment_id'] = $_REQUEST['id'];
    $_fields['comment'] = _escape($_REQUEST['comments']);
    $_fields['work_at'] = $_SESSION['company']['id'];

    $st = qi("tb_comments", $_fields);
    if (!empty($st)) {
        $success = "1";
        $msg = "Post Added!";
    } else {
        $success = "0";
        $msg = "Post Not Added!";
    }
    include _PATH . 'instance/front/tpl/newsfeed_data.php';
    die;
}
if (isset($_REQUEST['divCommentsPost'])) {
//    d($_REQUEST);
//    die;
    include _PATH . 'instance/front/tpl/newsfeed_data.php';
    die;
}
if (isset($_REQUEST['save_post'])) {
//    d($_REQUEST);
//    die;
    foreach ($_FILES as $key_param => $each_param) {

        if (isset($_FILES[$key_param]["name"])) {

            if ($_FILES[$key_param]["name"] == "")
                continue;
            $target_dir = _PATH . "docs/images/post_images/";
            $file_name = time() . "_" . basename($_FILES[$key_param]["name"]);
            $target_file = $target_dir . $file_name;
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

            if (file_exists($target_file)) {
                $file_name = rand(1000, 9999) . "_" . time() . "_" . basename($_FILES[$key_param]["name"]);
                $target_file = $target_dir . $file_name;
            }
            $doc_file_name[$key_param] = $file_name;
            if (!move_uploaded_file($_FILES[$key_param]["tmp_name"], $target_file)) {
                $error = 1;
                $err_msg .= "there was an error uploading " . $_FILES[$key_param]["name"] . " file.<br>";
            }
        }
    }


    $emplist = "";
    $boolemp = "0";
    foreach ($_REQUEST['selectedEMP'] as $emps) {
        if ($emps == "*") {
            $boolemp = "1";
        }
    }

    if ($boolemp == 1) {
//        d($boolemp);
        $listemp = q("select * from tb_employee");
//        foreach ($listemp as $EMP) {

        $_fields['create_post_id'] = $_SESSION['user']['id'];
        $_fields['share_id'] = "*";

        $_fields['message'] = _escape($_REQUEST['message']);
        $_fields['image'] = $file_name;
        $_fields['work_at'] = $_SESSION['company']['id'];


        qi("tb_post", $_fields);
//        
//        $emplist .= "" . $EMP . "-";
//        }
    } else {
        foreach ($_REQUEST['selectedEMP'] as $EMP) {

            $_fields['create_post_id'] = $_SESSION['user']['id'];
            $_fields['share_id'] = $EMP;
            $_fields['work_at'] = $_SESSION['company']['id'];
            $_fields['message'] = _escape($_REQUEST['message']);
            $_fields['image'] = $file_name;



            qi("tb_post", $_fields);
//        
//        $emplist .= "" . $EMP . "-";
        }
    }
    $btnclick = "2";

//    include _PATH . 'instance/front/tpl/newsfeed_data.php';
//    die;
//    foreach ($_REQUEST['selectedEMP'] as $EMP) {
//
//        $_fields['create_post_id'] = $_SESSION['user']['id'];
//        $_fields['share_id'] = $EMP;
//
//        $_fields['message'] = $_REQUEST['message'];
//        $_fields['image'] = $file_name;
//
//
//
////        qi("tb_post", $_fields);
////        
////        $emplist .= "" . $EMP . "-";
//    }
//    $emplist = trim($emplist, "-");
    _R('newsfeed');
}

if (isset($_REQUEST['save_comment'])) {

    $_fields['post_id'] = $_REQUEST['post_id'];
    $_fields['comment_id'] = $_SESSION['user']['id'];
    $_fields['comment'] = _escape($_REQUEST['comment']);

    qi("tb_comments", $_fields);
    _R('newsfeed');
}


//$PostResult = q("select tp.* , te.fname , te.lname , te.email , te.id as userid from tb_post tp, tb_employee te  where tp.create_post_id=te.id;");
$emplist = q("select * from tb_employee ".helper::onlyOfficeid());
$jsInclude = 'newsfeed.js.php';
_cg("page_title", "News Feed");

