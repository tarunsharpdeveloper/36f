<?php
$late_arrival = 0;
$late_arrival_hour = 0;
$late_arrival_min = 0;

$overtime = 0;
$overtime_hour = 0;
$overtime_min = 0;

$early_dep = 0;
$early_dep_hour = 0;
$early_dep_min = 0;

$abandoned = 0;
$abandoned_hour = 0;
$abandoned_min = 0;

$remove_hour = 0;
$remove_min = 0;

$withPayment[] = 'Sick';
$withoutPayment[] = 'Time off (without payment)';


$totalDK_min = (count($data) * 20) + ((count($data) * 7) * 60);

foreach ($data as $value) {
    ?>
    <tr>
        <td>
            <?= date("m/d", strtotime($value['shift_date'])); ?>
        </td>
        <td>
            <?php $location = qs("SELECT * FROM `tb_location` where id='" . $value['work_location'] . "'"); ?>
            <?= $location['name']; ?>
        </td>
        <td>
            <?= date("h:i A", strtotime($value['shift_start_time'])) . " - " . date("h:i A", strtotime($value['shift_end_time'])) ?>
        </td>
        <td>
            <div class="btn btn-warning btn-sm" onclick=" $('.emp' + <?= $value['id'] ?>).toggle('slow');">view detail</div>
        </td>
    </tr>
    <tr class="emp<?= $value['id'] ?>" style='display: none;'>
        <td colspan="4">
            <table class="table table-bordered table-condensed table-striped">
                <tr>
                    <th>
                        Date
                    </th>
                    <th>
                        Reason
                    </th>
                    <th>
                        Time
                    </th>
                </tr>
                <tbody><?php
                    $dataDetail = q("SELECT * FROM `timesheet_summary_detail` where timesheet_id='" . $value['id'] . "'");
                    $dataDetailCheckout = qs("SELECT * FROM `timesheet_summary_detail` where timesheet_id='" . $value['id'] . "' AND time_detail='Checkin'");
                    if ($value['absence_type'] == '' && (strtotime($value['shift_end_time']) <= strtotime($dataDetailCheckout['time']))) {
                        foreach ($dataDetail as $dataDetailValue) {
                            ?>
                            <tr>
                                <td>
                                    <?= date("m/d", strtotime($dataDetailValue['shiftdate'])); ?>
                                </td>
                                <td>
                                    <?= $dataDetailValue['time_detail']; ?>
                                </td>
                                <td>
                                    <?= date("h:i A", strtotime($dataDetailValue['time'])) ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3">
                                <div class="panel" style="margin: 0px;padding: 0px">
                                    <div class="panel-body">
                                        <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                                            <h3><b>Starting Karkaard</b></h3><br/>
                                            <?php echo floor($totalDK_min / 60) . ":" . ($totalDK_min % 60) ?>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                                            <h3><b> Reason</b></h3><br/>         
                                            <?php echo "Checkin after shift time"; ?>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                                            <h3><b> Hour</b></h3><br/>         
                                            <?php echo "7:20"; ?>
                                        </div>
                                        <?php $totalDK_min = $totalDK_min - 20 - (7 * 60); ?>
                                        <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                                            <h3><b>Monthly Karkaard</b></h3><br/>
                                            <?php echo floor($totalDK_min / 60) . ":" . ($totalDK_min % 60) ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    } else if ($value['absence_type'] == '' && empty($dataDetail)) {
                        $leaveCalander = qs("select * from timesheet_leave where leave_date='{$value['shift_date']}'");
                        if (empty($leaveCalander)) {
                            $sunday_leave = 0;
                        } else {
                            $sunday_leave = 1;
                        }
                        if ($sunday_leave == 0) {
                            ?>
                            <tr>
                                <td>
                                    Missing
                                </td>
                                <td>
                                    Missing
                                </td>
                                <td>
                                    Missing
                                </td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td colspan="3" style="text-align: center;color:red;font-weight: bold;"> 
                                    <?= $leaveCalander['reason'] . " Leave" ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3">
                                <div class="panel" style="margin: 0px;padding: 0px">
                                    <div class="panel-body">
                                        <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                                            <h3><b>Starting Karkaard</b></h3><br/>
                                            <?php echo floor($totalDK_min / 60) . ":" . ($totalDK_min % 60) ?>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                                            <h3><b> Reason</b></h3><br/>         
                                            <?php echo $leaveCalander['reason'] != '' ? $leaveCalander['reason'] . " Leave" : " Daily detail missing" ?> 
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                                            <h3><b> Hour</b></h3><br/>         
                                            <?php echo $leaveCalander['reason'] != '' ? "00:00" : "7:20" ?> 

                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                                            <h3><b>Monthly Karkaard</b></h3><br/>
                                            <?php
                                            if (empty($leaveCalander)) {
                                                $totalDK_min = $totalDK_min - 20 - (7 * 60);
                                                echo floor($totalDK_min / 60) . ":" . ($totalDK_min % 60);
                                            } else {
                                                echo floor($totalDK_min / 60) . ":" . ($totalDK_min % 60);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    } else if (in_array($value['absence_type'], $withPayment) || $value['absence_type'] == '') {
                        if ($dataDetail) {
                            foreach ($dataDetail as $dataDetailValue) {
                                ?>
                                <tr>
                                    <td>
                                        <?= date("m/d", strtotime($dataDetailValue['shiftdate'])); ?>
                                    </td>
                                    <td> 
                                        <?= $dataDetailValue['time_detail']; ?>
                                    </td>
                                    <td>
                                        <?= date("h:i A", strtotime($dataDetailValue['time'])) ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td>
                                    Missing
                                </td>
                                <td>
                                    Missing
                                </td>
                                <td>
                                    Missing
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3">
                                <div class="panel" style="margin: 0px;padding: 0px">
                                    <div class="panel-body">
                                        <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                                            <h3><b>Starting Karkaard</b></h3><br/>
                                            <?php echo floor($totalDK_min / 60) . ":" . ($totalDK_min % 60) ?>
                                        </div>
                                        <?php
                                        $daily_late_arrival = explode(":", $value['late_arrival']);
                                        $abandoned_falg = 0;
                                        if ((($daily_late_arrival[0] * 60) + $daily_late_arrival[1]) > 120) {
                                            $totalDK_min = $totalDK_min - 20 - (7 * 60);
                                            $abandoned_falg = 1;
                                        } else {
                                            $abandoned_falg = 0;
                                            $totalDK_min = $totalDK_min - $daily_late_arrival[1] - ($daily_late_arrival[0] * 60);
                                        }
                                        $daily_early_dep = explode(":", $value['early_dep']);
                                        $totalDK_min = $totalDK_min - $daily_early_dep[1] - ($daily_early_dep[0] * 60);

                                        $daily_overtime = explode(":", $value['overtime']);
                                        $totalDK_min = $totalDK_min + $daily_overtime[1] + ($daily_overtime[0] * 60);
                                        ?>
                                        <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">


                                            <h3><b> Reason</b></h3><br/>         
                                            <?php
                                            if (in_array($value['absence_type'], $withPayment)) {
                                                echo $value['absence_type'];
                                            } else {
                                                if ($abandoned_falg == '1') {
                                                    echo "Job Abandonment Applied";
                                                } else {
                                                    echo $value['late_arrival'] != '00:00' ? "Late Arrival<br>" : "";
                                                    echo $value['early_dep'] != '00:00' ? "Early Depature<br>" : "";
                                                    echo $value['overtime'] != '00:00' ? "Overtime<br>" : "";
                                                }
                                            }
                                            ?> 
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                                            <h3><b> Hour</b></h3><br/>  

                                            <?php
                                            if (in_array($value['absence_type'], $withoutPayment)) {
                                                echo "00:00";
                                            } else {
                                                if ($abandoned_falg == '1') {
                                                    echo "7:20";
                                                } else {
                                                    echo $value['late_arrival'] != '00:00' ? $value['late_arrival'] . "<br>" : "";
                                                    echo $value['early_dep'] != '00:00' ? $value['early_dep'] . "<br>" : "";
                                                    echo $value['overtime'] != '00:00' ? $value['overtime'] . "<br>" : "";
                                                }
                                            }
                                            ?> 

                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                                            <h3><b>Monthly Karkaard</b></h3><br/>
                                            <?php
                                            echo floor($totalDK_min / 60) . ":" . ($totalDK_min % 60);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } else {
                        ?>
                        <tr>
                            <td>
                                Missing
                            </td>
                            <td>
                                Missing
                            </td>
                            <td>
                                Missing
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="panel" style="margin: 0px;padding: 0px">
                                    <div class="panel-body">
                                        <div class="col-lg-6 col-md-6 col-sm-12" style="text-align: center;">
                                            <h3><b>Late Arrival</b></h3><br/>
                                            <?= "N/A"; ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12" style="text-align: center;">
                                            <h3><b>Early Departure</b></h3><br/>         
                                            <?= "N/A"; ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3">
                                <div class="panel" style="margin: 0px;padding: 0px">
                                    <div class="panel-body">
                                        <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                                            <h3><b>Starting Karkaard</b></h3><br/>
                                            <?php echo floor($totalDK_min / 60) . ":" . ($totalDK_min % 60) ?>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                                            <h3><b> Reason</b></h3><br/>         
                                            <?php echo $value['absence_type']; ?>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                                            <h3><b> Hour</b></h3><br/>         
                                            <?php echo "7:20"; ?>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                                            <h3><b>Monthly Karkaard</b></h3><br/>
                                            <?php
                                            $daily_min = (7 * 60) + 20;
                                            $totalDK_min = $totalDK_min - $daily_min;
                                            echo floor($totalDK_min / 60) . ":" . ($totalDK_min % 60);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </td>
    </tr>

    <?php
    $overtime = explode(":", $value['overtime']);
    $overtime_hour = $overtime_hour + $overtime[0];
    $overtime_min = $overtime_min + $overtime[1];

    $late_arrival = explode(":", $value['late_arrival']);
    if ((($late_arrival[0] * 60) + $late_arrival[1]) > 120) {
        $remove_hour = $remove_hour + 7;
        $remove_min = $remove_min + 20;
    } else {
        $late_arrival_hour = $late_arrival_hour + $late_arrival[0];
        $late_arrival_min = $late_arrival_min + $late_arrival[1];
    }

    $early_dep = explode(":", $value['early_dep']);
    $early_dep_hour = $early_dep_hour + $early_dep[0];
    $early_dep_min = $early_dep_min + $early_dep[1];

    $abandoned = explode(":", $value['daily_karkaard']);
    $abandoned_hour = $abandoned_hour + $abandoned[0];
    $abandoned_min = $abandoned_min + $abandoned[1];
    if ($value['absence_type'] !== '' && in_array($value['absence_type'], $withoutPayment)) {
        $rHour = explode(":", $value['daily_karkaard']);
        $remove_hour = $remove_hour + $rHour[0];
        $remove_min = $remove_min + $rHour[1];
    }
    if ($value['absence_type'] == '' && empty($dataDetail)) {
        $leaveCalander = qs("select * from timesheet_leave where leave_date='{$value['shift_date']}'");
        if (empty($leaveCalander)) {
            $remove_hour = $remove_hour + 7;
            $remove_min = $remove_min + 20;
        }
    }
    if ($value['absence_type'] == '' && (strtotime($value['shift_end_time']) <= strtotime($dataDetailCheckout['time']))) {
        $remove_hour = $remove_hour + 7;
        $remove_min = $remove_min + 20;
    }
}
if ($late_arrival_min >= 60) {
    $late_arrival_hour = $late_arrival_hour + floor($late_arrival_min / 60);
    $late_arrival_min = $late_arrival_min % 60;
}

if ($early_dep_min >= 60) {
    $early_dep_hour = $early_dep_hour + floor($early_dep_min / 60);
    $early_dep_min = $early_dep_min % 60;
}
if ($abandoned_min >= 60) {
    $abandoned_hour = $abandoned_hour + floor($abandoned_min / 60);
    $abandoned_min = $abandoned_min % 60;
}
if ($remove_min >= 60) {
    $remove_hour = $remove_hour + floor($remove_min / 60);
    $remove_min = $remove_min % 60;
}
?>
<tr>
    <td colspan="4" style='text-align: center'> 
        <div class='btn btn-success' onclick="$('#summary').toggle()">CALCULATE MONTHLY SCORE</div>
    </td>
</tr>
<tr id="summary" style='display:none'>
    <td colspan="4">
        <div class="panel" style="margin: 0px;padding: 0px">
            <div class="panel-body">
                <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                    <h3><b>Late Arrival</b></h3><br/>
                    <?= $late_arrival_hour . ":" . $late_arrival_min; ?>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                    <h3><b>Early Departure</b></h3><br/>
                    <?= $early_dep_hour . ":" . $early_dep_min; ?>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: center;">
                    <h3><b>Overtime</b></h3><br/>
                    <?= $overtime_hour . ":" . $overtime_min; ?>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12" style="text-align: center;">
                    <h3><b>Daily Karkaard</b></h3><br/>
                    <?php
                    $totalDeductHour = $late_arrival_hour + $early_dep_hour + $remove_hour;
                    $totalDeductMin = $late_arrival_min + $early_dep_min + $remove_min;
                    if ($totalDeductMin >= 60) {
                        $totalDeductHour = $totalDeductHour + floor($totalDeductMin / 60);
                        $totalDeductMin = $totalDeductMin % 60;
                    }

                    echo "Total : " . $abandoned_hour . ":" . $abandoned_min . "<br>";

                    $totalMin = $totalDeductMin + ($totalDeductHour * 60);
                    $totalMainMin = $abandoned_min + ($abandoned_hour * 60) + ($overtime_hour * 60) + $overtime_min;
                    $totalMainMin = $totalMainMin - $totalMin;
                    if ($totalMainMin >= 60) {
                        $totalHour = floor($totalMainMin / 60);
                        $totalMin = $totalMainMin % 60;
                    }
                    echo "Final Hour :" . $totalHour . ":" . $totalMin . "<br>";
                    ?>
                </div>
            </div>
        </div>
    </td>
</tr>