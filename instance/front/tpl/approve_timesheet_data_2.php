

<table id="emptable" class="table table-striped responsive no-wrap" cellspacing="0" width="100%" style="margin: 0px;padding: 0px;width: 100%;">
    <thead id="tabelHeading" >
        <tr>
            <th style=""><input type="checkbox" class="selectall" id="all"></th>
            <th>Employee</th>
            <th >Date</th>
            <th>Clock In</th>
            <th>Clock Out</th>
            <th>Length</th>
            <th>Break</th>
            <th>Position</th>
            <th>Location</th>
            <th></th>
        </tr>

    </thead>
    <tbody id="tabelBody">
        <?php
        foreach ($timesheet as $work) {
            ?>


        <!--            <tr>
                        <td><?php echo date("D, d/m", strtotime($work['created_at'])); ?></td>
                    </tr>-->

            <tr style="cursor: pointer;" >
                <td style="float:left;"><input type="checkbox" name="nchild[]" class="child" value="<?php echo $work['id']; ?>"></td>
                <td><?php echo $work['fname'] . " " . $work['lname']; ?></td>
                <td><?php echo date("D, d/m", strtotime($work['created_at'])); ?></td>
                <td><?= $work['start_time']; ?></td>
                <td><?= $work['end_time']; ?></td>
                <td><?php
                    if (empty($work['end_time'])) {
                        echo '-';
                    } else {
                        $to_time = strtotime($work['start_time']);
                        $from_time = strtotime($work['end_time']);


                        $totalTime = round(abs($to_time - $from_time) / 60, 2);
                        $tt = round(abs($totalTime - $work['break_time']) / 60, 2);
                        $ddt = explode(".", $tt);
                        echo $ddt[0] . ":";
                        echo round(abs(($ddt[1]) / 100) * 60);
                    }
//                    $totalTime = round(($totalTime - $work['break_time']) , 2);
//                    echo "||" . ($totalTime- - $work['break_time']);
                    ?></td>
                <td><?= $work['break_time'] ?></td>
                <td>driver</td>
                <td>-</td>
                <td>Approve</td>
            </tr>
            <?php
        } if (count($timesheet) == 0) {
            echo "<tr><td colspan='20'>";
            print _t('41', 'No records found!');
            echo "</td></tr>";
        }
        ?>
<!--                        <tr style="cursor: pointer;" >
<td style="float:left;"><input type="checkbox" name="nchild[]" class="child" value="<?php echo $PostRow['id']; ?>"></td>
<td>Agha neil</td>
<td>9:00am</td>
<td>5:00pm</td>
<td>8h</td>
<td>-</td>
<td>driver</td>
<td>-</td>
<td>Approve</td>
</tr>-->
    </tbody>
</table>