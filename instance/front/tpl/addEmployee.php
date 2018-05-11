<?php
if ($editEmployee != 1) {
    for ($i = 1; $i <= 2; $i++) {
        ?>
        <div>

            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                <div class="form-group">
                    <div class="input-group">
                        <label for="" class="col-sm-12 control-label lbl-text-align">First Name</label>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <input id="fname"  type="text" name="fname[]" class="form-control form-radius"   placeholder="First name" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                <div class="form-group">
                    <div class="input-group">
                        <label for="" class="col-sm-12 control-label lbl-text-align">Last Name</label>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <input id="lname"  type="text" name="lname[]" class="form-control form-radius"   placeholder="Last name" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                <div class="form-group">
                    <div class="input-group">
                        <label for="" class="col-sm-12 control-label lbl-text-align">Email</label>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <input id="email"  type="text" name="email[]" class="form-control form-radius emailValidate"   placeholder="(Optional)"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                <div class="form-group">
                    <div class="input-group">
                        <label for="" class="col-sm-12 control-label lbl-text-align">Phone Number</label>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <input id="phone_no"  type="text" name="phone_no[]" class="form-control form-radius phoneValidate"    placeholder="(mandatory)"/>
                           <span class="errorphone" style="display: block;color: red;"> </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                <div class="form-group">
                    <div class="input-group">
                        <label for="" class="col-sm-12 control-label lbl-text-align">Title</label>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <select class="form-control access " name="access[]" id="access" required>
                                <option value="Employee" selected>Employee</option>
                                <option value="Admin">Admin</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Manager"> Manager</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2 col-xs-2 <?= $remoteClass ?>">
                <label for="" class=" control-label lbl-text-align">Remote : </label>
                <input type="checkbox" <?= $employee['is_remote'] == 1 ? 'Checked' : '' ?> name="remote[]" value="<?php echo $employee['is_remote'] == 1 ? 1 : 0 ?>" class="checkIsRemote">
            </div>
            <div class="col-sm-2 trash" style="color: orangered;font-size: 26px;padding: 15px" onclick="$(this).parent().remove();"><i class="fa fa-trash"></i></div>
            <div class="clearfix"></div>
            <hr>
        </div>
        <?php
    }
} else {
    $checkIsremote = $employee['is_remote'] == 1 ? 'Checked' : '';
    ?>
    <div>
        <form id="editEmployeeDetail">
            <input type="hidden" name="employeeId" value="<?= $employee['id'] ?>">
            <?php if ($type == 'location') { ?>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                    <div class="input-group">
                        <label class="col-sm-12 col-lg-12">Choose Team:</label>
                        <div class="col-sm-12 col-lg-12">
                            <select class="form-control chosen-select empTeam" name="team[]" id="" required>
                                <option value="" disabled selected >Choose Team</option>
                                <?php
                                $teams = q("select * from tb_team where company_id={$employee['work_at']}");
                                foreach ($teams as $team) {
                                    ?>
                                    <option value="<?= $team['id'] ?>" <?php echo $team['id'] == $employee['team_id'] ? 'selected' : ""; ?> ><?= $team['name'] ?> </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                    <div class="input-group">
                        <label class="col-sm-12 col-lg-12">Choose Location:</label>
                        <div class="col-sm-12 col-lg-12">
                            <select class="form-control chosen-select empTeam" name="location[]" id="" required>
                                <option value="" disabled selected >Choose Location</option>
                                <?php
                                $location = q("select * from tb_location where company_id={$employee['work_at']}");
                                foreach ($location as $team) {
                                    ?>
                                    <option value="<?= $team['id'] ?>" <?php echo $team['id'] == $employee['location'] ? 'selected' : ''; ?>><?= $team['name'] ?> </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                <div class="form-group">
                    <div class="input-group">
                        <label for="" class="col-sm-12 control-label lbl-text-align">First Name</label>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <input id="fname"  type="text" name="fname[]" class="form-control form-radius"  value="<?= $employee['fname'] ?>" placeholder="First name" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                <div class="form-group">
                    <div class="input-group">
                        <label for="" class="col-sm-12 control-label lbl-text-align">Last Name</label>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <input id="lname"  type="text" name="lname[]" class="form-control form-radius" value="<?= $employee['lname'] ?>"  placeholder="Last name" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                <div class="form-group">
                    <div class="input-group">
                        <label for="" class="col-sm-12 control-label lbl-text-align">Email</label>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <input id="email"  type="text" name="email[]" class="form-control form-radius emailValidate"  value="<?= $employee['email'] ?>"  placeholder="(Optional)"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                <div class="form-group">
                    <div class="input-group">
                        <label for="" class="col-sm-12 control-label lbl-text-align">Phone Number</label>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <input id="phone_no"  type="text" name="phone_no[]" class="form-control form-radius phoneValidate"  value="<?= $employee['mobile'] ?>"   placeholder="(mandatory)"/>
                            <span class="errorphone" style="display: block;color: red;"> </span>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                <div class="form-group">
                    <div class="input-group">
                        <label for="" class="col-sm-12 control-label lbl-text-align">Title</label>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <select class="form-control access " name="access[]" id="access" required>
                                <option value="Employee" <?php echo $employee['access_level'] == 'Employee' ? 'Selected' : ""; ?>>Employee</option>
                                <option value="Admin" <?php echo $employee['access_level'] == 'Admin' ? 'Selected' : ""; ?>>Admin</option>
                                <option value="Supervisor" <?php echo $employee['access_level'] == 'Supervisor' ? 'Selected' : ""; ?>>Supervisor</option>
                                <option value="Manager" <?php echo $employee['access_level'] == 'Manager' ? 'Selected' : ""; ?>> Manager</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2 col-xs-2">
                <label for="" class=" control-label lbl-text-align">Remote : </label>
                <input type="checkbox" <?= $employee['is_remote'] == 1 ? 'Checked' : '' ?> name="remote[]" value="<?php echo $employee['is_remote'] == 1 ? 1 : 0 ?>" class="checkIsRemote">
            </div>
            <div class="col-sm-10 col-lg-10 col-md-10 col-xs-10">
                <center>
                    <div class="btn btn-success" onclick="saveEmployee()">Save changes for <?= $employee['fname'] . " " . $employee['lname'] ?>
                    </div>
                </center>
            </div>
            <div class="clearfix"></div>
        </form>
    </div>
    <?php
}
?>
