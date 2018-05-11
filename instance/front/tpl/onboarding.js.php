<script type="text/javascript">
//    window.onbeforeunload = function () {
//        return  "Data will be lost if you leave the page, are you sure?";
//    };    


    window.onload = function () {

        window.addEventListener("beforeunload", function (e) {
            $(".modalContent").each(function () {
                if ($(this).is(':visible')) {
                    if ($(this).attr("id") === 'mod_8') {
                        return undefined;
                    } else {
                        savingUnsavedData();

                        var confirmationMessage = 'Data will be lost if you leave the page, are you sure?';
                        (e || window.event).returnValue = confirmationMessage; //Gecko + IE
                        return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
                    }
                }
            });


        });
    };

    var map;
    var geocoder;
    var marker;
    function initMap() {
        geocoder = new google.maps.Geocoder();
        var myLatLng = {lat: 35.6892, lng: 51.3890};
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: myLatLng
        });
        marker = new google.maps.Marker({
            position: myLatLng,
            draggable: true,
            map: map
        });
        var autocomplete = new google.maps.places.Autocomplete(document.getElementById('locAddress'));
        autocomplete.setTypes(['geocode']);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }
            var myLatLng = {lat: place.geometry.location.lat(), lng: place.geometry.location.lng()};
            marker.setMap(null);
            marker = new google.maps.Marker({
                position: myLatLng,
                draggable: true,
                map: map
            });
            map.setCenter(marker.getPosition());
            google.maps.event.addListener(marker, 'dragend', function () {
                geocodePosition(marker.getPosition());
            });
        });

    }
    function success(position)
    {
        var myLatLng = {lat: position.coords.latitude, lng: position.coords.longitude};
        if (geocoder) {
            geocoder.geocode({'latLng': myLatLng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    $('#locAddress').val(results[0].formatted_address);
                    marker.setMap(null);
                    marker = new google.maps.Marker({
                        position: myLatLng,
                        draggable: true,
                        map: map,
                        title: results[0].formatted_address
                    });
                    map.setCenter(marker.getPosition());
                    google.maps.event.addListener(marker, 'dragend', function () {
                        geocodePosition(marker.getPosition());
                    });
                } else {
                    _toast("warning", "Declind", "Fail to load your address.");
                }
            }); //geocoder.geocode()
        }
    }
    function fail()
    {
        _toast("warning", "Declind", "Map loading fail.");
    }
    function geocodePosition(pos) {
        geocoder.geocode({
            latLng: pos
        }, function (responses) {
            if (responses && responses.length > 0) {
                marker.formatted_address = responses[0].formatted_address;
                $("#locAddress").val(marker.formatted_address);
                $("#latlang").val(pos);
            } else {
                marker.formatted_address = 'Cannot determine address at this location.';
            }
        });
    }
    function getCurrentLocation() {
        if (navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(success, fail);
        } else {
            alert("Sorry, your browser does not support geolocation services.");
        }
    }
    function getCenterLocation() {
//        var myLatLng = {lat: 35.6892, lng: 51.3890};
//        marker.setMap(null);
//        marker = new google.maps.Marker({
//            position: myLatLng,
//            draggable: true,
//            map: map
//        });
        map.setZoom(15);
        map.setCenter(marker.getPosition());
    }
</script>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyDP0smSL_Rs9pG4miCHjoAf-ILRHSsnbPo&libraries=places&callback=initMap&language=fa&region=IR"></script>
<script type="text/javascript">
    var
            mobileReg = /(0|\+98)?([ ]|-|[()]){0,2}9[1|2|3|4]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}/ig,
