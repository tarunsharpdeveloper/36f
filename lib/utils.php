<?php

/**
 * General Functions
 * 
 * 
 * @author Hardik Panchal 
 * @version 1.0
 * @package Whozoor
 * 
 */

/**
 * Function to check whether variable is set or not.
 * @param String $var
 * @return Boolean
 * 
 * @author Hardik Panchal 
 * @version 1.0
 * @package Whozoor
 * 
 */
function _set($var) {
    return isset($var) && $var ? true : false;
}

//function isMobile() {
//    $useragent = $_SERVER['HTTP_USER_AGENT'];
//
//    if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
//
//        return TRUE;
//    }
//    return FALSE;
//}

function _t($key, $default_value) {
    if (isset($_SESSION['lang'][$key])) {
        return $_SESSION['lang'][$key];
    } else {
        return $default_value;
    }
}

function getTimeOffDisplayId() {
    $db = Db::__d();
    $random = rand(100000, 999999);
    $display_id = "T" . $random;

    $qry = "SELECT id FROM tb_timeoff WHERE unique_id ='{$display_id}'";
    $rows = qs($qry);

    if (count($rows) > 0) {
        getTimeOffDisplayId();
    } else {
        return $display_id;
    }
}

function getErrandsDisplayId() {
    $db = Db::__d();
    $random = rand(100000, 999999);
    $display_id = "ER" . $random;

    $qry = "SELECT id FROM errands WHERE unique_id ='{$display_id}'";
    $rows = qs($qry);

    if (count($rows) > 0) {
        getErrandsDisplayId();
    } else {
        return $display_id;
    }
}

function _SendSMS($number, $message) {

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.smsapp.ir/v2/sms/send/simple",
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => "message=test&sender=10000000365365&Receptor=09128938411",
        CURLOPT_HTTPHEADER => array(
            "apikey:us6o02XYT/rovf8bhk4SvTOdnwyGqzSMwKeqJe74pEY",
        ),
    ));


    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo var_dump($response);
    }

    /* try {
      if ($number != '') {
      $client = new SoapClient("http://parsasms.com/webservice/v2.asmx?WSDL", array("trace" => 1, "exception" => 0));
      $params = array(
      'username' => "hoshyar",
      'password' => "9122078278ssss",
      'senderNumbers' => '10000000365365',
      'recipientNumbers' => '09109239245',
      //'sendDate'=> $sendDate,
      'messageBodies' => $message
      );
      $results = $client->SendSMS($params);
      //            return $results;
      var_dump($results);
      return 1;
      } else {
      return 2;
      }
      } catch (Exception $e) {
      print $e->getMessage();
      return 3;
      } */
}

/**
 * Checks if variable is set or not. if
 * variable is not set, it will reutnr second arc
 * @param String $var
 * @param String $var
 * @return String $var
 * 
 * @author Hardik Panchal 
 * @version 1.0
 * @package Whozoor
 * 
 */
function _e(&$s, $a = null) {
    return !empty($s) ? $s : $a;
}

/**
 * function to escape string
 * 
 * @param String $string
 * @return String escaped string
 * @author Hardik Panchal 
 * @version 1.0
 * @package Whozoor
 */
/* function _escape($string) {
  $string = stripslashes($string);
  return mysql_real_escape_string(trim($string));
  } */

/* function _escape($string) {
  //    $string = stripslashes($string);
  //    return mysql_real_escape_string(trim($string));
  $string = stripslashes($string);
  $db = Db::__d();
  return mysqli_real_escape_string($db->_link, trim($string));
  } */

function _escape($string) {
    //    $string = stripslashes($string);
    //    return mysql_real_escape_string(trim($string));
    $string = stripslashes($string);
    $db = Db::__d();
    return mysqli_real_escape_string($db->_link, trim($string));
}

/**
 * Wrapper function for db insert query
 * 
 * @author Hardik Panchal 
 * @version 1.0
 * @package Whozoor
 */
function qi($table, $fields, $operation = 'INSERT') {
    $db = Db::__d();
    return $db->insert_query($table, $fields, $operation);
}

function qd($table, $condition) {
    $db = Db::__d();
    return $db->delete_query($table, $condition);
}

function q($query) {
    $db = Db::__d();
    return $db->format_data($db->query($query));
}

function qs($query) {
    $result = q($query);
    return $result[0];
}

/**
 * Wrapper function for db update query
 * 
 * @author Hardik Panchal 
 * @version 1.0
 * @package Whozoor
 */
function qu($table, $fields, $condition) {
    $db = Db::__d();
    return $db->update_query($table, $fields, $condition);
}

/**
 * Return date format that mysql likes YYYY-MM-DD H:I:S
 * 
 * @param String $timestamp optional unixtimestamp
 * @return String $date
 * 
 * @author Hardik Panchal 
 * @version 1.0
 * @package Whozoor
 */
function _mysqlDate($timestamp = 0) {
    $timestamp = $timestamp ? $timestamp : time();
    return date('Y-m-d H:i:s');
}

function GetdataFromdb($array) {
    $counter = 0;
    for ($i = 0, $e = count($array); $i < $e; $i++) {
        if (!empty($array[$i])) {
            $counter += 1;
        }
    }
    return $counter;
}

