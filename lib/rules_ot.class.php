<?php

class rules_ot {

    public static $is_ot_allowed;
    public static $monthly_max_monthly_allowed;
    public static $monthly_max_monthly_allowed_value;
    public static $daily_ot_min_type;
    public static $daily_ot_min_ent_day;
    public static $daily_ot_min_seperate_prior;
    public static $daily_ot_min_seperate_post;
    public static $daily_ot_max_type;
    public static $daily_ot_max_ent_day;
    public static $daily_ot_max_seperate_prior;
    public static $daily_ot_max_seperate_post;

    public function __construct() {
        # initiate the values with default
        rules_ot::$is_ot_allowed = 'no';
        rules_ot::$monthly_max_monthly_allowed = 'no';
        rules_ot::$monthly_max_monthly_allowed_value = 0;
        rules_ot::$daily_ot_min_type = 'nomin';
        rules_ot::$daily_ot_min_ent_day = '0';
        rules_ot::$daily_ot_min_seperate_prior = '0';
        rules_ot::$daily_ot_min_seperate_post = '0';
        rules_ot::$daily_ot_max_type = 'nomin';
        rules_ot::$daily_ot_max_ent_day = '0';
        rules_ot::$daily_ot_max_seperate_prior = '0';
        rules_ot::$daily_ot_max_seperate_post = '0';
    }

    # check /ot_settings page

    public static function getOTSettings($company_id = 0) {
        $ot_data = rules_settings::get_rules("AUTH_OT", $company_id);

        if (empty($ot_data)) {
            return;
        }
        # overall
        rules_ot::$is_ot_allowed = $ot_data['value_1']; //AUTH
        # Monthly
        rules_ot::$monthly_max_monthly_allowed = $ot_data['value_2']; // PER_MONTH
        rules_ot::$monthly_max_monthly_allowed_value = $ot_data['value_3']; //TXT_MONTH
        #Min daily
        rules_ot::$daily_ot_min_type = $ot_data['value_4']; //it could be "nomin", "sep" "entday"
        if (rules_ot::$daily_ot_min_type == 'entday') {
            rules_ot::$daily_ot_min_ent_day = $ot_data['value_5']; //only if $daily_ot_min_type is 'entday'
        }
        if (rules_ot::$daily_ot_min_type == 'sep') {
            rules_ot::$daily_ot_min_seperate_prior = $ot_data['value_5']; //only if $daily_ot_min_type is 'sep'
            rules_ot::$daily_ot_min_seperate_post = $ot_data['value_6']; //only if $daily_ot_min_type is 'sep'  
        }

        #Max Daily
        rules_ot::$daily_ot_max_type = $ot_data['value_7']; //it could be "nomin", "sep" "entday"
        if (rules_ot::$daily_ot_max_type == 'entday') {
            rules_ot::$daily_ot_max_ent_day = $ot_data['value_8']; //only if $daily_ot_min_type is 'entday'
        }
        if (rules_ot::$daily_ot_max_type == 'sep') {
            rules_ot::$daily_ot_max_seperate_prior = $ot_data['value_8']; //only if $daily_ot_min_type is 'sep'
            rules_ot::$daily_ot_max_seperate_post = $ot_data['value_9']; //only if $daily_ot_min_type is 'sep'
        }

        rules_ot::convertToSeconds();
    }

    public static function convertToSeconds() {
        rules_ot::$monthly_max_monthly_allowed_value = min2sec(rules_ot::$monthly_max_monthly_allowed_value);
        rules_ot::$daily_ot_min_ent_day = min2sec(rules_ot::$daily_ot_min_ent_day);
        rules_ot::$daily_ot_min_seperate_prior = min2sec(rules_ot::$daily_ot_min_seperate_prior);
        rules_ot::$daily_ot_min_seperate_post = min2sec(rules_ot::$daily_ot_min_seperate_post);
        rules_ot::$daily_ot_max_ent_day = min2sec(rules_ot::$daily_ot_max_ent_day);
        rules_ot::$daily_ot_max_seperate_prior = min2sec(rules_ot::$daily_ot_max_seperate_prior);
        rules_ot::$daily_ot_max_seperate_post = min2sec(rules_ot::$daily_ot_max_seperate_post);
    }

