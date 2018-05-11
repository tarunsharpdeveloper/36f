

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
        /*height:60px;*/

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
</style>
<div class="panel" style="margin-bottom: 0px;">
    <div class="panel-body" style="">


        <div class="col-lg-2 col-sm-12">
            <!--<div class="btn-group " style="width: 90%">-->
            <div class="col-sm-12 " style="" >
                <h2>Time Clock</h2>              
                <!--</div>-->
            </div>
        </div>
        <!--        <div class="col-lg-2 col-sm-12 ">
                    <input type="hidden" name="currentSelect" id="currentSelect" value="">
                    <input type="hidden" name="SelectDate" id="SelectDate" value="">
                    <div class="btn-group " >
                    <div class="col-sm-12 " >
                    <select class="target form-control" name="TimeSlap" id="TimeSlap"  >
                        <option selected value="select" data-id="0">Select</option>
                                            <option >------</option>
                        <option value="Past 7 Days" data-id="1">Past 7 Days</option>
                        <option value="This Week" data-id="2">This Week</option>
                        <option value="Last Week" data-id="3">Last Week</option>
                        <option value="Two Week Ago" data-id="4">Two Week Ago</option>
                        <option value="This Month" data-id="5">This Month</option>
                        <option value="Last Month" data-id="6">Last Month</option>
                        <option value="Today" data-id="7">Today</option>
                        <option value="Yeasterday" data-id="8">Yeasterday</option>
                        <option value="Tommorrow" data-id="9">Tommorrow</option>
                        <option value="All Time" data-id="10">All Time</option>
        
                    </select>                   
                    </div>
                    </div>
                </div>-->
        <div class="col-lg-3 col-sm-12">
            <div class="form-group" style="width: 90%" >
                <!--<label for="" class="col-sm-4 control-label">Date &amp; Time picker</label>-->
                <div class="col-sm-12">
                    <div class="input-prepend input-group">
                        <span class="add-on input-group-addon">
                            <i class="glyph-icon icon-calendar"></i>
                        </span>
                        <input type="text" name="reportrange" id="reportrange" class=" form-control" value="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-sm-12" style="align-content: flex-end;text-align: left;" >
            <div class="btn-group " style="width: 30%">
                <div class="col-sm-12 " >
                    <select class=" form-control" name="selectStatus" id="selectStatus">
                        <option selected value="">All</option>
                        <option value="1">Approved</option>
                        <option value="0">Unapproved</option>
                    </select>                   
                </div>
            </div>
            <div class="btn-group " style="width: 30%">
                <div class="col-sm-12 " >
                    <select class=" form-control chosen-select" name="selectEmp" id="selectEmp">
                        <option selected value="">All Employee</option>
                        <?php foreach ($emp as $empval) {
                            ?>

                            <option value="<?= $empval['id'] ?>"  ><?php echo $empval['fname'] . ' ' . $empval['lname']; ?></option>
                            <?php
                        }
                        ?>

                    </select>                   
                </div>
            </div>
            <div class="btn-group " style="width: 30%">
                <div class="col-sm-12 " >
                    <select class=" form-control" >
                        <option selected >All Shcedule</option>
                        <option >------</option>
                    </select>                   
                </div>
            </div>



        </div>


    </div>
