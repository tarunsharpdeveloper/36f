
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
    function CheckConfirmPsw1() {
        var psw = document.getElementById('psw').value;
        var cnf_psw = document.getElementById('cnf_psw').value;
        if (!psw == cnf_psw)
        {
            document.getElementById('cnf_psw').value = "";
            document.getElementById('cnf_psw').focus();
        }

    }

</script>
<div class="row " style="margin-top:0px">
    <div class="col s12 m12 l12">
        <form data-parsley-validate action="change_password" method="post" id='change_password_form' >
            <!-- Popout -->

            <div class="card" >
                <div class="title">
                    <!--<div class="row">-->
                        <!--<i class="fa fa-cab prefix small"></i>&nbsp;-->
                    <span style="font-weight:bold;font-size:16px; "><?php print _t('238', 'Change Password') ?></span> 
                    <!--<span class="right" style="color: orangered; font-weight:bold;font-size:16px;margin-right: 10%; "><?php print _t('', '') ?>Reset</span>-->
                    <!--</div>-->
                </div>
                <div class="content">
                    <div class="row ">

                        <!--                        <div class="col l6 m6 s12">
                                                    <label for="fName" style="font-weight: bold; font-size: 12px; color: black;">First Name :</label> <br>
                                                    <label id="fName" style="color: black; font-size: 13px;"><?= $_SESSION['user']['fname']; ?></label>                                            
                                                </div>
                                                <div class="col l6 m6 s12">
                                                    <label for="lName" style="font-weight: bold; font-size: 12px; color: black;">First Name :</label> <br>
                                                    <label id="lName" style="color: black; font-size: 13px;"><?= $_SESSION['user']['lname']; ?></label>                                            
                                                </div>-->
                        <!--                        <div class="col l6 m6 s12">
                                                    <label for="fName" style="font-weight: bold; font-size: 12px; color: black;">ID :</label> <br>
                                                    <label id="fName" style="color: black; font-size: 13px;"><?= $_SESSION['user']['id']; ?></label>                                            
                                                </div>-->

                        <div class="input-field col l6 m6 s12">
                            <!--<i class="fa fa-credit-card prefix"></i>-->
                            <span for="psw" class="help-span"><?php print _t('189', 'Password') ?></span>
                            <input data-tooltip='Password ' id="psw"    name="psw"  type="password" minlength="6" class="validate tooltipped" maxlength="12" value=""  required>
                            
                        </div>
                        <div class="input-field col l6 m6 s12"></div>
                        <div style="clear: both"></div>
                        <div class="input-field col l6 m6 s12">
                            <!--<i class="fa fa-credit-card prefix"></i>-->
                            <span for="cnf_psw" class="help-span"><?php print _t('331', 'Confirm Password') ?></span>
                            <input data-tooltip='Confirm Password ' id="cnf_psw"    name="cnf_psw"  type="password"   class="validate tooltipped" maxlength="12" value="" required minlength="6" maxlength="12" >
                        </div>
                        <div class="input-field col l6 m6 s12"></div>    
                        <div style="clear: both"></div>



                        <!--  <div data-tooltip='Click to select vehicles'  class="right btn btn-default tooltipped" type="submit" onclick="$('#_header_0').click()">Next</div> -->
                        <!--                    <button type="submit" name="submit" class="right waves-effect waves-light btn-large z-depth-0 z-depth-1-hover">Save</button>-->
                        <button data-tooltip='Click to Change Password'  class="left waves-effect waves-light btn-large z-depth-0 z-depth-1-hover tooltipped" name="save" type="submit" ><?php print _t('238', 'Change Password') ?></button>
                        <div style="clear: both"></div>
                    </div> 
                </div>
            </div>
    </div>
    <div class="">

        <input type="hidden" name="id" value="<?php print $_REQUEST['id']; ?>">


    </div>

    <!-- /Popout -->
</form>
</div>
<!-- Modal Structure -->
<!--Modal 1 -->
<div id="rejected_message" class="modal modal-fixed-footer modal-fixed-header-footer">
    <div class="modal-header red" >
        <div class="header-text">
            <h3 style="color:white;" ><b ><i class="fa fa-exclamation-triangle prefix small"></i>&nbsp;<span style="font-weight:bold;font-size:16px;" ><?php print _t('191', 'Car Rejected') ?></span></b></h3>
        </div>
        <div class="header-close modal-action modal-close">
            <i class="fa fa-times"></i>
        </div>
    </div>
    <div class="modal-content flow-text  fixframe">
        <!--<div class="card-panel">-->

        <div id="filecontent" src="" style="height:auto;" frameborder="0">

            <div class="card-panel" id="card_basic" style="padding-top: 0;" >                                
                <div class="row">
                    <div class="input-field col l12 m12 s12" style='font-size: 14px; color: red;padding-bottom: 0;'>
                        <?php print _t('192', 'The vehicle has failed the criteria.') ?>
                    </div>
                    <div id="rejected_reason" style="line-height: 1.2;margin-bottom: 15px;">

                    </div>
                    <div style="clear: both;"></div>
                </div>
                <div class="row">

                    <div class="input-field col l12 m6 s12">                             
                        <textarea id="txt_note" class="materialize-textarea" name="v_note1" data-parsley-trigger="keyup" style="height:100px; margin-bottom: 0px;"  data-parsley-maxlength="255"  ></textarea>
                        <label  for="v_note1"><?php print _t('83', 'Vehicle Note 1( 255 max):') ?>:</label>
                        <span style="font-size: 12px;"><?php print _t('182', 'Please add notes to save for future reference') ?></span>
                    </div>
                </div>
            </div>                


        </div>

        <!--</div>-->
    </div>
    <div class="modal-footer ">
        <div style="clear: both;"></div>
        <button data-tooltip='Click to Close' name="close"  class="right grey modal-close  waves-effect waves-light btn btn-default z-depth-0 z-depth-1-hover tooltipped" type="button" style="margin-left: 2px;"><?php print _t('179', 'Close') ?></button>
        <button data-tooltip='Click to Save' name="save"  class="right red waves-effect waves-light btn btn-default z-depth-0 z-depth-1-hover tooltipped" type="button" onclick="submit_note()" style="margin-left: 2px;"><?php print _t('18', 'Save') ?></button>

    </div>

