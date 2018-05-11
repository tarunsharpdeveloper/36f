<!--<div class="col-sm-8 " id="empDi"  >-->
<?php
//d($lastQuery);
$allData = q("select * from tb_schedule_template");
?>
<table class="table table-striped responsive no-wrap" id="empTables">
    <thead>
        <tr>
            <th style="width:15px">#</th>
            <th style="">Name</th>
            <th id="tbl_1" class="tb-none tb-th">Monday</th>
            <th id="tbl_1" class="tb-none tb-th">Tuesday</th>
            <th id="tbl_1" class="tb-none tb-th">Wednesday</th>
            <th id="tbl_1" class="tb-none tb-th">Thursday</th>
            <th id="tbl_1" class="tb-none tb-th">Friday</th>
            <th id="tbl_1" class="tb-none tb-th">Saturday</th>
            <th id="tbl_1" class="tb-none tb-th">Sunday</th>
            <th id="tbl_5" class="tb-none tb-th">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($allData)) { ?>
            <tr><td colspan="11"><?php echo "No Record Found!!!!!"; ?></td></tr>
            <?php
        } else {
            $i = "1";
            foreach ($allData as $PostRow) {
                ?>
                <tr>
                    <td style="width:15px"><?= $i; ?></td>
                    <td style="" class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>">
                        <?= $PostRow['template_name'] ?>
                    </td>
                    <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>" >
                        <span style="display: block"> <?php echo $PostRow['mon_start'] == "" ? "-" : "Start Time: " . $PostRow['mon_start']; ?></span>
                        <span style="display: block"> <?php echo $PostRow['mon_end'] == "" ? "-" : "End Time: " . $PostRow['mon_end']; ?></span>
                    </td>
                    <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>" >
                        <span style="display: block"> <?php echo $PostRow['tue_start'] == "" ? "-" : "Start Time: " . $PostRow['tue_start']; ?></span>
                        <span style="display: block"> <?php echo $PostRow['tue_end'] == "" ? "-" : "End Time: " . $PostRow['tue_end']; ?></span>
                    </td>
                    <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>" >
                        <span style="display: block"> <?php echo $PostRow['wed_start'] == "" ? "-" : "Start Time: " . $PostRow['wed_start']; ?></span>
                        <span style="display: block"> <?php echo $PostRow['wed_end'] == "" ? "-" : "End Time: " . $PostRow['wed_end']; ?></span>
                    </td>
                    <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>" >
                        <span style="display: block"> <?php echo $PostRow['thu_start'] == "" ? "-" : "Start Time: " . $PostRow['thu_start']; ?></span>
                        <span style="display: block"> <?php echo $PostRow['thu_end'] == "" ? "-" : "End Time: " . $PostRow['thu_end']; ?></span>
                    </td>
                    <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>" >
                        <span style="display: block"> <?php echo $PostRow['fri_start'] == "" ? "-" : "Start Time: " . $PostRow['fri_start']; ?></span>
                        <span style="display: block"> <?php echo $PostRow['fri_end'] == "" ? "-" : "End Time: " . $PostRow['fri_end']; ?></span>
                    </td>
                    <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>" >
                        <span style="display: block"> <?php echo $PostRow['sat_start'] == "" ? "-" : "Start Time:" . $PostRow['sat_start']; ?></span>
                        <span style="display: block"> <?php echo $PostRow['sat_end'] == "" ? "-" : "End Time:" . $PostRow['sat_end']; ?></span>
                    </td>
                    <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>" >
                        <span style="display: block"> <?php echo $PostRow['sun_start'] == "" ? "-" : "Start Time:" . $PostRow['sun_start']; ?></span>
                        <span style="display: block"> <?php echo $PostRow['sun_end'] == "" ? "-" : "End Time:" . $PostRow['sun_end']; ?></span>
                    </td>
                    <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>" >
                        <span><i style="padding-top: 9px;" class="btn btn-primary fa fa-edit empEdit"  data-id="<?php echo $PostRow['id']; ?>"></i></span>
                        <span><i style="padding-top: 9px;" class="btn btn-link-danger remove fa fa-trash-o empDelete"  data-id="<?php echo $PostRow['id']; ?>" onclick="removeSchedule(<?php echo $PostRow['id']; ?>)"></i></span>
                    </td>

                </tr>
                <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>
<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/multi-select/multiselect.css">

<script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/multi-select/multiselect.js"></script>
<!--</div>-->