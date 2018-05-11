

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
<div class="panel">
    <div class="panel-body">

        <!--        <div class="panel">
                    <div class="panel-body">-->
        <div class="example-box-wrapper">
            <div class="panel-body">
                <h3>WHoZoor Corporate</h3>
                <div class="col-sm-12 col-lg-6 col-xs-12">
                    <div class="form-group">
                        <label for="" class="col-sm-4 col-xs-4 control-label" style="line-height: 30px;">Select</label>
                        <div class="col-sm-8 col-xs-8">
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon">
                                    <i class="glyph-icon icon-calendar"></i>
                                </span>
                                <input type="text" name="sDate" id="sDate" class="datepicker  form-control" value="" data-date-format="yy-mm-dd">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="" id="divsTot" style="clear: both; margin: 0px;padding: 0px;">

                </div>
                <div class="" id="divsDay" style="clear: both;">

                </div>
                <div class="" id="divsDayDetails" style="clear: both;">

                </div>
            </div>
        </div>
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


<?php

//include _PATH . "instance/front/tpl/vehicle_plate_design.php" ?>