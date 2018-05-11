<div class="card-panel" style="">

    <div class="row">

    </div>

    <div class="container-fluid sortable " style="width: 100%; overflow-style: scrollbar">
        <?php
        //$quote_data = q("SELECT * FROM quote WHERE tenant_id='{$_SESSION['user']['id']}' AND quote_status = 'PENDING_APPROVE'");
        ?>
        <?php $obj = new calculatePrice1(); ?>
        <!-- Orders Card -->

        <div class="col s12 m6 arrange" style="width: 22%; margin:1%;">

            <div class="card">

     <!--<thead>-->
                <div class="title red lighten-2 ">
                    <h5 style="color: white"><?php print _t('1', 'Station 1'); ?></h5>

                    <a class="minimize" href="#">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>

                </div>
                <!--</thead>-->
                <div class="content mail-card" style="height:auto;overflow-x:auto;">
                    <?php $i = 1; ?>
                    <?php
                    if (1 == 1) :

                        foreach ($stage1 as $row) {
                            ?>
                            <div class="row">
                                <div class="col s10 ltr">
<!--<i class="mdi-action-credit-card left  prefix"></i><i class="mdi-communication-call left  prefix"></i>-->
                                    <a href="#">
                                        <td > <b> <span style="text-transform: uppercase;"><?php echo $row['fname'] . " " . $row['lname']; ?></span></b>
                                            <br>
                                        </td>
                                        <td><span style="font-size: 12px; color:#888;"><?php echo $row['melli_no']; ?></span></td> 
                                        <br/>
                                        <td> <span style="font-size: 12px; color:#888;"><?php echo $row['phone']; ?></span></td> 
                                    </a>
                                    <br/>
                                </div>
                                <div style="clear: both"></div>
                                <!--<div class="row">-->
                                <div class="col s12 " style="padding-top: 1rem;" >
                                    <a class=" left-align orange-text accent-3 cursor modal-trigger ltr" href="#modal3" id="view<?php echo $value['id'] ?>"  name="<?php echo $row['id']; ?>" onclick="bindData(<?php echo $row['id'] . ',' . $row['stage']; ?>)">
                                        <span style="text-transform: lowercase;font-size: 12px;color:#666;"><i class="mdi-action-visibility  prefix"></i>&nbsp;<?php print _t('290', 'View') ?></span>
                                    </a>
                                    <!--                                    &nbsp;&nbsp;|&nbsp;&nbsp;-->
                                    <!--                                    <a href="#modal2" id="view<?php echo $row['id']; ?>" name="<?php echo $row['id']; ?>" onclick="bindStage(<?php echo $row['id'] . ',' . $row['stage']; ?>)" class="ltr left-align orange-text accent-3 cursor modal-trigger" >
                                                                                    <i class="ion-arrow-swap prefix  " ></i>
                                                                            <span style="text-transform: lowercase;font-size: 12px;color:#666;"><i class="ion-arrow-swap prefix"></i>&nbsp;<?php print _t('38', 'Move') ?></span>
                                                                            <span style="font-size: 30px; line-height: 20px;">Edit</span>
                                                                        </a>-->
                                </div>
                                <div style="clear: both"></div>
                                <!--</div>-->
                            </div>
                            <hr>
                            <?php
                        }
                        ?>

                    <?php else: ?>
                        <div class="row">
                            <div class="col s9">No records found.</div>
                            <a class="col s3 right-align orange-text accent-3 cursor modal-trigger" >&nbsp;</a>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <!-- /Orders Card -->

        <div class="col s12 m6 arrange" style="width: 22%; margin:1%;">
            <div class="card">
                <div class="title  indigo lighten-2">
                    <h5 style="color: white"><?php print _t('2', 'Station 2'); ?> </h5>

                    <a class="minimize" href="#">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content mail-card" style="height:auto;overflow:auto;">
                    <?php $i = 1; ?>
                    <?php
                    if (1 == 1) :

                        foreach ($stage2 as $row) {
                            ?>
                            <div class="row">
                                <div class="col s10 ltr">

                                    <a href="#">
                                        <td > <b> <span style="text-transform: uppercase;"><?php echo $row['fname'] . " " . $row['lname']; ?></span></b>
                                            <br>
                                        </td>
                                        <td><span style="font-size: 12px; color:#888;"><?php echo $row['melli_no']; ?></span></td> 
                                        <br/>
                                        <td> <span style="font-size: 12px; color:#888;"><?php echo $row['phone']; ?></span></td> 
                                    </a>
                                    <br/>
                                </div>
                                <div style="clear: both"></div>
                                <!--<div class="row">-->
                                <div class="col s12  " style="padding-top: 1rem;" >
                                    <a class=" left-align orange-text accent-3 cursor modal-trigger ltr" href="#modal3" id="view<?php echo $value['id'] ?>"  name="<?php echo $row['id']; ?>" onclick="bindData(<?php echo $row['id'] . ',' . $row['stage']; ?>)">
                                        <span style="text-transform: lowercase;font-size: 12px;color:#666;"><i class="mdi-action-visibility  prefix"></i>&nbsp;<?php print _t('290', 'View') ?></span>
                                    </a>
                                    <!--                                    &nbsp;&nbsp;|&nbsp;&nbsp;
                                                                        <a href="#modal2" id="view<?php echo $row['id']; ?>" name="<?php echo $row['id']; ?>" onclick="bindStage(<?php echo $row['id'] . ',' . $row['stage']; ?>)" class="ltr left-align orange-text accent-3 cursor modal-trigger" >
                                                                                    <i class="ion-arrow-swap prefix  " ></i>
                                                                            <span style="text-transform: lowercase;font-size: 12px;color:#666;"><i class="ion-arrow-swap prefix"></i>&nbsp;<?php print _t('38', 'Move') ?></span>
                                                                            <span style="font-size: 30px; line-height: 20px;">Edit</span>
                                                                        </a>-->
                                </div>
                                <div style="clear: both"></div>
                                <!--</div>-->

                            </div>
                            <hr>
                            <?php
                        }
                        ?>
                    <?php else: ?>
                        <div class="row">
                            <div class="col s9">No records found.</div>
                            <a class="col s3 right-align orange-text accent-3 cursor modal-trigger" >&nbsp;</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- ToDo Card -->

        <!--        <div class="col s12 m6 arrange" style="width: 18%; margin:1%;">
                    <div class="card">
                        <div class="title light-blue darken-2">
                            <h5 style="color: white"><?php print _t('3', 'Station 3'); ?></h5>
        
                            <a class="minimize" href="#">
                                <i class="mdi-navigation-expand-less"></i>
                            </a>
                        </div>
                        <div class="content mail-card" style="height:auto;overflow:auto;">
        <?php $i = 1; ?>
        <?php
        if (1 == 1) :

            foreach ($stage3 as $row) {
                ?>
                                                                                                                                                                                                                                    <div class="row">
                                                                                                                                                                                                                                        <div class="col s10 ltr" >
                                                                                                                                                                                                        
                                                                                                                                                                                                                                            <a href="#">
                                                                                                                                                                                                                                                <td > <b> <span style="text-transform: uppercase;"><?php echo $row['fname'] . " " . $row['lname']; ?></span></b>
                                                                                                                                                                                                                                                    <br>
                                                                                                                                                                                                                                                </td>
                                                                                                                                                                                                                                                <td><span style="font-size: 12px; color:#888;"><i class="mdi-action-credit-card left  prefix"></i><?php echo $row['melli_no']; ?></span></td> 
                                                                                                                                                                                                                                                <br/>
                                                                                                                                                                                                                                                <td> <span style="font-size: 12px; color:#888;"><i class="mdi-communication-call left  prefix"></i><?php echo $row['phone']; ?></span></td> 
                                                                                                                                                                                                                                            </a>
                                                                                                                                                                                                                                            <br/>
                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                        <div style="clear: both"></div>
                                                                                                                                                                                                                                        <div class="row">
                                                                                                                                                                                                                                        <div class="col s12  " style="padding-top: 1rem;" >
                                                                                                                                                                                                                                            <a class=" left-align orange-text accent-3 cursor modal-trigger ltr" href="#modal3" id="view<?php echo $value['id'] ?>"  name="<?php echo $row['id']; ?>" onclick="bindData(<?php echo $row['id'] . ',' . $row['stage']; ?>)">
                                                                                                                                                                                                                                                <span style="text-transform: lowercase;font-size: 12px;color:#666;"><i class="mdi-action-visibility  prefix"></i>&nbsp;<?php print _t('290', 'View') ?></span>
                                                                                                                                                                                                                                            </a>
                                                                                                                                                                                                                                            &nbsp;&nbsp;|&nbsp;&nbsp;
                                                                                                                                                                                                                                            <a href="#modal2" id="view<?php echo $row['id']; ?>" name="<?php echo $row['id']; ?>" onclick="bindStage(<?php echo $row['id'] . ',' . $row['stage']; ?>)" class="ltr left-align orange-text accent-3 cursor modal-trigger" >
                                                                                                                                                                                                                                                        <i class="ion-arrow-swap prefix  " ></i>
                                                                                                                                                                                                                                                <span style="text-transform: lowercase;font-size: 12px;color:#666;"><i class="ion-arrow-swap prefix"></i>&nbsp;<?php print _t('38', 'Move') ?></span>
                                                                                                                                                                                                                                                <span style="font-size: 30px; line-height: 20px;">Edit</span>
                                                                                                                                                                                                                                            </a>
                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                        <div style="clear: both"></div>
                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                    <hr>
                <?php
            }
            ?>
                                                                                                        
        <?php else: ?>
                                                                                                                                <div class="row">
                                                                                                                                    <div class="col s9">No records found.</div>
                                                                                                                                    <a class="col s3 right-align orange-text accent-3 cursor modal-trigger" >&nbsp;</a>
                                                                                                                                </div>
        <?php endif; ?>
                        </div>
                    </div>
                </div>-->
        <!-- /ToDo Card -->

        <!-- Mail Card -->
        <div class="col s12 m6 arrange" style="width: 22%; margin:1%;">
            <div class="card">
                <div class="title lime darken-2">
                    <h5 style="color: white"><?php print _t('3', 'Station 3'); ?><?php // print _t('4', 'Station 4');                         ?> </h5>

                    <a class="minimize" href="#">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content mail-card" style="height:auto;overflow:auto;">
                    <?php $i = 1; ?>
                    <?php
                    if (1 == 1) :

                        foreach ($stage4 as $row) {
                            ?>
                            <div class="row">
                                <div class="col s10 ltr">

                                    <a href="#">
                                        <td > <b> <span style="text-transform: uppercase;"><?php echo $row['fname'] . " " . $row['lname']; ?></span></b>
                                            <br>
                                        </td>
                                        <td><span style="font-size: 12px; color:#888;"><?php echo $row['melli_no']; ?></span></td> 
                                        <br/>
                                        <td> <span style="font-size: 12px; color:#888;"><?php echo $row['phone']; ?></span></td> 
                                    </a>
                                    <br/>
                                </div>
                                <div style="clear: both"></div>
                                <!--<div class="row">-->
                                <div class="col s12  " style="padding-top: 1rem;" >
                                    <a class=" left-align orange-text accent-3 cursor modal-trigger ltr" href="#modal3" id="view<?php echo $value['id'] ?>"  name="<?php echo $row['id']; ?>" onclick="bindData(<?php echo $row['id'] . ',' . $row['stage']; ?>)">
                                        <span style="text-transform: lowercase;font-size: 12px;color:#666;"><i class="mdi-action-visibility  prefix"></i>&nbsp;<?php print _t('290', 'View') ?></span>
                                    </a>
                                    <br/>
                                    <a class=" left-align orange-text accent-3 cursor modal-trigger ltr" href="#modal2" id="view<?php echo $row['id']; ?>" name="<?php echo $row['id']; ?>" onclick="bindStage(<?php echo $row['id'] . ',' . $row['stage']; ?>)" class="ltr left-align orange-text accent-3 cursor modal-trigger" >
            <!--                                    <i class="ion-arrow-swap prefix  " ></i>-->
                                        <span style="text-transform: lowercase;font-size: 12px;color:#666;"><i class="ion-arrow-swap prefix"></i> <?php print _t('38', 'Move') ?></span>
                                        <!--<span style="font-size: 30px; line-height: 20px;">Edit</span>-->
                                    </a>
                                </div>
                                <div style="clear: both"></div>
                                <!--</div>-->
                            </div>
                            <hr>
                            <?php
                        }
                        ?>

                    <?php else: ?>
                        <div class="row">
                            <div class="col s9">No records found.</div>
                            <a class="col s3 right-align orange-text accent-3 cursor modal-trigger" >&nbsp;</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- /Mail Card -->
        <div class="col s12 m6  arrange" style="width: 22%; margin:1%;">
            <div class="card">
                <div class="title green darken-2">
                    <h5 style="color: white"><?php print _t('4', 'Station 4'); ?><?php // print _t('5', 'Station 5');                         ?> </h5>

                    <a class="minimize" href="#">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content mail-card" style="height:auto;overflow:auto;">
                    <?php $i = 1; ?>
                    <?php
                    if (1 == 1) :

                        foreach ($stage5 as $row) {
                            ?>
                            <div class="row">
                                <div class="col s10 ltr">

                                    <a href="#">
                                        <td > <b> <span style="text-transform: uppercase;"><?php echo $row['fname'] . " " . $row['lname']; ?></span></b>
                                            <br>
                                        </td>
                                        <td><span style="font-size: 12px; color:#888;"><?php echo $row['melli_no']; ?></span></td> 
                                        <br/>
                                        <td> <span style="font-size: 12px; color:#888;"><?php echo $row['phone']; ?></span></td> 
                                    </a>
                                    <br/>
                                </div>
                                <div style="clear: both"></div>
                                <!--<div class="row">-->
                                <div class="col s12 " style="padding-top: 1rem;" >
                                    <a class=" left-align orange-text accent-3 cursor modal-trigger ltr" href="#modal3" id="view<?php echo $value['id'] ?>"  name="<?php echo $row['id']; ?>" onclick="bindData(<?php echo $row['id'] . ',' . $row['stage']; ?>)">
                                        <span style="text-transform: lowercase;font-size: 12px;color:#666;"><i class="mdi-action-visibility  prefix "></i>&nbsp;<?php print _t('290', 'View') ?></span>
                                    </a>
                                    <br/>
                                    <a class=" left-align orange-text accent-3 cursor modal-trigger ltr" href="#modal2" id="view<?php echo $row['id']; ?>" name="<?php echo $row['id']; ?>" onclick="bindStage(<?php echo $row['id'] . ',' . $row['stage']; ?>)"  >
            <!--                                    <i class="ion-arrow-swap prefix  " ></i>-->
                                        <span style="text-transform: lowercase;font-size: 12px;color:#666;"><i class="ion-arrow-swap prefix  "></i> <?php print _t('38', 'Move') ?></span>
                                        <!--<span style="font-size: 30px; line-height: 20px;">Edit</span>-->
                                    </a>
                                </div>
                                <div style="clear: both"></div>
                                <!--</div>-->
                            </div>
                            <hr>
                            <?php
                        }
                        ?>

                    <?php else: ?>
                        <div class="row">
                            <div class="col s9">No records found.</div>
                            <a class="col s3 right-align orange-text accent-3 cursor modal-trigger" >&nbsp;</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<div id="modal2"  class="modal modal-fixed-footer modal-fixed-header-footer">
    <form action="manager" method="post" id="manager_change">
        <div class="modal-header">
            <div class="header-text">
                <div class="title">
                    <h3> 
                        <span style="font-weight:bold"><?php print _t('181', 'Station Change') ?></span></h3>
                </div>
            </div>
            <div class="header-close modal-action modal-close">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="modal-content ">


            <!--<div class="card-panel">-->
            <!-- <a class="modal-action modal-close  waves-effect waves-green red-text btn-flat tooltipped" data-position="top" data-delay="50" data-tooltip="Click To Exit" href="#">
                 <i class="mdi-content-clear"></i>
             </a> -->
            <div id="filecontent" src="" style="height:auto;" frameborder="0" >

                <div class="wrapper"> 
                    <div class="card-panel" id="card_q1">
                        <div class="collapsible-header">
                            <div class="row">
                                <span style="font-weight:normal;font-size: 16px;" id="Q1"> &nbsp;<b><?php print _t('180', 'Select the station you want to move the driver') ?></b> </span></div>

                            <!--                                        <br/>-->
                                                                    <!--<input data-tooltip='Vehicle Chassis Number' id="vin_no1" name="vin_no1"   type="text" class=" tooltipped"  value="<?php echo $chassis['chassis_no']; ?>" readonly>--> 
                            <!--<label for="vin_no">Vehicle Chassis Number</label>--> 
                        </div>
                        <div class="input-field col l12 m6 s12">
