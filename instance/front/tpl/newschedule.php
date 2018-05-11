

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
</style>
<div class="panel" style="margin-bottom: 0px;">
    <div class="panel-body" style="left:-35px;">


        <div class="col-lg-3 col-sm-12">
            <!--<div class="content-box-wrapper">-->
            <!--<div class="col-lg-4">-->

            <div class="btn-group " style="width: 90%">


                <div class="col-sm-12 " >
                    <select class=" form-control" >
                        <option selected disabled><b><?= $_SESSION['company'] ['name'] ?> </b></option>

                    </select>                   
                </div>
            </div>




            <!--</div>-->
        </div>

        <div class="col-lg-2 col-sm-12 ">
            <div class="btn-group">
                <div class="form-group">
                    <!--                    <label for="" class="col-sm-4 col-xs-4 control-label" style="line-height: 30px;">Select</label>-->
                    <div class="col-sm-12 col-xs-12">
                        <div class="input-prepend input-group">
                            <span class="add-on input-group-addon">
                                <i class="glyph-icon icon-calendar"></i>
                            </span>
                            <input type="text" name="sDate" id="sDate" class="datepicker  form-control" value="" data-date-format="yy-mm-dd">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-sm-12 ">
            <div class="btn-toolbar" role="toolbar">
                <div class="btn-group">
                    <button class="btn btn-default" type="button">Day</button>
                    <button class="btn btn-default" type="button">Week</button>
                    <button class="btn btn-default" type="button">Month</button>
                </div>
            </div>
            <!--            <div class="btn-group">
                            <button class="btn btn-default" type="button">  
                                Day
                            </button>
                            <div class="btn-group ">
                                <button id="btn-group-example" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                                    Week
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="btn-group-example">
                                    <li>
                                        <a href="#">Dropdown link</a>
                                    </li>
                                    <li>
                                        <a href="#">Dropdown link</a>
                                    </li>
                                </ul>
                            </div>
                            <button class="btn btn-default" type="button">
                                Month
                            </button>
                        </div>-->
        </div>
        <div class="col-lg-5 col-sm-12">
            <button class="btn btn-default" type="button"> 
                <!--<a class="btn location-info" type="button" href="#">-->
                <i class="fa fa-refresh small"></i>&nbsp;Referesh
                <!--</a>-->
            </button>&nbsp;&nbsp;
            <div class="btn-group ">
                <button id="btn-group-example" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                    Copy Shift
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="btn-group-example">
                    <li>
                        <a href="#">Dropdown link</a>
                    </li>
                    <li>
                        <a href="#">Dropdown link</a>
                    </li>
                </ul>
            </div>
            &nbsp;&nbsp;
            <!--<div class="col-lg-4">-->
            <div class="btn-group">
                <button class="btn btn-default" type="button"> 
                    <i class="fa fa-line-chart small"></i>&nbsp;Status
                </button>
            </div>
            &nbsp;&nbsp;
            <div class="btn-group">
                <button class="btn btn-default" type="button"> 
                    <i class="fa fa-print small"></i>&nbsp;Print
                </button>
            </div>
            &nbsp;&nbsp;
            <div class="btn-group">
                <button class="btn btn-default" type="button"> 
                    <i class="fa fa-cogs small"></i>&nbsp;Option
                </button>
            </div>
            <!--</div>-->
        </div>


    </div>
