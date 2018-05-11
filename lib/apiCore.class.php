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
class apiCore {

    public function doCall($url) {
        $ch = curl_init();
        $timeout = 5;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0');
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function prepareApiUrl() {
        $params = array();
        foreach ($this->params as $option => $value) {
            $params[] = "{$option}=" . urlencode($value);
        }
        return $this->apiURL . $this->apiEndpoint . "?" . (implode("&", $params));
    }

    public function doPostCall($url, $body) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        $output = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);
        return $output;
    }

    public function doJSONCall($url, $body) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);

        $output = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($output, 0, $header_size);
        $body = substr($output, $header_size);

        curl_close($ch);
        return array($output, $body, $header);
    }

    public function doFormCall($url, $body) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $output = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);

        curl_close($ch);
        if ($errno != '0') {
            writeLog("Error Code: " . $errno . "\nError: " . $error);
        }
        return $output;
    }

    public function doFileCall($url, $filedata, $filename) {
        echo "DoFileCall Running";
//        $headers = array("Content-Type:multipart/form-data"); // cURL headers for file uploading
        $postfields = array("filedata" => "@$filedata", "filename" => $filename);
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => true,
            CURLOPT_POST => 1,
//            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_INFILESIZE => $filesize,
            CURLOPT_RETURNTRANSFER => true
        ); // cURL options
        curl_setopt_array($ch, $options);

//        curl_exec($ch);
        $output = curl_exec($ch);
        echo $output;

        $errno = curl_errno($ch);
        $error = curl_error($ch);

        curl_close($ch);
        if ($errno != '0') {
            writeLog("Error Code: " . $errno . "\nError: " . $error);
        }
        return $output;
    }
    
    public function doFileCallNew($url, $body) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

}

?>
