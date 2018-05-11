

<script type="text/javascript">
    function IsMobileNumber(phone) {
        var mob = /^[09]{1}[0-9]{9}$/;
        var txtMobile = document.getElementById(phone);
        if (mob.test(phone.value) == false) {
            // alert("Please enter valid mobile number.");
            phone.focus();


        }
        return true;
    }

    function IsNumeric(txb)
    {

        txb.value = txb.value.replace(/[^\0-9]{9}/ig, "");
        if (txb.value.length > 10) {

            txb.value = txb.value.replace(/[^\0-9]{9}/ig, "");
        }
        txb.focus();
    }

    function IsPlateNo(txb)
    {
        var x = txb.value;
        if (isNaN(x) || x.indexOf(" ") !== -1)
        {
            txb.value = txb.value.replace(/[^\0-9]{1}/ig, "");
            txb.focus();
        } else if (x.length < 10 || x.length > 10)
        {
//            alert("Enter must 10 digit Melli No");
            txb.value = txb.value.replace(/[^\0-9]{9}/ig, "");
            txb.focus();
        } else {

        }
        return false;
    }
    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.email(emailAddress);
    }

</script>

<script type="text/javascript">
    /* Datepicker bootstrap */
    $(function () {
        "use strict";
        $('.datepicker').datepicker({

            format: 'yyyy-mm-dd'
        });
    });
//    $(function () {
//        "use strict";
//        $('.bootstrap-datepicker').bsdatepicker({
//            format: 'yyyy-mm-dd'
//        }
//        });
//    });

</script>
<style>

    .ui-datepicker-week-end :hover {
        background-color: #808080;
    }
    .ui-datepicker-calendar tr:hover{
        background-color: #00CEB4;

    }
