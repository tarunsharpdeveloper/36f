<style>
    /*    .ui-accordion-content{
            height: fit-content;
        }
        .location_summary > .ui-accordion-content{
            height:200px;
        }*/
</style>
<ul class="nav nav-tabs location_summary">
    <li onclick="showSummaryByLocation()" class="active" id="tabSummaryLocation"><a href="javascript:;" >By Location</a></li>
    <li onclick="showSummaryByTeam()" id="tabSummaryTeam"><a href="javascript:;" >By Team</a></li>
</ul>

<div id="emp_accordion" class="summaryByTeam empSummary" style="display:none" >
    <?php
    $accordion_cnt = 0;
    foreach ($company_teams as $each_team):
        ?>
        <h3 id="accordion_team_<?= $each_team['id']; ?>" data-index="<?= $accordion_cnt++; ?>" class="active"> <?= $each_team['name']; ?></h3>
        <div >
            <?php
            $teamdata = q("select * from tb_employee where team_id = '{$each_team['id']}'");
            if (count($teamdata) > 0):
                ?>
                <table id="accordion_emp_table" style="width:100%;" class="table">
                    <thead>
                        <tr>
                            <th >Name</th>
                            <th>Location</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($teamdata as $each_emp):
                            ?>
                            <tr>
                                <td><?= $each_emp['fname'] . ' ' . $each_emp['lname']; ?></td>
                                <td> <?php
                                    if ($each_emp['location'] == "-1") {
                                        echo "Remote";
                                    } else {
                                        $name = qs("select * from tb_location where id='{$each_emp['location']}'");
                                        echo $name['name'];
                                    }
                                    ?></td>
                                <td><?= ($each_emp['access_level'] == '') ? "-" : $each_emp['access_level']; ?></td>
                                <td>
                                    <span><i style="padding-top: 9px;" class="btn btn-primary fa fa-edit empEdit TeamSummary"  data-id="<?php echo $each_emp['id']; ?>" onclick="editEmployee('<?php echo $each_emp['id']; ?>', 'team')"></i></span>
                                    <span><i style="padding-top: 9px;" class="btn btn-danger remove fa fa-trash-o empDelete"  data-id="<?php echo $each_emp['id']; ?>" onclick="removeEmp(<?php echo $each_emp['id']; ?>, '<?= $each_emp['fname'] . ' ' . $each_emp['lname']; ?>')"></i></span>
                                </td>
                            </tr>
        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                No record found for <?= $each_team['name']; ?>.
        <?php endif; ?>        
        </div>
<?php endforeach; ?>    
</div>

<div  class="summaryByLocation empSummary">
    <?php
    $accordion_cnt = 0;
    foreach ($company_locations as $each_location):
        ?>
        <h3 id="accordion_location_<?= $each_team['id']; ?>" data-index="<?= $accordion_cnt++; ?>" class="active"><?= $each_location['name']; ?></h3>
            <?php $location_employees = q(" select * from tb_employee where location = '{$each_location['id']}'   "); ?>
        <div >
    <?php if (count($location_employees) > 0): ?>
                <table id="accordion_emp_table" style="width:100%;" class="table">
                    <thead><tr><th>Name</th><th>Title</th><th>Team</th><th>Action</th></tr></thead>
                    <tbody>
        <?php foreach ($location_employees as $each_emp): ?>
                            <tr>
                                <td><?= $each_emp['fname'] . ' ' . $each_emp['lname']; ?></td>
                                <td><?= ($each_emp['access_level'] == '') ? "-" : $each_emp['access_level']; ?></td>
                                <td><?php
                                    $name = qs("select * from tb_team where id='{$each_emp['team_id']}'");
                                    echo $name['name']
                                    ?></td>
                                <td>
                                    <span><i style="padding-top: 9px;" class="btn btn-primary fa fa-edit empEdit LocTeamSummary"  data-id="<?php echo $each_emp['id']; ?>" onclick="editEmployee('<?php echo $each_emp['id']; ?>', 'location')"></i></span>
                                    <span><i style="padding-top: 9px;" class="btn btn-danger remove fa fa-trash-o empDelete"  data-id="<?php echo $each_emp['id']; ?>" onclick="removeEmp(<?php echo $each_emp['id']; ?>, '<?= $each_emp['fname'] . ' ' . $each_emp['lname']; ?>')"></i></span>
                                </td>
                            </tr>
        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                No record found for <?= $each_location['name']; ?>.
        <?php endif; ?>        
        </div>
<?php endforeach; ?>    
</div>
<script>

    $(document).ready(function () {
        $('.ui-accordion-content').css('height', 'auto');
        $('#employee_list .ui-accordion-content').css('height', 'auto');
    });
</script>