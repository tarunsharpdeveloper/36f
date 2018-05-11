<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var maxField = 15; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div id="remove_lan"><div class="col-sm-12"><div class="col-sm-3"><div class="col-sm-12"><div class="form-group"><div class="input-group"><div class="col-sm-12"><input id="name"  type="text" name="name[]" class="form-control form-radius"   placeholder="Name" required/></div></div></div></div></div><div class="col-sm-3"><div class="col-sm-12"><div class="form-group"><div class="input-group"><div class="col-sm-12"><input id="email"  type="text" name="email[]" class="form-control form-radius"   placeholder="(Optional)"/></div></div></div></div></div><div class="col-sm-3"><div class="col-sm-12"><div class="form-group"><div class="input-group"><div class="col-sm-12"><input id="phone_no"  type="text" name="phone_no[]" class="form-control form-radius"   placeholder="(Optional)"/></div></div></div></div></div><div class="col-sm-3"><div><a class="btn btn-link-danger remove remove_button" href="javascript:void(0);" title="Remove"><i class="fa fa-trash-o"></i></a></div></div></div>'; //New input field html 
        //var fieldHTML = '<div><input type="text" name="name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="<?php echo _U ?>instance/front/media/remove-icon.png"/></a></div>'; //New input field html 
        for (i = 0; i < 3; i++) {

            var x = 1; //Initial field counter is 1
            $(addButton).click(function () { //Once add button is clicked
                if (x < maxField) { //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); // Add field html
                }
            });
        }
        $(wrapper).on('click', '.remove_button', function (e) { //Once remove button is clicked
            e.preventDefault();
            //$(this).closest(".test").fadeOut(10);
            $(this).closest('#remove_lan').remove();
            //$(this).parent('div').remove(); //Remove field html
            //$( ".test" ).remove();
            x--; //Decrement field counter
        });
    });
</script>
<script>
    function myFunction() {
        var option_value = document.getElementById("uplods_multiple").value;
        if (option_value == "EXCEL") {
            $("#UploadFileExcel").modal('show');
        }else if (option_value == "MYOB") {
            $("#MyOb").modal('show');
        }else if (option_value == "WAGEEASY") {
            $("#WageEasy").modal('show');
        }else{
            
        }
    }
</script>
<style>
    .form-radius{
        border: #c1c1c1 solid 1px;
        border-radius: 5px !important;
    }
    .parsley-success {
        border-color: #c1c1c1 !important;
    }
    .btn.btn-placeholder {
        width: 82%;
        border: 2px dashed #999;
        color: #999;
    }
    .no-touch .btn.btn-placeholder:hover, .no-touch .btn.btn-placeholder:focus, .btn.btn-placeholder:active, .btn.btn-placeholder.active {
        border-color: #3f3f3f;
        color: #3f3f3f;
    }
    .btn:hover, .btn:focus {
        text-decoration: none;
    }
    .btn.btn-link-danger {
        color: #f27272;
        font-weight: 600;
    }
    .btn.btn-link-danger:hover,.no-touch .btn.btn-link-danger:focus{
        color:white;
        background:#ff5252;
        border-color:#ff5252;
        text-shadow:none
    }

    .btn.btn-close, .btn.btn-close-small {
        border-color: #969a9e;
        float: right;
        font-size: 20px;
    }
