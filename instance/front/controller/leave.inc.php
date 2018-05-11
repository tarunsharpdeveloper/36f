<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}
//if (!isset($_SESSION['user']) ) {
//    _R('login');
//}
//$strStart = '2013-06-19 05:25 am';
//$strEnd = '06/19/13 05:47 pm';
//$dteStart = new DateTime($strStart);
//$dteEnd = new DateTime($strEnd);
//$dteDiff = $dteStart->diff($dteEnd);
//print $dteDiff->format("%H:%I:%S");
date_default_timezone_set("UTC");

// Time format is UNIX timestamp or
// PHP strtotime compatible strings
function dateDiff($time1, $time2, $precision = 6) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
        $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
        $time2 = strtotime($time2);
    }

    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
        $ttime = $time1;
        $time1 = $time2;
        $time2 = $ttime;
    }

    // Set up intervals and diffs arrays
//    $intervals = array('year', 'month', 'day', 'hour', 'minute', 'second');
    $intervals = array('day', 'hour', 'minute', 'second');
    $diffs = array();

    // Loop thru all intervals
    foreach ($intervals as $interval) {
        // Create temp time from time1 and interval
        $ttime = strtotime('+1 ' . $interval, $time1);
        // Set initial values
        $add = 1;
        $looped = 0;
        // Loop until temp time is smaller than time2
        while ($time2 >= $ttime) {
            // Create new temp time from time1 and interval
            $add++;
            $ttime = strtotime("+" . $add . " " . $interval, $time1);
            $looped++;
        }

        $time1 = strtotime("+" . $looped . " " . $interval, $time1);
        $diffs[$interval] = $looped;
    }

    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
        // Break if we have needed precission
        if ($count >= $precision) {
            break;
        }
        // Add value and interval 
        // if value is bigger than 0
        if ($value > 0) {
            // Add s if value is not 1
            if ($value != 1) {
                $interval .= "s";
            }
            // Add value and interval to times array
            $times[] = $value . " " . $interval;
            $count++;
        }
    }

    // Return string with times
    return implode(", ", $times);
}

if (isset($_REQUEST['TotalTime'])) {
    $sdate = $_REQUEST['sdate'];
    $stime = date("H:i", strtotime($_REQUEST['stime']));
    $edate = $_REQUEST['edate'];
    $etime = date("H:i", strtotime($_REQUEST['etime']));
//    $strStart = '2013-06-19 05:25 am';
//    $strEnd = '06/19/13 05:47 pm';
    $dteStart = date("Y-m-d H:i:s ", strtotime($sdate . ' ' . $stime));
    $dteEnd = date("Y-m-d H:i:s ", strtotime($edate . ' ' . $etime));
    //echo dateDiff("2006-04-12 12:30:00", "1987-04-12 12:30:01");
//    d($dteStart);
//    d($dteEnd);
//    $dteDiff = $dteStart->diff($dteEnd);
//    print $dteDiff->format("%H:%I:%S");
    $S = dateDiff($dteStart, $dteEnd);
//    $c = $S->format("%H:%I:%S");
//    d($S);
//    die;
    echo json_encode($S);
    die;
}
if (isset($_REQUEST['cancelLeave'])) {
    $id = $_REQUEST['id'];
    $fields = array();
    $fields['status'] = "0";
    qu(tb_leave, $fields, "id='$id'");
//    qd("tb_leave", "id='$id'");
    $LeaveData = q("select tl.*,te.fname,te.lname from  tb_leave tl,tb_employee te where tl.emp_id=te.id and NOT tl.status=0");
    include _PATH . 'instance/front/tpl/leave_data.php';
    die;
}
if (isset($_REQUEST['save'])) {
    $fields['emp_id'] = $_SESSION['user']['id'];

    $fields['f_day_date'] = $_REQUEST['mf_date'];
    $fields['f_day_time'] = $_REQUEST['mf_time'];
    $fields['l_day_date'] = $_REQUEST['ml_date'];
    $fields['l_day_time'] = $_REQUEST['ml_time'];
    $fields['total_day'] = $_REQUEST['mhid_total'];
    $fields['leave_type'] = $_REQUEST['mleave_type'];
    $fields['notes'] = $_REQUEST['mtxtnotes'];
    $fields['status'] = "1";
    $fields['notify_manager'] = $_REQUEST['mnotifyby'];
    qi('tb_leave', $fields);
//    d($_REQUEST);
//    die;
}

if (isset($_REQUEST['getLeave'])) {
    $id = $_REQUEST['id'];

    $getdata = qs("select * from  tb_leave where id='$id'");
//    $getdata = qs("select *, CONCAT(te.fname, ' ', te.lname) as notifyby from tb_leave tl,tb_employee te where tl.id='$id' and te.id = tl.notify_manager ");
//    d($getdata);
//    die;
    echo json_encode($getdata);
    die;
}
$LeaveData = q("select tl.*,te.fname,te.lname from  tb_leave tl,tb_employee te where tl.emp_id=te.id and NOT tl.status=0");
$jsInclude = 'leave.js.php';
_cg("page_title", "leave");


            