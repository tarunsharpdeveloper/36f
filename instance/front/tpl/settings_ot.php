<div class="panel">
    <div class="panel-body">
        <div class="panel-body">
            <div>
                <div class="col-lg-12 col-sm-12">
                    <h3 style="font-weight: bold;color: #00c6ff">OT Settings  </h3>
                </div>
                <div class="col-lg-12 col-sm-12 ">
                    <hr>
                </div>
                <form action="settings_ot" method="POST" id="form_setting">
                    <table class="table table-bordered">
                        <tr>
                            <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Auth for OT: 
                                    <!--<i class="fa fa-question-circle" title="This is how many days OFF your FULL TIME employees will earn. Please either enter the days allotted per month or year" data-toggle="tooltip" ></i>-->
                                </span><br />
                            </td>
                            <td width="60%" style="padding: 10px 20px;">
                                <div class="input-group" style="float: left; margin-right: 10px; width: calc(70% - 10px);">
                                    <div class="input-group" style="float: left; margin-right: 10px; width: calc(80% - 10px);">
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="rbt_authYes" name="rbt_auth" value="yes" class="rbt_auth" >
                                            Yes&nbsp;&nbsp;&nbsp;
                                        </label>
                                        <label class="radio-inline float-left">
                                            <input type="radio" id="rbt_authNo" name="rbt_auth" value="no" class="rbt_auth" checked>
                                            No &nbsp;&nbsp;&nbsp;
                                        </label>
                                    </div>
                                    <div class="input-group" style="float: left; margin-left: 10px; width: calc(30% - 10px);"  >

                                    </div>

                                </div>
                            </td>
                        </tr>
                    </table>
                    <div  id="authDiv" hidden style="margin-top: -20px; " class="">
                        <table class="table table-bordered" style="padding: 0px 0px;margin: 0px;">
                            <tr>
                                <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                    <span style="font-size: 14px;font-weight: bold;color: #2D6BA0"></span><br />
                                </td>
                                <td width="60%" style="padding: 10px 20px;">
                                    <div class="row" style="padding: 10px 0px;">

                                        <table class="table table-bordered" style="padding: 0px 0px;">
                                            <tr>
                                                <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                                    <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Monthly max allowed OT: 
                                                        <!--<i class="fa fa-question-circle" title="This is how many days OFF your FULL TIME employees will earn. Please either enter the days allotted per month or year" data-toggle="tooltip" ></i>-->
                                                    </span><br />
                                                </td>
                                                <td width="60%" style="padding: 10px 20px;">
                                                    <div class="input-group" style="float: left; margin-right: 10px; width: calc(100% - 10px);">
                                                        <div class="input-group" style="float: left; margin-right: 10px; width: calc(90% - 10px);">
                                                            <label class="radio-inline float-left">
                                                                <input type="radio" id="rbt_monthYes" name="rbt_month" value="yes" class="rbt_month" checked>
                                                                Yes&nbsp;&nbsp;
                                                            </label>
                                                            <label class="radio-inline float-left">
                                                                <input type="radio" id="rbt_monthNo" name="rbt_month" value="no" class="rbt_month">
                                                                No &nbsp;&nbsp;
                                                            </label>
                                                            <div id="rbt_monthdiv" hidden style="float: left; margin-left: 10px;line-height: 30px; ">
                                                                <input id="txt_months" style="float: left;width:80px;" type="number" min="0" name="txt_months" class="form-control form-radius" step="0.5"  placeholder="" value="5"/>&nbsp;
                                                                <span> Hours</span>
                                                            </div>

                                                        </div>
                                                        <div class="input-group" style="float: left; margin-left: 10px; width: calc(10% - 10px);"  >

                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="40%" style="color: #545454;background-color: #F2F6F9">
                                                    <span style="font-size: 14px;font-weight: bold;color: #2D6BA0">Daily OT Settings: 
                                                        <!--<i class="fa fa-question-circle" title="This is how many days OFF your FULL TIME employees will earn. Please either enter the days allotted per month or year" data-toggle="tooltip" ></i>-->
                                                    </span><br />
                                                </td>
                                                <td width="60%" style="padding:  10px 20px;">
                                                    <table class="table table-bordered" style="padding: 0px 0px;">
                                                        <tr>
                                                            <td width="50%" style="color: #545454;background-color: #F2F6F9">Min</td>
                                                            <td width="50%" style="color: #545454;background-color: #F2F6F9">Max</td>
                                                        </tr>
                                                        <tr>
                                                            <td  style="" width="50%">
                                                                <div class="input-group" style="">
                                                                    <div class="input-group" style="float: left; margin-right: 10px; width: calc(90% - 10px);">
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rtb_min_nomin" name="rtb_min" value="nomin" class="rtb_min" >
                                                                            No Min&nbsp;&nbsp;
                                                                        </label>

                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td  style="" width="50%">
                                                                <div class="input-group" style="">
                                                                    <div class="input-group" style="float: left; margin-right: 10px; width: calc(90% - 10px);">
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rtb_max_nomin" name="rtb_max" value="nomin" class="rtb_max" >
                                                                            No Max&nbsp;&nbsp;
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td  style="" width="50%">
                                                                <div class="input-group" style="">
                                                                    <div class="input-group" style="float: left; margin-right: 10px; width: calc(100% - 10px);">
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rbt_min_entDay" name="rtb_min" value="entday" class="rtb_min" >
                                                                            Entire Day Min
                                                                        </label>
                                                                        <div id="min_entDayDiv" class="" hidden style="float: left; margin-left: 10px;line-height: 30px; ">
                                                                            <input id="txt_min_entday" style="float: left;width:80px;" type="number" min="0" name="txt_min_entday" class="form-control form-radius" step="0.5"  placeholder="" value="5"/>&nbsp;
                                                                            <span> Minutes</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td  style="" width="50%">
                                                                <div class="input-group" style="">
                                                                    <div class="input-group" style="float: left; margin-right: 10px; width: calc(100% - 10px);">
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rbt_max_entDay" name="rtb_max" value="entday" class="rtb_max" >
                                                                            Entire Day Max
                                                                        </label>
                                                                        <div id="max_entDayDiv" class="" hidden style="float: left; margin-left: 10px;line-height: 30px; ">
                                                                            <input id="txt_max_entday" style="float: left;width:80px;" type="number" min="0" name="txt_max_entday" class="form-control form-radius" step="0.5"  placeholder="" value="5"/>&nbsp;
                                                                            <span> Minutes</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td  style="" width="50%">
                                                                <div class="input-group" style="">
                                                                    <div class="input-group" style="">
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rbt_min_seprate" name="rtb_min" value="sep" class="rtb_min" >
                                                                            Seperate Before/After
                                                                        </label>
                                                                        <br/>
                                                                        <div id="min_sep_div" hidden style="padding:20px; margin-left: 10px;line-height: 30px; ">
                                                                            <input id="txt_min_prior" style="float: left;width:80px;" type="number" min="0" name="txt_min_prior" class="form-control form-radius" step="0.5"  placeholder="" value="5"/>&nbsp;
                                                                            <span> Prior</span>
                                                                            <br/>
                                                                            <br/>
                                                                            <input id="txt_min_post" style="float: left;width:80px;" type="number" min="0" name="txt_min_post" class="form-control form-radius" step="0.5"  placeholder="" value="5"/>&nbsp;
                                                                            <span> Post</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td  style="" width="50%">
                                                                <div class="input-group" style="">
                                                                    <div class="input-group" style="">
                                                                        <label class="radio-inline float-left">
                                                                            <input type="radio" id="rbt_max_seprate" name="rtb_max" value="sep" class="rtb_max" >
                                                                            Seperate Before/After
                                                                        </label>
                                                                        <br/>
                                                                        <div id="max_sep_div" hidden style="padding:20px; margin-left: 10px;line-height: 30px; ">
                                                                            <input id="txt_max_prior" style="float: left;width:80px;" type="number" min="0" name="txt_max_prior" class="form-control form-radius" step="0.5"  placeholder="" value="5"/>&nbsp;
                                                                            <span> Prior</span>
                                                                            <br/><br />
                                                                            <input id="txt_max_post" style="float: left;width:80px;" type="number" min="0" name="txt_max_post" class="form-control form-radius" step="0.5"  placeholder="" value="5"/>&nbsp;
                                                                            <span> Post</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <table class="table " style="margin-top: -20px; ">

                        <tr>
                            <td colspan="2"  style="text-align: right;"> 
                                <input type="hidden" name="isUpdated" id="isUpdated" value="no" />
                                <span id="waitText" style="line-height: 28px;color: #545454;"></span> &nbsp;&nbsp;&nbsp;&nbsp;<input class=" btn btn-primary" title="Save Default Settings" style="float: right;" id="submitbutton" type="submit" value="Save Settings" />
                            </td>
                        </tr>
                    </table>
                </form>

            </div>
        </div>
    </div>
</div>

<style>
    table#tbl{
        margin-top: 0px !important;
    }</style>