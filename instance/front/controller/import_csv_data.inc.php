<?php

$id = _escape($_REQUEST['id']);
$file_query = qs("select * from export_csv where id='{$id}'");
$file_name = $file_query['file_name'];

$file_path = _PATH . "instance/front/media/import_csv/" . $file_name;
$file = fopen($file_path, "r");
$file_content = fgetcsv($file);
fclose($file);

$no_visible_elements = 1;
?>