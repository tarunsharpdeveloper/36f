

<!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>js/jquery.timepicker.js"></script>-->

<!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/jquery.timepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/pikaday/css/pikaday.css"/>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/pikaday/pikaday.js"></script>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/pikaday/plugins/pikaday.jquery.js"></script>-->
<?php include _PATH . "instance/front/tpl/libValidate.php" ?>
<script type="text/javascript">
//    $(".delete").click(){
//        alert($(this).data("userid"));
//    }
    function deleteposts(posts) {
//        alert(posts);
        $.ajax({
            url: '<?php echo _U ?>newsfeed',
            data: {
                deleteposts: 1,
                posts: posts
            }, success: function (r) {
                $('#divCommentsPost').html(r);
            }
        });
    }
    function deletecomments(tbcommentid) {
//        alert(tbcommentid);
        $.ajax({
            url: '<?php echo _U ?>newsfeed',
            data: {
                deletecomments: 1,
                tbcommentid: tbcommentid
            }, success: function (r) {
                $('#divCommentsPost').html(r);
            }
        });
    }
//    $(".delete").click(function () {
//        // Holds the product ID of the clicked element
//        var productId = $(this).data('userid');
//
//        alert(productId);
//    });
    function checkboxval(btn) {
//        alert(btn);
        $.ajax({
            url: '<?php echo _U ?>newsfeed',
            //dataType: "json",
//            type: 'POST',
            data: {
                clicktobtnview: 1,
                btn: btn
//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
//                callCommentsPostDiv();
//                alert(r);
                $('#divCommentsPost').html(r);
//                $('#hid_emp_id').val(id);
//                enabledisable();
            }
        });
    }
    function SaveComment(pid, comments) {
//        alert("POST ID=" + pid + " Comments = " + comments);
//trim(comments);
        var c = $.trim(comments);
//        alert(c);
        if (c === "" || c === null) {
            $("#comment" + pid).val("");
            $("#comment" + pid).focus();
        } else {
            $.ajax({
                url: '<?php echo _U ?>newsfeed',
                //dataType: "json",
//            type: 'POST',
                data: {
                    SaveSubComment: 1,
                    id: <?= $_SESSION['user']['id']; ?>,
                    postid: pid,
                    comments: comments
//                dates: $("#daterangepicker-time").val()
                }, success: function (r) {
//                alert(r);
                    $('#divCommentsPost').html(r);
//                $('#hid_emp_id').val(id);
//                enabledisable();
                }
            });
        }
    }
    function callCommentsPostDiv() {
//        alert("r");
        $.ajax({
            url: '<?php echo _U ?>newsfeed',
            //dataType: "json",
//            type: 'POST',
            data: {
                divCommentsPost: 1,
                id: <?= $_SESSION['user']['id']; ?>
//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
//                alert(r);
                $('#divCommentsPost').html(r);
//                $('#hid_emp_id').val(id);
//                enabledisable();
            }
        });
    }
//    $('#department').load('content.php')
//    
//    alert("Call");
    $('#datatable-responsive').DataTable({
        responsive: true
    });
    $('.dataTables_filter input').attr("placeholder", "Search...");
    $(document).ready(function () {

        callCommentsPostDiv();
//        $('#emptable').DataTable({
//            "responsive": true,
//            "paging": false,
//            "ordering": false,
//            "info": false,
//            "bFilter": true
//        });
        Dropzone.options.myAwesomeDropzone = {
            maxFiles: 2,
            accept: function (file, done) {
                console.log("uploaded");
                done();
            },
            init: function () {
                var myDropZone = this;
                myDropZone.on("maxfilesexceeded", function (file) {
//                    alert("No more files please!");
                    myDropZone.removeFile(file);
                    _toast("danger", "Warning", "No more files please!");
                    myDropZone.removeFile(file);
                });
            }
        };

        start_end_time();
        $('#st1_link').css('background-color', '#C71418');
        $('#st1_link').css('color', 'white');
        $('#st1_link').css('border-radius', '30px');
//        $("#veh_lic_no").inputmask("Regex");
//        $("#veh_lic_no").inputmask("(99) 99A999");
        $("#phone").focusout(function () {
            var cell = $("#phone").val();
            var cell_under = cell.indexOf("_");
            if (cell_under < 14 && cell_under > 0) {
                $("#phone").focus();
                $("#phone").css('background', '#FFCDD2');
            } else {
                $("#phone").css('background', '');
            }
//            phoneValidate();
        });
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
            url: '<?php echo _U ?>timesheet',
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

        var y = document.timesheet.phone.value;
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
                url: '<?php echo _U ?>timesheet',
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
//        $('#timesheet_form').parsley().on('field:validated', function () {
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
    $("#timesheetCardPanel").removeClass("panelWait");
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
            url: '<?php echo _U ?>timesheet',
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
