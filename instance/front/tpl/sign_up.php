<div class="panel">
    <div class="panel-body">
        <div class="center-vertical ">
            <div class="center-content row">
                <form method="post" action="sign_up" id="sign_up-validation"   enctype="multipart/form-data"  class="col-md-4 col-sm-5 col-xs-11 col-lg-8 center-margin">

                    <h3 class="text-center pad25B font-gray text-transform-upr font-size-23">WHOzoor SignUp <span class="opacity-80"> Employee</span></h3>

                    <div id="" class="content-box bg-default">

                        <div class="form-group">
                            <label class="control-label col-sm-2">
                            </label>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <img id="imgTeamProfilePhoto" class="imgProfilePhoto m-team-photo--large" src="<?php print _MEDIA_URL ?>img/user.jpg" alt="Set Photo" style="cursor: pointer;border: 2px dashed transparent;
                                     border-radius: 50%;
                                     display: inline-block;
                                     position: relative;height: 60px;width: 60px">
                                <input type="file" name="emp_img" id="emp_img" class="inputfile" />
                                <!--<label for="file"><i class="glyphicon glyphicon-picture" style="font-size:34px;color:#00bca4;margin-left: 55px;"></i></label>-->
                                <!--                        <button style="background-color: #eeeeee;color: #000000;margin-left: 20px;" type="button" class="btn btn-default">Change Photo</button>-->
                            </div>
                        </div>  


                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-12 col-md-6 col-lg-6" for="firstname">First Name:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter First Name" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-12 col-md-6 col-lg-6" for="lastname">Last Name:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Last Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <?php
                            if ($sign_up_error != '') {
                                $set_brilliant_cookie = 0;
                                ?>
                                <div class="" style="padding:5px;">
                                    <div style="float:right;color:red;">
                                        <?php print _t('222', 'Email Already Exsit'); ?> 
                                    </div>

                                    <div style="clear:both;"></div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-12 col-md-6 col-lg-6" for="email">Email:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-12 col-md-6 col-lg-6" for="password">Password:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input id="password" type="password" class="form-control validate" name="password" required placeholder="Password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-12 col-md-6 col-lg-6" for="mobile">Mobile:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-12 col-md-6 col-lg-6" for="k_pin">Kiosk PIN:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-control" name="k_pin" id="k_pin" placeholder="Enter Kiosk PIN" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="" class="col-sm-12 col-md-6 col-lg-6 control-label" style="line-height: 30px;">Date of Birth:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="input-prepend input-group">
                                        <span class="add-on input-group-addon">
                                            <i class="glyph-icon icon-calendar"></i>
                                        </span>
                                        <input type="text" class=" form-control datepicker"  placeholder="08/27/1989" data-date-format="mm/dd/yyyy" name="dob" id="dob" required>
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
                                <label class="control-label col-sm-12 col-md-6 col-lg-6" for="e_c_name">Emergency Contact Name: </label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-control" name="e_c_name" id="e_c_name" placeholder="Enter Emergency Contact Name" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-12 col-md-6 col-lg-6" for="e_c_phone">Emergency Phone: </label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-control" name="e_c_phone" id="e_c_phone" placeholder="Enter Emergency Phone" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm-10">
                                <button class="btn btn-primary" type="submit" id="signup" name="signup">Sign Up</button>
                                <button class="btn btn-default" type="reset" >Reset</button>

                                <!--<button style="color: white;background-color: #2196F3;height: 40px;width: 200px;" type="submit" class="btn btn-default">Save</button>-->
                            </div>
                        </div>
                    </div>



                </form>

            </div>
        </div>
    </div>
</div>


