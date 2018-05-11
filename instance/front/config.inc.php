<?php

# Commit Test
//error_reporting(E_ALL);
/*
  $auth_pages = array();
  $auth_pages[] = "home";
  $auth_pages[] = "user_entry";
  $auth_pages[] = "language";
  $auth_pages[] = "manager";
  $auth_pages[] = "station1";
  $auth_pages[] = "station2";
  $auth_pages[] = "station2_vehical";
  $auth_pages[] = "station2_vehical_submit";
  $auth_pages[] = "station3";
  $auth_pages[] = "station4";
  $auth_pages[] = "station5";
  $auth_pages[] = "contract_page";
  $auth_pages[] = "view_contract_page";
  $auth_pages[] = "edit_contract_page";
  $auth_pages[] = "master_dashboard";
  $auth_pages[] = "master_station";
  $auth_pages[] = "completed_driver";
  $auth_pages[] = "rejected_vehicle";
  $auth_pages[] = "rejected_driver";
  $auth_pages[] = "cs-dashboard";
  $auth_pages[] = "departments";
  $auth_pages[] = "tickets";
  $auth_pages[] = "admin_add_office";
  $auth_pages[] = "test_timeoff";
  $auth_pages[] = "test_add_shift";
 */
$auth_pages = array();
$auth_pages[] = 'login';
$auth_pages[] = 'forgot_password';
$auth_pages[] = 'onboarding';
$auth_pages[] = 'api';
$auth_pages[] = 'apiTest';

if ($_REQUEST['logout']) {
    User::killSession();
}

_auth_url($auth_pages, "login");
?>