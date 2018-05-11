<?php

$new = new persian_date();
if (isset($_REQUEST['date_convert'])) {
    $a = $new->persian_to_gregorian($_REQUEST['pyear'], $_REQUEST['pmonth'], $_REQUEST['pdate']);
    echo $a[0] . "-" . $a[1] . "-" . $a[2];
    die;
}
if (isset($_REQUEST['gregorian_to_jalali'])) {
    $gego_date = explode("-", $_REQUEST['date']);
    $a = $new->gregorian_to_jalali($gego_date[0], $gego_date[1], $gego_date[2]);
    echo json_encode($a);
    die();
}
if ($_REQUEST['saveDetail'] == 1) {
    parse_str($_REQUEST['data'], $arr);
    $field = array();
    $field['leave_date'] = $arr['englishDate'];
    $field['persian_date'] = $arr['pyear'] . "-" . $arr['pmonth'] . "-" . $arr['pdate'];
    $field['reason'] = $arr['englishReason'];
    $field['farsi_reason'] = $arr['farsiReason'];
    $field['level'] = $arr['level'];
    if ($arr['editLeave'] == 0) {
        qi('timesheet_leave', _escapeArray($field));
    } else {
        qu('timesheet_leave', _escapeArray($field), "id=" . $arr['editLeave']);
    }
    $leaveDetail = q("Select * from  timesheet_leave order by leave_date");
    include _PATH . 'instance/front/tpl/calendar_deatil.php';
    die;
}
if ($_REQUEST['DeleteDetail'] == 1) {
    qd('timesheet_leave', "id=" . $_REQUEST['data']);
    $leaveDetail = q("Select * from  timesheet_leave order by leave_date");
    include _PATH . 'instance/front/tpl/calendar_deatil.php';
    die;
}

$leaveDetail = q("Select * from  timesheet_leave order by leave_date");
$date = date("Y-m-d");
$gego_date = explode("-", date("Y-m-d"));
$jala_date = $new->gregorian_to_jalali($gego_date[0], $gego_date[1], $gego_date[2]);

$jsInclude = 'calendar.js.php';
_cg("page_title", "Persian Date Picker");
?>