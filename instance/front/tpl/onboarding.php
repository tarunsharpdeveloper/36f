<!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/tooltip/tooltip.css">-->

<style>
    .ui-widget-overlay.custom-overlay
    {
        background-color: black;
        background-image: none;
        opacity: 0.6;
        z-index: 1040;    
    }
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

    #myProgress {
        width: 100%;
        background-color: #ddd;
    }

    #myBar {
        width: 1%;
        height: 30px;
        background-color: #555;
    }

    .backIMG{
        background: #EEE;
        display: compact;
        height:100vh;
        width: 100%;
        opacity: 60%;
    }
    .modal-backdrop
    {
        opacity:0.85 !important;
        background-color: #EEE;
    }
    .btn-prev{
        z-index: 5000;position: absolute;
        left: 21.3%;
        top: 1%;
        background-color: transparent;
        color: white;
    }
    .btn-next{
        z-index: 5000;position: absolute;
        right:  20.5%;
        top: 1%;
    }
    .lochtml{
        text-transform: capitalize;
        color: #00CEB4;

    }
</style>
<div style="padding: 3% 0;">
    <div class="row" style="margin-bottom: 30px; margin-right: 0px; margin-left: 0px;">
        <div class="col-lg-10 col-lg-offset-1" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.26);text-align: center; padding: 10px 10px 0px; background-color:white; border-radius: 2px;">
            <div class="example-box-wrapper" style="margin-bottom: -12px;">
                <div id="form-wizard-3" class="form-wizard">
                    <ul>
                        <li class="active tab step1" >
                            <a href="" data-toggle="tab" aria-expanded="true">
                                <label class="wizard-step">1</label>
                                <span class="wizard-description">
                                    <?php print $langLabels["text_company_information"]; ?>
                                </span>
                            </a>
                        </li>
                        <li class="tab step2">
                            <a href="" data-toggle="tab">
                                <label class="wizard-step">2</label>
                                <span class="wizard-description">
                                    <?php print $langLabels["text_location_team"]; ?>
                                </span>
                            </a>
                        </li>
                        <li class="tab step3">
                            <a href="" data-toggle="tab">
                                <label class="wizard-step">3</label>
                                <span class="wizard-description">
                                    <?php print $langLabels["text_employee"]; ?>
                                </span>
                            </a>
                        </li>
                        <li class="tab step4">
                            <a href="" data-toggle="tab">
                                <label class="wizard-step">4</label>
                                <span class="wizard-description">
                                    <?php print $langLabels["text_finalize"]; ?>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-left: 0px; margin-right: 0px;">
        <div class="col-lg-10 col-lg-offset-1" style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.26);padding: 10px;border-radius: 2px;">

            <div class="modalContent" style="background: transparent;" id="mod_1" >
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="lang-option" style="position:absolute;top:10px;right:10px;z-index: 100 !important;">
                                <select name="changeLanguage" id="changeLanguage" onchange="return changeLanguage()">
                                    <option value="en" <?php print ($_SESSION['selected_lang'] != 'fa') ? 'selected' : ''  ?>>English</option>
                                    <option value="fa" <?php print ($_SESSION['selected_lang'] == 'fa') ? 'selected' : ''  ?>>Farsi</option>
                                </select>
                            </div> 
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="text-align: center; margin-bottom: 2%;"><h2> <?php print $langLabels["text_create_new_company"]; ?> </h2></div>
                            <form id="screen2_form">

                                <input type="hidden" id="mdiv_active" name='mdiv_active' value="">
                                <input type="hidden" id="emp_fname" name='emp_fname' value="">
                                <input type="hidden" id="emp_lname" name='emp_lname' value="">
                                <input type="hidden" id="email" name='email' value="">
                                <input type="hidden" id="compid" >

                                <input type="hidden" name="hidbname" id="hidbname2" value="">
                                <input type="hidden" name="hidemail" id="hidemail2" value="">


                                <input type="hidden" id="compid" >

                                <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12">

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label"><?php print $langLabels["text_first_name"]; ?></label>
                                            <div class="input-prepend input-group">
                                                <input type="text" class="tooltip-button form-control" title="<?php print $langLabels["text_enter_your_first_name"]; ?>" data-placement="bottom" id="fname" name="fname" value="" placeholder="<?php print $langLabels["text_first_name"]; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label"><?php print $langLabels["text_last_name"]; ?></label>
                                            <div class="input-prepend input-group">
                                                <input type="text" class="tooltip-button form-control" title="<?php print $langLabels["text_enter_your_last_name"]; ?>" data-placement="bottom" id="lname" name="lname" value="" placeholder="<?php print $langLabels["text_last_name"]; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="" class="col-sm-12 col-sm-12 control-label"><?php print $langLabels["text_your_company_name"]; ?></label>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                            <div class="input-prepend input-group">
                                                <input type="text" class="tooltip-button form-control" data-placement="bottom" title="<?php print $langLabels["text_enter_your_company_name"]; ?>" id="bname" name="bname" value="" placeholder="<?php print $langLabels["text_business_name"]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-12 control-label"><?php print $langLabels["text_email"]; ?></label>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                <input type="email" name="workEmail" title="<?php print $langLabels["text_enter_your_email"]; ?>" data-placement="bottom" class="tooltip-button form-control" id="workEmail" placeholder="<?php print $langLabels["text_enter_email"]; ?>" required >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="" class="col-sm-12 control-label"><?php print $langLabels["text_password_onboard"]; ?></label>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                            <input type="password" name="password" id="password" class="form-control tooltip-button" title="<?php print $langLabels["text_enter_your_password"]; ?>" data-placement="bottom" placeholder="<?php print $langLabels["text_password_onboard"]; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-12 control-label"><?php print $langLabels["text_role_onboard"]; ?></label>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 tooltip-button" title="<?php print $langLabels["text_select_your_role"]; ?>" data-placement="bottom">
                                                <select class="form-control chosen-select " name="access" id="access" required>
                                                    <option value="Employee" selected><?php print $langLabels["text_employee_onboard"]; ?></option>
                                                    <option value="Admin" selected><?php print $langLabels["admin_text"]; ?></option>
                                                    <option value="Supervisor"><?php print $langLabels["text_supervisor"]; ?></option>
                                                    <option value="Manager"><?php print $langLabels["text_manager"]; ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>

                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                <button class="btn btn-primary " style="width: 100%" type="button" onclick="screenOne()"><?php print $langLabels["text_lets_go"]; ?></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="clearfix"></div>

            <!-- 2 screen-->
            <!--            <div class="modalContent" style="background: transparent;" id="mod_2" >
                            <form action="onboarding" id="screen2_form" method="POST">
                                <input type="hidden" name="hidbname" id="hidbname2" value="">
                                <input type="hidden" name="hidemail" id="hidemail2" value="">
                                <div class="col-sm-6">
                                    <div class="panel" style="min-height: 280px;">
                                        <div class="panel-body" style="display: table;vertical-align: central;alignment-baseline: middle">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="display: table-cell;text-align: center;margin-bottom: 4%"> <h2>Your information</h2></div><br/><br/>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="display: table-cell;vertical-align: central;">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <label for="" class="col-sm-4 control-label" style="line-height: 30px;">Name</label>
                                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                                                            <div class="input-prepend input-group">
                                                                <input type="text" class="tooltip-button form-control" title="Enter your first name" data-placement="bottom" id="fname" name="fname" value="" placeholder="First Name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                                                            <div class="input-prepend input-group">
                                                                <input type="text" class="tooltip-button form-control" title="Enter your last name" data-placement="bottom" id="lname" name="lname" value="" placeholder="Last Name" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <label for="" class="col-sm-12 control-label">Your Role</label>
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 tooltip-button" title="Select your role" data-placement="bottom">
                                                            <select class="form-control chosen-select " name="access" id="access" required>
                                                                <option value="Employee" selected>Employee</option>
                                                                <option value="Admin" selected>Admin</option>
                                                                <option value="Supervisor">Supervisor</option>
                                                                <option value="Manager">Manager</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <label for="" class="col-sm-12 control-label">Password</label>
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                            <input type="password" name="password" id="password" class="form-control tooltip-button" title="Enter your password" data-placement="bottom" placeholder="password" required>
            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
            
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 screenTwoProcess" style="display: table-cell;vertical-align: central;">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <button class="btn btn-primary screenTwoBtn"  style="width: 100%" type="button" onclick="screenTwo()">Let's Go</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 screenTwoWait hidden">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <button class="btn btn-warning"  style="width: 100%" type="button">Please Wait...</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-sm-6" style="text-align: center; min-height: 280px;">
                                    <img src="<?php echo _MEDIA_URL . 'img/36f.png' ?>" class="center" width="180" height="180"><h1 style="font-weight: bolder;">36Five </h1><h4 class="modal-title center" id="myModalLabel2" style="color: #00CEB4;"><b>User Information!</b></h4>
                                </div>
            
                            </form>
                        </div>
                        <div class="clearfix"></div>-->

            <!-- 3 screen-->
            <div class="modalContent" style="background: transparent;" id="mod_3" >
                <form action="onboarding" id="screen3_form" method="POST">
                    <input type="hidden" name="hidempid" id="hidempid3" value="">
                    <input type="hidden" name="hidemail" id="hidemail3" value="">
                    <input type="hidden" name="hidcompid" id="hidcompid3" value="">                    

                    <div class="col-sm-6">
                        <div class="panel" style="min-height: 280px; vertical-align: central;">
                            <div class="panel-body" style="align-content: center;">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="text-align: center;margin-bottom: 2%"> <h2>  Check Your email</h2></div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12"> <div class="form-group">
                                        <div class="input-group">
                                            <p style="text-align: justify"> We've sent a Six-digit confirmation code to <span id="email_span"></span> . it will expire shortly, so enter your code soon.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12"> <div class="form-group">
                                        <div class="input-group">
                                            <a id="change_email" class=""  href="#"style="text-align: right;float: right;" onclick="changeEmailToggle()">Click Here To change Email</a> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" id="changeEmailDiv" style="display: none;">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-12 control-label">New Email</label>
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                    <input type="email" name="changeEmail" class="form-control tooltip-button" data-placement="bottom" title="Enter your email" id="changeEmail" placeholder="Enter email" required >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                        <button class="btn btn-primary"  style="width: 100%" type="button" onclick="Emailchange()">Update Email</button>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" id="verifyEmailDiv">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12"> 
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="col-sm-10 col-md-10 col-lg-10">
                                                    <input type="text" name="code" id="code" class="form-control tooltip-button" data-placement="bottom" title="Enter 6 digit code that you received in email" placeholder="6 Digit Code"  required maxlength="6">
                                                </div>
                                                <div class="col-sm-2 col-md-2 col-lg-2"><a style="font-size: 18px;" href="#" class="btn btn-default hover-primary" onclick="resend()"><i class="glyphicon glyphicon-repeat"></i></a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <button class="btn btn-primary"  style="width: 100%" type="button" onclick="screenThree()">Confirm Code</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6" style="text-align: center; min-height: 280px;">
                        <img src="<?php echo _MEDIA_URL . 'img/36f.png' ?>" class="center" width="180" height="180"><h1 style="font-weight: bolder;">36Five </h1><h4 class="modal-title center" id="myModalLabel2" style="color: #00CEB4;"><b>Verify Your Email!</b></h4>
                    </div>

                </form>

            </div> 
            <div class="clearfix"></div>
            <div class="modalContent" style="background: transparent;" id="mod_csv_manual" >
                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="text-align: center;margin-bottom:30px; "><h2> How would you like to create your team ?</h2></div>

                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <a class="tile-box tile-box-shortcut btn-black" onclick="manualAddTeam()" title="Example tile shortcut" href="#">

                        <div class="tile-header" style="bottom:33px" >
                            Manually Add My Team
                        </div>
                        <div class="tile-content-wrapper">
                            <i class="glyph-icon icon-cogs"></i>
                        </div>
                    </a>
                </div>
                <div class="col-md-1">
                    <h3 style="text-align:center;margin-top:30px;"><b>OR</b></h3>
                </div>

                <div class="col-md-3" >
                    <a class="tile-box tile-box-shortcut btn-danger" title="Example tile shortcut" href="#">

                        <div class="tile-header" style="bottom:33px">
                            I shall upload CSV
                        </div>
                        <div class="tile-content-wrapper">
                            <i class="glyph-icon icon-file-photo-o"></i>
                        </div>
                    </a>
                </div>
            </div>            


            <div class="clearfix"></div>
            <!-- 4 screen-->
            <div class="modalContent" style="background: transparent;" id="mod_4" >
                <form action="onboarding" id="screen4_form" method="POST">
                    <input type="hidden" name="hidempid" id="hidempid4" value="">
                    <input type="hidden" name="hidcompid" id="hidcompid4" value="">
                    <input type="hidden" name="hidlocid" id="hidlocid4" value="">
                    <div class="col-sm-6">
                        <div class="panel" style="min-height: 280px;">
                            <div class="panel-body" style="align-content: space-between;">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="text-align: center;margin-bottom: 2%"> <h2> Set Location</h2></div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                    <p style="text-align: justify"> Where is this Location? Providing accurate location information will help you manage your scheduling and timesheets later on.</p>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label class="control-label col-sm-12" for="locName">Location Name:</label>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <input type="text" class="form-control tooltip-button" data-placement="bottom" title="Enter your location name" value="" name="locName" id="locName" placeholder="e.g Sydney Store, Supply Warehouse" required="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <label class="control-label col-lg-6 col-md-6 col-sm-12" for="locAddress">Location Address:</label>
                                            <div class="col-lg-6 col-md-6 col-sm-12 btn-link" style="text-align: right;text-decoration: underline;color: dodgerblue;" onclick="getCurrentLocation()">
                                                Get my current location                                        
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 tooltip-button" data-placement="bottom" title="Enter your location address" >
                                                <input type="text" class="form-control " value="" name="locAddress" id="locAddress" placeholder="e.g Street, City, Country" required="" >
                                                <input type="hidden" class="form-control" value="" name="latlang" id="latlang" placeholder="e.g Street, City, Country">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group hidden">
                                        <div class="input-group">
                                            <label class="control-label col-sm-12" for="locWeekStart">This Location Week Start On:</label>
                                            <div class="col-sm-12 col-md-12 col-lg-12 tooltip-button" data-placement="bottom" title="Select your week start day" >
                                                <select class="form-control chosen-select" name="locWeekStart" id="locWeekStart">
                                                    <option value="Mon">Mon</option>
                                                    <option value="Tue">Tue</option>
                                                    <option value="Wed">Wed</option>
                                                    <option value="Thu">Thu</option>
                                                    <option value="Fri">Fri</option>
                                                    <option value="Sat" selected>Sat</option>
                                                    <option value="Sun">Sun</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" value="Asia/Tehran" name="locTimeZone" id="locTimeZone">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <button class="btn btn-primary"  style="width: 100%" type="button" onclick="screenFour(1)">Set location </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6" style="text-align: center; min-height: 280px;">
                        <div id="map" style="min-height: 380px;min-width: 100%;vertical-align: central;align-self: center;">
                            map here
                        </div>
                        <div style="text-align: center;cursor: pointer;margin-top: 10px;" class="btn btn-azure" onclick="getCenterLocation()"><i class="fa fa-map-marker"></i>&nbsp;Center map</div>
                    </div>

                </form>
            </div> 
            <div class="clearfix"></div>
            <!-- 5 screen-->
            <div class="modalContent" style="background: transparent;" id="mod_5" >
                <form action="onboarding" id="screen5_form" method="POST">
                    <input type="hidden" name="hidempid" id="hidempid5" value="">
                    <input type="hidden" name="hidcompid" id="hidcompid5" value="">
                    <input type="hidden" name="hidlocid" id="hidlocid5" value="">
                    <input type="hidden" name="hidLocIndex" id="hidLocIndex5" value="">
                    <input type="hidden" name="hidisremote" id="hidisremote" value="">
                    <div class="col-sm-6">
                        <div class="panel" style="min-height: 280px;">
                            <div class="panel-body" style="align-content: space-between;">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="text-align: center;margin-bottom: 2%"> <h2> Create New Team</h2></div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                    <label for="" class="col-sm-12 control-label lbl-text-align">Team</label>
                                    <div id="field_wrapper_areas" >
                                        <?php
                                        $egTeam[] = 'e.g. Customer Service';
                                        $egTeam[] = 'e.g. Sales';
                                        $egTeam[] = 'e.g. Call Center';

                                        for ($i = 0; $i < 3; $i++) {
                                            ?>
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                <div class="col-sm-10 col-md-10 col-lg-10 col-xs-10">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                                    <input id="area"  type="text" name="area[]" class="form-control form-radius tooltip-button" data-placement="bottom" title="Team name"  placeholder="<?= $egTeam[$i] ?>" required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div id="teamInputBox" class="hidden">
                                            <?php for ($i = 0; $i < 3; $i++) { ?>
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-10">
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                                        <input id="area"  type="text" name="area[]" class="form-control form-radius tooltip-button" data-placement="bottom" title="Team name" placeholder="" required/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="margin-top: 5px;" onclick="addMainTeam()">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="btn btn-placeholder">
                                                        <i class="fa fa-plus"></i>Add More Team
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="checkbox-primary col-md-12 col-sm-12 col-xs-12" style="height: 20px;">
                                                    <label class="">
                                                        <input type="checkbox" id="isRemote" name='isRemote' class="custom-checkbox">
                                                        <span style="font-size: 12px;">Would you like to sign  up for remote employee monitoring ?</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <button class="btn btn-primary"  style="width: 100%" type="button" onclick="saveTeam()">Save Team</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6" style="text-align: center; min-height: 280px;">
                        <img src="<?php echo _MEDIA_URL . 'img/36f.png' ?>" class="center" width="180" height="180"><h1 style="font-weight: bolder;font-weight: 400">36Five </h1>
                        <h4 class="modal-title center" id="myModalLabel2" style="color: #00CEB4;">
                            <b>Create New Team!</b>
                        </h4>
                    </div>

                </form>
            </div> 
            <div class="clearfix"></div>
            <!-- 6 screen-->
            <div class="modalContent " style="background: transparent;" id="mod_6" >
                <form action="onboarding" id="screen6_form" method="POST">
                    <div class="modal-body" id="employeeFormList">

                    </div>
                </form>
            </div> 
            <div class="clearfix"></div>
            <!-- 7 screen-->
            <div class="modalContent" style="background: transparent;" id="mod_7" >
                <form action="onboarding" id="screen7_form" method="POST">
                    <input type="hidden" id="set_default_page" name='set_default_page' value="">
                    <input type="hidden" name="hidempid" id="hidempid7" value="">
                    <input type="hidden" name="hidcompid" id="hidcompid7" value="">
                    <input type="hidden" name="hidlocid" id="hidlocid7" value="">
                    <div class="col-sm-6">
                        <div class="panel" style="min-height: 280px;">
                            <div class="panel-body" style="border: none;margin:0px;">
                                <h2 style="font-weight: bolder;">What would you like to see first? </h2>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="content-box remove-border dashboard-buttons clearfix" style="background: transparent;">
                                                <a class="btn vertical-button remove-border btn-default" href="#" title="" style="height: 200px;width: 200px;" onclick="CallSubmit('location')">
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
                                            <div class="content-box remove-border dashboard-buttons clearfix">
                                                <a class="btn vertical-button remove-border btn-default" href="#" title="" style="height:200px;width: 200px;" onclick="CallSubmit('employee_settings')">
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
                    <div class="col-sm-6" style="text-align: center; min-height: 280px;">
                        <img src="<?php echo _MEDIA_URL . 'img/36f.png' ?>" class="center" width="180" height="180"><h1 style="font-weight: bolder;font-weight: 400">36Five </h1><h4 class="modal-title center" id="myModalLabel2" style="color: #00CEB4;"><b>Create New Team!</b></h4>
                    </div>
                </form>
            </div> 
            <div class="clearfix"></div>
            <!-- 8 screen-->
            <div class="modalContent" style="background: transparent;" id="mod_8" >
                <form action="onboarding" id="screen8_form" method="POST">
                    <div class="panel">
                        <div class="panel-body">
                            <input type="hidden" id="set_default_page" name='set_default_page' value="">
                            <input type="hidden" name="hidempid" id="hidempid8" value="">
                            <input type="hidden" name="hidcompid" id="hidcompid8" value="">
                            <input type="hidden" name="hidlocid" id="hidlocid8" value="">
                            <div class="col-sm-6" style="align-content: center;">
                                <h2 style="font-weight: bolder;">Welcome, <span style="font-size: 20px;" id="usernm"> <?= $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'] ?></span></h2> 
                                <h3>Please rest in your chair and relax, while we prepare your account in few seconds!</h3>
                            </div>

                            <div class="col-sm-6" style="text-align: center; min-height: 280px;">
                                <img src="<?php echo _MEDIA_URL . 'img/36f.png' ?>" class="center" width="180" height="180"><h1 style="font-weight: bolder;font-weight: 400">36Five </h1><h4 class="modal-title center" id="myModalLabel2" style="color: #00CEB4;"><b>Create New Team!</b></h4>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <div id="myProgress">
                                    <div id="myBar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div> 
            <div class="clearfix"></div>
            <!-- 9 screen-->
            <div class="modalContent" style="background: transparent;" id="mod_9" >
                <form action="onboarding" id="screen9_form" method="POST">
                    <input type="hidden" id="set_default_page" name='set_default_page' value="">
                    <input type="hidden" name="hidempid" id="hidempid9" value="">
                    <input type="hidden" name="hidcompid" id="hidcompid9" value="">
                    <input type="hidden" name="hidLocIndex" id="hidLocIndex9" value="">
                    <input type="hidden" name="hidlocid" id="hidlocid9" value="">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="align-content: center;">
                                <h2 style="font-weight: bolder;">List of Location</h2> 
                            </div>
                            <br/>                            <br/>
                            <div class="col-lg-12">
                                <div class="example-box-wrapper" id="ReloadTabel">
                                    <table id="datatable-responsive" class="table table-striped responsive no-wrap" cellspacing="0" width="100%" style="margin: 0 0 0 0;">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tbody id="LocSummary">
                                            <tr>
                                                <td>NO RECORD FOUND </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br/>                            <br/>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="text-align: center;">
                                <div class="col-sm-8 col-md-8 col-lg-8 col-xs-8">                      
                                    <h3 style="font-weight: bolder;">Do you want to add another location?</h3>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                                    <input type="button" value="Yes " onclick="setModel(3);
                                            $('#screen4_form .panel-body input:text').val('');" class="btn btn-primary">
                                    <input type="button" value="No, Let me start adding my team " class="btn btn-default" onclick="setModel(4);">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div> 
            <div class="clearfix"></div>
            <!-- 10 screen-->
            <div class="modalContent" style="background: transparent;" id="mod_10" >
                <form action="onboarding" id="screen10_form" method="POST">
                    <input type="hidden" id="set_default_page" name='set_default_page' value="">
                    <input type="hidden" name="hidempid" id="hidempid10" value="">
                    <input type="hidden" name="hidcompid" id="hidcompid10" value="">
                    <div class="col-sm-8 col-md-8 col-lg-8 col-xs-8" style="min-height: 240px;">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="align-content: center;margin-top: 10%;">
                                    <h2 style="font-weight: bolder;">Bravo!!, Ok, do you have remote workers that you would like to invite that are not set to a specific location?</h2>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="text-align: right;align-self: flex-end;border: 1px;margin-top: 5%;">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                        <input type="button" value="Yes " onclick="loadEmployeeForm('1', '-1', '1');
                                                setModel('5');" class="btn btn-primary">
                                        <input type="button" value="No " class="btn btn-default" onclick="callFinalSummary();
                                                changeToggle('4');">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4" style="text-align: center; min-height: 240px;">
                        <img src="<?php echo _MEDIA_URL . 'img/36f.png' ?>" class="center" width="180" height="180"><h1 style="font-weight: bolder;font-weight: 400">36Five </h1><h4 class="modal-title center" id="myModalLabel2" style="color: #00CEB4;"><b>Create New Team!</b></h4>
                    </div>
                </form>
            </div> 
            <div class="clearfix"></div>
            <!-- 11 screen-->
            <div class="modalContent" style="" id="mod_11" >
                <form action="onboarding" id="screen11_form" method="POST">
                    <input type="hidden" id="set_default_page" name='set_default_page' value="">
                    <input type="hidden" name="hidempid" id="hidempid10" value="">
                    <input type="hidden" name="hidcompid" id="hidcompid10" value="">
                    <!--<div class="panel" style="padding: 0px;">-->
                    <div class="" style="min-height: 240px; padding: 0px;" id="allSummary">
                        <!--                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="min-height: 240px;" id="allSummary">
                        
                                                    </div>-->
                        <!--</div>-->
                    </div>      
                    <div class="clearfix" style="height: 10px;"></div>

                    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="" >
                        <a onclick="setModel('6')" id="nextModel" style="float: right;" class="btn btn-primary" href="javascript:;" >Click to Next </a>
                    </div>

                </form>
            </div> 
        </div>
    </div>
</div>
<div id="editEmployeeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="editEmployeeForm">
                <p>Some text in the modal.</p>
            </div>

        </div>

    </div>
</div>
<style>
    #remove_lan, #remove_lan_r {
        border-top: 1px solid #cacaca;
        margin-top: 10px;
        padding-top: 10px;
    }
    #accordion_emp_table{
        font-size: 12px;
    }
    #accordion_emp_table > thead > tr > th, #accordion_emp_table > tbody > tr > td{
        padding: 6px !important;
    }
</style>