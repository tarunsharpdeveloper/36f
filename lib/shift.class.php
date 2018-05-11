<?php

/**
 * shift Class
 * 
 * Class to shift related functions
 * 
 * @author Hardik Panchal 
 * @version 1.0
 * @package Whozoor
 * 
 */
class shift {

    public function __construct() {
        
    }

    # get the last status

    public static function get_shift_last_status($shift_id) {
        $data = qs("select type from tb_shift_check_inout where shiftid = '{$shift_id}' order by id desc limit 0,1 ");
        return empty($data) ? 'UNKNOWN' : $data['type'];
    }

    # get first checkin time from the shift id 

    public static function get_first_checkin_time($shift_id) {
        $first_check_in = qs("select timestamp from tb_shift_check_inout where shiftid = '{$shift_id}' order by id asc limit 0,1 ");
        return empty($first_check_in) ? time() : $first_check_in['timestamp'];
    }

    # get last entry from the shift log table

    public static function get_last_shift_log_time($shift_id) {
        $last_check_in = qs("select timestamp,type from tb_shift_check_inout where shiftid = '{$shift_id}' order by id desc limit 0,1 ");

        # if invalid shift id is passed - then just return the current time;
        if (empty($last_check_in)) {
            return date("Y-m-d H:i:s");
        }


        if ($last_check_in['type'] != 'CHECKOUT') {
            # that means, shift is live.
            # so lets return the current time stamp
            return date("Y-m-d H:i:s");
        }

        return $last_check_in['timestamp'];
    }

    # get total meeting time

    public static function get_current_meeting_time($shift_id) {
        # Logic: get the last BRIEFCASEOUT (meaning - went into the meeting);
        $meeting_start_timestamp = shift::_get_last_time_by_status($shift_id, 'BRIEFCASEOUT');

        # Logic: get the last BRIEFCASEIN (meaning - came from the meeting);
        $meeting_end_timestamp = shift::_get_last_time_by_status($shift_id, 'BRIEFCASEIN');

        #return the difference
        return $meeting_end_timestamp - $meeting_start_timestamp;
    }

    # get total lunch time

    public static function get_current_lunch_time($shift_id) {
        $lunch_start_timestamp = shift::_get_last_time_by_status($shift_id, 'LUNCHOUT');
        $lunch_end_timestamp = shift::_get_last_time_by_status($shift_id, 'LUNCHIN');

        return intval($lunch_end_timestamp) > 0 && intval($lunch_start_timestamp) > 0 ? $lunch_end_timestamp - $lunch_start_timestamp : '-1';
    }

    public static function _get_last_time_by_status($shift_id, $status) {
        $data = qs("select timestamp,type from tb_shift_check_inout where shiftid = '{$shift_id}' order by id desc limit 0,1 ");
        return empty($data) || $data['type'] != $status ? time() : strtotime($data['timestamp']);
    }

    # based upon the user id - please check - if the user does have the published shift 

    public static function has_published_shift($user_id, $date = '') {
        $date = $date == '' ? date("Y-m-d") : $date;
        //$data = qs("select * from  tb_assign_shift where user_id = '{$user_id}' and start_date = '{$date}' ");
        # There is one nice scenario now - user has a shift of 8-5
        # User logs in at 07:00 and logs out at 07:30
        # and again logs in at 09:00 - so that means - his assigned shift has been completed
        # so we have to check that -if the assigned shift has been completed or not

        $data = qs("select * from  tb_assign_shift where user_id = '{$user_id}' and start_date = '{$date}' and shift_status != 'completed' ");

        return empty($data) ? array() : $data;
    }

    # based upon the user id - please check - if the user does have on-demand shift 

    public static function has_on_demand_shift($user_id, $date = '') {
        $date = $date == '' ? date("Y-m-d") : $date;
        $data = qs("select * from   tb_shift_time where user_id = '{$user_id}' and date(sDate) = '{$date}' and end_time is null and assign_shift_id = '-1' ");
        return empty($data) ? array() : $data;
    }

    # determine, if shift is running right now or not

    public static function is_shift_running_now($shift_id) {
        $last_status = shift::get_shift_last_status($shift_id);
        return $last_status == 'CHECKOUT' || $last_status == 'TIMEOUTOUT'  ? false : true;
    }

