<script type="text/javascript">
    var oldFormData = '';
    window.onload = function () {
        window.addEventListener("beforeunload", function (e) {
            if (refreshWithLogoutInactivity == 0) {
                var eachfieldChk = 0;
                $(".kardex_tool").each(function (index, element) {
                    console.log($(element).val());
                    if ($(element).val() !== '' && eachfieldChk === 0) {
                        eachfieldChk = 1;
                    }
                });
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
    function bindKardex() {
//        alert("CALL");
        $.ajax({
            url: '<?php echo _U ?>kardex',
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
            url: '<?php echo _U ?>kardex',
            dataType: "json",
            //            type: "POST",
            data: {
                bindLogged: 1,
            }, success: function (r)
            {

                var contents = "<h4 style='border-bottom:1px solid #DADADA;padding:5px;'>Kardex Settings Change Logs:</h4>";
                var j = 0;
                jQuery.each(r, function (i, val) {

                    contents += "<span style='font-size:10px;display:block;font-family:verdana;padding:5px;'>" + ++j + " " + val.name + " " + val.activityLog + " the kardex settings on " + val.touchdate + "</span>";
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
            url: '<?php echo _U ?>kardex',
            dataType: "json",
            //            type: "POST",
            data: {
                kardex_setting_save: 1,
                ladelData: $("#form_setting").serialize()
            }, success: function (r)
            {
                if (r.success > 0) {
//                    _toast("success", "Approved", r.msg);
                    bindKardex();
                    $("#myModal").modal("toggle");
                    oldFormData = $("#form_setting").serialize();
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
        setTimeout(function () {
            oldFormData = $("#form_setting").serialize();
        }, 1000);
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
</script>