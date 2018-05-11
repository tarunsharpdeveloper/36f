<div class="panel">
    <div class="panel-body">
        <div>
            <div class="col-lg-12 col-sm-12">
                <h2 style="font-weight: bold;">Add shift</h2>
            </div>
            <div class="col-lg-12 col-sm-12" style="padding-top: 20px">
                <form id="form_test_add_shift">
                    <div class="col-lg-4 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Select Employee</label>
                            <div>
                                <select class="form-control" name="employee">
                                    <?php foreach ($employee as $each_employee) { ?>
                                        <option value="<?php echo $each_employee['id'] ?>"><?php echo $each_employee['fname'] . " " . $each_employee['lname'] . " (" . $each_employee['mobile'] . ")" ?></option>                                      
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Shift Start Date</label>
                            <div>
                                <input class="form-control chnageInput" name="shift_start_date" id="main_shift_sdate" placeholder="YYYY-MM-DD" type="text">
                                <span class="copyShift hidden green-text">Enter copy shift start date</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Shift End Date</label>
                            <div>
                                <input class="form-control chnageInput" name="shift_end_date" id="main_shift_edate" placeholder="YYYY-MM-DD" type="text">
                                <span class="copyShift hidden green-text">Enter copy shift end date</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Shift Start Time</label>
                            <div>
                                <input class="form-control inputControl" name="shift_start_time" id="" placeholder="EX. 18:30" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Shift Time</label>
                            <div>
                                <input class="form-control inputControl" name="shift_end_time" id="" placeholder="EX. 18:30" type="text">
                            </div>
                        </div>
                    </div>

                </form>

                <div class="col-lg-12">
                    <div class="btn btn-success" onclick="submitData()">Submit</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-body">
        <div class="col-lg-12 col-sm-12">
            <h2 style="font-weight: bold;">Add shift list</h2>
        </div>
        <div class="col-lg-12 col-sm-12" style="padding-top: 20px">
            <table class="table">
                <thead>
                    <tr>
                        <td>Employee Name</td>
                        <td>Shift start date</td>
                        <td>Shift start time</td>
                        <td>Shift end date</td>
                        <td>Shift end time</td>
                        <td>Total hours</td>
                    </tr>
                </thead>
                <tbody id="add_shift_list_data">
                    <?php include _PATH . "instance/front/tpl/add_shift_data.php"; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="editModal" class="modal fade in" role="dialog" >
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <!--<button type="button" class="close" data-dismiss="modal">×</button>-->
            <form action="<?php echo _U ?>add_shift" method="post" id="editForm">
                <div class="modal-body">
                    <input type="hidden" name="editShift" value="1"/>
                    <input type="hidden" id="editShiftID" name="editShiftID" value="1"/>
                    <input type="hidden" id="employeeID" name="employeeID" value=""/>

                    <div class="col-lg-3 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Shift Start Date</label>
                            <div>
                                <input class="form-control" name="shift_start_date" id="shift_start_date" placeholder="EX. 10-5-2017" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Shift Start Time</label>
                            <div>
                                <input class="form-control" name="shift_start_time" id="shift_start_time" placeholder="EX. 18:30" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Shift Time</label>
                            <div>
                                <input class="form-control" name="shift_end_time" id="shift_end_time" placeholder="EX. 18:30" type="text">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="clearfix" ></div>
            </form>
            <div class="modal-body">
                <div class="btn btn-default pull-left" onclick="editFormSubmit()">Edit Changes </div>
                <div class="btn btn-default pull-left" data-dismiss="modal" style="margin-left:10px;">No</div>
                <div class="clearfix" ></div>
            </div>

        </div>
    </div>
</div>
<div id="deleteModal" class="modal fade in" role="dialog" >
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Are you sure you want to delete this shift? </h4>
            <form action="<?php echo _U ?>add_shift" method="post">
                <input type="hidden" name="deleteShift" value="1"/>
                <input type="hidden" id="deleteShiftId" name="deleteShiftId" value=""/>
                <button type="submit" class="btn btn-default pull-left">Yes</button>
            </form>

            <div class="btn btn-default pull-left" data-dismiss="modal">No</div>
            <div class="clearfix" ></div>
        </div>
    </div>
</div>

<div id="leaveModal" class="modal fade in" role="dialog" >
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body leaveBody">

            </div>
            <div class="clearfix" ></div>
            <div class="modal-body">
                <div class="btn btn-default pull-left" onclick="allowDates()">Allow Dates</div>
                <div class="btn btn-default pull-left" data-dismiss="modal">No</div>
                <div class="clearfix" ></div>
            </div>

        </div>
    </div>
</div>

<div id="leaveModalEdit" class="modal fade in" role="dialog" >
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body leaveBodyEdit">

            </div>
            <div class="clearfix" ></div>
            <div class="modal-body">
                <div class="btn btn-default pull-left" onclick="editFormSubmitAllow()">Allow Dates</div>
                <div class="btn btn-default pull-left" onclick="leaveModalEditClose()" style="margin-left:10px;">No</div>
                <div class="clearfix" ></div>
            </div>

        </div>
    </div>
</div>
<style>
    .green-text{color: #2ecc71;}
</style> 