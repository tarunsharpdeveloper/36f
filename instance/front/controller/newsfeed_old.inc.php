<?php
if (!isset($_SESSION['user'])) {
    _R('login');
}


$PostResult = q("select tp.* , te.fname , te.lname , te.email , te.id as userid from tb_post tp, tb_employee te  where tp.create_post_id=te.id;");
$jsInclude = 'newsfeed_old.js.php';
_cg("page_title", "News Feed");

            