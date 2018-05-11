<div class="panel">
    <div class="panel-body">
        <div class="panel-body">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <form id="leaveEntry">
                    <div class="panel">
                        <table class="responsive"  cellspacing="5" cellpadding="5" border="0">
                            <tbody><tr>
                                    <td style="padding: 10px;">Select Date</td>
                                    <td style="padding: 10px;">
                                        <input type="date" class="form-control" name="englishDate" id="englishDate" onchange="handler(event);"/>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="">
                            <table class="responsive"  cellspacing="5" cellpadding="5" border="0">
                                <tbody><tr>
                                        <td style="width: 100px; padding: 10px;">Shamsi day</td>
                                        <td style="width: 120px; padding: 10px;">Shamsi Month</td>
                                        <td style="width: 100px; padding: 10px;">Shamsi Year</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100px; padding: 10px;">
                                            <select id="pdate" name="pdate" class="form-control">
                                                <?php
                                                for ($i = 1; $i <= 31; $i++) {
                                                    echo "<option value='$i' >$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td style="width: 100px; padding: 10px;">
                                            <select id="pmonth" name="pmonth" class="form-control" style="width: 100px;">
                                                <?php
                                                for ($i = 1; $i <= 12; $i++) {
                                                    echo "<option value='$i' >$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td style="width: 150px; padding:0px 10px;">
                                            <select id="pyear" name="pyear" class="form-control">
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
                                                    <?= $gego_date[0] . "-" . $gego_date[1] . "-" . $gego_date[2] ?>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="panel">
                        <div class="responsive">
                            <table class="table table-condensed"  cellspacing="5" cellpadding="5" border="0">
                                <tbody>
                                    <tr>
                                        <td style="padding: 10px;">Reason</td>
                                        <td style="padding: 10px;">
                                            <textarea class="form-control" name="englishReason" id="englishReason"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;">Farsi Reason</td>
                                        <td style="padding: 10px;">
                                            <textarea class="form-control" name="farsiReason" id="farsiReason"></textarea>
                                        </td> 
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="responsive">
                        <table class="table table-condensed"  cellspacing="5" cellpadding="5" border="0">
                            <tbody>
                                <tr>
                                    <td style="padding: 10px;">
                                        <select class="form-control" name="level" id="level">
                                            <option value="36F level">36F level</option>
                                            <option value="Org Level">Org Level</option>
                                        </select>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="btn btn-success EditSaveChanges" onclick="formSubmit()">
                        Save The Leave Detail
                    </div> 
                    <input type="hidden" id="editLeave" name="editLeave" value="0">
                </form>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 table-responsive"  id="leaveDetail">
                <?php include _PATH . 'instance/front/tpl/calendar_deatil.php'; ?>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .yellow{
        background-color: #FCFFCC;
    }
</style>