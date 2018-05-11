<form id="form1" name="form1" method="post" action="">
    <p>Username:
        <label>
            <input type="text" name="username" id="username" />
        </label>
    </p>
    <p>Password:
        <label>
            <input type="text" name="password" id="password" />
        </label>
    </p>
    <p>From Number:
        <label>
            <input type="from_number" name="from_number" id="from_number" />
        </label>
    </p>
    <p>To Numbers:
        <label>
            <input name="to_number" type="text"  id="to_number"  />
        </label>
    </p>
    <p>Message:
        <label>
            <textarea name="message" id="message"></textarea>
        </label>
    </p>
    <p>
        <label>
            <input type="submit" name="submit" id="submit" value="Submit" />
        </label>
    </p>
</form>
<?php
/* بسم الله الرحمن الرحیم */
if (isset($_POST['submit'])) {
    //error_reporting(0);
    $sms_username = $_POST["username"];
    $sms_password = $_POST["password"];
    $from_number = array($_POST["from_number"]);
    $to_number = array($_POST["to_number"]);

//$date="29/12/2014 17:24"; //Date example
//list($day, $month, $year, $hour, $minute) = split('[/ :]', $date);
//The variables should be arranged according to your date format and so the separators
//$timestamp = mktime($hour, $minute, 0, $month, $day, $year);
    //$sendDate = array($timestamp);
    $message = array($_POST["message"]);


    $client = new SoapClient("http://parsasms.com/webservice/v2.asmx?WSDL");

    $params = array(
        'username' => $sms_username,
        'password' => $sms_password,
        'senderNumbers' => $from_number,
        'recipientNumbers' => $to_number,
        //'sendDate'=> $sendDate,
        'messageBodies' => $message
    );

    $results = $client->SendSMS($params);

    print_r($results);
}
?>


<?php
//$q = qs("select * from tb_employee where id='43'");
//echo "<img src='data:image/png;base64,".base64_encode($q['b_photo'])." ' alt='Red dot' />";
//$fields = array();
//$fields["fname"] = $q['fname'];
////$fields["picture"] = base64_encode($q['b_photo']);
//$fields["picture"] = base64_encode($q['b_photo']);
//echo json_encode($fields);
die;
$date1 = date_create('2017-07-03 13:55:20');

$date2 = date_create('2017-07-04 21:17:44');

$diff = date_diff($date1, $date2);
$hour = ($diff->d * 24) + $diff->h;
d($hour);
$hourdiff = round((strtotime('2017-07-03 13:55:20') - strtotime('2017-07-04 21:17:44')) / 3600);
d($hourdiff);
_R("sds");
die;
$latitude = '9.537086';
$longitude = '76.886407';
addressPicker($latitude, $longitude);

function addressPicker($latitude, $longitude) {
    $latitude = '9.537086';
    $longitude = '76.886407';
    $geolocation = $latitude . ',' . $longitude;

    $API_KEY = 'AIzaSyCV1OstieLoQIssF0tBwB6jYYz_I7w1FRA';
    $request = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $geolocation . '&sensor=false&key=' . $API_KEY;

    $file_contents = file_get_contents($request);
    $json_decode = json_decode($file_contents);
//    d($json_decode);
    $place_name = '';
    if (isset($json_decode->results[0])) {
        $response = array();
        $j = 0;
        foreach ($json_decode->results[0]->address_components as $addressComponet) {
            $response2[] = $addressComponet->long_name;

            switch ($json_decode->results[0]->address_components[$j]->types[0]) {
                case 'street_number':
                    $place_name .= $json_decode->results[0]->address_components[$j]->long_name . ', ';
                    break;
                case 'route':
                    $place_name .= $json_decode->results[0]->address_components[$j]->long_name . ', ';
                    break;
                case 'political':
                    $place_name .= $json_decode->results[0]->address_components[$j]->long_name . ', ';
                    break;
                case 'locality':
                    $place_name .= $json_decode->results[0]->address_components[$j]->long_name . ', ';
                    break;
            }
            $j++;
        }
        echo $place_name;
    }
}
?>
