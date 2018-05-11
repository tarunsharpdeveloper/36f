<?php
/**
 * Sage Live Data Handler
 *
 *
 * @package	gmi
 * @subpackage	helpers
 *
 * @copyright	GetMyInvoices
 */

class SageliveAuth {

	public static $instance_url = "https://simplessus-dev-ed.lightning.force.com";
	public static $oAuth_url = "https://login.salesforce.com/services/oauth2/";
	public static $redirect_uri = "";
    public static $version_url = "/services/data/v41.0/";
    public static $endPoint = "";
    public static $access_token = "";
    public static $refresh_token = "";
    public static $params = array();
    public static $noHeader = false;
    public static $method = "";
    public static $client_id = "";
    public static $client_secret = "";
    public static $sagelive_account_name = "";
    public static $sagelive_account_id = "";
	public static $sync_uid;

    /**
     * class constructor
     */
    public  function __construct() {
        //self::doSFAuth();
    }
	
	/**
	 * Validate user input
	 *
	 * @param	mixed	$_record
	 * @return	mixed
	 */
	public static function validate($_record) {
		
		$result = array();
		self::$sync_uid = isset($_record['sync_uid']) ? (int)$_record['sync_uid'] : 0;
		self::$access_token = isset($_record['sagelive_access_token']) ? trim(strip_tags_ext($_record['sagelive_access_token'])) : '';
		self::$refresh_token = isset($_record['sagelive_refresh_token']) ? trim(strip_tags_ext($_record['sagelive_refresh_token'])) : '';
		self::$sagelive_account_name = isset($_record['sagelive_account_name']) ? trim(strip_tags_ext($_record['sagelive_account_name'])) : '';
		self::$sagelive_account_id = isset($_record['sagelive_account_id']) ? trim(strip_tags_ext($_record['sagelive_account_id'])) : '';

		
		
		if ((self::$sync_uid == 0 && (self::$access_token == '' || self::$refresh_token == ''))) {
			$result = array(
				'Error' => true,
				'error_message' => $GLOBALS['i18']['error']['data_missing']
			);
		}

		return $result;
	}

	/**
	 * Pre save sync
	 * Here we will return those data which we want to save in sync details, except any tokens
	 *
	 * @param	mixed	$details
	 * @return	mixed
	 */
	public static function pre_save($details) {
		
		$details['data']['sagelive_account_name'] = self::$sagelive_account_name;
		$details['data']['sagelive_account_id'] = self::$sagelive_account_id;
		$details['data']['access_token'] = self::$access_token;
		$details['data']['refresh_token'] = self::$refresh_token;

		return $details;
	}

	/**
	 * Save handler
	 * Here we will prepare all data which we need to save in TR
	 *
	 * @return	mixed
	 */
	public static function save_handler() {
		$credential_record = array();

		if (self::$sync_uid == 0 || self::$access_token != '') {
			$credential_record['username'] = self::$access_token;
			$credential_record['password'] = self::$refresh_token;
			$credential_record['auth_token'] = self::$refresh_token;
		}

		return $credential_record;
	}	
	

    public static function doSFAuth() {
		self::$redirect_uri = $GLOBALS['config']['cms']['sage_live']['redirect_url'];
		self::$client_id = $GLOBALS['config']['cms']['sage_live']['client_id'];		
		self::$client_secret = $GLOBALS['config']['cms']['sage_live']['client_secret'];		
    }
	
	
	public static function init_oauth(){
		print $oAuth_url = self::$oAuth_url . "authorize";
		die;
		
		$params = array();
		$params['response_type'] = "code";
		$params['client_id'] = self::$client_id;
		$params['redirect_uri'] = self::$redirect_uri;
		$params['client_secret'] = self::$client_secret;
		
		$query_string = http_build_query($params);
		
		$url = "{$oAuth_url}?{$query_string}";
		
		header("Location: {$url}"); 
		exit();
	}
	
