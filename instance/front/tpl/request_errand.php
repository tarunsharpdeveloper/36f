<div class="container">
    <div class="row">
        <div class="pull-right">
            <?php if (checkAccessLevel($_SESSION['user']['access_level'], 'errand', 'add')) { ?>
                <button class="btn btn-warning" onclick="addNewRecord()">Add New</button>
            <?php } ?>
        </div>

        <ul class="nav nav-tabs" style="margin-top:-33px;">
            <li class="active"><a data-toggle="tab" href="#new_request">New Errand</a></li>
            <li><a data-toggle="tab" href="#accepted_request">Accepted Errand</a></li>
            <li><a data-toggle="tab" href="#rejected_request">Rejected Errand</a></li>

        </ul>   

        <div class="tab-content">
            <div id="new_request" class="tab-pane fade in active" style="padding-left:0px;margin-left:-40px;">
                <table class="table table-bordered">
                    <tr>
                        <th>Employee</th>
                        <th>Unique Id</th>
                        <th>Team</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Time</th>
                        <th>Day Request</th>
                        <th>Errand Type</th>
                        <th>Subject</th>
                        <th>Starting Point</th>
                        <th>Destination</th>
                        <th>Overnight Compensation</th>
                        <th>Food</th>
                        <th>Transportation</th>
                        <th>lodging</th>
                        <th>Requested By</th>
                        <th>Employee Comments</th>
                        <th>Manager Comments</th>
                        <th>Expences</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $companyId = $_SESSION['company']['id'];
                    $todayDate = date('Y-m-d');
                    //$timeoffRequest = q("Select * FROM tb_timeoff WHERE company_id = '{$companyId}' AND (status = '' OR status = 'null') AND DATE(from_date) >= '{$todayDate}' ORDER BY id DESC");
                    $errandRequest = q("Select * FROM errands WHERE company_id = '{$companyId}' AND (status = '' OR status = 'null' OR status='NEW_REQUESTED') " . $whereWithTeam . " ORDER BY id DESC");
                    if (count($errandRequest) > 0) {
                        foreach ($errandRequest as $eachErrandsRequest):
                            $reasonName = $eachErrandsRequest['reason'];
                            $employeeName = qs("SELECT id,fname,lname,email,team_id FROM tb_employee WHERE id = '{$eachErrandsRequest['employee_id']}'");
                            $employeeDisplayName = $employeeName['fname'] . " " . $employeeName['lname'];
                            $teamDetail = qs("SELECT name FROM tb_team WHERE id = '{$employeeName['team_id']}'");
                            if (1 == 1) {
                                ?>
                                <tr>
                                    <td><?php print $employeeDisplayName; ?></td>
                                    <td><?php print $eachErrandsRequest['unique_id']; ?></td>  
                                    <td><?php print $teamDetail['name']; ?></td>
                                    <td><?php print $eachErrandsRequest['from_date_time'] ?></td>
                                    <td><?php print $eachErrandsRequest['to_date_time'] ?></td>
                                    <td>
                                        <?php
                                        if ($eachErrandsRequest['total_days_applied'] > 1) {
                                            print convertInFarsi($eachErrandsRequest['total_days_applied']) . " روز";
                                        } else {
                                            print convertInFarsi(convertMinutesToHourMinuteFormat($eachErrandsRequest['total_days'])) . " ساعت";
                                        }
                                        ?>
                                    </td>
                                    <td><?php print $eachErrandsRequest['day_request_submitted'] ?></td>
                                    <td><?php print $eachErrandsRequest['errands_type'] ?></td>
                                    <td><?php print $eachErrandsRequest['subject'] ?></td>
                                    <td>
                                        <?php print $eachErrandsRequest['starting_point'] ?>
                                    </td>
                                    <td>
                                        <?php print $eachErrandsRequest['destination'] ?>
                                    </td>
                                    <td><?php print $eachErrandsRequest['overnight_compensation'] ?></td>
                                    <td>
                                        <?php print $eachErrandsRequest['food_authorization'] ?>
                                    </td>
                                    <td>
                                        <?php print $eachErrandsRequest['transportation_method'] ?>
                                    </td>
                                    <td><?php print $eachErrandsRequest['lodging'] ?></td>
                                    <td><?php print $eachErrandsRequest['requested_by'] ?></td>
                                    <td>
                                        <?php print $eachErrandsRequest['employee_comments'] ?>
                                    </td>
                                    <td>
                                        <?php print $eachErrandsRequest['manager_comments'] ?>
                                    </td>
                                    <td><?php print $eachErrandsRequest['expences'] ?></td>
                                    <td><?php print $eachErrandsRequest['status'] ?></td>
                                    <td>
                                        <?php if ($eachErrandsRequest['status'] == '' || $eachErrandsRequest['status'] == 'null' || $eachErrandsRequest['status'] == 'NEW_REQUESTED') { ?>
                                            <?php if (checkAccessLevel($_SESSION['user']['access_level'], 'errand', 'approve')) { ?>    
                                                <div class="btn btn-success" onclick="acceptRejectModal(this);" data-value="Accept" data-id='<?= $eachErrandsRequest['id'] ?>'>Accept</div><br>
                                                <div class="btn btn-default" onclick="acceptRejectModal(this);" data-value="Reject" data-id='<?= $eachErrandsRequest['id'] ?>'>Reject</div><br>
                                            <?php } ?>

                                            <?php if (checkAccessLevel($_SESSION['user']['access_level'], 'errand', 'edit')) { ?>
                                                <div class="btn btn-success" onclick="openEditPopup('<?php print $eachErrandsRequest['id'] ?>');" data-value="Edit" data-id='<?= $eachErrandsRequest['id'] ?>'>Edit</div><br>
                                            <?php } ?>
                                            <div class="btn btn-success" onclick="openHistoryPopup('<?php print $eachErrandsRequest['id'] ?>');">History</div>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                            }

                        endforeach;
                        ?>
                        <?php
                    } else {
                        ?>
                        <tr><td colspan="15">No record found</td></tr>
                    <?php } ?>

                </table>
            </div>



            <div id="accepted_request" class="tab-pane fade">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#accepted_archived">Archived</a></li>
                    <li><a data-toggle="tab" href="#accepted_active">Active</a></li>
                    <li><a data-toggle="tab" href="#accepted_both">Both</a></li>
                </ul>

                <?php
                // 1 = accepted_archived
                // 2 = accepted_active
                // 3 = accepted_both
                $companyId = $_SESSION['company']['id'];
                for ($i = 1; $i <= 3; $i++) {
                    $idName = '';
                    $activeCls = '';
                    $selectQuery = '';
                    if ($i == 1) { // accepted_archived
                        $idName = "accepted_archived";
                        $activeCls = " in active";
                        $selectQuery = "Select * FROM errands WHERE company_id = '{$companyId}' AND status = 'Accept' AND DATE(to_date_time) < '{$todayDate}' " . $whereWithTeam . " ORDER BY id ASC";
                    } else if ($i == 2) { // accepted_active
                        $idName = "accepted_active";
                        $activeCls = "";
                        $selectQuery = "Select * FROM errands WHERE company_id = '{$companyId}' AND status = 'Accept' AND DATE(to_date_time) >= '{$todayDate}' " . $whereWithTeam . " ORDER BY id ASC";
                    } else if ($i == 3) { // accepted_both
                        $idName = "accepted_both";
                        $activeCls = "";
                        $selectQuery = "Select * FROM errands WHERE company_id = '{$companyId}' AND status = 'Accept' " . $whereWithTeam . " ORDER BY id ASC";
                    }
                    ?>

                    <div id="<?php print $idName; ?>" class="tab-pane fade<?php print $activeCls; ?>">

                        <table class="table table-bordered">
                            <tr>
                                <th>Employee</th>
                                <th>Unique Id</th>
                                <th>Team</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Time</th>
                                <th>Day Request</th>
                                <th>Errand Type</th>
                                <th>Subject</th>
                                <th>Starting Point</th>
                                <th>Destination</th>
                                <th>Overnight Compensation</th>
                                <th>Food</th>
                                <th>Transportation</th>
                                <th>lodging</th>
                                <th>Requested By</th>
                                <th>Employee Comments</th>
                                <th>Manager Comments</th>
                                <th>Expences</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                            <?php
                            $errandRequest = q($selectQuery);
                            if (count($errandRequest) > 0) {
                                foreach ($errandRequest as $eachErrandsRequest):
                                    $reasonName = $eachErrandsRequest['reason'];
                                    $employeeName = qs("SELECT id,fname,lname,email,team_id FROM tb_employee WHERE id = '{$eachErrandsRequest['employee_id']}'");
                                    $employeeDisplayName = $employeeName['fname'] . " " . $employeeName['lname'];
                                    $teamDetail = qs("SELECT name FROM tb_team WHERE id = '{$employeeName['team_id']}'");
                                    if (1 == 1) {
                                        ?>
                                        <tr>
                                            <td><?php print $employeeDisplayName; ?></td>
                                            <td><?php print $eachErrandsRequest['unique_id']; ?></td>  
                                            <td><?php print $teamDetail['name']; ?></td>
                                            <td><?php print $eachErrandsRequest['from_date_time'] ?></td>
                                            <td><?php print $eachErrandsRequest['to_date_time'] ?></td>
                                            <td>
                                                <?php
                                                if ($eachErrandsRequest['total_days_applied'] > 1) {
                                                    print convertInFarsi($eachErrandsRequest['total_days_applied']) . " روز";
                                                } else {
                                                    print convertInFarsi(convertMinutesToHourMinuteFormat($eachErrandsRequest['total_days'])) . " ساعت";
                                                }
                                                ?>
                                            </td>
                                            <td><?php print $eachErrandsRequest['day_request_submitted'] ?></td>
                                            <td><?php print $eachErrandsRequest['errands_type'] ?></td>
                                            <td><?php print $eachErrandsRequest['subject'] ?></td>
                                            <td>
                                                <?php print $eachErrandsRequest['starting_point'] ?>
                                            </td>
                                            <td>
                                                <?php print $eachErrandsRequest['destination'] ?>
                                            </td>
                                            <td><?php print $eachErrandsRequest['overnight_compensation'] ?></td>
                                            <td>
                                                <?php print $eachErrandsRequest['food_authorization'] ?>
                                            </td>
                                            <td>
                                                <?php print $eachErrandsRequest['transportation_method'] ?>
                                            </td>
                                            <td><?php print $eachErrandsRequest['lodging'] ?></td>
                                            <td><?php print $eachErrandsRequest['requested_by'] ?></td>
                                            <td>
                                                <?php print $eachErrandsRequest['employee_comments'] ?>
                                            </td>
                                            <td>
                                                <?php print $eachErrandsRequest['manager_comments'] ?>
                                            </td>
                                            <td><?php print $eachErrandsRequest['expences'] ?></td>
                                            <td><?php print $eachErrandsRequest['status'] ?></td>
                                            <td>
                                                <?php
                                                if (date('Y-m-d', strtotime($eachErrandsRequest['from_date_time'])) > date('Y-m-d')) {
                                                    ?>

                                                    <?php if (checkAccessLevel($_SESSION['user']['access_level'], 'errand', 'edit')) { ?>

                                                        <div class="btn btn-success" onclick="openEditPopup('<?php print $eachErrandsRequest['id'] ?>');" data-value="Edit" data-id='<?= $eachErrandsRequest['id'] ?>'>Edit</div><br>
                                                    <?php } ?>
                                        <!-- <div class="btn btn-default" onclick="acceptRejectModal(this);" data-value="Cancel" data-id='<?= $eachErrandsRequest['id'] ?>'>Cancel </div><br> -->

                                                    <?php if (strtolower($_SESSION['user']['access_level']) == 'admin') { ?>
                                                        <div class="btn btn-default" onclick="adminDeleteModal(this);" data-value="Delete" data-id='<?= $eachErrandsRequest['id'] ?>'>Delete </div><br>
                                                    <?php } else { ?>
                                                        <div class="btn btn-default" onclick="acceptRejectModal(this);" data-value="Cancel" data-id='<?= $eachErrandsRequest['id'] ?>'>Cancel </div><br> 
                                                    <?php } ?>
                                                    <div><div class="btn btn-success" onclick="openHistoryPopup('<?php print $eachErrandsRequest['id'] ?>');">History</div></div> 
                                                <?php } else {
                                                    ?>
                                                    <?php if (checkAccessLevel($_SESSION['user']['access_level'], 'errand', 'edit')) { ?>
                                                        <?php if (strtolower($_SESSION['user']['access_level']) != 'admin') { ?>
                                                            <div class="btn btn-success" disabled>Edit</div><br>
                                                        <?php } else { ?>
                                                            <div class="btn btn-success" onclick="openEditPopup('<?php print $eachErrandsRequest['id'] ?>');" data-value="Edit" data-id='<?= $eachErrandsRequest['id'] ?>'>Edit</div><br> 
                                                        <?php } ?>
                                                        <?php if (strtolower($_SESSION['user']['access_level']) != 'admin') { ?>
                                                            <div class="btn btn-default" disabled>Cancel </div><br>
                                                        <?php } ?>
                                                    <?php } ?> 
                                                    <?php if (strtolower($_SESSION['user']['access_level']) == 'admin') { ?>
                                                        <div class="btn btn-default" onclick="adminDeleteModal(this);" data-value="Delete" data-id='<?= $eachErrandsRequest['id'] ?>'>Delete </div><br>
                                                    <?php } ?>       
                                                    <div><div class="btn btn-success" onclick="openHistoryPopup('<?php print $eachErrandsRequest['id'] ?>');">History</div></div> 
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }

                                endforeach;
                                ?>
                                <?php
                            } else {
                                ?>
                                <tr><td colspan="15">No record found</td></tr>
                            <?php } ?>

                        </table>

                    </div>


                <?php } ?>
            </div>



            <div id="rejected_request" class="tab-pane fade">
                <ul class="nav nav-tabs">

                    <li class="active"><a data-toggle="tab" href="#rejected_archived">Archived</a></li>
                    <li><a data-toggle="tab" href="#rejected_upcoming">Upcoming</a></li>

                </ul>
                <?php
// 1 = rejected_archived
// 2 = rejected_upcoming
                $companyId = $_SESSION['company']['id'];
                for ($i = 1; $i <= 2; $i++) {
                    $idName = '';
                    $activeCls = '';
                    $selectQuery = '';
                    if ($i == 1) { // rejected_archived
                        $idName = "rejected_archived";
                        $activeCls = " in active";
                        $selectQuery = "Select * FROM errands WHERE company_id = '{$companyId}' AND (status = 'Reject' OR status = 'Cancel' OR status = 'Delete') AND DATE(to_date_time) < '{$todayDate}' " . $whereWithTeam . " ORDER BY id DESC";
                    } else if ($i == 2) { // rejected_upcoming
                        $idName = "rejected_upcoming";
                        $activeCls = "";
                        $selectQuery = "Select * FROM errands WHERE company_id = '{$companyId}' AND (status = 'Reject' OR status = 'Cancel' OR status = 'Delete') AND DATE(to_date_time) >= '{$todayDate}' " . $whereWithTeam . " ORDER BY id DESC";
                    }
                    ?>  
                    <div id="<?php print $idName; ?>" class="tab-pane fade<?php print $activeCls; ?>">

                        <table class="table table-bordered">
                            <tr>
                                <th>Employee</th>
                                <th>Unique Id</th>
                                <th>Team</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Time</th>
                                <th>Day Request</th>
                                <th>Errand Type</th>
                                <th>Subject</th>
                                <th>Starting Point</th>
                                <th>Destination</th>
                                <th>Overnight Compensation</th>
                                <th>Food</th>
                                <th>Transportation</th>
                                <th>lodging</th>
                                <th>Requested By</th>
                                <th>Employee Comments</th>
                                <th>Manager Comments</th>
                                <th>Expences</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                            <?php
                            $errandRequest = q($selectQuery);
                            if (count($errandRequest) > 0) {
                                foreach ($errandRequest as $eachErrandsRequest):
                                    $reasonName = $eachErrandsRequest['reason'];
                                    $employeeName = qs("SELECT id,fname,lname,email,team_id FROM tb_employee WHERE id = '{$eachErrandsRequest['employee_id']}'");
                                    $employeeDisplayName = $employeeName['fname'] . " " . $employeeName['lname'];
                                    $teamDetail = qs("SELECT name FROM tb_team WHERE id = '{$employeeName['team_id']}'");
                                    if (1 == 1) {
                                        ?>
                                        <tr>
                                            <td><?php print $employeeDisplayName; ?></td>
                                            <td><?php print $eachErrandsRequest['unique_id']; ?></td>  
                                            <td><?php print $teamDetail['name']; ?></td>
                                            <td><?php print $eachErrandsRequest['from_date_time'] ?></td>
                                            <td><?php print $eachErrandsRequest['to_date_time'] ?></td>
                                            <td>
                                                <?php
                                                if ($eachErrandsRequest['total_days_applied'] > 1) {
                                                    print convertInFarsi($eachErrandsRequest['total_days_applied']) . " روز";
                                                } else {
                                                    print convertInFarsi(convertMinutesToHourMinuteFormat($eachErrandsRequest['total_days'])) . " ساعت";
                                                }
                                                ?>
                                            </td>
                                            <td><?php print $eachErrandsRequest['day_request_submitted'] ?></td>
                                            <td><?php print $eachErrandsRequest['errands_type'] ?></td>
                                            <td><?php print $eachErrandsRequest['subject'] ?></td>
                                            <td>
                                                <?php print $eachErrandsRequest['starting_point'] ?>
                                            </td>
                                            <td>
                                                <?php print $eachErrandsRequest['destination'] ?>
                                            </td>
                                            <td><?php print $eachErrandsRequest['overnight_compensation'] ?></td>
                                            <td>
                                                <?php print $eachErrandsRequest['food_authorization'] ?>
                                            </td>
                                            <td>
                                                <?php print $eachErrandsRequest['transportation_method'] ?>
                                            </td>
                                            <td><?php print $eachErrandsRequest['lodging'] ?></td>
                                            <td><?php print $eachErrandsRequest['requested_by'] ?></td> 
                                            <td>
                                                <?php print $eachErrandsRequest['employee_comments'] ?>
                                            </td>
                                            <td>
                                                <?php print $eachErrandsRequest['manager_comments'] ?>
                                            </td>
                                            <td><?php print $eachErrandsRequest['expences'] ?></td>
                                            <td><?php print $eachErrandsRequest['status'] ?></td>

                                            <td>
                                                <div><div class="btn btn-success" onclick="openHistoryPopup('<?php print $eachErrandsRequest['id'] ?>');">History</div></div> 
                                            </td>

                                        </tr>
                                        <?php
                                    }

                                endforeach;
                                ?>
                                <?php
                            } else {
                                ?>
                                <tr><td colspan="14">No record found</td></tr>
                            <?php } ?>

                        </table>

                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div id="commentModal" class="modal modal-fixed-header-footer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <form id="request_errand_form" action="request_errand" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="admin-manager-select">Manager Comment</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="1" name="requestResult">
                    <input type="hidden" value="" name="reason" id="reason">
                    <input type="hidden" value="" name="requestId" id="requestId">
                    <div class="form-group">
                        <textarea id="singleCommnet" class="form-control input-field" name="commnet"></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div class="btn btn-default" type="button" data-dismiss="modal">Close</div>
                <button class="btn btn-primary" type="submit">Save changes</button>
            </div>
        </form>
    </div>
</div>


<div id="editModal" class="modal modal-fixed-header-footer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="request_errand" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Record</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="1" name="requestEdit"> 
                    <input type="hidden" value="" name="editRecordId" id="editRecordId">
                    <div class="col-md-12">
                        <div class="form-group col-md-6">
                            Errand Type :
                            <select name="edit_errand_type" id="edit_errand_type" class="edit-required_fields">
                                <option value="local">Local</option>
                                <option value="out of town">Out of town</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            Absence Type :
                            <select name="edit_absence_type" id="edit_absence_type" onchange="inputBoxEditChanges(this)" class="edit-required_fields">
                                <option value="">Select Type</option>
                                <option value="hourly">Hourly</option>
                                <option value="entireDay">Entire Day</option> 
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            Subject : <input type="text" name="edit_subject" id="edit_subject" value=""/>
                        </div> 
                        <div class="form-group editHourlyInput col-md-6"> 
                            Leave Date : <input type="text" name="edit_leave_date" id="edit_leave_date" class="" value="" placeholder="YYYY-mm-dd"/> 
                        </div> 
                        <div class="form-group col-md-6">
                            <span class="editLableStartChnages">Start Date :</span> <input type="text" name="edit_start_date" id="edit_start_date" value="" class="edit-required_fields"/>
                        </div>
                        <div class="form-group col-md-6">
                            <span class="editLableEndChnages">End Date :</span> <input type="text" name="edit_end_date" id="edit_end_date" value="" class="edit-required_fields"/>
                        </div>
                        <div class="form-group col-md-6">
                            Day Request : <input type="text" name="edit_day_request" id="edit_day_request" value="" placeholder="YYYY-mm-dd"/>
                        </div>
                        <div class="form-group col-md-6">
                            Requested By : <input type="text" name="edit_request_by" id="edit_request_by" value=""/>
                        </div>
                        <div class="form-group col-md-6">
                            Starting Point : <input type="text" name="edit_starting_point" id="edit_starting_point" value=""/>
                        </div>
                        <div class="form-group col-md-6">
                            Destination : <input type="text" name="edit_destination" id="edit_destination" value=""/>
                        </div>
                        <div class="form-group col-md-6">
                            Overnight Compensation: 
                            <label>Yes <input type="radio" name="edit_overnight" id="overnight_yes" value="yes"/></label>
                            <label>No <input type="radio" name="edit_overnight" id="overnight_no" value="no"/></label>
                        </div>
                        <div class="form-group col-md-6">
                            Food Authorization: 
                            <label>Yes <input type="radio" name="edit_food" id="food_yes" value="yes"/></label>
                            <label>No <input type="radio" name="edit_food" id="food_no" value="no"/></label>
                        </div>
                        <div class="form-group col-md-6">
                            Transportation Method :
                            <select name="edit_transportation" id="edit_transportation">
                                <option value="">Default</option>
                                <option value="taxi">Taxi</option>
                                <option value="bus">Bus</option>
                                <option value="train">Train</option>
                                <option value="plane">Plane</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            Lodging : <input type="text" name="edit_lodging" id="edit_lodging" value=""/>
                        </div>

                        <div class="form-group col-md-6">
                            Expences : <input type="text" name="edit_expences" id="edit_expences" value=""/>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-md-12">
                            Manager Comments<br/>
                            Old : <span id="manager_oldComments">-</span>
                            <textarea class="form-control input-field edit-required_fields" name="edit_manager_commnet" id="edit_manager_commnet" required=""></textarea>
                        </div>
                        <div class="clearfix"></div>
                        <div id="editFormCompulsary" class="hidden alert alert-danger">Please fill up required fields</div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">
                <div class="btn btn-default" type="button" data-dismiss="modal">Close</div>
                <button class="btn btn-primary" type="submit" onclick="return beforeEditSubmit()">Save changes</button>
            </div>
        </form>
    </div>
</div>
  
<div id="historyModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Request History</h4>
            </div>
            <div class="modal-body" id="historyListing" style="max-height:450px;overflow-y:scroll;">

            </div>
        </div>
        <div class="modal-footer">
            <div class="btn btn-default" type="button" data-dismiss="modal">Close</div>
        </div>
    </div>
</div>
 
<div id="addModal" class="modal modal-fixed-header-footer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="request_errand" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Record</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="1" name="requestAdd"> 
                    <div class="col-md-12">
                        <div class="form-group  col-md-6">
                            Select Employee :
                            <select name="add_emp_id" id="add_emp_id" class="add-required_fields">
                                <option value="">Select Employee</option>
                                <?php
                                foreach ($employee as $each_employee) {
                                    if ($each_employee['mobile'] != '') {
                                        ?>
                                        <option value="<?php echo $each_employee['id'] ?>"><?php echo $each_employee['fname'] . " " . $each_employee['lname'] . " (" . $each_employee['mobile'] . ")" ?></option>                                        
                                    <?php } else {
                                        ?>
                                        <option value="<?php echo $each_employee['id'] ?>"><?php echo $each_employee['fname'] . " " . $each_employee['lname']; ?></option>                                      
                                    <?php } ?>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            Errand Type :
                            <select name="add_errand_type" id="add_errand_type" class="add-required_fields">
                                <option value="local">Local</option>
                                <option value="out of town">Out of town</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 ">
                            Subject : <input type="text" name="add_subject" id="add_subject" value=""  class=""/>
                        </div> 
                        <div class="form-group col-md-6">
                            Absence Type :
                            <select name="add_absence_type" id="add_absence_type" onchange="inputBoxChanges(this)" class="add-required_fields">
                                <option value="">Select Type</option>
                                <option value="hourly">Hourly</option>
                                <option value="entireDay">Entire Day</option> 
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group HourlyInput hidden col-md-6"> 
                            Leave Date : <input type="text" name="add_leave_date" id="add_leave_date" class="" value="" placeholder="YYYY-mm-dd"/> 
                        </div> 
                        <div class="form-group col-md-6">
                            <span class="LableStartChnages">Start Date :</span> <input type="text" name="add_start_date" id="add_start_date" value="" class="add-required_fields" placeholder="YYYY-mm-dd"/>
                        </div>
                        <div class="form-group col-md-6">
                            <span class="LableEndChnages">End Date :</span> <input type="text" name="add_end_date" id="add_end_date" value="" class="add-required_fields" placeholder="YYYY-mm-dd"/> 
                        </div> 
                        <div class="form-group col-md-6">
                            Day Request : <input type="text" name="add_day_request" id="add_day_request" value="" class="" placeholder="YYYY-mm-dd"/>
                        </div>
                        <div class="form-group col-md-6">
                            Requested By : <input type="text" name="add_request_by" id="add_request_by" value="" class=""/>
                        </div>
                        <div class="form-group col-md-6">
                            Starting Point : <input type="text" name="add_starting_point" id="add_starting_point" value="" class=""/>
                        </div>
                        <div class="form-group col-md-6">
                            Destination : <input type="text" name="add_destination" id="add_destination" value="" class=""/>
                        </div>
                        <div class="form-group col-md-6">
                            Overnight Compensation: 
                            <label>Yes <input type="radio" name="add_overnight" id="overnight_yes" value="yes"/></label>
                            <label>No <input type="radio" name="add_overnight" id="overnight_no" value="no"/></label>
                        </div>
                        <div class="form-group col-md-6">
                            Food Authorization: 
                            <label>Yes <input type="radio" name="add_food" id="food_yes" value="yes"/></label>
                            <label>No <input type="radio" name="add_food" id="food_no" value="no"/></label>
                        </div>
                        <div class="form-group col-md-6">
                            Transportation Method :
                            <select name="add_transportation" id="add_transportation"  class="">
                                <option value="">Default</option>
                                <option value="taxi">Taxi</option>
                                <option value="bus">Bus</option>
                                <option value="train">Train</option>
                                <option value="plane">Plane</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-md-6">
                            Lodging : <input type="text" name="add_lodging" id="add_lodging" value=""  class=""/>
                        </div>

                        <div class="form-group col-md-6">
                            Expences : <input type="text" name="add_expences" id="add_expences" value=""  class=""/>
                        </div>

                        <div class="form-group col-md-12">
                            Manager Comments<br/>
                            <textarea class="form-control input-field" name="add_manager_commnet" id="add_manager_commnet"></textarea>
                        </div> 
                        <div class="clearfix"></div>
                        <div id="addFormCompulsary" class="hidden alert alert-danger">Please fill up required the fields</div>
                        <div class="clearfix"></div> 
                    </div>
                    <div class="clearfix"></div> 
                </div>
                <div class="clearfix"></div> 
            </div>
            <div class="modal-footer">
                <div class="btn btn-default" type="button" data-dismiss="modal">Close</div>
                <button class="btn btn-primary" type="submit" onclick="return beforeAddSubmit()">Save changes</button>
            </div>
        </form>
    </div>
</div> 

<div class="hidden" id="oldRequestData">
    <span id="old_errand_type"></span>
    <span id="old_errand_absence_type"></span>
    <span id="old_subject"></span>
    <span id="old_start_date"></span>
    <span id="old_end_date"></span>
    <span id="old_day_request"></span>
    <span id="old_requested_by"></span>
    <span id="old_starting_point"></span>
    <span id="old_destination"></span>
    <span id="old_overnight_compensation"></span>
    <span id="old_food_authorization"></span>
    <span id="old_transportation_method"></span>
    <span id="old_lodging"></span>
    <span id="old_expences"></span>
    <span id="old_manager_comments"></span>

</div>

<style type="text/css">
    td div.btn {
        width:100%;
        margin-bottom: 4px;
    } 
</style>  
