
<html lang="en" class="<?= $rtl; ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="_nK">
        <link rel="icon" href="<?php print _MEDIA_URL ?>images/Whozoor-logo.png">
        <title>Whozoor | <?php print _cg("page_title"); ?></title>
        <!-- Main -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/_con/css/con-base.css?t=<?php print rand() ?>" />
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/lz.css?t=<?php print rand() ?>" />

<!--<link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>assets/_con/css/con-green.css" />-->


        <!-- Squire -->
        <link href="<?php print _MEDIA_URL ?>assets/_con/squire/squire-ui.css" rel="stylesheet" type="text/css" />
        <!--<link href="https://fonts.googleapis.com/css?family=Glegoo" rel="stylesheet"> -->
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>/css/custom.css" />
        <style>
            html {
                font-family: tahoma;
                /*font-weight: 400;*/
                color:#388e3c;
            }
        </style>

        <?php if ($_SESSION['selected_lang'] == 'fa'): ?>
            <link href="https://fonts.googleapis.com/css?family=Amiri" rel="stylesheet"> 
            <style>
                html {
                    font-family: 'Amiri', serif;
                    /*font-weight: 400;*/
                    color:#388e3c;
                }
            </style>    
        <?php endif; ?>

        <!--[if lt IE 9]>
            <script src="<?php print _MEDIA_URL ?>bower_components/html5shiv/dist/html5shiv.min.js"></script>
        <![endif]-->
        <!--<link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css" />-->

        <style type="text/css">
            .card-panel, .collapsible-header, select,.card{
                background-color: <?php print isset($_REQUEST['user_type']) && $_REQUEST['user_type'] == '2' ? " #fbe9e7" : "#f1f8e9"  ?>; 
            }
        </style>
    </head>
    <!--
      Body
        Options:
          .boxed - boxed layout for content
    -->

    <body>


        <script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/jquery/dist/jquery.min.js"></script>
        <!--<script src="js/jquery-ui-1.10.3.custom.min.js"></script>-->
        <!-- jQuery RAF (improved animation performance) -->






        <div id="page-message" class="panel-body center-div">
            <!--            <h2>404</h2>
            -->
            <h2 class="header-fixed">404 </h2> <h3>"SITE IS UNDER DEVELOPMENT!"</h3> 

        </div>





    </body>

</html>
