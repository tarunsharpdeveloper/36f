<div class="lang-option" style="position:fixed;top:10px;right:10px;z-index: 100 !important;">
    <select name="changeLanguage" id="changeLanguage" onchange="return changeLanguage()">
        <option value="en" <?php print ($_SESSION['selected_lang'] != 'fa') ? 'selected' : '' ?>>English</option>
        <option value="fa" <?php print ($_SESSION['selected_lang'] == 'fa') ? 'selected' : '' ?>>Farsi</option>
    </select>
</div> 
<div class="center-vertical ">
    <div class="center-content row">
        <form method="post" action="login" id="login-validation" class="col-md-4 col-sm-5 col-xs-11 col-lg-4 center-margin">

            <h3 class="text-center pad25B font-gray text-transform-upr font-size-23">WHOzoor Admin <span class="opacity-80">v1.0</span></h3>

            <div id="" class="content-box bg-default">
                <div class="content-box-wrapper pad20A">
                    <img class="mrg25B center-margin radius-all-100 display-block" src="<?php print _MEDIA_URL ?>img/LOGO.png" alt="" width="220"  >
                    <div class="">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <?php
                            if (isset($_COOKIE["user_previous_session_id"]) && trim($_COOKIE["user_previous_session_id"]) != '') {
                                $cookieName = "user_previous_session_id";
                                unset($_COOKIE[$cookieName]);  
                                setcookie($cookieName, '', time() - 3600);  
                                ?>
                                <div class="" style="padding:5px;">
                                    <div style="float:right;color:red;">
                                        <?php print $langLabels["error_multiple_login_message"]; ?> 
                                    </div>

                                    <div style="clear:both;"></div>
                                </div>
                                <?php
                            }
                             
                            ?>
                            <?php
                            if ($login_error != '') {
                                $set_brilliant_cookie = 0;
                                ?>
                                <div class="" style="padding:5px;">
                                    <div style="float:right;color:red;">
                                        <?php print _t('222', 'Email and password are invalid'); ?> 
                                    </div>

                                    <div style="clear:both;"></div>
                                </div>
                            <?php } ?>
                            <?php
                            if ($login_error_blank != '') {
                                $set_brilliant_cookie = 0;
                                ?>
                                <div class="" style="padding:5px;">
                                    <div style="float:right;color:red;">
                                        <?php print _t('', ''); ?>Please Enter Email and password
                                    </div>

                                    <div style="clear:both;"></div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon addon-inside bg-gray">
                                <i class="glyph-icon icon-envelope-o"></i>
                            </span>
                            <input id="email" type="email" name="email" class="form-control" required  placeholder="<?php print $langLabels["text_username"]; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon addon-inside bg-gray">
                                <i class="glyph-icon icon-unlock-alt"></i>
                            </span>
                            <input id="password_login" type="password" class="form-control validate" name="password" required placeholder="<?php print $langLabels["text_password"]; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="g-recaptcha" data-sitekey="6LfyGTEUAAAAAHQpcP_6iBkPCIHWNpIXKa5eKw7T" style=""></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type = "submit" name = "submit" class = "btn btn-block btn-primary waves-effect waves-amber  z-depth-0 z-depth-1-hover"><?php print $langLabels["text_sign_in"]; ?></button>
                        <input type = "hidden" name = "LoginData" value = "1">
                    </div>
                    <div class="row">
                        <div class="checkbox-primary col-md-6 col-sm-6 col-xs-6" style="height: 20px;">
                            <label>
                                <input type="checkbox" id="loginCheckbox1" class="custom-checkbox">
                                <?php print $langLabels["text_remember_me"]; ?>
                            </label>
                        </div>
                        <div class="text-right col-md-6 col-sm-6 col-xs-6" style="height: 20px;">
                            <a href="<?php echo _U ?>onboarding" class="btn-links" title="Sign Up"><?php print $langLabels["text_sign_up"]; ?></a>
                        </div>

                        <div style="clear: both;"></div>
                        <div class="text-right col-md-6 col-lg-12 col-sm-12">
                            <a href="<?php echo _U ?>forgot_password" class="btn-links" title="Recover password"><?php print $langLabels["text_forgot_password"]; ?></a>

                        </div>

                    </div>
                </div>
            </div>

            <div id="login-forgot" class="content-box bg-default hide">
                <div class="content-box-wrapper pad20A">

                    <div class="form-group">
                        <label for="exampleInputEmail2">Email address:</label>
                        <div class="input-group">
                            <span class="input-group-addon addon-inside bg-gray">
                                <i class="glyph-icon icon-envelope-o"></i>
                            </span>
                            <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
                        </div>
                    </div>
                </div>
                <div class="button-pane text-center">
                    <button type="submit" class="btn btn-md btn-primary">Recover Password</button>
                    <a href="#" class="btn btn-md btn-link switch-button" switch-target="#login-form" switch-parent="#login-forgot" title="Cancel">Cancel</a>
                </div>

            </div>

        </form>

    </div>
</div>
<div class="modal fadeInUp center "  id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <form action="sign_in" id="new_timesheet_modal_form" method="POST" >
            <div class="modal-content">

                <div class="modal-header" style="text-align: center;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title center" id="myModalLabel2"><b>Get Started!</b></h4>
                </div>

                <div class="modal-body" >
                    <div class="panel" >
                        <div class="panel-body" >
                            <div class="col-md-12" style="color: #00CEB4;margin-bottom: 20px;">
                                <p style="text-align: center;">
                                    Get set up in minutes, no credit card required.
                                </p>
                            </div>
                            <br/>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-4 control-label" style="line-height: 30px;">Name</label>
                                        <div class="col-sm-4">
                                            <div class="input-prepend input-group">
                                                <input type="text" class="  form-control" id="fname" name="fname" value="" placeholder="First Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="input-prepend input-group">
                                                <input type="text" class="form-control" id="lname" name="lname" value="" placeholder="Last Name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-4 control-label" >Work Email</label>
                                        <div class="col-sm-8">
                                            <input type="email" name="email" id="email" class="form-control" id="workEmail" placeholder="Enter email" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <button class="btn btn-primary"  style="width: 100%" type="submit" >Try To WhoZoor for Sign Up</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>
                <div class="modal-footer">

                </div> 


            </div>
        </form>
    </div><!-- modal-content -->
</div>
