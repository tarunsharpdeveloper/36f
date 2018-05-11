<div class="panel">
    <div class="panel-body">
        <div class="panel-body">
            <div>
                <div class="col-lg-12 col-sm-12">
                    <h3 style="font-weight: bold;color: #00c6ff">Advanced Settings  </h3>
                </div>
                <div class="col-lg-12 col-sm-12 ">
                    <hr>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a  href="#1" data-toggle="tab">Lunch Settings</a>
                    </li>
                    <li><a href="#2" data-toggle="tab"> Kasreh Kaar Settings</a>
                    </li>
                    <li><a href="#3" data-toggle="tab"> Other Settings</a>
                    </li>
                </ul>
                <div class="tab-content ">
                    <div class="tab-pane active" id="1" style="padding-left:  0px;">
                        <form action="daily_karkaard" method="POST" id="form_lunchsetting">
                            <table class="table table-bordered">
                                <tr>
                                    <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                        <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Set Lunch Duration</span><br />
                                        would you like to set Lunch Duration On?<br />
                                        ex: 30 minutes (Total Minutes for lunch)
                                    </td>
                                    <td width="60%">

<!--<input type="text" name="taxLabel[0][value]" value="ajsd" style="border: 1px solid rgb(218, 218, 218);font-size: 14px;margin-top: 13px;  padding: 0 5px;width: 98%;">-->
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="rbtLunchOn" name="rbtLunch" value="on" class="rbtLunch">
                                            On &nbsp;&nbsp;&nbsp;
                                        </label>
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="rbtLunchOff" name="rbtLunch" value="off" class="rbtLunch" checked>
                                            Off&nbsp;&nbsp;&nbsp;
                                        </label>
                                        <div class="col-lg-12" id="setLunchDiv"  style="margin-top: 10px;padding: 0px;" hidden >
                                            <!--<label for="" class="col-lg-12 col-sm-12 control-label lbl-text-align" style="">Set Lunch Time</label>-->
                                            <input id="set_lunch_time"  type="text" name="set_lunch_time" class="form-control form-radius"   placeholder="Set Lunch Time"  style="width:100%;" />
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                        <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Set specific Lunch Time</span><br />
                                        would you like to set Specific Lunch Time On?<br />
                                        ex: Start Time:07:20 | End Time: 05:30
                                    </td>
                                    <td width="60%">
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="rbtLunchTimeOn" name="rbtLunchTime" value="on" class="rbtLunchTime">
                                            On &nbsp;&nbsp;&nbsp;
                                        </label>
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="rbtLunchTimeOn" name="rbtLunchTime" value="off" class="rbtLunchTime" checked>
                                            Off&nbsp;&nbsp;&nbsp;
                                        </label>
                                        <div class="col-lg-12" id="rbtLunchTimeDiv"  style="margin-top: 10px;padding: 0px;" hidden >
                                            <!--<label for="" class="col-lg-12 col-sm-12 control-label lbl-text-align" style="">Set Lunch Time</label>-->
                                            <div class="col-lg-6" style="padding-left: 0px;"> 
                                                <input id="lunch_start_time"  type="text" name="lunch_start_time" class=" form-control form-radius"   placeholder="Lunch Start Time"  style="width:100%;" />
                                            </div>
                                            <div class="col-lg-6" style="padding-right:  0px;">  
                                                <input id="lunch_end_time"  type="text" name="lunch_end_time" class="form-control form-radius"   placeholder="Lunch End Time"  style="width:100%;" />
                                            </div>
                                        </div> 
                                    </td>
                                </tr>

                                <tr>
                                    <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                        <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Lunch Break deducted from total</span><br />
                                        would you like to deduct Lunch Break?
                                    </td>
                                    <td width="60%">
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="rbtLunchdeductOn" name="rbtLunchdeduct" value="on" class="rbtLunchdeduct">
                                            On &nbsp;&nbsp;&nbsp;
                                        </label>
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="rbtLunchdeductOff" name="rbtLunchdeduct" value="off" class="rbtLunchdeduct" checked>
                                            Off&nbsp;&nbsp;&nbsp;
                                        </label>
                                    </td>
                                </tr>
                                <tr >
                                    <!--<td width="40%" colspan="1"></td>-->
                                    <td colspan="2"  style="text-align: right;"> 
                                        <input type="hidden" name="isUpdated" id="isUpdatedLunch" value="" />
                                        <span id="waitText" class="waitText" style="line-height: 28px;color: #545454;"></span> &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input class=" btn btn-primary" title="Save Default Settings" style="float: right;" type="submit" value="Save Settings" id="savesettingsLunch" />
                                    </td>
                                </tr>



                            </table>
                            <!--                        <div class="col-lg-12 col-sm-12 " style="padding-left:  0px;">
                                                        <div class="col-sm-6 col-lg-6" style="padding-left:  0px;">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <label for="" class="col-lg-6 col-sm-6 control-label lbl-text-align" style="">Set Lunch Duration</label>
                                                                    <div class="col-sm-6 col-lg-6">
                            
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rbtLunchOn" name="rbtLunch" value="on" class="rbtLunch">
                                                                            On &nbsp;&nbsp;&nbsp;
                                                                        </label>
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rbtLunchOff" name="rbtLunch" value="off" class="rbtLunch" checked>
                                                                            Off&nbsp;&nbsp;&nbsp;
                                                                        </label>
                                                                        <div class="col-lg-12" id="setLunchDiv"  style="margin: 0px;padding: 0px;" hidden >
                                                                            <label for="" class="col-lg-12 col-sm-12 control-label lbl-text-align" style="">Set Lunch Time</label>
                                                                            <input id="set_lunch_time"  type="text" name="set_lunch_time" class="form-control form-radius"   placeholder="Set Lunch Time" required style="width:100%;" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="clear: both"></div>
                                                        <div class="col-sm-6 col-lg-6" style="padding-left:  0px;">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <label for="" class="col-lg-6 col-sm-6 control-label lbl-text-align" style="">Set specific Lunch Time</label>
                                                                    <div class="col-sm-6 col-lg-6">
                            
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rbtLunchTimeOn" name="rbtLunchTime" value="on" class="rbtLunchTime">
                                                                            On &nbsp;&nbsp;&nbsp;
                                                                        </label>
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rbtLunchTimeOn" name="rbtLunchTime" value="off" class="rbtLunchTime" checked>
                                                                            Off&nbsp;&nbsp;&nbsp;
                                                                        </label>
                                                                        <div class="col-lg-12" id="rbtLunchTimeDiv"  style="margin: 0px;padding: 0px;" hidden >
                                                                            <label for="" class="col-lg-12 col-sm-12 control-label lbl-text-align" style="">Set Lunch Time</label>
                                                                            <div class="col-lg-6" style="padding-left: 0px;"> 
                                                                                <input id="lunch_start_time"  type="text" name="lunch_start_time" class=" form-control form-radius"   placeholder="Lunch Start Time" required style="width:100%;" />
                                                                            </div>
                                                                            <div class="col-lg-6" style="padding-right:  0px;">  
                                                                                <input id="lunch_end_time"  type="text" name="lunch_end_time" class="form-control form-radius"   placeholder="Lunch End Time" required style="width:100%;" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="clear: both"></div>
                                                        <div class="col-sm-6 col-lg-6" style="padding-left:  0px;">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <label for="" class="col-lg-6 col-sm-6 control-label lbl-text-align" style="">Lunch Break deducted from total</label>
                                                                    <div class="col-sm-6 col-lg-6">
                            
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rbtLunchdeductOn" name="rbtLunchdeduct" value="on" class="rbtLunchdeduct">
                                                                            On &nbsp;&nbsp;&nbsp;
                                                                        </label>
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rbtLunchdeductOff" name="rbtLunchdeduct" value="off" class="rbtLunchdeduct" checked>
                                                                            Off&nbsp;&nbsp;&nbsp;
                                                                        </label>
                            
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="clear: both"></div>
                                                        <div class="col-lg-4 col-sm-12 ">
                                                            <a href="javascript:void(0);" class=" btn btn-primary" title="Save Default Settings" style="width: 100%;">
                                                                Save Settings
                                                            </a>
                                                        </div>
                                                    </div>-->
                        </form>
                    </div>
                    <div class="tab-pane" id="2"  style="padding-left:  0px;">
                        <form action="daily_karkaard" method="POST" id="form_karkaard">
                            <table class="table table-bordered">
                                <tr>
                                    <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                        <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Default Daily Karkaard</span><br />
                                        <!--                                    would you like to set Lunch Duration On?<br />
                                                                            ex: 30 minutes (Total Minutes for lunch)-->
                                    </td>
                                    <td width="60%">
                                        <input id="default_kakaard"  type="text" name="default_kakaard" class="form-control form-radius"   placeholder="07:20" required style=" width:100% ;"/>
                                        <br/>
                                        <div class="checkbox-info" style="height: 15px;">
                                            <label style="color: #888">
                                                <input type="checkbox" class="custom-checkbox selectall " id="checkboxDefault">The Default all same as daily karkaard
                                                <input type="hidden" class="" id="chkAllDefault" name="chkAllDefault" value="">
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered">
                                <tr>
                                    <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                        <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Illness Extended</span><br />
                                        <!--                                    would you like to set Specific Lunch Time On?<br />
                                                                            ex: Start Time:07:20 | End Time: 05:30-->
                                    </td>
                                    <td width="60%" style="padding-left: 0px;">
                                        <div class="col-lg-6 col-sm-6">
                                            <label class=" control-label lbl-text-align" style="color:#888">Deduct</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtIllnessOn" name="rbtIllness" value="on" class="rbtIllness" >
                                                    As a Shift &nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtIllnessOff" name="rbtIllness" value="off" class="rbtIllness defaultrbt" checked>
                                                    Custom&nbsp;&nbsp;&nbsp;
                                                </label>
                                                <div class="col-lg-12 col-sm-12" hidden id="illnessDivs" style="padding:5px 0px 0px 0px;">
                                                    <input id="txt_custome_illness"  type="text" name="txt_custome_illness" class="form-control form-radius txtdefault"   placeholder="07:20"  style="width:100%;"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div style="clear: both;height: 10px;"></div>
                                        <div class="col-lg-6 col-sm-6">
                                            <label style="color: #888">
                                                If illness falls between Holidays
                                            </label>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtIllnessDeductOff" name="rbtIllnessDeduct" value="off" class="rbtIllnessDeduct" >
                                                    Dont Deduct &nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtIllnessDeductOn" name="rbtIllnessDeduct" value="on" class="rbtIllnessDeduct " checked>
                                                    Deduct&nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                        <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">TimeOff (Without Payment)</span><br />
                                        <!--                                    would you like to set Specific Lunch Time On?<br />
                                                                            ex: Start Time:07:20 | End Time: 05:30-->
                                    </td>
                                    <td width="60%" style="padding-left: 0px;">
                                        <div class="col-lg-6 col-sm-6">
                                            <label class=" control-label lbl-text-align" style="color:#888">Deduct</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtTimeOffOn" name="rbtTimeOff" value="on" class="rbtTimeOff bydefaultrbt" checked>
                                                    As a Shift &nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtTimeOffOff" name="rbtTimeOff" value="off" class="rbtTimeOff defaultrbt" >
                                                    Custom&nbsp;&nbsp;&nbsp;
                                                </label>
                                                <div class="col-lg-12 col-sm-12" hidden id="TimeOffDivs" style="padding:5px 0px 0px 0px;">
                                                    <input id="txt_custome_deduct"  type="text" name="txt_custome_deduct" class="form-control form-radius txtdefault"   placeholder="07:20"  style="width:100%;"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div style="clear: both;height: 10px;"></div>
                                        <div class="col-lg-6 col-sm-6">
                                            <label style="color: #888">
                                                If timeoff falls between Holidays
                                            </label>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtTimeOffDeductOff" name="rbtTimeOffDeduct" value="off" class="rbtTimeOffDeduct" checked>
                                                    Dont Deduct &nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtTimeOffDeductOn" name="rbtTimeOffDeduct" value="on" class="rbtTimeOffDeduct" >
                                                    Deduct&nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                        <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Sick Time</span><br />
                                        <!--                                    would you like to set Specific Lunch Time On?<br />
                                                                            ex: Start Time:07:20 | End Time: 05:30-->
                                    </td>
                                    <td width="60%" style="padding-left: 0px;">
                                        <div class="col-lg-6 col-sm-6">
                                            <label class=" control-label lbl-text-align" style="color:#888">Deduct</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtSickOn" name="rbtSick" value="on" class="rbtSick bydefaultrbt" checked>
                                                    As a Shift &nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtSickOff" name="rbtSick" value="off" class="rbtSick defaultrbt" >
                                                    Custom&nbsp;&nbsp;&nbsp;
                                                </label>
                                                <div class="col-lg-12 col-sm-12" hidden id="sickDivs" style="padding:5px 0px 0px 0px;">
                                                    <input id="txt_custome_sick"  type="text" name="txt_custome_sick" class="form-control form-radius txtdefault"   placeholder="07:20"  style="width:100%;"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div style="clear: both;height: 10px;"></div>
                                        <div class="col-lg-6 col-sm-6">
                                            <label style="color: #888">
                                                If Sick Time falls between Holidays
                                            </label>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtSickDeductOff" name="rbtSickDeduct" value="off" class="rbtSickDeduct" checked>
                                                    Dont Deduct &nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtSickDeductOn" name="rbtSickDeduct" value="on" class="rbtSickDeduct" >
                                                    Deduct&nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                        <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Job Abandonment Deduction</span><br />
                                        <!--                                    would you like to set Specific Lunch Time On?<br />
                                                                            ex: Start Time:07:20 | End Time: 05:30-->
                                    </td>
                                    <td width="60%" style="padding-left: 0px;">
                                        <div class="col-lg-6 col-sm-6">
                                            <label class=" control-label lbl-text-align" style="color:#888">Deduct</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtJobOn" name="rbtJob" value="on" class="rbtJob"  >
                                                    As a Shift &nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtJobOff" name="rbtJob" value="off" class="rbtJob defaultrbt bydefaultrbt" checked >
                                                    Custom&nbsp;&nbsp;&nbsp;
                                                </label>
                                                <div class="col-lg-12 col-sm-12" hidden id="jobDivs" style="padding:5px 0px 0px 0px;">
                                                    <input id="txt_custome_job"  type="text" name="txt_custome_job" class="form-control form-radius txtdefault"   placeholder="07:20"  style="width:100%;"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div style="clear: both;height: 10px;"></div>
                                        <div class="col-lg-6 col-sm-6">
                                            <label style="color: #888">
                                                If Job falls between Holidays
                                            </label>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtJobDeductOff" name="rbtJobDeduct" value="off" class="rbtJobDeduct" >
                                                    Dont Deduct &nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtJobDeductOn" name="rbtJobDeduct" value="on" class="rbtJobDeduct" checked>
                                                    Deduct&nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                        <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Dayoff (With Payment)</span><br />
                                        <!--                                    would you like to set Specific Lunch Time On?<br />
                                                                            ex: Start Time:07:20 | End Time: 05:30-->
                                    </td>
                                    <td width="60%" style="padding-left: 0px;">
                                        <div class="col-lg-6 col-sm-6">
                                            <label class=" control-label lbl-text-align" style="color:#888">Deduct</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtDayoffOff" name="rbtDayoff" value="on" class="rbtDayoff bydefaultrbt" checked>
                                                    As a Shift &nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtDayoffOn" name="rbtDayoff" value="off" class="rbtDayoff defaultrbt" >
                                                    Custom&nbsp;&nbsp;&nbsp;
                                                </label>
                                                <div class="col-lg-12 col-sm-12" hidden id="DayoffDivs" style="padding:5px 0px 0px 0px;">
                                                    <input id="txt_custome_dayoff"  type="text" name="txt_custome_dayoff" class="form-control form-radius txtdefault"   placeholder="07:20"  style="width:100%;"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div style="clear: both;height: 10px;"></div>
                                        <div class="col-lg-6 col-sm-6">
                                            <label style="color: #888">
                                                If Dayoff falls between Holidays
                                            </label>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtDayoffDeductOff" name="rbtDayoffDeduct" value="off" class="rbtDayoffDeduct " checked>
                                                    Dont Deduct &nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtDayoffDeductOn" name="rbtDayoffDeduct" value="on" class="rbtDayoffDeduct" >
                                                    Deduct&nbsp;&nbsp;&nbsp;
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr >
                                    <!--<td width="40%" colspan="1"></td>-->
                                    <td colspan="2"  style="text-align: right;"> 
                                        <input type="hidden" name="isUpdated" id="isUpdatedKasreh" value="" />
                                        <span id="waitText" class="waitText" style="line-height: 28px;color: #545454;"></span> &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input class=" btn btn-primary" title="Save Default Settings" style="float: right;" type="submit" value="Save Settings" id="savesettingsKasreh" />
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="tab-pane" id="3">
                        <form action="daily_karkaard" method="POST" id="form_othersetting">
                            <table class="table table-bordered">
                                <tr>
                                    <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                        <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Thursday deducted as Whole day option </span><br />
                                        <!--                                    would you like to set Lunch Duration On?<br />
                                                                            ex: 30 minutes (Total Minutes for lunch)-->
                                    </td>
                                    <td width="60%">
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="rbtvactionOn" name="rbtvaction" value="on" class="rbtvaction">
                                            On &nbsp;&nbsp;&nbsp;
                                        </label>
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="rbtvactionOff" name="rbtvaction" value="off" class="rbtvaction" checked>
                                            Off&nbsp;&nbsp;&nbsp;
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                        <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Sick Time ceiling</span><br />
                                        <!--                                    Day per Month<br />
                                                                            Day per Year<br />-->
                                        <!--                                    ex: Start Time:07:20 | End Time: 05:30-->
                                    </td>
                                    <td width="60%">

                                        <label for="" class="col-lg-6 col-sm-6 control-label lbl-text-align" style="color: #888; padding-left: 0px;">Day per Month</label>
                                        <label for="" class="col-lg-6 col-sm-6 control-label lbl-text-align" style="color: #888;">Day per calender year</label>
                                        <div class=" col-lg-6 col-sm-6  " style="padding-left: 0px;">
                                            <input id="day_permonth"  type="text" name="day_permonth" class="form-control form-radius"   placeholder="07:20" required style="width:100%;" />
                                        </div>
                                        <div class=" col-lg-6 col-sm-6  " >
                                            <input id="day_peryear"  type="text" name="day_peryear" class="form-control form-radius"   placeholder="07:20" required style="width:100%;" />
                                        </div>
                                        <div class="clearfix" style="clear: both;height: 10px;"></div>
                                        <div class="form-group col-lg-6 col-sm-6 " style="padding-left: 0px;">
                                            <div class="checkbox-info" style="height: 15px; display: inline">
                                                <label style="color: #888">
                                                    <input type="checkbox" class="custom-checkbox types " id="chkFlexible" name="types" value="Flexible">Flexible
                                                </label>
                                            </div>
                                            &nbsp;&nbsp;&nbsp;
                                            <div class="checkbox-info" style="height: 15px;display: inline">
                                                <label style="color: #888  ">
                                                    <input type="checkbox" class="custom-checkbox types " id="chkStrict" name="types" value="Strict">Strict
                                                </label>
                                            </div>

                                        </div>
                                        <div class="form-group col-lg-6 col-sm-6">
                                            <!--                                        <div class="checkbox-info" style="height: 15px;">
                                                                                        <label style="color: #888">
                                                                                            <input type="checkbox" class="custom-checkbox selectall " id="checkbox">Strict
                                                                                        </label>
                                                                                    </div>-->

                                        </div>

                                    </td>
                                </tr>

                                <tr >
                                    <!--<td width="40%" colspan="1"></td>-->
                                    <td colspan="2"  style="text-align: right;"> 
                                        <input type="hidden" name="isUpdated" id="isUpdatedOther" value="" />
                                        <span id="waitText" class="waitText" style="line-height: 28px;color: #545454;"></span> &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input class=" btn btn-primary" title="Save Default Settings" style="float: right;" type="submit" value="Save Settings" id="savesettingsOther"/>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <!--                        <div class="col-sm-6 col-lg-6" style="padding-left:  0px;">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <label for="" class="col-lg-6 col-sm-6 control-label lbl-text-align" style="">Thursday deducted as Whole day option </label>
                                                            <div class="col-sm-6 col-lg-6">
                        
                                                                <label class="radio-inline float-left">
                                                                    <input type="radio" id="rbtvactionOn" name="rbtvaction" value="on" class="rbtvaction">
                                                                    On &nbsp;&nbsp;&nbsp;
                                                                </label>
                                                                <label class="radio-inline float-left">
                                                                    <input type="radio" id="rbtvactionOff" name="rbtvaction" value="off" class="rbtvaction" checked>
                                                                    Off&nbsp;&nbsp;&nbsp;
                                                                </label>
                                                                                                        <div class="col-lg-12" id="setLunchDiv"  style="margin: 0px;padding: 0px;" hidden >
                                                                                                            <input id="set_lunch_time"  type="text" name="set_lunch_time" class="form-control form-radius"   placeholder="Set Lunch Time" required style="width:100%;" />
                                                                                                        </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="clear: both"> 
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="col-lg-12 col-sm-12 ">
                                                                    <label for="" class=" col-lg-12 col-sm-12 control-label lbl-text-align" style="padding: 10px 0px 0px 0px;margin-left: 0px;">Sick Time ceiling</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="col-lg-3 col-sm-3 ">
                                                                <input id="default_kakaard"  type="text" name="default_kakaard" class="form-control form-radius"   placeholder="07:20" required style="width:100%;" />
                                                            </div>
                                                            <label for="" class=" col-lg-9 col-sm-9 control-label lbl-text-align" style="padding: 10px 0px 0px 0px;margin-left: 0px;">Day per Month</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="col-lg-3 col-sm-3 ">
                                                                <input id="default_kakaard"  type="text" name="default_kakaard" class="form-control form-radius"   placeholder="07:20" required style="width:100%;" />
                                                            </div>
                                                            <label for="" class=" col-lg-9 col-sm-9 control-label lbl-text-align" style="padding: 10px 0px 0px 0px;margin-left: 0px;">Day per calender year</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-3">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="checkbox-info" style="height: 15px;">
                                                                    <label style="color: #888">
                                                                        <input type="checkbox" class="custom-checkbox selectall " id="checkbox">Flexible
                                                                    </label>
                                                                </div>
                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-3">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="checkbox-info" style="height: 15px;">
                                                                    <label style="color: #888">
                                                                        <input type="checkbox" class="custom-checkbox selectall " id="checkbox">strict
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>