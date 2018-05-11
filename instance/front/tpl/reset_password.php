<div class="center-vertical ">
    <div class="center-content row"> 
        <form action="" id="resetpassword" method="post"  class="col-md-4 col-sm-5 col-xs-11 col-lg-4 center-margin " style="margin-top: 100px;">

            <div id="" class="content-box bg-default center-margin">
                <div class="content-box-wrapper pad20A">

                    <!--<img class="mrg25B center-margin radius-all-100 display-block" src="<?php print _MEDIA_URL ?>img/LOGO.png" alt="" width="220"  >-->

                    <section id="forgot-password">

                        <!-- Background Bubbles -->
                        <!--<canvas id="bubble-canvas"></canvas>-->
                        <!-- /Background Bubbles -->
                        <!-- Reset Form -->
                        <!--<form action="" method="post" id="resetpassword">-->
                        <div class="logo" style="text-align: left;">
                    <!--                    <img src="<?php print _MEDIA_URL ?>/images/MasirApp.png" alt="">-->
                            <img src="<?php print _MEDIA_URL ?>img/LOGO.png" style="height: 60px;width: 180px;" alt="">
                            <!--<span style="font-weight:bold;font-size:50px;color: #C71418;text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;">Weed_API</span>-->
                        </div>
                        <div class="">

                            <div class="alert blue lighten-5 blue-text text-darken-2">
                                <strong><i class="fa fa-css3"></i></strong>&nbsp;<?php print _t('234', 'We will reset password for this email.'); ?> 
                            </div>
                            <div class="">

                                <?php
                                if ($reset_error != '') {
                                    ?>
                                    <div class="" style="padding:5px;">
                                        <div style="float:right;"><img src="<?php print _MEDIA_URL ?>img/login-erroe.png" width="28" height="26" alt=" " /></div>
                                        <div style="margin-left:42px;color:red;"><?php _t('237', 'Password not match'); ?></div>
                                        <div style="clear:both;"></div>
                                    </div>
                                <?php } ?>

                            </div>

                            <div class="form-group">
                                <div class="input-group">

                                                                            <i class="glyph-icon icon-unlock-alt"></i>
<label for="password"><?php print _t('189', 'Password') ?></label>
                                    <!--<span class="input-group-addon addon-inside bg-gray">-->
                                    <!--</span>-->
                                    <input id="password" type="password" name="password" required placeholder="New Password" class="form-control">

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">

                                                                           <i class="glyph-icon icon-unlock-alt small"></i>
 <label for="re-password">Re-Enter Password</label>
                                    <!--<span class="input-group-addon addon-inside bg-gray">-->
                                    <!--</span>-->
                                    <input id="re-password" type="password" name="re-password" required  placeholder="re-New Password" class="form-control">

                                </div>
                            </div>




                            <div class="form-group">
                                <div class="input-group">

                                    <button type="submit" name="submit" class="btn-default btn-lg"><?php print _t('225', 'RESET'); ?></button>
                                </div>
                            </div>


                        </div>
                        <!--</form>-->
                        <!-- /Reset Form -->

                    </section>
                </div>
            </div>
        </form>
    </div>
</div>