function _getInstance($url) {
    $arg = explode("/", $url);
    switch ($arg[0]) {
        case 'admin':
            _cg('url', _e($arg[1], "home"));
            _cg("url_instance", $arg[0]);
            _cg("instance", "admin");
            break;
        default:
            if ($arg[0] != '') {
                $url_d = $arg[0];
            } else {
                $url_d = 'home';
            }
            _cg('url', $url_d);
            _cg("url_instance", '');
            _cg("instance", "front");

            if ($arg[1]) {
                array_shift($arg);
                _cg("url_vars", $arg);
            }
    }
}

/**
 *  Wrapper function for application level
 *  global variable
 * 
 *  set/get key/value
 * 
 *  @param String $key key
 *  @param $value value
 * 
 *  @return Array 
 * 
 */
function _cg($key, $value = null) {
    if (is_null($value)) {
        return Config::$_vars[$key];
    } else {
        Config::$_vars[$key] = $value;
    }
}

/**
 *  Wrapper function for application level
 *  global variable
 * 
 *  set/get key/value
 * 
 *  @param String $key key
 *  @param $value value
 * 
 *  @return Array 
 * 
 */
function _cgd($key, $value = null) {

    if (is_null($value)) {

        return Config::$_vars[$key];
    } else {
        Config::$_vars[$key] = $value;
    }
}

function lr($url) {
    return _U . $url;
}

function l($url) {
    print lr($url);
}

function getUserNameFromEmail($email) {
    $data = q("select * from admin_users  where user_name  = '{$email}' ");

    return $data[0]['user_name'];
}

function d($arr, $hideStyle = "block") {
    if (is_array($arr) || is_object($arr)) {
        print "<pre style='display:{$hideStyle}'>" . "...";
        print_r($arr);
        print "</pre>";
    } else {
        print "<div class='debug' style='display:{$hideStyle}'>Debug:<br>$arr</div>";
    }
}

function _R($url) {
    header("Location:{$url}");
    exit;
}

function _auth_url($pages, $return_page) {
//    d($_SESSION);
    if (!$_SESSION['user'] && !(in_array(_cg("url"), $pages))) {
        if (_cg("url") != 'login' && _cg("url") != 'home' && _cg("url") != '') {
            $_SESSION['redirectPage'] = _cg("url");
        }
        _cg("url", $return_page);
    }
}

function _level_auth_url($pages, $return_page) {

    if (!in_array(_cg("url"), $pages)) {
        _cg("url", $return_page);
    }
}

function back_trace() {
    $array = debug_backtrace();
    $output = 'Execution Backtrace:<br><ul>';
    foreach ($array as $debug_data) {
        $output .= "<li><b> " . $debug_data['file'] . "</b> [ Line : <b>" . $debug_data['line'] . "</b> ] <br></li>";
    }
    $output .= '</ul>';
    d($output);
}

function random_string() {
    return date("ymd") . mt_rand(1, 1000) . mt_rand(99, 99999);
}

/* function _escapeArray($array) {
  $array = array_map('mysql_real_escape_string', $array);
  return array_map('trim', $array);
  } */

function _escapeArray($array) {
    $array = array_map('_escape', $array);
    return array_map('trim', $array);
    //    $array = array_map('mysql_real_escape_string', $array);
    //    return array_map('trim', $array);
}

function _bindArray($array, $map) {
    $return = array();
    foreach ($map as $form_field => $db_field) {
        $return[$db_field] = $array[$form_field];
    }
    return $return;
}

function _normalDate($date) {
    return date("d-M-Y H:i a", strtotime($date));
}

function json_die($status = true, $array = array()) {
    $response = array();
    $response['status'] = $status;
    $response['data'] = $array;
    die(json_encode($response));
}

function _errors_on() {
    ini_set("display_errors", "on");
    error_reporting(E_ALL);
}

function _errors_off() {
    ini_set("display_errors", "off");
    error_reporting(0);
}

function clearNumber($number) {
    return str_replace(array("-", "(", ")", " "), array("", "", "", ""), $number);
}

function formatCellDash($data) {
    $data = clearNumber($data);

    return $data ? "(" . substr($data, 0, 3) . ") " . substr($data, 3, 3) . "-" . substr($data, 6) : "--";
}

function formatCell($data) {
    if (preg_match('/^\+\d(\d{3})(\d{3})(\d{4})$/', $data, $matches)) {
        $result = $matches[1] . '-' . $matches[2] . '-' . $matches[3];
        return $result;
    } else {
        return $data;
    }
}

/**
 * Whether its a local machine or host
 */
function _isLocalMachine() {
    return IS_DEV_ENV == 'true' ? true : false; //$_SERVER['HTTP_HOST'] == 'localhost' ? true : false;
}

function _isLocalHost() {
    return $_SERVER['HTTP_HOST'] == 'localhost' ? true : false;
}

/**
 * Custom Mail function.
 *    
 * Uses swift mail library and sends mail
 * 
 * @param type $to
 * @param type $subject
 * @param type $content
 * @param type $extra
 * 
 * @author  Hardik Panchal <hardikpanchal469@gmail.com>
 * @since November 28, 2013
 */
