<style>
   .lbl-text-align{
        text-align: right;
    }
</style>


<div class="row " style="margin-top:0px">
    <div class="col s12 m12 l12">
        <div class="modal-header">
            <h4 class="modal-title center_bold"  style="font-weight: bold;">Language Page</h4>
        </div>
        <form action="language" method="POST">
            <div class="modal-body" >
                <div class="panel" >
                    <div class="panel-body" >
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                   <span class="right" style="color: orangered; font-weight:bold;float: right; ">
                                <!--<i class="mdi-action-search prefix"  style="float: right;"></i>-->
                                       <input name="con_search" class="form-control form-radius" placeholder="Search..." width="" type="text" onkeypress="letsSearch()">
                                <!--<a class="mdi-action-search prefix"></a>-->

                            </span>
                                </div>
                            </div>
                        </div>
                        <?php foreach ($query as $value){ ?>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="" class="col-sm-1 control-label lbl-text-align" >English</label>
                                    <div class="col-sm-5">
                                        <textarea  id="v_note_e[<?php print $value['id'] ?>]" class="form-control" name="v_note_e[<?php print $value['id'] ?>]" data-parsley-trigger="keyup" data-parsley-maxlength="255"  ><?php echo $value['lang_english']; ?></textarea>
                                    </div>
                                    <label for="" class="col-sm-1 control-label lbl-text-align" >German</label>
                                    <div class="col-sm-5">
                                        <textarea  id="v_note_p[<?php print $value['id'] ?>]" class="form-control" name="v_note_p[<?php print $value['id'] ?>]" data-parsley-trigger="keyup" data-parsley-maxlength="255"  ><?php echo $value['lang_persian']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php } ?>
                        <ul>
                        <?php
//print 10 items
                        while ($result = mysqli_fetch_array($query)) {
                            echo "<li>" . $result['text1'] . "</li>";
                        }
                        ?>
                    </ul>
                    <?php
//fetch all the data from database.
//                    $row = qs("select count(id)as Total from language");
//calculate total page number for the given table in the database 
                    $rows = $row['Total'];
                    $total = ceil($rows / $limit);
                    ?>
                    <div class="input-field col l8 m6 s12"> 
                        <ul class='pagination'>
                            <?php
                            if ($id > 1) {
                                //Go to previous page to show previous 10 items. If its in page 1 then it is inactive
                                echo "<li><a href='?id=" . ($id - 1) . "' class='left btn btn-flat'><i class='mdi-navigation-chevron-left'>«</i></a></li>";
                            }
                            ?>

                            <?php
//                            if ($total >= 1 && $id <= $total) {
                            $counter = 1;
                            $check_start = $id - ($limit / 2);
                            if ($id > $check_start && $check_start >= 1 && $id >= 1) {
                                $startrange = $id - ($limit / 2);
                            } else {
                                $startrange = 1;
                            }
//                            if ($total < ($id + ($limit / 2))) {
//                                $endrange = $id + ($limit / 2);
//                            } else {
//                                $endrange = $total;
//                            }
                            $check_tot = $total - ($limit / 2);
                            if ($id < $check_tot) {
                                $endrange = $id + ($limit / 2);
                            } else {
                                $endrange = $total;
                            }
//show all the page link with page number. When click on these numbers go to particular page. 
                            for ($i = $startrange; $i <= $endrange; $i++) {
//                                    if ($id > ($limit / 2)) {
//                                        echo "<li class='waves-effect'><a href='?id=" . $i . "'>" . $i . "</a>...</li>";
//                                    }
                                if ($i == $id) {
                                    echo "<li class='active'>" . $i . "</li>";
                                } else {
//                                    if ($counter < $limit) {
                                    echo "<li class='waves-effect'><a href='?id=" . $i . "\"'>" . $i . "</a></li>";
//                                    }
//                                        if ($id < $total - ($limit / 2)) {
//                                            
//                                        }
                                }
                                $counter++;
                                if (i == 20) {
                                    die();
                                }
                            }
//                            }
                            if ($id != $total) {
                                ////Go to previous page to show next 10 items.
                                echo "<li><a href='?id=" . ($id + 1) . "' class='right btn btn-flat'><i class='mdi-navigation-chevron-right'>»</i></a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-12">
                    
                    <button class="btn btn-primary" name="save" type="submit" onclick="CheckRecord()"><i class="mdi-action-translate"></i>Translate</button>
                    
                </div> 
            </div> 

        </form>

    </div>
    <div class="">

        <input type="hidden" name="id" value="<?php print $_REQUEST['id']; ?>">
        <input type="hidden" id="total_row" value="<?= count($query); ?>">


    </div>

    <!-- /Popout -->
    <!--</form>-->

</div>

<style>
    .modal-fixed-header-footer{
        border-radius: 6px;
    }
    .modal-fixed-header-footer .modal-header{
        height: 56px; border-bottom: 1px solid #ccc;padding: 14px;
        background-color: #58bbff;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        color:white;
    }
    .modal-fixed-header-footer .header-text{
        float: left;
    }
    .modal-fixed-header-footer .header-close{
        float: right;
    }
    .modal-fixed-header-footer .flow-text{
        height: calc(100% - 112px) !important;
    }
    .my-btn{
        margin-right: 20px !important;
    }
    .my-btn-default{
        background-color: #aaaaaa;
    }
    .my-btn-default:hover ,  .my-btn-default:active, .my-btn-default:focus{
        background-color: #999999;
    }
    .pagination li.active {
    background-color: #64B5F6;
}
.pagination li {
    display: inline-block;
    font-size: 1.2rem;
    padding: 0 10px;
    line-height: 30px;
    border-radius: 2px;
    text-align: center;
    margin-bottom: -11px;
}
</style>