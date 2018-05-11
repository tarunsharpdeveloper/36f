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
    <div class="panel sidebar-nav-left">
        <div class="panel-body background-color">

            <div class="panel-body background-color-white" style="border-radius: 16px;">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-4 col-xs-4 col-lg-12 control-label">Teams</label>
                        <div class="col-sm-8 col-xs-8 col-lg-12">
                            <select name="leave_type1" id="leave_type1" class="browser-default chosen-select form-control" style="width:100%" >
                                <option selected >All Locations</option>
                                <option value="Unspecified">Hardik Casting</option>
                            </select>

                        </div>
                    </div>
                </div>
                <div class="panel-body" >

                    <div class="example-box-wrapper" >
                        <div class="row">

                            <div class="col-md-12" style="margin-top: 20px;">
                                <a class="btn btn-default" type="button" data-toggle="collapse" data-target="#demo-2" aria-expanded="true" style="    margin-left: -28%;padding-right: 81%;">
                                    <i class="fa fa-plus small"></i>&nbsp;&nbsp;On Break(1)
                                </a>
                                <div id="demo-2" class="collapse in" aria-expanded="true" style="margin-top: 20px;margin-left: -28px;">

                                    <div class="row">
                                        <div  class="col-xs-3 col-md-3 on-break">HH</div>
                                        <div class="col-xs-9 col-md-9">
                                            <div><b style="color: #1b92da;">Hardik Hardik</b></div>
                                            <div><a class="m-team-supportingLink" href="#" title="Started on 11:29am at Manager">11:29am at Manager</a></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <div class="panel sidebar-nav-right" >
        <div class="panel" style="margin-bottom: 0px;">
            <div class="panel-body">
                <div>
                    <div class="col-lg-2 col-sm-12">
                        <h2 style="font-weight: bold;">People</h2>
                    </div>

                    <div class="col-lg-8 col-sm-12 ">
                        <hr>
                    </div>
                    <div class="col-lg-2 col-sm-12">
                        <div class="dropdown float-right" style="width: 100%;">
                            <a href="#" class="btn btn-azure col-md-12" title="" data-toggle="dropdown" aria-expanded="false">
                                Add People
                                <i class="glyph-icon icon-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu float-right" style="display: none;">
                                <li>
                                    <!--<a data-toggle="modal" data-target="#Add-People" type="button" href="#">-->
                                    <!--<a type="button" href="<?= l('people_single') ?>">-->
                                    <a type="button" href="<?= l('add_people') ?>">
                                        Add a Single Person
                                    </a>
                                </li>
                                <li>
                                    <a href="people_multiple" title="">
                                        Add / Import Multiple People
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--<button class="btn btn-azure col-md-12 " data-toggle="modal" data-target="#Add-People" type="button">Add People</button>-->
                    </div>
                </div>

            </div>
            <div class="panel-body">
                <div class="col-lg-3 col-sm-12">

                    <a class="btn btn-default" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="true" style="width: 100%">Filter<span class="caret"></span></a>

                    <div id="filter" class="collapse filter-dropdown-menu">

                        <div class="form-group" style="margin-top: 20px;">
                            <label class="col-sm-4 col-xs-4 col-lg-12 control-label">Access</label>
                            <div class="col-sm-8 col-xs-8 col-lg-12">
                                <select name="leave_type1" id="leave_type1" class="browser-default chosen-select form-control" style="width:100%" >
                                    <option selected >All</option>
                                    <option value="Employee">Employee</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Location_Manager">Location Manager</option>
                                    <option value="System_Administrator">System Administrator</option>
                                </select>

                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label class="col-sm-4 col-xs-4 col-lg-12 control-label">Status</label>
                            <div class="col-sm-8 col-xs-8 col-lg-12">
                                <select name="leave_type2" id="leave_type1" class="browser-default chosen-select form-control" style="width:100%" >
                                    <option selected >All</option>
                                    <option value="Employee">Employee</option>
                                    <option value="Discarded">Discarded</option>
                                </select>

                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label class="col-sm-4 col-xs-4 col-lg-12 control-label">Invitation</label>
                            <div class="col-sm-8 col-xs-8 col-lg-12">
                                <select name="leave_type3" id="leave_type1" class="browser-default chosen-select form-control" style="width:100%" >
                                    <option selected >All</option>
                                    <option value="Waiting_Reply">Waiting Reply</option>
                                    <option value="Accepted">Accepted</option>
                                    <option value="Declined">Declined</option>
                                    <option value="No_invitation_sent">No invitation sent</option>
                                </select>

                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label class="col-sm-4 col-xs-4 col-lg-12 control-label">Stress Profile</label>
                            <div class="col-sm-8 col-xs-8 col-lg-12">
                                <select name="leave_type4" id="leave_type1" class="browser-default chosen-select form-control" style="width:100%" >
                                    <option selected >All</option>
                                    <option value="1">2 days per week</option>
                                    <option value="2">24/7</option>
                                    <option value="3">CA Overtime 40hrs per week, 8hrs per day, max 6 per day</option>
                                    <option value="4">Max 20 hours per week</option>
                                    <option value="5" >Normal 38 hours per week</option>
                                    <option value="6" >Standard 40 hours</option>
                                    <option value="7" >USA Overtime 40hrs per week, 8hrs per day</option>
                                </select>

                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label class="col-sm-4 col-xs-4 col-lg-12 control-label">Training</label>
                            <div class="col-sm-8 col-xs-8 col-lg-12">
                                <select name="training[]"  id="training" multiple data-placeholder="Click to see available options..." class="chosen-select" >
                                    <!--                                                        <option  value="" disabled > Choose Work At</option>-->
                                    <option value="1">Whozoor.com Employee Training</option>
                                    <option value="2">Whozoor.com Manager Training</option>

                                </select>


                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label class="col-sm-4 col-xs-4 col-lg-12 control-label">Has Time Sheet Export Code</label>
                            <div class="col-sm-8 col-xs-8 col-lg-12">
                                <select name="leave_type6" id="leave_type1" class="browser-default chosen-select form-control" style="width:100%" >
                                    <option selected >All</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>

                            </div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>

                </div>

                <div class="col-lg-7 col-sm-12 ">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-search"></i>
                        </div>
                        <input id="team-search-filter" class="form-control" type="text" name="team-search-filter" placeholder="Search People..." autocomplete="off" style="border-right: 0;">
                        <div class="input-group-addon">
                            <span id="lblTeamMemberCount" style="display: inline;">showing <strong>3</strong> people</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-12">
                    <li class="dropdown" style="width: 100%;">
                        <a href="#" style="width: 100%;" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false">Also Show<b class="caret"></b></a>
                        <ul class="dropdown-menu" style="display: none;width: 100%;">
                            <li style="margin-left: 5px;"><label><input type="checkbox" value="1" class="show-field" data-field="Company"> Main Location</label></li>
                            <li class="divider"></li>
