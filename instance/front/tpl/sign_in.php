<style>
    .form-radius{
        border: #c1c1c1 solid 1px;
        border-radius: 5px !important;
    }
    .parsley-success {
        border-color: #c1c1c1 !important;
    }
    .btn.btn-placeholder {
        width: 82%;
        border: 2px dashed #999;
        color: #999;
    }
    .no-touch .btn.btn-placeholder:hover, .no-touch .btn.btn-placeholder:focus, .btn.btn-placeholder:active, .btn.btn-placeholder.active {
        border-color: #3f3f3f;
        color: #3f3f3f;
    }
    .btn:hover, .btn:focus {
        text-decoration: none;
    }
    .btn.btn-link-danger {
        color: #f27272;
        font-weight: 600;
    }
    .btn.btn-link-danger:hover,.no-touch .btn.btn-link-danger:focus{
        color:white;
        background:#ff5252;
        border-color:#ff5252;
        text-shadow:none
    }

    .btn.btn-close, .btn.btn-close-small {
        border-color: #969a9e;
        float: right;
        font-size: 20px;
    }
</style>
<style>
    .backIMG{

        /*background: url('<?php echo _MEDIA_URL . 'img/backimage.png' ?>');*/
        background: #555;
        /*background-size: 100% 100%;*/
        /*background-repeat:no-repeat;*/
        display: compact;
        height:100vh;
        width: 100%;
        opacity: 60%;

    }
    .modal-backdrop
    {
        opacity:0.85 !important;
    }
    .btn-prev{
        z-index: 5000;position: absolute;
        left: 21.3%;
        top: 30%;
        background-color: transparent;
        color: white;
    }
    .btn-next{
        z-index: 5000;position: absolute;

        right:  20.5%;
        top: 30%;
        /*        background-color: buttonface;
                color: white;*/
    }
