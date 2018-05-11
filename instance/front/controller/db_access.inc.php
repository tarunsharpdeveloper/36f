<?php

//d(!isset($_SESSION['user']));
//die;
if (!isset($_SESSION['user'])) {
    _R('login');
}


$jsInclude = 'db_access.js.php';
_cg("page_title", "DB");