<!--                            <input name="station[]" type="radio" class="with-gap" id="station1" value="1" required />
                            <label for="station1" ><?php print _t('1', 'Station 1') ?></label>-->
<!--                            <input name="station[]" class="with-gap" type="radio" id="station2" value="2"    />
                            <label for="station2"><?php print _t('2', 'Station 2') ?></label>-->
                            <span id="st3"> 
                                <input name="station[]" class="with-gap" type="radio" id="station3" value="3"    />
                                <label for="station3"><?php print _t('2', 'Station 2') ?></label>
                            </span>
                            <span id="st4"> 
                                <input name="station[]" class="with-gap" type="radio" id="station4" value="4"    />
                                <label for="station4"><?php print _t('3', 'Station 3') ?></label>
                            </span>
                            <span id="st5">
                                <input name="station[]" class="with-gap" type="radio" id="station5" value="5"    />
                                <label for="station5"><?php print _t('4', 'Station 4') ?></label>
                            </span>
                            <!--<label id="ans1yes" ></label>-->
                        </div>
                    </div>
                    <input type="hidden" name="did" id="did" value="">
                    <input type="hidden" name="vid" id="vid" value="">
                    <!--card_1-->
                </div>
                <div style="clear: both"></div>


            </div>

            <!--</div>-->

        </div> 
        <div class="modal-footer">
            <button data-tooltip='Click to Close' name="close"  class="right modal-close  waves-effect waves-light btn btn-default z-depth-0 z-depth-1-hover tooltipped" type="button" style="margin-left: 2px;"><?php print _t('179', 'Close') ?></button>
            <button data-tooltip='Click to Move' name="move"  class="right waves-effect waves-light btn btn-default z-depth-0 z-depth-1-hover tooltipped" type="submit" style="margin-left: 2px;" ><?php print _t('38', 'Move') ?></button>

            <div style="clear: both"></div>
        </div>
    </form>
