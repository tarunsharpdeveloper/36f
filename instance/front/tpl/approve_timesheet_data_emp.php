

<table id="emptable" class="table table-striped responsive no-wrap" cellspacing="0" width="100%" style="margin: 0px;padding: 0px;width: 100%;">
    <thead id="tabelHeading" >
        <tr>
            <!--<th style=""><input type="checkbox" class="selectall" id="all"></th>-->
            <!--<th>Employee</th>-->
            <th >Date</th>
            <th >Shift/Status</th>
            <th>1st Clock In</th>
            <th>1st Clock Out</th>

            <th>2nd Clock In</th>
            <th>2nd Clock Out</th>
            <th>lunch out</th>
            <th>lunch In</th>
            <th>Over Time</th>
            <th>late arrival</th>
            <th>Penalize</th>
            <th>early dept.</th>
            <th>Penalize</th>
            <th>Time Off</th>
            <th></th>
        </tr>

    </thead>
    <tbody id="tabelBody">
        <?php
        foreach ($arrayDate as $Daily) {
            ?>
            <tr style="cursor: pointer;" >
                <td colspan='20' style="font-weight: bold;"><?= date("D, d/m", strtotime($Daily)); ?></td>
                <?php
                $timesheet = q("select sf.*, sf.id as sfid,e.fname,e.lname from tb_employee e, tb_shift_time sf where e.id=sf.user_id AND e.work_at='{$_SESSION['company']['id']}' AND sf.sDate='$Daily'" . $lastQuery);

//                d($timesheet);
                foreach ($timesheet as $work) {
                    ?>

                <tr style="cursor: pointer;" id='<?= $work['id'] ?>'  >
                    <td onclick="OpenModalEditShift(<?= $work['id'] ?>)">
                        <div class="col-xs-3 col-md-3 on-break-tab"><?php echo substr(ucfirst($work['fname']), 0, 1) . '' . substr(ucfirst($work['lname']), 0, 1) ?></div>
                        <?php echo $work['fname'] . " " . $work['lname']; ?><br/>
                        <?php
                        if (!empty($work['lat_clockstart']) && !empty($work['lng_clockstart'])) {
                            echo "Lat: " . $work['lat_clockstart'] . "<br/>Lng : " . $work['lng_clockstart'];
                        }
                        ?>
                    </td>
                    <?php
                    $ass_shift = qs("select * from tb_assign_shift where user_id='{$work['user_id']}' AND start_date='$Daily'");
              
                    ?>                    
                    <!--Assign Shift Time-->
                    <td onclick="OpenModalEditShift(<?= $work['id'] ?>)">
                     
                            <?= $ass_shift['start_time'] . ' - ' . $ass_shift['end_time'] ?></td>

                    <!--Start Work Time (1st Clock In)-->
                    <td onclick="OpenModalEditShift(<?= $work['id'] ?>)"><?php
                        echo $work['start_time'];
                        if (!empty($work['lat_clockstart']) && !empty($work['lng_clockstart'])) {
                            ?>
                            <span style="display: block; text-align: center;"class="" data-toggle="tooltip" data-placement="bottom" title="<?= $work['lat_clockstart'] . ", " . $work['lng_clockstart'] ?>"><i class="fa fa-map-marker"></i></span>
                        <?php } ?>
                    </td>

                    <!--End Work Time (1st Clock Out)-->
                    <td onclick="OpenModalEditShift(<?= $work['id'] ?>)"><?php
                        echo $work['end_time'];
                        if (!empty($work['lat_clockend']) && !empty($work['lng_clockend'])) {
                            ?>
                            <span style="display: block; text-align: center;"class="tooltipped" data-toggle="tooltip" data-placement="bottom" title="<?= $work['lat_clockend'] . ", " . $work['lng_clockend'] ?>"><i class="fa fa-map-marker"></i></span>
                        <?php } ?>
                    </td>


                    <!--Start Work Time (2nd Clock In)-->
                    <td onclick="OpenModalEditShift(<?= $work['id'] ?>)"></td>
                    <!--Start Work Time (2nd Clock Out)-->
                    <td onclick="OpenModalEditShift(<?= $work['id'] ?>)"></td>

                    <!--Lunch Out -->
                    <td onclick="OpenModalEditShift(<?= $work['id'] ?>)">

                        <?php ?>
                        <span style="display: block"> 

                            <?php
                            if (empty($work['lunch_break_start_1'])) {
                                echo "";
                            } else {
                                echo date("H:i", strtotime($work['lunch_break_start_1']));
                            }
                            ?>
                        </span>
                        <span style="display: block">
                            <?php
                            if (empty($work['lunch_break_start_2'])) {
                                echo "";
                            } else {
                                echo date("H:i", strtotime($work['lunch_break_start_2']));
                            }
                            ?>
                        </span>
                        <span style="display: block">
                            <?php
                            if (empty($work['lunch_break_start_3'])) {
                                echo "";
                            } else {
                                echo date("H:i", strtotime($work['lunch_break_start_3']));
                            }
                            ?>
                        </span>

                    </td>
                    <!--Lunch In)-->
                    <td onclick="OpenModalEditShift(<?= $work['id'] ?>)">
                        <span style="display: block">

                            <?php
                            if (empty($work['lunch_break_end_1'])) {
                                echo "";
                            } else {
                                echo date("H:i", strtotime($work['lunch_break_end_1']));
                            }
                            ?>
                        </span>
                        <span style="display: block">
                            <?php
                            if (empty($work['lunch_break_end_2'])) {
                                echo "";
                            } else {
                                echo date("H:i", strtotime($work['lunch_break_end_2']));
                            }
                            ?>
                        </span>
                        <span style="display: block">
                            <?php
                            if (empty($work['lunch_break_end_3'])) {
                                echo "";
                            } else {
                                echo date("H:i", strtotime($work['lunch_break_end_3']));
                            }
                            ?>
                        </span>
                    </td>

                    <!--Over Time)-->
                    <td onclick="OpenModalEditShift(<?= $work['id'] ?>)">
                        <?php
                        $OTtime = "0";
                        if (!empty($ass_shift['start_time'])) {
                            if (!empty($work['start_time'])) {
                                $diff = strtotime($ass_shift['start_time']) - strtotime($work['start_time']); // do the math
                                $tot_min = $diff / 60;
                                $AllowOT = qs("select * from tb_employee_settings where emp_id=' {$work['user_id']}' and company_id='{$_SESSION['company']['id']}'");

                                $OTtime = "0";
                                if ($tot_min >= 0) {
                                    if ($tot_min <= $AllowOT['before_time']) {
                                        $OTtime = $OTtime + $tot_min;
                                    } else {
                                        $OTtime = $OTtime + $AllowOT['before_time'];
                                    }
                                }
                            }
                        } if (!empty($ass_shift['end_time'])) {
                            if (!empty($work['end_time'])) {
                                $diff = strtotime($work['end_time']) - strtotime($ass_shift['end_time']); // do the math
                                $tot_min = $diff / 60;
//                                echo '|' . $tot_min;
                                if ($tot_min >= 0) {
                                    if ($tot_min <= $AllowOT['after_time']) {
                                        $OTtime = $OTtime + $tot_min;
                                    } else {
                                        $OTtime = $OTtime + $AllowOT['after_time'];
                                    }
                                }
                            }
                        }
                        echo $OTtime . " M";
                        ?>

                    </td>

                    <!--Late Arrival Time)-->
                    <td onclick="OpenModalEditShift(<?= $work['id'] ?>)">
                        <?php
                        if (!empty($ass_shift['start_time'])) {
                            if (!empty($work['start_time'])) {
                                $diff = strtotime($work['start_time']) - strtotime($ass_shift['start_time']); // do the math
                                $tot_min = $diff / 60;
                                $AllowLetStart = qs("select * from tb_employee_settings where emp_id=' {$work['user_id']}' and company_id='{$_SESSION['company']['id']}'");
                                $minuteLate = $tot_min - $AllowLetStart['tolrance_timeIn'];

                                if ($minuteLate >= 1) {
                                    echo $minuteLate . " M";
                                } else {
                                    echo $minuteLate = "0";
                                }
                            } else {
                                $minuteLate = "0";
                            }
                        }
                        ?>

                    </td >
                    <!--Late Panalize)-->
                    <td onclick="OpenModalEditShift(<?= $work['id'] ?>)"> 
                        <?php echo $minuteLate = $minuteLate * $AllowLetStart['penalize'] . " M" ?></td>

                    <!--Early dept Time)-->
                    <td onclick="OpenModalEditShift(<?= $work['id'] ?>)">
                        <?php
                        if (!empty($ass_shift['end_time'])) {
                            if (!empty($work['end_time'])) {
                                $diff = strtotime($ass_shift['end_time']) - strtotime($work['end_time']); // do the math
                                $tot_min = $diff / 60;
                                $AllowEarlyEnd = qs("select * from tb_employee_settings where emp_id=' {$work['user_id']}' and company_id='{$_SESSION['company']['id']}'");
                                $minuteEarly = $tot_min - $AllowEarlyEnd['tolrance_timeOut'];
                                if ($minuteEarly >= 1) {
                                    echo $minuteEarly . " M";
                                } else {
                                    echo $minuteEarly = "0";
                                }
                            } else {
                                $minuteEarly = "0";
                            }
                        }
                        ?>

                    </td>
                    <!--Early Panalize)-->
                    <td onclick="OpenModalEditShift(<?= $work['id'] ?>)">
                        <?php echo $minuteEarly = $minuteEarly * $AllowEarlyEnd['penalize'] . " M" ?>
                    </td>

                    <!--Day Time Off)-->
                    <td onclick="OpenModalEditShift(<?= $work['id'] ?>)">
                        <?php // round(($minuteEarly + $minuteLate) / 60, 2) . "H"               ?>
                        <?= $minuteEarly + $minuteLate . "M" ?>
                    </td>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <!--                    <td><?php