function _mail($to, $subject, $content, $extra = array()) {

    # unfortunately, need to use require within function.
    # swift lib overrides the autoloader 
    # and that stops native app classes being resolved and included

    require_once _PATH . 'lib/mail/swift/lib/swift_required.php';

    if (_isLocalMachine()) {
        //_l("To Email is overwritten by -  testoperators@gmail.com  due to dev localmachine ");
        $to = 'testaccts001@gmail.com';
    }
    $bcc = 'testaccts001@gmail.com';

    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
            ->setUsername(SMTP_EMAIL_USER_NAME)
            ->setPassword(SMTP_EMAIL_USER_PASSWORD);

    $mailer = Swift_Mailer::newInstance($transport);

    if (!is_array($to)) {
        $to = array($to);
    }



    $message = Swift_Message::newInstance($subject)
            ->setFrom(array(MAIL_FROM_EMAIL => MAIL_FROM_NAME))
            ->setTo($to)
            ->setBcc($bcc)
            //->setReplyTo(array($_SESSION['tenant']['reply_to_email'] => $_SESSION['tenant']['reply_to_email_name']))
            ->setBody($content, 'text/html', 'utf-8')
            ->addPart(strip_tags(nl2br($content)), 'text/plain');


    // create an array out of the extra if its not an array
    // so user can pass a string or array for attachment
    if ($extra != '') {
        if (is_array($extra)) {
            
        } else {
            $extra = array($extra);
        }
    }

    if (!empty($extra)) {
        if (count($extra) > 0) {
            foreach ($extra as $each_extra):
                if (file_exists($each_extra)) {
                    echo 'match<br>';
                    $message->attach(Swift_Attachment::fromPath($each_extra));
                }
            endforeach;
        }
        //$attachment = Swift_Attachment::fromPath('/path/to/image.jpg')->setFilename('cool.jpg');
    }
    $result = $mailer->send($message);

    return $result;
}

function _cprint($key, $value, $print, $doPrint = true) {

    if ($key == $value) {
        if ($doPrint) {
            print $print;
        } else {
            return $print;
        }
    }
}

/**
 * $ 275.00 => 275.00
 * @param type $subject
 * @return type
 */
function clearDecimal($subject) {
    $search = array(" ", "$", "_", "-", "(", ")", "%");
    $replace = array("", "", "", "", "", "", "");
    return trim(str_replace($search, $replace, $subject));
}

function clearString($subject) {
    $search = array(" ", "$", "_", "-", "(", ")", "%", "'", '"', "/", "\"", "&", "^", "@", "#", "$", "!", "`", "~", ",");
    $replace = array("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ",");
    return trim(str_replace($search, $replace, $subject));
}

function writeLog($log, $filePath = '') {
    if ($filePath == '') {
        $filePath = _PATH . "error_log/log_" . date("Y-m-d") . ".txt";
    }
    $log = "Time: " . date("h:i A") . $log . "\n\n----------------------------------------------------\n\n";
    file_put_contents($filePath, $log, FILE_APPEND);
}

function sendSMS($phone, $message = '') {
    try {
        if ($phone != '') {
            $sms_url = IS_DEV_ENV ? "http://192.168.70.90:3033" : "http://192.168.70.90:3033";
            $client = new SoapClient($sms_url . '/Whozoor.asmx?WSDL', array("trace" => 1, "exception" => 0));
            //$client = new SoapClient('http://192.168.72.41/Whozoor.asmx?WSDL', array("trace" => 1, "exception" => 0));

            $params = array();
            $params['username'] = "naeb7Q7geirn";
            $params['password'] = "^_GhG_!_PpP_^";
            $params['lineNumber'] = "5000530303";
            $params['message'] = $message;
            $params['destinationNumber'] = $phone;

            $data = $client->SendSMS($params);

            $slackMessage = "*SMS SENT LOGS* \n" . $phone . "\n" . $message . "\nSMS STATUS:" . "*" . $data->SendSMSResult . "*";

            $Slack = new apiSlack();
            $Slack->pingSlack($slackMessage);

            if ($data->SendSMSResult == "Success") {

                return 2;
            } elseif ($data->SendSMSResult == "InvalidDestination") {

                return 3;
            } else {
                return 4;
            }
        } else {
            return 5;
        }
    } catch (Exception $e) {
        return 6;
    }
}

function div($a, $b) {
    return (int) ($a / $b);
}

function gregorian_to_jalali($g_y, $g_m, $g_d, $str) {

    return array($g_y, $g_m, $g_d);

    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);


    $gy = $g_y - 1600;
    $gm = $g_m - 1;
    $gd = $g_d - 1;

    $g_day_no = 365 * $gy + div($gy + 3, 4) - div($gy + 99, 100) + div($gy + 399, 400);

    for ($i = 0; $i < $gm; ++$i)
        $g_day_no += $g_days_in_month[$i];
    if ($gm > 1 && (($gy % 4 == 0 && $gy % 100 != 0) || ($gy % 400 == 0)))
    /* leap and after Feb */
        $g_day_no++;
    $g_day_no += $gd;

    $j_day_no = $g_day_no - 79;

    $j_np = div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
    $j_day_no = $j_day_no % 12053;

    $jy = 979 + 33 * $j_np + 4 * div($j_day_no, 1461); /* 1461 = 365*4 + 4/4 */

    $j_day_no %= 1461;

    if ($j_day_no >= 366) {
        $jy += div($j_day_no - 1, 365);
        $j_day_no = ($j_day_no - 1) % 365;
    }

    for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
        $j_day_no -= $j_days_in_month[$i];
    $jm = $i + 1;
    $jd = $j_day_no + 1;
    if ($str)
        return $jy . '/' . $jm . '/' . $jd;
    return array($jy, $jm, $jd);
}

