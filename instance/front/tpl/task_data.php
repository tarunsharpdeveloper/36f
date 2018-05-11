<!--<script>
    $(".remove").on("click", function () {
//        $(this).data('id');
//        alert($(this).data('id'));
        callDelete($(this).data('id'));
    });
</script>-->
<div id="exTab1" class="">	
    <ul  class="nav nav-pills">
        <li class="active" style="display: <?= $admins ?>">
            <a  href="#0a" data-toggle="tab">ALL TASK</a>
        </li>
        <li class="">
            <a  href="#1a" data-toggle="tab">MY TASK</a>
        </li>
        <li><a href="#2a" data-toggle="tab">ASSIGN TASK</a>
        </li>

        <li><a href="#3a" data-toggle="tab">COMPLETED TASK</a>
        </li>
<!--                        <li style="display: <?= $admins ?>"><a href="#4a" data-toggle="tab">SUMMARY</a>
        </li>-->

        <!--                <li><a href="#3a" data-toggle="tab">Applying clearfix</a>
                        </li>
                        <li><a href="#4a" data-toggle="tab">Background color</a>
                        </li>-->
    </ul>

    <div class="tab-content clearfix" style="text-align: center;margin: 0;padding: 0;">
        <div class="tab-pane active" id="0a">

            <div class="example-box-wrapper">
                <!--                                <div id="startfrom">
                                                    <label for="from">From</label>
                                                    <input type="text" id="from" name="From">
                                                </div>
                                                <div id="endto">
                                                    <label for="to">to</label>
                                                    <input type="text" id="to" name="To">
                                                </div>-->
                <table cellspacing="5" cellpadding="5" border="0">
                    <tbody><tr>
                            <td>Minimum Date:</td>
                            <td><input id="min" name="min" type="text"></td>

                            <td>Maximum Date:</td>
                            <td><input id="max" name="max" type="text"></td>
                        </tr>
                    </tbody></table>
                <table id="datatable-responsive0a" class="table table-striped no-border responsive no-wrap" cellspacing="0" width="100%" style="margin: 0 0 0 0; border: none;">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Created By</th>
                            <th>Assign To</th>
                            <th>Due Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
