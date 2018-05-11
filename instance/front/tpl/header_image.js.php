<script type="text/javascript">
    $(document).ready(function () {
        $('#table1').DataTable({
            "bLengthChange": false,
            "iDisplayLength": 5,
            "filter": false
        });
    });

    function Delete_Data(obj) {
        $.ajax({
            url: "<?php echo _U ?>header_image",
            data: {Delete_data: 1, id: $(obj).attr('id')},
            success: function () {
                window.location.href = "<?php echo _U ?>header_image";
            }
        });
    }

</script>