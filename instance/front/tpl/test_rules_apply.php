
<?php

//d($data);
function countHours($date1, $date2) {
    $datediff = $date1 - $date2;
    $totalhours = $datediff / 60;
    $d = floor($totalhours / 1440);
    $h = floor(($totalhours - $d * 1440) / 60);
    $m = $totalhours - ($d * 1440) - ($h * 60);
    if ($h == "" OR $h == null) {
        $time = "$m m";
    } else {
        $time = "$h h $m m";
    }
    return $time;
}

foreach ($data as $val) {

    $staticCheckin = strtotime($startTime);
    $staticCheckOut = strtotime($endTime);
    $earlyCheckin = "";
    $earlyCheckout = "";
    $lateCheckin = "";
    $lateCheckout = "";
//    if ($staticCheckin > $val['CHECKEDIN']) {
//        $earlyCheckin = "Yes";
//    } else {
//        $earlyCheckin = "No";
//    }





    $lateCheckin = ($staticCheckin < strtotime($val['CHECKEDIN'])) ? "Yes" : "No";
    $earlyCheckout = ($staticCheckOut > strtotime($val['CHECKOUT'])) ? "Yes" : "No";

    $earlyCheckin = ($staticCheckin > strtotime($val['CHECKEDIN'])) ? "Yes" : "No";
    $lateCheckout = ($staticCheckOut < strtotime($val['CHECKOUT'])) ? "Yes" : "No";


    if (!empty($val['CHECKEDIN']) && !empty($val['CHECKOUT'])):
        ?>
        <h2>Timsheet ID: <?php print base64_encode(mt_rand(0, 1000)); ?></h2>
        <table class="table table-striped no-border responsive no-wrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th >RESULT: <?= date("Y-m-d ", strtotime($val['date'])); ?></th>
                    <th ></th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width=" calc(30% - 5px)">Early Checkin  :</td>
                    <td style="color: <?= ($earlyCheckin == "Yes") ? "red" : "green"; ?>">
                        <?php
                        echo $earlyCheckin . "  ";
                        if ($earlyCheckin == "Yes") {
                            $date1 = $staticCheckin;
                            $date2 = strtotime($val['CHECKEDIN']);
                            $time = countHours($date1, $date2);
                            echo "($time)";
                        }
                        ?>
                    </td>
                </tr>
                <?php include "test_rules_apply_late_checkin.php"; ?>
                <?php include "test_rules_apply_early_departure.php"; ?>


                <tr>
                    <td>Late Checkout : </td>
                    <td style="color: <?= ($lateCheckout == "Yes") ? "red" : "green"; ?>">
                        <?php
                        echo $lateCheckout;
                        if ($lateCheckout == "Yes") {
                            $date2 = $staticCheckOut;
                            $date1 = strtotime($val['CHECKOUT']);
                            $time = countHours($date1, $date2);
                            echo "($time)";
                        }
                        ?>
                    </td>
                </tr>
                <?php include "test_rules_apply_ot.php"; ?>
            </tbody>
        </table>
        <?php
    endif;
}
?>
<div class="col-lg-12 col-sm-12">
    <h5 style="font-weight: bold;color: #00c6ff">Timesheet Summary:  </h5>

</div>
<div class="col-lg-12 col-sm-12 ">
    <hr>
</div>
<table id="datatable-responsive0b" class="table table-striped no-border responsive no-wrap" cellspacing="0" width="100%" style="margin: 0 0 0 0; border: none;">
    <thead>
        <tr>
            <th>Date</th>
            <th>Total Hour</th>
            <th>Scenarios Applied</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $visible = "hidden";

        foreach ($data as $val) {
            $employeeID = $val['user_id'];
            $visible = "";
            if (!empty($val['CHECKEDIN']) && !empty($val['CHECKOUT'])):
                ?>
                <tr>
                    <td><?= date("Y-m-d ", strtotime($val['date'])); ?></td>
                    <td><?php
                        $checkout = strtotime($val['CHECKOUT']);
                        $checkin = strtotime($val['CHECKEDIN']);
                        $final_work_hours = $datediff = $checkout - $checkin;
                        $time_diff_actual = calcDiffFromSeconds($datediff, 'formated');
                        $shift_work_seconds = strtotime($endTime) - strtotime($startTime);
                        $shift_work_hours = calcDiffFromSeconds($shift_work_seconds, 'formated');

                        // if ot applied - then approved hours = shift times + total ot applied
                        if ($ot_scenario_applied == "OT_APPLIED") {
                            $final_work_hours = $shift_work_seconds + ($ot_approved_seconds);
                        } else if ($ot_scenario_applied == "NO_OT") {
                            $final_work_hours = $shift_work_seconds;
                        }

                        // if late arrival - then add the tolerance
                        if ($late_arrival_scenario_tolerance_minutes > 0) {
                            #add the tolerance from the late arrival rules
                            $final_work_hours = $final_work_hours + ($late_arrival_scenario_tolerance_minutes * 60);
                        }
                        // if early departure - then add the tolerance
                        if ($early_dep_scenario_tolerance_minutes > 0) {
                            #add the tolerance from the late arrival rules
                            $final_work_hours = $final_work_hours + ($early_dep_scenario_tolerance_minutes * 60);
                        }

                        $final_work_hours = calcDiffFromSeconds($final_work_hours, 'formated');
                        echo "Actual Time: <b>{$time_diff_actual}</b> <br /><small>(gap between checkout and checkin)</small>"; // actual is checking -chckout
                        print "<br /><br />Final Work Hours: <b>{$shift_work_hours}</b> <br /><small>(gap between schedule start and end)</small>"; // final is basically schedule
                        print "<br /><br />Approved Work Hours: <b>{$final_work_hours}</b> <br /><small>(after adding tolerance, approved ot, etc)</small>"; // approved is what is approved
                        ?>
                    </td>
                    <td>
                        <?php include "test_rules_scenarios.php"; ?>
                    </td>
                </tr>
                <?php
            endif;
        }
        ?>
    </tbody> 
</table>
<!--<div class="col-sm-12" <?= $visible ?>>
    <a class="btn btn-link small" style="color: #00c6ff;font-weight: bold;float: right;" href="#" onclick="deleteall('<?= $employeeID; ?>')">Delete All Time Entries</a>
</div>
<div class="col-sm-12" <?= $visible ?>><hr/></div>
<div class="col-sm-12" <?= $visible ?>>
    <a class="btn btn-primary" style="float: right;" href="#" >Approve Timesheet</a>
</div>-->
