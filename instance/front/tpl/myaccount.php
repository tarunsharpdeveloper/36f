<?php // d($_SESSION);                                                   ?>
<div class="panel">
    <div class="panel-body">
        <div class="col-lg-offset-2 col-lg-6 col-md-offset-2 col-md-8 col-sm-12 col-xs-12 bhoechie-tab-container">
            <div style="margin: 1rem;border-bottom: 1px solid #ddd;">
                <span style="font-size: 18px;font-weight: bolder;">First Section</span>
            </div>  <!-- flight section -->
            <form name="first_section" id="first_section" >
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >First Name:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="text" class="form-control" onkeypress="return isLatterKey(event)" value="<?= $_SESSION['user']['fname'] ?>" name="firstname" id="firstname" maxlength="20" placeholder="Enter First Name" required="">
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Last Name:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="text" class="form-control" value="<?= $_SESSION['user']['lname'] ?>" onkeypress="return isLatterKey(event)" name="lastname" id="lastname" maxlength="20" placeholder="Enter Last Name" required="">
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Gender: </label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="radio" name="gender" value="male" <?php echo $_SESSION['user']['gender'] == 'male' ? 'checked' : ''; ?>> Male
                            <input type="radio" name="gender" value="female" <?php echo $_SESSION['user']['gender'] == 'female' ? 'checked' : ''; ?>> Female<br>
                        </div>

                    </div>
                </div>
                <div class="form-group military <?php echo ($_SESSION['user']['gender'] == 'female' || $_SESSION['user']['gender'] == '') ? 'hidden' : ''; ?> ">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Military Status : </label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <select class="form-control" name="military">
                                <option <?= $_SESSION['user']['military_status'] == 'Educational Pardon' ? 'selected' : ""; ?>>Educational Pardon</option>
                                <option <?= $_SESSION['user']['military_status'] == 'Man of Household Pardon' ? 'selected' : ""; ?>>Man of Household Pardon</option>
                                <option <?= $_SESSION['user']['military_status'] == 'Temporary Pardon' ? 'selected' : ""; ?>>Temporary Pardon</option>
                                <option <?= $_SESSION['user']['military_status'] == 'Medical Pardon' ? 'selected' : ""; ?>>Medical Pardon</option>
                                <option <?= $_SESSION['user']['military_status'] == 'Other' ? 'selected' : ""; ?>>Other</option>
                                <option <?= $_SESSION['user']['military_status'] == 'Needs to serve' ? 'selected' : ""; ?>>Needs to serve</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-labelcol-sm-12 col-lg-12" >Fathers Name:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="email" class="form-control" value="<?= $_SESSION['user']['fathers_name'] ?>" name="father" id="father" maxlength="20" placeholder="Enter Father`s Name" required="">
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Date Of Birth:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <table class="responsive"  cellspacing="5" cellpadding="5" border="0">
                                <tbody>
                                    <?php
                                    $date = explode("-", $_SESSION['user']['dob']);
//                                    d($date);
                                    ?>
<!--                                    <tr>
                                        <td style="width: 100px; padding: 10px;"> Shamsi day</td>
                                        <td style="width: 120px; padding: 10px;">Shamsi Month</td>
                                        <td style="width: 100px; padding: 10px;">Shamsi Year</td>
                                    </tr>-->
                                    <tr>
                                        <td style="width: 100px; padding: 10px;">
                                            Month<br/>

                                            <select id="pmonth" name="pmonth" class="form-control" style="width: 100px;">
                                                <?php
                                                $str = ltrim($date[1], '0');
                                                for ($i = 1; $i <= 12; $i++) {
                                                    $select = $str == $i ? 'selected' : '';
                                                    echo "<option value='$i' $select >$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td style="width: 100px; padding: 10px;">
                                            Day<br/>
                                            <select id="pdate" name="pdate" class="form-control">
                                                <?php
                                                $str = ltrim($date[2], '0');
                                                for ($i = 1; $i <= 31; $i++) {
                                                    $select = $str == $i ? 'selected' : '';
                                                    echo "<option value='$i' $select>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>

                                        <td style="width: 150px; padding:0px 10px;">
                                            Year<br/>
                                            <select id="pyear" name="pyear" class="form-control">
                                                <?php
                                                for ($i = 1300; $i <= $jala_date[0]; $i++) {
                                                    $select = $date[0] == $i ? 'selected' : '';
                                                    echo "<option value='$i' $select>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Birth Certificate Number:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="text" class="form-control" onkeypress="return isNumberKey(event)" value="<?= $_SESSION['user']['birth_cert'] ?>" name="BCN" id="BCN" maxlength="10" placeholder="Enter Birth Certificate Number" required="" >
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Birth Certificate Issued In:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="text" class="form-control" value="<?= $_SESSION['user']['bod_issue_no'] ?>" name="BCI" id="BCI" placeholder="Enter Birth Certificate Issued In" required="" >
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >ID Number:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="text" class="form-control" maxlength="10" value="<?= $_SESSION['user']['ID_no'] ?>" onkeypress="return isNumberKey(event)" name="IDN" id="IDN" placeholder="Enter ID Number" required="" >
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 error" id="idnError" style="display: none;color:orangered;font-size: 12px;">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Mobile:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="text" class="form-control" value="<?= $_SESSION['user']['mobile'] ?>" onkeypress="return isNumberKey(event)" name="mobile" id="mobile" maxlength="11" placeholder="Enter Mobile Number" required="" >
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 error" id="mobileError" style="display: none;color:orangered;font-size: 12px;">

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Email:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="email" class="form-control" value="<?= $_SESSION['user']['email'] ?>" name="email" id="email" placeholder="Enter Email Address" required="" >
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 error" id="emailError" style="display: none;color:orangered;font-size: 12px;">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" > Marital Status : </label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <select class="form-control" name="marital">
                                <option <?= $_SESSION['user']['marital_status'] == 'Single' ? 'selected' : ""; ?>>Single </option>
                                <option <?= $_SESSION['user']['marital_status'] == 'Married' ? 'selected' : ""; ?>>Married</option>
                                <option <?= $_SESSION['user']['marital_status'] == 'Divorced' ? 'selected' : ""; ?>>Divorced</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >State:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="text" class="form-control" value="<?= $_SESSION['user']['state'] ?>" name="state" id="state" placeholder="Enter State" required="" >
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >City:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="text" class="form-control" value="<?= $_SESSION['user']['city'] ?>" name="city" id="city" placeholder="Enter City " required="" >
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Address:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <textarea name="address" class="form-control"><?= $_SESSION['user']['address'] ?></textarea>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Postcode:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="text" class="form-control" value="<?= $_SESSION['user']['post_code'] ?>" onkeypress="return isNumberKey(event)" name="postcode" id="postcode" maxlength="10" placeholder="Enter Postcode " required="" >
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 error" id="postcodeError" style="display: none;color:orangered;font-size: 12px;">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Home Phone:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="text" class="form-control" value="<?= $_SESSION['user']['home_phone'] ?>" onkeypress="return isNumberKey(event)" name="phone" id="phone" maxlength="11" placeholder="Enter Home Phone " required="" >
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 error" id="phoneError" style="display: none;color:orangered;font-size: 12px;">
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="clearfix"></div>
                <div style="margin: 1rem;border-bottom: 1px solid #ddd;">
                    <span style="font-size: 18px;font-weight: bolder;">Second Section</span>
                </div>
                <div class="form-group  ">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Last Degree  : </label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <select class="form-control" name="degree" id="degree">
                                <option <?= $_SESSION['user']['last_degree'] == 'Doctorate' ? 'selected' : ""; ?>>Doctorate </option>
                                <option <?= $_SESSION['user']['last_degree'] == 'Masters' ? 'selected' : ""; ?>>Masters</option>
                                <option <?= $_SESSION['user']['last_degree'] == 'Bachelor' ? 'selected' : ""; ?>>Bachelor</option>
                                <option <?= $_SESSION['user']['last_degree'] == 'Associate Degree' ? 'selected' : ""; ?>>Associate Degree</option>
                                <option <?= $_SESSION['user']['last_degree'] == 'Diploma' ? 'selected' : ""; ?>>Diploma</option>
                                <option <?= $_SESSION['user']['last_degree'] == 'Junior High Graduate' ? 'selected' : ""; ?>>Junior High Graduate</option>
                                <option <?= $_SESSION['user']['last_degree'] == 'Elementry School' ? 'selected' : ""; ?>>Elementry School</option>
                                <option <?= $_SESSION['user']['last_degree'] == 'Uneducated' ? 'selected' : ""; ?>>Uneducated</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Veteran: </label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <?php
                            if ($_SESSION['user']['veteran'] == '') {
                                $_SESSION['user']['veteran'] = 'no';
                            }
                            ?>
                            <input type="radio" name="veteran" value="yes" <?= $_SESSION['user']['veteran'] == 'yes' ? 'checked' : '' ?>> Yes
                            <input type="radio" name="veteran" value="no" <?= $_SESSION['user']['veteran'] == 'no' ? 'checked' : '' ?>> No<br>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Emergency Contact Name:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="text" class="form-control" value="<?= $_SESSION['user']['em_contact_name'] ?>" onkeypress="return isLatterKey(event)" name="ECName" id="ECName" maxlength="20" placeholder="Enter Emergency Contact Name" required="">
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Emergency Phone:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="text" class="form-control" value="<?= $_SESSION['user']['em_phone'] ?>" onkeypress="return isNumberKey(event)" name="EPhone" id="EPhone" maxlength="11" placeholder="Enter Emergency Phone " required="" >
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 error" id="EPhoneError" style="display: none;color:orangered;font-size: 12px;">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Relation:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="text" class="form-control" value="<?= $_SESSION['user']['relation'] ?>" onkeypress="return isLatterKey(event)" name="relation" id="relation" maxlength="10" placeholder="Enter Relation" required="" >
                        </div>

                    </div>
                </div>


                <hr/>
                <div class="clearfix"></div>
                <div style="margin: 1rem;border-bottom: 1px solid #ddd;">
                    <span style="font-size: 18px;font-weight: bolder;">Job Information</span>
                </div>


                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Work at Location:</label>
                        <?php
                        $localtion = q("select * from tb_location where company_id='{$_SESSION['company']['id']}'");
                        $locationId = explode(",", $_SESSION['user']['location']);
                        foreach ($localtion as $value) {
                            ?>
                            <label class="col-sm-4 col-md-3 col-lg-3">
                                <div class="col-sm-4 col-md-3 col-lg-3">
                                    <?php $check = in_array($value['id'], $locationId) ? "checked" : ""; ?>
                                    <input type="checkbox" class="form-control" <?= $check ?> value="<?= $value['id']; ?>"  name="location[]">
                                </div>
                                <div class="col-sm-8 col-md-9 col-lg-9">
                                    <?= $value['name'] ?>
                                </div>
                            </label>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Department /Teams:</label>
                        <?php
                        $team = q("SELECT * FROM tb_team where company_id='{$_SESSION['company']['id']}'");
                        $teamId = explode(",", $_SESSION['user']['team_id']);
                        foreach ($team as $value) {
                            ?>
                            <label class="col-sm-4 col-md-3 col-lg-3">
                                <div class="col-sm-4 col-md-3 col-lg-3">
                                    <?php $check = in_array($value['id'], $teamId) ? "checked" : ""; ?>
                                    <input type="checkbox" class="form-control" <?= $check ?> value="<?= $value['id']; ?>"  name="team[]">
                                </div>
                                <div class="col-sm-8 col-md-9 col-lg-9">
                                    <?= $value['name'] ?>
                                </div>
                            </label>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Position:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <select class="form-control" name="position">
                                <option <?= $_SESSION['company']['position'] == 'Supervisor' ? 'selected' : ""; ?>>Supervisor</option>
                                <option <?= $_SESSION['company']['position'] == 'Supervisor' ? 'selected' : ""; ?>>Supervisor</option>
                                <option <?= $_SESSION['company']['position'] == 'Manager' ? 'selected' : ""; ?>>Manager</option>
                                <option <?= $_SESSION['company']['position'] == 'Expert' ? 'selected' : ""; ?>>Expert</option>
                                <option <?= $_SESSION['company']['position'] == 'Specialist' ? 'selected' : ""; ?>>Specialist</option>
                                <option <?= $_SESSION['company']['position'] == 'CEO' ? 'selected' : ""; ?>>CEO</option>
                                <option <?= $_SESSION['company']['position'] == 'Security Guard' ? 'selected' : ""; ?>>Security Guard</option>
                                <option <?= $_SESSION['company']['position'] == 'Call Center' ? 'selected' : ""; ?>>Call Center</option>
                                <option <?= $_SESSION['company']['position'] == 'Driver' ? 'selected' : ""; ?>>Driver</option>
                                <option <?= $_SESSION['company']['position'] == 'Consultant' ? 'selected' : ""; ?>>Consultant</option>
                                <option <?= $_SESSION['company']['position'] == 'Janitor' ? 'selected' : ""; ?>>Janitor</option>
                                <option <?= $_SESSION['company']['position'] == 'Messenger' ? 'selected' : ""; ?>>Messenger</option>
                                <option <?= $_SESSION['company']['position'] == 'Part Time' ? 'selected' : ""; ?>>Part Time</option>
                                <option <?= $_SESSION['company']['position'] == 'Secratary' ? 'selected' : ""; ?>>Secratary </option>
                                <option <?= $_SESSION['company']['position'] == 'Other' ? 'selected' : ""; ?>> Other</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Employee Number:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="text" class="form-control" value="<?= $_SESSION['user']['employee_no'] ?>" maxlength="10" name="employeeNumber" id="employeeNumber" placeholder="Enter Employee Number" required="">
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Access Level : </label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <select class="form-control" name="accessLevel">
                                <option <?= $_SESSION['user']['access_level'] == 'Employee' ? 'selected' : ""; ?>>Employee</option>
                                <option <?= $_SESSION['user']['access_level'] == 'Supervisor' ? 'selected' : ""; ?>>Supervisor</option>
                                <option <?= $_SESSION['user']['access_level'] == 'Location Manager' ? 'selected' : ""; ?>>Location Manager</option>
                                <option <?= $_SESSION['user']['access_level'] == 'System Admin' ? 'selected' : ""; ?>>System Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Contract Type : </label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <select class="form-control" name="contractType">
                                <option <?= $_SESSION['user']['contract_type'] == 'Official' ? 'selected' : ""; ?>>Official</option>
                                <option <?= $_SESSION['user']['contract_type'] == 'Contract' ? 'selected' : ""; ?>>Contract</option>
                                <option <?= $_SESSION['user']['contract_type'] == 'Hourly' ? 'selected' : ""; ?>>Hourly</option>
                                <option <?= $_SESSION['user']['contract_type'] == 'Daily' ? 'selected' : ""; ?>>Daily</option>
                                <option <?= $_SESSION['user']['contract_type'] == 'Contractor' ? 'selected' : ""; ?>>Contractor</option>
                                <option <?= $_SESSION['user']['contract_type'] == 'Other' ? 'selected' : ""; ?>>Other</option>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Hired On: </label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <table class="responsive"  cellspacing="5" cellpadding="5" border="0">
                                <tbody>
                                    <tr>
                                        <td style="width: 100px; padding: 10px;">
                                            Month<br/>
                                            <?php
                                            $date = explode("-", $_SESSION['user']['hired_on']);
                                            ?>
                                            <select id="Hmonth" name="Hmonth" class="form-control" style="width: 100px;">
                                                <?php
                                                $str = ltrim($date[1], '0');
                                                for ($i = 1; $i <= 12; $i++) {
                                                    $select = $str == $i ? 'selected' : '';
                                                    echo "<option value='$i' {$select}>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td style="width: 100px; padding: 10px;">
                                            Day<br/>
                                            <select id="Hdate" name="Hdate" class="form-control">
                                                <?php
                                                $str = ltrim($date[2], '0');
                                                for ($i = 1; $i <= 31; $i++) {
                                                    $select = $str == $i ? 'selected' : '';
                                                    echo "<option value='$i' {$select}>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>

                                        <td style="width: 150px; padding:0px 10px;">
                                            Year<br/>
                                            <select id="Hyear" name="Hyear" class="form-control">
                                                <?php
                                                $str = ltrim($date[0], '0');
                                                for ($i = 1300; $i <= $jala_date[0]; $i++) {
                                                    echo "<option value='$i' {$select}>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Terminate Date: </label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <table class="responsive"  cellspacing="5" cellpadding="5" border="0">
                                <tbody>
                                    <tr>
                                        <td style="width: 100px; padding: 10px;">
                                            Month<br/>
                                            <?php
                                            $date = explode("-", $_SESSION['user']['terminate_date']);
                                            ?>
                                            <select id="Tmonth" name="Tmonth" class="form-control" style="width: 100px;">
                                                <?php
                                                $str = ltrim($date[1], '0');
                                                for ($i = 1; $i <= 12; $i++) {
                                                    $select = $str == $i ? 'selected' : '';
                                                    echo "<option value='$i' {$select}>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td style="width: 100px; padding: 10px;">
                                            Day<br/>
                                            <select id="Tdate" name="Tdate" class="form-control">
                                                <?php
                                                $str = ltrim($date[2], '0');
                                                for ($i = 1; $i <= 31; $i++) {
                                                    $select = $str == $i ? 'selected' : '';
                                                    echo "<option value='$i' {$select}>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>

                                        <td style="width: 150px; padding:0px 10px;">
                                            Year<br/>
                                            <select id="Tyear" name="Tyear" class="form-control">
                                                <?php
                                                $str = ltrim($date[0], '0');
                                                for ($i = $jala_date[0]; $i <= $jala_date[0] + 30; $i++) {
                                                    $select = $str == $i ? 'selected' : '';
                                                    echo "<option value='$i' {$select}>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" > Work Shuttle : </label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <?php
                            $id = $_SESSION['company']['id'];
                            $suttel = q('SELECT * FROM `tb_work_shuttle` where company_id=' . $id);
                            ?>
                            <select class="form-control" name="workShuttle">
                                <?php foreach ($suttel as $value) { ?>
                                    <option <?= $_SESSION['user']['work_shuttle'] == $value['id'] ? 'selected' : ""; ?> value="<?php echo $value['id']; ?>"><?php echo $value['area']; ?></option>
                                <?php } ?>
                           </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Monthly Salary:</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="text" class="form-control" value="<?= $_SESSION['user']['monthly_salary'] ?>"  name="monthlySalary" id="monthlySalary" placeholder="Enter Monthly Salary" required="">
                        </div>
                    </div>
                </div>
            </form>   
            <hr/>

            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="form-group">
                    <div class="input-group btn btn-primary saveData" onclick="secondSection()">
                        Save Changes
                    </div>
                    <div class="input-group btn btn-warning waitData" style="display: none;">
                        Please Wait
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