<!--                            <li style="margin-left: 5px;"><label><input type="checkbox" value="2" class="show-field" data-field="Company"> Status</label</li>
                            <li class="divider"></li>-->
                            <li style="margin-left: 5px;"><label><input type="checkbox" value="3" class="show-field" data-field="Company"> Email Address</label></li>
                            <li class="divider"></li>
                            <li style="margin-left: 5px;"><label><input type="checkbox" value="4" class="show-field" data-field="Company"> Mobile</label></li>
                            <li class="divider"></li>
                            <li style="margin-left: 5px;"><label><input type="checkbox" value="5" class="show-field" data-field="Company"> Stress Profile</label></li>
                            <!--<li class="divider"></li>-->
                            <!--<li style="margin-left: 5px;"><label><input type="checkbox" value="6" class="show-field" data-field="Company"> Training</label></li>-->
                            <li class="divider"></li>
                            <li style="margin-left: 5px;"><label><input type="checkbox" value="7" class="show-field" data-field="Company"> Pay Rates</label></li>
                            <li class="divider"></li>
                            <!--<li style="margin-left: 5px;"><label><input type="checkbox" value="8" class="show-field" data-field="Company"> Time Sheet Export Code</label></li>-->
                        </ul>
                    </li>
                </div>


            </div>
            <div class="panel-body" style="margin: 0px;padding: 0px;" id="RefreshDiv">
                <div class="panel-body">
                    <div class="col-lg-12 col-sm-12">
                        <li class="dropdown" style="width: 49%;">
                            <a id="Bulk_li" href="#" style="width: 49%;" data-toggle="dropdown" class="btn btn-default dropdown-toggle disabled" aria-expanded="false" >Bulk Actions<b class="caret"></b></a><span style="margin-left: 10px;" id="select_person"></span>
                            <ul class="dropdown-menu" style="display: none;width: 49%;">
                                <li><a href="#" onclick="BultActions('set_access_model');" >Set Access</a></li>
                                <li><a href="#" onclick="BultActions('strees_profile_model');" >Set Stress Profile</a></li>
                                <li><a href="#" onclick="BultActions('add_training_model');">Add Training</a></li>
                                <li><a href="#" onclick="BultActions('set_rate_model');">Set Rates</a></li>
                                <li><a href="#" onclick="BultActions('send_message_model');">Send Message</a></li>
                                <li><a href="#" onclick="BultActions('send_invitation_model');">Send Invitation</a></li>
                            </ul>
                        </li>
                    </div>
                </div>
                <div class="panel-body" id="testing">
                    <input type="hidden" id="bulk_select_id" name="bulk_select_id" />
                    <input type="hidden" id="bulk_select_id_count" name="bulk_select_id_count" />
                    <div class="col-lg-12 col-sm-12" id="RefreshTableData">

                        <table class="table table-striped responsive no-wrap">
                            <tr>
                                <th style="float:left;"><input type="checkbox" class="selectall" id="all"></th>
                                <th style="float:left;width:21%;">Name & Access</th>
                                <th id="tbl_1" class="tb-none tb-th">Main Location</th>
                                <!--<th id="tbl_2" class="tb-none tb-th">Status</th>-->
                                <th id="tbl_3" class="tb-none tb-th" style="width:14%;">Email Address</th>
                                <th id="tbl_4" class="tb-none tb-th">Mobile</th>
                                <th id="tbl_5" class="tb-none tb-th">Stress Profile</th>
                                <!--<th id="tbl_6" class="tb-none tb-th">Training</th>-->
                                <th id="tbl_7" class="tb-none tb-th">Pay Rates</th>
                                <!--<th id="tbl_8" class="tb-none tb-th">Time Sheet Export Code</th>-->
                                <th style="float:right;width:20%;text-align: center;">Actions</th>
                            </tr>
                            <?php if (empty($PostResult)) { ?>
                                <tr><td colspan="11"><?php echo "No Record Found!!!!!"; ?></td></tr>
                                <?php
                            } else {
                                foreach ($PostResult as $PostRow) {
                                    ?>
                                    <tr>

                                        <td style="float:left;"><input type="checkbox" name="nchild[]" class="child" value="<?php echo $PostRow['id']; ?>"></td>
                                        <td style="float:left;width: 21%">
                                            <div class="row">
                                                <div class="col-xs-3 col-md-3 on-break-tab"><?php echo substr(ucfirst($PostRow['fname']), 0, 1) . '' . substr(ucfirst($PostRow['lname']), 0, 1) ?></div>
                                                <div class="col-xs-9 col-md-9">
                                                    <div><b style="color: #1b92da;"><?php echo ucfirst($PostRow['fname']) . ' ' . ucfirst($PostRow['lname']) ?></b></div>
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
                                            </div> 
                                        </td>
                                        <td class="tb-none tbl_sub_1 tb-sub" ><?php echo $PostRow['work_at']; ?></td>
                                        <!--<td class="tb-none tbl_sub_2 tb-sub"><?php echo $PostRow['access_level']; ?></td>-->
                                        <td class="tb-none tbl_sub_3 tb-sub" style="width: 14%"><?php echo $PostRow['email']; ?></td>
                                        <td class="tb-none tbl_sub_4 tb-sub"><?php echo $PostRow['mobile']; ?></td>
                                        <td class="tb-none tbl_sub_5 tb-sub"><?php echo $PostRow['stress_profile']; ?></td>
                                        <!--<td class="tb-none tbl_sub_6 tb-sub"><?php echo $PostRow['training']; ?></td>-->
                                        <td class="tb-none tbl_sub_7 tb-sub"><?php echo $PostRow['pay_rates']; ?></td>
                                        <!--<td class="tb-none tbl_sub_8"><?php echo $PostRow['time_s_e_code']; ?></td>-->
                                        <td style="float: right;width: 20%">
                                            <a class="btn btn-default" type="button" data-toggle="collapse" data-target="#" aria-expanded="true" onclick="ViewPeople(<?= $PostRow['id'] ?>)">View</a>
                                    <li class="dropdown">
                                        <a href="#" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false">Options<b class="caret"></b></a>
                                        <ul class="dropdown-menu" style="display: none;">
                                            <li><a href="#" onclick="EditPeople(<?= $PostRow['id'] ?>)">Edit</a></li>
                                            <li><a href="#" onclick="discardPeople(<?= $PostRow['id'] ?>)">Discard</a></li>
                                            <li><a href="#">Invite</a></li>
                                        </ul>
                                    </li>
                                    </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="modal fadeInUp center "  id="Add-People" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document" style="">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title center_bold" id="myModalLabel2" style="text-align: center;font-weight: bold;">Add</h2>
                </div>
                <form action="people" method="POST" data-parsley-validate>
                    <div class="modal-body" >
                        <div class="panel" >
                            <div class="panel-body" >
                                <section>
                                    <h5 class="m-sideReveal-profileEditHeader gray">PROFILE</h5><br>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Name</label>
                                                <div class="col-sm-4">
                                                    <input id="fname" type="text" name="fname" class="form-control form-radius"  placeholder="" required/>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input id="lname" type="text" name="lname" class="form-control form-radius"  placeholder="" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Email</label>
                                                <div class="col-sm-8">
                                                    <input id="email" type="email" name="email" class="form-control form-radius"  placeholder="" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Mobile</label>
                                                <div class="col-sm-8">
                                                    <input id="mobile" data-parsley-type="digits" type="text" name="mobile" class="form-control form-radius"  placeholder="" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section>
                                    <h5 class="m-sideReveal-profileEditHeader gray">JOB INFORMATION</h5><br>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label class="col-sm-4 control-label lbl-text-align">Access Level</label>
                                                <div class="col-sm-8">
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
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Works at</label>
                                                <div class="col-sm-8">
                                                    <select name="work_at[]"  id="work_at" multiple data-placeholder="Click to see available options..." class="chosen-select" required >
                                                        <?php
                                                        foreach ($CompanyWork as $value) {
                                                            ?>
                                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Stress Profile</label>
                                                <div class="col-sm-8">
                                                    <select name="stress_profile" id="stress_profile"  class="browser-default chosen-select form-control" style="padding-left: 10%;font-size: 16px;" required >
                                                        <?php
                                                        foreach ($StreetProfile as $ProfileValue) {
                                                            ?>
                                                            <option value="<?php echo $ProfileValue['name']; ?>"><?php echo $ProfileValue['name']; ?></option>
                                                        <?php } ?>                        <!--<option value="gandhi">gandhi</option>-->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Training</label>
                                                <div class="col-sm-8">
                                                    <select name="training[]"  id="training" multiple data-placeholder="Click to see available options..." class="chosen-select" >
                                                        <!--                                                        <option  value="" disabled > Choose Work At</option>-->
                                                        <option value="1">Whozoor.com Employee Training</option>
                                                        <option value="2">Whozoor.com Manager Training</option>

                                                    </select>
                                                    <!--<input id="training" type="text" name="training" class="form-control form-radius"  placeholder=""/>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section>
                                    <h5 class="m-sideReveal-profileEditHeader gray">PAY RATES</h5><br>
                                    <div class="col-sm-12">
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
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Weekday Rate</label>
                                                <div class="col-sm-8">
                                                    <input id="weekday_rate" data-parsley-type="digits" type="text" name="weekday_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 hourly">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Saturday Rate</label>
                                                <div class="col-sm-8">
                                                    <input id="saturday_rate" data-parsley-type="digits" type="text" name="saturday_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 hourly">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Sunday Rate</label>
                                                <div class="col-sm-8">
                                                    <input id="sunday_rate" data-parsley-type="digits" type="text" name="sunday_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 hourly">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Public Holiday Rate</label>
                                                <div class="col-sm-8">
                                                    <input id="public_h_rate" data-parsley-type="digits" type="text" name="public_h_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 hourlyplus" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Hourly Rate</label>
                                                <div class="col-sm-8">
                                                    <input id="hourly_rate" data-parsley-type="digits" type="text" value="" name="hourly_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 hourlyplus" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Overtime Rate</label>
                                                <div class="col-sm-8">
                                                    <input id="overtime_rate" type="text"  value="" name="overtime_rate" class="form-control form-radius"  placeholder="" readonly="" disabled="true"/>
                                                    <span style="float: right;color: #5c597a;font-size: 12px;">* x1.50 Base Rate</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 annual" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Annual Salary</label>
                                                <div class="col-sm-8">
                                                    <input id="annual_salary" data-parsley-type="digits" type="text" name="annual_salary" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 days" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Mondays</label>
                                                <div class="col-sm-8">
                                                    <input id="day_m_rate" data-parsley-type="digits" type="text" name="day_m_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 days" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Tuesdays</label>
                                                <div class="col-sm-8">
                                                    <input id="day_t_rate" data-parsley-type="digits" type="text" name="day_t_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 days" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Wednesdays</label>
                                                <div class="col-sm-8">
                                                    <input id="day_w_rate" data-parsley-type="digits" type="text" name="day_w_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 days" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Thursdays</label>
                                                <div class="col-sm-8">
                                                    <input id="day_th_rate" data-parsley-type="digits" type="text" name="day_th_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 days" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Fridays</label>
                                                <div class="col-sm-8">
                                                    <input id="day_f_rate" data-parsley-type="digits" type="text" name="day_f_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 days" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Saturdays</label>
                                                <div class="col-sm-8">
                                                    <input id="day_sat_rate" data-parsley-type="digits" type="text" name="day_sat_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 days" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Sundays</label>
                                                <div class="col-sm-8">
                                                    <input id="day_sun_rate" data-parsley-type="digits" type="text" name="day_sun_rate" class="form-control form-radius" maxlength="10"   placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 days" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Public Holidays</label>
                                                <div class="col-sm-8">
                                                    <input id="day_holi_rate" data-parsley-type="digits" type="text" name="day_holi_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
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
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Gender</label>
                                                <div class="col-sm-8">
                                                    <label class="radio-inline">
                                                        <input type="radio" id="" name="gender" value="Male">
                                                        Male
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" id="" name="gender" value="Female">
                                                        Female
                                                    </label>
                                                </div>
                                                <!--                                                    <button class="btn btn-default" type="button">  
                                                                                                     Male
                                                                                                    </button>
                                                                                                    <button class="btn btn-default" type="button">
                                                                                                        Female
                                                                                                    </button>-->

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Date of Birth</label>
                                                <div class="col-sm-8">
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
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Hired on</label>
                                                <div class="col-sm-8">
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
                                </section>

                                <section>
                                    <h5 class="m-sideReveal-profileEditHeader gray">MAIN ADDRESS</h5><br>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Address</label>
                                                <div class="col-sm-8">
                                                    <input id="address" type="text" name="address" class="form-control form-radius"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >City</label>
                                                <div class="col-sm-8">
                                                    <input id="city" type="text" name="city" class="form-control form-radius"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Country</label>
                                                <div class="col-sm-8">
                                                    <input id="country" type="text" name="country" class="form-control form-radius"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Postcode</label>
                                                <div class="col-sm-8">
                                                    <input id="postcode" data-parsley-type="digits" type="text" name="postcode" class="form-control form-radius"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section>
                                    <h5 class="m-sideReveal-profileEditHeader gray">EMERGENCY CONTACT</h5><br>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Emergency Contact Name</label>
                                                <div class="col-sm-8">
                                                    <input id="e_c_name" type="text" name="e_c_name" class="form-control form-radius"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Emergency Phone</label>
                                                <div class="col-sm-8">
                                                    <input id="e_phone" data-parsley-type="digits" type="text" name="e_phone" class="form-control form-radius"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12">
                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Save</button>
                            <input id="add_people" type="hidden" name="add_people" value="1"/>
                        </div> 
                    </div> 

                </form>

            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
    <div class="modal fadeInLeft right"  id="Edit-People" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3">
        <div class="modal-dialog" role="document" style="width: 360px;">

            <div class="modal-content ">

                <div class="modal-header">
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title center_bold" id="myModalLabel2" style="text-align: center;font-weight: bold;">Edit</h2>
                </div>
                <form action="people" method="POST" data-parsley-validate>
                    <div class="modal-body" >
                        <div class="panel" >
                            <div class="panel-body" >
                                <section>
                                    <h5 class="m-sideReveal-profileEditHeader gray">PROFILE</h5><br>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Name</label>
                                                <div class="col-sm-4">
                                                    <input id="fname" type="text" name="fname" class="form-control form-radius"  placeholder="" required/>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input id="lname" type="text" name="lname" class="form-control form-radius"  placeholder="" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Email</label>
                                                <div class="col-sm-8">
                                                    <input id="email" type="email" name="email" class="form-control form-radius"  placeholder="" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Mobile</label>
                                                <div class="col-sm-8">
                                                    <input id="mobile" data-parsley-type="digits" type="text" name="mobile" class="form-control form-radius"  placeholder="" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section>
                                    <h5 class="m-sideReveal-profileEditHeader gray">JOB INFORMATION</h5><br>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label class="col-sm-4 control-label lbl-text-align">Access Level</label>
                                                <div class="col-sm-8">
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
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Works at</label>
                                                <div class="col-sm-8">
                                                    <select name="work_at[]"  id="work_at" multiple data-placeholder="Click to see available options..." class="chosen-select" required >
                                                        <?php
                                                        foreach ($CompanyWork as $value) {
                                                            ?>
                                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Stress Profile</label>
                                                <div class="col-sm-8">
                                                    <select name="stress_profile" id="stress_profile"  class="browser-default chosen-select form-control" style="padding-left: 10%;font-size: 16px;" required >
                                                        <?php
                                                        foreach ($StreetProfile as $ProfileValue) {
                                                            ?>
                                                            <option value="<?php echo $ProfileValue['name']; ?>"><?php echo $ProfileValue['name']; ?></option>
                                                        <?php } ?>                        <!--<option value="gandhi">gandhi</option>-->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Training</label>
                                                <div class="col-sm-8">
                                                    <select name="training[]"  id="training" multiple data-placeholder="Click to see available options..." class="chosen-select" >
                                                        <!--                                                        <option  value="" disabled > Choose Work At</option>-->
                                                        <option value="1">Whozoor.com Employee Training</option>
                                                        <option value="2">Whozoor.com Manager Training</option>

                                                    </select>
                                                    <!--<input id="training" type="text" name="training" class="form-control form-radius"  placeholder=""/>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section>
                                    <h5 class="m-sideReveal-profileEditHeader gray">PAY RATES</h5><br>
                                    <div class="col-sm-12">
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
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Weekday Rate</label>
                                                <div class="col-sm-8">
                                                    <input id="weekday_rate" data-parsley-type="digits" type="text" name="weekday_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 hourly">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Saturday Rate</label>
                                                <div class="col-sm-8">
                                                    <input id="saturday_rate" data-parsley-type="digits" type="text" name="saturday_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 hourly">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Sunday Rate</label>
                                                <div class="col-sm-8">
                                                    <input id="sunday_rate" data-parsley-type="digits" type="text" name="sunday_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 hourly">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Public Holiday Rate</label>
                                                <div class="col-sm-8">
                                                    <input id="public_h_rate" data-parsley-type="digits" type="text" name="public_h_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 hourlyplus" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Hourly Rate</label>
                                                <div class="col-sm-8">
                                                    <input id="hourly_rate" data-parsley-type="digits" type="text" value="" name="hourly_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 hourlyplus" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Overtime Rate</label>
                                                <div class="col-sm-8">
                                                    <input id="overtime_rate" type="text"  value="" name="overtime_rate" class="form-control form-radius"  placeholder="" readonly="" disabled="true"/>
                                                    <span style="float: right;color: #5c597a;font-size: 12px;">* x1.50 Base Rate</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 annual" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Annual Salary</label>
                                                <div class="col-sm-8">
                                                    <input id="annual_salary" data-parsley-type="digits" type="text" name="annual_salary" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 days" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Mondays</label>
                                                <div class="col-sm-8">
                                                    <input id="day_m_rate" data-parsley-type="digits" type="text" name="day_m_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 days" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Tuesdays</label>
                                                <div class="col-sm-8">
                                                    <input id="day_t_rate" data-parsley-type="digits" type="text" name="day_t_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 days" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Wednesdays</label>
                                                <div class="col-sm-8">
                                                    <input id="day_w_rate" data-parsley-type="digits" type="text" name="day_w_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 days" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Thursdays</label>
                                                <div class="col-sm-8">
                                                    <input id="day_th_rate" data-parsley-type="digits" type="text" name="day_th_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 days" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Fridays</label>
                                                <div class="col-sm-8">
                                                    <input id="day_f_rate" data-parsley-type="digits" type="text" name="day_f_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 days" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Saturdays</label>
                                                <div class="col-sm-8">
                                                    <input id="day_sat_rate" data-parsley-type="digits" type="text" name="day_sat_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 days" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Sundays</label>
                                                <div class="col-sm-8">
                                                    <input id="day_sun_rate" data-parsley-type="digits" type="text" name="day_sun_rate" class="form-control form-radius" maxlength="10"   placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 days" style="display:none;">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Public Holidays</label>
                                                <div class="col-sm-8">
                                                    <input id="day_holi_rate" data-parsley-type="digits" type="text" name="day_holi_rate" class="form-control form-radius" maxlength="10"  placeholder=""/>
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
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Gender</label>
                                                <div class="col-sm-8">
                                                    <label class="radio-inline">
                                                        <input type="radio" id="" name="gender" value="Male">
                                                        Male
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" id="" name="gender" value="Female">
                                                        Female
                                                    </label>
                                                </div>
                                                <!--                                                    <button class="btn btn-default" type="button">  
                                                                                                     Male
                                                                                                    </button>
                                                                                                    <button class="btn btn-default" type="button">
                                                                                                        Female
                                                                                                    </button>-->

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Date of Birth</label>
                                                <div class="col-sm-8">
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
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Hired on</label>
                                                <div class="col-sm-8">
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
                                </section>

                                <section>
                                    <h5 class="m-sideReveal-profileEditHeader gray">MAIN ADDRESS</h5><br>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Address</label>
                                                <div class="col-sm-8">
                                                    <input id="address" type="text" name="address" class="form-control form-radius"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >City</label>
                                                <div class="col-sm-8">
                                                    <input id="city" type="text" name="city" class="form-control form-radius"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Country</label>
                                                <div class="col-sm-8">
                                                    <input id="country" type="text" name="country" class="form-control form-radius"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Postcode</label>
                                                <div class="col-sm-8">
                                                    <input id="postcode" data-parsley-type="digits" type="text" name="postcode" class="form-control form-radius"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section>
                                    <h5 class="m-sideReveal-profileEditHeader gray">EMERGENCY CONTACT</h5><br>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Emergency Contact Name</label>
                                                <div class="col-sm-8">
                                                    <input id="e_c_name" type="text" name="e_c_name" class="form-control form-radius"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="" class="col-sm-4 control-label lbl-text-align" >Emergency Phone</label>
                                                <div class="col-sm-8">
                                                    <input id="e_phone" data-parsley-type="digits" type="text" name="e_phone" class="form-control form-radius"  placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12">
                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Save</button>
                            <input id="add_people" type="hidden" name="add_people" value="1"/>
                        </div> 
                    </div> 

                </form>

            </div>
        </div><!-- modal-content -->
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
    <div class="modal fadeInUp left "  id="View-People" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
        <div class="modal-dialog " id="view-people_modal-dialog" role="document" style="">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title center_bold" id="myModalLabel2" style="text-align: center;font-weight: bold;">View</h4>
                </div>
                <form action="people" method="POST" data-parsley-validate>
                    <div class="modal-body" style="margin: 0px;padding: 2px;" >
                        <div class="panel"   >
                            <div class="panel-body" >
                                <section>
                                    <input type="hidden" id="hidid" name="hidid" value="">
                                    <h5 class="m-sideReveal-profileEditHeader gray">PROFILE</h5><br>
                                    <div class="col-lg-12 col-sm-12">
                                        <?php
                                        // echo _URL; $GLOBALS
                                        if (empty($ProfileData['photo'])) {
                                            $image = 'user.jpg';
                                        } else {
                                            $image = $ProfileData['photo'];
                                        }
                                        ?>
                                        <div class="col-lg-2 col-sm-2" style="text-align: left; ">
                                            <img id="imgTeamProfilePhoto" name="imgTeamProfilePhoto" class=" imgProfilePhoto m-team-photo--large" src=""  style="cursor: pointer;border: 2px dashed transparent;
                                                 border-radius: 50%;
                                                 border: 3px #ddd double;
                                                 display: inline-block;
                                                 position: relative;height: 60px;width: 60px;" >
                                        </div>
                                        <div class="col-lg-10 col-sm-10" id="PeopleDetails" style="text-align: center">
                                        </div>
                                    </div>
                                </section>





                            </div>
                        </div>
                        <div class="panel"   >
                            <div class="panel-body" >
                                <section>
                                    <div class="col-lg-12 col-sm-12">
                                        <b>Next 3 Shifts</b>
                                    </div>

                                    <div class="col-lg-12 col-sm-12"></div>
                                </section>
                            </div>
                        </div>
                        <div class="panel"   >
                            <div class="panel-body" >
                                <section>
                                    <div class="col-lg-12 col-sm-12">
                                        <b>Recent Time Sheets</b>
                                    </div>
                                    <div class="col-lg-12 col-sm-12"></div>
                                </section>
                            </div>
                        </div>
                        <div class="panel"   >
                            <div class="panel-body" >
                                <section>
                                    <div class="col-lg-12 col-sm-12">
                                        <b>Leave</b>
                                    </div>
                                    <div class="col-lg-12 col-sm-12" style="text-align: right">
                                        <a class="btn btn-primary btn-sm" href="#" onclick="callModalLeave()">Add New</a>
                                    </div>

                                </section>
                            </div>
                        </div>

                    </div>
                    <!--                    <div class="modal-footer">
                                            <div class="col-sm-12">
                                                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                <button class="btn btn-primary" type="submit">Save</button>
                                                <input id="add_people" type="hidden" name="add_people" value="1"/>
                                            </div> 
                                        </div> -->

                </form>

            </div>
        </div><!-- modal-content -->
    </div>
    <div class="modal fadeInUp center "  id="newLeave"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="min-width: 360px;">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">New Leave</h4>
                </div>

                <div class="modal-body" >
                    <div class="content-box-wrapper" >
                        <div class="panel">
                            <div class="panel-body">


                                <!--        <div class="example-box-wrapper">
                                            <button class="btn btn-default btn-md" data-toggle="modal" data-target="#myModal"> Launch demo modal </button>
                                
                                        </div>-->
                                <!--<form  action="task"  id='task_form'>-->
                                <form action="leave" id="new_leave_form" method="post">
                                    <!--                                <div class="panel">
                                                                        <div class="panel-body">-->
                                    <h3 class="title-hero">
                                        New Leave Request
                                    </h3>
                                    <div class="content-box-wrapper" >
                                        <div class="panel">
                                            <div class="panel-body">
                                                <h3 class="title-hero">
                                                    First Day of Leave
                                                </h3>
                                                <div class="col-sm-12 col-lg-6">

                                                    <div class="form-group">
                                                        <!--<div class="input-group">-->

                                                        <label for="" class="col-sm-4 col-xs-4 control-label" style="line-height: 30px;">All Day</label>

                                                        <div class="col-sm-8 col-xs-8">
                                                            <div class="input-prepend input-group">
                                                                <span class="add-on input-group-addon">
                                                                    <i class="glyph-icon icon-calendar"></i>
                                                                </span>
                                                                <input type="text" id="mf_date" name="mf_date" class="bootstrap-datepicker  form-control " value="" data-date-format="YY/mm/dd">
                                                            </div>
                                                        </div>
                                                        <!--                                    <div class="btn-group col-lg-3 col-xs-12 col-sm-3" data-toggle="buttons" style="float: right;">
                                                                                                <a href="#" class="btn btn-default btn-sm">
                                                                                                    <input type="radio" name="start_day">
                                                                                                    No
                                                                                                </a>
                                                                                                <a href="#" class="btn btn-default btn-sm">
                                                                                                    <input type="radio" name="start_day">
                                                                                                    Yes
                                                                                                </a>
                                                                                            </div>-->


                                                        <!--</div>-->
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-4 col-xs-4 control-label">Starts</label>
                                                        <div class="col-sm-8 col-xs-8">
                                                            <div class="bootstrap-timepicker dropdown">
                                                                <input class="timepicker-example form-control totals" id="mf_time" name="mf_time" type="text" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div class="panel-body">
                                                <h3 class="title-hero">
                                                    Last Day of Leave
                                                </h3>
                                                <div class="col-sm-12 col-lg-6">

                                                    <div class="form-group">
                                                        <!--<div class="input-group">-->

                                                        <label for="" class="col-sm-4 col-xs-4 control-label" style="line-height: 30px;">All Day</label>

                                                        <div class="col-sm-8 col-xs-8">
                                                            <div class="input-prepend input-group">
                                                                <span class="add-on input-group-addon">
                                                                    <i class="glyph-icon icon-calendar"></i>
                                                                </span>
                                                                <input type="text" name="ml_date" id="ml_date" class="bootstrap-datepicker  form-control " value="" data-date-format="YY/mm/dd">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-4 col-xs-4 control-label">Ends</label>
                                                        <div class="col-sm-8 col-xs-8">
                                                            <div class="bootstrap-timepicker dropdown">
                                                                <input class="timepicker-example form-control totals" id="ml_time" name="ml_time" type="text" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div class="panel-body">
                                                <div class="col-sm-12 col-lg-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="" class="col-sm-4 col-xs-4 control-label">Day Total</label>
                                                        <div class="col-sm-8 col-xs-8">
                                                            <div class="control-label center-div">
                                                                <label for="" class="col-sm-4 col-xs-4 control-label  " id="mlbl_total">--</label>
                                                                <input type="hidden" value="" name="mhid_total" id="mhid_total">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <label for="" class="col-sm-4 control-label" >Notes</label>
                                                            <div class="col-sm-8">
                             <!--                                <span class="input-group-addon addon-inside bg-gray" role="title">
                                                                 <i class="">Notes</i>
                                                             </span>
                                                             <br/>-->
                                                            <!--<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">-->
                                                            <!--<input id="ast" type="search" name="ast" class="form-control" required  placeholder="Assign to Emplyoee"/>-->
                                                                <textarea name="mtxtnotes" placeholder="Notes here" id="mtxtnotes" maxlength="255" style="width: 100%;min-height: 100px;" required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-6 col-sm-12">
                                                    <div class="form-group">
                                                        <!--<div class="input-group">-->
                                                        <label class="col-sm-4 col-xs-4 control-label">Leave Type</label>
                                                        <div class="col-sm-8 col-xs-8">
                                                            <select name="mleave_type" id="mleave_type" class="chosen-select form-control" style="width:100%" >
                                                                <option selected disabled>Choose</option>
                                                                <option value="Unspecified">Unspecified</option>
                                                                <option value="Annual Leave(Vacation)">Annual Leave(Vacation)</option>
                                                                <option value="Unpaid Leave">Unpaid Leave</option>
                                                                <option value="Compassionation Leave">Compassionation Leave</option>
                                                                <option value="Community Service Leave">Community Service Leave</option>
                                                                <option value="Long Service Leave">Long Service Leave</option>
                                                                <option value="Time Of In Lieu">Time Of In Lieu</option>
                                                                <option value="Other Paid Leave">Other Paid Leave</option>
                                                            </select>
                                                            <!--</div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-6 col-sm-12">
                                                    <div class="form-group">
                                                        <!--<div class="input-group">-->
                                                        <?php
                                                        $emp = q("select * from tb_employee where access_level like '%manager%'" . helper::officeid());
//                                        d($emp);
                                                        ?>
                                                        <label class="col-sm-4 col-xs-4 control-label">Notify Manager</label>
                                                        <div class="col-sm-8 col-xs-8">
                                                            <select name="mnotifyby" id="mnotifyby" class="chosen-select form-control" style="width:100%" >
                                                                <option selected disabled>Choose</option>
                                                                <?php foreach ($emp as $value) { ?>

                                                                    <option value="<?= $value['id']; ?>"><?= $value['fname'] . ' ' . $value['lname'] ?></option>
                                                                    <?php
                                                                }
                                                                ?>


                                                            </select>
                                                            <!--</div>-->
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="" style="margin:  1rem;">
                                        <!--<div class="panel-body">-->
                                        <div style="clear: both"></div>
                                        <div class="col-lg-12 col-sm-12 center-div center-content">
                                            <button class="btn btn-primary col-sm-12 col-lg-3" type="submit" name="save" id="save" style="float: right;" onclick="DataSave()">Save changes</button>
                                        </div>
                                    </div>


                                    <!--                                    </div>
                                                                    </div>-->
                                </form>
                            </div>
                        </div>
                    </div>




                </div>
                <div class="col-sm-12 modal-footer " id="divbuttons" name="divbuttons">
                    <!--                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" type="button" name="Save" id="modalsave">Save</button>-->
                </div> 


            </div>
        </div><!-- modal-content -->
    </div>
    <div class="modal fadeInUp center "  id="strees_profile_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document" style="">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title center_bold" id="myModalLabel2" style="text-align: center;font-weight: bold;">Set Stress Profile</h2>
                </div>
                <form action="people" method="POST" id="StreetProfile_form">
                    <div class="modal-body" >
                        <div class="panel" >
                            <div class="panel-body" >
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-12 control-label" >Set Stress Profile to <span id="lbl_strees_profile_model"></span></label>
                                            <div class="col-sm-12">
                                                <select name="stress_profile_model" id="stress_profile_model"  class="browser-default chosen-select form-control" style="padding-left: 10%;font-size: 16px;" required >
                                                    <?php
                                                    foreach ($StreetProfile as $ProfileValue) {
                                                        ?>
                                                        <option value="<?php echo $ProfileValue['name']; ?>"><?php echo $ProfileValue['name']; ?></option>
                                                    <?php } ?>                        <!--<option value="gandhi">gandhi</option>-->
                                                </select>
                                                <!--<input id="stress_profile" type="text" name="stress_profile" class="form-control form-radius"  placeholder=""/>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12">
                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="button" onclick="StreesProfileModel();">Save</button>
                            <input id="ids_strees_profile_model" type="hidden" name="ids_strees_profile_model" value=""/>
                            <input id="counts_strees_profile_model" type="hidden" name="counts_strees_profile_model" value=""/>
                        </div> 
                    </div> 

                </form>

            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->

    <div class="modal fadeInUp center "  id="set_access_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document" style="">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title center_bold" id="myModalLabel2" style="text-align: center;font-weight: bold;">Set Access</h2>
                </div>
                <form action="people" method="POST" id="SetAccess_form">
                    <div class="modal-body" >
                        <div class="panel" >
                            <div class="panel-body" >
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label class="col-sm-12 control-label" >Set access to <span id="lbl_set_access_model"></span></label>
                                            <div class="col-sm-12">
                                                <select name="access_level" id="access_level" class="browser-default chosen-select form-control" style="width:100%" >
                                                    <option selected value="Employee">Employee</option>
                                                    <option value="Supervisor">Supervisor</option>
                                                    <option value="Location_Manager">Location Manager</option>
                                                    <option value="System_Administrator">System Administrator</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12">
                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="button" onclick="SetAccessModel();">Save</button>
                            <input id="ids_set_access_model" type="hidden" name="ids_set_access_model" value=""/>
                            <input id="counts_set_access_model" type="hidden" name="counts_set_access_model" value=""/>
                        </div> 
                    </div> 

                </form>

            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->

    <div class="modal fadeInUp center "  id="add_training_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document" style="">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title center_bold" id="myModalLabel2" style="text-align: center;font-weight: bold;">Add Training</h2>
                </div>
                <form action="people" method="POST" id="AddTraining_form">
                    <div class="modal-body" >
                        <div class="panel" >
                            <div class="panel-body" >
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-12 control-label" >Add Training to <span id="lbl_add_training_model"></span></label>
                                            <div class="col-sm-12">
                                                <select name="training_model[]"  id="training_model" multiple data-placeholder="Click to see available options..." class="chosen-select" required="true">
                                                    <!--                                                        <option  value="" disabled > Choose Work At</option>-->
                                                    <option value="1">Whozoor.com Employee Training</option>
                                                    <option value="2">Whozoor.com Manager Training</option>

                                                </select>
                                                <span style="color: red;" id="error_trainig_model"></span>
                                                <!--<input id="training" type="text" name="training" class="form-control form-radius"  placeholder=""/>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12">
                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="button" onclick="AddTrainingModel();">Save</button>
                            <input id="ids_add_training_model" type="hidden" name="ids_add_training_model" value=""/>
                            <input id="counts_add_training_model" type="hidden" name="counts_add_training_model" value=""/>
                        </div> 
                    </div> 

                </form>

            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->


    <div class="modal fadeInUp center "  id="set_rate_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document" style="">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title center_bold" id="myModalLabel2" style="text-align: center;font-weight: bold;">Set Rates</h2>
                </div>
                <form action="people" method="POST" id="SetRate_form">
                    <div class="modal-body" >
                        <div class="panel" >
                            <div class="panel-body" >
                                <label class="col-sm-12 control-label" style="margin-left: 10px;font-weight: bold;">Set rates for <span id="lbl_set_rate_model"></span></label>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label class="col-sm-12 control-label">Pay Rates</label>
                                            <div class="col-sm-12">
                                                <select name="pay_rates_model" id="pay_rates_model" class="browser-default chosen-select form-control" style="width:100%" >
                                                    <option selected value="Hourly">Hourly</option>
                                                    <option value="Hourly_overtime">Hourly (40 h + 1.5 x Overtime)</option>
                                                    <option value="Rate_per_day">Rates per day</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 hourly_model">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-4 control-label lbl-text-align" >Weekday Rate</label>
                                            <div class="col-sm-8">
                                                <input id="weekday_rate_model" type="text" name="weekday_rate_model" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 hourly_model">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-4 control-label lbl-text-align" >Saturday Rate</label>
                                            <div class="col-sm-8">
                                                <input id="saturday_rate_model" type="text" name="saturday_rate_model" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 hourly_model">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-4 control-label lbl-text-align" >Sunday Rate</label>
                                            <div class="col-sm-8">
                                                <input id="sunday_rate_model" type="text" name="sunday_rate_model" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 hourly_model">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-4 control-label lbl-text-align" >Public Holiday Rate</label>
                                            <div class="col-sm-8">
                                                <input id="public_h_rate_model" type="text" name="public_h_rate_model" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span style="color:red" id="error_hourly"></span>
                                <div class="col-sm-12 hourlyplus_model" style="display:none;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-4 control-label lbl-text-align" >Hourly Rate</label>
                                            <div class="col-sm-8">
                                                <input id="hourly_rate_model" type="text" value="" name="hourly_rate_model" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 hourlyplus_model" style="display:none;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-4 control-label lbl-text-align" >Overtime Rate</label>
                                            <div class="col-sm-8">
                                                <input id="overtime_rate_model" type="text"  value="" name="overtime_rate_model" class="form-control form-radius"  readonly=""/>
                                                <span style="float: right;color: #5c597a;font-size: 12px;">* x1.50 Base Rate</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span style="color:red" id="error_Hourly_overtime"></span>
                                <div class="col-sm-12 days_model" style="display:none;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-4 control-label lbl-text-align" >Mondays</label>
                                            <div class="col-sm-8">
                                                <input id="day_m_rate_model" type="text" name="day_m_rate_model" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 days_model" style="display:none;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-4 control-label lbl-text-align" >Tuesdays</label>
                                            <div class="col-sm-8">
                                                <input id="day_t_rate_model" type="text" name="day_t_rate_model" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 days_model" style="display:none;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-4 control-label lbl-text-align" >Wednesdays</label>
                                            <div class="col-sm-8">
                                                <input id="day_w_rate_model" type="text" name="day_w_rate_model" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 days_model" style="display:none;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-4 control-label lbl-text-align" >Thursdays</label>
                                            <div class="col-sm-8">
                                                <input id="day_th_rate_model" type="text" name="day_th_rate_model" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 days_model" style="display:none;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-4 control-label lbl-text-align" >Fridays</label>
                                            <div class="col-sm-8">
                                                <input id="day_f_rate_model" type="text" name="day_f_rate_model" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 days_model" style="display:none;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-4 control-label lbl-text-align" >Saturdays</label>
                                            <div class="col-sm-8">
                                                <input id="day_sat_rate_model" type="text" name="day_sat_rate_model" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 days_model" style="display:none;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-4 control-label lbl-text-align" >Sundays</label>
                                            <div class="col-sm-8">
                                                <input id="day_sun_rate_model" type="text" name="day_sun_rate_model" class="form-control form-radius" maxlength="10"   placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 days_model" style="display:none;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-4 control-label lbl-text-align" >Public Holidays</label>
                                            <div class="col-sm-8">
                                                <input id="day_holi_rate_model" type="text" name="day_holi_rate_model" class="form-control form-radius" maxlength="10"  placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span style="color:red" id="error_Rate_per_day"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12">
                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="button" onclick="SetRateModel();">Save</button>
                            <input id="ids_set_rate_model" type="hidden" name="ids_set_rate_model" value=""/>
                            <input id="counts_set_rate_model" type="hidden" name="counts_set_rate_model" value=""/>
                        </div> 
                    </div> 

                </form>

            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->

    <div class="modal fadeInUp center "  id="send_message_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document" style="">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title center_bold" id="myModalLabel2" style="text-align: center;font-weight: bold;">Create Post</h2>
                </div>
                <form action="people" method="POST">
                    <div class="modal-body" >
                        <div class="panel" >
                            <div class="panel-body" >
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-6 control-label" >Share With</label>
                                            <label for="" class="col-sm-6 control-label" style="text-align: right;color: #988b8b;" >sharing with <span id="lbl_send_message_model"></span></label>
                                            <div class="col-sm-12">
                                                <select name="selectedPPL[]" id="selectedEMP" multiple data-placeholder="Select Some People..." class="form-control chosen-select">

                                                    <option label="All"  value="*">All</option>

                                                    <optgroup label="Locations">

                                                        <?php
                                                        foreach ($PostResult as $empval) {
                                                            ?>
                                                            <option  id="<?= $empval['id'] ?>" value="<?= $empval['id'] ?>"><?= $empval['fname'] . " " . $empval['lname'] ?></option>
                                                            <?php
                                                        }
                                                        ?>

                                                    </optgroup>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="col-sm-12"> 
                                                <textarea name="" id="" class="form-control" placeholder="What's happening?" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="col-sm-3"> 
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-default btn-file" style="border-color: #afafaf;">
                                                        <span class="fileinput-new"><i class="fa fa-paperclip"></i>Add Media</span>
                                                        <span class="fileinput-exists"></span>
                                                        <input type="file" name="..." class="btn btn-default">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9"> 
                                                <spna style="color: #988b8b;">Drag & drop files here. JPG, PNG and PDFs are accepted. Maximum of 4 files.</spna>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="col-sm-3"> 
                                                <div class="bootstrap-switch-container">
                                                    <input  type="checkbox" data-on-color="success" name="checkbox-example-3" class="input-switch" checked="" data-size="medium" data-on-text="On" data-off-text="Off">
                                                </div>
                                            </div>
                                            <div class="col-sm-9"> 
                                                <label>
                                                    Require confirmation from all readers
                                                    <p style="color:#988b8b;">All readers will be required to mark this post as confirmed. You can track who has and hasn’t confirmed.</p>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12">
                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Post</button>
                            <input id="ids_send_message_model" type="hidden" name="" value=""/>
                            <input id="counts_send_message_model" type="hidden" name="" value=""/>
                        </div> 
                    </div> 

                </form>

            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->


    <div class="modal fadeInUp center "  id="send_invitation_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document" style="">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title center_bold" id="myModalLabel2" style="text-align: center;font-weight: bold;">Send Invitation</h2>
                </div>
                <form action="people" method="POST">
                    <div class="modal-body" >
                        <div class="panel" >
                            <div class="panel-body" >
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="padding">
                                                <h3>Invite <span id="lbl_send_invitation_model"></span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12">
                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Send</button>
                            <input id="ids_send_invitation_model" type="hidden" name="" value=""/>
                            <input id="counts_send_invitation_model" type="hidden" name="" value=""/>
                        </div> 
                    </div> 

                </form>

            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
    <style>

        #Edit-People{
            float: right;
            position: fixed;
            /*left: 65%;*/
            right: 0px;

        }
    </style>