<?php

// List of events
$json = array();

// Query that retrieves events
//$requete = "SELECT * FROM evenement ORDER BY id";
$Result = q("SELECT id,title,start, end,url,allDay FROM evenement ORDER BY id");

//d($Result);
//die;
// sending the encoded result to success page
echo json_encode($Result);
die;
?>