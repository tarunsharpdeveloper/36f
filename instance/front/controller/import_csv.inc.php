<?php

if (isset($_REQUEST['submit'])) {

    $target_dir = _PATH . "instance/front/media/import_csv/";
    $target_file = $target_dir . time() . "_" . basename($_FILES["fileToUpload"]["name"]);

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $csv_file = array();
        $csv_file['file_name'] = time() . "_" . basename($_FILES["fileToUpload"]["name"]);
        $csv_file_id = qi("export_csv", _escapeArray($csv_file));
        $string = "import_csv_data?id=" . $csv_file_id;
        _R(lr($string));
    }
}

$no_visible_elements = 1;
_cg("page_title", "Import CSV");
?>