function jalali_to_gregorian($j_y, $j_m, $j_d, $str) {

    return array($j_y, $j_m, $j_d);

    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);


    $jy = (int) ($j_y) - 979;
    $jm = (int) ($j_m) - 1;
    $jd = (int) ($j_d) - 1;

    $j_day_no = 365 * $jy + div($jy, 33) * 8 + div($jy % 33 + 3, 4);

    for ($i = 0; $i < $jm; ++$i)
        $j_day_no += $j_days_in_month[$i];

    $j_day_no += $jd;

    $g_day_no = $j_day_no + 79;

    $gy = 1600 + 400 * div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */
    $g_day_no = $g_day_no % 146097;

    $leap = true;
    if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */ {
        $g_day_no--;
        $gy += 100 * div($g_day_no, 36524); /* 36524 = 365*100 + 100/4 - 100/100 */
        $g_day_no = $g_day_no % 36524;

        if ($g_day_no >= 365)
            $g_day_no++;
        else
            $leap = false;
    }

    $gy += 4 * div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */
    $g_day_no %= 1461;

    if ($g_day_no >= 366) {
        $leap = false;

        $g_day_no--;
        $gy += div($g_day_no, 365);
        $g_day_no = $g_day_no % 365;
    }

    for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)
        $g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);
    $gm = $i + 1;
    $gd = $g_day_no + 1;
    if ($str)
        return $gy . '/' . $gm . '/' . $gd;
    return array($gy, $gm, $gd);
}

function _persianToDigits($string) {
    $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $num = range(0, 9);
    return str_replace($persian, $num, $string);
}

function _DigitsTopersian($string) {
    $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $num = range(0, 9);
    return str_replace($num, $persian, $string);
}

function _isOdd($num) {
    $num = intval(_persianToDigits($num));
    return $num & 1 ? true : false;
}

function _permitType($last_4_digit) {
    return _isOdd($last_4_digit) ? "B" : "C";
}

function calcDiffFromSeconds($seconds, $formated = '0') {
    $hours = str_pad(floor($seconds / 3600), 2, "0", STR_PAD_LEFT);
    $minutes = str_pad(floor(($seconds / 60) % 60), 2, "0", STR_PAD_LEFT);
    $seconds = $seconds % 60;
    if ($formated == "0") {
        return array("hours" => $hours, "minutes" => $minutes);
    }

    return "{$hours}:{$minutes}";
}

function gtj_datetime($datetime) {
    return $datetime;
    $datetime_arr = explode(" ", $datetime);
    $sdate = explode("-", $datetime_arr[0]);
    $gdate = gregorian_to_jalali($sdate[0], ltrim($sdate[1], "0"), ltrim($sdate[2], "0"));
    if (isset($datetime_arr[1]))
        return $gdate[0] . "-" . str_pad($gdate[1], "2", "0", STR_PAD_LEFT) . "-" . str_pad($gdate[2], "2", "0", STR_PAD_LEFT) . " " . $datetime_arr[1];
    else
        return $gdate[0] . "-" . str_pad($gdate[1], "2", "0", STR_PAD_LEFT) . "-" . str_pad($gdate[2], "2", "0", STR_PAD_LEFT);
}

function jtg_datetime($datetime) {
    return $datetime;
    $datetime_arr = explode(" ", $datetime);
    $sdate = explode("-", $datetime_arr[0]);
    $gdate = jalali_to_gregorian($sdate[0], ltrim($sdate[1], "0"), ltrim($sdate[2], "0"));
    if (isset($datetime_arr[1]))
        return $gdate[0] . "-" . str_pad($gdate[1], "2", "0", STR_PAD_LEFT) . "-" . str_pad($gdate[2], "2", "0", STR_PAD_LEFT) . " " . $datetime_arr[1];
    else
        return $gdate[0] . "-" . str_pad($gdate[1], "2", "0", STR_PAD_LEFT) . "-" . str_pad($gdate[2], "2", "0", STR_PAD_LEFT);
}

function arrayRemoveNull($array) {
    $return = array();
    foreach ($array as $key => $value) {
        if (!is_array($value)) {
            $return[$key] = _e($value, '');
        } else {
            $return[$key] = $vaue;
        }
    }
    return $return;
}

/* Get English & farsi language from the table */

