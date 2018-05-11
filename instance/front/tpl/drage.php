<html>
    <head>

        <script>

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

            });

        </script>
        <style>

            body {
                margin-top: 40px;
                text-align: center;
                font-size: 14px;
                font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;

            }


            #calendar {
                width: 900px;
                margin: 0 auto;
            }

        </style>
    </head>
    <body>
        <?php echo _U ?>
        <div id='calendar'></div>
    </body>
</html>