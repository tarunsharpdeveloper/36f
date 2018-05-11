<?php

/* Values received via ajax */
//$start = date($start);


$id = $_REQUEST['id'];
$title = $_REQUEST['title'];
$start = $_REQUEST['start'];
//d($start);
//d($end);
//die;
if ($_REQUEST['end'] == "Invalid date" || $_REQUEST['end'] == "" || $_REQUEST['end'] == NULL) {
    $end = date('Y-m-d H:m:s', strtotime($start . ' +1 day'));
} else {
    $end = $_REQUEST['end'];
}

$fields = array();
$fields['title'] = $title;
$fields['start'] = $start;
$fields['end'] = $end;
//$fields['url'] = $url;
qu("evenement", $fields, "id='$id'");
echo json_encode(1);
die();
?>