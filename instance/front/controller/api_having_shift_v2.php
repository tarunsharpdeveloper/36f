<?php

//_errors_on();
// requirement documenbt 
// https://docs.google.com/document/d/1XiGXBBGowMqsojBhcGbQAtwHYf5oYCP8ijzVBE3YogY/edit
if (isset($_REQUEST['doc_helper'])) {
    include _PATH . "instance/front/controller/api_having_shift_v2_doc_helper.php";
    die;
}


$userId = _e($_REQUEST['id'], 0);
$shift_id = _e($_REQUEST['shift_id'], 0);

$time = strtotime();
$today = date("Y-m-d");
$isShift = qs("SELECT * FROM tb_assign_shift WHERE user_id='{$userId}' and start_date like '{$today}%' order by id desc limit 0,1");

if ($shift_id != 0) {
    # okay - so this is the usecase when user kills the pp
    # and user is in between the shift 
    # and he is basically calling having shift with shift id
    # so jut to keep the logic of existing having shift intact
    # i am adding this file for this scenario
    include _PATH . "instance/front/controller/api_having_shift_v2_live_shift.php";

    die;
}

if (!$userId) {
    $fields = array();
    $fields['result'] = "error";
    $fields['msg'] = "INVALID_USER_ID";
    $fields['active_badge'] = mt_rand(0,999);
    echo _api_response($fields);
    die;
}



# check if the user does have the shift 
# 


if (empty($isShift)) {
    # if user doesn't have the shift then just return the message
    # nothing else 
    $fields = array();
    $fields['result'] = "error";
    $fields['msg'] = "Shift Not Available";
    $fields['active_badge'] = mt_rand(0,999);
    echo _api_response($fields);
    die;
} else {

    # if user does have the shift
    # then - please check - if the shift has been started (live shift)
    # of if the shift hasn't been started 



    $start_time = strtotime($isShift['start_time']);
    $end_time = strtotime($isShift['end_time']);


    # check if is in the shift ?
    if ($start_time < $time && $end_time > $time) {
        # Yes, user does have a live shift
        # Get the shift id from tb_shift_time:
        $shift_id = qs("select id  from tb_shift_time where  assign_shift_id = '{$isShift['id']}' ");

        #in order to use the same logic for the kill-app-call-again scenario 
        #creating this common file
        include _PATH . "instance/front/controller/api_having_shift_v2_live_shift.php";
    } else {



        #current unix timestamp
        $current_time = time();
        $shift_data = qs("select *  from tb_shift_time where  assign_shift_id = '{$isShift['id']}' ");

        # if we have some value for the end_time then - shift is ended
        # so we have to send the error
        if ($shift_data['shift_status'] == 'CHECKEDOUT') {
            $fields = array();
            $fields['result'] = "error";
            $fields['msg'] = "A SHIFT HAS JUST COMPLETED";
            $fields['active_badge'] = mt_rand(0,999);
            echo _api_response($fields);
            die;
        }

        #shift start time
        $shift_start_time = strtotime($isShift['start_date'] . " " . $isShift['start_time']);
        $shift_end_time = strtotime($isShift['end_date'] . " " . $isShift['end_time']);

        #tolerance limit
        $tolerance_end_time = employee::get_check_in_tolerance($userId);
        if ($tolerance_end_time == 0) {
            #default is start + tolerance
            #otherwise - end time
            $tolerance_end_time_seconds = 0;
            $shift_checkin_max_time_limit = $shift_end_time;
        } else {
            $tolerance_end_time_seconds = $tolerance_end_time * 60;
            $shift_checkin_max_time_limit = $shift_start_time + $tolerance_end_time;
        }


        $fields = array();
        $fields['current_time'] = $current_time;
        $fields['shift_start_time'] = $shift_start_time;
        $fields['shift_checkin_max_time_limit'] = $shift_checkin_max_time_limit;
        $fields['shift_status'] = $shift_start_time >= $current_time ? 'BEFORE_SHIFT' : 'LATE';
        $fields['active_badge'] = mt_rand(0,999);


        echo _api_response($fields);
    }
}

die;
?>