function getChangeLangLabels() {
    $langLabels = array();
    $labelTxt = q("Select * FROM tb_translate_website_texts");
    foreach ($labelTxt as $eachLabel):
        if ($_SESSION['selected_lang'] == 'fa') {
            $langLabels[$eachLabel["unique_text_id"]] = $eachLabel["farsi_text"];
        } else {
            $langLabels[$eachLabel["unique_text_id"]] = $eachLabel["english_text"];
        }
    endforeach;
    return $langLabels;
}

function checkLunchTime($shiftTime) {
    $checkInTime = qs("SELECT timestamp FROM `tb_shift_check_inout` WHERE `shiftid` = '$shiftTime' order by id ");
    $endTime = date_create(date('Y-m-d H:i:s'));
    $startTime = date_create($checkInTime['timestamp']);
    $diffirenceTime = date_diff($endTime, $startTime);
    return str_pad($diffirenceTime->h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($diffirenceTime->i, 2, "0", STR_PAD_LEFT) . ":" . str_pad($diffirenceTime->s, 2, "0", STR_PAD_LEFT);
}

function convertMinutesToHourMinuteFormat($minutes) {
    $hours = intval($minutes / 60);
    $minutes = ($minutes % 60);
    return str_pad($hours, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minutes, 2, "0", STR_PAD_LEFT);
}

/* Like [Input]07:20 = 440[OutPut In minutes] */

function convertHourMinuteToMinuteFormat($hourMinute) {
    $hourMinuteArr = explode(":", $hourMinute);
    $hourVal = intval($hourMinuteArr[0]);
    $hourToMinuteVal = ($hourVal * 60);
    $totalMinute = ($hourToMinuteVal + intval($hourMinuteArr[1]));
    return $totalMinute;
}

function calculateOT($shiftid, $totalTime, $lunchFlag) {
    $totalTime = $totalTime;
    $fields_test = array();
    //Static Field 
    $fields_test['allow_intermediate_meetings_time'] = 'true';
    $lunch_start = q("select id,timestamp,type from tb_shift_check_inout where shiftid='$ShiftId' and type='LUNCHIN' ");
    $lunch_end = q("select id,timestamp,type from tb_shift_check_inout where shiftid='$ShiftId' and type='LUNCHOUT'");
    $lunchData = array();
    $max = max(sizeof($lunch_start), sizeof($lunch_end));
    $m = "1";
    for ($i = '0'; $i < $max; $i++) {
        $data = array();
        $data['lunch_break_start'] = gtj_datetime($lunch_start[$i]['timestamp']);
        $data['lunch_break_end'] = gtj_datetime($lunch_end[$i]['timestamp']);
        $data['lunch_break_end'] = is_null($data['lunch_break_end']) ? "" : $data['lunch_break_end'];
        $endTime = date_create($lunch_start[$i]['timestamp']);
        $startTime = date_create(is_null($data['lunch_break_end']) ? date("Y-m-d H:i:s") : $data['lunch_break_end']);

        $diffirenceTime = date_diff($endTime, $startTime);
        $data['lunch_break_total'] = $diffirenceTime->h . ":" . $diffirenceTime->i . ":" . $diffirenceTime->s;
        $lunchData[] = ($data);
        $m++;
    }
    /* lunch array end */
    if ($lunchFlag == false) {
        $hour = 0;
        $minute = 0;
        $second = 0;
        foreach ($lunchData as $value) {
            $lunchtime = explode(":", $value['lunch_break_total']);
            $hour = $hour + $lunchtime[0];
            $minute = $minute + $lunchtime[1];
            $second = $second + $lunchtime[2];
        }
        if ($second >= 60) {
            $minute = $minute + floor($second / 60);
            $second = $second % 60;
        }
        if ($minute >= 60) {
            $hour = $hour + floor($minute / 60);
            $minute = $minute % 60;
        }
        $lunchTime = $hour . ":" . $minute . ":" . $second;
        $first = new DateTime($totalTime);
        $second = new DateTime($lunchTime);
        $diff = $first->diff($second);
        $totalTime = $diff->h . ":" . $diff->i . ":" . $diff->s;
    }
    if ($fields_test['allow_intermediate_meetings_time'] == 'false') {
        $checkInOutTime = q("SELECT timestamp,type FROM `tb_shift_check_inout` WHERE `shiftid` = '$shiftid' order by id ");
        $hour = 0;
        $minute = 0;
        $second = 0;
        $outFlag = 0;
        foreach ($checkInOutTime as $key => $value) {
            if ($value['type'] == 'BRIEFCASEIN') {
                $outFlag = 1;
                if ($checkInOutTime[$key + 1]['timestamp'] != '') {
                    $endTime = date_create($value['timestamp']);
                    $startTime = date_create($checkInOutTime[$key + 1]['timestamp']);
                    $diffirenceTime = date_diff($endTime, $startTime);
                    $hour = $hour + $diffirenceTime->h;
                    $minute = $minute + $diffirenceTime->i;
                    $second = $second + $diffirenceTime->s;
                }
            }
            if ($value['type'] == 'LUNCHIN' && $outFlag == 1) {
                if ($checkInOutTime[$key + 1]['timestamp'] != '') {
                    $endTime = date_create($value['timestamp']);
                    $startTime = date_create($checkInOutTime[$key + 1]['timestamp']);
                    $diffirenceTime = date_diff($endTime, $startTime);
                    $hour = $hour + $diffirenceTime->h;
                    $minute = $minute + $diffirenceTime->i;
                    $second = $second + $diffirenceTime->s;
                }
            }
            if ($value['type'] == 'CHECKEDIN') {
                $outFlag = 0;
            }
        }
        if ($second >= 60) {
            $minute = $minute + floor($second / 60);
            $second = $second % 60;
        }
        if ($minute >= 60) {
            $hour = $hour + floor($minute / 60);
            $minute = $minute % 60;
        }
        $meetingTime = $hour . ":" . $minute . ":" . $second;
        $fields['total_time_between_meetings'] = $meetingTime;
        $first = new DateTime($totalTime);
        $second = new DateTime($meetingTime);
        $diff = $first->diff($second);
        $totalTime = $diff->h . ":" . $diff->i . ":" . $diff->s;
    }
    return $totalTime;
}

function getTimeZoneTime($time = '') {
    $the_date = strtotime($time);
    date_default_timezone_set("UTC");
    return date("H:i:s", $the_date);
}

function getTimeZoneDateTime($time = '') {
    $the_date = strtotime($time);
    date_default_timezone_set("UTC");
    return date("Y-m-d H:i:s", $the_date);
}

function _ts($time) {
    return Config::$from_ios == "1" ? $time : strtotime($time);
}

function is_ios() {
    return Config::$from_ios == "1" ? true : false;
}

function _api_process_output($fields, $api_call = '', $options = array()) {

    if (!is_ios()) {
        if ($api_call != '') {
            switch ($api_call) {
                case "having_shift":
                    unset($fields['Is_shift_due_in_120_min']);
                    unset($fields['total_time_seconds']);
                    unset($fields['check_in_time_expired']);
                    unset($fields['start_shift_time']);
                    unset($fields['end_shift_time']);

                    if ($options == 'no_shift') {
                        unset($fields['shiftid']);
                    }
                    break;
            }
        }
    }
    return $fields;
}

function distance($lat1, $lon1, $lat2, $lon2, $unit) {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "M") {
        return (($miles * 1.609344) * 1000);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}

function _gj($timestamp) {

// $g_y, $g_m, $g_d, $str
    $g_y = date("Y", $timestamp);
    $g_m = intval(date("m", $timestamp));
    $g_d = intval(date("d", $timestamp));


    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);


    $gy = $g_y - 1600;
    $gm = $g_m - 1;
    $gd = $g_d - 1;

    $g_day_no = 365 * $gy + div($gy + 3, 4) - div($gy + 99, 100) + div($gy + 399, 400);

    for ($i = 0; $i < $gm; ++$i)
        $g_day_no += $g_days_in_month[$i];
    if ($gm > 1 && (($gy % 4 == 0 && $gy % 100 != 0) || ($gy % 400 == 0)))
    /* leap and after Feb */
        $g_day_no++;
    $g_day_no += $gd;

    $j_day_no = $g_day_no - 79;

    $j_np = div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
    $j_day_no = $j_day_no % 12053;

    $jy = 979 + 33 * $j_np + 4 * div($j_day_no, 1461); /* 1461 = 365*4 + 4/4 */

    $j_day_no %= 1461;

    if ($j_day_no >= 366) {
        $jy += div($j_day_no - 1, 365);
        $j_day_no = ($j_day_no - 1) % 365;
    }

    for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
        $j_day_no -= $j_days_in_month[$i];
    $jm = $i + 1;
    $jd = $j_day_no + 1;

    return $jy . '-' . $jm . '-' . $jd;
}

