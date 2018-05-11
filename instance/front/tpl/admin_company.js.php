

<!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>js/jquery.timepicker.js"></script>-->

<!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/jquery.timepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/pikaday/css/pikaday.css"/>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/pikaday/pikaday.js"></script>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/pikaday/plugins/pikaday.jquery.js"></script>-->
<?php include _PATH . "instance/front/tpl/libValidate.php" ?>

<script>
   
    function cancel() {
        var id = $("#hid_id").val();
        $.ajax({
            url: "<?php echo _U ?>leave",
//            type: "post",
//            dataType: 'json',
            data: {
                cancelLeave: 1,
                id: id
            },
            success: function (r) {
                $("#leaveTabel").html(r);
                $("#myModal2").modal('toggle');
            }});
    }
    $('.totals').on('change', function () {
//        alert("OK");
        var sdate = $("#mf_date").val();
        var stime = $("#mf_time").val();
        var etime = $("#ml_time").val();
        var edate = $("#ml_date").val();
        if ($("#mf_date").val() === "") {
            $("#mf_date").focus();
        } else if ($("#ml_date").val() === "") {
            $("#ml_date").focus();
        } else {

        }
//        alert(sdate);
//        alert(edate);
        $.ajax({
            url: "<?php echo _U ?>leave",
//            type: "post",
            dataType: 'json',
            data: {
                TotalTime: 1,
                sdate: sdate,
                stime: stime,
                etime: etime,
                edate: edate
            },
            success: function (r) {
                $("#mlbl_total").text(r);
                $("#mhid_total").val(r);
            }});
    });
    function bindleave(id) {

//        alert(id);
        $("#myModal2").modal('show');

        $.ajax({
            url: '<?php echo _U ?>leave',
            dataType: "json",
            data: {

                getLeave: 1,
                id: id
            }, success: function (r) {

//                alert(r);
//                $("#myModal2").openModal();
//                $("#myModal2").modal("toggle");

                $("#txtnotes").text(r.notes);
                $("#f_date").val(r.f_day_date).change();
                $("#f_time").val(r.f_day_time).change();
                $("#l_date").val(r.l_day_date).change();
                $("#l_time").val(r.l_day_time).change();
                $("#leave_type").val(r.leave_type).change();
                $("#notifyby").val(r.notify_manager).change();
                $("#hid_id").val(r.id);
                $("#hid_total").val(r.total_day);
                $("#lbl_total").text(r.total_day);
                var st = r.status;
                var contents = "<button class='btn btn-default' type='button' data-dismiss='modal'>Close</button>";
                if (st === "1") {
                    contents += "  <button class='btn btn-danger '  type='button' name='cancelRequest' id='cancelRequest' onclick='cancel()'>Cancel Request</button>";

                } else if (st === "2") {

                } else {
                    contents += "<button class='btn btn-alert ' type='button' name='resubmit' id='resubmit'>Resubmit</button>";

                }
                $("#divbuttons").html(contents);

            }
        });
    }
