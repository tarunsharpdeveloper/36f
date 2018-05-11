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
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Shift Start Date</label>
                            <div>
                                <input class="form-control" name="shift_start_date" id="shift_start_date" placeholder="EX. 10-5-2017" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Shift Start Time</label>
                            <div>
                                <input class="form-control" name="shift_start_time" id="shift_start_time" placeholder="EX. 18:30" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-lg-4 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Shift End Date</label>
                            <div>
                                <input class="form-control" name="shift_end_date" id="shift_end_date" placeholder="EX. 10-5-2017" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Shift End Time</label>
                            <div>
                                <input class="form-control" name="shift_end_time" id="shift_end_time" placeholder="EX. 18:30" type="text">
                            </div>
                        </div>
                    </div>
<!--                    <div class="col-lg-4 col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Total Hours</label>
                            <div>
                                <input class="form-control" name="total_hours" id="total_hours" placeholder="EX. 10" type="text">
                            </div>
                        </div>
                    </div>-->

                    <div class="clearfix"></div>

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
                        <td>Customer Name</td>
                        <td>Shift start date</td>
                        <td>Shift start time</td>
                        <td>Shift end date</td>
                        <td>Shift end time</td>
                        <td>Total hours</td>
                    </tr>
                </thead>
                <tbody id="add_shift_list_data">
                    <?php include _PATH . "instance/front/tpl/test_add_shift_data.php"; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">


    /*$("#pdate, #pmonth, #pyear").change(function () {
     $.ajax({
     url: "<?php echo _U ?>test_date",
     data: {date_convert: 1, pdate: $("#pdate").val(), pmonth: $("#pmonth").val(), pyear: $("#pyear").val()},
     method: "post",
     success: function (r) {
     $("#span_gregorian").html(r);
     }
     });
     });*/
</script>