</div>
<div style="" class="main-content">
    <div class="panel" style="margin: 0px;padding: 0px;">
        <div class="panel-body" style="margin:10px 0px 0px 0px;padding: 0px;">

            <div class="" id="timesheetDiv" style=" ">
                <table id="emptable" class="table table-striped responsive no-wrap" cellspacing="0" width="100%" style="margin: 0px;padding: 0px;width: 100%;">
                    <thead id="tabelHeading" >
                        <tr>
                            <th style=""><input type="checkbox" class="selectall" id="all"></th>
                            <th>Employee</th>
                            <th >Date</th>
                            <th>Clock In</th>
                            <th>Clock Out</th>
                            <th>Length</th>
                            <th>Break</th>
                            <th>Position</th>
                            <th>Location</th>
                            <th></th>
                        </tr>

                    </thead>
                    <tbody id="tabelBody">
                        <?php
                        foreach ($timesheet as $work) {
                            ?>


                            <tr>
                                <td><?php echo date("D, d/m", strtotime($work['created_at'])); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" >
                                <td style="float:left;"><input type="checkbox" name="nchild[]" class="child" value="<?php echo $work['id']; ?>"></td>
                                <td><?php echo $work['fname'] . " " . $work['lname']; ?></td>
                                <td><?php echo date("D, d/m", strtotime($work['created_at'])); ?></td>
                                <td><?= $work['start_time']; ?></td>
                                <td><?= $work['end_time']; ?></td>
                                <td><?php
                                    $to_time = strtotime($work['start_time']);
                                    $from_time = strtotime($work['end_time']);
                                    $totalTime = round(abs($to_time - $from_time) / 60, 2);
                                    $tt = round(abs($totalTime - $work['break_time']) / 60, 2);
                                    $ddt = explode(".", $tt);
                                    echo $ddt[0] . ":";
                                    echo round(abs(($ddt[1]) / 100) * 60);
//                    $totalTime = round(($totalTime - $work['break_time']) , 2);
//                    echo "||" . ($totalTime- - $work['break_time']);
                                    ?></td>
                                <td><?= $work['break_time'] ?></td>
                                <td>driver</td>
                                <td>-</td>
                                <td>Approve</td>
                            </tr>
                            <?php
                        } if (count($timesheet) == 0) {
                            echo "<tr><td colspan='20'>";
                            print _t('41', 'No records found!');
                            echo "</td></tr>";
                        }
                        ?>
<!--                        <tr style="cursor: pointer;" >
<td style="float:left;"><input type="checkbox" name="nchild[]" class="child" value="<?php echo $PostRow['id']; ?>"></td>
<td>Agha neil</td>
<td>9:00am</td>
<td>5:00pm</td>
<td>8h</td>
<td>-</td>
<td>driver</td>
<td>-</td>
<td>Approve</td>
</tr>-->
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
</div>
<!-- Modal Structure -->
<!--Modal 1 -->
<!-- Modal -->
<div class="modal fadeInUp center "  id="EndShiftModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title center_bold" id="myModalLabel2">Edit Shift</h4>
            </div>

            <div class="modal-body" >
                <div class="panel" >
                    <div class="panel-body" >
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <h2 class="m-myWeek-endShiftTime center_bold">
                                        <i class="fa fa-clock-o"></i> 
                                        <span class="" id="hours_count"></span>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-4 padding-none">
                            <div class="form-group">
                                <label>Start time</label>
                                <input class="form-control timepicker mContent" id="start_time" name="start_time" type="text" value="" required>
                                <span id="error_start_time" style="color:red;"></span>
                            </div>
                        </div>


                        <div class="col-xs-4 padding-none">
                            <div class="form-group">
                                <label>End time</label>
                                <input class="form-control timepicker mContent" id="end_time" name="end_time" type="text" value="<?php echo $endvalue; ?>" required>
                                <span id="error_end_time" style="color:red;"></span>
                            </div>
                        </div>
                        <div class="col-xs-4 padding-none">
                            <div class="form-group">
                                <label>Break time</label>
                                <input class="form-control mContent" type="text" value="" id="break_time" name="break_time" required> 

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-1 control-label" >Note</label>
                                        <div class="col-sm-11">
                                            <input id="note" type="text" name="note" class="form-control"  placeholder="(Optional)"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="error_msg" style="display: block;color: red;"></div> 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-6" id="div_deleted" style="text-align: left;">
                    <a class="btn btn-danger" href="javascript:void();" onclick="deleteShift()">Click here to Delete</a>
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="button" onclick="edit_Shift();">Edit Time Card</button>
                </div> 
            </div> 


        </div>
    </div><!-- modal-content -->
</div>
<div class="modal fadeInUp center "  id="AlertShiftModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title center_bold" id="mymodalTitle">Approve! Alert</h4>
            </div>

            <div class="modal-body" >
                <div class="panel" >
                    <div class="panel-body" >
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <h2 class="m-myWeek-endShiftTime center_bold">
                                        <i class="fa fa-clock-o"></i> 
                                        <span class="" id="hours_counts"></span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <p id="mymodalBody"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-6" id="div_deleted" style="text-align: left;">
                    <!--<a class="btn btn-danger" href="javascript:void();" onclick="deleteShift()">Click here to Delete</a>-->
                </div>
                <div class="col-sm-6" id="approve_div">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="button" onclick="edit_Shift();">Edit Time Card</button>
                </div> 
            </div> 


        </div>
    </div><!-- modal-content -->
