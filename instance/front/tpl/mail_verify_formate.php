<div class="container" style="background-color: white;width: 700px;height: 325px;border: 1px solid #dadada;font-family: tahoma">
    <div class="heading" style="border-bottom: 1px solid #dadada;padding-left: 10px;margin-top: 15px;font-weight: 100">
        <div class="col s8 logo" style="text-align: left;">
            <!--<img src="<?php print _MEDIA_URL ?>/images/MasirApp.png" alt="">-->
            <span style="font-weight:bold;font-size:50px;color: silver;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">WHOzoor</span>
            <!--<img src="<?php print _MEDIA_URL ?>/images/Whozoor-Logos.png" style="height: 80px;width: 80px;" alt="">-->
            <span style="color:black;font-size: 20px;margin: 15px 0 0 10px">Hi,&nbsp;<?php echo $user_data['fname'] . ' ' . $user_data['lname']; ?></span>
            <div style="clear: both"></div></div>
    </div>
    <div class="detail">
        <div style="font-size: 25px;font-weight: 400;margin: 15px 0 15px 20px;"><?php print _t('226', 'We received a request to confirm email for your account.'); ?></div>
        <div style="font-size: 17px;font-weight: 300;margin: 15px 0 15px 20px;">If you requested a confirmation for <?php echo $user_data['email'] ?>, <?php print _t('228', 'use the below code for mail Verification. '); ?></div>
        <div style="margin: 30px 0 15px 20px;">
            <span style="background-color: silver;padding: 10px;width: 200px;font-size:20px;cursor: pointer;color: white;text-decoration: none"><?php echo $user_data['mail_code'] ?></span>
        </div>
        <div style="font-size: 17px;font-weight: 300;margin: 15px 0 15px 20px;"> If you did not make this request, please ignore this email</div>
        <!--        <div style="margin: 30px 0 15px 20px;">
                    <a href="<?php echo _U; ?>confirm_mail/<?php echo $user_data['mail_code'] ?>" style="background-color: silver;padding: 10px;width: 167px;font-size:20px;cursor: pointer;color: white;text-decoration: none"><?php print _t('229', 'Confrim Mail'); ?></a>
                </div>-->
    </div>
</div>