    public static function is_having_live_shift($user_id, $date = '') {
        $date = $date == '' ? date("Y-m-d") : $date;
        $data = qs("select * from   tb_shift_time where user_id = '{$user_id}' and date(sDate) = '{$date}' and end_time is null ");
        return empty($data) ? array() : $data;
    }

    # whether employee is in office or field
    # take all the clock entry from last and start traversing
    # if the checkedin comes-  meaning in office
    # if bcout comes - meaning out of office

    public static function employee_in_office_or_metting($shift_id) {
        $data = q("select type from tb_shift_check_inout where shiftid='{$shift_id}'  ORDER BY id  DESC  ");
        $employee_status = 'clock'; # by default lets assume in office
        foreach ($data as $each_data) {
            if ($each_data['type'] == 'BRIEFCASEOUT') {
                $employee_status = 'briefcase';
                break;
            }
            if ($each_data['type'] == 'CHECKEDIN') {
                $employee_status = 'clock';
                break;
            }
        }
        return $employee_status;
    }

    # convert the 08:00:00 to seoncds

    public static function hisToSeconds($h_i_s) {
        return strtotime("1970-01-01 {$h_i_s} UTC");
    }

    # please check if the published shift has been started or not 

    public static function has_started_shift($assign_shift_id) {
        $data = qs("select * from tb_shift_time where assign_shift_id = '{$assign_shift_id}' ");
        return empty($data) ? array() : $data;
    }

    # start the main shift - i.e. entry into the main table

    public static function start_shift($user_id, $lat, $lng, $status, $assign_shift_id) {

        $is_holiday_data = shift::_is_holiday();
        $is_timeoff_data = shift::_is_timeoff($user_id);
        $is_weekend = shift::_is_weekend();

        $fields = array();
        $fields['user_id'] = $user_id;
        $fields['sDate'] = date('Y-m-d');
        $fields['start_time'] = date('H:i:s');
        $fields['lat_clockstart'] = $lat;
        $fields['lng_clockstart'] = $lng;
        $fields['shift_status'] = $status;
        $fields['assign_shift_id'] = $assign_shift_id;

        # determine for weekend
        $fields['is_weekend'] = $is_weekend;

        #dtermine for holiday
        $fields['is_holiday'] = $is_holiday_data['is_holiday'];
        $fields['holiday_id'] = $is_holiday_data['holiday_id'];
        $fields['holiday_farsi'] = $is_holiday_data['holiday_farsi'];

        $fields['is_abandon'] = '0';

        $fields['is_timeoff'] = $is_timeoff_data['is_timeoff'];
        $fields['timeoff_code'] = $is_timeoff_data['timeoff_code'];
        $fields['timeoff_farsi_text'] = $is_timeoff_data['timeoff_farsi_text'];

        $shift_id = qi("tb_shift_time", $fields);
        return $shift_id;
    }

    // entry for the child table
    public static function log_shift_entry($user_id, $shift_id, $status, $lat, $lng, $briefcase = 0, $timeout = 0) {

        $fields = array();
        $fields['user_id'] = $user_id;
        $fields['shiftid'] = $shift_id;
        $fields['sDate'] = date("Y-m-d");
        $fields['timestamp'] = date("Y-m-d H:i:s");
        $fields['lat'] = $lat;
        $fields['lng'] = $lng;

        $fields['type'] = $status;
        $fields['briefcase'] = $briefcase;
        $fields['timeout'] = $timeout;

        qi("tb_shift_check_inout", $fields);

        #also update the parent table with the latest data
        qu("tb_shift_time", array('shift_status' => $status), " id = '{$shift_id}' ");
    }

    # end the meeting only

    public static function end_meeting($user_id, $shift_id, $lat, $lng) {
        shift::log_shift_entry($user_id, $shift_id, 'BRIEFCASEIN', $lat, $lng, 1);
    }

