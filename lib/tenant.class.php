<?php

class tenant {

    public static function logged_user_id() {
        return $_SESSION['user']['employee_id'];
    }

    public static function current_id() {
        return $_SESSION['user']['tenant_id'];
    }

    public static function loadUser($user_id) {
        $user_id = _escape($user_id);
        $user_data = qs("SELECT * FROM employee WHERE id='{$user_id}' ");
        $_SESSION['user'] = $user_data;
        $_SESSION['user']['id'] = $user_data['tenant_id'];
        $_SESSION['user']['employee_id'] = $user_data['id'];
    }

    function getUserIdFromEmail($email) {
        $email = _escape($email);
        $user = qs("select id from users where email = '{$email}' ");
        return empty($user) ? "-1" : $user['id'];
    }

    public static function onboard_fleet_added() {
        $current_tenant = $_SESSION['user']['tenant_id'];
        $count = qs("select count(id) as total_data from fleet where tenant_id = '{$current_tenant}' ");
        return $count['total_data'] > 0 ? true : false;
    }

    public static function onboard_prices_added() {
        $current_tenant = $_SESSION['user']['tenant_id'];
        $count = qs("select count(id) as total_data from prices where tenant_id = '{$current_tenant}' ");
        return $count['total_data'] > 0 ? true : false;
    }

    public static function onboard_team_added() {
        $current_tenant = $_SESSION['user']['tenant_id'];
        $count = qs("select count(id) as total_data from employee where tenant_id = '{$current_tenant}' ");
        return $count['total_data'] > 1 ? true : false;
    }

    public static function onboard_quote_added() {
        $current_tenant = $_SESSION['user']['tenant_id'];
        $count = qs("select count(id) as total_data from quote where tenant_id = '{$current_tenant}' ");
        return $count['total_data'] > 0 ? true : false;
    }

    public static function loadTenant($tenant_id) {
        $tenant_data = qs("select * from tenant where id = '{$tenant_id}' ");
        if (!empty($tenant_data)) {
            return $_SESSION['tenant'] = $tenant_data;
        } else {
            return FALSE;
        }
    }

    public static function _name() {
        return $_SESSION['tenant']['company_name'] ? $_SESSION['tenant']['company_name'] : "Your Organization";
    }

    public static function _fleet_types() {
        $tenant_id = tenant::current_id();
        $data = q("select * From fleet_types where tenant_id = '{$tenant_id}' ");
        return $data;
    }

    public static function getFleet() {
        $tenant_id = tenant::current_id();
        $data = q("select * from fleet where tenant_id = '{$tenant_id}' ");
        return $data;
    }

    public static function _logo() {
        return $_SESSION['tenant']['company_logo'] ? $_SESSION['tenant']['company_logo'] : "no-logo.jpg";
    }

    public static function _website() {
        return $_SESSION['tenant']['company_website'];
    }

    public static function _address() {
        return $_SESSION['tenant']['company_address'];
    }

    public static function _email() {
        return $_SESSION['tenant']['email'];
    }

    public static function _phone() {
        return formatCell(clearNumber($_SESSION['tenant']['company_phone']));
    }

    public static function _bg_color() {
        return $_SESSION['tenant']['template_default_header_color'] ? "#" . $_SESSION['tenant']['template_default_header_color'] : "#24BC10";
    }

}
