<div class="tab-pane active" id="2"  style="padding-left:  0px;">
    <form action="kardex" method="POST" id="form_setting">
        <table class="table table-bordered">
            <tr>
                <td width="40%" style="color: #545454;background-color: #F2F6F9">
                    <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Permitted Days Off <i class="fa fa-question-circle" title="This is how many days OFF your FULL TIME employees will earn. Please either enter the days allotted per month or year" data-toggle="tooltip" ></i></span><br />
                </td>
                <td width="60%" style="padding: 10px 20px;">
                    <div class="input-group" style="float: left; margin-right: 10px; width: calc(50% - 10px);">
                        <input type="text" class="form-control" value="2.5" id="txtPerMonth" name="txtPerMonth">
                        <span class="input-group-btn">
                            <button class="btn btn-gray" type="button">Per Month</button>
                        </span>
                    </div>
                    <div class="input-group" style="float: left; margin-left: 10px; width: calc(50% - 10px);">
                        <input type="text" class="form-control" value="30" id="txtPerYear" name="txtPerYear">
                        <span class="input-group-btn">
                            <button class="btn btn-gray" type="button">Per Year</button>
                        </span>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="40%" style="color: #545454;background-color: #F2F6F9">
                    <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Rollover at end of calendar year <i class="fa fa-question-circle" data-toggle="tooltip" title="This is how many days you will allow your employees to carry into the following year">&nbsp;</i></span><br />
                </td>
                <td width="60%" style="padding: 10px 20px;">
                    <div class="row">
                        <div class="col-lg-2" >
                            <div><input id="txtrollyear"  type="number" min="0" max="30" step="1" name="txtrollyear" class="form-control form-radius"   placeholder="" value="9"/></div>
                            <div> Days </div>
                        </div>
                        <div class="col-lg-1" >

                        </div>
                        <div class="col-lg-3" >
                            <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Rollover excess action:</span>
                        </div>
                        <div class="col-lg-4" >
                            <div>
                                <label class="radio-inline float-left">
                                    <input type="radio" id="excess" name="excess" value="yes" class="" checked>
                                    Pay Employee <i  class="fa fa-question-circle" data-toggle="tooltip" title="If selected, All days beyond will be separated & provided to you to include in the final payroll of the year">&nbsp;</i>
                                </label>
                            </div>
                            <div>
                                <label class="radio-inline float-left">
                                    <input type="radio" id="excess" name="excess" value="no" class="">
                                    Burn/Lose All Excess <i  class="fa fa-question-circle"  data-toggle="tooltip" title="If selected, All days beyond the amount entered above will be lost">&nbsp;</i>
                                </label>                            
                            </div>

                        </div>
                    </div>
                </td>
            </tr>

        </table>

        <div class="" id="accordion" style="margin: 0px 0px;">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
                            Advanced
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true">
                    <table class="table table-bordered" style="margin-top: 0px; ">
                        <tr>
                            <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Ceiling for HOURLY "time off with payment:</span><br />
                            </td>
                            <td width="60%" style="padding: 10px 20px;">
                                <div class="input-group" style="float: left; margin-right: 10px; width: calc(70% - 10px);">
                                    <div class="input-group" style="float: left; margin-right: 10px; width: calc(80% - 10px);">
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="rbtHRTimeOffOff" name="rbtHRTimeOff" value="off" class="rbtHRTimeOff" checked>
                                            Off&nbsp;&nbsp;&nbsp;
                                        </label>
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="rbtHRTimeOffOn" name="rbtHRTimeOff" value="on" class="rbtHRTimeOff">
                                            On &nbsp;&nbsp;&nbsp;
                                        </label>
                                        <div id="HRTimeOffdiv" hidden style="float: left; margin-left: 10px;line-height: 30px; ">
                                            <input id="txtHRTimeOff" style="float: left;width:80px;" type="number" min="0" name="txtHRTimeOff" class="form-control form-radius" step="0.5"  placeholder="" value="5"/>&nbsp;
                                            <span> Hours</span>
                                        </div>

                                    </div>
                                    <div class="input-group" style="float: left; margin-left: 10px; width: calc(30% - 10px);"  >

                                    </div>

                                </div>


                            </td>
                        </tr>
                        <tr>
                            <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Employees on extended illness or pregnant leave, should they earn accruals:</span><br />
                            </td>
                            <td width="60%" style="padding: 10px 20px;">
                                <div class="input-group" style="float: left; margin-right: 10px; width: calc(50% - 10px);">
                                    <div class="input-group" style="float: left; margin-right: 10px; width: calc(50% - 10px);">
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="rbtipaYes" name="rbtipa" value="Yes" class="rbtipa" >
                                            Yes&nbsp;&nbsp;&nbsp;
                                        </label>
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="rbtipaNo" name="rbtipa" value="No" class="rbtipa" checked>
                                            No &nbsp;&nbsp;&nbsp;
                                        </label>

                                    </div>


                                </div>
                            </td>
                        </tr>
                    </table>
                    <table class="table table-bordered" style="margin-bottom: 0px;">

                        <tr>
                            <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Allow negative vacation accruals:</span><br />
                            </td>
                            <td width="60%" style="padding: 10px 20px;">
                                <div class="input-group" style="float: left; margin-right: 10px; width: calc(50% - 10px);">
                                    <div class="input-group" style="float: left; margin-right: 10px; width: calc(50% - 10px);">
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="accrualsYes" name="accruals" value="yes" class="accruals" checked>
                                            Yes&nbsp;&nbsp;&nbsp;
                                        </label>
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="accrualsNo" name="accruals" value="no" class="accruals">
                                            No &nbsp;&nbsp;&nbsp;
                                        </label>

                                    </div>


                                </div>
                            </td>
                        </tr>
                    </table>
                    <div  id="options">
                        <table class="table table-bordered" style="padding: 0px 0px;margin: 0px;">

                            <tr>
                                <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                    <span style="font-size: 14px;font-weight: bold;color: #2D6BA0"></span><br />
                                </td>
                                <td width="60%" style="padding: 10px 20px;">
                                    <div class="row" style="padding: 10px 0px;">
                                        <div class="input-group" style="float: left; margin-right: 10px; width: calc(100% - 10px);">
                                            <div class="input-group" >
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtQA" name="rbtQ" value="QA" class="rbtQ" >
                                                    Allow Kardex to remain in negative mode&nbsp;&nbsp;&nbsp;
                                                </label>
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtQB" name="rbtQ" value="QB" class="rbtQ">
                                                    Deduct from Overtime &nbsp;&nbsp;&nbsp;
                                                </label>
                                                <label class="radio-inline float-left">
                                                    <input type="radio" id="rbtQC" name="rbtQ" value="QC" class="rbtQ">
                                                    Time Off Without Payment
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div  id="QA" class="sub_Q">
                                        <table class="table table-bordered" style="padding: 0px 0px;">
                                            <tr>
                                                <td width="80%" style="padding: 10px 20px;">
                                                    <div class="input-group" style="float: left; margin-right: 10px; width: calc(50% - 10px);">
                                                        <div class="input-group" >
                                                            <label class="radio-inline float-left">
                                                                <input type="radio" id="rbtcapAOff" name="rbtcapA" value="off" class="rbtcapA" checked>
                                                                No Cap&nbsp;
                                                            </label>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td width="80%" style="padding: 10px 20px;">
                                                    <div class="input-group" style="float: left; margin-right: 10px; width: calc(80% - 10px);">
                                                        <div class="input-group" >

                                                            <label class="radio-inline float-left">
                                                                <input type="radio" id="rbtcapAOn" name="rbtcapA" value="on" class="rbtcapA">
                                                                Custom Cap &nbsp;
                                                            </label>
                                                            <div id="capDivA" hidden  style="float: left; margin-left: 10px; line-height: 30px;">
                                                                <input id="txtcapA" style="float: left; width: 80px;" type="number" min="0" name="txtcapA" step="0.5" class="form-control form-radius ceilings"   placeholder="Day per Month" value="3"/>
                                                                <span> DAYS</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="input-group" style="float: left; margin-left: 10px; width: calc(10% - 10px);"  >

                                                    </div>


                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                    <div  id="QB" class="sub_Q">
                                        <table class="table table-bordered" style="padding: 0px 0px;">
                                            <tr>
                                                <td width="60%" style="padding: 10px 20px;">
                                                    <h3>Should it have a cap?</h3>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td width="60%" style="padding: 10px 20px;">
                                                    <div class="input-group" style="float: left; margin-right: 10px; width: calc(100% - 10px);">
                                                        <div class="input-group" >
                                                            <!--<label style="float: left;font-weight: bold;color: #888;padding-right: 10px;"> Ceiling    :</label>&nbsp;&nbsp;&nbsp;-->
                                                            <label class="radio-inline float-left">
                                                                <input type="radio" id="rbtceilingBOff" name="rbtceilingB" value="off" class="rbtceilingB" checked>
                                                                Employees have no max. timeoff in a month&nbsp;
                                                            </label>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="60%" style="padding: 10px 20px;">
                                                    <div class="input-group" style="float: left; margin-right: 10px; width: calc(100% - 10px);">
                                                        <div class="input-group">

                                                            <label class="radio-inline float-left">
                                                                <input type="radio" id="rbtceilingBOn" name="rbtceilingB" value="on" class="rbtceilingB">
                                                                Custom timeoff cap &nbsp;
                                                            </label>
                                                            <div id="ceilingdivB" hidden style="float: left; margin-left: 10px;line-height: 30px; ">
                                                                <input id="txtceilingB"  style="float: left;width: 80px;" type="number" min="0" step="0.5" name="txtceilingB" class="form-control form-radius ceilings"   placeholder="Day per Month" value="3"/>&nbsp;
                                                                <span> DAYS</span>
                                                            </div>
                                                        </div>
                                                        <!--                                                                            <div class="input-group" style="float: left; margin-left: 10px; width: calc(30% - 10px);"  >
                                                        
                                                                                                                                    </div>-->
                                                    </div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="60%" style="padding: 10px 20px;">
                                                    <h3>IF TIME OFF EXCEEDS THE OT</h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="60%" style="padding: 10px 20px;">
                                                    <div class="input-group" style="float: left; margin-right: 10px; width: calc(100% - 10px);">
                                                        <div class="input-group" >

                                                            <label class="radio-inline float-left">
                                                                <input type="radio" id="rbtOT1" name="rbtOT" value="OT1" class="rbtOT" checked>
                                                                allow kardex to remin negative with no cap&nbsp;
                                                            </label>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="60%" style="padding: 10px 20px;">
                                                    <div class="input-group" style="float: left; margin-right: 10px; width: calc(90% - 10px);">
                                                        <div class="input-group" >

                                                            <label class="radio-inline float-left">
                                                                <input type="radio" id="rbtOT2" name="rbtOT" value="OT2" class="rbtOT">
                                                                allow kardex to remin negative with a cap off&nbsp;
                                                            </label>
                                                            <div id="OTdiv" hidden  style="float: left; margin-left: 10px;line-height: 30px;">
                                                                <input id="txtOT2B" style="float: left; width: 80px;"  type="number" min="0" step="0.5" name="txtOT2B" class="form-control form-radius ceilings"   placeholder="Day per Month" value="3"/>&nbsp;
                                                                <span> DAYS</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--                                                                        <div class="input-group" style="float: left; margin-left: 10px; width: calc(30% - 10px);"  >
                                                    
                                                                                                                            </div>-->

                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="60%" style="padding: 10px 20px;">
                                                    <div class="input-group" style="float: left; margin-right: 10px; width: calc(100% - 10px);">
                                                        <div class="input-group" >

                                                            <label class="radio-inline float-left">
                                                                <input type="radio" id="rbtOT3" name="rbtOT" value="OT3" class="rbtOT">
                                                                Apply all as time off without payment&nbsp;
                                                            </label>
                                                        </div>
                                                    </div>


                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                    <!--                                                        <div  id="QC" class="sub_Q">
                                                                                                <table class="table table-bordered" style="padding: 0px 0px;">
                                                                                                    <tr>
                                                                                                        <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                                                                                            <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Days off without payment C:</span><br />
                                                                                                        </td>
                                                                                                        <td width="60%" style="padding: 10px 20px;">
                                                                                                            <div class="input-group" style="float: left; margin-right: 10px; width: calc(100% - 10px);">
                                                                                                                <div class="checkbox-info" style="height: 15px;">
                                    
                                                                                                                    <label style="color: #888">
                                                                                                                        <input type="checkbox" class="custom-checkbox selectall " id="checkboxDefault">All Hours As Days Off Without Payment
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="input-group" style="float: left; margin-left: 10px; width: calc(50% - 10px);">
                                    
                                                                                                            </div>
                                    
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </div>-->
                                </td>
                            </tr>
                        </table>

                    </div>

                </div>
            </div>
        </div>
        <table class="table " style="margin-top: -20px; ">

            <tr>
                <td colspan="2"  style="text-align: right;"> 
                    <input type="hidden" name="isUpdated" id="isUpdated" value="" />
                    <span id="waitText" style="line-height: 28px;color: #545454;"></span> &nbsp;&nbsp;&nbsp;&nbsp;<input class=" btn btn-primary" title="Save Default Settings" style="float: right;" id="submitbutton" type="submit" value="Save Settings" />
                </td>
            </tr>
        </table>
    </form>
    <div id="logged">

    </div>
</div>