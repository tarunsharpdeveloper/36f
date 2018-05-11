<style>
    .dropdown-menu li > a:hover {
        border-top: 1px solid rgba(10, 10, 10, 0.36);
        border-bottom: 1px solid rgba(10, 10, 10, 0.36);
    }
    .dropdown-menu>li.clean-slate, .dropdown-menu>li>* {
        border-top: 1px solid transparent;
        border-bottom: 1px solid transparent;
    }
    /*    .navbar-nav >li> a:hover,*:focus, *:active {
            color: white;
            background: #07CFB6;
    
        }
        .navbar-nav >li> a:active{
            color: #00CEB4;
    
        }
        .navbar-nav >li> a, a:visited, a:focus, a:active, *:visited, *:focus, *:active {
            outline: medium none;
            border: #2274c9;
            background: #F9FBFC;
        }*/
    .badge-notify{ 
        background:red; 
        position:relative;
        top: -16px !important;
        left: -16px; 
        width:14px;
        line-height:14px;
        font-size:10px;
        min-width: 14px; 
    }
    .notification-list{
        width: auto; 
        max-height: 400px;
        overflow-y: auto !important; 
        border:2px solid #DADADA;
        border-radius: 5px;
        display: none;
        position: absolute;
        background: #FAFAFA;
        overflow: hidden;
    }
    .notification-each-list {
        padding: 16px; 
        border-bottom:1px solid #DADADA;
        width: 400px;  
        word-wrap:break-word !important;
        line-break: normal !important;  
        line-height: 1.5 !important;  
        white-space: normal !important;
    }
    .notification-each-list-last{
        border-bottom: none !important;
    }

</style>
<?php
//if ($_SESSION['user']['access_level'] == "Admin" || $_SESSION['user']['access_level'] == "admin" || 1)
if ($_SESSION['user']['access_level'] == "Admin" || $_SESSION['user']['access_level'] == "admin" || 1) { 
    ?>
    <style>
        /*        .btn-azure{
                    background-color: #444;
                    color: white;
                     border-color: #444;
                }
                .btn-azure:hover{
                    background: #888 none repeat scroll 0 0;
                    border-color: #444;
                    color: white
                }
                .btn-primary:hover {
                    background: #888 none repeat scroll 0 0;
                    border-color: #444;
                    color: white
                }
                .btn-primary{
                    background-color: #444;
                    color: white;
                     border-color: #444;
                }*/
    </style>
    <?php
    $navinverse = "navbar-inverse";
    $bgcolor = "background-color: #00BCA4;";
    $logo = "Admin";
} else {
    $navinverse = "navbar-default";
    $logo = "";
    $bgcolor = "";
}

function timeago($date) {
    $timestamp = strtotime($date);

    $strTime = array("second", "minute", "hour", "day", "month", "year");
    $length = array("60", "60", "24", "30", "12", "10");

    $currentTime = time();
    if ($currentTime >= $timestamp) {
        $diff = time() - $timestamp;
        for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
            $diff = $diff / $length[$i];
        }

        $diff = round($diff);
        return $diff . " " . $strTime[$i] . "(s) ago ";
    }
}
?>
<div class="bs-example">
    <nav id="myNavbar" class="navbar <?= $navinverse ?> navbar-fixed-top   green" role="navigation" style="<?= $bgcolor ?>">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="" style="margin: 0;">
            <div class="navbar-header navbar-right" style="right: 10px;" >
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand navbar-right" href="<?php l('me_home') ?>" >
                    <?php if (empty($logo)) { ?>
                        <img class="left-align radius-all-100 display-block" src="<?php print _MEDIA_URL ?>img/tlogo.png" alt="WHOzoor"  width="180" style="margin:-10px 20px;"  />
                    <?php } else {
                        ?>
                        <span style="margin:-10px 20px; font-family: fantasy;font-size: 20px;font-weight: bold;"><?= $logo ?></span>
                        <?php
                    }
                    ?>