</div>
<div style="" class="main-content">
    <div class="panel sidebar-nav-left">
        <div class="panel-body" style="padding: 0 1%;margin:0px;">
            <?php $emp = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'"); ?>

            <!--<div class="content-wrap" >-->
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

            <!--</div>-->


        </div>
    </div>

    <div class="panel sidebar-nav-right" >
        <!--        <div class="panel-body" style="padding: 0 1px; ">
                    <div class="panel">
                        <div class="panel-body" style="margin: 0px;padding: 0px;">
        
                                    <div class="panel">
                                        <div class="panel-body">
        
        
        
                            
                                                        <div class="" id="divsTot" style="clear: both; margin: 0px;padding: 0px;">
                            
                                                        </div>
                            <div class="" id="divsDay" style="clear: both;">
        
                            </div>
                            <div class="" id="" style="clear: both;"></div>
        <?php
        $i = "";
        for ($i = 1; $i < 31; $i++) {
            ?>
                                                                            <div class="tb_months" id="" style=""><?= $i ?></div>
            <?php
        }

        $empCounts = q("select * from tb_employee where work_at='{$_SESSION['company']['id']}'");

        for ($j = 1; $j < 31; $j++) {
            ?>
                                                                            <div class="tb_months droppable eventCall" id="" style="position: relative;padding: 0px;min-height:56px ;line-height: 29px;"><?php if (!$j % 1 == 0) { ?><div style="background-color: red;height: 20px;width:100%;" class="draggable">*</div><?php } ?></div>
            <?php
        }

        foreach ($empCounts as $counted):
            $j = "";
            for ($j = 1; $j < 31; $j++) {
                ?>
                                                                                                                            <div class="tb_months droppable eventCall" id="<?= $counted['id'] . '_' . $j ?>" data-id="<?= $counted['id'] . '_' . $j ?>" style="min-height:51.8px;padding: 0px;"></div>
                <?php
            }
        endforeach;
        ?>
        
                            <div class="" id="divsDayDetails" style="clear: both;" ></div>
        
        
        
                        </div>
                    </div>
                </div>-->
        <div class="panel">
            <div class="panel-body">
                <div class="">
                    <!--<a class="btn btn-default" href="#" style="margin: 5px;"> Add New Schedule</a>-->
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
                            <!--                            <div class="col-md-3">
                                                            <div class="content-box" id="external-events">
                                                                <h3 class="content-box-header bg-default">
                                                                    <span class="icon-separator">
                                                                        <i class="glyph-icon icon-calendar"></i>
                                                                    </span>
                                                                    Draggable Events
                                                                </h3>
                                                                <div class="content-box-wrapper">
                                                                    <div class="btn display-block mrg5B bg-orange external-event ui-draggable ui-draggable-handle" data-class="bg-orange">
                                                                        <div class="button-content">My Event 1</div>
                                                                    </div>
                                                                    <div class="btn display-block mrg5B bg-primary external-event ui-draggable ui-draggable-handle">
                                                                        <div class="button-content">My Event 2</div>
                                                                    </div>
                                                                    <div class="btn display-block mrg5B bg-yellow external-event ui-draggable ui-draggable-handle">
                                                                        <div class="button-content">My Event 3</div>
                                                                    </div>
                                                                    <div class="btn display-block mrg5B bg-blue-alt external-event ui-draggable ui-draggable-handle">
                                                                        <div class="button-content">My Event 4</div>
                                                                    </div>
                                                                    <div class="btn display-block mrg5B bg-red external-event ui-draggable ui-draggable-handle">
                                                                        <div class="button-content">My Event 5</div>
                                                                    </div>
                                                                    <p>
                                                                        <input id="drop-remove" type="checkbox">
                                                                        <label for="drop-remove">remove after drop</label>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>-->
                        </div>
                    </div>
                </div>
            </div>       
        </div>
    </div>

</div>



</div>
<!-- Modal Structure -->
<!--Modal 1 -->
<!-- Modal -->
<div class="modal fadeInUp center "  id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <form action="newschedule" id="newschedule_form">
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
                                            <input type="text" class="form-control" value="" name="title" id="title" placeholder="" required="">
                                        </div>

                                    </div>
                                </div>
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
                        <input type="hidden" name="newschedule_submit" id="newschedule_submit" value="1">
                    </div> 
                </div> 


            </div>
        </form>
    </div><!-- modal-content -->
</div><!-- modal-dialog -->



<?php
//include _PATH . "instance/front/tpl/vehicle_plate_design.php" ?>