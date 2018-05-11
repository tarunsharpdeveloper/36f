<script type="text/javascript">
//    $(".mySelect, .mySelect1, .mySelect2, .mySelect3").chosen({
//        "disable_search": true
//    });
    function bindApplyRules(id) {


        $("#applyRules").html("<h3>Please, Wait...</h3>");

        var rulesData = {
            bindApplyRules: 1,
            id: id,
            late_arrival_tolerance_minutes: $("#late_arrival_tolerana_minutes").val(),
            late_arrival_tolerance: $("input[name='late_arrival_tolerance']:checked").val(),
            late_arrival_truancy: $("input[name='late_arrival_truancy']:checked").val(),
            early_departure_tolerance_minutes: $("#early_departure_tolerana_minutes").val(),
            early_departure_tolerance: $("input[name='early_departure_tolerance']:checked").val(),
            early_departure_truancy: $("input[name='early_departure_truancy']:checked").val(),
            overnight_schedule: $("#schedule_overnight:checked").length > 0 ? "1" : "0",
            startTime: $("#starttime").val(),
            endTime: $("#endtime").val(),
            ot_auth_main: $("input[name='ot_auth_main']:checked").val(),
            ot_auth_prior: $("input[name='ot_auth_prior']:checked").val(),
            ot_auth_post: $("input[name='ot_auth_post']:checked").val(),
            ot_auth_prior_total: $("#ot_auth_prior_total").val(),
            ot_auth_post_total: $("#ot_auth_post_total").val(),
            ot_auth_daily_max: $("#ot_auth_daily_max").val(),
            ot_auth_main_min: $("input[name='ot_auth_main_min']:checked").val(),
            ot_auth_prior_min: $("input[name='ot_auth_prior_min']:checked").val(),
            ot_auth_post_min: $("input[name='ot_auth_post_min']:checked").val(),
            ot_auth_prior_total_min: $("#ot_auth_prior_total_min").val(),
            ot_auth_post_total_min: $("#ot_auth_post_total_min").val(),
            ot_auth_daily_min: $("#ot_auth_daily_min").val(),
            ot_auth_no_max: $("input[name='ot_auth_no_max']:checked").val(),
            ot_auth_no_min: $("input[name='ot_auth_no_min']:checked").val()
        }

        $.ajax({
            url: '<?php echo _U ?>test_rules',
            data: rulesData,
            success: function (r)
            {
                $("#applyRules").html(r);
                $('#datatable-responsive0b').DataTable({
                    responsive: true, "searching": false,
                    "bPaginate": false, "bInfo": false
                });
            }
        });
    }
    function bindKardex() {
//        alert("CALL");
        $.ajax({
            url: '<?php echo _U ?>test_rules',
            dataType: "json",
//            type: "POST",
            data: {
                bindKardex: 1,
            }, success: function (r)
            {
//                alert(r.length);
                if (r.length >= 1) {
                    $('#collapseOne').collapse("show");
                    $("#isUpdated").val("yes");
                    $("#submitbutton").val("Update Settings");
                    jQuery.each(r, function (i, val) {
                        if (val.short_code == "DAYS_OFF_PER_MONTH_YEAR") {
//                            alert(val.value_1);
                            $("#txtPerMonth").val(val.value_1).change();
//                        $("#txtPerYear").val(val.value_2).change();
                        } else if (val.short_code == "ROLL_OVER_END") {
                            $("#txtrollyear").val(val.value_1).change();
                        } else if (val.short_code == "ROLL_OVER_EXCESS") {
                            $("#excess").val(val.value_1).change();
                            $("#excess").trigger('chosen:updated');
                        } else if (val.short_code == "HOURLY_TIME_OFF") {
                            if (val.value_1 == "on") {
                                $("#rbtHRTimeOffOn").click();
                                $("#txtHRTimeOff").val(val.value_2).change();
                            } else {
                                $("#rbtHRTimeOffOff").click();
                            }
                        } else if (val.short_code == "ILLNESS_PREGNANT_LEAVE") {
                            if (val.value_1 == "Yes") {
                                $("#rbtipaYes").click();
                            } else {
                                $("#rbtipaNo").click();
                            }
                        } else if (val.short_code == "ALLOW_NEGATIVE_VACATION") {
                            if (val.value_1 == "yes") {
                                $("#accrualsYes").click();
                                if (val.value_2 == "ALLOW") {
                                    $("#rbtQA").click();
                                    if (val.value_3 == "CUSTOM_CAP") {
                                        $("#rbtcapAOn").click();
                                        $("#txtcapA").val(val.value_4);
                                    } else {
                                        $("#rbtcapAOff").click();
                                    }
                                } else if (val.value_2 == "DEDUCT") {
                                    $("#rbtQB").click();
                                    if (val.value_3 == "CUSTOM_CAP") {
                                        $("#rbtceilingBOn").click();
                                        $("#txtceilingB").val(val.value_4);
                                        if (val.value_5 == "ALLOW_WITH_NO_CAP") {
//                                        $("#rbtOT1").prop(":checked");
                                            $("#rbtOT1").click();
                                        } else
                                        if (val.value_5 == "ALLOW_WITH_CAP_OFF") {
//                                        $("#rbtOT2").prop(":checked");
                                            $("#rbtOT2").click();
                                            $("#txtOT2B").val(val.value_6);
                                        } else
                                        if (val.value_5 == "TIME_OFF_WITHOUT_PAYMENT") {
                                            $("#rbtOT3").prop(":checked");
                                        }
                                    } else {
                                        $("#rbtceilingBOff").click();
                                        if (val.value_4 == "ALLOW_WITH_NO_CAP") {
//                                        $("#rbtOT1").prop(":checked");
                                            $("#rbtOT1").click();
                                        } else
                                        if (val.value_4 == "ALLOW_WITH_CAP_OFF") {
//                                        $("#rbtOT2").prop(":checked");
                                            $("#rbtOT2").click();
                                            $("#txtOT2B").val(val.value_5);
                                        } else
                                        if (val.value_4 == "TIME_OFF_WITHOUT_PAYMENT") {
                                            $("#rbtOT3").prop(":checked");
                                        }
                                    }
                                } else {
                                    $("#rbtQC").click();
                                }
                            } else {
                                $("#accrualsNo").click();
                            }
                        }
                    });
                } else {
                    $("#submitbutton").val("Save Settings");
                    $("#isUpdated").val("no");
                }
                bindLogged();
            }

        });
    }
    function bindLogged() {
        $.ajax({
            url: '<?php echo _U ?>test_rules',
            dataType: "json",
            //            type: "POST",
            data: {
                bindLogged: 1,
            }, success: function (r)
            {

                var contents = "<h4 style='border-bottom:1px solid #DADADA;padding:5px;'>Kardex Settings Change Logs:</h4>";
                var j = 0;
                jQuery.each(r, function (i, val) {

                    contents += "<span style='font-size:10px;display:block;font-family:verdana;padding:5px;'>" + ++j + " " + val.name + " " + val.activityLog + " the test_rules settings on " + val.touchdate + "</span>";
                });
                $("#logged").html(contents);
            }
        });
    }
    $('#tbl').dataTable({searching: false, paging: false, bInfo: false, order: [[1, 'asc']], aoColumnDefs: [{bSortable: false, aTargets: [0]}]});
