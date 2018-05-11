<?php

if (isset($_REQUEST['setLanguage'])) {
    if ((isset($_SESSION['selected_lang']) && $_SESSION['selected_lang'] != $_REQUEST['set_lang']) || (!isset($_SESSION['selected_lang']) && $_REQUEST['set_lang'] == 'fa')) {
        $is_change = '1';
    } else {
        $is_change = '0';
    }
    $_SESSION['selected_lang_dev'] = $_SESSION['selected_lang'] = isset($_REQUEST['set_lang']) ? $_REQUEST['set_lang'] : 'en';
    $_SESSION['lang'] = language::getLanguageText($_SESSION['selected_lang']);
//    d($_SESSION['lang']);
//    die();
    echo json_encode(array('is_change' => $is_change));
    die;
}
if (isset($_REQUEST['closeLanguageBar'])) {
    $_SESSION['selected_lang'] = isset($_SESSION['selected_lang']) ? $_SESSION['selected_lang'] : 'en';
    die;
}
?>