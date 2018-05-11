<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">

    $(function () {
        $("#min").datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            onClose: function (selectedDate) {
                $("#max").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#max").datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            onClose: function (selectedDate) {
                $("#min").datepicker("option", "maxDate", selectedDate);
            }
        });
    });


</script>
<script type="text/javascript">
    $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var minB = $('#min').val().replace(/-/g, "");
                var maxB = $('#max').val().replace(/-/g, "");
                var CreatedBy = $("#createdby").val();
                var Assignto = $("#assignto").val();
                var CreatedByData = data[1];
                var AssigntoData = data[2];
//                alert(CreatedByData.search(/CreatedBy/i));
//                if (CreatedByData.search(CreatedBy) >= 1) {
//
//                    return false;
//                } else {
//                    return true;
//                }
                var curB;
                var CurrentDate;
                var B = data[3] || 0;

                curB = B.toLocaleString();
//                alert(curB.replace(/-/g, ""));

//                  alert(curB.split("-"));
                if (curB === "" || curB === "0") {
                    CurrentDate = "0";
                } else {
                    CurrentDate = curB.replace(/-/g, "");
                }
                var min = minB;
                var max = maxB;
                var age = CurrentDate; // use data for the age column
                if ((min === "" || min === null) && (max === "" || max === null)) {
                    return true;
                }
                if ((isNaN(min) && isNaN(max)) || (isNaN(min) && age <= max) ||
                        (min <= age && (max === "")) || (min <= age && age <= max))
                {
                    return true;
                }
//                if (CreatedBy === "" || (CreatedByData.search(CreatedBy) === 0)) {
//                    return true;
//                }
//                if (CreatedByData.search(CreatedBy) >= 1) {
//                    return true;
//                }

                return false;
            }
    );
    $(document).ready(function () {
        $("#due_date").datepicker({minDate: new Date()});
        $('#datatable-responsive').DataTable({
            responsive: true
        });
        var table = $('#datatable-responsive0a').DataTable({
            responsive: true
        });
        $('#min, #max').change(function () {
            table.draw();
        });
        $('#createdby').keyup(function () {
//            alert("Key Up");
            table.column(1).search($(this).val()).draw();
//            table.draw();
        });
        $('#assignto').keyup(function () {
//            alert("Key Up");
            table.column(2).search($(this).val()).draw();
//            table.draw();
        });

        $('#datatable-responsive2').DataTable({
            responsive: true
        });
        $('#datatable-responsive3').DataTable({
            responsive: true
        });
        $('.dataTables_filter input').attr("placeholder", "Search...");

    });

    $("body").on("click", ".DoneTask", function () {
        //        alert($(this).data('id'));
        callDoneTask($(this).data('id'));
    });
    function callDoneTask(id) {
        $.ajax({
            url: "<?php echo _U ?>task",
            //            datatype: "json",
            data: {
                doneTask: 1,
                id: id,
            },
            success: function (r) {
                $('#refreshTask').html(r);
<?php // if ($success === "1") {                                                                             ?>
                //                    _toast("success", "Approved", "////<?php echo $msg; ?>");
<?php // } else {                                                                             ?>
                //                _toast("warning", "Declind", "////<?php echo $msg; ?>");
<?php // }                                                                             ?>
            }

        });
    }
    $("body").on("click", ".remove", function () {
        callDelete($(this).data('id'));
    });
    function callDelete(id) {
        $.ajax({
            url: "<?php echo _U ?>task",
            //            datatype: "json",
            data: {
                deleteTask: 1,
                id: id,
            },
            success: function (r) {
                $('#refreshTask').html(r);
<?php // if ($success === "1") {                                                                             ?>
                //                    _toast("success", "Approved", "////<?php echo $msg; ?>");
<?php // } else {                                                                             ?>
                //                _toast("warning", "Declind", "////<?php echo $msg; ?>");
<?php // }                                                                             ?>
            }

        });
    }

</script>