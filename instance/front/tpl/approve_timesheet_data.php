
<table id="timesheet-table" class="table table-striped responsive no-wrap" cellspacing="0" width="100%" style="margin: 0px;padding: 0px;width: 100%;">
    <thead >
        <tr >
            <th >Date</th>
            <th >Status</th>
            <th >Progress</th>
            <th >Area Of Work</th>
            <th >Time</th>
            <th >Hours</th>

        </tr>
    </thead>



    <tbody>
        <?php
//        $timesheet = $_SESSION["timesheetData"];
//                        d($timesheet);
        foreach ($timesheet as $row) {
            ?>
            <tr id="tr_<?= $row['id'] ?>" onclick="getschedule('<?= $row['id'] ?>')" style="cursor: pointer;">
                <td><?php echo date("D, d/m", strtotime($row['created_at'])); ?></td>
                <td><?php
                    if ($row['status'] == "0"): echo "<span style='background-color:gray;color:white;'>Pending</span>";
                    elseif ($row['status'] == "1"): echo "<span style='background-color:green;color:white;'>accepted</span>";
                    else: echo "<span style='background-color:Red;color:white;'>Declined</span>";
                    endif;
                    ?></td>
                <td><?php echo $row['progress']; ?></td>
                <td><?php echo $row['area_of_work']; ?></td>
                <td><?php echo $row['start_time'] . " | " . $row['end_time'] . " | " . $row['break_time']; ?></td>
                <td><?php
                    $to_time = strtotime($row['start_time']);
                    $from_time = strtotime($row['end_time']);
                    $totalTime = round(abs($to_time - $from_time) / 60, 2);
                    echo (($totalTime - $row['break_time']) / 60);
                    ?></td>

            </tr><?php
        }
        if (count($timesheet) == 0) {
            echo "<tr><td colspan='20'>";
            print _t('41', 'No records found!');
            echo "</td></tr>";
        }
        ?>

    </tbody>
</table>