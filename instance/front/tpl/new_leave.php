

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


<div class="panel">
    <div class="panel-body">


        <!--        <div class="example-box-wrapper">
                    <button class="btn btn-default btn-md" data-toggle="modal" data-target="#myModal"> Launch demo modal </button>
        
                </div>-->
        <!--<form  action="task"  id='task_form'>-->
        <form action="new_leave" id="new_leave_form">
            <div class="panel">
                <div class="panel-body">
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
                                                <input type="text" id="f_date" name="f_date" class="bootstrap-datepicker  form-control " value="" data-date-format="YY/mm/dd">
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
                                                <input class="timepicker-example form-control totals" id="f_time" name="f_time" type="text" >
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
                                                <input type="text" name="l_date" id="l_date" class="bootstrap-datepicker  form-control " value="" data-date-format="YY/mm/dd">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 col-xs-4 control-label">Ends</label>
                                        <div class="col-sm-8 col-xs-8">
                                            <div class="bootstrap-timepicker dropdown">
                                                <input class="timepicker-example form-control totals" id="l_time" name="l_time" type="text" >
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
                                                <label for="" class="col-sm-4 col-xs-4 control-label  " id="lbl_total">--</label>
                                                <input type="hidden" value="" name="hid_total" id="hid_total">
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
                                                <textarea name="txtnotes" placeholder="Notes here" id="txtnotes" maxlength="255" style="width: 100%;min-height: 100px;" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <!--<div class="input-group">-->
                                        <label class="col-sm-4 col-xs-4 control-label">Leave Type</label>
                                        <div class="col-sm-8 col-xs-8">
                                            <select name="leave_type" id="leave_type" class="chosen-select form-control" style="width:100%" >
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
                                            <select name="notifyby" id="notifyby" class="chosen-select form-control" style="width:100%" >
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


                </div>
            </div>
        </form>
        <!-- /Popout -->
        <!--</form>-->
        <div id="myModal" class="modal modal-fixed-header-footer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <p>Modal content here ...</p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="button">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
<!-- Modal Structure -->
<!--Modal 1 -->
<!-- Modal -->
<div class="modal fadeInUp right "  id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel2">New Task</h4>
            </div>

            <div class="modal-body" >
                <div class="content-box-wrapper" >

                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="" class="col-sm-4 control-label" >Title</label>
                                <div class="col-sm-8">

<!--<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">-->
                                    <input id="title" type="text" name="title" class="form-control" required  placeholder="Title"/>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                <label for="" class="col-sm-4 control-label" style="line-height: 30px;">Due Date</label>
                                <div class="col-sm-8">
                                    <div class="input-prepend input-group">
                                        <span class="add-on input-group-addon">
                                            <i class="glyph-icon icon-calendar"></i>
                                        </span>
                                        <input type="text" class="bootstrap-datepicker  form-control" value="02/16/12" data-date-format="mm/dd/yy">
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
                                    <input id="ast" type="text" name="ast" class="form-control" required  placeholder="Assign to Emplyoee"/>
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
                                    <textarea name="Notes" placeholder="Notes here" id="txtnotes" maxlength="255" style="width: 100%;min-height: 100px;" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
            <div class="col-sm-12">
                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button">Save</button>
            </div> 


        </div>
    </div><!-- modal-content -->
</div><!-- modal-dialog -->


<?php include _PATH . "instance/front/tpl/vehicle_plate_design.php" ?>