//    $("#mySelect, .mySelect1, .mySelect2, .mySelect3").chosen({
//        "disable_search": true
//    });
    $("#ser_company").change(function () {
//        alert(this.value);
        bindLocation(this.value);
        bindTeam(this.value);

    });
    $(".locationTeam").change(function () {
//        alert(this.value);
        var companyId = $("#ser_company").val();
        var locationId = $("#ser_location").val();
        var teamId = $("#ser_team").val();
        $("#applyRules").html("");
//        if()
        bindEmployees(companyId, locationId, teamId);

    });
    $("#ser_employee").change(function () {
//        alert(this.value);
        if (this.value != "") {
            $("#approveBtn").show();
        } else {
            $("#approveBtn").hide();
        }
        $("#applyRules").html("");
        tableCall(this.value);


    });
    function bindLocation(companyid) {
        $.ajax({
            url: '<?php echo _U ?>test_rules',
            dataType: "json",
            //            type: "POST",
            data: {
                bindLocation: 1,
                companyid: companyid

            }, success: function (r)
            {
//                alert(r.length);
                var contents = "<option selected disabled>Choose Location</option>";
                var j = 0;
                jQuery.each(r, function (i, val) {

                    contents += " <option value=" + val.id + " >" + val.name + "</option>";
                });
                contents += " <option value='-1' >REMOTE WORKERS</option>";
                $("#ser_location").html(contents);
//                $("#ser_location").trigger("chosen:updated");
//                $("#ser_location .chosen-drop").slideDown();
            }
        });
    }
    function bindTeam(companyid) {
        $.ajax({
            url: '<?php echo _U ?>test_rules',
            dataType: "json",
            //            type: "POST",
            data: {
                bindTeam: 1,
                companyid: companyid

            }, success: function (r)
            {
//                alert(r.length);
                var contents = "<option selected disabled>Choose Team</option>";
                var j = 0;
                jQuery.each(r, function (i, val) {

                    contents += " <option value=" + val.id + " >" + val.name + "</option>";
                });
                $("#ser_team").html(contents);
//                $("#ser_team").trigger("chosen:updated");
//                $("#ser_team").mousedown();
            }
        });
    }
    function bindEmployees(companyId, locationId, teamId) {
        $.ajax({
            url: '<?php echo _U ?>test_rules',
            dataType: "json",
            //            type: "POST",
            data: {
                bindEmployees: 1,
                companyid: companyId, locationid: locationId, teamid: teamId
            }, success: function (r)
            {
//                alert(r.length);
                var contents = "<option selected disabled>Choose Employee</option>";
                var j = 0;
                jQuery.each(r, function (i, val) {

                    contents += " <option value=" + val.id + " >" + val.fname + " " + val.lname + "</option>";
                });
                $("#ser_employee").html(contents);
//                $("#ser_employee").trigger("chosen:updated");
            }
        });
    }
    $("#txtPerMonth").change(function () {
        if (!isNaN($(this).val())) {
            var a = parseFloat(parseFloat($(this).val()) * 12).toFixed(2);
            $("#txtPerYear").val(a);
        }
    });
    $("#txtPerYear").change(function () {
        if (!isNaN($(this).val())) {
            var a = parseFloat(parseFloat($(this).val()) / 12).toFixed(2);
            $("#txtPerMonth").val(a);
        }
    });
    $("#logged_form").submit(function (e) {
//        setTimeout(function() {$("#waitText").text("Please wait We are saving Data");},1000);
//        $("#waitText").text("Please wait... we are saving the data");
        var empid = $("#ser_employee").val();
        if (empid == null) {
//            alert("ITS NULL"+empid+" ;");
            return false;
        }
        $.ajax({
            url: '<?php echo _U ?>test_rules',
            dataType: "json",
            //            type: "POST",
            data: {
                test_rules_save: 1,
                ladelData: $("#logged_form").serialize()
            }, success: function (r)
            {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);
//                    bindKardex();
                    tableCall(empid);
                    $("#applyRules").html("");
                } else {
                    _toast("warning", "Declind", r.msg);
                }

//                $("#waitText").text("");
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
    function tableCall(id) {
        $.ajax({
            url: '<?php echo _U ?>test_rules',
//            dataType: "json",
            //            type: "POST",
            data: {
                tableCall: 1,
                id: id
            }, success: function (r)
            {
                $("#tblsummary").html(r);
                $('#datatable-responsive0a').DataTable({
                    responsive: true, "searching": false,
                    "bPaginate": false, "bInfo": false
                });
            }
        });
    }
    function deleteRecords(id) {
        var empid = $("#ser_employee").val();
        $.ajax({
            url: '<?php echo _U ?>test_rules',
            dataType: "json",
            //            type: "POST",
            data: {
                deleteRecords: 1,
                id: id
            }, success: function (r)
            {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);
//                    bindKardex();
                    tableCall(empid);
                    $("#applyRules").html("");
                } else {
                    _toast("warning", "Declind", r.msg);
                }
            }
        });
    }
    function deleteall(id) {
        var empid = $("#ser_employee").val();
        $.ajax({
            url: '<?php echo _U ?>test_rules',
            dataType: "json",
            //            type: "POST",
            data: {
                deleteall: 1,
                id: id
            }, success: function (r)
            {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);
//                    bindKardex();
                    tableCall(empid);
                    $("#applyRules").html("");
                } else {
                    _toast("warning", "Declind", r.msg);
                }
            }
        });
    }
    $(document).on("click", ".rbtHRTimeOff", function () {
        if ($(this).val() === "on") {
            $("#HRTimeOffdiv").slideDown();
        } else {
            $("#HRTimeOffdiv").slideUp();
        }
    });
    $(document).on("click", ".rbtcapA", function () {
        if ($(this).val() === "on") {
            $("#capDivA").slideDown();
        } else {
            $("#capDivA").slideUp();
        }
    });
    $(document).on("click", ".rbtceilingB", function () {
        if ($(this).val() === "on") {
            $("#ceilingdivB").slideDown();
        } else {
            $("#ceilingdivB").slideUp();
        }
    });
    $(document).on("change", ".ceilings", function () {
        //        alert($(this).val());
        if ($(this).val() > 3) {
            //            $("#checkboxDefault").prop("checked", "true");
            $("#checkboxDefault").attr('checked');
            $("#checkboxDefault").parent('span').addClass('checked');
        } else {
            //            $("#checkboxDefault").prop("checked", "false");

            $("#checkboxDefault").removeAttr('checked');
            $("#checkboxDefault").parent('span').removeClass('checked');
        }
    });
    $(document).on("click", ".accruals", function () {
        //        alert($(this).val());
        if ($(this).val() == "yes") {
            $("#options").slideDown();
        } else {
            $("#options").slideUp();
        }

    });
    $(document).on("click", ".rbtOT", function () {
        //        alert($(this).val());
        if ($(this).val() == "OT2") {
            $("#OTdiv").slideDown();
        } else {
            $("#OTdiv").slideUp();
        }

    });
    $(document).on("click", ".rbtilllness", function () {
        if ($(this).val() === "on") {
            $("#illlnessdiv").slideDown();
        } else {
            $("#illlnessdiv").slideUp();
        }
    });
    $(document).on("click", ".rbtQ", function () {
        $(".sub_Q").slideUp();
        $("#" + $(this).val()).slideDown();
    });
    $(document).ready(function () {
        if ($("#ser_employee").val() === null) {
            $("#approveBtn").hide();

        } else {
            $("#approveBtn").show();

        }
        $('#datatable-responsive0a').DataTable({
            responsive: true,
        });
        //        $('#collapseOne').collapse("show");
        $(".sub_Q").slideUp();
        if ($(".accruals").val() == "yes") {
            $("#options").slideDown();
        } else {
            $("#options").slideUp();
        }
        bindKardex();
        $("[data-toggle]").tooltip();
    });
    $(function () {
        $("#dateofshift").bsdatepicker({
            autoClose: true,
            onSelect: function (dateText) {
                display("Selected date: ");
            },
            onClose: function (dateText) {
                display("Close" + this.value);
            }
        }).on("changeDate", function () {
//            ChangeCall();
        });
//        $("#enddateofshift").bstimepicker({
//            autoClose: true,
//            use24hours: true,
//            onSelect: function (dateText) {
//                display("Selected date: ");
//            },
//            onClose: function (dateText) {
//                display("Close" + this.value);
//            }
//        }).on("changeDate", function () {
////            endChangeCall();
//        });
    });

    function show_custom_values(id) {
        $(".rules_custom_values").hide();
        $("#" + id).slideDown();
    }
</script>