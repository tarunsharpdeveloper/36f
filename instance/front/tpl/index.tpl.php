<?php if (!file_exists(_PATH . "instance/front/tpl/" . $modulePage)): ?>
    <?php include _PATH . "instance/front/tpl/404.php"; ?>
    <?php header("HTTP/1.0 404 Not Found"); ?>
    <?php die; ?>
<?php endif; ?>
<?php 
       //fa = farsi; (ea || '') = English
   $langLabels = array();
   $langLabels = getChangeLangLabels();
   
    
?>
<?php $rtl = ($_SESSION['selected_lang'] == 'fa') ? 'rtl' : ''; ?>
<!DOCTYPE html>
<html lang="en" class="<?= $rtl; ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="_nK">
        <!--<link rel="icon" href="<?php print _MEDIA_URL ?>images/MasirApp.png">-->
        <link rel="icon" href="<?php print _MEDIA_URL ?>img/t_logo_je.png">


        <title>WHOzoor | <?php print _cg("page_title"); ?></title>
        <!--****BootStrap CSS HERE******-->


        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/bootstrap/css/bootstrap.min.css">
        <!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/bootstrap/css/bootstrap.css">-->
        <!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/bootstrap/css/bootstrap-theme.css">-->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/bootstrap/css/bootstrap-theme.min.css">
        <?php if ($rtl == "rtl") { ?>
            <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css" integrity="sha256-Y4fsmcZ5AITTOI41har72EhwauUaLt5u51px24bEtKc=" crossorigin="anonymous" />-->
            <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.min.css" integrity="sha256-QaRlBIHoN1LIkxeziW34nknOVrCasnLJY6esf3ldv+k=" crossorigin="anonymous" />-->
                <!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/bootstrap/css/bootstrap-rtl.min.css">-->
        <?php } ?>
            
            <?php if ($rtl == "rtl") { ?>
                 <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>/custom.css">
             <?php } ?>

        <!-- HELPERS -->

        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/helpers/animate.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/helpers/backgrounds.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/helpers/boilerplate.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/helpers/border-radius.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/helpers/grid.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/helpers/page-transitions.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/helpers/spacing.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/helpers/typography.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/helpers/utils.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/helpers/colors.css">

        <!-- ELEMENTS -->

        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/badges.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/buttons.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/content-box.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/dashboard-box.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/forms.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/images.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/info-box.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/invoice.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/loading-indicators.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/menus.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/panel-box.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/response-messages.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/responsive-tables.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/ribbon.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/social-box.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/tables.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/tile-box.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/elements/timeline.css">



        <!-- ICONS -->

        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/icons/fontawesome/fontawesome.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/icons/linecons/linecons.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/icons/spinnericon/spinnericon.css">


        <!-- WIDGETS -->

        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/accordion-ui/accordion.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/calendar/calendar.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/carousel/carousel.css">

        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/charts/justgage/justgage.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/charts/morris/morris.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/charts/piegage/piegage.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/charts/xcharts/xcharts.css">

        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/chosen/chosen.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/colorpicker/colorpicker.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/datatable/datatable.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/datepicker/datepicker.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/datepicker-ui/datepicker.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/dialog/dialog.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/dropdown/dropdown.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/dropzone/dropzone.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/file-input/fileinput.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/input-switch/inputswitch.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/input-switch/inputswitch-alt.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/ionrangeslider/ionrangeslider.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/jcrop/jcrop.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/jgrowl-notifications/jgrowl.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/loading-bar/loadingbar.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/maps/vector-maps/vectormaps.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/markdown/markdown.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/modal/modal.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/multi-select/multiselect.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/multi-upload/fileupload.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/nestable/nestable.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/noty-notifications/noty.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/popover/popover.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/pretty-photo/prettyphoto.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/progressbar/progressbar.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/range-slider/rangeslider.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/slidebars/slidebars.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/slider-ui/slider.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/summernote-wysiwyg/summernote-wysiwyg.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/tabs-ui/tabs.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/theme-switcher/themeswitcher.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/timepicker/timepicker.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/tocify/tocify.css">