</style>
<div class="backIMG col-sm-12">
    <div class="modal fadeInUp center "  id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <button class="btn btn-default btn-prev" onclick="setModelBack()"><i class="fa fa-arrow-left"></i> Go Back</button>
        <button class="btn btn-primary btn-next" onclick="setModelNext()">Next Step <i class="fa fa-arrow-right"></i></button>
        <div class="modal-dialog" role="document"  style="background: transparent;">
            <form action="sign_in" id="sign_in_form">
                <input type="hidden" id="mdiv_active" name='mdiv_active' value="">
                <input type="hidden" id="set_default_page" name='set_default_page' value="">
                <input type="hidden" id="emp_fname" name='emp_fname' value="">
                <input type="hidden" id="emp_lname" name='emp_lname' value="">
                <input type="hidden" id="email" name='email' value="">
                <div class="modal-content" style="background: #555;" id="mod_1" hidden>
                    <div class="modal-header" style="text-align: center;background: transparent;color: white">
                        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                        <img src="<?php echo _MEDIA_URL . 'img/t_logo_je.png' ?>" class="center" width="60" height="60"><h1 style="font-weight: bolder;">WHOZOOR </h1><h4 class="modal-title center" id="myModalLabel2" style="color: #00CEB4;"><b>Enter Your Own Data!</b></h4>
                    </div>
                    <div class="modal-body" >
                        <div class="panel" >
                            <div class="panel-body" >
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-12 col-sm-12 control-label" style="line-height: 30px;">What is Your Business Call?</label>
                                            <div class="col-sm-12">
                                                <div class="input-prepend input-group">
    <!--                                                <span class="add-on input-group-addon">
                                                        <i class="glyph-icon icon-calendar"></i>
                                                    </span>-->
                                                    <input type="text" class="  form-control" id="bname" name="bname" value="" placeholder="Business Name">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-12 col-sm-12 control-label" style="line-height: 30px;">Where is Your Business?(City)</label>
                                            <div class="col-sm-12">
                                                <div class="input-prepend input-group">
    <!--                                                <span class="add-on input-group-addon">
                                                        <i class="glyph-icon icon-calendar"></i>
                                                    </span>-->
                                                    <input type="text" class="  form-control" id="bcity" name="bcity" value="" placeholder="Place">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <button class="btn btn-primary"  style="width: 100%" type="button" onclick="setModel('1')">Let's Go</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12" style="color: white;text-align: center">
                            <h4>Wait, I am an employee. I don't need to set up a business!</h4><br/>
                            <button class="btn btn-warning" type="button" >Employees, Get Strated Here</button>
                        </div> 
                    </div> 
                </div>
                <div class="modal-content " style="background: #555;" id="mod_2" hidden>
                    <div class="modal-header" style="text-align: center;background: transparent;color: white">
                        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                        <h2 style="font-weight: bolder;">Tell us a little more </h2>
                    </div>
                    <div class="modal-body" >
                        <div class="panel" >
                            <div class="panel-body" >
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-12 col-sm-12 control-label" style="line-height: 30px;">Your Industry</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" name="c_type" id="c_type">
                                                    <option value="" selected="">Please select an option</option>
                                                    <option value="Food">Food, Beverage, and Hospitality</option>
                                                    <option value="Healthcare">Healthcare</option>
                                                    <option value="Retail">Retail</option>
                                                    <option value="Catering">Catering</option>
                                                    <option value="Construction">Construction</option>
                                                    <option value="Consulting">Consulting</option>
                                                    <option value="Education">Education</option>
                                                    <option value="Entertainment">Entertainment</option>
                                                    <option value="Finance">Finance/Accounting</option>
                                                    <option value="Fitness">Fitness</option>
                                                    <option value="Government">Government</option>
                                                    <option value="Home Services">Home Services</option>
                                                    <option value="Hotel">Hotel &amp; Resorts</option>
                                                    <option value="Insurance/Banking">Insurance/Banking</option>
                                                    <option value="Law Enforcement">Law Enforcement</option>
                                                    <option value="Legal">Legal</option>
                                                    <option value="Manufacturing">Manufacturing</option>
                                                    <option value="Media">Media</option>
                                                    <option value="Non Profit">Non Profit</option>
                                                    <option value="Staffing">Staffing</option>
                                                    <option value="Professional Services">Professional Services</option>
                                                    <option value="Technology">Technology</option>
                                                    <option value="Security">Security</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-12 col-sm-12 control-label" style="line-height: 30px;">Total Employees</label>
                                            <div class="col-sm-12">
                                                <div class="input-prepend input-group">
    <!--                                                <span class="add-on input-group-addon">
                                                        <i class="glyph-icon icon-calendar"></i>
                                                    </span>-->
                                                    <input type="text" class="  form-control" id="b_emp" name="b_emp" value="" placeholder="How Many peoples work in this business?">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-12 col-sm-12 control-label" style="line-height: 30px;">What is Your Title?</label>
                                            <div class="col-sm-12">
                                                <div class="input-prepend input-group">
    <!--                                                <span class="add-on input-group-addon">
                                                        <i class="glyph-icon icon-calendar"></i>
                                                    </span>-->
                                                    <input type="text" class="  form-control" id="b_title" name="b_title" value="" placeholder="Owner, Manager, Supervisor...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-12 col-sm-12 control-label" style="line-height: 30px;">What is your mobile number?</label>
                                            <div class="col-sm-12">
                                                <div class="input-prepend input-group">
    <!--                                                <span class="add-on input-group-addon">
                                                        <i class="glyph-icon icon-calendar"></i>
                                                    </span>-->
                                                    <input type="text" class="  form-control" id="c_mobile" name="c_mobile" value="" placeholder="Contact Number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-content " style="background: #555;" id="mod_3" >
                    <div class="modal-header" style="text-align: center;background: transparent;color: white">
                        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                        <h2 style="font-weight: bolder;">What would you like to see first? </h2>
                    </div>
                    <div class="modal-body" style="background: transparent;margin: 0px;" >
                        <div class="panel" style="background: transparent;border: none;" >
                            <div class="panel-body" style="background: transparent;border: none;margin:0px;" >
                                <div class="col-sm-6" style="background: transparent;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="content-box remove-border dashboard-buttons clearfix" style="background: transparent;">
                                                <a class="btn vertical-button remove-border btn-default" href="#" title="" style="height: 200px;width: 200px;" onclick="CallSubmit('newschedule_2')">
                                                    <span class="glyph-icon icon-separator-vertical" style="margin: 20% auto;font-size: 75px;display: block;">
                                                        <i class="glyph-icon icon-picture-o"></i>
                                                    </span>
                                                    <span class="button-content">Sheduling</span>
                                                    <h2 style="color: #00CEB4;font-weight: bolder">Let's Go</h2>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="content-box remove-border dashboard-buttons clearfix" style="background: transparent;">
                                                <a class="btn vertical-button remove-border btn-default" href="#" title="" style="height:200px;width: 200px;" onclick="CallSubmit('approve_timesheet_2')">
                                                    <span class="glyph-icon icon-separator-vertical" style="margin: 20% auto;font-size: 75px;display: block;">
                                                        <i class="glyph-icon icon-picture-o"></i>
                                                    </span>
                                                    <span class="button-content">Time & Attendance</span>
                                                    <h2 style="color: #00CEB4;font-weight: bolder">Let's Go</h2>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- modal-content -->
    </div>
    <div class="modal fadeInUp center "  id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
