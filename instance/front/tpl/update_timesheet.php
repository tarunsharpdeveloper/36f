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
    label{
        font-weight: inherit;
        margin-bottom: 12px;
    }

    
</style>
<style>
   .error{color: #da1f1f;}

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
    <div class="panel" >
        
            <div class="panel-body">
                <div class="col-lg-2 col-sm-12">
                    <h2 style="font-weight: bold;">Update Timesheet</h2>
                </div>
                <div class="col-lg-8 col-sm-12 ">
                    <hr>
                </div>
                <form action="" class="form-inline" method="POST">
                  <div class="col-xs-6">
                      <div class="form-group">
                        <label for="s_date">Start Date:</label>
                        <input type="text" value="<?=$s_date?>" class="form-control bootstrap-datepicker bootstrap-datetimepicker-widget" id="s_date" name="s_date">
                      </div>
                      <?php if(isset($errors) && $errors['s_date'] !=""){ ?>
                      <span class="error"><?=$errors['s_date']?></span>
                      <?php } ?>
                  </div>
                  <div class="col-xs-6">
                      <div class="form-group">
                        <label for="s_time">Start Time:</label>
                        <input type="text" value="<?=$s_time?>" class="form-control bootstrap-timepicker timepicker" id="s_time" name="s_time">
                      </div>
                      <?php if(isset($errors) && $errors['s_time'] !=""){ ?>
                      <span class="error"><?=$errors['s_time']?></span>
                      <?php } ?>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-xs-6">
                      <div class="form-group">
                        <label for="e_date">End Date:</label>
                        <input type="text" value="<?=$e_date?>" class="form-control" id="e_date" name="e_date">
                      </div>
                      <?php if(isset($errors) && $errors['e_date'] !=""){ ?>
                      <span class="error"><?=$errors['e_date']?></span>
                      <?php } ?>
                  </div>
                  <div class="col-xs-6">
                      <div class="form-group">
                        <label for="e_time">End Time:</label>
                        <input type="text" value="<?=$e_time?>" class="form-control" id="e_time" name="e_time">
                      </div>
                      <?php if(isset($errors) && $errors['e_time'] !=""){ ?>
                      <span class="error"><?=$errors['e_time']?></span>
                      <?php } ?>
                  </div>
                  <div class="clearfix"></div> 
                  <div class="col-xs-12 text-center" style="margin-top:10px;">   
                    <button type="submit" name="save" id="save" class="btn btn-primary">SAVE</button>
                  </div>  
                </form>
            </div>
        
    </div>
</div>
<script src="<?php print _MEDIA_URL ?>assets/bootstrap-notify-master/bootstrap-notify.js"></script>
<script type="text/javascript">
<?php if($is_success) { ?>
(function($) {
    $.notify({
        message: 'Update Successfull!'
    },
    { 
        type: 'success'
    });
    setTimeout(function(){
        window.parent.location.href = 'timesheet_approve';
    },2000);
    
})(jQuery);
<?php } ?>    
</script>