</div>
<div class="modal fadeIn center "  id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <form action="approve_timesheet_2" id="approve_timesheet_2_form">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">New Schedule</h4>
                </div>

                <div class="modal-body" >
                    <div class="panel" >
                        <div class="panel-body" >
                            <!--                            <div class="col-md-12" style="background-color: mistyrose;margin-bottom: 20px;">
                                                            <p style="text-align: justify;">
                                                                Unrostered time sheets are used when an employee wasn't initially rostered but a shift was worked. Select an employee and date to continue and once added, approve the time sheet through the normal process.
                                                            </p>
                                                        </div>
                                                        <br/>-->

                            <div class="col-sm-12">
                                <!--                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon addon-inside bg-gray" role="title">
                                                                    <i class=""></i>Due Date
                                                                </span>
                                                                <br/>
                                                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                                                <input id="duedate" type="datetime" name="duedate" class="form-control" required  placeholder="DUE DATE"/>
                                                            </div>
                                                        </div>-->
                                <div class="form-group">
                                    <div class="input-group">

                                        <label class="control-label col-lg-6 col-sm-12" for="title">Title:</label>

                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                            <input type="text" class="form-control" value="" name="title" id="title" placeholder="" required="" pattern="^([01]\d|2[0-3]\-[01]\d|2[0-3]):?([0-5]\d) " >
                                        </div>

                                    </div>
                                </div>
                                <input type="hidden" value="" name="hidshiftID" id="hidshiftID">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-4 control-label" style="line-height: 30px;">Start Date Of Shift</label>
                                        <div class="col-sm-8">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon">
                                                    <i class="glyph-icon icon-calendar"></i>
                                                </span>
                                                <input type="text" class="datepicker  form-control" id="dateofshift" name="dateofshift" value="" data-date-format="yy-mm-dd">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-4 control-label" style="line-height: 30px;">End Date Of Shift</label>
                                        <div class="col-sm-8">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon">
                                                    <i class="glyph-icon icon-calendar"></i>
                                                </span>
                                                <input type="text" class="datepicker  form-control" id="enddateofshift" name="enddateofshift" value="" data-date-format="yy-mm-dd">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-4 control-label" >Assign To</label>
                                        <div class="col-sm-8">
        <!--                                    <span class="input-group-addon addon-inside bg-gray" role="title">
                                                <i class="">Assign To</i>
                                            </span>
                                            <br/>-->
                                            <!--<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">-->
                                            <select name="emplist" id="emplist" class="form-control browser-default">
                                                <option selected disabled value="">Select Employee</option>
                                                <?php foreach ($emp as $val) {
                                                    ?>
                                                    <option value="<?= $val['id'] ?>"><?= $val["fname"] . ' ' . $val['lname'] ?></option>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <!--<input id="md_ast" type="text" name="md_ast" class="form-control" required  placeholder="Assign to Emplyoee"/>-->
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
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
                                            <textarea name="md_txtnotes" placeholder="Notes here" id="md_txtnotes" maxlength="255" style="width: 100%;min-height: 100px;" required></textarea>
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
                        <button class="btn btn-primary" type="submit" >Save</button>
                        <input type="hidden" name="approve_timesheet_2_submit" id="approve_timesheet_2_submit" value="1">
                    </div> 
                </div> 


            </div>
        </form>
    </div><!-- modal-content -->
</div><!-- modal-dialog -->
<input type="hidden" name="locAddress" id="locAddress" value="">
<input type="hidden" name="hidstart" id="hidstart" value="">
<input type="hidden" name="hidend" id="hidend" value="">
<div class="modal fadeInUp center "  id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <form action="approve_timesheet" id="new_timesheet_modal_form">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Location</h4>
                </div>

                <div class="modal-body" >
                    <div class="panel" >
                        <div class="panel-body" style="padding: 0px;" >
                            <div class="col-lg-12" style="min-height: 320px;text-align: center;align-content: space-between">
                                <div id="map" style="min-height: 350px;width: 100%;">

                                </div>
                            </div>
                        </div>
                    </div>




                </div>
                <!--                    <div class="modal-footer">
                                        <div class="col-sm-12">
                                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                                        <button class="btn btn-primary" type="button" onclick="NewSchedulesave()">Save</button>
                                        </div> 
                                    </div> -->


            </div>
        </form>
    </div><!-- modal-content -->
</div>


<?php
//include _PATH . "instance/front/tpl/vehicle_plate_design.php" ?>