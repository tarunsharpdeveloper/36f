
<ul class="nav nav-tabs alllocation_summary">
    <li onclick="showAllSummaryByLocation()" class="active" id="tabAllSummaryLocation"><a href="javascript:;" >By Location</a></li>
    <li onclick="showAllSummaryByTeam()" id="tabAllSummaryTeam"><a href="javascript:;" >By Team</a></li>
    <li onclick="showAllSummaryByRemote()" id="tabAllSummaryRemote"><a href="javascript:;" >By Remote</a></li>
    <a onclick="setModel('9')" id="nextModel" style="float: right;" class="btn btn-primary" href="javascript:;" >Next </a>
</ul>

<div id="emp_accordion" class="allsummaryByTeam empAllSummary" style="display:none" >
    <?php
    $accordion_cnt = 0;
    foreach ($team as $each_team):
        ?>
        <h3 id="accordion_team_<?= $each_team['id']; ?>" data-index="<?= $accordion_cnt++; ?>" class="active"><?= $each_team['name']; ?></h3>
        <div>
            <?php if (count($team_wise_emp[$each_team['id']]) > 0): ?>
                <table id="accordion_emp_table" style="width:100%;" class="table">
                    <thead><tr><th>Name</th><th>Email</th><th>Phone</th></tr></thead>
                    <tbody>
                        <?php
                        foreach ($team_wise_emp[$each_team['id']] as $each_emp):
//                            if ($each_emp['location'] > 0) {
                            ?>
                            <tr>
                                <td><?= $each_emp['fname'] . ' ' . $each_emp['lname']; ?></td>
                                <td><?= ($each_emp['email'] == '') ? "-" : $each_emp['email']; ?></td>
                                <td><?=
                                    ($each_emp['mobile'] == '') ? "-" : $each_emp['mobile'];
                                    ;
                                    ?></td>
                            </tr>
                            <?php
//                            }
                        endforeach;
                        ?>
                    </tbody>
                </table>
            <?php else: ?>
                No record found for <?= $each_team['name']; ?>.
            <?php endif; ?>        
        </div>
    <?php endforeach; ?>    
</div>

<div  class="allsummaryByLocation empAllSummary"  >
    <?php
    $accordion_cnt = 0;
    foreach ($company_locations as $each_location):
        ?>
        <h3 id="accordion_location_<?= $each_team['id']; ?>" data-index="<?= $accordion_cnt++; ?>" class="active"><?= $each_location['name']; ?></h3>
        <?php $location_employees = q(" select * from tb_employee where location = '{$each_location['id']}'   "); ?>
        <div>
            <?php if (count($location_employees) > 0): ?>
                <table id="accordion_emp_table" style="width:100%;" class="table">
                    <thead><tr><th>Name</th><th>Title</th><th>Team</th></tr></thead>
                    <tbody>
                        <?php foreach ($location_employees as $each_emp): ?>
                            <tr>
                                <td><?= $each_emp['fname'] . ' ' . $each_emp['lname']; ?></td>
                                <td><?= ($each_emp['access_level'] == '') ? "-" : $each_emp['access_level']; ?></td>
                                <td><?= print $company_teams[$each_emp['team_id']]['0']['name'] ?></td>
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
<div id="" class="allsummaryByRemote empAllSummary" style="display:none" >
    <?php
    $accordion_cnt = 0;
    foreach ($team as $each_team):
        ?>
        <h3 id="accordion_team_<?= $each_team['id']; ?>" data-index="<?= $accordion_cnt++; ?>" class="active"><?= $each_team['name']; ?></h3>
        <div>
            <?php if (count($team_wise_emp[$each_team['id']]) > 0): ?>
                <table id="accordion_emp_table" style="width:100%;" class="table">
                    <thead><tr><th>Name</th><th>Email</th><th>Phone</th></tr></thead>
                    <tbody>
                        <?php
                        foreach ($team_wise_emp[$each_team['id']] as $each_emp):
                            if ($each_emp['location'] == "-1") {
                                ?>
                                <tr>
                                    <td><?= $each_emp['fname'] . ' ' . $each_emp['lname']; ?></td>
                                    <td><?= ($each_emp['email'] == '') ? "-" : $each_emp['email']; ?></td>
                                    <td><?=
                                        ($each_emp['mobile'] == '') ? "-" : $each_emp['mobile'];
                                        ;
                                        ?></td>
                                </tr>
                            <?php } endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                No record found for <?= $each_team['name']; ?>.
            <?php endif; ?>        
        </div>
    <?php endforeach; ?>    
</div>