</style>
<style>

    .tb_div {
        border: 1px solid grey;
        cursor: pointer;
        float: left;
        padding: 0.8%;
        text-align: center;
        width: 14.285%;
    }
    .page-content
    {
        /*        min-height: min-content;
                height: 100%;*/
    }
    .calendar-time{
        display: none;
    }
    body{
        height: 100%;
    }
    .sidebar-nav-left{

        float: left;
        padding: 0px;
        margin: 0px;
        width: 20%;
        min-height: 450px;
        height: 100%;
        border: #F3F5F7 2px solid; 
    }
    .tab_left{
        float: left;
        padding: 1rem;
        margin:0 0 0 0px;
        width: 70%;
        /*min-height: max-content ;*/
        height: 100%;
        min-height: 200px;
        border: #F3F5F7 2px solid; 
        border-radius: 5% 5% 5% 5%;
    }
    .tab_right{
        float: right;
        padding: 10px;
        margin: 0px 0px 0 0px;
        width: 29%;
        /*min-height: max-content ;*/
        height: 100%;
        min-height: 230px;
        border: #F3F5F7 2px solid; 
        background-color: #FFFFFF;
        border-radius: 5% 5% 5% 5%;
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
    .pull-left{
        float: left !important;
    }
    .tab-content div{
        /*padding-left:*/
        margin:  1px 0px ;
    }
    .main-content{
        float: left;margin: 0;padding: 0;min-height: min-content;min-width: 100%;
        /*background-color: mistyrose;*/
    }
    .myborder{
        border: 2px solid #F0F2F4;
    }
    .tb_months{
        float: left;
        width: 3.33%;
        /*height: 60px;*/
        line-height: 38px;
        border: 1px solid #F0F2F4;
        min-height: min-content;
        border: 1px grey solid;
        text-align: center;
        padding: 1%;
        cursor: pointer;
    }
    .tb_months > .fa:hover{
        color: black;
    }
    tbody> tr{

    } 
    tbody> tr > td{
        height:60px;

    } 
    .unselectable {
        -moz-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;

        /*
          Introduced in IE 10.
          See http://ie.microsoft.com/testdrive/HTML5/msUserSelect/
        */
        -ms-user-select: none;
        user-select: none;
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
        height: 25px;
        width: 25px;font-weight: bold;
        background-color: #e9e9e9;
        font-size: 12px;
        line-height: 25px;
        text-transform: uppercase;
        padding: 0px;
        text-align: center;
    }
    .label{
        width: 100%;
        display: block;
        margin: 0.2em;
    }
</style>
<div class="panel" style="margin-bottom: 0px;">
    <div class="panel-body" style="left:-35px;">
        <div class="col-lg-12 col-sm-12">
            <div class="btn-group " style="">
                <div class="col-sm-12 " style="" >
                    <h1>Schedule</h1>     
                </div>
            </div>
        </div>
    </div>

    <div class="panel" style="margin: 0px;padding: 0px;">

        <div class="panel-body" style="margin:10px 10px;padding: 0px;">
            <form name="form_save" id="form_save" action="POST" >
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="" class="col-sm-4 control-label" >Template Name</label>
                            <div class="col-sm-4">
                                <input id="template_name" type="text" name="template_name" class="form-control" required  placeholder="Name"/>
                            </div>

                            <div class="col-sm-4"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <!--                <div class="form-group">
                                        <div class="input-group">-->
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <label for="" class="col-sm-12 control-label" >Start</label>
                    </div>

                    <div class="col-sm-4">
                        <label for="" class="col-sm-12 control-label" >End</label>
                    </div>
                    <!--                    </div>
                                    </div>-->
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="col-sm-4">
                                <label for="" class=" control-label right" style="text-align: center;">Monday</label>
                            </div>
                            <div class="col-sm-4">
                                <input id="mon_start" type="text" name="mon_start" class="form-control" required  placeholder="Monday start"/>
                            </div>

                            <div class="col-sm-4">
                                <input id="mon_end" type="text" name="mon_end" class="form-control" required  placeholder="Monday end"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="" class="col-sm-4 control-label right" style="align-content: flex-end">Tuesday</label>
                            <div class="col-sm-4">
                                <input id="tue_start" type="text" name="tue_start" class="form-control" required  placeholder="Tuesday start"/>
                            </div>

                            <div class="col-sm-4">
                                <input id="tue_end" type="text" name="tue_end" class="form-control" required  placeholder="Tuesday end"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="" class="col-sm-4 control-label right" style="align-content: flex-end">Wednesday</label>
                            <div class="col-sm-4">
                                <input id="wed_start" type="text" name="wed_start" class="form-control" required  placeholder="Wednesday start"/>
                            </div>

                            <div class="col-sm-4">
                                <input id="wed_end" type="text" name="wed_end" class="form-control" required  placeholder="Wednesday end"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="" class="col-sm-4 control-label right" style="align-content: flex-end">Thursday</label>
                            <div class="col-sm-4">
                                <input id="thu_start" type="text" name="thu_start" class="form-control" required  placeholder="Thursday start"/>
                            </div>

                            <div class="col-sm-4">
                                <input id="thu_end" type="text" name="thu_end" class="form-control" required  placeholder="Thursday end"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="col-sm-4"> 
                                <label for="" class=" control-label right" style="align-content: center">Friday</label>
                            </div>
                            <div class="col-sm-4">
                                <input id="fri_start" type="text" name="fri_start" class="form-control" required  placeholder="Friday start"/>
                            </div>

                            <div class="col-sm-4">
                                <input id="fri_end" type="text" name="fri_end" class="form-control" required  placeholder="Friday end"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="col-sm-4"> 
                                <label for="" class=" control-label right" style="align-content: center">Saturday</label>
                            </div>
                            <div class="col-sm-4">
                                <input id="sat_start" type="text" name="sat_start" class="form-control" required  placeholder="Saturday start"/>
                            </div>

                            <div class="col-sm-4">
                                <input id="sat_end" type="text" name="sat_end" class="form-control" required  placeholder="Saturday end"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="col-sm-4"> 
                                <label for="" class=" control-label right" style="align-content: center">Sunday</label>
                            </div>
                            <div class="col-sm-4">
                                <input id="sun_start" type="text" name="sun_start" class="form-control" required  placeholder="Sunday start"/>
                            </div>

                            <div class="col-sm-4">
                                <input id="sun_end" type="text" name="sun_end" class="form-control" required  placeholder="Sunday end"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" style="text-align: right;">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="hidden" name="hideditID" id="hideditID" value=""/>
                            <input type="submit" class="btn btn-primary"  name="temp_save" value="Save" id="temp_save"/>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="panel" style="margin: 0px;padding: 0px;">

    <div class="panel-body" style="margin:10px 10px;padding: 0px;">
        <div class="col-lg-12 col-sm-12">
            <div class="btn-group " style="">
                <div class="col-sm-12 " style="" >
                    <h5>List Of Schedule</h5>     
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12" id="setTable"></div>
    </div>
</div>
<!-- Modal Structure -->
<!--Modal 1 -->
<!-- Modal -->
<div class="modal fadeIn center "  id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <form action="schedule_template" id="schedule_template_form">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="mymodalTitle" style="width: 50%;"><span>Click here to Title</span></h4>
                    <input type="hidden" name="hidtitle" id="hidtitle" value="">
                    <input type="hidden" name="hidshiftId" id="hidshiftId" value="">
                    <input type="hidden" name="hiduserId" id="hiduserId" value="">
                    <input type="hidden" name="hidtotalHour" id="hidtotalHour" value="">
                    <input type="hidden" name="hiddateDiff" id="hiddateDiff" value="">
                    <input type="hidden" name="hidenddateofshift" id="hidenddateofshift" value="">
                </div>

                <div class="modal-body" >
                    <div class="panel" >
                        <div class="panel-body" >


                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label" style="line-height: 30px;">Date:</label>
                                        <div class="col-sm-6">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon">
                                                    <i class="glyph-icon icon-calendar"></i>
                                                </span>
                                                <input type="text" class="bootstrap-datepicker bootstrap-datetimepicker-widget form-control" id="dateofshift" name="dateofshift" value="" data-date-format="yy-mm-dd">
                                            </div>
                                            <span id="error_start_date" style="color:red;"></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon">
                                                    <i class="glyph-icon icon-calendar"></i>
                                                </span>
                                                <input type="text" class="bootstrap-datepicker bootstrap-datetimepicker-widget form-control" id="enddateofshift" name="enddateofshift" value="" data-date-format="yy-mm-dd">
                                            </div>
                                            <span id="error_end_date" style="color:red;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <!--                            <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <div class="input-group">
                            
                                                                    <label class="control-label col-lg-6 col-sm-12" for="title">Title:</label>
                            
                                                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                                                        <input type="text" class="form-control" value="" name="title" id="title" placeholder="" required="" pattern="^(?:[01]\d|2[0-3])(?::?[0-5]\d)?-(?:[01]\d|2[0-3])(?::?[0-5]\d)?$" >
                                                                    </div>
                            
                                                                </div>
                                                            </div>
                            
                                                            
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <label for="" class="col-sm-4 control-label" >Assign To</label>
                                                                    <div class="col-sm-8">
                                                                        <span class="input-group-addon addon-inside bg-gray" role="title">
                                                                            <i class="">Assign To</i>
                                                                        </span>
                                                                        <br/>
                                                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                                                        <select name="emplist" id="emplist" class="form-control browser-default">
                                                                            <option selected disabled value="">Select Employee</option>
                         
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>-->
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label" style="line-height: 30px;">Time:</label>
                                        <div class="col-sm-4">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon">
                                                    <i class="glyph-icon icon-clock-o"></i>
                                                </span>
                                                <input class="form-control timepicker mContent" id="start_time" name="start_time" type="text" value="" required="" pattern="^(?:[01]\d|2[0-3])(?::?[0-5]\d)?$">

                                            </div>
                                            <span id="error_start_time" style="color:red;"></span>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon">
                                                    <i class="glyph-icon icon-clock-o"></i>
                                                </span>
                                                <input class="form-control timepicker mContent" id="end_time" name="end_time" type="text" value="" required="" pattern="^(?:[01]\d|2[0-3])(?::?[0-5]\d)?$">

                                            </div>
                                            <span id="error_end_time" style="color:red;"></span>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon" id="TotalHr">

                                                </span>
                                                <!--<input type="text" class="bootstrap-datepicker  form-control" id="enddateofshift" name="enddateofshift" value="" data-date-format="yy-mm-dd">-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 " >
                                <div class="form-group">
                                    <div class="input-group">
                                        <?php
                                        $location = q("select * from  tb_location where company_id='{$_SESSION['company']['id']}'");
                                        ?>
                                        <select class=" form-control chosen-select" multiple name="selectLocations[]" id="selectLocations">
                                            <!--<option selected value=""></option>-->
                                            <?php foreach ($location as $empval) {
                                                ?>

                                                <option value="<?= $empval['id'] ?>"  ><?php echo $empval['name'] ?></option>
                                                <?php
                                            }
                                            ?>

                                        </select>                   
                                    </div>
                                </div>
                                <span id="error_location" style="color:red;"></span>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label" >Shift Type</label>
                                        <div class="col-sm-12">

                                            <?php $shifttype = q("select * from tb_shift_type "); ?>
                                            <select name="selectShiftType" id="selectShiftType" class="form-control browser-default chosen-select">
                                                <?php
                                                foreach ($shifttype as $type) {
                                                    ?>

                                                    <option value="<?= $type['id'] ?>"  ><?php echo $type['shift_name'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Deduction Time</label>
                                        <div class="col-sm-12">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon">
                                                    <i class="glyph-icon icon-clock-o"></i>
                                                </span>
                                                <input id="deductTime" type="text" name="deductTime" class="form-control form-radius"  placeholder="" required />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label" >Notes</label>
                                        <div class="col-sm-12">
                                            <textarea name="md_txtnotes" placeholder="Notes here" id="md_txtnotes" maxlength="255" style="width: 100%;min-height: 100px;" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <style>
                                .colordiv{
                                    margin: 5px;
                                    border-radius: 5px;
                                }
                                .colordiv:hover{
                                    border-color: #182848;

                                }
                            </style>
                            <div class="col-sm-6">
                                <div class="form-group">

                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label" >Colors</label>
                                        <div class="btn-toolbar" role="toolbar">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-round colordiv" data-color="#B694D1" style="background-color: #B694D1;border-radius: 5px;"></button>
                                                <button type="button" class="btn btn-round colordiv" data-color="#E96E57" style="background-color: #E96E57;border-radius: 5px;"></button>
                                                <button type="button" class="btn btn-round colordiv" data-color="#FB9253" style="background-color: #FB9253;border-radius: 5px;"></button>
                                                <button type="button" class="btn btn-default colordiv" data-color="#60B86B" style="background-color: #60B86B;border-radius: 5px;"></button>
                                                <button type="button" class="btn btn btn-default colordiv" data-color="#39ACBF" style="background-color: #39ACBF;border-radius: 5px;"></button>
                                                <button type="button" class="btn btn btn-default colordiv" data-color="#FBB933" style="background-color: #FBB933;border-radius: 5px;"></button>
                                            </div>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn btn-default colordiv" data-color="#A6D06E" style="background-color: #A6D06E;border-radius: 5px;"></button>
                                                <button type="button" class="btn btn-default colordiv" data-color="#D2527F" style="background-color: #D2527F;border-radius: 5px;"></button>
                                                <button type="button" class="btn btn btn-default colordiv" data-color="#69C29A" style="background-color: #69C29A;border-radius: 5px;"></button>
                                                <button type="button" class="btn btn btn-default colordiv" data-color="#F98D00" style="background-color: #F98D00;border-radius: 5px;"></button>
                                                <button type="button" class="btn btn btn-default colordiv" data-color="#F0D014" style="background-color: #F0D014;border-radius: 5px;"></button>
                                                <button type="button" class="btn btn btn-default colordiv" data-color="#1E8BC3" style="background-color: #1E8BC3;border-radius: 5px;"></button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="hidshiftcolor" id="hidshiftcolor" value="#A6D06E"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-6" id="div_deleted" style="text-align: left;">
                        <a class="btn btn-danger" href="javascript:void();" onclick="deleteShift()">Click here to Delete Shift</a>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="button" onclick="UpdateShift($('#hidshiftId').val())" >Edit & Exit</button>
                        <input type="hidden" name="schedule_template_submit" id="schedule_template_submit" value="1">
                    </div> 
                </div> 


            </div>
        </form>
    </div><!-- modal-content -->
</div><!-- modal-dialog -->



<?php
//include _PATH . "instance/front/tpl/vehicle_plate_design.php" ?>