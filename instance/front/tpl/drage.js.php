
<?php include _PATH . "instance/front/tpl/libValidate.php" ?>

<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/interactions-ui/resizable.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/interactions-ui/draggable.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/interactions-ui/sortable.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/interactions-ui/selectable.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/daterangepicker/moment.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/calendar/calendar.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/calendar/calendar-demo.js"></script>


<script type="text/javascript">
    var events = []; //array of events in json format
    var calendar = $('#calendar7').fullCalendar({
        theme: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,agendaFourDay'
        },

        selectable: true,
        selectHelper: true,

        select: function (start, end, allDay) {
            console.log('create new event');
        },
        editable: true,
        droppable: true,
        events: [{
                title: 'event2',
                start: '2017-05-16',
                end: '2017-05-18'
            }],
        eventDrop: function (event, delta) {
            console.log('move exists event');
            saveEvent(event);
        },
        loading: function (bool) {},
        eventClick: function (calEvent, jsEvent, view) {
            console.log('edit exists event');
        },
        eventRender: function (event, element) {
            // get your new title somehow
            var title = "New Content";
            // replace the event title
            element.find('.fc-event-title').text(title);
        },
        dayClick: function (date, jsEvent, view, resourceObj) {

            var eventTitle = prompt("Provide Event Title");
            if (eventTitle) {
                $("#calendar1").fullCalendar('renderEvent', {
                    title: eventTitle,
                    start: moment(date).format('YYYY-MM-DD HH:MM:SS'), /* vs HH:MM:SS */
                    stick: true
                });
            }
        }
    });

    function saveEvent(event) {
        $.ajax({
            url: 'drage',
            type: 'post',
            data: {event: event},
            dataType: 'json',
            success: function (response) {
                console.log('response');
//                alert('response');
            }
        });
    }

</script>
<?php include _PATH . "instance/front/tpl/google_maps.js.php"; ?>
