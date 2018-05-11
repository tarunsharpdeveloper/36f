<script type="text/javascript">
    function initMap() {

        var options = {
            types: ['(cities)'],
            componentRestrictions: {country: "ir"}
        };

        var input = document.getElementById('test_city');
        var autocomplete = new google.maps.places.Autocomplete(input, options);

        var options = {
            types: ['(regions)'],
            componentRestrictions: {country: "ir"}
        };

        var input = document.getElementById('test_state');
        var autocomplete = new google.maps.places.Autocomplete(input, options);


    }

</script>

<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyC8Nah--MZ-q0F0_tWA0rK88VYgirNwMQk&callback=initMap&libraries=places" ></script>