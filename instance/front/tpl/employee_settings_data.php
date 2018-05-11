<!--<div class="col-sm-8 " id="empDi"  >-->
<?php
//d($lastQuery);
$PostResult = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'" . $lastQuery . $whereRelatedEmployee);
?>
<table class="table table-striped responsive no-wrap" id="empTables">
    <thead>
        <tr>
            <th style="width:15px">
    <div class="checkbox-info" style="height: 15px;">
        <label>
            <input type="checkbox" class="custom-checkbox selectall " id="all" >
        </label>
    </div>
</th>
<th style="">Name & Access</th>
<th id="tbl_1" class="tb-none tb-th">Overtime</th>
<th id="tbl_3" class="tb-none tb-th" style="">Tolerance Time</th>
<th id="tbl_4" class="tb-none tb-th">Day Off</th>
<th id="tbl_5" class="tb-none tb-th">Lunch Break</th>
</tr>
</thead>
<tbody>
    <?php if (empty($PostResult)) { ?>
        <tr><td colspan="11"><?php echo "No Record Found!!!!!"; ?></td></tr>
        <?php
    } else {
        foreach ($PostResult as $PostRow) {
            ?>
            <tr>

                <td style="width:15px">
                    <div class="checkbox-info" style="height: 15px;">
                        <label>
                            <input type="checkbox" name="nchild[]" class="custom-checkbox child " value="<?php echo $PostRow['id']; ?>" id="<?php echo $PostRow['id']; ?>">
                        </label>
                    </div>
                </td>
                <td style="" class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>">
                    <!--<div class="row">-->
                    <div class="col-xs-3 col-sm-3 col-md-3 on-break-tab"><?php echo substr(ucfirst($PostRow['fname']), 0, 1) . '' . substr(ucfirst($PostRow['lname']), 0, 1) ?></div>
                    <div class="col-xs-9 col-sm-9 col-md-9">
                        <div style=""><b style="color: #1b92da;"><?php echo ucfirst($PostRow['fname']) . ' ' . ucfirst($PostRow['lname']) ?></b></div>
                        <div><a class="m-team-supportingLink" href="#" title="" style="font-size: 12px"><?php
                                if ($PostRow['access_level'] == "Location_Manager") {
                                    $access_level = "Location Manager";
                                } else if ($PostRow['access_level'] == "System_Administrator") {
                                    $access_level = "System Administrator";
                                } else {

                                    $access_level = $PostRow['access_level'];
                                }
                                echo $access_level;
                                ?></a></div>
                    </div>
                    <!--</div>--> 
                </td>
                <?php
                $emprules = qs("select * from tb_employee_settings where emp_id='{$PostRow['id']}'");
                ?>
                <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>" >
                    <span style="display: block">Before: <?php echo $emprules['before_time']; ?></span>
                    <span style="display: block">After: <?php echo $emprules['after_time']; ?></span>
                    <span style="display: block">Holidays: <?php echo $emprules['holiday_time']; ?></span>

                </td>
                <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>">
                    <span style="display: block">Late: <?php echo $emprules['tolrance_timeIn']; ?></span>
                    <span style="display: block">Early: <?php echo $emprules['tolrance_timeOut']; ?></span>
                    <span style="display: block">Penalize: <?php echo $emprules['penalize']; ?></span>
                </td>
                <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>" >
                    <span style="display: block">Paid Days: <?php echo $emprules['paidDayOff']; ?></span>
                    <span style="display: block">Vacation Days: <?php echo $emprules['vacationDay']; ?></span>
                    <span style="display: block">Sick Days: <?php echo $emprules['sick_day']; ?></span>
                </td>
                <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>">
                    <span style="display: block">Counted: <?php echo ucfirst(strtolower($emprules['lunch_time_counted'])); ?></span>
                </td>
            </tr>
            <?php
        }
    }
    ?>
</tbody>
</table> 
<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/multi-select/multiselect.css">

<script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/multi-select/multiselect.js"></script>
<!--</div>-->