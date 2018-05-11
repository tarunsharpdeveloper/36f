



<div class="panel">
    <div class="panel-body">
        <div class="panel" style="margin:  0px 20%;">
            <div class="panel-body">
                <div class="col-lg-12">
                    <?php
                    // echo _URL; $GLOBALS
                    if (empty($ProfileData['photo'])) {
                        $image = 'user.jpg';
                    } else {
                        $image = $ProfileData['photo'];
                    }
                    ?>
                    <div class="col-lg-2" style="text-align: right; ">
                        <img id="imgTeamProfilePhoto" class=" imgProfilePhoto m-team-photo--large" src="docs/<?php echo $image; ?>" alt="Set Photo" style="cursor: pointer;border: 2px dashed transparent;
                             border-radius: 50%;
                             border: 3px #ddd double;
                             display: inline-block;
                             position: relative;height: 100px;width: 100px;" ></div>
                    <div class="col-lg-10">
                        <h1 style=""><?= $ProfileData['fname'] . ' ' . $ProfileData['lname'] ?></h1>
                        <h5 style=""><?= $ProfileData['email'] ?></h5>
                        <h5 style=""><?= $ProfileData['mobile'] ?></h5>
                    </div>

                    <div class="col-lg-2" style="float: right;"><a class="btn btn-primary " href="<?php l('myaccount') ?>"> Edit Profile</a></div>
                </div>
            </div>

        </div>
        <div style="margin:  0px 20%;padding: 1.8rem;">
            <h2 style="float: left;"><b>Business</b></h2>
            <a class="btn btn-default" style="float: right;"><i class="glyphicon glyphicon-briefcase"></i>Add New Business</a>
        </div>
        <div class="panel" style="margin:  30px 20%;">
            <div class="panel-body" style="margin: 0px;padding: 0px;">
                <div style="background: #FAFAFA;padding: 1rem">
                    <h3 style="font-weight: bold;color: #00CEB4; float: left;"><?= $_SESSION['company']['name'] ?></h3>
                    <a class="btn btn-default" style="float: right;"><i class="fa fa-wrench"></i>Settings</a>

                    <h6 style="clear: both;text-transform: capitalize;"><?= $ProfileData['access_level'] ?></h6>
                </div>
                <div class="col-lg-12">
                    <span><?php
                        $emps = qs("select count(id)as tot from tb_employee where work_at='{$_SESSION['company']['id']}'");
                        $emp = q("select *  from tb_employee where work_at='{$_SESSION['company']['id']}' ORDER BY tb_employee.fname ASC");
                        echo $emps['tot'];
                        ?></span><br/>
                    <span>People</span>
                    <br/>
                    <?php
                    foreach ($emp as $value) {
//                        echo $value['fname'] . ' ' . $value['lname'];
                        ?>

                        <div class="tooltip-button" style="min-height: 18px;min-width: 18px;padding: 5px;color: black;background-color: #d8d6d6;border-radius: 50%;display: inline-block;font-size: 14px;"><span style="font-size: 14px;color: black;" title="<?= $value['fname'] . ' ' . $value['lname']; ?>" data-original-title="<?= $value['fname'] . ' ' . $value['lname']; ?>"><?php echo substr(ucfirst($value['fname']), 0, 1) . '' . substr(ucfirst($value['lname']), 0, 1) ?></span></div>
                        <?php
                    }
                    ?>
                    <div class="" style="float: right;margin: 1rem;"><a class="btn btn-primary" href="#">view</a></div>
                    <div  style="clear: both"></div>
                </div>

            </div>

        </div>


        <!--        <div class="panel " style="margin: 0px 10%;">
                    <div class="panel-body">
                        <form action="post_comment" method="post">
                            <div class="example-box-wrapper">
                                <a href="edit_profile">
                                    <div class="row" style="background-color: rgba(74, 73, 82, 0.75);">
        <?php
// echo _URL; $GLOBALS
        if (empty($ProfileData['photo'])) {
            $image = 'user.jpg';
        } else {
            $image = $ProfileData['photo'];
        }
        ?>
                                        <div class="col-lg-2"><img id="imgTeamProfilePhoto" class="imgProfilePhoto m-team-photo--large" src="docs/profile_images/<?php echo $image; ?>" alt="Set Photo" style="cursor: pointer;border: 2px dashed transparent;
                                                                   border-radius: 50%;
                                                                   display: inline-block;
                                                                   position: relative;height: 60px;width: 60px"></div>
                                        <div class="col-xs-12 col-md-12 col-lg-10" style="padding: 1rem;">
                                            <h2><b style="color: white;"><?php echo $ProfileData['fname'] . ' ' . $ProfileData['lname'] ?></b> <span><b style="color: white; font-size: 16px;">[ <?php echo $ProfileData['access_level'] ?> ]</b></span></h2>
        
                                            <div style="color: white;"><?php echo $ProfileData['email'] ?><div style="float:right"><i class="glyphicon glyphicon-chevron-down"></i></div></div>
                                        </div>
                                    </div>
                                                        <div class="row">
                                                            <div  class="col-xs-12 col-md-12">
                                                              awesrdtfy
                                                            </div>
                                                        </div>
        
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12" style="margin-top: 18px; color: #444;">
                                            Organization
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12" style="background-color: rgba(128, 128, 128, 0.23);color: black;">
                                            <i class="glyphicon glyphicon-calendar"></i> <span style="margin-left: 25px;">Whozoor</span>
                                        </div>
                                    </div>
                                    <div style="height: 2px;border-bottom: 1px solid;margin-bottom: 8px;background-color: #e9e9e9;color: black;margin-top: 5px;"></div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12" style="margin-top: 2px; color: #444;">
                                            Options
                                        </div>
                                    </div>
                                </a>
                                <a href="<?php echo _U ?>?logout=1">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12" style="background-color: rgba(128, 128, 128, 0.23);color: black;">
                                        <i class="glyphicon glyphicon-log-out"></i> <span style="margin-left: 25px;">Logout</span>
                                    </div>
                                </div>
        </a>
                            </div>
                        </form>
                    </div>
                </div>-->




    </div><!-- modal-content -->
</div><!-- modal-dialog -->

