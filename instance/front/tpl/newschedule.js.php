

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
    $(".eventCall").on("click", function () {
//        $(this).append("<div style='background-color: red;height: 20px;width:100%;' class='draggable'>*</div>");
//        $("#myModal2").openModal();
//        alert("Day Click");
    });
    $(function () {
        $(".draggable").draggable();
        $(".draggable").resizable({
            start: function (e, ui) {
//                alert('resizing started');

            },
            resize: function (e, ui) {

            },
            stop: function (e, ui) {
//                alert('resizing stopped');
            }
        });
        $(".droppable").droppable({
            accept: ".draggable",
            classes: {
                "ui-droppable-active": "ui-state-active",
                "ui-droppable-hover": "ui-state-hover"
            },
//      drag:function( event, ui ) {
//        $( this )
////          .addClass( "ui-state-highlight" )
////          .find( "p" )
//            .html("");
//      },
            drop: function (event, ui) {
//                alert($(this).attr("id"));
//                alert(event);
                $(this).html("");
//          .addClass( "ui-state-highlight" )
//          .find( "p" )
//           .html("");
            }
        });
    });
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
            url: '<?php echo _U ?>newschedule',
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
                url: '<?php echo _U ?>newschedule',
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
                    event.allDay = false;
                } else {
                    event.allDay = false;
                }

            },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                var title = prompt('Event Title:');
                var url = prompt('Type Event url, if exits:');
                if (title) {
                    var start = moment(start).format('YYYY-MM-DD HH:MM:SS');/* $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");*/
                    var end = moment(end).format('YYYY-MM-DD HH:MM:SS');/* $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");*/
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
            events: function (start, end, callback)
            {
                var event = [{"title": "Timed event", "start": "2013-11-12 14:00:00", "end": "2013-11-12 15:00:00", "allDay": false}];


                callback(event);
            },

            eventDrop: function (event, delta, revertFunc) {
//  alert(event.end);
                var start = moment(event.start).format('YYYY-MM-DD HH:MM:SS');/* $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");*/
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
                var start = moment(event.start).format('YYYY-MM-DD HH:MM:SS');/*$.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");*/
                var end = moment(event.end).format('YYYY-MM-DD HH:MM:SS');/*$.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");*/
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
        $('#emptable').DataTable({
            "responsive": true,
            "paging": false,
            "ordering": false,
            "info": false,
            "bFilter": true
        });

        $('.dataTables_filter input').attr("placeholder", "Search...");
        $('.dataTables_filter').addClass('pull-left');
        $('.dataTables_wrapper div').addClass('col-sm-12');
//        alert("JS CALL when ready");
        start_end_time();
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

        var y = document.newschedule.phone.value;
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
                url: '<?php echo _U ?>newschedule',
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
//        $('#newschedule_form').parsley().on('field:validated', function () {
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
    $("#newscheduleCardPanel").removeClass("panelWait");
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
            url: '<?php echo _U ?>newschedule',
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