//            mobileReg = /[0]{1}[9][0-9]{9}/,
            junkReg = /[^\d]/ig,
            persinNum = [/۰/gi, /۱/gi, /۲/gi, /۳/gi, /۴/gi, /۵/gi, /۶/gi, /۷/gi, /۸/gi, /۹/gi],
            num2en = function (str) {
                for (var i = 0; i < 10; i++) {
                    str = str.replace(persinNum[i], i);
                }
                return str;
            },
            getMobiles = function (str) {
                var mobiles = num2en(str + '').match(mobileReg) || [];
                mobiles.forEach(function (value, index, arr) {
                    arr[index] = value.replace(junkReg, '');
                    arr[index][0] === '0' || (arr[index] = '0' + arr[index]);
                });
                return mobiles;
            };
    $(document).on('click', '.checkIsRemote', function (e) {
//        alert($(this).is(':checked'));
        if ($(this).is(':checked')) {
            $(this).val("1");
        } else {
            $(this).val("0");
        }
    });
    $(document).on('keydown change', '.removedBodytaghere input:text', function (e) {
        //        if (e.keyCode == 32 && $(this).val().indexOf(' ') >= 0) {
        //            $(this).text('Already a space!');
        //
//        alert($(this).val().indexOf(" "));
        var n = $(this).val().indexOf(" ");
        if (n < "2" && n >= "0") {
            $(this).val("");
            $(this).prop("placeholder", "white space not allow");
//            $(this).focus();
            $(this).css("background", "pink");
        } else {
            $(this).css("background", "#FFFFFF");
            $(this).prop("placeholder", " ");
        }
    });
    $(document).on('click ', '#EmployeeScreen input:text', function (e) {

        if ($("#empTeam").val() == null) {
            $("#empTeam_chosen").trigger('mousedown');
//            $('#empTeam_chosen a.chosen-single').focus();
        }
    });

    $(document).on('change ', '#screen6_form #EmployeeScreen .phoneValidate', function (e) {

//        alert(this.value.length);
        var isPhone = $(this);
        if (this.value.length >= 1) {
            var isValidate = phoneValidation();
            if (isValidate != "True") {
//                $(this).parent().find("span").text("Enter correct Number");
                $(".savebtn").hide();
            } else {
                var isPhone = $(this);
                $.ajax({
                    url: '<?php echo _U ?>onboarding',
                    dataType: "json",
                    data: {
                        duplicatePhone: 1,
                        phone: this.value
                    }, success: function (r) {
                        if (r.error == "-1") {
                            alert("PHONE " + r.phone + " " + r.msg);
//                             setTimeout(function() {isPhone.focus(); },10000);
                            isPhone.focus();
//                            isPhone.val("");
                            isPhone.css("background", "pink");
//                            isPhone.parent().find("span").text(r.msg);
                            $(".savebtn").hide();
                            return false;
                        } else {
//                            isPhone.parent().find("span").text(r.msg);
                            isPhone.css("background", "#FFFFFF");
                            $(".savebtn").show();
                        }

                    }
                });
            }
        } else {
//            isPhone.parent().find("span").text("");
            isPhone.css("background", "#FFFFFF");
            $(".savebtn").show();
        }
    });
    function duplicatePhone() {
        var retval = true;
        $("#screen6_form #EmployeeScreen .phoneValidate").each(function () {
            if (this.value.length >= 1) {
                var isPhone = $(this);
                $.ajax({
                    url: '<?php echo _U ?>onboarding',
                    dataType: "json",
                    async: false,
                    data: {
                        duplicatePhone: 1,
                        phone: this.value
                    }, success: function (r) {
                        if (r.error == "-1") {
                            alert("PHONE " + r.phone + " " + r.msg);
                            isPhone.focus();
                            isPhone.css("background", "pink");
//                            isPhone.parent().find("span").text(r.msg);
                            retval = false;
                            $(".savebtn").hide();
                            return retval;
                        } else {
//                            isPhone.parent().find("span").text(r.msg);
                            isPhone.css("background", "#FFFFFF");
                            retval = true;
                            $(".savebtn").show();
                            return retval;
                        }
                    }
                });
            } else {
            }
        });
    }
    function submitSix(locationId, flag, isRemot, nextLocation) {
        var isError = 0;

        $("#screen6_form #EmployeeScreen .phoneValidate").each(function () {
            if (this.value.length >= 1) {
                var isPhone = $(this);
                $.ajax({
                    url: '<?php echo _U ?>onboarding',
                    dataType: "json",
                    async: false,
                    data: {
                        duplicatePhone: 1,
                        phone: this.value
                    }, success: function (r) {
                        if (r.error == "-1") {
                            alert("PHONE " + r.phone + " " + r.msg);
                            isPhone.focus();
                            isPhone.css("background", "pink");
//                            isPhone.parent().find("span").text(r.msg);
//                            retval = false;
//                            $(".savebtn").hide();
//                            return retval;
                            isError = isError + 1;
                        } else {
//                            isPhone.parent().find("span").text(r.msg);
                            isPhone.css("background", "#FFFFFF");
//                            retval = true;
//                            $(".savebtn").show();
//                            return retval;

                        }
                    }
                });
            } else {
            }
        });
//        alert(isError);
        if (isError >= 1) {
            return false;
        } else {
//            alert("NO isError");
            screenSix(locationId, flag, isRemot, nextLocation);
        }
    }

    function emilValidation() {
        var retval;
        $(".emailValidate").each(function () {
//            alert($(this).val());
            if ($(this).val() != "") {
                var ch_mail = $(this).val();
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                var isEmail = regex.test(ch_mail);
                if (isEmail != true) {
                    $(this).focus();
                    $(this).css("background", "pink");
                    retval = "False";
//                    return false;
                } else {
                    $(this).css("background", "#FFFFFF");
                    retval = "True";
//                    return true;
                }
            }
        });
        return retval;
    }
