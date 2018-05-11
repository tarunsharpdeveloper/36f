
<?php include _PATH . "instance/front/tpl/libValidate.php" ?>

<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/interactions-ui/resizable.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/interactions-ui/draggable.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/interactions-ui/sortable.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/interactions-ui/selectable.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/daterangepicker/moment.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/calendar/calendar.js"></script>
<script class="ng-scope" type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/calendar/calendar-demo.js"></script>

<script>
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.
    var map, infoWindow;
    function initMap() {
        geocoder = new google.maps.Geocoder();
         var latlng = new google.maps.LatLng(35.757554, 51.410456);

        var mapOptions = {
            zoom: 8,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
//                    title: document.getElementById('locAddress').value,
                    animation: google.maps.Animation.DROP,
                    position: pos
                });
//                infoWindow.setPosition(pos);
//                infoWindow.setContent('Location found.');
//                infoWindow.open(map);
                map.setCenter(pos);
                google.maps.event.addListener(marker, 'dragend', function () {
//                    alert(marker.getPosition());
                    geocodePosition(marker.getPosition());
                });
                google.maps.event.addListener(map, 'click', function () {
                    infowindow.close();
                });
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }
</script>
<script type="text/javascript">

</script>
<?php include _PATH . "instance/front/tpl/google_maps.js.php"; ?>
