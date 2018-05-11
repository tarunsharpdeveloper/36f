

<!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>js/jquery.timepicker.js"></script>-->

<!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/jquery.timepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/pikaday/css/pikaday.css"/>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/pikaday/pikaday.js"></script>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/pikaday/plugins/pikaday.jquery.js"></script>-->
<?php include _PATH . "instance/front/tpl/libValidate.php" ?>
<!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/tooltip/tooltip.css">-->
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/interactions-ui/resizable.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/interactions-ui/draggable.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/interactions-ui/sortable.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/interactions-ui/selectable.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/daterangepicker/moment.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/calendar/calendar.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/calendar/calendar-demo.js"></script>
<!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/tooltip/tooltip.js"></script>--> 

<script>
//    $(document).ready(function () {
//        $('[data-toggle="tooltip"]').tooltip('toggle');
//    });
</script>
<script type="text/javascript">

    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 8
        });
    }

//    var geocoder;
//    var map;
//    var marker;
//    var infowindow = new google.maps.InfoWindow({
//        size: new google.maps.Size(50, 50)
//    });
//    var map, infoWindow;
//    function initMap() {
//        var locations = [
//
//            ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
//            ['Maroubra Beach', -33.950198, 151.259302, 1]
//        ];
//
//        var map = new google.maps.Map(document.getElementById('map'), {
//            zoom: 10,
//            center: new google.maps.LatLng(-33.92, 151.25),
//            mapTypeId: google.maps.MapTypeId.ROADMAP
//        });
//
//        var infowindow = new google.maps.InfoWindow();
//
//        var marker, i;
//
//        for (i = 0; i < locations.length; i++) {
//            marker = new google.maps.Marker({
//                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
//                map: map
//            });
//
//            google.maps.event.addListener(marker, 'click', (function (marker, i) {
//                return function () {
//                    infowindow.setContent(locations[i][0]);
//                    infowindow.open(map, marker);
//                }
//            })(marker, i));
//        }
//    }
//
//    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
//        infoWindow.setPosition(pos);
//        infoWindow.setContent(browserHasGeolocation ?
//                'Error: The Geolocation service failed.' :
//                'Error: Your browser doesn\'t support geolocation.');
//        infoWindow.open(map);
//    }
//    function initMap() {
//
//        geocoder = new google.maps.Geocoder();
//        var latlng = new google.maps.LatLng(35.757554, 51.410456);
//
//        var mapOptions = {
//            zoom: 8,
//            center: latlng,
//            mapTypeId: google.maps.MapTypeId.ROADMAP
//        }
//        map = new google.maps.Map(document.getElementById('map'), mapOptions);
////        map.setZoom(30);
//        marker = new google.maps.Marker({
//            map: map,
//            draggable: true,
////                    title: document.getElementById('locAddress').value,
//            animation: google.maps.Animation.DROP,
//            position: {lat: 35.757554, lng: 51.410456}
//        });
//        google.maps.event.addListener(marker, 'dragend', function () {
////                    alert(marker.getPosition());
//            geocodePosition(marker.getPosition());
//        });
//        google.maps.event.addListener(map, 'click', function () {
//            infowindow.close();
//        });
//    }

//    function geocodePosition(pos) {
////        alert("GEO POSITION CALLED");
//        geocoder.geocode({
//            latLng: pos
//        }, function (responses) {
//            if (responses && responses.length > 0) {
//                marker.formatted_address = responses[0].formatted_address;
//                $("#locAddress").val(marker.formatted_address);
////                alert(marker.formatted_address);
//            } else {
//                marker.formatted_address = 'Cannot determine address at this location.';
//            }
//            infowindow.setContent(marker.formatted_address + "<br>coordinates: " + marker.getPosition().toUrlValue(6));
////            alert(marker.formatted_address + "<br>coordinates: " + marker.getPosition().toUrlValue(6));
//            infowindow.open(map, marker);
//        });
//    }

    function codeAddress(latST, lngST, latED, lngED) {
//        var address = document.getElementById('locAddress').value;
//        var start = address.str.split(",");
//        alert("sliced1" + start[0]);
//        alert("sliced2" + start[1]);
        var locations = [

            ['SHIFT START', latST, lngST, 2],
            ['SHIFT END', latED, lngED, 1]
        ];

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: new google.maps.LatLng(latST, lngST),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;
        var colors;
        for (i = 0; i < locations.length; i++) {
            if (i == 0) {
//                colors = "green";
                colors = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png';

            } else {
//                colors = "red";
                colors = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
            }
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon: colors
//                icon: {
//                    path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
//                    strokeColor: colors,
//                    scale: 3
//                }
            });

            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }

    }

    google.maps.event.addDomListener(window, "load", initMap);
