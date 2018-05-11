<?php include _PATH . "instance/front/tpl/libValidate.php" ?>


<script type="text/javascript">
    $("body").on("change", ".show_preview", function ()
    {
        var prev_id = $(this).data('prev_id');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            return
        }
        ;
        //if (/^image/.test( files[0].type))
        var reader = new FileReader();
        reader.readAsDataURL(files[0]);
        reader.onloadend = function () {
            $("#" + prev_id).show();
            $("#" + prev_id).css("background-image", "url(" + this.result + ")");
        };
    });

    $("#add_people").validate({
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
    $(document).ready(function () {

        $('.rbtgender').click(function () {
            if ($(this).is(':checked') && $(this).val() === "Male") {
                $("#militryDiv").slideDown();
            } else {
                $("#militryDiv").slideUp();
            }
        });
        $('.rbttolrance').click(function () {
            if ($(this).is(':checked') && $(this).val() === "Yes") {
                $("#tolrance_div").slideDown();
            } else {
                $("#tolrance_div").slideUp();
            }
        });
        $('.rbtpregnancy').click(function () {
            if ($(this).is(':checked') && $(this).val() === "Yes") {
                $("#pregnancy_div").slideDown();
            } else {
                $("#pregnancy_div").slideUp();
            }
        });
        $('.rbtveteran').click(function () {
            if ($(this).is(':checked') && $(this).val() === "Yes") {
                $("#veteran_div").slideDown();
            } else {
                $("#veteran_div").slideUp();
            }
        });
        $('.rbtovertime').click(function () {
            if ($(this).is(':checked') && $(this).val() === "Yes") {
                $("#overtime_div").slideDown();
            } else {
                $("#overtime_div").slideUp();
            }
        });


    });
    $("input:checkbox").on('click', function () {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });
    $('#newLeave').on('hidden', function () {
        // do something…
        $("#View-People").toggle();

    });
    $('#View-People').on('show', function (e) {
//       alert("Model calls ");// stops modal from being shown
    });
    $('#pay_rates').on('change', function () {

        var value2 = this.value;
        if (value2 == "Hourly") {
            $(".hourly").css("display", "inline");
            $(".hourlyplus").css("display", "none");
            $(".annual").css("display", "none");
            $(".days").css("display", "none");
        } else if (value2 == "Hourly_overtime") {
            $(".hourly").css("display", "none");
            $(".hourlyplus").css("display", "block");
            $(".annual").css("display", "none");
            $(".days").css("display", "none");
        } else if (value2 == "Salary") {
            $(".hourly").css("display", "none");
            $(".hourlyplus").css("display", "none");
            $(".annual").css("display", "inline");
            $(".days").css("display", "none");
        } else if (value2 == "Rate_per_day") {
            $(".hourly").css("display", "none");
            $(".hourlyplus").css("display", "none");
            $(".annual").css("display", "none");
            $(".days").css("display", "inline");
        } else {
        }
    }
    );
    $("#hourly_rate").keyup(function () {
        var rate = $("#hourly_rate").val();
        var overtime_rate = rate * 1.5;
        $("#overtime_rate").val(overtime_rate);
    });
//    $(function () {
    $('.selectall').on('click', function () {
        $("#select_person").html("");
        $("#bulk_select_id_count").val("");
        $("#bulk_select_id").val("");
        $('.child').prop('checked', this.checked);
        var count = $("input[name='nchild[]']:checked").length;
        //$("#bulk_select_id").val(val);
        if (count >= "1") {
            $("#select_person").html("<strong>" + count + "</strong> people selected");
            $("#bulk_select_id_count").val(count);
            $("#Bulk_li").removeClass("disabled");

        } else {
            $("#select_person").html("");
            $("#bulk_select_id_count").val("");
            $("#bulk_select_id").val("");
            $("#Bulk_li").addClass("disabled");

        }
    });

//    });

//    $(function () {
//    $('th input[type="checkbox"]').click(function(){
//        if ( $(this).is(':checked') )
//            $('td input[type="checkbox"]').prop('checked', true);
//        else
//            $('td input[type="checkbox"]').prop('checked', false);
//    })
//});
//    $(function () {
    $('.selectall').click(function () {
        $("#select_person").html("");
        $("#bulk_select_id_count").val("");
        $("#bulk_select_id").val("");
        var val = [];
        var count = '';
        $(':checkbox:checked').each(function (i) {
            val[i] = $(this).val();

            if (val == "on") {
                $("#bulk_select_id").val("");
                $("#Bulk_li").addClass("disabled");
            } else {
                ++count;
//                    alert(count);
                $("#select_person").html("<strong>" + (count - 1) + "</strong> people selected");

                $("#bulk_select_id").val(val);
                $("#bulk_select_id_count").val(count - 1);

                $("#Bulk_li").removeClass("disabled");
            }

        });
    });
//    });
    $('#pay_rates_model').on('change', function () {

        var value2 = this.value;
        if (value2 == "Hourly") {
            $(".hourly_model").css("display", "inline");
            $(".hourlyplus_model").css("display", "none");
            $(".days_model").css("display", "none");
        } else if (value2 == "Hourly_overtime") {
            $(".hourly_model").css("display", "none");
            $(".hourlyplus_model").css("display", "block");
            $(".days_model").css("display", "none");
        } else if (value2 == "Rate_per_day") {
            $(".hourly_model").css("display", "none");
            $(".hourlyplus_model").css("display", "none");
            $(".days_model").css("display", "inline");
        } else {
        }
    }
    );
    $("#hourly_rate_model").keyup(function () {
        var rate = $("#hourly_rate_model").val();
        var overtime_rate = rate * 1.5;
        $("#overtime_rate_model").val(overtime_rate);
    });
//    $(function () {
    $('.show-field').on('click', function () {
        var id = $(this).val();
        var ischecked = $(this).is(':checked');
        if (ischecked == true) {
            $("#tbl_" + id).css("display", "inline-block");
            $(".tbl_sub_" + id).css("display", "inline-block");
        } else {
            $("#tbl_" + id).css("display", "none");
            $(".tbl_sub_" + id).css("display", "none");
        }




    });

//    });
//    $(function () {
    $('.child').click(function () {
        var val = [];
        $(':checkbox:checked').each(function (i) {
            val[i] = $(this).val();
            $("#all").attr("checked", false);
            $("#bulk_select_id").val(val);
            var count = $("input[name='nchild[]']:checked").length;

            if (count == "0") {
                $("#bulk_select_id_count").val("");
                $("#Bulk_li").addClass("disabled");
            } else {
                $("#bulk_select_id_count").val(count);
                $("#Bulk_li").removeClass("disabled");
            }

            if (count > 0) {
//                    alert(count);
                $("#select_person").html("<strong>" + count + "</strong> people selected");
                $("#Bulk_li").removeClass("disabled");
            } else {
                $("#select_person").html("");
                $("#bulk_select_id").val("");
                $("#Bulk_li").addClass("disabled");
            }

        });
    });
//    });
</script>
<script>
    function toastCall() {
<?php if ($_SESSION['success'] === "1") { ?>
            _toast("success", "<?php echo $_SESSION['msg']; ?>");
<?php } else { ?>
            _toast("warning", "<?php echo $_SESSION['msg']; ?>");
<?php } ?>
    }
    function BultActions(name) {

        var ids = $('#bulk_select_id').val();
//        alert(ids);
        var counts = $('#bulk_select_id_count').val();
//        alert(counts);
//        if (counts == 1) {
//            var arr = ids.split(',');
//            var arrrr = arr[0].split('-');
//            $('#lbl_' + name).html(arrrr[1]);
//        } else {
//            $('#lbl_' + name).html(+counts + " employees");
//        }
        $('#lbl_' + name).html(+counts + " employees");
        $('#ids_' + name).val(ids);
        $('#counts_' + name).val(counts);
        $('#' + name).modal('show');


    }
    function SetAccessModel() {
//    var access_level = $("#access_level").val();
        $.ajax({
            url: '<?php echo _U ?>add_people',

            dataType: "json",
            type: "post",
            data: {
                SetAccessModel: 1,
                Formdata: $("#SetAccess_form").serialize()

//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
//                $("#RefreshDiv").html(r);
                if (r.success > 0) {
//                    RefereshPeople();
                    $("#" + r.model).modal('hide');
                    _toast("success", r.msg);
                    //$( "#RefreshTableData" ).load( "people_data" );
//                   $("#test").load(" #test");
//                 $("#testing").load(window.location + " #testing");
//                    $( "#testing" ).load( "people.php #testing" );

                } else {
                    RefereshPeople();
                    $("#" + r.model).modal('hide');
                    _toast("warning", r.msg);
                }

            }});

    }
//    function StreesProfileModel() {
////    var access_level = $("#access_level").val();
//        $.ajax({
//            url: '<?php echo _U ?>add_people',
//
//            dataType: "json",
//            type: "post",
//            data: {
//                StreesProfileModel: 1,
//                Formdata: $("#StreetProfile_form").serialize()
//
////                dates: $("#daterangepicker-time").val()
//            }, success: function (r) {
//                if (r.success > 0) {
//                    $("#" + r.model).modal('hide');
////                   $("#test").load(" #test");
////                 $("#testing").load(window.location + " #testing");
////                    $( "#testing" ).load( "people.php #testing" );
//                    _toast("success", r.msg);
//                } else {
//                    $("#" + r.model).modal('hide');
//                    _toast("warning", r.msg);
//                }
//
//            }});
//
//    }
    function StreesProfileModel() {
//    var access_level = $("#access_level").val();
        $.ajax({
            url: '<?php echo _U ?>add_people',

            dataType: "json",
            type: "post",
            data: {
                StreesProfileModel: 1,
                Formdata: $("#StreetProfile_form").serialize()

//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
                if (r.success > 0) {
                    $("#" + r.model).modal('hide');

//                   $("#test").load(" #test");
//                 $("#testing").load(window.location + " #testing");
//                    $( "#testing" ).load( "people.php #testing" );
                    _toast("success", r.msg);
                } else {
                    $("#" + r.model).modal('hide');
                    _toast("warning", r.msg);
                }

            }});

    }
    function RefereshPeople() {
        $.ajax({
            url: '<?php echo _U ?>add_people',

//            dataType: "json",
//            type: "post",
            data: {
                RefereshPeople: 1

            }, success: function (r) {
                $("#RefreshTableData").html(r);
//                $("#bulk_select_id").val("");
//                $("#bulk_select_id_count").val("");
//                $("#select_person").html("");
            }});
    }
    function AddTrainingModel() {
        if ($("#training_model").val() == "" || $("#training_model").val() == null || $("#training_model").val() == "null") {
            $("#training_model").focus();
            $("#error_trainig_model").html("Training Fields Required");
            return false;
        }
        $("#error_trainig_model").html("");
        $.ajax({
            url: '<?php echo _U ?>add_people',

            dataType: "json",
            type: "post",
            data: {
                AddTrainingModel: 1,
                Formdata: $("#AddTraining_form").serialize()

//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
                if (r.success > 0) {
                    $("#" + r.model).modal('hide');
//                   $("#test").load(" #test");
//                 $("#testing").load(window.location + " #testing");
//                    $( "#testing" ).load( "people.php #testing" );
                    _toast("success", r.msg);
                } else {
                    $("#" + r.model).modal('hide');
                    _toast("warning", r.msg);
                }

            }});

    }
    function SetRateModel() {
        var Value = $("#pay_rates_model").val();
        $("#error_hourly").html("");
        $("#error_Rate_per_day").html("");
        $("#error_Hourly_overtime").html("");
        if (Value == "Hourly") {
            $("#error_hourly").html("");
            $("#error_Rate_per_day").html("");
            $("#error_Hourly_overtime").html("");
            var weekday_rate_model = $("#weekday_rate_model").val();
            var saturday_rate_model = $("#saturday_rate_model").val();
            var sunday_rate_model = $("#sunday_rate_model").val();
            var public_h_rate_model = $("#public_h_rate_model").val();
            if (weekday_rate_model == "" || saturday_rate_model == "" || sunday_rate_model == "" || public_h_rate_model == "") {
                $("#error_hourly").html("All Fields Required");
                return true;
            }
        } else if (Value == "Hourly_overtime") {
            $("#error_hourly").html("");
            $("#error_Rate_per_day").html("");
            $("#error_Hourly_overtime").html("");
            var hourly_rate_model = $("#hourly_rate_model").val();
            if (hourly_rate_model == "") {
                $("#error_Hourly_overtime").html("All Fields Required");
                return true;
            }
        } else if (Value == "Rate_per_day") {
            $("#error_hourly").html("");
            $("#error_Rate_per_day").html("");
            $("#error_Hourly_overtime").html("");
            var day_m_rate_model = $("#day_m_rate_model").val();
            var day_t_rate_model = $("#day_t_rate_model").val();
            var day_w_rate_model = $("#day_w_rate_model").val();
            var day_th_rate_model = $("#day_th_rate_model").val();
            var day_f_rate_model = $("#day_f_rate_model").val();
            var day_sat_rate_model = $("#day_sat_rate_model").val();
            var day_sun_rate_model = $("#day_sun_rate_model").val();
            var day_holi_rate_model = $("#day_holi_rate_model").val();
            if (day_m_rate_model == "" || day_t_rate_model == "" || day_w_rate_model == "" || day_th_rate_model == "" || day_f_rate_model == "" || day_sat_rate_model == "" || day_sun_rate_model == "" || day_holi_rate_model == "") {
                $("#error_Rate_per_day").html("All Fields Required");
                return true;
            }
        } else {

        }
        $("#error_hourly").html("");
        $("#error_Rate_per_day").html("");
        $("#error_Hourly_overtime").html("");

        $.ajax({
            url: '<?php echo _U ?>add_people',

            dataType: "json",
            type: "post",
            data: {
                SetRateModel: 1,
                Formdata: $("#SetRate_form").serialize()

//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
                if (r.success > 0) {
                    $("#" + r.model).modal('hide');
//                   $("#test").load(" #test");
//                 $("#testing").load(window.location + " #testing");
//                    $( "#testing" ).load( "people.php #testing" );
                    _toast("success", r.msg);
                } else {
                    $("#" + r.model).modal('hide');
                    _toast("warning", r.msg);
                }

            }});

    }
    function discardPeople(id) {
//        alert("Deleted =" + id);
        $.ajax({
            url: '<?php echo _U ?>add_people',

            dataType: "json",
//            type: "post",
            data: {
                discardPeople: 1,
                id: id

//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
                if (r.success > 0) {
//                    $("#" + r.model).modal('hide');
                    _toast("success", r.msg);
                } else {
//                    $("#" + r.model).modal('hide');
                    _toast("warning", r.msg);
                }

            }});
    }
    function EditPeople(id) {
//    $("#View-People").modal("show");
        $("#Edit-People").modal("show");


    }
    function callModalLeave() {
//        alert("Call");
        var id = $("#hidid").val();
        $("#newLeave").modal("show");
//        $("#view-people_modal-dialog").css("width","700px");
//        $("#view-people_modal-dialog").css("transition","2");
        $("#View-People").toggle();

    }

    function ViewPeople(id) {
        $.ajax({
            url: '<?php echo _U ?>add_people?id="1"',

            dataType: "json",
            type: "GET",
            data: {
                bindviewPeople: 1,
                id: id

//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
//                alert(r.fname);
                $("#hidid").val(r.id);
                $("#imgTeamProfilePhoto").attr("src", "docs/" + r.photo);
                var content = "<h5><b>" + r.fname + " " + r.lname + "</b></h5>";
                content += "<h6>" + r.access_level + "</h6>";
                var d = r.dob;
                var d = d.split(" ");
//                alert(d[0]);
                content += "<div class='col-sm-12' style='text-align:center;'><i class='fa fa-calendar'></i> <label>" + d[0] + "</label></div>";
                content += "<div class='col-sm-12' style='text-align:center;'><i class='fa fa-mobile'></i> <label>" + r.mobile + "</label></div>";
                content += "<div class='col-sm-12' style='text-align:center;'><i class='fa fa-envelope'></i> <label>" + r.email + "</label></div>";
                $("#PeopleDetails").html(content);
                $("#View-People").modal("show");
            }});
//        $("#Edit-People").modal("show");

    }

</script>
<?php include _PATH . "instance/front/tpl/google_maps.js.php"; ?>