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
    .prev_image{
        height: 50px;
        width: 50px;
        background-position: center center;
        background-size: cover;
        display: none;
        border: blanchedalmond groove thin;
        box-shadow: gray 5px 5px 5px,   #000 0px 0px 1px,   #000 0px 0px 1px,
            #000 0px 0px 1px,   #000 0px 0px 1px,   #000 0px 0px 1px;
    }
    body{
        height: 100%;
        background: #dfe2e6;
    }
    label{
        color: #969a9e;
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
</style>
<div style="" class="main-content">
    <div class="panel" >
        <div class="panel-body" >
            <h3 style="font-weight: bold;margin-left: 20px;">Upload Documents</h3>

            <form action="people_single_upload" method="POST" data-parsley-validate enctype="multipart/form-data">
                <input type="hidden" id="work_at_location" name="work_at_location" value="<?= $_REQUEST['work_at_location']; ?>">
                <input type="hidden" id="email" name="email" value="<?= $_REQUEST['email']; ?>">
                <input type="hidden" id="idno" name="idno" value="<?= $_REQUEST['idno']; ?>">
                <div class="panel" >
                    <div class="panel-body" >

                        <section>
                            <h5 class="m-sideReveal-profileEditHeader gray">UPLOAD IMAGES</h5><br>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Upload Contract</label>
                                        <div class="col-sm-12 col-lg-10">
                                            <input id="ContractImage"  type="file" name="ContractImage" class="form-control form-radius show_preview"  placeholder="select File"  data-prev_id="prev_1"/>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <div id="prev_1" class="prev_image"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Military service</label>
                                        <div class="col-sm-12 col-lg-10">
                                            <input id="military_service"  type="file" name="military_service" class="form-control form-radius show_preview"  placeholder="select File"  data-prev_id="prev_2"/>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <div id="prev_2" class="prev_image"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Birth Certificate</label>
                                        <div class="col-sm-12 col-lg-10">
                                            <input id="birth_cert"  type="file" name="birth_cert" class="form-control form-radius show_preview"  placeholder="select File"  data-prev_id="prev_3"/>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <div id="prev_3" class="prev_image"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Identity Certificate</label>
                                        <div class="col-sm-12 col-lg-10">
                                            <input id="idc"  type="file" name="idc" class="form-control form-radius show_preview"  placeholder="select File"  data-prev_id="prev_4"/>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <div id="prev_4" class="prev_image"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Resident Proof</label>
                                        <div class="col-sm-12 col-lg-10">
                                            <input id="idc"  type="file" name="idc" class="form-control form-radius show_preview"  placeholder="select File"  data-prev_id="prev_5"/>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <div id="prev_5" class="prev_image"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Last degree Certificate</label>
                                        <div class="col-sm-12 col-lg-10">
                                            <input id="ldc"  type="file" name="ldc" class="form-control form-radius show_preview"  placeholder="select File"  data-prev_id="prev_6"/>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <div id="prev_6" class="prev_image"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="" class="col-sm-12 control-label " >Veteran</label>
                                        <div class="col-sm-12 col-lg-10">
                                            <input id="veteran"  type="file" name="veteran" class="form-control form-radius show_preview"  placeholder="select File"  data-prev_id="prev_7"/>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <div id="prev_7" class="prev_image"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                        </section>


                    </div>
                </div>

                <div class="col-sm-12 text-right" >
                    <a class="btn btn-default" href="<?= l("people") ?>" type="button">Back</a>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" type="submit">Save</button>
                    <input id="add_people_upload" type="hidden" name="add_people_upload" value="1"/>
                </div> 

            </form>
        </div>
    </div>
</div>

<style>
    .modal:nth-of-type(even) {
        z-index: 1042 !important;
    }
    .modal-backdrop.in:nth-of-type(even) {
        z-index: 1041 !important;
        .setwidth{
            width: 700px;
        }
    }
</style>
<style>

    #Edit-People{
        float: right;
        position: fixed;
        /*left: 65%;*/
        right: 0px;

    }
</style>