//    function phoneValidation() {
//        var retval;
//        $(".phoneValidate").each(function () {
//            if ($(this).val() != "") {
//                var isVal = getMobiles($(this).val()).length;
////                alert(isVal);
//                if (isVal == "0") {
//                    
//                    $(this).focus();
//                    $(this).css("background", "pink");
//                    retval = "False";
//                    return false;
//                } else {
//                    $(this).css("background", "#FFFFFF");
//                    retval = "True";
//                    return true;
//                }
//            } else {
//                retval = "True";
//                return true;
//            }
//        });
//        return retval;
//    }
    function phoneValidation() {
        var retval;
        $(".phoneValidate").each(function () {
            if ($(this).val() != "") {
                var ch_mob = $(this).val();
                var regex = /^[0]{1}[9]{1}[0-9]{9}$/;
                var isMobile = regex.test(ch_mob);
//                alert(isMobile);
                if (isMobile != true) {
                    $(this).focus();
                    $(this).css("background", "pink");
                    retval = "False";
                    return false;
                } else {
                    $(this).css("background", "#FFFFFF");
                    retval = "True";
                    return true;
                }
            } else {
                retval = "True";
                return true;
            }
        });
        return retval;
    }


//    $(document).on('change ', 'body input:text', function (e) {
//        //        if (e.keyCode == 32 && $(this).val().indexOf(' ') >= 0) {
//        //            $(this).text('Already a space!');
//        //            
//        //        }
//        var regx = /^[A-Za-z0-9]{3,}$/;
////        var regx = /^[\s]{2,}$/;
//        var txt = $(this).val();
//        var istest = regx.test(txt);
//        //alert(istest);
//        if (istest != true) {
//            $(this).focus();
//            $(this).val('');
//
//        }
//    });
    function changeToggle(nav) {
        $(".tab").removeClass('active');
        $(".step" + nav).addClass('active');
    }
    function saveEmployee() {
//        var emailCheck = emilValidation();
        var mobileCheck = phoneValidation();
        var mobileduplicate = duplicatePhone();
        if (mobileCheck == "True" && mobileduplicate != "false") {

            $.ajax({
                url: '<?php echo _U ?>onboarding',
                dataType: "json",
                data: {
                    editEmployeeDetail: 1,
                    ladelData: $("#editEmployeeDetail").serialize()
                }, success: function (r) {
                    if (r.success > 0) {
                        _toast("success", "Approved", r.msg);
                        loadEmployeeList();
                        allSummary();
                        $("#editEmployeeModal").modal('hide');
                    }
                }
            });
        }
    }
    function editEmployee(id, type) {
        $.ajax({
            url: '<?php echo _U ?>onboarding',
            data: {
                editEmployee: 1,
                id: id, type: type
            }, success: function (r) {
                $("#editEmployeeForm").html(r);
                $("#editEmployeeModal").modal('show');
            }
        });
    }
    function changeEmailToggle() {
        $("#changeEmailDiv").toggle();
        $("#verifyEmailDiv").toggle();
    }
    function Emailchange() {
        var ch_mail = $("#changeEmail").val();
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var isEmail = regex.test(ch_mail);
        if (isEmail != true) {
            $("#changeEmail").focus();
            $("#changeEmail").css("background", "pink");
        } else {
            $("#changeEmail").css("background", "#FFFFFF");
            $.ajax({
                url: '<?php echo _U ?>onboarding',
                dataType: "json",
                data: {
                    changeMail: 1,
                    ladelData: $("#screen3_form").serialize()
                }, success: function (r) {
                    if (r.success > 0) {
                        $("#email_span").text(r.empid.email);
                        _toast("success", "Approved", r.msg);
                        $("#hidempid3").val(r.empid.id);
                        $("#hidemail3").val(r.empid.email);
                        $("#hidcompid3").val(r.work_at);
                        $("#compid").val(r.work_at);
                        changeEmailToggle();
                    } else {
                        _toast("warning", "Declind", r.msg);
                    }
                }
            });
        }
    }
    function screenOne() {
        var bname = $("#bname").val();
        var workEmail = $("#workEmail").val();
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var isEmail = regex.test(workEmail);

        if ($("#fname").val() == "") {
            $("#fname").focus();
            $("#fname").css("background", "pink");
        } else if ($("#lname").val() == "") {
            $("#lname").focus();
            $("#lname").css("background", "pink");
        } else if (bname === "") {
            $("#bname").focus();
        } else if (isEmail != true) {
            $("#workEmail").focus();
            $("#workEmail").css("background", "pink");
        } else if ($("#password").val() == "") {
            $("#password").focus();
            $("#password").css("background", "pink");
        } else {
            $("#fname").css("background", "#FFFFFF");
            $("#lname").css("background", "#FFFFFF");
            $("#password").css("background", "#FFFFFF");
            $("#workEmail").css("background", "#FFFFFF");
            $("#hidbname2").val(bname);
            $("#hidemail2").val(workEmail);
            $.ajax({
                url: '<?php echo _U ?>onboarding',
                dataType: "json",
                data: {
                    checkEmail: 1,
                    data: $("#workEmail").val()
                }, success: function (r) {
                    if (r.success > 0) {
                        screenTwo();
                    } else {
                        _toast("warning", "Declind", r.msg);
                    }
                }
            });
        }
    }
    function screenTwo() {
        $.ajax({
            url: '<?php echo _U ?>onboarding',
            dataType: "json",
            data: {
                screenTwo: 1,
                ladelData: $("#screen2_form").serialize()
            }, success: function (r) {
                if (r.success > 0) {
                    $("#email_span").text(r.empid.email);
                    _toast("success", "Approved", r.msg);
                    setModel('2');
                    $("#hidempid3").val(r.empid.id);
                    $("#hidemail3").val(r.empid.email);
                    $("#hidcompid3").val(r.work_at);
                    $("#compid").val(r.work_at);
                    $("#code").val(r.empid.mail_code);
                } else {
                    _toast("warning", "Declined", r.msg);
                }
            }
        });
    }

    function screenThree() {
        $.ajax({
            url: '<?php echo _U ?>onboarding',
            dataType: "json",
            data: {
                screenThree: 1,
                ladelData: $("#screen3_form").serialize()
            }, success: function (r) {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);

                    //setModel('csv_manual');

                    $(".modalContent").css("display", "none");
                    $("#mod_csv_manual").css("display", "block").slideDown();

                    initMap();
                    changeToggle('2');
                    if ($('#mod_4').is(':visible'))
                    {
//                        initMap();
                    }
                    $("#hidempid4").val(r.empid.id);
                    $("#hidempid5").val(r.empid.id);
                    $("#hidcompid4").val(r.work_at);
                    $("#hidcompid5").val(r.work_at);
                } else {
                    _toast("warning", "Declind", r.msg);
                }
            }
        });
    }
    function saveTeam() {
        var isRemote = "";
        if ($("#isRemote").is(':checked')) {
            isRemote = "1";
        } else {
            isRemote = "0";
        }
        $("#hidisremote").val(isRemote);
        var n = $('input[name="area[]"]').val();
        if (n == "") {
            $("body").find('input[name="area[]"]').eq(0).focus();
            //$('input[name="area[]"]').focus();
            $("body").find('input[name="area[]"]').eq(0).css("background", "pink");
        } else {
            $("body").find('input[name="area[]"]').eq(0).css("background", "#FFFFFF");
            $.ajax({
                url: '<?php echo _U ?>onboarding',
                dataType: "json",
                data: {
                    saveTeam: 1,
                    ladelData: $("#screen5_form").serialize()
                }, success: function (r) {
                    if (r.success > 0) {
                        _toast("success", "Approved", r.msg);
                        setModel('5');
                        changeToggle('3');
                        loadEmployeeForm(isRemote, 1, 1);
                    } else {
                        _toast("warning", "Declind", r.msg);
                    }
                }
            });
        }
    }
    function loadEmployeeForm(isremote, location, isFirst) {
        $.ajax({
            url: '<?php echo _U ?>onboarding',
            data: {
                loadEmployeeForm: 1, companyId: $("#compid").val(), locationId: location, isremote: isremote, isFirst: isFirst
            }, success: function (r) {
                $("#employeeFormList").html(r);
                $('.dropdown-toggle').dropdown();
                $('.empTeam').chosen();
                loadEmployeeList();
            }
        });
    }
    function addEmployee(isremote, compId, locationId) {
        $.ajax({
            url: '<?php echo _U ?>onboarding',
            data: {
                loadMoreEmp: 1, compId: compId, isremote: isremote, locationId: locationId
            }, success: function (r) {
                $("#wrap_div_r").append(r);
                $('.dropdown-toggle').dropdown();
                $('.empTeam').chosen();
                $(".access").chosen();
                $('#wrap_div_r input[type="checkbox"].custom-checkbox').uniform();
            }
        });
    }
    function loadEmployeeList() {
        var company_id = "";
        $("#screen6_form .emp_list").hide();
        $("#employee_list_wait").show();
        company_id = $("#compid").val();
        $.ajax({
            url: '<?php echo _U ?>onboarding',
            data: {loadEmployeeList: 1, company_id: company_id},
            success: function (r) {
                $("#screen6_form .emp_list").hide();
                $("#employee_list").html(r);
                $("#employee_list").show();
                $("#screen6_form .summaryByTeam").accordion({
                    collapsible: true,
                });
                $("#screen6_form #emp_accordion .ui-accordion-content").css("height", "fit-content");
                $("#screen6_form .summaryByLocation").accordion({
                    collapsible: true
                });
                $("#screen6_form .summaryByLocation .ui-accordion-content").css("height", "fit-content");
                $('.ui-accordion-content').css('height', 'auto');
                $('#employee_list .ui-accordion-content').css('height', 'auto');
            }

        });
    }
    function screenFour(flag) {
        if ($("#locName").val() == "" && flag == 1) {
            $("#locName").focus();
            $("#locName").css("background", "pink");
            return;
        } else if ($("#locAddress").val() == "" && flag == 1) {
            $("#locAddress").focus();
            $("#locAddress").css("background", "pink");
            return;
        } else {
            $("#locName").css("background", "#FFFFFF");
            $.ajax({
                url: '<?php echo _U ?>onboarding',
                dataType: "json",
                data: {
                    screenFour: 1,
                    ladelData: $("#screen4_form").serialize()
                }, success: function (r) {
                    if (r.success > 0) {
                        _toast("success", "Approved", r.msg);
                        setModel('8');
                        $("#hidempid6").val(r.empid.id);
                        $("#hidcompid6").val(r.work_at);
                        $("#hidempid7").val(r.empid.id);
                        $("#hidcompid7").val(r.work_at);
                        $("#hidempid8").val(r.empid.id);
                        $("#hidcompid8").val(r.work_at);
                        $("#hidempid9").val(r.empid.id);
                        $("#hidcompid9").val(r.work_at);
                        $("#hidempid10").val(r.empid.id);
                        $("#hidcompid10").val(r.work_at);
                        $("#compid").val(r.work_at);
                        var tabContents = "";
                        $.each(r.loc, function (i, loc) {
                            tabContents += "<tr><td>" + loc.name + "</td><td>" + loc.address + "</td></tr>";
                        });
                        $('#LocSummary').html(tabContents);
                    } else {
                        _toast("warning", "Declind", r.msg);
                    }
                }
            });
        }
    }
    function changeTeam() {
        var oldTeamId = $("#empTeam").val();
        if (oldTeamId === "add_new_team") {
            $("#showNewTeam").slideDown();
        } else {
            $(".afterTeamSelect").removeClass('hidden');
            $(".beforeTeamSelect").addClass('hidden');
            $("#teamId").val($("#empTeam").val());
        }

    }

    function screenSix(locationId, flag, isRemot, nextLocation) {
//        var emailCheck = emilValidation();
        var mobileCheck = phoneValidation();
        var mobileduplicate = duplicatePhone();
        if (mobileCheck == "True" && mobileduplicate != "false") {
            if ($("#teamId").val() != 'noId' || nextLocation == 1) {
                var oldTeamId = $("#empTeam").val();
                $("#empTeam").val($("#teamId").val());
                $.ajax({
                    url: '<?php echo _U ?>onboarding',
                    dataType: "json",
                    data: {
                        screenSix: 1,
                        ladelData: $("#screen6_form").serialize(),
                        locationId: locationId
                    }, success: function (r) {
                        if (r.success > 0) {
                            if (r.nextlocation === 1) {
                                _toast("success", "Approved", r.msg);
//                            if (nextLocation === 1) {
//                                loadEmployeeForm(isRemot, locationId, 1);
//                            } else {
                                loadEmployeeForm(isRemot, locationId, 0);
//                            }
                                setModel('5');
                                $('.field_wrapper').html("");
                                $("#wrap_div_r input:text").val("");
                            } else if (r.nextlocation === -2 && flag === '0') {
                                _toast("success", "Approved", r.msg);
                                loadEmployeeForm(1, locationId, 0);
                                setModel('5');
                                $('.field_wrapper').html("");
                                $("#wrap_div_r input:text").val("");
                            } else if (r.nextlocation === -2 && flag === '1') {
//                            allSummary();
                                callFinalSummary();
//                            setModel('6');
                                changeToggle('4');
                            } else {
                                setModel('9');
                            }
                            setTimeout(function () {
                                $('#empTeam').trigger("chosen:updated");
//                            $("#teamId").val(oldTeamId);
//                            $("#empTeam").val(oldTeamId);
                            }, 1000);
                        } else {
                            _toast("warning", "Declind", r.msg);
                        }
                    }
                });
            }
        }
    }
    function callFinalSummary() {
        setModel('10');
        allSummary();
    }
    function allSummary() {
//        setModel('10');
        $.ajax({
            url: '<?php echo _U ?>onboarding',
            data: {
                loadAllSummary: 1, companyId: $("#compid").val()
            }, success: function (r) {
                $("#allSummary").html(r);
            }
        });
    }
    function addMainTeam() {
        $("#field_wrapper_areas").append($("#teamInputBox").html());
        setTimeout(function () {
            $('.tooltip-button').tooltip({
                container: 'body'
            });
        }, 500);
    }
    function resend() {
        $.ajax({
            url: '<?php echo _U ?>onboarding',
            dataType: "json",
            data: {
                resend: 1,
                ladelData: $("#screen3_form").serialize()
            }, success: function (r) {
                if (r.success > 0) {
                    _toast("success", "Approved", r.msg);
                } else {
                    _toast("warning", "Declind", r.msg);
                }
            }
        });
    }
    function CallSubmit(value) {
        $("#set_default_page").val(value);
        $.ajax({
            url: '<?php echo _U ?>onboarding',
            dataType: "json",
            data: {
                screenSeven: 1,
                ladelData: $("#screen7_form").serialize()
            }, success: function (r) {
                if (r.success > 0) {
                    $("#usernm").text(r.user);
                    setModel('7');
                } else {
                    _toast("warning", "Declind", r.msg);
                }
            }});
    }
    function setModel(value) {
        $("#mdiv_active").val(value);
        set_model();
        if (value === "7") {
            calProgress();
        }
    }
    function set_model() {
        var md_no = $("#mdiv_active").val();
        md_no++;
        var md = md_no;
        $("#mdiv_active").val(md);
        $(".modalContent").css("display", "none");
        $("#mod_" + md).css("display", "block");
        $("#mod_" + md).slideDown();
    }
    function calProgress() {
        var elem = document.getElementById("myBar");
        var width = 1;
        var id = setInterval(frame, 60);
        function frame() {
            if (width >= 100) {
                clearInterval(id);
//                exitFlag = "flase";
                window.onbeforeunload = null;  
                location.href = "<?= _U ?>" + $('#set_default_page').val(); 
            } else {
                width++;
                elem.style.width = width + '%';
            }
        }
    }
    function showSummaryByLocation() {
        console.log("here");
        $(".location_summary .active").removeClass("active");
        $("#tabSummaryLocation").addClass("active");
        $(".empSummary").hide();
        $(".summaryByLocation").show();
    }
    function showSummaryByTeam() {
        console.log("here 2");
        $(".location_summary .active").removeClass("active");
        $("#tabSummaryTeam").addClass("active");
        $(".empSummary").hide();
        $(".summaryByTeam").show();
    }

    function manualAddTeam() {
        initMap();
        setModel('3');
    }


    function ConfirmDialog(message, id) {
        $('<div></div>').appendTo('body')
                .html('<div><h4>' + message + '?</h4></div>')
                .dialog({
                    modal: true, title: 'Please confirm', zIndex: 10000, autoOpen: true,
                    width: 'auto', resizable: false,
                    open: function () {
                        $('.ui-widget-overlay').addClass('custom-overlay');
                    },
                    buttons: {
                        Yes: function () {
                            $(this).dialog("close");
                            $.ajax({
                                url: '<?php echo _U ?>onboarding',
                                dataType: "json",
                                data: {
                                    removeEmp: 1,
                                    id: id
                                }, success: function (r) {
                                    if (r.success > 0) {
                                        _toast("success", "Approved", r.msg);
                                        loadEmployeeList();
                                        allSummary();
                                    } else {
                                        _toast("warning", "Declind", r.msg);
                                    }
                                }
                            });
                        },
                        No: function () {
                            $(this).dialog("close");
                            _toast("warning", "Declind", "you don't want to delete employee");
                        }
                    },
                    close: function (event, ui) {
                        $(this).remove();
                    }
                });
    }

    function removeEmp(id, empName) {
        ConfirmDialog('Are you sure you want to delete ' + empName + '?', id);
    }
    function SaveTeamData() {
        if ($.trim($("#addTeam").val()) == "") {
            $("#addTeam").focus();
            return;
        } else {
            $.ajax({
                url: '<?php echo _U ?>onboarding',
                dataType: "json",
                data: {
                    addTeam: 1,
                    teamName: $("#addTeam").val(), compId: $("#compid").val()
                }, success: function (r) {
                    if (r.success > 0) {
//                         loadEmployeeForm($("#hidisremote").val(), 1, 0);
                        var contents = "";
                        var selectValue = "";
                        var selectId = '';
                        contents += "<option  value='' disabled >Choose Team</option>";
                        $.each(r.team, function (i, item) {
                            if (item.name === $("#addTeam").val()) {
                                selectValue = 'selected';
                                selectId = item.id;
                            } else {
                                selectValue = '';
                            }
                            contents += "<option value='" + item.id + "' " + selectValue + ">" + item.name + "</option>";
                        });
                        contents += "<option value='add_new_team'>Add New Team</option>";
                        $('#empTeam').html(contents);
                        $('#empTeam').trigger('chosen:updated');
                        $("#teamId").val(selectId);
//        $(".beforeTeamSelect").removeClass('hidden');
//                    $(".afterTeamSelect").addClass('hidden');
                    }
                }
            });
            $("#showNewTeam").slideUp();


            loadEmployeeList();
        }
    }
    $(document).ready(function () {
<?php
$mailEmpId = trim($_REQUEST['mailEmpId']);
$setGetData = 0;
if (isset($_REQUEST['mailEmpId']) && $mailEmpId > 0) {
    $getOtherDetails = qs("SELECT * FROM tb_onboarding_lost_data WHERE employee_id = '{$mailEmpId}' ORDER BY id desc LIMIT 0,1");
    if (!empty($getOtherDetails)) {
        $setGetData = 1;
        $getModArr = explode("_", $getOtherDetails['stage_no']);
        $stageNo = $getModArr[1];
        $modVal = $getOtherDetails['stage_no'];
        if ($modVal == "mod_4") {
            $modVal = "mod_9";
        } else if ($modVal == "mod_5") {
            $modVal = "mod_6";
        }
        ?>
                $(".modalContent").css("display", "none");
                $('input[name="hidempid"]').val('<?= $getOtherDetails['employee_id'] ?>');
                $('input[name="hidcompid"]').val('<?= $getOtherDetails['company_id'] ?>');
                $("#compid").val('<?= $getOtherDetails['company_id'] ?>');
                $("#<?php print $modVal; ?>").css("display", "block");
                $(".tab").removeClass("active");
                $(".<?php print $getOtherDetails['active_tab']; ?>").addClass("active");
        <?php if ($modVal == "mod_9") { ?>
                    screenFour(0);
        <?php } ?>

        <?php if ($modVal == "mod_6") { ?>
                    loadEmployeeForm(1, 1, 0);
        <?php } ?>

        <?php if ($modVal == "mod_11") { ?>
                    callFinalSummary();
        <?php } ?>





        <?php
    }
}
if ($setGetData == 0) {
    ?>
            $("#mdiv_active").val('1');
            $("#emp_fname").val('<?= $_REQUEST['fname'] ?>');
            $("#emp_lname").val('<?= $_REQUEST['lname'] ?>');
            $("#email").val('<?= $_REQUEST['email'] ?>');
            $(".modalContent").css("display", "none");
            $("#mod_1").css("display", "block");
            $('.ui-accordion-content').css('height', 'auto');
    <?php if ($success == "1") { ?>
                Materialize.toast('<?= $msg; ?>', 4000);
    <?php } ?>
    <?php if ($success == "-1") { ?>
                Materialize.toast('<?= $msg; ?>', 4000);
    <?php } ?>
<?php } ?>
    });

    function savingUnsavedData() {
        if ($("#hidempid3").val() !== '' && $("#hidcompid3").val() !== '') {
            var stage_no = '';
            $(".modalContent").each(function () {
                if ($(this).is(':visible') && stage_no === '') {
                    stage_no = $(this).attr("id");
                }
            });

            var activeTabCls = $("#form-wizard-3").find("li.active").attr("class");
            activeTabCls = activeTabCls.toString().replace("tab", "");
            activeTabCls = activeTabCls.toString().replace("active", "");
            activeTabCls = activeTabCls = $.trim(activeTabCls);
            $.ajax({
                url: '<?php echo _U ?>onboarding',
                dataType: "json",
                data: {
                    savingUnsavedData: 1,
                    employee_id: $("#hidempid3").val(),
                    company_id: $("#hidcompid3").val(),
                    stage_no: stage_no,
                    active_tab: activeTabCls
                }, success: function (r) {
                    console.log(r);
                }
            });
        }
    }

</script>
<!--<script>
    $.fn.dataTableExt.oApi.fnFilterAll = function (oSettings, sInput, iColumn, bRegex, bSmart) {
        var settings = $.fn.dataTableSettings;

        for (var i = 0; i < settings.length; i++) {
            settings[i].oInstance.fnFilter(sInput, iColumn, bRegex, bSmart);
        }
    };

    $(document).ready(function () {
        $('#table1').dataTable({
            "bPaginate": false,

        });
        var oTable0 = $("#table1").dataTable();

        $("#Search_All").keyup(function () {
            // Filter on the column (the index) of this element
            oTable0.fnFilterAll(this.value);
        });
    });

    $(document).ready(function () {
        $('#table2').dataTable({
            "bPaginate": false,

        });
        var oTable1 = $("#table1").dataTable();

        $("#Search_All").keyup(function () {
            // Filter on the column (the index) of this element
            oTable1.fnFilterAll(this.value);
        });
    });
</script>-->
