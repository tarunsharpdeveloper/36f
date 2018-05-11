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
    }

    function openEditPopup(editId) {
        $("#editRecordId").val('');

        $.ajax({
            url: '<?php echo _U ?>request_errand',
            dataType: "json",
            data: {
                getRecordData: 1,
                editId: editId
            }, success: function (r) {

                /* Start set old value for edit time confimation */
                $("#old_errand_type").html('');
                $("#old_errand_absence_type").html('');
                $("#old_subject").html('');
                $("#old_start_date").html('');
                $("#old_end_date").html('');
                $("#old_day_request").html('');
                $("#old_requested_by").html('');
                $("#old_starting_point").html('');
                $("#old_destination").html('');
                $("#old_overnight_compensation").html('');
                $("#old_food_authorization").html('');
                $("#old_transportation_method").html('');
                $("#old_lodging").html('');
                $("#old_expences").html('');
                $("#old_manager_comments").html('');


                $("#old_errand_type").html(r.data.errands_type);
                $("#old_errand_absence_type").html(r.data.absence_type);
                $("#old_subject").html(r.data.subject);
                if (r.data.absence_type == 'hourly') {
                    $("#old_start_date").html(r.data.from_date_time);
                    $("#old_end_date").html(r.data.to_date_time);
                } else {  
                    $("#old_start_date").html(r.data.entire_start_date);
                    $("#old_end_date").html(r.data.entire_end_date); 
                } 
                $("#old_day_request").html(r.data.day_request_submitted);
                $("#old_requested_by").html(r.data.requested_by);
                $("#old_starting_point").html(r.data.starting_point);
                $("#old_destination").html(r.data.destination);
                $("#old_overnight_compensation").html(r.data.overnight_compensation);
                $("#old_food_authorization").html(r.data.food_authorization);
                $("#old_transportation_method").html(r.data.transportation_method);
                $("#old_lodging").html(r.data.lodging);
                $("#old_expences").html(r.data.expences);
                $("#old_manager_comments").html(r.data.manager_comments);
                /* End set old value for edit time confimation */


                $("#editRecordId").val(r.data.id);
                $("#edit_errand_type").val(r.data.errands_type);
                $("#edit_absence_type").val(r.data.absence_type);
                $("#edit_subject").val(r.data.subject);
                $("#edit_start_date").val(r.data.from_date_time);
                $("#edit_end_date").val(r.data.to_date_time);
                $("#edit_day_request").val(r.data.day_request_submitted);
                $("#edit_request_by").val(r.data.requested_by);
                $("#edit_starting_point").val(r.data.starting_point);
                $("#edit_destination").val(r.data.destination);

                $(".editHourlyInput").addClass('hidden');
                if (r.data.absence_type == 'hourly') {
                    $(".editHourlyInput").removeClass('hidden');
                    $("#edit_leave_date").val(r.data.hourly_date);
                    $("#edit_start_date").val(r.data.hourly_start_time);
                    $("#edit_end_date").val(r.data.hourly_end_time);
                } else {
                    $("#edit_start_date").val(r.data.entire_start_date);
                    $("#edit_end_date").val(r.data.entire_end_date);
                }

                if (r.data.overnight_compensation == 'Yes' || r.data.overnight_compensation == 'yes') {
                    $("#overnight_yes").attr('checked', true);
                    $("#overnight_no").attr('checked', false);
                } else {
                    $("#overnight_yes").attr('checked', false);
                    $("#overnight_no").attr('checked', true);
                }

                if (r.data.food_authorization == 'Yes' || r.data.food_authorization == 'yes') {
                    $("#food_yes").attr('checked', true);
                    $("#food_no").attr('checked', false);
                } else {
                    $("#food_yes").attr('checked', false);
                    $("#food_no").attr('checked', true);
                }

                $("#edit_transportation").val(r.data.transportation_method);
                $("#edit_lodging").val(r.data.lodging);
                $("#edit_expences").val(r.data.expences);
                $("#manager_oldComments").html(r.data.manager_comments);
                $("#editModal").modal("show");
            }
        });
    }

    function openHistoryPopup(recordId) {
        $.ajax({
            url: '<?php echo _U ?>request_errand',
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

        var hourlyDate = '';
        if ($("#add_absence_type").val() == 'hourly') {
            hourlyDate = ' At ' + $("#add_leave_date").val();
        }

        if (confirm('Dear manager, you are about to approve an absence for ' + $("#add_emp_id :selected").text() + ' for FROM ' + $("#add_start_date").val() + ' TO ' + $("#add_end_date").val() + hourlyDate + ' are you sure you would like to proceed') == true) {
            return true;
        } else {
            return false;
        }
    }

    function beforeEditSubmit() {

        if ($("#edit_absence_type").val() == 'hourly') {
            var editStartDate = $("#edit_leave_date").val()+" "+$("#edit_start_date").val();
            var editEndDate = $("#edit_leave_date").val()+" "+$("#edit_end_date").val();    
        } else {
            var editStartDate = $("#edit_start_date").val();
            var editEndDate = $("#edit_end_date").val();
        }

        
        var allowToNext = 1;
        $(".edit-required_fields").each(function () {
            if ($(this).val() == '' && allowToNext == 1) {
                allowToNext = 0;
            }
        });

        if (allowToNext == 0) {
            $("#editFormCompulsary").removeClass("hidden");
            return false;
        } else {
            $("#editFormCompulsary").addClass("hidden");
        }

        var chkOvernight = 'no';
        if ($("#overnight_yes").is(':checked')) {
            chkOvernight = 'yes';
        }

        var chkFood = 'no';
        if ($("#food_yes").is(':checked')) {
            chkFood = 'yes';
        }

        if ($("#edit_manager_commnet").val() != '') {
            var allowToSubmit = 1;
            var InfoMsg = '';
            if ($("#old_errand_type").html() !== $("#edit_errand_type").val()) {
                InfoMsg += 'Old Errand Type: ' + $("#old_errand_type").html() + '\n';
                InfoMsg += 'New Errand Type: ' + $("#edit_errand_type").val() + '\n\n';
                allowToSubmit = 0;
            }
            
            if ($("#old_errand_absence_type").html() !== $("#edit_absence_type").val()) {
                InfoMsg += 'Old Errand Absent Type: ' + $("#old_errand_absence_type").html() + '\n';
                InfoMsg += 'New Errand Absent Type: ' + $("#edit_absence_type").val() + '\n\n';
                allowToSubmit = 0; 
            }
            
            
            if ($("#old_subject").html() !== $("#edit_subject").val()) {
                InfoMsg += 'Old Subject: ' + $("#old_subject").html() + '\n';
                InfoMsg += 'New Subject: ' + $("#edit_subject").val() + '\n\n';
                allowToSubmit = 0;
            }
            if ($("#old_start_date").html() !== editStartDate) {
                InfoMsg += 'Old Start Date: ' + $("#old_start_date").html() + '\n';
                InfoMsg += 'New Start Date: ' + editStartDate + '\n\n';
                allowToSubmit = 0;
            }
            if ($("#old_end_date").html() !== editEndDate) {
                InfoMsg += 'Old End Date: ' + $("#old_end_date").html() + '\n';
                InfoMsg += 'New End Date: ' + editEndDate + '\n\n';
                allowToSubmit = 0;  
            }
  

            if ($("#old_day_request").html() !== $("#edit_day_request").val()) {
                InfoMsg += 'Old Day Request: ' + $("#old_day_request").html() + '\n';
                InfoMsg += 'New Day Request: ' + $("#edit_day_request").val() + '\n\n';
                allowToSubmit = 0;
            }

            if ($("#old_requested_by").html() !== $("#edit_request_by").val()) {
                InfoMsg += 'Old Requested By: ' + $("#old_requested_by").html() + '\n';
                InfoMsg += 'New Requested By: ' + $("#edit_request_by").val() + '\n\n';
                allowToSubmit = 0;
            }

            if ($("#old_starting_point").html() !== $("#edit_starting_point").val()) {
                InfoMsg += 'Old Starting Point: ' + $("#old_starting_point").html() + '\n';
                InfoMsg += 'New Starting Point: ' + $("#edit_starting_point").val() + '\n\n';
                allowToSubmit = 0;
            }

            if ($("#old_destination").html() !== $("#edit_destination").val()) {
                InfoMsg += 'Old Destination: ' + $("#old_destination").html() + '\n';
                InfoMsg += 'New Destination: ' + $("#edit_destination").val() + '\n\n';
                allowToSubmit = 0;
            }

            if ($("#old_overnight_compensation").html() !== chkOvernight) {
                InfoMsg += 'Old Overnight Compensation: ' + $("#old_overnight_compensation").html() + '\n';
                InfoMsg += 'New Overnight Compensation: ' + chkOvernight + '\n\n';
                allowToSubmit = 0;
            }

            if ($("#old_food_authorization").html() !== chkFood) {
                InfoMsg += 'Old Food Authorization: ' + $("#old_food_authorization").html() + '\n';
                InfoMsg += 'New Food Authorization: ' + chkFood + '\n\n';
                allowToSubmit = 0;
            }

            if ($("#old_transportation_method").html() !== $("#edit_transportation").val()) {
                InfoMsg += 'Old Transportation Method: ' + $("#old_transportation_method").html() + '\n';
                InfoMsg += 'New Transportation Method: ' + $("#edit_transportation").val() + '\n\n';
                allowToSubmit = 0;
            }

            if ($("#old_lodging").html() !== $("#edit_lodging").val()) {
                InfoMsg += 'Old Lodging: ' + $("#old_lodging").html() + '\n';
                InfoMsg += 'New Lodging: ' + $("#edit_lodging").val() + '\n\n';
                allowToSubmit = 0;
            }

            if ($("#old_expences").html() !== $("#edit_expences").val()) {
                InfoMsg += 'Old Expences: ' + $("#old_expences").html() + '\n';
                InfoMsg += 'New Expences: ' + $("#edit_expences").val() + '\n\n';
                allowToSubmit = 0;
            }

            if ($("#old_manager_comments").html() !== $("#edit_manager_commnet").val()) {
                InfoMsg += 'Old Manager Comment: ' + $("#old_manager_comments").html() + '\n';
                InfoMsg += 'New Manager Comment: ' + $("#edit_manager_commnet").val() + '\n\n';
                allowToSubmit = 0;
            }

            if (allowToSubmit == 0) {
                if (confirm("are you sure you wanna edit this request \n\n" + InfoMsg) == true) {
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

    function inputBoxChanges(obj) {

        if ($(obj).val() == 'hourly') {

            $("#add_leave_date").addClass("add-required_fields");
            $(".LableStartChnages").html("Start Time :");
            $(".LableEndChnages").html("End Time :");
            $(".HourlyInput").removeClass('hidden');
            $("#add_start_date").attr("placeholder", "HH:mm:ss");
            $("#add_end_date").attr("placeholder", "HH:mm:ss");
        } else {
            $("#add_leave_date").removeClass("add-required_fields");
            $(".LableStartChnages").html("Start Date :");
            $(".LableEndChnages").html("End Date :");
            $(".HourlyInput").addClass('hidden');
            $("#add_start_date").attr("placeholder", "YYYY-mm-dd");
            $("#add_end_date").attr("placeholder", "YYYY-mm-dd");
        }

    }

    function inputBoxEditChanges(obj) {

        $("#edit_start_date").val('');
        $("#edit_end_date").val('');
        if ($(obj).val() == 'hourly') {

            $("#edit_leave_date").addClass("edit-required_fields");
            $(".editLableStartChnages").html("Start Time :");
            $(".editLableEndChnages").html("End Time :");
            $(".editHourlyInput").removeClass('hidden');
            $("#edit_start_date").attr("placeholder", "HH:mm:ss");
            $("#edit_end_date").attr("placeholder", "HH:mm:ss");
        } else {
            $("#edit_leave_date").removeClass("edit-required_fields");
            $(".editLableStartChnages").html("Start Date :");
            $(".editLableEndChnages").html("End Date :");
            $(".editHourlyInput").addClass('hidden');
            $("#edit_start_date").attr("placeholder", "YYYY-mm-dd");
            $("#edit_end_date").attr("placeholder", "YYYY-mm-dd");
        }


    }

    $(document).ready(function () {
        $("#request_errand_form").submit(function () {
            var reason = $("#reason").val();
            var allowToSubmit = 0;
            if (reason != 'Accept' && reason != 'accept') {
                var userType = 'manager';
                if (reason == 'Delete' || reason == 'delete') {
                    userType = 'admin';
                }
                if (confirm('Dear ' + userType + ', Are you sure you want to ' + reason + ' this record ?') == true) {
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

