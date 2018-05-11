<?php
if ($shift_list) {
    foreach ($shift_list as $each_shift) {
        ?>
        <tr>
            <td style="text-transform: uppercase"><?php echo $each_shift['fname'] . " " . $each_shift['lname'] ?> 
                <span style='font-size:10px'>(<?php echo $each_shift['mobile'] ?>)</span> <br />
                <?php if ($each_shift['unique_id']): ?><span style='font-size:10px'>Shift ID:<?php echo $each_shift['unique_id'] ?></span><?php endif; ?>
            </td>
            <td><?php echo date("m-d-Y", strtotime($each_shift['start_date'])) ?></td>
            <td><?php echo $each_shift['start_time'] ?></td>
            <td><?php echo date("m-d-Y", strtotime($each_shift['end_date'])) ?></td>
            <td><?php echo $each_shift['end_time'] ?></td>
            <td><?php echo $each_shift['total_hour'] ?></td>
            <td>
                <div class="btn btn-danger" data-id='<?php echo $each_shift['id'] ?>' onclick="deleteShift(this)">
                    <i class="fa fa-trash"></i> 
                </div>
                <div class="btn btn-danger" data-id='<?php echo $each_shift['id'] ?>' onclick="editShift(this)">
                    <i class="fa fa-pencil"></i> 
                </div>
            </td>
        </tr>
        <?php
    }
}else {
    ?>
<tr>
    <td colspan="7">No Data Available</td>
</tr>
<?php } ?>