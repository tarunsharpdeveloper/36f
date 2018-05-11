<?php

$no_visible_elements = 1;
$sign_up_error = '';
global $office;

if ($_REQUEST['email'] != '' && $_REQUEST['password'] != '') {
    $password = md5(trim(_escape($_REQUEST['password'])));
    $email = (trim(_escape($_REQUEST['email'])));
    $user_data = qs("SELECT * FROM tb_employee WHERE email='{$email}' ");
//    d($email);
//    d($user_data);
//    d($_FILES);
//    die();

    if (!empty($user_data)) {
        $_SESSION['user'] = $user_data;
        $sign_up_error = 1;
    } else {

        $doc_file_name = array();
        foreach ($_FILES as $key_param => $each_param) {
            if ($key_param == 'doc_signed_contract') {
                foreach ($_FILES[$key_param]["name"] as $file_key => $each_file) {
                    if ($_FILES[$key_param]["name"][$file_key] == "")
                        continue;
                    $target_dir = _PATH . "docs/\profile_images/";
                    $file_name = time() . "_" . basename($_FILES[$key_param]["name"][$file_key]);
                    $target_file = $target_dir . $file_name;
                    $uploadOk = 1;
                    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                    if (file_exists($target_file)) {
                        $file_name = rand(1000, 9999) . "_" . time() . "_" . basename($_FILES[$key_param]["name"][$file_key]);
                        $target_file = $target_dir . $file_name;
                    }
//$doc_file_name[$key_param] = $file_name;
                    $doc_signed_contract_file_name .= "||GLUE||" . $file_name;
                    if (!move_uploaded_file($_FILES[$key_param]["tmp_name"][$file_key], $target_file)) {
                        $error = 1;
                        $err_msg .= "there was an error uploading " . $_FILES[$key_param]["name"][$file_key] . " file.<br>";
                    }
                }
            } else {
                if ($_FILES[$key_param]["name"] == "")
                    continue;
                $target_dir = _PATH . "docs/\profile_images/";
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
//        d($target_file);
//        d($doc_file_name);
//        die;
//    d($_REQUEST['hid_tested_at']);
//    die;

        $fields = array();
        $fields['fname'] = $_REQUEST['firstname'];
        $fields['lname'] = $_REQUEST['lastname'];
        $fields['email'] = $_REQUEST['email'];
        $fields['password'] = md5($_REQUEST['password']);
        $fields['mobile'] = $_REQUEST['mobile'];
        $fields['kiosk_pin'] = $_REQUEST['k_pin'];
        $fields['dob'] = date('Y-m-d', strtotime($_REQUEST['dob']));
        $fields['em_contact_name'] = $_REQUEST['e_c_name'];
        $fields['em_phone'] = $_REQUEST['e_c_phone'];
//        $fields['geneder'] = $_REQUEST[''];
        $fields['photo'] = $doc_file_name['emp_img'];
        $st = qi("tb_employee", $fields);
        if (!empty($st)) {
            _R('login');
        } else {
            $sign_up_error = 1;
        }
    }
}
//
//if (isset($_REQUEST['bindOffice'])) {
//
//    $d_id = $_REQUEST['id'];
//    $st1 = q("SELECT * FROM tb_office ORDER BY name  ASC");
////    d($st1);
//    echo json_encode($st1);
//    die;
////    die();
//}
//if (!isset($_SESSION['lang'])) {
//    $_SESSION['lang'] = language::getLanguageText($_SESSION['selected_lang']);
//}
$jsInclude = 'sign_up.js.php';
_cg("page_title", "sign_up");
