
<style>
                #Add-option2{
                    position: fixed;
                    right: -280px;
                    top: 68%;
                    transition: transform 0.5s ease 0s;
                    width: 300px;
                    z-index: 9999;
                }
                #Add-option3{
                    position: fixed;
                    right: -280px;
                    top: 56%;
                    transition: transform 0.5s ease 0s;
                    width: 300px;
                    z-index: 9999;
                }
            </style>


        <div class="panel">
            <div class="panel-body">
                <div class="example-box-wrapper">
                    <div class="row">
                        <div  class="col-xs-1 col-md-1" style="font-size: 27px;">
                             
                        </div>
                        <div class="col-xs-11 col-md-11">
                            <input type="text" value="" style="width: 100%;"/>
                        </div>
                    </div>
                    
                    
                </div>
<!--top: 180px;margin-left: 93%;-->
                <div id="Add-option3" class="">
                    <a style="border-radius: 50%;background-color: rgba(244, 67, 54, 0.85);border-color: rgba(244, 67, 54, 0.85);"  class="btn btn-primary theme-switcher tooltip-button" href="<?php l('new_people') ?>" data-toggle="" data-target="" data-placement="left" title="Add people from contacts" data-original-title="Add people from contacts">
                        <i class="glyph-icon icon-users "></i>
                    </a>
                </div>
                <div id="Add-option2" class="">
                    <a style="border-radius: 50%;background-color: #3F51B5;border-color: #3F51B5;"  class="btn btn-primary theme-switcher tooltip-button" href="<?php l('new_people') ?>" data-toggle="" data-target="" data-placement="left" title="Add prople manually" data-original-title="Add prople manually">
                        <i class="glyph-icon icon-user "></i>
                    </a>
                </div>
                <div id="Add-option" class="">
                    <a style="border-radius: 50%;background-color: #FF9800;border-color: #FF9800;" class="btn btn-primary theme-switcher tooltip-button" href="<?php l('add_people') ?>" data-toggle="" data-target="" data-placement="left" title="" data-original-title="">
                        <i class="glyph-icon icon-plus "></i>
                    </a>
                </div>
            </div>
        </div>


