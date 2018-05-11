<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">

</script>
<script type="text/javascript">

    $(document).ready(function () {
        $("#due_date").datepicker({minDate: new Date()});
        $('#datatable-responsive0a').DataTable({
            responsive: true,
			order:[]
        });

        $('#datatable-responsive2').DataTable({
            responsive: true
        });
        $('#datatable-responsive3').DataTable({
            responsive: true
        });
        $('.dataTables_filter input').attr("placeholder", "Search...");

    });


</script>