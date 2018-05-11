<?php

if (isset($_REQUEST['date_convert'])) {
    $new = new persian_date();
    $a = $new->persian_to_gregorian($_REQUEST['pyear'], $_REQUEST['pmonth'], $_REQUEST['pdate']);
    echo $a[0] . "/" . $a[1] . "/" . $a[2];
    die;
}
$gego_date = explode("-", date("Y-m-d"));
$jala_date = gregorian_to_jalali($gego_date[0], $gego_date[1], $gego_date[2]);

$jsInclude = 'test_date.js.php';
_cg("page_title", "Persian Date Picker");
?>