<!--<img class="left-align radius-all-100 display-block" src="<?php print _MEDIA_URL ?>img/tlogo.png" alt="WHOzoor"  width="180" style="margin:-10px 20px;"  />-->
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <?php if ($logo == "Admin") { ?>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-top: 4px;">
                    <ul class="nav navbar-nav navbar-right" >
                        <!--<li><a href="<?php l('me_home') ?>" class="  <?= (_cg('current_page') == 'me_home' ? 'active' : ''); ?>"><?= _t(1, "Me") ?></a></li>-->
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class=" dropdown-toggle"><span style="color:orange;font-weight:bold">Sandbox</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php l('test_rules') ?>">Sandbox</a></li>
                                <li><a href="<?php l('test_timeoff') ?>">Timeoff</a></li>
                                <li><a href="<?php l('test_add_shift') ?>">Add Shift</a></li>
                            </ul>
                        </li>
                        <!--<li><a href="<?php l('test_rules') ?>" class="<?= (_cg('test_rules') == 'Settings' ? 'active' : ''); ?> "><span style="color:orange;font-weight:bold">Sandbox</span></a></li>-->
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class=" dropdown-toggle"><?= _t(0, "Settings") ?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php l('employee_settings') ?>">General</a></li> 
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Advanced</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php l('daily_karkaard') ?>"><span style='font-size:11px;'>Daily Karkaard Settings</span></a></li>                                     
                                        <li><a href="<?php l('designated_approver') ?>">Designated Approver</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="<?php l('task') ?>" class="<?= (_cg('current_page') == 'task' ? 'active' : ''); ?> "><?= _t(2, "Task") ?></a></li>
                        <li><a href="<?php l('hnd') ?>" class="<?= (_cg('current_page') == 'h&d' ? 'active' : ''); ?> "><?= _t('', "H&D") ?></a></li>
                        <li><a href="<?php l('report') ?>" class="<?= (_cg('current_page') == 'Report' ? 'active' : ''); ?> "><?= _t('', "Report") ?></a></li>
                        <li><a href="<?php l('location') ?>" class="<?= (_cg('current_page') == 'Location' ? 'active' : ''); ?> "><?= _t('', "Location") ?></a></li>
                        <!--<li><a href="<?php l('leave') ?>" class="<?= (_cg('current_page') == 'leave' ? 'active' : ''); ?> "><?= _t(3, "Leave") ?></a></li>-->

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <!--<li><a href="<?php l('people') ?>" class="<?= (_cg('current_page') == 'people' ? 'active' : ''); ?>"><?= _t(5, "People") ?></a></li>-->
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class=" dropdown-toggle"><?= _t(5, "People") ?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php l('people') ?>">Employees</a></li>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">Request</a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="<?php l('request_time_off') ?>">Time Off</a></li>
                                        <li><a href="<?php l('request_errand') ?>">Errand</a></li>
                                        <li><a href="<?php l('create_absence') ?>">Create Absence</a></li>                                        
                                    </ul>
                                </li>
                                <li><a href="<?php l('kardex') ?>">Kardex Settings</a></li>
                                <li><a href="<?php l('settings_ot') ?>">OT Settings</a></li>
                            </ul>
                        </li>


                        <li><a href="<?php l('newschedule_2') ?>" class="<?= (_cg('current_page') == 'newschedule_2' ? 'active' : ''); ?>"><?= _t(4, "Schedule") ?></a></li>

                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class=" dropdown-toggle"><?= _t(6, "TimeSheets") ?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <!-- <li><a href="<?php l('approve_timesheet_2') ?>">Approve Timesheets</a></li> -->
                                <li><a href="<?php l('timesheet_approve') ?>">Approve Timesheets</a></li>
                                <li><a href="<?php l('approve_timesheet#') ?>">Export Timesheets</a></li>
                                <!--<li><a href="<?php l('kardex') ?>">Kardex Settings</a></li>-->
                            </ul>
                        </li>



                        <!--                    <li class="dropdown">
                                                <a href="#" data-toggle="dropdown" class=" dropdown-toggle"><?= _t(7, "News Feed") ?><b class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="<?php l('newsfeed') ?>">View</a></li>
                                                 
                                                </ul>
                                            </li>-->
                    </ul>
                    <ul class="nav navbar-nav nav"  >
                        <div class="dropdown">

                            <a data-toggle="dropdown" href="#" title="" onclick="resetCountNotify()">
                                <span class="bs-badge badge-absolute bg-orange" id="getCountNotify"></span>
                                <i class="glyph-icon icon-globe" style="font-size: 18px;"></i>
                            </a>
                            <div class="dropdown-menu">

                                <div class="popover-title display-block clearfix pad10A">
                                    Notifications
                                </div>
                                <div class="scrollable-content scrollable-nice box-md scrollable-small" id="notification-panel">

                                    <ul class="no-border notifications-box">
                                        <?php
                                        if ($_SESSION['user']['access_level'] == "manager" || $_SESSION['user']['access_level'] == "Location_Manager" || $_SESSION['user']['access_level'] == "Admin") {
                                            $noty = q("select *,empl.created_at as cdate from tb_employee_log empl,tb_employee emp where emp.id=empl.emp_id and empl.company_id='{$_SESSION['user']['work_at']}' Order by empl.id DESC");
//d($noty['cdate']);

                                            foreach ($noty as $notify) :
                                                if (empty($notify['photo'])) {
                                                    $image = 'user.jpg';
                                                } else {
                                                    $image = $notify['photo'];
                                                }
                                                ?>
                                                <li>
                                                    <span class="bg-danger icon-notification glyph-icon icon-bullhorn"></span>
                                                    <span class="notification-text">

                                                        <h5>
                                                            <?php
                                                            if ($notify['emp_id'] == $_SESSION['user']['id']) {
                                                                echo 'You';
                                                            } else {
                                                                echo $notify['fname'] . ' ' . $notify['lname'];
                                                            }
                                                            ?></h5>
                                                        <h6><?php
                                                            if ($notify['task_to'] == $_SESSION['user']['id']) {
                                                                echo 'You Have New task from ' . $notify['fname'] . ' ' . $notify['lname'];
                                                            } else {
                                                                echo $notify['log'];
                                                            }
                                                            ?></h6></span>
                                                    <div class="notification-time">
                                                        <?php echo timeago($notify['cdate']); ?>
                                                        <span class="glyph-icon icon-clock-o"></span>
                                                    </div>
                                                </li>
                                                <?php
                                            endforeach;
                                        }
                                        if ($_SESSION['user']['access_level'] == "employee" || $_SESSION['user']['access_level'] == "Employee") {
                                            $noty = q("select *,empl.created_at as cdate  from tb_employee_log empl,tb_employee emp where emp.id=empl.emp_id  and empl.company_id='{$_SESSION['user']['work_at']}' and Not empl.task_to=0 Order by empl.id DESC");
//                    $noty = q("select * from tb_employee_log empl,tb_employee emp where emp.id=empl.emp_id  and empl.company_id='{$_SESSION['user']['work_at']}' and empl.task_to='{$_SESSION['user']['id']}' or empl.emp_id='{$_SESSION['user']['id']}' Order by empl.id DESC");

                                            foreach ($noty as $notify) :
                                                if (empty($notify['photo'])) {
                                                    $image = 'user.jpg';
                                                } else {
                                                    $image = $notify['photo'];
                                                }
                                                ?>
                                                <li>
                                                    <span class="bg-danger icon-notification glyph-icon icon-bullhorn"></span>
                                                    <span class="notification-text">

                                                        <h5>
                                                            <?php
                                                            if ($notify['emp_id'] == $_SESSION['user']['id']) {
                                                                echo 'You';
                                                                $messages = $notify['log'];
                                                            } else {
                                                                echo $notify['fname'] . ' ' . $notify['lname'];
                                                            }
                                                            ?></h5>
                                                        <h6> <?php
                                                            if ($notify['task_to'] == $_SESSION['user']['id']) {
                                                                $messages = 'You Have New task from ' . $notify['fname'] . ' ' . $notify['lname'];
                                                            } else {
                                                                $messages = $notify['log'];
                                                            }
                                                            echo $messages;
                                                            ?></h6></span>
                                                    <div class="notification-time">
                                                        <?php echo timeago($notify['cdate']); ?>
                                                        <span class="glyph-icon icon-clock-o"></span>
                                                    </div>
                                                </li><?php
                                            endforeach;
                                        }
                                        ?>
                                        <!--                                            <li>
                                                                                        <span class="bg-warning icon-notification glyph-icon icon-users"></span>
                                                                                        <span class="notification-text font-blue">This is a warning notification</span>
                                                                                        <div class="notification-time">
                                                                                            <b>15</b> minutes ago
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-green icon-notification glyph-icon icon-sitemap"></span>
                                                                                        <span class="notification-text font-green">A success message example.</span>
                                                                                        <div class="notification-time">
                                                                                            <b>2 hours</b> ago
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-azure icon-notification glyph-icon icon-random"></span>
                                                                                        <span class="notification-text">This is an error notification</span>
                                                                                        <div class="notification-time">
                                        <?php echo timeago($notify['cdate']); ?>
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-warning icon-notification glyph-icon icon-ticket"></span>
                                                                                        <span class="notification-text">This is a warning notification</span>
                                                                                        <div class="notification-time">
                                                                                            <b>15</b> minutes ago
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-blue icon-notification glyph-icon icon-user"></span>
                                                                                        <span class="notification-text font-blue">Alternate notification styling.</span>
                                                                                        <div class="notification-time">
                                                                                            <b>2 hours</b> ago
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-purple icon-notification glyph-icon icon-user"></span>
                                                                                        <span class="notification-text">This is an error notification</span>
                                                                                        <div class="notification-time">
                                        <?php echo timeago($notify['cdate']); ?>
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-warning icon-notification glyph-icon icon-user"></span>
                                                                                        <span class="notification-text">This is a warning notification</span>
                                                                                        <div class="notification-time">
                                                                                            <b>15</b> minutes ago
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-green icon-notification glyph-icon icon-user"></span>
                                                                                        <span class="notification-text font-green">A success message example.</span>
                                                                                        <div class="notification-time">
                                                                                            <b>2 hours</b> ago
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-purple icon-notification glyph-icon icon-user"></span>
                                                                                        <span class="notification-text">This is an error notification</span>
                                                                                        <div class="notification-time">
                                        <?php echo timeago($notify['cdate']); ?>
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-warning icon-notification glyph-icon icon-user"></span>
                                                                                        <span class="notification-text">This is a warning notification</span>
                                                                                        <div class="notification-time">
                                                                                            <b>15</b> minutes ago
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>--> 
                                        <!--                                            <li>
                                                                                        <span class="bg-danger icon-notification glyph-icon icon-bullhorn"></span>
                                                                                        <span class="notification-text"><b>xyz</b></span><br/>
                                                                                        <span class="notification-text">none</span>
                                                                                        <div class="notification-time">
                                        <?php echo timeago($notify['cdate']); ?>
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>-->
                                    </ul>

                                </div>
                                <div class="pad10A button-pane button-pane-alt text-center">
                                    <a href="#" class="btn btn-primary" title="View all notifications">
                                        View all notifications
                                    </a>
                                </div>

                            </div>
                        </div>
                        <!--                    <li class="">
                                                <button class="btn btn-gray-opacity " href="#">
                                                    <i class="glyph-icon icon-eye" style="height: 100%"></i>
                                                </button>
                                            </li>-->
                        <!--                        <div class="btn vertical-button hover-white" href="#" title="" style="padding: 0px;line-height: 0em" >
                                                  <a class="btn vertical-button hover-gray sb-toggle-left"  id="chatbox-btn" title="Notification" href="#" >
                                                        <i class="glyph-icon icon-globe " style="font-size: 25px;color: gray;"></i>
                        
                                                    </a>
                                                   
                                                </div>-->
                        <div class="btn vertical-button hover-gray" href="#" title="" style="padding: 0px;line-height: 0em" >
                            <a class="btn vertical-button hover-gray sb-toggle-right dropdown-toggle"  id="chatbox-btn" title="Chat sidebar" href="#" >
                                <i class="glyph-icon icon-comments-o " style="font-size: 25px;color: grey;"></i>
                            </a>
                        </div>

                        <div class="btn vertical-button hover-gray"  href="#" title="" style="padding: 0px;line-height: 0em" >
                            <a class="btn vertical-button hover-gray dropdown-toggle"  data-toggle="dropdown"  aria-expanded="true" href="#" title="" >
                                <!--<span class="glyph-icon icon-separator-vertical">-->
                                <i class="glyph-icon icon-question-circle " style="font-size: 25px;"></i>
                                <!--</span>-->

                            </a>

                            <ul class="dropdown-menu" role="menu">
                              <!--<li style="text-align: center;"><span style="text-transform: uppercase;"><?= $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname']; ?></span></li>-->
                                <li><a href="<?php l('#') ?>">About Helps </a></li>
                                <li><a href="<?php l('#') ?>">About Docs </a></li>
                                <li><a href="<?php l('#') ?>">About Account </a></li>
                                <li><a href="<?php l('#') ?>">About Privacy </a></li>
                                <li class="divider"></li>
                                <li style="text-align: center;"><a href="#">HELP</a></li>
                            </ul>
                        </div> 
                        <div class="btn vertical-button hover-gray"  href="#" title="" style="padding: 0px;line-height: 0em" >
                            <?php
                            $userNotifications = Notifications::GetEmployeeNotifications($_SESSION['user']['id']);
                            $totalNotification = count($userNotifications);
                            ?>
                            <a href="#" onclick="return normalUserNotificationShow('<?php print $_SESSION['user']['id']; ?>');">
                                <i class="glyphicon glyphicon-bell" style="font-size: 21px;"></i>
                                <?php if ($totalNotification > 0) { ?>
                                    <span id="notification_counter" class="badge badge-notify"><?php print Notifications::GetEmployeeNotificationsCount($_SESSION['user']['id']); ?></span>
                                <?php } ?>
                            </a>
                            <?php
                            if ($totalNotification > 0) {
                                ?>
                                <div class="notification-list" id="normal_user_notifications">
                                    <?php
                                    $noOfNoti = 9;
                                    $startNoti = 0;
                                    $notificationPart = $noOfNoti;
                                    for ($i = 0; $i < $totalNotification / $noOfNoti; $i++) {
                                        ?>
                                        <div class="noti-box noti-box<?= $i ?> <?php echo $i == 0 ? '' : 'hidden'; ?>">
                                            <?php
                                            for ($j = $startNoti; $j < $notificationPart; $j++) {
                                                if ($userNotifications[$j]["display_text"]) {
                                                    ?>
                                                    <div class="notification-each-list" data-id="<?php echo $userNotifications[$j]["id"]; ?>">
                                                        <?php echo $userNotifications[$j]["display_text"]; ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div> 
                                        <?php
                                        $startNoti = $notificationPart;
                                        $notificationPart = $notificationPart + $noOfNoti;
                                    }
                                    ?>
                                    <div class="hidden nextDiv">1</div>
                                    <div class="hidden preDiv">0</div>
                                    <div class="hidden totalDiv"><?php echo floor($totalNotification / $noOfNoti); ?></div>
                                    <div class="notification-each-list <?php echo floor($totalNotification / $noOfNoti) == 0 ? "hidden" : ''; ?>"  >
                                        <div class="pull-left preDivDisp hidden" onclick="nextNoti('pre')">Previous</div>
                                        <div class="pull-right nextDivDisp <?php echo floor($totalNotification / $noOfNoti) == 0 ? "hidden" : ''; ?>" onclick="nextNoti('next')">Next</div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>


                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class=" dropdown-toggle"  aria-expanded="true"><span style="text-transform: uppercase; font-weight: bold"><?= $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname']; ?></span> <b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu">
                                <li style="text-align: center;"><span style="text-transform: uppercase;"><?= $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname']; ?></span></li>
                                <li><a href="<?php l('profile') ?>">Profile</a></li>
                                <li><a href="<?php l('myaccount') ?>">My Account</a></li>
                                <li class="divider"></li>
                                <li style="text-align: center;"><a href="<?php echo _U ?>?logout=1">LogOut</a></li>
                            </ul>
                        </li>



                    </ul>

                </div>
            <?php } else { ?>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-top: 4px;">
                    <ul class="nav navbar-nav navbar-right" >
                        <!--<li><a href="<?php l('me_home') ?>" class="  <?= (_cg('current_page') == 'me_home' ? 'active' : ''); ?>"><?= _t(1, "Me") ?></a></li>-->
                        <li><a href="<?php l('employee_settings') ?>" class="<?= (_cg('employee_settings') == 'Settings' ? 'active' : ''); ?> "><?= _t(0, "Settings") ?></a></li>
                        <li><a href="<?php l('task') ?>" class="<?= (_cg('current_page') == 'task' ? 'active' : ''); ?> "><?= _t(2, "Task") ?></a></li>
                        <li><a href="<?php l('hnd') ?>" class="<?= (_cg('current_page') == 'task' ? 'active' : ''); ?> "><?= _t('', "H&D") ?></a></li>
                        <li><a href="<?php l('report') ?>" class="<?= (_cg('current_page') == 'Report' ? 'active' : ''); ?> "><?= _t('', "Report") ?></a></li>
                        <li><a href="<?php l('location') ?>" class="<?= (_cg('current_page') == 'Location' ? 'active' : ''); ?> "><?= _t('', "Location") ?></a></li>

                        <?php if (strtolower($_SESSION['user']['access_level']) == "manager" || strtolower($_SESSION['user']['access_level']) == "supervisor") { ?>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class=" dropdown-toggle">Request<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="<?php l('request_time_off') ?>">Time Off</a></li>
                                    <li><a href="<?php l('request_errand') ?>">Errand</a></li>                                        
                                </ul>
                            </li>
                        <?php } ?>
                    <!--<li><a href="<?php l('leave') ?>" class="<?= (_cg('current_page') == 'leave' ? 'active' : ''); ?> "><?= _t(3, "Leave") ?></a></li>-->
                        <?php if ($_SESSION['user']['access_level'] == "manager" || $_SESSION['user']['access_level'] == "owner" or $_SESSION['user']['access_level'] == 'Location_Manager') {
                            ?>
                            <li><a href="<?php l('people') ?>" class="<?= (_cg('current_page') == 'people' ? 'active' : ''); ?>"><?= _t(5, "People") ?></a></li>
                            <li><a href="<?php l('newschedule_2') ?>" class="<?= (_cg('current_page') == 'newschedule_2' ? 'active' : ''); ?>"><?= _t(4, "Schedule") ?></a></li>

                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class=" dropdown-toggle"><?= _t(6, "TimeSheets") ?><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php l('approve_timesheet_2') ?>">Approve Timesheets</a></li>
                                    <li><a href="<?php l('approve_timesheet#') ?>">Export Timesheets</a></li>
                                    <li><a href="<?php l('kardex') ?>">Kardex Settings</a></li>
                                    <li><a href="<?php l('settings_ot') ?>">OT Settings</a></li>
                                </ul>
                            </li>

                        <?php } ?>

                        <!--                    <li class="dropdown">
                                                <a href="#" data-toggle="dropdown" class=" dropdown-toggle"><?= _t(7, "News Feed") ?><b class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="<?php l('newsfeed') ?>">View</a></li>
                                                 
                                                </ul>
                                            </li>-->
                    </ul>
                    <ul class="nav navbar-nav nav"  >
                        <div class="dropdown">

                            <a data-toggle="dropdown" href="#" title="" onclick="resetCountNotify()">
                                <span class="bs-badge badge-absolute bg-orange" id="getCountNotify"></span>
                                <i class="glyph-icon icon-globe" style="font-size: 18px;"></i>
                            </a>
                            <div class="dropdown-menu">

                                <div class="popover-title display-block clearfix pad10A">
                                    Notifications
                                </div>
                                <div class="scrollable-content scrollable-nice box-md scrollable-small">

                                    <ul class="no-border notifications-box">
                                        <?php
                                        if ($_SESSION['user']['access_level'] == "manager" || $_SESSION['user']['access_level'] == "Location_Manager" || $_SESSION['user']['access_level'] == "Admin") {
                                            $noty = q("select *,empl.created_at as cdate from tb_employee_log empl,tb_employee emp where emp.id=empl.emp_id and empl.company_id='{$_SESSION['user']['work_at']}' Order by empl.id DESC");

                                            foreach ($noty as $notify) :
                                                if (empty($notify['photo'])) {
                                                    $image = 'user.jpg';
                                                } else {
                                                    $image = $notify['photo'];
                                                }
                                                ?>
                                                <li>
                                                    <span class="bg-danger icon-notification glyph-icon icon-bullhorn"></span>
                                                    <span class="notification-text">

                                                        <h5>
                                                            <?php
                                                            if ($notify['emp_id'] == $_SESSION['user']['id']) {
                                                                echo 'You';
                                                            } else {
                                                                echo $notify['fname'] . ' ' . $notify['lname'];
                                                            }
                                                            ?></h5>
                                                        <h6><?php
                                                            if ($notify['task_to'] == $_SESSION['user']['id']) {
                                                                echo 'You Have New task from ' . $notify['fname'] . ' ' . $notify['lname'];
                                                            } else {
                                                                echo $notify['log'];
                                                            }
                                                            ?></h6></span>
                                                    <div class="notification-time">
                                                        <?php echo timeago($notify['cdate']); ?>
                                                        <span class="glyph-icon icon-clock-o"></span>
                                                    </div>
                                                </li>
                                                <?php
                                            endforeach;
                                        }
                                        if ($_SESSION['user']['access_level'] == "employee" || $_SESSION['user']['access_level'] == "Employee") {
                                            $noty = q("select *,empl.created_at as cdate from tb_employee_log empl,tb_employee emp where emp.id=empl.emp_id  and empl.company_id='{$_SESSION['user']['work_at']}' and Not empl.task_to=0 Order by empl.id DESC");
//                    $noty = q("select * from tb_employee_log empl,tb_employee emp where emp.id=empl.emp_id  and empl.company_id='{$_SESSION['user']['work_at']}' and empl.task_to='{$_SESSION['user']['id']}' or empl.emp_id='{$_SESSION['user']['id']}' Order by empl.id DESC");

                                            foreach ($noty as $notify) :
                                                if (empty($notify['photo'])) {
                                                    $image = 'user.jpg';
                                                } else {
                                                    $image = $notify['photo'];
                                                }
                                                ?>
                                                <li>
                                                    <span class="bg-danger icon-notification glyph-icon icon-bullhorn"></span>
                                                    <span class="notification-text">

                                                        <h5>
                                                            <?php
                                                            if ($notify['emp_id'] == $_SESSION['user']['id']) {
                                                                echo 'You';
                                                                $messages = $notify['log'];
                                                            } else {
                                                                echo $notify['fname'] . ' ' . $notify['lname'];
                                                            }
                                                            ?></h5>
                                                        <h6> <?php
                                                            if ($notify['task_to'] == $_SESSION['user']['id']) {
                                                                $messages = 'You Have New task from ' . $notify['fname'] . ' ' . $notify['lname'];
                                                            } else {
                                                                $messages = $notify['log'];
                                                            }
                                                            echo $messages;
                                                            ?></h6></span>
                                                    <div class="notification-time">
                                                        <?php echo timeago($notify['cdate']); ?>
                                                        <span class="glyph-icon icon-clock-o"></span>
                                                    </div>
                                                </li><?php
                                            endforeach;
                                        }
                                        ?>
                                        <!--                                            <li>
                                                                                        <span class="bg-warning icon-notification glyph-icon icon-users"></span>
                                                                                        <span class="notification-text font-blue">This is a warning notification</span>
                                                                                        <div class="notification-time">
                                                                                            <b>15</b> minutes ago
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-green icon-notification glyph-icon icon-sitemap"></span>
                                                                                        <span class="notification-text font-green">A success message example.</span>
                                                                                        <div class="notification-time">
                                                                                            <b>2 hours</b> ago
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-azure icon-notification glyph-icon icon-random"></span>
                                                                                        <span class="notification-text">This is an error notification</span>
                                                                                        <div class="notification-time">
                                        <?php echo timeago($notify['created_at']); ?>
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-warning icon-notification glyph-icon icon-ticket"></span>
                                                                                        <span class="notification-text">This is a warning notification</span>
                                                                                        <div class="notification-time">
                                                                                            <b>15</b> minutes ago
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-blue icon-notification glyph-icon icon-user"></span>
                                                                                        <span class="notification-text font-blue">Alternate notification styling.</span>
                                                                                        <div class="notification-time">
                                                                                            <b>2 hours</b> ago
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-purple icon-notification glyph-icon icon-user"></span>
                                                                                        <span class="notification-text">This is an error notification</span>
                                                                                        <div class="notification-time">
                                        <?php echo timeago($notify['created_at']); ?>
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-warning icon-notification glyph-icon icon-user"></span>
                                                                                        <span class="notification-text">This is a warning notification</span>
                                                                                        <div class="notification-time">
                                                                                            <b>15</b> minutes ago
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-green icon-notification glyph-icon icon-user"></span>
                                                                                        <span class="notification-text font-green">A success message example.</span>
                                                                                        <div class="notification-time">
                                                                                            <b>2 hours</b> ago
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-purple icon-notification glyph-icon icon-user"></span>
                                                                                        <span class="notification-text">This is an error notification</span>
                                                                                        <div class="notification-time">
                                        <?php echo timeago($notify['created_at']); ?>
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <span class="bg-warning icon-notification glyph-icon icon-user"></span>
                                                                                        <span class="notification-text">This is a warning notification</span>
                                                                                        <div class="notification-time">
                                                                                            <b>15</b> minutes ago
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>--> 
                                        <!--                                            <li>
                                                                                        <span class="bg-danger icon-notification glyph-icon icon-bullhorn"></span>
                                                                                        <span class="notification-text"><b>xyz</b></span><br/>
                                                                                        <span class="notification-text">none</span>
                                                                                        <div class="notification-time">
                                        <?php echo timeago($notify['created_at']); ?>
                                                                                            <span class="glyph-icon icon-clock-o"></span>
                                                                                        </div>
                                                                                    </li>-->
                                    </ul>

                                </div>
                                <div class="pad10A button-pane button-pane-alt text-center">
                                    <a href="#" class="btn btn-primary" title="View all notifications">
                                        View all notifications
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="btn vertical-button hover-gray " href="#" title="" style="padding: 0px;line-height: 0em" >
                            <a class="btn vertical-button hover-gray sb-toggle-right dropdown-toggle"  id="chatbox-btn" title="Chat sidebar" href="#" >
                                <i class="glyph-icon icon-comments-o " style="font-size: 25px;color: grey;"></i>
                            </a>
                        </div>

                        <div class="btn vertical-button hover-gray"  href="#" title="" style="padding: 0px;line-height: 0em" >
                            <a class="btn vertical-button hover-gray dropdown-toggle"  data-toggle="dropdown"  aria-expanded="true" href="#" title="" >
                                <!--<span class="glyph-icon icon-separator-vertical">-->
                                <i class="glyph-icon icon-question-circle " style="font-size: 25px;"></i>
                                <!--</span>-->
                            </a>

                            <ul class="dropdown-menu" role="menu">
                              <!--<li style="text-align: center;"><span style="text-transform: uppercase;"><?= $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname']; ?></span></li>-->
                                <li><a href="<?php l('#') ?>">About Helps </a></li>
                                <li><a href="<?php l('#') ?>">About Docs </a></li>
                                <li><a href="<?php l('#') ?>">About Account </a></li>
                                <li><a href="<?php l('#') ?>">About Privacy </a></li>
                                <li class="divider"></li>
                                <li style="text-align: center;"><a href="#">HELP</a></li>
                            </ul>
                        </div>

                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class=" dropdown-toggle"  aria-expanded="true"><span style="text-transform: uppercase; font-weight: bold"><?= $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname']; ?></span> <b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu">
                                <li style="text-align: center;"><span style="text-transform: uppercase;"><?= $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname']; ?></span></li>
                                <li><a href="<?php l('profile') ?>">Profile</a></li>
                                <li><a href="<?php l('myaccount') ?>">My Account</a></li>
                                <li class="divider"></li>
                                <li style="text-align: center;"><a href="<?php echo _U ?>?logout=1">LogOut</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <?php
            }
            ?>
            <!-- /.navbar-collapse -->
        </div>
    </nav>

</div>

<style>
    .sb-slidebar{
        margin-top: 50px;
        padding:0px 0px 20px 0px;
    }
    .page-wrapper{
        margin-top: 60px;
    }
</style>

<?php
if ($_SESSION['user']['access_level'] == "Admin" || $_SESSION['user']['access_level'] == "admin") {
    $classColor = "bg-black-opacity";
    $hedColor = "white";
    $btnColor = " btn-black";
} else {
    $hedColor = "black";
    $btnColor = "btn-gray-alt";
    $classColor = "bg-white-opacity";
}
?>
<div class="sb-slidebar <?= $classColor ?> sb-left sb-style-overlay " style="margin-top: 50px;padding:0px 0px 20px 0px;">
    <div class="scrollable-content scrollable-slim-sidebar">
        <div class="pad10A">
            <div class="divider-header" style="color: <?= $hedColor; ?>">Notification</div>
            <ul class="chat-box">
                <?php
                if ($_SESSION['user']['access_level'] == "manager" || $_SESSION['user']['access_level'] == "Location_Manager" || $_SESSION['user']['access_level'] == "Admin") {
                    $noty = q("select *,empl.created_at as cdate from tb_employee_log empl,tb_employee emp where emp.id=empl.emp_id and empl.company_id='{$_SESSION['user']['work_at']}' Order by empl.id DESC");

                    foreach ($noty as $notify) :
                        if (empty($notify['photo'])) {
                            $image = 'user.jpg';
                        } else {
                            $image = $notify['photo'];
                        }
                        ?>
                        <li>
                            <div class="status-badge">
                                <!--<img class="img-circle" width="40" src="<?php print _MEDIA_URL ?>assets/image-resources/people/testimonial1.jpg" alt="">-->
                                <img class="img-circle" width="40" src="docs/profile_images/<?php echo $image; ?>" alt="">
                                <div class="small-badge bg-green"></div>
                            </div>
                            <b>

                                <?php
                                if ($notify['emp_id'] == $_SESSION['user']['id']) {
                                    echo 'You';
                                } else {
                                    echo $notify['fname'] . ' ' . $notify['lname'];
                                }
                                ?>
                            </b>
                            <p> <?php
                                if ($notify['task_to'] == $_SESSION['user']['id']) {
                                    echo 'You Have New task from ' . $notify['fname'] . ' ' . $notify['lname'];
                                } else {
                                    echo $notify['log'];
                                }
                                ?></p>
                            <a href="#" class="btn btn-md no-border radius-all-100  <?= $btnColor; ?>"><i class="glyph-icon icon-comments-o"></i></a>
                        </li>
                        <?php
                    endforeach;
                }
                if ($_SESSION['user']['access_level'] == "employee" || $_SESSION['user']['access_level'] == "Employee") {
                    $noty = q("select *,empl.created_at as cdate from tb_employee_log empl,tb_employee emp where emp.id=empl.emp_id  and empl.company_id='{$_SESSION['user']['work_at']}' and Not empl.task_to=0 Order by empl.id DESC");
//                    $noty = q("select * from tb_employee_log empl,tb_employee emp where emp.id=empl.emp_id  and empl.company_id='{$_SESSION['user']['work_at']}' and empl.task_to='{$_SESSION['user']['id']}' or empl.emp_id='{$_SESSION['user']['id']}' Order by empl.id DESC");

                    foreach ($noty as $notify) :
                        if (empty($notify['photo'])) {
                            $image = 'user.jpg';
                        } else {
                            $image = $notify['photo'];
                        }
                        ?>
                        <li>
                            <div class="status-badge">
                                <!--<img class="img-circle" width="40" src="<?php print _MEDIA_URL ?>assets/image-resources/people/testimonial1.jpg" alt="">-->
                                <img class="img-circle" width="40" src="docs/profile_images/<?php echo $image; ?>" alt="">
                                <div class="small-badge bg-green"></div>
                            </div>
                            <b>

                                <?php
                                if ($notify['emp_id'] == $_SESSION['user']['id']) {
                                    echo 'You';
                                    $messages = $notify['log'];
                                } else {
                                    echo $notify['fname'] . ' ' . $notify['lname'];
                                }
                                ?>
                            </b>
                            <p> <?php
                                if ($notify['task_to'] == $_SESSION['user']['id']) {
                                    $messages = 'You Have New task from ' . $notify['fname'] . ' ' . $notify['lname'];
                                } else {
                                    $messages = $notify['log'];
                                }
                                echo $messages;
                                ?></p>
                            <a href="#" class="btn btn-md no-border radius-all-100 btn-black"><i class="glyph-icon icon-comments-o"></i></a>
                        </li>
                        <?php
                    endforeach;
                }
                ?>
            </ul>
            <!--            <div class="divider-header">Idle</div>-->
        </div>
    </div>
</div>
<div class="sb-slidebar <?= $classColor ?> sb-right sb-style-overlay" style="margin-top: 50px;padding:0px 0px 20px 0px;">

    <div class="scrollable-content scrollable-slim-sidebar">
        <div class="pad10A" id="OnlineList">
            <div class="divider-header">ONLINE</div>
            <ul class="chat-box">
                <li>
                    <div class="status-badge">
                        <img class="img-circle" width="40" src="<?php print _MEDIA_URL ?>assets/image-resources/people/testimonial1.jpg" alt="">
                        <div class="small-badge bg-green"></div>
                    </div>
                    <b>
                        Grace Padilla
                    </b>
                    <p>On the other hand, we denounce...</p>
                    <a href="#" class="btn btn-md no-border radius-all-100 btn-gray-alt"><i class="glyph-icon icon-comments-o"></i></a>
                </li>
                <li>
                    <div class="status-badge">
                        <img class="img-circle" width="40" src="<?php print _MEDIA_URL ?>assets/image-resources/people/testimonial2.jpg" alt="">
                        <div class="small-badge bg-green"></div>
                    </div>
                    <b>
                        Carl Gamble
                    </b>
                    <p>Dislike men who are so beguiled...</p>
                    <a href="#" class="btn btn-md no-border radius-all-100 btn-black"><i class="glyph-icon icon-comments-o"></i></a>
                </li>
                <li>
                    <div class="status-badge">
                        <img class="img-circle" width="40" src="<?php print _MEDIA_URL ?>assets/image-resources/people/testimonial3.jpg" alt="">
                        <div class="small-badge bg-green"></div>
                    </div>
                    <b>
                        Michael Poole
                    </b>
                    <p>Of pleasure of the moment, so...</p>
                    <a href="#" class="btn btn-md no-border radius-all-100 btn-black"><i class="glyph-icon icon-comments-o"></i></a>
                </li>
                <li>
                    <div class="status-badge">
                        <img class="img-circle" width="40" src="<?php print _MEDIA_URL ?>assets/image-resources/people/testimonial4.jpg" alt="">
                        <div class="small-badge bg-green"></div>
                    </div>
                    <b>
                        Bill Green
                    </b>
                    <p>That they cannot foresee the...</p>
                    <a href="#" class="btn btn-md no-border radius-all-100 btn-black"><i class="glyph-icon icon-comments-o"></i></a>
                </li>
                <li>
                    <div class="status-badge">
                        <img class="img-circle" width="40" src="<?php print _MEDIA_URL ?>assets/image-resources/people/testimonial5.jpg" alt="">
                        <div class="small-badge bg-green"></div>
                    </div>
                    <b>
                        Cheryl Soucy
                    </b>
                    <p>Pain and trouble that are bound...</p>
                    <a href="#" class="btn btn-md no-border radius-all-100 btn-black"><i class="glyph-icon icon-comments-o"></i></a>
                </li>
            </ul>
            <div class="divider-header">Idle</div>
            <ul class="chat-box">
                <li>
                    <div class="status-badge">
                        <img class="img-circle" width="40" src="<?php print _MEDIA_URL ?>assets/image-resources/people/testimonial6.jpg" alt="">
                        <div class="small-badge bg-orange"></div>
                    </div>
                    <b>
                        Jose Kramer
                    </b>
                    <p>Equal blame belongs to those...</p>
                    <a href="#" class="btn btn-md no-border radius-all-100 btn-black"><i class="glyph-icon icon-comments-o"></i></a>
                </li>
                <li>
                    <div class="status-badge">
                        <img class="img-circle" width="40" src="<?php print _MEDIA_URL ?>assets/image-resources/people/testimonial7.jpg" alt="">
                        <div class="small-badge bg-orange"></div>
                    </div>
                    <b>
                        Dan Garcia
                    </b>
                    <p>Weakness of will, which is same...</p>
                    <a href="#" class="btn btn-md no-border radius-all-100 btn-black"><i class="glyph-icon icon-comments-o"></i></a>
                </li>
                <li>
                    <div class="status-badge">
                        <img class="img-circle" width="40" src="<?php print _MEDIA_URL ?>assets/image-resources/people/testimonial8.jpg" alt="">
                        <div class="small-badge bg-orange"></div>
                    </div>
                    <b>
                        Edward Bridges
                    </b>
                    <p>These cases are perfectly simple...</p>
                    <a href="#" class="btn btn-md no-border radius-all-100 btn-black"><i class="glyph-icon icon-comments-o"></i></a>
                </li>
            </ul>
            <div class="divider-header">Offline</div>
            <ul class="chat-box">
                <li>
                    <div class="status-badge">
                        <img class="img-circle" width="40" src="<?php print _MEDIA_URL ?>assets/image-resources/people/testimonial1.jpg" alt="">
                        <div class="small-badge bg-red"></div>
                    </div>
                    <b>
                        Randy Herod
                    </b>
                    <p>In a free hour, when our power...</p>
                    <a href="#" class="btn btn-md no-border radius-all-100 btn-black"><i class="glyph-icon icon-comments-o"></i></a>
                </li>
                <li>
                    <div class="status-badge">
                        <img class="img-circle" width="40" src="<?php print _MEDIA_URL ?>assets/image-resources/people/testimonial2.jpg" alt="">
                        <div class="small-badge bg-red"></div>
                    </div>
                    <b>
                        Patricia Bagley
                    </b>
                    <p>when nothing prevents our being...</p>
                    <a href="#" class="btn btn-md no-border radius-all-100 btn-black"><i class="glyph-icon icon-comments-o"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    function callModel(id) {
        //        alert("callmodel = " + id + " Name =" + name);
        $("#ChattModel").slideToggle();
        bindChatbox(id);

    }
    function bindChatbox(id) {

        $.ajax({
            url: '<?php echo _U ?>online',
            dataType: "json",
            data: {
                getChatt: 1, id: id

            }, success: function (r) {
                $("#empName").text(r.fname + ' ' + r.lname);
                $("#hidid").val(r.id);
                chatboxmsg(id);
                //                $("#OnlineList").html(r)
            }
        });
    }
    function chatboxmsg(id) {
        $.ajax({
            url: '<?php echo _U ?>online',
            dataType: "json",
            //            type: "post",
            data: {
                chatboxmsg: 1, id: id

            }, success: function (r) {

                $("#chat_box").html(r);
            }
        });
    }
    function sendMessage() {
        //    alert($("#txtmsg").val());

        if ($("#txtmsg").val() === "") {
            $("#txtmsg").focus();
        } else {
            var rid = $("#hidid").val();
            var msg = $("#txtmsg").val();
            sentMessage(rid, msg);
        }
    }
    function sentMessage(rid, msg) {
        $.ajax({
            url: '<?php echo _U ?>online',
            dataType: "json",
            data: {sendMessage: 1, rid: rid, msg: msg},
            success: function (r) {
                $("#txtmsg").val("");
                bindChatbox(rid);
                //                $("#empName").text(r.fname + ' ' + r.lname);
                //                $("#OnlineList").html(r)
            }
        });
    }
</script>
<style>
    .ChattBox{
        height: 350px; 
        width: 350px; 
        background-color: #F0F0F0; 

        right: inherit; 
        z-index: 2147483647; 
        bottom: 38px; 
        position: fixed; 
        /*top: 100px;*/
    }
</style>
<div class="ChattBox" id="ChattModel" hidden  >
    <input type="hidden" id="hidid" name="hidid" value="">
    <?php
//    $query = qs("select * from tb_employee where id=''")
    ?>
    <div class="content-box-header bg-black-opacity-alt"><div class=" text-left" style="float: left;">
            <i class="glyph-icon icon-comments"></i>
            <span id="empName"></span>

        </div>
        <button type="button" class="close"  onclick=" $('#ChattModel').slideToggle();"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="content-box-wrapper" style="">
        <div class="scrollable-content scrollable-nice scrollable-medium" id="chat_box">

            <!--            <ul class="chat-box">
                            <li>
                                <div class="chat-author">
                                    <img width="36" src="assets-minified/dummy-images/gravatar.jpg" alt="">
                                </div>
                                <div class="popover left no-shadow">
                                    <div class="arrow"></div>
                                    <div class="popover-content">
                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
                                        <div class="chat-time">
                                            <i class="glyph-icon icon-clock-o"></i>
            <?php echo timeago($notify['created_at']); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="float-left">
                                <div class="chat-author">
                                    <img width="36" src="assets-minified/dummy-images/gravatar.jpg" alt="">
                                </div>
                                <div class="popover right no-shadow">
                                    <div class="arrow"></div>
                                    <div class="popover-content">
                                        <h3>
                                            <a href="#" title="Horia Simon">Horia Simon</a>
                                            <div class="float-right">
                                                <a href="#" class="btn glyph-icon icon-inbox font-gray tooltip-button" data-placement="bottom" title="This chat line was received in the mail."></a>
                                            </div>
                                        </h3>
                                        This comment line has a title (author name) and a right button panel.
                                        <div class="chat-time">
                                            <i class="glyph-icon icon-clock-o"></i>
            <?php echo timeago($notify['created_at']); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="chat-author">
                                    <img width="36" src="assets-minified/dummy-images/gravatar.jpg" alt="">
                                </div>
                                <div class="popover left no-shadow">
                                    <div class="arrow"></div>
                                    <div class="popover-content">
                                        This comment line has a bottom button panel, box shadow and title.
                                        <div class="chat-time">
                                            <i class="glyph-icon icon-clock-o"></i>
            <?php echo timeago($notify['created_at']); ?>
                                        </div>
                                        <div class="divider"></div>
                                        <a href="#" class="btn btn-sm btn-default font-bold text-transform-upr" title=""><span class="button-content">Reply</span></a>
                                        <a href="#" class="btn btn-sm btn-danger float-right tooltip-button" data-placement="left" title="Remove comment"><i class="glyph-icon icon-remove"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="chat-author">
                                    <img width="36" src="assets-minified/dummy-images/gravatar.jpg" alt="">
                                </div>
                                <div class="popover left no-shadow">
                                    <div class="arrow"></div>
                                    <div class="popover-content">
                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
                                        <div class="chat-time">
                                            <i class="glyph-icon icon-clock-o"></i>
            <?php echo timeago($notify['created_at']); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="float-left">
                                <div class="chat-author">
                                    <img width="36" src="assets-minified/dummy-images/gravatar.jpg" alt="">
                                </div>
                                <div class="popover right no-shadow">
                                    <div class="arrow"></div>
                                    <div class="popover-content">
                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
                                        <div class="chat-time">
                                            <i class="glyph-icon icon-clock-o"></i>
            <?php echo timeago($notify['created_at']); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
            
                        </ul>-->

        </div>
    </div>

    <div class="input-group">
        <input type="text" placeholder="Say something here..." class="form-control" name="txtmsg" id="txtmsg" >
        <div class="input-group-btn">
            <button type="button" class="btn btn-default" tabindex="-1" onclick="sendMessage()"><i class="glyph-icon icon-mail-reply"></i></button>
            <!--            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>-->
            <!--            <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>-->
        </div>
    </div>

</div>

<script type="text/javascript">

    function normalUserNotificationShow(userId) {
        $("#normal_user_notifications").toggle();
        /// $("#notification_counter").hide();
        /*  $.ajax({
         url: '<?php echo _U ?>notifications',
         dataType: "json",
         data: {
         setShowNotification: 1,
         userId: userId
         }, success: function (r) {
         $("#notification_counter").hide();
         }
         });*/
        var ids = new Array();
        var idsDiv = $(".noti-box0").children('div');
        idsDiv.each(function (index) {
            ids.push($(this).attr('data-id'));
        });
        _notificationGet(ids);
    }
    function _notificationGet(ids) {
        $.ajax({
            url: '<?php echo _U ?>notifications',
            data: {
                getNotification: 1, id: ids
            }, success: function (r) {
                if (r == 0) {
                    $("#notification_counter").remove();
                } else {
                    $("#notification_counter").html(r);
                }
            }
        });
    }
    function nextNoti(obj) {
        $(".noti-box").addClass('hidden');
        if (obj === 'next') {
            //change status code
            var ids = new Array();
            var idsDiv = $(".noti-box" + $(".nextDiv").html()).children('div');
            idsDiv.each(function (index) {
                ids.push($(this).attr('data-id'));
            });
            _notificationGet(ids);
            //end 
            $(".preDivDisp").removeClass('hidden');
            $(".noti-box" + $(".nextDiv").html()).removeClass('hidden');
            if ((parseInt($(".totalDiv").html()) >= (parseInt($(".nextDiv").html()) + 1)))
            {

                $(".preDiv").html($(".nextDiv").html());
                $(".nextDiv").html(parseInt($(".nextDiv").html()) + 1);
            } else {
                $(".nextDivDisp").addClass('hidden');
            }
        } else {
            $(".noti-box" + $(".preDiv").html()).removeClass('hidden');
            $(".nextDivDisp").removeClass('hidden');
            if (parseInt($(".preDiv").html()) - 1 >= 0) {

                $(".nextDiv").html($(".preDiv").html());
                $(".preDiv").html(parseInt($(".preDiv").html()) - 1);
            } else {
                $(".preDivDisp").addClass('hidden');
            }
        }

    }
</script>