</style>
<div class="panel">
    <div class="panel-body" style="margin-left: 264px;">

        <!--        <div class="panel">
                    <div class="panel-body">-->
        <div class="example-box-wrapper">
            <div class="panel-body">
                <h3 style="font-weight: bold;margin-left: 20px;">Add new People</h3>
                <form action="people_multiple" method="POST" data-parsley-validate>
                    <div class="col-sm-12" style="margin-top: 20px;">
                        <div class="form-group">
                            <div class="input-group">
                                <label class="col-sm-12 control-label lbl-text-align">These people work at :</label>
                                <div class="col-sm-6">
                                    <select name="work_at" id="work_at" class="browser-default chosen-select form-control" style="width:100%" >
                                        <option value="<?= $_SESSION['company'] ['id'] ?>" selected ><?= $_SESSION['company'] ['name'] ?></option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="input-group">
                                <label class="col-sm-9 control-label lbl-text-align">Choose a location for your new people and then add as many as you want by typing their names and email addresses. You can always edit someone's details later, so don't worry if you can't remember everything.</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9" style="margin-left: 107px;">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="col-sm-4">
                                    <select name="uplods_multiple" id="uplods_multiple" data-placeholder="Import or Upload a file" placeholder="Import or Upload a file" class="browser-default chosen-select form-control" style="width:100%" onchange = "myFunction()">
                                        <option value="XR" data-service="XR" data-image="xero.png">Xero Payroll</option>
                                        <option value="ADP" data-service="ADP" data-image="adp.png">ADP</option>
                                        <option value="QB" data-service="QB" data-image="qb.png">Quickbooks</option>
                                        <option value="NS" data-service="NS" data-image="ns.png">NetSuite</option>
                                        <option value="ZP" data-service="ZP" data-image="zp.png">Gusto</option>
                                        <option value="MO" data-service="MO" data-image="mo.png">MYOB AccountRight</option>
                                        <option value="MYOB" data-service="MYOB" data-image="myob.png">MYOB</option>
                                        <option value="WAGEEASY" data-service="WAGEEASY" data-image="wageeasy.png">WageEasy</option>
                                        <option value="EXCEL" data-service="EXCEL" data-image="excel.png">Excel</option>
                                    </select>
                                    <!--<option value="XR" style="background-image:url(instance/front/media/people_multi_image/xr.png);">Xero Payroll</option>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--                <div class="col-lg-9 col-sm-12">
                                        <li class="dropdown" style="width: 50%;">
                                            <a id="Bulk_li" href="#" style="width: 50%;" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false">Import or Upload a file<b style="float: right;margin-top: 14px;" class="caret"></b></a>
                                            <ul class="dropdown-menu" style="width: 50%; display: none;">
                                                <li><a href="#" onclick="BultActions('set_access_model');">Set Access</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#" onclick="BultActions('strees_profile_model');">Set Stress Profile</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#" onclick="BultActions('add_training_model');">Add Training</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#" onclick="BultActions('set_rate_model');">Set Rates</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#" onclick="BultActions('send_message_model');">Send Message</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#" onclick="BultActions('send_invitation_model');">Send Invitation</a></li>
                                            </ul>
                                        </li>
                                    </div>-->
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="col-lg-11 col-sm-12 ">
                                    <hr>
                                </div>
                                <div class="col-lg-1 col-sm-12 " style="margin-left: -49%;margin-top: 11px;">
                                    OR
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field_wrapper">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-12 control-label lbl-text-align" >Name</label>
                                            <div class="col-sm-12">
                                                <input id="name"  type="text" name="name[]" class="form-control form-radius"   placeholder="Name" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-12 control-label lbl-text-align" >Email</label>
                                            <div class="col-sm-12">
                                                <input id="email"  type="text" name="email[]" class="form-control form-radius"   placeholder="(Optional)"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-12 control-label lbl-text-align" >Phone Number</label>
                                            <div class="col-sm-12">
                                                <input id="phone_no"  type="text" name="phone_no[]" class="form-control form-radius"   placeholder="(Optional)"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!--                                    <div style="margin-top: 23px;">
                                                                        <a class="btn btn-link-danger remove remove_button" href="javascript:void(0);" title="Remove">
                                                                                <i class="fa fa-trash-o"></i>
                                                                        </a>
                                                                        <a href="javascript:void(0);" class="remove_button" title="Add field">
                                                                            <img src="<?php echo _U ?>instance/front/media/add-icon.png"/>
                                                                        </a>
                                                                    </div>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12" style="margin-top: 5px;">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <a href="javascript:void(0);" class="add_button btn btn-placeholder" title="Add field">
                                        <i class="fa fa-plus"></i>Add More People
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-12" style="margin-top: 50px;">
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-5 control-label lbl-text-align" >Send Invitation Email [?]</label>
                                        <div class="col-sm-6">
                                            <input  type="checkbox" data-on-color="success" name="send_invitation" class="input-switch" checked="" data-size="medium" data-on-text="On" data-off-text="Off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6" align="right" style="margin-left: -174px;">
                            <a href="people"><button class="btn btn-default" type="button">Cancel</button></a>
                            <button class="btn btn-primary" type="submit">Add People</button>
                            <input id="add_people" type="hidden" name="Add_multiple_people" value="1"/>
                        </div>

                    </div>

                </form>
            </div>
        </div>

    </div>
