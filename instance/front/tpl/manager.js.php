<?php include _PATH . "instance/front/tpl/libValidate.php" ?>
<script>
    function IsPlateNo(txb)
    {
        var x = txb.value;
        if (isNaN(x) || x.indexOf(" ") !== -1)
        {
            txb.value = txb.value.replace(/[^\0-9]{1}/ig, "");
            txb.focus();
        } else if (x.length < 10 || x.length > 10)
        {
//            alert("Enter must 10 digit Melli No");
            txb.value = txb.value.replace(/[^\0-9]{9}/ig, "");
            txb.focus();
        } else {

        }
        return false;
    }
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
    $("#manager_edit").validate({
        ignore: [],
        rules: {
            fName: {required: true, regex: '^[\u0020\u0600-\u06FF\s]+$'},
            lName: {required: true, regex: '^[\u0020\u0600-\u06FF\s]+$'},
            fatherName: {required: true, regex: '^[\u0020\u0600-\u06FF\s]+$'},
            email: {regex: '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$'},
            city: {regex: '^[^0-9]+$'},
            melli_no: {required: true, minlength: '10', maxlength: '10'},
            post_code: {number: true, minlength: '10', maxlength: '10'},
            dob: {required: true, minlength: '10', maxlength: '10'},
            insurance_no: {number: true},
            home_address: {required: true},
            em_fName: {required: true, regex: '^[\u0020\u0600-\u06FF\s]+$'},
            em_lName: {required: true, regex: '^[\u0020\u0600-\u06FF\s]+$'},
            em_phone: {required: true, minlength: '13', maxlength: '13'},
            phone: {required: true, minlength: '9', maxlength: '13', onlynumber: true},
            veh_lic_no4: {required_lic: true},
            vin_no: {required: true, regex: '^[A-Za-z0-9]+$'},
            v_type: {required: true},
            cell_provider: {required: true},
            car_make: {required: true},
            car_year: {required: true},
            ddl_year: {required: true},
            ddl_month: {required: true},
            ddl_date: {required: true},
            l_p_type: {required: true}
        },
        messages: {
            fName: {required: '<span style="color:red;font-size:11px;">This value is required</span>', regex: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            lName: {required: '<span style="color:red;font-size:11px;">This value is required</span>', regex: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            fatherName: {required: '<span style="color:red;font-size:11px;">This value is required</span>', regex: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            email: {regex: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            city: {regex: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            melli_no: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            melli_ex_date: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            post_code: {number: '<span style="color:red;font-size:11px;">This value is not valid</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            dob: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            bod_no: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            insurance_no: {number: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            insurance_date: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            home_address: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            home_phone: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            phone: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', onlynumber: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            em_fName: {required: '<span style="color:red;font-size:11px;">This value is required</span>', regex: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            em_lName: {required: '<span style="color:red;font-size:11px;">This value is required</span>', regex: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            em_phone: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            endine_no: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            veh_card_no: {required: '<span style="color:red;font-size:11px;">This value is required</span>', minlength: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            vin_no: {required: '<span style="color:red;font-size:11px;">This value is required</span>', maxlength: '<span style="color:red;font-size:11px;">This value is not valid</span>', regex: '<span style="color:red;font-size:11px;">This value is not valid</span>'},
            veh_lic_no4: {required_lic: '<span style="color:red;font-size:11px;">This value is required</span>'},
            v_type: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            cell_provider: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            car_make: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            car_year: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            ddl_year: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            ddl_month: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            ddl_date: {required: '<span style="color:red;font-size:11px;">This value is required</span>'},
            l_p_type: {required: '<span style="color:red;font-size:11px;">This value is required</span>'}
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "v_type") {
                error.insertAfter($('#errorbox_vehicle_type'));
            } else if (element.attr("name") == "l_p_type") {
                error.insertAfter($('#errorbox_license_plate_type'));
            } else if (element.attr("name") == "rd_subcat") {
                error.insertAfter($('#errorbox_subcat'));
            } else if (element.attr("name") == "chk_dept[]") {
                error.insertAfter($('#errorbox_dept'));
            } else if (element.attr("name") == "veh_lic_no4") {
                console.log(element.attr("name"));
                error.insertAfter($('#errorbox_vln'));
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
</script>
<script type="text/javascript">
    $(document).ready(function () {

//        $('#table1').DataTable({
//            "bLengthChange": false
//           
//        });



<?php if ($success == "1") { ?>
            Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>
<?php if ($success == "-1") { ?>
            Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>

    });
    function change() {
        $('#car_make').change(function () {
            var value = $(this).val();

            if (value == "other") {
                $('#select_make_model_other').show();
                return;
            } else
            {
                $('#select_make_model_other').hide();
            }

        });

        $('#car_make').change(function () {
            var value = $(this).val();

            if (value == "other") {
                $('#select_make_model_other2').show();
                return;
            } else
            {
                $('#select_make_model_other2').hide();
            }

        });


    }
    function bindStage(id, stage)
    {
//        alert(stage);
        if (stage == "1") {
            $('#station1').attr('disabled', false);
            $('#station1').prop("checked", true);
            $("#station2").attr('disabled', true);
            $('#station3').attr('disabled', true);
            $('#station4').attr('disabled', true);
            $('#station5').attr('disabled', true);
        }
        if (stage == "2")
        {
            $('#station1').attr('disabled', false);
            $('#station2').attr('disabled', false);
            $('#station2').prop("checked", true);
            $('#station3').attr('disabled', true);
            $('#station4').attr('disabled', true);
            $('#station5').attr('disabled', true);


        }
        if (stage == "3")
        {
            $('#station2').attr('disabled', false);
            $('#station3').attr('disabled', false);
            $('#station3').prop("checked", true);
            $("#station1").attr('disabled', true);
            $('#station4').attr('disabled', true);
            $('#station5').attr('disabled', true);
        }
        if (stage == "4")
        {
            $('#station3').attr('disabled', false);
            $('#station4').attr('disabled', false);
            $('#station4').prop("checked", true);
            $('#station1').attr('disabled', true);
            $('#station2').attr('disabled', true);
            $('#station5').attr('disabled', true);
            $('#st5').hide();
            $('#st3').show();

            $('#station3').attr('enabled', true);
        }
        if (stage == "5")
        {
            $('#station4').attr('disabled', false);
            $('#station5').attr('disabled', false);
            $('#station5').prop("checked", true);
            $('#st5').show();
            $('#st3').hide();

            $('#station1').attr('disabled', true);
            $('#station2').attr('disabled', true);
            $('#station3').attr('disabled', true);
            $('#station4').attr('enabled', true);
        }
        $('#did').val(id);
    }
    function bindUser(id, stage)
    {
        $.ajax({
            url: '<?php echo _U ?>manager',
            dataType: "json",
            data: {

                getUser: 1,
                id: id,
                stage: stage
            }, success: function (data) {
//                $("#agent").val(data.uname + " is " + data.operation_type + " At " + data.touch_date).change();
                $("#agent").val("User Name:  " + data.row.uname + " , " + data.row.operation_type + " At " + data.Tdate).change();
                if (data.row.operation_type == "ADD")
                {
                    $("#agent_op").html("Added By&nbsp;").change();
                    $("#agent_nm").html("<?php print _t('188', 'User Name') ?> " + data.row.uname + " , ").change();

                    $("#agent_time").html("&nbsp; <?php print _t('209', 'Log Date') ?>: " + data.Tdate).change();
                } else {
                    $("#agent_op").html("Modified By&nbsp;").change();
                    $("#agent_nm").html("<?php print _t('188', 'User Name') ?> " + data.row.uname + " , ").change();
                    $("#agent_time").html("&nbsp;<?php print _t('209', 'Log Date') ?> " + data.Tdate).change();
                }
            }
        });
    }
    function divDisplay(btn)
    {
        if (btn == "driver")
        {
            $('#login').css('background-color', '#F08080');
            $('#vehicle').css('background-color', '#F08080');
            $('#driver').css('background-color', 'gray');
//            $('#driver').hide();
            $('#card_basic').show();
            $('#card_vehicle').hide();
            $('#card_login').hide();

        } else if (btn == "vehicle")
        {
            $('#driver').css('background-color', '#F08080');
            $('#login').css('background-color', '#F08080');
            $('#vehicle').css('background-color', 'gray');
            $('#card_basic').hide();
            $('#card_login').hide();
            $('#card_vehicle').show();
        } else
        {
            $('#login').css('background-color', 'gray');
            $('#driver').css('background-color', '#F08080');
            $('#vehicle').css('background-color', '#F08080');
//            $('#card_basic').hide();
            $('#card_vehicle').hide();
            $('#card_basic').hide();
            $('#card_login').show();
        }
    }
    function bindData1(id)
    {
        $.ajax({
            url: '<?php echo _U ?>manager',
            dataType: "json",
            data: {
                getData1: 1,
                id: id
            }, success: function (data) {
                $("#rejected_wait").hide();
                $("#rejected_data").show();
//                 $("#v_id").val(data.vehicle_id);
                $("#d_id").val(data.driver_id);
                $("#v_id").val(data.vehicle_id);
                $("#fName").val(data.fname).change();
                $("#lName").val(data.lname).change();
                $("#fatherName").val(data.father_name).change();
                $("#email").val(data.email).change();
                if (data.gender == null) {
                    return false;
                } else {
                    if (data.gender == '0') {
                        $('input[type=radio][id=male]').prop('checked', 'true');
                    } else if (data.gender == '1') {
                        $('input[type=radio][id=female]').prop('checked', 'true');
                    } else {
                    }
                }
                if (data.marital_status == null) {
                    return false;
                } else {
                    if (data.marital_status == '0') {
                        $('input[type=radio][id=single]').prop('checked', 'true');
                    } else if (data.marital_status == '1') {
                        $('input[type=radio][id=married]').prop('checked', 'true');
                    } else {
                    }
                }
                $("#bod_no").val(data.birth_cert_number).change();
//                $("#hiddenDOB").val(data.dob).change();
                $("#melli_no").val(data.melli_no).change();

                $("#home_phone").val(data.home_phone);
                $("#home_address").val(data.home_address);
                $("#city").val(data.city);
                $("#post_code").val(data.postal_code);
                $("#car_year").val(data.year).change();
                $("#car_make").val(data.make_modal);

                if (data.vehicle_type == null) {
                    return false;
                } else {
                    if (data.vehicle_type == '5') {
                        $('input[type=radio][id=type_sedan]').prop('checked', 'true');
                    } else if (data.vehicle_type == '4') {
                        $('input[type=radio][id=type_taxi]').prop('checked', 'true');
                    } else if (data.vehicle_type == '7') {
                        $('input[type=radio][id=type_suv]').prop('checked', 'true');
                    } else if (data.vehicle_type == '6') {
                        $('input[type=radio][id=type_van]').prop('checked', 'true');
                    } else {
                    }
                }
                $("#veh_card_no").val(data.vehicle_card_number).change();
                $("#color_id").val(data.colors);
                $("#other_color").val(data.new_color).change();
                if (data.is_applicant_owner == null) {
                    return false;
                } else {
                    if (data.is_applicant_owner == '0') {
                        $('input[type=radio][id=non_owner_no]').prop('checked', 'true');
                    } else if (data.is_applicant_owner == '1') {
                        $('input[type=radio][id=non_owner_yes]').prop('checked', 'true');
                    } else {

                    }

                }

                //                $("#veh_lic_no").val(data.license_plate).change();
                //                $("#veh_lic_no1").val(data.vin_lic_no1);
                //                $("#veh_lic_no2").val(data.vin_lic_no2);
                //                $("#veh_lic_no3").val(data.vin_lic_no3);
                $("#veh_lic_no1").val(data.license_plate1);
                $("#veh_lic_no2").val(data.license_plate2);
                $("#veh_lic_no3").val(data.license_plate3);
                $("#veh_lic_no4").val(data.license_plate4);
                $("#dvl2").text(data.license_plate2);
                $("#dvl3").text(data.license_plate3);
                $("#dvl4").text(data.license_plate4 + ' ' + data.license_plate1);
                $("#phone").val(data.phone).change();
//                $("#vin_no").val(data.chassis_no).change();
//                $("#hiddenLED").val(data.license_expiry_date).change();
                $("#cell_provider").val(data.cell_provider);
                $('input[type=radio][id=odd]').prop('checked', '');
                $('input[type=radio][id=even]').prop('checked', '');
                var value = data.make_modal;
                if (value == "other") {
                    $('#select_make_model_other2').slideDown();
                    $("#other_car").val(data.make_modal_other).change();
                    return;
                } else
                {
                    $('#select_make_model_other2').slideUp();
                }
                // console.log(data.make_modal);
                //$("#car_modal").val(data.make_modal).trigger("change");
//                alert("1");
                $("#dob_year").val(data.dyears);
//                alert("2");
                $("#dob_month").val(data.dmonths);
//                alert("3");
                $("#dob_date").val(data.ddate);
                $('selected').material_select();
                $("#insurance_expr_year").val(data.iyears);
                $("#insurance_expr_month").val(data.imonths);
                $("#insurance_expr_date").val(data.idate);
                $('selected').material_select();
                $("#smog_expr_year").val(data.syears);
                $("#smog_expr_month").val(data.smonths);
                $("#smog_expr_date").val(data.sdate);
                $('selected').material_select();
                $("#melli_expr_year").val(data.myears);
                $("#melli_expr_month").val(data.mmonths);
                $("#melli_expr_date").val(data.mdate);
                $('selected').material_select();
                $("#ddl_year").val(data.years);
                $("#ddl_month").val(data.months);
                $("#ddl_date").val(data.date);
                $('selected').material_select();
            }
        });
    }
    function bindData2(id)
    {
//        alert(id);
        $.ajax({
            url: '<?php echo _U ?>manager',
            dataType: "json",
            data: {
                getData2: 1,
                id: id
            }, success: function (data) {
                $("#rejected_wait").hide();
                $("#rejected_data").show();
//                 $("#v_id").val(data.vehicle_id);
                $("#d_id").val(data.driver_id);
                $("#v_id").val(data.vehicle_id);
                $("#fName").val(data.fname).change();
                $("#lName").val(data.lname).change();
                $("#fatherName").val(data.father_name).change();
                $("#email").val(data.email).change();
                if (data.gender == null) {
                    return false;
                } else {
                    if (data.gender == '0') {
                        $('input[type=radio][id=male]').prop('checked', 'true');
                    } else if (data.gender == '1') {
                        $('input[type=radio][id=female]').prop('checked', 'true');
                    } else {
                    }
                }
                if (data.marital_status == null) {
                    return false;
                } else {
                    if (data.marital_status == '0') {
                        $('input[type=radio][id=single]').prop('checked', 'true');
                    } else if (data.marital_status == '1') {
                        $('input[type=radio][id=married]').prop('checked', 'true');
                    } else {
                    }
                }
                $("#bod_no").val(data.birth_cert_number).change();
//                $("#hiddenDOB").val(data.dob).change();
                $("#melli_no").val(data.melli_no).change();

                $("#home_phone").val(data.home_phone);
                $("#home_address").val(data.home_address);
                $("#city").val(data.city);
                $("#post_code").val(data.postal_code);
                $("#car_year").val(data.year).change();
                $("#car_make").val(data.make_modal);

                if (data.vehicle_type == null) {
                    return false;
                } else {
                    if (data.vehicle_type == '5') {
                        $('input[type=radio][id=type_sedan]').prop('checked', 'true');
                    } else if (data.vehicle_type == '4') {
                        $('input[type=radio][id=type_taxi]').prop('checked', 'true');
                    } else if (data.vehicle_type == '7') {
                        $('input[type=radio][id=type_suv]').prop('checked', 'true');
                    } else if (data.vehicle_type == '6') {
                        $('input[type=radio][id=type_van]').prop('checked', 'true');
                    } else {
                    }
                }
                $("#veh_card_no").val(data.vehicle_card_number).change();
                $("#color_id").val(data.colors);
                $("#other_color").val(data.new_color).change();
                if (data.is_applicant_owner == null) {
                    return false;
                } else {
                    if (data.is_applicant_owner == '0') {
                        $('input[type=radio][id=non_owner_no]').prop('checked', 'true');
                    } else if (data.is_applicant_owner == '1') {
                        $('input[type=radio][id=non_owner_yes]').prop('checked', 'true');
                    } else {

                    }

                }

                //                $("#veh_lic_no").val(data.license_plate).change();
                //                $("#veh_lic_no1").val(data.vin_lic_no1);
                //                $("#veh_lic_no2").val(data.vin_lic_no2);
                //                $("#veh_lic_no3").val(data.vin_lic_no3);
                $("#veh_lic_no1").val(data.license_plate1);
                $("#veh_lic_no2").val(data.license_plate2);
                $("#veh_lic_no3").val(data.license_plate3);
                $("#veh_lic_no4").val(data.license_plate4);
                $("#dvl2").text(data.license_plate2);
                $("#dvl3").text(data.license_plate3);
                $("#dvl4").text(data.license_plate4 + ' ' + data.license_plate1);
                $("#phone").val(data.phone).change();
//                $("#vin_no").val(data.chassis_no).change();
//                $("#hiddenLED").val(data.license_expiry_date).change();
                $("#cell_provider").val(data.cell_provider);
                $('input[type=radio][id=odd]').prop('checked', '');
                $('input[type=radio][id=even]').prop('checked', '');
                var value = data.make_modal;
                if (value == "other") {
                    $('#select_make_model_other2').slideDown();
                    $("#other_car").val(data.make_modal_other).change();
                    return;
                } else
                {
                    $('#select_make_model_other2').slideUp();
                }
                // console.log(data.make_modal);
                //$("#car_modal").val(data.make_modal).trigger("change");
//                alert("1");
                $("#dob_year").val(data.dyears);
//                alert("2");
                $("#dob_month").val(data.dmonths);
//                alert("3");
                $("#dob_date").val(data.ddate);
                $('selected').material_select();
                $("#insurance_expr_year").val(data.iyears);
                $("#insurance_expr_month").val(data.imonths);
                $("#insurance_expr_date").val(data.idate);
                $('selected').material_select();
                $("#smog_expr_year").val(data.syears);
                $("#smog_expr_month").val(data.smonths);
                $("#smog_expr_date").val(data.sdate);
                $('selected').material_select();
                $("#melli_expr_year").val(data.myears);
                $("#melli_expr_month").val(data.mmonths);
                $("#melli_expr_date").val(data.mdate);
                $('selected').material_select();
                $("#ddl_year").val(data.years);
                $("#ddl_month").val(data.months);
                $("#ddl_date").val(data.date);
                $('selected').material_select();
            }
        });
    }
    function bindData3(id)
    {
        $.ajax({
            url: '<?php echo _U ?>manager',
            dataType: "json",
            data: {
                getData3: 1,
                id: id
            }, success: function (data) {
                $("#rejected_wait").hide();
                $("#rejected_data").show();
//                 $("#v_id").val(data.vehicle_id);
                $("#d_id").val(data.driver_id);
                $("#v_id").val(data.vehicle_id);
                $("#fName").val(data.fname).change();
                $("#lName").val(data.lname).change();
                $("#fatherName").val(data.father_name).change();
                $("#email").val(data.email).change();
                if (data.gender == null) {
                    return false;
                } else {
                    if (data.gender == '0') {
                        $('input[type=radio][id=male]').prop('checked', 'true');
                    } else if (data.gender == '1') {
                        $('input[type=radio][id=female]').prop('checked', 'true');
                    } else {
                    }
                }
                if (data.marital_status == null) {
                    return false;
                } else {
                    if (data.marital_status == '0') {
                        $('input[type=radio][id=single]').prop('checked', 'true');
                    } else if (data.marital_status == '1') {
                        $('input[type=radio][id=married]').prop('checked', 'true');
                    } else {
                    }
                }
                $("#bod_no").val(data.birth_cert_number).change();
//                $("#hiddenDOB").val(data.dob).change();
                $("#melli_no").val(data.melli_no).change();

                $("#home_phone").val(data.home_phone);
                $("#home_address").val(data.home_address);
                $("#city").val(data.city);
                $("#post_code").val(data.postal_code);
                $("#car_year").val(data.year).change();
                $("#car_make").val(data.make_modal);

                if (data.vehicle_type == null) {
                    return false;
                } else {
                    if (data.vehicle_type == '5') {
                        $('input[type=radio][id=type_sedan]').prop('checked', 'true');
                    } else if (data.vehicle_type == '4') {
                        $('input[type=radio][id=type_taxi]').prop('checked', 'true');
                    } else if (data.vehicle_type == '7') {
                        $('input[type=radio][id=type_suv]').prop('checked', 'true');
                    } else if (data.vehicle_type == '6') {
                        $('input[type=radio][id=type_van]').prop('checked', 'true');
                    } else {
                    }
                }
                $("#veh_card_no").val(data.vehicle_card_number).change();
                $("#color_id").val(data.colors);
                $("#other_color").val(data.new_color).change();
                if (data.is_applicant_owner == null) {
                    return false;
                } else {
                    if (data.is_applicant_owner == '0') {
                        $('input[type=radio][id=non_owner_no]').prop('checked', 'true');
                    } else if (data.is_applicant_owner == '1') {
                        $('input[type=radio][id=non_owner_yes]').prop('checked', 'true');
                    } else {

                    }

                }

                //                $("#veh_lic_no").val(data.license_plate).change();
                //                $("#veh_lic_no1").val(data.vin_lic_no1);
                //                $("#veh_lic_no2").val(data.vin_lic_no2);
                //                $("#veh_lic_no3").val(data.vin_lic_no3);
                $("#veh_lic_no1").val(data.license_plate1);
                $("#veh_lic_no2").val(data.license_plate2);
                $("#veh_lic_no3").val(data.license_plate3);
                $("#veh_lic_no4").val(data.license_plate4);
                $("#dvl2").text(data.license_plate2);
                $("#dvl3").text(data.license_plate3);
                $("#dvl4").text(data.license_plate4 + ' ' + data.license_plate1);
                $("#phone").val(data.phone).change();
//                $("#vin_no").val(data.chassis_no).change();
//                $("#hiddenLED").val(data.license_expiry_date).change();
                $("#cell_provider").val(data.cell_provider);
                $('input[type=radio][id=odd]').prop('checked', '');
                $('input[type=radio][id=even]').prop('checked', '');
                var value = data.make_modal;
                if (value == "other") {
                    $('#select_make_model_other2').slideDown();
                    $("#other_car").val(data.make_modal_other).change();
                    return;
                } else
                {
                    $('#select_make_model_other2').slideUp();
                }
                // console.log(data.make_modal);
                //$("#car_modal").val(data.make_modal).trigger("change");
//                alert("1");
                $("#dob_year").val(data.dyears);
//                alert("2");
                $("#dob_month").val(data.dmonths);
//                alert("3");
                $("#dob_date").val(data.ddate);
                $('selected').material_select();
                $("#insurance_expr_year").val(data.iyears);
                $("#insurance_expr_month").val(data.imonths);
                $("#insurance_expr_date").val(data.idate);
                $('selected').material_select();
                $("#smog_expr_year").val(data.syears);
                $("#smog_expr_month").val(data.smonths);
                $("#smog_expr_date").val(data.sdate);
                $('selected').material_select();
                $("#melli_expr_year").val(data.myears);
                $("#melli_expr_month").val(data.mmonths);
                $("#melli_expr_date").val(data.mdate);
                $('selected').material_select();
                $("#ddl_year").val(data.years);
                $("#ddl_month").val(data.months);
                $("#ddl_date").val(data.date);
                $('selected').material_select();
            }
        });
    }

    function bindData4(id)
    {
        $.ajax({
            url: '<?php echo _U ?>manager',
            dataType: "json",
            data: {
                getData4: 1,
                id: id
            }, success: function (data) {
                $("#rejected_wait").hide();
                $("#rejected_data").show();
//                 $("#v_id").val(data.vehicle_id);
                $("#d_id").val(data.driver_id);
                $("#v_id").val(data.vehicle_id);
                $("#fName").val(data.fname).change();
                $("#lName").val(data.lname).change();
                $("#fatherName").val(data.father_name).change();
                $("#email").val(data.email).change();
                if (data.gender == null) {
                    return false;
                } else {
                    if (data.gender == '0') {
                        $('input[type=radio][id=male]').prop('checked', 'true');
                    } else if (data.gender == '1') {
                        $('input[type=radio][id=female]').prop('checked', 'true');
                    } else {
                    }
                }
                if (data.marital_status == null) {
                    return false;
                } else {
                    if (data.marital_status == '0') {
                        $('input[type=radio][id=single]').prop('checked', 'true');
                    } else if (data.marital_status == '1') {
                        $('input[type=radio][id=married]').prop('checked', 'true');
                    } else {
                    }
                }
                $("#bod_no").val(data.birth_cert_number).change();
//                $("#hiddenDOB").val(data.dob).change();
                $("#melli_no").val(data.melli_no).change();

                $("#home_phone").val(data.home_phone);
                $("#home_address").val(data.home_address);
                $("#city").val(data.city);
                $("#post_code").val(data.postal_code);
                $("#car_year").val(data.year).change();
                $("#car_make").val(data.make_modal);

                if (data.vehicle_type == null) {
                    return false;
                } else {
                    if (data.vehicle_type == '5') {
                        $('input[type=radio][id=type_sedan]').prop('checked', 'true');
                    } else if (data.vehicle_type == '4') {
                        $('input[type=radio][id=type_taxi]').prop('checked', 'true');
                    } else if (data.vehicle_type == '7') {
                        $('input[type=radio][id=type_suv]').prop('checked', 'true');
                    } else if (data.vehicle_type == '6') {
                        $('input[type=radio][id=type_van]').prop('checked', 'true');
                    } else {
                    }
                }
                $("#veh_card_no").val(data.vehicle_card_number).change();
                $("#color_id").val(data.colors);
                $("#other_color").val(data.new_color).change();
                if (data.is_applicant_owner == null) {
                    return false;
                } else {
                    if (data.is_applicant_owner == '0') {
                        $('input[type=radio][id=non_owner_no]').prop('checked', 'true');
                    } else if (data.is_applicant_owner == '1') {
                        $('input[type=radio][id=non_owner_yes]').prop('checked', 'true');
                    } else {

                    }

                }

                //                $("#veh_lic_no").val(data.license_plate).change();
                //                $("#veh_lic_no1").val(data.vin_lic_no1);
                //                $("#veh_lic_no2").val(data.vin_lic_no2);
                //                $("#veh_lic_no3").val(data.vin_lic_no3);
                $("#veh_lic_no1").val(data.license_plate1);
                $("#veh_lic_no2").val(data.license_plate2);
                $("#veh_lic_no3").val(data.license_plate3);
                $("#veh_lic_no4").val(data.license_plate4);
                $("#dvl2").text(data.license_plate2);
                $("#dvl3").text(data.license_plate3);
                $("#dvl4").text(data.license_plate4 + ' ' + data.license_plate1);
                $("#phone").val(data.phone).change();
//                $("#vin_no").val(data.chassis_no).change();
//                $("#hiddenLED").val(data.license_expiry_date).change();
                $("#cell_provider").val(data.cell_provider);
                $('input[type=radio][id=odd]').prop('checked', '');
                $('input[type=radio][id=even]').prop('checked', '');
                var value = data.make_modal;
                if (value == "other") {
                    $('#select_make_model_other2').slideDown();
                    $("#other_car").val(data.make_modal_other).change();
                    return;
                } else
                {
                    $('#select_make_model_other2').slideUp();
                }
                // console.log(data.make_modal);
                //$("#car_modal").val(data.make_modal).trigger("change");
//                alert("1");
                $("#dob_year").val(data.dyears);
//                alert("2");
                $("#dob_month").val(data.dmonths);
//                alert("3");
                $("#dob_date").val(data.ddate);
                $('selected').material_select();
                $("#insurance_expr_year").val(data.iyears);
                $("#insurance_expr_month").val(data.imonths);
                $("#insurance_expr_date").val(data.idate);
                $('selected').material_select();
                $("#smog_expr_year").val(data.syears);
                $("#smog_expr_month").val(data.smonths);
                $("#smog_expr_date").val(data.sdate);
                $('selected').material_select();
                $("#melli_expr_year").val(data.myears);
                $("#melli_expr_month").val(data.mmonths);
                $("#melli_expr_date").val(data.mdate);
                $('selected').material_select();
                $("#ddl_year").val(data.years);
                $("#ddl_month").val(data.months);
                $("#ddl_date").val(data.date);
                $('selected').material_select();
            }
        });
    }

    function bindData5(id)
    {
        $.ajax({
            url: '<?php echo _U ?>manager',
            dataType: "json",
            data: {
                getData5: 1,
                id: id
            }, success: function (data) {
                $("#rejected_wait").hide();
                $("#rejected_data").show();
//                 $("#v_id").val(data.vehicle_id);
                $("#d_id").val(data.driver_id);
                $("#v_id").val(data.vehicle_id);
                $("#fName").val(data.fname).change();
                $("#lName").val(data.lname).change();
                $("#fatherName").val(data.father_name).change();
                $("#email").val(data.email).change();
                if (data.gender == null) {
                    return false;
                } else {
                    if (data.gender == '0') {
                        $('input[type=radio][id=male]').prop('checked', 'true');
                    } else if (data.gender == '1') {
                        $('input[type=radio][id=female]').prop('checked', 'true');
                    } else {
                    }
                }
                if (data.marital_status == null) {
                    return false;
                } else {
                    if (data.marital_status == '0') {
                        $('input[type=radio][id=single]').prop('checked', 'true');
                    } else if (data.marital_status == '1') {
                        $('input[type=radio][id=married]').prop('checked', 'true');
                    } else {
                    }
                }
                $("#bod_no").val(data.birth_cert_number).change();
//                $("#hiddenDOB").val(data.dob).change();
                $("#melli_no").val(data.melli_no).change();

                $("#home_phone").val(data.home_phone);
                $("#home_address").val(data.home_address);
                $("#city").val(data.city);
                $("#post_code").val(data.postal_code);
                $("#car_year").val(data.year).change();
                $("#car_make").val(data.make_modal);

                if (data.vehicle_type == null) {
                    return false;
                } else {
                    if (data.vehicle_type == '5') {
                        $('input[type=radio][id=type_sedan]').prop('checked', 'true');
                    } else if (data.vehicle_type == '4') {
                        $('input[type=radio][id=type_taxi]').prop('checked', 'true');
                    } else if (data.vehicle_type == '7') {
                        $('input[type=radio][id=type_suv]').prop('checked', 'true');
                    } else if (data.vehicle_type == '6') {
                        $('input[type=radio][id=type_van]').prop('checked', 'true');
                    } else {
                    }
                }
                $("#veh_card_no").val(data.vehicle_card_number).change();
                $("#color_id").val(data.colors);
                $("#other_color").val(data.new_color).change();
                if (data.is_applicant_owner == null) {
                    return false;
                } else {
                    if (data.is_applicant_owner == '0') {
                        $('input[type=radio][id=non_owner_no]').prop('checked', 'true');
                    } else if (data.is_applicant_owner == '1') {
                        $('input[type=radio][id=non_owner_yes]').prop('checked', 'true');
                    } else {

                    }

                }

                //                $("#veh_lic_no").val(data.license_plate).change();
                //                $("#veh_lic_no1").val(data.vin_lic_no1);
                //                $("#veh_lic_no2").val(data.vin_lic_no2);
                //                $("#veh_lic_no3").val(data.vin_lic_no3);
                $("#veh_lic_no1").val(data.license_plate1);
                $("#veh_lic_no2").val(data.license_plate2);
                $("#veh_lic_no3").val(data.license_plate3);
                $("#veh_lic_no4").val(data.license_plate4);
                $("#dvl2").text(data.license_plate2);
                $("#dvl3").text(data.license_plate3);
                $("#dvl4").text(data.license_plate4 + ' ' + data.license_plate1);
                $("#phone").val(data.phone).change();
//                $("#vin_no").val(data.chassis_no).change();
//                $("#hiddenLED").val(data.license_expiry_date).change();
                $("#cell_provider").val(data.cell_provider);
                $('input[type=radio][id=odd]').prop('checked', '');
                $('input[type=radio][id=even]').prop('checked', '');
                var value = data.make_modal;
                if (value == "other") {
                    $('#select_make_model_other2').slideDown();
                    $("#other_car").val(data.make_modal_other).change();
                    return;
                } else
                {
                    $('#select_make_model_other2').slideUp();
                }
                // console.log(data.make_modal);
                //$("#car_modal").val(data.make_modal).trigger("change");
//                alert("1");
                $("#dob_year").val(data.dyears);
//                alert("2");
                $("#dob_month").val(data.dmonths);
//                alert("3");
                $("#dob_date").val(data.ddate);
                $('selected').material_select();
                $("#insurance_expr_year").val(data.iyears);
                $("#insurance_expr_month").val(data.imonths);
                $("#insurance_expr_date").val(data.idate);
                $('selected').material_select();
                $("#smog_expr_year").val(data.syears);
                $("#smog_expr_month").val(data.smonths);
                $("#smog_expr_date").val(data.sdate);
                $('selected').material_select();
                $("#melli_expr_year").val(data.myears);
                $("#melli_expr_month").val(data.mmonths);
                $("#melli_expr_date").val(data.mdate);
                $('selected').material_select();
                $("#ddl_year").val(data.years);
                $("#ddl_month").val(data.months);
                $("#ddl_date").val(data.date);
                $('selected').material_select();
            }
        });
    }
    function checkDuplication()
    {
        $.ajax({
            url: '<?php echo _U ?>manager',
            dataType: "json",
            data: {

                duplication: 1,
                ID: $("#d_id").val(),
                phoneno: $("#phone").val(),
                mellino: $("#melli_no").val(),
                veh_lic_no1: $("#veh_lic_no1").val(),
                veh_lic_no2: $("#veh_lic_no2").val(),
                veh_lic_no3: $("#veh_lic_no3").val(),
                veh_lic_no4: $("#veh_lic_no4").val()
            }, success: function (r) {
                if (r.success == '1') {
                    $("#manager_edit").submit();
                } else {
                    $('#duplicate_msg_manager').html(r.msg);
                    if (r.duplicate == "pm" || r.duplicate == "p") {
                        $("#phone").focus();
                        $('#phone').css('background', '#FFCDD2');
                        if (r.duplicate == "pm") {
                            $('#melli_no').css('background', '#FFCDD2');
                        }
                        $('#warning_msg_manager').css("display", "block");
                    }
                    if (r.duplicate == "m") {
                        $("#melli_no").focus();
                        $('#melli_no').css('background', '#FFCDD2');
                        $('#warning_msg_manager').css("display", "block");
                    }
                    if (r.duplicate == "l") {
                        $("#veh_lic_no1").focus();
                        $('#veh_lic_no1').css('background', '#FFCDD2');
                        $('#veh_lic_no2').css('background', '#FFCDD2');
                        $('#veh_lic_no3').css('background', '#FFCDD2');
                        $('#veh_lic_no4').css('background', '#FFCDD2');
                        $('#warning_msg_manager').css("display", "block");
                    }
//                    $('#modal1').Modal({dismissible: false});
//                    $('#modal1').leanModal({dismissible: false});

                }
            }
        }
        );
    }
    function  bindNotes(id, stage)
    {
//        alert(id +"-"+stage);
        $.ajax({
            url: '<?php echo _U ?>manager',
            dataType: "json",
            data: {
                getNote: 1,
                id: id,
                stage: stage
            }, success: function (data) {
//                alert(data.touch_note);
//                $("#v_note1_id").html("Note Prepared By <b>" + data.uname + "</b> <br/>Touch Date : <b>" + data.touch_date + "<br/></b>Driver Name: <b>" + data.fname + " " + data.lname + "</b> &nbsp;&nbsp;&nbsp;&nbsp;  Vehicle : <b>" + data.make_modal + " " + data.make_modal_other + "<br/> Notes : </b>" + data.touch_note + "");
//                $("#v_note1_id").css("margin-top", "-10%");
//                $("#v_note1_id").css("color", "black");
//                $("#v_note1_id").css("font-size", "14px");
               $("#v1_value").html(data.row.uname);
                $("#v2_value").html(data.Tdate);
                $("#v3_value").html(data.row.fname + " " + data.row.lname);
                $("#v4_value").html(data.row.make_modal + " " + data.row.make_modal_other + " " + data.row.year);
                $("#v5_value").html(data.row.touch_note);

            }
        });
    }
//    function bindUser(id, stage)
//    {
////        alert(stage);
//        $.ajax({
//            url: '<?php echo _U ?>manager',
//            dataType: "json",
//            data: {
//
//                getUser: 1,
//                id: id,
//                stage: stage
//            }, success: function (data) {
//                $("#agent").val(data.uname + " is " + data.operation_type + " At " + data.touch_date).change();
//
//
////               alert(data);
//            }
//        });
//    }
    function bindQuestion(id, stage)
    {
//        alert(id, stage);
        $.ajax({
            url: '<?php echo _U ?>manager',
            dataType: "json",
            data: {
                getQuestion: 1,
                id: id,
                stage: stage,
                vid: $("#vid").val()
            }, success: function (data) {
//                alert(data);
                var a = [];
                var b = [];
                var c = [];
                a[0] = '#ans1yes';
                a[1] = '#ans2yes';
                a[2] = '#ans3yes';
                a[3] = '#ans4yes';
                a[4] = '#ans5yes';
                a[5] = '#ans6yes';
                a[6] = '#ans7yes';
                a[7] = '#ans8yes';
                a[8] = '#ans9yes';
                a[9] = '#ans10yes';
                a[10] = '#ans11yes';
                a[11] = '#ans12yes';
                a[12] = '#ans13yes';
                a[13] = '#ans14yes';
                a[14] = '#ans15yes';
                a[15] = '#ans16yes';
                a[16] = '#ans17yes';
                a[17] = '#ans18yes';
                a[18] = '#ans19yes';
                a[19] = '#ans20yes';
                a[20] = '#ans21yes';
                a[21] = '#ans22yes';
                a[22] = '#ans23yes';
                a[23] = '#ans24yes';
                a[24] = '#ans25yes';
                a[25] = '#ans26yes';
                a[26] = '#ans27yes';
                a[27] = '#ans28yes';
                a[28] = '#ans29yes';
//                a[29] = '#ans30yes';

                b[0] = '<?php print _t('51', '1.Chassis Number is Ok?') ?>';
                b[1] = '<?php print _t('52', '2.Headlights are working properly ?') ?>';
                b[2] = '<?php print _t('53', '3.Front Turn Signals are working properly ?') ?>';
                b[3] = '<?php print _t('54', '4.Windshield Wiper are working properly ?') ?>';
                b[4] = '<?php print _t('55', '5.Rear lights are working properly ?') ?>';
                b[5] = '<?php print _t('56', '6.Rear Turn Signal/s are working properly ?') ?>';
                b[6] = '<?php print _t('57', '7.Brake lights are working properly ?') ?>';
                b[7] = '<?php print _t('58', '8.Reverse lights are working properly ?') ?>';
                b[8] = '<?php print _t('59', '9.Have a Trunk and its clear ?') ?>';
                b[9] = '<?php print _t('60', '10.Have a Spare Tire and good condition ?') ?>';
                b[10] = '<?php print _t('61', '11.Exhaust are working properly ?') ?>';
                b[11] = '<?php print _t('62', '12.Exterior cleaned properly ?') ?>';
                b[12] = '<?php print _t('63', '13.Paint are properly ?') ?>';
                b[13] = '<?php print _t('64', '14.Windows are cleaned properly ?') ?>';
                b[14] = '<?php print _t('65', '15.Mirrors are working properly ?') ?>';
                b[15] = '<?php print _t('66', '16.Wheels condition are proper ?') ?>';
                b[16] = '<?php print _t('67', '17.Seats are working properly ?') ?>';
                b[17] = '<?php print _t('68', '18.Seat adjustment are working properly ?') ?>';
                b[18] = '<?php print _t('69', '19.Interior Door Handles are working properly ?') ?>';
                b[19] = '<?php print _t('70', '20.Doors are working properly ?') ?>';
                b[20] = '<?php print _t('71', '21.Front Passenger Seat Belt is working properly ?') ?>';
                b[21] = '<?php print _t('72', '22.Window Buttons are working properly ?') ?>';
                b[22] = '<?php print _t('73', '23.Sun Visor is proper ?') ?>';
                b[23] = '<?php print _t('74', '24.Roof is proper ?') ?>';
                b[24] = '<?php print _t('75', '25.Steering Wheels condition is proper ?') ?>';
                b[25] = '<?php print _t('76', '26.Horn is working properly ?') ?>';
                b[26] = '<?php print _t('77', '27.Speedometer is working properly ?') ?>';
                b[27] = '<?php print _t('78', '28.Heater/Cooling is working properly?') ?>';
//                b[28] = '<?php print _t('79', '29.Heater is working properly ?') ?>';
                b[28] = '<?php print _t('80', '29.Interior are Cleaned proper ?') ?>';
                c[0] = '';
                c[1] = '';
                c[2] = '';
                c[3] = '#ans2yes';
                c[4] = '#ans3yes';
                c[5] = '#ans5yes';
                c[6] = '#ans7yes';
                c[7] = '#ans8yes';
                c[8] = '';
                c[9] = '';
                c[10] = '';
                c[11] = '';
                c[12] = '';
                c[13] = '';
                c[14] = '';
                c[15] = '';
                c[16] = '';
                c[17] = '';
                c[18] = '';
                c[19] = '';
                c[20] = '';
                c[21] = '';
                c[22] = '';
                c[23] = '';
                c[24] = '';
                c[25] = '';
                c[26] = '';
                c[27] = '';
                c[28] = '';
                c[29] = '';
                if (data.found > 0) {
                    for (index = 1; index <= 35; index++) {
                        if (data.qusetion[index])
                        {
//                            alert(data.qusetion[index]);
                            $('#td_no' + index).text(index);
                            $('#td_que' + index).text(b[index - 1]);
                        }
                        if (data.record[index])
                        {

                            rd_value = data.record[index];
//                            $(a[index] + index + rd_value).prop("checked", true);
                            if (rd_value == "yes")
                            {
//                        document.getElementById(a[key]).checked = true;

                                if (index == 1)
                                {
                                    $('#td_ans' + index).text("<?php print _t('19', 'Yes') ?>");
                                }
//                                if (a[0] != a[index - 1]) {

                                else {
                                    $('#td_ans' + index).text("<?php print _t('200', 'Acceptable') ?>");
                                }
                                $('#td_ans' + index).css("color", "#1B5E20");
//                        alert("its change id is=" + a[key]);
                            } else if (rd_value == "no")
                            {
//                        document.getElementById(a[key]).checked = true;

                                if (index == 1)
                                {
                                    $('#td_ans' + index).text("<?php print _t('20', 'No') ?>");
                                } else {
                                    $('#td_ans' + index).text("<?php print _t('201', 'Not Acceptable') ?>");
                                }
                                $('#td_ans' + index).css("color", "#BF360C");
//                        alert("its change id is=" + a[key]);
                            } else if (rd_value == "one")
                            {
//                        document.getElementById(a[key]).checked = true;

                                $('#td_ans' + index).text("<?php print _t('48', 'One Ok') ?>");
                                $('#td_ans' + index).css("color", "#3F51B5");
//                        alert("its change id is=" + a[key]);
                            } else
//                            {
////                        document.getElementById(a[key]).checked = true;
//                                console.log("a: " + a[index - 1] + " b: " + rd_value);
//                                $(a[index - 1]).text('Answer is Remaining ' + rd_value);
//                                $(a[index - 1]).css("color", "yellow");
//
////                        alert("its change id is=" + a[key]);
//                            }
                                $('#td_ans' + index).css("font-weight", "bold");
                            $('#td_ans' + index).css("font-size", "16px");
                        } else {
//                            console.log("a: " + a[index - 1] + " b: " + rd_value);
                            $('#td_ans' + index).text(' ');
                            $('#td_ans' + index).hide();
                            $('#td_que' + index).hide();
                            $('#td_ans' + index).css("color", "#616161");
                        }
                        $('#td_ans' + index).css("font-weight", "bold");
                        $('#td_ans' + index).css("font-size", "16px");
                        $('#td_que' + index).css("font-size", "16px");
//                        if (data.record[index])
//                        {
//
//                            rd_value = data.record[index];
////                            $(a[index] + index + rd_value).prop("checked", true);
//                            if (rd_value == "yes")
//                            {
////                        document.getElementById(a[key]).checked = true;
//
//                                if (a[0] == a[index - 1])
//                                {
//                                    $('#ans1yes').text("<?php print _t('19', 'Yes') ?>");
//                                }
////                                if (a[0] != a[index - 1]) {
//
//                                else {
//                                    $(a[index - 1]).text("<?php print _t('200', 'Acceptable') ?>");
//                                }
//                                $(a[index - 1]).css("color", "#1B5E20");
//
////                        alert("its change id is=" + a[key]);
//                            } else if (rd_value == "no")
//                            {
////                        document.getElementById(a[key]).checked = true;
//
//                                if (a[0] == a[index - 1])
//                                {
//                                    $('#ans1yes').text("<?php print _t('20', 'No') ?>");
//                                } else {
//                                    $(a[index - 1]).text("<?php print _t('201', 'Not Acceptable') ?>");
//                                }
//                                $(a[index - 1]).css("color", "#BF360C");
//
////                        alert("its change id is=" + a[key]);
//                            } else if (rd_value == "one")
//                            {
////                        document.getElementById(a[key]).checked = true;
//
//                                $(a[index - 1]).text('' + rd_value + ' Is Ok');
//                                $(a[index - 1]).css("color", "#3F51B5");
//
////                        alert("its change id is=" + a[key]);
//                            } else
////                            {
//////                        document.getElementById(a[key]).checked = true;
////                                console.log("a: " + a[index - 1] + " b: " + rd_value);
////                                $(a[index - 1]).text('Answer is Remaining ' + rd_value);
////                                $(a[index - 1]).css("color", "yellow");
////
//////                        alert("its change id is=" + a[key]);
////                            }
//                                $(a[index - 1]).css("font-weight", "bold");
//                            $(a[index - 1]).css("font-size", "16px");
//
//                        } 
//                        else {
////                            console.log("a: " + a[index - 1] + " b: " + rd_value);
//                            $(a[index - 1]).text('Answer is Remaining ');
//                            $(a[index - 1]).css("color", "#616161");
//                        }
//                        $(a[index - 1]).css("font-weight", "bold");
//                        $(a[index - 1]).css("font-size", "16px");
                    }

                }

            }
        });
    }
//    function bindQuestion(id, stage)
//    {
//        $.ajax({
//            url: '<?php echo _U ?>station3',
//            dataType: "json",
//            data: {
//                getQuestion: 1,
//                id: id,
//                stage: stage
//            }, success: function (data) {
////                alert(data);
//                var a = [];
//                var b = [];
//                var c = [];
//                a[0] = 'ans1yes';
//                a[1] = 'ans2yes';
//                a[2] = 'ans3yes';
//                a[3] = 'ans4yes';
//                a[4] = 'ans5yes';
//                a[5] = 'ans6yes';
//                a[6] = 'ans7yes';
//                a[7] = 'ans8yes';
//                a[8] = 'ans9yes';
//                a[9] = 'ans10yes';
//                a[10] = 'ans11yes';
//                a[11] = 'ans12yes';
//                a[12] = 'ans13yes';
//                a[13] = 'ans14yes';
//                a[14] = 'ans15yes';
//                a[15] = 'ans16yes';
//                a[16] = 'ans17yes';
//                a[17] = 'ans18yes';
//                a[18] = 'ans19yes';
//                a[19] = 'ans20yes';
//                a[20] = 'ans21yes';
//                a[21] = 'ans22yes';
//                a[22] = 'ans23yes';
//                a[23] = 'ans24yes';
//                a[24] = 'ans25yes';
//                a[25] = 'ans26yes';
//                a[26] = 'ans27yes';
//                a[27] = 'ans28yes';
//                a[28] = 'ans29yes';
//
//
//
//                b[0] = 'ans1no';
//                b[1] = 'ans2no';
//                b[2] = 'ans3no';
//                b[3] = 'ans4no';
//                b[4] = 'ans5no';
//                b[5] = 'ans6no';
//                b[6] = 'ans7no';
//                b[7] = 'ans8no';
//                b[8] = 'ans9no';
//                b[9] = 'ans10no';
//                b[10] = 'ans11no';
//                b[11] = 'ans12no';
//                b[12] = 'ans13no';
//                b[13] = 'ans14no';
//                b[14] = 'ans15no';
//                b[15] = 'ans16no';
//                b[16] = 'ans17no';
//                b[17] = 'ans18no';
//                b[18] = 'ans19no';
//                b[19] = 'ans20no';
//                b[20] = 'ans21no';
//                b[21] = 'ans22no';
//                b[22] = 'ans23no';
//                b[23] = 'ans24no';
//                b[24] = 'ans25no';
//                b[25] = 'ans26no';
//                b[26] = 'ans27no';
//                b[27] = 'ans28no';
//                b[28] = 'ans29no';
//
//                c[0] = '';
//                c[1] = '';
//                c[2] = 'ans3one';
//                c[3] = 'ans4one';
//                c[4] = 'ans5one';
//                c[5] = 'ans6one';
//                c[6] = 'ans7one';
//                c[7] = '';
//                c[8] = '';
//                c[9] = '';
//                c[10] = '';
//                c[11] = '';
//                c[12] = '';
//                c[13] = '';
//                c[14] = '';
//                c[15] = '';
//                c[16] = '';
//                c[17] = '';
//                c[18] = '';
//                c[19] = '';
//                c[20] = '';
//                c[21] = '';
//                c[22] = '';
//                c[23] = '';
//                c[24] = '';
//                c[25] = '';
//                c[26] = '';
//                c[27] = '';
//                c[28] = '';
//                for (var i = 0; i < 29; i++)
//                {
////                    console.log("i: " + i + " c" + c[i]);
//
//
////                    if (data[i] == "one")
////                    {
//////                        alert(data[i]);
////                        document.getElementById(c[i]).checked = true;
////                    }
////                    else 
//                    if (data[i] == "yes")
//                    {
//                        document.getElementById(a[i]).checked = true;
//                    } else
//                    {
//                        if (data[i] == "no")
//                        {
//                            document.getElementById(b[i]).checked = true;
//                        } else
//                        {
//                            //alert(c[i] + "-" + data[i]);
//                            document.getElementById(c[i]).checked = true;
//
//                        }
//                    }
//                }
//            }
//        });
//
//    }
//    jQuery.fn.extend({
//        disable: function (state) {
//            return this.each(function () {
//                this.disabled = state;
//            });
//        }
//    });
    function bindData(id, stage)
    {
        $('#login').css('background-color', '#F08080');
        $('#vehicle').css('background-color', '#F08080');
        $('#driver').css('background-color', 'gray');
//            $('#driver').hide();
        $('#card_basic').show();
        $('#card_vehicle').hide();
        $('#card_login').hide();

        $("#rejected_wait").show();
        $("#rejected_data").hide();
//        alert(stage);
        if (stage == "1")
        {
            $('#card_vehicle').hide();
            $('#card_login').hide();
            $('#vehicle').hide();
            $('#login').hide();
//            $('#vehicle').disable(true);
//            $('#login').disable(true);
//            alert(stage, id);
            bindUser(id, stage);
            bindData1(id);
//            $("#card_vehicle").hide();
//            $("#card_login").hide();
//          
        }
        if (stage == "2")
        {
            $('#vehicle').show();
            $('#card_login').hide();
            $('#login').hide();
//            $('#login').prop('disabled', true);
            bindNotes(id, stage);
            bindUser(id, stage);
            bindData2(id);
            bindQuestion(id, stage);
//            $("#card_vehicle").show();
//            $("#card_login").hide();
        }
        if (stage == "3")
        {
//        alert(id);
            $('#vehicle').show();
            $('#login').show();
            bindNotes(id, stage);
            bindUser(id, stage);
//            $("#card_vehicle").show();
//            $("#card_login").show();
            bindData3(id);
            bindQuestion(id, stage);
        }
        if (stage == "4")
        {
            $('#vehicle').show();
            $('#login').show();
            bindNotes(id, stage);
//            $("#card_vehicle").show();
//            $("#card_login").show();
            bindUser(id, stage);
            bindData4(id);
            bindQuestion(id, stage);
        }
        if (stage == "5")
        {

            $('#vehicle').show();
            $('#login').show();
            bindNotes(id, stage);
//            $("#card_vehicle").show();
//            $("#card_login").show();
            bindUser(id, stage);
            bindData5(id);
            bindQuestion(id, stage);
        }
    }

    $(document).ready(function () {
        $('.add_new').keydown(function (e) {
            if (e.keyCode === 13) {
                $.ajax({
                    url: "<?php echo _U ?>manager",
                    data: {addnew: 1, add_new: $(this).val()},
                    success: function () {
                        window.location.href = "<?php echo _U ?>manager";
                    }
                });
            }
        });
    });

    function IsMobileNumber(phone) {
        var mob = /^[09]{1}[0-9]{9}$/;
        var txtMobile = document.getElementById(phone);
        if (mob.test(phone.value) == false) {
            // alert("Please enter valid mobile number.");
            phone.focus();


        }
        return true;
    }
    function showData(id) {
        $("#hiddenId").val(id);
        $("#filecontent").attr("src", "<?php print _U ?>var/quotes/quotes_" + id + ".html");

    }
    function UpdateStatus() {
        $.ajax({
            url: "<?php echo _U ?>manager",
            data: {updateStatus: 1, quote_id: $("#hiddenId").val()},
            success: function () {
                window.location.href = "<?php echo _U ?>manager";
                Materialize.toast('Quote Approved Successfully!', 4000);
            }
        });
    }
    function testcheckbox(id) {
        var status;
        if ($('#checkbox' + id).prop('checked') == true) {
            status = '1';
        } else {
            status = '0';
        }
        $.ajax({
            url: "<?php echo _U ?>manager",
            data: {testcheckbox: 1, id: id, status: status},
            success: function () {
                window.location.href = "<?php echo _U ?>manager";
            }
        });
    }

    function deletetodo(id) {
        $.ajax({
            url: "<?php echo _U ?>manager",
            data: {deletetodo: 1, id: id},
            success: function () {
                window.location.href = "<?php echo _U ?>manager";
            }
        });
    }
</script>