    public static function end_day($user_id, $shift_id, $lat, $lng, $end_type = 'NORMAL') {
        # UPDATE the child table 
        $check_out_status = $end_type == 'TIMEOUT' ? "TIMEOUTOUT" : "CHECKOUT";
        $briefcase_end = $end_type == 'BRIEFCASE' ? "1" : "0";
        $timeout_end = $end_type == 'TIMEOUT' ? "1" : "0";
        shift::log_shift_entry($user_id, $shift_id, $check_out_status, $lat, $lng, $briefcase_end, $timeout_end);

        #update the main table
        $fields = array();
        $fields['end_date'] = date('Y-m-d');
        $fields['end_time'] = date('H:i:s');
        $fields['lat_clockend'] = $lat;
        $fields['lng_clockend'] = $lng;
        $fields['shift_status'] = "CHECKEDOUT";
        $fields['timeout'] = $timeout_end;
        $fields['briefcase'] = $briefcase_end;
        qu("tb_shift_time", $fields, "id='{$shift_id}'");
        #also update the tb_assign_shift if it was the schedule shift - we need to mark it as completed
        $published_shift_data = shift::get_published_shift_data($shift_id);
        if (!empty($published_shift_data)) {
            $assign_shift_id = $published_shift_data['id'];
            qu("tb_assign_shift", array('shift_status' => "completed"), " id = '{$assign_shift_id}'  ");
        }
    }

    public static function get_summary($shift_id, $returnPersian = true) {

        $shift_logged_start_time = strtotime(shift::get_first_checkin_time($shift_id));
        $shift_logged_end_time = strtotime(shift::get_last_shift_log_time($shift_id));

        # if shift is running right now - then we need to send calc the first clockin and current time
        if (shift::is_shift_running_now($shift_id)) {
            $total_shift_logged_time = $shift_logged_end_time - $shift_logged_start_time;
        } else {
            # otherwise, we can use the summary function
            $summary = shift::calc_shift_times_summary($shift_id);
            $total_shift_logged_time = array_sum($summary);
        }



        # for on-demand shift - it would be -1
        $published_shift_data = shift::get_published_shift_data($shift_id);

        $total_overtime = 0;
        $total_early_departure = 0;
        $total_late_arrival = 0;
        $total_published_shift_time = 0;

        if (!empty($published_shift_data)) {
            $total_published_shift_time = shift::hisToSeconds($published_shift_data['total_hour']);

            $published_start_time = strtotime("{$published_shift_data['start_date']} {$published_shift_data['start_time']}");
            $published_end_time = strtotime("{$published_shift_data['end_date']} {$published_shift_data['end_time']}");



            if ($shift_logged_start_time > $published_start_time) {
                $total_late_arrival = intval($shift_logged_start_time) - intval($published_start_time);
            }

            if ($published_end_time > $shift_logged_end_time) {
                $total_early_departure = intval($published_end_time) - intval($shift_logged_end_time);
            }
            /* $bad_boy_applied = rules_badboy::doCalc($shift_id, $shift_logged_start_time, $shift_logged_end_time, $published_start_time, $published_end_time);
              $total_late_arrival = $bad_boy_applied['total_late_arrival'];
              $total_early_departure = $bad_boy_applied['total_early_departure']; */


            // Need to calc the daily OTs based upon the /settings_ot page
            // and update it on tb_shift_time page
            // applies only if published shift
            //$ot_applied = rules_ot::doCalc($shift_id, $shift_logged_start_time, $shift_logged_end_time, $published_start_time, $published_end_time,$total_shift_logged_time,$total_published_shift_time);
            //$total_overtime = $ot_applied['total_ot_approved'];

            if (intval($total_shift_logged_time) > intval($total_published_shift_time)) {
                $total_overtime = intval($total_shift_logged_time) - intval($total_published_shift_time);
            }
        }

        /* if (!empty($published_shift_data)) {
          $total_published_shift_time = shift::hisToSeconds($published_shift_data['total_hour']);

          if (intval($total_shift_logged_time) > intval($total_published_shift_time)) {
          $total_overtime = intval($total_shift_logged_time) - intval($total_published_shift_time);
          }
          $published_start_time = strtotime("{$published_shift_data['start_date']} {$published_shift_data['start_time']}");
          $published_end_time = strtotime("{$published_shift_data['end_date']} {$published_shift_data['end_time']}");

          if ($shift_logged_start_time > $published_start_time) {
          $total_late_arrival = intval($shift_logged_start_time) - intval($published_start_time);
          }

          if ($published_end_time > $shift_logged_end_time) {
          $total_early_departure = intval($published_end_time) - intval($shift_logged_end_time);
          }
          } */



        $return = array();
        $return['shift_id'] = $shift_id;
        if ($returnPersian) {
            $return['date'] = _DigitsTopersian(_gj($shift_logged_start_time));
            $return['start_time'] = _tt(date("Y-m-d H:i:s", $shift_logged_start_time));
            $return['end_time'] = _tt(date("Y-m-d H:i:s", $shift_logged_end_time));
            $return['total_shift_logged_time'] = _s2p($total_shift_logged_time);
            $return['total_lunch_time'] = _s2p($summary['lunch']);
            $return['total_meeting_time'] = _s2p($summary['meeting']);
            //$retutings_time'] = $summary['in_between_meetings'];
            //$retuing_time'] = $summary['in_office_working_time'];
            $return['total_published_shift_time'] = _s2p($total_published_shift_time);
            $return['total_overtime'] = _s2p($total_overtime);
            //$return['total_late_arrival'] = $total_late_arrival;
            //$return['total_early_departure'] = $total_early_departure;
            $return['total_bad_boy'] = _s2p($total_early_departure + $total_late_arrival);
        } else {
            $return['date'] = _DigitsTopersian(_gj($shift_logged_start_time));
            $return['start_time'] = _tt(date("Y-m-d H:i:s", $shift_logged_start_time));
            $return['end_time'] = _tt(date("Y-m-d H:i:s", $shift_logged_end_time));
            $return['total_shift_logged_time'] = ($total_shift_logged_time);
            $return['total_lunch_time'] = ($summary['lunch']);
            $return['total_meeting_time'] = ($summary['meeting']);
            //$retutings_time'] = $summary['in_between_meetings'];
            //$retuing_time'] = $summary['in_office_working_time'];
            $return['total_published_shift_time'] = ($total_published_shift_time);
            $return['total_overtime'] = ($total_overtime);
            //$return['total_late_arrival'] = $total_late_arrival;
            //$return['total_early_departure'] = $total_early_departure;
            $return['total_bad_boy'] = ($total_early_departure + $total_late_arrival);
        }


        return $return;
    }