<!--        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/tooltip/tooltip.css">-->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/touchspin/touchspin.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/uniform/uniform.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/wizard/wizard.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/xeditable/xeditable.css">

        <!-- SNIPPETS -->

        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/snippets/chat.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/snippets/files-box.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/snippets/login-box.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/snippets/notification-box.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/snippets/progress-box.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/snippets/todo.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/snippets/user-profile.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/snippets/mobile-navigation.css">

        <!-- APPLICATIONS -->

        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/applications/mailbox.css">
        <!-- Uniform -->

        <!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/uniform/uniform.css">-->
        <!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/uniform/uniform.js"></script>-->
        <!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/uniform/uniform-demo.js"></script>-->

        <!-- Chosen -->

<!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/chosen/chosen.css">-->
        <!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/chosen/chosen.js"></script>-->
        <!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/chosen/chosen-demo.js"></script>-->
        <!-- Admin theme -->

        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/themes/admin/layout.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/modal/modal.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/themes/admin/color-schemes/default.css?temp=223">

        <!-- Components theme -->

        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/themes/components/default.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/themes/components/border-radius.css">

        <!-- Admin responsive -->

        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/helpers/responsive-elements.css">
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/helpers/admin-responsive.css">

        <!-- JS Core -->     

        <!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>assets-minified/js-core.js"></script>-->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/js-core/jquery-core.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/js-core/jquery-ui-core.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/js-core/jquery-ui-widget.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/js-core/jquery-ui-mouse.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/js-core/jquery-ui-position.js"></script>
        <!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/js-core/transition.js"></script>-->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/js-core/modernizr.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/js-core/jquery-cookie.js"></script>

        <!--****BootStrap CSS HERE OVER******-->
        <!--<link href='http://fonts.googleapis.com/css?family=Lato:400,100,300,500,700,900' rel='stylesheet' type='text/css'>-->
        <!--<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">--> 
        <!-- Clockpicker -->
        <!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/clockpicker/dist/jquery-clockpicker.min.css" />-->
        <!-- MarkItUp -->
<!--        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/markitup-1x/markitup/sets/default/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/markitup-1x/markitup/skins/simple/style.css" />
        -->
        <!-- nanoScroller -->
        <!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/nanoscroller/bin/css/nanoscroller.css" />-->

        <!-- FontAwesome -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/fontawesome/css/font-awesome.min.css" />


        <!-- Materialt" type="text/css" href="<?php print _MEDIA_URL ?>bower_components Design Icons -->
        <!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>OLD/assets/material-design-icons/css/material-design-icons.min.css" />-->
        <!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/icons/fontawesome/fontawesome.css" />-->
        <!-- IonIcons -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/ionicons/css/ionicons.min.css" />
        <!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/icons/iconic/iconic.css" />-->

        <!-- WeatherIcons -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/weather-icons/css/weather-icons.min.css" />

        <!-- Rickshaw -->
        <!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/rickshaw/rickshaw.min.css" />-->

        <!-- nvd3 -->
        <!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/nvd3/build/nv.d3.min.css" />-->

        <!-- jvectormap -->
        <!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/jquery-jvectormap/jquery-jvectormap.css" />-->
        <!-- select2-->
