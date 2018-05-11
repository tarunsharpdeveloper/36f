<style>
    .tb_div{
        float: left;
        width:14.285%;
        min-height: min-content;
        border: 1px rgba(128, 128, 128, 0.29) solid;
        text-align: center;
        padding: 1.8%;
        cursor: pointer;
        height: 153px;
    }
    .center_bold {   
        text-align: center;
        font-weight: bold;
    }
    .photo-css{
        cursor: pointer;
        border: 2px dashed transparent;
        border-radius: 50%;
        display: inline-block;
        position: relative;
        height:60px;
        width: 60px
    }
    .button-color{
        color: white;
        background-color: rgb(255, 141, 0);
        border: yellow;
        display: none;
    }
</style>
<div class="panel">
    <div class="panel-body">
        <form  action="me_home" method="post" id='me_home_form'>
            <div class="panel">
                <div class="panel-body">
                    <div>
                        <div id="OnlineList">
                        <?php
                        foreach ($online as $listOnline) {
                            echo $listOnline['fname'] . ' ' . $listOnline['lname'] . '<br/>';
                        }
                        ?>
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            <h2 style="font-weight: bold;">Welcome Back , <?= $ProfileData['fname'] ?></h2>
                        </div>
                        <div class="col-lg-6 col-sm-12 ">
                            <hr>
                        </div>
                        <div class="col-lg-3 col-sm-12" style="border: 2px solid green;padding: 10px;border-radius: 10px;height: min-content">
                            <div id="startshiftdisplay" style="" class="col-sm-4 col-md-4 col-lg-4 ">

                            </div>
                            <div style="" class="col-sm-8 col-md-8 col-lg-8 ">
                                <button class="btn btn-sm js-myWeek-Start-Unrostered button-color " data-dp-analytics="DMWS" id="start_break" value="0" type="button" onclick="Break('0');"  >Start Break</button>
                                <button class="btn btn-sm js-myWeek-Start-Unrostered button-color" data-dp-analytics="DMWS" id="end_break" value="1" type="button" onclick="Break('1');" >End Break</button>
                                <button class="btn btn-success btn-sm js-myWeek-Start-Unrostered" data-dp-analytics="DMWS" id="start" value="0" style="display: none;float: right;" type="button" onclick="Shift('0');" >Start Shift</button>
                                <a style="color: white;background-color: rgba(255, 0, 0, 0.73);border: red;display: none;" class="btn btn-success btn-sm js-myWeek-Start-Unrostered" id="end" href="#" onclick="GetShiftDetails('<?php echo $_SESSION["shiftId"]; ?>');" data-toggle="modal" data-target="#EndShiftModel" >End Shift</a>

                                <!--<button style="color: white;background-color: rgba(255, 0, 0, 0.73);border: red;display: none;" class="btn btn-success btn-sm js-myWeek-Start-Unrostered" data-dp-analytics="DMWS" id="end" value="1" type="button" onclick="Shift('1');" >End Shift</button>-->
                            </div>
                        </div>
                    </div>

                    <!--                    <div class="row">
                                            <div class="col-xs-3 col-md-3">
                    <?php
                    if (empty($ProfileData['photo'])) {
                        $image = 'user.jpg';
                    } else {
                        $image = $ProfileData['photo'];
                    }
                    ?>
                    
                                                <img id="imgTeamProfilePhoto" class="imgProfilePhoto m-team-photo--large photo-css" src="docs/profile_images/<?php echo $image; ?>" alt="Set Photo">
                    
                                            </div>
                                            <div class="col-xs-9 col-md-9">
                    
                                                <label style="text-transform: uppercase;"><?= $ProfileData['fname'] . " " . $ProfileData['lname']; ?></label><br/>
                                                <span><?= $_SESSION['user']['access_level'] ?></span>
                                            </div>
                                        </div>-->


                    <!--                    <div class="example-box-wrapper">
                                            <button type="button" name="startshift" value="Start Unscheduled Sift" class="btn-primary  col-md-6 col-sm-12 col-lg-12" style="width: 100%;" >Start Unscheduled Sift</button>
                                        </div>-->

                </div>
            </div>

            <!--            <div class="panel">
                            <div class="panel-body">
                                <div id="startshiftdisplay" style="float: left;margin-left: 76%;">
            
                                </div>
                                <div style="float: right;">
            
            
                                    <button class="btn btn-sm js-myWeek-Start-Unrostered button-color" data-dp-analytics="DMWS" id="start_break" value="0" type="button" onclick="Break('0');" >Start Break</button>
                                    <button class="btn btn-sm js-myWeek-Start-Unrostered button-color" data-dp-analytics="DMWS" id="end_break" value="1" type="button" onclick="Break('1');" >End Break</button>
                                    <button class="btn btn-success btn-sm js-myWeek-Start-Unrostered" data-dp-analytics="DMWS" id="start" value="0" style="display: none;" type="button" onclick="Shift('0');" >Start Shift</button>
                                    <a style="color: white;background-color: rgba(255, 0, 0, 0.73);border: red;display: none;" class="btn btn-success btn-sm js-myWeek-Start-Unrostered" id="end" href="#" onclick="GetShiftDetails('<?php echo $_SESSION["shiftId"]; ?>');" data-toggle="modal" data-target="#EndShiftModel" >End Shift</a>
            
                                    <button style="color: white;background-color: rgba(255, 0, 0, 0.73);border: red;display: none;" class="btn btn-success btn-sm js-myWeek-Start-Unrostered" data-dp-analytics="DMWS" id="end" value="1" type="button" onclick="Shift('1');" >End Shift</button>
                                </div>
            
            
                            </div>
                        </div>-->

            <div class="panel">
                <div class="panel-body" style="font-size: 15px;">
                    <div class="" id="divsDate" style="clear: both;">

                    </div>
                    <div class="" id="divsDay" style="clear: both; overflow-y: scroll; height: 400px;">

                    </div>
                </div>
            </div>

            <!--            <div class="panel">
                            <div class="panel-body">
                                <h3 class="title-hero">
                                    Shift
                                </h3>
                                <div class="example-box-wrapper">
                                    <div class="col-lg-4 col-sm-12 col-md-12">
                                        <button class="btn btn-alt btn-hover btn-default " style="width: 100%">
                                            <span>Upcommming Shift</span>
                                            <i class="glyph-icon icon-arrow-right"></i>
                                        </button>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-md-12">
                                        <button class="btn btn-alt btn-hover btn-default" style="width: 100%">
                                            <span>Available Shift</span>
                                            <i class="glyph-icon icon-arrow-right"></i>
                                        </button></div>
                                    <div class="col-lg-4 col-sm-12 col-md-12">
                                        <a class="btn btn-alt btn-hover btn-default" style="width: 100%" href="<?php l('timesheet') ?>">
                                            <span>Timesheets</span>
                                            <i class="glyph-icon icon-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <h3 class="title-hero">
                                    Time Off
                                </h3>
                                <div class="example-box-wrapper">
                                    <div class="col-lg-6 col-sm-12 col-md-12"> 
                                        <a class="btn btn-alt btn-hover btn-default " style="width: 100%" href="<?php l('leave') ?>">
                                            <span>Leave</span>
                                            <i class="glyph-icon icon-arrow-right"></i>
                                        </a>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-md-12">
                                        <a class="btn btn-alt btn-hover btn-default " style="width: 100%"  href="#">
                                            <span>Unavailable</span>
                                            <i class="glyph-icon icon-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>-->
            <!-- /Popout -->
        </form>
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <p>Modal content here ...</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="button">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


                 

    </div>