    # remember, the shift id is of the tb_shift_time table

    public static function get_published_shift_data($shift_id) {
        # first get the assigned shift id from the tb_shift_time
        $data = qs("select assign_shift_id from tb_shift_time where id = '{$shift_id}' ");
        $return = array();
        if (!empty($data)) {
            if ($data['assign_shift_id'] != "0") {
                if ($data['assign_shift_id'] == "-1") {
                    # meaning - this is on-demand shift
                    $return = array();
                } else {
                    $return = qs("select * from tb_assign_shift where id = '{$data['assign_shift_id']}' ");
                }
            }
        }
        return $return;
    }

    public static function get_user_id_from_shift_id($shift_id) {
        $data = qs("select user_id from tb_shift_time where id = '{$shift_id}' ");
        return empty($data) ? "-1" : $data['user_id'];
    }

    public static function get_user_id_from_logged_shift_id($shift_id) {
        $data = qs("select user_id from tb_shift_time where id = '{$shift_id}' ");
        return empty($data) ? "-1" : $data['user_id'];
    }

    # calculate total meeting time

    public static function calc_total_meeting_time($shift_id) {
        $total_meeting_time = 0;
        # get all the meeting start and meeting end response order by id 
        # and calculate the difference between the two 
        # also take care for the invalid entries
        $data = q("select timestamp,type,id from tb_shift_check_inout where (type = 'BRIEFCASEOUT' or type = 'BRIEFCASEIN') and shiftid = '{$shift_id}'  order by id asc ");
        //d($data);
        if (!empty($data)) {
            $skip_briefcasein = false;
            foreach ($data as $key => $each_data) {
                if ($skip_briefcasein) {
                    # please skip - as this is meeting end entry
                    $skip_briefcasein = false;
                    continue;
                }
                if ($each_data['type'] == 'BRIEFCASEOUT') {
                    $start_time = strtotime($each_data['timestamp']);
                    $next_index = $key + 1;
                    if (isset($data[$next_index])) {
                        if ($data[$next_index]['type'] == 'BRIEFCASEIN') {
                            $end_time = strtotime($data[$next_index]['timestamp']);
                            $total_meeting_time += intval($end_time) - intval($start_time);
                            # make sure you skip the next entry
                            # We are putting it here because the next entry should be briefcasein
                            $skip_briefcasein = true;
                        }
                    }
                }
            }
        }
        return $total_meeting_time;
    }

