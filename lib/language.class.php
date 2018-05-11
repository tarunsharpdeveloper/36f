<?php

/**
 *  Class file to provide core
 *  functions for API Calls
 * 
 *  i.e. 
 *  Curl requests
 *  Handling SOAP Calls
 *  Handling XML Responses
 *  Handling JSON Responses
 *  
 * @author hardikpanchal469@gmail.com
 * @since October 28, 2013
 * @version 1.0
 * 
 * 
 */
class language {

    public function __construct() {
        
    }

    public static function getLanguageText($language = 'en') {
        if ($language == 'fa') {
            $lang_data = q("select `id`,lang_persian as lang_text from language");
        } else {
            $lang_data = q("select `id`,lang_english as lang_text from language");
        }
        $lang_text = self::setLanguageKeyPair($lang_data);
        return $lang_text;
    }

    public static function setLanguageKeyPair($lang_data) {
        foreach ($lang_data as $each_text) {
            $lang_text[$each_text['id']] = $each_text['lang_text'];
        }
        return $lang_text;
    }

    public static function leave_status($type) {
        $status = array();
        $status['new_request'] = "در انتظار";
        $status['new_requested'] = "در انتظار";
        $status['accept'] = "تایید شده";
        $status['reject'] = "رد شده";
        $status['cancel'] = "رد شده";
        return _e($status[strtolower($type)], $type);
    }

    public static function timesheet_status($type) {
        $status = array();
        $status['0'] = "در انتظار";
        $status['1'] = "تایید شده";
        $status['2'] = "رد شده";
        return _e($status[strtolower($type)], $type);
    }

    public static function transportation_type($type) {
        $status = array();
        $status['taxi'] = "تاکسی";
        $status['bus'] = "اتوبوس";
        $status['train'] = "قطار";
        $status['plane'] = "هواپیما";
        $status['ajans'] = "آژانس";
        $status['brt'] = "اتوبوس";
        $status['metro'] = "مترو";
        $status['personal car'] = "خودرو شخصی";
        return _e($status[strtolower($type)], $type);
    }

    public static function transportation_type_id($type) {
        $status = array();
        $status['taxi'] = "1";
        $status['bus'] = "2";
        $status['train'] = "3";
        $status['plane'] = "4";
        $status['ajans'] = "5";
        $status['brt'] = "6";
        $status['metro'] = "7";
        $status['personal car'] = "8";
        return _e($status[strtolower($type)], $type);
    }

    public static function food_auth($type) {
        $status = array();
        $status['yes'] = "بله";
        $status['no'] = "خیر";
        return _e($status[strtolower($type)], $type);
    }

}

?>
