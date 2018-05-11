<style>
body{ height: 100%; background: #dfe2e6; }
.main-content{ float: left;margin: 0;padding: 0;min-height: min-content;min-width: 100%; }
label{ font-weight: inherit; margin-bottom: 12px; }
</style>
<div style="" class="main-content">
    <div class="panel">
    
        <div class="panel-body">
            <div>
                <div class="col-sm-12">
                    <h2 style="font-weight: bold;">Timesheet History</h2>
                </div>
            </div>
        </div>
        
            <div class="panel-body" id="refreshTask">
                <table id="datatable-responsive0a" class="table table-striped no-border responsive no-wrap" cellspacing="0" width="100%" style="margin: 0 0 0 0; border: none;">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Modified By</th>
                            <th>Updated Data</th>
                            <th>Modified Action</th>
                            <th>Modified Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(count($subq) > 0){ ?>
                            <?php foreach ($subq as $val) { ?>
                                <tr>
                                    <td><?= $val['id'] ?></td>
                                    <td><?= $val['fname']." ".$val['lname'] ?></td>
                                    <td>
                                    <?php
                                    if($val['updated_fields'] !=""){
                                      $jsd = json_decode($val['updated_fields']);
                                      foreach ($jsd as $key => $value) {
                                          if($key == "e_date"){
                                            $k = "End Date";
                                          }else if($key == "s_date"){
                                            $k = "Start Date";
                                          }else if($key == "e_time"){
                                            $k = "End Time";
                                          }else if($key == "s_time"){
                                            $k = "Start Time";
                                          }
                                          echo $k. " : " .$value."<br>";
                                      }
                                    }else{
                                      echo "status updated";
                                    } 
                                      
                                    
                                    ?>
                                    </td>
                                    <td><?= $val['action'] ?></td>
                                    <td><?= date("m/d/Y H:i:s",strtotime($val['created_at'])) ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        <?php }else{ ?>
                                <tr>
                                    <td colspan='5' class="text-center">No record(s) found!</td>
                                </tr>
                        <?php } ?>
                        

                    </tbody> 
                </table>

            </div>
        
    
</div>
</div>
