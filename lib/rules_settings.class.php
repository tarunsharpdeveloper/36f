<?php

class rules_settings {

    public function __construct() {
        
    }

    public static function get_rules($type, $company_id = 0) {
        $data = qs("select * from   settings_leave_master where short_code = '{$type}' and company_id = '{$company_id}' ");
        return empty($data) ? array() : $data;
    }

}
