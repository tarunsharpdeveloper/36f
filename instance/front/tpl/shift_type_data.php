<table class="table table-striped responsive no-wrap" id="empTables">
    <thead>
        <tr>
            <th style="width: 5%;">#</th>
            <th id="tbl_1" style="width: 40%;" class="tb-none tb-th">Name</th>
            <th id="tbl_3" style="width: 20%;" class="tb-none tb-th" style="">Time</th>
            <th id="tbl_3" style="width: 20%;" class="tb-none tb-th" style="">Deduction</th>
            <th id="tbl_4" style="width: 15%;" class="tb-none tb-th">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = "1";
        if (empty($PostResult)) {
            ?>
            <tr><td colspan="11"><?php echo "No Record Found!!!!!"; ?></td></tr>
            <?php
        } else {
            foreach ($PostResult as $PostRow) {
                ?>
                <tr>

                    <td style="width:15px">
                        <?= $i; ?>
                    </td>
                    <td style="" class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>">
                        <?php echo $PostRow['shift_name']; ?>
                    </td>

                    <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>" >
                        <?php echo $PostRow['start_time'] . " To " . $PostRow['end_time'] . " | " . $PostRow['shift_time']; ?>
                    </td>
                    <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>" >
                        <span><?php echo $PostRow['deduction']; ?></span>
                    </td>
                    <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>">
                        <!--                                <button class="btn btn-round btn-default">
                                                            <i class="glyph-icon icon-download"></i>
                                                        </button>-->
                        <button class="btn btn-round btn-info btn_edit" data-id="<?php echo $PostRow['id']; ?>" >
                            <i class="glyph-icon icon-pencil"></i>
                        </button>
                        <button class="btn btn-round btn-danger btn_delete" data-id="<?php echo $PostRow['id']; ?>">
                            <i class="glyph-icon icon-trash"></i>
                        </button>
                    </td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>