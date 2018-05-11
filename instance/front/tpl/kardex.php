<div class="panel">
    <div class="panel-body">
        <div class="panel-body">
            <div>
                <div class="col-lg-12 col-sm-12">
                    <h3 style="font-weight: bold;color: #00c6ff">Kardex Tool and Settings  </h3>
                </div>
                <div class="col-lg-12 col-sm-12 ">
                    <hr>
                </div>
                <ul class="nav nav-tabs">
                    <li >
                        <a  href="#1" data-toggle="tab">Tool</a>
                    </li>
                    <li class="active">
                        <a href="#2" data-toggle="tab"> Settings</a>
                    </li>
                    <!--                    <li>
                                            <a href="#3" data-toggle="tab"> Options</a>
                                        </li>-->
                </ul>
                <div class="tab-content ">
                    <?php include _PATH . "instance/front/tpl/kardex_tool.php"; ?>
                    <?php include _PATH . "instance/front/tpl/kardex_settings.php"; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style=" padding-right: 17px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: green;color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Success!</h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-1"><span style="font-size: 30px; color: #71B280"> <i class="fa fa fa-calendar" aria-hidden="true"></i></span> </div>
                <div class="col-lg-11" style="font-size: 16px;">
                    <p>The Kardex settings has been updated.</p> 
                    <p style="font-size: 15px;">Please be advised that it would be applied from <?= $firstDayNextMonth = date('dS F, Y', strtotime('first day of next month')); ?></p>

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default " data-dismiss="modal" style="background-color: #7cd362;color: white;">Yes, I understand</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>
<style>
    table#tbl{
        margin-top: 0px !important;
    }</style>