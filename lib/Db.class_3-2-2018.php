<?php

/**
 * Database Class
 * 
 * Normal DB class with singleton pattern
 * 
 * @author Hardik Panchal 
 * @version 1.0
 * @package Whozoor
 * 
 */
class Db {
    # holds singleton object

    private static $db;
    # holds link
    public $_link;


    # constructor

    public function __construct() {
        $this->_link = mysql_connect(DB_HOST, DB_UNAME, DB_PASSWORD) or trigger_error(mysql_error(), 1024);
        mysql_select_db(DB_NAME) or trigger_error(mysql_error(), 1024);
        mysql_query("SET NAMES 'utf8'");
    }

    /**
     * A Singleton pattern
     * to prevent multiple use of db
     * @return object 
     */
    public static function __d() {
        if (!isset($db)) {
            self::$db = new Db();
        }
        return self::$db;
    }

    /**
     * Wrapper function for db
     * @param String $query
     * @return resource
     */
    public function query($query) {
        if ($res = mysql_query($query))
            return $res;
        else {
            d(mysql_error());
            back_trace();
            d($query);
            exit;
        }
    }

    /**
     * Wrapper function to delete
     * @param String $table
     * @param String $condition
     * @return integer 
     */
    function delete_query($table, $condition) {
        $db = Db::__d();
        $db->query("delete from {$table} where {$condition} ");
        if (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] > 0) {
            unset($_SESSION['log_delete']);
            $_SESSION['log_delete'] = '';
            $_SESSION['log_delete'] = "delete from {$table} where {$condition} ";
        }
        return mysql_affected_rows();
    }

    /**
     * wrapper function for update query
     * @author Hardik Panchal 
     * @param String $table
     * @param Array $array list of fields
     * @param String $where where condition
     * @return Integer return number rows updated
     * @package Whozoor
     * 
     */
    function update_query($table, $fields, $condition) {
        $db = Db::__d();

        if (!empty($fields)) {
            $set_string = array();
            $fields['modified_at'] = _mysqlDate();

            foreach ($fields as $field_name => $field_value) {
                $set_string[] = "  `{$field_name}` = '{$field_value}'  ";
            }
            $set_string = implode(",", $set_string);
            $query = " update {$table} set {$set_string} where {$condition} ";
            if (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] > 0) {
                unset($_SESSION['log_update']);
                $_SESSION['log_update'] = '';
                $_SESSION['log_update'] = $query;
            }
            $db->query($query);

            return mysql_affected_rows();
        }
        return false;
    }

    /**
     * wrapper function for insert query
     * @author Hardik Panchal 
     * @param String $table
     * @param Array $array list of fields

     * @return Integer return number rows inserted
     * @package Whozoor
     * 
     */
    function insert_query($table, $fields, $operation='INSERT') {

        $db = Db::__d();

        if (!empty($fields)) {
            $value_string = array();
            $fields['created_at'] = $fields['modified_at'] = _mysqlDate();

            foreach ($fields as $field_name => $field_value) {
                $value_string[] = " '{$field_value}' ";
            }

            $fields_string = " ( `" . implode("`, `", array_keys($fields)) . "` ) ";

            $value_string = " ( " . implode(",", $value_string) . " ) ";

            $query = " {$operation} INTO {$table} {$fields_string} values {$value_string}";
            $db->query($query);

            return mysql_insert_id();
        }
        return false;
    }

    /**
     *
     * @param Resource $result
     * @param string $field
     * @param string $second_field
     * @param type $third_field
     * @return type 
     */
    public function format_data($result, $field=NULL, $second_field=NULL, $third_field=NULL) {
        $data_array = array();
        if ($result) {
            while ($array = mysql_fetch_assoc($result)) {
                $t = array();
                foreach ($array as $field_name => $value) {
                    //$t[$field_name] = utf8_encode($value);				
                    $t[$field_name] = ($value);
                }
                if (isset($field)) {
                    if (isset($second_field)) {
                        if (isset($third_field)) {
                            $data_array[$t[$field]][$t[$second_field]][$t[$third_field]][] = $t;
                        } else {
                            $data_array[$t[$field]][$t[$second_field]][] = $t;
                        }
                    } else {
                        $data_array[$t[$field]][] = $t;
                    }
                } else {
                    $data_array[] = $t;
                }
            }
        }
        return $data_array;
    }

}

?>