</div>
<div id="modal_alert" class="modal modal-fixed-footer modal-fixed-header-footer" >
    <div class="modal-header orange" >
        <div class="header-text">
            <h3 style="color:white;" ><b ><i class="fa fa-exclamation-triangle prefix small"></i>&nbsp;<span style="font-weight:bold;font-size:16px;" >Duplicate Record</span></b></h3>
        </div>
        <div class="header-close modal-action modal-close" onclick="goFocus()">
            <i class="fa fa-times"></i>
        </div>
    </div>
    <div class="modal-content flow-text  fixframe">
        <!--<div id="filecontent" src="" style="height:auto;" frameborder="0">-->
        <!--<form action="change_password" method="post">-->
        <div class="alert orange lighten-4 orange-text text-darken-2 card" id="warning_msg" >
            <div class="title">  <h5>Warning!</h5></div>
            <div class="content">
                <span id="duplicate_msg" style="font-size: 12px;"></span>

            </div>
            <!--<br/>-->

        </div>
        <div class="card" id="success_msg" >
            <div class="title">
                <h5 style="text-transform: capitalize;">Log of last inspections/visits</h5>
            </div>
            <div class="content">
                <span id="duplicate_log" style="font-size: 14px;">

                </span>
                <table id="table2" class="display table table-bordered table-striped table-hover " >
                    <thead style="font-size: 10px;">
                        <tr>
                            <th style="min-width: 5%;">No</th>
                            <th style="min-width: 20%;">Name</th>
                            <th style="min-width: 15%;">Cell Number <br>Melli Number </th>
                            <!--<th style="min-width: 10%;"></th>-->
                            <th style="min-width: 18%;">Vehicle Plate</th>
                            <th style="min-width: 18%;">Current Stage</th>
                            <th style="min-width: 10%;">Added By</th>
                            <th style="min-width: 20%;">Visited Date</th>
                        </tr>

                    </thead>
                    <tbody style="font-size: 12px;">

                        <?php
                        $query = q("SELECT * FROM `tb_driver`where phone='$ph' OR melli_no='$melli' OR license_plate='$veh_lic' ");
                        $i = 1;
                        $fs_mod = "";

                        foreach ($query as $row) {
                            ?>
                            <tr>
                                <td style="min-width: 5%;"><?php echo $i; ?></td> 
                                <td style="min-width: 15%;text-transform: uppercase;"><?php echo $row['fname'] . ' ' . $row['lname']; ?></td> 
                                <td style="min-width: 15%; "  >
                                    <?php
                                    if ($ph == $row['phone']) {
                                        $fs_mod = "p";
                                        ?>
                                        <span style="background-color: #ffcdd2; font-weight: bold  ;">
                                        <?php } else { ?>
                                            <span> 
                                            <?php } ?>
                                            C:<?php echo $row['phone']; ?></span>
                                        <br>
                                        <?php
                                        if ($melli == $row['melli_no']) {
                                            $fs_mod .= "m";
                                            ?>
                                            <span style="background-color: #ffcdd2; font-weight: bold  ;">
                                            <?php } else { ?>
                                                <span> 
                                                <?php } ?>
                                                M:<?php echo $row['melli_no']; ?></span>
                                            </td> 
                                    <!--<td style="min-width: 15%;"></td>--> 
                                            <td style="min-width: 15%;">
                                                <?php
                                                if ($veh_lic == $row['license_plate']) {
                                                    $fs_mod .= "l";
                                                    ?>
                                                    <span style="background-color: #ffcdd2; font-weight: bold  ;">
                                                    <?php } else { ?>
                                                        <span> 
                                                        <?php } ?>
                                                        <?php echo $row['license_plate']; ?></span>
                                            </td> 
                                            <td style="min-width: 15%;"><?php echo $row['stage']; ?></td> 
                                            <?php
                                            $sub_query = q("SELECT * FROM `tb_station_touch_log` where driver_id='{$row[id]}' ORDER BY `id`  DESC limit 1");
                                            foreach ($sub_query as $val) {
                                                ?>
                                                <td style="min-width: 15%;"><?php echo $val['uname']; ?></td> 
                                                <td style="min-width: 15%;"><?php echo $val['touch_date']; ?></td> 
                                            <?php } ?>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>


                                        </tbody>
                                        </table>
                                        <!--</form>-->
                                        </div>
                                        </div>

                                        </div>
                                        <div class="modal-footer ">
                                            <div style="clear: both;"></div>
                                            <a class="modal-action modal-close waves-effect waves-light btn btn-default z-depth-0 z-depth-1-hover tooltipped orange "  onclick="goFocus()">Close</a>
                                            <!--<a class="btn waves-effect modal-close cyan z-depth-0" href="">Okay</a>-->
                                            <!--<a class="btn waves-effect modal-close white cyan-text text-darken-2 z-depth-0" href="">Cancel</a>-->

                                        </div>
                                        </div>
                                        <style>
                                            .radio_list_single{
                                                margin-top: 5px;
                                            }
                                            input[data-parsley-id].parsley-error,
                                            textarea[data-parsley-id].parsley-error {
                                                border-bottom: 1px solid #a5d6a7;
                                                box-shadow: 0 1px 0 0 #a5d6a7 ; }
                                        </style>