</div>

<div class="modal fadeInUp center "  id="EndShiftModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title center_bold" id="myModalLabel2">End Shift</h4>
            </div>

            <div class="modal-body" >
                <div class="panel" >
                    <div class="panel-body" >
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <h2 class="m-myWeek-endShiftTime center_bold">
                                        <i class="fa fa-clock-o"></i> 
                                        <span class="" id="hours_count"></span>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-4 padding-none">
                            <div class="form-group">
                                <label>Start time</label>
                                <input class="form-control timepicker-example mContent" id="start_time" name="start_time" type="text" value="" required>
                                <span id="error_start_time" style="color:red;"></span>
                            </div>
                        </div>


                        <div class="col-xs-4 padding-none">
                            <div class="form-group">
                                <label>End time</label>
                                <input class="form-control timepicker-example mContent" id="end_time" name="end_time" type="text" value="<?php echo $endvalue; ?>" required>
                                <span id="error_end_time" style="color:red;"></span>
                            </div>
                        </div>
                        <div class="col-xs-4 padding-none">
                            <div class="form-group">
                                <label>Break time</label>
                                <input class="form-control mContent" type="text" value="" id="break_time" name="break_time" required> 

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-1 control-label" >Note</label>
                                        <div class="col-sm-11">
                                            <input id="note" type="text" name="note" class="form-control"  placeholder="(Optional)"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="error_msg" style="display: block;color: red;"></div> 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-12">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="button" onclick="Add_End_Shift();">End Shift</button>
                </div> 
            </div> 


        </div>
    </div><!-- modal-content -->
</div><!-- modal-dialog -->

<!-- Modal Structure -->
<!--Modal 1 -->

<style>

    label.error{
        position: relative;
    }
    .not_margin{
        margin-bottom: 0px !important;
    }
    .radio_list_single{
        margin-top: 5px;
    }
    .ddl_date{

        /*width: 20%;*/
    }
    input[type="text"]{
        height: 32px;
    }
    .row .col.l4{
        padding-bottom: 0px;
    }
    .custom_ddl_block .col.l4{
        margin-top: 0px;
    }
    html.rtl .custom_ddl_block .col.l4{
        padding-right: 0px;
        padding-left: 10px;
    }
    html.rtl .custom_ddl_block{
        padding-right: 0px;
    }


</style>

<?php include _PATH . "instance/front/tpl/vehicle_plate_design.php" ?>