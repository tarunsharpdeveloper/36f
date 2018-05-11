<style>
    .btnNext
    {
        float: right;margin:  1rem;
    }
    .prev_image{
        height: 30px;
        width: 30px;
        background-position: center center;
        background-size: cover;
        display: none;
        border: blanchedalmond groove thin;
        box-shadow: gray 5px 5px 5px,   #000 0px 0px 1px,   #000 0px 0px 1px,
            #000 0px 0px 1px,   #000 0px 0px 1px,   #000 0px 0px 1px;
    }
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
//            alert($(this).index());
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
        });
//        $(".btnNext").click(function (e) {
//            e.preventDefault();
//            alert($(this).index());
//            $(this).siblings('a.active').removeClass("active");
//            $(this).addClass("active");
//            var index = $(this).index();
//            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
//            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index + 1).addClass("active");
//            $("div.bhoechie-tab-menu>div.list-group>a").removeClass("active");
//            $("div.bhoechie-tab-menu>div.list-group>a").eq(index + 1).addClass("active");
//        });
//        $(".btnPre").click(function (e) {
//            e.preventDefault();
//            alert($(this).index());
//            $(this).siblings('a.active').removeClass("active");
//            $(this).addClass("active");
//            var index = $(this).index();
//            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
//            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
//            $("div.bhoechie-tab-menu>div.list-group>a").removeClass("active");
//            $("div.bhoechie-tab-menu>div.list-group>a").eq(index).addClass("active");
//        });
    });
    function btnNext(e) {
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab-menu>div.list-group>a").removeClass("active");
        $("#mt_" + e).addClass("active");
        $("#t_" + e).addClass("active");
    }
