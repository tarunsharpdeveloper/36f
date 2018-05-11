<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$no_visible_elements = 1;

if ($_REQUEST['email'] != '') {

    $email = $_REQUEST['email'];
    $user_name = qs("SELECT * FROM tb_employee WHERE email='{$email}'");

    $sendemail = _escape($user_name['email']);
    $subject = "Confirm email";

    ob_start();
    include _PATH . 'instance/front/tpl/mail_verify_formate.php';
    $content = ob_get_contents();
    ob_end_clean();
//    print $content;
    _mail($sendemail, $subject, $content);
//    die;
    ?>
    <div class="center-vertical ">
        <div class="center-content row"> 
            <form action="" method="post"  class="col-md-4 col-sm-5 col-xs-11 col-lg-4 center-margin " style="margin-top: 100px;">

                <div id="" class="content-box bg-default center-margin">
                    <div class="content-box-wrapper pad20A">

                        <!--<img class="mrg25B center-margin radius-all-100 display-block" src="<?php print _MEDIA_URL ?>img/LOGO.png" alt="" width="220"  >-->

                        <section id="forgot-password">
                            <!-- Background Bubbles -->
<!--                            <canvas id="bubble-canvas"></canvas>-->
                            <!-- /Background Bubbles -->
                            <!-- Reset Form -->


                            <div class=" logo" style="text-align: left;">
                                <!--                    <img src="<?php print _MEDIA_URL ?>/images/MasirApp.png" alt="">-->
                                <img src="<?php print _MEDIA_URL ?>img/LOGO.png" style="height: 60px;width: 250px;" alt="">
                                <!--<span style="font-weight:bold;font-size:50px;color: #C71418;  text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;">Weed_API</span>-->
                            </div>
                            <div class="">
                                <div class="alert green lighten-5 blue-text text-darken-2">
                                    <strong><i class="fa fa-css3"></i></strong>&nbsp; Hi,&nbsp;<?php echo $user_name['fname'] . ' ' . $user_name['lname']; ?>.<br><br>
                                    <div style="font-size: 20px;font-weight: 400;"><?php print _t('230', 'Check your email'); ?></div>
                                    <div style="font-size: 17px;font-weight: 300;"><?php print _t('231', 'We have sent an email to'); ?>&nbsp;<a href=""><?php echo $email ?></a>&nbsp; <?php print _t('232', 'Click the link in the email to Confirmation.'); ?> <br> <br><strong>OR</strong>
                                        <br><br>
                                        <a href="<?php echo _U; ?>mail_verify" style="" class="btn-large "><?php print _t('233', 'Resend the Email'); ?></a>

                                    </div>


                                </div>


                            </div>


                            <!-- /Reset Form -->

                        </section>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
}
_cg("page_title", "Confirm Mail");
?>

