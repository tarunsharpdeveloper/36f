<?php
$no_visible_elements = 1;
$urlArgs = _cg("url_vars");

$user_name = qs("SELECT * FROM tb_employee WHERE email='{$urlArgs[0]}'");

$reset_error = '';

if ($_REQUEST['password'] != '') {
    $pass = $_REQUEST['password'];
    $re_pass = $_REQUEST['re-password'];

    if ($pass != $re_pass) {
        $reset_error = 1;
    } else {
        $fields['password'] = md5($_REQUEST['password']);

        qu("tb_employee", $fields, "email='{$urlArgs[0]}'");
        ?>
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

                                <!--<form>-->
                                <div class="logo" style="text-align: left;">
                 <!--                    <img src="<?php print _MEDIA_URL ?>/images/MasirApp.png" alt="">-->
                                    <img src="<?php print _MEDIA_URL ?>img/LOGO.png" style="height: 60px;width: 180px;" alt="">
                                    <!--<span style="font-weight:bold;font-size:50px;color: #C71418;text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;">Weed_API</span>-->
                                </div>
                                <div class="">
                                    <div class="alert green lighten-5 blue-text text-darken-2">
                                        <strong><i class="fa fa-css3"></i></strong>&nbsp; Hi,&nbsp;<?php echo $user_name['fname'] . ' ' . $user_name['lname']; ?>.<br>
                                        <div style="font-size: 25px;font-weight: 400;margin: 15px 0 15px 20px;"><?php print _t('235', 'Congratulations! You have successfully changed your password'); ?></div>
                                        <div style="">
                                            <br><br><br>
                                            <a href="<?php echo _U; ?>login" class="btn-default btn-lg"><?php print _t('236', 'Continue to Login'); ?></a>
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
}
?>
