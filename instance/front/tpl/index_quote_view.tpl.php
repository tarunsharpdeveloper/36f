<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="_nK">
        <link rel="icon" href="<?php print _MEDIA_URL ?>images/WHOZOORLogoSmall.png">

        <title>WHOZOOR Proposal | <?php print _cg("page_title"); ?></title>

        <!--<link href='http://fonts.googleapis.com/css?family=Lato:400,100,300,500,700,900' rel='stylesheet' type='text/css'>-->
        <!--<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">--> 
        <!-- Clockpicker -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/clockpicker/dist/jquery-clockpicker.min.css" />
        <!-- MarkItUp -->
<!--        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/markitup-1x/markitup/sets/default/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/markitup-1x/markitup/skins/simple/style.css" />
        -->
        <!-- nanoScroller -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/nanoscroller/bin/css/nanoscroller.css" />

        <!-- FontAwesome -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/fontawesome/css/font-awesome.min.css" />

        <!-- Materialt" type="text/css" href="<?php print _MEDIA_URL ?>bower_components Design Icons -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/material-design-icons/css/material-design-icons.min.css" />

        <!-- IonIcons -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/ionicons/css/ionicons.min.css" />

        <!-- WeatherIcons -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/weather-icons/css/weather-icons.min.css" />

        <!-- Rickshaw -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/rickshaw/rickshaw.min.css" />

        <!-- nvd3 -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>bower_components/nvd3/build/nv.d3.min.css" />

        <!-- jvectormap -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/jquery-jvectormap/jquery-jvectormap.css" />
        <!-- select2-->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/_con/select2/select2.min.css" />

        <!-- Main -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/_con/css/con-base.css?t=<?php print rand() ?>" />
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/lz.css?t=<?php print rand() ?>" />
        <!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/_con/css/con-green.css" />-->


        <!-- Squire -->
        <link href="<?php print _MEDIA_URL ?>assets/_con/squire/squire-ui.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Glegoo" rel="stylesheet"> 
        <style>
            html {
                font-family: 'Glegoo', serif;
                /*font-weight: 400;*/
            }
        </style>
        <!--[if lt IE 9]>
            <script src="<?php print _MEDIA_URL ?>bower_components/html5shiv/dist/html5shiv.min.js"></script>
        <![endif]-->
    </head>
    <!--
      Body
        Options:
          .boxed - boxed layout for content
    -->

    <body>
        <?php if (!_isLocalMachine()): ?>
            <script type="text/javascript" src="https://hubmost.atlassian.net/s/d41d8cd98f00b204e9800998ecf8427e-T/ct4jhl/100016/c/1000.0.10/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=bcb25529"></script>
        <?php endif; ?>
        <?php if ($no_visible_elements != 1) { ?>

            <!-- Main Content -->
            <section class="content-wrap" style="margin-left:0px !important;margin-top:-80px;">
                <?php //include _PATH . 'instance/front/tpl/breadcrumb.php'; ?>

                <?php
                if (!include _PATH . 'instance/front/tpl/' . $modulePage) {
                    include _PATH . 'instance/front/tpl/404.php';
                }
                ?>

            </section>
            <!-- /Main Content -->
        <?php } else { ?>
            <?php include _PATH . 'instance/front/tpl/' . $modulePage ?>
        <?php } ?>


        <!--        <footer>
        <?php print date("Y") ?> <strong>WHOZOOR</strong>. All rights reserved.
                </footer>-->

        <!-- CKeditor -->
<!--        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/ckeditor/adapters/jquery.js"></script>-->

        <!-- MarkItUp -->
<!--        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/markitup-1x/markitup/jquery.markitup.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/markitup-1x/markitup/sets/default/set.js"></script>-->


        <!-- jQuery -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/jquery/dist/jquery.min.js"></script>

        <!-- jQuery RAF (improved animation performance) -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/jquery-requestAnimationFrame/dist/jquery.requestAnimationFrame.min.js"></script>
        <!-- Clockpicker -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/clockpicker/dist/jquery-clockpicker.min.js"></script>

        <!-- nanoScroller -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/nanoscroller/bin/javascripts/jquery.nanoscroller.min.js"></script>

        <!-- Materialize -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/materialize/bin/materialize.js"></script>

        <!-- Simple Weather -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>

        <!-- Sparkline -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/jquery.sparkline/dist/jquery.sparkline.min.js"></script>

        <!-- Flot -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/flot/jquery.flot.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/flot/jquery.flot.time.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/flot/jquery.flot.pie.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/flot/jquery.flot.categories.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>

        <!-- d3 -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/d3/d3.min.js"></script>

        <!-- nvd3 -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/nvd3/build/nv.d3.min.js"></script>

        <!-- Rickshaw -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/rickshaw/rickshaw.min.js"></script>

        <!-- jvectormap -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/jquery-jvectormap/jquery-jvectormap.min.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/jquery-jvectormap/gdp-data.js"></script>

        <!-- Sortable -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/Sortable/Sortable.min.js"></script>

        <!-- Main -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/_con/js/_con.js"></script>

        <!-- Google Prettify -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/code-prettify/src/prettify.js"></script>
        <!-- Squire -->
        <script src="<?php print _MEDIA_URL ?>bower_components/squire/build/squire.js" type="text/javascript"></script>
        <script src="<?php print _MEDIA_URL ?>assets/_con/squire/squire-ui.js" type="text/javascript"></script>


        <!-- Parsley (validation) -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/parsleyjs/dist/parsley.min.js"></script>
        <!-- Drop Zone -->



        <!-- Data Tables -->
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/datatables-tabletools/js/dataTables.tableTools.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/datatables-scroller/js/dataTables.scroller.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>assets/_con/select2/select2.full.min.js"></script>
        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>

        <?php // generic script ?>
        <?php include _PATH . 'instance/front/tpl/scripts.php'; ?>

        <!-- Custom JS-->
        <?php @include _PATH . 'instance/front/tpl/' . $jsInclude; ?>
    </body>
</html>