<?php

$a = "Test";




ob_start();
include _PATH . 'instance/front/tpl/_cron_daily_report.php';
$mail = ob_get_contents();
ob_end_clean();

print $mail;

$subject = "Whozoor App - Daily Report - " . date("d/m");
$sendMailAddress = _escape($data['testaccts001@gmail.com']);
//_mail($sendMailAddress, $subject, $mail);

die;
?>
