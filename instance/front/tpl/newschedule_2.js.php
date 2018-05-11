

<!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>js/jquery.timepicker.js"></script>-->

<!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/jquery.timepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/pikaday/css/pikaday.css"/>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/pikaday/pikaday.js"></script>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/pikaday/plugins/pikaday.jquery.js"></script>-->
<?php include _PATH . "instance/front/tpl/libValidate.php" ?>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/interactions-ui/resizable.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/interactions-ui/draggable.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/interactions-ui/sortable.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/interactions-ui/selectable.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/daterangepicker/moment.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/calendar/calendar.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/calendar/calendar-demo.js"></script>

<script>
    $(document).on('change keyup', "#hidtotalHour", function () {
        var hour = $(this).val();
        $("#deductTime").val(countDeduct(hour));
    });
    function countDeduct(hour) {
        var minutes = "";
        if (hour >= 16) {
            minutes = 16 * 55;
        } else {
            minutes = hour * 55;
        }
        return minutes;
    }
    function deleteShift() {
        var shiftId = $("#hidshiftId").val();
        $("#div_deleted").html(" <a class='btn btn-danger' href='javascript:void(0);' onclick='deleteShiftConfirm(" + shiftId + ")'>Are you sure to delete this shift?</a>");
    }
    function deleteShiftConfirm(id) {
        $.ajax({
            url: '<?php echo _U ?>newschedule_2',
            dataType: "json",
            data: {
                deleteShift: 1, shiftId: id
            }, success: function (r) {
//                alert(r.success);
                if (r.success === "1") {
                    _toast("success", "Approved", r.msg);
                    $("#myModal2").modal("hide");
                    var selectedWeek = $("#currentSelect").val();
                    var DD = $("#SelectDate").val();
                    if (selectedWeek === "1week") {
                        CallWeek(DD);
                    }
                    if (selectedWeek === "2week") {
                        Call2Week(DD);
                    }
                    if (selectedWeek === "4week") {
                        Call4Week(DD);
                    }
                } else {
                    _toast("danger", "Decliend", r.msg);
                }
            }});
    }
    function UpdateShift(shiftId) {

        var selectLocations = $("#selectLocations").val();
//        alert(selectLocations);
        var startDate = $("#dateofshift").val();
        var endDate = $("#enddateofshift").val();
        var startTime = $("#start_time").val();
        var endTime = $("#end_time").val();
        var note = $("#md_txtnotes").val();
        var patTime = /^(?:[01]\d|2[0-3])(?::?[0-5]\d)?$/;
        var patDate = /^([0-9]{4}-[0-1][0-9]-[0-3][0-9])?$/;
        var IsTrueST = patTime.test(startTime);
        var IsTrueET = patTime.test(endTime);
        var IsTrueSDT = patDate.test(startDate);
        var IsTrueEDT = patDate.test(endDate);
        if (!IsTrueSDT)
        {
            $("#error_start_date").html("Invalid Input");
            return false;
        } else if (!IsTrueEDT)
        {
            $("#error_end_date").html("Invalid Input");
            return false;
        } else if (!IsTrueST) {
            $("#error_start_time").html("Invalid Input");
            return false;
        } else if (!IsTrueET) {
            $("#error_end_time").html("Invalid Input");
            return false;
        } else {
            if (startTime == "" || startTime == null) {
                $("#error_start_time").html("Start Time Fields Required");
            } else if (endTime == "" || endTime == null) {
                $("#error_end_time").html("End Time Fields Required");
            } else if (selectLocations == "" || selectLocations == null) {
                $("#error_location").html("Location Fields Required");
            } else {
                var error1 = $("#error_start_date").text().length;
                var error2 = $("#error_end_date").text().length;
                var error3 = $("#error_start_time").text().length;
                var error4 = $("#error_end_time").text().length;
                var error5 = $("#error_location").text().length;
                if (error1 || error2 || error3 || error4 || error5) {
                    return false;
                }
                $.ajax({
                    url: '<?php echo _U ?>newschedule_2',
                    dataType: "json",
                    data: {

                        updateShift: 1,
                        shiftId: shiftId,
                        start_time: startTime,
                        end_time: endTime,
                        start_date: startDate,
                        end_date: endDate,
                        totalHour: $("#hidtotalHour").val(),
                        title: $("#hidtitle").val(),
                        location: $("#selectLocations").val(),
                        note: note,
                        shifttype: $("#selectShiftType").val(),
                        deduction: $("#deductTime").val(),
                        shiftcolor: $("#hidshiftcolor").val()

                    }, success: function (r) {
                        if (r.success === "1") {
                            _toast("success", "Approved", r.msg);
                            $("#myModal2").modal("hide");
                            var selectedWeek = $("#currentSelect").val();
                            var DD = $("#SelectDate").val();
                            if (selectedWeek === "1week") {
                                CallWeek(DD);
                            }
                            if (selectedWeek === "2week") {
                                Call2Week(DD);
                            }
                            if (selectedWeek === "4week") {
                                Call4Week(DD);
                            }
                        } else {
                            _toast("danger", "Decliend", r.msg);
                        }
                    }
                });
            }
        }
    }
    $(document).on('dblclick contextmenu ', ".label", function () {
        var shiftId = this.id;
        $.ajax({
            url: '<?php echo _U ?>newschedule_2',
            dataType: "json",
            data: {
                GetShiftdata: 1,
                shiftId: shiftId
            }, success: function (r) {
                $("#myModal2").modal("show");
                $("#error_start_time").html("");
                $("#div_deleted").html(" <a class='btn btn-danger' href='javascript:void(0);' onclick='deleteShift()'>Click here to Delete</a>");
                if (r.title === "" || r.title === null) {
                    $("#mymodalTitle").html("<span>Click here to Title</span>");
                } else {
                    $("#mymodalTitle").html("<span>" + r.title + "</span>");
                }
                $("#hidtitle").val(r.title);
                $("#dateofshift").val(r.start_date);
                $("#enddateofshift").val(r.end_date);
                $("#hidenddateofshift").val(r.end_date);
                $("#start_time").val(r.start_time);
                $("#end_time").val(r.end_time);
                $("#TotalHr").text(r.TotalHr);
                $("#hidshiftId").val(r.id);
                $("#hiduserId").val(r.user_id);
                $("#deductTime").val(r.deduction);
                $("#hidtotalHour").val(r.total_hour).change();
                $("#hiddateDiff").val(r.date_diff);
//                $("#dateofshift").bsdatepicker("option", "defaultDate", r.start_date);
                $("#dateofshift").bsdatepicker('update', r.start_date);
//                $("#enddateofshift").bsdatepicker("minDate", r.start_date);
//                $("#enddateofshift").bsdatepicker("option", "minDate",r.start_date);

                $("#enddateofshift").bsdatepicker('update', r.end_date);
//                alert(r.area_of_work);
                $.each(r.area_of_work.split(","), function (i, e) {
//                    alert(e);
                    $("#selectLocations option[value='" + e + "']").prop("selected", true);
//                    $("#selectLocations").val(e);
                    $("#selectLocations").trigger('chosen:updated');
                });
//                $("#selectLocations").val(r.area_of_work);
//                $("#selectLocations").trigger('chosen:updated');
                $("#selectLocations").chosen('updated');
                $("#selectShiftType option[value='" + r.shift_type_id + "']").prop("selected", true);
                $("#selectShiftType").trigger('chosen:updated');
                $("#selectShiftType").chosen('updated');
            }});
    });
    $("#start_time").on("change", function () {
        var pat = /^(?:[01]\d|2[0-3])(?::?[0-5]\d)?$/;
        var v = $("#start_time").val();
        var IsTrue = pat.test(v);
        if (IsTrue) {
            $("#error_start_time").html("");
            $.ajax({
                url: '<?php echo _U ?>newschedule_2',
                dataType: "json",
                data: {
                    getHoursWithDiff: 1,
                    start_time: $("#start_time").val(),
                    end_time: $("#end_time").val(),
                    diff: $("#hidtotalHour").val()
                }, success: function (r) {
                    $("#end_time").val(r);
                }});
        } else {
            $("#error_start_time").html("Invalid Input");
            return false;
        }
    });
    $("#dateofshift").on("change", function () {
        ChangeCall();
    });
    $("#dateofshift").on("keypress", function () {
        $("#error_start_date").html("");
    });
    $("#enddateofshift").on("change", function () {
        endChangeCall();
    });
    $("#enddateofshift").on("keypress", function () {
        $("#error_end_date").html("");
    });
    $("#end_time").on("change", function () {
        var pat = /^(?:[01]\d|2[0-3])(?::?[0-5]\d)?$/;
        var v = $("#end_time").val();
        var IsTrue = pat.test(v);
        if (IsTrue) {
            $("#error_end_time").html("");
            $.ajax({
                url: '<?php echo _U ?>newschedule_2',
                dataType: "json",
                data: {
                    getEndTimeHoursDiff: 1,
                    start_time: $("#start_time").val(),
                    end_time: $("#end_time").val(),
                    startDate: $("#dateofshift").val(),
                    endDate: $("#enddateofshift").val(),
                    diff: $("#hidtotalHour").val()
                }, success: function (r) {
                    $("#enddateofshift").val(r.endDate);
                    $("#enddateofshift").bsdatepicker('update', r.end_date);
                    $("#hidtotalHour").val(r.total_hour).change();
                    $("#TotalHr").text(r.TotalHr);
                    $("#hiddateDiff").val(r.diff);
                }});
        } else {
            $("#error_end_time").html("Invalid Input");
            return false;
        }
    });
    $(document).on('click', "#mymodalTitle span", function () {
        $("#mymodalTitle").html("<input type='text' class='form-control' name='headtxtTitle' id='headtxtTitle' value='" + $("#hidtitle").val() + "'>");
    });
    $(document).on('change focusout', "#headtxtTitle", function () {
        $("#hidtitle").val($("#headtxtTitle").val());
        if ($("#headtxtTitle").val() == "") {
            $("#mymodalTitle").html("<span>Click here to Title</span>");
        } else {
            $("#mymodalTitle").html("<span>" + $("#headtxtTitle").val() + "</span>");
        }
    });
    function ChangeCall() {
        var pat = /^([0-9]{4}-[0-1][0-9]-[0-3][0-9])?$/;
        var v = $("#dateofshift").val();
        var IsTrue = pat.test(v);
        if (IsTrue) {
            $("#error_start_date").html("");
            var DayDiff = $("#hiddateDiff").val();
            $.ajax({
                url: '<?php echo _U ?>newschedule_2',
                dataType: "json",
                data: {
                    getdateWithDiff: 1,
                    startDate: $("#dateofshift").val(),
                    diff: DayDiff
                }, success: function (r) {
                    $("#enddateofshift").val(r);
                    $("#enddateofshift").bsdatepicker('update', r);
                }});
        } else {
            $("#error_start_date").html("Invalid Input");
            return false;
        }
    }
    function endChangeCall() {
        var pat = /^([0-9]{4}-[0-1][0-9]-[0-3][0-9])?$/;
        var v = $("#enddateofshift").val();
        var IsTrue = pat.test(v);
        if (IsTrue) {
            $("#error_end_date").html("");
            var DayDiff = $("#hiddateDiff").val();
            var Endshift = $("#hidenddateofshift").val();
            $.ajax({
                url: '<?php echo _U ?>newschedule_2',
                dataType: "json",
                data: {
                    getStartDateWithDiff: 1,
                    shiftID: $("#hidshiftId").val(),
                    userID: $("#hiduserId").val(),
                    endDate: $("#enddateofshift").val(),
                    startDate: $("#dateofshift").val(),
                    startTime: $("#start_time").val(),
                    endTime: $("#end_time").val(),
                    diff: DayDiff
                }, success: function (r) {
//                    alert(r.isShift.length);
//                    OLD LOGIC AS SAME AS HUMANITY
//                    $("#dateofshift").val(r);
//                    $("#dateofshift").bsdatepicker('update', r);
                    if (r.isShift.length >= 1) {
                        var overlap = confirm("Shift was overlapping, do you wanna to continue?");
                        if (overlap) {
                            return true;
                        } else {
                            $("#error_end_date").html("Shift was Overlappnig");
                            return false;
                        }
                    }
                    if (r.isDays > -1) {
                        if (r.total_hour <= 12) {
                            $("#TotalHr").text(r.TotalHr);
                            $("#end_time").change();
                            $("#hidtotalHour").val(r.total_hour).change();
                        } else {
                            var con = confirm("do you wanna to12+ hour shift");
                            if (con) {
                                $("#TotalHr").text(r.TotalHr);
                                $("#hiddateDiff").val(r.diff);
                                $("#end_time").change();
                                $("#hidtotalHour").val(r.total_hour).change();
                            } else {
                                $("#error_end_date").html("Large Hour shift");
                                return false;
                            }
                        }
                    } else {
                        $("#enddateofshift").val(Endshift);
                        $("#enddateofshift").bsdatepicker('update', Endshift);
//                        $("#error_end_date").html("Large Hour shift");
//                        return false;
                    }
                }});
        } else {
            $("#error_end_date").html("Invalid Input");
            return false;
        }
    }

