<?php include _PATH . "instance/front/tpl/libValidate.php" ?>
<script type="text/javascript">
    $(".mContent").change(function () {
//        alert("Handler for .change() called.");
        onchangeGetTime();
    });
    $(document).ready(function () {
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
            url: '<?php echo _U ?>me_home',
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
    function Break(val) {
        BreakEntry(val);
        BreakButton(val);

    }

    function BreakButton(val) {
        if (val == '0') {
            $('#start_break').hide();
            $('#end_break').show();
        } else if (val == '1') {
            $('#start_break').show();
            $('#end_break').hide();
        } else {

        }

    }
    function BreakEntry(val) {
        $.ajax({
            url: '<?php echo _U ?>me_home',
            dataType: "json",
            data: {

                BreakShift: 1,
                id: val

            }, success: function (r) {
                click_load_shift();

                if (r.shift != "") {
                    $("#startshiftdisplay").html("<div style='color: green;font-size: 16px;font-weight: bold;'><span>On Break</span></div><div><span>break</span></div>");
                } else {
                    $("#startshiftdisplay").html("<div style='color: green;font-size: 16px;font-weight: bold;'><span>On Shift</span></div><div><span>Started " + r.starttime + "</span></div>");
                }

            }
        });
    }



    function Shift(val) {
        ShiftEntry(val);
        StartButton(val);
    }
    function StartButton(val) {
        if (val == '0') {
            $('#start').hide();
            $('#end').show();
            $('#start_break').show();


        } else if (val == '1') {
            $('#start').show();
            $('#end').hide();
            $('#start_break').hide();
            $('#end_break').hide();


        } else {

        }

    }
    function ShiftEntry(val) {
        $.ajax({
            url: '<?php echo _U ?>me_home',
            dataType: "json",
            data: {

                StartShift: 1,
                id: val

            }, success: function (r) {
                click_load_shift();
                if (r.shift != "") {
                    $("#startshiftdisplay").html("<div style='color: green;font-size: 16px;font-weight: bold;'><span>On Shift</span></div><div><span>Started " + r.starttime + "</span></div>");
                } else {
                    $("#startshiftdisplay").html("");
                }

            }
        });
    }
    function click_load_shift() {
        $("#divsDate").html("");
        $("#divsDay").html("");
        $.ajax({
            url: '<?php echo _U ?>me_home',
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
    }
    function Add_End_Shift() {

        var start_time = $("#start_time").val();
        var end_time = $("#end_time").val();
        var break_time = $("#break_time").val();
        var note = $("#note").val();


        $("#error_start_time").html("");
        $("#error_end_time").html("");
        $("#error_msg").html("");
        if (start_time == "" || start_time == null) {
            $("#error_start_time").html("Start Time Fields Required");
        } else if (end_time == "" || end_time == null) {
            $("#error_end_time").html("End Time Fields Required");
        } else {

            $.ajax({
                url: '<?php echo _U ?>me_home',
                dataType: "json",
                data: {

                    AddShift: 1,
                    start_time: start_time,
                    end_time: end_time,
                    break_time: break_time,
                    note: note

                }, success: function (r) {
                    if (r.error == 1) {
                        $("#error_msg").html("This timesheet might be deleted because its length is less than minimum length requirement of 15  minutes. Are you sure?");
                    } else {
                        location.reload();
                    }
                }
            });
        }

    }


    function Break_time_update(Start_break_check) {
        alert(Start_break_check);
    }

    function GetShiftDetails(id) {
        $.ajax({
            url: '<?php echo _U ?>me_home',
            dataType: "json",
            data: {
                getShiftDetail: 1,
                id: id
//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {

                $("#start_time").val(r.data.start_time).change();
                $("#end_time").val(r.end_times).change();
                $("#break_time").val(r.data.break_time).change();
                $("#hours_count").html(r.Hours).change();
            }
        });
    }
    function onchangeGetTime() {
        var startTime = $("#start_time").val();
        var endTime = $("#end_time").val();
        var breakTime = $("#break_time").val();
        $.ajax({
            url: '<?php echo _U ?>me_home',
            dataType: "json",
            data: {
                getTotalTime: 1, startTime: startTime, endTime: endTime, breakTime: breakTime

//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {


                $("#hours_count").html(r.Hours).change();
            }
        });
    }
</script>

<script type="text/javascript">
//    showWait();


    $('#fName').autocomplete({
        source: function (request, response) {
            $.ajax({
                url: '<?php echo _U ?>approve_timesheet',
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


</script>
<?php include _PATH . "instance/front/tpl/google_maps.js.php"; ?>