<!--        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>OLD/assets/_con/select2/select2.min.css" />

         Main 
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>OLD/assets/_con/css/con-base.css?t=<?php print rand() ?>" />
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>OLD/css/lz.css?t=<?php print rand() ?>" />-->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/jquery-ui-1.12.1/jquery-ui.min.css">

        <!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/persian-datepicker.css" />-->
        <!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/persian-datepicker-blue.css" />-->

        <!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/_con/css/con-green.css" />


        <!-- Squire -->
        <!--<link href="<?php print _MEDIA_URL ?>assets/_con/squire/squire-ui.css" rel="stylesheet" type="text/css" />-->
        <!--<link href="https://fonts.googleapis.com/css?family=Glegoo" rel="stylesheet"> -->
        <!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>OLD/css/custom.css" />-->
        <style>
            /*            .ui-accordion-content{
                    height: 150px !important;
                }*/
            html {
                font-family: tahoma;
                /*font-weight: 400;*/
                color:#388e3c;
            }

            body{
                background-color: #F9F9F9;
            }
            .pac-item{
                text-align: left
            }

            header.m-topHeader{
                background:#1b92da; 
            }
            header.m-topHeader .nav-tabs>li.active, header.m-topHeader .nav-tabs>li.open{
                background: #0074bc ; 
            }
            .login-container .login-panel .login-logo-wrapper{
                background-color: #1b92da;
            }
            .global-setting-modal .from-group-image-uploader img{
                background-color: #1b92da; 
            }
            /*header.m-topHeader .nav-tabs>li>a {
                    color: #cfffff ;
            }*/
            header.m-topHeader .nav-tabs>li.active>a{
                color: white;
            }
            header.m-topHeader .nav-tabs > li:hover{
                background: #0074bc ;
            }
        </style>

        <?php if ($_SESSION['selected_lang'] == 'fa'): ?>
            <!--<link href="https://fonts.googleapis.com/css?family=Amiri" rel="stylesheet">--> 
            <!--<link href="<?php print _MEDIA_URL ?>OLD/fonts/fonts.css" rel="stylesheet">--> 
            <style>
                html {
                    font-family: 'Iranian Sans', serif;
                    /*font-weight: 400;*/
                    color:#388e3c;
                }
            </style>    
        <?php endif; ?>

        <!--[if lt IE 9]>
            <script src="<?php print _MEDIA_URL ?>bower_components/html5shiv/dist/html5shiv.min.js"></script>
        <![endif]-->
        <!--<link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css" />-->

        <style>
            /* Loading Spinner */
            .spinner{margin:0;width:70px;height:18px;margin:-35px 0 0 -9px;position:absolute;top:50%;left:50%;text-align:center}.spinner > div{width:18px;height:18px;background-color:#333;border-radius:100%;display:inline-block;-webkit-animation:bouncedelay 1.4s infinite ease-in-out;animation:bouncedelay 1.4s infinite ease-in-out;-webkit-animation-fill-mode:both;animation-fill-mode:both}.spinner .bounce1{-webkit-animation-delay:-.32s;animation-delay:-.32s}.spinner .bounce2{-webkit-animation-delay:-.16s;animation-delay:-.16s}@-webkit-keyframes bouncedelay{0%,80%,100%{-webkit-transform:scale(0.0)}40%{-webkit-transform:scale(1.0)}}@keyframes bouncedelay{0%,80%,100%{transform:scale(0.0);-webkit-transform:scale(0.0)}40%{transform:scale(1.0);-webkit-transform:scale(1.0)}}
        </style>
        <script type="text/javascript">
            $(window).load(function () {
                setTimeout(function () {
                    $('#loading').fadeOut(50, "linear");
                }, 50);
            });
        </script>
    </head>
    <!--
      Body
        Options:
          .boxed - boxed layout for content
    -->


    <body>

        <!--        <div id="loading" class="">
        
                    <div class="spinner center-div">
                        <img src="<?php print _MEDIA_URL ?>img/t_logo_je.png" class="center-div" width="100" height="100"/>
        
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>-->
        <?php /* if (!_isLocalMachine()): ?>
          <script type="text/javascript" src="https://hubmost.atlassian.net/s/d41d8cd98f00b204e9800998ecf8427e-T/ct4jhl/100016/c/1000.0.10/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=bcb25529"></script>
          <?php endif; */ ?>
        <?php if ($no_visible_elements != 1) { ?>


            <?php include _PATH . 'instance/front/tpl/nav.php'; ?>

            <?php
            if ($_REQUEST['q'] == 'station5') {
                include _PATH . 'instance/front/tpl/left.php';
            } else {
                
            }
            ?>
            <style>
                #Add-option{
                    position: fixed;
                    right: -280px;
                    top: 80%;
                    transition: transform 0.5s ease 0s;
                    width: 300px;
                    z-index: 9999;
                }
                .lang_content{
                    width: 100%;
                    min-height: 50px;
                    text-align: center;
                    padding: 10px 0px;
                }

            </style>
            <!-- Main Content -->
            <div id="page-wrapper" style="margin-top: 70px;">

                <div id="page-content-wrapper">
                    <div id="page-content" style=" margin: -20px 0px 0px 0px;padding: 10px 0px;"  >

                        <div class="container">
                            <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/sticky/sticky.js"></script>
                            <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/tocify/tocify.js"></script>
                            <script type="text/javascript">
                            //            $(function() {
                            //            var toc = $("#tocify-menu").tocify({context: ".toc-tocify", showEffect: "fadeIn", extendPage:false, selectors: "h2, h3, h4" });
                            //            });
                            //            jQuery(document).ready(function($) {
                            //
                            //            /* Sticky bars */
                            //
                            //            $(function() { "use strict";
                            //            $('.sticky-nav').hcSticky({
                            //            top: 50,
                            //                    innerTop: 50,
                            //                    stickTo: 'document'
                            //            });
                            //            });
                            //            });
                            </script>


                            <section class="content-wrap">
                                <!--                                <div id="theme-options" class="admin-options">
                                                                    <a href="javascript:void(0);" class="btn btn-primary theme-switcher tooltip-button" data-placement="left" title="Color schemes and layout options">
                                                                        <i class="glyph-icon icon-linecons-cog icon-spin"></i>
                                                                    </a>
                                                                    <div id="theme-switcher-wrapper">
                                                                        <div class="scroll-switcher">
                                                                            <h5 class="header">Layout options</h5>
                                                                            <ul class="reset-ul">
                                                                                <li>
                                                                                    <label for="boxed-layout">Boxed layout</label>
                                                                                    <input type="checkbox" data-toggletarget="boxed-layout" id="boxed-layout" class="input-switch-alt">
                                                                                </li>
                                                                                <li>
                                                                                    <label for="fixed-header">Fixed header</label>
                                                                                    <input type="checkbox" data-toggletarget="fixed-header" id="fixed-header" class="input-switch-alt">
                                                                                </li>
                                                                                <li>
                                                                                    <label for="fixed-sidebar">Fixed sidebar</label>
                                                                                    <input type="checkbox" data-toggletarget="fixed-sidebar" id="fixed-sidebar" class="input-switch-alt">
                                                                                </li>
                                                                                <li>
                                                                                    <label for="closed-sidebar">Closed sidebar</label>
                                                                                    <input type="checkbox" data-toggletarget="closed-sidebar" id="closed-sidebar" class="input-switch-alt">
                                                                                </li>
                                                                            </ul>
                                                                            <div class="boxed-bg-wrapper hide">
                                                                                <h5 class="header">
                                                                                    Boxed Page Background
                                                                                    <a class="set-background-style" data-header-bg="" title="Remove all styles" href="javascript:void(0);">Clear</a>
                                                                                </h5>
                                                                                <div class="theme-color-wrapper clearfix">
                                                                                    <h5>Patterns</h5>
                                                                                    <a class="tooltip-button set-background-style pattern-bg-3" data-header-bg="pattern-bg-3" title="Pattern 3" href="javascript:void(0);">Pattern 3</a>
                                                                                    <a class="tooltip-button set-background-style pattern-bg-4" data-header-bg="pattern-bg-4" title="Pattern 4" href="javascript:void(0);">Pattern 4</a>
                                                                                    <a class="tooltip-button set-background-style pattern-bg-5" data-header-bg="pattern-bg-5" title="Pattern 5" href="javascript:void(0);">Pattern 5</a>
                                                                                    <a class="tooltip-button set-background-style pattern-bg-6" data-header-bg="pattern-bg-6" title="Pattern 6" href="javascript:void(0);">Pattern 6</a>
                                                                                    <a class="tooltip-button set-background-style pattern-bg-7" data-header-bg="pattern-bg-7" title="Pattern 7" href="javascript:void(0);">Pattern 7</a>
                                                                                    <a class="tooltip-button set-background-style pattern-bg-8" data-header-bg="pattern-bg-8" title="Pattern 8" href="javascript:void(0);">Pattern 8</a>
                                                                                    <a class="tooltip-button set-background-style pattern-bg-9" data-header-bg="pattern-bg-9" title="Pattern 9" href="javascript:void(0);">Pattern 9</a>
                                                                                    <a class="tooltip-button set-background-style pattern-bg-10" data-header-bg="pattern-bg-10" title="Pattern 10" href="javascript:void(0);">Pattern 10</a>
                                
                                                                                    <div class="clear"></div>
                                
                                                                                    <h5 class="mrg15T">Solids &amp;Images</h5>
                                                                                    <a class="tooltip-button set-background-style bg-black" data-header-bg="bg-black" title="Black" href="javascript:void(0);">Black</a>
                                                                                    <a class="tooltip-button set-background-style bg-gray mrg10R" data-header-bg="bg-gray" title="Gray" href="javascript:void(0);">Gray</a>
                                
                                                                                    <a class="tooltip-button set-background-style full-bg-1" data-header-bg="full-bg-1 fixed-bg" title="Image 1" href="javascript:void(0);">Image 1</a>
                                                                                    <a class="tooltip-button set-background-style full-bg-2" data-header-bg="full-bg-2 fixed-bg" title="Image 2" href="javascript:void(0);">Image 2</a>
                                                                                    <a class="tooltip-button set-background-style full-bg-3" data-header-bg="full-bg-3 fixed-bg" title="Image 3" href="javascript:void(0);">Image 3</a>
                                                                                    <a class="tooltip-button set-background-style full-bg-4" data-header-bg="full-bg-4 fixed-bg" title="Image 4" href="javascript:void(0);">Image 4</a>
                                                                                    <a class="tooltip-button set-background-style full-bg-5" data-header-bg="full-bg-5 fixed-bg" title="Image 5" href="javascript:void(0);">Image 5</a>
                                                                                    <a class="tooltip-button set-background-style full-bg-6" data-header-bg="full-bg-6 fixed-bg" title="Image 6" href="javascript:void(0);">Image 6</a>
                                
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="header">
                                                                                Header Style
                                                                                <a class="set-adminheader-style" data-header-bg="bg-gradient-9" title="Remove all styles" href="javascript:void(0);">Clear</a>
                                                                            </h5>
                                                                            <div class="theme-color-wrapper clearfix">
                                                                                <h5>Solids</h5>
                                                                                <a class="tooltip-button set-adminheader-style bg-primary" data-header-bg="bg-primary font-inverse" title="Primary" href="javascript:void(0);">Primary</a>
                                                                                <a class="tooltip-button set-adminheader-style bg-green" data-header-bg="bg-green font-inverse" title="Green" href="javascript:void(0);">Green</a>
                                                                                <a class="tooltip-button set-adminheader-style bg-red" data-header-bg="bg-red font-inverse" title="Red" href="javascript:void(0);">Red</a>
                                                                                <a class="tooltip-button set-adminheader-style bg-blue" data-header-bg="bg-blue font-inverse" title="Blue" href="javascript:void(0);">Blue</a>
                                                                                <a class="tooltip-button set-adminheader-style bg-warning" data-header-bg="bg-warning font-inverse" title="Warning" href="javascript:void(0);">Warning</a>
                                                                                <a class="tooltip-button set-adminheader-style bg-purple" data-header-bg="bg-purple font-inverse" title="Purple" href="javascript:void(0);">Purple</a>
                                                                                <a class="tooltip-button set-adminheader-style bg-black" data-header-bg="bg-black font-inverse" title="Black" href="javascript:void(0);">Black</a>
                                
                                                                                <div class="clear"></div>
                                
                                                                                <h5 class="mrg15T">Gradients</h5>
                                                                                <a class="tooltip-button set-adminheader-style bg-gradient-1" data-header-bg="bg-gradient-1 font-inverse" title="Gradient 1" href="javascript:void(0);">Gradient 1</a>
                                                                                <a class="tooltip-button set-adminheader-style bg-gradient-2" data-header-bg="bg-gradient-2 font-inverse" title="Gradient 2" href="javascript:void(0);">Gradient 2</a>
                                                                                <a class="tooltip-button set-adminheader-style bg-gradient-3" data-header-bg="bg-gradient-3 font-inverse" title="Gradient 3" href="javascript:void(0);">Gradient 3</a>
                                                                                <a class="tooltip-button set-adminheader-style bg-gradient-4" data-header-bg="bg-gradient-4 font-inverse" title="Gradient 4" href="javascript:void(0);">Gradient 4</a>
                                                                                <a class="tooltip-button set-adminheader-style bg-gradient-5" data-header-bg="bg-gradient-5 font-inverse" title="Gradient 5" href="javascript:void(0);">Gradient 5</a>
                                                                                <a class="tooltip-button set-adminheader-style bg-gradient-6" data-header-bg="bg-gradient-6 font-inverse" title="Gradient 6" href="javascript:void(0);">Gradient 6</a>
                                                                                <a class="tooltip-button set-adminheader-style bg-gradient-7" data-header-bg="bg-gradient-7 font-inverse" title="Gradient 7" href="javascript:void(0);">Gradient 7</a>
                                                                                <a class="tooltip-button set-adminheader-style bg-gradient-8" data-header-bg="bg-gradient-8 font-inverse" title="Gradient 8" href="javascript:void(0);">Gradient 8</a>
                                                                            </div>
                                                                            <h5 class="header">
                                                                                Sidebar Style
                                                                                <a class="set-sidebar-style" data-header-bg="" title="Remove all styles" href="javascript:void(0);">Clear</a>
                                                                            </h5>
                                                                            <div class="theme-color-wrapper clearfix">
                                                                                <h5>Solids</h5>
                                                                                <a class="tooltip-button set-sidebar-style bg-primary" data-header-bg="bg-primary font-inverse" title="Primary" href="javascript:void(0);">Primary</a>
                                                                                <a class="tooltip-button set-sidebar-style bg-green" data-header-bg="bg-green font-inverse" title="Green" href="javascript:void(0);">Green</a>
                                                                                <a class="tooltip-button set-sidebar-style bg-red" data-header-bg="bg-red font-inverse" title="Red" href="javascript:void(0);">Red</a>
                                                                                <a class="tooltip-button set-sidebar-style bg-blue" data-header-bg="bg-blue font-inverse" title="Blue" href="javascript:void(0);">Blue</a>
                                                                                <a class="tooltip-button set-sidebar-style bg-warning" data-header-bg="bg-warning font-inverse" title="Warning" href="javascript:void(0);">Warning</a>
                                                                                <a class="tooltip-button set-sidebar-style bg-purple" data-header-bg="bg-purple font-inverse" title="Purple" href="javascript:void(0);">Purple</a>
                                                                                <a class="tooltip-button set-sidebar-style bg-black" data-header-bg="bg-black font-inverse" title="Black" href="javascript:void(0);">Black</a>
                                
                                                                                <div class="clear"></div>
                                
                                                                                <h5 class="mrg15T">Gradients</h5>
                                                                                <a class="tooltip-button set-sidebar-style bg-gradient-1" data-header-bg="bg-gradient-1 font-inverse" title="Gradient 1" href="javascript:void(0);">Gradient 1</a>
                                                                                <a class="tooltip-button set-sidebar-style bg-gradient-2" data-header-bg="bg-gradient-2 font-inverse" title="Gradient 2" href="javascript:void(0);">Gradient 2</a>
                                                                                <a class="tooltip-button set-sidebar-style bg-gradient-3" data-header-bg="bg-gradient-3 font-inverse" title="Gradient 3" href="javascript:void(0);">Gradient 3</a>
                                                                                <a class="tooltip-button set-sidebar-style bg-gradient-4" data-header-bg="bg-gradient-4 font-inverse" title="Gradient 4" href="javascript:void(0);">Gradient 4</a>
                                                                                <a class="tooltip-button set-sidebar-style bg-gradient-5" data-header-bg="bg-gradient-5 font-inverse" title="Gradient 5" href="javascript:void(0);">Gradient 5</a>
                                                                                <a class="tooltip-button set-sidebar-style bg-gradient-6" data-header-bg="bg-gradient-6 font-inverse" title="Gradient 6" href="javascript:void(0);">Gradient 6</a>
                                                                                <a class="tooltip-button set-sidebar-style bg-gradient-7" data-header-bg="bg-gradient-7 font-inverse" title="Gradient 7" href="javascript:void(0);">Gradient 7</a>
                                                                                <a class="tooltip-button set-sidebar-style bg-gradient-8" data-header-bg="bg-gradient-8 font-inverse" title="Gradient 8" href="javascript:void(0);">Gradient 8</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                                <?php //include _PATH . 'instance/front/tpl/breadcrumb.php';  ?>

                                <?php
                                if (!include _PATH . 'instance/front/tpl/' . $modulePage) {
                                    include _PATH . 'instance/front/tpl/404.php';
                                }
                                ?>



                                <!-- /Main Content -->
                            <?php } else { ?>
                                <?php include _PATH . 'instance/front/tpl/' . $modulePage ?>
                            <?php } ?>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <!-- Widgets init for demo -->

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/js-init/widgets-init.js"></script>

        <!-- jQuery -->
        <!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>assets-minified/admin-all-demo.js"></script>-->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/parsley/parsley.js"></script>

        <!-- WIDGETS -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/jquery-ui-1.12.1/jquery-ui.js"></script>

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/accordion-ui/accordion.js"></script>
        <!-- Bootstrap Datepicker -->

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/datepicker/datepicker.js"></script>

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/datepicker-ui/datepicker.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/datepicker-ui/datepicker-demo.js"></script>

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/daterangepicker/moment.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/daterangepicker/daterangepicker-demo.js"></script>

        <!-- Bootstrap Timepicker -->

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/timepicker/timepicker.js"></script>
        <!-- Bootstrap Progress Bar -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/progressbar/progressbar.js"></script>
        <!-- Superclick -->

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/superclick/superclick.js"></script>

        <!-- Input switch alternate -->

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/input-switch/inputswitch-alt.js"></script>

        <!-- Slim scroll -->

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/slimscroll/slimscroll.js"></script>


        <!-- PieGage -->

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/charts/piegage/piegage.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/charts/piegage/piegage-demo.js"></script>

        <!-- Screenfull -->

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/screenfull/screenfull.js"></script>

        <!-- Content box -->

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/content-box/contentbox.js"></script>

        <!-- Overlay -->

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/overlay/overlay.js"></script>


        <!-- Theme layout -->

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/themes/admin/layout.js"></script>
        <!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/modal/modal.js"></script>-->

        <!-- Theme switcher -->

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/theme-switcher/themeswitcher.js"></script>
        <!--<script type="text/javascript" src="<?php print _MEDIA_URL ?>assets-minified/frontend-all-demo.js"></script>-->
        <!--****BotStrape JS OVER*****-->

        <!-- Data Tables -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/datatable/datatable.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/dropzone/dropzone.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/datatable/datatable-bootstrap.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/datatable/datatable-responsive.js"></script>

        <!--Multi select-->


        <!-- jQueryUI Autocomplete -->

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/autocomplete/autocomplete.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/autocomplete/menu.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/autocomplete/autocomplete-demo.js"></script>

        <!-- Touchspin -->

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/touchspin/touchspin.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/touchspin/touchspin-demo.js"></script>

        <!-- Input switch -->

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/input-switch/inputswitch.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/textarea/textarea.js"></script>

        <!-- Multiselect -->

        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/widgets/multi-select/multiselect.css">
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/multi-select/multiselect.js"></script>

        <!-- Uniform -->

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/uniform/uniform.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/uniform/uniform-demo.js"></script>

        <!-- Chosen -->

        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/chosen/chosen.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/widgets/chosen/chosen-demo.js"></script>

        <?php // generic script     ?>
        <?php include _PATH . 'instance/front/tpl/scripts.php'; ?>

        <!-- Custom JS-->
        <?php @include _PATH . 'instance/front/tpl/' . $jsInclude; ?>

        <!-- Start mouse movement code -->
        <script type="text/javascript">
            var countInactivityTime = 0;
            var setWarningPopup = 0;
            var refreshWithLogoutInactivity = 0;
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
                
                $(document).mousedown(function (e) {
                    setActivity("mousedown");
                });
                $(document).mouseup(function (e) {
                    setActivity("mouseup");
                });
                $(document).mousemove(function (e) {
                    setActivity("mousemove");
                });

                $(document).keypress(function (e) {
                    setActivity("keypress");
                });

                
            });
      

            setInterval(function () {
                countInactivityTime = parseInt(parseInt(countInactivityTime) + parseInt(1));
                         
<?php if (isset($_SESSION['user']) && _cg("url") != 'onboarding'): ?>
                    //880
                    if (parseInt(countInactivityTime) > 880) {
                                     
                        if (!$('#setWarningPopupModal').is(':visible')) {
                            $("#setWarningPopupModal").modal("show");       
                        }  
                    }   
                    //900 
                    if (parseInt(countInactivityTime) > 900) {    
                        refreshWithLogoutInactivity = 1;    
                        window.location.href = './?logout=1';      
                    }
<?php endif; ?>
            }, 1000);   
            
            function setActivity(type) {
                    countInactivityTime = 0;
                }
            
            function resetTimer(){
                
                countInactivityTime = 0; 
            }
        </script> 
        <!-- End mouse movement code -->
          <div id="setWarningPopupModal" class="modal fade" role="dialog">  
            <div class="modal-dialog"> 
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="alert alert-warning">you will be logged out in 20 seconds</div>
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal" onclick="resetTimer()">Close</button>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>   
        
        <script type="text/javascript">
          function changeLanguage(){
              var selectedLang = $("#changeLanguage").val();
               
               $.ajax({
                    url: '<?php echo _U ?>login',
                    dataType: "json",
                    async: false,
                    data: {
                        changeLanguage: 1,
                        setLanguage: selectedLang
                    }, success: function (r) {
                        console.log(r); 
                        window.location.reload(true); 
                        //window.location = window.location; 
                    }
                });  
              
              
          }
          
        </script>
    </body>
</html>