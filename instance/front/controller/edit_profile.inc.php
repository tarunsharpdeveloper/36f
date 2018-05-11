<?php
if (!isset($_SESSION['user'])) {
    _R('login');
}
if (isset($_REQUEST['update_employee'])) {
   
    foreach ($_FILES as $key_param => $each_param) {
        
        if(isset($_FILES[$key_param]["name"])){
            
            if ($_FILES[$key_param]["name"] == "")
        
                continue;
            $target_dir = _PATH . "docs/profile_images/";
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
    
   $_fields['fname'] = $_REQUEST['firstname'];
   $_fields['lname'] = $_REQUEST['lastname'];
   $_fields['email'] =  $_REQUEST['email'];
   $_fields['mobile'] = $_REQUEST['mobile'];
   $_fields['kiosk_pin'] = $_REQUEST['k_pin'];
   $_fields['dob'] =  date('Y-m-d', strtotime($_REQUEST['d_o_b']));
   $_fields['em_contact_name'] = $_REQUEST['e_c_name'];
   $_fields['em_phone'] = $_REQUEST['e_c_phone'];
   $_fields['gender'] =  $_REQUEST['gender'];
   
   if(isset($file_name)){
       $_fields['photo'] =  $file_name;
   }
   
   
   $UserId=$_SESSION['user']['id'];
   $up_time = qu("tb_employee", $_fields, "id = '{$UserId}'");
   //qi("tb_employee", $_fields);
   _R('profile');
}
$UserId=$_SESSION['user']['id'];
$ProfileData = qs("select * from tb_employee where id='$UserId'");

$jsInclude = 'edit_profile.js.php';
_cg("page_title", "Edit Profile");

            