    # calculate total meeting time

    public static function calc_total_lunch_time($shift_id) {
        $total_lunch_time = 0;
        # get all the lunch start and lunch add 
        # and calculate the difference between the two 
        # also take care for the invalid entries
        $data = q("select timestamp,type,id from tb_shift_check_inout where (type = 'LUNCHOUT' or type = 'LUNCHIN') and shiftid = '{$shift_id}'  order by id asc ");
        //d($data);
        if (!empty($data)) {
            $skip_lunchin = false;
            foreach ($data as $key => $each_data) {
                if ($skip_lunchin) {
                    # please skip - as this is lunch end entry and we have already calculated this timestamp
                    $skip_lunchin = false;
                    continue;
                }
                if ($each_data['type'] == 'LUNCHOUT') {
                    $start_time = strtotime($each_data['timestamp']);
                    $next_index = $key + 1;
                    if (isset($data[$next_index])) {
                        if ($data[$next_index]['type'] == 'LUNCHIN') {
                            $end_time = strtotime($data[$next_index]['timestamp']);
                            $total_lunch_time += intval($end_time) - intval($start_time);
                            # make sure you skip the next entry
                            # We are putting it here because the next entry should be briefcasein
                            $skip_lunchin = true;
                        }
                    }
                }
            }
        }
        return $total_lunch_time;
    }

    #the function will give us all the times for the shift
    # total lunch time, total meeting time, total in between time 
    # to easily understand this logic 
    # try to visulize the pair of [current,previous]
    # ex: [lunchin,lunchout] -- it goes for lunch
    # ex: [briefcastin,briefcaseout] -- it goes for the meeting
    # and all the possible combinations

