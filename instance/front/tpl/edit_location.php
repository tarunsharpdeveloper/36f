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
<style>

    /*  bhoechie tab */
    div.bhoechie-tab-container{
        z-index: 10;
        background-color: #ffffff;
        padding: 0 !important;
        border-radius: 4px;
        -moz-border-radius: 4px;
        border:1px solid #ddd;
        /*margin-top: 20px;*/
        /*margin-left: 50px;*/
        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
        -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        background-clip: padding-box;
        opacity: 0.97;
        filter: alpha(opacity=97);
    }
    div.bhoechie-tab-menu{
        padding-right: 0;
        padding-left: 0;
        padding-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group{
        margin-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group>a{
        margin-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group>a .glyphicon,
    div.bhoechie-tab-menu div.list-group>a .fa {
        color: #00CEB4;
    }
    div.bhoechie-tab-menu div.list-group>a:first-child{
        border-top-right-radius: 0;
        -moz-border-top-right-radius: 0;
    }
    div.bhoechie-tab-menu div.list-group>a:last-child{
        border-bottom-right-radius: 0;
        -moz-border-bottom-right-radius: 0;
    }
    div.bhoechie-tab-menu div.list-group>a.active,
    div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
    div.bhoechie-tab-menu div.list-group>a.active .fa{
        background-color: #00CEB4;
        background-image: #00CEB4;
        color: #ffffff;
    }
    div.bhoechie-tab-menu div.list-group>a.active:after{
        content: '';
        position: absolute;
        left: 100%;
        top: 50%;
        margin-top: -13px;
        border-left: 0;
        border-bottom: 13px solid transparent;
        border-top: 13px solid transparent;
        border-left: 10px solid #00CEB4;
    }

    div.bhoechie-tab-content{
        background-color: #ffffff;
        /* border: 1px solid #eeeeee; */
        padding-left: 20px;
        padding-top: 10px;
    }

    div.bhoechie-tab div.bhoechie-tab-content:not(.active){
        display: none;
    }

</style>
<script type="text/javascript">
    $(document).ready(function () {
        $("div.bhoechie-tab-menu>div.list-group>a").click(function (e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
        });
    });
</script>
<div class="panel">
    <div class="panel-body">
        <div>
            <div class="col-lg-2 col-sm-12">
                <h2 style="font-weight: bold;">Location</h2>
            </div>

            <div class="col-lg-8 col-sm-12 ">
                <hr>
            </div>
            <div class="col-lg-2 col-sm-12">
                <div class="dropdown float-right" style="width: 100%;">
                    <a class="btn btn-default btn-link" href="<?php l('location') ?>"> <i class="glyphicon glyphicon-arrow-left"></i>Back</a>

                </div>
                <!--<button class="btn btn-azure col-md-12 " data-toggle="modal" data-target="#Add-People" type="button">Add People</button>-->
            </div>
        </div>
<!--        <div> <a class="btn btn-default btn-link" href="<?php l('profile') ?>"> <i class="glyphicon glyphicon-arrow-left"></i>Back to My Account</a></div>
<br/>
<div style="margin: 1rem;border-bottom: 1px solid #ddd;"><span style="font-size: 18px;font-weight: bolder;">Edit Profile</span> </div>-->

        <!--<div class="container">
            <div class="row">-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
                <div class="list-group">
                    <a href="#" class="list-group-item active text-left">
                        <h4 class="glyphicon "></h4><br/><b>General</b>
                    </a>
                    <a href="#" class="list-group-item text-left">
                        <h4 class="glyphicon "></h4><br/><b>Areas</b>
                    </a>
                    <a href="#" class="list-group-item text-left">
                        <h4 class="glyphicon "></h4><br/><b>Scheduling</b>
                    </a>
                    <a href="#" class="list-group-item text-left">
                        <h4 class="glyphicon "></h4><br/><b>Timesheets</b>
                    </a>
                    <a href="#" class="list-group-item text-left">
                        <h4 class="glyphicon "></h4><br/><b>Payroll</b>
                    </a>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                <!-- flight section -->
                <div class="bhoechie-tab-content active">
                    <form name="form_profile" id="form_profile" action="myaccount">
                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-12 col-lg-12" for="Name">Name:</label>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <input type="text" class="form-control" value="<?php echo $ProfileData['fname']; ?>" name="Name" id="Name" placeholder="Enter Name" required="">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-12 col-lg-12" for="code">Code:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-control" value="<?php echo $ProfileData['lname']; ?>" name="code" id="code" placeholder="Enter Code" required="">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-labelcol-sm-12 col-lg-12" for="address">Address:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-control" value="<?php echo $ProfileData['email']; ?>" name="address" id="address" placeholder="Enter Address" required="">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-12 col-lg-12" for="locTimeZone">Timezone:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <select class="form-control chosen-select" name="locTimeZone" id="locTimeZone">
                                        <option >Asia/Tehran</option>
                                        <option>Asia/Tehran</option>
                                        <option>Asia/Tehran</option>
                                        <option>Asia/Tehran</option>
                                        <option>Asia/Tehran</option>
                                        <option>Asia/Tehran</option>
                                        <option>Asia/Tehran</option>
                                    </select>
                                    <!--<input type="text" class="form-control" value="<?php echo $ProfileData['lname']; ?>" name="locWeekStart" id="locWeekStart" placeholder="e.g Street, City, Country" required="">-->
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-labelcol-sm-12 col-lg-12" for="note">Note:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <textarea name="note" id="note" style="min-height: 100px;width: 100%;resize: none;">
                                        
                                    </textarea>
                                    <!--<input type="text" class="form-control" value="<?php echo $ProfileData['email']; ?>" name="address" id="address" placeholder="Enter Address" required="">-->
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6"></div>
                            </div>
                        </div>

                        <hr/>
                    
                    </form>
                </div>
                <!-- train section -->
                <div class="bhoechie-tab-content">
                    <form name="form_profile_pic" id="form_profile_pic" action="myaccount" enctype="multipart/form-data" >
                        <div class="col-lg-12"><h4><b>Change your profile picture, or import your current</b></h4></div>
                        <div class="col-lg-12"><hr/></div>
                      
                    </form>
                </div>

                <!-- hotel search -->
                <div class="bhoechie-tab-content">
                    <form name="form_profile_resident" id="form_profile_resident" action="myaccount">
                      
                        <div class="col-lg-6 col-sm-12">
                            <h4>Weeks Starts With</h4>
                            <p>Which day of the week does your week start with? This will determine the start day in activities such as Scheduling and calendar selection.</p>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <!--<label class="control-labelcol-sm-12 col-lg-12" for="address">Address:</label>-->
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <input type="text" class="form-control" value="<?php echo $ProfileData['city']; ?>" name="city" id="email" placeholder="Enter city" required="">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div style="clear: both; padding: 5px 0px;"><hr/></div>

                        <div class="col-lg-6 col-sm-12">
                            <h4>Location Open Time</h4>
                            <p>Please specify the time your location opens.</p>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <input type="text" class="form-control" value="<?php echo $ProfileData['city']; ?>" name="city" id="email" placeholder="Enter city" required="">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div style="clear: both; padding: 5px 0px;"><hr/></div>
                        <div class="col-lg-6 col-sm-12">
                            <h4>Location Close Time</h4>
                            <p>
                                Please specify the time your location closes.
                            </p>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                             <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <input type="text" class="form-control" value="<?php echo $ProfileData['city']; ?>" name="city" id="email" placeholder="Enter city" required="">
                                    </div>

                                </div>
                            </div>
                        </div>
                      <div style="clear: both; padding: 5px 0px;"><hr/></div>
                        <div class="col-lg-6 col-sm-12">
                            <h4>Default Shift Duration(hours)</h4>
                            <p>
                            Default shift length when creating a shift in Rostering.
                            </p>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                             <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <input type="text" class="form-control" value="<?php echo $ProfileData['city']; ?>" name="city" id="email" placeholder="Enter city" required="">
                                    </div>

                                </div>
                            </div>
                        </div>
                      <div style="clear: both; padding: 5px 0px;"><hr/></div>
                        <div class="col-lg-6 col-sm-12">
                            <h4>Default Meal Break Duration(minutes)</h4>
                            <p>
                           Default meal break length for shifts that get created in Rostering.
                            </p>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                             <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <input type="text" class="form-control" value="<?php echo $ProfileData['city']; ?>" name="city" id="email" placeholder="Enter city" required="">
                                    </div>

                                </div>
                            </div>
                        </div>
                      <div style="clear: both; padding: 5px 0px;"><hr/></div>
                        <div class="col-lg-6 col-sm-12">
                            <h4>Apply and Report On-Costs</h4>
                            <p>
                           Enter a number to add an on-cost percentage to all wage and salary costs shown on the Schedule screen (including Daily, Weekly and Monthly Stats) and on the Schedule vs Timesheets vs Sales report. For example, if you enter 10 here, an additional 10% will be added to wage and salary costs. This feature is added to allow you to factor 'on-cost' expenses such as insurances and superannuation (401K) into your schedule costs and wages vs sales calculations. The additional percentage will not be applied to pay rates or exported payroll data.
                            </p>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                             <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <input type="text" class="form-control" value="<?php echo $ProfileData['city']; ?>" name="city" id="email" placeholder="Enter city" required="">
                                    </div>

                                </div>
                            </div>
                        </div>
                      <div style="clear: both; padding: 5px 0px;"><hr/></div>
                        <div class="col-lg-6 col-sm-12">
                            <h4>Prevent Modification</h4>
                            <p>
                          System will prevent any changes to an unworked rostered shift.
                            </p>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                             <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <input type="text" class="form-control" value="<?php echo $ProfileData['city']; ?>" name="city" id="email" placeholder="Enter city" required="">
                                    </div>

                                </div>
                            </div>
                        </div>
                      <div style="clear: both; padding: 5px 0px;"><hr/></div>
                        <div class="col-lg-6 col-sm-12">
                            <h4>Shift Notification</h4>
                            <p>
                          Select who should receive Shift notifications such as Late employee notifications & Shift Swap approvals.
                            </p>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                             <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <input type="text" class="form-control" value="<?php echo $ProfileData['city']; ?>" name="city" id="email" placeholder="Enter city" required="">
                                    </div>

                                </div>
                            </div>
                        </div>
                      <div style="clear: both; padding: 5px 0px;"><hr/></div>
                        
                    </form>
                </div>
                <div class="bhoechie-tab-content">
                    <form name="form_profile_emergency" id="form_profile_emergency" action="myaccount">
                       
                    </form>
                </div>
                <div class="bhoechie-tab-content">
                    <div class="form-group">
                        <div class="input-group">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--    </div>
        </div>-->
    </div>
</div>

<div class="modal fadeInUp center "  id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title center_bold" id="myModalLabel2">Reset Your Password</h4>
            </div>

            <div class="modal-body" >
                <div class="panel" >
                    <div class="panel-body" >


                        <div class="col-xs-12 col-lg-12 col-sm-12 padding-none">
                            <div class="form-group">
                                <label>Old Password</label>
                                <input class="form-control " id="start_time" name="start_time" type="text" value="" required>
                                <span id="error_start_time" style="color:red;"></span>
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-12 col-sm-12 padding-none">
                            <div class="form-group">
                                <label>New Password</label>
                                <input class="form-control " id="end_time" name="end_time" type="text" value="<?php echo $endvalue; ?>" required>
                                <span id="error_end_time" style="color:red;"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-lg-12 col-sm-12 padding-none">
                            <div class="form-group">
                                <label>Confirm New Password</label>
                                <input class="form-control" type="text" value="" id="break_time" name="break_time" required> 

                            </div>
                        </div>

                        <div id="error_msg" style="display: block;color: red;"></div> 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-12">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="button" onclick="Add_End_Shift();">Save Change</button>
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