//                    if (empty($work['end_time'])) {
//                        echo '-';
//                    } else {
//                        $to_time = strtotime($work['start_time']);
//                        $from_time = strtotime($work['end_time']);
//
//
//                        $totalTime = round(abs($to_time - $from_time) / 60, 2);
//                        $tt = round(abs($totalTime - $work['break_time']) / 60, 2);
//                        $ddt = explode(".", $tt);
//                        echo $ddt[0] . ":";
//                        echo round(abs(($ddt[1]) / 100) * 60);
//                    }
//                    $totalTime = round(($totalTime - $work['break_time']) , 2);
//                    echo "||" . ($totalTime- - $work['break_time']);
                    ?></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td><?= $work['break_time'] ?></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>driver</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td>-</td>-->
                    <td>
                        <?php
                        if (!empty($work['lat_clockstart']) && !empty($work['lng_clockstart'])) {
                            $StartLocationShift = $work['lat_clockstart'] . "," . $work['lng_clockstart'];
                        }
                        if (!empty($work['lat_clockend']) && !empty($work['lng_clockend'])) {
                            $EndLocationShift = $work['lat_clockend'] . "," . $work['lng_clockend'];
                        }
                        ?>
                        <a class="btn btn-alt" href="javascript:void(0)" onclick="GetLocationMap('<?= $StartLocationShift ?>', '<?= $EndLocationShift ?>')">Location
                        </a>
                        <?php
                        if ($work['status'] == "0") {
                            $status = "Approve";
                            $statusBtn = "btn-default";
                        } else {
                            $status = "Unapprove";
                            $statusBtn = "btn-danger";
                        }
                        ?>
                        <a href="javascript:void(0)" class="btn <?= $statusBtn ?>" onclick="onStatus(<?= $work['id'] ?>,<?= $work['status'] ?>)"><?= $status ?> </a></td>
                </tr>
                <?php
            }
//            if (count($timesheet) == 0) {
//                echo "<tr><td colspan='20'>";
//                print _t('41', 'No records found!');
//                echo "</td></tr>";
//            }
            ?>
            </tr> 
            <?php
        }
        ?>

    </tbody>
</table>