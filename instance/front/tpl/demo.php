<script type="text/javascript">
//  $(function () {
//        var dateText = '12/20/2015',
//                display = $('#week-start');
//        display.text(dateText);
//
//        $('#weekpicker').weekpicker({
//            currentText: dateText,
//            onSelect: function (dateText, startDateText, startDate, endDate, inst) {
//                display.text(startDateText);
//            }
//        });
//    });

    /* Datatables responsive */

    $(document).ready(function () {
        $('#datatable-responsive').DataTable({
            responsive: true
        });


    });

    $(document).ready(function () {
        $('.dataTables_filter input').attr("placeholder", "Search...");
    });

</script>

<script type="text/javascript">
    /* Datepicker bootstrap */
    $(document).ready(function () {

        $(function () {
            "use strict";
            $('.bootstrap-datepicker').bsdatepicker({
                format: 'MM-DD-YYYY'
            });
        });
//        alert(value);
//        $('#bootstrap-datepicker').on('change', function (e) {
//            value = $("#bootstrap-datepicker").val();
//            alert(value);
//            firstDate = moment(value, "MM-DD-YYYY").day(0).format("MM-DD-YYYY");
//            lastDate = moment(value, "MM-DD-YYYY").day(6).format("MM-DD-YYYY");
//            $("#bootstrap-datepicker").val(firstDate + "   -   " + lastDate);
//        });
    });

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP0smSL_Rs9pG4miCHjoAf-ILRHSsnbPo">
</script>
<div class="panel">
    <div class="panel-body">
        <div id="map" style="width: 60%;"></div>

    </div>
</div>
<script>
    // This example displays a map with the language and region set
    // to Japan. These settings are specified in the HTML script element
    // when loading the Google Maps JavaScript API.
    // Setting the language shows the map in the language of your choice.
    // Setting the region biases the geocoding results to that region.
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: {lat: 35.717, lng: 139.731}
        });
    }
</script>

