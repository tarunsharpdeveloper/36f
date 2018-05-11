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



        <div class="panel">
            <div class="panel-body">
                <div class="example-box-wrapper">
<!--                    <div class="row">
                        <div  class="col-xs-3 col-md-3" style="cursor: pointer;
                        border: 2px dashed transparent;
                        border-radius: 50%;
                        display: inline-block;
                        position: relative;
                        height: 54px;
                        width: 60px;
                        background-color: #e9e9e9;
                        font-size: 28px;">HP</div>
                        <div class="col-xs-3 col-md-3">
                            
                                <img id="imgTeamProfilePhoto" class="imgProfilePhoto m-team-photo--large" src="<?php print _MEDIA_URL ?>img/user.jpg" alt="Set Photo" style="cursor: pointer;border: 2px dashed transparent;
                                     border-radius: 50%;
                                     display: inline-block;
                                     position: relative;height: 60px;width: 60px">
                            
                        </div>
                        <div class="col-xs-9 col-md-9">
                            <div><b>Hardik Panchal</b></div>
                            <div>system Administrator 1</div>
                            <div>system Administrator 2</div>
                            
                        </div>
                           
                    </div>-->
                    
                    
                    <?php
                    if(empty($PostResult)){
                        echo "No Post Found!!!!";
                    }else{
                        foreach($PostResult as $PostRow){
                     if(($PostRow['create_post_id'] == $_SESSION['user']['id']) OR ($PostRow['share_id'] == $_SESSION['user']['id'])){ ?>
                         <a href="post_comment?id=<?php echo $PostRow['id']; ?>">
                            <div class="row">
                                <div  class="col-xs-3 col-md-3" style="cursor: pointer;
                                border: 2px dashed transparent;
                                border-radius: 50%;
                                display: inline-block;
                                position: relative;
                                height: 50px;
                                width: 60px;
                                background-color: #e9e9e9;
                                font-size: 28px;"><?php echo substr(ucfirst($PostRow['fname']),0,1).''.substr(ucfirst($PostRow['lname']),0,1) ?></div>
                                <div class="col-xs-9 col-md-9">
                                    <div><b><?php echo ucfirst($PostRow['fname']).' '.ucfirst($PostRow['lname']) ?></b></div>
                                    <div><?php echo timeago($PostRow['created_at']); ?></div>
                                    <div><?php echo $PostRow['message']; ?></div>

                                </div>
                            </div>
                                </a>
                            <div style="height: 8px;border-bottom: 1px solid #e3e3e3;margin-bottom: 8px;"></div>
                    
                     <?php }else{ 
                         echo "No Post Found!!!!";
                     } }} ?>
                </div>

                <div  id="Add-option" class="">
                    <a class="btn btn-primary theme-switcher tooltip-button" href="<?php l('add_newsfeed') ?>" data-toggle="" data-target="" data-placement="left" title="New NewsFeed" data-original-title="Add NewsFeed">
                        <i class="glyph-icon icon-plus-square "></i>
                    </a>
                </div>
            </div>
        </div>

   


    </div><!-- modal-content -->
</div><!-- modal-dialog -->

