<div class="card-panel">
    <!-- Stats Panels -->
    <div class="row sortable">
        <div class="col l3 m6 s12">
            <a href="#" class="card-panel stats-card amber lighten-2 amber-text text-lighten-5">
                <i class="fa fa-dollar" style="margin: 0 3px 19px 0;"></i>
                <span class="count"><?php echo number_format($total['0']['total'], 2) ?></span>
                <div class="name">Quoted Amount</div>
            </a>
        </div>
        <div class="col l3 m6 s12">
            <a href="#" class="card-panel stats-card blue lighten-2 blue-text text-lighten-5">
                <i class="fa fa-send" style="margin: 0 3px 19px 0;"></i>
                <span class="count"><?php echo count($totalquote) ?> </span>
                <div class="name">Quote</div>
            </a>
        </div>
        <div class="col l3 m6 s12">
            <a href="#" class="card-panel stats-card red lighten-2 red-text text-lighten-5">
                <i class="fa fa-users" style="margin: 0 3px 19px 0;"></i>
                <span class="count"><?php echo count($totalEmployee) ?> </span>
                <div class="name">Employee</div>
            </a>
        </div>
        <div class="col l3 m6 s12">
            <div class="card-panel stats-card green lighten-2 green-text text-lighten-5">
                <i class="fa fa-car" style="margin: 0 3px 19px 0;"></i>
                <span class="count"><?php echo count($totalFleet) ?></span>
                <div class="name">Fleet</div>
            </div>
        </div>
    </div>
    <!-- /Stats Panels -->

    <!--    <div class="row sortable">
            <div class="col l6 m6 s3 bordered  align-center">
                <div class=" image-card l6 m6 s3">
                    <div class="image"> 
                        <img style="width:30%;" src="<?php print _MEDIA_URL ?>assets/_con/images/user12.jpg" alt=""> 
                    </div> 
                </div>
                <div style="clear: both;"></div> 
                <blockquote class="red-text">
                    I’m simply raving to everyone about how accommodating, helpful and wonderful you are… especially at 5:30am.<b> Thank you for making our event easier!</b><br>
                    <small>
                        Lisa Anne Silhanek,Project Coordinator, Silhanek LLC
                    </small>
                </blockquote> </div>  
          <div class="col l6 m6 s3 bordered align-center">
                <div class=" image-card l6 m6 s3">
                    <div class="image"> 
                        <img style="width:30%;" src="<?php print _MEDIA_URL ?>assets/_con/images/user5.jpg" alt=""> 
                    </div> 
                </div>
                <div style="clear: both;"></div> 
                <blockquote class="red-text">I LOVED arriving in my Brilliant ride!! Thanks so much! My friend loved the van too, and he does loads of events.<br>
                    <small>
                        Alan Cumming, actor
                    </small>
                </blockquote>
            </div>  
        </div>
    -->


    <div class="row sortable">
        <!-- Orders Card -->
        <div class="col l4 s12">
            <div class="card">
                <div class="title">
                    <h5>Quote</h5>
                    <a class="close" href="#">
                        <i class="mdi-content-clear"></i>
                    </a>
                    <a class="minimize" href="#">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content orders-card">

                    <h4><?php echo count($totalquote) ?></h4>
                    <div class="row">
                        <div class="col s6">
                            <small>Total Trips</small>
                        </div>
                        <div class="col s6 right-align">
                            <?php
                            $count1 = count($totalquote);
                            $count2 = $total_quote['0']['numrow'];
                            $count3 = (($count1 / $count2) * 100);
                            $count = number_format($count3, 2);
                            echo $count . "%";
                            ?>
                            <i class="fa fa-level-down red-text"></i>
                        </div>
                    </div>
                    <div class="progress small">
                        <div class="determinate" style="width: <?php echo round($count, 2) . "%" ?>"></div>
                    </div>

                    <h4><?php echo "$" . number_format($total['0']['total'], 2) ?></h4>
                    <div class="row">
                        <div class="col s6">
                            <small>Total quotes amount</small>
                        </div>
                        <div class="col s6 right-align">
                            <?php
                            $sum1 = $total['0']['total'];
                            $sum2 = $totalperquote['0']['totalprice'];
                            $sum3 = (($sum1 / $sum2) * 100);
                            echo number_format($sum3, 2) . "%";
                            ?>
                            <i class="fa fa-level-up green-text"></i>
                        </div>
                    </div>
                    <div class="progress small">
                        <div class="determinate" style="width: <?php echo round(number_format($sum3, 2), 2) . "%" ?>"></div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /Orders Card -->

        <!-- ToDo Card -->
        <div class="col l4 s12">
            <div class="card">
                <div class="title">
                    <h5>Todo</h5>
                    <a class="close" href="#">
                        <i class="mdi-content-clear"></i>
                    </a>
                    <a class="minimize" href="#">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>


                <div class="content todo-card">
                    <?php
                    foreach ($totaltodo as $key => $result) {
                        $status = $result['status'];
                        ?>
                        <div class="todo-task">
                            <input type="checkbox" id="checkbox<?php echo $result['id'] ?>"  onclick="testcheckbox('<?php echo $result['id'] ?>')" <?php if ($status == 1) { ?>checked=""<?php } ?>/>
                            <label for="checkbox<?php echo $result['id'] ?>"><?php echo $result['task'] ?>
                                <span class="todo-remove mdi-action-delete" onclick="deletetodo('<?php echo $result['id'] ?>')"></span>
                            </label>
                        </div>
                    <?php } ?>

                    <div class="input-field">
                        <input id="todo-add" class="add_new" type="text">
                        <label for="todo-add">Add New</label>
                    </div>
                </div>

            </div>
        </div>
        <!-- /ToDo Card -->
        <?php
        //$quote_data = q("SELECT * FROM quote WHERE tenant_id='{$_SESSION['user']['id']}' AND quote_status = 'PENDING_APPROVE'");
        ?>
        <?php //$obj = new calculatePrice1(); ?>
        <!-- Mail Card -->
        <div class="col l4 s12">
            <div class="card">
                <div class="title">
                    <h5>Approval Requests</h5>
                    <a class="close" href="#">
                        <i class="mdi-content-clear"></i>
                    </a>
                    <a class="minimize" href="#">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content mail-card" style="height:300px;overflow:auto;">
                    <?php $i = 1; ?>
                    <?php if (1 == 1) : ?>
                        <div class="row">
                            <div class="col s9">

                                <a href="#">
                                    DEMO DRIVER<br>driver@driver.com
                                </a>
                            </div>
                            <a class="col s3 right-align orange-text accent-3 cursor modal-trigger" href="#modal1" id="view<?php echo $value['id'] ?>" onclick="showData('<?php echo $value['id'] ?>')">
                                VIEW
                            </a>
                        </div>
                        <hr>
                    <?php else: ?>
                        <div class="row">
                            <div class="col s9">No new approval in queue</div>
                            <a class="col s3 right-align orange-text accent-3 cursor modal-trigger" >&nbsp;</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- /Mail Card -->
    </div>
</div>

<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer">
    <div class="flow-text fixframe">
        <h3 style="color:#2f9cf4;font-size: 26px;"><b>Approval: Quote Preview</b></h3>
        <div class="content mail-card" style="border-top:1px solid #DADADA">
            <div id="detail" class="">
                <input type="hidden" id="hiddenId" value=""/>
                <iframe id="filecontent" src="" style="height:350px;" frameborder="0" scrolling="yes"></iframe>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" onclick="UpdateStatus()" class="modal-action modal-close waves-effect btn-flat tooltipped blue-text" data-position="top" data-delay="50" data-tooltip="Click To Approve">
                <i class='fa fa-check'>&nbsp;</i> Approve
            </a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green red-text btn-flat tooltipped" data-position="top" data-delay="50" data-tooltip="Click To Exit"> Close</a>
        </div>
    </div>
</div>
<style>
    .fixframe {
        position: fixed;
        top: 15px;
        left: 25px;
        right: 25px;
        bottom: 0px;

    } 
    .fixframe iframe {
        height: 100%;
        width: 100%;  
    } 
</style>
