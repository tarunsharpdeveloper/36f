<div class="panel">
    <div class="panel-body">
        <div>
            <div class="col-lg-12 col-sm-12">
                <h3 style="font-weight: bold;color: #00c6ff">Designated Approver  </h3>
            </div>
            <div class="col-lg-12 col-sm-12 ">
                <hr>
            </div>
        </div>
    </div>

    <?php if ($_SESSION['user']['team_id'] == 0 || strtolower($_SESSION['user']['access_level']) == 'admin') { ?>

        <?php 
        $companyId = $_SESSION['user']['work_at'];
        $allTeamList = q("SELECT team_id FROM tb_employee WHERE work_at = '{$companyId}' AND (access_level != 'Admin' OR access_level != 'admin') GROUP BY team_id ORDER BY team_id DESC");
        ?>
        <div style="padding:10px;">
            <form action="designated_approver" method="POST" id="form_lunchsetting">
                <?php
                foreach ($allTeamList as $eachTeam):
                    $teamName = team::getTeamName($eachTeam['team_id']);
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><b>Team: <?php print $teamName; ?></b></div>
                        <div class="panel-body">
                            <?php
                            $teamEmployeeList = array();
                            $teamEmployeeList = q("SELECT * FROM tb_employee WHERE work_at = '{$companyId}' AND team_id = '{$eachTeam['team_id']}'");
                            ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Designation</th>
                                        <th>Designated Approver</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($teamEmployeeList as $eachEmployee):
                                        ?>
                                        <tr>
                                            <td><?php print $eachEmployee['fname'] . " " . $eachEmployee['lname']; ?></td>
                                            <td><?php print $eachEmployee['access_level']; ?></td>
                                            <td>
                                                <?php
                                                $check = 0;
                                                if (($eachEmployee['access_level'] == 'Supervisor' || $eachEmployee['access_level'] == 'Manager') && $eachEmployee['designated_approver'] == 0) {
                                                    $check = 1;
                                                    ?>    
                                                    <div id="ques<?= $eachEmployee['id']; ?>">Allow to approve their own?
                                                        <div class="btn btn-success" onclick="questionApproval('<?= $eachEmployee['id']; ?>', 1)">yes</div>
                                                        <div class="btn btn-success" onclick="questionApproval('<?= $eachEmployee['id']; ?>', 0)" >no</div>
                                                    </div>
                                                <?php } ?>

                                                <input type ="hidden" name="id[]" value="<?= $eachEmployee["id"]; ?>">
                                                <select class="<?php echo $check == 1 ? "hidden" : ""; ?>"
                                                        id="employee_designated_<?php print $eachEmployee["id"]; ?>" 
                                                        name="empVal[]" 
                                                        />
                                                 <!--name="employee_designated_<?php print $eachEmployee["id"]; ?>">-->
                                    <option value="">Select</option>
                                    <?php foreach ($designatedApproverList as $eachDesignated): ?> 
                                        <?php
                                        $designatedName = '';
                                        $designatedNameArr = array();
                                        $designatedNameArr = employeeDetail::GetEmployeeNameAndEmail($eachDesignated["id"]);
                                        $designatedName = $designatedNameArr['full_name'];
                                        $selectedRec = '';
                                        if ($eachDesignated["id"] == $eachEmployee["designated_approver"]) {
                                            $selectedRec = 'selected="selected"';
                                        }
                                        $eachTeamName = '';
                                        if ($eachDesignated['team_id'] > 0) {
                                            $eachTeamName = "Team : " . team::getTeamName($eachDesignated['team_id']) . " ";
                                        }
                                        $displayTeamName = '';
                                        $displayTeamName.= ' [' . $eachDesignated["access_level"] . ']';
                                        if ($eachTeamName != '') {
                                            $displayTeamName.= ' [' . $eachTeamName . ']';
                                        }
                                        ?>
                                        <option <?php print $selectedRec; ?> value="<?php print $eachDesignated["id"]; ?>"><?php print $designatedName . $displayTeamName; ?></option>  
                                    <?php endforeach; ?>
                                    </select>
                                    </td>
                                    </tr>
                                    <?php
                                endforeach;
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                endforeach;
                ?>
                <input type="hidden" name="update_designated" value="1" />    
                <input class="btn btn-success" type="submit" name="update_designated_btn" value="Update" /> 
            </form>
        </div> 
    <?php } else { ?>
        <div>You have no permission to access for this page</div>
    <?php } ?>
</div>

