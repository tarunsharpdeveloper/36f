<?php include _PATH . "instance/front/tpl/libValidate.php" ?>


<script type="text/javascript">
    var form_lunchsetting = '';
    var form_karkaard = '';
    var form_othersetting = '';
    window.onload = function () {
        window.addEventListener("beforeunload", function (e) {
            if (refreshWithLogoutInactivity == 0) {
                var eachfieldChk = 0;
                if (form_lunchsetting === $("#form_lunchsetting").serialize() && eachfieldChk === 0) {
                    eachfieldChk = 0;
                } else {
                    eachfieldChk = 1;
                }
                
               
                if (form_karkaard === $("#form_karkaard").serialize() && eachfieldChk === 0) {
                    eachfieldChk = 0;
                } else {
                    eachfieldChk = 1;
                }
               
               
                if (form_othersetting === $("#form_othersetting").serialize() && eachfieldChk === 0) {
                    eachfieldChk = 0;
                } else {
                    eachfieldChk = 1;
                }
               
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
    $("#form_lunchsetting").submit(function (e) {
        $(".waitText").text("Please wait... we are saving the data");
        $.ajax({
            url: '<?php echo _U ?>daily_karkaard',
            dataType: "json",
//            type: "POST",
            data: {
                lunch_setting_save: 1,
                ladelData: $("#form_lunchsetting").serialize()
            }, success: function (r)
            {
                if (r.success > 0) {
                    form_lunchsetting = $("#form_lunchsetting").serialize();
                    _toast("success", "Approved", r.msg);
                    bindLunchSettings();
                } else {
                    _toast("warning", "Declind", r.msg);
                }
                $(".waitText").text("");
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
    $("#form_karkaard").submit(function (e) {
        $(".waitText").text("Please wait... we are saving the data");
        $.ajax({
            url: '<?php echo _U ?>daily_karkaard',
            dataType: "json",
//            type: "POST",
            data: {
                karkaard_save: 1,
                ladelData: $("#form_karkaard").serialize()
            }, success: function (r)
            {
                if (r.success > 0) {
                    form_karkaard = $("#form_karkaard").serialize();
                    _toast("success", "Approved", r.msg);
                    bindKarkaardSettings();
                } else {
                    _toast("warning", "Declind", r.msg);
                }
                $(".waitText").text("");
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
    $("#form_othersetting").submit(function (e) {
        $(".waitText").text("Please wait... we are saving the data");
        $.ajax({
            url: '<?php echo _U ?>daily_karkaard',
            dataType: "json",
//            type: "POST",
            data: {
                other_save: 1,
                ladelData: $("#form_othersetting").serialize()
            }, success: function (r)
            {
                if (r.success > 0) {
                    form_othersetting = $("#form_othersetting").serialize();
                    _toast("success", "Approved", r.msg);
                    bindOtherSettings();
                } else {
                    _toast("warning", "Declind", r.msg);
                }
                $(".waitText").text("");
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
    $(document).on("click", ".selectall", function () {
        if ($(this).is(":checked")) {
            $("#chkAllDefault").val("yes");
        } else {
            $("#chkAllDefault").val("no");
        }
    });
    function bindOtherSettings() {
        $.ajax({
            url: '<?php echo _U ?>daily_karkaard',
            dataType: "json",
//            type: "POST",
            data: {
                bindOtherSettings: 1,
            }, success: function (r)
            {
//                alert(r.length);
                if (r.length >= 1) {
                    $('#collapseOne').collapse("show");
                    $("#isUpdatedOther").val("yes");
                    $("#savesettingsOther").val("Update Settings");
                    jQuery.each(r, function (i, val) {
                        if (val.short_code == "THUSDAY_DEDUCT_AS_DAY") {
                            if (val.value_1 == "on") {
                                $("#rbtvactionOn").click();
                            } else {
                                $("#rbtvactionOff").click();
                            }
                        } else if (val.short_code == "SICK_TIME_CEILING") {
                            $("#day_permonth").val(val.value_1);
                            $("#day_peryear").val(val.value_2);
                            if (val.value_3 == "Flexible") {
                                $("#chkFlexible").click();
                            } else {
                                $("#chkStrict").click();
                            }

                        }
                    });
                } else {
                    $("#savesettingsOther").val("Save Settings");
                    $("#isUpdatedOther").val("no");
                }
            }
        });
    }
    function bindLunchSettings() {
        $.ajax({
            url: '<?php echo _U ?>daily_karkaard',
            dataType: "json",
//            type: "POST",
            data: {
                bindLunchSettings: 1,
            }, success: function (r)
            {
//                alert(r.length);
                if (r.length >= 1) {
                    $('#collapseOne').collapse("show");
                    $("#isUpdatedLunch").val("yes");
                    $("#savesettingsLunch").val("Update Settings");
                    jQuery.each(r, function (i, val) {
                        if (val.short_code == "LUNCH_DURATION") {
                            if (val.value_1 == "on") {
                                $("#rbtLunchOn").click();
                                $("#set_lunch_time").val(val.value_2);
                            } else {
                                $("#rbtLunchOff").click();
                            }
                        } else if (val.short_code == "LUNCH_SPECIFIC_TIME") {
                            if (val.value_1 == "on") {
                                $("#rbtLunchTimeOn").click();
                                $("#lunch_start_time").val(val.value_2);
                                $("#lunch_end_time").val(val.value_3);
                            } else {
                                $("#rbtLunchTimeOff").click();
                            }
                        } else if (val.short_code == "LUNCH_DEDUCTED") {
                            if (val.value_1 == "on") {
                                $("#rbtLunchdeductOn").click();
                            } else {
                                $("#rbtLunchdeductOff").click();
                            }
                        }
                    });
                } else {
                    $("#savesettingsLunch").val("Save Settings");
                    $("#isUpdatedLunch").val("no");
                }
            }
        });
    }
    function bindKarkaardSettings() {
        $.ajax({
            url: '<?php echo _U ?>daily_karkaard',
            dataType: "json",
//            type: "POST",
            data: {
                bindKarkaardSettings: 1,
            }, success: function (r)
            {
//                alert(r.length);
                if (r.length >= 1) {
                    $('#collapseOne').collapse("show");
                    $("#isUpdatedKasreh").val("yes");
                    $("#savesettingsKasreh").val("Update Settings");
                    jQuery.each(r, function (i, val) {
                        if (val.short_code == "DEFAULT_DAILY_KARKAARD") {
                            $("#default_kakaard").val(val.value_1);
                            if (val.value_2 == "yes") {
                                $(".selectall").prop('checked', true);
                                $(".selectall").parent('span').addClass('checked');
                                $("#chkAllDefault").val("yes");
                            } else {
                                $(".selectall").removeAttr('checked');
                                $('.selectall').parent('span').removeClass('checked');
                                $("#chkAllDefault").val("no");
                            }
                        } else if (val.short_code == "ILLNESS_EXTENDED") {
                            if (val.value_1 == "CUSTOM") {
                                $("#rbtIllnessOff").click();

                                $("#txt_custome_illness").val(val.value_2);
                            } else {
                                $("#rbtIllnessOn").click();
                            }
                            if (val.value_3 == "DONT_DEDUCT") {
                                $("#rbtIllnessDeductOff").click();
                            } else {
                                $("#rbtIllnessDeductOn").click();
                            }
                        } else if (val.short_code == "TIMEOFF_WITHOUT_PAYMENT") {
                            if (val.value_1 == "CUSTOM") {
                                $("#rbtTimeOffOff").click();
                                $("#txt_custome_deduct").val(val.value_2);
                            } else {
                                $("#rbtTimeOffOn").click();

                            }
                            if (val.value_3 == "DONT_DEDUCT") {
                                $("#rbtTimeOffDeductOff").click();
                            } else {
                                $("#rbtTimeOffDeductOn").click();
                            }
                        } else if (val.short_code == "SICK_TIME") {
                            if (val.value_1 == "CUSTOM") {
                                $("#rbtSickOff").click();

                                $("#txt_custome_sick").val(val.value_2);
                            } else {
                                $("#rbtSickOn").click();
                            }
                            if (val.value_3 == "DONT_DEDUCT") {
                                $("#rbtTimeOffDeductOff").click();
                            } else {
                                $("#rbtTimeOffDeductOn").click();
                            }
                        } else if (val.short_code == "JOB_ABNDONMENT") {
                            if (val.value_1 == "CUSTOM") {
                                $("#rbtJobOff").click();
                                $("#txt_custome_job").val(val.value_2);
                            } else {
                                $("#rbtJobOn").click();
                            }
                            if (val.value_3 == "DONT_DEDUCT") {
                                $("#rbtJobDeductOff").click();
                            } else {
                                $("#rbtJobDeductOn").click();
                            }
                        } else if (val.short_code == "DAY_OFF_WITH_PAYMENT") {
                            if (val.value_1 == "CUSTOM") {
                                $("#rbtDayoffOn").click();
                                $("#txt_custome_dayoff").val(val.value_2);
                            } else {
                                $("#rbtDayoffOff").click();
                            }
                            if (val.value_3 == "DONT_DEDUCT") {
                                $("#rbtDayoffDeductOff").click();
                            } else {
                                $("#rbtDayoffDeductOn").click();
                            }
                        }

                    });
                } else {
                    $("#savesettingsKasreh").val("Save Settings");
                    $("#isUpdatedKasreh").val("no");
                }
            }
        });
    }
    $(document).on("click", ".rbtLunch", function () {
        if ($(this).val() === "on") {
            $("#setLunchDiv").slideDown();
            $("#set_lunch_time").prop('required', "true");
        } else {
            $("#setLunchDiv").slideUp();
            $("#set_lunch_time").removeAttr("required");
            $("#set_lunch_time").val("");
        }
    });
    $(document).on("click", ".rbtLunchTime", function () {
        if ($(this).val() === "on") {
            $("#rbtLunchTimeDiv").slideDown();
            $("#lunch_start_time").prop('required', "true");
            $("#lunch_end_time").prop('required', "true");
        } else {
            $("#rbtLunchTimeDiv").slideUp();
            $("#lunch_start_time").removeAttr("required");
            $("#lunch_end_time").removeAttr("required");
            $("#lunch_start_time").val("");
            $("#lunch_end_time").val("");
        }
    });
    $(document).on("click", ".rbtIllness", function () {
        if ($(this).val() === "off") {
            $("#illnessDivs").slideDown();
            $("#txt_custome_illness").prop('required', "true");
        } else {
            $("#illnessDivs").slideUp();
            $("#txt_custome_illness").removeAttr("required");
            $("#txt_custome_illness").val("");
        }
    });
    $(document).on("click", ".rbtTimeOff", function () {
        if ($(this).val() === "off") {
            $("#TimeOffDivs").slideDown();
            $("#txt_custome_deduct").prop('required', "true");
        } else {
            $("#TimeOffDivs").slideUp();
            $("#txt_custome_deduct").removeAttr("required");
            $("#txt_custome_deduct").val("");
        }
    });
    $(document).on("click", ".rbtSick", function () {
        if ($(this).val() === "off") {
            $("#sickDivs").slideDown();
            $("#txt_custome_sick").prop('required', "true");
        } else {
            $("#sickDivs").slideUp();
            $("#txt_custome_sick").removeAttr("required");
            $("#txt_custome_sick").val("");
        }
    });
    $(document).on("click", ".rbtJob", function () {
        if ($(this).val() === "off") {
            $("#jobDivs").slideDown();
            $("#txt_custome_job").prop('required', "true");
        } else {
            $("#jobDivs").slideUp();
            $("#txt_custome_job").removeAttr("required");
            $("#txt_custome_job").val("");
        }
    });
    $(document).on("click", ".rbtDayoff", function () {
        if ($(this).val() === "off") {
            $("#DayoffDivs").slideDown();
            $("#txt_custome_dayoff").prop('required', "true");
        } else {
            $("#DayoffDivs").slideUp();
            $("#txt_custome_dayoff").removeAttr("required");
            $("#txt_custome_dayoff").val("");
        }
    });
    $(document).ready(function () {
         setTimeout(function () {
            form_lunchsetting = $("#form_lunchsetting").serialize();
            form_karkaard = $("#form_karkaard").serialize();
            form_othersetting = $("#form_othersetting").serialize();
        }, 1000);
        bindLunchSettings();
        bindOtherSettings();
        bindKarkaardSettings();
        if ($("#rbtJobOff").is(":checked")) {
            $("#jobDivs").slideDown();
            $("#txt_custome_job").prop('required', "true");
        } else {
            $("#jobDivs").slideUp();
            $("#txt_custome_job").removeAttr("required");
            $("#txt_custome_job").val("");
        }
        if ($("#rbtIllnessOff").is(":checked")) {
            $("#illnessDivs").slideDown();
            $("#txt_custome_illness").prop('required', "true");
        } else {
            $("#illnessDivs").slideUp();
            $("#txt_custome_illness").removeAttr("required");
            $("#txt_custome_illness").val("");
        }
       

    });
//    $('.txtdefault').each(function () {
//
//        if ($(".txtdefault").is(':visible'))
//        {
//            $(".txtdefault").prop('required', "true");
//        } else {
//            $(".txtdefault").removeAttr("required");
//            $(".txtdefault").val("");
//        }
//    });
    $(document).on("change click", ".types", function ()
    {
        $('.types').prop('checked', "false");
        $(".types").removeAttr('checked');
        $('.types').parent('span').removeClass('checked');

        $(this).prop('checked', "true");
        $(this).parent('span').addClass('checked');
    });
</script>
<?php
// include _PATH . "instance/front/tpl/google_maps.js.php"; ?>