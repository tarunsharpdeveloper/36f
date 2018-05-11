<div class="col-lg-3 col-md-3 col-sm-12">
    <div class="panel" style="margin: 0px;padding: 0px">
        <div class="panel-body">

            <div class="col-lg-12 col-sm-12">
                <h3 style="font-weight: bold;color: #00c6ff">Select Location  </h3>
                <select class="form-control" onchange="changeLocation(this)" >
                    <option>Select Location </option>
                    <?php foreach ($location as $value) {
                        ?>
                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-lg-12 col-sm-12" id="employeeList" style="margin-top: 5%;">

            </div>
        </div>
    </div> 
</div>
<div class="col-lg-9 col-md-9 col-sm-12">
    <div class="panel" style="margin: 0px;padding: 0px">
        <div class="panel-body">
            <div class="col-lg-12 col-sm-12 table-responsive">
                <table class="table table-bordered table-condensed">
                    <tr>
                        <th>
                            Date
                        </th>
                        <th>
                            Location
                        </th>
                        <th>
                            Time
                        </th>
                        <th>
                        </th>
                    </tr>
                    <tbody id="employeeTimesheet">

                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</div>