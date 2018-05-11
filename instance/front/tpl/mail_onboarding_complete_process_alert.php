<div class="container" style="background-color: white;width: 700px;height: 325px;border: 1px solid #dadada;font-family: tahoma">
    <div class="heading" style="border-bottom: 1px solid #dadada;padding-left: 10px;margin-top: 15px;font-weight: 100">
        <div class="col s8 logo" style="text-align: left;">
            <span style="font-weight:bold;font-size:50px;color: silver;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">WHOzoor</span>
            <div style="clear: both"></div>
        </div>
    </div>
    <div class="detail">
        <div style="font-size: 15px;font-weight: 150;margin: 15px 0 15px 20px;">
            <div>Hi&nbsp;<?php print trim($firstName . " " . $lastName); ?>,</div>
            <div>We miss you!</div>
            <div>we saved all of your data, just click this below link and you will start off where you left off</div>
            <div>&nbsp;</div>
            <div><a href="<?php print _U . "onboarding?mailEmpId=" . $empId ?>" target="_blank">Click here & complete your process</a></div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div>
                Thanks,<br/>
                WHOzoor
            </div>
        </div>
    </div>
</div>