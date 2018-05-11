<script>
    function changeLocation(obj) {
        $.ajax({
            url: '<?php echo _U ?>timesheet_detail',
            data: {loadEmp: '1', id: $(obj).val()},
            success: function (r)
            {
                $("#employeeList").html(r);
            }
        });
    }
    function getDetail(id) {
        $.ajax({
            url: '<?php echo _U ?>timesheet_detail',
            data: {loadTimesheet: '1', id: id},
            success: function (r)
            {
                $("#detailSummary").hide();
                $("#employeeTimesheet").html(r);

            }
        });

    }
   
</script>