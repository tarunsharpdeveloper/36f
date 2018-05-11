<?php

$jsInclude = 'on_board.js.php';

if (isset($_REQUEST['saveCompInfo'])) {
    parse_str($_REQUEST['data'], $data);

    /**
     * [comp_name] => test
      [comp_phone] => etes
      [email] => test@test.com
      [comp_address] => test
      [comp_header_color] => test
      [comp_font_color] => test
     */
    $insert_data = array();
    $insert_data['company_name'] = $data['comp_name'];
    $insert_data['company_phone'] = $data["comp_phone"];
    $insert_data['company_address'] = $data["comp_address"];
    $insert_data['company_website'] = $data["comp_website"];
    $insert_data['template_default_header_color'] = $data["comp_header_color"];
    $insert_data['template_default_font_color'] = $data["comp_font_color"];

    $current_tenant = tenant::current_id();
    qu('tenant', $insert_data, " id = '{$current_tenant}'   ");

    # rebind session data
    tenant::loadTenant(tenant::current_id());
    die;
}
if (isset($_REQUEST['savePropInfo'])) {
    parse_str($_REQUEST['data'], $data);
    
    $insert_data = array();
    $insert_data['reply_to_email'] = $data['prop_reply_to_email'];
    $insert_data['reply_to_email_name'] = $data["prop_reply_to_email_label"];

    $current_tenant = tenant::current_id();
    qu('tenant', $insert_data, " id = '{$current_tenant}'   ");

    # rebind session data
    tenant::loadTenant(tenant::current_id());
    die;
}

if ($_REQUEST['email'] == 1) {
    d($_REQUEST);
    die;
}