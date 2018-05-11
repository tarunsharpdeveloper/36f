<?php

/**
 * Main Booking Engine Logic Class
 * 
 * @since July 10, 2016
 * @author Hardik Panchal
 * 
 */
class calculatePrice1 {

    public static $quote_default_template = 'template_foldcorner_theme.php';
    public static $fname = '';
    public static $lname = '';
    public static $phone = '';
    public static $vehicle = '';
    public static $subject = '';
    public static $toEmail = '';
    public static $grossMargin = 0.30;
# in minutes
    public static $hourlySafetyNet = 0.0;

# gratuities 
    public static $gratuity = 20;
# tax 
    public static $tax = 8.875;

#hold the actual addresses
    public static $pu = '';
    public static $do = '';

#Hold the vehicle category select by user
    public static $vehicle_type = '';

#hold pickup date and time
    public static $pickupDate = '';
    public static $pickupTime = '';

#hold the hours
    public static $pointHours = 0;
    public static $puDeadHead = 0;
    public static $doDeadHead = 0;
    public static $billableHours = 0;

#Set the base city - base city - means, which city affiliates are going to serve this trip
# there can be many conditions for this.
# in city trips, outer city trips but served by nearest city affiliate, fixed trips, etc etc @see getBaseCity
    public static $baseCity = 'New York, NY, United States';
    public static $baseAmount = '';
    public static $amount = '';
#email variable for discount
    public static $email = '';
    public static $internal_notes;
    public static $customer_notes;
    public static $stops;

#header Image
    public static $headerImage = '';
    public static $vehicleImage = '';
    public static $cover_text = '';

# in template
    public static $template = '';
    public static $id = '';
    public static $attachment = '';
    public static $mailVideo = '';
    public static $days = array();

#charge
    public static $charge = array();

    public function __construct() {
        
    }

    public function getValue($id) {
        $id = _escape($id);
        $fields = qs("select * from quote where id='{$id}' ");
        calculatePrice1::$attachment = $fields['attachment'];
        calculatePrice1::$id = $fields['id'];
        calculatePrice1::$template = $fields['template'];
        calculatePrice1::$vehicleImage = $fields['image'];
        calculatePrice1::$headerImage = $fields['headerImage'];
        calculatePrice1::$attachment = $fields['attachment'];
        calculatePrice1::$tax = $fields['tax'];
        calculatePrice1::$internal_notes = $fields['internal_notes'];
        calculatePrice1::$customer_notes = $fields['customer_notes'];
        calculatePrice1::$cover_text = $fields['cover_text'] ? $fields['cover_text'] : helper::getDefaultCoverText();

        calculatePrice1::$gratuity = $fields['gratuity'];
        calculatePrice1::$mailVideo = $fields['video'];
        $day = q("select * from quote_day where quote_id='{$id}' ");
        $c = 0;
        foreach ($day as $value) {
            calculatePrice1::$days[$c] = $value; // pu/do and othe stuff
            $car = q("select * from car where quote_id='{$id}' AND day_id= '{$value['id']}' ");
            calculatePrice1::$days[$c]['car'] = $car;
            foreach ($car as $optionValue) {
//                d($optionValue);
                $carOption = q("select * from car_option where quote_id='{$id}' AND day_id= '{$value['id']}' AND carOption='{$optionValue['id']}'");
                calculatePrice1::$days[$c]['car']['option' . $optionValue['id']] = $carOption;
            }

            $stops = q("select * from quote_stops where quote_id = '{$id}' and quote_day_id = '{$value['id']}' ");
            if (!empty($stops)) {
                calculatePrice1::$days[$c]['stops'] = $stops;
            }
            $c++;
        }


        $check = qs("select * from customer where id ='{$fields['customer_id']}' ");
        calculatePrice1::$fname = $check['first_name'];
        calculatePrice1::$lname = $check['last_name'];
        calculatePrice1::$email = $check['email'];
        calculatePrice1::$phone = $check['phone'];
        _escapeArray($fields);
        calculatePrice1::$charge = q("select * from quote_charges where quote_id='{$id}'");
        return $fields;
    }

