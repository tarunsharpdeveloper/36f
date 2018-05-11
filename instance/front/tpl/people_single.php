<script>
    $(document).ready(function () {
<?php if ($success == "1") { ?>
            Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>
<?php if ($success == "-1") { ?>
            Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>
    });
</script>

<style>

    body{
        height: 100%;
        background: #dfe2e6;
    }
    label{
        color: #969a9e;
    }
    .sidebar-nav-left{

        float: right;
        padding: 0px;
        margin: 0px;
        width: 20%;
        /*min-height: max-content ;*/
        height: 100%;
        border: #F3F5F7 2px solid; 
    }

    .sidebar-nav-right{
        float: right;
        padding: 0px;
        margin: 0px;
        width: 80%;
        min-height:  min-content;

        border: #F3F5F7 2px solid; 
        /*clear: both;*/
    }

    .main-content{
        float: left;margin: 0;padding: 0;min-height: min-content;min-width: 100%;
        /*background-color: mistyrose;*/
    }
    .background-color{
        background: #dfe2e6;
    }
    .background-color-white{
        background: white;
    }
    .on-break{
        /*    cursor: pointer;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            height: 23px;
            width: 38px;
            background-color: #e9e9e9;
            font-weight: bold;*/
        /* cursor: pointer; */cursor: pointer;
        /*border: 2px dashed transparent;*/
        border-radius: 50%;
        display: inline-block;
        position: relative;
        height: 40px;
        width: 40px;font-weight: bold;
        background-color: #e9e9e9;
        font-size: 14px;
        line-height: 35px;
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
        height: 40px;
        width: 40px;font-weight: bold;
        background-color: #e9e9e9;
        font-size: 14px;
        line-height: 35px;
    }
    .filter-dropdown-menu {
        box-shadow: 0 1px 4px 1px rgba(0,0,0,0.2), 0 12px 24px rgba(0,0,0,0.24);
        border-radius: 4px;
        min-width: 0;
        margin-left: 0;
        margin-right: 0;
        max-height: 90vh;
        overflow-y: auto;
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
    }
    /*    .also-show-dropdown-menu{
            box-shadow: 0 1px 4px 1px rgba(0,0,0,0.2), 0 12px 24px rgba(0,0,0,0.24);border-radius: 4px;
            overflow-y: auto;
            overflow-x: hidden;
        }*/
    label{
        font-weight: inherit;
        margin-bottom: 12px;
    }

    .form-radius{
        border: #c1c1c1 solid 1px;
        border-radius: 5px !important;
    }
    .gray{
        color: black;
        font-weight: bold;
    }
    .lbl-text-align{
        text-align: right;
    }
    .dropdown-menu li > a:hover {
        border-top: 1px solid rgba(10, 10, 10, 0.36);
        border-bottom: 1px solid rgba(10, 10, 10, 0.36);
    }
    .dropdown-menu>li.clean-slate, .dropdown-menu>li>* {
        border-top: 1px solid transparent;
        border-bottom: 1px solid transparent;
    }
</style>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        /*border: 1px solid #dddddd;*/
        text-align: left;
        padding: 8px;
    }
    .tb-none{
        display: none;
        /*width:  10%;*/
    }
    .tb-sub{
        width: 10%;
    }
    .tb-th{
        width: 10%;
    }

</style>
<style>
    .parsley-success {
        border-color: #c1c1c1 !important;
    }
    .btn.btn-close, .btn.btn-close-small {
        border-color: #969a9e;
        float: right;
        font-size: 20px;
    }
</style>
<div style="" class="main-content">
    <div class="panel" >
        <div class="panel-body" >
            <h3 style="font-weight: bold;margin-left: 20px;">Add new People</h3>
            <?php
            $StreetProfile = q("select * from tb_stress_profile");
            ?>
            <form action="people_single_upload" method="POST" data-parsley-validate enctype="multipart/form-data">
                <div class="panel" >
                    <div class="panel-body" >
                        <section>
                            <h5 class="m-sideReveal-profileEditHeader gray">PROFILE</h5><br>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >First Name</label>
                                        <div class="col-sm-12">
                                            <input id="fname" type="text" name="fname" class="form-control form-radius"  placeholder="" required/>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Last Name</label>
                                        <div class="col-sm-12">
                                            <input id="lname" type="text" name="lname" class="form-control form-radius"  placeholder="" required/>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Email</label>
                                        <div class="col-sm-12">
                                            <input id="email" type="email" name="email" class="form-control form-radius"  placeholder="" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Mobile</label>
                                        <div class="col-sm-12">
                                            <input id="mobile" data-parsley-type="digits" type="text" name="mobile" class="form-control form-radius"  placeholder="" data-inputmask="'mask': '99999999999'" maxlength="11" pattern="/^[09]{1}[0-9]{10}$/" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                        </section>

                        <section>
                            <h5 class="m-sideReveal-profileEditHeader gray">JOB INFORMATION</h5><br>
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
                                            <select name="work_at_location[]"  id="work_at_location" multiple data-placeholder="Click to see available options..." class="chosen-select" required >
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
                                            <select name="stress_profile" id="stress_profile"  class="browser-default chosen-select form-control" style="padding-left: 10%;font-size: 16px;" required >

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
                        </section>

                        <section>
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

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-4 control-label lbl-text-align" >Time Sheet Export Code</label>
                                        <div class="col-sm-8">
                                            <input id="time_s_e_code" type="text" name="time_s_e_code" class="form-control form-radius"  placeholder=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section>
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
                                            <input id="idno" type="text" name="idno" class="form-control form-radius"  placeholder="" required/>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Employee Number</label>
                                        <div class="col-sm-12">
                                            <input id="empno" type="text" name="empno" class="form-control form-radius"  placeholder="" required/>
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
                                            <input id="bodno" type="text" name="bodno" class="form-control form-radius"  placeholder="" required/>
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
                        </section>

                        <section>
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
                                            <input id="home_phone" type="text" name="home_phone" class="form-control form-radius"  placeholder=""  maxlength="11" pattern="/^[09]{1}[0-9]{10}$/" required/>
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
                        </section>

                        <section>
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
                        </section>
<!--                        <section>
                            <h5 class="m-sideReveal-profileEditHeader gray">UPLOAD IMAGES</h5><br>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Upload Contract</label>
                                        <div class="col-sm-12">
                                            <input id="ContractImage"  type="file" name="ContractImage" class="form-control form-radius"  placeholder=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                        </section>-->
                        <section>
                            <!--                            <h5 class="m-sideReveal-profileEditHeader gray">UPLOAD IMAGES</h5><br>-->
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
                                        <label for="" class="col-sm-4 control-label " >Overtime Permission</label>
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

                        </section>

                    </div>
                </div>

                <div class="col-sm-12 text-right" >
                    <a class="btn btn-default" href="<?= l("people") ?>" type="button">Back</a>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" type="submit">Save</button>
                    <input id="add_people" type="hidden" name="add_people" value="1"/>
                </div> 

            </form>
        </div>
    </div>
</div>

<style>
    .modal:nth-of-type(even) {
        z-index: 1042 !important;
    }
    .modal-backdrop.in:nth-of-type(even) {
        z-index: 1041 !important;
        .setwidth{
            width: 700px;
        }
    }
</style>
<style>

    #Edit-People{
        float: right;
        position: fixed;
        /*left: 65%;*/
        right: 0px;

    }
</style>