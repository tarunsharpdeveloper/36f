<a href="mail:hardik.adroja510@gmail.com?subject=Subject You Selected<a href='//google.com'>test</a>">The text of your link</a>
<?php
error_reporting(E_ALL);
$to = "hardik.adroja510@gmail.com";
$subject = "Hi!";
$body = "Hi,\n\nHow are you?";
if (mail($to, $subject, $body)) {
    echo("<p>Email successfully sent!</p>");
} else {
    echo("<p>Email delivery failed…</p>");
}
die;
echo strtotime('02:00:00');
d(getTimeZoneTime('19:12'));
d(getTimeZoneDateTime('2017-12-20 19:12'));
die;

$q = "Select * FROM timesheet_summary WHERE emp_id = 23";
$rec = q($q);
foreach ($rec as $eachRec):
    d($eachRec);
    $insertRec = array();
    $insertRec['timesheet_id'] = $eachRec['id'];
    $insertRec['time_detail'] = 'Checkin';
    $insertRec['time'] = $eachRec['shift_start_time'];
    $insertRec['shiftdate'] = $eachRec['shift_date'];
//    qi("timesheet_summary_detail", $insertRec);
    d($insertRec);

    $insertRec = array();
    $insertRec['timesheet_id'] = $eachRec['id'];
    $insertRec['time_detail'] = 'Check Out';
    $insertRec['time'] = $eachRec['shift_end_time'];
    $insertRec['shiftdate'] = $eachRec['shift_date'];
//    qi("timesheet_summary_detail", $insertRec);
    d($insertRec);
endforeach;
die;

$fields = array();
$startDate = date("Y-10-01");
for ($i = 0; $i <= 30; $i++) {
    unset($fields);
    $fields['emp_id'] = '23';
    $fields['location_id'] = '10';
    $fields['work_location'] = '10';
    $fields['shift_date'] = date("Y-m-d", strtotime("+" . $i . " days", strtotime($startDate)));
    $fields['shift_start_time'] = "10:00";
    $fields['shift_end_time'] = '07:00';
    $fields['late_arrival'] = "00:00";
    $fields['early_dep'] = '00:00';
    $fields['daily_karkaard'] = '07:20';
    qi('timesheet_summary', $fields);
}
$no_visible_elements = true;

$bc = array();
_cg("page_title", "Page Not Found");
?>