<!--
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP0smSL_Rs9pG4miCHjoAf-ILRHSsnbPo&language=fa&region=IR">-->
<!--</script>-->
<div class="panel">
    <div class="panel-body">
        <div class="col-lg-6">FIRST COL</div>
        <div class="col-lg-6">SECOUND COL</div>
        <div class="col-lg-6">
            <div class="dropdown">

                <a data-toggle="dropdown" href="#" title="">
                    <span class="bs-badge badge-absolute bg-orange">5</span>
                    <i class="glyph-icon icon-globe" style="font-size: 18px;"></i>
                </a>
                <div class="dropdown-menu">

                    <div class="popover-title display-block clearfix pad10A">
                        Notifications
                    </div>
                    <div class="scrollable-content scrollable-nice box-md scrollable-small">

                        <ul class="no-border notifications-box">
                            <li>
                                <span class="bg-danger icon-notification glyph-icon icon-bullhorn"></span>
                                <span class="notification-text">This is an error notification</span>
                                <div class="notification-time">
                                    a few seconds ago
                                    <span class="glyph-icon icon-clock-o"></span>
                                </div>
                            </li>
                            <li>
                                <span class="bg-warning icon-notification glyph-icon icon-users"></span>
                                <span class="notification-text font-blue">This is a warning notification</span>
                                <div class="notification-time">
                                    <b>15</b> minutes ago
                                    <span class="glyph-icon icon-clock-o"></span>
                                </div>
                            </li>
                            <li>
                                <span class="bg-green icon-notification glyph-icon icon-sitemap"></span>
                                <span class="notification-text font-green">A success message example.</span>
                                <div class="notification-time">
                                    <b>2 hours</b> ago
                                    <span class="glyph-icon icon-clock-o"></span>
                                </div>
                            </li>
                            <li>
                                <span class="bg-azure icon-notification glyph-icon icon-random"></span>
                                <span class="notification-text">This is an error notification</span>
                                <div class="notification-time">
                                    a few seconds ago
                                    <span class="glyph-icon icon-clock-o"></span>
                                </div>
                            </li>
                            <li>
                                <span class="bg-warning icon-notification glyph-icon icon-ticket"></span>
                                <span class="notification-text">This is a warning notification</span>
                                <div class="notification-time">
                                    <b>15</b> minutes ago
                                    <span class="glyph-icon icon-clock-o"></span>
                                </div>
                            </li>
                            <li>
                                <span class="bg-blue icon-notification glyph-icon icon-user"></span>
                                <span class="notification-text font-blue">Alternate notification styling.</span>
                                <div class="notification-time">
                                    <b>2 hours</b> ago
                                    <span class="glyph-icon icon-clock-o"></span>
                                </div>
                            </li>
                            <li>
                                <span class="bg-purple icon-notification glyph-icon icon-user"></span>
                                <span class="notification-text">This is an error notification</span>
                                <div class="notification-time">
                                    a few seconds ago
                                    <span class="glyph-icon icon-clock-o"></span>
                                </div>
                            </li>
                            <li>
                                <span class="bg-warning icon-notification glyph-icon icon-user"></span>
                                <span class="notification-text">This is a warning notification</span>
                                <div class="notification-time">
                                    <b>15</b> minutes ago
                                    <span class="glyph-icon icon-clock-o"></span>
                                </div>
                            </li>
                            <li>
                                <span class="bg-green icon-notification glyph-icon icon-user"></span>
                                <span class="notification-text font-green">A success message example.</span>
                                <div class="notification-time">
                                    <b>2 hours</b> ago
                                    <span class="glyph-icon icon-clock-o"></span>
                                </div>
                            </li>
                            <li>
                                <span class="bg-purple icon-notification glyph-icon icon-user"></span>
                                <span class="notification-text">This is an error notification</span>
                                <div class="notification-time">
                                    a few seconds ago
                                    <span class="glyph-icon icon-clock-o"></span>
                                </div>
                            </li>
                            <li>
                                <span class="bg-warning icon-notification glyph-icon icon-user"></span>
                                <span class="notification-text">This is a warning notification</span>
                                <div class="notification-time">
                                    <b>15</b> minutes ago
                                    <span class="glyph-icon icon-clock-o"></span>
                                </div>
                            </li>
                        </ul>

                    </div>
                    <div class="pad10A button-pane button-pane-alt text-center">
                        <a href="#" class="btn btn-primary" title="View all notifications">
                            View all notifications
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Chosen multiselect</label>
    <div class="col-sm-6">
        <select name="" multiple data-placeholder="Click to see available options..." class="chosen-select">
            <optgroup label="Option group 1">
                <option>Option 1</option>
                <option>Option 2</option>
                <option>Option 3</option>
                <option>Option 4</option>
            </optgroup>
            <optgroup label="Option group 2">
                <option>Option 5</option>
                <option>Option 6</option>
                <option>Option 7</option>
                <option>Option 8</option>
            </optgroup>
            <optgroup label="Option group 3">
                <option>Option 9</option>
                <option>Option 10</option>
                <option>Option 11</option>
                <option>Option 12</option>
            </optgroup>
        </select>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-3 control-label">Chosen multiselect</label>
            <div class="col-sm-6">
                <select name="" multiple data-placeholder="Click to see available options..." class="chosen-select">
                    <optgroup label="Option group 1">
                        <option>Option 1</option>
                        <option>Option 2</option>
                        <option>Option 3</option>
                        <option>Option 4</option>
                    </optgroup>
                    <optgroup label="Option group 2">
                        <option>Option 5</option>
                        <option>Option 6</option>
                        <option>Option 7</option>
                        <option>Option 8</option>
                    </optgroup>
                    <optgroup label="Option group 3">
                        <option>Option 9</option>
                        <option>Option 10</option>
                        <option>Option 11</option>
                        <option>Option 12</option>
                    </optgroup>
                </select>
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <br/>
        <select>
            <option>

            <option>1</option>
            <option>2</option>
            <option>3</option>


            </option>
            <option>2</option>
            <option>3</option>
        </select>
        <h3 class="title-hero">
            Horizontal list tabs menu
        </h3>
        <div class="example-box-wrapper">
            <div class="col-lg-4"><?= date(); ?></div>
            <div class="col-lg-4"> 
                <ul class="list-group list-group-separator row list-group-icons">
                    <li class="col-md-4 active">
                        <a href="#tab-example1" data-toggle="tab" class="list-group-item">
                            <!--<i class="glyph-icon font-red icon-bullhorn"></i>-->
                            Timesheet
                        </a>
                    </li>
                    <li class="col-md-4 ">
                        <a href="#tab-example-2" data-toggle="tab" class="list-group-item">
                            <!--<i class="glyph-icon icon-dashboard"></i>-->
                            History
                        </a>
                    </li>
                    <li class="col-md-4">
                        <a href="#tab-example-3" data-toggle="tab" class="list-group-item">
                            <!--<i class="glyph-icon font-primary icon-camera"></i>-->
                            Comments
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4"></div>
            <div class="" style="clear: both;"></div>

            <div class="tab-content">
                <div class="tab-pane fade active in" id="tab-example-1">
                    <p>Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                </div>
                <div class="tab-pane fade" id="tab-example-2">
                    <p> Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                </div>
                <div class="tab-pane fade" id="tab-example-3">
                    <p>Commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown.</p>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
        <div class="">Week starting: <b id="week-start"></b></div>
        <div id="weekpicker"></div>

        <?php
