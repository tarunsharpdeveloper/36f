<?php
$team = q("select * from tb_team where company_id='{$_SESSION['company']['id']}'");
?>

<table id="datatable-responsive" class="table table-striped responsive no-wrap" cellspacing="0" width="100%" style="margin: 0 0 0 0;">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Location</th>
            <th>Company Name</th>
            <th>action</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $i = 1;
        foreach ($team as $cmp) {
            ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $cmp['name'] ?></td>
                <td><?php
                    $llid = explode(",", $cmp['location_id']);
                    foreach ($llid as $lid) {
                        $locanme = qs("SELECT * FROM `tb_location` where id='$lid'");
                        echo "<span style='display:block;'>" . $locanme['name'] . "</span>";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    $com_name = qs("select name from tb_company_works where id='{$cmp['company_id']}'");
                    echo $com_name['name']
                    ?>
                </td>
                <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $cmp['id']; ?>" >
                    <span><i style="padding-top: 9px;" class="btn btn-primary fa fa-edit teamEdit"  data-id="<?php echo $cmp['id']; ?>"></i></span>
                    <span><i style="padding-top: 9px;" class="btn btn-links danger remove fa fa-trash-o teamDelete"  data-id="<?php echo $cmp['id']; ?>" ></i></span>
                </td>

            </tr> 
            <?php
            $i++;
        }
        ?>

    </tbody>
</table>