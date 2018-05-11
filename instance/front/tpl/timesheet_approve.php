
<?php if (checkAccessLevel($_SESSION['user']['access_level'], 'timesheet', 'view')) { ?>
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
        #colorbox #cboxClose
        {
            top: 0;
            right: 0;
        }
        #cboxLoadedContent{
            margin-top:28px;
            margin-bottom:0;
        }
        .action_button
        {
            padding: 4px !important;
            width: 12px;
            height: 24px;
        }
    </style>

    <div class="panel">
        <div class="panel-body">
            <div class="panel-body">
                <div>
                    <div class="col-sm-12">
                        <h2 style="font-weight: bold;">Manage Timesheet</h2>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body" id="refreshTask">

                    <table id="datatable-responsive0a" class="table table-striped no-border responsive no-wrap" cellspacing="0" width="100%" style="margin: 0 0 0 0; border: none;">
                        <thead>
                            <?php /* if(count($subq) > 0){ ?>
                              <tr>
                              <td colspan='8' class="text-right"><?php echo $pagination->createLinks(); ?></td>
                              </tr>
                              <?php } */ ?>
                            <tr>
                                <th>id</th>
                                <th>User ID</th>
                                <th>Start Date</th>
                                <th>Start Time</th>
                                <th>End Date</th>
                                <th>End Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($subq) > 0) { ?>
                                <?php foreach ($subq as $val) { ?>
                                    <tr>
                                        <td><?= $val['id'] ?></td>
                                        <td>
                                            <?= $val['user_id'] ?>
                                            <br><span><?= $val['empFname'] . " " . $val['empLname'] ?></span>
                                        </td>
                                        <td><?php
                                            $StrToTime = strtotime($val['sDate']);
                                            $con1 = _DigitsTopersian(_gj($StrToTime));
                                            $con2 = _tt($val['sDate']);
                                            echo $con1 . " " . $con2;
                                            ?>
                                        </td>
                                        <td><?= _DigitsTopersian(strtotime($val['start_time'])) ?></td>
                                        <td><?php
                                            $StrToTime1 = strtotime($val['end_date']);
                                            $con3 = _DigitsTopersian(_gj($StrToTime1));
                                            $con4 = _tt($val['end_date']);
                                            echo $con3 . " " . $con4;
                                            ?></td>
                                        <td><?= _DigitsTopersian(strtotime($val['end_time'])) ?></td>
                                        <td><span id="<?= $val['id'] ?>"><?= getStatusOfEmployee($val['status']); ?></span></td>
                                        <td class="icon">
                                            <?php if (checkAccessLevel($_SESSION['user']['access_level'], 'timesheet', 'approve')) { ?>

                                                <?php if ($val['status'] == "0") { ?> 
                                                    <a href="update_timesheet?id=<?= $val['id'] ?>" data-id="<?= $val['id'] ?>" class="colorbox_popup" data-toggle="tooltip" title="Edit"><i style="padding-top: 9px;" class="action_button fa fa-edit btn btn-primary"></i></a>
                                                <?php } ?>

                                                <a data-toggle="tooltip" title="Approve" href="javascript:void(0);" data-id="<?= $val['id'] ?>" class="approve"><i style="padding-top: 9px;" class="action_button fa fa-thumbs-up btn btn-primary"></i></a>

                                                <a data-toggle="tooltip" title="Reject" href="javascript:void(0);" data-id="<?= $val['id'] ?>" class="decline"><i style="padding-top: 9px;" class="action_button fa fa-ban btn btn-links danger"></i></a>
                                            <?php } ?> 
                                            <a data-toggle="tooltip" title="History" href="timesheet_log_history?id=<?= $val['id'] ?>" data-id="<?= $val['id'] ?>" class="history_popup"><i style="padding-top: 9px;" class="action_button fa fa-history btn btn-primary"></i></a>

                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td colspan='8' class="text-right"><?php echo $pagination->createLinks(); ?></td>
                                </tr>

                            <?php } else { ?>
                                <tr>
                                    <td colspan='8' class="text-center">No record(s) found!</td>
                                </tr>
                            <?php } ?>


                        </tbody> 
                    </table>

                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/pagination_style.css">
    <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/colorbox/css/colorbox.css">
    <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/sweetalert2/src/sweetalert2.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
    <script src="<?php print _MEDIA_URL ?>assets/colorbox/jquery.colorbox.js"></script>
    <script src="<?php print _MEDIA_URL ?>assets/bootstrap-notify-master/bootstrap-notify.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

    <script src="<?php print _MEDIA_URL ?>assets/sweetalert2/src/sweetalert2.all.js"></script>


    <script type="text/javascript">
        (function ($) {

            $(".colorbox_popup").colorbox({
                iframe: true,
                width: "50%",
                height: '500px'
            });
            $(".history_popup").colorbox({
                iframe: true,
                width: "60%",
                height: '500px'
            });


            $(document).on('click', '.approve', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: 'update_timesheet_status',
                    method: 'post',
                    data: {id: id, status: '1'},
                    dataType: 'json',
                    success: function (res) {
                        if (res.result == "success") {
                            $('.notifyjs-corner').empty();
                            $.notify({
                                message: 'Update Successfull!'
                            },
                            {
                                type: 'success',
                                placement: {
                                    from: "top",
                                    align: "center"
                                },
                                showProgressbar: true,
                                delay: 1000,
                            });

                            $("a[href='update_timesheet?id=" + id + "']").hide();
                            $("span#" + id).html('Approved');

                        }
                    }
                });
            });
            $(document).on('click', '.decline', function () {
                var id = $(this).data('id');
                //var conf = confirm("Are you sure you want to reject this timesheet?");

                swal({
                    title: "Are you sure?",
                    text: "you want to reject this timesheet?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes, Reject it!',
                    cancelButtonText: "No, cancel it!"
                }).then(function (Confirm) {
                    console.log(Confirm);
                    if (Confirm['value'] == true) {
                        $.ajax({
                            url: 'update_timesheet_status',
                            method: 'post',
                            data: {id: id, status: '2'},
                            dataType: 'json',
                            success: function (res) {
                                if (res.result == "success") {
                                    $('.notifyjs-corner').empty();
                                    $.notify({
                                        message: 'Update Successfull!'
                                    },
                                    {
                                        type: 'success',
                                        placement: {
                                            from: "top",
                                            align: "center"
                                        },
                                        showProgressbar: true,
                                        delay: 2000,
                                    });

                                    $("a[href='update_timesheet?id=" + id + "']").hide();
                                    $("span#" + id).html('Rejected');
                                }
                            }
                        });

                    } else {
                        //if we require this scope!     
                    }
                });

            });

        })(jQuery);

    </script>

<?php } ?>
