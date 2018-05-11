

<script type="text/javascript" src="<?php print _MEDIA_URL ?>js/jquery.timepicker.js"></script>

<!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/jquery.timepicker.css" />-->
<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/pikaday/css/pikaday.css"/>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/pikaday/pikaday.js"></script>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/pikaday/plugins/pikaday.jquery.js"></script>



<script type="text/javascript">

    function checkPasswordMatch() {
        var psw = $('#psw').val();
        var cnf_psw = $('#cnf_psw').val();
        if (psw == cnf_psw)
        {

        } else {
            $('#cnf_psw').focus();
            $('#cnf_psw').css('background', '#FFCDD2');
        }
    }

    function IsFarsi(txb)
    {
////        txb.value = txb.value.replace(/^[\u0600-\u06FF\s]+$/ , "");
//        var p = var p = /^[\u0600-\u06FF\s]+$/;
//        if (!p.test(txb)) {
////            alert("not format");
//            txb.value = "";
//        }
    }
    function changeFocus(txb) {
        if (txb.length > 4) {
            $('#veh_lic_no2').focus();
        }
    }
    $(document).ready(function () {
        $("#cnf_psw").focusout(checkPasswordMatch);
//       

        start_end_time();
        $('#st1_link').css('background-color', '#C71418');
        $('#st1_link').css('color', 'white');
        $('#st1_link').css('border-radius', '30px');
        //$("#veh_lic_no").inputmask("Regex");
        //$("#veh_lic_no").inputmask("(99) 99A999");
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
        window.pd = $("#inlineDatepicker").persianDatepicker({
            timePicker: {
                enabled: true
            },
            altField: '#inlineDatepickerAlt',
            altFormat: "YYYY MM DD HH:mm:ss",
//            minDate:1258675200000,
//            maxDate:1358675200000,
            checkDate: function (unix) {
                var output = true;
                var d = new persianDate(unix);
                if (d.date() == 20) {
                    output = false;
                }
                return output;
            },
            checkMonth: function (month) {
                var output = true;
                if (month == 1) {
                    output = false;
                }
                return output;
            }, checkYear: function (year) {
                var output = true;
                if (year == 1396) {
                    output = false;
                }
                return output;
            }

        }).data('datepicker');
        $("#inlineDatepicker").pDatepicker("setDate", [1391, 12, 1, 11, 14]);
        //pd.setDate([1333,12,28,11,20,30]);

        /**
         * Default
         * */
        $('#default').persianDatepicker({
            altField: '#defaultAlt'

        });
        /*
         observer
         */
        $(".observer").persianDatepicker({
            altField: '#observerAlt',
            altFormat: "YYYY MM DD HH:mm:ss",
            observer: true,
            format: 'YYYY/MM/DD'

        });
        /*
         timepicker
         */
        $("#timepicker").persianDatepicker({
            altField: '#timepickerAltField',
            altFormat: "YYYY MM DD HH:mm:ss",
            format: "HH:mm:ss a",
            onlyTimePicker: true

        });
        /*
         month
         */
        $("#monthpicker").persianDatepicker({
            format: " MMMM YYYY",
            altField: '#monthpickerAlt',
            altFormat: "YYYY MM DD HH:mm:ss",
            yearPicker: {
                enabled: false
            },
            monthPicker: {
                enabled: true
            },
            dayPicker: {
                enabled: false
            }
        });
        /*
         year
         */
        $("#yearpicker").persianDatepicker({
            format: "YYYY",
            altField: '#yearpickerAlt',
            altFormat: "YYYY MM DD HH:mm:ss",
            dayPicker: {
                enabled: false
            },
            monthPicker: {
                enabled: false
            },
            yearPicker: {
                enabled: true
            }
        });
        /*
         year and month
         */
        $("#yearAndMonthpicker").persianDatepicker({
            format: "YYYY MM",
            altFormat: "YYYY MM DD HH:mm:ss",
            altField: '#yearAndMonthpickerAlt',
            dayPicker: {
                enabled: false
            },
            monthPicker: {
                enabled: true
            },
            yearPicker: {
                enabled: true
            }
        });
        /**
         inline with minDate and maxDate
         */
        $("#inlineDatepickerWithMinMax").persianDatepicker({
            altField: '#inlineDatepickerWithMinMaxAlt',
            altFormat: "YYYY MM DD HH:mm:ss",
            minDate: 1416983467029,
            maxDate: 1419983467029
        });
        /**
         Custom Disable Date
         */
        $("#customDisabled").persianDatepicker({
            timePicker: {
                enabled: true
            },
            altField: '#customDisabledAlt',
            checkDate: function (unix) {
                var output = true;
                var d = new persianDate(unix);
                if (d.date() == 20 | d.date() == 21 | d.date() == 22) {
                    output = false;
                }
                return output;
            },
            checkMonth: function (month) {
                var output = true;
                if (month == 1) {
                    output = false;
                }
                return output;
            }, checkYear: function (year) {
                var output = true;
                if (year == 1396) {
                    output = false;
                }
                return output;
            }

        });
        /**
         persianDate
         */
        $("#persianDigit").persianDatepicker({
            altField: '#persianDigitAlt',
            altFormat: "YYYY MM DD HH:mm:ss",
            persianDigit: false
        });
    });
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
            $('#veh_lic_no').focus();
            $('#veh_lic_no').css('background', '#FFCDD2');
<?php } ?>

    }
    function start_end_time()
    {
        $.ajax({
            url: '<?php echo _U ?>change_password',
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
    $('#car_make').change(function () {
        var value = $(this).val();
        if (value == "other") {
            $('#select_make_model_other2').slideDown();
            return;
        } else
        {
            $('#select_make_model_other2').slideUp();
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

    function Validate()
    {

        var y = document.change_password.phone.value;
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
                url: '<?php echo _U ?>change_password',
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
//        $('#change_password_form').parsley().on('field:validated', function () {
//
//        }).on('form:submit', function () {
//            return true;
//            if ($('.parsley-error').length === 0) {
//                //showWait();
//                return true;
//            }
//            return false; // Don't submit form for this demo
//        });
    setTimeout(_doLoadDynamicDays, 2000);
    $('.clockpicker').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });
    $(".clockpicker1").timepicker();
    $('.datepicker').pickadate({
        min: new Date(),
//        onSet: function () {
//            setTimeout(this.close, 0);
//        }
//        max: new Date(2016,12, 14)
    });
    $("#change_passwordCardPanel").removeClass("panelWait");
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

    function _doLoadDynamicDays() {
        return;
        $.ajax({
            url: '<?php echo _U ?>change_password',
            type: 'post',
            data: {_doLoadDynamicDays: 1, silent: 1, id:<?php print _e($_REQUEST['id'], "0"); ?>},
            success: function (r) {
                $("#LIcustInfo").after(r);
                setTimeout(function () {
                    $('.tooltipped').tooltip({delay: 50});
                    $('select').material_select();
                    initMap();
                    $('.datepicker').pickadate({
                        selectMonths: true, // Creates a dropdown to control month
                        selectYears: 15 // Creates a dropdown of 15 years to control year
                    });
                    $('.clockpicker').clockpicker({
                        placement: 'bottom',
                        align: 'left',
                        autoclose: true,
                        'default': 'now'
                    });
                    $(".clockpicker1").timepicker();
                }, 2000);
            }
        });
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
    }
    );


</script>
<?php include _PATH . "instance/front/tpl/google_maps.js.php"; ?>
