<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}

$jsInclude = 'getlocation.js.php';
_cg("page_title", "Add People");

