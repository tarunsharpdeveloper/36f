<?php include _PATH . "instance/front/tpl/libValidate.php" ?>


<script type="text/javascript">

    $("#new_team").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        var locid = [];
        $('.setlocation:checked').each(function (i) {

            locid[i] = $(this).val();
        });
//        alert(locid);
        $('#hidlocationid').val(locid);
//        return;
        $.ajax({
            url: '<?php echo _U ?>team',
            dataType: "json",
//            type: "post",
            data: {
                isAddTeam: 1,
                ladelData: $("#new_team").serialize(),
                hidlocationid: locid

//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);
                    $("#myModal3").modal('hide');

                    tablerefresh();
                } else {
                    _toast("warning", "Declind", r.msg);
                }
            }
        });
    });
    $("#edit_team").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var locid = [];
        $('.e_setlocation:checked').each(function (i) {
            locid[i] = $(this).val();
        });
        $('#e_hidlocationid').val(locid);
        $.ajax({
            url: '<?php echo _U ?>team',
            dataType: "json",
//            type: "post",
            data: {
                iseditTeam: 1,
                ladelData: $("#edit_team").serialize(),
                hidlocationid: locid

//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);
                    $("#myModal4").modal('hide');

                    tablerefresh();
                } else {
                    _toast("warning", "Declind", r.msg);
                }
            }
        });
    });
    function tablerefresh() {
        $.ajax({
            url: '<?php echo _U ?>team',
//            dataType: "json",
//            type: "post",
            data: {
                tablerefresh: 1,
//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
                $("#ReloadTabel").html(r);
                $('#datatable-responsive').DataTable({
                    "responsive": true,
                    "paging": true,

                    "info": false,
                    "bFilter": true

                });
            }});
    }
    $("body").on("change", ".show_preview", function ()
    {
        var prev_id = $(this).data('prev_id');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            return
        }
        ;
        //if (/^image/.test( files[0].type))
        var reader = new FileReader();
        reader.readAsDataURL(files[0]);
        reader.onloadend = function () {
            $("#" + prev_id).show();
            $("#" + prev_id).css("background-image", "url(" + this.result + ")");
        };
    }
    );
    $(document).on("click", ".teamDelete", function (e) {
        var id = $(this).data('id');

        $.ajax({
            url: '<?php echo _U ?>team',
            dataType: "json",
//            type: "post",
            data: {
                teamDelete: 1,
                id: id
            }, success: function (r) {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);
                    tablerefresh();
                } else {
                    _toast("warning", "Declind", r.msg);
                }
            }
        });
    });
    $(document).on("click", ".teamEdit", function (e) {
        var id = $(this).data('id');
//        alert(id);
        $.ajax({
            url: '<?php echo _U ?>team',
            dataType: "json",
//            type: "post",
            data: {
                bindTeams: 1,
                id: id
            }, success: function (r) {
//                alert(r.team);
                $('.e_setlocation').each(function (i) {

                    $(this).prop('checked', false);
                    $(this).parent('span').removeClass('checked');

                });
                $.each(r.locTeam, function (i, item) {
                    var locid = [];
                    $('.e_setlocation').each(function (i) {
                        if ($(this).val() === item.location_id)
                        {

                            $(this).prop('checked', true);
                            $(this).parent('span').addClass('checked');
                            locid[i] = $(this).val();
                        }
                        $('#e_hidlocationid').val(locid);
                    });
//                    $("#a_name").val(item.name);
                });


                $.each(r.team, function (i, val) {
                    if (i == "id") {
                        $("#teamID").val(val);
                    }
                    if (i == "name") {
//                        alert(i + "   " + val);
                        $("#e_name").val(val);
                    }
                });
                $("#myModal4").modal("show");

            }
        });
    });
    $(document).ready(function () {
        tablerefresh();
    });</script>
<script>
    function toastCall() {
<?php if ($_SESSION['success'] === "1") { ?>
            _toast("success", "<?php echo $_SESSION['msg']; ?>");
<?php } else { ?>
            _toast("warning", "<?php echo $_SESSION['msg']; ?>");
<?php } ?>
    }
</script>
<?php
// include _PATH . "instance/front/tpl/google_maps.js.php"; ?>