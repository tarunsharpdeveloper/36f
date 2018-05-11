<?php

/**
 *  for the OT settings
 *  AB-73
 * 
 *  need to check 
 * - if enabled or not ?
 * - if enabled then total pre and total post
 * - and then need to check for daily limit
 * 
 * 
 */
$settings_ot_auth_main = $_REQUEST['ot_auth_main'];
$settings_ot_auth_prior = $_REQUEST['ot_auth_prior'];
$settings_ot_auth_post = $_REQUEST['ot_auth_post'];
$settings_ot_auth_prior_total = $_REQUEST['ot_auth_prior_total'];
$settings_ot_auth_post_total = $_REQUEST['ot_auth_post_total'];
$settings_ot_auth_daily_max = $_REQUEST['ot_auth_daily_max'];


$total_ot_prior = 0; // applied ot (i.e. subtracted from the limit)
$total_ot_post = 0; // applied ot (i.e. subtracted from the limit)

$total_exceeded_ot_prior = 0;
$total_exceeded_ot_post = 0;

$total_ot = 0;
$total_exceeded_ot = 0;
$daily_ot_exceeded = 0;
$daily_ot_applied = 0;

$ot_scenario_applied = "NO_OT";
$ot_approved_seconds = "0";

$earlyCheckinSeconds = $lateCheckoutSeconds = 0;
$earlyCheckinSeconds = $staticCheckin - strtotime($val['CHECKEDIN']);
$lateCheckoutSeconds = strtotime($val['CHECKOUT']) - $staticCheckOut;

if ($settings_ot_auth_main == 'yes') {

    // no max is set - meaning - everything is OT - yay!
    
    if ($_REQUEST['ot_auth_no_max'] == '1') {
        $ot_approved_seconds = $earlyCheckinSeconds + $lateCheckoutSeconds;
        $ot_scenario_applied = "OT_APPLIED";
        $total_ot_prior = $earlyCheckinSeconds;
        $total_ot_post = $lateCheckoutSeconds;
    } else {
        // else check for the daily max or pre/post settings
        // check for early checkin
        if ($earlyCheckin == "Yes") {

            $settings_ot_auth_prior_total_seconds = $settings_ot_auth_prior_total * 60;

            if ($settings_ot_auth_prior_total_seconds > $earlyCheckinSeconds) {
                // meaning - Within TotalOT
                $ot_scenario_applied = "OT_APPLIED";
                $total_exceeded_ot_prior = 0;
                $total_ot_prior = $earlyCheckinSeconds;
            } else {
                $ot_scenario_applied = "OT_APPLIED";
                $total_exceeded_ot_prior = $earlyCheckinSeconds - $settings_ot_auth_prior_total_seconds;
                $total_ot_prior = $settings_ot_auth_prior_total_seconds;
            }
        }



        if ($lateCheckout == "Yes") {

            $settings_ot_auth_post_total_seconds = $settings_ot_auth_post_total * 60;

            if ($settings_ot_auth_post_total_seconds > $lateCheckoutSeconds) {
                // meaning - Within TotalOT
                $ot_scenario_applied = "OT_APPLIED";
                $total_ot_post = $lateCheckoutSeconds;
                $total_exceeded_ot_post = 0;
            } else {
                $ot_scenario_applied = "OT_APPLIED";
                $total_exceeded_ot_post = $lateCheckoutSeconds - $settings_ot_auth_post_total_seconds;
                $total_ot_post = $settings_ot_auth_post_total_seconds;
            }
        }

        $total_ot = $total_ot_post + $total_ot_prior;
        $total_exceeded_ot = $total_exceeded_ot_post + $total_exceeded_ot_prior;


        $settings_ot_auth_daily_max_seconds = $settings_ot_auth_daily_max * 60;

        //$ot_approved_seconds = 0; //used into the approved hours calculation

        if ($settings_ot_auth_daily_max > 0) {
            d("in");
            $ot_scenario_applied = "OT_APPLIED";
            if (($earlyCheckinSeconds + $lateCheckoutSeconds) > $settings_ot_auth_daily_max_seconds) {
                $daily_ot_exceeded = ($earlyCheckinSeconds + $lateCheckoutSeconds) - $settings_ot_auth_daily_max_seconds;
                $daily_ot_applied = $settings_ot_auth_daily_max_seconds;
            } else {
                $daily_ot_applied = ($earlyCheckinSeconds + $lateCheckoutSeconds);
            }
            $ot_approved_seconds = $daily_ot_applied;
            $total_ot_post = $total_exceeded_ot_prior = $total_exceeded_ot_post = 0;
        } else {
            $ot_approved_seconds = $total_ot_post + $total_ot_prior;
        }
    }



    // add the logic for the ot mins.
    // we shall first start with the daily things
    $ot_mins_message = "";
    // if min ot is enabled
    // check for daily

    if ($_REQUEST['ot_auth_daily_min'] > 0) {
        if ($ot_approved_seconds < ($_REQUEST['ot_auth_daily_min'] * 60)) {
            $ot_scenario_applied = "OT_APPLIED";
            // aha - no ot should be applied - because - ot mins is in effect
            $ot_mins_message = "did not meet min daily - " . calcDiffFromSeconds($ot_approved_seconds,'formated');
            $daily_ot_applied = 0;
            $ot_approved_seconds = 0;
            $total_ot_post = $total_ot_prior = 0; 
            //$total_ot_post = $total_ot_prior = $total_exceeded_ot_prior = $total_exceeded_ot_post = 0;
        }
    } else {
        
        if ($lateCheckoutSeconds < ($_REQUEST['ot_auth_post_total_min'] * 60)) {
            $ot_scenario_applied = "OT_APPLIED";
            $total_ot_post = 0;
            $ot_mins_message = "did not meet min post - " . calcDiffFromSeconds($lateCheckoutSeconds,'formated');
            $ot_approved_seconds = $total_ot_post + $total_ot_prior;
        }
        if ($earlyCheckinSeconds < ($_REQUEST['ot_auth_prior_total_min'] * 60)) {
            $ot_scenario_applied = "OT_APPLIED";
            $total_ot_prior = 0;
            $ot_mins_message .= "<br />did not meet min prior - " . calcDiffFromSeconds($earlyCheckinSeconds,'formated');
            $ot_approved_seconds = $total_ot_post + $total_ot_prior;
        }
    }
}