</div>


<div class="modal fadeInUp center "  id="UploadFileExcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document" style="">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title center_bold" id="myModalLabel2" style="text-align: center;font-weight: bold;">Upload file from Excel</h2>
            </div>
            <form action="#" method="POST">
                <div class="modal-body" >
                    <div class="panel" >
                        <div class="panel-body" >
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="padding">
                                            <label>1. Open this sample <a href="https://s3.amazonaws.com/deputymailout/product/DeputyEmployee.xlsx" target="_blank">Excel</a> or <a href="https://docs.google.com/spreadsheet/ccc?key=0AmNtbJFdAyCidEJzQU5aVUFWT0lZYU5YcTlhNjRrWFE&amp;usp=sharing" target="_blank">Google Docs Spreadsheet</a></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="padding">
                                            <label>2. Add your employee details correctly under the column headings. You can delete the sample John person</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="padding">
                                            <label>3. Save the Excel file as CSV file (Comma Separated Value) anywhere in your computer (E.g. Desktop)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="padding">
                                            <label>4. Upload the saved CSV file in using the button to the right.</label>
                                            <div class="col-sm-12"> 
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-default btn-file" style="border-color: #afafaf;">
                                                        <span class="fileinput-new">Browse</span>
                                                        <span class="fileinput-exists"></span>
                                                        <input  type="file" name="..." class="btn btn-default">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Upload file</button>
                    </div> 
                </div> 

            </form>

        </div>
    </div><!-- modal-content -->
</div><!-- modal-dialog -->

<div class="modal fadeInUp center "  id="MyOb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document" style="">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title center_bold" id="myModalLabel2" style="text-align: center;font-weight: bold;">Upload file from Myob</h2>
            </div>
            <form action="#" method="POST">
                <div class="modal-body" >
                    <div class="panel" >
                        <div class="panel-body" >
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="padding">
                                            <label>1. In MYOB Accounts Premiere, go to File <i class="fa fa-arrow-right"></i> Export Data <i class="fa fa-arrow-right"></i> Cards <i class="fa fa-arrow-right"></i> Employee Cards</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="padding">
                                            <label>2. Choose <strong>Tab-delimited</strong> File Format with First Record as <strong>Header Record</strong>. Leave all other selections empty.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="padding">
                                            <label>3. Click Continue</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="padding">
                                            <label>4. Click <strong>Match All</strong> to bring all columns</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="padding">
                                            <label>5. Click Export</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="padding">
                                            <label>6. Save the file to your computer</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="padding">
                                            <label>7. Upload that file using the button to the right.</label>
                                            <div class="col-sm-12"> 
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-default btn-file" style="border-color: #afafaf;">
                                                        <span class="fileinput-new">Browse</span>
                                                        <span class="fileinput-exists"></span>
                                                        <input  type="file" name="..." class="btn btn-default">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Upload file</button>
                    </div> 
                </div> 

            </form>

        </div>
    </div><!-- modal-content -->
</div><!-- modal-dialog -->

<div class="modal fadeInUp center "  id="WageEasy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document" style="">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title center_bold" id="myModalLabel2" style="text-align: center;font-weight: bold;">Upload file from Wageeasy</h2>
            </div>
            <form action="#" method="POST">
                <div class="modal-body" >
                    <div class="panel" >
                        <div class="panel-body" >
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="padding">
                                            <label>1.In WageEasy, go to HR <i class="fa fa-arrow-right"></i> User Defined Queries <i class="fa fa-arrow-right"></i> Deputy Employee Export</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="padding">
                                            <label>2. When the table opens, right click anywhere on the table and choose Export Data <i class="fa fa-arrow-right"></i> CSV</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="padding">
                                            <label>3. Save the file to your computer</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="padding">
                                            <label>4. Upload that file using the button to the right.</label>
                                            <div class="col-sm-12"> 
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-default btn-file" style="border-color: #afafaf;">
                                                        <span class="fileinput-new">Browse</span>
                                                        <span class="fileinput-exists"></span>
                                                        <input  type="file" name="..." class="btn btn-default">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Upload file</button>
                    </div> 
                </div> 

            </form>

        </div>
    </div><!-- modal-content -->
</div><!-- modal-dialog -->