    public static function calc_shift_times_summary($shift_id) {
        $data = q("select timestamp,type,id from tb_shift_check_inout where shiftid = '{$shift_id}'  order by id asc ");
        //d($data);
        $total_times = array();
        $total_times['lunch'] = 0;
        $total_times['meeting'] = 0;
        $total_times['in_between_meetings'] = 0;
        $total_times['in_office_working_time'] = 0;
        # logic is to iterate over each row and keep adding the total
        # example: if the current status is lunchout and the next one lunchin 
        # then - we should add that to total lunch time
        # same for meeting, in between total shift time
        if (!empty($data)) {
            $previous_status = "";
            $previous_time = 0;
            foreach ($data as $key => $each_data) {

                #first entry just store the data and continue;
                if ($key == 0) {
                    $previous_status = $each_data['type'];
                    $previous_time = strtotime($each_data['timestamp']);
                    continue;
                }
                $current_status = $each_data['type'];
                $current_time = strtotime($each_data['timestamp']);
                switch ($current_status) {
                    case "BRIEFCASEIN";
                        # if current status BRIEFCASEIN in then - previous status must be briefcaseout - or invalid entry
                        switch ($previous_status) {
                            case "BRIEFCASEOUT":
                                $total_times['meeting'] += intval($current_time) - intval($previous_time);
                                break;
                        }
                        break;
                    case "BRIEFCASEOUT";
                        # current status is briefcaseout - meaning user has gone for the meeting
                        # previous status must be within office or he is out for the lunch in and starts the meeting
                        switch ($previous_status) {
                            case "CHECKEDIN":
                                $total_times['in_office_working_time'] += intval($current_time) - intval($previous_time);
                                break;
                            case "LUNCHIN":
                                # this is really nice
                                # it could be like user is out for meeting, meeting end - then goes for lunch and then completes the lunch
                                # then also starts the lunch - then - it should in_between_meeting
                                # and if user was in office, completes the lunch and then - goes for meeting
                                # then it is in_office hours
                                # so we have to check previous to preivous status
                                # meaning whether it was BRIEFCASEIN->LUNCHOUT->LUNCHIN->BRIEFCASEOUT
                                # Or it was CHECKEDIN->LUNCHOUT->LUNCHIN->BRIEFCASEOUT
                                $status_before_previous_status = $data[$key - 3]['type'];
                                if ($status_before_previous_status == 'BRIEFCASEIN') {
                                    $total_times['in_between_meetings'] += intval($current_time) - intval($previous_time);
                                }
                                if ($status_before_previous_status == 'CHECKEDIN') {
                                    $total_times['in_office_working_time'] += intval($current_time) - intval($previous_time);
                                }
                                break;
                            case "BRIEFCASEIN":
                                #Meaning if the previous status was lunch completed or meeting completed and he starts another meeting
                                $total_times['in_between_meetings'] += intval($current_time) - intval($previous_time);
                                break;
                        }
                        break;
                    case "CHECKEDIN";
                        switch ($previous_status) {
                            case "LUNCHIN":
                            case "BRIEFCASEIN":
                                #Meaning user has completed the meeting 
                                # and now - he is at the office
                                # so this time goes as in between meetings
                                $total_times['in_between_meetings'] += intval($current_time) - intval($previous_time);
                                break;
                        }
                        break;
                    case "CHECKOUT";
                        switch ($previous_status) {
                            case "BRIEFCASEIN":
                                #Meaning user has completed the meeting 
                                # and now - he is ending the day 
                                # so this goes as in between meetings

                                $total_times['in_between_meetings'] += intval($current_time) - intval($previous_time);
                                break;
                            case "CHECKEDIN":
                            case "LUNCHIN":
                                #previous status was checked in - so he was in the office
                                $total_times['in_office_working_time'] += intval($current_time) - intval($previous_time);
                                break;
                        }
                        break;
                    case "LUNCHIN";
                        switch ($previous_status) {
                            case "LUNCHOUT":
                                #current status is lunchin
                                #and previously it was lunch out
                                #so that the lunch time

                                $total_times['lunch'] += intval($current_time) - intval($previous_time);
                                break;
                        }
                        break;
                        break;
                    case "LUNCHOUT";
                        switch ($previous_status) {
                            case "BRIEFCASEIN":
                                #Meaning user has completed the meeting 
                                # and now - he is taking the lunch
                                # so this goes as in between meetings

                                $total_times['in_between_meetings'] += intval($current_time) - intval($previous_time);
                                break;
                            case "CHECKEDIN":
                                #previous status was checked in - so he was in the office
                                # user is going out for the lunch
                                $total_times['in_office_working_time'] += intval($current_time) - intval($previous_time);
                                break;
                        }
                        break;
                    case "TIMEOUTOUT";
                        switch ($previous_status) {
                            case "BRIEFCASEIN":
                                #Meaning user has completed the meeting 
                                # and now - he was on the way and abruptly ending the meeting
                                # so this goes as in between meetings
                                $total_times['in_between_meetings'] += intval($current_time) - intval($previous_time);
                                break;
                            case "LUNCHIN":
                                # this is really nice
                                # it could be like user is out for meeting, meeting end - then goes for lunch and then completes the lunch
                                # then user just times out
                                # and if user was in office, completes the lunch and then - if he timesout
                                # then it is in_office hours
                                # so we have to check previous to preivous status
                                # meaning whether it was BRIEFCASEIN->LUNCHOUT->LUNCHIN->TIMEOUTOUT
                                # Or it was CHECKEDIN->LUNCHOUT->LUNCHIN->TIMEOUTOUT
                                $status_before_previous_status = $data[$key - 3]['type'];
                                if ($status_before_previous_status == 'BRIEFCASEIN') {
                                    $total_times['in_between_meetings'] += intval($current_time) - intval($previous_time);
                                }
                                if ($status_before_previous_status == 'CHECKEDIN') {
                                    $total_times['in_office_working_time'] += intval($current_time) - intval($previous_time);
                                }
                                break;
                            case "CHECKEDIN":
                                #user was in the office and he just needs to timeout
                                #so office hours
                                $total_times['in_office_working_time'] += intval($current_time) - intval($previous_time);
                                break;
                        }
                        break;
                }
                $previous_status = $each_data['type'];
                $previous_time = strtotime($each_data['timestamp']);
            }
        }
        return $total_times;
    }

    # function to update the shift times

