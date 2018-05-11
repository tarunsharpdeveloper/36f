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
                                                </li><?php endforeach;
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