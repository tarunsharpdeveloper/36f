<div class="container">
    <div class="row">
        <div class="pull-right">
<?php if (checkAccessLevel($_SESSION['user']['access_level'], 'timeoff', 'add')) { ?>
                <button class="btn btn-warning" onclick="addNewRecord()">Add New</button>
            <?php } ?>

        </div>
        <div class="clearfix"></div>
        <ul class="nav nav-tabs" style="margin-top:-33px;">
            <li class="active"><a data-toggle="tab" href="#new_request">New Request</a></li>
            <li><a data-toggle="tab" href="#accepted_request">Accepted Request</a></li>
            <li><a data-toggle="tab" href="#rejected_request">Rejected Request</a></li>
        </ul>

        <div class="tab-content">
            <div id="new_request" class="tab-pane fade in active">
                <table class="table table-bordered">
                    <tr>
                        <th>Employee</th>
                        <th>Unique Id</th>
                        <th>Team</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Total Time</th>
                        <th>Entire day/hourly</th>
                        <th>Absent Reason</th>
                        <th>Employee comment</th>
                        <th>Manager comment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

<?php
$companyId = $_SESSION['company']['id'];  
$todayDate = date('Y-m-d');
//$timeoffRequest = q("Select * FROM tb_timeoff WHERE company_id = '{$companyId}' AND (status = '' OR status = 'null') AND DATE(from_date) >= '{$todayDate}' ORDER BY id DESC");
$timeoffRequest = q("Select * FROM tb_timeoff WHERE company_id = '{$companyId}' AND (status = '' OR status = 'null' OR status = 'NEW_REQUEST') " . $whereWithTeam . " ORDER BY id DESC");
if (count($timeoffRequest) > 0) {
    foreach ($timeoffRequest as $eachTimeoffRequest):
        $reasonName = $eachTimeoffRequest['reason']; 
        $allowedReasonArr = array('Day Off (With Payment)', 'Time Off (Without Payment)', 'Sick Time');
        $reasonValId = $eachTimeoffRequest['reason_id']; 
        $allowedReasonIdsArr = array(4, 2, 3); 
        if (in_array($reasonName, $allowedReasonArr) || ($reasonValId > 0 && in_array($reasonValId, $allowedReasonIdsArr))) {
            $employeeName = qs("SELECT id,fname,lname,email,team_id FROM tb_employee WHERE id = '{$eachTimeoffRequest['emp_id']}'");
            $employeeDisplayName = $employeeName['fname'] . " " . $employeeName['lname'];
            $teamDetail = qs("SELECT name FROM tb_team WHERE id = '{$employeeName['team_id']}'");
            //if (($eachTimeoffRequest['status'] == 'Accept' && date('Y-m-d', strtotime($eachTimeoffRequest['to_date'])) >= date('Y-m-d')) || ($eachTimeoffRequest['status'] == '' && date('Y-m-d', strtotime($eachTimeoffRequest['to_date'])) >= date('Y-m-d'))) 
            if (1 == 1) {
                ?>
                                    <tr>
                                        <td><?php print $employeeDisplayName; ?></td>
                                        <td><?php print $eachTimeoffRequest['unique_id']; ?></td> 
                                        <td><?php print $teamDetail['name']; ?></td>
                                        <td><?php print date("Y-m-d", strtotime($eachTimeoffRequest['from_date'])); ?></td>
                                        <td><?php print date("Y-m-d", strtotime($eachTimeoffRequest['to_date'])); ?></td>
                                        <td><?php echo $eachTimeoffRequest['absence_type'] == 'hourly' ? date("H:i:s", strtotime($eachTimeoffRequest['from_date'])) : '-'; ?></td>
                                        <td><?php echo $eachTimeoffRequest['absence_type'] == 'hourly' ? date("H:i:s", strtotime($eachTimeoffRequest['to_date'])) : '-'; ?></td>
                                        <td>
                <?php
                if (strtolower($eachTimeoffRequest['absence_type']) == 'entireday') {
                    /*  $totalDaysVal = '';
                      $totalDaysVal = $eachTimeoffRequest['total_days_applied'];
                      $persianNumbers1 = substr($totalDaysVal, 0, 1);
                      $persianNumbers2 = substr($totalDaysVal, 1, 1);
                      $persianNoDays = '';
                      if ($persianNumbers1 != '') {
                      $persianNoDays.= $persianNumbers[$persianNumbers1];
                      }
                      if ($persianNumbers2 != '') {
                      $persianNoDays.= $persianNumbers[$persianNumbers2];
                      } */
                    echo convertInFarsi($eachTimeoffRequest['total_days_applied']) . " روز";
//                                                echo "<br>" . $persianNoDays . " روز";
                } else {
                    echo convertInFarsi(convertMinutesToHourMinuteFormat($eachTimeoffRequest['total_days'])) . " ساعت";
//                                                echo convertMinutesToHourMinuteFormat($eachTimeoffRequest['total_days']) . " ساعت";
                }
                ?>
                                        </td>
                                        <td><?php print $eachTimeoffRequest['absence_type'] ?></td>
                                        <td><?php print $eachTimeoffRequest['reason'] ?></td>
                                        <td><?php print $eachTimeoffRequest['employee_notes'] ?></td>
                                        <td><?php print $eachTimeoffRequest['manager_notes'] ?></td>
                                        <td><?php print $eachTimeoffRequest['status'] ?></td> 
                                        <td>
                <?php if ($eachTimeoffRequest['status'] == '' || $eachTimeoffRequest['status'] == 'NEW_REQUEST') { ?>
                    <?php if (checkAccessLevel($_SESSION['user']['access_level'], 'timeoff', 'approve')) { ?>    
                                                    <div class="btn btn-success" onclick="acceptRejectModal(this);" data-value="Accept" data-id='<?= $eachTimeoffRequest['id'] ?>'>Accept</div><br>
                                                    <div class="btn btn-default" onclick="acceptRejectModal(this);" data-value="Reject" data-id='<?= $eachTimeoffRequest['id'] ?>'>Reject</div><br>
                                                <?php } ?>

                                                <?php if (checkAccessLevel($_SESSION['user']['access_level'], 'timeoff', 'edit')) { ?>
                                                    <div class="btn btn-success" onclick="openEditPopup('<?php print $eachTimeoffRequest['id'] ?>');" data-value="Edit" data-id='<?= $eachTimeoffRequest['id'] ?>'>Edit</div><br>
                                                <?php } ?> 
                                                <div><div class="btn btn-success" onclick="openHistoryPopup('<?php print $eachTimeoffRequest['id'] ?>');">History</div></div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                            <?php
                                        }
                                    }
                                endforeach;
                                ?>
                        <?php
                    } else {
                        ?>
                        <tr><td colspan="13">No record found</td></tr>
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
        $selectQuery = "Select * FROM tb_timeoff WHERE company_id = '{$companyId}' AND status = 'Accept' AND DATE(to_date) < '{$todayDate}' " . $whereWithTeam . " ORDER BY id ASC";
    } else if ($i == 2) { // accepted_active
        $idName = "accepted_active";
        $activeCls = "";
        $selectQuery = "Select * FROM tb_timeoff WHERE company_id = '{$companyId}' AND status = 'Accept' AND DATE(to_date) >= '{$todayDate}' " . $whereWithTeam . " ORDER BY id ASC";
    } else if ($i == 3) { // accepted_both
        $idName = "accepted_both";
        $activeCls = "";
        $selectQuery = "Select * FROM tb_timeoff WHERE company_id = '{$companyId}' AND status = 'Accept' " . $whereWithTeam . " ORDER BY id ASC";
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
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Total Time</th>
                                <th>Entire day/hourly</th>
                                <th>Absent Reason</th>
                                <th>Employee comment</th>
                                <th>Manager comment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

    <?php
    $timeoffRequest = q($selectQuery);
    if (count($timeoffRequest) > 0) {
        foreach ($timeoffRequest as $eachTimeoffRequest):
            $reasonName = $eachTimeoffRequest['reason'];
            $allowedReasonArr = array('Day Off (With Payment)', 'Time Off (Without Payment)', 'Sick Time');
            $reasonValId = $eachTimeoffRequest['reason_id'];
            $allowedReasonIdsArr = array(4, 2, 3);
            if (in_array($reasonName, $allowedReasonArr) || ($reasonValId > 0 && in_array($reasonValId, $allowedReasonIdsArr))) {

                $employeeName = qs("SELECT id,fname,lname,email,team_id FROM tb_employee WHERE id = '{$eachTimeoffRequest['emp_id']}'");
                $employeeDisplayName = $employeeName['fname'] . " " . $employeeName['lname'];
                $teamDetail = qs("SELECT name FROM tb_team WHERE id = '{$employeeName['team_id']}'");
                ?>
                                        <tr>
                                            <td><?php print $employeeDisplayName; ?></td>
                                            <td><?php print $eachTimeoffRequest['unique_id']; ?></td> 
                                            <td><?php print $teamDetail['name']; ?></td>


                                            <td><?php print date("Y-m-d", strtotime($eachTimeoffRequest['from_date'])); ?></td>
                                            <td><?php print date("Y-m-d", strtotime($eachTimeoffRequest['to_date'])); ?></td>
                                            <td><?php echo $eachTimeoffRequest['absence_type'] == 'hourly' ? date("H:i:s", strtotime($eachTimeoffRequest['from_date'])) : '-'; ?></td>
                                            <td><?php echo $eachTimeoffRequest['absence_type'] == 'hourly' ? date("H:i:s", strtotime($eachTimeoffRequest['to_date'])) : '-'; ?></td>

                                            <td>
                <?php
                if (strtolower($eachTimeoffRequest['absence_type']) == 'entireday') {
                    echo convertInFarsi($eachTimeoffRequest['total_days_applied']) . " روز";
//                                                    echo "<br>" . $persianNoDays . " روز";
                } else {
                    echo convertInFarsi(convertMinutesToHourMinuteFormat($eachTimeoffRequest['total_days'])) . " ساعت";
//                                                    echo convertMinutesToHourMinuteFormat($eachTimeoffRequest['total_days']) . " ساعت";
                }
                ?>
                                            </td>
                                            <td><?php print $eachTimeoffRequest['absence_type'] ?></td>
                                            <td><?php print $eachTimeoffRequest['reason'] ?></td>
                                            <td><?php print $eachTimeoffRequest['employee_notes'] ?></td>
                                            <td><?php print $eachTimeoffRequest['manager_notes'] ?></td>
                                            <td><?php print $eachTimeoffRequest['status'] ?></td>
                                            <td>
                <?php
                /*
                  if (date('Y-m-d', strtotime($eachTimeoffRequest['from_date'])) > date('Y-m-d')) {
                  ?>
                  <div class="btn btn-success" onclick="openEditPopup('<?php print $eachTimeoffRequest['id'] ?>');" data-value="Edit" data-id='<?= $eachTimeoffRequest['id'] ?>'>Edit</div><br>
                  <div class="btn btn-default" onclick="acceptRejectModal(this);" data-value="Cancel" data-id='<?= $eachTimeoffRequest['id'] ?>'>Cancel </div><br>
                  <div><div class="btn btn-success" onclick="openHistoryPopup('<?php print $eachTimeoffRequest['id'] ?>');">History</div></div>
                  <?php } else {
                  ?>
                  <div title="you can not edit"><div class="btn btn-success" disabled>Edit</div></div>
                  <div title="you can not cancel"><div class="btn btn-default" disabled>Cancel</div> </div>
                  <div><div class="btn btn-success" onclick="openHistoryPopup('<?php print $eachTimeoffRequest['id'] ?>');">History</div></div>
                  <?php
                  }
                 */
                ?>

                                                <?php
                                                if (date('Y-m-d', strtotime($eachTimeoffRequest['from_date'])) > date('Y-m-d')) {
                                                    ?>

                                                    <?php if (checkAccessLevel($_SESSION['user']['access_level'], 'timeoff', 'edit')) { ?>

                                                        <div class="btn btn-success" onclick="openEditPopup('<?php print $eachTimeoffRequest['id'] ?>');" data-value="Edit" data-id='<?= $eachTimeoffRequest['id'] ?>'>Edit</div><br>
                                                    <?php } ?>


                                                    <?php if (strtolower($_SESSION['user']['access_level']) == 'admin') { ?>
                                                        <div class="btn btn-default" onclick="adminDeleteModal(this);" data-value="Delete" data-id='<?= $eachTimeoffRequest['id'] ?>'>Delete </div><br>
                                                    <?php } else { ?>
                                                        <div class="btn btn-default" onclick="acceptRejectModal(this);" data-value="Cancel" data-id='<?= $eachTimeoffRequest['id'] ?>'>Cancel </div><br>
                                                    <?php } ?>
                                                    <div><div class="btn btn-success" onclick="openHistoryPopup('<?php print $eachTimeoffRequest['id'] ?>');">History</div></div>
                                                <?php } else {
                                                    ?>
                                                    <?php if (checkAccessLevel($_SESSION['user']['access_level'], 'timeoff', 'edit')) { ?>
                                                        <?php if (strtolower($_SESSION['user']['access_level']) != 'admin') { ?>
                                                            <div class="btn btn-success" disabled>Edit</div><br>
                                                        <?php } else { ?>
                                                            <div class="btn btn-success" onclick="openEditPopup('<?php print $eachTimeoffRequest['id'] ?>');" data-value="Edit" data-id='<?= $eachTimeoffRequest['id'] ?>'>Edit</div><br>
                                                        <?php } ?>
                                                        <?php if (strtolower($_SESSION['user']['access_level']) != 'admin') { ?>
                                                            <div class="btn btn-default" disabled>Cancel </div><br>
                                                        <?php } ?>
                                                    <?php } ?> 
                                                    <?php if (strtolower($_SESSION['user']['access_level']) == 'admin') { ?>
                                                        <div class="btn btn-default" onclick="adminDeleteModal(this);" data-value="Delete" data-id='<?= $eachTimeoffRequest['id'] ?>'>Delete </div><br>
                                                    <?php } ?>       
                                                    <div><div class="btn btn-success" onclick="openHistoryPopup('<?php print $eachTimeoffRequest['id'] ?>');">History</div></div>
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
                                <tr><td colspan="13">No record found</td></tr>
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
        $selectQuery = "Select * FROM tb_timeoff WHERE company_id = '{$companyId}' AND (status = 'Reject' OR status = 'Cancel' OR status = 'Delete') AND DATE(to_date) < '{$todayDate}' " . $whereWithTeam . " ORDER BY id DESC";
    } else if ($i == 2) { // rejected_upcoming
        $idName = "rejected_upcoming";
        $activeCls = "";
        $selectQuery = "Select * FROM tb_timeoff WHERE company_id = '{$companyId}' AND (status = 'Reject' OR status = 'Cancel' OR status = 'Delete') AND DATE(to_date) >= '{$todayDate}' " . $whereWithTeam . " ORDER BY id DESC";
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
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Total Time</th>
                                <th>Entire day/hourly</th>
                                <th>Absent Reason</th>
                                <th>Employee comment</th>
                                <th>Manager comment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

    <?php
    $timeoffRequest = q($selectQuery);
    if (count($timeoffRequest) > 0) {
        foreach ($timeoffRequest as $eachTimeoffRequest):
            $reasonName = $eachTimeoffRequest['reason'];
            $allowedReasonArr = array('Day Off (With Payment)', 'Time Off (Without Payment)', 'Sick Time');
            $reasonValId = $eachTimeoffRequest['reason_id'];
            $allowedReasonIdsArr = array(4, 2, 3);
            if (in_array($reasonName, $allowedReasonArr) || ($reasonValId > 0 && in_array($reasonValId, $allowedReasonIdsArr))) {
                $employeeName = qs("SELECT id,fname,lname,email,team_id FROM tb_employee WHERE id = '{$eachTimeoffRequest['emp_id']}'");
                $employeeDisplayName = $employeeName['fname'] . " " . $employeeName['lname'];
                $teamDetail = qs("SELECT name FROM tb_team WHERE id = '{$employeeName['team_id']}'");
                if (1 == 1) {
                    ?>
                                            <tr> 
                                                <td><?php print $employeeDisplayName; ?></td>
                                                <td><?php print $eachTimeoffRequest['unique_id']; ?></td> 
                                                <td><?php print $teamDetail['name']; ?></td>
                                                <td><?php print date("Y-m-d", strtotime($eachTimeoffRequest['from_date'])); ?></td>
                                                <td><?php print date("Y-m-d", strtotime($eachTimeoffRequest['to_date'])); ?></td>
                                                <td><?php echo $eachTimeoffRequest['absence_type'] == 'hourly' ? date("H:i:s", strtotime($eachTimeoffRequest['from_date'])) : '-'; ?></td>
                                                <td><?php echo $eachTimeoffRequest['absence_type'] == 'hourly' ? date("H:i:s", strtotime($eachTimeoffRequest['to_date'])) : '-'; ?></td>
                                                <td>
                    <?php
                    if (strtolower($eachTimeoffRequest['absence_type']) == 'entireday') {
                        echo convertInFarsi($eachTimeoffRequest['total_days_applied']) . " روز";
//                                                        echo "<br>" . $persianNoDays . " روز";
                    } else {
                        echo convertInFarsi(convertMinutesToHourMinuteFormat($eachTimeoffRequest['total_days'])) . " ساعت";
//                                                        echo convertMinutesToHourMinuteFormat($eachTimeoffRequest['total_days']) . " ساعت";
                    }
                    ?>
                                                </td>
                                                <td><?php print $eachTimeoffRequest['absence_type'] ?></td>
                                                <td><?php print $eachTimeoffRequest['reason'] ?></td>
                                                <td><?php print $eachTimeoffRequest['employee_notes'] ?></td>
                                                <td><?php print $eachTimeoffRequest['manager_notes'] ?></td>
                                                <td><?php print $eachTimeoffRequest['status'] ?></td>
                                                <td><div><div class="btn btn-success" onclick="openHistoryPopup('<?php print $eachTimeoffRequest['id'] ?>');">History</div></div></td>
                                            </tr>
                    <?php
                }
            }
        endforeach;
        ?>
                                <?php
                            } else {
                                ?>
                                <tr><td colspan="13">No record found</td></tr>
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
        <form id="request_timeoff_form" action="request_time_off" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="admin-manager-select">Manager Comment</h4>
                </div>
                <div class="modal-body">
                    <div id="displayHoursViewAccept" class="alert alert-warning col-lg-12 col-md-12 hidden">
                        <div class="col-lg-4 col-md-4"><b>Available Hours :</b> <span class="accept-available-hours-display">00:00</span></div>
                        <div class="col-lg-4 col-md-4"><b>Pending Hours :</b> <span class="accept-pending-hours-display">00:00</span></div>
                        <div class="col-lg-4 col-md-4"><b>Proceed Hours :</b> <span class="accept-proceed-hours-display">00:00</span></div>
                        <div class="clearfix"></div>
                    </div>
                    <input type="hidden" value="1" name="requestResult">
                    <input type="hidden" value="" name="reason" id="reason">
                    <input type="hidden" value="" name="requestId" id="requestId">
                    <div class="form-group">
                        <textarea id="singleCommnet" class="form-control input-field" name="commnet"></textarea>
                    </div>

                    <div class="alert alert-warning accept-previousRecords-area"></div>
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
        <form action="request_time_off" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Record</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="1" name="requestEdit">
                    <input type="hidden" value="" name="editRecordId" id="editRecordId">
                    <input type="hidden" value="" name="absence_type_val" id="absence_type_val">
                    <div id="displayHoursView" class="alert alert-warning col-lg-12 col-md-12">
                        <div class="col-lg-4 col-md-4"><b>Available Hours :</b> <span class="available-hours-display">00:00</span></div>
                        <div class="col-lg-4 col-md-4"><b>Pending Hours :</b> <span class="pending-hours-display">00:00</span></div>
                        <div class="col-lg-4 col-md-4"><b>Proceed Hours :</b> <span class="proceed-hours-display">00:00</span></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        Absence Type : <span name="sel_absence_type" id="sel_absence_type"></span>

                    </div>
                    <div class="form-group HourlyInput hidden">
                        Leave Date : <input type="text" name="edit_leave_date" id="edit_leave_date" value=""/>
                    </div>
                    <div class="form-group">
                        Start Date : <input type="text" name="edit_start_date" id="edit_start_date" value=""/>
                    </div>
                    <div class="form-group">
                        End Date : <input type="text" name="edit_end_date" id="edit_end_date" value=""/>
                    </div>
                    <div class="form-group">
                        Absent Reason :
                        <select name="edit_absent_choice" id="edit_absent_choice">
                            <option value="Day Off (With Payment)">Day Off (With Payment)</option>
                            <option value="Time Off (Without Payment)">Time Off (Without Payment)</option>
                            <option value="Sick Time">Sick Time</option>
                        </select>
                    </div>
                    <div class="form-group">
                        Manager Comments: <br/>
                        Old Comment: <span id="oldCommentText"></span><br/>
                        <textarea id="managerNewComment" class="form-control input-field" name="commnet" required=""></textarea>
                    </div>
                    <div class="alert alert-warning previousRecords-area"></div>
                </div> 

            </div>
            <div class="modal-footer">
                <div class="btn btn-default" type="button" data-dismiss="modal">Close</div>
                <button class="btn btn-primary" type="submit" onclick="return beforeEditSubmit()">Save changes</button>
            </div>
        </form>
    </div>
</div>
<style type="text/css">
    td div.btn {
        width:100%;
        margin-bottom: 4px;
    }
    .alert-margin-bottom {
        margin-bottom: 10px; 
        /*
        background-color: #00bca4 !important;
        color:#FFF !important;
        */
    }
</style>

<div class="hidden" id="oldRequestData">
    <span id="old_start_date"></span>
    <span id="old_absent_choice"></span>
    <span id="old_end_date"></span>
</div>


<div id="historyModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="request_time_off" method="post">
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
        </form>
    </div>
</div>


<div id="addModal" class="modal modal-fixed-header-footer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="add_time_off" method="post" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add New Time Off Request</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="1" name="requestAdd">
                    <div class="form-group">
                        Select Employee :
                        <select name="add_emp_id" id="add_emp_id" class="add-required_fields">
                            <option value="">Select Employee</option>
<?php
foreach ($employee as $each_employee) {
    if ($each_employee['mobile'] != '') {
        ?>
                                    <option value="<?php echo $each_employee['id'] ?>"><?php echo $each_employee['fname'] . " " . $each_employee['lname'] . " (" . $each_employee['mobile'] . ")" ?></option>                                        
                                <?php } else { ?>
                                    <option value="<?php echo $each_employee['id'] ?>"><?php echo $each_employee['fname'] . " " . $each_employee['lname']; ?></option>                                      
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        Absence Type :
                        <select name="add_absence_type" id="add_absence_type" onchange="inputBoxChanges(this)" class="add-required_fields" required="">
                            <option value="">Select Type</option>
                            <option value="hourly">Hourly</option>
                            <option value="entireDay">Entire Day</option>
                        </select>
                    </div>
                    <div class="form-group">
                        Absent Reason :
                        <select name="add_absent_choice" id="add_absent_choice" class="add-required_fields" required="">
                            <option value="">Select Reason</option>
                            <option value="Day Off (With Payment)">Day Off (With Payment)</option>
                            <option value="Time Off (Without Payment)">Time Off (Without Payment)</option>
                            <option value="Sick Time">Sick Time</option>
                        </select>
                    </div>
                    <div class="form-group">
                        Subject : <input type="text" name="add_subject" id="add_subject" class="add-required_fields" value="" required=""/>
                    </div>
                    <div class="form-group HourlyInput hidden">
                        Leave Date : <input type="text" name="add_leave_date" id="add_leave_date" class="" value="" required=""/> (YYYY-mm-dd)
                    </div>
                    <div class="form-group">
                        <span class="LableStartChnages"> Start Date :</span> <input type="text" name="add_start_date" id="add_start_date" class="add-required_fields" value="" required=""/> <span class="dropdownChnages">(YYYY-mm-dd)</span>  
                    </div>

                    <div class="form-group">
                        <span class="LableEndChnages"> End Date : </span><input type="text" name="add_end_date" id="add_end_date" class="add-required_fields" value="" required=""/> <span class="dropdownChnages">(YYYY-mm-dd)</span>
                    </div>
                    <div class="form-group">
                        Manager Comments: <br/>
                        <textarea id="managerNewComment" name="managerNewComment" class="form-control input-field add-required_fields" required=""></textarea>
                    </div>
                </div>
                <div id="addFormCompulsary" class="hidden alert alert-danger">Please fill up all the fields</div>
            </div>

            <div class="modal-footer">
                <div class="btn btn-default" type="button" data-dismiss="modal">Close</div>
                <button class="btn btn-primary" type="submit" onclick="return beforeAddSubmit()">Save changes</button>
            </div>
        </form>
    </div>
</div>   
<?php ?>