//        echo date("l d m Y, N D", strtotime("2011-03-29"));
        $current_day = date("d");
        $date = date("d", strtotime("2011-03-29"));
        $month = date("m", strtotime("2011-03-29"));
        $year = date("Y", strtotime("2011-03-29"));
        $totday = date("t", strtotime("2011-03-29"));
        $d = cal_days_in_month(CAL_GREGORIAN, 2, 2017);

        echo "<br>There was $d days in February 2017.<br>";
        ?>

        <style>
            .ui-datepicker-calendar tr:hover{
                background-color: #00CEB4;

            }
        </style>

        <h3 class="title-hero">
            Basic
        </h3>
        <div class="example-box-wrapper row">
            <div id="calendar-example-1" class="col-md-10 center-margin"></div>
        </div>
        <div class="col-sm-12 col-lg-6">

            <div class="form-group">
                <!--<div class="input-group">-->

                <label for="" class="col-sm-4 col-xs-4 control-label" style="line-height: 30px;">All Day</label>

                <div class="col-sm-8 col-xs-8">
                    <div class="input-prepend input-group">
                        <span class="add-on input-group-addon">
                            <i class="glyph-icon icon-calendar"></i>
                        </span>
                        <input type="text" class=" form-control datepicker"  value="02/2012" data-date-format="mm/dd/yyyy">
                    </div>
                </div>
                <!--                                    <div class="btn-group col-lg-3 col-xs-12 col-sm-3" data-toggle="buttons" style="float: right;">
                                                        <a href="#" class="btn btn-default btn-sm">
                                                            <input type="radio" name="start_day">
                                                            No
                                                        </a>
                                                        <a href="#" class="btn btn-default btn-sm">
                                                            <input type="radio" name="start_day">
                                                            Yes
                                                        </a>
                                                    </div>-->


                <!--</div>-->
            </div>
        </div>
    </div>
