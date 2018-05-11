<script>
    function submitData() {
        $.ajax({
            url: "<?php echo _U ?>test_add_shift",
            data: {
                submitData: 1,
                data: $("#form_test_add_shift").serialize()
            },
            success: function(r) {
//                console.log(r);
                $("#add_shift_list_data").html(r);
                console.log($(".table").html());
            }
        });
    }
</script>