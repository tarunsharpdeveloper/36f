
<!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>js/jquery.timepicker.js"></script>-->
<!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/jquery.timepicker.css" />-->
<?php include _PATH . "instance/front/tpl/libValidate.php" ?>
<script type="text/javascript">
//    function checkMails() {
//        $.ajax({
//            url: '<?php echo _U ?>sign_in',
//
////            dataType: "json",
//            type: "GET",
//            data: {
//                Checking: 1,
//                email: '<?= $_REQUEST['email'] ?>',
//                ufname: '<?= $_REQUEST['fname'] ?>',
//                ulname: '<?= $_REQUEST['lname'] ?>'
//            }, success: function (r) {
//
//            }
//        });
//
//    }
    function CallSubmit(value) {
        $("#set_default_page").val(value);
//        alert(value);
        $.ajax({
            url: '<?php echo _U ?>sign_in',

            dataType: "json",
//            type: "post",
            data: {
                SigninApprove: 1,
                ladelData: $("#sign_in_form").serialize()

//                dates: $("#daterangepicker-time").val()
            }, success: function (r) {
                if (r.success > 0) {
                    $("#myModal2").modal('toggle');
                    $("#work_at").val(r.work_at);
                    $("#default_page").val($("#set_default_page").val(value));
//                    location.href = "<?= _U . $_SESSION['company']['default_page']; ?>";
                    $("#myModal3").modal({backdrop: 'static', keyboard: false});
                    $("#mod_4").css("display", "block");
//                    _toast("success", "Approved", r.msg);
                } else {
                    _toast("warning", "Declind", r.msg);
//                    location.href = "<?= _U . 'login' ?>";
                }
            }});
    }
    function setModelBack() {
        var md_no = $("#mdiv_active").val();
        md_no--;
        md = md_no;
        if (md_no == 1) {
            $(".btn-prev").css("display", "none");
            $(".btn-next").css("display", "none");
        } else {
            $(".btn-prev").css("display", "block");
            $(".btn-next").css("display", "block");
        }
        $("#mdiv_active").val(md);
        $(".modal-content").css("display", "none");
        $("#mod_" + md).css("display", "block");
    }
    function setModelNext() {
        var md_no = $("#mdiv_active").val();
        md_no++;
        if (md_no > 2) {
            $(".btn-prev").css("display", "block");
            $(".btn-next").css("display", "none");
        }
        var md = md_no;
        $("#mdiv_active").val(md);
        $(".modal-content").css("display", "none");
        $("#mod_" + md).css("display", "block");
    }
    function setModel(value) {
        $("#mdiv_active").val(value);
        var bname = $("#bname").val();
        var bcity = $("#bcity").val();
        if (bname === "") {
            $("#bname").focus();
        } else if (bcity === null || bcity === "") {
            $("#bcity").focus();
        } else {
            set_model();
        }
    }
    function set_model() {
        var md_no = $("#mdiv_active").val();
        md_no++;
        if (md_no <= 2) {
            $(".btn-prev").css("display", "block");
            $(".btn-next").css("display", "block");
        }
        var md = md_no;
        $("#mdiv_active").val(md);
        $(".modal-content").css("display", "none");
        $("#mod_" + md).css("display", "block");
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
//        checkMails();


<?php if (!empty($_REQUEST['email'])) { ?>
            $("#myModal2").modal({backdrop: 'static', keyboard: false}
            );
            $("#mdiv_active").val('1');
            $("#emp_fname").val('<?= $_REQUEST['fname'] ?>');
            $("#emp_lname").val('<?= $_REQUEST['lname'] ?>');
            $("#email").val('<?= $_REQUEST['email'] ?>');
            $(".modal-content").css("display", "none");
            $(".btn-prev").css("display", "none");
            $(".btn-next").css("display", "none");
            $("#mod_1").css("display", "block");


    <?php
} else {
    _R('login');
}
?>
<?php if ($success == "1") { ?>
            Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>
<?php if ($success == "-1") { ?>
            Materialize.toast('<?= $msg; ?>', 4000);
<?php } ?>
        var maxField = 15; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div id="remove_lan"><div class="col-sm-3"><div class="form-group"><div class="input-group"><div class="col-sm-12"><input id="fname"  type="text" name="fname[]" class="form-control form-radius"   placeholder="First Name" required/></div></div></div></div><div class="col-sm-3"><div class="form-group"><div class="input-group"><div class="col-sm-12"><input id="lname"  type="text" name="lname[]" class="form-control form-radius"   placeholder="Last Name" required/></div></div></div></div><div class="col-sm-3"><div class="form-group"><div class="input-group"><div class="col-sm-12"><input id="email"  type="text" name="email[]" class="form-control form-radius"   placeholder="(Optional)"/></div></div></div></div><div class="col-sm-2"><div class="col-sm-12"><div class="form-group"><div class="input-group"><div class="col-sm-12"><input id="phone_no"  type="text" name="phone_no[]" class="form-control form-radius"   placeholder="(Optional)"/></div></div></div></div></div><div class="col-sm-1"><div><a class="btn btn-link-danger remove remove_button" href="javascript:void(0);" title="Remove"><i class="fa fa-trash-o"></i></a></div></div></div>'; //New input field html 
        //var fieldHTML = '<div><input type="text" name="name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="<?php echo _U ?>instance/front/media/remove-icon.png"/></a></div>'; //New input field html 
        for (i = 0; i < 3; i++) {

            var x = 1; //Initial field counter is 1
            $(addButton).click(function () { //Once add button is clicked
                if (x < maxField) { //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); // Add field html
                }
            });
        }
        $(wrapper).on('click', '.remove_button', function (e) { //Once remove button is clicked
            e.preventDefault();
            //$(this).closest(".test").fadeOut(10);
            $(this).closest('#remove_lan').remove();
            //$(this).parent('div').remove(); //Remove field html
            //$( ".test" ).remove();
            x--; //Decrement field counter
        });
        $("#sign_inform").validate({
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
                $("#sign_inform").submit();
            }
        });
    });

</script>
