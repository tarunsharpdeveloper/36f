<?php

/**
 * timesheet Class
 * 
 * Class for timesheet related functions
 * 
 * @author Hardik Panchal 
 * @version 1.0
 * @package Whozoor
 * 
 */
class ts {

    public static $_j_month_days = array("01" => 31, "02" => 31, "03" => 31, "04" => 31, "05" => 31, "06" => 31, "07" => 30, "08" => 30, "09" => 30, "10" => 30, "11" => 30, "12" => 29);
    public static $_page = 1;
    public static $_limit = 5;

    public function __construct() {
        
    }

    public static function has_shift_data_for_month($month_start, $month_end, $user_id) {
        $data = qs("select count(id) as total_rows "
                . " from tb_shift_time "
                . " where user_id = '{$user_id}' and end_time is not null and  "
                . " ( date(sDate) >= '{$month_start}' and date(sDate) <= '{$month_end}' ) ");

        return $data['total_rows'] > 0 ? true : false;
    }

    public static function _pagging() {
        $page = (ts::$_page - 1) * ts::$_limit;
        $limit = ts::$_limit;

        return " LIMIT {$page},{$limit}";
    }

    # for each day we need below data
    /**
     * 
      Team name
      Location
      OT time
      Badboy time
      Start time
      End time

      Also, for a given day - the OT or badbody - should be either approved or pending
     * so if we have approved badboy/ot send that first
     * also send the status

     */

    public static function get_timesheet_daily_data($month_start, $month_end, $user_id, $shift_id = 0) {

        $pagging = ts::_pagging();

        if ($shift_id != 0) {
            $data = q("select id,user_id,status, location,team,date(sDate) as start_date,start_time, date(end_date) as end_date, end_time,"
                    . " total_pending_time,total_approved_time,pending_ot,approved_ot,pending_bad_boy,approved_bad_boy, "
                    . " is_holiday, holiday_farsi,is_abandon, is_weekend,is_timeoff, timeoff_code, timeoff_farsi_text "
                    . " from tb_shift_time "
                    . " where user_id = '{$user_id}' and id = '{$shift_id}' {$pagging}  ");
        } else {
            $data = q("select id,user_id,status, location,team,date(sDate) as start_date,start_time, date(end_date) as end_date, end_time,"
                    . " total_pending_time,total_approved_time,pending_ot,approved_ot,pending_bad_boy,approved_bad_boy, "
                    . " is_holiday, holiday_farsi,is_abandon, is_weekend,is_timeoff, timeoff_code, timeoff_farsi_text "
                    . " from tb_shift_time "
                    . " where user_id = '{$user_id}' and end_time is not null and "
                    . " (date(sDate) >= '{$month_start}' and date(sDate) <= '{$month_end}' ) {$pagging} ");
        }


        if (empty($data)) {
            return array();
        }
        $return = array();
        foreach ($data as $each_data) {

            $array = array();
            $array['date'] = _DigitsTopersian(_gj(strtotime($each_data['start_date'])));
            $array['circle_data'] = _get_day_persian($each_data['start_date']);
            $array['location'] = $each_data['location'];
            $array['team'] = $each_data['team'];
            $array['start_time'] = _tt($each_data['start_date'] . " " . $each_data['start_time'], "G:i");
            $array['end_time'] = _tt($each_data['end_date'] . " " . $each_data['end_time'], "G:i");
            $array['total_time'] = $each_data['status'] == '1' ? _s2p($each_data['total_approved_time']) : _s2p($each_data['total_pending_time']);
            $array['total_lunch_time'] = _s2p($each_data['total_lunch_time']);
            $array['total_meeting_time'] = _s2p($each_data['total_meeting_time']);
            $array['overtime'] = $each_data['status'] == '1' ? _s2p($each_data['approved_ot']) : _s2p($each_data['pending_ot']);
            $array['badboy'] = $each_data['status'] == '1' ? _s2p($each_data['approved_bad_boy']) : _s2p($each_data['pending_bad_boy']);
            $array['status'] = language::timesheet_status($each_data['status']);
            $array['holiday'] = array(
                'is_holiday' => $each_data['is_holiday'],
                'farsi_name' => $each_data['holiday_farsi']
            );
            $array['timeoff'] = array(
                'is_timeoff' => $each_data['is_timeoff'],
                'code' => $each_data['timeoff_code'],
                'farsi_farsi_nametext' => $each_data['timeoff_farsi_text'],
            );
            $array['is_abandon'] = $each_data['is_abandon'];
            $array['is_weekend'] = $each_data['is_weekend'];
            $array['shift_id'] = $each_data['id'];
            $return[] = $array;
        }
        return $return;
    }