    public function setValue($QuoteId) {
        $fields['tenant_id'] = $_SESSION['user']['id'];
        $fields['first_name'] = calculatePrice1::$fname;
        $fields['last_name'] = calculatePrice1::$lname;
        $fields['email'] = calculatePrice1::$email;
        $fields['phone'] = calculatePrice1::$phone;
        $check = qs("select * from customer where email ='{$fields['email']}' and tenant_id='{$_SESSION['user']['id']}'");
        if (!empty($check) && $check['id'] != '') {
            $id = $check['id'];
        } else {
            $id = qi('customer', $fields);
        }

        unset($fields);
        $fields['quote_employee_id'] = $_SESSION['user']['id'];
        $fields['customer_id'] = $id;
        $fields['tenant_id'] = $_SESSION['user']['id'];
        $fields['tax'] = calculatePrice1::$tax;
        $fields['gratuity'] = calculatePrice1::$gratuity;
        $fields['internal_notes'] = calculatePrice1::$internal_notes;
        $fields['customer_notes'] = calculatePrice1::$customer_notes;

        _escapeArray($fields);
        if ($QuoteId == 0) {
            $fields['headerImage'] = _MEDIA_URL . 'header_img/Airport-Arrival.jpg';
            $fields['template'] = 'template_foldcorner_theme.php';
            _escapeArray($fields);
            $id = qi('quote', $fields);
            unset($fields);
        } else {
            $condition = 'id=' . $QuoteId;
            qu('quote', $fields, $condition);
            $id = $QuoteId;
            unset($fields);
        }
#day info
        qd("quote_day", " quote_id='{$id}' ");
        qd("car", " quote_id='{$id}' ");
        qd("quote_stops", " quote_id='{$id}' ");
        qd("car_option", " quote_id='{$id}' ");
        qd("quote_charges", " quote_id='{$id}' ");

        unset($fields);
        $fields['tenant_id'] = $_SESSION['user']['id'];
        $fields['quote_id'] = $id;
//        $stops = array_filter($day['stops']);
//        foreach ($stops as $each_stop) {
//            $fields['quote_day_id'] = $dayID;
//        }
        foreach (calculatePrice1::$charge as $value) {
            $fields['charge_name'] = $value['name'];
            $fields['charge_value'] = $value['value'];
            qi('quote_charges', $fields);
        }



        foreach (calculatePrice1::$days as $day) {


            unset($fields);
            $fields['quote_id'] = $id;
            $fields['pickupTime'] = $day['pTime'];
            $fields['pickupDate'] = $day['pDate'];
            $fields['pickup'] = $day['pu'];
            $fields['dropoff'] = $day['do'];

//$fields['billableHours'] = $day['doBH'];
            $dayID = qi('quote_day', $fields);

            $stop_fields = array();
            $stops = array_filter($day['stops']);
            foreach ($stops as $each_stop) {
                $stop_fields['quote_day_id'] = $dayID;
                $stop_fields['quote_id'] = $id;
                $stop_fields['stop_address'] = $each_stop;
                qi("quote_stops", $stop_fields);
            }


            $total_billable_hours = 0;
#car Info

            foreach ($day['car'] as $value) {

                unset($fields);
                $fields = array();
                $fields['day_id'] = $dayID;
                $fields['car_id'] = $value['vehicle'];
                $fields['quote_id'] = $id;
                $fields['quantity'] = $value['quantity'];
                $fields['tax'] = $value['tax'];
                $fields['baseAmount'] = $value['baseAmount'];
                $fields['gratuity'] = $value['gratuity'];
                $fields['amount'] = $value['amount'];


                $fields['car_name'] = $value['car_name'];
                $fields['rate_type'] = $value['rate_type'];
                $fields['hourly_rate'] = $value['hourly_rate'];
                $fields['min_hours'] = $value['min_hours'];
                $total_billable_hours +=$value['min_hours'];

# add a new entry
                $carId = qi('car', $fields);
                if (is_array($value['option'])) {
                    foreach ($value['option'] as $optionValue) {
                        unset($fields);
                        $fields = array();
                        $fields['day_id'] = $dayID;
                        $fields['car_id'] = $optionValue['vehicle'];
                        $fields['quote_id'] = $id;
                        $fields['carOption'] = $carId;
                        $fields['quantity'] = $optionValue['quantity'];
                        $fields['tax'] = $optionValue['tax'];
                        $fields['baseAmount'] = $optionValue['baseAmount'];
                        $fields['gratuity'] = $optionValue['gratuity'];
                        $fields['amount'] = $optionValue['amount'];


                        $fields['car_name'] = $optionValue['car_name'];
                        $fields['rate_type'] = $optionValue['rate_type'];
                        $fields['hourly_rate'] = $optionValue['hourly_rate'];
                        $fields['min_hours'] = $optionValue['min_hours'];
                        qi('car_option', $fields);
                    }
                }
            }

# update total billable hours
            qu('quote_day', array("billableHours" => $total_billable_hours), " id = '{$dayID}' ");
        }
        return $id;
    }

