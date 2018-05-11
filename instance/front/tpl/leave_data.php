<script type="text/javascript">
//    alert("Call");
    $('#datatable-responsive').DataTable({
        responsive: true
    });
    $('.dataTables_filter input').attr("placeholder", "Search...");
</script>
<table id="datatable-responsive" class="table table-striped table-bordered responsive no-wrap" cellspacing="0" width="100%" style="margin: 0 0 0 0;">
    <thead>
        <tr>
            <th>Leave Report</th>

        </tr>
    </thead>


    <tbody>
        <?php
        foreach ($LeaveData as $LeaveRow) {
            if ($LeaveRow['emp_id'] == $_SESSION['user']['id']) {
                ?>
                <tr>
                    <td>
                        <div class="col-lg-8  col-xs-12 col-md-12 col-sm-12">
                            <span style="color: #666;"><b><?php echo $LeaveRow['leave_type']; ?></b></span>

                            <br/>
                            <p style="font-size: 10px;">Start Date:<?php echo $LeaveRow['f_day_date'] . ' ' . $LeaveRow['f_day_time']; ?>
                                <br/>End Date:<?php echo $LeaveRow['l_day_date'] . ' ' . $LeaveRow['l_day_time']; ?>
                                <br/>Total Time:<?php echo $LeaveRow['total_day']; ?>
                            </p> 
                        </div>
                        <div class="col-lg-4  col-xs-12 col-md-12 col-sm-12">
                            <span style="float: right;"> Status:
                                <?php
                                $status = $LeaveRow['status'];
                                if ($status == "1") {
                                    echo "Pending";
                                } else if ($status == "2") {
                                    echo "Approved";
                                } else {
                                    echo "Rejected";
                                }
                                ?>
                            </span><br/>
                            <!--<a href="#" class="btn btn-primary btn-sm " style="float: right;"  data-toggle="modal"  data-placement="left" onclick="bindleave('<?= $LeaveRow['id'] ?>')" ><i class="icon-iconic-book-open"></i>View</a>-->
                            <button class="btn btn-primary btn-sm " type="button" style="float: right;"  data-toggle="modal"  data-placement="left" onclick="bindleave('<?= $LeaveRow['id'] ?>')" ><i class="icon-iconic-book-open"></i>View</button>
                        </div>
                    </td>
        <!--                                            <td><?php echo date("j-F-Y", strtotime($LeaveRow['due_date'])); ?></td>
                    <td><?php echo $LeaveRow['fname'] . ' ' . $LeaveRow['lname'] ?></td>
                    <td><?php echo $LeaveRow['notes']; ?></td>-->
                    <!--<td>Status:</td>-->
                </tr> 
                <?php
            }
        }
        ?>

    </tbody>
</table>