<?php
if (!isset($_SESSION['user'])) {
    _R('login');
}

$PostID = $_GET['id'];
if(isset($PostID)){
    
    $PostResultComment = q("select te.fname,te.lname,te.email,tp.* from tb_post tp, tb_employee te  where tp.create_post_id=te.id AND tp.id='$PostID'");
    
    $PostResultSubComment = q("select te.id as userid ,te.fname,te.lname,te.email,tc.comment,tc.created_at ,tp.id from tb_comments tc, tb_post tp , tb_employee te  where tc.post_id = tp.id and te.id = tc.comment_id And tc.post_id='$PostID' order by tc.id asc");
    
}


if (isset($_REQUEST['save_comment'])) {
    
   $_fields['post_id'] = $_REQUEST['post_id'];
   $_fields['comment_id'] = $_SESSION['user']['id'];
   $_fields['comment'] =  $_REQUEST['comment'];
   
   qi("tb_comments", $_fields);
   _R('post_comment?id='.$_REQUEST['post_id']);
}



_cg("page_title", "News Feed");

            