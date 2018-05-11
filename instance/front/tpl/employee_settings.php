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
    .on-break-tab{
        /*        border-radius: 50%;
                height: 29px;
                width: 46px;
                background-color: #e9e9e9;
                font-weight: bold;
                font-size: 17px;
                margin-top: 4px;*/
        cursor: pointer;
        /*border: 2px dashed transparent;*/
        border-radius: 50%;
        display: inline-block;
        position: relative;
        height: 35px;
        width: 35px;font-weight: bold;
        background-color: #e9e9e9;
        font-size: 12px;
        line-height: 35px;
    }
</style>
<style>
    p{
        color: #888;
    }

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
                <h2 style="font-weight: bold;">Settings</h2>

            </div>

            <div class="col-lg-10 col-sm-12 ">
                <hr>
            </div>
            <!--            <div class="col-lg-2 col-sm-12">
                            <div class="dropdown float-right" style="width: 100%;">
                                <a class="btn btn-default btn-link" href="<?php l('location') ?>"> <i class="glyphicon glyphicon-arrow-left"></i>Back</a>
            
                            </div>
                        </div>-->
        </div>
<!--        <div> <a class="btn btn-default btn-link" href="<?php l('profile') ?>"> <i class="glyphicon glyphicon-arrow-left"></i>Back to My Account</a></div>
<br/>
<div style="margin: 1rem;border-bottom: 1px solid #ddd;"><span style="font-size: 18px;font-weight: bolder;">Edit Profile</span> </div>-->

        <!--<div class="container">
            <div class="row">-->

        <!--        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 "> <div class="col-sm-12 " ><label> Settings apply on:</label></div></div>
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 ">
                        <label> Select to apply for Settngs:</label><select>
                        <div class="col-sm-4 " >
                            <select class=" form-control chosen-select" name="selectType" id="selectType">
                                <option value="*">All</option>
                                <option value="Admin">Admin</option>
                                <option value="Employee">Employee</option>
                                <option value="Location_Manager">Location Manager</option>
                                <option value="Supervisor">Supervisor</option>
        
        
                            </select>                   
                        </div>
        <?php
        $emp = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'" . $lastQuery . $whereRelatedEmployee);
        ?>
                        <div class="col-sm-8 "  >
        
                        </div>
                    </div>
                    <div style="clear: both;"></div>
        
        
                </div>-->
        <!--<div style="clear: both;height: 20px;"></div>-->
        <!--<div class="panel-body" style="margin: 0px;padding: 0px;" id="RefreshDiv">-->
        <?php if (strtolower($_SESSION['user']['access_level']) == 'admin') { ?>
            <div class="panel-body">
                <div class="col-lg-4 col-sm-4">
                    <li class="dropdown" style="width: 90%;">
                        <a id="Bulk_li" href="#" style="width: 90%;" data-toggle="dropdown" class="btn btn-info dropdown-toggle disabled" aria-expanded="false" onclick="bindModal()"><span style="color: brown"><b>Apply Rules</b></span></a><span style="margin-left: 10px;display: block;" id="select_person"></span>
                    </li>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 "> <div class="col-sm-12 " ><label > Settings apply on:</label></div></div>
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 ">
                        <select class=" form-control chosen-select" name="selectType" id="selectType">
                            <option value="*">All</option>
                            <option value="Admin">Admin</option>
                            <option value="Employee">Employee</option>
                            <option value="Location_Manager">Location Manager</option>
                            <option value="Supervisor">Supervisor</option>
                        </select>                   
                    </div>
                </div>
            </div>
        <?php } ?>
        <!--<div class="panel-body" id="testing">-->
        <input type="hidden" id="bulk_select_id" name="bulk_select_id" />
        <input type="hidden" id="bulk_select_id_count" name="bulk_select_id_count" />
        <div class="" id="RefreshTableData">

            <?php
