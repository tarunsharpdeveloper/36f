<?php

class rules_badboy {

    public static $is_la_allowed;
    public static $la_tolerance_minutes;
    public static $la_truancy_exceeds_tolerance;
    public static $is_ed_allowed;
    public static $ed_tolerance_minutes;
    public static $ed_truancy_exceeds_tolerance;

    public function __construct() {
        rules_badboy::$is_la_allowed = 'no';
        rules_badboy::$la_tolerance_minutes = '0';
        rules_badboy::$la_truancy_exceeds_tolerance = 'entire';
        rules_badboy::$is_ed_allowed = 'no';
        rules_badboy::$ed_tolerance_minutes = '0';
        rules_badboy::$ed_truancy_exceeds_tolerance = 'entire';
    }

    public static function getBadBoySettings($company_id = 0) {
        $la_data = rules_settings::get_rules("LATE_ARRIVAL_SETTINGS", $company_id);
        $ed_data = rules_settings::get_rules("EARLY_DEPARTURE_SETTINGS", $company_id);

        if (!empty($la_data)) {
            rules_badboy::$is_la_allowed = $la_data['value_1']; // LA_ALLOWED;
            rules_badboy::$is_la_allowed = $la_data['value_2']; // LA_TOLERANCE_MINUTES;
            rules_badboy::$la_truancy_exceeds_tolerance = $la_data['value_3']; //LA_TRUANCY_EXCEEDS_TOLERANCE
        }

        if (!empty($ed_data)) {
            rules_badboy::$is_ed_allowed = $ed_data['value_1']; // ED_ALLOWED;
            rules_badboy::$ed_tolerance_minutes = $ed_data['value_2']; // ED_TOLERANCE_MINUTES;
            rules_badboy::$ed_truancy_exceeds_tolerance = $ed_data['value_3']; //ED_TRUANCY_EXCEEDS_TOLERANCE
        }

        rules_badboy::convertToSeconds();
    }

    public static function convertToSeconds() {
        rules_badboy::$la_tolerance_minutes = min2sec(rules_badboy::$la_tolerance_minutes);
        rules_badboy::$ed_tolerance_minutes = min2sec(rules_badboy::$ed_tolerance_minutes);
    }

    public static function doCalc($shift_id, $shift_logged_start_time, $shift_logged_end_time, $published_start_time, $published_end_time) {
        $return = array();
        $return['total_late_arrival'] = 0;
        $return['total_early_departure'] = 0;

        $published_shift_data = shift::get_published_shift_data($shift_id);

        # this is on-demand shift - then no ot
        if (empty($published_shift_data)) {
            return $return;
        }

        $published_shift_start_time = $published_start_time == 0 ? strtotime("{$published_shift_data['start_date']} {$published_shift_data['start_time']}") : $published_start_time;
        $published_shift_end_time = $published_end_time == 0 ? strtotime("{$published_shift_data['end_date']} {$published_shift_data['end_time']}") : $published_end_time;

        $shift_start_time = $shift_logged_start_time == 0 ? strtotime(shift::get_first_checkin_time($shift_id)) : $shift_logged_start_time;
        $shift_end_time = $shift_logged_end_time == 0 ? strtotime(shift::get_last_shift_log_time($shift_id)) : $shift_logged_end_time;

        $company_id = employee::getCompanyIdFromShiftId($shift_id);

        # set the rules
        rules_badboy::getBadBoySettings($company_id);

        if (rules_badboy::$is_la_allowed == 'yes') {
            
        }
        if (rules_badboy::$is_ed_allowed == 'yes') {
            
        }
    }

}
