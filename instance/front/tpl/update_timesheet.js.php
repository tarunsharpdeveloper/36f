<?php include _PATH . "instance/front/tpl/libValidate.php" ?>
<script>
$(function(){
    $("#s_date").bsdatepicker({
        autoClose: true,
        onSelect: function (dateText) {
            display("Selected date: ");
        },
        onClose: function (dateText) {
            display("Close" + this.value);
        }
    }).on("changeDate", function () {
        //ChangeCall();
    });

    $("#e_date").bsdatepicker({
        autoClose: true,
        onSelect: function (dateText) {
            display("Selected date: ");
        },
        onClose: function (dateText) {
            display("Close" + this.value);
        }
    }).on("changeDate", function () {
        //ChangeCall();
    });

    $('#s_time').timepicker({
        minuteStep: 1,
        template: 'dropdown',
        appendWidgetTo: 'body',
        showSeconds: true,
        showMeridian: false,
        defaultTime: false
        
    });
    $('#e_time').timepicker({
        minuteStep: 1,
        template: 'dropdown',
        appendWidgetTo: 'body',
        showSeconds: true,
        showMeridian: false,
        defaultTime: false
        
    });

    /*$('#s_time').timepicker().on('changeTime.timepicker', function(e) {
        var timePicked = $('#s_time').val();

        if(timePicked.length < 8)   
            $('#s_time').val("0" + timePicked);
    });
    $('#e_time').timepicker().on('changeTime.timepicker', function(e) {
        var timePicked = $('#e_time').val();

        if(timePicked.length < 8)   
            $('#e_time').val("0" + timePicked);
    });*/



});
</script>
