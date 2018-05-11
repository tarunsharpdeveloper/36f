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

        float: left;
        padding: 0px;
        margin: 0px;
        width: 80%;
        /*min-height: max-content ;*/
        height: 100%;
        border: #F3F5F7 2px solid; 
    }

    .sidebar-nav-right{
        float: right;
        padding: 0px;
        margin: 0px;
        width: 20%;
        min-height:  min-content;

        border: #F3F5F7 2px solid; 
        /*clear: both;*/
    }
    .sub_sidebar-nav-left{

        float: left;
        padding: 0px;
        margin: 0px;
        width: 20%;
        /*padding: 1rem;*/
        /*margin: 0px 1%;*/ 
        /*min-height: max-content ;*/
        height: 100%;
        /*border: #F3F5F7 2px solid;*/ 
    }

    .sub_sidebar-nav-right{
        float: right;
        padding: 0px;
        margin: 0px;
        width: 80%;
        /*padding: 1rem;*/
        min-height:  min-content;

        /*border: #F3F5F7 2px solid;*/ 
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
        /* cursor: pointer; */
        border-radius: 50%;
        height: 29px;
        width: 46px;
        background-color: #e9e9e9;
        font-weight: bold;
        font-size: 18px;
        margin-top: 4px;
    }
    .on-break-tab{
        border-radius: 50%;
        height: 29px;
        /*width: 46px;*/
        background-color: #e9e9e9;
        font-weight: bold;
        font-size: 18px;
        margin-top: 4px;
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
    .delete:hover{
        /*background-color: salmon;*/
        color: salmon;

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

</style>

<div style="" class="main-content">


    <div class="panel sidebar-nav-left" >
        <div class="panel" style="margin-bottom: 0px;">
            <div class="panel-body">
                <div>
                    <div class="col-lg-2 col-sm-12">
                        <h2 style="font-weight: bold;">News Feed</h2>
                    </div>

                    <div class="col-lg-8 col-sm-12 ">
                        <hr>
                    </div>
                    <div class="col-lg-2 col-sm-12">
                        <button class="btn btn-azure col-md-12 " data-toggle="modal" data-target="#Add-People" type="button">Create Post</button>
                    </div>
                </div>

            </div>
            <div class="panel-body">
                <div class="panel col-lg-2 col-sm-12">
                    <div class="panel-body" style="margin: 0px;padding: 15px 0px;">
                        <!--                <div class="sub_sidebar-nav-left" >-->
                        <div class="btn-group" data-toggle="buttons">
                            <button class=" btn btn-default" onclick="checkboxval('1')" id="allpost"  style="width: 100%;text-align: left;">
                                <!--<input type="checkbox" name="chkperform" id="chk1" class="chkperform" value="Approved All" >-->
                                All Posts
                            </button>
                            <button class="btn btn-default"  onclick="checkboxval('2')" id="receivedpost" style="width: 100%;text-align: left;">
                                <!--<input type="checkbox"  name="chkperform" id="chk2" class="chkperform" value="Unapproved All">-->
                                <i class=" fa fa-exclamation-triangle"></i> Received Post
                            </button>
                            <button class="btn btn-default"  onclick="checkboxval('3')" id="yourpost" style="width: 100%;text-align: left;">
                                <!--<input type="checkbox"  name="chkperform" id="chk2" class="chkperform" value="Unapproved All">-->
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Your Post
                            </button>
                            <button class="btn btn-default" disabled  id="" style="width: 100%;text-align: left;">
                                <!--<input type="checkbox"  name="chkperform" id="chk2" class="chkperform" value="Unapproved All">-->
                                Location
                            </button>


                        </div>


                    </div>
                </div>
                <div class="panel  col-lg-10 col-sm-12">
                    <div class="panel-body">
                        <!--<div class="sub_sidebar-nav-right ">-->
                        <!--                    <div class="panel">
                                                <div class="panel-body">-->
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </div>
                            <input id="team-search-filter" class="form-control" type="text" name="team-search-filter" placeholder="Search People..." autocomplete="off" style="border-right: 0;">
                            <div class="input-group-addon">
                                <span id="lblTeamMemberCount" style="display: inline;">showing <strong>3</strong> people</span>
                            </div>
                        </div>
                        <!--                             </div>
                                            </div>-->
                        <div class="panel">
                            <div class="panel-body" id="divCommentsPost">
                                <!--                                <h1>Hello Body</h1>-->


                                <!--<div class="panel">-->
                                <!--<div class="panel-body">-->
                                <!--                                        <h3 class="title-hero">
                                                                            Basic
                                                                        </h3>-->
                                <!--                                        <form action="newsfeed"
                                                                              class="dropzone"
                                                                              id="my-awesome-dropzone">
                                
                                                                        </form>-->
                                <!--                                        <div class="example-box-wrapper">
                                                                            <div class="row" id="dropzone-example">
                                                                                <form action="newsfeed"  class="dropzone bg-gray col-md-10 center-margin" id="demo_upload"></form>
                                                                            </div>
                                                                        </div>-->
                                <!--</div>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>



            </div>


        </div>

    </div>
    <div class="panel sidebar-nav-right">
        <div class="panel-body background-color">

            <div class="panel-body background-color-white">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-4 col-xs-4 col-lg-12 control-label">Teams</label>
                        <div class="col-sm-8 col-xs-8 col-lg-12">
                            <select name="leave_type1" id="leave_type1" class="browser-default chosen-select form-control" style="width:100%" >
                                <option selected >All Locations</option>
                                <option value="Unspecified">Hardik Casting</option>
                            </select>

                        </div>
                    </div>
                </div>
                <div class="panel-body" >

                    <div class="example-box-wrapper" >
                        <div class="row">

                            <div class="col-md-12" style="margin-top: 20px;">
                                <a class="btn btn-default" type="button" data-toggle="collapse" data-target="#demo-2" aria-expanded="true" style="    margin-left: -28%;padding-right: 81%;">
                                    <i class="fa fa-plus small"></i>&nbsp;&nbsp;On Break(1)
                                </a>
                                <div id="demo-2" class="collapse in" aria-expanded="true" style="margin-top: 20px;margin-left: -28px;">

                                    <div class="row">
                                        <div  class="col-xs-3 col-md-3 on-break">HH</div>
                                        <div class="col-xs-9 col-md-9">
                                            <div><b style="color: #1b92da;">Hardik Hardik</b></div>
                                            <div><a class="m-team-supportingLink" href="#" title="Started on 11:29am at Manager">11:29am at Manager</a></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div> 
        </div>
    </div>
    <div class="modal fadeInUp center "  id="Add-People" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document" style="">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title center_bold" id="myModalLabel2" style="text-align: center;font-weight: bold;">Create Post</h4>
                </div>
                <form action="newsfeed" method="POST" enctype="multipart/form-data">
                    <div class="modal-body" >
                        <div class="panel" >
                            <div class="panel-body" >
<!--                                <section>-->
                                <h5 class="m-sideReveal-profileEditHeader gray">Share With</h5><br/>
                                <div class="col-sm-12 col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <!--                                            <label class="col-sm-3 control-label">Chosen multiselect</label>-->
                                            <label for="" class=" control-label lbl-text-align" ></label>
                                            <div class="col-sm-12">
                                                <select name="selectedEMP[]" id="selectedEMP" multiple data-placeholder="Select Some People..." class="form-control chosen-select">

                                                    <option label="All"  value="*">All</option>

                                                    <optgroup label="Employee">
                                                        <?php
                                                        foreach ($emplist as $empval) {
                                                            if ($_SESSION['user']['id'] == $empval['id']) {
                                                                $disableds = "disabled";
                                                            }else{
                                                                 $disableds = "";
                                                            }
                                                            ?>

                                                            <option id="<?= $empval['id'] ?>" value="<?= $empval['id'] ?>" <?= $disableds ?> ><?= $empval['fname'] . " " . $empval['lname'] ?></option>
                                                            <?php
                                                        }
                                                        ?>

                                                    </optgroup>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <!--<label for="" class="col-sm-4 control-label lbl-text-align" >Email</label>-->
                                            <label for="" class=" control-label lbl-text-align" ></label>
                                            <div class="col-sm-12">
                                                <!--<input id="email" type="email" name="email" class="form-control form-radius"  placeholder="" required/>-->
                                                <textarea name="message" class="form-control" id="message" placeholder="What's happening?" maxlength="255" style="width: 100%;min-height: 100px;" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="" class=" control-label lbl-text-align" ></label>
                                            <div class="col-sm-12">
                                                <!--<input id="mobile" type="text" name="mobile" class="form-control form-radius"  placeholder="" required/>-->
                                                <!--                                                </form> 
                                                                                                <form action="newsfeed"
                                                                                                      class="dropzone"
                                                                                                      id="my-awesome-dropzone">-->


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--                                </section>-->

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12">
                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit" name="save_post" id="save_post">Save</button>
                            <input id="add_people" type="hidden" name="add_people" value="1"/>
                        </div> 
                    </div> 

                </form>

            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->