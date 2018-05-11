<?php

$id = $_REQUEST['id'];
qd("evenement", "id='$id'");
echo json_encode(1);
die;
?>