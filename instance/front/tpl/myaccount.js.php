
<script type="text/javascript" src="<?php print _MEDIA_URL ?>js/jquery.mask.min.js"></script>

<script type="text/javascript">
    function initMap() {
        var options = {
            types: ['(cities)'],
            componentRestrictions: {country: "ir"}
        };

        var input = document.getElementById('BCI');
        var autocomplete = new google.maps.places.Autocomplete(input, options);
        var optionsCity = {
            types: ['(cities)'],
            componentRestrictions: {country: "ir"}
        };

        var inputCity = document.getElementById('city');
        var autocompleteCity = new google.maps.places.Autocomplete(inputCity, optionsCity);

        var optionsState = {
            componentRestrictions: {country: "ir"}
        };

        var inputState = document.getElementById('state');
        var autocompleteCity = new google.maps.places.Autocomplete(inputState, optionsState);
    }
    var msgError = '';
    $("#pmonth").change(function () {
        if ($("#pmonth").val() >= 7) {
            $("#pdate option").last().attr('disabled', 'disabled');
        } else {
            $("#pdate option").last().removeAttr('disabled');
        }
    });

    $("#Hmonth").change(function () {
        if ($("#Hmonth").val() >= 7) {
            $("#Hdate option").last().attr('disabled', 'disabled');
        } else {
            $("#Hdate option").last().removeAttr('disabled');
        }
    });

    $("#Tmonth").change(function () {
        if ($("#Tmonth").val() >= 7) {
            $("#Tdate option").last().attr('disabled', 'disabled');
        } else {
            $("#Tdate option").last().removeAttr('disabled');
        }
    });
    $("#pyear").change(function () {
        if ($("#pyear").val() >= '1368') {
            $("#BCN").val($("#pyear").val() + $("#pmonth").val() + $("#pdate").val());
        }
    });
    $("#mobile").blur(function () {
        var str = $("#mobile").val();
        msgError = '';
        if (str.substr(0, 2) !== '09') {
            msgError += "Must Start with 09";
        }
        if (str.length !== 11) {
            var error = "Must be 11 digit";
            if (msgError != '') {
                msgError += " & ";
            }
            msgError += error;
        }

        if (msgError != '') {
            $("#mobileError").html(msgError).show();
            $("#mobile").focus();
        } else {
            $("#mobileError").html("").hide();
        }

    });
    $("#phone").blur(function () {
        var str = $("#phone").val();
        msgError = '';
        if (str.substr(0, 1) !== '0') {
            msgError += "Must Start with 0";
        }
        if (str.length !== 11) {
            var error = "Must be 11 digit";
            if (msgError != '') {
                msgError += " & ";
            }
            msgError += error;
        }

        if (msgError != '') {
            $("#phoneError").html(msgError).show();
            $("#phone").focus();
        } else {
            $("#phoneError").html("").hide();
        }

    });
    $("#EPhone").blur(function () {
        var str = $("#EPhone").val();
        msgError = '';
        if (str.substr(0, 1) !== '0') {
            msgError += "Must Start with 0";
        }
        if (str.length !== 11) {
            var error = "Must be 11 digit";
            if (msgError != '') {
                msgError += " & ";
            }
            msgError += error;
        }

        if (msgError != '') {
            $("#EPhoneError").html(msgError).show();
            $("#EPhone").focus();
        } else {
            $("#EPhoneError").html("").hide();
        }

    });
    $("#IDN").blur(function () {
        var str = $("#IDN").val();
        msgError = '';
        if (str.length !== 10) {
            var error = "Must be 10 digit";
            msgError += error;
        }

        if (msgError != '') {
            $("#IDN").focus();
            $("#idnError").html(msgError).show();
        } else {
            $("#idnError").html("").hide();
        }

    });
    $("#email").blur(function () {
        var str = $("#email").val();
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(str)) {
            $("#emailError").html('Email address must be valid').show();
            $("#email").focus();
        } else {
            $("#emailError").html("").hide();
        }

    });
    $("#postcode").blur(function () {
        var str = $("#postcode").val();
        msgError = '';
        if (str.length !== 10) {
            var error = "Must be 10 digit";
            msgError += error;
        }

        if (msgError != '') {
            $("#postcodeError").html(msgError).show();
            $("#postcode").focus();
        } else {
            $("#postcodeError").html("").hide();
        }

    });
    $("#monthlySalary").mask("000,000,000,000");

    function secondSection() {
//        alert($(".error:visible").length );
        if ($(".error:visible").length === 0) {
//               alert();
            $(".saveData").hide();
            $(".waitData").show();
            $.ajax({
                url: "<?php echo _U ?>myaccount",
                data: {secondSection: 1, data: $("#first_section").serialize()},
                method: "get",
                success: function (r) {
                    _toast("success", "Approved", "Account data is successfully edited. ");
//                window.location.reload();
                    setTimeout(function () {
                        $(".saveData").show();
                        $(".waitData").hide();
                    }, 2000);
                }
            });
        }
    }
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46) {
            return false;
        } else {
            return true;
        }
    }
    function isLatterKey(evt) {
        var value = evt.key;
        if (/^[a-z]+$/i.test(value)) {
            return true;
        } else {
            return false;
        }
//        return this.optional(element) || /^[a-z]+$/i.test(value);
    }
    $('input[name=gender]').change(function () {
        if ($('input[name=gender]:checked').val() == 'male') {
            $(".military").removeClass('hidden');
        } else {
            $(".military").addClass('hidden');
        }
    });
</script>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyDP0smSL_Rs9pG4miCHjoAf-ILRHSsnbPo&libraries=places&callback=initMap&language=fa&region=IR"></script>
