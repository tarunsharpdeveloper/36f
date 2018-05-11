
<?php if (checkAccessLevel($_SESSION['user']['access_level'], 'timesheet', 'export')) { ?>
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
    <style>
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

            <div class="col-lg-5 col-sm-12 ">
                <div class="btn-group " style="width: 100%">

                    <div class="form-group">
                        <!--<label for="" class="col-sm-4 control-label">Date &amp; Time picker</label>-->
                        <div class="col-sm-12">
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon">
                                    <i class="glyph-icon icon-calendar"></i>
                                </span>
                                <input type="text" name="daterangepicker-time" id="daterangepicker-time" class=" form-control" value="">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <!--<div class="example-box-wrapper">-->

                <!--<button class="btn btn-default" type="button" >--> 
                <a class="btn btn-default"  type="button" href="#" data-toggle="modal" data-target="#myModal2" data-placement="center" >
                    <i class="fa fa-plus small"></i>&nbsp;Add Timesheet
                </a>
                <!--</button>-->
                &nbsp;&nbsp;&nbsp;
                <div class="btn-group" data-toggle="buttons">
                    <button class="btn btn-default" onclick="checkboxval('1')" id="chkbtnapprove"  >
                        <!--<input type="checkbox" name="chkperform" id="chk1" class="chkperform" value="Approved All" >-->
                        Approve All
                    </button>
                    <button class="btn btn-default"  onclick="checkboxval('2')" id="chkbtnunapprove">
                        <!--<input type="checkbox"  name="chkperform" id="chk2" class="chkperform" value="Unapproved All">-->
                        Unapprove All
                    </button>


                </div>
                <input type="hidden" name="hid_emp_id" id="hid_emp_id" value=""/>
    <!--            <input type="hidden" name="shift_id" id="shift_id" value=""/>
                <input type="hidden" name="shift_id" id="shift_id" value=""/>-->
                <!--</div>-->
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
                        <?php foreach ($emp as $row) {
                            ?>
                            <tr style="cursor: pointer;" onclick="getTimesheet('<?= $row['id'] ?>')">
                                <td><?php echo $row['fname'] . " " . $row['lname'] ?></td>

                            </tr><?php } ?>
                    </tbody>
                </table>

                <!--</div>-->


            </div>
        </div>

        <div class="panel sidebar-nav-right" >
            <div class="panel-body" style="padding: 0 1px; ">
                <div class="" id="timesheetDiv" style=" resize:vertical;overflow: hidden;overflow-y: scroll;border: 2px solid #F0F2F4;">
                    <table id="timesheet-table" class="table table-striped responsive no-wrap" cellspacing="0" width="100%" style="margin: 0px;padding: 0px;width: 100%;">
                        <thead >
                            <tr >
                                <th >Date</th>
                                <th >Status</th>
                                <th >Progress</th>
                                <th >Area Of Work</th>
                                <th >Time</th>
                                <th >Hours</th>

                            </tr>
                        </thead>



                        <tbody>
                            <?php
//                        $timesheet = $_SESSION["timesheetData"];
//                        d($timesheet);
                            foreach ($timesheet as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td><?php
                                        if ($row['status'] == "0"): echo "Pending";
                                        elseif ($row['status'] == "1"): echo "accepted";
                                        else: echo "Declined";
                                        endif;
                                        ?></td>
                                    <td><?php echo $row['progress']; ?></td>
                                    <td><?php echo $row['area_of_work']; ?></td>
                                    <td><?php echo $row['start_time'] . " | " . $row['end_time'] . " | " . $row['break_time']; ?></td>
                                    <td><?php
                                        $to_time = strtotime($row['start_time']);
                                        $from_time = strtotime($row['end_time']);
                                        $totalTime = round(abs($to_time - $from_time) / 60, 2);
                                        echo (($totalTime - $row['break_time']) / 60);
                                        ?></td>

                                </tr><?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--<div class="panel">-->
            <div class="panel-body" style="background-color: #F9F9F9;margin: 0px; padding: 0px;">

                <!--<div class="example-box-wrapper">-->
                <div class="col-lg-4">

                    <div class="myborder" style="background-color: white; padding: 5px 10px; width: min-content;" id="cDetailsDiv" >
                        <span id="cDetails" style=" font-weight: bold; color: #999;background-color: white; "></span> 
                    </div>
                </div>
                <div class="col-lg-4"> 
                    <ul class="list-group list-group-separator row list-group-icons">
                        <li class="col-md-4 active">
                            <a href="#tab-timesheet" data-toggle="tab" class="list-group-item" style="height: 20px;line-height: 0px;">
                                <!--<i class="glyph-icon font-red icon-bullhorn"></i>-->
                                Timesheet
                            </a>
                        </li>
                        <li class="col-md-4 ">
                            <a href="#tab-history" data-toggle="tab" class="list-group-item" style="height: 20px;line-height: 0px;">
                                <!--<i class="glyph-icon icon-dashboard"></i>-->
                                History
                            </a>
                        </li>
                        <li class="col-md-4">
                            <a href="#tab-comments" data-toggle="tab" class="list-group-item" style="height: 20px;line-height: 0px;">
                                <!--<i class="glyph-icon font-primary icon-camera"></i>-->
                                Comments
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 ">
                    <button class="btn btn-azure col-md-6 " style="float: right;" type="button" name="approveNext" id="approveNext" onclick="approveNext()" >Approve & Next</button>
                </div>
                <div class="myborder" style="clear: both;" id="cDateDiv">
                    <span id="cDate" style="padding: 0 10px; font-weight: bold;"></span> &nbsp;Time Approval
                </div>
                <div class="panel-body" style="clear: both;background-color: #FFFFFF; padding: 0px 0px; " >
                    <!--<div class="tab-content myborder tab_left" style="background-color: #FFFFFF; ">-->
                    <div class="tab-pane fade myborder active in tab_left" style="background-color: #FFFFFF; " id="tab-timesheet">
                        <div id="timeapprovalDiv">
                            <form id="approveForm" action="approve_timesheet">
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <div class="form-group">
                                        <!--<div class="input-group">-->
                                        <label class="col-sm-4 col-xs-4 control-label">Area Of Work </label>
                                        <div class="col-sm-8 col-xs-8">
                                            <select name="area" id="area" class="browser-default  form-control" style="width:100%" >
                                                <option selected disabled value="">Choose Area</option>
                                                <?php
                                                foreach ($positions as $value) {
                                                    ?>
                                                    <option value="<?= $value['c_name']; ?>"><?= $value['c_name']; ?></option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
                                            <!--</div>-->
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 col-xs-4 control-label">Start Time</label>
                                        <div class="col-sm-8 col-xs-8">
                                            <div class="bootstrap-timepicker dropdown">
                                                <input class="timepicker-example form-control" id="s_time" name="s_time" type="text" value="" required>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 col-xs-4 control-label">End Time</label>
                                        <div class="col-sm-8 col-xs-8">
                                            <div class="bootstrap-timepicker dropdown">
                                                <input class="timepicker-example form-control" id="e_time" name="e_time" type="text" value="" required>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 col-xs-4 control-label">Break Time</label>
                                        <div class="col-sm-8 col-xs-8">
                                            <div class="bootstrap-timepicker dropdown">
                                                <input class=" form-control" id="b_time" name="b_time" type="text" required >
                                            </div>
                                        </div>


                                    </div>
                                    <hr/>
                                </div>

                                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                                    <input type="hidden" name="shift_id" id="shift_id" value=""/>
                                    <div class="" >
                                        <div class="" style="float: right" id="divScheduleSet">
                                            <!--<div id="divScheduleSet" name="divScheduleSet"></div>-->
                                            <button class="btn btn-danger"  type="button" name="unapprovebtn" id="unapprovebtn" onclick="shiftDiscard()">Discard</button>

                                            <button class="btn btn-default"   type="button" onclick="shiftApprove()" name="approvebtn" id="approvebtn" >Approve</button>

                                        </div> 


                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="timeapprovalNextDiv" style="display: none;">
                            <!--                        Hello its click On NExt Approval-->
                            <table class="table table-bordered">
                                <tr><td style="text-align: right;width: 10%;">Area</td><td style="width: 40%;">MANAGER</td><td style="text-align: right;width: 10%;">Pay Rate</td><td style="width: 40%;">-</td></tr>
                                <tr><td style="text-align: right;width: 10%;">Time/Break</td><td style="width: 40%;">7:31 pm - 8:31 pm | 0 min</td><td style="text-align: right;width: 10%;"></td><td style="width: 40%;"></td></tr>
                                <tr><td style="text-align: right;width: 10%;"></td><td style="width: 40%;"></td><td style="text-align: right;width: 10%;"></td><td style="width: 40%;"></td></tr>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade myborder tab_left" style="background-color: #FFFFFF; "  id="tab-history">
                        <p> Content Remains</p>
                    </div>
                    <div class="tab-pane fade myborder tab_left" style="background-color: #FFFFFF; " id="tab-comments">
                        <p>Here Content Remains</p>
                    </div>

                    <!--</div>-->
                    <div class="tab_right" > Location MAP HERE</div>
                </div>
            </div>
            <!--</div>-->
        </div>

    </div>
    <!-- Modal Structure -->
    <!--Modal 1 -->
    <!-- Modal -->
    <div class="modal fadeInUp center "  id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <form action="approve_timesheet" id="new_timesheet_modal_form">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel2">Unrostered Timesheet</h4>
                    </div>

                    <div class="modal-body" >
                        <div class="panel" >
                            <div class="panel-body" >
                                <div class="col-md-12" style="background-color: mistyrose;margin-bottom: 20px;">
                                    <p style="text-align: justify;">
                                        Unrostered time sheets are used when an employee wasn't initially rostered but a shift was worked. Select an employee and date to continue and once added, approve the time sheet through the normal process.
                                    </p>
                                </div>
                                <br/>

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
                                            <label for="" class="col-sm-4 control-label" style="line-height: 30px;">Date Of Shift</label>
                                            <div class="col-sm-8">
                                                <div class="input-prepend input-group">
                                                    <span class="add-on input-group-addon">
                                                        <i class="glyph-icon icon-calendar"></i>
                                                    </span>
                                                    <input type="text" class="bootstrap-datepicker  form-control" id="dateofshift" name="dateofshift" value="" data-date-format="yy-mm-dd">
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
                                                    <?php foreach ($employee as $val) {
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
                            <button class="btn btn-primary" type="button" onclick="NewSchedulesave()">Save</button>
                        </div> 
                    </div> 


                </div>
            </form>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->


    <?php include _PATH . "instance/front/tpl/vehicle_plate_design.php" ?>

<?php } ?>