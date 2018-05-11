<?php
$data = shift::get_summary('3639');
d($data);
die;
_errors_on();

echo _tt('2018-03-10 22:00:00');
die; 

$year = '1396-12-12 22:00'; 
echo _j2g_full($year); 
die;  
$date = "۲۰۱۸-۰۳-۰۳ ۲۲:۰۰:۰۰";  
$date = _persianToDigits($date);
print $date;
die;  

$date = "2018-03-02 18:00:00";

$time = _ut($date,"G:i","t");
d($time);

die;
d(date("Y-m-d",strtotime("-36 days")));
die;
d(employee::getEmployeeCompanyName('300'));
die;
d(_s2p(600 * 60));
die;
d(shift::get_summary('2263'));
die;
$date = "۱۳۹۶-۱۱-۲۰";
$date = _persianToDigits($date);
print $date . "<Br>";
print _j2g_full("$date 10:00:00");

die;
d(shift::is_having_live_shift(11, '2018-01-23'));

die;
$data = shift::get_summary('1161');
d($data);

die;
$result = filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL);
var_dump($result);

die;
$pd = new persian_date();

d($pd->persian_day_names);
d($pd->persian_month_names);

d($pd->to_date(date("Y-m-d"), 'D'));
d($pd->to_date(date("Y-m-d"), 'y'));
d($pd->to_date(date("Y-m-d"), 'M'));
d($pd->to_date(date("Y-m-d"), 'j'));


die;
include _PATH . "instance/front/controller/apiTest_add_sample_timesheet_data.php";
print "Sample data added";
;

die;
$data = shift::get_summary('714');
d($data);

die;
$user_id = 23;
$date = "2018-01-06";
$time = "15:58";
//echo Notifications::employee_late_arrival($user_id, $date, $time);
echo Notifications::employee_early_departure($user_id, $date, $time);
die;
_errors_on();


die;
$data = shift::_is_timeoff(300, '2018-01-03');
d($data);
die;
d(date("Y-m-d"));

$day = date("w");

$pd = new persian_date();
$repsonse = $pd->to_date(date("Y-m-d"), "D");
d($repsonse);

die;
$_j_date = "۱۳۹۶-۱۰";
ts::get_month_start_end_from_jalali_yyyymm($_j_date);

die;
$shamsi = _persianToDigits("۱۳۹۶-۱۰");
$shamsi .= "-15";
$shamsi = explode("-", $shamsi);
d($shamsi);
d(_jg($shamsi[0], $shamsi[1], $shamsi[2]));

die;

print intval(date("d"));

die;
$shift_id = _e($_REQUEST['sid'], 94);
$total_time = shift::calc_shift_times_summary($shift_id);
d($total_time);

die;
$number = '30008304000000';
$message = "TEST SMS";
$resule = _SendSMS($number, $message);
die;
die;
print str_pad("9", 2, "0", STR_PAD_LEFT);
die;
$number = '30008304000000';
$message = "TEST SMS";
//echo 
$resule = _SendSMS($number, $message);
$r = json_decode($resule, true);
d($r);

die;
//d($_REQUEST);
$botToken = "397599083:AAEKRTSs0th_ZAMeP0NWK_O1Vwo0_FShX0E";
//$telegram = new Telegram($botToken);
$message = $_REQUEST['text'];

$botToken = "397599083:AAEKRTSs0th_ZAMeP0NWK_O1Vwo0_FShX0E";
$website = "https://api.telegram.org/bot" . $botToken;
$updated = file_get_contents($website . "/getupdates");
$updateArray = json_decode($updated, TRUE);
$chat_id = $updateArray['result'][0]['message']['chat']['id'];
sendMessage($chat_id, $message);

function sendMessage($chat_id, $message) {

    $botToken = "397599083:AAEKRTSs0th_ZAMeP0NWK_O1Vwo0_FShX0E";
    $website = "https://api.telegram.org/bot" . $botToken;
    file_get_contents($website . "/sendmessage?chat_id=" . $chat_id . "&text=" . urlencode($message));
}

die;
//$apiCore = new apiCore();
////$data = array();
////$data['user_id'] = '162';
//$data = '2017-07-07';
//$output_data = $apiCore->doCall("https://pholiday.herokuapp.com/gdate/" . $data);
//d($output_data);
//$Data = array();
//
//$Data = json_decode($output_data);
//d($Data['events']);
//foreach ($Data as $val) {
//    d($val);
//}
//die;
//$country = geoip_country_name_by_name('www.example.com');
//if ($country) {
//    echo 'This host is located in: ' . $country;
//}
//
//
//$times = "13:00 ";
//echo date('H:i', strtotime($times));
//$startMinutes = "100";
//$f = date('H:i', strtotime($startMinutes . ' minutes'));
//d($f);
//die;
//$strStart = '2013-06-19 18:25';
//$strEnd = '06/20/13 18:25';
//$to_time = strtotime($strStart);
//$from_time = strtotime($strEnd);
////echo $v / 60;
//$totalTime = round(abs($to_time - $from_time) / 60, 2);
//echo number_format(round($totalTime / 60, 2), 2, ':', '');
//
//
//
//$dteStart = new DateTime($strStart);
//$dteEnd = new DateTime($strEnd);
//$dteDiff = $dteStart->diff($dteEnd);
//print $dteDiff->format("%H:%I:%S");
//die;
?>




