<?php


if (isset($_REQUEST['v_note_p'])) {

    foreach ($_REQUEST['v_note_p'] as $lang_id => $value) {
        $s1 = qu("language", _escapeArray(array('lang_persian' => $value)), " id = '{$lang_id}' ");
    }
    foreach ($_REQUEST['v_note_e'] as $lang_id => $value) {
        $s2 = qu("language", _escapeArray(array('lang_english' => $value)), " id = '{$lang_id}' ");
    }
    if (!empty($s1) || !empty($s2)) {


        $success = '1';
        $msg = "Record Translate successfully";
    } else {
        $success = '-1';
        $msg = "Record can not Translate. please try again.";
    }
}

$start = 0;
$limit = 10;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $start = ($id - 1) * $limit;
} else {
    $id = 1;
}
if (empty($_REQUEST['con_search'])) {
    $query = q("select * from language LIMIT $start, $limit");
    $row = qs("select count(id)as Total from language");
} else {
    $lets = $_REQUEST['con_search'];
    $query = q("select * from language WHERE lang_english LIKE '%{$lets}%' or lang_persian LIKE '%{$lets}%'");
    $row = qs("select count(id)as Total from language WHERE lang_english LIKE '%{$lets}%' or lang_persian LIKE '%{$lets}%' ");
}
$jsInclude = 'language.js.php';
_cg("page_title", "language");
