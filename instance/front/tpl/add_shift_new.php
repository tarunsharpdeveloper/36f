<div class="container">
    <input type="hidden" id="formName" value="">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label class="control-label">Select Employee</label>
                <div>
                    <select class="form-control" name="employee" id="employee">
                        <?php foreach ($employee as $each_employee) { ?>
                            <option value="<?php echo $each_employee['id'] ?>"><?php echo $each_employee['fname'] . " " . $each_employee['lname'] . " (" . $each_employee['mobile'] . ")" ?></option>                                      
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#week">Week</a></li>
            <li><a data-toggle="tab" href="#2week">2 Week</a></li>
            <li><a data-toggle="tab" href="#month">Month</a></li>
        </ul>

        <div class="tab-content" >
            <div id="week" class="tab-pane fade in active" style="background-color: white !important;">
                <form id="weekForm">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <input class="form-control" value="" name="week[1][]" type="text" placeholder="Mon">
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1700">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>                       

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <input class="form-control" value="" name="week[1][]" type="text" placeholder="Tue">
                            </div>    
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1700">
                            </div> 
                        </div>
                        <div class="clearfix"></div>
                        <br/>   
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <input class="form-control" value="" name="week[1][]" type="text" placeholder="Wed">
                            </div> 
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1700">
                            </div> 
                        </div>
                        <div class="clearfix"></div>
                        <br/>   
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <input class="form-control" value="" name="week[1][]" type="text" placeholder="Thr">
                            </div>  
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1700">
                            </div>  
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <input class="form-control" value="" name="week[1][]" type="text" placeholder="Fri">
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1700">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>   
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <input class="form-control" value="" name="week[1][]" type="text" placeholder="Sat">
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1400">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>   
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <input class="form-control" value="" name="week[1][]" type="text" placeholder="Sun">
                            </div>  
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1400">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>   
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                            <div class="btn btn-success" onclick="openModalConf('weekForm')">Ok</div> 
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
            <div id="2week" class="tab-pane fade" style="background-color: white !important;">
                <form id="2weekForm">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12" style="padding: 0">
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6" >
                            <h3> 1 Week</h3>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6" style="padding: 0">
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="Mon" name="week[1][]" type="text" placeholder="Mon">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="0900-1000" name="time[1][]" type="text" placeholder="1000-1700">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>                       

                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[1][]" type="text" placeholder="Tue">
                                    </div>    
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1700">
                                    </div> 
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[1][]" type="text" placeholder="Wed">
                                    </div> 
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1700">
                                    </div> 
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[1][]" type="text" placeholder="Thr">
                                    </div>  
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1700">
                                    </div>  
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6" style="padding: 0">
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[1][]" type="text" placeholder="Fri">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1700">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[1][]" type="text" placeholder="Sat">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1400">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[1][]" type="text" placeholder="Sun">
                                    </div>  
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1400">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6" >
                            <h3> 2 Week</h3>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6" style="padding: 0">
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="Tue" name="week[2][]" type="text" placeholder="Mon">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="0900-1000" name="time[2][]" type="text" placeholder="1000-1700">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>                       

                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[2][]" type="text" placeholder="Tue">
                                    </div>    
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[2][]" type="text" placeholder="1000-1700">
                                    </div> 
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[2][]" type="text" placeholder="Wed">
                                    </div> 
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[2][]" type="text" placeholder="1000-1700">
                                    </div> 
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[2][]" type="text" placeholder="Thr">
                                    </div>  
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[2][]" type="text" placeholder="1000-1700">
                                    </div>  
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6" style="padding: 0">
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[2][]" type="text" placeholder="Fri">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[2][]" type="text" placeholder="1000-1700">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[2][]" type="text" placeholder="Sat">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[2][]" type="text" placeholder="1000-1400">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[2][]" type="text" placeholder="Sun">
                                    </div>  
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[2][]" type="text" placeholder="1000-1400">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="btn btn-success" onclick="openModalConf('2weekForm')">Ok</div> 
                                </div>

                            </div>
                        </div>
                    </div>

                </form>
                <div class="clearfix"></div>
            </div>
            <div id="month" class="tab-pane fade" style="background-color: white !important;">
                <form id="MonthForm">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                               <h3> 1 Week</h3>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="Wed" name="week[1][]" type="text" placeholder="Mon">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="0900-1000" name="time[1][]" type="text" placeholder="1000-1700">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>                       

                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[1][]" type="text" placeholder="Tue">
                                    </div>    
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1700">
                                    </div> 
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[1][]" type="text" placeholder="Wed">
                                    </div> 
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1700">
                                    </div> 
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[1][]" type="text" placeholder="Thr">
                                    </div>  
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1700">
                                    </div>  
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[1][]" type="text" placeholder="Fri">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1700">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[1][]" type="text" placeholder="Sat">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1400">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[1][]" type="text" placeholder="Sun">
                                    </div>  
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[1][]" type="text" placeholder="1000-1400">
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                               <h3> 2 Week</h3>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="Thu" name="week[2][]" type="text" placeholder="Mon">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="0900-1000" name="time[2][]" type="text" placeholder="1000-1700">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>                       

                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[2][]" type="text" placeholder="Tue">
                                    </div>    
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[2][]" type="text" placeholder="1000-1700">
                                    </div> 
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[2][]" type="text" placeholder="Wed">
                                    </div> 
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[2][]" type="text" placeholder="1000-1700">
                                    </div> 
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[2][]" type="text" placeholder="Thr">
                                    </div>  
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[2][]" type="text" placeholder="1000-1700">
                                    </div>  
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[2][]" type="text" placeholder="Fri">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[2][]" type="text" placeholder="1000-1700">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[2][]" type="text" placeholder="Sat">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[2][]" type="text" placeholder="1000-1400">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[2][]" type="text" placeholder="Sun">
                                    </div>  
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[2][]" type="text" placeholder="1000-1400">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                               <h3> 3 Week</h3>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="Mon" name="week[3][]" type="text" placeholder="Mon">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="0900-1000" name="time[3][]" type="text" placeholder="1000-1700">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>                       

                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[3][]" type="text" placeholder="Tue">
                                    </div>    
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[3][]" type="text" placeholder="1000-1700">
                                    </div> 
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[3][]" type="text" placeholder="Wed">
                                    </div> 
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[3][]" type="text" placeholder="1000-1700">
                                    </div> 
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[3][]" type="text" placeholder="Thr">
                                    </div>  
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[3][]" type="text" placeholder="1000-1700">
                                    </div>  
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[3][]" type="text" placeholder="Fri">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[3][]" type="text" placeholder="1000-1700">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[3][]" type="text" placeholder="Sat">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[3][]" type="text" placeholder="1000-1400">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[3][]" type="text" placeholder="Sun">
                                    </div>  
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[3][]" type="text" placeholder="1000-1400">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                               <h3> 4 Week</h3>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="Tue" name="week[4][]" type="text" placeholder="Mon">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="0900-1000" name="time[4][]" type="text" placeholder="1000-1700">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>                       

                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[4][]" type="text" placeholder="Tue">
                                    </div>    
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[4][]" type="text" placeholder="1000-1700">
                                    </div> 
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[4][]" type="text" placeholder="Wed">
                                    </div> 
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[4][]" type="text" placeholder="1000-1700">
                                    </div> 
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[4][]" type="text" placeholder="Thr">
                                    </div>  
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[4][]" type="text" placeholder="1000-1700">
                                    </div>  
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[4][]" type="text" placeholder="Fri">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[4][]" type="text" placeholder="1000-1700">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[4][]" type="text" placeholder="Sat">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[4][]" type="text" placeholder="1000-1400">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="week[4][]" type="text" placeholder="Sun">
                                    </div>  
                                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-6">
                                        <input class="form-control" value="" name="time[4][]" type="text" placeholder="1000-1400">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br/>   
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                    <div class="btn btn-success" onclick="openModalConf('MonthForm')">Ok</div> 
                                </div>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel">
            <div class="panel-body">
                <div class="col-lg-12 col-sm-12">
                    <h2 style="font-weight: bold;">Add shift list</h2>
                </div>
                <div class="col-lg-12 col-sm-12" style="padding-top: 20px">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Employee Name</td>
                                <td>Shift start date</td>
                                <td>Shift start time</td>
                                <td>Shift end date</td>
                                <td>Shift end time</td>
                                <td>Total hours</td>
                            </tr>
                        </thead>
                        <tbody id="add_shift_list_data">
                            <?php include _PATH . "instance/front/tpl/add_shift_data.php"; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="confModal" class="modal fade in" role="dialog" >
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body ">
                Would you like to repeat/copy this shift? 
            </div>

            <div class="modal-footer">
                <div class="btn btn-default pull-left" onclick="openCopy()">Yes</div>
                <div class="btn btn-default pull-left" onclick="formSubmit()" style="margin-left:10px;">No</div>
                <div class="clearfix" ></div>
            </div>
        </div>
    </div>
</div>

<div id="copyModal" class="modal fade in" role="dialog" >
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body ">
                Enter end date : <input type="text" id="endDate" name="endDate" class="form-control" placeholder="YYYY-MM-DD">
                <br/>
                <span class="btn btn-success" onclick="dateChnges('month')">This Month</span>
                <span class="btn btn-success" onclick="dateChnges('+3month')">+3 Month</span>
                <span class="btn btn-success" onclick="dateChnges('+6month')">+6 Month</span>
            </div>

            <div class="modal-footer">
                <div class="btn btn-default pull-left" onclick="submitCopy()">Yes</div>
                <div class="btn btn-default pull-left" data-dismiss="modal" style="margin-left:10px;">No</div>
                <div class="clearfix" ></div>
            </div>
        </div>
    </div>
</div>

<div id="leaveModal" class="modal fade in" role="dialog" >
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body leaveBody">

            </div>
            <div class="clearfix" ></div>
            <div class="modal-body">
                <div class="btn btn-default pull-left" onclick="allowDates()">Allow Dates</div>
                <div class="btn btn-default pull-left" data-dismiss="modal">No</div>
                <div class="clearfix" ></div>
            </div>

        </div>
    </div>
</div>

<div id="deleteModal" class="modal fade in" role="dialog" >
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Are you sure you want to delete this shift? </h4>
            <form action="<?php echo _U ?>add_shift_new" method="post">
                <input type="hidden" name="deleteShift" value="1"/>
                <input type="hidden" id="deleteShiftId" name="deleteShiftId" value=""/>
                <button type="submit" class="btn btn-default pull-left">Yes</button>
            </form>

            <div class="btn btn-default pull-left" data-dismiss="modal">No</div>
            <div class="clearfix" ></div>
        </div>
    </div>
</div>