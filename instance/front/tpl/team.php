

<script type="text/javascript">
    function IsMobileNumber(phone) {
        var mob = /^[09]{1}[0-9]{9}$/;
        var txtMobile = document.getElementById(phone);
        if (mob.test(phone.value) == false) {
            // alert("Please enter valid mobile number.");
            phone.focus();


        }
        return true;
    }

    function IsNumeric(txb)
    {

        txb.value = txb.value.replace(/[^\0-9]{9}/ig, "");
        if (txb.value.length > 10) {

            txb.value = txb.value.replace(/[^\0-9]{9}/ig, "");
        }
        txb.focus();
    }

    function IsPlateNo(txb)
    {
        var x = txb.value;
        if (isNaN(x) || x.indexOf(" ") !== -1)
        {
            txb.value = txb.value.replace(/[^\0-9]{1}/ig, "");
            txb.focus();
        } else if (x.length < 10 || x.length > 10)
        {
//            alert("Enter must 10 digit Melli No");
            txb.value = txb.value.replace(/[^\0-9]{9}/ig, "");
            txb.focus();
        } else {

        }
        return false;
    }
    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.email(emailAddress);
    }

</script>


<div class="panel">
    <div class="panel-body">
        <div class="panel-body">
            <div>
                <div class="col-lg-2 col-sm-12">
                    <h2 style="font-weight: bold;">Team</h2>
                </div>

                <div class="col-lg-8 col-sm-12 ">

                    <hr>
                </div>
                <div class="col-lg-2 col-sm-12">
                    <div class="dropdown float-right" style="width: 100%;">
                        <a href="#" class="btn btn-primary col-md-12" title="" data-toggle="modal" data-target="#myModal3" data-placement="left" title="New Leave" data-original-title="Add New Leave">
                            Add New Team
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <form class="form-horizontal bordered-row" role="form">
            <div class="panel">
                <div class="panel-body">
                    <div class="example-box-wrapper" id="ReloadTabel">
                        <table id="datatable-responsive" class="table table-striped responsive no-wrap" cellspacing="0" width="100%" style="margin: 0 0 0 0;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Company Name</th>
                                    <th>action</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($team as $cmp) {
                                    ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $cmp['name'] ?></td>
                                        <td><?php
//                                        d($cmp['location_id']);
                                            $locanme = q("SELECT * FROM `tb_location` where id IN('{$cmp['location_id']}')");
                                            foreach ($locanme as $name) {
                                                echo "<span style='display:bloack;'>" . $name['name'] . "</span>";
                                            }
                                            ?></td>
                                        <td>
                                            <?php
                                            $com_name = qs("select name from tb_company_works where id='{$cmp['company_id']}'");
                                            echo $com_name['name']
                                            ?>
                                        </td>
                                        <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $cmp['id']; ?>" >
                                            <span><i style="padding-top: 9px;" class="btn btn-primary fa fa-edit empEdit"  data-id="<?php echo $cmp['id']; ?>"></i></span>
                                            <span><i style="padding-top: 9px;" class="btn btn-links danger remove fa fa-trash-o empDelete"  data-id="<?php echo $cmp['id']; ?>" onclick="removeSchedule(<?php echo $cmp['id']; ?>)"></i></span>
                                        </td>

                                    </tr> 
                                    <?php
                                    $i++;
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>

                    <!--                    <div  id="Add-option" class="">
                                            <a class="btn btn-primary theme-switcher tooltip-button" href="<?php l('new_leave') ?>" data-toggle="" data-target="" data-placement="left" title="New Task" data-original-title="Add New Task">
                                                <i class="glyph-icon icon-plus-square "></i>
                                            </a>
                                        </div>-->
                </div>
            </div>
        </form>

        <!-- /Popout -->
        <!--</form>-->

    </div>
</div>


</div>
<!-- Modal Structure -->

<div class="modal fadeInUp center "  id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3">
    <div class="modal-dialog" role="document" >
        <form action="team" id="new_team" class="new_team" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">New Team</h4>
                </div>
                <div class="modal-body" >
                    <div class="panel" >
                        <div class="panel-body" >
                            <input type="hidden" name="isAddTeam" id="isAddTeam" value="1">
                            <input type="hidden" name="shiftid" id="shiftid" value="">
                            <input type="hidden" name="hidLocaid" id="hidlocationid" value="">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Team Name</label>
                                        <div class="col-sm-12">
                                            <input id="a_name" type="text" name="a_name" class="form-control form-radius"  placeholder="Team Name here" required  />
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 " >
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Team Location</label>
                                        <div class="col-sm-12">
                                            <?php
                                            $location = q("select * from  tb_location where company_id='{$_SESSION['company']['id']}'");
                                            ?>

                        <!--<select class=" form-control chosen-select"  name="selectLocations" id="selectLocations" required>-->
                                            <!--<option selected value=""></option>-->
                                            <?php foreach ($location as $empval) {
                                                ?>
                                                <div class="col-sm-4" style="margin:5px 0px; transition: ">
                                                    <div class="checkbox-info" style="height: 15px;">
                                                        <label class="checkbox-inline ">
                                                            <input id="<?= $empval['id'] ?>" value="<?= $empval['id'] ?>" type="checkbox" name="selectLocations['<?php echo $empval['id'] ?>']" class="custom-checkbox setlocation">
                                                            <span style="word-wrap: break-word;"><?php echo $empval['name'] ?></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                       <!--<option value="<?= $empval['id'] ?>"  ><?php echo $empval['name'] ?></option>-->
                                                <?php
                                            }
                                            ?>
                                            <!--</select>-->                   
                                        </div>
                                    </div>
                                </div>
                                <span id="error_location" style="color:red;"></span>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit" >Add Team</button>
                    </div> 
                </div> 


            </div>
        </form>
    </div><!-- modal-content -->
</div><!-- modal-dialog -->
<div class="modal fadeInUp center "  id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4">
    <div class="modal-dialog" role="document" >
        <form action="team" id="edit_team" class="edit_team" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Edit Team</h4>
                </div>
                <div class="modal-body" >
                    <div class="panel" >
                        <div class="panel-body" >
                            <input type="hidden" name="iseditTeam" id="iseditTeam" value="1">
                            <input type="hidden" name="shiftid" id="shiftid" value="">
                            <input type="hidden" name="teamID" id="teamID" value="">

                            <input type="hidden" name="hidLocaid" id="e_hidlocationid" value="">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Team Name</label>
                                        <div class="col-sm-12">
                                            <input id="e_name" type="text" name="e_name" class="form-control form-radius"  placeholder="Team Name here" required  />
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 " >
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Team Location</label>
                                        <div class="col-sm-12">
                                            <?php
                                            $location = q("select * from  tb_location where company_id='{$_SESSION['company']['id']}'");
                                            ?>

                        <!--<select class=" form-control chosen-select"  name="selectLocations" id="selectLocations" required>-->
                                            <!--<option selected value=""></option>-->
                                            <?php foreach ($location as $empval) {
                                                ?>
                                                <div class="col-sm-4" style="margin:5px 0px; ">
                                                    <div class="checkbox-info" style="height: 15px;">
                                                        <label class="checkbox-inline ">
                                                            <input id="<?= $empval['id'] ?>" value="<?= $empval['id'] ?>" type="checkbox" name="selectLocations['<?php echo $empval['id'] ?>']" class="custom-checkbox e_setlocation">
                                                            <span style="word-wrap: break-word;"><?php echo $empval['name'] ?></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                       <!--<option value="<?= $empval['id'] ?>"  ><?php echo $empval['name'] ?></option>-->
                                                <?php
                                            }
                                            ?>
                                            <!--</select>-->                   
                                        </div>
                                    </div>
                                </div>
                                <span id="error_location" style="color:red;"></span>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit" >Update Team</button>
                    </div> 
                </div> 


            </div>
        </form>
    </div><!-- modal-content -->
</div><!-- modal-dialog -->


<?php include _PATH . "instance/front/tpl/vehicle_plate_design.php" ?>