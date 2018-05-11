<div class="panel">
    <div class="panel-body">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 bhoechie-tab-container">
            <form name="first_section" id="first_section" >
                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" style="font-weight: bolder;">Select Company</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <?php
                            $allCompany = q("select * from tb_company_works");
                            ?>
                            <select class="form-control mySelect" id="ser_company" name="ser_company">
                                <option selected disabled>Choose Company</option>
                                <?php foreach ($allCompany as $company) { ?>
                                    <option value="<?= $company['id'] ?>" ><?= $company['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" style="font-weight: bolder;">Select Location</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <select class="form-control mySelect locationTeam" id="ser_location" name="ser_location">
                                <option selected disabled>Choose Location</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" style="font-weight: bolder;">Select Team</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <select class="form-control mySelect locationTeam" id="ser_team" name="ser_team">
                                <option selected disabled>Choose Team</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" style="font-weight: bolder;">Select Employee</label>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <select class="form-control mySelect" id="ser_employee" name="ser_employee">
                                <option selected disabled>Choose Employee</option>
                            </select>
                        </div>
                    </div>
                </div> 

                <div style="margin: 1rem;">
                    <span style="font-weight: bolder;">Absence Type: 
                        <label  onclick="divManage()"><input type="radio" name="absentType" value="entireDay" checked>Entire Day</label>
                        <label  onclick="divManage()"><input type="radio" name="absentType" value="hourly">Hourly</label>
                    </span>
                </div> 

                <div id="entireDay" class="">
                    <div style="margin: 1rem;">
                        <span style="font-weight: bolder;">Entire Day:</span>
                    </div> 
                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <label class="control-label col-sm-12 col-lg-12" >From Date</label>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input type="text" class="form-control" name="fromDate" placeholder="<?php print date("Y-m-d H:is") ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <label class="control-label col-sm-12 col-lg-12" >To Date</label>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input type="text" class="form-control" name="toDate" placeholder="<?php print date("Y-m-d H:is") ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="hourly" class="hidden">
                    <div style="margin: 1rem;">
                        <span style="font-weight: bolder;"> Hourly:</span>
                    </div> 
                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <label class="control-label col-sm-12 col-lg-12" >From Date/Time</label>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input type="text" class="form-control" name="fromDateTime">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="input-group">
                            <label class="control-label col-sm-12 col-lg-12" >To Date/Time</label>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input type="text" class="form-control" name="toDateTime">
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="form-group">
                    <div class="input-group">
                        <label class="control-label col-sm-12 col-lg-12" >Absence Reason Dropdown:</label>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <select class="form-control" name="reason">
                                <option>Illness (Extended)</option>
                                <option>Time Off (Without Payment)</option>
                                <option>Sick Time</option>
                                <option>Day Off (With Payment)</option>
                                <option>Job Abandonment</option>
                                <option>Bonus Time Off</option>
                                <option>Death in Family</option>
                                <option>Wedding</option> 
                                <option>Pregnancy Leave</option>
                                <option>Newborn Allowances</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                    <div class="input-group btn btn-primary saveData" onclick="saveData()">
                        Save 
                    </div>
                    <div class="input-group btn btn-warning waitData" style="display: none;">
                        Please Wait
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 bhoechie-tab-container">

            <div>
                <label class="control-label" >Employee's Absence List</label>
            </div>
            <div id="absence_list"> 
                <?php include _PATH . 'instance/front/tpl/test_timeoff_data.php'; ?>
            </div>
        </div>
    </div>
</div>