<!--        <button class="btn btn-default btn-prev" onclick="setModelBack()"><i class="fa fa-arrow-left"></i> Go Back</button>
       <button class="btn btn-primary btn-next" onclick="setModelNext()">Next Step <i class="fa fa-arrow-right"></i></button>-->
        <div class="modal-dialog" role="document"  style="background: transparent;width: 80%;">
            <form action="sign_in" id="sign_in_form">
                <input type="hidden" id="mdiv_active" name='mdiv_active' value="">
                <input type="hidden" id="default_page" name='default_page' value="">
                <input type="hidden" id="emp_fname" name='emp_fname' value="">
                <input type="hidden" id="emp_lname" name='emp_lname' value="">
                <input type="hidden" id="email" name='email' value="">
                <input type="hidden" id="work_at" name='work_at' value="">
                <div class="modal-content" style="background: #555;" id="mod_4">
                    <div class="modal-header" style="text-align: center;background: transparent;color: white">
                        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                        <h3 style="font-weight: bolder;">To get started, let's enter a few trusted staff.<small><span style="color: blue;">(Skip)</span></small> </h3>
                    </div>
                    <div class="modal-body" >
                        <div class="panel" >
                            <div class="panel-body" >
                                <div class="field_wrapper">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-12 control-label lbl-text-align" >First Name</label>
                                                <div class="col-sm-12">
                                                    <input id="fname"  type="text" name="fname[]" class="form-control form-radius"   placeholder="First name" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-12 control-label lbl-text-align" >Last Name</label>
                                                <div class="col-sm-12">
                                                    <input id="lname"  type="text" name="lname[]" class="form-control form-radius"   placeholder="Last name" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-12 control-label lbl-text-align" >Email</label>
                                                <div class="col-sm-12">
                                                    <input id="email"  type="text" name="email[]" class="form-control form-radius"   placeholder="email"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label for="" class="col-sm-12 control-label lbl-text-align" >Phone Number</label>
                                                    <div class="col-sm-12">
                                                        <input id="phone_no"  type="text" name="phone_no[]" class="form-control form-radius"   placeholder="(Optional)"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>
                                <div class="col-sm-12" style="margin-top: 5px;">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <a href="javascript:void(0);" class="add_button btn btn-placeholder" title="Add field" style="width: 90%;">
                                                    <i class="fa fa-plus"></i>Add More People
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="margin-top: 50px;">
                                    <div class="col-sm-12">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label for="" class="col-sm-5 control-label lbl-text-align" >Send Invitation Email [?]</label>
                                                    <div class="col-sm-6">
                                                        <input  type="checkbox" data-on-color="success" name="send_invitation" class="input-switch" checked="" data-size="medium" data-on-text="On" data-off-text="Off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" align="right" style="">
                                    <a href="people"><button class="btn btn-default" type="button">Cancel</button></a>
                                    <button class="btn btn-primary" type="submit">Add People</button>
                                    <input id="add_people" type="hidden" name="Add_multiple_people" value="1"/>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div><!-- modal-content -->
    </div>


</div>

