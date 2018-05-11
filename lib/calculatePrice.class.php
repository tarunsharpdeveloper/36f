<?php

/**
 * Main Booking Engine Logic Class
 * 
 * @since July 10, 2016
 * @author Hardik Panchal
 * 
 */
class calculatePrice {
    # percentage of margin on affiliate prices

    public static $fname = '';
    public static $lname = '';
    public static $phone = '';
    public static $vehicle = '';
    public static $grossMargin = 0.30;
    # in minutes
    public static $hourlySafetyNet = 0.0;

    # gratuities 
    public static $gratuity = 0.20;
    # tax 
    public static $tax = 0.887;

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

    #header Image
    public static $headerImage = '';
    public static $vehicleImage = '';
    # in template
    public static $template = '';
    public static $id = '';
    public static $attachment = '';
    public static $test = array();

    public function __construct() {
        
    }

    public function getValue($id) {
        $fields = qs('select * from quote where id=' . $id);
        calculatePrice::$attachment = $fields['attachment'];
        calculatePrice::$id = $fields['id'];
        calculatePrice::$template = $fields['template'];
        calculatePrice::$vehicleImage = $fields['image'];
        calculatePrice::$headerImage = $fields['headerImage'];
        calculatePrice::$pickupTime = $fields["pickupTime"];
        calculatePrice::$pickupDate = $fields['start_date'];
        calculatePrice::$pu = $fields['pickup'];
        calculatePrice::$do = $fields['dropoff'];
        calculatePrice::$puDeadHead = $fields['puDeadhead'];
        calculatePrice::$doDeadHead = $fields['doDeadhead'];
        calculatePrice::$billableHours = $fields['billableHours'];
        calculatePrice::$tax = $fields['tax'];
        calculatePrice::$gratuity = $fields['gratuity'];
        calculatePrice::$vehicle=$fields['car'];
        $car = q("select * from car where quote_id=" . $id);
        calculatePrice::$test = $car;


        $check = qs("select * from customer where id ='{$fields['customer_id']}' ");
        calculatePrice::$fname = $check['first_name'];
        calculatePrice::$lname = $check['last_name'];
        calculatePrice::$email = $check['email'];
        calculatePrice::$phone = $check['phone'];
        _escapeArray($fields);

        return $fields;
    }

    public function setValue($QuoteId) {
        $fields['tenant_id'] = $_SESSION['user']['id'];
        $fields['first_name'] = calculatePrice::$fname;
        $fields['last_name'] = calculatePrice::$lname;
        $fields['email'] = calculatePrice::$email;
        $fields['phone'] = calculatePrice::$phone;
        $check = qs("select * from customer where email ='{$fields['email']}' and tenant_id='{$_SESSION['user']['id']}'");
        if (!empty($check) && $check['id'] != '') {
            $id = $check['id'];
        } else {
            $id = qi('customer', $fields);
        }
        unset($fields);
        $fields['customer_id'] = $id;
        $fields['tenant_id'] = $_SESSION['user']['id'];
        $fields['template'] = 'basicTemplate.php';
        $fields['pickupTime'] = calculatePrice::$pickupTime;
        $fields['start_date'] = calculatePrice::$pickupDate;
        $fields['pickup'] = calculatePrice::$pu;
        $fields['dropoff'] = calculatePrice::$do;
        $fields['puDeadhead'] = calculatePrice::$puDeadHead;
        $fields['doDeadhead'] = calculatePrice::$doDeadHead;
        $fields['billableHours'] = calculatePrice::$billableHours;
        $fields['tax'] = calculatePrice::$tax;
        $fields['gratuity'] = calculatePrice::$gratuity;
//        $fields['car'] = calculatePrice::$vehicle;

        _escapeArray($fields);
        if ($QuoteId == 0) {
            $fields['headerImage'] = 'http://localhost/lifezaver-proposal/instance/front/media/img/IMG_08102016_114355.png';
            _escapeArray($fields);
            $id = qi('quote', $fields);
            unset($fields);
        } else {
            $condition = 'id=' . $QuoteId;
            qu('quote', $fields, $condition);
            $id = $QuoteId;
            unset($fields);
        }
        qd("car", "quote_id=" . $id);
        foreach (calculatePrice::$test as $value) {
            $fields['car_id'] = $value['vehicle'];
            $fields['quote_id'] = $id;
            $fields['quantity'] = $value['quintity'];
            $fields['tax'] = $value['tax'];
            $fields['baseAmount'] = $value['baseAmount'];
            $fields['gratuity'] = $value['gratuity'];
            $fields['amount'] = $value['amount'];
            d($fields);
            qi('car', $fields);
        }
        return $id;
    }

    public function calcBillableHours() {
        calculatePrice::$puDeadHead = $this->_calcRadius(calculatePrice::$baseCity, calculatePrice::$pu, strtotime(calculatePrice::$pickupDate . " " . calculatePrice::$pickupTime));
        calculatePrice::$doDeadHead = $this->_calcRadius(calculatePrice::$do, calculatePrice::$baseCity, strtotime(calculatePrice::$pickupDate));

        calculatePrice::$pointHours = $this->_calcRadius(calculatePrice::$pu, calculatePrice::$do, strtotime(calculatePrice::$pickupDate . " " . calculatePrice::$pickupTime));

        calculatePrice::$billableHours = calculatePrice::$puDeadHead + calculatePrice::$pointHours + calculatePrice::$doDeadHead;
        calculatePrice::$billableHours = (calculatePrice::$billableHours * calculatePrice::$hourlySafetyNet) + calculatePrice::$billableHours;
        calculatePrice::$billableHours = $this->_convertToHours(calculatePrice::$billableHours);
        calculatePrice::$puDeadHead = $this->_convertToHours(calculatePrice::$puDeadHead);
        calculatePrice::$doDeadHead = $this->_convertToHours(calculatePrice::$doDeadHead);
        return calculatePrice::$billableHours;
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

}
