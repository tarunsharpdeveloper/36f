<?php include _PATH . "instance/front/tpl/libValidate.php" ?>


<script type="text/javascript">
    $(document).ready(function () {
        
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
            url: '<?php echo _U ?>people',

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
//            url: '<?php echo _U ?>people',
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
            url: '<?php echo _U ?>people',

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
            url: '<?php echo _U ?>people',

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
            url: '<?php echo _U ?>people',

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
            url: '<?php echo _U ?>people',

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
            url: '<?php echo _U ?>people',

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
            url: '<?php echo _U ?>people?id="1"',

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