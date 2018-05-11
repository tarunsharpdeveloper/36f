
<?php
$checkIsremote = $isremote == 1 ? "Checked" : "";
$remoteClass = '';
if ($isremote == 0 && $locationId != '-1') {
    $remoteClass = 'hidden';
}
if ($locationId != '-1') {
    $remoteClass = 'hidden';
    $limit = ($locationId - 1) . ",1";
    $location = qs("select * from tb_location where company_id='{$compId}' limit {$limit}");
} else {
    $location['id'] = $locationId;
    $location['name'] = " Remote Workers ";
}
$teams = q("select * from tb_team where company_id='{$compId}' ");
?>
<input type="hidden" name="hidcompid" id="hidcompid6" value="<?= $compId ?>">
<input type="hidden" name="hidlocid" id="hidlocid6" value="<?= $location['id']; ?>">
<input type="hidden" name="teamId" id="teamId" value="noId">

<div class="panel" >
    <div class="panel-body">
        <h3 style="font-weight: bolder;">To get started, let's enter a few trusted staff for the location <span style="text-transform: uppercase;color: orangered;text-decoration: underline"><?= $location['name'] ?></span></h3>
        <br/>
        <br/>
        <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12">
            <div class="input-group">
                <label class="col-sm-12 col-lg-12">Choose Team For Employee:</label>
                <div class="col-sm-12 col-lg-12">
                    <input type="hidden" name="locationId" value="<?= $location['id'] ?>">
                    <select class="form-control chosen-select empTeam" onchange="changeTeam();" name="team" id="empTeam" required>
  <!--<select class="form-control chosen-select empTeam" onchange="screenSix('<?= $locationId ?>', '0');" name="team" id="empTeam" required>-->
                        <option value="noId" disabled selected >Choose Team</option>
                        <?php
                        foreach ($teams as $team) {
                            ?>
                            <option value="<?= $team['id'] ?>"><?= $team['name'] ?> </option>
                            <?php
                        }
                        ?>
                        <option value="add_new_team">Add New Team</option>
                    </select>
                </div>
            </div>

            <div id="showNewTeam" style="display: none">  <br>            
                <div class="form-group">
                    <div class="input-group">
                        <div class="col-sm-8 col-md-8 col-lg-8">
                            <input type="text" id="addTeam" class="form-control tooltip-button" data-placement="bottom" title="Enter your team name" value="" name="locName" id="locName" placeholder="e.g Customer Support" required="">
                        </div>
                        <div class="btn btn-success col-lg-4 col-mg-4 col-sm-4" onclick="SaveTeamData()">Save Team</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6  col-md-6  col-sm-12 col-xs-12 lochtml" style="font-weight: bold;font-size: 20px;text-align: right;padding: 2% 0">
            <i class="fa fa-map-marker"></i> <?= $location['name'] ?> 
        </div>
        <div class="clearfix"></div>
        <div style="margin: 1% 0;border-bottom: 2px solid gray;"></div>
        <div class="<?php echo $isFirst == 1 ? "hidden" : "" ?> afterTeamSelect" id="EmployeeScreen" >
            <div class="<?php echo $isFirst == 1 ? 'col-lg-12 col-md-12 col-sm-12' : 'col-lg-6 col-md-6 col-sm-12' ?>">
                <div class="col-lg-12" id="wrap_div_r" style="margin-top: 25px;">
                    <?php include _PATH . 'instance/front/tpl/addEmployee.php'; ?>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-12" style="margin-top: 5px;">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="btn btn-placeholder" title="Add field" style="width: 100%;" onclick="addEmployee('<?= $isremote ?>', '<?= $compId ?>', '<?= $locationId ?>')">
                                <i class="fa fa-plus"></i>Add More People
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 <?php echo $isFirst == 1 ? 'hidden' : '' ?>" style="padding-top: 15px;">
                <div style="font-weight: bold; padding-bottom: 10px;">
                    Employee List for <span style="font-weight:bold;" class="lochtml"><?= $location['name'] ?></span> 
                </div>
                <div class="emp_list" id="employee_list_wait">
                    Loading...
                </div>
                <div class="emp_list" id="employee_list">

                </div>                                    
            </div>
            <div class="col-sm-12 col-lg-12 col-md-12" style="margin-top: 50px;">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="input-group">
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-sm-12 col-lg-12 col-md-12" align="center">
                <center>
                    <button class="btn btn-primary savebtn" type="button" onclick="submitSix('<?php echo $locationId ?>', '<?php echo $locationId != '-1' ? '1' : '0' ?>', '<?= $isremote ?>', 0);">
                        Save Employee
                    </button>
                    <br>
                    <br>
                    <button class="btn btn-primary savebtn" type="button" onclick="submitSix('<?php echo $locationId != '-1' ? $locationId + 1 : $locationId ?>', '<?php echo $locationId == '-1' ? '1' : '0' ?>', '<?= $isremote ?>', 1);">
                        All done with <?= $location['name'] ?>, lets invite emp
                    </button>
                </center> 
            </div>
        </div>
        <div class="<?php echo $isFirst == 1 ? "" : "hidden" ?> beforeTeamSelect">
            <div class="col-lg-6 col-md-6 col-sm-12" style="font-size: 22px;color: #00bca4;font-weight:bold;">
                <img style="width: 40%" src="<?php echo _MEDIA_URL . "img/arrow.png" ?>">
                <br/>
                Select the team to get started for <?= $location['name'] ?>. 
            </div>
        </div>
    </div>
</div>
