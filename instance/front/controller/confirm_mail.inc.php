<?php
$no_visible_elements = 1;
$urlArgs = _cg("url_vars");
//
//echo $urlArgs[0];
//die;
$user_name = qs("SELECT * FROM tb_employee WHERE email='{$urlArgs[0]}'");

$reset_error = '';

if ($urlArgs[0] != '') {

    $fields['verify_mail'] = "1";

    qu("tb_employee", $fields, "email='{$urlArgs[0]}'");
    ?>
    <div class="center-vertical ">
        <div class="center-content row"> 
            <form action="" id="resetpassword" method="post"  class="col-md-4 col-sm-5 col-xs-11 col-lg-4 center-margin " style="margin-top: 80px;">

                <div id="" class="content-box bg-default center-margin">
                    <div class="content-box-wrapper pad20A">
                        <section id="forgot-password">
                            <div class="logo" style="text-align: left;">
                                <img src="<?php print _MEDIA_URL ?>img/LOGO.png" style="height: 50px;width: 180px;" alt="">
                            </div>
                            <div class="">
                                <div class="alert green lighten-5 blue-text text-darken-2">
                                    <strong><i class="fa fa-css3"></i></strong>&nbsp; Hi,&nbsp;<?php echo $user_name['fname'] . ' ' . $user_name['lname']; ?>.<br>
                                    <div style="font-size: 16px;font-weight: 100;margin: 15px 0 15px 0px; padding: 0px 5px 5px 0px;"><?php print _t('235', 'Congratulations, <br>your email address has been verified!'); ?></div>
                                    <div style="">

                                        <a href="<?php echo _U; ?>login" class="btn btn-default btn-xlg"><?php print _t('236', 'Continue to Login'); ?></a>
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
    <?php
}
?>