</div>


<div id="modal3"  class="modal modal-fixed-footer modal-fixed-header-footer">
    <form action="manager" method="post"  id="manager_edit"> 
        <div class="modal-header">
            <div class="header-text">
                <div class="btn-group">
                    <a class="btn btn-default btn-rounded"  id="driver" onclick="divDisplay('driver')" style="background: gray;"><?php print _t('206', 'Driver Details') ?> </a>
                    <a class="btn btn-default btn-rounded " id="vehicle" onclick=" divDisplay('vehicle')" style="background: #F08080;" ><?php print _t('44', 'Car Details') ?></a>
                    <!--<a class="btn btn-default btn-rounded" id="login" onclick=" divDisplay('login')" style="background: #F08080;" ><?php print _t('207', 'Login Details') ?> </a>-->
                </div>
            </div>
            <div class="header-close modal-action modal-close">
                <i class="fa fa-times"></i>
            </div>
        </div>

        <div class="modal-content flow-text ">
            <div id="filecontent" src="" style="height:auto;" frameborder="0" scrolling="yes">
                <div id="rejected_wait">
                    <img src="<?php print _MEDIA_URL ?>img/Whozoor-wait.gif" />
                </div>

                <div id="rejected_data" style="display:none">
                    <div class="alert orange lighten-4 orange-text text-darken-2 card" id="warning_msg"  name="warning_msg" style="display: none;" >
                        <div class="title">  <h5><?php print _t('333', 'Warning') ?>!</h5></div>
                        <div class="content">
                            <span id="duplicate_msg" style="font-size: 14px;"></span>

                        </div>
                        <!--<br/>-->

                    </div>
                    <!--<div class="card-panel">-->
                    <!--<div id="filecontent" src="" style="height:auto;" frameborder="0" scrolling="yes">-->

                    <div class="wrapper"> 
                        <div class="card" id="card_basic" >
                            <div class="title">
                                <!--<div class="row">-->
                                    <!--<i class="fa fa-cab prefix small"></i>&nbsp;-->
                                <span style="font-weight:bold;font-size:16px; ">
                                    <?php print _t('206', 'Driver Details') ?> 
                                </span>
                                <!--<span class="right" style="color: orangered; font-weight:bold;font-size:16px;margin-right: 10%; ">STATION-1</span><br/>-->
                                <label id="agent_time" class="right" style="color:#999; font-weight: bold;padding-bottom: 0%;line-height: 3; padding-right: 2%;"></label>&nbsp;&nbsp;
                                <label id="agent_nm" class="right" style="color:#777; font-weight: bold;padding-bottom: 0%;line-height: 3; "></label>&nbsp;&nbsp;
                                <!--<label id="agent_op" class="right" style="color:#999; font-weight: bold;padding-bottom: 0%;line-height: 3; "></label>--> 

                                <!--</div>-->
                            </div> 

                            <div class="content">  
                                <div class="alert orange lighten-4 orange-text text-darken-2 card" id="warning_msg_manager"  name="warning_msg_manager" style="display: none;" >
                                    <div class="title">  <h5><?php print _t('333', 'Warning') ?>!</h5></div>
                                    <div class="content">
                                        <span id="duplicate_msg_manager" style="font-size: 14px;"></span>

                                    </div>
                                    <!--<br/>-->

                                </div>
   <!--                                <div class="input-field col l12 m12 s12" style="padding: 1rem;"><i class="mdi-action-perm-identity prefix"> </i>
                                       <input data-tooltip='Name of the Agent'  id="agent" name="agent" type="text" class=" tooltipped" value="" readonly> 
                                       <label for="agent">Last Modified Agent</label> 
                                   </div>-->
                                <div class="row" style="padding: 0rem;">
                                    <div class="input-field col l4 m4 s12">
                                        <span for="fName" class="help-span"><?php print _t('9', 'First Name') ?></span>
                                        <input data-tooltip='First name of the Driver'  id="fName" name="fName" type="text" class="" value="<?php echo $fnm; ?>" required  pattern="^[\u0020\u0600-\u06FF\s]+$"> 
                                        <span class="help-text" ><?php print _t('335', 'For Example "امیررضا" ') ?></span>
                                    </div>
                                    <div class="input-field col l4 m4 s12">
                                        <span for="lName" class="help-span"><?php print _t('10', 'Last Name') ?></span>
                                        <input data-tooltip='Last name of the Driver'  id="lName" name="lName" type="text" class="validate tooltipped" value="<?php echo $lnm; ?>" pattern="^[\u0020\u0600-\u06FF\s]+$" > 
                                        <span class="help-text" ><?php print _t('335', 'For Example "امیررضا" ') ?></span>
                                    </div>
                                    <div class="input-field col l4 m4 s12">
                                        <span for="fatherName" class="help-span"><?php print _t('99', 'Father Name') ?></span>
                                        <input data-tooltip='Father name'  id="fatherName" name="fatherName" type="text" class="tooltipped not_margin" value="<?= $fathnm; ?>"> 
                                        <span class="help-text" ><?php print _t('335', 'For Example "امیررضا" ') ?></span>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="input-field col l4 m4 s12">
                                        <span for="email" class="help-span"><?php print _t('14', 'E-Mail') ?></span>
                                        <input data-tooltip='Customer Email' id="email" name="email"  type="text" class="tooltipped not_margin ltr"  value="<?= $em; ?>" > <!-- *{1,64}[.*{1,64}][.*{1,64}][.*{1,64}]@*{1,64}[.*{2,64}][.*{2,6}][.*{1,2}]; -->
                                        <span class="help-text" ><?php print _t('343', 'For example,') ?> "example@mail.com" </span>
                                    </div>
                                    <div class="input-field col l4 m4 s12" style="float: left;">  
                                        <span for="gender" class="help-span"><?php print _t('101', 'Gender') ?></span> 
                                        <div class="radio_list_single">
                                            <input name="gender" type="radio" class="with-gap my-radio-question right" data-que_id="1" data-que_type="CRITICAL" data-fail_point="0" id="male" value="0" />
                                            <label for="male"><?php print _t('102', 'MALE') ?></label>
                                            <input name="gender" class="with-gap my-radio-question" data-que_id="1" data-que_type="CRITICAL" data-fail_point="10"  type="radio" id="female" value="1"   />
                                            <label for="female"><?php print _t('103', 'FEMALE') ?></label>
                                            <div id="errorbox_gender"></div>
                                        </div>                           

                                    </div>
                                    <div class="input-field col l4 m4 s12" style="float: left;">
                                        <span for="marital" class="help-span"><?php print _t('104', 'Marital Status') ?></span> 
                                        <div class="radio_list_single">
                                            <input name="marital_status" type="radio" class="with-gap my-radio-question right" data-que_id="1" data-que_type="CRITICAL" data-fail_point="0" id="single" value="0" />
                                            <label for="single"><?php print _t('105', 'Single') ?></label>
                                            <input name="marital_status" class="with-gap my-radio-question" data-que_id="1" data-que_type="CRITICAL" data-fail_point="10"  type="radio" id="married" value="1"   />
                                            <label for="married"><?php print _t('106', 'Married') ?></label>
                                            <div id="errorbox_marital_status"></div>
                                        </div>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div style="border-bottom: 2px solid gray; margin-bottom: 20px; padding-bottom: 6px;"><span style="color: brown;"><b><?php print _t('205', 'Basic Details') ?></b></span></div>                        
                                    <div style="clear: both;"></div>
                                    <div class="input-field col l6 m6 s12" >
                                        <span for="bod_no" class="help-span col s12"><?php print _t('108', 'Birth-Certificate-Number') ?></span>
                                        <input data-tooltip='Birth Certificate Number ' id="bod_no"   name="bod_no" type="text" minlength="1" maxlength="10" class="tooltipped ltr not_margin" value="<?= $bodno; ?>">
                                        <span class="help-text" ><?php print _t('343', 'For example,') ?> "1234" </span>
                                    </div>
                                    <div class="input-field col l6 m6 s12" style="margin:0px;padding: 0px;">                            
                                        <span for="dob" class="help-span "><?php print _t('107', 'Date Of Birth') ?></span>
                                        <input type="hidden" id="hiddenDOB" name="hiddenDOB">
                                        <div class="col l12 m12 s12">

                                            <div class="input-field col l4 m4 s4" style="padding-bottom: 0px;  margin: 0px;">
                                                <select id="dob_date" name="dob_date"  class="browser-default left" style="font-size: 16px;" onchange="checkDOBFarsiDate()" >
                                                    <option disabled selected=""><?php print _t('283', 'Day') ?></option>
                                                    <?php for ($i = 1; $i <= '31'; $i++) { ?>
                                                        <option id="" value="<?= $i; ?>"><?= $i; ?></option> 
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="input-field col l4 m4 s4" style="padding-bottom: 0px;  margin: 0px;">
                                                <select id="dob_month" name="dob_month"  class="browser-default left " style="font-size: 16px;" onchange="checkDOBFarsiDate()" >
                                                    <option disabled selected><?php print _t('282', 'Month') ?></option>
                                                    <?php for ($i = 1; $i <= '12'; $i++) { ?>
                                                        <option id="" value="<?= $i; ?>"><?= $i; ?></option> 
                                                    <?php } ?>
                                                </select >
                                            </div>
                                            <div class="input-field col l4 m4 s4" style="padding-bottom: 0px; margin: 0px;">
                                                <select   id="dob_year" name="dob_year"  class="browser-default left " style="font-size: 16px;" onchange="checkDOBFarsiDate()" >
                                                    <option disabled selected ><?php print _t('281', 'Year') ?></option>
                                                    <?php
                                                    $DYear = $p_Year - 15;
                                                    for ($i = $DYear; $i >= 1320; $i--) {
                                                        ?>
                                                        <option id="" value="<?= $i; ?>"><?= $i; ?></option> 
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div style="clear: both;"></div>

                                        </div>
                                        <!--<div style="clear: both;"></div>-->
                                        <span class="help-text" style="padding-top: 0rem;" ><?php print _t('343', 'For example,') ?> "1340/01/25" </span>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="input-field col l6 m6 s12" >
                                        <span for="melli_no" class="help-span"><?php print _t('11', 'Melli-Number') ?></span>
                                        <input data-tooltip='Melli Nummber ' id="melli_no"   name="melli_no" type="text"  class="not_margin tooltipped ltr " value="<?php echo $mel; ?>" maxlength="10" onkeyup="IsPlateNo(this)" >
                                        <span class="help-text" ><?php print _t('343', 'For example,') ?>"9876543210" </span>


                                    </div>
                                    <div class="input-field col l6 m6 s12" style="margin:0px;padding: 0px;">                            
                                        <span for="dt_melli_expr" class="help-span"><?php print _t('100', 'Melli-Expiration-Date') ?></span>  

                                        <?php
                                        $melli_exp_arr = explode("-", $data['melli_expiry_date']);
                                        $melli_year = $melli_exp_arr[0];
                                        $melli_month = $melli_exp_arr[1];
                                        $melli_day = $melli_exp_arr[2];
                                        ?>
                                        <div class="col l12 m12 s12" style="padding-bottom: 0px;">

                                            <div class="input-field col l4 m4 s4" style="padding-bottom: 0px;margin-top: 0px;">
                                                <select id="melli_expr_date" name="melli_expr_date"  class="  browser-default left" style="font-size: 16px;">  <!-- onchange="checkMELLIFarsiDate()" -->
                                                    <option disabled selected=""><?php print _t('283', 'Day') ?></option>
                                                    <?php for ($i = 1; $i <= '31'; $i++) { ?>
                                                        <option id="" value="<?= $i; ?>" <?= _cprint($mellidate, $i, 'selected'); ?>><?= $i; ?></option> 
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="input-field col l4 m4 s4" style="padding-bottom: 0px;margin-top: 0px;">
                                                <select id="melli_expr_month" name="melli_expr_month"  class="browser-default left " style="font-size: 16px;">  <!-- onchange="checkMELLIFarsiDate()" -->
                                                    <option disabled selected><?php print _t('282', 'Month') ?></option>
                                                    <?php for ($i = 1; $i <= '12'; $i++) { ?>
                                                        <option id="" value="<?= $i; ?>" <?= _cprint($mellimonth, $i, 'selected'); ?>><?= $i; ?></option> 
                                                    <?php } ?>
                                                </select >
                                            </div>    
                                            <div class="input-field col l4 m4 s4" style="padding-bottom: 0px;margin-top: 0px;">
                                                <select   id="melli_expr_year" name="melli_expr_year"  class="  browser-default left " style="font-size: 16px;" >  <!-- onchange="checkMELLIFarsiDate()" -->
                                                    <option disabled selected ><?php print _t('281', 'Year') ?></option>
                                                    <?php for ($i = 1394; $i < 1445; $i++) { ?>
                                                        <option id="" value="<?= $i; ?>" <?= _cprint($melliyear, $i, 'selected'); ?>><?= $i; ?></option> 
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div style="clear: both;"></div>
                                        </div>
                                        <span class="help-text" style="padding-top: 1rem;" ><?php print _t('341', 'For example, "25/01/1400"') ?> </span>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div style="border-bottom: 2px solid gray; margin-bottom: 20px; padding-bottom: 6px;"><span style="color: brown;"><b><?php print _t('376', 'Contact Details') ?></b></span></div>                        
                                    <div style="clear: both"></div>
                                    <div class="input-field col l4 m4 s12 ltr"> 
                                        <span for="phone" class="help-span"><?php print _t('13', 'Cell Number') ?></span>
                                        <input data-tooltip='Customer Phone' id="phone" name="phone"  type="text" class="validate tooltipped" minlength="11" maxlength="11" data-inputmask="'mask': '99999999999'" value="<?php echo $pho; ?>" required> 
                                        <span class="help-text" ><?php print _t('338', 'For Example "98765432100"') ?> </span>

                                    </div>
                                    <div class="input-field col l4 m4 s12"> 
                                        <span for="cell_provider" class="help-span"><?php print _t('332', 'Cell Provider') ?></span>
                                        <select name="cell_provider" required id="cell_provider" class="browser-default" style="font-size: 16px;" onchange="change()">
                                            <option value="" disabled selected><?php print _t('30', 'Select Cell Provider') ?></option>
                                            <option value="Hamrah Aval" <?= _cprint($mkprovider, 'Hamrah Aval', 'selected'); ?>><?= _t('277', 'Hamrah Aval'); ?></option>
                                            <option value="Irancell" <?= _cprint($mkprovider, 'Irancell', 'selected'); ?> ><?= _t('278', 'Irancell'); ?></option>
                                            <option value="Ritetell" <?= _cprint($mkprovider, 'Ritetell', 'selected'); ?> ><?= _t('279', 'Ritetell'); ?></option>
                                            <option value="Talia" <?= _cprint($mkprovider, 'Talia', 'selected'); ?> ><?= _t('280', 'Talia'); ?></option>
                                        </select>
                                        <span class="help-text" ><?php print _t('340', 'For example "Irancell"') ?> </span>
                                    </div>
                                    <div class="input-field col l4 m4 s12"> 
                                        <span for="home_phone" class="help-span"><?php print _t('114', 'Home Phone Number') ?></span>
                                        <input data-tooltip='Home Phone Number' id="home_phone" name="home_phone"  type="text" class="tooltipped ltr not_margin" data-inputmask="'mask': '99999999999'" value="<?= $hpho; ?>" onchange="HomephoneValidate()"> 
                                        <span class="help-text" ><?php print _t('343', 'For example,') ?> "1234567890" </span>

                                    </div>
                                    <div style="clear: both"></div>
                                    <div class="input-field col l4 m4 s12">
                                        <span for="home_address" class="help-span"><?php print _t('111', 'Home Address (20 chars min, 255 max):') ?></span>
                                        <textarea data-tooltip='Home Address' id="home_address" class="materialize-textarea not_margin" name="home_address"><?= $address; ?></textarea>
                                        <span class="help-text" ><?php print _t('343', 'For example,') ?> "B13 Street 1, cross Road" </span>
                                    </div>
                                    <div class="input-field col s12 m4 l4 ">
                                        <span for="city" class="help-span"><?php print _t('112', 'City') ?></span>
                                        <input data-tooltip='City'  id="city" name="city" type="text" class="tooltipped not_margin" value="<?= $mcity ?>" > 
                                        <span class="help-text" ><?php print _t('343', 'For example,') ?> "Tehran" </span>
                                    </div>
                                    <div class="input-field col l4 m4 s12">
                                        <span for="post_code" class="help-span"><?php print _t('113', 'Postal-Code') ?></span>
                                        <input data-tooltip='Postal-Code' id="post_code"   name="post_code" type="text"  class="tooltipped ltr not_margin" maxlength="10" value="<?= $mpostal; ?>">
                                        <span class="help-text" ><?php print _t('343', 'For example,') ?> "0123456789" </span>
                                    </div>
                                    <div style="clear: both"></div>
                                    <div style="border-bottom: 2px solid gray; margin-bottom: 20px; padding-bottom: 6px;"><span style="color: brown;"><b><?php print _t('44', 'Car Details') ?></b></span></div>                        
                                    <div style="clear: both;"></div>
                                    <div class="input-field col s12 m4 l4 ">
                                        <span for="car_make" class="help-span"><?php print _t('369', 'Car Model') ?></span>
                                        <select name="car_make"  id="car_make" class="browser-default" style="font-size: 16px;" >
                                            <option value="" disabled selected><?php print _t('16', 'Choose Car Model Maker') ?></option>
                                            <option value="206" <?= _cprint($mkmodal, '206', 'selected'); ?>><?= _t('257', '206'); ?></option>
                                            <option value="405" <?= _cprint($mkmodal, '405', 'selected'); ?> ><?= _t('258', '405'); ?></option>
                                            <option value="pershia"<?= _cprint($mkmodal, 'pershia', 'selected'); ?> ><?= _t('259', 'pershia'); ?></option>
                                            <option value="L90"<?= _cprint($mkmodal, 'L90', 'selected'); ?> ><?= _t('260', 'L90'); ?></option>
                                            <option value="pride"<?= _cprint($mkmodal, 'pride', 'selected'); ?> ><?= _t('261', 'pride'); ?></option>
                                            <option value="tiba"<?= _cprint($mkmodal, 'tiba', 'selected'); ?> ><?= _t('262', 'tiba'); ?></option>
                                            <option value="samand"<?= _cprint($mkmodal, 'samand', 'selected'); ?> ><?= _t('263', 'samand'); ?></option>
                                            <option value="jac"<?= _cprint($mkmodal, 'jac', 'selected'); ?> ><?= _t('264', 'jac'); ?></option>
                                            <option value="lifan"<?= _cprint($mkmodal, 'lifan', 'selected'); ?> ><?= _t('265', 'lifan'); ?></option>
                                            <option value="geelee"<?= _cprint($mkmodal, 'geelee', 'selected'); ?> ><?= _t('266', 'geelee'); ?></option>
                                            <option value="MG"<?= _cprint($mkmodal, 'MG', 'selected'); ?> ><?= _t('267', 'MG'); ?></option>
                                            <option value="MVM"<?= _cprint($mkmodal, 'MVM', 'selected'); ?> ><?= _t('268', 'MVM'); ?></option>
                                            <option value="brilliance"<?= _cprint($mkmodal, 'brilliance', 'selected'); ?> ><?= _t('269', 'brilliance'); ?></option>
                                            <option value="proton"<?= _cprint($mkmodal, 'proton', 'selected'); ?> ><?= _t('270', 'proton'); ?></option>
                                            <option value="xantia"<?= _cprint($mkmodal, 'xantia', 'selected'); ?> ><?= _t('271', 'xantia'); ?></option>
                                            <option value="dena"<?= _cprint($mkmodal, 'dena', 'selected'); ?> ><?= _t('272', 'dena'); ?></option>
                                            <option value="rana"<?= _cprint($mkmodal, 'rana', 'selected'); ?> ><?= _t('273', 'rana'); ?></option>
                                            <option value="megan"<?= _cprint($mkmodal, 'megan', 'selected'); ?> ><?= _t('274', 'megan'); ?></option>
                                            <option value="hyundia"<?= _cprint($mkmodal, 'hyundia', 'selected'); ?> ><?= _t('275', 'hyundia'); ?></option>
                                            <option value="kia"<?= _cprint($mkmodal, 'kia', 'selected'); ?> ><?= _t('276', 'kia'); ?></option>
                                            <option value="other"<?= _cprint($mkmodal, 'other', 'selected'); ?>  ><?= _t('122', 'Other'); ?></option>
                                        </select>
                                        <span class="help-text" ><?php print _t('336', 'For Example "Pride"') ?> </span>
                                        <div id="select_make_model_other2" class="row" style="display: none;">
                                            <div class="input-field col s12 m12 l12 ">
                                                <span for="other_car" class="help-span"><?php print _t('374', 'Car Make') ?></span>
                                                <input data-tooltip="Car Maker" type="text"  name="other_car"  id="other_car" class=" tooltipped" minlength="2" >
                                                <span class="help-text" ><?php print _t('343', 'For example,') ?> "BMW" </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-field col s12 m4 l4  prefix">
                                        <span for="car_year" class="help-span"><?php print _t('374', 'Car Year') ?></span>
                                        <select name="car_year"  id="car_year" class="browser-default" style="font-size: 16px;">
                                            <option value="" disabled selected><?php print _t('17', 'Choose Car Year') ?></option>
                                            <?php for ($i = 1380; $i <= 1395; $i++) { ?>
                                                <option value="<?php echo $i; ?>" <?= _cprint($year, $i, 'selected'); ?>><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="help-text" ><?php print _t('342', 'For example, "1385"') ?> </span>
                                    </div>
                                    <div class="input-field col l4 m4 s12" >
                                        <span for="vehicle_type" class="help-span"><?php print _t('123', 'Vehicle Type') ?></span> 
                                        <div class="radio_list_single">
                                            <input name="v_type" type="radio" class="v_type with-gap my-radio-question right" data-que_id="1" data-que_type="CRITICAL" data-fail_point="0" id="type_sedan" value="5" />
                                            <label for="type_sedan"> <?php print _t('124', 'Sedan') ?></label>
                                            <input name="v_type" class="v_type with-gap my-radio-question" data-que_id="1" data-que_type="CRITICAL" data-fail_point="10"  type="radio" id="type_taxi" value="4"   />
                                            <label for="type_taxi"><?php print _t('125', 'Taxi') ?></label>
                                            <input name="v_type" class="v_type with-gap my-radio-question" data-que_id="1" data-que_type="CRITICAL" data-fail_point="10"  type="radio" id="type_suv" value="7"   />
                                            <label for="type_suv"><?php print _t('126', 'Suv') ?></label>
                                            <input name="v_type" class="v_type with-gap my-radio-question" data-que_id="1" data-que_type="CRITICAL" data-fail_point="10"  type="radio" id="type_van" value="6"   />
                                            <label for="type_van"><?php print _t('127', 'Luxury') ?></label>
                                            <div id="errorbox_vehicle_type"></div>
                                        </div>
                                    </div>
                                    <div style="clear: both; height: 20px;"></div>

                                    <div class="input-field col l4 m4 s12">

<!--                                        <input data-tooltip='License Expiry Date' id="license_expiry_date"   name="license_expiry_date" type="text"  class="tooltipped form-control observer" value="<?php echo $license_expiry_date; ?>" required>
                                        <label for="license_expiry_date"><?php print _t('31', 'License Expiry Date') ?></label>-->
                                        <input type="hidden" id="hiddenLED" name="hiddenLED">
                                        <?php // d($LED);   ?>
                                        <span for="license_expiry_date" class="help-span col s12 m12"><?php print _t('31', 'License Expiry Date') ?></span>

                                        <div class=" col l12 m12 s12 left ltr " style="padding: 0rem;">
                                            <div class="input-field col l4 m4 s4">
                                                <select id="ddl_date" name="ddl_date"  class=" ddl_date browser-default left" style="font-size: 12px;" required onchange="checkFarsiDate()">
                                                    <option disabled selected="">Day</option>
                                                    <?php
                                                    $i = '1';
                                                    for ($i; $i <= '31'; $i++) {
                                                        ?>
                                                        <option id="" value="<?= $i; ?>" <?= _cprint($mkdate, $i, 'selected'); ?> ><?= $i; ?></option> 
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="input-field col l4 m4 s4">
                                                <select id="ddl_month" name="ddl_month"  class="ddl_date browser-default left " style="font-size: 12px;" onchange="checkFarsiDate()" required>
                                                    <option disabled selected="">Month</option>
                                                    <?php
                                                    $i = '1';
                                                    for ($i; $i <= '12'; $i++) {
                                                        ?>
                                                        <option id="" value="<?= $i; ?>" <?= _cprint($mkmonth, $i, 'selected'); ?>><?= $i; ?></option> 
                                                        <?php
                                                    }
                                                    ?>
                                                </select >
                                            </div>     
                                            <div class="input-field col l4 m4 s4 "  style="padding: 0rem;">
                                    <!--<input data-tooltip='License Expiry Date' id="license_expiry_date"   name="license_expiry_date" type="text"  class="tooltipped form-control observer" value="<?php echo $license_expiry_date; ?>" required>-->

                                                <select   id="ddl_year" name="ddl_year"  class="ddl_date browser-default left " style="font-size: 12px;" onchange="checkFarsiDate()" required>
                                                    <option disabled selected="" >Year</option>
                                                    <?php
                                                    $i = '1395';
                                                    for ($i; $i <= '1445'; $i++) {
                                                        ?>
                                                        <option id="" value="<?= $i; ?>" <?= _cprint($mkyear, $i, 'selected'); ?> ><?= $i; ?></option> 
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>


                                            <div style="clear: both;"></div>
                                            <span class="help-text" ><?php print _t('341', 'For example, "1400/01/25"') ?> </span>
                                        </div> <div style="clear: both;"></div>
                                    </div>
                                    <div class="input-field col l4 m4 s12">
                                        <span for="dt_insurance_expr" class="help-span col s12 m12"><?php print _t('110', 'Insurance-Expiration-Date') ?></span> 
                                        <div class="col l12 m12 s12" style="padding: 0px;margin: 0px;">
                                            <div class="input-field col l4 m4 s4" style="padding-bottom: 0px; margin: 0px;">
                                                <select id="insurance_expr_date" name="insurance_expr_date"  class="ddl_date  browser-default left" style="font-size: 16px;" onchange="checkINSUFarsiDate()" >
                                                    <option disabled selected=""><?php print _t('283', 'Day') ?></option>
                                                    <?php for ($i = 1; $i <= '31'; $i++) { ?>
                                                        <option id="" value="<?= $i; ?>" <?= _cprint($insudate, $i, 'selected'); ?>><?= $i; ?></option> 
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="input-field col l4 m4 s4" style="padding-bottom: 0px; margin: 0px;">
                                                <select id="insurance_expr_month" name="insurance_expr_month"  class="ddl_date browser-default left " style="font-size: 16px;" onchange="checkINSUFarsiDate()" >
                                                    <option disabled selected><?php print _t('282', 'Month') ?></option>
                                                    <?php for ($i = 1; $i <= '12'; $i++) { ?>
                                                        <option id="" value="<?= $i; ?>" <?= _cprint($insumonth, $i, 'selected'); ?>><?= $i; ?></option> 
                                                    <?php } ?>
                                                </select >
                                            </div>
                                            <div class="input-field col l4 m4 s4" style="padding-bottom: 0px;margin: 0px;padding: 0rem;">
                                                <select id="insurance_expr_year" name="insurance_expr_year"  class=" ddl_date browser-default left " style="font-size: 16px;" onchange="checkINSUFarsiDate()"  >
                                                    <option disabled selected ><?php print _t('281', 'Year') ?></option>
                                                    <?php for ($i = 1395; $i < 1445; $i++) { ?>
                                                        <option id="" value="<?= $i; ?>" <?= _cprint($insuyear, $i, 'selected'); ?>><?= $i; ?></option> 
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div style="clear: both;"></div>
                                        </div>
                                        <div style="clear: both;"></div>
                                        <span class="help-text" style="padding-top: 1rem;" ><?php print _t('341', 'For example, "1400/01/25"') ?> </span>
                                    </div>
                                    <div class="input-field col l4 m4 s12">
                                        <span for="dt_smog_expr" class="help-span col s12 m12"><?php print _t('377', 'Smog-Expiration-Date') ?></span> 
                                        <div class="col l12 m12 s12" style="padding: 0px;">
                                            <div class="input-field col l4 m4 s4" style="padding-bottom: 0px; margin: 0px;">
                                                <select id="smog_expr_date" name="smog_expr_date"  class="ddl_date  browser-default left" style="font-size: 16px;" onchange="checkSmogFarsiDate()" >
                                                    <option disabled selected=""><?php print _t('283', 'Day') ?></option>
                                                    <?php for ($i = 1; $i <= '31'; $i++) { ?>
                                                        <option id="" value="<?= $i; ?>" <?= _cprint($insudate, $i, 'selected'); ?>><?= $i; ?></option> 
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="input-field col l4 m4 s4" style="padding-bottom: 0px; margin: 0px;">
                                                <select id="smog_expr_month" name="smog_expr_month"  class="ddl_date browser-default left " style="font-size: 16px;" onchange="checkSmogFarsiDate()" >
                                                    <option disabled selected><?php print _t('282', 'Month') ?></option>
                                                    <?php for ($i = 1; $i <= '12'; $i++) { ?>
                                                        <option id="" value="<?= $i; ?>" <?= _cprint($insumonth, $i, 'selected'); ?>><?= $i; ?></option> 
                                                    <?php } ?>
                                                </select >
                                            </div>
                                            <div class="input-field col l4 m4 s4" style="padding-bottom: 0px;margin: 0px;padding: 0rem;">
                                                <select id="smog_expr_year" name="smog_expr_year"  class=" ddl_date browser-default left " style="font-size: 16px;" onchange="checkSmogFarsiDate()"  >
                                                    <option disabled selected ><?php print _t('281', 'Year') ?></option>
                                                    <?php for ($i = 1395; $i < 1445; $i++) { ?>
                                                        <option id="" value="<?= $i; ?>" <?= _cprint($insuyear, $i, 'selected'); ?>><?= $i; ?></option> 
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div style="clear: both;"></div>
                                        </div>
                                        <div style="clear: both;"></div>
                                        <span class="help-text" style="padding-top: 1rem;" ><?php print _t('341', 'For example, "1400/01/25"') ?> </span>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="input-field col l4 m4 s12">
                                        <span for="veh_card_no" class="help-span"><?php print _t('130', 'Vehicle Card Number') ?></span> 
                                        <input data-tooltip='Vehicle Card Number'  id="veh_card_no"  name="veh_card_no" type="text"  class="tooltipped ltr not_margin" value="<?= $data['vehicle_card_number']; ?>" maxlength="8"> 
                                        <span class="help-text" ><?php print _t('343', 'For example,') ?> "12345678" </span>
                                    </div>

                                    <div class="col l4 s12 m4">


                                        <span for="" class="help-span col s12 m12"><?php print _t('128', 'Choose Color') ?></span> 
                                        <select id="color_id" name="color_id"  class=" browser-default" style="padding-left: 5px;font-size: 16px;" >
                                            <option value="" disabled selected> <?php print _t('128', 'Choose Color') ?></option>
                                            <option value="red" ><?= _t('246', 'red'); ?></option>
                                            <option value="green"><?= _t('247', 'green'); ?></option>
                                            <option value="blue" ><?= _t('248', 'blue'); ?></option>
                                            <option value="yellow" ><?= _t('249', 'yellow'); ?></option>
                                            <option value="white" ><?= _t('250', 'white'); ?></option>
                                            <option value="brown" ><?= _t('251', 'brown'); ?></option>
                                            <option value="black" ><?= _t('252', 'black'); ?></option>
                                            <option value="pink" ><?= _t('253', 'pink'); ?></option>
                                            <option value="silver" ><?= _t('254', 'silver'); ?></option>
                                            <option value="charcoal" ><?= _t('255', 'charcoal'); ?></option>
                                            <option value="beige" ><?= _t('256', 'beige'); ?></option>
                                            <option value="other" ><?= _t('122', 'Other'); ?></option>
                                        </select>
                                        <span class="help-text" ><?php print _t('343', 'For example,') ?> "red" </span>
                                        <div id="select_color_other" class="row" style="display: none;">
                                            <div class="input-field col s12 m12 l12 ">
                                                <span for="other_color" class="help-span"><?php print _t('', 'New Color') ?></span> 
                                                <input data-tooltip="Other Color" type="text"  name="other_color"  id="other_color" class=" tooltipped" minlength="2"  value="<?= $data['new_color']; ?>">
                                                <span class="help-text" ><?php print _t('343', 'For example,') ?> "lemon green" </span>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col l4 s12 m4">

                                        <span for="" class="help-span"><?php print _t('133', 'Is the applicant the owner?') ?></span> 
                                        <div class="radio_list_single">

                                            <input  name="non_owner" class="non_owner" type="radio" id="non_owner_yes" value="1" <?= _cprint($data['is_applicant_owner'], '1', 'checked'); ?> />
                                            <label for="non_owner_yes"><?php print _t('19', 'Yes') ?></label>
                                            <input name="non_owner" class="non_owner" type="radio" id="non_owner_no" value="0" <?= _cprint($data['is_applicant_owner'], '0', 'checked'); ?>/>
                                            <label for="non_owner_no"><?php print _t('20', 'No') ?></label>                            

                                        </div>
                                        <div id="errorbox_non_owner">&nbsp;</div>


                                    </div>
                                    <div style="clear: both;height: 20px;"></div>
                                    <!--<div ></div>-->

                                    <div class="col l6 m12 s12 ltr vehicle_license_block" >
                                        <span for="veh_lic_no" class="help-span" style="display:block"><?php print _t('12', 'Vehicle License Plate') ?></span>
                                        <!--                                        <div class="vehicle_license_block_lbl">
                                                                                    <label for="veh_lic_no"><?php print _t('12', 'Vehicle License Plate') ?></label> 
                                                                                </div>-->
                                        <div class="s20">
                                            <input data-tooltip='Vehicle License Plate Number'  id="veh_lic_no1"  data-inputmask="'mask': '99'" maxlength="2" name="veh_lic_no1" type="text"  class=" tooltipped" value="<?php echo $veh_l1; ?>">
                                        </div>
                                        <div class="s80">
                                            <div class="flg_block">
                                                <img src="<?php print _MEDIA_URL ?>images/flag.png" style="margin-top: 5px; height: 17px;">
                                                <div style="font-weight: bold; font-size: 4px;">&nbsp;</div>
                                                <div style="font-weight: bold;">I.R.</div>
                                                <div style="font-weight: bold;">IRAN</div>
                                            </div>
                                            <div class="b1">
                                                <input data-tooltip='Vehicle License Plate Number'   id="veh_lic_no2"  data-inputmask="'mask': '99'" maxlength="2" name="veh_lic_no2" type="text"  class=" tooltipped ltr" value="<?php echo $veh_l2; ?>">                                    
                                            </div>
                                            <div dir="rtl" class="b2">
                                                <select class="browser-default" id="veh_lic_no3" name="veh_lic_no3">
                                                    <?php
                                                    $persian_alpha = array("ا", "آ", "ب", "ت", "ج", "د", "ز", "س", "ص", "ط", "ق", "ل", "م", "ن", "و", "ه", "ی");
                                                    foreach ($persian_alpha as $value) {
                                                        echo "<option value='{$value}' " . _cprint($veh_l3, $value, 'selected') . ">{$value}</option>";
                                                    }
                                                    ?>
                                                </select>                                    
                                            </div>
                                            <div class="b3">
                                                <input data-tooltip='Vehicle License Plate Number'  id="veh_lic_no4"  data-inputmask="'mask': '999'"  maxlength="3" name="veh_lic_no4" type="text"  class=" tooltipped ltr" style="" value="<?php echo $veh_l4; ?>">                                                                 
                                            </div>                                
                                        </div>
                                        <div id="errorbox_vln">&nbsp;</div>
                                        <div style="clear: both;"></div>  
                                        <span class="help-text" >Example "99 <span class="">ت</span> </span><span class="help-text"> 999 99 "</span>
                                    </div>
                                    <!--                                    <div class="input-field col l6 m6 s12" >
                                                                            <span for="license_plate_type" class="help-span"><?php print _t('361', 'License Plate Type') ?> :</span> 
                                                                            <div class="radio_list_single">
                                                                                <input name="l_p_type" type="radio" class="with-gap my-radio-question right" data-que_id="1" data-que_type="CRITICAL" data-fail_point="0" id="odd" value="b"/>
                                                                                <label for="odd"> <?php print _t('362', 'ODD') ?></label>
                                                                                <input name="l_p_type" class="with-gap my-radio-question" data-que_id="1" data-que_type="CRITICAL" data-fail_point="10"  type="radio" id="even" value="c" />
                                                                                <label for="even"><?php print _t('363', 'EVEN') ?></label>
                                    
                                                                            </div>
                                                                        </div>
                                                                        <div id="errorbox_license_plate_type"></div>-->
                                </div> 
                                <br/>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper"> 
                        <div class=" " id="card_vehicle" hidden >
                            <div class="card" id="card_1" >
                                <div class="title">
                                    <!--<div class="row">-->
                                    <!--<i class="fa fa-cab prefix"></i>&nbsp;-->
                                    <span style="font-weight:bold;font-size:16px; "><?php print _t('44', 'Car Details') ?></span>
                                    <span class="right" style="color: orangered; font-weight:bold;font-size:16px;margin-right: 10%; "><?php print _t('42', 'STATION-2') ?></span>
                                    <!--</div>-->
                                </div>
                                <div class="content">  
                                    <div class="s12 m12 l12 ltr">

                                        <div class="row" >
                                            <!--                        <div class="input-field col s12 m6 l6 ">
                                                                        <i class="mdi-maps-directions-car prefix"></i>
                                                                        <input data-tooltip='Car Modal'  id="car_modal" name="car_modal" type="text" class="validate tooltipped" value="" required> 
                                                                        <label for="car_modal">Modal</label> 
                                                                    </div>-->
                                            <div class="col l16 m6 s12 ">
                                                <!--<i class="mdi-maps-directions-car prefix"> </i>-->
                                                <!--<input data-tooltip='Vehicle License Plate Number'  id="veh_lic_2"   name="veh_lic_2" type="text"  class=" tooltipped" value="<?php echo $plate['license_plate']; ?>" readonly>--> 
                                                <span id="v1" style="font-size: 14px;"><?php print _t('12', 'Vehicle License Plate') ?></span> <br/>
                                                <!--<label for="veh_lic_2"><?php print _t('12', 'Vehicle License Plate') ?></label> <br/>-->
                                                <?php
                                                // echo $row['license_plate']; 
                                                $vin_arr = explode('-', $plate["license_plate"]);
                                                ?>
                                                <div style="width:136px;" class="ltr left">
                                                    <!--                                                    <label id="dvl1" name="dvl1" style="color: black; font-size: 12px;line-height: 28px;" class="ltr"></label> 
                                                                                                        <label id="dvl2" name="dvl2" style="color: black; font-size: 12px;line-height: 28px;" class="ltr"></label> 
                                                                                                        <label id="dvl3" name="dvl3" style="color: black; font-size: 12px;line-height: 28px;" class="vlicense "></label>-->
                                                    <!--<label id="dvl1" name="dvl1" style=" font-size: 12px;line-height: 28px;" class="ltr"></label>--> 
                                                    <label id="dvl2" name="dvl2" style=" font-size: 12px;line-height: 28px;" class="ltr"></label> 
                                                    <label id="dvl3" name="dvl3" style=" font-size: 12px;line-height: 28px;" class="ltr"></label> 
                                                    <label id="dvl4" name="dvl4" style=" font-size: 12px;line-height: 28px;" class="vlicense "></label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="title"  ><span style="font-weight:bold;font-size:16px; "><?php print _t('81', 'Car Notes') ?></span></div>
                                <div class="content">
                                    <div class="row">
                                        <!--<div class="input-field col l12 m6 s12">--> 
                                            <!--<i class="mdi-maps-directions-car prefix"></i>-->
                                            <!--<textarea id="v_note1" class="materialize-textarea" name="v_note1" data-parsley-trigger="keyup" style="height:50px; " data-parsley-minlength="20" data-parsley-maxlength="300" data-parsley-validation-threshold="10" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." readonly></textarea>-->
                                        <!--<label  id="v_note1_id" class="input-field"></label>-->
                                        <div class="col l4 m4 s12 car_notes" >
                                            <div class="col l12 m6 s12">
                                                <label  id="v1" class="input-field" style=" "><?php print _t('208', 'Note Prepared By') ?>:</label><br>
                                                <label  id="v1_value" class="input-field" style="text-transform: uppercase;"></label>
                                            </div>
                                            <div class="col l12 m6 s12">
                                                <label  id="v2" class="input-field" style=""><?php print _t('209', 'Log Date') ?>:</label><br>
                                                <label  id="v2_value" class="input-field" style=""></label>
                                            </div>
                                            <!--                                                <div style="clear: both"></div>-->
                                        </div>
                                        <div class="col l7 m8 s12 offset-l1">
                                            <div class="col l6 m6 s12">
                                                <label  id="v3" class="input-field" style=""><?php print _t('119', 'Driver') ?>:</label><br>
                                                <label  id="v3_value" class="input-field" style=" text-transform: uppercase;"></label> 
                                            </div>
                                            <div class="col l6 m6 s12">  
                                                <label  id="v4" class="input-field" style=""><?php print _t('35', 'Make-Model-Year') ?>:</label><br>
                                                <label  id="v4_value" class="input-field" style="text-transform: uppercase;"></label>
                                            </div>
                                            <div style="clear: both"></div>
                                            <div class="col l12 m6 s12">
                                                <label  id="v5" class="input-field"style=""><?php print _t('212', 'Note') ?>:</label><br>
                                                <label  id="v5_value" class="input-field" style="text-transform: capitalize;"></label>
                                            </div>
                                        </div>

                                        <!--</div>-->
                                    </div>
                                </div>
                            </div>
                            <div class="card" id="card_car_insp" >
                                <div class="title"> 
                                    <i class="fa fa-cab prefix"></i>&nbsp;<span style="font-weight:bold"><?php print _t('46', 'Car Inspection [Questions]') ?></span>
                                </div>
                                <div class="content">  
                                    <table id="table2" class="display table table-bordered table-striped table-hover " >
                                        <thead>
                                            <tr>
                                                <!--<th style="font-weight:normal;font-size:16px; width: 2%;"><?php print _t('346', '#') ?></th>-->
                                                <th style="font-weight:bold;font-size:16px; width: 70%;"><?php print _t('210', 'Question') ?></th>
                                                <th style="font-weight:bold;font-size:16px; width: 30%;"><?php print _t('211', 'Replied Answer') ?></th>

                                            </tr>

                                        </thead>
                                        <tbody id="tbody_1">
    <!--                                            <tr>
    
    
                                                <td id="">1</td>
                                                <td id="q_que">aasjhjagdahgdjaghdjavhsd</td>
                                                <td id="q_ans">yes</td>
    
                                            </tr>-->
                                            <?php
                                            for ($index = 1; $index < 30; $index++) {
                                                ?>
                                                <tr>


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!--<td id="td_no<?php echo $index ?>"></td>-->
                                                    <td id="td_que<?php echo $index ?>"></td>
                                                    <td id="td_ans<?php echo $index ?>"></td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <br/>
                            </div>

                            <!--card_1-->
                        </div>
                    </div>
                    <div class="wrapper">
                        <div class="card" id="card_login" hidden>
                            <div class="title">
                                <!--<div class="row">-->
                                    <!--<i class="fa fa-cab prefix small"></i>&nbsp;-->
                                <span style="font-weight:bold;font-size:16px; "><?php print _t('207', 'Login Details') ?></span>
                                <span class="right" style="color: orangered; font-weight:bold;font-size:16px;margin-right: 10%; "><?php print _t('43', 'STATION-3') ?></span>
                                <!--</div>-->
                            </div>
                            <!--                            <div class="content" >
                                                            <div class="input-field col l6 m6 s12 ltr">
                                                                <span for="uname" class="help-span"><?php print _t('188', 'User Name') ?></span>
                                                                <input data-tooltip='User Name' id="uname" name="uname"  type="text" class="validate tooltipped" minlength="10" maxlength="13" data-inputmask="'mask': '(0\\9)999999999'" value="" required> 
                                                                <span class="help-text" ><?php print _t('343', 'For example,') ?> "(09)987654321" </span>
                                                            </div>
                                                            <div class="input-field col l6 m6 s12">
                                                                <span for="psw" class="help-span"><?php print _t('189', 'Password') ?></span>
                                                                <input data-tooltip='Password'  id="psw" name="psw" type="text" class="validate tooltipped" value="" required > 
                                                                <span class="help-text" ><?php print _t('343', 'For example,') ?> "AB12CD3456" </span>
                                                            </div>
                                                        </div>-->
                        </div>
                    </div>
                </div>
            </div>
            <div style="clear: both"></div>
            <!--</div>-->
            <!--                    </div>-->

        </div>
        <div class="modal-footer ">
            <button data-tooltip='Click to Close' name="close" id="close" class="right modal-close  waves-effect waves-light btn btn-default z-depth-0 z-depth-1-hover tooltipped" type="button" style="margin-left: 2px;"><?php print _t('179', 'Close') ?></button>
            <button data-tooltip='Click to Save' name="save"  class="right waves-effect waves-light btn btn-default z-depth-0 z-depth-1-hover tooltipped" type="button" style="margin-left: 2px;" onclick="checkDuplication()"><?php print _t('18', 'Save') ?></button>
            <div style="clear: both"></div>
            <input type="hidden" name="d_id" id="d_id" value="">
            <input type="hidden" name="v_id" id="v_id" value="">
            <input type="hidden" name="save" />

        </div>
    </form>
</div>
<style>
    .fixframe {
        position: fixed;
        top: 15px;
        left: 25px;
        right: 25px;
        bottom: 0px;

    } 
    .fixframe iframe {
        height: 100%;
        width: 100%;  
    } 
    .arrange{
        float:left;
    }
    html.rtl .arrange{
        float:right;
    }
</style>
<?php include _PATH . "instance/front/tpl/vehicle_plate_design.php" ?>
