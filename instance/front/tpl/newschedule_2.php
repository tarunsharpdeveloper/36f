

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


        <div class="col-lg-3 col-sm-12">
            <!--<div class="content-box-wrapper">-->
            <!--<div class="col-lg-4">-->

            <div class="btn-group " style="width: 90%">


                <div class="col-sm-12 " style="" >
                    <h1>ShiftPlanning</h1>     
                    <!--                    <div id="target">
                                            Right-click here
                                        </div>-->
                </div>
            </div>




            <!--</div>-->
        </div>


        <div class="col-lg-3 col-sm-12 ">
            <input type="hidden" name="currentSelect" id="currentSelect" value="">
            <input type="hidden" name="SelectDate" id="SelectDate" value="">

            <div class="btn-toolbar" role="toolbar">
                <div class="btn-group">
                    <button class="btn btn-default" style=" " type="button" onclick="CallDays()">Day</button>
                    <button class="btn btn-default" type="button" onclick="CallWeeks($('#SelectDate').val())">Week</button>
                    <button class="btn btn-default" type="button" onclick="Call2Week($('#SelectDate').val())">2 Week</button>
                    <button class="btn btn-default" type="button" onclick="Call4Week($('#SelectDate').val())">4 Week</button>
                </div>
            </div>

        </div>
        <div class="col-lg-2 col-sm-12">
            <div class="btn-group">
                <button class="btn btn-default" type="button" onclick="CallBefore()">  <i class="fa fa-angle-double-left small"></i></button>
                <div class="btn-group ">
                    <button id="btn-group-example" class="btn btn-default " type="button" aria-expanded="true" onclick="CallToday()">
                        Today
                    </button>

                </div>
                <button class="btn btn-default" type="button" onclick="CallAfter()"><i class="fa fa-angle-double-right small"></i></button>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12" >

            <!--            <div class="btn-group " style="align-items:  right;">
                            <button id="btn-group-example" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
            
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu left-align" role="menu" aria-labelledby="btn-group-example">
                                <li>
                                    <a href="#">Dropdown link</a>
                                </li>
                                <li>
                                    <a href="#">Dropdown link</a>
                                </li>
                            </ul>
                        </div>-->


        </div>


    </div>
    <!--</div>-->
    <!--<div style="" class="main-content">-->
    <div class="panel" style="margin: 0px;padding: 0px;">
        <div class="panel-body" style="margin:10px 10px;padding: 0px;">
            <div class="col-lg-2">
                <div class="form-group">
                    <div class="input-group">
                        <!--<label for="" class="col-sm-4 control-label" >Search</label>-->
                        <div class="col-sm-12">
<!--                                <span class="input-group-addon addon-inside bg-gray" role="title">
                             <i class="">Notes</i>
                         </span>
                         <br/>-->
                        <!--<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">-->
                            <input id="ast" type="search" name="ast" class="form-control" required  placeholder="Search"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10">

            </div>
            <br/>
            <div class="col-lg-12" id="TableWeek" > </div>
            <div style="overflow-x: scroll; width: 100%">
                <table id="emptable" class="table table-striped table-bordered responsive no-wrap" cellspacing="0" width="100%" style="margin: 0px;padding: 0px;overflow-x: scroll; ">
                    <thead id="tabelHeading" >

                    </thead>
                    <tbody id="tabelBody">
                        <tr style="cursor: pointer;" onclick="getTimesheet('<?= $row['id'] ?>')">
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--    <div class="panel sidebar-nav-left">
            <div class="panel-body" style="padding: 0 1%;margin:0px;">
    <?php $emp = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'"); ?>
    
                <table id="emptable" class="table table-striped responsive no-wrap" cellspacing="0" width="100%" style="margin: 0px;padding: 0px;width: 100%;">
                    <thead >
                        <tr >
                            <td ></td>
    
                        </tr>
                    </thead>
    
    
    
                    <tbody>
                        <tr style="cursor: pointer;" onclick="getTimesheet('<?= $row['id'] ?>')">
                            <td> <i class="fa fa-clock-o" style="margin: 0px;padding:5px;color: white;background-color: pink;border-radius: 50%;display: inline-block;font-size: 24px;"></i>OPEN/EMPTY SHIFT</td>
                        </tr>
    <?php foreach ($emp as $row) {
        ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <tr style="cursor: pointer;" onclick="getTimesheet('<?= $row['id'] ?>')">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td> <span style="min-height: 28px;min-width: 28px;padding: 5px;color: black;background-color: #d8d6d6;border-radius: 50%;display: inline-block;font-size: 14px;"><span style="font-size: 14px;color: black;" title="<?= $row['fname'] . ' ' . $row['lname']; ?>" data-original-title="<?= $row['fname'] . ' ' . $row['lname']; ?>"><?php echo substr(ucfirst($row['fname']), 0, 1) . '' . substr(ucfirst($row['lname']), 0, 1) ?></span></span>  <?php echo $row['fname'] . " " . $row['lname'] ?></td>
                                                                                                                                                                                                            
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </tr><?php } ?>
                    </tbody>
                </table>
    
    
    
            </div>
        </div>
    
        <div class="panel sidebar-nav-right" >
            <div class="panel-body" style="padding: 0 1px; ">
                <div class="panel">
                    <div class="panel-body" style="margin: 0px;padding: 0px;">
    
                        <div class="panel">
                            <div class="panel-body" style="clear: both; margin: 0px;padding: 0px;">
    
                                <div class="" id="divsDay" style="clear: both;"></div>
                                <div class="" id="" style="clear: both;"></div>
    <?php
    $i = "";
    for ($i = 1; $i < 31; $i++) {
        ?>
        <?php
    }

    $empCounts = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'");



    foreach ($empCounts as $counted):
        $j = "";
        for ($j = 1; $j <= 7; $j++) {
            ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class=" droppable eventCall" id="<?= $counted['id'] . '_' . $j ?>" data-id="<?= $counted['id'] . '_' . $j ?>" style="min-height:51.8px;padding: 0px;"></div>
            <?php
        }
    endforeach;
    ?>
    
                                <div class="" id="divsDayDetails" style="clear: both;" ></div>
    
    
    
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-body">
                            <div class="">
                                <a class="btn btn-default" style="margin:10px 0px;" type="button" href="#" data-toggle="modal" data-target="#myModal2" data-placement="center" >
                                    <i class="fa fa-plus small"></i>&nbsp;Add New Schedule
                                </a>
                            </div>
                            <div class="example-box-wrapper row">
    
                                <div class="col-md-12 center-margin">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="calendar" class="fc fc-ltr">
                                            </div>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                        </div>       
                    </div>
                </div>
    
            </div>
    
    
    
        </div>-->
    <!--</div>-->
</div>
<!-- Modal Structure -->
<!--Modal 1 -->
<!-- Modal -->
<div class="modal fadeIn center "  id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <form action="newschedule_2" id="newschedule_2_form">
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
                        <input type="hidden" name="newschedule_2_submit" id="newschedule_2_submit" value="1">
                    </div> 
                </div> 


            </div>
        </form>
    </div><!-- modal-content -->
</div><!-- modal-dialog -->



<?php
//include _PATH . "instance/front/tpl/vehicle_plate_design.php" ?>