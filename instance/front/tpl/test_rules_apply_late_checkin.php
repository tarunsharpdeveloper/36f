<tr>
    <td width=" calc(30% - 5px)">Late Checkin  :</td>
    <td  style="color: <?= ($lateCheckin == "Yes") ? "red" : "green"; ?>">
        <?php
        $late_arrival_scenario_applied = "DEFAULT";
        $late_arrival_scenario_tolerance_minutes = 0; // how many minutes to add in the final work hours 
        if ($_REQUEST['late_arrival_tolerance'] == 'yes') {
            $late_arrival_tolerance_minutes = $_REQUEST['late_arrival_tolerance_minutes'];

            if ($lateCheckin == "Yes") {
                $date1 = strtotime($val['CHECKEDIN']);
                $date2 = $staticCheckin;

                # check the difference
                $difference_in_seconds = $date1 - $date2;
                $difference_in_minutes = intval($difference_in_seconds / 60);
                $late_arrival_scenario_tolerance_minutes = $difference_in_minutes;

                if ($difference_in_seconds > ($late_arrival_tolerance_minutes * 60)) {
                    $late_arrival_truancy = $_REQUEST['late_arrival_truancy'];
                    $late_arrival_scenario_applied = "HAS_TOLERANCE_FALLS_EXCEEDS_TOLERANCE";
                    if ($late_arrival_truancy == 'difference') {
                        $date1 = strtotime($val['CHECKEDIN']) - ($late_arrival_tolerance_minutes * 60);
                        $date2 = $staticCheckin;
                        $time = countHours($date1, $date2);
                        echo "Yes ($time) - TRUANCY|DIFFERENCE";
                        $late_arrival_scenario_applied = "HAS_TOLERANCE_EXCEEDS_TRUANCY__DIFERENCE_APPLIED";
                        $late_arrival_scenario_tolerance_minutes = $late_arrival_tolerance_minutes;
                    } else {
                        $date1 = strtotime($val['CHECKEDIN']);
                        $date2 = $staticCheckin;
                        $time = countHours($date1, $date2);
                        echo "Yes ($time) - TRUANCY|ENTIRE";
                        $late_arrival_scenario_applied = "HAS_TOLERANCE_EXCEEDS_TRUANCY__ENTIRE_APPLIED";
                        $late_arrival_scenario_tolerance_minutes = 0;
                    }
                } else {
                    print "Yes, late {$difference_in_minutes} minutes <br />({$late_arrival_tolerance_minutes} minutes grace period for tolerance)";
                    $late_arrival_scenario_applied = "HAS_TOLERANCE_FALLS_WITHIN_RANGE";
                    //$late_arrival_scenario_tolerance_minutes = $late_arrival_scenario_tolerance_minutes;
                }
            } else {
                echo 'NO';
            }
        } else {
            echo $lateCheckin;
            if ($lateCheckin == "Yes") {
                $late_arrival_scenario_applied = "NO_TOLERANCE";
                $date1 = strtotime($val['CHECKEDIN']);
                $date2 = $staticCheckin;
                $time = countHours($date1, $date2);
                echo "($time) - NO TOLERANCE";
            }
        }
        ?></td>
</tr>