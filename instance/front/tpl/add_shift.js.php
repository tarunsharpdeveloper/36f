<script>
    function submitData() {
        $.ajax({
            url: "<?php echo _U ?>add_shift",
            data: {
                submitDataCheck: 1,
                data: $("#form_test_add_shift").serialize()
            },
            success: function (r) {
                if (r == 'Pass') {
                    $.ajax({
                        url: "<?php echo _U ?>add_shift",
                        data: {
                            submitData: 1,
                            data: $("#form_test_add_shift").serialize()
                        },
                        success: function (r) {
                            if (r == '0') {
                                alert('shift is not added ');
                            } else {
                                if (confirm("Are you copy shift for otherdays!") == true) {
                                    $(".chnageInput").css('border-color', '#2ecc71').val('');
                                    $(".copyShift").removeClass('hidden');
                                } else {
                                    $(".chnageInput").css('border-color', '');
                                    $('input').val('');
                                    $(".copyShift").addClass('hidden');
                                }
                                $("#add_shift_list_data").html(r);
                            }
                        }
                    });
                } else {
                    $(".leaveBody").html(r);
                    $("#leaveModal").modal('show');
                }
            }
        });
    }
    function allowDates() {
        $.ajax({
            url: "<?php echo _U ?>add_shift",
            data: {
                submitData: 1,
                allowDates: $('input[name="chk[]"]:checked').serialize(),
                data: $("#form_test_add_shift").serialize()
            },
            success: function (r) {
                $("#leaveModal").modal('hide');
                console.log(r);
                if (r == '0') {
                    alert('shift is not added ');
                } else {
                    if (confirm("Are you copy shift for otherdays!") == true) {
                        $(".chnageInput").css('border-color', '#2ecc71').val('');
                        $(".copyShift").removeClass('hidden');
                    } else {
                        $(".chnageInput").css('border-color', '');
                        $('input').val('');
                        $(".copyShift").addClass('hidden');
                    }
                    $("#add_shift_list_data").html(r);
                }
            }
        });
    }
    function deleteShift(obj) {
        $("#deleteModal").modal('show');
        $("#deleteShiftId").val($(obj).attr('data-id'));
    }
    function editShift(obj) {
        $.ajax({
            url: '<?php echo _U ?>add_shift',
            dataType: "json",
            type: "post",
            data: {
                getShiftData: 1,
                id: $(obj).attr('data-id')
            }, success: function (r) {
                $("#shift_start_date").val(r.data.start_date);
                $("#shift_start_time").val(r.data.start_time);
                $("#shift_end_time").val(r.data.total_hour);
                $("#editShiftID").val(r.data.id);
                $("#employeeID").val(r.data.user_id);
                $("#editModal").modal('show');
            }
        });

    }

    function editFormSubmit() {
        $.ajax({
            url: "<?php echo _U ?>add_shift",
            data: {
                submitDataCheckEdit: 1,
                data: $("#editForm").serialize()
            },
            success: function (r) {
                if (r == 'Pass') {
                    $.ajax({
                        url: "<?php echo _U ?>add_shift",
                        data: {
                            submitEditData: 1,
                            data: $("#editForm").serialize()
                        },
                        success: function (r) {
                            if (r == '0') {
                                alert('Shift was not edited because another shift is conflicted  ');
                            } else {
                                $("#add_shift_list_data").html(r);
                                $("#editModal").modal('hide');
                            }
                        }
                    });
                } else {
                    $(".leaveBodyEdit").html(r);  
                    $("#leaveModalEdit").modal('show');
                }
            }
        });
    }

    function editFormSubmitAllow() {
        $.ajax({
            url: "<?php echo _U ?>add_shift",
            data: {
                submitEditData: 1,
                allowDates: $('input[name="chk[]"]:checked').serialize(),
                data: $("#editForm").serialize()
            },
            success: function (r) {
                if (r == '0') {
                    alert('Shift was not edited because another shift is conflicted  ');
                } else {
                    $("#add_shift_list_data").html(r);
                    $("#editModal").modal('hide'); 
                    $("#leaveModalEdit").modal('hide'); 
                }
            }
        });
    }
    
    function leaveModalEditClose(){
       $("#editModal").modal('hide'); 
       $("#leaveModalEdit").modal('hide');  
    }
</script>