    # timesheet api - get the monthly summary data

    public static function get_timesheet_monthly_data($month_start, $month_end, $user_id) {
        $data = qs("select id,user_id,status, "
                . " sum(total_pending_time) as total_pending_time,  "
                . " sum(total_approved_time) as total_approved_time, "
                . " sum(pending_ot) as pending_ot, "
                . " sum(approved_ot) as approved_ot, "
                . " sum(pending_bad_boy) as pending_bad_boy, "
                . " sum(approved_bad_boy) as approved_bad_boy "
                . " from tb_shift_time "
                . " where user_id = '{$user_id}' and end_time is not null and "
                . " (date(sDate) >= '{$month_start}' and date(sDate) <= '{$month_end}' ) ");

        if (empty($data)) {
            return array();
        }
        $return = array();
        $return['total_pending_time'] = _s2p($data['total_pending_time']);
        $return['total_approved_time'] = _s2p($data['total_approved_time']);
        $return['pending_ot'] = _s2p($data['pending_ot']);
        $return['approved_ot'] = _s2p($data['approved_ot']);
        $return['pending_bad_boy'] = _s2p($data['pending_bad_boy']);
        $return['approved_bad_boy'] = _s2p($data['approved_bad_boy']);

        $return = ts::removeNull($return);

        return $return;
    }

    function removeNull($return) {
        $data = array();
        foreach ($return as $key => $each_data) {
            if (is_null($each_data) || $each_data == '') {
                $data[$key] = 0;
            } else {
                $data[$key] = $each_data;
            }
        }
        return $data;
    }

    # App will give something like this - ۱۳۹۶-۱۰ (yyyy-mm) 
    # we have to convert this to relevant 1st and last of the persian
    # then - to the american dates
    # https://calendar.zoznam.sk/persian_calendar-en.php?ly=2025
    # jalali has - 1st to 6th month as 31st day, 7th to 11th as 30 and 12th can be 29/30 if leap year+1

    public static function get_month_start_end_from_jalali_yyyymm($jalali_yyyy_mm) {
        $persian_digits = _persianToDigits($jalali_yyyy_mm);

        if (strlen($persian_digits) != 7) {
            return false;
        }

        list($persian_year, $persian_month) = explode("-", $persian_digits);

        # so this is the first date. 
        $_g_start_date = _jg($persian_year, $persian_month, "01");


        #now, we need to find out the last date
        # The last date is basically if jalali month - 1 till 6 has 31 days - so we add 1st day + 31 
        # 7th to 11th month is 30 so we add 30 days to 1st
        # for 12th - it can be 29 or 30 (if english leap+1 year then 30 else 29)
        # Get the total days into the month

        $_j_days_in_month = ts::$_j_month_days[$persian_month];

        if ($persian_month == 12) {
            $_g_year = date("Y", strtotime($_g_start_date));
            $_g_year_prev = $_g_year - 1;
            if ($_g_year_prev % 4 == 0) {
                $_j_days_in_month = 30;
            }
        }

        # finally, logically we have to add one less day.  so we get the end date. Otherwise we get the 1st date of next month
        $_j_days_in_month = $_j_days_in_month - 1;

        $_g_end_date = date("Y-m-d", strtotime("+{$_j_days_in_month} days ", strtotime($_g_start_date)));

        $return = array("start" => $_g_start_date, "end" => $_g_end_date);
        return $return;
    }

    public static function get_calendar_data($month_start = '', $length = 30, $user_id = 0) {
        $month_start = $month_start == "" ? date("Y-m-d") : $month_start;

        $days = array();
        for ($i = 0; $i < $length; $i++) {
            $date_timestamp = $i == 0 ? strtotime($month_start) : strtotime("+{$i} Days", strtotime($month_start));
            $date_ymd = date("Y-m-d", $date_timestamp);
            $day = array();
            $day['date'] = _DigitsTopersian(_gj($date_timestamp));
            $day['is_weekend'] = shift::_is_weekend($date_ymd);
            $day['is_holiday'] = shift::_is_holiday($date_ymd);
            $day['is_timeoff'] = shift::_is_timeoff($user_id, $date);
            $days[] = $day;
        }
        return $days;
    }

}