</script>
<!--<script>
    jQuery.validator.addMethod("vehicle_type_valid", function (value, element) {
        if ($(".v_type:checked").length == 0)
            return false;
        else
            return true;
    }, "Please select type of complaint.");
    jQuery.validator.addMethod("regex", function (value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    }, "This value is not valid");
    jQuery.validator.addMethod("required_lic", function (value, element, regexp) {

        return ($("#veh_lic_no1").val() != '' && $("#veh_lic_no2").val() != '' && $("#veh_lic_no4").val() != '' &&
                $("#veh_lic_no1").val().indexOf('_') == -1 && $("#veh_lic_no2").val().indexOf('_') == -1 && $("#veh_lic_no4").val().indexOf('_') == -1);
    }, "This value is not valid");
    jQuery.validator.addMethod("onlynumber", function (value, element, regexp) {
        return (value.indexOf('_') == -1);
    }, "This value is not valid");
    $("#leave_form").validate({
        ignore: [],
        rules: {
            fName: {required: true, regex: '^[\u0020\u0600-\u06FF\s]+$'},
            lName: {required: true, regex: '^[\u0020\u0600-\u06FF\s]+$'},
            fatherName: {required: true, regex: '^[\u0020\u0600-\u06FF\s]+$'},
            email: {regex: '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$'},
            city: {regex: '^[\u0020\u0600-\u06FF\s]+$'},
            home_phone: {required: true, minlength: '10', maxlength: '13', onlynumber: true},
            melli_no: {required: true, minlength: '10', maxlength: '10'},
            post_code: {required: true, number: true, minlength: '10', maxlength: '10'},
            dob: {required: true, minlength: '10', maxlength: '10'},
            insurance_no: {number: true},
            home_address: {required: true, maxlength: '255'},
            em_fName: {required: true, regex: '^[\u0020\u0600-\u06FF\s]+$'},
            em_lName: {required: true, regex: '^[\u0020\u0600-\u06FF\s]+$'},
            em_phone: {required: true, minlength: '11', maxlength: '11'},
            phone: {required: true, minlength: '1', maxlength: '11', onlynumber: true},
            //veh_lic_no4: {required_lic: true},
            vin_no: {required: true, regex: '^[A-Za-z0-9]+$'},
            veh_card_no: {required: true, minlength: '8', maxlength: '8', regex: '^[0-9]'},
            v_type: {required: true},
            l_p_type: {required: true},
            cell_provider: {required: true},
            car_make: {required: true},
            car_year: {required: true},
            ddl_year: {required: true},
            ddl_month: {required: true},
            ddl_date: {required: true},
            gender: {required: true},
            marital_status: {required: true},
            lic_expr_year: {required: true},
            lic_expr_month: {required: true},
            lic_expr_date: {required: true},
            melli_expr_year: {required: true},
            melli_expr_month: {required: true},
            melli_expr_date: {required: true},
            insurance_expr_year: {required: true},
            insurance_expr_month: {required: true},
            insurance_expr_date: {required: true},
            dob_year: {required: true},
            dob_month: {required: true},
            dob_date: {required: true},
            smog_expr_year: {required: true},
            smog_expr_month: {required: true},
            smog_expr_date: {required: true},
            non_owner: {required: true}
        },
        messages: {
            fName: {required: '<span style="color:red;font-size:11px;">This value is required</span>', regex: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            lName: {required: '<span style="color:red;font-size:11px;">This value is required</span>', regex: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            fatherName: {required: '<span style="color:red;font-size:11px;">This value is required</span>', regex: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            email: {regex: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            city: {regex: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            melli_no: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            melli_ex_date: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            post_code: {required: '<span style="color:red;font-size:11px;">This value is required</span>', number: '<span style="color:red;font-size:11px;">This value is not valid</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            dob: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            bod_no: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            insurance_no: {number: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            insurance_date: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            home_address: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            home_phone: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', onlynumber: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            phone: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', onlynumber: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            em_fName: {required: '<span style="color:red;font-size:11px;">This value is required</span>', regex: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            em_lName: {required: '<span style="color:red;font-size:11px;">This value is required</span>', regex: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            em_phone: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            endine_no: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            veh_card_no: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', regex: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            vin_no: {required: '<span style="color:red;font-size:11px;">This value is required</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', regex: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            //veh_lic_no4: {required_lic: '<span style="color:red;font-size:11px;">This value is required</span>'},
            v_type: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            cell_provider: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            car_make: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            car_year: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            ddl_year: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            ddl_month: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            ddl_date: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            l_p_type: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            gender: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            marital_status: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            lic_expr_year: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            lic_expr_month: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            lic_expr_date: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            melli_expr_year: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            melli_expr_month: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            melli_expr_date: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            insurance_expr_year: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            insurance_expr_month: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            insurance_expr_date: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            dob_year: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            dob_month: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            dob_date: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            smog_expr_year: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            smog_expr_month: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            smog_expr_date: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            non_owner: {required: '<span style="color:red;font-size:11px;">This value is required</span>'}
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "v_type") {
                error.insertAfter($('#errorbox_vehicle_type'));
            } else if (element.attr("name") == "l_p_type") {
                error.insertAfter($('#errorbox_license_plate_type'));
            } else if (element.attr("name") == "gender") {
                error.insertAfter($('#errorbox_gender'));
            } else if (element.attr("name") == "marital_status") {
                error.insertAfter($('#errorbox_marital_status'));
            } else if (element.attr("name") == "rd_subcat") {
                error.insertAfter($('#errorbox_subcat'));
            } else if (element.attr("name") == "chk_dept[]") {
                error.insertAfter($('#errorbox_dept'));
            } else if (element.attr("name") == "veh_lic_no4") {
                console.log(element.attr("name"));
                error.insertAfter($('#errorbox_vln'));
            } else if (element.attr("name") == "non_owner") {
                error.insertAfter($('#errorbox_non_owner'));
            } else {
                error.insertAfter(element);
            }
        }
    });
    function LicensePlate1Change(event) {
        return;
        last_char = $("#veh_lic_no1").val().substr(3, 1);
        if (last_char != '_' && event.keyCode != 8 && event.keyCode != 9 && event.keyCode != 16 && event.keyCode != 17 && event.keyCode != 20 && event.keyCode != 37 && event.keyCode != 38 && event.keyCode != 39 && event.keyCode != 40) {
            $("#veh_lic_no2").focus();
        }

    }
    function LicensePlate2Change(event) {
        return;
        last_char = $("#veh_lic_no2").val().substr(3, 1);
        if (last_char != '_' && event.keyCode != 8 && event.keyCode != 9 && event.keyCode != 16 && event.keyCode != 17 && event.keyCode != 20 && event.keyCode != 37 && event.keyCode != 38 && event.keyCode != 39 && event.keyCode != 40) {
            $("#veh_lic_no3").focus();
        }
    }
    function LicensePlate3Change(event) {
        return;
        char_len = $("#veh_lic_no3").val().length;
        if (char_len == 1 && event.keyCode != 8 && event.keyCode != 9 && event.keyCode != 16 && event.keyCode != 17 && event.keyCode != 20 && event.keyCode != 37 && event.keyCode != 38 && event.keyCode != 39 && event.keyCode != 40) {
            $("#veh_lic_no4").focus();
        }
    }
    function LicensePlate4Change() {
        return;
        last_char = $("#veh_lic_no4").val().substr(4, 1);
        if (last_char == '_' && event.keyCode == 8 && event.keyCode == 9 && event.keyCode == 16 && event.keyCode == 17 && event.keyCode == 20 && event.keyCode == 37 && event.keyCode == 38 && event.keyCode == 39 && event.keyCode == 40) {
            $("#veh_lic_no4").focus();
        }
    }
    function checkDuplication()
    {
        $.ajax({
            url: '<?php echo _U ?>leave',
            dataType: "json",
            data: {

                duplication: 1,
                phoneno: $("#phone").val(),
                mellino: $("#melli_no").val(),
                veh_lic_no1: $("#veh_lic_no1").val(),
                veh_lic_no2: $("#veh_lic_no1").val(),
                veh_lic_no3: $("#veh_lic_no3").val(),
                veh_lic_no4: $("#veh_lic_no4").val()
            }, success: function (r) {
                if (r.success == '1') {
                    $("#leave_form").submit();
                } else {
                    $('#warning_msg2').css("display", "");
                    $('#duplicate_msg2').html(r.msg);
                    if (r.duplicate == "m" || r.duplicate == "p") {
                        $("#phone").focus();
                        $('#phone').css('background', '#FFCDD2');
                        if (r.duplicate == "m") {
                            $('#melli_no').css('background', '#FFCDD2');
                        }
                        $('#warning_msg2').css("display", "");
                    }
                    if (r.duplicate == "p") {
                        $("#phone").focus();
                        $('#phone').css('background', '#FFCDD2');
                        $('#warning_msg2').css("display", "");
                    }
                    if (r.duplicate == "m") {
                        $("#melli_no").focus();
                        $('#melli_no').css('background', '#FFCDD2');
                        $('#warning_msg2').css("display", "");
                    }
                    if (r.duplicate == "l") {
                        $("#veh_lic_no1").focus();
                        $('#veh_lic_no1').css('background', '#FFCDD2');
                        $('#veh_lic_no2').css('background', '#FFCDD2');
                        $('#veh_lic_no3').css('background', '#FFCDD2');
                        $('#veh_lic_no4').css('background', '#FFCDD2');
                        $('#warning_msg2').css("display", "");
                    }
                    $('#modal1').css("dismissible", "false");
//                    $('#modal1').leanModal({dismissible: false});

                }
            }
        }
        );
    }
    function checkLicPlate()
    {
        var vlp1 = $("#veh_lic_no1").val();
        var vlp2 = $("#veh_lic_no2").val();
        var vlp4 = $("#veh_lic_no4").val();
        var v1 = $("#veh_lic_no1").val().indexOf('_');
        var v2 = $("#veh_lic_no2").val().indexOf('_');

        var v4 = $("#veh_lic_no4").val().indexOf('_');

        if ((v1 < 2 && v1 > 0) || (v2 < 2 && v2 > 0) || (v4 < 3 && v4 > 0)) {
            $("#errorbox_vln").show();
            $("#errorbox_vln").html('<span style="color:red;font-size:11px;">This value is required</span>');

            return false;

        }
        if ((vlp1 == "" || vlp1 == null) || (vlp2 == "" || vlp2 == null) || (vlp4 == "" || vlp4 == null)) {
            $("#errorbox_vln").show();
            $("#errorbox_vln").html('<span style="color:red;font-size:11px;">This value is required</span>');
            return false;

        } else {
            $("#errorbox_vln").hide();
            return true;

        }


    }
</script>-->

<script type="text/javascript">
//    alert("Call");
    $('#datatable-responsive').DataTable({
        responsive: true
    });
    $('.dataTables_filter input').attr("placeholder", "Search...");
    $(document).ready(function () {


<?php if ($success == "1") { ?>
            Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>
<?php if ($success == "-1") { ?>
            Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>
<?php if ($model == "1") { ?>
            //            Materialize.toast('<?= $msg; ?>', 4000);
            $('#duplicate_msg').html('<?= $msg ?>');
            $('#modal_alert').openModal();
<?php } ?>
<?php if ($model == "-1") { ?>
            //            Materialize.toast('<?= $msg; ?>', 4000);
            $('#modal_alert').openModal();
<?php } ?>

        /*
         Default
         */

//        window.pd = $("#inlineDatepicker").persianDatepicker({
//            timePicker: {
//                enabled: true
//            },
//            altField: '#inlineDatepickerAlt',
//            altFormat: "YYYY MM DD HH:mm:ss",
////            minDate:1258675200000,
////            maxDate:1358675200000,
//            checkDate: function (unix) {
//                var output = true;
//                var d = new persianDate(unix);
//                if (d.date() == 20) {
//                    output = false;
//                }
//                return output;
//            },
//            checkMonth: function (month) {
//                var output = true;
//                if (month == 1) {
//                    output = false;
//                }
//                return output;
//            }, checkYear: function (year) {
//                var output = true;
//                if (year == 1396) {
//                    output = false;
//                }
//                return output;
//            }
//
//        }).data('datepicker');
//        $("#inlineDatepicker").pDatepicker("setDate", [1391, 12, 1, 11, 14]);
//        //pd.setDate([1333,12,28,11,20,30]);
//
//        /**
//         * Default
//         * */
//        $('#default').persianDatepicker({
//            altField: '#defaultAlt'
//
//        });
//        /*
//         observer
//         */
//        $(".observer").persianDatepicker({
//            altField: '#observerAlt',
//            altFormat: "YYYY MM DD HH:mm:ss",
//            observer: true,
//            format: 'YYYY/MM/DD'
//
//        });
//        /*
//         timepicker
//         */
//        $("#timepicker").persianDatepicker({
//            altField: '#timepickerAltField',
//            altFormat: "YYYY MM DD HH:mm:ss",
//            format: "HH:mm:ss a",
//            onlyTimePicker: true
//
//        });
//        /*
//         month
//         */
//        $("#monthpicker").persianDatepicker({
//            format: " MMMM YYYY",
//            altField: '#monthpickerAlt',
//            altFormat: "YYYY MM DD HH:mm:ss",
//            yearPicker: {
//                enabled: false
//            },
//            monthPicker: {
//                enabled: true
//            },
//            dayPicker: {
//                enabled: false
//            }
//        });
//        /*
//         year
//         */
//        $("#yearpicker").persianDatepicker({
//            format: "YYYY",
//            altField: '#yearpickerAlt',
//            altFormat: "YYYY MM DD HH:mm:ss",
//            dayPicker: {
//                enabled: false
//            },
//            monthPicker: {
//                enabled: false
//            },
//            yearPicker: {
//                enabled: true
//            }
//        });
//        /*
//         year and month
//         */
//        $("#yearAndMonthpicker").persianDatepicker({
//            format: "YYYY MM",
//            altFormat: "YYYY MM DD HH:mm:ss",
//            altField: '#yearAndMonthpickerAlt',
//            dayPicker: {
//                enabled: false
//            },
//            monthPicker: {
//                enabled: true
//            },
//            yearPicker: {
//                enabled: true
//            }
//        });
//        /**
//         inline with minDate and maxDate
//         */
//        $("#inlineDatepickerWithMinMax").persianDatepicker({
//            altField: '#inlineDatepickerWithMinMaxAlt',
//            altFormat: "YYYY MM DD HH:mm:ss",
//            minDate: 1416983467029,
//            maxDate: 1419983467029
//        });
//        /**
//         Custom Disable Date
//         */
//        $("#customDisabled").persianDatepicker({
//            timePicker: {
//                enabled: true
//            },
//            altField: '#customDisabledAlt',
//            checkDate: function (unix) {
//                var output = true;
//                var d = new persianDate(unix);
//                if (d.date() == 20 | d.date() == 21 | d.date() == 22) {
//                    output = false;
//                }
//                return output;
//            },
//            checkMonth: function (month) {
//                var output = true;
//                if (month == 1) {
//                    output = false;
//                }
//                return output;
//            }, checkYear: function (year) {
//                var output = true;
//                if (year == 1396) {
//                    output = false;
//                }
//                return output;
//            }
//
//        });
//        /**
//         persianDate
//         */
//        $("#persianDigit").persianDatepicker({
//            altField: '#persianDigitAlt',
//            altFormat: "YYYY MM DD HH:mm:ss",
//            persianDigit: false
//        });

    });
//    function IsFarsi(txb)
//    {
////        txb.value = txb.value.replace(/^[\u0600-\u06FF\s]+$/ , "");
//        var p = var p = /^[\u0600-\u06FF\s]+$/;
//        if (!p.test(txb)) {
////            alert("not format");
//            txb.value = "";
//        }
//    }
//    function changeFocus(txb) {
//        if (txb.length > 4) {
//            $('#veh_lic_no2').focus();
//        }
//    }
//    function goClear() {
//        return false;
////        $('#modal_warning').closeModal();
//        $("#ddl_year").val("Year").change();
//        $("#ddl_month").val("Month").change();
//        $("#ddl_date").val("Date").change();
//    }
    function goFocus()
    {
<?php if ($fs_mod == 'pml' || $fs_mod == 'pl' || $fs_mod == 'pm' || $fs_mod == 'p') { ?>
            $('#phone').focus();
    <?php if ($fs_mod == 'p') { ?>
                $('#phone').css('background', '#FFCDD2');
    <?php } ?>
    <?php if ($fs_mod == 'pm') { ?>
                $('#phone').css('background', '#FFCDD2');
                $('#melli_no').css('background', '#FFCDD2');
    <?php } ?>
    <?php if ($fs_mod == 'pl') { ?>
                $('#phone').css('background', '#FFCDD2');
                $('#veh_lic_no').css('background', '#FFCDD2');
    <?php } ?>
    <?php if ($fs_mod == 'pml') { ?>
                $('#phone').css('background', '#FFCDD2');
                $('#melli_no').css('background', '#FFCDD2');
                $('#veh_lic_no').css('background', '#FFCDD2');
    <?php } ?>

<?php } ?>
<?php if ($fs_mod == 'ml' || $fs_mod == 'm') { ?>
            $('#melli_no').focus();
    <?php if ($fs_mod == 'm') { ?>

                $('#melli_no').css('background', '#FFCDD2');
    <?php } ?>
    <?php if ($fs_mod == 'ml') { ?>
                $('#melli_no').css('background', '#FFCDD2');
                $('#veh_lic_no').css('background', '#FFCDD2');
    <?php } ?>
<?php } ?>
<?php if ($fs_mod == 'l') { ?>
            //            $('#veh_lic_no').focus();
            //            $('#veh_lic_no').css('background', '#FFCDD2');
<?php } ?>

    }


//    function _compareDate(dateString) {
//
//        var selectedDate = new Date(dateString);
//        gm =<?= $p_Month ?>;
//        gd =<?= $p_Day ?>;
//        gy =<?= $p_Year ?>;
//        var SysdateString = gm + "/" + gd + "/" + gy;
////        var now = new Date();
//        var sDate = new Date(SysdateString);
//        //alert("Selected date= " + selectedDate + "Now  Sys Date =" + sDate);
////        jalaali.toJalaali(2016, 4, 11);
////        var now = new Date("4/5/1400");
//        var d1 = Date.parse(selectedDate);
//        sDate.setHours(0, 0, 0, 0);
//        sDate.getDate() + 1;
//
//        var d2 = Date.parse(sDate);
//        console.log(d1 / 1000);
//        console.log(d2 / 1000);
//
////        selectedDate1 = d1 / 1000;
////        now1 = d2 / 1000;
////        var now_date = now.toISOString();
//        if (selectedDate < sDate) {
//
//            return false;
//        } else {
//
//            return true;
//        }
//    }

//    function checkDDLYear() {
//        var month = $("#ddl_month").val();
//        var day = $("#ddl_date").val();
//        var year = $("#ddl_year").val();
//
//        if (month == null && day == null) {
//            $("#ddl_month").focus();
//        }
//        if (month == null) {
//            $("#ddl_month").focus();
//        }
//        if (day == null) {
//            $("#ddl_date").focus();
//        }
//        var GD = toGregorian(parseInt(year), parseInt(month), parseInt(day));
//
//        var dateString = GD.gm + "/" + GD.gd + "/" + GD.gy;
////        alert(dateString);
//        console.log(GD);
////        var dateString = month + "/" + day + "/" + year;
////        alert(dateString);
//        if (_compareDate(dateString)) {
////            console.log("future date");
////            alert("future date");
//
//        } else {
//
////            console.log("past date");
////            alert('Invalid <?php print _t('31', 'License Expiry Date') ?>\nKindly select the future date');
//            $('#title_warning').text('Invalid <?php print _t('31', 'License Expiry Date') ?>');
////            ("Invalid License Expire Date");
//
//            $('#modal_warning').openModal({dismissible: false});
//        }
//
//    }
//    function checkDDLMonth() {
//        var month = $("#ddl_month").val();
//        var day = $("#ddl_date").val();
//        var year = $("#ddl_year").val();
//
//        if (year == null && day == null) {
//            $("#ddl_year").focus();
//        }
//        if (year == null) {
//            $("#ddl_year").focus();
//        }
//        if (day == null) {
//            $("#ddl_date").focus();
//        }
//        var GD = toGregorian(parseInt(year), parseInt(month), parseInt(day));
//
//        var dateString = GD.gm + "/" + GD.gd + "/" + GD.gy;
////        alert(dateString);
//        console.log(GD);
////        var dateString = month + "/" + day + "/" + year;
////        alert(dateString);
//        if (_compareDate(dateString)) {
////            console.log("future date");
////            alert("future date");
//
//        } else {
//
////            console.log("past date");
////            alert('Invalid <?php print _t('31', 'License Expiry Date') ?>\nKindly select the future date');
//            $('#title_warning').text('Invalid <?php print _t('31', 'License Expiry Date') ?>');
////            ("Invalid License Expire Date");
//            $('#modal_warning').openModal({dismissible: false});
//        }
//
//    }
//    function doCheckLiceDate() {
//
//        var month = $("#ddl_month").val();
//        var day = $("#ddl_date").val();
//        var year = $("#ddl_year").val();
//        if (month == "" && year == "")
//        {
//            $("#ddl_year").focus();
//        }
//        if (year == "") {
//            $("#ddl_year").focus();
//        }
//        if (month == "") {
//            $("#ddl_month").focus();
//        }
//
//        var GD = toGregorian(parseInt(year), parseInt(month), parseInt(day));
//
//        var dateString = GD.gm + "/" + GD.gd + "/" + GD.gy;
////        alert(dateString);
//        console.log(GD);
//
//        if (_compareDate(dateString)) {
////            console.log("future date");
////            alert("future date");
//
//        } else {
//
////            console.log("past date");
////            alert("past date");
//            $('#title_warning').text('Invalid <?php print _t('31', 'License Expiry Date') ?>');
////            ("Invalid License Expire Date");
//            $('#modal_warning').openModal({dismissible: false});
//        }
//    }
    function HomephoneValidate() {
        var cell = $("#home_phone").val();
        var cell_under = cell.indexOf("_");
//        alert(cell);
//        alert(cell.indexOf("_"));
        if (cell_under < 14 && cell_under > 0) {
            $("#home_phone").focus();
            $("#home_phone").css('background', '#FFCDD2');
        } else {
            $("#home_phone").css('background', '#F1F8E9');
        }
    }
    function start_end_time()
    {
        $.ajax({
            url: '<?php echo _U ?>leave',
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
    $('#car_make').change(function () {
        var value = $(this).val();
        if (value == "other") {
            $('#select_make_model_other').slideDown();
            return;
        } else
        {
            $('#select_make_model_other').slideUp();
        }

    });

//    $(function () {
//        $("#vin_no").on("keyup blur", function () {
//            if (validateVin($("#vin_no").val()))
//                alert("That's a VIN"););
//            else
//               alert("Not a VIN");
//        });
//    });
//
//    function validateVin(vin) {
//        var re = new RegExp("^[A-HJ-NPR-Z\\d]{8}[\\dX][A-HJ-NPR-Z\\d]{2}\\d{6}$");
//        return vin.match(re);
//    }
    function phoneValidate() {
        var cell = $("#phone").val();
        var cell_under = cell.indexOf("_");
//        alert(cell);
//        alert(cell.indexOf("_"));
        if (cell_under < 14 && cell_under > 0) {
            $("#phone").focus();
            $("#phone").css('background', '#FFCDD2');
        } else {
            $("#phone").css('background', '');
        }
    }
//    function LC1(name) {
//		return;
//        var LicencePlate = $("#" + name).val();
//        var LicencePlate_under = LicencePlate.indexOf("_");
//
//        if (LicencePlate_under < 2) {
////             alert("Value = " + LicencePlate_under);
//            $("#" + name).focus();
//            $("#" + name).css('background', '#FFCDD2');
//            $("#errorbox_vln").show();
//            $("#errorbox_vln").html('<span style="color:red;font-size:11px;">This value is required</span>');
//
////             false;
//        } else {
//            $("#" + name).css('background', '');
//            $("#errorbox_vln").hide();
////            return true;
//        }
//        return;
//    }
//    function LC4(name) {
//		return;
//        var LicencePlate = $("#" + name).val();
//        var LicencePlate_under = LicencePlate.indexOf("_");
//        if (LicencePlate_under < 3 && LicencePlate_under > 0) {
//            $("#" + name).focus();
//            $("#" + name).css('background', '#FFCDD2');
//            $("#errorbox_vln").show();
//            $("#errorbox_vln").html('<span style="color:red;font-size:11px;">This value is required</span>');
//            return false;
//        } else {
//            $("#" + name).css('background', '');
//            $("#errorbox_vln").hide();
//            return true;
//        }
//    }
    $('#color_id').change(function () {
        var value = $(this).val();
        if (value.indexOf("other") != -1) {
            $('#select_color_other').slideDown();
        } else {
            $('#select_color_other').slideUp();
        }
    });
    function changePhoneNumber() {
        var cell = $("#phone").val();
        var cell_initial = cell.replace(/09/g, '');
        cell_initial = cell_initial.substr(0, 2);
        if (cell_initial == '01' || cell_initial == '02' || cell_initial == '03') {
            $("#cell_provider").val("Irancell");
        } else if (cell_initial == '32') {
            $("#cell_provider").val("Talia");
        } else {
            cell_initial = cell_initial.substr(0, 1);
            if (cell_initial == '1' || cell_initial == '9') {
                $("#cell_provider").val("Hamrah Aval");
            } else if (cell_initial == '3') {
                $("#cell_provider").val("Irancell");
            } else if (cell_initial == '2') {
                $("#cell_provider").val("Ritetell");
            }
        }
    }

    function Validate()
    {

        var y = document.leave.phone.value;
        if (isNaN(x) || x.indexOf(" ") != -1)
        {
            alert("Enter numeric value")
            return false;
        }
        if (x.length > 8)
        {
            alert("enter 8 characters");
            return false;
        }
        if (x.charAt(0) != "2")
        {
            alert("it should start with 2 ");
            return false
        }

        if (isNaN(y) || y.indexOf(" ") != -1)
        {
            alert("Enter numeric value")
            return false;
        }
        if (y.length > 10)
        {
            alert("enter 10 characters");
            return false;
        }
        if (y.charAt(0) != "0" || y.charAt(1) != "9")
        {
            alert("it should start with 09 ");
            return false
        }
    }
</script>
<script type="text/javascript">
//    showWait();


    $('#fName').autocomplete({
        source: function (request, response) {
            $.ajax({
                url: '<?php echo _U ?>leave',
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
//        $('#leave_form').parsley().on('field:validated', function () {
//
//        }).on('form:submit', function () {
//            return true;
//            if ($('.parsley-error').length === 0) {
//                //showWait();
//                return true;
//            }
//            return false; // Don't submit form for this demo
//        });
//    setTimeout(_doLoadDynamicDays, 2000);
//    $('.clockpicker').clockpicker({
//        placement: 'bottom',
//        align: 'left',
//        autoclose: true,
//        'default': 'now'
//    });
//    $(".clockpicker1").timepicker();
//    $('.datepicker').pickadate({
//        min: new Date(),
////        onSet: function () {
////            setTimeout(this.close, 0);
////        }
////        max: new Date(2016,12, 14)
//    });
    $("#leaveCardPanel").removeClass("panelWait");
    hideWait();
    function initMap() {
        $(".gMapSuggest").each(function (i, v) {
            new google.maps.places.Autocomplete(document.getElementById($(v).attr("id")));
        });
    }

    function showMoreVehicle(id) {
        $("#more_vehicle_" + id).show();
    }
    function showMoreDay(id) {
        $("#_header_" + id).click().parent().show();
    }

    function vehicleSelected(id) {
        console.log(id);
        var selectedValue = $("#vehicle_selection_box_" + id).val();
        if (selectedValue == 'other') {
            $("#vehicle_selection_custom_" + id).show();
        } else {
            $("#vehicle_selection_custom_" + id).hide().val("");
        }
        var min_hours = $("#vehicle_selection_box_" + id + " option:selected").data('minhour');
        var rate = $("#vehicle_selection_box_" + id + " option:selected").data('rate');
        $("#vehicle_selection_hours_" + id).val(min_hours);
        $("#vehicle_selection_rate_" + id).val(rate);
        console.log("#vehicle_selection_rate_" + id);
        //$("#vehicle_selection_total_" + id).val('1');

    }
    function vehicleOptionSelected(id) {
        var selectedValue = $("#vehicle_selection_box" + id).val();
        if (selectedValue == 'other') {
            $("#vehicle_selection_custom" + id).show();
        } else {
            $("#vehicle_selection_custom" + id).hide().val("");
        }
        var min_hours = $("#vehicle_selection_box" + id + " option:selected").data('minhour');
        var rate = $("#vehicle_selection_box" + id + " option:selected").data('rate');
        $("#vehicle_selection_hours" + id).val(min_hours);
        $("#vehicle_selection_rate" + id).val(rate);
        //$("#vehicle_selection_total_" + id).val('1');

    }

    function rateSelected(id) {
        var selectedValue = $("#vehicle_selection_rate_type_" + id).val();
        var helpText = selectedValue == 'hourly' ? 'Hourly Rate' : "Flat Rate";
        $("#vehicle_selection_rate_" + id).next().html(helpText).css({color: 'red'});
    }
    function rateOptionSelected(id) {
        var selectedValue = $("#vehicle_selection_rate_type" + id).val();
        var helpText = selectedValue == 'hourly' ? 'Hourly Rate' : "Flat Rate";
        $("#vehicle_selection_rate" + id).next().html(helpText).css({color: 'red'});
    }

    function addStop(id) {
        $(".stop_div_" + id).show('slow');
    }

    function addCharge(id) {
        $("#charge" + id).show('slow');
    }

    function addOption(day, vehicle, id) {
        $("#option_" + day + "_" + vehicle + "_" + id).show();
    }



    $(".rd-bcr").click(function e() {
        if ($(this).val() == '1') {
            $('#div_upload_doc').slideDown();
        } else {
            $('#div_upload_doc').slideUp();
        }
    });
    $(".rd-permit-a").click(function e() {
        if ($(this).val() == '1') {
            $('#div_permit_expire_date').slideDown();
        } else {
            $('#div_permit_expire_date').slideUp();
        }
    });
    $("#veh_lic_no1,#veh_lic_no2").keyup(function e() {
        //$("#veh_lic_no4").blur();
    });
    function checkFarsiDate() {
        var month = $("#ddl_month").val();
        var day = $("#ddl_date").val();
        var year = $("#ddl_year").val();
        if (month == '' || day == '' || year == '') {
            return false;
        }

//        confirm(<?= $p_Month, $p_Day, $p_Year; ?>);
//        var GD = toGregorian(parseInt(year), parseInt(month), parseInt(day));


//        var dateString = GD.gm + "/" + GD.gd + "/" + GD.gy;
        var dateString = month + "/" + day + "/" + year;
//        confirm(dateString);
        if (_compareDate(dateString)) {
//        if (month >= gm && day > gd && year >= gy) {
            return true;
        } else {
            $('#title_warning').text('Invalid <?php print _t('31', 'License Expiry Date') ?>');
            $('#warnMsg').text('<?php print _t('344', 'Kindly select the future date') ?>');
//            ("Invalid License Expire Date");
            $("#yearName").val("ddl_year");
            $("#monthName").val("ddl_month");
            $("#dateName").val("ddl_date");
            $('#modal_warning').openModal({dismissible: false});
            return false;
        }
    }

    function goClear() {
        var y = $("#yearName").val();
        var m = $("#monthName").val();
        var d = $("#dateName").val();
        $("#" + y).val("<?php print _t('281', 'Year') ?>").change();
        $("#" + m).val("<?php print _t('282', 'Month') ?>").change();
        $("#" + d).val("<?php print _t('283', 'Day') ?>").change();
        $("#" + y).focus();
    }
    function checkLICFarsiDate() {
        var month = $("#lic_expr_month").val();
        var day = $("#lic_expr_date").val();
        var year = $("#lic_expr_year").val();
        if (month == '' || day == '' || year == '') {
            return false;
        }

//        confirm(<?= $p_Month, $p_Day, $p_Year; ?>);
//        var GD = toGregorian(parseInt(year), parseInt(month), parseInt(day));


//        var dateString = GD.gm + "/" + GD.gd + "/" + GD.gy;
        var dateString = month + "/" + day + "/" + year;
//        confirm(dateString);
        if (_compareDate(dateString)) {
//        if (month >= gm && day > gd && year >= gy) {
            return true;
        } else {
            $('#title_warning').text('Invalid <?php print _t('31', 'License Expiry Date') ?>');
            $('#warnMsg').text('<?php print _t('344', 'Kindly select the future date') ?>');
//            ("Invalid License Expire Date");
            $("#yearName").val("lic_expr_year");
            $("#monthName").val("lic_expr_month");
            $("#dateName").val("lic_expr_date");
            $('#modal_warning').openModal({dismissible: false});
            return false;
        }
    }
    function checkMELLIFarsiDate() {
        var month = $("#melli_expr_month").val();
        var day = $("#melli_expr_date").val();
        var year = $("#melli_expr_year").val();
        if (month == '' || day == '' || year == '') {
            return false;
        }

//        confirm(<?= $p_Month, $p_Day, $p_Year; ?>);
//        var GD = toGregorian(parseInt(year), parseInt(month), parseInt(day));


//        var dateString = GD.gm + "/" + GD.gd + "/" + GD.gy;
        var dateString = month + "/" + day + "/" + year;
//        confirm(dateString);
        if (_compareDate(dateString)) {
//        if (month >= gm && day > gd && year >= gy) {
            return true;
        } else {
            $('#title_warning').text('Invalid <?php print _t('100', 'Melli-Expiration-Date') ?>');
            $('#warnMsg').text('<?php print _t('344', 'Kindly select the future date') ?>');
//            ("Invalid License Expire Date");
            $("#yearName").val("melli_expr_year");
            $("#monthName").val("melli_expr_month");
            $("#dateName").val("melli_expr_date");
            $('#modal_warning').openModal({dismissible: false});
            return false;
        }
    }
    function checkINSUFarsiDate() {
        var month = $("#insurance_expr_month").val();
        var day = $("#insurance_expr_date").val();
        var year = $("#insurance_expr_year").val();
        if (month == '' || day == '' || year == '') {
            return false;
        }

//        confirm(<?= $p_Month, $p_Day, $p_Year; ?>);
//        var GD = toGregorian(parseInt(year), parseInt(month), parseInt(day));


//        var dateString = GD.gm + "/" + GD.gd + "/" + GD.gy;
        var dateString = month + "/" + day + "/" + year;
//        confirm(dateString);
        if (_compareDate(dateString)) {
//        if (month >= gm && day > gd && year >= gy) {
            return true;
        } else {
            $('#title_warning').text('Invalid <?php print _t('110', 'Insurance-Expiration-Date') ?>');
            $('#warnMsg').text('<?php print _t('344', 'Kindly select the future date') ?>');
//            ("Invalid License Expire Date");
            $("#yearName").val("insurance_expr_year");
            $("#monthName").val("insurance_expr_month");
            $("#dateName").val("insurance_expr_date");
            $('#modal_warning').openModal({dismissible: false});
            return false;
        }
    }
    function checkSmogFarsiDate() {
        var month = $("#smog_expr_month").val();
        var day = $("#smog_expr_date").val();
        var year = $("#smog_expr_year").val();
        if (month == '' || day == '' || year == '') {
            return false;
        }

//        confirm(<?= $p_Month, $p_Day, $p_Year; ?>);
//        var GD = toGregorian(parseInt(year), parseInt(month), parseInt(day));


//        var dateString = GD.gm + "/" + GD.gd + "/" + GD.gy;
        var dateString = month + "/" + day + "/" + year;
//        confirm(dateString);
        if (_compareDate(dateString)) {
//        if (month >= gm && day > gd && year >= gy) {
            return true;
        } else {
            $('#title_warning').text('Invalid <?php print _t('', 'Smog-Expiration-Date') ?>');
            $('#warnMsg').text('<?php print _t('344', 'Kindly select the future date') ?>');
//            ("Invalid License Expire Date");
            $("#yearName").val("smog_expr_year");
            $("#monthName").val("smog_expr_month");
            $("#dateName").val("smog_expr_date");
            $('#modal_warning').openModal({dismissible: false});
            return false;
        }
    }
    function checkPERMITENDFarsiDate() {
        var month = $("#permit_end_month").val();
        var day = $("#permit_end_date").val();
        var year = $("#permit_end_year").val();
        if (month == '' || day == '' || year == '') {
            return false;
        }

//        confirm(<?= $p_Month, $p_Day, $p_Year; ?>);
//        var GD = toGregorian(parseInt(year), parseInt(month), parseInt(day));


//        var dateString = GD.gm + "/" + GD.gd + "/" + GD.gy;
        var dateString = month + "/" + day + "/" + year;
//        confirm(dateString);
        if (_compareDate(dateString)) {
//        if (month >= gm && day > gd && year >= gy) {
            return true;
        } else {
            $('#title_warning').text('Invalid <?php print _t('21', 'Permit Expiry Date') ?>');
            $('#warnMsg').text('<?php print _t('344', 'Kindly select the future date') ?>');
//            ("Invalid License Expire Date");
            $("#yearName").val("permit_end_year");
            $("#monthName").val("permit_end_month");
            $("#dateName").val("permit_end_date");
            $('#modal_warning').openModal({dismissible: false});
            return false;
        }
    }
    function checkContractFarsiDate() {
        var month = $("#con_expr_month").val();
        var day = $("#con_expr_date").val();
        var year = $("#con_expr_year").val();
        if (month == '' || day == '' || year == '') {
            return false;
        }

//        confirm(<?= $p_Month, $p_Day, $p_Year; ?>);
//        var GD = toGregorian(parseInt(year), parseInt(month), parseInt(day));


//        var dateString = GD.gm + "/" + GD.gd + "/" + GD.gy;
        var dateString = month + "/" + day + "/" + year;
//        confirm(dateString);
        if (_compareDate(dateString)) {
//        if (month >= gm && day > gd && year >= gy) {
            return true;
        } else {
            $('#title_warning').text('Invalid <?php print _t('', 'Contract Expiry Date') ?>');
            $('#warnMsg').text('<?php print _t('344', 'Kindly select the future date') ?>');
//            ("Invalid License Expire Date");
            $("#yearName").val("con_expr_year");
            $("#monthName").val("con_expr_month");
            $("#dateName").val("con_expr_date");
            $('#modal_warning').openModal({dismissible: false});
            return false;
        }
    }
    function checkPERMITStartFarsiDate() {
        var month = $("#permit_start_month").val();
        var day = $("#permit_start_date").val();
        var year = $("#permit_start_year").val();
        if (month == '' || day == '' || year == '') {
            return false;
        }

//        confirm(<?= $p_Month, $p_Day, $p_Year; ?>);
//        var GD = toGregorian(parseInt(year), parseInt(month), parseInt(day));


//        var dateString = GD.gm + "/" + GD.gd + "/" + GD.gy;
        var dateString = month + "/" + day + "/" + year;
//        confirm(dateString);
        if (_compareDate2(dateString)) {
//        if (month >= gm && day > gd && year >= gy) {
            return true;
        } else {
            $('#title_warning').text('Invalid <?php print _t('217', 'Permit Start Date') ?>');
            $('#warnMsg').text('Kindly select the Past date');
//            ("Invalid License Expire Date");
            $("#yearName").val("permit_start_year");
            $("#monthName").val("permit_start_month");
            $("#dateName").val("permit_start_date");
            $('#modal_warning').openModal({dismissible: false});
            return false;
        }
    }
    function checkDOBFarsiDate() {
        var month = $("#dob_month").val();
        var day = $("#dob_date").val();
        var year = $("#dob_year").val();
        if (month == '' || day == '' || year == '') {
            return false;
        }

//        confirm(<?= $p_Month, $p_Day, $p_Year; ?>);
//        var GD = toGregorian(parseInt(year), parseInt(month), parseInt(day));


//        var dateString = GD.gm + "/" + GD.gd + "/" + GD.gy;
        var dateString = month + "/" + day + "/" + year;
//        confirm(dateString);
        if (_compareDate2(dateString)) {
//        if (month >= gm && day > gd && year >= gy) {
            return true;
        } else {
            $('#title_warning').text('Invalid <?php print _t('107', 'Date Of Birth') ?>');
            $('#warnMsg').text('Kindly select the Past date');
//            ("Invalid License Expire Date");
            $("#yearName").val("dob_year");
            $("#monthName").val("dob_month");
            $("#dateName").val("dob_date");
            $('#modal_warning').openModal({dismissible: false});
            return false;
        }
    }


</script>
<?php include _PATH . "instance/front/tpl/google_maps.js.php"; ?>
