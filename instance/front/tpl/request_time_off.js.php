<script type="text/javascript">
    function acceptRejectModal(obj) {
        $("#singleCommnet").attr("required", false);
        if ($(obj).attr('data-value') == "Cancel") {
            $("#singleCommnet").attr("required", true);
        }
        $("#admin-manager-select").html('Manager Comment');
        $("#commentModal").modal('show');
        $("#reason").val($(obj).attr('data-value'));
        $("#requestId").val($(obj).attr('data-id'));
        $("#displayHoursViewAccept").hide();
        if ($(obj).attr('data-value') == "Accept") {
            $("#displayHoursViewAccept").show();
            $("#displayHoursViewAccept").removeClass('hidden');
            $.ajax({
                url: '<?php echo _U ?>request_time_off',
                dataType: "json",
                data: {
                    getRecordData: 1,
                    editId: $(obj).attr('data-id')
                }, success: function (r) {

                    var availableHours = r.data.available_hours;
                    var pendingHours = r.data.pending_hours;
                    var proceedHours = r.data.proceed_hours;
                    $(".accept-available-hours-display").html('');
                    $(".accept-proceed-hours-display").html('');
                    $(".accept-pending-hours-display").html('');
                    $(".accept-previousRecords-area").html('');
                    $(".accept-available-hours-display").html(availableHours);
                    $(".accept-proceed-hours-display").html(proceedHours);
                    $(".accept-pending-hours-display").html(pendingHours);
                    $(".accept-previousRecords-area").html(r.data.previousRecords);
                }
            });
        }

    }
    
    function adminDeleteModal(obj) {
        $("#singleCommnet").attr("required", false);
        if ($(obj).attr('data-value') == "Delete") {
            $("#singleCommnet").attr("required", true);
        }
        $("#admin-manager-select").html('Admin Comment');
        $("#commentModal").modal('show');
        $("#reason").val($(obj).attr('data-value'));
        $("#requestId").val($(obj).attr('data-id'));
        $("#displayHoursViewAccept").hide();
        if ($(obj).attr('data-value') == "Accept") {
            $("#displayHoursViewAccept").show();
            $("#displayHoursViewAccept").removeClass('hidden');
            $.ajax({
                url: '<?php echo _U ?>request_time_off',
                dataType: "json",
                data: {
                    getRecordData: 1,
                    editId: $(obj).attr('data-id')
                }, success: function (r) {

                    var availableHours = r.data.available_hours;
                    var pendingHours = r.data.pending_hours;
                    var proceedHours = r.data.proceed_hours;
                    $(".accept-available-hours-display").html('');
                    $(".accept-proceed-hours-display").html('');
                    $(".accept-pending-hours-display").html('');
                    $(".accept-previousRecords-area").html('');
                    $(".accept-available-hours-display").html(availableHours);
                    $(".accept-proceed-hours-display").html(proceedHours);
                    $(".accept-pending-hours-display").html(pendingHours);
                    $(".accept-previousRecords-area").html(r.data.previousRecords);
                }
            });
        }
    }

    function openEditPopup(editId) {
        $("#editRecordId").val('');
        $("#edit_start_date").val('');
        $("#edit_end_date").val('');

        $("#old_start_date").html('');
        $("#old_absent_choice").html('');
        $("#old_end_date").html('');

        $(".available-hours-display").html('00:00');
        $(".proceed-hours-display").html('00:00');
        $(".pending-hours-display").html('00:00');
        $(".previousRecords-area").html('');

        $.ajax({
            url: '<?php echo _U ?>request_time_off',
            dataType: "json",
            data: {
                getRecordData: 1,
                editId: editId
            }, success: function (r) {
                var resEditId = r.data.id;
                var fromDate = r.data.from_date;
                var toDate = r.data.to_date;
                var reasonVal = r.data.reason;
                var absenceType = r.data.absence_type;
                var managerOldComment = r.data.manager_notes;
                var availableHours = r.data.available_hours;
                var pendingHours = r.data.pending_hours;
                var proceedHours = r.data.proceed_hours;
                $("#editRecordId").val(resEditId);
                $("#edit_start_date").val(fromDate);
                $("#edit_end_date").val(toDate);
                $("#edit_absent_choice").val(reasonVal);
                $("#absence_type_val").val(absenceType);
                $("#sel_absence_type").html(absenceType);
                $("#oldCommentText").html(managerOldComment);
                $("#old_start_date").html(fromDate);
                $("#old_end_date").html(toDate);
                $("#old_absent_choice").html(reasonVal);
                $(".available-hours-display").html(availableHours);
                $(".proceed-hours-display").html(proceedHours);
                $(".pending-hours-display").html(pendingHours);
                $(".previousRecords-area").html(r.data.previousRecords);
                if (absenceType == 'hourly') {
                    $("#edit_leave_date").val(r.data.leave_date);
                    $(".HourlyInput").removeClass('hidden');
                } else {
                    $(".HourlyInput").addClass('hidden');
                }
                $("#editModal").modal("show");

            }
        });
    }

    function beforeEditSubmit() {
        if ($("#managerNewComment").val() != '') {
            var allowToSubmit = 1;
            var InfoMsg = '';
            if ($("#old_start_date").html() !== $("#edit_start_date").val()) {
                InfoMsg += 'Old Start Date: ' + $("#old_start_date").html() + '\n';
                InfoMsg += 'New Start Date: ' + $("#edit_start_date").val() + '\n\n';
                allowToSubmit = 0;
            }
            if ($("#old_end_date").html() !== $("#edit_end_date").val()) {
                InfoMsg += 'Old End Date: ' + $("#old_end_date").html() + '\n';
                InfoMsg += 'New End Date: ' + $("#edit_end_date").val() + '\n\n';
                allowToSubmit = 0;
            }


            if ($("#old_absent_choice").html() !== $("#edit_absent_choice").val()) {
                InfoMsg += 'Old Absent Type: ' + $("#old_absent_choice").html() + '\n';
                InfoMsg += 'New Absent Type: ' + $("#edit_absent_choice").val() + '\n\n';
                allowToSubmit = 0;
            }

            if (allowToSubmit == 0) {
                if (confirm("are you sure you wanna edit this from \n\n" + InfoMsg) == true) {
                    return true;
                } else {
                    return false;
                }
            } else {
                if (confirm("are you sure you wanna accept this request") == true) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    function openHistoryPopup(recordId) {
        $.ajax({
            url: '<?php echo _U ?>request_time_off',
            dataType: "text",
            data: {
                getHistoryRecord: 1,
                recordId: recordId
            }, success: function (r) {
                $("#historyListing").html(r);
            }
        });
        $("#historyModal").modal("show");
    }

    function addNewRecord() {
        $("#addModal").modal("show");
    }

    function beforeAddSubmit() {
        var allowToNext = 1;
        $(".add-required_fields").each(function () {
            if ($(this).val() == '' && allowToNext == 1) {
                allowToNext = 0;
            }
        });

        if (allowToNext == 0) {
            $("#addFormCompulsary").removeClass("hidden");
            return false;
        } else {
            $("#addFormCompulsary").addClass("hidden");
        }

        if (confirm('Dear manager, you are about to approve an absence for ' + $("#add_emp_id :selected").text() + ' for FROM ' + $("#add_start_date").val() + ' TO ' + $("#add_end_date").val() + ' are you sure you would like to proceed') == true) {
            return true;
        } else {
            return false;
        }
    }

    function inputBoxChanges(obj) {
        if ($(obj).val() == 'hourly') {
            $(".LableStartChnages").html("Start Time :");
            $(".LableEndChnages").html("End Time :");
            $(".dropdownChnages").html("(HH:mm:ss)");
            $(".HourlyInput").removeClass('hidden');
        } else {
            $(".LableStartChnages").html("Start Date :");
            $(".LableEndChnages").html("End Date :");
            $(".dropdownChnages").html("(YYYY-mm-dd)");
            $(".HourlyInput").addClass('hidden');
        }

    }

    $(document).ready(function () {
        $("#request_timeoff_form").submit(function () {
            var reason = $("#reason").val();
            var allowToSubmit = 0;
            if (reason != 'Accept' && reason != 'accept') {
                if (confirm('Dear manager, Are you sure you want to ' + reason + ' this record ?') == true) {
                    allowToSubmit = 1;
                } else {
                    allowToSubmit = 0;
                }
                if (allowToSubmit == 0) {
                    return false;
                } else {
                    return true;
                }
            }
        });

    });
</script>

