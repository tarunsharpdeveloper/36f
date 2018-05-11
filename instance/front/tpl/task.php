<?php
if ($_SESSION['user']['access_level'] == "Admin" || $_SESSION['user']['access_level'] == "admin") {
    $admins = "block";
} else {
    $admins = "none";
}
?>


<style>

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
    .btn.btn-link-danger:hover,.no-touch .btn.btn-link-danger:focus{
        color:white;
        background:#ff5252;
        border-color:#ff5252;
        text-shadow:none;

    }
</style>
<div class="panel">
    <div class="panel-body">
        <div class="panel-body">
            <div>
                <div class="col-lg-2 col-sm-12">
                    <h2 style="font-weight: bold;">Task</h2>
                </div>

                <div class="col-lg-8 col-sm-12 ">
                    <hr>
                </div>
                <div class="col-lg-2 col-sm-12">
                    <div class="dropdown float-right" style="width: 100%;">
                        <a href="#" class="btn btn-azure col-md-12" title="" data-toggle="modal" data-target="#myModal2" data-placement="left" title="New Task" data-original-title="Add New Task">
                            New Task
                            <i class="glyph-icon icon-caret-down"></i>
                        </a>

                    </div>
                    <!--<button class="btn btn-azure col-md-12 " data-toggle="modal" data-target="#Add-People" type="button">Add People</button>-->
                </div>
            </div>

        </div>

        <!--        <div class="example-box-wrapper">
                    <button class="btn btn-default btn-md" data-toggle="modal" data-target="#myModal"> Launch demo modal </button>
        
                </div>-->
        <!--<form  action="task"  id='task_form'>-->

        <div class="panel">
            <div class="panel-body" id="refreshTask">

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
                                            <td>Start Date:</td>
                                            <td><input id="min" name="min" type="text"></td>

                                            <td>End Date:</td>
                                            <td><input id="max" name="max" type="text"></td>
                                        </tr>
                                        <tr>
                                            <td>Created by:</td>
                                            <td><input id="createdby" name="createdby" type="text"></td>

                                            <td>Assign to:</td>
                                            <td><input id="assignto" name="assignto" type="text"></td>
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
                                                    <td><?php
                                                        echo $TaskRow['due_date'];
                                                        ?></td>
                                                    <td><?php
                                                        if ($TaskRow['due_date'] < date('Y-m-d')) {
                                                            if ($TaskRow['status'] == "0") {
                                                                echo "Incomplete";
                                                            } else {
                                                                echo "Completed";
                                                            }
                                                        } else {
                                                            if ($TaskRow['status'] == "0") {
                                                                echo "In Progress";
                                                            } else {
                                                                echo "Completed";
                                                            }
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

            </div>
        </div>

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

<!-- Modal -->
<div class="modal fadeInUp right "  id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="task" method="post">
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

                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-4 control-label" style="line-height: 30px;">Due Date</label>
                                    <div class="col-sm-8">
                                        <div class="input-prepend input-group">
                                            <span class="add-on input-group-addon">
                                                <i class="glyph-icon icon-calendar"></i>
                                            </span>
                                            <input type="text" id="due_date" name="due_date" class=" form-control" placeholder="16/05/29" value="" data-date-format="yy/mm/dd" required>
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
                                        <select name="assign_to[]" multiple data-placeholder="Select Some People..." class="chosen-select form-control" style="width:100%" required="">

                                            <option label="All"  value="*">All</option>
                                            <optgroup label="Employee">
                                                <?php foreach ($EmployeeData as $EmployeeRow) { ?>
                                                    <option value="<?php echo $EmployeeRow['id']; ?>"><?php echo $EmployeeRow['fname'] . ' ' . $EmployeeRow['lname'] ?></option>
                                                <?php } ?>
                                            </optgroup>
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
                                        <textarea name="notes" id="notes" placeholder="Notes here" maxlength="255" style="width: 100%;min-height: 100px;" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <!--<button class="btn btn-default" type="reset">Reset</button>-->
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                </div> 
                <input type="hidden" name="create_by" id="create_by" value="<?php echo $_SESSION['user']['id']; ?>" />
                <input type="hidden" name="save_task" />
            </form>       
        </div>
    </div><!-- modal-content -->
</div>
<!-- modal-dialog -->

