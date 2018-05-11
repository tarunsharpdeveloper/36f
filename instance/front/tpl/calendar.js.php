<script type="text/javascript">
    $("#englishDate").val("<?= $date ?>").change();
//    $("#pdate").val("<?= $jala_date[2]; ?>");
//    $("#pmonth").val("<?= $jala_date[1]; ?>");
//    $("#pyear").val("<?= $jala_date[0]; ?>");

    $("#pdate, #pmonth, #pyear").change(function () {
        $.ajax({
            url: "<?php echo _U ?>calendar",
            data: {date_convert: 1, pdate: $("#pdate").val(), pmonth: $("#pmonth").val(), pyear: $("#pyear").val()},
            method: "post",
            success: function (r) {
                $("#englishDate").val(r);
                $("#span_gregorian").html(r);
            }
        });
    });

    function handler(e) {
        $.ajax({
            url: "<?php echo _U ?>calendar",
            data: {gregorian_to_jalali: 1, date: e.target.value},
            method: "post",
            dataType: "JSON",
            success: function (r) {
                $("#pdate").val(r[2]);
                $("#pmonth").val(r[1]);
                $("#pyear").val(r[0]);
                $("#span_gregorian").html(e.target.value);
            }
        });

    }
    function formSubmit() {
        $.ajax({
            url: "<?php echo _U ?>calendar",
            data: {saveDetail: 1, data: $("#leaveEntry").serialize()},
            method: "post",
            success: function (r) {
                $("#englishDate").val("<?= $date ?>").change();
                $(".EditSaveChanges").html("Save The Leave Detail").addClass('btn-success').removeClass('btn-warning');
                $("#leaveDetail").html(r);
                $("textarea").val('');
                $("#editLeave").val(0);
                $("#level").val('36F level');
            }
        });
    }
    function editLeave(id, date, reason, fReason, level) {
        $("#englishDate").val(date).change();
        $("#farsiReason").val(fReason);
        $("#englishReason").val(reason);
        $("#editLeave").val(id);
        $("#level").val(level);
        $(".EditSaveChanges").html(" Edit The Leave Detail").removeClass('btn-success').addClass('btn-warning');
    }
    function deleteLeave(id) {
        var r = confirm("Are you sure you want to delete?");
        if (r === true) {
            $.ajax({
                url: "<?php echo _U ?>calendar",
                data: {DeleteDetail: 1, data: id},
                method: "post",
                success: function (data) {
                    $("#leaveDetail").html(data);
                }
            });

        }

    }
</script>