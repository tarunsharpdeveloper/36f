<?php
//d($_REQUEST);
//die;
$title = $_REQUEST['title'];
$start = $_REQUEST['start'];
$end = $_REQUEST['end'];
$url = $_REQUEST['url'];
// connection to the database
$fields = array();
$fields['title'] = $title;
$fields['start'] = $start;
$fields['end'] = $end;
$fields['url'] = $url;
//$q->execute(array(':title' => $title, ':start' => $start, ':end' => $end, ':url' => $url));
qi("evenement", $fields);
echo json_encode(1);
die;
?>