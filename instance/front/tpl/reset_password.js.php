<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<?php include _PATH . "instance/front/tpl/libValidate.php"?>

<script type="text/javascript">
    $(document).ready(function () {
    

        $("#resetpassword").validate({
            rules: {
                password: {required: true},
                re-password: {required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                password: {required: '<span style="color:red;font-size:11px;">Please Enter Password</span>'},
                password_reset: {required: '<span style="color:red;font-size:11px;">Please Enter the new password again</span>',
                    equalTo: '<span style="color:red;font-size:11px;">Please enter the same value again.</span>',
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
   
</script>
