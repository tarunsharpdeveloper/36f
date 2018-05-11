
<!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>js/jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/jquery.timepicker.css" />-->
<?php include _PATH . "instance/front/tpl/libValidate.php"?>
<script type="text/javascript">
    $(document).ready(function () {
<?php if ($success == "1") { ?>
            Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>
<?php if ($success == "-1") { ?>
            Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>
        
        $("#sign_upform").validate({
            rules: {
                email: {required: true},
                office: {required: true},
                password: {required: true}

            },
            messages: {
                email: {required: '<span style="color:red;font-size:11px;">"<?php print _t('220', 'Please enter your email address'); ?>"</span>'},
                office: {required: '<span style="color:red;font-size:11px;">"<?php print _t('219', 'Please select an office '); ?>"</span>'},
                password: {required: '<span style="color:red;font-size:11px;">"<?php print _t('221', 'Please enter your password'); ?>"</span>'}
            },
            submitHandler: function (form) {
                $("#sign_upform").submit();
            }
        });
    });
   
</script>