</script>
<div class="panel">
    <div class="panel-body">
        <div> <a class="btn btn-default btn-link" href="<?php l('people') ?>"> <i class="glyphicon glyphicon-arrow-left"></i>Back</a></div>
        <br/>
        <div style="margin: 1rem;border-bottom: 1px solid #ddd;"><span style="font-size: 18px;font-weight: bolder;">Add New People</span> </div>

        <!--<div class="container">
            <div class="row">-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
            <form action="add_people" method="POST" data-parsley-validate enctype="multipart/form-data">

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
                    <div class="list-group">
                        <a href="#" class="list-group-item active text-left" id="mt_1">
                            <h4 class="glyphicon "></h4><br/><b>Profile</b>
                        </a>
                        <a href="#" class="list-group-item text-left" id="mt_2">
                            <h4 class="glyphicon "></h4><br/><b>Job Information</b>
                        </a>
                        <a href="#" class="list-group-item text-left " id="mt_3">
                            <h4 class="glyphicon "></h4><br/><b>Contact Details</b>
                        </a>
                        <a href="#" class="list-group-item text-left" id="mt_4">
                            <h4 class="glyphicon "></h4><br/><b>Employee Status</b>
                        </a>
                        <a href="#" class="list-group-item text-left" id="mt_5">
                            <h4 class="glyphicon "></h4><br/><b>Upload Documents</b>
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                    <!-- flight section -->
                    <div class="bhoechie-tab-content active" id="t_1">
                        <!--<form name="form_profile" id="form_profile" action="myaccount">-->
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >First Name</label>
                                    <div class="col-sm-12">
                                        <input id="fname" type="text" name="fname" class="form-control form-radius"  placeholder="" required />
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >Last Name</label>
                                    <div class="col-sm-12">
                                        <input id="lname" type="text" name="lname" class="form-control form-radius"  placeholder="" required />
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >Email</label>
                                    <div class="col-sm-12">
                                        <input id="email" type="email" name="email" class="form-control form-radius"  placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >Mobile</label>
                                    <div class="col-sm-12">
                                        <input id="mobile" data-parsley-type="digits" type="text" name="mobile" class="form-control form-radius"  placeholder="" data-inputmask="'mask': '99999999999'" maxlength="11" pattern="/^[09]{1}[0-9]{10}$/" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <h5 class="m-sideReveal-profileEditHeader gray">OTHER</h5><br>
                        <div class="col-sm-12  col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label " >Gender</label>
                                    <div class="col-sm-8">
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="rbtmale" name="gender" value="Male" class="rbtgender">
                                            Male &nbsp;&nbsp;&nbsp;
                                        </label>
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="rbtfemale" name="gender" value="Female" class="rbtgender">
                                            Female&nbsp;&nbsp;&nbsp;
                                        </label>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12  col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label " >Marital status</label>
                                    <div class="col-sm-8">
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="" name="marital" value="Single">
                                            Single&nbsp;&nbsp;&nbsp;
                                        </label>
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="" name="marital" value="Married">
                                            Married&nbsp;&nbsp;&nbsp;
                                        </label>

                                        <label class="radio-inline float-left">
                                            <input type="radio" id="" name="marital" value="Divorced">
                                            Divorced&nbsp;&nbsp;&nbsp;
                                        </label>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 " style="display: none;" id="militryDiv">
                            <div class="form-group">
                                <div class="input-group">
                                    <label class="col-sm-12 control-label ">Military Status</label>
                                    <div class="col-sm-12">
                                        <select name="militay_status" id="militay_status" class="browser-default chosen-select form-control" style="width:100%" >
                                            <option selected value="">Choose Status</option>
                                            <option value="Complited">Completed</option>
                                            <option value="Purchaseds">Purchased</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >ID Number</label>
                                    <div class="col-sm-12">
                                        <input id="idno" type="text" name="idno" class="form-control form-radius"  placeholder="" />
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >Employee Number</label>
                                    <div class="col-sm-12">
                                        <input id="empno" type="text" name="empno" class="form-control form-radius"  placeholder="" />
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >Date of Birth</label>
                                    <div class="col-sm-12">
                                        <div class="input-prepend input-group">
                                            <span class="add-on input-group-addon">
                                                <i class="glyph-icon icon-calendar"></i>
                                            </span>
                                            <input type="text" id="d_o_b" name="d_o_b" class="bootstrap-datepicker form-control" placeholder="02/16/12" value="" data-date-format="mm/dd/yy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >Birth Certificate Number</label>
                                    <div class="col-sm-12">
                                        <input id="bodno" type="text" name="bodno" class="form-control form-radius"  placeholder="" />
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >Hired on</label>
                                    <div class="col-sm-12">
                                        <div class="input-prepend input-group">
                                            <span class="add-on input-group-addon">
                                                <i class="glyph-icon icon-calendar"></i>
                                            </span>
                                            <input type="text" id="hired_on" name="hired_on" class="bootstrap-datepicker form-control" placeholder="02/16/12" value="" data-date-format="mm/dd/yy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >Terminate Date</label>
                                    <div class="col-sm-12">
                                        <div class="input-prepend input-group">
                                            <span class="add-on input-group-addon">
                                                <i class="glyph-icon icon-calendar"></i>
                                            </span>
                                            <input type="text" id="terminate_on" name="terminate_on" class="bootstrap-datepicker form-control" placeholder="02/16/12" value="" data-date-format="mm/dd/yy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="col-sm-12 col-lg-6 " style="">
                            <div class="form-group">
                                <div class="input-group">
                                    <label class="col-sm-12 control-label ">Last Degree</label>
                                    <div class="col-sm-12">
                                        <select name="last_degree" id="last_degree"  data-placeholder="Choose Degree" class="browser-default chosen-select form-control" style="width:100%" >

                                            <option value="doctorate">Doctorate</option>
                                            <option value="fogh lisons">Fogh lisons</option>
                                            <option value="lisons">Lisons</option>
                                            <option value="fogh diploma">Fogh Diploma</option>
                                            <option value="diploma">Diploma</option>

                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 " style="">
                            <div class="form-group">
                                <div class="input-group">
                                    <label class="col-sm-12 control-label ">Contract Type</label>
                                    <div class="col-sm-12">
                                        <select name="contract_type" id="contract_type" class="browser-default chosen-select form-control" style="width:100%" >
                                            <option selected value="">Choose Type</option>
                                            <option value="FullTime">Full Time</option>
                                            <option value="PartTime">Part Time</option>
                                            <option value="Seasonal">Seasonal</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 " style="">
                            <div class="form-group">
                                <div class="input-group">
                                    <label class="col-sm-12 control-label ">Section/Team work</label>
                                    <div class="col-sm-12">
                                        <select name="section_type[]" id="section_type" data-placeholder="Choose Section/Team Work" multiple class="browser-default chosen-select form-control" style="width:100%" >
                                            <?php
                                            foreach ($LocationWork as $value) {
                                                ?>
                                                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6 " style="">
                            <div class="form-group">
                                <div class="input-group">
                                    <label class="col-sm-12 control-label "> Work Shuttle</label>
                                    <div class="col-sm-12">
                                        <select name="work_shuttle[]" id="work_shuttle" data-placeholder="Choose Work Shuttle" multiple  class="browser-default chosen-select form-control" style="width:100%" >
                                            <?php
                                            foreach ($LocationWork as $value) {
                                                ?>
                                                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class=" col-lg-12">
                            <a class="btn btn-primary btnNext right-align" href="#" onclick="btnNext(2)" >Next</a>
                        </div>
                        <!--</form>-->
                    </div>
                    <!-- train section -->
                    <div class="bhoechie-tab-content" id="t_2">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label class="col-sm-12 control-label ">Access Level</label>
                                    <div class="col-sm-12">
                                        <select name="access_level" id="leave_type1" class="browser-default chosen-select form-control" style="width:100%" >
                                            <option selected value="Employee">Employee</option>
                                            <option value="Supervisor">Supervisor</option>
                                            <option value="Location_Manager">Location Manager</option>
                                            <option value="System_Administrator">System Administrator</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >Works at Location</label>
                                    <div class="col-sm-12">
                                        <select name="work_at_location[]"  id="work_at_location" multiple data-placeholder="Click to see available options..." class="chosen-select"  >
                                            <?php
                                            foreach ($LocationWork as $value) {
                                                ?>
                                                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--                            <div class="col-sm-12 col-lg-6">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <label for="" class="col-sm-12 control-label " >Stress Profile</label>
                                                                <div class="col-sm-12">
                                                                    <select name="stress_profile" id="stress_profile"  class="browser-default chosen-select form-control" style="padding-left: 10%;font-size: 16px;"  >
                        
                        <?php
                        foreach ($StreetProfile as $ProfileValue) {
                            ?>
                                                                                                                                                                                                        <option value="<?php echo $ProfileValue['id']; ?>"><?php echo $ProfileValue['name']; ?></option>
                        <?php } ?>                        <option value="gandhi">gandhi</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>-->
                        <!--                            <div class="col-sm-12 col-lg-6">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <label for="" class="col-sm-12 control-label " >Training</label>
                                                                <div class="col-sm-12">
                                                                    <select name="training[]"  id="training" multiple data-placeholder="Click to see available options..." class="chosen-select" >
                                                                                                                                <option  value="" disabled > Choose Work At</option>
                                                                        <option value="1">Whozoor.com Employee Training</option>
                                                                        <option value="2">Whozoor.com Manager Training</option>
                        
                                                                    </select>
                                                                    <input id="training" type="text" name="training" class="form-control form-radius"  placeholder=""/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>-->
                        <div style="clear: both;"></div>
                        <h5 class="m-sideReveal-profileEditHeader gray ">PAY RATES</h5><br>
                        <div class="col-sm-12 ">
                            <div class="form-group">
                                <div class="input-group">
                                    <label class="col-sm-4 control-label lbl-text-align">Pay Rates</label>
                                    <div class="col-sm-8">
                                        <select name="pay_rates" id="pay_rates" class="browser-default chosen-select form-control" style="width:100%" >
                                            <option selected value="Hourly">Hourly</option>
                                            <option value="Hourly_overtime">Hourly (40 h + 1.5 x Overtime)</option>
                                            <option value="Salary">Salary</option>
                                            <option value="Rate_per_day">Rates per day</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 hourly">
                            <div class="form-group">
                                <div class="input-group">
                                    <!--&#65020;//Its a Rial currency symbol-->
                                    <label for="" class="col-sm-4 control-label lbl-text-align" >Weekday Rate</label>
                                    <div class="col-sm-8">
                                        <input id="weekday_rate" data-parsley-type="digits" type="text" name="weekday_rate" class="form-control form-radius" maxlength="10"  placeholder="&#65020; / Rial"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 hourly">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label lbl-text-align" >Saturday Rate</label>
                                    <div class="col-sm-8">
                                        <input id="saturday_rate" data-parsley-type="digits" type="text" name="saturday_rate" class="form-control form-radius" maxlength="10"  placeholder="&#65020; / Rial"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 hourly">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label lbl-text-align" >Sunday Rate</label>
                                    <div class="col-sm-8">
                                        <input id="sunday_rate" data-parsley-type="digits" type="text" name="sunday_rate" class="form-control form-radius" maxlength="10"  placeholder="&#65020; / Rial"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 hourly">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label lbl-text-align" >Public Holiday Rate</label>
                                    <div class="col-sm-8">
                                        <input id="public_h_rate" data-parsley-type="digits" type="text" name="public_h_rate" class="form-control form-radius" maxlength="10"  placeholder="&#65020; / Rial"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 hourlyplus" style="display:none;">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label lbl-text-align" >Hourly Rate</label>
                                    <div class="col-sm-8">
                                        <input id="hourly_rate" data-parsley-type="digits" type="text" value="" name="hourly_rate" class="form-control form-radius" maxlength="10"  placeholder="&#65020; / Rial"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 hourlyplus" style="display:none;">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label lbl-text-align" >Overtime Rate</label>
                                    <div class="col-sm-8">
                                        <input id="overtime_rate" type="text"  value="" name="overtime_rate" class="form-control form-radius"  placeholder="&#65020; / Rial" readonly="" disabled="true"/>
                                        <span style="float: right;color: #5c597a;font-size: 12px;">* x1.50 Base Rate</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 annual" style="display:none;">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label lbl-text-align" >Monthly Salary</label>
                                    <div class="col-sm-8">
                                        <!--<input id="annual_salary" data-parsley-type="digits" type="text" name="annual_salary" class="form-control form-radius" maxlength="10"  placeholder=""/>-->
                                        <input id="monthly_salary" data-parsley-type="digits" type="text" name="monthly_salary" class="form-control form-radius" maxlength="10"  placeholder="&#65020; / Rial"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 days" style="display:none;">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label lbl-text-align" >Mondays</label>
                                    <div class="col-sm-8">
                                        <input id="day_m_rate" data-parsley-type="digits" type="text" name="day_m_rate" class="form-control form-radius" maxlength="10"  placeholder="&#65020; / Rial"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 days" style="display:none;">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label lbl-text-align" >Tuesdays</label>
                                    <div class="col-sm-8">
                                        <input id="day_t_rate" data-parsley-type="digits" type="text" name="day_t_rate" class="form-control form-radius" maxlength="10"  placeholder="&#65020; / Rial"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 days" style="display:none;">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label lbl-text-align" >Wednesdays</label>
                                    <div class="col-sm-8">
                                        <input id="day_w_rate" data-parsley-type="digits" type="text" name="day_w_rate" class="form-control form-radius" maxlength="10"  placeholder="&#65020; / Rial"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 days" style="display:none;">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label lbl-text-align" >Thursdays</label>
                                    <div class="col-sm-8">
                                        <input id="day_th_rate" data-parsley-type="digits" type="text" name="day_th_rate" class="form-control form-radius" maxlength="10"  placeholder="&#65020; / Rial"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 days" style="display:none;">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label lbl-text-align" >Fridays</label>
                                    <div class="col-sm-8">
                                        <input id="day_f_rate" data-parsley-type="digits" type="text" name="day_f_rate" class="form-control form-radius" maxlength="10"  placeholder="&#65020; / Rial"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 days" style="display:none;">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label lbl-text-align" >Saturdays</label>
                                    <div class="col-sm-8">
                                        <input id="day_sat_rate" data-parsley-type="digits" type="text" name="day_sat_rate" class="form-control form-radius" maxlength="10"  placeholder="&#65020; / Rial"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 days" style="display:none;">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label lbl-text-align" >Sundays</label>
                                    <div class="col-sm-8">
                                        <input id="day_sun_rate" data-parsley-type="digits" type="text" name="day_sun_rate" class="form-control form-radius" maxlength="10"   placeholder="&#65020; / Rial"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 days" style="display:none;">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label lbl-text-align" >Public Holidays</label>
                                    <div class="col-sm-8">
                                        <input id="day_holi_rate" data-parsley-type="digits" type="text" name="day_holi_rate" class="form-control form-radius" maxlength="10"  placeholder="&#65020; / Rial"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--                    <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <label for="" class="col-sm-4 control-label lbl-text-align" >Time Sheet Export Code</label>
                                                        <div class="col-sm-8">
                                                            <input id="time_s_e_code" type="text" name="time_s_e_code" class="form-control form-radius"  placeholder=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>-->
                        <div style="clear: both;"></div>
                        <div class=" col-lg-12">
                            <a class="btn btn-primary btnPre " href="#" style="float: left;" onclick="btnNext(1)">Previous</a>
                            <a class="btn btn-primary btnNext right-align" href="#" onclick="btnNext(3)">Next</a>
                        </div>
                    </div>

                    <!-- hotel search -->
                    <div class="bhoechie-tab-content" id="t_3">
                        <!--<form name="form_profile_resident" id="form_profile_resident" action="myaccount">-->
                        <h5 class="m-sideReveal-profileEditHeader gray">MAIN ADDRESS</h5><br>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >Address</label>
                                    <div class="col-sm-12">
                                        <textarea id="address"  name="address" class="form-control form-radius"  placeholder="" style="resize: none;height: 100px;"></textarea>
                                        <!--<input id="address" type="text" name="address" class="form-control form-radius"  placeholder=""/>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >Home Phone</label>
                                    <div class="col-sm-12">
                                        <input id="home_phone" type="text" name="home_phone" class="form-control form-radius"  placeholder=""  maxlength="11" pattern="/^[09]{1}[0-9]{10}$/" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >City</label>
                                    <div class="col-sm-12">
                                        <input id="city" type="text" name="city" class="form-control form-radius"  placeholder=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--                            <div class="col-sm-12 col-lg-6">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <label for="" class="col-sm-12 control-label " >Country</label>
                                                                <div class="col-sm-12">
                                                                    <input id="country" type="text" name="country" class="form-control form-radius"  placeholder=""/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>-->
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >Postcode</label>
                                    <div class="col-sm-12">
                                        <input id="postcode" data-parsley-type="digits" type="text" name="postcode" class="form-control form-radius"  placeholder=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <h5 class="m-sideReveal-profileEditHeader gray">EMERGENCY CONTACT</h5><br>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >Emergency Contact Name</label>
                                    <div class="col-sm-12">
                                        <input id="e_c_name" type="text" name="e_c_name" class="form-control form-radius"  placeholder=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >Emergency Phone</label>
                                    <div class="col-sm-12">
                                        <input id="e_phone" data-parsley-type="digits" type="text" name="e_phone" class="form-control form-radius"  placeholder=""  maxlength="11" pattern="/^[09]{1}[0-9]{10}$/" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-12 control-label " >Relation</label>
                                    <div class="col-sm-12">
                                        <input id="e_relation"  type="text" name="e_relation" class="form-control form-radius"  placeholder=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class=" col-lg-12">
                            <a class="btn btn-primary btnPre " href="#" style="float: left;" onclick="btnNext(2)">Previous</a>
                            <a class="btn btn-primary btnNext right-align" href="#" onclick="btnNext(4)">Next</a>
                        </div>
                        <!--</form>-->
                    </div>
                    <div class="bhoechie-tab-content" id="t_4">
                        <!--                    <form name="form_profile_emergency" id="form_profile_emergency" action="myaccount">-->
                        <div class="col-sm-12  col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label " >Employee status</label>
                                    <div class="col-sm-8 ">
                                        <label class="checkbox-inline float-left">
                                            <input type="checkbox" checked id="" name="empStatus" value="Normal">
                                            Normal&nbsp;&nbsp;
                                        </label>&nbsp;&nbsp;
                                        <label class="checkbox-inline float-left">
                                            <input type="checkbox" id="" name="empStatus" value="Veteran">
                                            Veteran&nbsp;&nbsp;
                                        </label>&nbsp;&nbsp;

                                        <label class="checkbox-inline float-left">
                                            <input type="checkbox" id="" name="empStatus" value="Pregnant">
                                            Pregnant&nbsp;&nbsp;
                                        </label>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12  col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label " >Late Tolerance</label>
                                    <div class="col-sm-8">
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="tolranceYes" name="tolrance" value="Yes" class="rbttolrance">
                                            Yes &nbsp;&nbsp;&nbsp;
                                        </label>
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="tolranceNo" name="tolrance" value="No" class="rbttolrance">
                                            No &nbsp;&nbsp;&nbsp;
                                        </label>
                                    </div>


                                </div>


                            </div>
                            <div class="form-group" id="tolrance_div" style="display: none;" >
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label " ></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12  col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label " >Pregnancy</label>
                                    <div class="col-sm-8">
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="pregnancyYes" name="pregnancy" value="Yes" class="rbtpregnancy">
                                            Yes &nbsp;&nbsp;&nbsp;
                                        </label>
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="pregnancyNo" name="pregnancy" value="No" class="rbtpregnancy">
                                            No &nbsp;&nbsp;&nbsp;
                                        </label>
                                    </div>


                                </div>
                            </div>
                            <div class="form-group" id="pregnancy_div" style="display: none;" >
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label " ></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="col-sm-12  col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label " >Veteran</label>
                                    <div class="col-sm-8">
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="veteranYes" name="veteran" value="Yes" class="rbtveteran">
                                            Yes &nbsp;&nbsp;&nbsp;
                                        </label>
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="veteranNo" name="veteran" value="No" class="rbtveteran">
                                            No &nbsp;&nbsp;&nbsp;
                                        </label>
                                    </div>


                                </div>
                            </div>
                            <div class="form-group" id="veteran_div" style="display: none;" >
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label " ></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12  col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label " >OT Permission</label>
                                    <div class="col-sm-8">
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="overtimeYes" name="overtime" value="Yes" class="rbtovertime">
                                            Yes &nbsp;&nbsp;&nbsp;
                                        </label>
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="overtimeNo" name="overtime" value="No" class="rbtovertime">
                                            No &nbsp;&nbsp;&nbsp;
                                        </label>
                                    </div>


                                </div>
                            </div>
                            <div class="form-group" id="overtime_div" style="display: none;" >
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label " ></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class=" col-lg-12">
                            <a class="btn btn-primary btnPre " href="#" style="float: left;" onclick="btnNext(3)">Previous</a>
                            <a class="btn btn-primary btnNext right-align" href="#" onclick="btnNext(5)">Next</a>
                        </div>
                        <!--</form>-->
                    </div>
                    <div class="bhoechie-tab-content" id="t_5">


                        <!--<form action="people_single_upload" method="POST" data-parsley-validate enctype="multipart/form-data">-->
<!--                        <input type="hidden" id="work_at_location" name="work_at_location" value="<?= $_REQUEST['work_at_location']; ?>">
                        <input type="hidden" id="email" name="email" value="<?= $_REQUEST['email']; ?>">
                        <input type="hidden" id="idno" name="idno" value="<?= $_REQUEST['idno']; ?>">-->
                        <div class="panel" >
                            <div class="panel-body" >

                                <section>
                                    <h5 class="m-sideReveal-profileEditHeader gray">UPLOAD Document</h5><br>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-12 control-label " >Upload Contract</label>
                                                <div class="col-sm-12 col-lg-10">
                                                    <input id="ContractImage"  type="file" name="ContractImage" class="form-control form-radius show_preview"  placeholder="select File"  data-prev_id="prev_1"/>
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <div id="prev_1" class="prev_image"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-12 control-label " >Military service</label>
                                                <div class="col-sm-12 col-lg-10">
                                                    <input id="military_service"  type="file" name="military_service" class="form-control form-radius show_preview"  placeholder="select File"  data-prev_id="prev_2"/>
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <div id="prev_2" class="prev_image"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-12 control-label " >Birth Certificate</label>
                                                <div class="col-sm-12 col-lg-10">
                                                    <input id="birth_cert"  type="file" name="birth_cert" class="form-control form-radius show_preview"  placeholder="select File"  data-prev_id="prev_3"/>
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <div id="prev_3" class="prev_image"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-12 control-label " >Identity Certificate</label>
                                                <div class="col-sm-12 col-lg-10">
                                                    <input id="idc"  type="file" name="idc" class="form-control form-radius show_preview"  placeholder="select File"  data-prev_id="prev_4"/>
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <div id="prev_4" class="prev_image"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-12 control-label " >Resident Proof</label>
                                                <div class="col-sm-12 col-lg-10">
                                                    <input id="idc"  type="file" name="idc" class="form-control form-radius show_preview"  placeholder="select File"  data-prev_id="prev_5"/>
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <div id="prev_5" class="prev_image"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-12 control-label " >Last degree Certificate</label>
                                                <div class="col-sm-12 col-lg-10">
                                                    <input id="ldc"  type="file" name="ldc" class="form-control form-radius show_preview"  placeholder="select File"  data-prev_id="prev_6"/>
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <div id="prev_6" class="prev_image"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-12 control-label " >Veteran</label>
                                                <div class="col-sm-12 col-lg-10">
                                                    <input id="veteran"  type="file" name="veteran" class="form-control form-radius show_preview"  placeholder="select File"  data-prev_id="prev_7"/>
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <div id="prev_7" class="prev_image"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="clear: both;"></div>
                                </section>


                            </div>
                        </div>

                        <div class="col-sm-12 text-right" >
                            <a class="btn btn-primary btnPre btnNext " href="#" style="float: left;" onclick="btnNext(4)">Previous</a>
                            <button class="btn btn-primary btnNext" type="submit">Save</button>
                            <input id="add_people_upload" type="hidden" name="add_people_upload" value="1"/>
                        </div> 

                        <!--</form>-->
                    </div>
                </div>
        </div>
        </form>

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
                                <input class="form-control " id="start_time" name="start_time" type="text" value="" >
                                <span id="error_start_time" style="color:red;"></span>
                            </div>
                        </div>

                        <div class="col-xs-12 col-lg-12 col-sm-12 padding-none">
                            <div class="form-group">
                                <label>New Password</label>
                                <input class="form-control " id="end_time" name="end_time" type="text" value="<?php echo $endvalue; ?>" >
                                <span id="error_end_time" style="color:red;"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-lg-12 col-sm-12 padding-none">
                            <div class="form-group">
                                <label>Confirm New Password</label>
                                <input class="form-control" type="text" value="" id="break_time" name="break_time" > 

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