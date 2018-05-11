<form id="logged_form" action="test_rules" method="POST">
    <div class="panel" style="margin: 0px;padding: 0px">
        <!--<div class="panel-body">-->
        <div class="panel-body">
            <div>
                <div class="col-lg-12 col-sm-12">
                    <h3 style="font-weight: bold;color: #00c6ff">Search  </h3>
                </div>
                <div class="col-lg-12 col-sm-12 ">
                    <hr>
                </div>
                <div class="col-lg-12 col-sm-12">
                    <div class="col-lg-3">
                        <?php
                        $allCompany = q("select * from tb_company_works");
                        ?>
                        <select class="form-control mySelect" id="ser_company" name="ser_company">
                            <option selected disabled>Choose Company</option>
                            <?php foreach ($allCompany as $company) { ?>
                                <option value="<?= $company['id'] ?>" ><?= $company['name'] ?></option>
                                <?php
                            }
                            ?>

                        </select>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control mySelect locationTeam" id="ser_location" name="ser_location">
                            <option selected disabled>Choose Location</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control mySelect locationTeam" id="ser_team" name="ser_team">
                            <option selected disabled>Choose Team</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control mySelect" id="ser_employee" name="ser_employee">
                            <option selected disabled>Choose Employee</option>
                        </select>
                    </div>

                </div>
            </div>
        </div>
        <!--</div>-->

    </div>
    <!--<div style=" ">-->

    <div class="" style="float: left; width: calc(32% - 5px)">
        <div class=" panel" style="margin: 0px;padding: 0px;">
            <div class="panel-body" style="margin: 0px;">
                <div class="col-lg-12 col-sm-12">
                    <h5 style="font-weight: bold;color: #00c6ff">Add Status  </h5>
                </div>
                <div class="col-lg-12 col-sm-12 ">
                    <hr>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label for="" class="col-sm-6 control-label" style="line-height: 30px;">Date:</label>
                        <label for="" class="col-sm-6 control-label" style="line-height: 30px;">Time:</label>
                        <div class="col-sm-6">
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon">
                                    <i class="glyph-icon icon-calendar"></i>
                                </span>
                                <input type="text" class="bootstrap-datepicker bootstrap-datetimepicker-widget form-control" placeholder="DD-MM-YYYY " id="dateofshift" name="dateofshift" value="" data-date-format="dd-mm-yyyy" required>
                            </div>
                            <span id="error_start_date" style="color:red;"></span>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon">
                                    <i class="glyph-icon icon-clock-o"></i>
                                </span>
                                <input type="text" class=" form-control" id="txttime" name="txttime" value="" placeholder="2300 or 23:00" minlength="4"   required pattern="^(?:[01]\d|2[0-3])(?::?[0-5]\d)?$">
                            </div>
                            <span id="error_end_date" style="color:red;"></span>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="col-sm-6">

                            <select class="form-control chosen-select" id="status" name="status" required>
                                <option selected disabled value="">Choose Status</option>
                                <option value="CHECKEDIN">CHECKEDIN</option>
                                <option value="BRIEFCASEIN">BRIEFCASEIN</option>
                                <option value="TIMEOUTIN">TIMEOUTIN</option>
                                <option value="LUNCHOUT">LUNCHOUT</option>
                                <option value="LUNCHIN">LUNCHIN</option>
                                <option value="BRIEFCASEOUT">BRIEFCASEOUT</option>
                                <option value="TIMEOUTOUT">TIMEOUT</option>
                                <option value="CHECKOUT">CHECKOUT</option>

                            </select>
                            <span id="error_end_date" style="color:red;"></span>
                        </div>
                        <div class="col-sm-6" >

                            <input type="submit" value="Save" class="btn btn-primary" title="Save Records" style="width: 100%" id="submitbuttons" onclick=""/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 ">
                    <hr>
                </div>
                <div class="col-lg-12 col-sm-12 " id="tblsummary" style="">
                    <h5>Choose Employee For Summary</h5>
                </div>
            </div>
        </div>
    </div>
    <div class=" " style="float: right; width: calc(68%)">
        <div class=" panel" style="margin: 0px;">
            <div class="panel-body">
                <div class="col-lg-9 col-sm-12">
                    <h5 style="font-weight: bold;color: #00c6ff">Rules: </h5>
                    <div>
                        <div>
                            <a href="javascript:show_custom_values('rules_schedule');" >Schedule</a> | 
                            <a href="javascript:show_custom_values('rules_tolerance');">Late Arrival</a> | 
                            <a href="javascript:show_custom_values('rules_tolerance_ed');">Early Departure</a> | 
                            <a href="javascript:show_custom_values('rules_OT');">OT</a>
                        </div>

                        <div style="margin-top:15px;font-weight:normal;color:#777">
                            <div id="rules_schedule" class="rules_custom_values">
                                <input  style="float: left;width:300px;margin:0px 5px;" type="text"  class="form-control form-radius"  id="starttime" name="starttime" value="<?php print date("Y-m-d") ?> 09:00"     >
                                <input  style="float: left;width:300px;margin:0px 5px;" type="text"   class="form-control form-radius" id="endtime" name="endtime" value="<?php print date("Y-m-d") ?> 17:00"   >
                                <!--<div><input type="checkbox" name="schedule_overnight" id="schedule_overnight" value="1" /> Overight schedule?</div> -->
                            </div>

                            <?php /* LATE ARRIVAL STARTS */ ?>
                            <div id="rules_tolerance" class="rules_custom_values">
                                <table width="100%"  border="0" class="rule_table" style="border-collapse: collapse">
                                    <tr>
                                        <td width="300">Late arrival tolerance allowed: </td>
                                        <td>
                                            <input type="radio" class="" name="late_arrival_tolerance" value='yes' id="late_arrival_tolerana_yes" /> YES
                                            <input type="radio" class="" name="late_arrival_tolerance" value='no' checked id="late_arrival_tolerana_no" /> NO
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="300">Late arrival tolerance minutes: </td>
                                        <td>
                                            <input type="text" class="form-control form-radius" name="late_arrival_tolerance_minutes" value='15' id="late_arrival_tolerana_minutes" style='width:100px' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            If truancy <b>exceeds</b> tolerance option: </td>
                                        <td>
                                            <input type="radio" class="" name="late_arrival_truancy" value='difference' checked id="late_arrival_difference_late" /> Mark the difference as late
                                            <input type="radio" class="" name="late_arrival_truancy" value='entire' id="late_arrival_entire_time_late" /> The entire time is marked as late
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php /* LATE ARRIVIVAL ENDS ENDS */ ?>


                            <?php /* EARLY DEPARTURE STARTS */ ?>
                            <div id="rules_tolerance_ed" class="rules_custom_values">
                                <table width="100%"  border="0" class="rule_table" style="border-collapse: collapse">
                                    <tr>
                                        <td width="300">Early departure tolerance allowed: </td>
                                        <td>
                                            <input type="radio" class="" name="early_departure_tolerance" value='yes' id="early_departure_tolerana_yes" /> YES
                                            <input type="radio" class="" name="early_departure_tolerance" value='no' checked id="early_departure_tolerana_no" /> NO
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="300">Early departure tolerance minutes: </td>
                                        <td>
                                            <input type="text" class="form-control form-radius" name="early_departure_tolerance_minutes" value='15' id="early_departure_tolerana_minutes" style='width:100px' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            If early departure <b>exceeds</b> tolerance option: </td>
                                        <td>
                                            <input type="radio" class="" name="early_departure_truancy" value='difference' checked id="early_departure_difference_late" /> Mark the difference as early departure
                                            <input type="radio" class="" name="early_departure_truancy" value='entire' id="early_departure_entire_time_late" /> The entire time is marked as early dep
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php /* EARLY DEPARTURE ENDS */ ?>



                            <?php /* OT STARTS */ ?>

                            <div id="rules_OT" class="rules_custom_values">
                                <table width="40%"  border="0" class="rule_table" style="border-collapse: collapse;float:left;margin-right:20px;">
                                    <tr><td colspan="2" style="background-color: #ffeec6;text-align: center">OT MAX</td></tr>
                                    <tr>
                                        <td width="40%">Auth for OT?</td>
                                        <td>
                                            <input type="radio" class="" name="ot_auth_main" value='yes' id="ot_auth_main_yes" /> YES
                                            <input type="radio" class="" name="ot_auth_main" value='no' checked id="ot_auth_main_no" /> NO
                                        </td>
                                    </tr>
                                    <!--<tr>
                                        <td >Auth OT Prior: </td>
                                        <td>
                                            <input type="radio" class="" name="ot_auth_prior" value='yes' id="ot_auth_prior_yes" /> YES
                                            <input type="radio" class="" name="ot_auth_prior" value='no' checked id="ot_auth_prior_no" /> NO
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >Auth OT Post: </td>
                                        <td>
                                            <input type="radio" class="" name="ot_auth_post" value='yes' id="ot_auth_post_yes" /> YES
                                            <input type="radio" class="" name="ot_auth_post" value='no' checked id="ot_auth_post_no" /> NO
                                        </td>
                                    </tr> --> 
                                    <tr>
                                        <td >Total OT Prior: </td>
                                        <td>
                                            <input type="text" class="" name="ot_auth_prior_total" value='0' id="ot_auth_prior_total" />
                                        </td>
                                    </tr>                                      
                                    <tr>
                                        <td >Total OT Post: </td>
                                        <td>
                                            <input type="text" class="" name="ot_auth_post_total" value='0' id="ot_auth_post_total" />
                                        </td>
                                    </tr>    
                                    <tr>
                                        <td >Daily Max OT: </td>
                                        <td>
                                            <input type="text" class="" name="ot_auth_daily_max" value='0' id="ot_auth_daily_max" /> <br />
                                            <span style="font-size:10px;color:#BBB">If Daily Max OT is provided then above options (OT Prior/Post) will not be applied</span>
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <td >No Max: </td>
                                        <td>
                                            <input type="checkbox" class="" name="ot_auth_no_max" value='1' checked="checked"  id="ot_auth_no_max" /> <br />
                                        </td>
                                    </tr>                                    
                                </table>

                                <table width="50%"  border="0" class="rule_table" style="border-collapse: collapse;float:left">
                                    <tr><td colspan="2" style="background-color: #ffeec6;text-align: center;">OT MIN</td></tr>
                                    <tr>
                                        <td width="50%">&nbsp;-</td>
                                        <td>-
                                            <!--<input type="radio" class="" name="ot_auth_main_min" value='yes' id="ot_auth_main_min_yes" /> YES
                                            <input type="radio" class="" name="ot_auth_main_min" value='no' checked id="ot_auth_main__min_no" /> NO-->
                                        </td>
                                    </tr>
                                    <!--<tr>
                                        <td >Auth OT Prior: </td>
                                        <td>
                                            <input type="radio" class="" name="ot_auth_prior_min" value='yes' id="ot_auth_prior_min_yes" /> YES
                                            <input type="radio" class="" name="ot_auth_prior_min" value='no' checked id="ot_auth_prior_min_no" /> NO
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >Auth OT Post: </td>
                                        <td>
                                            <input type="radio" class="" name="ot_auth_post_min" value='yes' id="ot_auth_post_min_yes" /> YES
                                            <input type="radio" class="" name="ot_auth_post_min" value='no' checked id="ot_auth_post_min_no" /> NO
                                        </td>
                                    </tr>  -->
                                    <tr>
                                        <td >Separate Before: </td>
                                        <td>
                                            <input type="text" class="" name="ot_auth_prior_total_min" value='0' id="ot_auth_prior_total_min" />
                                        </td>
                                    </tr>                                      
                                    <tr>
                                        <td >Separate After: </td>
                                        <td>
                                            <input type="text" class="" name="ot_auth_post_total_min" value='0' id="ot_auth_post_total_min" />
                                        </td>
                                    </tr>    
                                    <tr><td colspan="2" style="height:8px;padding:0px;"></td></tr>
                                    <tr>
                                        <td >Entire Day Min: </td>
                                        <td>
                                            <input type="text" class="" name="ot_auth_daily_min" value='0' id="ot_auth_daily_min" /> <br />
                                            <span style="font-size:10px;color:#BBB">If Daily MIN OT is provided then above options (OT Prior/Post) will not be applied</span>
                                        </td>
                                    </tr>   
                                    <tr>
                                        <td >No Min: </td>
                                        <td>
                                            <input type="checkbox" class="" name="ot_auth_no_min" value='1' checked="checked" id="ot_auth_no_min" /> <br />
                                        </td>
                                    </tr>                                        
                                </table>
                                <div style="clear:both">&nbsp;</div>
                            </div>
                            <?php /* OT ENDS */ ?>

                        </div>

                    </div>
                </div>
                <div class="col-sm-12 col-lg-3" >
                    <a class="btn btn-danger" style="float: right;" href="javascript:;" onclick="bindApplyRules($('#ser_employee').val())" id="approveBtn">
                        <i class="fa fa-calendar-check-o"></i>
                        Approve Timesheet</a>
                </div>
                <div class="col-lg-12 col-sm-12 ">
                    <hr>
                </div>
                <div class="col-lg-12 col-sm-12 " id="applyRules">

                </div>
            </div>
        </div>
    </div>

    <!--</div>-->
</form>

<style type="text/css">
    table#tbl{
        margin-top: 0px !important;
    }
    .rules_custom_values{
        display:none;
    }
    .rule_table td{
        border:1px solid #DADADA;
        padding:5px;
    }
</style>

