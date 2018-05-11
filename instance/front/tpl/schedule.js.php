

<!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>js/jquery.timepicker.js"></script>-->

<!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/jquery.timepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/pikaday/css/pikaday.css"/>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/pikaday/pikaday.js"></script>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/pikaday/plugins/pikaday.jquery.js"></script>-->
<?php include _PATH . "instance/front/tpl/libValidate.php" ?>

<script>
//    $(function () {
//        $(".bootstrap-datepicker").bsdatepicker({
//            onSelect: function (dateText) {
//                display("Selected date: " + dateText + "; input's current value: " + this.value);
//            }
//        }).on("blur", function () {
//               $("<p>").html(msg).appendTo(document.body);
//        });
//    });
    function getDayViseData(selectedDate) {
        $.ajax({
            url: '<?php echo _U ?>schedule',
            dataType: "json",
            data: {

                getDayViseData: 1,
                selectedDate: selectedDate

            }, success: function (r) {
                alert(r.weeks);
                var htmacontent = "";
                var subcontents = "";
                var accordianDivstart = "";
                htmacontent += "<div class='panel'><div class='panel-body'><div class='container'><span style='float:right;'>Selected Date:<big>" + selectedDate + "</big><span></div><div id='exTab1' class='container'><ul  class='nav nav-pills'><li class='active'><a  href='#tasks' data-toggle='tab'>Task Summry</a></li><li><a href='#timesheets' data-toggle='tab'>TimeSheet Summry</a></li></ul><div class='tab-content clearfix'><div class='tab-pane active' id='tasks'>";
                htmacontent += "<div id='accordion' class='panel-group'>";
                subcontents += "<div class='panel'><div class='panel-heading'><h4 class='panel-title'><a class='' data-toggle='collapse' data-parent='#accordion' href='#collapseOne' aria-expanded='false'> TASK 1 </a></h4></div><div id='collapseOne' class='panel-collapse collapse in' aria-expanded='false' style=''><div class='panel-body'> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div></div></div></div>";
                subcontents += "<div class='panel'><div class='panel-heading'><h4 class='panel-title'><a class='' data-toggle='collapse' data-parent='#accordion' href='#collapseTwo' aria-expanded='false'> TASK 2</a></h4></div><div id='collapseTwo' class='panel-collapse collapse in' aria-expanded='false' style=''><div class='panel-body'> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div></div>";
                htmacontent += "<h3>Content's background is The TASK the tab</h3>";
                htmacontent += subcontents;


                htmacontent += "</div></div><div class='tab-pane ' id='timesheets'>";
                htmacontent += "<h3>Content's background is the Summery time sheet the tab</h3>";
                htmacontent += "</div></div></div></div>";
                $("#divsDayDetails").html(htmacontent);
//                $("#divsDayDetails").html("<div class='panel'><div class='panel-body'><div class='container'><span style='float:right;'>Selected Date:<big>" + selectedDate + "</big><span></div><div id='exTab1' class='container'><ul  class='nav nav-pills'><li class='active'><a  href='#tasks' data-toggle='tab'>Task Summry</a></li><li><a href='#timesheets' data-toggle='tab'>TimeSheet Summry</a></li></ul><div class='tab-content clearfix'><div class='tab-pane active' id='tasks'><h3>Content's background is The TASK the tab</h3>" + htmacontent + "</div><div class='tab-pane active' id='timesheets'><h3>Content's background is the Summery time sheet the tab</h3>" + ContentsCall() + "</div></div></div></div>");
//        alert($(this).attr('data-id'));


            }
        });
    }
    function ContentsCall() {
        return "<div><h1>Contents Call function</h1></div>"
    }
    $(document).on('click', ".tb_div", function () {
        //code here ....
        var selectedDate = $(this).attr('data-id');
        getDayViseData(selectedDate);
//        $("#divsDayDetails").html("<div class='panel'><div class='panel-body'>" + $(this).attr('data-id') + "</div></div>");

    });
    $('.datepicker').datepicker({onSelect: function () {
            $("#divsDay").html("");
            var mon = $(this).datepicker('getDate');
            var st = new Date(mon);
//            alert(st.getUTCDate());

//            alert(st.getYear() + '-' + st.getMonth() + '-' + st.getDate());
            $.ajax({
                url: '<?php echo _U ?>schedule',
                dataType: "json",
                data: {

                    DivsDate: 1,
                    selectDate: $("#sDate").val()

                }, success: function (r) {
//                    alert(r.weeks);
                    for (var i = 0; i < 7; i++) {
//                alert(mon + ' || ' + sun);
//                        var tempdate = new Date(mon.getDate());
//                var today = new Date('12/31/2015');
//                var tomorrow = new Date(today);
//                tomorrow.setDate(today.getDate() + 1);
//                tomorrow.toLocaleDateString();
                        var t_data = r.weeks_month[i];
                        var t_id = r.weeks[i];
                        var t_dayname = r.dayname[i];
                        var t_dayno = r.dayno[i];
                        $("#divsTot").append("<div style='width:14.285%;float:left;text-align:center'>" + t_id + "</div>");
                        $("#divsDay").append("<div class='tb_div  btn-primary weeks_divs' data-id=" + t_id + " id='" + t_id + "'>" + t_dayname + "<br/><big>" + t_dayno + "</big></div>");
                    }
                }
            });
//            alert(mon.setDate(mon.getDate() + 1 - (mon.getDay() || 7)));
//            mon.setDate(mon.getDate() + 1 - (mon.getDay() || 7));
//            var tt = new Date(mon);
//            var mm = mon.setDate(mon.getDate() + 1);
////            alert(tt);
//            var sun = new Date(mon.getTime());
//            sun.setDate(sun.getDate() + 6);

        }});
    $(".weeks_divs").on("click", function () {

        alert$("Day Click");
    });
    function display(msg) {
//        alert(msg);
    }
    $(document).ready(function () {

//        alert("JS CALL when ready");
        start_end_time();
        $('#st1_link').css('background-color', '#C71418');
        $('#st1_link').css('color', 'white');
        $('#st1_link').css('border-radius', '30px');
    });
//    $(function () {
    //"use strict";

    //  });
    function CallDivs() {

//        alert($("#sDate").val());
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
    $("#schedule_form").validate({
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
            url: '<?php echo _U ?>schedule',
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
                    $("#schedule_form").submit();
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
</script>

<script type="text/javascript">
//    alert("Call");
    $('#datatable-responsive').DataTable({
        responsive: true
    });
    $('.dataTables_filter input').attr("placeholder", "Search...");
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
            url: '<?php echo _U ?>schedule',
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

        var y = document.schedule.phone.value;
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
                url: '<?php echo _U ?>schedule',
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
//        $('#schedule_form').parsley().on('field:validated', function () {
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
    $("#scheduleCardPanel").removeClass("panelWait");
    hideWait();
//    function initMap() {
//        $(".gMapSuggest").each(function (i, v) {
//            new google.maps.places.Autocomplete(document.getElementById($(v).attr("id")));
//        });
//    }

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
            url: '<?php echo _U ?>schedule',
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
<?php //include _PATH . "instance/front/tpl/google_maps.js.php";  ?>
