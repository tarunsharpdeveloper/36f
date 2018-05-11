<?php
	$strTimeAgo = ""; 
	if(!empty($_POST["date-field"])) {
		$strTimeAgo = timeago($_POST["date-field"]);
	}
	function timeago($date) {
	   $timestamp = strtotime($date);	
	   
	   $strTime = array("second", "minute", "hour", "day", "month", "year");
	   $length = array("60","60","24","30","12","10");

	   $currentTime = time();
	   if($currentTime >= $timestamp) {
			$diff     = time()- $timestamp;
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
			$diff = $diff / $length[$i];
			}

			$diff = round($diff);
			return $diff . " " . $strTime[$i] . "(s) ago ";
	   }
	}
	
?>
<div class="panel">
    <div class="panel-body">



        <div class="panel">
            <div class="panel-body">
                <form action="post_comment" method="post">
                <div class="example-box-wrapper">
     <?php
                    if(empty($PostResultComment)){
                        //echo "No Comment Found!!!!";
                    }else{
                        foreach($PostResultComment as $PostComRow){
                            
                    
                    ?>
                    <div class="row">
                        
                        <div  class="col-xs-3 col-md-3" style="cursor: pointer;
                        border: 2px dashed transparent;
                        border-radius: 50%;
                        display: inline-block;
                        position: relative;
                        height: 50px;
                        width: 60px;
                        background-color: #e9e9e9;
                        font-size: 28px;"><?php echo substr(ucfirst($PostComRow['fname']),0,1).''.substr(ucfirst($PostComRow['lname']),0,1) ?></div>
                        <div class="col-xs-9 col-md-9">
                            <div><b><?php echo $PostComRow['fname'].' '.$PostComRow['lname'] ?></b></div>
                            <div><?php echo $PostComRow['email']; ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div  class="col-xs-12 col-md-12">
                           <?php echo $PostComRow['message']; ?>
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $PostComRow['id']; ?>" id="post_id" name="post_id"/>
                   
                
                    <div class="row">
                        <div  class="col-xs-12 col-md-12" style="color: #9E9E9E;">
                            <?php $timestamp = strtotime($PostComRow['created_at']);
                            echo date('l F d, Y, h:i A',$timestamp); ?>
                             <!--March 2017 9:22 AM    date('l F d, Y, h:i A',$timestamp); -->
                        </div>
                    </div>
                     <?php }} ?>
                    <div style="height: 20px;border-bottom: 1px solid #e3e3e3;margin-bottom: 8px;background-color: #e9e9e9;color: black;margin-top: 5px;">Comment</div>
                    <?php
                    if(empty($PostResultSubComment)){
                        //echo "No Comment Found!!!!";
                    }else{
                        foreach($PostResultSubComment as $PostResultSubCommentRow){
                            
                    
                    ?>
                    <div class="row">
                        <div  class="col-xs-3 col-md-3" style="cursor: pointer;
                        border: 2px dashed transparent;
                        border-radius: 50%;
                        display: inline-block;
                        position: relative;
                        height: 50px;
                        width: 60px;
                        background-color: #e9e9e9;
                        font-size: 28px;"><?php echo substr(ucfirst($PostResultSubCommentRow['fname']),0,1).''.substr(ucfirst($PostResultSubCommentRow['lname']),0,1) ?></div>
                        <div class="col-xs-6 col-md-6">
                            <?php 
                            if($PostResultSubCommentRow['userid'] == $_SESSION['user']['id']){ ?>
                                <div><b>You</b></div>
                            <?php }else{ ?>
                                <div><b><?php echo $PostResultSubCommentRow['fname'].' '.$PostResultSubCommentRow['lname']; ?></b></div>
                            <?php } ?>
                            
                            <div><?php echo $PostResultSubCommentRow['comment'] ?></div>
                        </div>
                        <div class="col-xs-3 col-md-3">
                            <div><?php echo timeago($PostResultSubCommentRow['created_at']); ?></div>
                        </div>
                        
                    </div>
                    <?php }} ?>
                    
                    <div class="row">
                        <div  class="col-xs-6 col-md-6">
                            <input type="text" value="" id="comment" name="comment" style="height: 40px;" required=""/>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <button style="margin-left: 50px;" class="btn btn-primary" type="submit">Post</button>
                        </div>
                    </div>
                </div>
                    <input type="hidden" name="save_comment" />
                <input type="hidden" value="2" id="comment_id" name="comment_id"/>
                </form>
            </div>
        </div>

   


    </div><!-- modal-content -->
</div><!-- modal-dialog -->

