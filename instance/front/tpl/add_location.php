<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        var maxField = 15; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var addButtonArea = $('.add_area_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var wrapperArea = $('.field_wrapper_areas'); //Input field wrapper
        var fieldHTML = '<div id="remove_lan"><div class="col-sm-12"><div class="col-sm-3"><div class="col-sm-12"><div class="form-group"><div class="input-group"><div class="col-sm-12"><input id="name"  type="text" name="name[]" class="form-control form-radius"   placeholder="Name" required/></div></div></div></div></div><div class="col-sm-3"><div class="col-sm-12"><div class="form-group"><div class="input-group"><div class="col-sm-12"><input id="email"  type="text" name="email[]" class="form-control form-radius"   placeholder="(Optional)"/></div></div></div></div></div><div class="col-sm-3"><div class="col-sm-12"><div class="form-group"><div class="input-group"><div class="col-sm-12"><input id="phone_no"  type="text" name="phone_no[]" class="form-control form-radius"   placeholder="(Optional)"/></div></div></div></div></div><div class="col-sm-3"><div><a class="btn btn-link-danger remove remove_button" href="javascript:void(0);" title="Remove"><i class="fa fa-trash-o"></i></a></div></div></div>'; //New input field html 
        var fieldHTMLArea = '<div id="remove_lan_area"><div class="col-sm-12"><div class="col-sm-10"><div class="col-sm-12"><div class="form-group"><div class="input-group"><div class="col-sm-12"><input id="area"  type="text" name="area[]" class="form-control form-radius"   placeholder="e.g. Driver" required/></div></div></div></div></div><div class="col-sm-2"><div><a class="btn btn-link-danger remove remove_button_area" href="javascript:void(0);" title="Remove"><i class="fa fa-trash-o"></i></a></div></div></div>'; //New input field html 
        //var fieldHTML = '<div><input type="text" name="name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="<?php echo _U ?>instance/front/media/remove-icon.png"/></a></div>'; //New input field html 
        for (i = 0; i < 3; i++) {

            var x = 1; //Initial field counter is 1
            $(addButton).click(function () { //Once add button is clicked
                if (x < maxField) { //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); // Add field html
                }
            });
            $(addButtonArea).click(function () { //Once add button is clicked
                if (x < maxField) { //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapperArea).append(fieldHTMLArea); // Add field html
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
        $(wrapperArea).on('click', '.remove_button_area', function (e) { //Once remove button is clicked
            e.preventDefault();
            //$(this).closest(".test").fadeOut(10);
            $(this).closest('#remove_lan_area').remove();
            //$(this).parent('div').remove(); //Remove field html
            //$( ".test" ).remove();
            x--; //Decrement field counter
        });
    });
</script>
<script>
    function myFunction() {
        var option_value = document.getElementById("uplods_multiple").value;
        if (option_value == "EXCEL") {
            $("#UploadFileExcel").modal('show');
        } else if (option_value == "MYOB") {
            $("#MyOb").modal('show');
        } else if (option_value == "WAGEEASY") {
            $("#WageEasy").modal('show');
        } else {

        }
    }
</script>
<style>
    .form-radius{
        border: #c1c1c1 solid 1px;
        border-radius: 5px !important;
    }
    .parsley-success {
        border-color: #c1c1c1 !important;
    }
    .btn.btn-placeholder {
        width: 82%;
        border: 2px dashed #999;
        color: #999;
    }
    .no-touch .btn.btn-placeholder:hover, .no-touch .btn.btn-placeholder:focus, .btn.btn-placeholder:active, .btn.btn-placeholder.active {
        border-color: #3f3f3f;
        color: #3f3f3f;
    }
    .btn:hover, .btn:focus {
        text-decoration: none;
    }
    .btn.btn-link-danger {
        color: #f27272;
        font-weight: 600;
    }
    .btn.btn-link-danger:hover,.no-touch .btn.btn-link-danger:focus{
        color:white;
        background:#ff5252;
        border-color:#ff5252;
        text-shadow:none
    }

    .btn.btn-close, .btn.btn-close-small {
        border-color: #969a9e;
        float: right;
        font-size: 20px;
    }
</style>
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
    .background-color{
        background: #dfe2e6;
    }
    .background-color-white{
        background: white;
    }
    .on-break{
        /*    cursor: pointer;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            height: 23px;
            width: 38px;
            background-color: #e9e9e9;
            font-weight: bold;*/
        /* cursor: pointer; */cursor: pointer;
        /*border: 2px dashed transparent;*/
        border-radius: 50%;
        display: inline-block;
        position: relative;
        height: 40px;
        width: 40px;font-weight: bold;
        background-color: #e9e9e9;
        font-size: 14px;
        line-height: 35px;
    }
    .on-break-tab{
        /*        border-radius: 50%;
                height: 29px;
                width: 46px;
                background-color: #e9e9e9;
                font-weight: bold;
                font-size: 17px;
                margin-top: 4px;*/
        cursor: pointer;
        /*border: 2px dashed transparent;*/
        border-radius: 50%;
        display: inline-block;
        position: relative;
        height: 40px;
        width: 40px;font-weight: bold;
        background-color: #e9e9e9;
        font-size: 14px;
        line-height: 35px;
    }
    .filter-dropdown-menu {
        box-shadow: 0 1px 4px 1px rgba(0,0,0,0.2), 0 12px 24px rgba(0,0,0,0.24);
        border-radius: 4px;
        min-width: 0;
        margin-left: 0;
        margin-right: 0;
        max-height: 90vh;
        overflow-y: auto;
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
    }
    /*    .also-show-dropdown-menu{
            box-shadow: 0 1px 4px 1px rgba(0,0,0,0.2), 0 12px 24px rgba(0,0,0,0.24);border-radius: 4px;
            overflow-y: auto;
            overflow-x: hidden;
        }*/
    label{
        font-weight: inherit;
        margin-bottom: 12px;
    }

    .form-radius{
        border: #c1c1c1 solid 1px;
        border-radius: 5px !important;
    }
    .gray{
        color: black;
        font-weight: bold;
    }
    .lbl-text-align{
        text-align: right;
    }
    .dropdown-menu li > a:hover {
        border-top: 1px solid rgba(10, 10, 10, 0.36);
        border-bottom: 1px solid rgba(10, 10, 10, 0.36);
    }
    .dropdown-menu>li.clean-slate, .dropdown-menu>li>* {
        border-top: 1px solid transparent;
        border-bottom: 1px solid transparent;
    }
</style>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        /*border: 1px solid #dddddd;*/
        text-align: left;
        padding: 8px;
    }
    .tb-none{
        display: none;
        /*width:  10%;*/
    }
    .tb-sub{
        width: 10%;
    }
    .tb-th{
        width: 10%;
    }

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
    .m-step{
        alignment-baseline: central;
        align-content: space-between;
        float: left ;
        cursor: pointer;
        border: 2px solid threedhighlight;
        border-radius: 50%;
        display: inline-block;
        background-color: #e9e9e9;
        text-align: center;
        position: relative;height: 60px;width:60px;
    }
</style>
<style>
    /* -------------------------------- 

Main Components 

-------------------------------- */

    .cd-horizontal-timeline {
        opacity: 0;
        -webkit-transition: opacity 0.2s;
        -moz-transition: opacity 0.2s;
        transition: opacity 0.2s;
        font-family: "Fira Sans", sans-serif;
        color: blue;
        background-color: #f8f8f8;
        line-height: 1;
        font-size: 14px;
        box-sizing: border-box;
        margin: 2px auto;
    }

    .cd-horizontal-timeline * {
        box-sizing: border-box;
    }

    .cd-horizontal-timeline *::after {
        box-sizing: border-box;
    }

    .cd-horizontal-timeline *::before {
        box-sizing: border-box;
    }

    .cd-horizontal-timeline ol {
        list-style: none;
        margin-top: 1em;
    }

    .cd-horizontal-timeline ul {
        list-style: none;
    }

    .cd-horizontal-timeline::before {
        content: 'mobile';
        display: none;
    }

    .cd-horizontal-timeline .timeline {
        position: relative;
        height: 100px;
        width: 90%;
        max-width: 800px;
        margin: 0 auto;
    }

    .cd-horizontal-timeline .events-wrapper {
        position: relative;
        height: 100%;
        margin: 0 40px;
        overflow: hidden;
    }

    .cd-horizontal-timeline .events-wrapper::after {
        content: '';
        position: absolute;
        z-index: 2;
        top: 0;
        height: 100%;
        width: 20px;
        right: 0;
        background-image: -webkit-linear-gradient(right, #f8f8f8, rgba(248, 248, 248, 0));
        background-image: linear-gradient(to left, #f8f8f8, rgba(248, 248, 248, 0));
    }

    .cd-horizontal-timeline .events-wrapper::before {
        content: '';
        position: absolute;
        z-index: 2;
        top: 0;
        height: 100%;
        width: 20px;
        left: 0;
        background-image: -webkit-linear-gradient(left, #f8f8f8, rgba(248, 248, 248, 0));
        background-image: linear-gradient(to right, #f8f8f8, rgba(248, 248, 248, 0));
    }

    .cd-horizontal-timeline .events {
        position: absolute;
        z-index: 1;
        left: 0;
        top: 49px;
        height: 2px;
        background: #c2c2c2;
        -webkit-transition: -webkit-transform 0.4s;
        -moz-transition: -moz-transform 0.4s;
        transition: transform 0.4s;
    }

    .cd-horizontal-timeline .events a {
        position: absolute;
        z-index: 2;
        text-align: center;
        font-size: 13px;
        padding-bottom: 15px;
        color: #383838;
        text-decoration: none;
        -webkit-transform: translateZ(0);
        -moz-transform: translateZ(0);
        -ms-transform: translateZ(0);
        -o-transform: translateZ(0);
        transform: translateZ(0);
    }

    .cd-horizontal-timeline .events a::after {
        content: '';
        position: absolute;
        left: 50%;
        right: auto;
        -webkit-transform: translateX(-50%);
        -moz-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        -o-transform: translateX(-50%);
        transform: translateX(-50%);
        bottom: 29px;
        height: 30px;
        width: 30px;
        border-radius: 50%;
        border: 2px solid #55606e;
        background-color: #c2c2c2;
        -webkit-transition: background-color 0.3s, border-color 0.3s;
        -moz-transition: background-color 0.3s, border-color 0.3s;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .cd-horizontal-timeline .events a::before {
        content: attr(data-index);
        position: absolute;
        left: 50%;
        right: auto;
        -webkit-transform: translateX(-50%);
        -moz-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        -o-transform: translateX(-50%);
        transform: translateX(-50%);
        bottom: 21px;
        height: 30px;
        width: 30px;
        border-radius: 50%;
        z-index: 3;
        color: #fff;
    }

    .cd-horizontal-timeline .events a.active {
        pointer-events: none;
    }

    .cd-horizontal-timeline .events a.active::after {
        background-color: #0091d9;
        border-color: #55606e;
    }

    .cd-horizontal-timeline .events a.complete.active::after {
        background-color: #0091d9;
        border-color: #55606e;
    }

    .cd-horizontal-timeline .events a.complete::after {
        background-color: #89ad45;
        border-color: #55606e;
    }

    .cd-horizontal-timeline .events a.older-event::after {
        border-color: #55606e;
    }

    .cd-horizontal-timeline .filling-line {
        position: absolute;
        z-index: 1;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        background-color: #55606e;
        -webkit-transform: scaleX(0);
        -moz-transform: scaleX(0);
        -ms-transform: scaleX(0);
        -o-transform: scaleX(0);
        transform: scaleX(0);
        -webkit-transform-origin: left center;
        -moz-transform-origin: left center;
        -ms-transform-origin: left center;
        -o-transform-origin: left center;
        transform-origin: left center;
        -webkit-transition: -webkit-transform 0.3s;
        -moz-transition: -moz-transform 0.3s;
        transition: transform 0.3s;
    }

    .cd-horizontal-timeline.loaded {
        opacity: 1;
    }

    .no-touch .cd-horizontal-timeline .events a:hover::after {
        background-color: #0091d9;
        border-color: #55606e;
    }

    .no-touch .cd-timeline-navigation a:hover {
        border-color: #55606e;
    }

    .no-touch .cd-timeline-navigation a.inactive:hover {
        border-color: #0000FF;
    }

    .cd-timeline-navigation a {
        position: absolute;
        z-index: 1;
        top: 50%;
        bottom: auto;
        -webkit-transform: translateY(-50%);
        -moz-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        -o-transform: translateY(-50%);
        transform: translateY(-50%);
        height: 34px;
        width: 34px;
        border-radius: 50%;
        border: 2px solid #dfdfdf;
        overflow: hidden;
        color: transparent;
        text-indent: 100%;
        white-space: nowrap;
        -webkit-transition: border-color 0.3s;
        -moz-transition: border-color 0.3s;
        transition: border-color 0.3s;
        color: #7b9d6f;
        text-decoration: none;
    }

    .cd-timeline-navigation a::after {
        content: '';
        position: absolute;
        height: 16px;
        width: 16px;
        left: 50%;
        top: 50%;
        bottom: auto;
        right: auto;
        -webkit-transform: translateX(-50%) translateY(-50%);
        -moz-transform: translateX(-50%) translateY(-50%);
        -ms-transform: translateX(-50%) translateY(-50%);
        -o-transform: translateX(-50%) translateY(-50%);
        transform: translateX(-50%) translateY(-50%);
        background: url(/img/cd-arrow.svg) no-repeat 0 0;
    }

    .cd-timeline-navigation a.prev {
        left: 0;
        -webkit-transform: translateY(-50%) rotate(180deg);
        -moz-transform: translateY(-50%) rotate(180deg);
        -ms-transform: translateY(-50%) rotate(180deg);
        -o-transform: translateY(-50%) rotate(180deg);
        transform: translateY(-50%) rotate(180deg);
    }

    .cd-timeline-navigation a.next {
        right: 0;
    }

    .cd-timeline-navigation a.inactive {
        cursor: not-allowed;
    }

    .cd-timeline-navigation a.inactive::after {
        background-position: 0 -16px;
    }

    @media only screen and (min-width: 1100px) {
        .cd-horizontal-timeline::before {
            content: 'desktop';
        }
    }

</style>
<div class="panel" style="margin:0px 18%; ">
    <div class="panel-body">
        <h1>Add New Location</h1>
        <div id="lat"></div>
        <div id="long"></div>
        <div class="col-lg-12" style="text-align: center;align-content: space-between">
            <section id="cd-horizontal-timeline"></section>

        </div>

        <div class="panel-body">
            <form action="add_location" id="add_location" method="POST" >
                <div id="nav1" class="navdiv" >
                    <div class="col-lg-12"><p>Where is this Location? Providing accurate location information will help you manage your scheduling and timesheets later on.</p></div>

                    <div class="col-lg-6">

                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-12" for="locName">Location Name:</label>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <input type="text" class="form-control" value="" name="locName" id="locName" placeholder="e.g Sydney Store, Supply Warehouse" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-12" for="locAddress">Location Address:</label>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <input type="text" class="form-control" value="" name="locAddress" id="locAddress" placeholder="e.g Street, City, Country" required="" onchange="codeAddress()">
                                    <input type="hidden" class="form-control" value="" name="latlang" id="latlang" placeholder="e.g Street, City, Country" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label class="control-label col-sm-12" for="locWeekStart">This Location Week Start On:</label>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <select class="form-control chosen-select" name="locWeekStart" id="locWeekStart">
                                        <option value="Mon">Mon</option>
                                        <option value="Tue">Tue</option>
                                        <option value="Wed">Wed</option>
                                        <option value="Thu">Thu</option>
                                        <option value="Fri">Fri</option>
                                        <option value="Sat" selected>Sat</option>
                                        <option value="Sun">Sun</option>
                                    </select>
                                    <!--<input type="text" class="form-control" value="<?php echo $ProfileData['lname']; ?>" name="locWeekStart" id="locWeekStart" placeholder="e.g Street, City, Country" required="">-->
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" value="Asia/Tehran" name="locTimeZone" id="locTimeZone" >
                       
                    </div>
                    <div class="col-lg-6" style="min-height: 320px;text-align: center;align-content: space-between">
                        <div id="map" style="min-height: 300px;min-width: 90%;">

                        </div>
                    </div>
                    <div class="form-group" style="text-align: right;align-content: flex-end;">        
                        <div class="col-sm-offset-8 col-sm-4 col-lg-4" style="">
                            <a class="btn btn-default" type="reset" href="<?php l("location"); ?>" >Back</a>
                            <button class="btn btn-primary" type="button" name="submit" id="submit" onclick="changeToggle(2)">Next</button>
                            <!--<button style="color: white;background-color: #2196F3;height: 40px;width: 200px;" type="submit" class="btn btn-default">Save</button>-->
                        </div>
                    </div>
                </div>
                <div id="nav2" class="navdiv" style="text-align: left;">
                    <div class="col-lg-12"><p> <div class="col-lg-12"><p>People are scheduled to Areas of Work. These may be roles, physical areas, customer names - anywhere people perform work at. You'll need at least one to start scheduling or to clock on/off.</p></div></p></div>

                    <div class="field_wrapper_areas">
                        <div class="col-sm-12">
                            <div class="col-sm-10">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class="col-sm-12 control-label lbl-text-align" >Area Of Work</label>
                                            <div class="col-sm-12">
                                                <input id="area"  type="text" name="area[]" class="form-control form-radius"   placeholder="e.g. Driver" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12" style="margin-top: 5px;">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <a href="javascript:void(0);" class="add_area_button btn btn-placeholder" title="Add field" style="width: 100%;">
                                        <i class="fa fa-plus"></i>Add More Areas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12" style="margin-top: 50px;">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6" align="right" style="text-align: right;align-content: flex-end;">
                            <button class="btn btn-default" type="button" onclick="changeToggle(1)">Back</button>
                            <button class="btn btn-primary" type="button" onclick="changeToggle(3)">Next</button>
                            <input id="add_work" type="hidden" name="Add_work" value="1"/>
                        </div>
                    </div>
                </div>
                <div id="nav3" class="navdiv" >
                    <div class="col-lg-12"><p> <div class="col-lg-12"><p>Please select your accounting software below</p></div></p></div>

                    <div class="col-sm-12" style="padding: 1rem;">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="col-sm-12">
                                    <select name="uplods_multiple" id="uplods_multiple" data-placeholder="Import or Upload a file" placeholder="Import or Upload a file" class="browser-default chosen-select form-control" style="width:100%" onchange = "myFunction()">
                                        <option value="Sepidar" data-service="XR" data-image="xero.png">Sepidar</option>
                                        <option value="Hamkaran" data-service="ADP" data-image="adp.png">Hamkaran</option>
                                        <option value="Hulu" data-service="QB" data-image="qb.png">Hulu</option>
                                        <option value="Parmis" data-service="NS" data-image="ns.png">Parmis</option>
                                        <option value="Aryan" data-service="ZP" data-image="zp.png">Aryan</option>

                                        <!--                                        <option value="XR" data-service="XR" data-image="xero.png">Xero Payroll</option>
                                                                                <option value="ADP" data-service="ADP" data-image="adp.png">ADP</option>
                                                                                <option value="QB" data-service="QB" data-image="qb.png">Quickbooks</option>
                                                                                <option value="NS" data-service="NS" data-image="ns.png">NetSuite</option>
                                                                                <option value="ZP" data-service="ZP" data-image="zp.png">Gusto</option>
                                                                                <option value="MO" data-service="MO" data-image="mo.png">MYOB AccountRight</option>
                                                                                <option value="MYOB" data-service="MYOB" data-image="myob.png">MYOB</option>
                                                                                <option value="WAGEEASY" data-service="WAGEEASY" data-image="wageeasy.png">WageEasy</option>
                                                                                <option value="EXCEL" data-service="EXCEL" data-image="excel.png">Excel</option>-->
                                    </select>
                                    <!--<option value="XR" style="background-image:url(instance/front/media/people_multi_image/xr.png);">Xero Payroll</option>-->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--                    <div class="col-sm-12">
                                            <div class="col-lg-12 col-sm-12 ">
                                                <hr/>
                                            </div>
                                            <div class="col-lg-1 col-sm-12 " style="margin-left: -49%;margin-top: 11px;">
                                                OR
                                            </div>
                                        </div>
                                        <div class="field_wrapper">
                                            <div class="col-sm-12">
                                                <div class="col-sm-3">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <label for="" class="col-sm-12 control-label lbl-text-align" >Name</label>
                                                                <div class="col-sm-12">
                                                                    <input id="name"  type="text" name="name[]" class="form-control form-radius"   placeholder="Name" required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <label for="" class="col-sm-12 control-label lbl-text-align" >Email</label>
                                                                <div class="col-sm-12">
                                                                    <input id="email"  type="text" name="email[]" class="form-control form-radius"   placeholder="(Optional)"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <label for="" class="col-sm-12 control-label lbl-text-align" >Phone Number</label>
                                                                <div class="col-sm-12">
                                                                    <input id="phone_no"  type="text" name="phone_no[]" class="form-control form-radius"   placeholder="(Optional)"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12" style="margin-top: 5px;">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <a href="javascript:void(0);" class="add_button btn btn-placeholder" title="Add field" style="width: 100%;">
                                                            <i class="fa fa-plus"></i>Add More People
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                    
                                        </div>-->



                    <div class="col-sm-12" style="margin-top: 50px;">
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-5 control-label lbl-text-align" >Send Invitation Email [?]</label>
                                        <div class="col-sm-6">
                                            <input  type="checkbox" data-on-color="success" name="send_invitation" class="input-switch" checked="" data-size="medium" data-on-text="On" data-off-text="Off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6" align="right" style="text-align: right;align-content: flex-end;">
                            <button class="btn btn-default" type="button" onclick="changeToggle(2)">Back</button>
                            <button class="btn btn-primary" type="button" onclick="finishCall()">Finish</button>
                            <input id="add_people" type="hidden" name="Add_multiple_people" value="1"/>
                        </div>

                    </div>

                </div>
                <div id="nav4" class="navdiv">
                    <!--NAV4-->
                </div>
            </form>
        </div>

    </div>
</div>

