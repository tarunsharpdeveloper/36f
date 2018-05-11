<script type="text/javascript">
    var oldFormData = '';
    window.onload = function () {
        window.addEventListener("beforeunload", function (e) {
            if (refreshWithLogoutInactivity == 0) {
                var eachfieldChk = 0;
                if (oldFormData === $("#form_setting").serialize() && eachfieldChk === 0) {
                    eachfieldChk = 0;
                } else {
                    eachfieldChk = 1;
                }
                console.log(eachfieldChk);
                if (eachfieldChk === 0) {
                    return undefined;
                }


                var confirmationMessage = 'It looks like you have been editing something. '
                        + 'If you leave before saving, your changes will be lost.';
                (e || window.event).returnValue = confirmationMessage; //Gecko + IE
                return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.    
            }
        });
    };
    function bindOt() {
//        alert("CALL");
        $.ajax({
            url: '<?php echo _U ?>settings_ot',
            dataType: "json",
//            type: "POST",
            data: {
                bindOt: 1,
            }, success: function (r)
            {
//                alert(r.length);
                if (r.length >= 1) {
                    $('#collapseOne').collapse("show");
                    $("#isUpdated").val("yes");
                    $("#submitbutton").val("Update Settings");
                    jQuery.each(r, function (i, val) {
                        if (val.value_1 === "yes") {
                            $("#rbt_authYes").click();
                            if (val.value_2 === "yes") {
                                $("#rbt_monthYes").click();
                                $("#txt_months").val(val.value_3);

                            } else {
                                $("#rbt_monthNo").click();
                            }
                            if (val.value_4 === "entday") {
                                $("#rbt_min_entDay").click();
                                $("#txt_min_entday").val(val.value_5);
                            }
                            if (val.value_4 === "sep") {
                                $("#rbt_min_seprate").click();
                                $("#txt_min_prior").val(val.value_5);
                                $("#txt_min_post").val(val.value_6);
                            }
                            if (val.value_4 === "nomin") {
                                $("#rtb_min_nomin").click();
                            }
                            if (val.value_7 === "entday") {
                                $("#rbt_max_entDay").click();
//                                alert(val.value_8);
                                $("#txt_max_entday").val(val.value_8);
                            }
                            if (val.value_7 === "sep") {
                                $("#rbt_max_seprate").click();
                                $("#txt_max_prior").val(val.value_8);
                                $("#txt_max_post").val(val.value_9);
                            }
                            if (val.value_7 === "nomin") {
                                $("#rtb_max_nomin").click();
                            }


                        } else {
                            $("#rbt_authNo").click();
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
            url: '<?php echo _U ?>settings_ot',
            dataType: "json",
            //            type: "POST",
            data: {
                bindLogged: 1,
            }, success: function (r)
            {

                var contents = "<h4 style='border-bottom:1px solid #DADADA;padding:5px;'>Kardex Settings Change Logs:</h4>";
                var j = 0;
                jQuery.each(r, function (i, val) {

                    contents += "<span style='font-size:10px;display:block;font-family:verdana;padding:5px;'>" + ++j + " " + val.name + " " + val.activityLog + " the settings_ot settings on " + val.touchdate + "</span>";
                });
                $("#logged").html(contents);
            }
        });
    }
    $('#tbl').dataTable({searching: false, paging: false, bInfo: false, order: [[1, 'asc']], aoColumnDefs: [{bSortable: false, aTargets: [0]}]});
    $("#mySelect, .mySelect1, .mySelect2, .mySelect3").chosen({
        "disable_search": true
    });
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
    $("#form_setting").submit(function (e) {
//        setTimeout(function() {$("#waitText").text("Please wait We are saving Data");},1000);
        $("#waitText").text("Please wait... we are saving the data");
        $.ajax({
            url: '<?php echo _U ?>settings_ot',
            dataType: "json",
            //            type: "POST",
            data: {
                settings_ot_setting_save: 1,
                ladelData: $("#form_setting").serialize()
            }, success: function (r)
            {
                if (r.success > 0) {
                    oldFormData = $("#form_setting").serialize();
                    _toast("success", "Approved", r.msg);
                    bindOt();
                } else {
                    _toast("warning", "Declind", r.msg);
                }

                $("#waitText").text("");
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
    $(document).on("click", ".rbtHRTimeOff", function () {
        if ($(this).val() === "on") {
            $("#HRTimeOffdiv").slideDown();
        } else {
            $("#HRTimeOffdiv").slideUp();
        }
    });
    $(document).on("click", ".rbt_month", function () {
        if ($(this).val() === "yes") {
            $("#rbt_monthdiv").slideDown();
        } else {
            $("#rbt_monthdiv").slideUp();
        }
    });
    $(document).on("click", ".rbt_auth", function () {
        if ($(this).val() === "yes") {
            $("#authDiv").slideDown();
        } else {
            $("#authDiv").slideUp();
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
    $(document).on("click", ".rtb_min", function () {
        if ($(this).val() == "entday") {
            $("#min_entDayDiv").slideDown();
        } else {
            $("#min_entDayDiv").slideUp();
        }
        if ($(this).val() == "sep") {
            $("#min_sep_div").slideDown();
        } else {
            $("#min_sep_div").slideUp();
        }
    });
    $(document).on("click", ".rtb_max", function () {
        if ($(this).val() == "entday") {
            $("#max_entDayDiv").slideDown();
        } else {
            $("#max_entDayDiv").slideUp();
        }
        if ($(this).val() == "sep") {
            $("#max_sep_div").slideDown();
        } else {
            $("#max_sep_div").slideUp();
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
        setTimeout(function () {
            oldFormData = $("#form_setting").serialize();
        }, 1000);
        //        $('#collapseOne').collapse("show");
        if ($('#rbt_authNo').is(':checked')) {
            $("#authDiv").slideUp();
        } else {
            $("#authDiv").slideDown();
        }
        if ($('#rbt_monthNo').is(':checked')) {
            $("#rbt_monthdiv").slideUp();
        } else {
            $("#rbt_monthdiv").slideDown();
        }
        $(".sub_Q").slideUp();
        if ($(".accruals").val() == "yes") {
            $("#options").slideDown();
        } else {
            $("#options").slideUp();
        }
        bindOt();
        $("[data-toggle]").tooltip();
    });
</script>