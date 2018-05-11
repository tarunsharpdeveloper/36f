<style>
    .tb_div{
        float: left;
        width:14.285%;
        min-height: min-content;
        border: 1px rgba(128, 128, 128, 0.29) solid;
        text-align: center;
        padding: 1.8%;
        cursor: pointer;
        height: 153px;
    }
    .center_bold {   
        text-align: center;
        font-weight: bold;
    }
    .photo-css{
        cursor: pointer;
        border: 2px dashed transparent;
        border-radius: 50%;
        display: inline-block;
        position: relative;
        height:60px;
        width: 60px
    }
    .button-color{
        color: white;
        background-color: rgb(255, 141, 0);
        border: yellow;
        display: none;
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
        height: 35px;
        width: 35px;font-weight: bold;
        background-color: #e9e9e9;
        font-size: 12px;
        line-height: 35px;
    }
</style>
<style>
    p{
        color: #888;
    }

    /*  bhoechie tab */
    div.bhoechie-tab-container{
        z-index: 10;
        background-color: #ffffff;
        padding: 0 !important;
        border-radius: 4px;
        -moz-border-radius: 4px;
        border:1px solid #ddd;
        /*margin-top: 20px;*/
        /*margin-left: 50px;*/
        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
        -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        background-clip: padding-box;
        opacity: 0.97;
        filter: alpha(opacity=97);
    }
    div.bhoechie-tab-menu{
        padding-right: 0;
        padding-left: 0;
        padding-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group{
        margin-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group>a{
        margin-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group>a .glyphicon,
    div.bhoechie-tab-menu div.list-group>a .fa {
        color: #00CEB4;
    }
    div.bhoechie-tab-menu div.list-group>a:first-child{
        border-top-right-radius: 0;
        -moz-border-top-right-radius: 0;
    }
    div.bhoechie-tab-menu div.list-group>a:last-child{
        border-bottom-right-radius: 0;
        -moz-border-bottom-right-radius: 0;
    }
    div.bhoechie-tab-menu div.list-group>a.active,
    div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
    div.bhoechie-tab-menu div.list-group>a.active .fa{
        background-color: #00CEB4;
        background-image: #00CEB4;
        color: #ffffff;
    }
    div.bhoechie-tab-menu div.list-group>a.active:after{
        content: '';
        position: absolute;
        left: 100%;
        top: 50%;
        margin-top: -13px;
        border-left: 0;
        border-bottom: 13px solid transparent;
        border-top: 13px solid transparent;
        border-left: 10px solid #00CEB4;
    }

    div.bhoechie-tab-content{
        background-color: #ffffff;
        /* border: 1px solid #eeeeee; */
        padding-left: 20px;
        padding-top: 10px;
    }

    div.bhoechie-tab div.bhoechie-tab-content:not(.active){
        display: none;
    }

</style>
<script type="text/javascript">
    $(document).ready(function () {
        $("div.bhoechie-tab-menu>div.list-group>a").click(function (e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
        });
    });
</script>
<div class="panel">
    <div class="panel-body">
        <div>
            <div class="col-lg-2 col-sm-12">
                <h2 style="font-weight: bold;">Shift Type</h2>
            </div>
            <div class="col-lg-8 col-sm-12 ">
                <hr>
            </div>
            <div class="col-lg-2 col-sm-12">
                <li class="dropdown" style="width: 90%;">
                    <a class="btn btn-default add_new" style="width: 100%;" href="#" id="add_new">Add Shift Type</a>
                </li>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div id="refreshDiv">
            <table class="table table-striped responsive no-wrap" id="empTables">
                <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th id="tbl_1" style="width: 40%;" class="tb-none tb-th">Name</th>
                        <th id="tbl_3" style="width: 20%;" class="tb-none tb-th" style="">Time</th>
                        <th id="tbl_3" style="width: 20%;" class="tb-none tb-th" style="">Deduction</th>
                        <th id="tbl_4" style="width: 15%;" class="tb-none tb-th">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = "1";
                    if (empty($PostResult)) {
                        ?>
                        <tr><td colspan="11"><?php echo "No Record Found!!!!!"; ?></td></tr>
                        <?php
                    } else {
                        foreach ($PostResult as $PostRow) {
                            ?>
                            <tr>
                                <td style="width:15px">
                                    <?= $i; ?>
                                </td>
                                <td style="" class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>">
                                    <?php echo $PostRow['shift_name']; ?>
                                </td>
                                <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>" >
                                    <?php echo $PostRow['start_time'] . " To " . $PostRow['end_time'] . " | " . $PostRow['shift_time']; ?>
                                </td>
                                <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>" >
                                    <?php echo $PostRow['deduction']; ?>
                                </td>
                                <td class="tb-none tbl_sub_1 tb-sub" data-id="<?php echo $PostRow['id']; ?>">
                                    <!--                                <button class="btn btn-round btn-default">
                                                                        <i class="glyph-icon icon-download"></i>
                                                                    </button>-->
                                    <button class="btn btn-round btn-info btn_edit" data-id="<?php echo $PostRow['id']; ?>" >
                                        <i class="glyph-icon icon-pencil"></i>
                                    </button>
                                    <button class="btn btn-round btn-danger btn_delete" data-id="<?php echo $PostRow['id']; ?>">
                                        <i class="glyph-icon icon-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fadeInUp center "  id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document" >
        <form action="shift_type" id="modal_form" class="shift_type_form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Add New Shift Type</h4>
                </div>
                <div class="modal-body" >
                    <div class="panel" >
                        <div class="panel-body" >
                            <input type="hidden" name="isNewType" value="">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Shift Name</label>
                                        <div class="col-sm-12">
                                            <input id="a_shiftName" type="text" name="a_shiftName" class="form-control form-radius"  placeholder="" required  />
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label" style="line-height: 30px;">Start Time:</label>
                                        <div class="col-sm-12">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon">
                                                    <i class="glyph-icon icon-clock-o"></i>
                                                </span>
                                                <input class="form-control timepicker mContent a_time" id="a_start_time" name="a_start_time" type="text" value="" required="" pattern="^(?:[01]\d|2[0-3])(?::?[0-5]\d)?$">
                                            </div>
                                            <span id="error_start_time" style="color:red;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label" style="line-height: 30px;">End Time:</label>
                                        <div class="col-sm-12">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon">
                                                    <i class="glyph-icon icon-clock-o"></i>
                                                </span>
                                                <input class="form-control timepicker mContent a_time" id="a_end_time" name="a_end_time" type="text" value="" required="" pattern="^(?:[01]\d|2[0-3])(?::?[0-5]\d)?$">

                                            </div>
                                            <span id="error_end_time" style="color:red;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!--                            <div class="col-sm-12 col-lg-6">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <label for="" class="col-sm-12 control-label " >Shift Time</label>
                            
                                                                    <div class="col-sm-12 ">
                                                                        <div class="input-prepend input-group">
                                                                            <span class="add-on input-group-addon">
                                                                                <i class="glyph-icon icon-clock-o"></i>
                                                                            </span>-->
                            <input id="a_shiftTime" type="hidden" name="a_shiftTime" class="form-control form-radius"  placeholder="" value=""  />
                            <!--                                            </div>
                                                                    </div>
                            
                                                                </div>
                                                            </div>
                                                        </div>-->

                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Deduction Time</label>
                                        <div class="col-sm-12">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon">
                                                    <i class="glyph-icon icon-clock-o"></i>
                                                </span>
                                                <input id="a_deductTime" type="text" name="a_deductTime" class="form-control form-radius"  placeholder="" required />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit" onclick="NewSchedulesave()">Save</button>
                    </div> 
                </div> 


            </div>
        </form>
    </div><!-- modal-content -->
</div>
<!-- modal-dialog -->

<div class="modal fadeInUp center "  id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document" >
        <form action="shift_type" id="edit_modal_form" class="shift_type_form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Update Shift Type</h4>
                </div>
                <div class="modal-body" >
                    <div class="panel" >
                        <div class="panel-body" >
                            <input type="hidden" name="isUpdateType" value="">
                            <input type="hidden" name="shiftid" id="shiftid" value="">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Shift Name</label>
                                        <div class="col-sm-12">
                                            <input id="e_shiftName" type="text" name="e_shiftName" class="form-control form-radius"  placeholder="" required  />
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label" style="line-height: 30px;">Start Time:</label>
                                        <div class="col-sm-12">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon">
                                                    <i class="glyph-icon icon-clock-o"></i>
                                                </span>
                                                <input class="form-control timepicker mContent e_time" id="e_start_time" name="e_start_time" type="text" value="" required="" pattern="^(?:[01]\d|2[0-3])(?::?[0-5]\d)?$">

                                            </div>
                                            <span id="error_start_time" style="color:red;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label" style="line-height: 30px;">End Time:</label>
                                        <div class="col-sm-12">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon">
                                                    <i class="glyph-icon icon-clock-o"></i>
                                                </span>
                                                <input class="form-control timepicker mContent e_time" id="e_end_time" name="e_end_time" type="text" value="" required="" pattern="^(?:[01]\d|2[0-3])(?::?[0-5]\d)?$">

                                            </div>
                                            <span id="error_end_time" style="color:red;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--                            <div class="col-sm-12 col-lg-6">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <label for="" class="col-sm-12 control-label " >Shift Time</label>
                                                                    <div class="col-sm-12">-->
                            <input id="e_shiftTime" type="hidden" name="e_shiftTime" class="form-control form-radius"  placeholder="" value=""  />
                            <!--                                        </div>
                            
                                                                </div>
                                                            </div>
                                                        </div>-->
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Deduction Time</label>
                                        <div class="col-sm-12">
                                            <div class="input-prepend input-group">
                                                <span class="add-on input-group-addon">
                                                    <i class="glyph-icon icon-clock-o"></i>
                                                </span>
                                                <input id="e_deductTime" type="text" name="e_deductTime" class="form-control form-radius"  placeholder="" required />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit" >EDIT</button>
                    </div> 
                </div> 


            </div>
        </form>
    </div><!-- modal-content -->
</div>
<div class="modal fadeInUp center "  id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document" >
        <form action="shift_type" id="edit_modal_form" class="shift_type_form">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#EB6759;color: whitesmoke;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2">Delete Shift Type</h4>
                </div>
                <div class="modal-body" >
                    <div class="panel" >
                        <div class="panel-body" >
                            <input type="hidden" name="isUpdateType" value="">
                            <input type="hidden" name="dshiftid" id="dshiftid" value="">
                            <p style="color: #EB6759;" class="h3">Are You Sure You to delete Shift Type?</p>
                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <div class="col-sm-12">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-danger" type="button" onclick="deleteShift($('#dshiftid').val())" >Delete</button>
                    </div> 
                </div> 


            </div>
        </form>
    </div><!-- modal-content -->
</div>
<!-- Modal Structure -->
<!--Modal 1 -->

<style>

    label.error{
        position: relative;
    }
    .not_margin{
        margin-bottom: 0px !important;
    }
    .radio_list_single{
        margin-top: 5px;
    }
    .ddl_date{

        /*width: 20%;*/
    }
    input[type="text"]{
        height: 32px;
    }
    .row .col.l4{
        padding-bottom: 0px;
    }
    .custom_ddl_block .col.l4{
        margin-top: 0px;
    }
    html.rtl .custom_ddl_block .col.l4{
        padding-right: 0px;
        padding-left: 10px;
    }
    html.rtl .custom_ddl_block{
        padding-right: 0px;
    }


</style>

<?php include _PATH . "instance/front/tpl/vehicle_plate_design.php" ?>