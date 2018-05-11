<?php

class helper {

    public static $helper;
    public static $googleMapsDirectionsAPIKey = 'AIzaSyDPQbRpbOMXS7gEsJnWWbd2Nww8uQd0n_0';

    public function __construct() {
        
    }

    public static function officeid() {
        return " and work_at = '{$_SESSION['company']['id']}' ";
    }
    public static function onlyOfficeid() {
        return " where work_at = '{$_SESSION['company']['id']}' ";
    }

    public static function officeCond() {
        return " and office = '{$_SESSION['office']}' ";
    }

    public static function OrderByDesc() {
        return " order by d.created_at Desc";
    }

    public static function getObj() {
        return self::$helper = new stdClass();
    }

    public static function doLogError($message) {
        $message = _escape($message);
        $server_variable = _escape(json_encode($_SERVER));
        $request_variable = _escape(json_encode($_REQUEST));
        $cookie_variable = _escape(json_encode($_COOKIE));
        $session_variable = _escape(json_encode($_SESSION));

        $log_id = qi('_system_logs', array(
            'log' => $message,
            'server_variable' => $server_variable,
            'request_variable' => $request_variable,
            'cookie_variable' => $cookie_variable,
            'session_variable' => $session_variable,
        ));

        //_mail(SYSTEM_LOG_EMAIL, "[LIFEZAVER-SYSTEM-ERROR]-{$log_id}", $message);
    }

    public static function tenantCond() {
        return " and tenant_id = '{$_SESSION['user']['id']}' ";
    }

    public static function isLocalhost() {
        return visits::isInternal();
    }

    public static function generateRandomCode($length = '5') {
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $code = "";
        for ($i = 0; $i < $length; $i++) {
            $code .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $code;
    }

    public static function renderFleetType($data) {
        $return = '';
        foreach ($data as $each_data) {
            $return[] = "<option value='{$each_data['fleet_type']}'>{$each_data['fleet_type']}</option>";
        }
        return implode("", $return);
    }

    public static function vehicleImage($image) {
        return _MEDIA_URL . "img/{$image}";
    }

    public static function convertpdf($content, $filename) {
        require _PATH . 'instance/front/tpl/setaspdf_pdfcrowd.php';
        try {
            // create an API client instance
            $client = new Pdfcrowd("hardikpanchal", "8d17c3da28b32cfc83628718c3e13af2");

            // convert a web page and store the generated PDF into a $pdf variable
            //$pdf = $client->convertURI('http://manifest.my-brilliant.info/multiple_car_quote_mail_preview?event_id=1106');
            // set HTTP response headers
            /*
              header("Content-Type: application/pdf");
              header("Cache-Control: max-age=0");
              header("Accept-Ranges: none");
              header("Content-Disposition: attachment; filename=\"{$output_file}\"");
             */
            $tempPath = _PATH . "var/quotes_pdf/";
            $pdf_file_name = $filename . '.pdf';

            $output_file = $tempPath . $pdf_file_name;


            $out_file = fopen($output_file, "wb");
            $client->convertHtml($content, $out_file);
            fclose($out_file);
            return $content;
        } catch (PdfcrowdException $why) {
            return "Pdfcrowd Error: " . $why;
        }
    }

    public static function renderFleet($data, $id) {
        $return = '';


        foreach ($data as $each_data) {
            $vehicle_image = helper::vehicleImage($each_data['image'] ? $each_data['image'] : 'no_image.gif');
            $selectedValue = $each_data['id'] == $id ? 'selected' : "";
            $return[] = "<option data-icon='{$vehicle_image}' value='{$each_data['id']}' data-minhour='{$each_data['hourly_minimum']}' data-rate='{$each_data['price']}' {$selectedValue}>{$each_data['vehicle_name']}</option>";
        }
        return implode("", $return);
    }

    public static function getCarName($id) {
        $data = qs("select vehicle_name from fleet where id = '{$id}' ");
        if (!empty($data)) {
            return $data['vehicle_name'];
        }
        return !empty($data) ? $data['vehicle_name'] : "VEHICLE";
    }

    public static function getDefaultCoverText() {
        $defaultText = file_get_contents(_PATH . 'instance/front/tpl/defaultCoverLetter.php');
        $search = array('[FIRST_NAME]', '[COMPANY_NAME]');
        $replace = array($_SESSION['user']['first_name'], tenant::_name());
        $defaultText = str_replace($search, $replace, $defaultText);
        return ($defaultText);
    }

    public static function getDefaultSubject() {
        return tenant::_name() . ': Your default proposal is attached';
    }
    
    public static function _api_log($array,$type){
        $data = array();
        $data['payload'] = json_encode($array);
        $data['log_type'] = $type;
        $data = _escapeArray($data);
        qi("api_logs",$data);
        
    }

}

?>
