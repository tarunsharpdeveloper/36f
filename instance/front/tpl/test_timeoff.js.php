<script>
    function divManage() {
        var value = '';
        $('#first_section input').on('change', function () {
            value = ($('input[name=absentType]:checked', '#first_section').val());
            if (value === 'entireDay') {
                $("#entireDay").removeClass('hidden');
                $("#hourly").addClass('hidden');
            } else {
                $("#hourly").removeClass('hidden');
                $("#entireDay").addClass('hidden');
            }
        });
    }
    $("#ser_company").change(function () {
        bindLocation(this.value);
        bindTeam(this.value);
    });
    function bindLocation(companyid) {
        $.ajax({
            url: '<?php echo _U ?>test_timeoff',
            dataType: "json",
            type: "POST",
            data: {
                bindLocation: 1, companyid: companyid
            }, success: function (r) {
                var contents = "<option selected disabled>Choose Location</option>";
                var j = 0;
                jQuery.each(r, function (i, val) {
                    contents += " <option value=" + val.id + " >" + val.name + "</option>";
                });
                contents += " <option value='-1' >REMOTE WORKERS</option>";
                $("#ser_location").html(contents);
                $("#ser_location").trigger("chosen:updated");
                $("#ser_location .chosen-drop").slideDown();
            }
        });
    }
    function bindTeam(companyid) {
        $.ajax({
            url: '<?php echo _U ?>test_timeoff',
            dataType: "json",
            type: "POST",
            data: {
                bindTeam: 1, companyid: companyid
            }, success: function (r) {
                var contents = "<option selected disabled>Choose Team</option>";
                var j = 0;
                jQuery.each(r, function (i, val) {
                    contents += " <option value=" + val.id + " >" + val.name + "</option>";
                });
                $("#ser_team").html(contents);
                $("#ser_team").trigger("chosen:updated");
                $("#ser_team").mousedown();
            }
        });
    }
    $(".locationTeam").change(function () {
        var companyId = $("#ser_company").val();
        var locationId = $("#ser_location").val();
        var teamId = $("#ser_team").val();
        bindEmployees(companyId, locationId, teamId);
    });
    function bindEmployees(companyId, locationId, teamId) {
        $.ajax({
            url: '<?php echo _U ?>test_timeoff',
            dataType: "json",
            type: "POST",
            data: {
                bindEmployees: 1, companyid: companyId, locationid: locationId, teamid: teamId
            }, success: function (r) {
                var contents = "<option selected disabled>Choose Employee</option>";
                var j = 0;
                jQuery.each(r, function (i, val) {
                    contents += " <option value=" + val.id + " >" + val.fname + " " + val.lname + "</option>";
                });
                $("#ser_employee").html(contents);
                $("#ser_employee").trigger("chosen:updated");
            }
        });
    }

    function saveData() {
//        alert($(".error:visible").length );
        if ($(".error:visible").length === 0) {
//               alert();
            $(".saveData").hide();
            $(".waitData").show();
            $.ajax({
                url: "<?php echo _U ?>test_timeoff",
                data: {dataUpdate: 1, data: $("#first_section").serialize()},
                method: "post",
                success: function (r) {
                    _toast("success", "Approved", "Your record has been added");
                    $("#absence_list").html(r);
                    setTimeout(function () {
                        $(".saveData").show();
                        $(".waitData").hide();
                    }, 2000);
                }
            });
        }
    }
    function leaveManage(days, status, id,emp_id) {
        $.ajax({
            url: "<?php echo _U ?>test_timeoff",
            data: {leaveManage: 1, status: status, day: days, id: id,empid:emp_id},
            method: "post",
            success: function (r) {
                if (status == 1) {
                    _toast("success", "Approved", "Your request for " + days + " day(s) has been approved");
                } else {
                    _toast("danger", "Sorry", "Your request for " + days + " day(s) has been decline");
                }
                $("#absence_list").html(r);
//                setTimeout(function () {
//                    $(".saveData").show();
//                    $(".waitData").hide();
//                }, 2000);
            }
        });
    }
</script>