function _jg($j_y, $j_m, $j_d) {



    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);


    $jy = (int) ($j_y) - 979;
    $jm = (int) ($j_m) - 1;
    $jd = (int) ($j_d) - 1;

    $j_day_no = 365 * $jy + div($jy, 33) * 8 + div($jy % 33 + 3, 4);

    for ($i = 0; $i < $jm; ++$i)
        $j_day_no += $j_days_in_month[$i];

    $j_day_no += $jd;

    $g_day_no = $j_day_no + 79;

    $gy = 1600 + 400 * div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */
    $g_day_no = $g_day_no % 146097;

    $leap = true;
    if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */ {
        $g_day_no--;
        $gy += 100 * div($g_day_no, 36524); /* 36524 = 365*100 + 100/4 - 100/100 */
        $g_day_no = $g_day_no % 36524;

        if ($g_day_no >= 365)
            $g_day_no++;
        else
            $leap = false;
    }

    $gy += 4 * div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */
    $g_day_no %= 1461;

    if ($g_day_no >= 366) {
        $leap = false;

        $g_day_no--;
        $gy += div($g_day_no, 365);
        $g_day_no = $g_day_no % 365;
    }

    for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)
        $g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);
    $gm = $i + 1;
    $gd = $g_day_no + 1;
    return $gy . '-' . str_pad($gm, 2, 0, STR_PAD_LEFT) . '-' . str_pad($gd, 2, 0, STR_PAD_LEFT);
}

