<?php

/**
 * Database Class
 * 
 * Normal DB class with singleton pattern
 * 
 * @author Dave Jay <dave.jay90@gmail.com>
 * @version 1.0
 * @package IvrTree
 * 
 */
class Db {
    # holds singleton object

    private static $db;
    # holds link
    public $_link;

    # constructor

    public function __construct() {
        $this->_link = mysqli_connect(DB_HOST, DB_UNAME, DB_PASSWORD, DB_NAME) or trigger_error('db error', 1024);

        mysqli_query($this->_link, "SET NAMES 'utf8'");
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
        if ($res = mysqli_query($this->_link, $query))
            return $res;
        else {
            d(mysqli_error($this->_link));
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
        return mysqli_affected_rows($db->_link);
    }

    /**
     * wrapper function for update query
     * @author Dave Jay <dave.jay90@gmail.com>
     * @param String $table
     * @param Array $array list of fields
     * @param String $where where condition
     * @return Integer return number rows updated
     * @package Aerus
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
          
            $db->query($query);

            return mysqli_affected_rows($db->_link);
        }
        return false;
    }

    /**
     * wrapper function for insert query
     * @author Dave Jay <dave.jay90@gmail.com>
     * @param String $table
     * @param Array $array list of fields

     * @return Integer return number rows inserted
     * @package Aerus
     * 
     */
    function insert_query($table, $fields, $operation = 'INSERT') {

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
            return mysqli_insert_id($db->_link);
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
    public function format_data($result, $field = NULL, $second_field = NULL, $third_field = NULL) {
        $data_array = array();
        if ($result) {
            while ($array = mysqli_fetch_assoc($result)) {
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