//d($lastQuery);
            $PostResult = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'" . $lastQuery . $whereRelatedEmployee);
            ?>
            <table class="table table-striped responsive no-wrap" id="empTables">
                <thead>
                    <tr>
                        <?php if (strtolower($_SESSION['user']['access_level']) == 'admin') { ?>
                            <th style="width:15px;">
                    <div class="checkbox-info " style="height: 15px;">
                        <label>
                            <input type="checkbox" class="custom-checkbox selectall " id="all" >
                        </label>
                    </div>
                    </th>
                <?php } ?>
                <th style="">Name & Access</th>
                <th id="tbl_1" class="tb-none tb-th">Overtime</th>
                <th id="tbl_3" class="tb-none tb-th" style="">Tolerance Time</th>
                <th id="tbl_4" class="tb-none tb-th">Day Off</th>
                <th id="tbl_5" class="tb-none tb-th">Lunch Break</th>
                </tr>
                </thead>
                <tbody>
                    <?php if (empty($PostResult)) { ?>
                        <tr><td colspan="11"><?php echo "No Record Found!!!!!"; ?></td></tr>
                        <?php
                    } else {
                        foreach ($PostResult as $PostRow) {
                            ?>
                            <tr>
                                <?php if (strtolower($_SESSION['user']['access_level']) == 'admin') { ?>
                                <td style="width:15px">
                                    <div class="checkbox-info" style="height: 15px;">
                                        <label>
                                            <input type="checkbox" name="nchild[]" class="custom-checkbox child " value="<?php echo $PostRow['id']; ?>" id="<?php echo $PostRow['id']; ?>">
                                        </label>
                                    </div>
                                </td>
                                <?php } ?>   
                                <td style="" class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>">
                                    <!--<div class="row">-->
                                    <div class="col-xs-3 col-sm-3 col-md-3 on-break-tab"><?php echo substr(ucfirst($PostRow['fname']), 0, 1) . '' . substr(ucfirst($PostRow['lname']), 0, 1) ?></div>
                                    <div class="col-xs-9 col-sm-9 col-md-9">
                                        <div style=""><b style="color: #1b92da;"><?php echo ucfirst($PostRow['fname']) . ' ' . ucfirst($PostRow['lname']) ?></b></div>
                                        <div><a class="m-team-supportingLink" href="#" title="" style="font-size: 12px"><?php
                                                if ($PostRow['access_level'] == "Location_Manager") {
                                                    $access_level = "Location Manager";
                                                } else if ($PostRow['access_level'] == "System_Administrator") {
                                                    $access_level = "System Administrator";
                                                } else {

                                                    $access_level = $PostRow['access_level'];
                                                }
                                                echo $access_level;
                                                ?></a></div>
                                    </div>
                                    <!--</div>--> 
                                </td>
                                <?php
                                $emprules = qs("select * from tb_employee_settings where emp_id='{$PostRow['id']}' AND company_id = '{$_SESSION['company']['id']}' ORDER BY id DESC LIMIT 0,1");
                                ?>
                                <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>" >
                                    <span style="display: block">Before: <?php echo $emprules['before_time']; ?></span>
                                    <span style="display: block">After: <?php echo $emprules['after_time']; ?></span>
                                    <span style="display: block">Holidays: <?php echo $emprules['holiday_time']; ?></span>

                                </td>
                                <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>">
                                    <span style="display: block">Late: <?php echo $emprules['tolrance_timeIn']; ?></span>
                                    <span style="display: block">Early: <?php echo $emprules['tolrance_timeOut']; ?></span>
                                    <span style="display: block">Penalize: <?php echo $emprules['penalize']; ?></span>
                                </td>
                                <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>" >
                                    <span style="display: block">Paid Days: <?php echo $emprules['paidDayOff']; ?></span>
                                    <span style="display: block">Vacation Days: <?php echo $emprules['vacationDay']; ?></span>
                                    <span style="display: block">Sick Days: <?php echo $emprules['sick_day']; ?></span>
                                </td>
                                <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>">
                                    <span style="display: block">Counted: <?php echo ucfirst(strtolower($emprules['lunch_time_counted'])); ?></span>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>
        <!--</div>-->
        <!--</div>-->

        <!--    </div>
        </div>-->
    </div>
</div>

<?php if (strtolower($_SESSION['user']['access_level']) == 'admin') { ?>
<div class="modal fadeInUp center "  id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document" style="width: 80%">


        <div class="modal-body" >
            <input type="hidden" name="select_id" id="select_id" value="">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
                    <div class="list-group">
                        <a href="#" class="list-group-item active text-left">
                            <h4 class="glyphicon "></h4><br/><b>OverTime</b>
                        </a>
                        <a href="#" class="list-group-item text-left">
                            <h4 class="glyphicon "></h4><br/><b>Late/Early Departure</b>
                        </a>
                        <a href="#" class="list-group-item text-left">
                            <h4 class="glyphicon "></h4><br/><b>Day Off</b>
                        </a>
                        <a href="#" class="list-group-item text-left">
                            <h4 class="glyphicon "></h4><br/><b>Lunch Break</b>
                        </a>
                        <a href="#" class="list-group-item text-left">
                            <h4 class="glyphicon "></h4><br/><b>Time Limit (Abandon)</b>
                        </a>
                        <!--                    <a href="#" class="list-group-item text-left">
                                                <h4 class="glyphicon "></h4><br/><b>Timesheets</b>
                                            </a>
                                            <a href="#" class="list-group-item text-left">
                                                <h4 class="glyphicon "></h4><br/><b>Payroll</b>
                                            </a>-->
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                    <!-- flight section -->
                    <div class="bhoechie-tab-content active">
                        <form name="form_profile" id="form_profile" action">
                              <!--                        <h4 class="title-hero ">Regular</h4>-->
                              <div class="panel">
                                <div class="panel-body">
                                    <div id="exTab3" class="">	
                                        <ul  class="nav nav-pills">
                                            <li class="active">
                                                <a  href="#1b" data-toggle="tab">Regular</a>
                                            </li>
                                            <li><a href="#2b" data-toggle="tab">Holiday</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content clearfix">
                                            <div class="tab-pane active" id="1b">
                                                <div class="col-lg-12" >
                                                    <div class="col-lg-6" >
                                                        <label class="control-label " for="r_clockOut">Overtime allowed:</label>
                                                    </div> 
                                                    <div class="col-lg-6" >
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <!--<label for="" class="col-sm-4 control-label " >Gender</label>-->
                                                                <div class="col-sm-8">
                                                                    <label class="radio-inline float-left">
                                                                        <input type="radio" id="rbtOTYes" name="OT" value="Yes" class="rbtOT">
                                                                        Yes &nbsp;&nbsp;&nbsp;
                                                                    </label>
                                                                    <label class="radio-inline float-left">
                                                                        <input type="radio" id="rbtOTNo" name="OT" value="No" class="rbtOT">
                                                                        No&nbsp;&nbsp;&nbsp;
                                                                    </label>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 hidediv" id="OTdiv" style="display: none;">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class=" col-sm-12 col-lg-6">
                                                                <label class="control-label" for="r_clockIn">Before Shift allowed to clock In :</label>
                                                                <p>User defined allowance
                                                                    of time employee is
                                                                    allowed to clock in early
                                                                    (and get paid for it)</p>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-6">
                                                                <input type="text" class="form-control" value="" name="r_clockIn" id="r_clockIn" placeholder="Clock In Time Allow" required="">
                                                            </div>
                                                            <!--                                                    <div class="col-sm-12 col-md-12 col-lg-6"></div>-->
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="col-sm-12 col-lg-6">
                                                                <label class="control-label " for="r_clockOut">After Shift allowed to clock Out :</label>
                                                                <p>User defined allowance
                                                                    of time employee is
                                                                    allowed to clock out
                                                                    after shift (and get paid
                                                                    for it)</p>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-6">
                                                                <input type="text" class="form-control" value="" name="r_clockOut" id="r_clockOut" placeholder="Clock Out Time Allow" required="">
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-6"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 " style="float: right;">
                                                    <a class="btn btn-primary" href="#" onclick="shiftAllowClock()">Save</a>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="2b">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="col-sm-12 col-lg-6">
                                                            <label class="control-label" for="h_time">Work On Holiday Time :</label>
                                                            <p>User defined allowance of time employee is allowed to work on a holiday (and get paid for it)</p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                            <input type="text" class="form-control" value="" name="h_time" id="h_time" placeholder="Holiday Time Allow To work" required="">
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-6"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <a class="btn btn-primary" href="#" onclick="workAllowHoliday()">Save</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--                        <div class="form-group">
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
                                                                <input type="text" class="form-control" value="<?php echo $ProfileData['lname']; ?>" name="locWeekStart" id="locWeekStart" placeholder="e.g Street, City, Country" required="">
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
                                                                <input type="text" class="form-control" value="<?php echo $ProfileData['email']; ?>" name="address" id="address" placeholder="Enter Address" required="">
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-6"></div>
                                                        </div>
                                                    </div>-->
                            <hr/>
                        </form>
                    </div>
                    <!-- train section -->
                    <div class="bhoechie-tab-content">
                        <form name="form_profile_pic" id="form_profile_pic" action" enctype="multipart/form-data" >
                              <div class="panel">
                                <div class="panel-body">
                                    <div id="exTab1" class="">	
                                        <ul  class="nav nav-pills">
                                            <li class="active">
                                                <a  href="#s1" data-toggle="tab">Schedule Start Time</a>
                                            </li>
                                            <li><a href="#s2" data-toggle="tab">Schedule End Time</a>
                                            </li>
                                            <li><a href="#s3" data-toggle="tab">Penalize X</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content clearfix">
                                            <div class="tab-pane active" id="s1">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="col-lg-6 col-sm-12">
                                                            <label class="control-label " for="r_clockIn">Tolerance of time allowed to clock In Late :</label>
                                                            <p>User defined tolerance
                                                                of time employee is
                                                                allowed to clock in late
                                                                <br/>i.e 10 mins</p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <!--<label for="" class="col-sm-4 control-label " >Gender</label>-->
                                                                    <div class="col-sm-8">
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rbtTlYes" name="TL" value="Yes" class="rbtTL">
                                                                            Yes &nbsp;&nbsp;&nbsp;
                                                                        </label>
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rbtTlNo" name="TL" value="No" class="rbtTL">
                                                                            No&nbsp;&nbsp;&nbsp;
                                                                        </label>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 hidediv" style="display: none;" id="TLDiv">
                                                                <input type="text" class="form-control" value="" name="t_clockIn" id="t_clockIn" placeholder="Clock In Time Allow" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-6"></div>
                                                        <div class="col-sm-12 col-md-12 col-lg-6"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 " style="float: right;">
                                                    <a class="btn btn-primary" href="#" onclick="toleranceAllowIn()">Save</a>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="s2">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="col-sm-12 col-lg-6">

                                                            <label class="control-label " for="r_clockOut">Tolerance of time allowed to clock Out Late :</label>
                                                            <p>User defined tolerance
                                                                of time employee is
                                                                allowed to clock out<br/>
                                                                i.e 10 mins
                                                            </p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <!--<label for="" class="col-sm-4 control-label " >Gender</label>-->
                                                                    <div class="col-sm-8">
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rbtTeYes" name="TE" value="Yes" class="rbtTE">
                                                                            Yes &nbsp;&nbsp;&nbsp;
                                                                        </label>
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rbtTeNo" name="TE" value="No" class="rbtTE">
                                                                            No&nbsp;&nbsp;&nbsp;
                                                                        </label>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 hidediv" style="display: none;" id="TEDiv">
                                                                <input type="text" class="form-control" value="" name="t_clockOut" id="t_clockOut" placeholder="Clock Out Time Allow" required="">
                                                            </div>
                                                        </div>
                                                        <!--<div class="col-sm-12 col-md-12 col-lg-6"></div>-->
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 " style="float: right;">
                                                    <a class="btn btn-primary" href="#" onclick="toleranceAllowOut()">Save</a>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="s3">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="col-sm-12 col-lg-6">

                                                            <label class="control-label " for="r_clockOut">Out of Tolerance time penalize By:</label>
                                                            <p>User defined penalize multiply by out of tolerance
                                                                time<br/>
                                                                i.e 5 Minute late 5*2
                                                            </p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <!--<label for="" class="col-sm-4 control-label " >Gender</label>-->
                                                                    <div class="col-sm-8">
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rbtPnYes" name="PN" value="Yes" class="rbtPN">
                                                                            Yes &nbsp;&nbsp;&nbsp;
                                                                        </label>
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rbtPnNo" name="PN" value="No" class="rbtPN">
                                                                            No&nbsp;&nbsp;&nbsp;
                                                                        </label>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 hidediv" style="display: none;" id="PNDiv">
                                                                <input type="text" class="form-control" value="" name="t_penalize" id="t_penalize" placeholder="Penalize:2* or 3* " required="">
                                                            </div>
                                                        </div>
                                                        <!--<div class="col-sm-12 col-md-12 col-lg-6"></div>-->
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 " style="float: right;">
                                                    <a class="btn btn-primary" href="#" onclick="tolerancePenalize()">Save</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                    <!-- hotel search -->
                    <div class="bhoechie-tab-content">
                        <form name="form_profile_resident" id="form_profile_resident" action>
                            <div class="panel">
                                <div class="panel-body">
                                    <div id="exTab2" class="">	
                                        <ul  class="nav nav-pills">
                                            <li class="active">
                                                <a  href="#d1" data-toggle="tab">Paid Day Off</a>
                                            </li>
                                            <li><a href="#d2" data-toggle="tab">Vacation During Holidays</a>
                                            </li>
                                            <li><a href="#d3" data-toggle="tab">Sick Time</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content clearfix">
                                            <div class="tab-pane active" id="d1">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="col-sm-12 col-lg-6">
                                                            <label class="control-label " for="r_clockIn">Allowed to Paid day Off :</label>
                                                            <p>Company level option / exception: negative balance (vacation days)<br/>
                                                                i.e user has 6 days vacation but manager approved 8 days off,
                                                                the 2 days will be deducted in the coming month</p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-6">

                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <input type="text" class="form-control" value="" name="paidDayOff" id="paidDayOff" placeholder="" required="">
                                                            </div>
                                                            <div class="" style="height: 50px;"></div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <div class="checkbox-primary" style="height: 15px;">
                                                                    <label>
                                                                        <input type="checkbox" class="custom-checkbox " id="paidDay_Roll" >
                                                                        Roll over remaining leave balance
                                                                    </label>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-6">


                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 " style="float: right;">
                                                    <a class="btn btn-primary" href="#" onclick="allowPadiDayOff()">Save</a>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="d2">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="col-lg-6 col-sm-12">
                                                            <label class="control-label " for="r_clockOut">Vacation falls during holidays:</label>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <input type="text" class="form-control" value="" name="vacationFalls" id="vacationFalls" placeholder="" required="">
                                                            </div>
                                                            <div class="" style="height: 50px;"></div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <div class="checkbox-primary" style="height: 15px;">
                                                                    <label>
                                                                        <input type="checkbox" class="custom-checkbox " id="vacationDay_Roll" value="" >
                                                                        Roll over remaining leave balance
                                                                    </label>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-6"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 " style="float: right;">
                                                    <a class="btn btn-primary" href="#" onclick="allowvacationFalls()">Save</a>
                                                </div>
                                            </div>
                                            <div class="tab-pane " id="d3">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="col-lg-6 col-sm-12">
                                                            <label class="control-label " for="sickDate">allowed to use sick time day off :</label>
                                                            <p>User defined days that
                                                                employee is allowed to
                                                                use sick time day off,
                                                                documented (with Doctor
                                                                note)</p>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <input type="text" class="form-control" value="" name="sickDate" id="sickDate" placeholder="Sick Time Allow" required="">
                                                            </div>
                                                            <div class="" style="height: 50px;"></div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <div class="checkbox-primary" style="height: 15px;">
                                                                    <label>
                                                                        <input type="checkbox" class="custom-checkbox " id="sickDay_Roll" value="" >
                                                                        Roll over remaining leave balance
                                                                    </label>
                                                                </div> 
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-6"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 " style="float: right;">
                                                    <a class="btn btn-primary" href="#" onclick="allowsickDate()">Save</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="clear: both; padding: 5px 0px;"><hr/></div>

                        </form>
                    </div>
                    <div class="bhoechie-tab-content">
                        <form name="form_lunch_break" id="form_lunch_break" action>
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="col-lg-6 col-sm-12">
                                                <label class="control-label " for="sickDate">allowed Lunch Break To add:</label>
                                                <p>The
                                                    employee is allowed to
                                                    counted Lunch break in Total time</p>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6">


                                                <div class="col-lg-12" >
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <!--<label for="" class="col-sm-4 control-label " >Gender</label>-->
                                                            <div class="col-sm-8">
                                                                <label class="radio-inline float-left">
                                                                    <input type="radio" id="LunchToAdd" name="LunchTo" value="yes" class="LunchTo">
                                                                    Yes &nbsp;&nbsp;&nbsp;
                                                                </label>
                                                                <label class="radio-inline float-left">
                                                                    <input type="radio" id="LunchToNotAdd" name="LunchTo" value="no" class="LunchTo">
                                                                    No&nbsp;&nbsp;&nbsp;
                                                                </label>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <span id="error_lunch" style="color:red;"></span>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 " style="float: right;">
                                        <a class="btn btn-primary" href="#" onclick="allowsLunchBreak()">Save</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="bhoechie-tab-content">
                        <div class="form-group">
                            <div class="input-group">
                                <form >
                                    <div class="panel">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="col-lg-4 col-sm-12">
                                                        <label class="control-label " >Allow Abandon Time Limit:</label>
                                                        <p>The time limit for the job abandon. </p>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-6">


                                                        <div class="col-lg-12" >
                                                            <div class="form-group">
                                                                <div class="input-group">

                                                                    <div class="col-sm-8">
                                                                        <label class="radio-inline float-left">

                                                                            <input class="form-control" type="text" id="time_limit_abandon" name="time_limit_abandon"  value="<?php print $settings_data['time_limit_time_stamp_abandon'] ?>"   />
                                                                            <div class="help-text">Add 0 for no limit</div>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <span id="error_lunch" style="color:red;"></span>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-6"></div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 " style="float: right;">
                                                <a class="btn btn-primary" href="#" onclick="saveAbandonTime()">Save</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- modal-content -->
</div><!-- modal-dialog -->
<?php } ?>  

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

