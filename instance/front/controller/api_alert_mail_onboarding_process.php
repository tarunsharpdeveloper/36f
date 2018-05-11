<?php


$res = q("SELECT * FROM tb_onboarding_lost_data ORDER BY id ASC");
if (count($res) > 0) {
    foreach ($res as $eachRes):
        $date1 = date_create(date('Y-m-d', strtotime($eachRes["modified_at"])));
        $date2 = date_create(date('Y-m-d'));
        $diff = date_diff($date1, $date2);
        $total_diff_days = 0;
        $total_diff_days = $diff->days;
        if ($total_diff_days == 3 || $total_diff_days == 7) {
            $getEmployeeDetail = array();
            $getEmployeeDetail = qs("SELECT id,fname,lname,email FROM tb_employee WHERE id = '{$eachRes["employee_id"]}'");
            if (!empty($getEmployeeDetail)) {
                $empEmail = "";
                $empEmail = $getEmployeeDetail['email'];
                if ($empEmail != '') {
                    $firstName = $getEmployeeDetail['fname'];
                    $lastName = $getEmployeeDetail['lname'];
                    $empId = $getEmployeeDetail['id'];
                    $sendemail = _escape($empEmail);
                    $subject = "Complete your Onboarding process into WHOzoor";
                    ob_start();
                    include _PATH . 'instance/front/tpl/mail_onboarding_complete_process_alert.php';
                    $contentAlert = ob_get_contents();
                    ob_end_clean();
                    _mail($sendemail, $subject, $contentAlert);
                    echo $sendemail . " difference days = " . $total_diff_days;
                    echo "\n";
                    echo "Alert mail of complete onboarding process is sent into " . $sendemail;
                    echo "\n\n";
                }
            }
        } else if ($total_diff_days > 10) {
            $deleteRec = qd("tb_onboarding_lost_data", "id='{$eachRes["id"]}'");
        }
    endforeach;
}

$emailSendTest = "jay.patel110188@gmail.com";
$subjectTest = "Cron Testing Email";
$testContentTest = "Test Content " . date("Y-m-d H:i:s");
_mail($emailSendTest, $subjectTest, $testContentTest);  

die;
?>