	public static function get_token($code){
		$oAuth_url = self::$oAuth_url . "token";
		
		$params = array();
		$params['grant_type'] = "authorization_code";
		$params['client_id'] = self::$client_id;
		$params['redirect_uri'] = self::$redirect_uri;
		$params['code'] =$code;
		
		$query_string = http_build_query($params);
		
		$url = "{$oAuth_url}?{$query_string}";
		
		self::$noHeader = true;
		self::$method = "POST";
		$data = self::doCall($url);
		self::$noHeader = false;
		return $data;
	}
	
	public static function setAccessData($token,$instance_url){
		self::$access_token = $token;
		self::$instance_url = $instance_url;
	}
	

    public static function doCall($url) {

        if(!self::$access_token && !self::$noHeader ){ 
			print ("ACCESS TOKEN HAS BEEN EXPIRED");
		}
		
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if (!self::$noHeader) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".self::$access_token, "Content-type: application/json"));
        }

        if (self::$method == "post") {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(self::$params));
        }
        if (self::$method == "post_plain") {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, self::$params);
        }

        if (in_array(self::$method, array('PATCH'))) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(self::$params));
        }
        if (in_array(self::$method, array('DELETE'))) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(self::$params));
        }


        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        $json_response = curl_exec($curl);
        self::$status = curl_getinfo($curl);
		$error = curl_error($curl);
	
        curl_close($curl);
        return $response = json_decode($json_response, true);
    }

    public static function getObjects() {
        self::$method = "GET";
        self::$endPoint = "sobjects/";
        $url = self::prepareURL();
        return self::doCall($url);
    }	
	
    public static function getObjectMetaData($objectName) {
        self::$method = "GET";
        self::$endPoint = "sobjects/{$objectName}/";
        $url = self::prepareURL();
        return self::doCall($url);
    }

    public static function getLayouts($objectName) {
        self::$method = "GET";
        self::$endPoint = "sobjects/{$objectName}/describe/layouts/";
        $url = self::prepareURL();
        return self::doCall($url);
    }

	#s2cor__Sage_FIN_Purchase_Invoice__c
	public static function pushSageInvoice($data){
		
		
		self::$params = $data;
        self::$endPoint = "sobjects/s2cor__Sage_INV_Trade_Document__c/";
        self::$method = "post";

        $url = self::prepareURL();
        return self::doCall($url);
	}
	
	public static function getSageInvoices(){
		
        /*self::$endPoint = "sobjects/s2cor__Sage_FIN_Purchase_Invoice__c/a140N0000084kv2QAA";
        self::$method = "get";
		

        $url = self::prepareURL();
        return self::doCall($url);*/
		
		$query = "Select Id,Name,CreatedDate,OwnerId,s2cor__Paid_Amount__c from s2cor__Sage_INV_Trade_Document__c";
		return self::doQuery($query);
	}	
	
	
	
	
	public static function get_account($data) {
        self::$params = $data;
        self::$endPoint = "sobjects/Account/";
        self::$method = "get";

        $url = self::prepareURL();
        return self::doCall($url);
    }
	
    public static function createAccount($data) {
        self::$params = $data;
        self::$endPoint = "sobjects/Account/";
        self::$method = "post";

        $url = self::prepareURL();
        return self::doCall($url);
    }

    public static function createCalllog($data) {
        self::$params = $data;
        self::$endPoint = "sobjects/Task/";
        self::$method = "post";

        $url = self::prepareURL();
        return self::doCall($url);
    }

    public static function getContact($id) {
        self::$params = array();
        self::$endPoint = "sobjects/Contact/{$id}";
        self::$method = "GET";

        $url = self::prepareURL();
        return self::doCall($url);
    }


    public static function getAccount($id) {
        self::$params = array();
        self::$endPoint = "sobjects/Account/{$id}";
        self::$method = "GET";

        $url = self::prepareURL();
        return self::doCall($url);
    }

    public static function createContact($data) {
        self::$params = $data;
        self::$endPoint = "sobjects/Contact/";
        self::$method = "post";

        $url = self::prepareURL();
        return self::doCall($url);
    }

   

    public static function doQuery($query) {
        self::$method = "GET";
        self::$endPoint = "query?q=" . urlencode($query);
        $url = self::prepareURL();
        return self::doCall($url);
    }

    public static function prepareURL() {
        return self::$instance_url . self::$version_url . self::$endPoint;
    }

}
?>