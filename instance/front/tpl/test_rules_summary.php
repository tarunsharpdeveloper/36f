<table id="datatable-responsive0a" class="table table-striped no-border responsive no-wrap" cellspacing="0" width="100%" style="margin: 0 0 0 0; border: none;">
    <thead>
        <tr>
            <th>sDate</th>
            <th>Time</th>
            <th>type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $visible = "hidden";
        foreach ($subq as $val) {
            $employeeID = $val['user_id'];
            $visible = "";
            ?>
            <tr>
                <td><?= $val['sDate'] ?></td>
                <td><?= $val['timestamp'] ?></td>
                <td><?= $val['type'] ?></td>
                <td>
                    <a class="btn btn-default" href="javascript:;" onclick="deleteRecords('<?= $val['id'] ?>')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody> 
</table>
<div class="col-sm-12" <?= $visible ?>>
    <a class="btn btn-link small" style="color: #00c6ff;font-weight: bold;float: right;" href="javascript:;" onclick="deleteall('<?= $employeeID; ?>')">Delete All Time Entries</a>
</div>
<div class="col-sm-12" <?= $visible ?>><hr/></div>
<!--<div class="col-sm-12" <?= $visible ?>>
    <a class="btn btn-primary" style="float: right;" href="javascript:;" onclick="bindApplyRules('<?= $employeeID; ?>')">Approve Timesheet</a>
</div>-->
