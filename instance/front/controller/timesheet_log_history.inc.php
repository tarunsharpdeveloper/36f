<?php
if (!isset($_SESSION['user'])) {
    _R('login');
}

if (isset($_REQUEST['id']) && $_REQUEST['id'] !=0) {
    
    $id = "time_shift_id='" . $_REQUEST['id'] . "'";
    $qry = "SELECT tl.*,e.fname,e.lname 
            FROM timesheet_log tl
            LEFT JOIN tb_employee e ON (tl.modified_by=e.id) 
            WHERE {$id} ";    

    $subq = q($qry);
     

}

$jsInclude = 'timesheet_log_history.js.php';
$_templete = "iframe_layout.tpl.php";
_cg("page_title", "Timesheet History");

