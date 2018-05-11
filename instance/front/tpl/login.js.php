<script type="text/javascript" src="<?php print _MEDIA_URL ?>js/jquery.timepicker.js"></script>
<!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/jquery.timepicker.css" />-->
<?php include _PATH . "instance/front/tpl/libValidate.php" ?>
<?php if($_SESSION['selected_lang'] == 'fa'): ?>
    <script src="https://www.google.com/recaptcha/api.js?hl=fa" async defer></script>
<?php else: ?>
     <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#myModal3").modal("toggle");
<?php if ($success == "1") { ?>
            Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>
<?php if ($success == "-1") { ?>
            Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>

        $("#loginform").validate({
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
                $("#loginform").submit();
            }
        });
    });

</script>