</div>
<div class="panel">
    <div class="panel-body">

        <h3 class="title-hero">
            Responsive data tables
        </h3>
        <div class="example-box-wrapper">

            <label class="switch">
                <input type="checkbox">
                <div class="slider round"></div>
            </label>
            <table id="datatable-responsive" class="table table-striped table-bordered responsive no-wrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </tfoot>

                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
        <div class="container"><h1>Bootstrap  tab panel example (using nav-pills)  </h1></div>
        <div id="exTab1" class="container">	
            <ul  class="nav nav-pills">
                <li class="active">
                    <a  href="#1a" data-toggle="tab">Overview</a>
                </li>
                <li><a href="#2a" data-toggle="tab">Using nav-pills</a>
                </li>
                <li><a href="#3a" data-toggle="tab">Applying clearfix</a>
                </li>
                <li><a href="#4a" data-toggle="tab">Background color</a>
                </li>
            </ul>

            <div class="tab-content clearfix">
                <div class="tab-pane active" id="1a">
                    <h3>Content's background color is the same for the tab</h3>
                </div>
                <div class="tab-pane" id="2a">
                    <h3>We use the class nav-pills instead of nav-tabs which automatically creates a background color for the tab</h3>
                </div>
                <div class="tab-pane" id="3a">
                    <h3>We applied clearfix to the tab-content to rid of the gap between the tab and the content</h3>
                </div>
                <div class="tab-pane" id="4a">
                    <h3>We use css to change the background color of the content to be equal to the tab</h3>
                </div>
            </div>
        </div>


        <hr></hr>
        <div class="container"><h2>Example tab 2 (using standard nav-tabs)</h2></div>

        <div id="exTab2" class="container">	
            <ul class="nav nav-tabs">
                <li class="active">
                    <a  href="#1" data-toggle="tab">Overview</a>
                </li>
                <li><a href="#2" data-toggle="tab">Without clearfix</a>
                </li>
                <li><a href="#3" data-toggle="tab">Solution</a>
                </li>
            </ul>

            <div class="tab-content ">
                <div class="tab-pane active" id="1">
                    <h3>Standard tab panel created on bootstrap using nav-tabs</h3>
                </div>
                <div class="tab-pane" id="2">
                    <h3>Notice the gap between the content and tab after applying a background color</h3>
                </div>
                <div class="tab-pane" id="3">
                    <h3>add clearfix to tab-content (see the css)</h3>
                </div>
            </div>
        </div>

        <hr></hr>

        <div class="container"><h2>Example 3 </h2></div>
        <div id="exTab3" class="container">	
            <ul  class="nav nav-pills">
                <li class="active">
                    <a  href="#1b" data-toggle="tab">Overview</a>
                </li>
                <li><a href="#2b" data-toggle="tab">Using nav-pills</a>
                </li>
                <li><a href="#3b" data-toggle="tab">Applying clearfix</a>
                </li>
                <li><a href="#4a" data-toggle="tab">Background color</a>
                </li>
            </ul>

            <div class="tab-content clearfix">
                <div class="tab-pane active" id="1b">
                    <h3>Same as example 1 but we have now styled the tab's corner</h3>
                </div>
                <div class="tab-pane" id="2b">
                    <h3>We use the class nav-pills instead of nav-tabs which automatically creates a background color for the tab</h3>
                </div>
                <div class="tab-pane" id="3b">
                    <h3>We applied clearfix to the tab-content to rid of the gap between the tab and the content</h3>
                </div>
                <div class="tab-pane" id="4b">
                    <h3>We use css to change the background color of the content to be equal to the tab</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="example-box-wrapper">
                <!--<div class="col-lg-4">-->
                <div class="btn-group">
                    <button class="btn btn-default" type="button"> 
                        <a class="btn location-info" type="button" href="#">
                            <i class="fa fa-map-marker small"></i>
                        </a>
                    </button>

                    <div class="btn-group ">
                        <button id="btn-group-example" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                            uname
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="btn-group-example">
                            <li>
                                <a href="#">Dropdown link</a>
                            </li>
                            <li>
                                <a href="#">Dropdown link</a>
                            </li>
                        </ul>
                    </div>
                </div>&nbsp;&nbsp;
                <!--</div>-->
                <!--<div class="col-lg-4">-->

                <div class="btn-group">
                    <button class="btn btn-default" type="button">  
                        <i class="fa fa-angle-double-left small"></i></button>
                    <div class="btn-group ">
                        <button id="btn-group-example" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                            Select
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="btn-group-example">
                            <li>
                                <a href="#">Dropdown link</a>
                            </li>
                            <li>
                                <a href="#">Dropdown link</a>
                            </li>
                        </ul>
                    </div>
                    <button class="btn btn-default" type="button"><i class="fa fa-angle-double-right small"></i></button>
                </div>
                &nbsp;&nbsp;
                <!--</div>-->
                <!--<div class="col-lg-4">-->  
                <div class="btn-group">
                    <button class="btn btn-default" type="button">  
                        Day
                    </button>
                    <div class="btn-group ">
                        <button id="btn-group-example" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                            Week
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="btn-group-example">
                            <li>
                                <a href="#">Dropdown link</a>
                            </li>
                            <li>
                                <a href="#">Dropdown link</a>
                            </li>
                        </ul>
                    </div>
                    <button class="btn btn-default" type="button">
                        Month
                    </button>
                </div>
                <!--</div>-->
            </div>
        </div>

        <div class="col-lg-6">
            <div class="example-box-wrapper">
                <button class="btn btn-default" type="button"> 
                    <!--<a class="btn location-info" type="button" href="#">-->
                    <i class="fa fa-refresh small"></i>&nbsp;Referesh
                    <!--</a>-->
                </button>&nbsp;&nbsp;
                <div class="btn-group ">
                    <button id="btn-group-example" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                        Copy Shift
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="btn-group-example">
                        <li>
                            <a href="#">Dropdown link</a>
                        </li>
                        <li>
                            <a href="#">Dropdown link</a>
                        </li>
                    </ul>
                </div>
                &nbsp;&nbsp;
                <!--<div class="col-lg-4">-->
                <div class="btn-group">
                    <button class="btn btn-default" type="button"> 
                        <i class="fa fa-line-chart small"></i>&nbsp;Status
                    </button>
                </div>
                &nbsp;&nbsp;
                <div class="btn-group">
                    <button class="btn btn-default" type="button"> 
                        <i class="fa fa-print small"></i>&nbsp;Print
                    </button>
                </div>
                &nbsp;&nbsp;
                <div class="btn-group">
                    <button class="btn btn-default" type="button"> 
                        <i class="fa fa-cogs small"></i>&nbsp;Option
                    </button>
                </div>
                <!--</div>-->
            </div>
        </div>

        <div class="btn-group" data-toggle="buttons">
            <a href="#" class="btn btn-primary">
                <input type="checkbox">
                Checkbox 1
            </a>
            <a href="#" class="btn btn-primary">
                <input type="checkbox">
                Checkbox 2
            </a>
            <a href="#" class="btn btn-primary">
                <input type="checkbox">
                Checkbox 3
            </a>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-4 control-label">Date &amp; Time picker</label>
        <div class="col-sm-8">
            <div class="input-prepend input-group">
                <span class="add-on input-group-addon">
                    <i class="glyph-icon icon-calendar"></i>
                </span>
                <input type="text" name="daterangepicker-time" id="daterangepicker-time" class=" form-control" value="03/18/2013 - 03/23/2013">
            </div>
        </div>
    </div>