//    $(function () {
//
//        $(".draggable").draggable();
//        $(".draggable").resizable({
//            start: function (e, ui) {
////                alert('resizing started');
//
//            },
//            resize: function (e, ui) {
//
//            },
//            stop: function (e, ui) {
////                alert('resizing stopped');
//            }
//        });
//        $(".droppable").droppable({
//            accept: ".draggable",
//            classes: {
//                "ui-droppable-active": "ui-state-active",
//                "ui-droppable-hover": "ui-state-hover"
//            },
////      drag:function( event, ui ) {
////        $( this )
//////          .addClass( "ui-state-highlight" )
//////          .find( "p" )
////            .html("");
////      },
//            drop: function (event, ui) {
////                alert($(this).attr("id"));
////                alert(event);
//                $(this).html("");
////          .addClass( "ui-state-highlight" )
////          .find( "p" )
////           .html("");
//            }
//        });
//    });
    $(document).on("click", ".colordiv", function () {
        $("#hidshiftcolor").val($(this).data('color'));
    });
    $(function () {
        $("#dateofshift").bsdatepicker({
            autoClose: true,
            onSelect: function (dateText) {
                display("Selected date: ");
            },
            onClose: function (dateText) {
                display("Close" + this.value);
            }
        }).on("changeDate", function () {
            ChangeCall();
        });
        $("#enddateofshift").bsdatepicker({
            autoClose: true,
            onSelect: function (dateText) {
                display("Selected date: ");
            },
            onClose: function (dateText) {
                display("Close" + this.value);
            }
        }).on("changeDate", function () {
            endChangeCall();
        });
    });
    function getDayViseData(selectedDate) {
        $.ajax({
            url: '<?php echo _U ?>newschedule_2',
            dataType: "json",
            data: {

                getDayViseData: 1,
                selectedDate: selectedDate

            }, success: function (r) {
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
                url: '<?php echo _U ?>newschedule_2',
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

        //        alert$("Day Click");
    });
    function display(msg) {
        alert(msg);
    }
//    $(function () {
//        $(".label").draggable();
//        $(".Dropabletd").droppable({
//            accept: ".label",
//            drop: function (e, ui) {
//                ui.draggable.appendTo($(this)).css({
//                    top: "0.4em",
//                    left: "0.2em"
//                });
//            }
//        });
    //    });
    function eventCall(id, dt) {
        //        alert(id);
        var content = "";
        $.ajax({
            url: '<?php echo _U ?>newschedule_2',
            dataType: "json",
            data: {
                eventCall: 1,
                date: dt,
                id: id
            }, success: function (r) {
                var content = "";
                //                for (var i = 0; i <= r.length; i++) {
                jQuery.each(r, function (i, val) {
                    //                    content += val.id;
                    var title = "";
                    if (!val.title == "") {
                        title = "<h5>" + val.title + "</h5><br/>";
                    }
                    if (val.start_date === dt && val.user_id === id) {
                        content += "<span  class='label label-success ui-widget-content filediv unselectable' style='background-color:" + val.shiftcolor + " ' id='" + val.id + "' data-val='" + val.id + "_" + val.start_date + "_" + val.user_id + "'>" + title + val.start_time + "-" + val.end_time + " </span>";
                    }
                });
                $("#" + dt + "_" + id).html(content);
                Dragging();
            }
        });
    }
    function  getColumns(v) {
        var dateId = $("#hidtxthandle").val();
        $.ajax({
            url: '<?php echo _U ?>newschedule_2',
            dataType: "json",
            data: {

                saveAssignShift: 1,
                dateId: dateId,
                time: v

            }, success: function (r) {
//                alert(r.ShiftId);
                $("#hidtxthandle").val();
                $(".dynatext").remove();
                var content = "<span  class='label label-success ui-widget-content filediv unselectable' id='" + r.ShiftId + "'>" + r.startT + "-" + r.endT + " </span>";
                $("#" + dateId).append(content);
                Dragging();
            }
        });
//        $('#myModal2').modal('toggle');
        //        $('#myModal2').css(".display-block");
    }
    function handle(e) {
        //pattern='^(?:[01]\d|2[0-3])(?::?[0-5]\d)?-(?:[01]\d|2[0-3])(?::?[0-5]\d)?$'
        var pat = /^(?:[01]\d|2[0-3])(?::?[0-5]\d)?-(?:[01]\d|2[0-3])(?::?[0-5]\d)?$/;
        $("#errorhadler").val("");
        if (e.keyCode === 13) {

            e.preventDefault(); // Ensure it is only this code that rusn
            //            $("#handle").submit();
            var v = document.getElementById("txthandle").value;
            var IsTrue = pat.test(v);
            if (IsTrue) {
                if ($("#dynflag").val() === "") {
                    getColumns(v);
                    $("#dynflag").val("true");
                }
                //                $('#myModal2').modal('toggle');
            } else {
                $("#errorhadler").val("Error: invalid input");
                //                document.getElementById("txthandle").value = " ";
            }
        }
        if (e.keyCode === 27) {
            //            alert("Escape was pressed was presses");
            $(".dynatext").remove();
        }

    }

    function CallWeeks(DD) {
        var d = new Date();
        if (DD === " ") {
            var DD = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate();
        }
        CallWeek(DD);
    }
    function Call4Week(DD) {
        //        alert(DD);
        var d = new Date();
        if (DD === " ") {
            var DD = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate();
        }

        //        alert(DD);
        $.ajax({
            url: '<?php echo _U ?>newschedule_2',
            dataType: "json",
            data: {

                DivsDate4Week: 1,
                selectDate: DD

            }, success: function (r) {


//                $(r.emp_nm).each(function () {
//                    alert(this);
//                });
                //                    alert(r.weeks);
                var tabelHeading = "";
                tabelHeading += "<td style='width:10%' id='tdDate'>Employee</td>"
                for (var i = 0; i < 29; i++) {

                    var t_data = r.weeks_month[i];
                    var t_id = r.weeks[i];
                    var t_dayname = r.dayname[i];
                    var t_dayno = r.dayno[i];
//                    if (i == "6") {
//                        tabelHeading += "<td style='width:12.5%'>" + t_dayname + ", " + t_data + "</td></tr>";
                    //                    } else {
                    tabelHeading += "<td style='width:3.21%;font-size:12px;'>" + t_dayname + "<br/> " + t_data + "</td>";
//                    }

//                    var tabelBody = "<table id='emptable' class='table table-striped responsive no-wrap' cellspacing='0' width='100%' style='margin: 0px;padding: 0px;width: 100%;'><thead ><tr ><td ></td></tr></thead>";
//                    $("#divsTot").append("<div style='width:14.285%;float:left;text-align:center'>" + t_id + "</div>");
//                            $("#divsDay").append("<div class='tb_div  btn-default weeks_divs' data-id=" + t_id + " id='" + t_id + "'>" + t_dayname + ", " + t_data + "  </div>");

                    //                    tabelHeading = "";
                }
                $("#tabelHeading").html("<tr>" + tabelHeading + "</tr>");
                var tabelBody = "";
                $(r.emp_nm).each(function (index) {
                    //                    alert(this);
                    tabelBody += "<tr><td style='width:10%'><div class='col-xs-3 col-md-3 on-break-tab'>" + this.fname.charAt(0) + this.lname.charAt(0) + "</div>" + this.fname + ' ' + this.lname + " </td>";
                    for (var i = 0; i < 29; i++) {

                        var t_data = r.weeks_month[i];
                        var t_id = r.weeks[i];
                        var t_dayname = r.dayname[i];
                        var t_dayno = r.dayno[i];
                        if (i === "28") {
                            tabelBody += "<td style='width:3.21%' class='Dropabletd' data-employeID='" + this.id + "' data-date='" + t_id + "' id='" + t_id + "_" + this.id + "'></td></tr>";
                        } else {
                            if (r.dayname[i] === "Fri") {
                                tabelBody += "<td style='width:3.21%'' class='Holiday' style='background-color:#D3FFC6;' data-employeID='" + this.id + "' data-date='" + t_id + "' id='" + t_id + "_" + this.id + "'></td>";
                            } else {
                                tabelBody += "<td style='width:3.21%' class='Dropabletd' data-employeID='" + this.id + "' data-date='" + t_id + "' id='" + t_id + "_" + this.id + "'></td>";
                            }
                        }
                        eventCall(this.id, t_id);
//                    var tabelBody = "<table id='emptable' class='table table-striped responsive no-wrap' cellspacing='0' width='100%' style='margin: 0px;padding: 0px;width: 100%;'><thead ><tr ><td ></td></tr></thead>";
//                    $("#divsTot").append("<div style='width:14.285%;float:left;text-align:center'>" + t_id + "</div>");
//                            $("#divsDay").append("<div class='tb_div  btn-default weeks_divs' data-id=" + t_id + " id='" + t_id + "'>" + t_dayname + ", " + t_data + "  </div>");

                    }

                });
                $("#tabelBody").html(tabelBody);
                $("#tdDate").html(r.weekStart[0] + " To " + r.weekStart[28]);
                $("#SelectDate").val(r.weeks[0]);
                $("#currentSelect").val("4week");
                Dragging();
                DynamicTextBox();
                DTTable();
                //                 $('#emptable').DataTable({"responsive": true});
            }
        });
    }
    function Call2Week(DD) {
        var d = new Date();
        if (DD === " ") {
            var DD = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate();
        }

        //        alert(DD);
        $.ajax({
            url: '<?php echo _U ?>newschedule_2',
            dataType: "json",
            data: {

                DivsDate2Week: 1,
                selectDate: DD

            }, success: function (r) {


//                $(r.emp_nm).each(function () {
//                    alert(this);
//                });
                //                    alert(r.weeks);
                var tabelHeading = "";
                tabelHeading += "<td style='width:10%' id='tdDate'>Employee</td>";
                for (var i = 0; i < 14; i++) {

                    var t_data = r.weeks_month[i];
                    var t_id = r.weeks[i];
                    var t_dayname = r.dayname[i];
                    var t_dayno = r.dayno[i];
//                    if (i == "6") {
//                        tabelHeading += "<td style='width:12.5%'>" + t_dayname + ", " + t_data + "</td></tr>";
                    //                    } else {
                    tabelHeading += "<td style='width:6.42%'>" + t_dayname + "<br/> " + t_data + "</td>";
//                    }

//                    var tabelBody = "<table id='emptable' class='table table-striped responsive no-wrap' cellspacing='0' width='100%' style='margin: 0px;padding: 0px;width: 100%;'><thead ><tr ><td ></td></tr></thead>";
//                    $("#divsTot").append("<div style='width:14.285%;float:left;text-align:center'>" + t_id + "</div>");
//                            $("#divsDay").append("<div class='tb_div  btn-default weeks_divs' data-id=" + t_id + " id='" + t_id + "'>" + t_dayname + ", " + t_data + "  </div>");

                    //                    tabelHeading = "";
                }
                $("#tabelHeading").html("<tr>" + tabelHeading + "</tr>");
                var tabelBody = "";
                $(r.emp_nm).each(function (index) {
                    //                    alert(this);
                    tabelBody += "<tr><td style='width:10%'><div class='col-xs-3 col-md-3 on-break-tab'>" + this.fname.charAt(0) + this.lname.charAt(0) + "</div>" + this.fname + ' ' + this.lname + " </td>";
                    for (var i = 0; i < 14; i++) {

                        var t_data = r.weeks_month[i];
                        var t_id = r.weeks[i];
                        var t_dayname = r.dayname[i];
                        var t_dayno = r.dayno[i];
                        if (i === "13") {
                            tabelBody += "<td style='width:6.42%' class='Dropabletd' data-employeID='" + this.id + "' data-date='" + t_id + "' id='" + t_id + "_" + this.id + "'></td></tr>";
                        } else {
                            if (r.dayname[i] === "Fri") {
                                tabelBody += "<td style='width:6.42%' class='Holiday' style='background-color:#D3FFC6;' data-employeID='" + this.id + "' data-date='" + t_id + "' id='" + t_id + "_" + this.id + "'></td>";
                            } else {
                                tabelBody += "<td style='width:6.42%' class='Dropabletd' data-employeID='" + this.id + "' data-date='" + t_id + "' id='" + t_id + "_" + this.id + "'></td>";
                            }
                        }
                        eventCall(this.id, t_id);
//                    var tabelBody = "<table id='emptable' class='table table-striped responsive no-wrap' cellspacing='0' width='100%' style='margin: 0px;padding: 0px;width: 100%;'><thead ><tr ><td ></td></tr></thead>";
//                    $("#divsTot").append("<div style='width:14.285%;float:left;text-align:center'>" + t_id + "</div>");
//                            $("#divsDay").append("<div class='tb_div  btn-default weeks_divs' data-id=" + t_id + " id='" + t_id + "'>" + t_dayname + ", " + t_data + "  </div>");

                    }

                });
                $("#tabelBody").html(tabelBody);
                $("#tdDate").html(r.weekStart[0] + " To " + r.weekStart[13]);
                $("#SelectDate").val(r.weeks[0]);
                $("#currentSelect").val("2week");
                Dragging();
                DynamicTextBox();
                DTTable();
                //                 $('#emptable').DataTable({"responsive": true});
            }
        });
    }
    function CallWeek(DD)
    {
        //        alert(DD);
        $.ajax({
            url: '<?php echo _U ?>newschedule_2',
            dataType: "json",
            data: {

                DivsDate: 1,
                selectDate: DD

            }, success: function (r) {


//                $(r.emp_nm).each(function () {
//                    alert(this);
//                });
                //                    alert(r.weeks);
                var tabelHeading = "";
                tabelHeading += "<td style='width:12.5%' id='tdDate'>Employee</td>"
                for (var i = 0; i < 7; i++) {

                    var t_data = r.weeks_month[i];
                    var t_id = r.weeks[i];
                    var t_dayname = r.dayname[i];
                    var t_dayno = r.dayno[i];
//                    if (i == "6") {
//                        tabelHeading += "<td style='width:12.5%'>" + t_dayname + ", " + t_data + "</td></tr>";
                    //                    } else {
                    tabelHeading += "<td style='width:12.5%'>" + t_dayname + ", " + t_data + "</td>";
//                    }

//                    var tabelBody = "<table id='emptable' class='table table-striped responsive no-wrap' cellspacing='0' width='100%' style='margin: 0px;padding: 0px;width: 100%;'><thead ><tr ><td ></td></tr></thead>";
//                    $("#divsTot").append("<div style='width:14.285%;float:left;text-align:center'>" + t_id + "</div>");
//                            $("#divsDay").append("<div class='tb_div  btn-default weeks_divs' data-id=" + t_id + " id='" + t_id + "'>" + t_dayname + ", " + t_data + "  </div>");

                    //                    tabelHeading = "";
                }
                $("#tabelHeading").html("<tr>" + tabelHeading + "</tr>");
                var tabelBody = "";
                var classtd = "";
                var tdDate = "";
                $(r.emp_nm).each(function (index) {
                    //                    alert(index);
                    tabelBody += "<tr><td style='width:10%'><div class='col-xs-3 col-md-3 on-break-tab'>" + this.fname.charAt(0) + this.lname.charAt(0) + "</div>" + this.fname + ' ' + this.lname + " </td>";
                    for (var i = 0; i < 7; i++) {

                        var t_data = r.weeks_month[i];
                        var t_id = r.weeks[i];
                        var t_dayname = r.dayname[i];
                        var t_dayno = r.dayno[i];
                        var weekStart = r.weekStart[i];
//                        if (i === 5) {
//                            tabelBody += "<td style='width:12.5%' class='Holiday' style='background-color:#D3FFC6;' data-employeID='" + this.id + "' data-date='" + t_id + "' id='" + t_id + "_" + this.id + "'></td>";
//                        }

                        if (i === 6) {
                            tabelBody += "<td style='width:12.5%' class='Dropabletd ' data-employeID='" + this.id + "' data-date='" + t_id + "' id='" + t_id + "_" + this.id + "'></td></tr>";
                            //                            tdDate += " To " + weekStart[i];
                        } else {
                            if (r.dayname[i] === "Fri") {
                                tabelBody += "<td style='width:12.5%' class='Holiday' style='background-color:#D3FFC6;' data-employeID='" + this.id + "' data-date='" + t_id + "' id='" + t_id + "_" + this.id + "'></td>";
                            } else {
                                tabelBody += "<td style='width:12.5%' class='Dropabletd '  data-employeID='" + this.id + "' data-date='" + t_id + "' id='" + t_id + "_" + this.id + "'></td>";
                            }
                        }
                        eventCall(this.id, t_id);
//                    var tabelBody = "<table id='emptable' class='table table-striped responsive no-wrap' cellspacing='0' width='100%' style='margin: 0px;padding: 0px;width: 100%;'><thead ><tr ><td ></td></tr></thead>";
//                    $("#divsTot").append("<div style='width:14.285%;float:left;text-align:center'>" + t_id + "</div>");
//                            $("#divsDay").append("<div class='tb_div  btn-default weeks_divs' data-id=" + t_id + " id='" + t_id + "'>" + t_dayname + ", " + t_data + "  </div>");

                    }

                });
                $("#tabelBody").html(tabelBody);
                $("#tdDate").html(r.weekStart[0] + " To " + r.weekStart[6]);
                $("#SelectDate").val(r.weeks[0]);
                $("#currentSelect").val("1week");
                $(".Holiday").click(function () {
                    _toast("success", "Holiday");
                });
                Dragging();
                DynamicTextBox();
                DTTable();
                //                $('#emptable').DataTable({"responsive": true});
            }
        });
    }
    function CallDays(DD) {
//        alert("Call DAys");
        var d = new Date();
//        alert(d);
        if (DD === "" || DD === undefined) {
            var DD = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate();
        }

//        alert(DD);
        var selectedWeek = $("#currentSelect").val();
        var selectedDate = $("#SelectDate").val();
        $.ajax({
            url: '<?php echo _U ?>newschedule_2',
            dataType: "json",
            data: {

                callDaysHour: 1,
                selectDate: DD

            }, success: function (r) {

//                $(r.emp_nm).each(function () {
//                    alert(this);
//                });
                //                    alert(r.weeks);
                var tabelHeading = "";
                tabelHeading += "<td style='width:12.5%' id='tdDate'>Employee</td>"
                for (var i = 0; i < 24; i++) {

                    var t_hours = "";
                    if (i === 0) {
                        t_hours = r.hours[i] + "<br/><span style='font-size:10px;'>[12 AM]</span>";
                    } else {
                        t_hours = r.hours[i];
                    }
//                    var t_data = r.weeks_month[i];
//                    var t_id = r.weeks[i];
//                    var t_dayname = r.dayname[i];
//                    var t_dayno = r.dayno[i];
//                    if (i == "6") {
//                        tabelHeading += "<td style='width:12.5%'>" + t_dayname + ", " + t_data + "</td></tr>";
                    //                    } else {
                    tabelHeading += "<td style='width:12.5%'>" + t_hours + "</td>";
//                    }

//                    var tabelBody = "<table id='emptable' class='table table-striped responsive no-wrap' cellspacing='0' width='100%' style='margin: 0px;padding: 0px;width: 100%;'><thead ><tr ><td ></td></tr></thead>";
//                    $("#divsTot").append("<div style='width:14.285%;float:left;text-align:center'>" + t_id + "</div>");
//                            $("#divsDay").append("<div class='tb_div  btn-default weeks_divs' data-id=" + t_id + " id='" + t_id + "'>" + t_dayname + ", " + t_data + "  </div>");

                    //                    tabelHeading = "";
                }
                $("#tabelHeading").html("<tr>" + tabelHeading + "</tr>");
                var tabelBody = "";
                var tabelsubBody = "";
                var tdDate = "";
                $(r.emp_nm).each(function (index) {
                    //                    alert(index);
                    tabelBody += "<tr><td style='width:10%'><div class='col-xs-3 col-md-3 on-break-tab'>" + this.fname.charAt(0) + this.lname.charAt(0) + "</div>" + this.fname + ' ' + this.lname + " </td>";
                    for (var i = 0; i < 24; i++) {
                        var tabelsubBody = "";
                        var p = 15;
//                        var t_data = r.weeks_month[i];
                        var t_id = r.hours[i];
//                        var t_dayname = r.dayname[i];
//                        var t_dayno = r.dayno[i];
//                        var weekStart = r.weekStart[i];
                        for (var j = 0; j < 4; j++) {
                            tabelsubBody += "<div style='float:left; width:25%;height:inherit;'  class='Dropablesub_td' data-employeID='" + this.id + "' data-date='" + t_id + "' id='" + t_id + "_" + this.id + "_" + j + "'><span class='label icon icon-file-alt'></span></div>";
                        }


                        if (i === 23) {
                            tabelBody += "<td style='width:12.5%' class='DropableTd' data-employeID='" + this.id + "' data-date='" + t_id + "' id='" + t_id + "_" + this.id + "'>" + tabelsubBody + "</td></tr>";
                            //                            tdDate += " To " + weekStart[i];
                        } else {
                            tabelBody += "<td style='width:12.5%' class='DropableTd'  data-employeID='" + this.id + "' data-date='" + t_id + "' id='" + t_id + "_" + this.id + "'>" + tabelsubBody + "</td>";
                        }
//                        eventCall(this.id, t_id);
//                    var tabelBody = "<table id='emptable' class='table table-striped responsive no-wrap' cellspacing='0' width='100%' style='margin: 0px;padding: 0px;width: 100%;'><thead ><tr ><td ></td></tr></thead>";
//                    $("#divsTot").append("<div style='width:14.285%;float:left;text-align:center'>" + t_id + "</div>");
//                            $("#divsDay").append("<div class='tb_div  btn-default weeks_divs' data-id=" + t_id + " id='" + t_id + "'>" + t_dayname + ", " + t_data + "  </div>");

                    }

                });
                $("#tabelBody").html(tabelBody);
                $("#tdDate").html(r.today);
                $("#SelectDate").val(r.today);
                $("#currentSelect").val("Days");
                $(".DropableTd").css({margin: "0px", padding: "0px"});
                DynamicTextBox();
//                mouseEvents();
                Dragging2();
//                $(".divId").resizable({
//                    handles: 'w'
//                });
                DTTable();
            }});
    }
    function CallToday() {

        var d = new Date();
        var DD = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate();
        var selectedWeek = $("#currentSelect").val();
        var selectedDate = $("#SelectDate").val();
        if (selectedWeek === "1week") {
            CallWeek(DD);
        }
        if (selectedWeek === "2week") {
            Call2Week(DD);
        }
        if (selectedWeek === "4week") {
            Call4Week(DD);
        }
        if (selectedWeek === "Days") {
            CallDays(DD);
        }
    }
    function CallAfter() {
        var selectedWeek = $("#currentSelect").val();
        var selectedDate = $("#SelectDate").val();
        var Dayjump = "";
        if (selectedWeek === "1week") {
            Dayjump = "7";
            AfterWeek(selectedDate, Dayjump);
            //            alert(beforeWeek(selectedDate, Dayjump));
        }
        if (selectedWeek === "2week") {
            Dayjump = "14";
            AfterWeek(selectedDate, Dayjump);
        }
        if (selectedWeek === "4week") {
            Dayjump = "28";
            AfterWeek(selectedDate, Dayjump);
        }
        if (selectedWeek === "Days") {
            Dayjump = "1";
            afterDays(selectedDate, Dayjump);
        }
    }
    function AfterWeek(selectedDate, Dayjump) {
        $.ajax({
            url: '<?php echo _U ?>newschedule_2',
            dataType: "json",
            data: {

                AfterWeek: 1,
                selectDate: selectedDate,
                Dayjump: Dayjump

            }, success: function (r) {
                if (Dayjump === "7") {
                    CallWeek(r);
                }
                if (Dayjump === "14") {
                    Call2Week(r);
                }
                if (Dayjump === "28") {
                    Call4Week(r);
                }

            }
        });
    }
    function CallBefore() {
        var selectedWeek = $("#currentSelect").val();
        var selectedDate = $("#SelectDate").val();
        var Dayjump = "";
        if (selectedWeek === "1week") {
            Dayjump = "7";
            beforeWeek(selectedDate, Dayjump);
            //            alert(beforeWeek(selectedDate, Dayjump));
        }
        if (selectedWeek === "2week") {
            Dayjump = "14";
            beforeWeek(selectedDate, Dayjump);
        }
        if (selectedWeek === "4week") {
            Dayjump = "28";
            beforeWeek(selectedDate, Dayjump);
        }
        if (selectedWeek === "Days") {
            Dayjump = "1";
            beforeDays(selectedDate, Dayjump);
        }
    }
    function afterDays(selectedDate, Dayjump) {
        $.ajax({
            url: '<?php echo _U ?>newschedule_2',
            dataType: "json",
            data: {

                AfterDays: 1,
                selectDate: selectedDate,
                Dayjump: Dayjump

            }, success: function (r) {
                if (Dayjump === "1") {
                    CallDays(r);
                }
                if (Dayjump === "7") {
                    CallWeek(r);
                }
                if (Dayjump === "14") {
                    Call2Week(r);
                }
                if (Dayjump === "28") {
                    Call4Week(r);
                }
            }
        });
    }
    function beforeDays(selectedDate, Dayjump) {
        $.ajax({
            url: '<?php echo _U ?>newschedule_2',
            dataType: "json",
            data: {

                BeforeDays: 1,
                selectDate: selectedDate,
                Dayjump: Dayjump

            }, success: function (r) {
                if (Dayjump === "1") {
                    CallDays(r);
                }
                if (Dayjump === "7") {
                    CallWeek(r);
                }
                if (Dayjump === "14") {
                    Call2Week(r);
                }
                if (Dayjump === "28") {
                    Call4Week(r);
                }
            }
        });
    }
    function beforeWeek(selectedDate, Dayjump) {
        $.ajax({
            url: '<?php echo _U ?>newschedule_2',
            dataType: "json",
            data: {

                BeforeWeek: 1,
                selectDate: selectedDate,
                Dayjump: Dayjump

            }, success: function (r) {
                if (Dayjump === "7") {
                    CallWeek(r);
                }
                if (Dayjump === "14") {
                    Call2Week(r);
                }
                if (Dayjump === "28") {
                    Call4Week(r);
                }
            }
        });
    }
    function DynamicTextBox() {
//        if (!$("#currentSelect").val() === "Days") {
        $("body").on("click", ".Dropabletd", function () {
            $(".dynatext").remove();
//            alert($(this).attr("data-date"));
            //            alert($(this).attr("id"));
            var hidid = $(this).attr("id");
            $(this).append("<div class='dynatext'><input type='hidden' name='hidtxthandle' id='hidtxthandle' value='" + hidid + "'><input type='text' class='dynatext'  value='' onkeydown='handle(event)'  onkeypress='handle(event)' required='' name='txthandle' id='txthandle' placeholder='i.e 1200-2300 or 10:00-18:00'><input type='text' style='text-align:center' value='10:00-6:00' disabled name='errorhadler' id='errorhadler'><input type='hidden' name='dynflag' id='dynflag' value=''></div>");
            $(".dynatext").focus();
        });
//        } else {
        $("body").on("dblclick", ".Dropablesub_td", function () {
//            if (!$("#currentSelect").val() === "Days")
//            {
//            $(".dynatext").remove();

            var hidid = $(this).attr("id");
//            alert($(this).offset().left);
//            Myleft = $(this).offset().left;
//            Mytop = $(this).offset().top;
            var Myleft = $(this).position().left;
            var Mytop = $(this).position().top;
//            alert($(this).attr("data-date"));
//            alert($(this).attr("id"));
//            alert("Top" + $(this).position().top);
//            alert("Left" + $(this).position().left);
//            alert("Index of " + $(this).index());
//            alert("Parents Index of " + $(this).parent().index());
//            alert("Parents id of " + $(this).parent().attr("id"));
//            var p = $(this).parent().attr("id");
//
            var id = $(this).parent().nextAll().eq($(this).parent().index() + 8).attr("id");
//            alert("Siblings ID=" + id);
//            alert("8th Siblings is=" + $(this).parent().nextAll().eq($(this).parent().index() + 8).attr("data-date"));

//            var endTop = id.position().top;
//            var endLeft = $(this).parent().nextAll().eq($(this).parent().index() + 6).position().left;
//            var endRight = document.getElementById(id).style.right;

//            alert("END LEFT" + endLeft);
            if ($(this).parent().index() > 16) {
                var widths = "100%";
            } else {
                var widths = $(this).parent().width() * 8;
            }
            var heights = $(this).height();
//            alert("Parent Width" + widths);
            $(this).html("<span id='" + hidid.replace(":", "_") + "'  class='divId label label-success unselectable' >ABCDEFGHIJKLMNOPQRSTUVWXYZ<span>");
            $(this).children().css({zIndex: 999, position: "absolute", top: Mytop, left: Myleft, width: widths, height: heights, display: "block", border: "#808080 solid 2px", color: "black", background: "#00CEB4"});
//                $(".dynatext").focus();
//            }
            $(".divId").resizable({
                handles: 'w'
            });
            Dragging2();
        });
//        }
    }
    function mouseEvents() {


    }
    function Dragging() {
        $("body .label").draggable({revert: "invalid"});
        $("body .Dropabletd ").droppable({
            accept: ".label",
            drop: function (e, ui) {
//                alert($(this).attr("data-date"));
//                alert($(this).attr("id"));

                ui.draggable.appendTo($(this)).css({
                    top: "0.4em",
                    left: "0.2em",
                    width: "100%",
                    display: "block"

                });
//                console.log(e.id, ui.id)

                updateEvents($(this).find('span:last-child').attr("id"), $(this).attr("id"));
                //                alert($(this).find('span').attr("id"));
            }
        });
    }
    function Dragging2() {
//        alert("itscall");
        $("body .label").draggable({revert: "invalid"});
//        $("body .DropableTd > div").droppable({
        $("body .Dropablesub_td").droppable({
            accept: ".label",
            drop: function (e, ui) {
//            create: function (e, ui) {
//                alert(ui.draggable.element.attr("data-date"));
                alert(ui.position.left);
                alert(ui.position.top);
                alert($(this).attr("data-date"));
                alert($(this).attr("id"));
                var hidid = $(this).attr("id");
//                var Myleft = $(this).position().left;
                var Myleft = ui.position.left;
                var Mytop = $(this).position().top;
                alert("My Left" + $(this).parents().position().left + " And  top=" + Mytop);
                alert("My Left" + Myleft + " And  top=" + Mytop);
//                var id = $(this).parent().nextAll().eq($(this).parent().index() + 8).attr("id");
//            alert("8th Siblings is=" + $(this).parent().nextAll().eq($(this).parent().index() + 8).attr("data-date"));
                alert("this index" + $(this).parent().index());
                if ($(this).parent().index() > 16) {
                    var widths = "100%";
                } else {
                    var widths = $(this).parent().width() * 8;
                }
                var heights = $(this).height();
                ui.draggable.appendTo($(this)).css({zIndex: 999, position: "absolute", top: Mytop, left: Myleft, width: widths, height: heights, display: "block", border: "#808080 solid 2px", color: "black", background: "#00CEB4"});
//                console.log(e.id, ui.id)

//                updateEvents($(this).find('span:last-child').attr("id"), $(this).attr("id"));
                //                alert($(this).find('span').attr("id"));
            }
        });
    }
    $(".Dropabletd").click(function () {
//        $(".dynatext").remove();
//            $(this).add("<input type='text' value=''>");
        //            this.appendChild("<span class='label'>O</span>");
        $(this).html("<input type='text' class='dynatext' value='123'>");
        //            alert("claaa");
    });
    function  updateEvents(id, dataId) {
//        alert("ID IS =" + id);
        //        alert("DATA ID IS =" + dataId);
        $.ajax({
            url: '<?php echo _U ?>newschedule_2',
            dataType: "json",
            data: {

                updateAssignShift: 1,
                dateId: dataId,
                eventID: id

            }, success: function (r) {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);
                } else {
                    _toast("danger", "Decliend", r.msg);
                }
//                alert(r);
//                $("#hidtxthandle").val();
//                $(".dynatext").remove();
//                var content = "<span  class='label label-success ui-widget-content filediv unselectable'>" + r.startT + "-" + r.endT + " </span>";
                //                $("#" + dateId).append(content);
                Dragging();
            }
        });
    }
    $("#target").contextmenu(function () {
        alert("Handler for .contextmenu() called.");
    });
    function DTTable() {
//        $('#emptable').DataTable()
//        var table = $('#emptable').DataTable();
//        table.destroy();
//
//        table = $('#emptable').DataTable({
//            responsive: true
//        });
////        $('#min, #max').change(function () {
////            table.draw();
////        });
////        $('#createdby').keyup(function () {
//////            alert("Key Up");
////            table.column(1).search($(this).val()).draw();
//////            table.draw();
////        });
//        $('#ast').keyup(function () {
////            alert("Key Up");
//            table.column(0).search($(this).val()).draw();
////            table.draw();
//        });
    }
    $(document).ready(function () {
        var d = new Date();
        var dts = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate();
        CallWeek(dts);
//        alert("hello");


//        DTTable();
//        $('#ast').keyup(function () {
//            alert("Key Up");
//            table.column(0).search($(this).val()).draw();
//            //            table.draw();
//        });
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            //   events: "http://localhost:8888/fullcalendar/events.php",
            events: "<?php echo _U ?>events",
            // Convert the allDay from string to boolean
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = true;
                }

            },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                var title = prompt('Event Title:');
                var url = prompt('Type Event url, if exits:');
                if (title) {
                    var start = moment(start).format('YYYY-MM-DD HH:MM:SS'); /* $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");*/
                    var end = moment(end).format('YYYY-MM-DD HH:MM:SS'); /* $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");*/
//                            alert(start);
                    //                            alert(end);
                    $.ajax({
                        url: '<?php echo _U ?>add_events',
                        data: 'title=' + title + '&start=' + start + '&end=' + end + '&url=' + url,
                        type: "POST",
                        success: function (json) {
                            alert('Added Successfully');
                        }
                    });
                    calendar.fullCalendar('renderEvent',
                            {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay

                            },
                            true // make the event "stick"
                            );
                }
                calendar.fullCalendar('unselect');
            },
            editable: true,
            eventDrop: function (event, delta, revertFunc) {
                //  alert(event.end);
                var start = moment(event.start).format('YYYY-MM-DD HH:MM:SS'); /* $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");*/
                //                        var end = moment(event.end).format('YYYY-MM-DD HH:MM:SS');/*$.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");*/
                var defaultDuration = moment.duration($('#calendar').fullCalendar('option', 'defaultTimedEventDuration')); // get the default and convert it to proper type
                var end = moment(event.end).format('YYYY-MM-DD HH:MM:SS') || event.start.clone().add(defaultDuration); // If there is no end, compute it

                $.ajax({
                    url: '<?php echo _U ?>update_events',
                    data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                    type: "POST",
                    success: function (json) {
                        alert("Updated Successfully");
                    }
                });
            },
            eventResize: function (event) {
                //                        alert(event.title + " end is now " + event.end.format());
                var start = moment(event.start).format('YYYY-MM-DD HH:MM:SS'); /*$.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");*/
                var end = moment(event.end).format('YYYY-MM-DD HH:MM:SS'); /*$.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");*/
//                        alert(start);
                //                        alert(end);
                $.ajax({
                    url: '<?php echo _U ?>update_events',
                    data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                    type: "POST",
                    dataType: 'json',
                    success: function (json) {
                        alert("Updated Successfully");
                    }
                });
            },
            eventClick: function (event) {
                var decision = confirm("Do you really want to do that?");
                if (decision) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo _U ?>delete_events",
                        data: "&id=" + event.id
                    });
                    $('#calendar').fullCalendar('removeEvents', event.id);
                } else {
                }
            }

        });
        $('.dataTables_filter input').attr("placeholder", "Search...");
        $('.dataTables_filter').addClass('pull-left');
        $('.dataTables_wrapper div').addClass('col-sm-12');
        //        alert("JS CALL when ready");
//        start_end_time();
        $('#st1_link').css('background-color', '#C71418');
        $('#st1_link').css('color', 'white');
        $('#st1_link').css('border-radius', '30px');
    });
    //    $(function () {
    //"use strict";

    //  });

</script>

<script type="text/javascript">
    //    alert("Call");
    $('#datatable-responsive').DataTable({
        responsive: true
    });
    $('.dataTables_filter input').attr("placeholder", "Search...");
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

        var y = document.newschedule_2.phone.value;
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
                url: '<?php echo _U ?>newschedule_2',
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
//        $('#newschedule_2_form').parsley().on('field:validated', function () {
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
    $("#newschedule_2CardPanel").removeClass("panelWait");
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
            url: '<?php echo _U ?>newschedule_2',
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
<?php //include _PATH . "instance/front/tpl/google_maps.js.php";          ?>