//                                        $allTask = q("select * from tb_task " . helper::onlyOfficeid());
                        $c_id = $_SESSION['company']['id'];
                        $allTask = q("SELECT * FROM `tb_task` where company_id='$c_id' ");
                        $test == 0;
                        foreach ($allTask as $TaskRow) {
                            if (!$TaskRow['assign_to'] == "" || $TaskRow['assign_to'] == "*") {
                                $test = 1;
                                ?>
                                <tr>
                                    <td>
                                        <div class="col-lg-1" style="color: black;">
                                            <i style="padding-top: 9px;" class="btn btn-link DoneTask fa fa-check-square-o"  data-id="<?php echo $TaskRow['id']; ?>"></i></span>
                                        </div>
                                        <div class="col-lg-11" style="color: black;">
                                            <h3><?php echo $TaskRow['title']; ?></h3>
                                            <p> <?php echo $TaskRow['notes']; ?></p>
                                        </div>

                                    </td>
                                    <td>
                                        <?php
                                        $emp = qs("select * from tb_employee where id='{$TaskRow['created_by']}'")
                                        ?>

                                        <span style="color: black;background-color: #d8d6d6;border-radius: 50%;display: inline-block;min-width: 20px;min-height: 20px;text-align: center"><?php echo substr(ucfirst($emp['fname']), 0, 1) . '' . substr(ucfirst($emp['lname']), 0, 1) ?></span>
                                        <span href="#" style="color:#00CEB4;font-weight: bold"><?php echo $emp['fname'] . ' ' . $emp['lname'] ?></span>
                                        <span style="color:#444;display: block;text-align: left;margin-left: 20px;"><small><?php echo $emp['access_level'] ?></span>


                                    </td>
                                    <td>
                                        <?php
                                        if ($TaskRow['assign_to'] == "*") {
                                            $empAssignTo['fname'] = "All";
                                            $empAssignTo['lname'] = "";
                                            $empAssignTo['access_level'] = "";
                                        } else {
                                            $empAssignTo = qs("select * from tb_employee where id='{$TaskRow['assign_to']}'");
                                        }
                                        ?>

                                        <span style="color: black;background-color: #d8d6d6;border-radius: 50%;display: inline-block;min-width: 20px;min-height: 20px;text-align: center"><?php echo substr(ucfirst($empAssignTo['fname']), 0, 1) . '' . substr(ucfirst($empAssignTo['lname']), 0, 1) ?></span>
                                        <span href="#" style="color:#00CEB4;font-weight: bold"><?php echo $empAssignTo['fname'] . ' ' . $empAssignTo['lname'] ?></span>
                                        <span style="color:#444;display: block;text-align: left;margin-left: 20px;"><small><?php echo $empAssignTo['access_level'] ?></small></span>
                                    </td>
                                    <td><?php echo $TaskRow['due_date']; ?></td>
                                    <td><?php
                                        if ($TaskRow['status'] == "0") {
                                            echo "Pending";
                                        } else {
                                            echo "Completed";
                                        }
                                        ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        <?php if ($test == 0) {
                            ?>
                            <tr><td colspan='20'>
                                    <h3>You’ve got no tasks!</h3>
                        <h7>So sit back and relax, or give yourself some more to do.</h7>
                        </td></tr>
                    <?php }
                    ?>
                    </tbody> 
                </table>
            </div>
        </div>
        <div class="tab-pane " id="1a">
            <div class="example-box-wrapper">
                <table id="datatable-responsive" class="table table-striped table-bordered responsive no-wrap" cellspacing="0" width="100%" style="margin: 0 0 0 0;">
                    <thead>
                        <tr>
                            <th>Information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $test == 0;
                        foreach ($TaskData as $TaskRow) {
                            if ($TaskRow['assign_to'] == $_SESSION['user']['id'] || $TaskRow['assign_to'] == "*") {
                                $test = 1;
                                ?>
                                <tr>
                                    <td>
                                        <div class="col-lg-1" style="color: black;">
                                            <i style="padding-top: 9px;" class="btn btn-link DoneTask fa fa-check-square-o"  data-id="<?php echo $TaskRow['id']; ?>"></i></span>
                                        </div>
                                        <div class="col-lg-7" style="color: black;">
                                            <h3><?php echo $TaskRow['title']; ?></h3>
                                            <p> <?php echo $TaskRow['notes']; ?></p>
                                        </div>
                                        <div class="col-lg-4" style="float: right;">
                                            <span style="color:black;float: right">Assigned From <span style="color: black;background-color: #d8d6d6;border-radius: 50%;display: inline-block;"><?php echo substr(ucfirst($TaskRow['fname']), 0, 1) . '' . substr(ucfirst($TaskRow['lname']), 0, 1) ?></span>
                                                <span href="#" style="color:#00CEB4;font-weight: bold"><?php echo $TaskRow['fname'] . ' ' . $TaskRow['lname'] ?></span>
                                                <!--<i style="padding-top: 9px;" class="btn btn-link-danger  fa fa-trash-o" data-id="<?php echo $TaskRow['id']; ?>"></i>-->
                                            </span> 
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        <?php if ($test == 0) {
                            ?>
                            <tr><td colspan='20'>
                                    <h3>You’ve got no tasks!</h3>
                        <h7>So sit back and relax, or give yourself some more to do.</h7>
                        </td></tr>
                    <?php }
                    ?>
                    </tbody> 
                </table>
            </div>
        </div>
        <div class="tab-pane" id="2a">
            <div class="example-box-wrapper">

                <table id="datatable-responsive2" class="table table-striped table-bordered responsive no-wrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $test2 = 0;
                        foreach ($AssignTaskData as $AssignTaskDataRow) {
                            if ($AssignTaskDataRow['created_by'] == $_SESSION['user']['id']) {
                                $test2 = 1;
                                ?>
                                <tr>
                                    <td>
                                        <div class="col-lg-8" style="color: black;">
                                            <h3><?php echo $AssignTaskDataRow['title']; ?></h3>
                                            <p>  <?php echo $AssignTaskDataRow['notes']; ?></p>
                                        </div>

                                        <div class="col-lg-4" style="float: right;align-content: flex-end;">
                                            <span style="color:black;float: right">Assigned to <span style="color: black;background-color: #d8d6d6;border-radius: 50%;display: inline-block; height: 18px;"><?php echo substr(ucfirst($AssignTaskDataRow['fname']), 0, 1) . '' . substr(ucfirst($AssignTaskDataRow['lname']), 0, 1) ?></span>
                                                <span style="color: #00CEB4;font-weight: bold"> <?php echo $AssignTaskDataRow['fname'] . ' ' . $AssignTaskDataRow['lname'] ?></span>
                                                <i style="padding-top: 9px;" class="btn btn-link-danger remove fa fa-trash-o"  data-id="<?php echo $TaskRow['id']; ?>"></i></span>
                                        </div>
                                    </td>

                                </tr>
                                <?php
                            }
                        }
                        ?>
                        <?php if ($test2 == 0) { ?>

                            <tr><td colspan='20'>
                                    <h3>You’ve got no tasks!</h3>
                        <h7>So sit back and relax, or give yourself some more to do.</h7>
                        </td></tr>
                    <?php }
                    ?>
                    </tbody> 
                </table>
            </div>
        </div>
        <div class="tab-pane" id="3a">
            <div class="example-box-wrapper">

                <table id="datatable-responsive3" class="table table-striped table-bordered responsive no-wrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $test2 == 0;
                        foreach ($TaskCompleted as $AssignTaskDataRow) {
                            if ($AssignTaskDataRow['created_by'] == $_SESSION['user']['id']) {
                                $test2 = 1;
                                ?>
                                <tr>
                                    <td>
                                        <div class="col-lg-8" style="color: black;">
                                            <h3><?php echo $AssignTaskDataRow['title']; ?></h3>
                                            <p>  <?php echo $AssignTaskDataRow['notes']; ?></p>
                                        </div>

                                        <div class="col-lg-4" style="float: right;align-content: flex-end;">
                                            <span style="color:black;float: right">Assigned to <span style="color: black;background-color: #d8d6d6;border-radius: 50%;display: inline-block; height: 18px;"><?php echo substr(ucfirst($AssignTaskDataRow['fname']), 0, 1) . '' . substr(ucfirst($AssignTaskDataRow['lname']), 0, 1) ?></span>
                                                <span style="color: #00CEB4;font-weight: bold"> <?php echo $AssignTaskDataRow['fname'] . ' ' . $AssignTaskDataRow['lname'] ?></span>
                                                <i style="padding-top: 9px;" class="btn btn-link-danger remove fa fa-trash-o"  data-id="<?php echo $TaskRow['id']; ?>"></i></span>
                                        </div>
                                    </td>

                                </tr>
                                <?php
                            }
                        }
                        ?>
                        <?php if ($test2 == 0) { ?>

                            <tr><td colspan='20'>
                                    <h3>You’ve got no tasks!</h3>
                        <h7>So sit back and relax, or give yourself some more to do.</h7>
                        </td></tr>
                    <?php }
                    ?>
                    </tbody> 
                </table>
            </div>
        </div>
        <div class="tab-pane" id="4a" style="display: <?= $admins ?>">
            <div class="example-box-wrapper">


            </div>
        </div>
    </div>
</div>
