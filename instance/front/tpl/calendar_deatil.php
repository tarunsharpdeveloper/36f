
<h3>Weekend Holidays</h3> 
<table class="table table-responsive table-condensed">
    <thead>
        <tr>
            <th>Date</th>
            <th>persian date</th>
            <th>Holiday (English)</th>
            <th>Holiday (Farsi)</th>
            <th>Level</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($leaveDetail as $value) {
            $timestamp = strtotime($value['leave_date']);

            $day = date('D', $timestamp);
            if ($day == 'Sun') {
                ?>
                <tr>
                    <td  style="width: 15%;"><?= $value['leave_date'] ?></td>
                    <td  style="width: 15%;"><?= $value['persian_date'] ?></td>
                    <td  style="width: 25%;"><?= $value['reason'] ?></td>
                    <td  style="width: 25%;"><?= $value['farsi_reason'] ?></td>
                    <td  style="width: 10%;"><?= $value['level'] ?></td>
                    <td  style="width: 10%;"><i class="fa fa-edit" onclick="editLeave('<?= $value['id'] ?>', '<?= $value['leave_date'] ?>', '<?= $value['reason'] ?>', '<?= $value['farsi_reason'] ?>', '<?= $value['level'] ?>')"></i>&nbsp;&nbsp;<i class="fa fa-trash" onclick="deleteLeave('<?php echo $value['id'] ?>')"></i></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<h3>National Holidays</h3>
<table class="table table-responsive table-condensed">
    <thead>
        <tr>
            <th>Date</th>
            <th>persian date</th>
            <th>Holiday (English)</th>
            <th>Holiday (Farsi)</th>
            <th>Level</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($leaveDetail as $value) {
            $timestamp = strtotime($value['leave_date']);
            $day = date('D', $timestamp);
            if ($day != 'Sun') {
                ?>
                <tr>
                    <td style="width: 15%;"><?= $value['leave_date'] ?></td>
                    <td style="width: 15%;"><?= $value['persian_date'] ?></td>
                    <td style="width: 25%;"><?= $value['reason'] ?></td>
                    <td style="width: 25%;"><?= $value['farsi_reason'] ?></td>
                    <td style="width: 10%;"><?= $value['level'] ?></td>
                    <td style="width: 10%;"><i class="fa fa-edit" onclick="editLeave('<?= $value['id'] ?>', '<?= $value['leave_date'] ?>', '<?= $value['reason'] ?>', '<?= $value['farsi_reason'] ?>', '<?= $value['level'] ?>')"></i>&nbsp;&nbsp;<i class="fa fa-trash" onclick="deleteLeave('<?php echo $value['id'] ?>')"></i></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>