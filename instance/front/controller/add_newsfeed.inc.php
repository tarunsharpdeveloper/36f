<?php
if (!isset($_SESSION['user'])) {
    _R('login');
}


if (isset($_REQUEST['save_post'])) {
   
    foreach ($_FILES as $key_param => $each_param) {
        
        if(isset($_FILES[$key_param]["name"])){
            
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
    
   $_fields['create_post_id'] = $_REQUEST['create_post_id'];
   $_fields['share_id'] = $_REQUEST['share_id'];
   $_fields['message'] =  $_REQUEST['message'];
   $_fields['image'] =  $file_name;
   
   
   
   qi("tb_post", $_fields);
   _R('newsfeed');
}

//$jsInclude = 'new_timesheet.js.php';
_cg("page_title", "Add NewsFeed");


            