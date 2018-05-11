<script>

<?php if ($success == "1") { ?>
        _toast("success", "success", "<?= $msg ?>");
        //        Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>
<?php if ($success == "0") { ?>
        _toast("danger", "Try Again", "<?= $msg ?>");
        //        Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>


</script>
<?php
$PostID = $_SESSION['user']['id'];
//d($btnclick);
//if (isset($PostID)) {
if ($btnclick == 1) {

//********************************For ALL Effected POST**********
    $PostResultComment = q("select te.fname,te.lname,te.email,tp.* from tb_post tp, tb_employee te  where tp.create_post_id=te.id and tp.work_at = '{$_SESSION['company']['id']}'");
}
if ($btnclick == 2) {

//********************************For Specific Your received POST**********
    $PostResultComment = q("select te.fname,te.lname,te.email,tp.* from tb_post tp, tb_employee te  where tp.create_post_id=te.id and tp.work_at = '{$_SESSION['company']['id']}' AND tp.share_id in ('$PostID','*')");
}
if ($btnclick == 3) {
//********************************For Specific Your POST**********
    $PostResultComment = q("select te.fname,te.lname,te.email,tp.* from tb_post tp, tb_employee te  where tp.create_post_id=te.id AND tp.create_post_id='$PostID' and tp.work_at = '{$_SESSION['company']['id']}'");
}
// $PostResultComment = q("select te.fname,te.lname,te.email,tp.* from tb_post tp, tb_employee te  where tp.create_post_id=te.id ");
////    d($PostResultComment);
//    die;
//    d($PostResultSubComment);
//    die;
//}
$strTimeAgo = "";
if (!empty($_POST["date-field"])) {
    $strTimeAgo = timeago($_POST["date-field"]);
}

function timeago($date) {
    $timestamp = strtotime($date);

    $strTime = array("second", "minute", "hour", "day", "month", "year");
    $length = array("60", "60", "24", "30", "12", "10");

    $currentTime = time();
    if ($currentTime >= $timestamp) {
        $diff = time() - $timestamp;
        for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
            $diff = $diff / $length[$i];
        }

        $diff = round($diff);
        return $diff . " " . $strTime[$i] . "(s) ago ";
    }
}
?>
<!--<div class="panel">
    <div class="panel-body">-->



<!--<div class="panel">
    <div class="panel-body">-->
<form action="newsfeed" method="post">

<!--    <table id="emptable" class="table table-striped responsive no-wrap" cellspacing="0" width="100%" style="margin: 0px;padding: 0px;width: 100%;">
        <thead >
            <tr >
                <td ></td>

            </tr>
        </thead>
        <tbody>
    -->
    <!--<div class="example-box-wrapper">-->
    <?php
    if (empty($PostResultComment)) {
        //echo "No Comment Found!!!!";
    } else {
        foreach ($PostResultComment as $PostComRow) {
            ?>
                <!--                    <tr>
                    <td>-->
            <div class="row">
                <div class="panel">
                    <div class="panel-body">
                        <div  class="col-xs-3 col-md-3 col-lg-3" style="cursor: pointer;
                              border: 2px dashed transparent;
                              border-radius: 50%;
                              display: inline-block;
                              position: relative;
                              height: 40px;
                              width: 40px;font-weight: bold;
                              background-color: #e9e9e9;
                              font-size: 14px;
                              line-height: 35px;"><?php echo substr(ucfirst($PostComRow['fname']), 0, 1) . '' . substr(ucfirst($PostComRow['lname']), 0, 1) ?></div>
                        <div class="col-xs-8 col-md-8 col-lg-8">
                            <div><b><?php echo $PostComRow['fname'] . ' ' . $PostComRow['lname'] ?></b></div>
                            <div><?php echo $PostComRow['email']; ?></div>
                            <div class="row">
                                <div  class="col-xs-12 col-md-12">
                                    <?php echo $PostComRow['message']; ?>
                                </div>
                            </div>
                            <input type="hidden" value="<?php echo $PostComRow['id']; ?>" id="post_id" name="post_id"/>


                            <div class="row">
                                <div  class="col-xs-12 col-md-12" style="color: #9E9E9E;">
                                    <?php
                                    $timestamp = strtotime($PostComRow['created_at']);
                                    echo date('l F d, Y, h:i A', $timestamp);
                                    ?>
                                    <!--March 2017 9:22 AM    date('l F d, Y, h:i A',$timestamp); -->
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($PostID == $PostComRow['create_post_id']) {
                            $disp = "block";
                        } else {
                            $disp = "none;";
                        }
                        ?>
                        <div class="col-lg-1 col-xs-1 col-md-1" style="float: right;">
                            <a href="javascript:void(0)"   style="line-height: 40px;padding: 10px;display:<?= $disp; ?>  " class="delete" onclick="deleteposts(<?= $PostComRow['id']; ?>)" data-userid="<?= $PostComRow['create_post_id']; ?>" ><i class="fa fa-trash"></i></a>
                        </div>

                    </div>

                    <!--                        <hr/>-->

                    <?php
                    $PID = $PostComRow['id'];
//                                d($PID);
                    $PostResultSubComment = q("select tc.id as tbcomment_id,tc.post_id as post_id,tc.comment_id AS comment_id,te.id as userid ,te.fname,te.lname,te.email,tc.comment,tc.created_at ,tp.id from tb_comments tc, tb_post tp , tb_employee te  where tc.post_id = tp.id and te.id = tc.comment_id And tc.post_id='$PID' order by tc.id asc");
                    if (empty($PostResultSubComment)) {
                        //echo "No Comment Found!!!!";
                    } else {
                        foreach ($PostResultSubComment as $PostResultSubCommentRow) {
                            ?>
                            <!--<hr/>-->
                            <div class="panel-body" style="padding: 0px 10%;  ">
                                <div  class="col-xs-3 col-md-3" style="cursor: pointer;
                                      border: 2px dashed transparent ;
                                      border-radius: 50%;
                                      display: inline-block;
                                      position: relative;
                                      height: 30px;
                                      width: 30px;padding: 0px 5px;font-weight: bold;
                                      background-color: #e9e9e9;
                                      font-size: 12px;
                                      line-height: 25px;"><?php echo substr(ucfirst($PostResultSubCommentRow['fname']), 0, 1) . '' . substr(ucfirst($PostResultSubCommentRow['lname']), 0, 1) ?></div>
                                <div class="col-xs-8 col-md-8 col-lg-8" style="border-bottom:  1px dashed lightsteelblue ;">
                                    <?php if ($PostResultSubCommentRow['userid'] == $_SESSION['user']['id']) { ?>
                                        <div><b>You</b></div>
                                    <?php } else { ?>
                                        <div><b><?php echo $PostResultSubCommentRow['fname'] . ' ' . $PostResultSubCommentRow['lname']; ?></b></div>
                                    <?php } ?>

                                    <div style="float: left;"><?php echo $PostResultSubCommentRow['comment'] ?></div>
                                    <div style="float: right;font-size: 10px;"><?php echo timeago($PostResultSubCommentRow['created_at']); ?></div>

                                </div>
                                <?php
                                if ($PostID == $PostComRow['create_post_id']) {
                                    $subdisp = "block";
                                } else {
//                                    if ($PostID == $PostResultSubCommentRow['comment_id']) {
                                    if ($PostID == $PostResultSubCommentRow['userid']) {
                                        $subdisp = "block";
                                    } else {
                                        $subdisp = "none;";
                                    }
                                }
                                ?>

                                <div class="col-xs-1 col-md-1 col-lg-1" style="border-bottom:  1px dashed transparent ;">
                                    <a href="javascript:void(0)" style="padding: 10px; display: <?= $subdisp; ?>" onclick="deletecomments(<?= $PostResultSubCommentRow['tbcomment_id']; ?>)" data-userid="<?= $PostResultSubCommentRow['tbcomment_id']; ?>" class="delete"><i class="fa fa-trash"></i></a>
                                </div>

                            </div>

                            <?php
                        }
                    }
                    ?>
                    <hr/>
                    <!--<div style="height: 20px;border-bottom: 1px solid #e3e3e3;margin-bottom: 8px;background-color: #e9e9e9;color: black;margin-top: 5px;">Comment</div>-->


                    <div class="panel-body" style="margin: 0px 10px;">

                        <div  class="col-xs-9 col-md-9 col-lg-9">
                            <input type="text" value="" id="comment<?= $PID ?>" name="comment<?= $PID ?>" style="height: 40px;width: 100%" />
                        </div>
                        <div class="col-xs-3 col-md-3 col-lg-3">
                            <button style="margin: auto 10px;" class="btn btn-primary" type="button" onclick="SaveComment(<?= $PID ?>, document.getElementById('comment<?= $PID ?>').value)">Post</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--                    </td>
                                </tr>-->
            <?php
        }
    }
    ?>

    <!--</div>-->
    <input type="hidden" name="save_comment" />
    <input type="hidden" value="2" id="comment_id" name="comment_id"/>

    <!--        </tbody>
        </table>-->
</form>

<!--    </div>
</div>-->




<!--    </div> modal-content 
</div> modal-dialog 
-->
