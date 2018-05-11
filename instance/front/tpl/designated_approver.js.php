<script type="text/javascript">
    $(document).ready(function () {

    });
    function questionApproval(id, flag) {
        if (flag === 1) {
            $('#employee_designated_' + id).val(id);

        }
        $('#ques' + id).addClass('hidden');
        $('#employee_designated_' + id).removeClass('hidden');
    }
</script>