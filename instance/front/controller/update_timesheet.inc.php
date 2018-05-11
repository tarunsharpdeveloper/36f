<?php
if (!isset($_SESSION['user'])) {
    _R('login');
}

if (isset($_REQUEST['id']) && $_REQUEST['id'] !=0) {
    $Auto_Id = $_REQUEST['id'];

    $id = "id='" . $_REQUEST['id'] . "'";
    $qry = "SELECT * 
            FROM tb_shift_time 
            WHERE {$id} ";    

    $subq = qs($qry);
    if(count($subq) > 0){
        $old_val_array = array();
        
        $s_date = ($subq['sDate']!="" && $subq['sDate'] !="0000-00-00 00:00:00") ? date("m/d/Y",strtotime($subq['sDate'])) : "";
        $s_time = ($subq['start_time'] != NULL) ? $subq['start_time'] : "" ;
        $e_date = ($subq['end_date'] !="" && $subq['end_date'] !="0000-00-00") ? date("m/d/Y",strtotime($subq['end_date'])) : "" ;
        $e_time = ($subq['end_time'] !="") ? $subq['end_time'] : "" ;   

        $old_val_array['s_date'] = $s_date;
        $old_val_array['s_time'] = $s_time;
        $old_val_array['e_date'] = $e_date;
        $old_val_array['e_time'] = $e_time;

    }
}

if (isset($_REQUEST['save'])) {

    $errors = array();
    $is_success = false;
    if($_REQUEST['s_date'] ==""){
        $errors['s_date'] = "Start date is require";    
    }
    if($_REQUEST['s_time'] ==""){
        $errors['s_time'] = "Start time is require";    
    }
    if($_REQUEST['e_date'] ==""){
        $errors['e_date'] = "End date is require";    
    }
    if($_REQUEST['e_time'] ==""){
        $errors['e_time'] = "End time is require";    
    }
    
    $s_date = $_REQUEST['s_date'];
    $s_time = $_REQUEST['s_time'];
    
    $exp_stime = explode(":", $s_time);

    if(strlen($exp_stime[0]) == "1"){
        $s_time = "0".$s_time;
    }  

    $e_date = $_REQUEST['e_date'];
    $e_time = $_REQUEST['e_time'];    
    
    $exp_etime = explode(":", $e_time);

    if(strlen($exp_etime[0]) == "1"){
        $e_time = "0".$e_time;
    }

    if(empty($errors)){
        $fields = array();
        $fields['sDate'] = date("Y-m-d",strtotime($_REQUEST['s_date']));
        $fields['start_time'] = $s_time;
        $fields['end_date'] = date("Y-m-d",strtotime($_REQUEST['e_date']));
        $fields['end_time'] = $e_time;

        qu("tb_shift_time", $fields, " id='{$Auto_Id}'");
        
        $new_val_array = array();
        $new_val_array['s_date'] = date("m/d/Y",strtotime($_REQUEST['s_date']));
        $new_val_array['s_time'] = $s_time;
        $new_val_array['e_date'] = date("m/d/Y",strtotime($_REQUEST['e_date']));
        $new_val_array['e_time'] = $e_time;

        $result = array_diff($new_val_array,$old_val_array);
        
        if(count($result)>0){
            $fields = array();
            $old_val_json = json_encode($old_val_array);
            $new_val_json = json_encode($new_val_array);
            $updated_val_json = json_encode($result);

            $fields['time_shift_id'] = $subq['id'];
            $fields['modified_by'] = $_SESSION['user']['id'];
            $fields['user_id'] = $subq['user_id'];
            $fields['old_json'] = $old_val_json;
            $fields['new_json'] = $new_val_json;
            $fields['updated_fields'] = $updated_val_json;
            $fields['action'] = "update";
            
            qi("timesheet_log",$fields);

            $fields = array();
        }

        $is_success = true; 
        //echo "<script>$.notify({message: 'Successfull'},{ type: 'danger'});</script>";
        //echo "<script>window.parent.location.href = 'timesheet_approve';</script>";
        //_R("timesheet_approve");

    }
    
    
}

$jsInclude = 'update_timesheet.js.php';
$_templete = "iframe_layout.tpl.php";
_cg("page_title", "Location");

