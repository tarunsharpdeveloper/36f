<?php
if (!isset($_SESSION['user'])) {
    _R('login');
}



$UserId=$_SESSION['user']['id'];
$ProfileData = qs("select * from tb_employee where id='$UserId'");


_cg("page_title", "Profile");

            