# Returns the timeoff text 
# used in the timesheet api and shift class
# if user is sick (timeoffcode = 3) - then user the farsi text in app response

function _get_timeoff_farsi($timeoff_code) {
    $timeoff_array = array();
    $timeoff_array[1] = " بیماری";
    $timeoff_array[2] = " بدون حقوق";
    $timeoff_array[3] = " استعلاجی";
    $timeoff_array[4] = " استحقاقی";
    $timeoff_array[5] = "غیبت";
    $timeoff_array[6] = " تشویقی";
    $timeoff_array[7] = "فوت بستگان";
    $timeoff_array[8] = " ازدواج";
    $timeoff_array[9] = " بارداری";
    $timeoff_array[10] = " نوزاد";

    if (isset($timeoff_array[$timeoff_code])) {
        return $timeoff_array[$timeoff_code];
    }
    return 'NA';
}

# convert the unix time to tehran time
#10:30 => 07:00 => farsi for 07:00

function _tt($ymdhis_date, $format = "H:i", $returnFormat = 'persian') {
    //$format = "H:i:s";
    $date_value = $ymdhis_date;

    try {
        $DateTime = new DateTime($date_value, new DateTimeZone("UTC"));
        $DateTime->setTimezone(new DateTimeZone("Asia/Tehran"));
        $time = $DateTime->format($format);

        if ($format == "H:i") {
            $seconds = hisToSeconds($time);
            return _s2p($seconds);
        }
    } catch (Exception $e) {
        $fields = array();
        $fields['success'] = '0';
        $fields['msg'] = 'INVALID_DATE';
        echo _api_response($fields);
        die;
    }
    return $returnFormat == 'persian' ? _DigitsTopersian($time) : $time;
}
// gets your utc time based upon tehran time
function _ut($ymdhis_date, $format = "H:i", $returnFormat = 'persian') {
    //$format = "H:i:s";
    $date_value = $ymdhis_date;

    try {
        $DateTime = new DateTime($date_value, new DateTimeZone("Asia/Tehran"));
        $DateTime->setTimezone(new DateTimeZone("UTC"));
        $time = $DateTime->format($format);
        if ($format == "H:i") {
            $seconds = hisToSeconds($time);
            return _s2p($seconds);
        }
    } catch (Exception $e) {
        $fields = array();
        $fields['success'] = '0';
        $fields['msg'] = 'INVALID_DATE';
        echo _api_response($fields);
        die;
    }
    return $returnFormat == 'persian' ? _DigitsTopersian($time) : $time;
}


function hisToSeconds($h_i) {
    list($hour, $minutes) = explode(":", $h_i);
    $hour = intval($hour);
    $minutes = intval($minutes);

    $hour_to_seconds = $hour * 60 * 60;
    $minutes_to_seconds = $minutes * 60;

    return $hour_to_seconds + $minutes_to_seconds;
}

function _s2p($seconds) {
    if (intval($seconds) == 0) {
        return '';
    }
    // if less than on hour then - dont return 00:45 - only returnr 45
    if ($seconds < (59 * 60)) {
        $h_m = intval(gmdate("i", $seconds)) . "";
    } else {
        $h_m = (gmdate("G:i", $seconds)) . " ";
    }

    return _DigitsTopersian($h_m);
}

function _api_response($array) {
    $array['token_state'] = _cg('token_state');
    $array['token_message'] = _cg('token_message');

    helper::_api_log($array, 'REQUEST');
    //apiSlack::pingSlack("RESPONSE_SENT_TO_APP");
    
    echo json_encode($array, JSON_UNESCAPED_UNICODE);
    die;
}

function _get_day_persian($date = '') {

    if ($date == '') {
        $date = date("Y-m-d");
    }
    $pd = new persian_date();
    $return = array();
    $return['day'] = $pd->to_date($date, 'D');
    $return['month'] = $pd->to_date($date, 'M');
    $return['year'] = _DigitsTopersian($pd->to_date($date, 'y'));
    $return['date'] = _DigitsTopersian($pd->to_date($date, 'j'));

    return $return;
}

function min2sec($min) {
    return intval($min) * 60;
}

function convertInFarsi($no) {
    $persianNumbers = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $convertedNo = '';
    $length = strlen($no);
    for ($i = 0; $i < $length; $i++) {
        $char = '';
        $char = substr($no, $i, 1);
        if (is_numeric($char)) {
            $convertedNo .= $persianNumbers[$char];
        } else {
            $convertedNo .= $char;
        }
    }
    return $convertedNo;
}

// pass the shamsey - "Y-m-d H:i:s" and get the UTC "Y-m-d H:i:s"
function _j2g_full($jalali_ymdhis) {

    list($dates_part, $times_part) = explode(" ", $jalali_ymdhis);

    list($j_y, $j_m, $j_d) = explode("-", $dates_part);
    $english_date = _jg($j_y, $j_m, $j_d);

    $full_date_time = "{$english_date} {$times_part}";
    
    return $times_part != "00:00:00" ? _ut($full_date_time, "Y-m-d H:i:s", 'english') : $full_date_time;
}

# one character and one password
# length  6 to 12