    public static function doCalc($shift_id, $shift_logged_start_time = 0, $shift_logged_end_time = 0, $published_start_time = 0, $published_end_time = 0, $total_worked_time = 0, $total_scheduled_time = 0) {

        $return = array();
        $return['total_ot_approved'] = 0;

        if ($total_worked_time == 0) {
            return $return;
        }

        $published_shift_data = shift::get_published_shift_data($shift_id);

        # this is on-demand shift - then no ot
        if (empty($published_shift_data)) {
            return $return;
        }

        $company_id = employee::getCompanyIdFromShiftId($shift_id);

        # set the rules
        rules_ot::getOTSettings($company_id);

        # if auth is not allowed then just return
        if (rules_ot::$is_ot_allowed != 'yes') {
            return $return;
        }

        $published_shift_start_time = $published_start_time == 0 ? strtotime("{$published_shift_data['start_date']} {$published_shift_data['start_time']}") : $published_start_time;
        $published_shift_end_time = $published_end_time == 0 ? strtotime("{$published_shift_data['end_date']} {$published_shift_data['end_time']}") : $published_end_time;

        $shift_start_time = $shift_logged_start_time == 0 ? strtotime(shift::get_first_checkin_time($shift_id)) : $shift_logged_start_time;
        $shift_end_time = $shift_logged_end_time == 0 ? strtotime(shift::get_last_shift_log_time($shift_id)) : $shift_logged_end_time;

        $total_published_shift_time = $total_scheduled_time == 0 ? shift::hisToSeconds($published_shift_data['total_hour']) : $total_scheduled_time;

        $total_pre_ot = 0;
        $total_post_ot = 0;
        $total_ot = 0;

        // calc total ot
        if (intval($total_worked_time) > intval($total_published_shift_time)) {
            $total_ot = intval($total_worked_time) - intval($total_published_shift_time);
        }

        // calc total pre ot - for the sep ot considerations
        if ($shift_start_time < $published_shift_start_time) {
            $total_pre_ot = $shift_start_time - $published_shift_start_time;
        }

        // calc total post ot - for the sep ot considerations
        if ($shift_end_time > $published_shift_end_time) {
            $total_post_ot = $shift_end_time - $published_shift_end_time;
        }

        $total_ot = $total_pre_ot + $total_post_ot;

        # if not ot then - good - just return
        if ($total_ot == 0) {
            return $return;
        } else {
            # first check - if min ot is enabled 

            if (rules_ot::$daily_ot_min_type != 'nomin') {
                # if nomin is enabled - then no need to check entday or sep
                if (rules_ot::$daily_ot_min_type == 'entday') {
                    if ($total_ot < rules_ot::$daily_ot_min_ent_day) {
                        # so total OT falls below the entday min. ot
                        return $return;
                    }
                }
                # usecase for seperate
                if (rules_ot::$daily_ot_min_type == 'sep') {
                    # if min pre ot is less than allowed-  then set the min ot to 0
                    if ($total_pre_ot < rules_ot::$daily_ot_min_seperate_prior) {
                        //$total_pre_ot = 0;
                        # min - the min. ot is no matched so the pre ot doesn't count for total ot
                        $total_ot = $total_ot - $total_pre_ot;
                    }
                    if ($total_post_ot < rules_ot::$daily_ot_min_seperate_post) {
                        # if min post ot is less than allowed-  then set the min ot to 0
                        $total_ot = $total_ot - $total_post_ot;
                    }
                }
            }

            if (rules_ot::$daily_ot_max_ent_day != 'nomin') {
                # if nomin is enabled - then no need to check entday or sep
                if (rules_ot::$daily_ot_max_type == 'entday') {
                    if ($total_ot > rules_ot::$daily_ot_max_ent_day) {
                        # so total OT falls below the entday min. ot
                        $return['total_ot_approved'] = rules_ot::$daily_ot_max_ent_day;
                        return $return;
                    }
                }
                # usecase for seperate
                if (rules_ot::$daily_ot_max_type == 'sep') {
                    # if min pre ot is less than allowed-  then set the min ot to 0
                    if ($total_pre_ot > rules_ot::$daily_ot_max_seperate_prior) {
                        $total_ot = $total_ot - ($total_pre_ot - rules_ot::$daily_ot_max_seperate_prior);
                    }
                    if ($total_post_ot > rules_ot::$daily_ot_max_seperate_post) {
                        # if min post ot is less than allowed-  then set the min ot to 0
                        $total_ot = $total_ot - ($total_post_ot - rules_ot::$daily_ot_max_seperate_post);
                    }
                    
                    $return['total_ot_approved'] = $total_ot;
                    return $return;
                }
            }
        }
        $return['total_ot_approved'] = $total_ot;



        return $return;
    }

}
