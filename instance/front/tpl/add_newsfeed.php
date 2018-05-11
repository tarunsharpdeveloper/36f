<style>
    .inputfile {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
    }

</style>
<div class="panel">
    <div class="panel-body">


        <!--        <div class="example-box-wrapper">
                    <button class="btn btn-default btn-md" data-toggle="modal" data-target="#myModal"> Launch demo modal </button>
        
                </div>-->
        <!--<form  action="task"  id='task_form'>-->

        <div class="panel">
            <div class="panel-body">
            
                <form action="add_newsfeed" method="post" enctype="multipart/form-data">
                    <h3 class="title-hero">
                        New NewsFeed
                    </h3>

                <div class="content-box-wrapper" >

                    <input type="hidden" name="share_id" id="share_id" value="1"/>
                    <input type="hidden" name="create_post_id" id="create_post_id" value="<?php echo $_SESSION['user']['id']; ?>"/>
<!--                     <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="" class="col-sm-4 control-label" >Share With</label>
                                <div class="col-sm-8">
                                     <select name="share_id" class="chosen-select form-control" style="width:100%" required="">
                                        <option selected disabled value="">Choose Department</option>
                                        <option value="1">Demo User</option>
                                        <option value="2">Test 1</option>
                                        <option value="3">Test 2</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="" class="col-sm-4 control-label" ></label>
                                <div class="col-sm-8">
                                        <textarea name="message" placeholder="What's happening?" id="message" maxlength="255" style="height: 350px;width: 100%;min-height: 100px;" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 center-div center-content">
                        <input type="file" name="file" id="file" class="inputfile" />
                            <label for="file"><i class="glyphicon glyphicon-picture" style="font-size:48px;color:#00bca4"></i></label>
                    </div>
                    <div class="col-lg-6 col-sm-12 center-div center-content">
                        <button class="btn btn-primary col-sm-12 col-lg-3" type="submit">Create Post</button>
                    </div>
                    <input type="hidden" name="save_post" />
                </div>
                </form>

<!--                                <div  id="Add-option" class="">
                                    <a class="btn btn-primary theme-switcher tooltip-button" href="#" data-toggle="modal" data-target="#myModal2" data-placement="left" title="New Task" data-original-title="Add New Task">
                                        <i class="glyph-icon icon-plus-square "></i>
                                    </a>
                                </div>-->
            </div>
        </div>


    </div><!-- modal-content -->
</div><!-- modal-dialog -->
