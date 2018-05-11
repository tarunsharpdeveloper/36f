


<script type="text/javascript">
    var table = "";
//    $(document).on("click", "#temp_save", function () {
//
//    });
    $("#form_save").submit(function (e) {
//        alert("Call");
        $.ajax({
            url: '<?php echo _U ?>schedule_template',
            dataType: "json",
            data: {
                saveTemplate: 1,
                ladelData: $("#form_save").serialize()

            }, success: function (r) {
                if (r.success > 0) {
                    $("#temp_save").val("Save");
                    $("#hideditID").val("");
                    $("#form_save input:text").val("");
                    _toast("success", "Approved", r.msg);
                    refreshDiv();
                } else {
                    _toast("warning", "Declind", r.msg);
                }
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
    function refreshDiv() {
        $.ajax({
            url: '<?php echo _U ?>schedule_template',
//            dataType: "json",
            data: {
                refreshDiv: 1

            }, success: function (r) {
                $("#setTable").html(r);
                DTableCall();
            }
        });
    }
    function DTableCall() {
        $('#empTables').DataTable().destroy();
        table = $('#empTables').DataTable({
            "responsive": true,
            "paging": false,
            "ordering": false,
            "info": false,
            "bFilter": true
        });
        table.on('draw', function () {

        });
        return table;

    }
    function removeSchedule(id) {
        $.ajax({
            url: '<?php echo _U ?>schedule_template',
            dataType: "json",
            data: {
                removeSchedule: 1, id: id

            }, success: function (r) {
                if (r.success > 0) {

                    _toast("success", "Approved", r.msg);
                    refreshDiv();
                } else {
                    _toast("warning", "Declind", r.msg);
                }

            }
        });
    }
    $(document).on("click", ".empEdit", function (e) {
        var id = $(this).data('id');
//        alert(id);
        bindData(id);
    });
    function bindData(id) {
        $.ajax({
            url: '<?php echo _U ?>schedule_template',
            dataType: "json",
            data: {
                bindData: 1, id: id

            }, success: function (r) {
                $("#hideditID").val(r.id);
                $("#template_name").val(r.template_name);
                $("#mon_start").val(r.mon_start);
                $("#tue_start").val(r.tue_start);
                $("#wed_start").val(r.wed_start);
                $("#thu_start").val(r.thu_start);
                $("#fri_start").val(r.fri_start);
                $("#sat_start").val(r.sat_start);
                $("#sun_start").val(r.sun_start);

                $("#mon_end").val(r.mon_end);
                $("#tue_end").val(r.tue_end);
                $("#wed_end").val(r.wed_end);
                $("#thu_end").val(r.thu_end);
                $("#fri_end").val(r.fri_end);
                $("#sat_end").val(r.sat_end);
                $("#sun_end").val(r.sun_end);
                $("#temp_save").val("Update");
                $("#template_name").focus();

                $("#template_name").animate({scrollTop: 0}, "slow");
            }
        });
    }
    $(document).ready(function () {
        refreshDiv();
    });
</script>
<?php //include _PATH . "instance/front/tpl/google_maps.js.php";          ?>
