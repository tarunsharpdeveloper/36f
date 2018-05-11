<!--<html>
    <head>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP0smSL_Rs9pG4miCHjoAf-ILRHSsnbPo&libraries=places&callback=initialize&language=fa&region=IR"></script>
         <script src="https://maps.googleapis.com/maps/api/js"></script>

        <script type="text/javascript">
            var geocoder;
            var map;
            var marker;
            var infowindow = new google.maps.InfoWindow({
                size: new google.maps.Size(150, 50)
            });

            function initialize() {
                geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(-34.397, 150.644);
                var mapOptions = {
                    zoom: 8,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
                google.maps.event.addListener(map, 'click', function () {
                    infowindow.close();
                });
            }

            function geocodePosition(pos) {
                geocoder.geocode({
                    latLng: pos
                }, function (responses) {
                    if (responses && responses.length > 0) {
                        marker.formatted_address = responses[0].formatted_address;
                    } else {
                        marker.formatted_address = 'Cannot determine address at this location.';
                    }
                    infowindow.setContent(marker.formatted_address + "<br>coordinates: " + marker.getPosition().toUrlValue(6));
                    infowindow.open(map, marker);
                });
            }

            function codeAddress() {
                var address = document.getElementById('address').value;
                geocoder.geocode({
                    'address': address
                }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                        if (marker) {
                            marker.setMap(null);
                            if (infowindow)
                                infowindow.close();
                        }
                        marker = new google.maps.Marker({
                            map: map,
                            draggable: true,
                            position: results[0].geometry.location
                        });
                        google.maps.event.addListener(marker, 'dragend', function () {
                            geocodePosition(marker.getPosition());
                        });
                        google.maps.event.addListener(marker, 'click', function () {
                            if (marker.formatted_address) {
                                infowindow.setContent(marker.formatted_address + "<br>coordinates: " + marker.getPosition().toUrlValue(6));
                            } else {
                                infowindow.setContent(address + "<br>coordinates: " + marker.getPosition().toUrlValue(6));
                            }
                            infowindow.open(map, marker);
                        });
                        google.maps.event.trigger(marker, 'click');
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            }

            google.maps.event.addDomListener(window, "load", initialize);
        </script>
    </head>
    <body>
        <style>
            html,
            body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
            #map_canvas {
                height: 100%;
            }
            @media print {
                html,
                body {
                    height: auto;
                }
                #map_canvas {
                    height: 650px;
                }
            }
        </style>
        <div>
            <input id="address" type="textbox" value="Sydney, NSW">
            <input type="button" value="Geocode" onclick="codeAddress()">
        </div>
        <div id="map_canvas" style="height:90%;top:30px"></div>
    </body>
</html>

-->

<!DOCTYPE html>
<html>
    <head>
        <title>Geolocation</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                height: 100%;
            }
            /* Optional: Makes the sample page fill the window. */
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
        </style>
    </head>
    <body>
        <div id="map"></div>
        <script>
            // Note: This example requires that you consent to location sharing when
            // prompted by your browser. If you see the error "The Geolocation service
            // failed.", it means you probably did not give permission for the browser to
            // locate you.
            var map, infoWindow;
            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: -34.397, lng: 150.644},
                    zoom: 6
                });
                infoWindow = new google.maps.InfoWindow();
                geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(35.757554, 51.410456);

                var mapOptions = {
                    zoom: 8,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                map = new google.maps.Map(document.getElementById('map'), mapOptions);
//        map.setZoom(30);
                marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
//                    title: document.getElementById('locAddress').value,
                    animation: google.maps.Animation.DROP,
                    position: {lat: 35.757554, lng: 51.410456}
                });
                google.maps.event.addListener(marker, 'dragend', function () {
//                    alert(marker.getPosition());
                    geocodePosition(marker.getPosition());
                });
                google.maps.event.addListener(map, 'click', function () {
                    infowindow.close();
                });
                // Try HTML5 geolocation.
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        alert(position.coords.latitude);
                        alert(position.coords.longitude);
                        infoWindow.setPosition(pos);
                        infoWindow.setContent('Location found.');
                        infoWindow.open(map);
                        map.setCenter(pos);
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
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP0smSL_Rs9pG4miCHjoAf-ILRHSsnbPo&libraries=places&callback=initMap&language=fa&region=IR"></script>
    </body>
</html>