<table class="table table-responsive">
    <tr>
        <th>#</th>
        <th>Employee</th>
        <th>Absence Type</th>
        <th>Timeoff Balance</th>
        <th>From</th>
        <th>To</th>
        <th>Reason</th>
    </tr>
    <?php
    $i = 1;
    foreach ($leaveData as $value) {
        ?>
        <tr>
            <td><?= $i; ?></td>
            <td>
                <?php
//                echo $value['emp_id'] . "<br/>";
                $emp = qs("SELECT * FROM `tb_employee` WHERE `id` ={$value['emp_id']}");
                echo $emp['fname'] . " " . $emp['lname'] . "<Br /><span style='font-size:9px'>ID: " . $value['unique_id'] . "</span>";
                ?>
            </td>
            <td><?php
                if ($value['absence_type'] == 'entireDay') {
                    echo "Entire Day";
                } else {
                    echo "Hourly";
                }
                ?></td>
            <td style="font-size: 12px;"><?php
                $date1 = date_create($value['from_date']);
                $date2 = date_create($value['to_date']);
                $diff = date_diff($date1, $date2);
                $diff->format("%R%a days");

                $emp = qs("SELECT * FROM `employee_leave_balance` WHERE `employee_id` ={$value['emp_id']}");
                $leave_balance = 2;
                $leave_pending_balance = 10;
                echo "Approved: <b>{$emp['leave_balance']}</b><br/>
            Pending: <b>{$emp['leave_pending_balance']}</b><br/>";
                if ($value['status'] == '') {
                    ?>
                    <span style="color:green;font-size:20px;" onclick="leaveManage('<?php echo $diff->format("%a"); ?>', '1', '<?= $value['id'] ?>', '<?= $value['emp_id'] ?>')"><i class="fa fa-check"></i></span>
                    <span style="color:red;font-size:20px;" onclick="leaveManage('<?php echo $diff->format("%a"); ?>', '0', '<?= $value['id'] ?>', '<?= $value['emp_id'] ?>')"><i class="fa fa-times"></i></span>
                <?php } else if ($value['status'] == 'Decline') { ?>
                    <span style="color:red;font-size:12px;" ><i class="fa fa-times"></i> Decline</span>
                <?php } else if ($value['status'] == 'Approved') { ?>
                    <span style="color:green;font-size:12px;"><i class="fa fa-check"></i> Approved</span>

                <?php } ?>
            </td>
            <td><?= date("m/d", strtotime($value['from_date'])); ?></td>
            <td><?= date("m/d", strtotime($value['to_date'])); ?></td>
            <td><?= $value['reason'] ?></td>
        </tr>
        <?php
        $i++;
    }
    ?>
</table>