</div>
<style>
    .tb_div{
        float: left;
        width:12.5%;
        min-height: min-content;
        border: 1px grey solid;
        text-align: center;
        padding: 1.8%;
    }
    /*******************************
* MODAL AS LEFT/RIGHT SIDEBAR
* Add "left" or "right" in modal parent div, after class="modal".
* Get free snippets on bootpen.com
*******************************/
    .modal.left .modal-dialog,
    .modal.right .modal-dialog {
        position: fixed;
        margin: auto;
        width: 320px;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);
    }

    .modal.left .modal-content,
    .modal.right .modal-content {
        height: 100%;
        overflow-y: auto;
    }

    .modal.left .modal-body,
    .modal.right .modal-body {
        padding: 15px 15px 80px;
    }

    /*Left*/
    .modal.left.fade .modal-dialog{
        left: -320px;
        -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
        -o-transition: opacity 0.3s linear, left 0.3s ease-out;
        transition: opacity 0.3s linear, left 0.3s ease-out;
    }

    .modal.left.fade.in .modal-dialog{
        left: 0;
    }

    /*Right*/
    .modal.right.fade .modal-dialog {
        right: -320px;
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
        -o-transition: opacity 0.3s linear, right 0.3s ease-out;
        transition: opacity 0.3s linear, right 0.3s ease-out;
    }

    .modal.right.fade.in .modal-dialog {
        right: 0;
    }

    /* ----- MODAL STYLE ----- */
    .modal-content {
        border-radius: 0;
        border: none;
    }

    .modal-header {
        border-bottom-color: #EEEEEE;
        background-color: #FAFAFA;
    }

    /* ----- v CAN BE DELETED v ----- */
    body {
        background-color: #78909C;
    }

    .demo {
        padding-top: 60px;
        padding-bottom: 110px;
    }

    .btn-demo {
        margin: 15px;
        padding: 10px 15px;
        border-radius: 0;
        font-size: 16px;
        background-color: #FFFFFF;
    }

    .btn-demo:focus {
        outline: 0;
    }


