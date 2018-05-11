<?php include _PATH . "instance/front/tpl/libValidate.php" ?>
<script type="text/javascript">
    function UpdateProfile(id) {
        $.ajax({
            url: '<?php echo _U ?>myaccount',
            dataType: "json",
            data: {

                UpdateProfile: 1,
                id: id,
                ladelData: $("#form_profile").serialize()

            }, success: function (r) {
                if (r.success > 0) {
//                    $("#myModal2").close();
//                    $("#myModal2").modal('toggle');
//                    location.href = "<?= _U . $_SESSION['company']['default_page']; ?>";
//                    $("#myModal3").modal({backdrop: 'static', keyboard: false});
//                    $("#mod_4").css("display", "block");
                    _toast("success", "Approved", r.msg);
                } else {
                    _toast("warning", "Declind", r.msg);
//                    location.href = "<?= _U . 'login' ?>";
                }
            }});
    }
    function UpdateResident(id) {
//        alert("UpdateResident");
        $.ajax({
            url: '<?php echo _U ?>myaccount',
            dataType: "json",
            data: {

                UpdateResident: 1,
                id: id,
                ladelData: $("#form_profile_resident").serialize()

            }, success: function (r) {
                if (r.success > 0) {
//                    $("#myModal2").close();
//                    $("#myModal2").modal('toggle');
//                    location.href = "<?= _U . $_SESSION['company']['default_page']; ?>";
//                    $("#myModal3").modal({backdrop: 'static', keyboard: false});
//                    $("#mod_4").css("display", "block");
                    _toast("success", "Approved", r.msg);
                } else {
                    _toast("warning", "Declind", r.msg);
//                    location.href = "<?= _U . 'login' ?>";
                }
            }});
    }

    function UpdateEmergency(id) {
//        alert("UpdateResident");
        $.ajax({
            url: '<?php echo _U ?>myaccount',
            dataType: "json",
            data: {

                UpdateEmergency: 1,
                id: id,
                ladelData: $("#form_profile_emergency").serialize()

            }, success: function (r) {
                if (r.success > 0) {
//                    $("#myModal2").close();
//                    $("#myModal2").modal('toggle');
//                    location.href = "<?= _U . $_SESSION['company']['default_page']; ?>";
//                    $("#myModal3").modal({backdrop: 'static', keyboard: false});
//                    $("#mod_4").css("display", "block");
                    _toast("success", "Approved", r.msg);
                } else {
                    _toast("warning", "Declind", r.msg);
//                    location.href = "<?= _U . 'login' ?>";
                }
            }});
    }
    function UpdatePreview(id) {
        if ($("#profile_pic").val() === "") {
            $("#profile_pic").focus();
            $("#profile_pic").click();
        } else {
//        

            var dataValue = new FormData($("#form_profile_pic")[0]);
            dataValue.append('UpdatePreview', '1');
            dataValue.append('id', id);
            $.ajax({
                url: '<?php echo _U ?>myaccount',
                type: 'POST',
                data: dataValue,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                dataType: 'json',

//                data: {
//
//                    UpdatePreview: 1,
//                    id: id,
////                    ladelData: $("#form_profile_pic").serialize()
////                    ladelData: dataValue
//
//                },
                success: function (r) {
                    if (r.success > 0) {
//                    $("#myModal2").close();
//                    $("#myModal2").modal('toggle');
//                    location.href = "<?= _U . $_SESSION['company']['default_page']; ?>";
//                    $("#myModal3").modal({backdrop: 'static', keyboard: false});
//                    $("#mod_4").css("display", "block");
                        $("#imgTeamProfilePhoto").attr('src', "docs/" + r.img);
                        $("#profile_pic").val("");
                        _toast("success", "Approved", r.msg);
                    } else {
                        _toast("warning", "Declind", r.msg);
//                    location.href = "<?= _U . 'login' ?>";
                    }
                }});
        }
    }
    function kioskchange(pin, id) {
//        alert("PIN=" + pin + " ID =" + id);
//        if (pin === "" && id === "")
        ajaxKisok(pin, id);
    }
    function ajaxKisok(pin, id) {
//        alert("AJAX CAll");
        $.ajax({
            url: '<?php echo _U ?>myaccount',
            dataType: "json",
            data: {

                kisokchange: 1,
                oldpin: pin,
                id: id

            }, success: function (r) {
                $("#k_pin").val(r);
            }});
    }
    $(document).ready(function () {

//        setInterval(function(){
//        var Start_break_check = <?php echo json_encode($_SESSION["start_break"]); ?>;
//            if(Start_break_check == "" || Start_break_check == null){
//               // alert("hi");
//             }else{
//                 Break_time_update(Start_break_check);
//             }
//             
//          }, 6000);
<?php if ($_SESSION["shiftId"] != '') { ?>
            $('#start').hide();
            $('#start_break').show();
            $('#end').show();
            $("#startshiftdisplay").html("<div style='color: green;font-size: 16px;font-weight: bold;'><span>On Shift</span></div><div><span>Started<?php echo $_SESSION['Timecount']; ?></span></div>");
<?php } else { ?>
            $('#start').show();
            $('#end').hide();
            $('#start_break').hide();
            $('#end_break').hide();
            $("#startshiftdisplay").html("");
<?php } ?>
<?php if ($_SESSION["start_break"] != '') { ?>
            $('#end_break').show();
            $('#start_break').hide();
            $("#startshiftdisplay").html("<div style='color: green;font-size: 16px;font-weight: bold;'><span>On Break</span></div><div><span>break</span></div>");
<?php } else { ?>

<?php } ?>

        $("#divsDay").html("");
        var mon = $(this).datepicker('getDate');
        var st = new Date(mon);
//            alert(st.getUTCDate());

//            alert(st.getYear() + '-' + st.getMonth() + '-' + st.getDate());
        $.ajax({
            url: '<?php echo _U ?>myaccount',
            dataType: "json",
            data: {

                DivsDate: 1

            }, success: function (r) {
//                    alert(r.weeks);
                for (var i = 0; i < 7; i++) {

                    var t_status = r.status[i];
                    var t_data = r.weeks_month[i];
                    var t_id = r.weeks[i];
                    var t_dayname = r.dayname[i];
                    var t_dayno = r.dayno[i];
                    $("#divsDate").append("<div style='width:14.285%;float:left;text-align:center;'>" + t_data + "</div>");
                    $("#divsDay").append("<div class='tb_div weeks_divs' data-id=" + t_id + " id='" + t_id + "'>" + t_status + "</div>");
                }
            }
        });
    });

</script>