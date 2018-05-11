<?php include _PATH . "instance/front/tpl/libValidate.php" ?>


<script type="text/javascript">
    var geocoder;
    var map;
    var marker;
    var infowindow = new google.maps.InfoWindow({
        size: new google.maps.Size(50, 50)
    });
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
        var input = document.getElementById('locAddress');
        var autocomplete = new google.maps.places.Autocomplete(input);
//        alert(autocomplete);

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
                    $("#latlang").val(marker.getPosition());
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

    function geocodePosition(pos) {
//        alert("GEO POSITION CALLED");
        geocoder.geocode({
            latLng: pos
        }, function (responses) {
            if (responses && responses.length > 0) {
                marker.formatted_address = responses[0].formatted_address;
                $("#locAddress").val(marker.formatted_address);
//                alert(marker.formatted_address);
            } else {
                marker.formatted_address = 'Cannot determine address at this location.';
            }
            infowindow.setContent(marker.formatted_address + "<br>coordinates: " + marker.getPosition().toUrlValue(6));
//            alert(marker.formatted_address + "<br>coordinates: " + marker.getPosition().toUrlValue(6));
            infowindow.open(map, marker);
        });
    }

    function codeAddress() {
        var address = document.getElementById('locAddress').value;
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
                $("#latlang").val(results[0].geometry.location);
                marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
//                    title: document.getElementById('locAddress').value,
                    animation: google.maps.Animation.DROP,
                    position: results[0].geometry.location
                });




                google.maps.event.addListener(marker, 'dragend', function () {
//                    alert(marker.getPosition());
                    $("#latlang").val(marker.getPosition());
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

    google.maps.event.addDomListener(window, "load", initMap);
    function MapBinding(address) {
//        ajax({
//            url: '<?php echo _U ?>location',
//            dataType: "json",
////                type: "post",
//            data: {
//                LocationDetails: 1,
//                id: id
//
////                dates: $("#daterangepicker-time").val()
//            }, success: function (r) {
//                codeAddress();
//            }
//        });
        if (address == "") {

        } else {
            $("#locAddress").val(address);
            $("#myModalLabel2").html(address);
            codeAddress();
            google.maps.event.addDomListener(window, "load", initMap);
            $("#myModal2").modal('show');
        }
    }
    $(document).ready(function () {

    });
</script>
<script>
    function toastCall() {
<?php if ($_SESSION['success'] === "1") { ?>
            _toast("success", "<?php echo $_SESSION['msg']; ?>");
<?php } else { ?>
            _toast("warning", "<?php echo $_SESSION['msg']; ?>");
<?php } ?>
    }
    function discardLocation(id) {
//        alert("Deleted =" + id);
        $.ajax({
            url: '<?php echo _U ?>location',

            dataType: "json",
//            type: "post",
            data: {
                discardLocation: 1,
                id: id

//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
                if (r.success > 0) {
                    $("#" + id).remove();
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
            url: '<?php echo _U ?>location?id="1"',

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
    $(document).on("click", ".locationEdit", function (e) {
        var id = $(this).data('id');
        bindLocation(id);
    });
    $(document).on("click", ".locationDelete", function (e) {
        var id = $(this).data('id');
        discardLocation(id);
    });
    $("#edit_location_form").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        $.ajax({
            url: '<?php echo _U ?>location',
            dataType: "json",
//            type: "post",
            data: {
                isEditLoc: 1,
                ladelData: $("#edit_location_form").serialize()

            }, success: function (r) {
                if (r.success > 0) {
                    $("#" + r.loc.id).find("td:eq(0)").html(r.loc.name);
                    $("#" + r.loc.id).find("td:eq(1) a").html(r.loc.address);
                    _toast("success", "Approved", r.msg);
                    $("#myModal3").modal('hide');

                } else {
                    _toast("warning", "Declind", r.msg);
                }
            }
        });
    });

    function bindLocation(id) {
        $.ajax({
            url: '<?php echo _U ?>location',
            dataType: "json",
//            type: "post",
            data: {
                bindLocation: 1,
                id: id
            }, success: function (r) {
                $("#myModal3").modal('show');
                $("#hidlocid").val(r.id);
                $("#locName").val(r.name);
                $("#edit_location_form #locAddress").val(r.address);
                $("#latlang").val(r.latlng);
                $("#locWeekStart").val(r.week_starton);

            }
        });
    }
</script>
<?php include _PATH . "instance/front/tpl/google_maps.js.php"; ?>