<?php include _PATH . "instance/front/tpl/libValidate.php" ?>
<script type="text/javascript">
    $(document).on('change ', "#selectgroup", function () {
//        alert($(this).val());
        var searchKey = $(this).val();
        BindEmployee(searchKey);
    });
    function BindEmployee(searchKey) {
        $.ajax({
            url: '<?php echo _U ?>company_settings',
            dataType: "json",
            data: {
                BindEmployee: 1,
                searchKey: searchKey
            }, success: function (r) {
//                $("#empDi").html(r);

//                alert(r.length);
                var contents = "";

                contents += "<option  value='*'>All</option>";
                $.each(r, function (i, item) {

                    contents += "<option value='" + item.id + "'>" + item.fname + " " + item.lname + "</option>";
//                    alert(i + " - " + item.id);
//                    $('#selectEmp').add($('<option>', {
//                        value: item.id,
//                        text: item.fname + " " + item.lname
//                    }));

//                    $('#selectEmp').append("<option>" + item.fname + " " + item.lname + "2</option>").attr("value", item.id);

//                    $('#selectEmp')
//                            .append($("<option></option>")
//                                    .attr("value", item.id)
//                                    .text(item.fname + " " + item.lname));

                });

//                var v = new MultiSelect.ad;
//                v.addOption(contents).constructor();
//                v.constructor();
                $('#selectEmp').html(contents);
                $('#selectEmp').multiSelect('refresh');

//                var r = v.prototype.constructor;


//                alert(contents);
//                contents +="</select>"

            }});
    }

    function shiftAllowClock() {
        var clockIn = $("#r_clockIn").val();
        var clockOut = $("#r_clockOut").val();
        if ($("#r_clockIn").val() === "") {
            $("#r_clockIn").focus();
            return;
        }
        if ($("#r_clockOut").val() === "") {
            $("#r_clockOut").focus();
            return;
        }
        $.ajax({
            url: '<?php echo _U ?>company_settings',
            dataType: "json",
            data: {
                shiftAllowClock: 1,
                clockIn: clockIn,
                clockOut: clockOut,
                selectEmp: $("#selectEmp").val(),
                selectGroup: $("#selectgroup").val()
            }, success: function (r) {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);
                } else {
                    _toast("danger", "Decliend", r.msg);
                }
//                bindAllSettings();
            }
        });
    }
    function workAllowHoliday() {
        var hTime = $("#h_time").val();
        if ($("#h_time").val() === "") {
            $("#h_time").focus();
            return;
        }
        $.ajax({
            url: '<?php echo _U ?>company_settings',
            dataType: "json",
            data: {
                workAllowHoliday: 1,
                selectEmp: $("#selectEmp").val(),
                hTime: hTime,
                selectGroup: $("#selectgroup").val()
            }, success: function (r) {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);
                } else {
                    _toast("danger", "Decliend", r.msg);
                }
//                bindAllSettings();
            }
        });

    }
    function toleranceAllowIn() {
        var t_clockIn = $("#t_clockIn").val();
        if ($("#t_clockIn").val() === "") {
            $("#t_clockIn").focus();
            return;
        }
        $.ajax({
            url: '<?php echo _U ?>company_settings',
            dataType: "json",
            data: {
                toleranceAllowIn: 1,
                t_clockIn: t_clockIn,
                selectEmp: $("#selectEmp").val(),
                selectGroup: $("#selectgroup").val()
            }, success: function (r) {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);
                } else {
                    _toast("danger", "Decliend", r.msg);
                }
//                bindAllSettings();
            }
        });

    }
    function toleranceAllowOut() {
        var t_clockOut = $("#t_clockOut").val();
        if ($("#t_clockOut").val() === "") {
            $("#t_clockOut").focus();
            return;
        }
        $.ajax({
            url: '<?php echo _U ?>company_settings',
            dataType: "json",
            data: {
                toleranceAllowOut: 1,
                t_clockOut: t_clockOut,
                selectEmp: $("#selectEmp").val(),
                selectGroup: $("#selectgroup").val()

            }, success: function (r) {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);
                } else {
                    _toast("danger", "Decliend", r.msg);
                }
//                bindAllSettings();
            }
        });

    }
    function tolerancePenalize() {
        var t_penalize = $("#t_penalize").val();
        if ($("#t_penalize").val() === "") {
            $("#t_penalize").focus();
            return;
        }
        $.ajax({
            url: '<?php echo _U ?>company_settings',
            dataType: "json",
            data: {
                tolerancePenalize: 1,
                t_penalize: t_penalize,
                selectEmp: $("#selectEmp").val(),
                selectGroup: $("#selectgroup").val()

            }, success: function (r) {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);
                } else {
                    _toast("danger", "Decliend", r.msg);
                }
//                bindAllSettings();
            }
        });

    }
    function allowPadiDayOff() {
        var paidDayOff = $("#paidDayOff").val();
        if ($("#paidDayOff").val() === "") {
            $("#paidDayOff").focus();
            return;
        }
        $.ajax({
            url: '<?php echo _U ?>company_settings',
            dataType: "json",
            data: {
                allowPadiDayOff: 1,
                paidDayOff: paidDayOff,
                selectEmp: $("#selectEmp").val(),
                selectGroup: $("#selectgroup").val()
            }, success: function (r) {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);
                } else {
                    _toast("danger", "Decliend", r.msg);
                }
//                bindAllSettings();
            }
        });

    }
    function allowvacationFalls() {
        var vacationFalls = $("#vacationFalls").val();
        if ($("#vacationFalls").val() === "") {
            $("#vacationFalls").focus();
            return;
        }
        $.ajax({
            url: '<?php echo _U ?>company_settings',
            dataType: "json",
            data: {
                allowvacationFalls: 1,
                vacationFalls: vacationFalls,
                selectEmp: $("#selectEmp").val(),
                selectGroup: $("#selectgroup").val()
            }, success: function (r) {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);
                } else {
                    _toast("danger", "Decliend", r.msg);
                }
//                bindAllSettings();
            }
        });

    }
    function allowsickDate() {
        var sickDate = $("#sickDate").val();
        if ($("#sickDate").val() === "") {
            $("#sickDate").focus();
            return;
        }
        $.ajax({
            url: '<?php echo _U ?>company_settings',
            dataType: "json",
            data: {
                allowsickDate: 1,
                sickDate: sickDate,
                selectEmp: $("#selectEmp").val(),
                selectGroup: $("#selectgroup").val()
            }, success: function (r) {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);
                } else {
                    _toast("danger", "Decliend", r.msg);
                }
//                bindAllSettings();
            }
        });

    }
    function allowsLunchBreak() {
//        alert($("input[type='radio'][name='LunchTo']:checked").val());
        var LunchValue = $("input[type='radio'][name='LunchTo']:checked").val();
        if (LunchValue == null) {
            $("#error_lunch").html("Please select Yes Or No");
//            alert(LunchValue);

            return;
        }

        $.ajax({
            url: '<?php echo _U ?>company_settings',
            dataType: "json",
            data: {
                allowLunchBreak: 1,
                islunch: LunchValue,
                selectEmp: $("#selectEmp").val(),
                selectGroup: $("#selectgroup").val()
            }, success: function (r) {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);
                } else {
                    _toast("danger", "Decliend", r.msg);
                }
//                bindAllSettings();
            }
        });

    }
    function bindAllSettings() {
        $.ajax({
            url: '<?php echo _U ?>company_settings',
            dataType: "json",
            data: {
                bindAllSettings: 1,
            }, success: function (r) {
                $("#r_clockIn").val(r.before_time);
                $("#r_clockOut").val(r.after_time);
                $("#h_time").val(r.holiday_time);
                if (r.before_time === "0" && r.after_time === "0") {
                    $("#rbtOTNo").prop("checked", true);
                } else {
                    $("#rbtOTYes").prop("checked", true);
                    $("#OTdiv").slideDown();
                }
                if (r.tolrance_timeIn === "0") {
                    $("#rbtTlNo").prop("checked", true);
                } else {
                    $("#rbtTlYes").prop("checked", true);
                    $("#TLDiv").slideDown();
                }
                if (r.tolrance_timeOut === "0") {
                    $("#rbtTeNo").prop("checked", true);
                } else {
                    $("#rbtTeYes").prop("checked", true);
                    $("#TEDiv").slideDown();
                }
                if (r.penalize === "0") {
                    $("#rbtPnNo").prop("checked", true);
                } else {
                    $("#rbtPnYes").prop("checked", true);
                    $("#PNDiv").slideDown();
                }
                $("#t_clockIn").val(r.tolrance_timeIn);
                $("#t_clockOut").val(r.tolrance_timeOut);
                $("#paidDayOff").val(r.paidDayOff);
                $("#vacationFalls").val(r.vacationDay);
                $("#sickDate").val(r.sick_day);
            }});
    }
    function UpdateResident(id) {
//        alert("UpdateResident");
        $.ajax({
            url: '<?php echo _U ?>company_settings',
            dataType: "json",
            data: {

                UpdateResident: 1,
                id: id,
                ladelData: $("#form_profile_resident").serialize()

            }, success: function (r) {
                if (r.success > 0) {
//                    $("#myModal2").close();
//                    $("#myModal2").modal('toggle');
//                    location.href = "<?= _U . $_SESSION['company']['default_page']; ?>";
//                    $("#myModal3").modal({backdrop: 'static', keyboard: false});
//                    $("#mod_4").css("display", "block");
                    _toast("success", "Approved", r.msg);
                } else {
                    _toast("warning", "Declind", r.msg);
//                    location.href = "<?= _U . 'login' ?>";
                }
            }});
    }

    function UpdateEmergency(id) {
//        alert("UpdateResident");
        $.ajax({
            url: '<?php echo _U ?>company_settings',
            dataType: "json",
            data: {

                UpdateEmergency: 1,
                id: id,
                ladelData: $("#form_profile_emergency").serialize()

            }, success: function (r) {
                if (r.success > 0) {
//                    $("#myModal2").close();
//                    $("#myModal2").modal('toggle');
//                    location.href = "<?= _U . $_SESSION['company']['default_page']; ?>";
//                    $("#myModal3").modal({backdrop: 'static', keyboard: false});
//                    $("#mod_4").css("display", "block");
                    _toast("success", "Approved", r.msg);
                } else {
                    _toast("warning", "Declind", r.msg);
//                    location.href = "<?= _U . 'login' ?>";
                }
            }});
    }
    function UpdatePreview(id) {
        if ($("#profile_pic").val() === "") {
            $("#profile_pic").focus();
            $("#profile_pic").click();
        } else {
//        

            var dataValue = new FormData($("#form_profile_pic")[0]);
            dataValue.append('UpdatePreview', '1');
            dataValue.append('id', id);
            $.ajax({
                url: '<?php echo _U ?>company_settings',
                type: 'POST',
                data: dataValue,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                dataType: 'json',
//                data: {
//
//                    UpdatePreview: 1,
//                    id: id,
////                    ladelData: $("#form_profile_pic").serialize()
////                    ladelData: dataValue
//
//                },
                success: function (r) {
                    if (r.success > 0) {
//                    $("#myModal2").close();
//                    $("#myModal2").modal('toggle');
//                    location.href = "<?= _U . $_SESSION['company']['default_page']; ?>";
//                    $("#myModal3").modal({backdrop: 'static', keyboard: false});
//                    $("#mod_4").css("display", "block");
                        $("#imgTeamProfilePhoto").attr('src', "docs/" + r.img);
                        $("#profile_pic").val("");
                        _toast("success", "Approved", r.msg);
                    } else {
                        _toast("warning", "Declind", r.msg);
//                    location.href = "<?= _U . 'login' ?>";
                    }
                }});
        }
    }
    function kioskchange(pin, id) {
//        alert("PIN=" + pin + " ID =" + id);
//        if (pin === "" && id === "")
        ajaxKisok(pin, id);
    }
    function ajaxKisok(pin, id) {
//        alert("AJAX CAll");
        $.ajax({
            url: '<?php echo _U ?>company_settings',
            dataType: "json",
            data: {

                kisokchange: 1,
                oldpin: pin,
                id: id

            }, success: function (r) {
                $("#k_pin").val(r);
            }});
    }
    $(document).ready(function () {
        $('.LunchTo').click(function () {
            $("#error_lunch").html("");
            
        });
        $('.rbtOT').click(function () {
            if ($(this).is(':checked') && $(this).val() === "Yes") {
                $("#OTdiv").slideDown();
            } else {
                $("#OTdiv").slideUp();
                $("#r_clockIn").val("0");
                $("#r_clockOut").val("0");
            }
        });
        $('.rbtTL').click(function () {
            if ($(this).is(':checked') && $(this).val() === "Yes") {
                $("#TLDiv").slideDown();
            } else {
                $("#TLDiv").slideUp();
                $("#t_clockIn").val("0");
            }
        });
        $('.rbtTE').click(function () {
            if ($(this).is(':checked') && $(this).val() === "Yes") {
                $("#TEDiv").slideDown();
            } else {

                $("#TEDiv").slideUp();
                $("#t_clockOut").val("0");
            }
        });
        $('.rbtPN').click(function () {
            if ($(this).is(':checked') && $(this).val() === "Yes") {
                $("#PNDiv").slideDown();
            } else {

                $("#PNDiv").slideUp();
                $("#t_penalize").val("0");
            }
        });
//        bindAllSettings();



//        setInterval(function(){
//        var Start_break_check = <?php echo json_encode($_SESSION["start_break"]); ?>;
//            if(Start_break_check == "" || Start_break_check == null){
//               // alert("hi");
//             }else{
//                 Break_time_update(Start_break_check);
//             }
//             
//          }, 6000);
<?php if ($_SESSION["shiftId"] != '') { ?>
            $('#start').hide();
            $('#start_break').show();
            $('#end').show();
            $("#startshiftdisplay").html("<div style='color: green;font-size: 16px;font-weight: bold;'><span>On Shift</span></div><div><span>Started<?php echo $_SESSION['Timecount']; ?></span></div>");
<?php } else { ?>
            $('#start').show();
            $('#end').hide();
            $('#start_break').hide();
            $('#end_break').hide();
            $("#startshiftdisplay").html("");
<?php } ?>
<?php if ($_SESSION["start_break"] != '') { ?>
            $('#end_break').show();
            $('#start_break').hide();
            $("#startshiftdisplay").html("<div style='color: green;font-size: 16px;font-weight: bold;'><span>On Break</span></div><div><span>break</span></div>");
<?php } else { ?>

<?php } ?>

        $("#divsDay").html("");
        var mon = $(this).datepicker('getDate');
        var st = new Date(mon);
//            alert(st.getUTCDate());

//            alert(st.getYear() + '-' + st.getMonth() + '-' + st.getDate());
        $.ajax({
            url: '<?php echo _U ?>company_settings',
            dataType: "json",
            data: {

                DivsDate: 1

            }, success: function (r) {
//                    alert(r.weeks);
                for (var i = 0; i < 7; i++) {

                    var t_status = r.status[i];
                    var t_data = r.weeks_month[i];
                    var t_id = r.weeks[i];
                    var t_dayname = r.dayname[i];
                    var t_dayno = r.dayno[i];
                    $("#divsDate").append("<div style='width:14.285%;float:left;text-align:center;'>" + t_data + "</div>");
                    $("#divsDay").append("<div class='tb_div weeks_divs' data-id=" + t_id + " id='" + t_id + "'>" + t_status + "</div>");
                }
            }
        });
    });

</script>