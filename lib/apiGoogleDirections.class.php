<?php

/**
 * 
 * API client class to integrate with google directions api to calculate garage out time
 * http://maps.googleapis.com/maps/api/directions/json?origin=Toronto&destination=Montreal&sensor=false
 * 
 * @author hardikpanchal469@gmail.com
 * 
 */
class apiGoogleDirections extends apiCore {

    public $apiURL = "https://maps.googleapis.com/maps/api/directions/";
    public $apiEndpoint = "json";

    public function doRequest($from, $to, $departure_time = 'now') {

        if ($departure_time === FALSE) {
            $departure_time = 'now';
        }

        $this->params['origin'] = $from;
        $this->params['destination'] = $to;
        $this->params['sensor'] = 'false';
        $this->params['traffic_model'] = 'pessimistic';
        $this->params['departure_time'] = $departure_time;
        $this->params['key'] = helper::$googleMapsDirectionsAPIKey;

        return $result = $this->doCall($this->prepareApiUrl());
    }

}


?>
