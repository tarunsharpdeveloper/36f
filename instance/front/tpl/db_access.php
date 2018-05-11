


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
                    <h2 style="font-weight: bold;">DB</h2>
                </div>

                <div class="col-lg-4 col-sm-12 ">
                    <hr>
                </div>

            </div>

        </div>

        <!--        <div class="example-box-wrapper">
                    <button class="btn btn-default btn-md" data-toggle="modal" data-target="#myModal"> Launch demo modal </button>
        
                </div>-->
        <!--<form  action="task"  id='task_form'>-->

        <div class="panel">
            <div class="panel-body" id="refreshTask">

                <table id="datatable-responsive0a" class="table table-striped no-border responsive no-wrap" cellspacing="0" width="100%" style="margin: 0 0 0 0; border: none;">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Shiftid</th>
                            <th>user_id</th>
                            <th>sDate</th>
                            <th>Timestamp</th>
                            <th>type</th>

                            <th>briefcase</th>
                            <th>timeout</th>
                            <th>lat</th>
                            <th>lang</th>
<!--                            <th>created_at</th>
                            <th>modified_at</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = $_REQUEST['user_id'] != '' ? "sci.user_id='" . $_REQUEST['user_id'] . "'" : '1=1';
                        $qry = "SELECT sci.*,e.fname as empFname,e.lname as empLname 
								FROM tb_shift_check_inout sci 
								LEFT JOIN tb_employee e ON(sci.user_id=e.id)
								WHERE {$id} ORDER BY sci.id DESC";
								
						$subq = q($qry);
//                        $subq = q("SELECT * FROM `tb_shift_check_inout` ORDER BY `id` DESC ");
                        foreach ($subq as $val) {
                            ?>
                            <tr>
                                <td><?= $val['id'] ?></td>
                                <td><?= $val['shiftid'] ?></td>
                                <td>
									<?= $val['user_id'] ?>
									<br><span><?=$val['empFname']." ".$val['empLname']?></span>
								</td>
                                <td><?= $val['sDate'] ?></td>
                                <td><?= $val['timestamp'] ?></td>
                                <td><?= $val['type'] ?></td>
                                <td><?= $val['briefcase'] ?></td>
                                <td><?= $val['timeout'] ?></td>
                                <td><?php $val['lat']; ?></td>
                                <td><?php $val['lng']; ?></td>

        <!--                                <td><?= $val['created_at'] ?></td>
         <td><?= $val['modified_at'] ?></td>-->
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody> 
                </table>

            </div>
        </div>

        <!-- /Popout -->
        <!--</form>-->

    </div>
</div>

