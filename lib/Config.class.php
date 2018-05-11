<?php

/**
 * Config Class
 * 
 * Class to handle config operations
 * 
 * @author Hardik Panchal 
 * @version 1.0
 * @package Whozoor
 * 
 */
class Config {

    /**
     * Mechanism to access variable globally
     * @var Array $_vars
     */
    public static $_vars = array();
    
    public static $from_ios = 0;


    # constructor

    public function __construct() {
        
    }

    

    public static function Getdata() {
        return qs("SELECT * FROM config");
    }


}

?>