    public static function update_shift_times_after_end_day($shift_id) {
        # basically, need to update below parameters
        # Total pending time, Total Approved time, Pending OT, Approved OT, Pending Bad boy, Approved Bad Boy
        # approved time - we are not going to update right now - only the ot, total time and bad body
        $summary = shift::get_summary($shift_id, false);
        $update_array = array();
        $update_array['pending_ot'] = $summary['overtime'];
        $update_array['total_pending_time'] = $summary['total_shift_logged_time'];
        $update_array['pending_bad_boy'] = $summary['total_bad_boy'];
        $update_array['total_meeting_time'] = $summary['total_meeting_time'];
        $update_array['total_lunch_time'] = $summary['total_lunch_time'];


        $user_id = shift::get_user_id_from_shift_id($shift_id);
        $update_array['team'] = employee::getEmployeeTeamName($user_id);
        $update_array['location'] = employee::getEmployeeLocationName($user_id);

        #AB-72
        # check for the holiday and weekend
        if (shift::_is_weekend()) {
            $update_array['weekend_ot'] = $summary['total_shift_logged_time'];
        } else {
            $holiday = shift::_is_holiday();
            if ($holiday['is_holiday'] == '1') {
                $update_array['holiday_ot'] = $summary['total_shift_logged_time'];
                $update_array['is_holiday'] = 1;
                $update_array['holiday_farsi'] = $holiday['holiday_farsi'];
            }
        }
        $timeoff_data = shift::_is_timeoff($user_id);
        if (($timeoff_data['is_timeoff'] == '1')) {
            $update_array['is_timeoff'] = 1;
            $update_array['timeoff_code'] =  $timeoff_data['timeoff_code'];;
            $update_array['timeoff_farsi_text'] = $timeoff_data['timeoff_farsi_text'];
        }
        qu("tb_shift_time", $update_array, " id = '{$shift_id}'  ");
    }

    # Function to determine whether it is weekend today or not

    public static function _is_weekend($date = null) {

        $date = is_null($date) ? date("Y-m-d") : $date;
        $day_no = date("w", strtotime($date));

        #if day number is 5 - then the weekend in iran 1=monday, 2=tuesday, ... 4=thursday and 5=friday
        return $day_no == 5 ? 1 : 0;
    }

    # Function to resolve if current date is holiday or not

    public static function _is_holiday($date = null) {
        $date = is_null($date) ? date("Y-m-d") : $date;
        $data = qs("select * from timesheet_leave where leave_date = '{$date}' order by id asc limit 0,1 ");
        $return = array();
        $return['is_holiday'] = 0;
        $return['holiday_id'] = 0;
        $return['holiday_farsi'] = '';

        if (!empty($data)) {
            $return['is_holiday'] = '1';
            $return['holiday_id'] = $data['id'];
            $return['holiday_farsi'] = $data['farsi_reason'];
        }
        return $return;
    }

    #function to test the timeoff for the given user id and given date

    public static function _is_timeoff($user_id, $date = null) {
        $date = is_null($date) ? date("Y-m-d") : $date;

        $return = array();
        $return['is_timeoff'] = 0;
        $return['timeoff_code'] = 0;
        $return['timeoff_farsi_text'] = '';

        if (!$user_id) {
            return $return;
        }

        $data = qs("select * from tb_timeoff where date(from_date) >= '{$date}' and date(to_date) <= '{$date}' and status = 'Accept' and emp_id = '{$user_id}'  ");
        if (!empty($data)) {
            $return['is_timeoff'] = '1';
            $return['timeoff_code'] = $data['reason_id'];
            $return['timeoff_farsi_text'] = _get_timeoff_farsi($data['reason_id']);
        }
        return $return;
    }

    # 01/22/2018
    # Amir wanted a new feature for end day by timeout
    # for published shift only
    # if 9-5 is published shfit and user times out at 3 pm - we need to store - that 2 pm was not logged
    # later needs to be approved by manager
    # this is basically the timeoff module integration 
    # however, for now just a quick implementation

    public static function timeout_log_remaining_hours($user_id, $shift_id) {
        $has_published_shift = shift::has_published_shift($user_id);

        # if not published shift then return
        if (empty($has_published_shift)) {
            return;
        }

        #timeout_remaining_time
        $current_time = time();
        $remaining_time = 0;
        $published_shift_end_time = strtotime($has_published_shift['end_date'] . " " . $has_published_shift['end_time']);
        if ($published_shift_end_time > $current_time) {
            $remaining_time = $published_shift_end_time - $current_time;
        }
        qu('tb_shift_time', array('timeout_remaining_time' => $remaining_time), " id = '{$shift_id}'  ");
    }

}