</script>
<script type="text/javascript">
    $('#selectEmp, #selectStatus').change(function () {
        callPreData();
    });

    $(".mContent").change(function () {
//        alert("Handler for .change() called.");
        EditModalValidation();
    });
    $(".mContent").focusin(function () {
//        alert("Handler for .change() called.");
        $("#error_start_time").html("");
        $("#error_end_time").html("");
        $("#error_msg").html("");
    });
    function deleteShift() {
        var shiftId = $("#hidshiftID").val();
        $("#div_deleted").html(" <a class='btn btn-danger' href='javascript:void();' onclick='deleteShiftConfirm(" + shiftId + ")'>Are you sure to delete this shift?</a>");
    }
    function deleteShiftConfirm(id) {
//        alert(id);
        $.ajax({
            url: '<?php echo _U ?>approve_timesheet_2',
            dataType: "json",
            data: {
                deleteShift: 1, shiftId: id
//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
                $("#EndShiftModel").modal("toggle");
                callPreData();
            }});
    }
    function EditModalValidation() {
        var pat = /^(?:[01]\d|2[0-3])(?::?[0-5]\d)?$/;
        var startTime = $("#start_time").val();
        var endTime = $("#end_time").val();
        var IsTrueST = pat.test(startTime);
        var IsTrueET = pat.test(endTime);
        if (!IsTrueST) {
            $("#error_start_time").html("Invalid Input");
            return false;
//            alert("NOT PAT");
        } else if (!IsTrueET) {
            $("#error_end_time").html("Invalid Input");
//            alert("NOT PAT");
            return false;
        } else {
            onchangeGetTime();
        }
    }
    function onchangeGetTime() {
        var startTime = $("#start_time").val();
        var endTime = $("#end_time").val();
        var breakTime = $("#break_time").val();
        $.ajax({
            url: '<?php echo _U ?>approve_timesheet_2',
            dataType: "json",
            data: {
                getTotalTime: 1, startTime: startTime, endTime: endTime, breakTime: breakTime
//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
                $("#hours_count").html(r.Hours).change();
            }
        });
    }
    function GetLocationMap(startSFL, endSFL) {

//        var markers;
//        markers[0] = startSFL;
//        markers[1] = endSFL;
        $("#locAddress").val(startSFL).change();
        $("#hidstart").val(startSFL).change();
        $("#hidend").val(endSFL).change();
//        initMap();
        var fields = startSFL.split(',');
        var latStart = fields[0];
        var lngStart = fields[1];
        var fields2 = endSFL.split(',');
        var latEnd = fields2[0];
        var lngEnd = fields2[1];
        $("#myModal3").modal("show");
//        alert(startSFL);
//        alert(endSFL);
        codeAddress(latStart, lngStart, latEnd, lngEnd);
//        testMap();
//        google.maps.event.addDomListener(window, "load", initMap);


    }


    function edit_Shift() {
//        EditModalValidation();
        var start_time = $("#start_time").val();
        var end_time = $("#end_time").val();
        var break_time = $("#break_time").val();
        var note = $("#note").val();
        $("#error_start_time").html("");
        $("#error_end_time").html("");
        $("#error_msg").html("");
        var pat = /^(?:[01]\d|2[0-3])(?::?[0-5]\d)?$/;
        var startTime = $("#start_time").val();
        var endTime = $("#end_time").val();
        var IsTrueST = pat.test(startTime);
        var IsTrueET = pat.test(endTime);
        if (!IsTrueST) {
            $("#error_start_time").html("Invalid Input");
            return false;
//            alert("NOT PAT");
        } else if (!IsTrueET) {
            $("#error_end_time").html("Invalid Input");
//            alert("NOT PAT");
            return false;
        } else {
            if (start_time == "" || start_time == null) {
                $("#error_start_time").html("Start Time Fields Required");
            } else if (end_time == "" || end_time == null) {
                $("#error_end_time").html("End Time Fields Required");
            } else {

                $.ajax({
                    url: '<?php echo _U ?>approve_timesheet_2',
                    dataType: "json",
                    data: {

                        editShift: 1,
                        shiftId: $("#hidshiftID").val(),
                        start_time: start_time,
                        end_time: end_time,
                        break_time: break_time,
                        note: note

                    }, success: function (r) {
                        if (r.error == 1) {
                            $("#error_msg").html("This timesheet might be deleted because its length is less than minimum length requirement of 15  minutes. Are you sure?");
                        } else {
                            $("#EndShiftModel").modal("toggle");
                            callPreData();
                        }
                    }
                });
            }
        }
    }
    function onStatus(id, status) {
        $.ajax({
            url: '<?php echo _U ?>approve_timesheet_2',
            dataType: "json",
            data: {
                getshifts: 1,
                id: id
//                status: status
            }, success: function (r) {
//                var totH = r.total_hours.split("h");
                var Hr = r.total_hours.replace(" ", "").trim();
                Hr = Hr.replace("m", "").trim();
                Hr = Hr.replace(" ", "").trim();
                Hr = Hr.replace("h", ".").trim();
//                alert(Hr);
//                var totM = r.total_hours.split("m");
                if (Hr < 12) {
                    saveStatus(id, status);
                } else {
                    var st = "";
                    var color = "";
                    var btn = "";
                    if (status == "1") {
                        st = "Unapprove";
                        color = "Red";
                        btn = "btn-danger";
                    } else {
                        st = "Approve";
                        color = "#777";
                        btn = "btn-primary";
                    }
                    $("#AlertShiftModel").modal("toggle");
                    $("#mymodalTitle").html("<b>" + st + "! Alert!</b>");
                    $("#approve_div").html("<button class='btn btn-default' type='button' data-dismiss='modal'>Close</button><button class='btn " + btn + "' type='button' onclick='saveStatus(" + id + ", " + status + ")'>" + st + "</button>");
                    $("#hours_counts").text(r.total_hours);
                    $("#mymodalBody").html("<h3>Are You Sure To " + st + " <b>" + r.total_hours + "</b> Time ?</h3>");
                    $("#mymodalBody , #mymodalTitle").css("color", color);
                    $("#start_time").val(r.start_time);
                    $("#end_time").val(r.end_time);
                    $("#break_time").val(r.break_time);
                    $("#hidshiftID").val(id);
                }
            }
        });
    }
    function saveStatus(id, status) {
//        alert(id + " - " + status);
        $.ajax({
            url: '<?php echo _U ?>approve_timesheet_2',
//            dataType: "json",

            data: {
                UpdateStatus: 1,
                id: id,
                status: status
            }, success: function (r) {
//                alert(r);
                $("#AlertShiftModel").modal("hide");
                callPreData();
            }
        });
    }
    function OpenModalEditShift(id) {
//        alert(id);
        $.ajax({
            url: '<?php echo _U ?>approve_timesheet_2',
            dataType: "json",
            data: {
                getshifts: 1,
                id: id
//                status: status
            }, success: function (r) {
//                alert(r);
                $("#EndShiftModel").modal("toggle");
                $("#div_deleted").html(" <a class='btn btn-danger' href='javascript:void();' onclick='deleteShift()'>Click here to Delete</a>");
                $("#hours_count").text(r.total_hours);
                $("#start_time").val(r.start_time);
                $("#end_time").val(r.end_time);
                $("#break_time").val(r.break_time);
                $("#hidshiftID").val(id);
//                callPreData();
            }
        });
    }
    $(function () {

        var start = moment();
        var end = moment();
        function cb(start, end) {
            $('#reportrange ').val(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
//            alert($('#reportrange ').val());
            callPreData();
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            format: 'YYYY/MM/DD ',
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//                'Last2 Month': [moment().subtract(2, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            onSelect: function (dateText) {
                display("Onselect");
            },
            onClose: function (selectedDate) {
                display("OnClose");
            }
        }, cb).on("change", function () {
            display("OnChange");
        });
        cb(start, end);
        function display(msg) {
//            alert(msg);
        }

    });</script>