</style>
<div class="panel">
    <div class="panel-body">

        <div class="content-box">
            <div class="tb_div">1
            </div>
            <div class="tb_div">2</div>
            <div class="tb_div">3</div>
            <div class="tb_div">4</div>
            <div class="tb_div">5</div>
            <div class="tb_div">6</div>
            <div class="tb_div">7</div>
            <div class="tb_div">8</div>
            <div class="tb_div">9</div>
            <div class="tb_div">10</div>
            <div class="tb_div">11</div>
            <div class="tb_div">12</div>
            <div class="tb_div">13</div>
            <div class="tb_div">14</div>
            <div class="tb_div">15</div>
            <div class="tb_div">16</div>
            <div class="tb_div">17</div>
            <div class="tb_div">18</div>

        </div>
    </div>
</div>
<div class="panel">

    <div class="panel-body">

        <div class="container demo">


            <div class="text-center">
                <button type="button" class="btn btn-demo" data-toggle="modal" data-target="#myModal">
                    Left Sidebar Modal
                </button>

                <button type="button" class="btn btn-demo modal-trigger" data-toggle="modal" data-target="#myModal2">
                    Right Sidebar Modal
                </button>
            </div>

            <!-- Modal -->
            <div class="modal left fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Left Sidebar</h4>
                        </div>

                        <div class="modal-body">
                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </p>
                        </div>

                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div><!-- modal -->

            <!-- Modal -->
            <div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel2">Right Sidebar</h4>
                        </div>

                        <div class="modal-body">
                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </p>
                        </div>

                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div><!-- modal -->


        </div><!-- container -->


    </div>
</div>

<div class="panel">

    <div class="panel-body">
        <a href="#"  data-toggle="modal" data-target="#mod" class=" btn-default">Me</a>
        <h3 class="title-hero">
            Tabs with HEllo DEMo
        </h3>

        <div class="panel">
            <div class="panel-body">
                <h3 class="title-hero">
                    Pills
                </h3>
                <div class="example-box-wrapper">
                    <ul class="nav nav-pills">
                        <li class="active btn-default"><a href="#">Home</a></li>
                        <li class="btn-default"><a href="#">Profile</a></li>
                        <li class="btn-default"><a href="#">Messages</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<nav id="myfooterNavbar" class="navbar navbar-default navbar-fixed-bottom" role="navigation" >
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="" style="margin: 0;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="#">
                <img class="left-align radius-all-100 display-block" src="<?php print _MEDIA_URL ?>img/tlogo.png" alt="WHOzoor"  width="180" style="margin:-10px 0px;"  />
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
            <ul class="nav navbar-nav nav-tabs-justified">
                <li><a href="#">Home</a></li>
                <li><a href="#">Profile</a></li>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">Messages <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Inbox</a></li>
                        <li><a href="#">Drafts</a></li>
                        <li><a href="#">Sent Items</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Trash</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right"  >
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class=" dropdown-toggle">Admin <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Settings</a></li>
                    </ul>
                </li>


            </ul>

        </div>

        <!-- /.navbar-collapse -->
    </div>
</nav>


