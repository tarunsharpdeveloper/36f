<script>
    $(document).ready(function () {
<?php if ($success == "1") { ?>
            Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>
<?php if ($success == "-1") { ?>
            Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>
    });
</script>

<style>

    body{
        height: 100%;
        background: #dfe2e6;
    }
    .sidebar-nav-left{

        float: right;
        padding: 0px;
        margin: 0px;
        width: 20%;
        /*min-height: max-content ;*/
        height: 100%;
        border: #F3F5F7 2px solid; 
    }

    .sidebar-nav-right{
        float: right;
        padding: 0px;
        margin: 0px;
        width: 80%;
        min-height:  min-content;

        border: #F3F5F7 2px solid; 
        /*clear: both;*/
    }

    .main-content{
        float: left;margin: 0;padding: 0;min-height: min-content;min-width: 100%;
        /*background-color: mistyrose;*/
    }
    .background-color{
        background: #dfe2e6;
    }
    .background-color-white{
        background: white;
    }
    .on-break{
        /*    cursor: pointer;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            height: 23px;
            width: 38px;
            background-color: #e9e9e9;
            font-weight: bold;*/
        /* cursor: pointer; */cursor: pointer;
        /*border: 2px dashed transparent;*/
        border-radius: 50%;
        display: inline-block;
        position: relative;
        height: 40px;
        width: 40px;font-weight: bold;
        background-color: #e9e9e9;
        font-size: 14px;
        line-height: 35px;
    }
    .on-break-tab{
        /*        border-radius: 50%;
                height: 29px;
                width: 46px;
                background-color: #e9e9e9;
                font-weight: bold;
                font-size: 17px;
                margin-top: 4px;*/
        cursor: pointer;
        /*border: 2px dashed transparent;*/
        border-radius: 50%;
        display: inline-block;
        position: relative;
        height: 40px;
        width: 40px;font-weight: bold;
        background-color: #e9e9e9;
        font-size: 14px;
        line-height: 35px;
    }
    .filter-dropdown-menu {
        box-shadow: 0 1px 4px 1px rgba(0,0,0,0.2), 0 12px 24px rgba(0,0,0,0.24);
        border-radius: 4px;
        min-width: 0;
        margin-left: 0;
        margin-right: 0;
        max-height: 90vh;
        overflow-y: auto;
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
    }
    /*    .also-show-dropdown-menu{
            box-shadow: 0 1px 4px 1px rgba(0,0,0,0.2), 0 12px 24px rgba(0,0,0,0.24);border-radius: 4px;
            overflow-y: auto;
            overflow-x: hidden;
        }*/
    label{
        font-weight: inherit;
        margin-bottom: 12px;
    }

    .form-radius{
        border: #c1c1c1 solid 1px;
        border-radius: 5px !important;
    }
    .gray{
        color: black;
        font-weight: bold;
    }
    .lbl-text-align{
        text-align: right;
    }
    .dropdown-menu li > a:hover {
        border-top: 1px solid rgba(10, 10, 10, 0.36);
        border-bottom: 1px solid rgba(10, 10, 10, 0.36);
    }
    .dropdown-menu>li.clean-slate, .dropdown-menu>li>* {
        border-top: 1px solid transparent;
        border-bottom: 1px solid transparent;
    }
</style>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        /*border: 1px solid #dddddd;*/
        text-align: left;
        padding: 8px;
    }
    .tb-none{
        display: none;
        /*width:  10%;*/
    }
    .tb-sub{
        width: 10%;
    }
    .tb-th{
        width: 10%;
    }

</style>
<style>
    .parsley-success {
        border-color: #c1c1c1 !important;
    }
    .btn.btn-close, .btn.btn-close-small {
        border-color: #969a9e;
        float: right;
        font-size: 20px;
    }
</style>
<div style="" class="main-content">
    <div class="panel " >
        <div class="panel" style="margin-bottom: 0px;">
            <div class="panel-body">
                <div>
                    <div class="col-lg-2 col-sm-12">
                        <h2 style="font-weight: bold;">Location</h2>
                    </div>
                    <div class="col-lg-8 col-sm-12 ">
                        <hr>
                    </div>

                    <div class="col-lg-2 col-sm-12">
                        <?php if (checkAccessLevel($_SESSION['user']['access_level'], 'locations', 'add')) { ?>
                            <div class="dropdown float-right" style="width: 100%;">
                                <a href="<?php l('add_location') ?>" class="btn btn-azure col-md-12" title="" >
                                    Add Location
                                </a>
                            </div>
                        <?php } ?> 
                        <!--<button class="btn btn-azure col-md-12 " data-toggle="modal" data-target="#Add-People" type="button">Add People</button>-->
                    </div>
                </div>

            </div>
            <div class="panel-body">
                <div class="col-lg-10 col-sm-12 ">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-search"></i>
                        </div>
                        <input id="team-search-filter" class="form-control" type="text" name="team-search-filter" placeholder="Search People..." autocomplete="off" style="border-right: 0;">
                        <div class="input-group-addon">
                            <span id="lblTeamMemberCount" style="display: inline;">showing <strong>0</strong> Location</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-12">
                    <ul  class="nav nav-pills border-primary">
                        <li class="" style="display: <?= $admins ?>">
                            <a  href="#0a" data-toggle="tab" class="btn btn-link fa fa-road btn-large" ></a>
                        </li>
                        <li class="">
                            <a  href="#1a" data-toggle="tab" class="btn btn-link fa fa-image btn-large"></a>
                        </li>
                        <li class="active"><a href="#2a" data-toggle="tab" class="btn btn-link fa fa-list-alt btn-large "></a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="panel-body" style="margin: 0px;padding: 0px;" id="RefreshDiv">
                <div class="panel-body">

                    <div class="tab-content clearfix" style="text-align: left;margin: 0;padding: 0;">
                        <div class="tab-pane " id="0a">
                            <h1 class="">Today's Snapshot</h1>
                            <div class="example-box-wrapper">

                                <table id="datatable-responsive0a" class="table table-striped no-border responsive no-wrap" cellspacing="0" width="100%" style="margin: 0 0 0 0; border: none;">
                                    <thead>
                                        <tr>
                                            <th>No Schedules</th>
                                            <th>Late</th>
                                            <th>Pending Open Shifts</th>
                                            <th>Upcomming</th>
                                            <th>Working</th>
                                            <th>Timesheet Pending</th>
                                            <th>Timesheet Approved</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($locations as $located) {
                                            ?>      
                                            <tr>

                                                <td><a class="btn btn-primary" href="#"> <?= $located['name'] ?></a></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        <?php } ?>

                                    </tbody> 
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane " id="1a">
                            <div class="example-box-wrapper">

                            </div>

                        </div>
                        <div class="tab-pane active " id="2a">

                            <div class="example-box-wrapper">

                                <table id="datatable-responsive0a" class="table table-striped no-border responsive no-wrap" cellspacing="0" width="100%" style="margin: 0 0 0 0; border: none;">
                                    <thead>
                                        <tr>
                                            <th>Location Name</th>
                                            <th>Location Address</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <input type="hidden" value="" name="locAddress" id="locAddress1" class="locAddress"  autocomplete="on"  >
                                    <?php foreach ($locations as $located) {
                                        ?>      

                                        <tr id="<?php echo $located['id']; ?>">
                                            <td><?= $located['name'] ?></td>
                                            <td><a href="#" class="btn-links" style="color: #00BCA4;" title="" data-placement="center" onclick="MapBinding('<?= $located['address'] ?>')" ><?= $located['address'] ?></a></td>
                                            <td style="text-align: right;align-content: space-between;">
                                                <?php if (checkAccessLevel($_SESSION['user']['access_level'], 'locations', 'edit')) { ?>
                                                    <span><i style="padding-top: 9px;" class="btn btn-primary fa fa-edit locationEdit"  data-id="<?php echo $located['id']; ?>"></i></span>
                                                <?php } ?>

                                                <?php if (checkAccessLevel($_SESSION['user']['access_level'], 'locations', 'delete')) { ?> 
                                                    <span><i style="padding-top: 9px;" class="btn btn-links danger remove fa fa-trash-o locationDelete"  data-id="<?php echo $located['id']; ?>" ></i></span>
                                                <?php } ?>  
                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody> 
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane " id="3a"></div>
                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="modal fadeInUp center "  id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <form action="approve_timesheet" id="new_timesheet_modal_form">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel2">Location</h4>
                    </div>

                    <div class="modal-body" >
                        <div class="panel" >
                            <div class="panel-body" >
                                <div class="col-lg-12" style="min-height: 320px;text-align: center;align-content: space-between">
                                    <div id="map1" class="map"  style="min-height: 300px;min-width: 100%;">

                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>

                </div>
            </form>
        </div><!-- modal-content -->
    </div>
    
    <?php if (checkAccessLevel($_SESSION['user']['access_level'], 'locations', 'edit')) {  ?>
    <div class="modal fadeInUp center "  id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3">
        <div class="modal-dialog" role="document" style="width: 70%;">
            <form action="location" id="edit_location_form" method="POST">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel2">Edit Location</h4>
                    </div>

                    <div class="modal-body" >
                        <div class="panel" >
                            <div class="panel-body" >
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <label class="control-label col-sm-12" for="locName">Location Name:</label>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <input type="text" class="form-control" value="" name="locName" id="locName" placeholder="e.g Sydney Store, Supply Warehouse" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label class="control-label col-sm-12" for="locAddress">Location Address:</label>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <input type="text" class="form-control locAddress" value="" name="locAddress" id="locAddress" placeholder="e.g Street, City, Country" required="" onchange="codeAddress()">
                                                <input type="hidden" class="form-control" value="" name="latlang" id="latlang" placeholder="e.g Street, City, Country" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label class="control-label col-sm-12" for="locWeekStart">This Location Week Start On:</label>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <select class="form-control chosen-select" name="locWeekStart" id="locWeekStart">
                                                    <option value="Mon">Mon</option>
                                                    <option value="Tue">Tue</option>
                                                    <option value="Wed">Wed</option>
                                                    <option value="Thu">Thu</option>
                                                    <option value="Fri">Fri</option>
                                                    <option value="Sat" selected>Sat</option>
                                                    <option value="Sun">Sun</option>
                                                </select>
                                                <!--<input type="text" class="form-control" value="<?php echo $ProfileData['lname']; ?>" name="locWeekStart" id="locWeekStart" placeholder="e.g Street, City, Country" required="">-->
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" value="Asia/Tehran" name="locTimeZone" id="locTimeZone" >
                                    <div class="col-lg-6 form-group" style="">        
                                        <div class=" col-sm-12 col-lg-12 " style="">
                                            <input type="hidden" name="hidlocid" id="hidlocid" value=""/>
                                            <input type="hidden" name="isEditLoc" id="isEditLoc" value="1"/>

                                            <button class="btn btn-primary" type="submit" name="submit" id="submit" >Update</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6" style="min-height: 320px;text-align: center;align-content: space-between">
                                    <div id="map" class="map"  style="min-height: 300px;min-width: 90%;">

                                    </div>
                                </div>

                            </div>
                        </div>




                    </div>
                    <!--                    <div class="modal-footer">
                                            <div class="col-sm-12">
                                                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                                            <button class="btn btn-primary" type="button" onclick="NewSchedulesave()">Save</button>
                                            </div> 
                                        </div> -->


                </div>
            </form>
        </div><!-- modal-content -->
    </div>
    <?php } ?>
    <style>
        .modal:nth-of-type(even) {
            z-index: 1042 !important;
        }
        .modal-backdrop.in:nth-of-type(even) {
            z-index: 1041 !important;
            .setwidth{
                width: 700px;
            }
        }
    </style>


    <style>

        #Edit-People{
            float: right;
            position: fixed;
            /*left: 65%;*/
            right: 0px;

        }
    </style>