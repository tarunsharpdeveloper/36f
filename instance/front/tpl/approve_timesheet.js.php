

<!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>js/jquery.timepicker.js"></script>-->

<!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/jquery.timepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/pikaday/css/pikaday.css"/>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/pikaday/pikaday.js"></script>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/pikaday/plugins/pikaday.jquery.js"></script>-->
<?php include _PATH . "instance/front/tpl/libValidate.php" ?>


<script type="text/javascript">
//    alert("Call");
//    $('#example').DataTable({
//        "paging": false,
//        "ordering": false,
//        "info": false
//    });
//    $(".chkperform[]").on("click"){
//        alert(this.val());
//    }

    function enabledisable() {
        var shiftid = $("#shift_id").val();
        var empid = $("#hid_emp_id").val();
        if (empid === "") {
            $("#chkbtnapprove").prop("disabled", true);
            $("#chkbtnunapprove").prop("disabled", true);
        } else {
            $("#chkbtnapprove").prop("disabled", false);
            $("#chkbtnunapprove").prop("disabled", false);
        }
        if (shiftid === "") {
            $("#area").prop("disabled", true);
            $("#s_time").prop("disabled", true);
            $("#e_time").prop("disabled", true);
            $("#b_time").prop("disabled", true);
            $("#approvebtn").prop("disabled", true);
            $("#unapprovebtn").prop("disabled", true);
            $("#approveNext").prop("disabled", true);
            $("#cDetailsDiv").prop("hidden", true);

        } else {
            $("#area").prop("disabled", false);
            $("#s_time").prop("disabled", false);
            $("#e_time").prop("disabled", false);
            $("#b_time").prop("disabled", false);
            $("#approvebtn").prop("disabled", false);
            $("#unapprovebtn").prop("disabled", false);
            $("#approveNext").prop("disabled", false);
            $("#cDetailsDiv").prop("hidden", false);
        }
    }
    function approveNext() {
        var shiftid = $("#shift_id").val();
        var empid = $("#hid_emp_id").val();
        if (shiftid === "" || empid == "") {
            enabledisable();
        } else {
            ajaxapproveNext(shiftid, empid);
        }

    }
    function ajaxapproveNext(shiftid, empid) {
        alert("approveNext Call" + shiftid);
        $.ajax({
            url: '<?php echo _U ?>approve_timesheet',
//            dataType: "json",
//                type: "post",
            data: {
                ajaxapproveNext: 1,
                shiftid: shiftid,
                empid: empid,
                sDate: $("#daterangepicker-time").val()
//                ladelData: $("#approveForm").serialize()

//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
                $('#timesheetDiv').html(r);
//                $('#timeapprovalNextDiv').html("");
                $('#timeapprovalNextDiv').css("display", "block");
                $('#timeapprovalDiv').css("display", "none");
                $('#cDateDiv').css("display", "none");
                $('.tab-pane').removeClass("tab_left");
                $('.tab_right').css("display", "none");

            }
        });
    }
    function checkboxval(val) {
        var empid = $("#hid_emp_id").val();
        if (empid === "") {
            alert("Click On Employee Please");
        } else {
//            var chk = documents.getElementById("chk" + val).checked;
//            alert("Checking Value = " + chk);
//            if (chk === false)
//            {
            $("#chkbtnapprove").removeClass("active");
            $("#chkbtnunapprove").removeClass("active");
            if (val === "1") {
                $("#chkbtnapprove").addClass("btn btn-default active");
                $("#chkbtnunapprove").removeClass("active");
                ajaxApproveAll(empid);


            } else {
                $("#chkbtnapprove").removeClass("active");
                $("#chkbtnunapprove").addClass("btn btn-default active");
                ajaxUnapproveAll(empid);
            }
//            } else {
//                alert("Uncheck");
//                document.getElementById("chk2").checked = false;
//                document.getElementById("chk1").checked = false;
//            }
        }
    }
    function  ajaxApproveAll(empid) {
//        $("#chk2").prop('checked', false);
//        document.getElementById("chk2").checked = false;
        $.ajax({
            url: '<?php echo _U ?>approve_timesheet',
//            dataType: "json",
//                type: "post",
            data: {
                ajaxApproveAll: 1,
                empid: empid,
                sDate: $("#daterangepicker-time").val()
//                ladelData: $("#approveForm").serialize()

//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
                $('#timesheetDiv').html(r);
                $("#chkbtnapprove").removeClass("active");
            }
        });
//        alert("ajaxApproveAll");
    }
    function ajaxUnapproveAll(empid) {
//        $("#chk1").prop('checked', false);
//        document.getElementById("chk1").checked = false;
        $.ajax({
            url: '<?php echo _U ?>approve_timesheet',
//            dataType: "json",
//                type: "post",
            data: {
                ajaxUnapproveAll: 1,
                empid: empid,
                sDate: $("#daterangepicker-time").val()
//                ladelData: $("#approveForm").serialize()

//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
//                alert("<?php echo $_SESSION['msg'] ?>");
                $('#timesheetDiv').html(r);
                $("#chkbtnunapprove").removeClass("active");
            }
        });
    }
    function shiftDiscard() {
//        alert("shiftDiscard()");
        var id = $("#shift_id").val();
        if (id === "" || id === null) {
            alert("Dont Allow to discard Because Not having selected Records");
        } else {
            ajaxshiftDiscard();
        }
    }
    function ajaxshiftDiscard() {
//        alert("Aprove Submit call");
        $.ajax({
            url: '<?php echo _U ?>approve_timesheet',

            dataType: "json",
            type: "post",
            data: {
                shiftDiscard: 1,
                sDate: $("#daterangepicker-time").val(),
                empid: $("#hid_emp_id").val(),
                ladelData: $("#approveForm").serialize()

//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
//                toastCall();
//                $('#timesheetDiv').html(r);

                if (r.success > 0) {

                    _toast("success", "Approved", r.msg);
                    $("#shift_id").val(" ").change();

                    $('#cDate').html();
                    $("#area").val("Choose Area").change();

                    $("#s_time").val("").change();
                    $("#e_time").val(" ").change();
                    $("#b_time").val(" ").change();
                } else {
                    _toast("warning", "Declind", r.msg);
                }

            }});
    }
    function toastCall() {
<?php if ($_SESSION['success'] === "1") { ?>
            _toast("success", "Approved", "<?php echo $_SESSION['msg']; ?>");
<?php } else { ?>
            _toast("warning", "Declind", "<?php echo $_SESSION['msg']; ?>");
<?php } ?>
    }
    function shiftApprove() {
//        alert("Aprove 1 call");
        var area = $("#area").val();
        var starttime = $("#s_time").val();
        var enditime = $("#e_time").val();
        var breaketime = $("#b_time").val();
        var shiftid = $("#shift_id").val();
        if (shiftid === "") {
            $("#area").prop("disabled", true);
            $("#s_time").prop("disabled", true);
            $("#e_time").prop("disabled", true);
            $("#b_time").prop("disabled", true);
            $("#approvebtn").prop("disabled", true);
        } else {
            if (area != "" && starttime != "" && enditime != "" && breaketime != "") {

                ajaxshiftApprove();

            } else {
                if (area === "")
                {
                    $("#area").focus();

                }
                if (starttime === "") {
                    $("#s_time").focus();
                }
                if (enditime === "") {
                    $("#e_time").focus();
                }
                if (breaketime === "") {
                    $("#b_time").focus();
                }

            }
        }
    }
    function ajaxshiftApprove() {
//        alert("Aprove Submit call");
        $.ajax({
            url: '<?php echo _U ?>approve_timesheet',

            dataType: "json",
            type: "post",
            data: {
                shiftApprove: 1,
                ladelData: $("#approveForm").serialize()

//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
                if (r.success > 0) {
//                    $("#myModal2").close();
//                    $("#myModal2").modal('toggle');

                    _toast("success", "Approved", r.msg);
                    $("#shift_id").val("").change();

                    $('#cDate').html();
                    $("#area").val("Choose Area").change();

                    $("#s_time").val("").change();
                    $("#e_time").val(" ").change();
                    $("#b_time").val(" ").change();
                    $('#divScheduleSet').html(" <button class='btn btn-danger'  type='button' name='unapprovebtn' id='unapprovebtn' onclick='shiftDiscard()'>Discard</button> <button class='btn btn-default'  type='button' onclick='shiftApprove()' id='approvebtn' name='approvebtn' >Approve</button>");

                } else {
                    _toast("warning", "Declind", r.msg);
                }

            }});
    }
    function NewSchedulesave() {
        var shiftdt = $("#dateofshift").val();
        var md_ast = $("#emplist").val();
        var md_notes = $("#md_txtnotes").val();

        if (shiftdt != "" && md_ast != "" && md_ast != null) {
            ajaxNewSchedule(shiftdt, md_ast, md_notes);
        } else {
            if (shiftdt === "" || md_ast === "" || md_ast === null) {
                if (shiftdt === "" && md_ast != "" || md_ast != null) {
                    $("#dateofshift").focus();
                } else {
                    $("#emplist").focus();
                }
            }

        }
    }
    function ajaxNewSchedule(shiftdt, md_ast, md_notes) {
        $.ajax({
            url: '<?php echo _U ?>approve_timesheet',
            dataType: "json",
            data: {
                NewSchedulesave: 1,
                shiftdt: shiftdt,
                user_id: md_ast,
                md_notes: md_notes
//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
                if (r.success > 0) {
//                    $("#myModal2").close();
                    $('#divScheduleSet').html("<button class='btn btn-default'  type='button' onclick='shiftApprove()' name='approvebtn' id='approvebtn' >Approve</button>");
//                    $('#divScheduleSet').text("Its WOrkds");
                    $("#myModal2").modal('toggle');
                    _toast("success", "Approved", r.msg);
                    $("#shift_id").val(r.data.id).change();
                    $('#cDate').html(r.Cdate);
//                    var BTNcontents = "<button class='btn btn-default'  type='button' onclick='shiftApprove()' >Approve</button>";
                    $("#area").val("Choose Area").change();
                    $("#s_time").val("").change();
                    $("#e_time").val(" ").change();
                    $("#b_time").val(" ").change();
                } else {
                    _toast("danger", "Decliend", r.msg);
                }
//                $.toaster({priority: 'danger', title: 'Message', message: r.msg});
            }
        });
    }
    function getschedule(id) {
//        alert(id);
        $.ajax({
            url: '<?php echo _U ?>approve_timesheet',
            dataType: "json",
            data: {
                getSchedule: 1,
                id: id
//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
//                alert(r.Cdate);
                $("#shift_id").val(r.data.id).change();

                $('#cDetails').html(r.Cdate + "<br/> " + r.data.start_time + " | " + r.data.end_time + " | " + r.data.break_time);
                $('#cDate').html(r.Cdate);
                $("#area").val(r.data.area_of_work).change();
                $("#s_time").val(r.data.start_time).change();
                $("#e_time").val(r.data.end_time).change();
                $("#b_time").val(r.data.break_time).change();
                enabledisable();
            }
        });
    }
    function getTimesheet(id) {
        if ($("#daterangepicker-time").val() == "") {
            $("#daterangepicker-time").focus();
        }
//        alert(id);
        $.ajax({
            url: '<?php echo _U ?>approve_timesheet',
            //dataType: "json",
            data: {
                getTimesheet: 1,
                id: id,
                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
//                alert(r);
                $('#timesheetDiv').html(r);
                $('#hid_emp_id').val(id);
                enabledisable();
            }
        });
    }
    $(document).ready(function () {
        enabledisable();
        $("#dateofshift").datepicker({maxDate: new Date()});
//        $("#dateofshift").bsdatepicker({maxDate: new Date()});
        $('#emptable').DataTable({
            "responsive": true,
            "paging": false,
            "ordering": false,
            "info": false,
            "bFilter": true
        });
        $('.dataTables_filter input').attr("placeholder", "Search...");
        $('.dataTables_filter').addClass('pull-left');
        $('.dataTables_wrapper div').addClass('col-sm-12');
        $('#timesheet-table').DataTable({
            "responsive": true,
            "bSort": true,
            "paging": false,
            "ordering": false,
            "info": false,
            "bFilter": false

        });
<?php if ($success == "1") { ?>
            Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>
<?php if ($success == "-1") { ?>
            Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>
    });
    function start_end_time()
    {
        $.ajax({
            url: '<?php echo _U ?>approve_timesheet',
            dataType: "json",
            data: {
                getTime: 1
            }, success: function () {

            }
        });
//        $_SESSION['startTime'] = time();
//        $_SESSION["loginTime"] = time();
//        $_SESSION["endTime"] = time() - $_SESSION["startTime"];
//       
    }
</script>
<script type="text/javascript">
//    showWait();


    $('#fName').autocomplete({
        source: function (request, response) {
            $.ajax({
                url: '<?php echo _U ?>approve_timesheet',
                dataType: "json",
                data: {
                    name_startsWith: request.term
                }, success: function (data) {
                    response($.map(data, function (item) {
                        var code = item.split("|");
                        return {
                            label: code[0] + " " + code[1] + " (" + code[3] + ")",
                            value: code[0],
                            data: item
                        }
                    }));
                }
            });
        },
        autoFocus: true,
        minLength: 0,
        select: function (event, ui) {
            var names = ui.item.data.split("|");
            console.log(names);
            $('#lName').val(names[1]);
            $('#email').val(names[3]);
            $('#phone').val(names[2]);
        }
    });


</script>
<?php include _PATH . "instance/front/tpl/google_maps.js.php"; ?>
