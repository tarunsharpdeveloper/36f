<script type="text/javascript">
    function IsNumberOnly(txb)
    {
        var x = txb.value;
        if (isNaN(x) || x.indexOf(" ") !== -1)
        {
            txb.value = txb.value.replace(/[^\0-9]{1}/ig, "");
            txb.focus();
        } else if (x.length < 10 || x.length > 10)
        {
            txb.value = txb.value.replace(/[^\0-9]{9}/ig, "");
            txb.focus();
        } else {

        }
        return false;
    }
</script>
<style>
    .inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

</style>

<div class="panel">
    <div class="panel-body">

        <div class="panel">
            <div class="panel-body">
                <div class="container">
                    <!--  <h2>Edit Profile</h2>-->


                    <form method="post" action="edit_profile" enctype="multipart/form-data" > 



                        <div class="form-group">
                            <label class="control-label col-sm-2">
                            </label>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <?php
                                if (empty($ProfileData['photo'])) {
                                    $image = 'user.jpg';
                                } else {
                                    $image = $ProfileData['photo'];
                                }
                                ?>
                                <img id="imgTeamProfilePhoto" class="imgProfilePhoto m-team-photo--large" src="docs/profile_images/<?php echo $image; ?>" alt="Set Photo" style="cursor: pointer;border: 2px dashed transparent;
                                     border-radius: 50%;
                                     display: inline-block;
                                     position: relative;height: 60px;width: 60px">
                                <input type="file" name="file" id="file" class="inputfile" />
                                <label for="file"><i class="glyphicon glyphicon-picture" style="font-size:34px;color:#00bca4;margin-left: 55px;"></i></label>
                                <!--                        <button style="background-color: #eeeeee;color: #000000;margin-left: 20px;" type="button" class="btn btn-default">Change Photo</button>-->
                            </div>
                        </div>  


                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-2" for="firstname">First Name:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-control" value="<?php echo $ProfileData['fname']; ?>" name="firstname" id="firstname" placeholder="Enter First Name" required="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-2" for="lastname">Last Name:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-control" value="<?php echo $ProfileData['lname']; ?>" name="lastname" id="lastname" placeholder="Enter Last Name" required="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-2" for="email">Email:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input type="email" class="form-control" value="<?php echo $ProfileData['email']; ?>" name="email" id="email" placeholder="Enter email" required="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-2" for="mobile">Mobile:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-control" value="<?php echo $ProfileData['mobile']; ?>" name="mobile" id="mobile" placeholder="Enter Mobile"  maxlength="12" onkeyup="IsNumberOnly(this);" required="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-2" for="k_pin">Kiosk PIN:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-control" value="<?php echo $ProfileData['kiosk_pin']; ?>" name="k_pin" id="k_pin" placeholder="Enter Kiosk PIN" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="d_o_b" class="col-sm-2 control-label" style="line-height: 30px;">Date of Birth:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="input-prepend input-group">
                                        <span class="add-on input-group-addon">
                                            <i class="glyph-icon icon-calendar"></i>
                                        </span>
                                        <input type="text" id="d_o_b" name="d_o_b" class=" form-control datepicker"  value="<?php echo $ProfileData['dob']; ?>" placeholder="03/02/2017" data-date-format="mm/dd/yyyy" required="">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--    <div class="form-group">
                                <div class="input-group">
                                <label class="control-label col-sm-2" for="d_o_b">Date of Birth:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input type="text" class="bootstrap-datepicker form-control" name="d_o_b" id="d_o_b" placeholder="Enter Date Of Birth">
                                </div>
                                </div>
                            </div>-->

                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-2" for="e_c_name">Emergency Contact Name: </label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-control" value="<?php echo $ProfileData['em_contact_name']; ?>" name="e_c_name" id="e_c_name" placeholder="Enter Emergency Contact Name" required="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-2" for="e_c_phone">Emergency Phone: </label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-control" value="<?php echo $ProfileData['em_phone']; ?>" name="e_c_phone" id="e_c_phone" placeholder="Enter Emergency Phone"  maxlength="10" onkeyup="IsNumberOnly(this);" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-2" for="e_c_phone">Gender: </label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <?php if ($ProfileData['gender'] == "male") { ?>
                                        <input type="radio" name="gender" value="male" checked="selected"> Male
                                        <input type="radio" name="gender" value="female"> Female<br>
                                    <?php } elseif ($ProfileData['gender'] == "female") { ?>
                                        <input type="radio" name="gender" value="male" > Male
                                        <input type="radio" name="gender" value="female" checked="selected"> Female<br>
                                    <?php } else { ?>
                                        <input type="radio" name="gender" value="male" > Male
                                        <input type="radio" name="gender" value="female"> Female<br>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm-10">
                                <button class="btn btn-default" type="reset" >reset</button>
                                <button class="btn btn-primary" type="submit">Update</button>
                                <!--<button style="color: white;background-color: #2196F3;height: 40px;width: 200px;" type="submit" class="btn btn-default">Save</button>-->
                            </div>
                        </div>
                        <input type="hidden" name="update_employee" />
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