    public function calcBillableHours() {
        calculatePrice1::$puDeadHead = $this->_calcRadius(calculatePrice1::$baseCity, calculatePrice1::$pu, strtotime(calculatePrice1::$pickupDate . " " . calculatePrice1::$pickupTime));
        calculatePrice1::$doDeadHead = $this->_calcRadius(calculatePrice1::$do, calculatePrice1::$baseCity, strtotime(calculatePrice1::$pickupDate));

        calculatePrice1::$pointHours = $this->_calcRadius(calculatePrice1::$pu, calculatePrice1::$do, strtotime(calculatePrice1::$pickupDate . " " . calculatePrice1::$pickupTime));

        calculatePrice1::$billableHours = calculatePrice1::$puDeadHead + calculatePrice1::$pointHours + calculatePrice1::$doDeadHead;
        calculatePrice1::$billableHours = (calculatePrice1::$billableHours * calculatePrice1::$hourlySafetyNet) + calculatePrice1::$billableHours;
        calculatePrice1::$billableHours = $this->_convertToHours(calculatePrice1::$billableHours);
        calculatePrice1::$puDeadHead = $this->_convertToHours(calculatePrice1::$puDeadHead);
        calculatePrice1::$doDeadHead = $this->_convertToHours(calculatePrice1::$doDeadHead);
        return calculatePrice1::$billableHours;
    }

    /**
     * Convert the minutes into hours with rounded to 2
     * @param type $minutes
     * @return string
     */
    public function _convertToHours($minutes = 0) {
        if ($minutes == 0) {
            return '0';
        }
        $hours = $minutes / 60;
        $hours = round($hours, 2);
        return $hours;
    }

    public function _calcRadius($from = '', $to = '', $date = '') {

# For malformed entries return false;
        if ($from == '' || $to == '') {
            return FALSE;
        }

        if ($date == '') {
            $date = strtotime('now');
        }
        $googleDirectionsAPI = new apiGoogleDirections();
        $result = $googleDirectionsAPI->doRequest($from, $to, $date);
        $result = json_decode($result, true);
# result is in seconds
        $duration = $result['routes'][0]['legs'][0]['duration_in_traffic']['value'] ? $result['routes'][0]['legs'][0]['duration_in_traffic']['value'] : $result['routes'][0]['legs'][0]['duration']['value'];
        $time = ceil(intval($duration) / 60);
//        d($result);
#calc the intval
        $time = intval($time);
        return $time;
    }

    // render the template
    // assuming we have load the values for calculatePrice1
    public static function _render_quote_template($options = array()) {
        $tpl_path = _PATH . 'instance/front/tpl/' . calculatePrice1::$template;
        $tpl_path = file_exists($tpl_path) ? $tpl_path : _PATH . 'instance/front/tpl/' . calculatePrice1::$quote_default_template;

        ob_start();
        include $tpl_path;
        $mail = ob_get_contents();
        ob_end_clean();

        $cover_letter = calculatePrice1::_render_quote_cover_letter();
        $mail = $cover_letter . $mail;

        if (!isset($options['isAdminApprovalMail'])) {
            $mail .= calculatePrice1::_render_email_tracking_image();
        } else {
            $mail = calculatePrice1::_render_admin_approve_link($options['adminId']) . $mail;
        }

        return $mail;
    }

    public static function _render_admin_approve_link($adminId) {
        $link_content = "";
        $approval_link = _U . "approveQuoteMail?approve_id={$_REQUEST['quote_id']}&mail_id={$_REQUEST['mail_id']}";
        $link_content .= "<div style='color:#9c372a;background-color:#f9f1bc;font-size:20px;padding:10px;border:2px dashed #f7cea6;'><a style='color:#8e1a0c;' target='_blank' href=" . $approval_link . ">Click here</a> to manage approval for this quote</div>";
        return $link_content;
    }

    # render the cover letter;

    public static function _render_quote_cover_letter() {

        $bg_color = tenant::_bg_color();

        $content = '';
        $content .= "<div style='font-family:tahoma;'>";
        $content .= calculatePrice1::$cover_text;
        $content .= '</div>';
        $content .= "<br />  <div style='height:4px;width:100%;background-color:{$bg_color}'>&nbsp;</div> <br />";

        return $content;
    }

    public static function _render_email_tracking_image() {
        $id = calculatePrice1::$id;
        $image_path = _U . "et?id={$id}";
        $img = "<img src='{$image_path}' width='1' height='1' alt='' border='0' />";
        return $img;
    }

    public static function _quote_activity($quote_id) {
        $quote_id = _escape($quote_id);
        $data = q("select * from quote_activity where quote_id = '{$quote_id}' order by created_at DESC ");
        return empty($data) ? array() : $data;
    }

}
