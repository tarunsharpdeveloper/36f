<?php include _PATH . "instance/front/tpl/libValidate.php" ?>
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP0smSL_Rs9pG4miCHjoAf-ILRHSsnbPo">
</script>-->
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
//        alert(pos);
        geocoder.geocode({
            latLng: pos
        }, function (responses) {
            if (responses && responses.length > 0) {
                marker.formatted_address = responses[0].formatted_address;
                $("#locAddress").val(marker.formatted_address);

//                 ltng = ltng.replace(')', '');
                $("#latlang").val(pos);
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
                marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
//                    title: document.getElementById('locAddress').value,
                    animation: google.maps.Animation.DROP,
                    position: results[0].geometry.location
                });

                $("#latlang").val(results[0].geometry.location);
                google.maps.event.addListener(marker, 'dragend', function () {
//                    alert(marker.getPosition());
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
</script>
<!--<script type="text/javascript">
    var marker;

    // This example displays a map with the language and region set
    // to Japan. These settings are specified in the HTML script element
    // when loading the Google Maps JavaScript API.
    // Setting the language shows the map in the language of your choice.
    // Setting the region biases the geocoding results to that region.
    function initMap11() {
        initMap2();
//        var map = new google.maps.Map(document.getElementById('map'), {
//            zoom: 8,
//            center: {lat: 35.717, lng: 139.731}
//        });
//        alert("calll");
        var mapDiv = document.getElementById('map');
        var map = new google.maps.Map(mapDiv, {
            zoom: 8,
            center: new google.maps.LatLng(35.6892, 51.3890)
        });
        marker = new google.maps.Marker({
            map: map,
            draggable: true,
            title: "Demo Title",
            animation: google.maps.Animation.DROP,
            position: {lat: 35.6892, lng: 51.3890}
        });
        marker.addListener('click', toggleBounce);
        google.maps.event.addListener(marker, 'dragend', function () {
            updateMarkerStatus('Drag ended');
            geocodePosition(marker.getPosition());
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('locAddress');
        var searchBox = new google.maps.places.SearchBox(input);
//        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function () {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function (marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function (place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    animation: google.maps.Animation.DROP,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });



//        // We add a DOM event here to show an alert if the DIV containing the
//        // map is clicked.
//        google.maps.event.addDomListener(mapDiv, 'click', function () {
//            window.alert('Map was clicked!');
//        });

    }
    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }
    function geocodePosition(pos) {
        geocoder.geocode({
            latLng: pos
        }, function (responses) {
            if (responses && responses.length > 0) {
                updateMarkerAddress(responses[0].formatted_address);
            } else {
                updateMarkerAddress('Cannot determine address at this location.');
            }
        });
    }
</script>-->

<script type="text/javascript">
    function changeToggle(nav) {
        $(".navdiv").hide();
        $("#nav" + nav).show();
        $(".alink").removeClass("active");
        $("#alink" + nav).addClass("true active");
        $("#alink" + nav).addClass("true active");

//        alert(nav);
    }
    function finishCall() {
        var locName = $("#locName").val();
        var locAddress = $("#locAddress").val();
        if (locAddress === "" || locName === "") {
            changeToggle(1);

        } else {
            AjaxSubmitCall();
        }
    }
    function AjaxSubmitCall() {
        $.ajax({
            url: '<?php echo _U ?>add_location',
            dataType: "json",
//                type: "post",
            data: {
                ajaxSubmitAll: 1,
                ladelData: $("#add_location").serialize()

//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
                window.location.href = "<?= l('location') ?>";
//                alert("<?php echo $_SESSION['msg'] ?>");
//                $('#timesheetDiv').html(r);
//                $("#chkbtnunapprove").removeClass("active");
            }
        });
    }
    (function ($) {
        'use strict';

        $.fn.navigationWizard = function (options) {
            var defaults = {
                stepMinDistance: 100,
                stepClickHandler: undefined
            },
                    settings = $.extend({}, defaults, options),
                    navbarContainer = this,
                    navComponent = {};


            var navbarTemplate = $(['<div class="timeline">',
                '<div class="events-wrapper">',
                '<div class="events">',
                '<ol>',
                getSteps(options),
                '</ol>',
                '<span class="filling-line" aria-hidden="true"></span>',
                '</div>',
                '</div>',
                '<ul class="cd-timeline-navigation">',
                '<li><a href="#0" class="prev inactive">Prev</a></li>',
                '<li><a href="#0" class="next">Next</a></li>',
                '</ul>',
                '</div>'
            ].join(''));

            navbarContainer.addClass('cd-horizontal-timeline').append(navbarTemplate);

            //cache timeline components
            navComponent['config'] = settings;
            navComponent['timelineWrapper'] = navbarContainer.find('.events-wrapper');
            navComponent['eventsWrapper'] = navComponent['timelineWrapper'].children('.events');
            navComponent['fillingLine'] = navComponent['eventsWrapper'].children('.filling-line');
            navComponent['timelineEvents'] = navComponent['eventsWrapper'].find('a');
            navComponent['timelineNavigation'] = navbarContainer.find('.cd-timeline-navigation');

            var eventsCount = navComponent['timelineEvents'] && navComponent['timelineEvents'].length;
            //set max-width of the .timeline  
            if ((eventsCount + 2) * settings.stepMinDistance < 800) {
                navComponent['timelineWrapper'].parent('.timeline').css('max-width', (eventsCount + 2) * settings.stepMinDistance)
            }
            //assign a left postion to the single events along the timeline
            setStepPosition(navComponent, settings.stepMinDistance);
            //assign a width to the timeline
            var timelineTotWidth = setTimelineWidth(navComponent, settings.stepMinDistance);
            //the timeline has been initialize - show it
            navbarContainer.addClass('loaded');

            //detect click on the next arrow
            navComponent['timelineNavigation'].on('click', '.next', function (event) {
                event.preventDefault();
                updateSlide(navComponent, timelineTotWidth, 'next');
            });
            //detect click on the prev arrow
            navComponent['timelineNavigation'].on('click', '.prev', function (event) {
                event.preventDefault();
                updateSlide(navComponent, timelineTotWidth, 'prev');
            });
            //detect click on the a single event - show new event content
            navComponent['eventsWrapper'].on('click', 'a', function (event) {
                event.preventDefault();
                navComponent['timelineEvents'].removeClass('active');
                $(this).addClass('alink active');
                updateOlderEvents($(this));
                updateFilling($(this), navComponent['fillingLine'], timelineTotWidth);
                options.stepClickHandler ? options.stepClickHandler.call(this, navComponent) : void 0;
            });

            //keyboard navigation
            $(document).keyup(function (event) {
                if (event.which == '37' && elementInViewport(navbarContainer.get(0))) {
                    showNewNavLi(navComponent, timelineTotWidth, 'prev');
                } else if (event.which == '39' && elementInViewport(navbarContainer.get(0))) {
                    showNewNavLi(navComponent, timelineTotWidth, 'next');
                }
            });
            $(document).off("resize.cd-horizontal-timeline").on("resize.cd-horizontal-timeline", function (event) {
                navComponent['timelineNavigation'].find('.next').click();
                navComponent['timelineNavigation'].find('.prev').click();
            });

            return {
                setActiveNavItem: setActiveNavItem,
                navComponent: navComponent
            };

            function getSteps(options) {
                var steps = '';

                $.each(options.steps, function (index, item) {
                    steps += ['<li>',
                        '<a href="#nav' + (index + 1) + '" id="alink' + (index + 1) + '" data-index="' + (index + 1) + '" onclick="changeToggle(' + (index + 1) + ')" class="' + (index != 0 || "active") + '">' + item.title + '</span> </a>',
                        '</li>'
                    ].join('');
                });

                return steps;
            }

            function setActiveNavItem(index, toggle) {
                var targetElm = $(this.navComponent['timelineEvents'].get(index - 1));
                toggle ? targetElm.removeClass('complete') : targetElm.addClass('alink');
            }

            function updateSlide(navComponent, timelineTotWidth, string) {
                //retrieve translateX value of navComponent['eventsWrapper']
                var translateValue = getTranslateValue(navComponent['eventsWrapper']),
                        wrapperWidth = Number(navComponent['timelineWrapper'].css('width').replace('px', ''));
                //translate the timeline to the left('next')/right('prev') 
                (string == 'next') ? translateTimeline(navComponent, translateValue - wrapperWidth + settings.stepMinDistance, wrapperWidth - timelineTotWidth) : translateTimeline(navComponent, translateValue + wrapperWidth - settings.stepMinDistance);
            }

            function showNewNavLi(navComponent, timelineTotWidth, string) {
                //go from one event to the next/previous one
                var selectedStep = navComponent['eventsWrapper'].find('.active'),
                        selectedStepLi = selectedStep.parent('li'),
                        newContent = (string == 'next') ? selectedStepLi.next() : selectedStepLi.prev();

                if (newContent.length > 0) { //if there's a next/prev event - show it
                    var newEvent = (string == 'next') ? selectedStepLi.next('li').children('a') : selectedStepLi.prev('li').children('a');
                    updateFilling(newEvent, navComponent['fillingLine'], timelineTotWidth);
                    //updateVisibleContent(newEvent, navComponent['eventsContent']);
                    newEvent.addClass('alink active');
                    selectedStep.removeClass('active');
                    updateOlderEvents(newEvent);
                    updateTimelinePosition(string, newEvent, navComponent);

                    options.stepClickHandler ? options.stepClickHandler.call(newEvent, navComponent) : void 0;
                }
            }

            function updateTimelinePosition(string, event, navComponent) {
                //translate timeline to the left/right according to the position of the selected event
                var eventStyle = window.getComputedStyle(event.get(0), null),
                        eventLeft = Number(eventStyle.getPropertyValue("left").replace('px', '')),
                        timelineWidth = Number(navComponent['timelineWrapper'].css('width').replace('px', '')),
                        timelineTotWidth = Number(navComponent['eventsWrapper'].css('width').replace('px', ''));
                var timelineTranslate = getTranslateValue(navComponent['eventsWrapper']);

                if ((string == 'next' && eventLeft > timelineWidth - timelineTranslate) || (string == 'prev' && eventLeft < -timelineTranslate)) {
                    translateTimeline(navComponent, -eventLeft + timelineWidth / 2, timelineWidth - timelineTotWidth);
                }
            }

            function translateTimeline(navComponent, value, totWidth) {
                var eventsWrapper = navComponent['eventsWrapper'].get(0);
                value = (value > 0) ? 0 : value; //only negative translate value
                value = (!(typeof totWidth === 'undefined') && value < totWidth) ? totWidth : value; //do not translate more than timeline width
                setTransformValue(eventsWrapper, 'translateX', value + 'px');
                //update navigation arrows visibility
                (value == 0) ? navComponent['timelineNavigation'].find('.prev').addClass('inactive') : navComponent['timelineNavigation'].find('.prev').removeClass('inactive');
                (value == totWidth) ? navComponent['timelineNavigation'].find('.next').addClass('inactive') : navComponent['timelineNavigation'].find('.next').removeClass('inactive');
            }

            function updateFilling(selectedEvent, filling, totWidth) {
                //change .filling-line length according to the selected event
                var eventStyle = window.getComputedStyle(selectedEvent.get(0), null),
                        eventLeft = eventStyle.getPropertyValue("left"),
                        eventWidth = eventStyle.getPropertyValue("width");
                eventLeft = Number(eventLeft.replace('px', '')) + Number(eventWidth.replace('px', '')) / 2;
                var scaleValue = eventLeft / totWidth;
                setTransformValue(filling.get(0), 'scaleX', scaleValue);
            }

            function setStepPosition(navComponent, min) {
                for (var i = 0; i < navComponent['timelineEvents'].length; i++) {
                    var distanceNorm = i + 1;
                    navComponent['timelineEvents'].eq(i).css('left', distanceNorm * min + 'px');
                }
            }

            function setTimelineWidth(navComponent, width) {
                var timeSpanNorm = navComponent['timelineEvents'].length + 1.2,
                        totalWidth = timeSpanNorm * width;
                navComponent['eventsWrapper'].css('width', totalWidth + 'px');
                updateFilling(navComponent['eventsWrapper'].find('a.active'), navComponent['fillingLine'], totalWidth);
                updateTimelinePosition('next', navComponent['eventsWrapper'].find('a.active'), navComponent);

                return totalWidth;
            }

            function updateOlderEvents(event) {
                event.parent('li').prevAll('li').children('a').addClass('alink older-event').end().end().nextAll('li').children('a').removeClass('older-event');
            }

            function getTranslateValue(timeline) {
                var timelineStyle = window.getComputedStyle(timeline.get(0), null),
                        timelineTranslate = timelineStyle.getPropertyValue("-webkit-transform") ||
                        timelineStyle.getPropertyValue("-moz-transform") ||
                        timelineStyle.getPropertyValue("-ms-transform") ||
                        timelineStyle.getPropertyValue("-o-transform") ||
                        timelineStyle.getPropertyValue("transform"),
                        translateValue = 0;

                if (timelineTranslate.indexOf('(') >= 0) {
                    timelineTranslate = timelineTranslate.split('(')[1];
                    timelineTranslate = timelineTranslate.split(')')[0];
                    timelineTranslate = timelineTranslate.split(',');
                    translateValue = timelineTranslate[4];
                }
                return Number(translateValue);
            }

            function setTransformValue(element, property, value) {
                element.style["-webkit-transform"] = property + "(" + value + ")";
                element.style["-moz-transform"] = property + "(" + value + ")";
                element.style["-ms-transform"] = property + "(" + value + ")";
                element.style["-o-transform"] = property + "(" + value + ")";
                element.style["transform"] = property + "(" + value + ")";
            }

            /*
             How to tell if a DOM element is visible in the current viewport?
             http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
             */
            function elementInViewport(el) {
                var top = el.offsetTop;
                var left = el.offsetLeft;
                var width = el.offsetWidth;
                var height = el.offsetHeight;

                while (el.offsetParent) {
                    el = el.offsetParent;
                    top += el.offsetTop;
                    left += el.offsetLeft;
                }

                return (
                        top < (window.pageYOffset + window.innerHeight) &&
                        left < (window.pageXOffset + window.innerWidth) &&
                        (top + height) > window.pageYOffset &&
                        (left + width) > window.pageXOffset
                        );
            }

            function checkMQ() {
                //check if mobile or desktop device
                return window.getComputedStyle(document.querySelector('.cd-horizontal-timeline'), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "");
            }
        };
    }(jQuery));

    var options = {
        steps: [{
                title: "Location"
            }, {
                title: "Areas Of Work"
            }, {
                title: "People"
            }, {
                title: "Finish"
            }]
    };
    var navbar = $('#cd-horizontal-timeline').navigationWizard(options);
    navbar.setActiveNavItem(2);
    $(document).ready(function () {
//        $("#locAddress").geocomplete();
//        $("#locAddress").autocomplete({
//            source: ["Tehran", "java", "php", "coldfusion", "javascript", "asp", "ruby"]
//        });
        changeToggle(1);
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
            url: '<?php echo _U ?>location',

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
//            url: '<?php echo _U ?>location',
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
            url: '<?php echo _U ?>location',

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
            url: '<?php echo _U ?>location',

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
            url: '<?php echo _U ?>location',

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
            url: '<?php echo _U ?>location',

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
            url: '<?php echo _U ?>location',

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

</script>
<?php include _PATH . "instance/front/tpl/google_maps.js.php"; ?>