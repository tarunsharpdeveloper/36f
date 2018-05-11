<tr>
    <td width=" calc(30% - 5px)">Early Departure :</td>
    <td  style="color: <?= ($earlyCheckout == "Yes") ? "red" : "green"; ?>">
        <?php
        $early_dep_scenario_applied = "DEFAULT";
        $early_dep_scenario_tolerance_minutes = 0; // how many minutes to add in the final work hours 
        if ($_REQUEST['early_departure_tolerance'] == 'yes') {

            # what is the tolerance limit company has set ?
            $early_dep_tolerance_minutes = $_REQUEST['early_departure_tolerance_minutes'];

            if ($earlyCheckout == "Yes") {

                # value we have received from the chekcout
                $date1 = strtotime($val['CHECKOUT']);
                $date2 = $staticCheckOut;

                # check the difference
                $difference_in_seconds = $date2- $date1;
                $difference_in_minutes_ed = intval($difference_in_seconds / 60);

                # how early user has checked out
                $early_dep_scenario_tolerance_minutes = $difference_in_minutes_ed;

                if ($difference_in_seconds > ($early_dep_tolerance_minutes * 60)) {
                    $early_dep_truancy = $_REQUEST['early_departure_truancy'];
                    $early_dep_scenario_applied = "HAS_TOLERANCE_FALLS_EXCEEDS_TOLERANCE";
                    if ($early_dep_truancy == 'difference') {
                        //$date1 = ($early_dep_tolerance_minutes * 60) + strtotime($val['CHECKOUT']) ;
                        //$date2 = $staticCheckOut;
                        //$time = countHours($date2, $date1);
                        //echo "Yes ($time) - TRUANCY|DIFFERENCE";
                        echo "Yes ($difference_in_minutes_ed) - TRUANCY|DIFFERENCE";
                        $early_dep_scenario_applied = "HAS_TOLERANCE_EXCEEDS_TRUANCY__DIFERENCE_APPLIED";
                        $early_dep_scenario_tolerance_minutes = $early_dep_tolerance_minutes;
                    } else {
                        echo "Yes ($difference_in_minutes_ed) - TRUANCY|ENTIRE";
                        $early_dep_scenario_applied = "HAS_TOLERANCE_EXCEEDS_TRUANCY__ENTIRE_APPLIED";
                        $early_dep_scenario_tolerance_minutes = 0;
                    }
                } else {
                    print "Yes, late {$difference_in_minutes_ed} minutes <br />({$early_dep_tolerance_minutes} minutes grace period for tolerance)";
                    $early_dep_scenario_applied = "HAS_TOLERANCE_FALLS_WITHIN_RANGE";
                    //$early_dep_scenario_tolerance_minutes = $early_dep_scenario_tolerance_minutes;
                }
            } else {
                echo 'NO';
            }
        } else {
            echo $earlyCheckout ;
            //$early_dep_scenario_applied = "NO_TOLERANCE";
            $date1 = $staticCheckOut;
            $date2 = strtotime($val['CHECKOUT']);
            $time = countHours($date1, $date2);
            //echo "($time)";
        }
        ?></td>
</tr>