function validate_password($string) {

    if (strlen($string) < 6 || strlen($string) > 12) {
        return false;
    }

    if (preg_match('/[A-Za-z]/', $string) & preg_match('/\d/', $string) == 1) {
        return true;
    }

    return false;
}

function checkAccessLevel($employeeType, $moduleName, $action) {
    $employeeType = strtolower($employeeType);
    $moduleName = strtolower($moduleName);
    $action = strtolower($action);


    $allowAccess = false;
    $accessRes = qs("SELECT * FROM tb_access_levels WHERE module_name = '{$moduleName}' AND action_name = '{$action}' LIMIT 0,1");

    if (!empty($accessRes)) {
        if ($employeeType == 'admin' && $accessRes['admin_action_value'] == 1) {
            $allowAccess = true;
        } else if ($employeeType == 'manager' && $accessRes['manager_action_value'] == 1) {
            $allowAccess = true;
        } else if ($employeeType == 'supervisor' && $accessRes['supervisor_action_value'] == 1) {
            $allowAccess = true;
        } else if ($employeeType == 'employee' && $accessRes['employee_action_value'] == 1) {
            $allowAccess = true;
        }
    }

    return $allowAccess;

    /*
      $accessLevelArr = array();

      $accessLevelArr['admin']['errand']['add'] = true;
      $accessLevelArr['admin']['errand']['edit'] = true;
      $accessLevelArr['admin']['errand']['delete'] = true;
      $accessLevelArr['admin']['errand']['approve'] = true;

      $accessLevelArr['manager']['errand']['add'] = true;
      $accessLevelArr['manager']['errand']['edit'] = true;
      $accessLevelArr['manager']['errand']['delete'] = false;
      $accessLevelArr['manager']['errand']['approve'] = true;

      $accessLevelArr['supervisor']['errand']['add'] = true;
      $accessLevelArr['supervisor']['errand']['edit'] = true;
      $accessLevelArr['supervisor']['errand']['delete'] = false;
      $accessLevelArr['supervisor']['errand']['approve'] = true;

      $accessLevelArr['employee']['errand']['add'] = true;
      $accessLevelArr['employee']['errand']['edit'] = true;
      $accessLevelArr['employee']['errand']['delete'] = false;
      $accessLevelArr['employee']['errand']['approve'] = false;


      $accessLevelArr['admin']['timeoff']['add'] = true;
      $accessLevelArr['admin']['timeoff']['edit'] = true;
      $accessLevelArr['admin']['timeoff']['delete'] = true;
      $accessLevelArr['admin']['timeoff']['approve'] = true;

      $accessLevelArr['manager']['timeoff']['add'] = true;
      $accessLevelArr['manager']['timeoff']['edit'] = true;
      $accessLevelArr['manager']['timeoff']['delete'] = false;
      $accessLevelArr['manager']['timeoff']['approve'] = true;

      $accessLevelArr['supervisor']['timeoff']['add'] = true;
      $accessLevelArr['supervisor']['timeoff']['edit'] = true;
      $accessLevelArr['supervisor']['timeoff']['delete'] = false;
      $accessLevelArr['supervisor']['timeoff']['approve'] = true;

      $accessLevelArr['employee']['timeoff']['add'] = true;
      $accessLevelArr['employee']['timeoff']['edit'] = true;
      $accessLevelArr['employee']['timeoff']['delete'] = false;
      $accessLevelArr['employee']['timeoff']['approve'] = false;

      $accessLevelArr['admin']['timesheet']['approve'] = true;
      $accessLevelArr['admin']['timesheet']['view'] = true;
      $accessLevelArr['admin']['timesheet']['export'] = true;

      $accessLevelArr['manager']['timesheet']['approve'] = true;
      $accessLevelArr['manager']['timesheet']['view'] = true;
      $accessLevelArr['manager']['timesheet']['export'] = true;

      $accessLevelArr['supervisor']['timesheet']['approve'] = true;
      $accessLevelArr['supervisor']['timesheet']['view'] = true;
      $accessLevelArr['supervisor']['timesheet']['export'] = true;

      $accessLevelArr['employee']['timesheet']['approve'] = true;
      $accessLevelArr['employee']['timesheet']['view'] = true;
      $accessLevelArr['employee']['timesheet']['export'] = true;

      $allowAccess = false;

      if (isset($accessLevelArr[$employeeType][$moduleName][$action])) {
      $allowAccess = $accessLevelArr[$employeeType][$moduleName][$action];
      }

      return $allowAccess;
     */
}

function seconds_to_his($seconds) {

    // CONVERT TO HH:MM:SS
    $hours = floor($seconds / 3600);
    $remainder_1 = ($seconds % 3600);
    $minutes = floor($remainder_1 / 60);
    $seconds = ($remainder_1 % 60);

    // PREP THE VALUES
    if (strlen($hours) == 1) {
        $hours = "0" . $hours;
    }

    if (strlen($minutes) == 1) {
        $minutes = "0" . $minutes;
    }

    if (strlen($seconds) == 1) {
        $seconds = "0" . $seconds;
    }

    return $hours . ":" . $minutes . ":" . $seconds;
}

?>