<script type="text/javascript">



//    $("#reportrange").change(function () {
//        alert("Callranges");
//    });
//    $(".ranges ul li").on("click", function () {
//        var setCal = $(this).val();
////        alert(setCal);
//    });
//    $(function () {
//        "use strict";
//
//        $('#daterangepicker-time').daterangepicker({
//            timePicker: true,
//            timePickerIncrement: 30,
////            format: 'MM/DD/YYYY h:mm A'
//            format: 'YYYY-MM-DD ',
//            onSelect: function (dateText) {
//                display("Selected date: " + dateText + "; input's current value: " + this.value);
//            },
//            onClose: function (selectedDate) {
//                alert("Close Call");
//            }
//        }).on("change", function () {
//            display("Got change event from field");
//        });
//        function display(msg) {
//            alert(msg);
//        }
//
//    });

    function getTimesheet(id) {
        if ($("#daterangepicker-time").val() == "") {
            $("#daterangepicker-time").focus();
        }
//        alert(id);
        $.ajax({
            url: '<?php echo _U ?>approve_timesheet',
            //dataType: "json",
            data: {
                getTimesheet: 1,
                id: id,
                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
                alert(r);
//                $('#timesheetDiv').html(r);
//                $('#hid_emp_id').val(id);
//                enabledisable();
            }
        });
    }

    $(document).on('click', ".tb_div", function () {
        //code here ....
        var selectedDate = $(this).attr('data-id');
        getDayViseData(selectedDate);
//        $("#divsDayDetails").html("<div class='panel'><div class='panel-body'>" + $(this).attr('data-id') + "</div></div>");

    });
    $(".weeks_divs").on("click", function () {

//        alert$("Day Click");
    });
    function callPreData() {
        var empID = $("#selectEmp").val();
        var Dates = $("#reportrange").val();
        var status = $("#selectStatus").val();
//        alert(status);
//        var Dates = $("#reportrange").val();
//        var Dates = $("#reportrange").val();
        $.ajax({
            url: '<?php echo _U ?>approve_timesheet_2',
//            dataType: "json",

            data: {
                getEMPTimesheet: 1,
                sDate: Dates,
                empID: empID,
                status: status
            }, success: function (r) {
//                alert(r);
                $('#timesheetDiv').html(r);
//                $('#hid_emp_id').val(id);
//                enabledisable();
//                $('#emptable').DataTable({
//                    "responsive": true,
//                    "paging": false,
//                    "ordering": false,
//                    "info": false,
//                    "bFilter": true
//                });
            }
        });
    }
    $(document).ready(function () {

        var d = new Date();
        var dts = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate();
//        CallWeek(dts);
//        alert("hello");
//        alert($("#reportrange").val());
        callPreData();
//        var table = $('#emptable').DataTable({
//            "responsive": true,
//            "paging": false,
//            "ordering": false,
//            "info": false,
//            "bFilter": true
//        });
//        $('#ast').keyup(function () {
//            alert("Key Up");
//            table.column(0).search($(this).val()).draw();
////            table.draw();
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

        var y = document.approve_timesheet_2.phone.value;
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
                url: '<?php echo _U ?>approve_timesheet_2',
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
//        $('#approve_timesheet_2_form').parsley().on('field:validated', function () {
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
    $("#approve_timesheet_2CardPanel").removeClass("panelWait");
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
            url: '<?php echo _U ?>approve_timesheet_2',
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
