<div class="panel">
    <div class="panel-body">
        <div>
            <div class="col-lg-12 col-sm-12">
                <h2 style="font-weight: bold;">Google Maps City and State only</h2>
            </div>
        </div>

        <div> State: <input type="text" id="test_state" class="form-control" style="width:500px" /> </div>
        <div> city: <input type="text" id="test_city" class="form-control"  style="width:500px"/> </div>
    </div>


    <div class="panel-body">
        <div class="panel-body">
            <div>
                <div class="col-lg-12 col-sm-12">
                    <h2 style="font-weight: bold;">Convert Persian Date to Gregorian</h2>
                </div>
            </div>

        </div>


        <div class="panel">
            <table class="responsive"  cellspacing="5" cellpadding="5" border="0">
                <tbody><tr>
                        <td style="width: 100px; padding: 10px;"> Shamsi day</td>
                        <td style="width: 120px; padding: 10px;">Shamsi Month</td>
                        <td style="width: 100px; padding: 10px;">Shamsi Year</td>
                    </tr>
                    <tr>
                        <td style="width: 100px; padding: 10px;">
                            <select id="pdate" class="form-control">
                                <?php
                                for ($i = 1; $i <= 31; $i++) {
                                    echo "<option value='$i' >$i</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td style="width: 100px; padding: 10px;">
                            <select id="pmonth" class="form-control" style="width: 100px;">
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    echo "<option value='$i' >$i</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td style="width: 150px; padding:0px 10px;">
                            <select id="pyear" class="form-control">
                                <?php
                                for ($i = 1375; $i <= 1425; $i++) {
                                    echo "<option value='$i' >$i</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style=" padding:10px;">
                            <div style="font-size: 17px;">
                                Gregorian Date: <span style="font-weight: bold;" id="span_gregorian">
                                    <?= $gego_date[0] . "/" . $gego_date[1] . "/" . $gego_date[2] ?>
                                </span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#pdate").val("<?= $jala_date[2]; ?>");
    $("#pmonth").val("<?= $jala_date[1]; ?>");
    $("#pyear").val("<?= $jala_date[0]; ?>");

    $("#pdate, #pmonth, #pyear").change(function () {
        $.ajax({
            url: "<?php echo _U ?>test_date",
            data: {date_convert: 1, pdate: $("#pdate").val(), pmonth: $("#pmonth").val(), pyear: $("#pyear").val()},
            method: "post",
            success: function (r) {
                $("#span_gregorian").html(r);
            }
        });
    });
</script>
