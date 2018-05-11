
<div class="center-vertical <?php echo $fp == "1" ? "hidden" : "" ?>">
    <div class="center-content row"> 
        <form action="" method="post"  class="col-md-4 col-sm-5 col-xs-11 col-lg-4 center-margin " style="margin-top: 100px;">

            <div id="" class="content-box bg-default center-margin">
                <div class="content-box-wrapper pad20A">

                    <section id="forgot-password">
                        <!-- Background Bubbles -->
                        <!--<canvas id="bubble-canvas"></canvas>-->
                        <!-- /Background Bubbles -->
                        <!-- Reset Form -->
                        <div class="logo text-center">
                            <img src="<?php print _MEDIA_URL ?>img/LOGO.png" style="height: 60px;width: 250px;" alt="">
                        </div>
                        <div class="">
                            <div class="alert blue lighten-5 blue-text text-darken-2">
                                <strong><i class="fa fa-css3"></i></strong>&nbsp;We will send instructions to reset your password to your email.
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon addon-inside bg-gray">
                                        <i class="glyph-icon icon-envelope-o"></i>
                                    </span>
                                    <input id = "input_email" class="form-control" type = "email" required name = "email" placeholder="E-Mail">                        
                                </div>
                            </div>

                            <div class="form-group">
                                <button type = "submit" name = "submit" class = "btn btn-block btn-primary waves-effect waves-amber  z-depth-0 z-depth-1-hover">RESET</button>
                            </div>
                        </div>

                        <!--/Reset Form -->

                    </section>
                </div>
            </div>
        </form>
    </div>
</div>
<style>
    .input-field .prefix ~ input,
    .input-field .prefix ~ textarea {
        width: calc(100% - 4rem); 
    }
    ::-webkit-input-placeholder {
        color: #4d4d4d;
    }

    :-moz-placeholder {
        /* Firefox 18- */
        color: #4d4d4d;
    }

    ::-moz-placeholder {
        /* Firefox 19+ */
        color: #4d4d4d; 
    }

    :-ms-input-placeholder {
        color: #4d4d4d; 
    }
</style>