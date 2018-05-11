<script type="text/javascript">
    $(document).ready(function () {
        $("#endDate").val('');
    })
    function openModalConf(obj) {
        $("#confModal").modal('show');
        $("#formName").val(obj);
    }
    function openCopy() {
        $("#confModal").modal('hide');
        setTimeout(function () {
            $("#copyModal").modal('show');
        }, 1000);
    }
    function dateChnges(obj) {
        $.ajax({
            url: "<?php echo _U ?>add_shift_new",
            data: {
                getDate: 1,
                data: obj
            },
            success: function (r) {
                $("#endDate").val(r);
            }
        });

    }
    function submitCopy() {
        $("#copyModal").modal('hide');
        $.ajax({
            url: "<?php echo _U ?>add_shift_new",
            data: {
                submitData: 1,
                endDate: $("#endDate").val()
            },
            success: function (r) {
                if (r == 'Pass') {
                    $.ajax({
                        url: "<?php echo _U ?>add_shift_new",
                        data: {
                            dataEntry: 1,
//                            data: $("#formName").val(),
                            data: $("#" + $("#formName").val()).serialize(),
                            allowDates: $('input[name="chk[]"]:checked').serialize(),
                            empId: $("#employee").val(),
                            endDate: $("#endDate").val()
                        },
                        success: function (r) {
                            if (r == '0') {
                                alert("Shift is not added because conflict with other shift");
                                $("#leaveModal").modal('hide');
                            } else {
                                $("#endDate").val('');
                                $("#add_shift_list_data").html(r);
                                $("#leaveModal").modal('hide');
                            }
                        }
                    });
                } else {
                    $(".leaveBody").html(r);
                    setTimeout(function () {
                        $("#leaveModal").modal('show');
                    }, 1000);
                }
            }
        });
    }
    function formSubmit() {
        $("#confModal").modal('hide');
        $.ajax({
            url: "<?php echo _U ?>add_shift_new",
            data: {
                submitData: 1,
                endDate: '',
                shiftForm: $("#formName").val()
            },
            success: function (r) {
                if (r == 'Pass') {
                    $.ajax({
                        url: "<?php echo _U ?>add_shift_new",
                        data: {
                            dataEntry: 1,
//                            data: $("#formName").val(),
                            data: $("#" + $("#formName").val()).serialize(),
                            allowDates: $('input[name="chk[]"]:checked').serialize(),
                            empId: $("#employee").val()
                        },
                        success: function (r) {
                            $("#endDate").val('');
                            if (r == '0') {
                                alert("Shift is not added because conflict with other shift");
                                $("#leaveModal").modal('hide');
                            } else {
                                $("#add_shift_list_data").html(r);
                                $("#leaveModal").modal('hide');
                            }
                        }
                    });
                } else {
                    $(".leaveBody").html(r);
                    setTimeout(function () {
                        $("#leaveModal").modal('show');
                    }, 1000);
                }
            }
        });
        $("#endDate").val('');
    }
    function allowDates() {
        $("#copyModal").modal('hide');
        $.ajax({
            url: "<?php echo _U ?>add_shift_new",
            data: {
                dataEntry: 1,
//                data: $("#formName").val(),
                data: $("#" + $("#formName").val()).serialize(),
                allowDates: $('input[name="chk[]"]:checked').serialize(),
                empId: $("#employee").val(),
                endDate: $("#endDate").val()
            },
            success: function (r) {
                if (r == '0') {
                    alert("Shift is not added because conflict with other shift");
                    $("#leaveModal").modal('hide');
                } else {
                    $("#add_shift_list_data").html(r);
                    $("#leaveModal").modal('hide');
                }
            }
        });
        $("#endDate").val('');
    }
    function deleteShift(obj) {
        $("#deleteModal").modal('show');
        $("#deleteShiftId").val($(obj).attr('data-id'));
    }
</script>