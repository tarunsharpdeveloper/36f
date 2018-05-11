<?php
if (!isset($_SESSION['user'])) {
    _R('login');
}
if (isset($_REQUEST['save_timesheet'])) {

   $_fields['emp_id'] = $_REQUEST['emp_id'];
   $_fields['t_date'] = $_REQUEST['t_date'];
   $_fields['area'] =  $_REQUEST['area'];
   $_fields['start_time'] = $_REQUEST['start_time'];
   $_fields['end_time'] =  $_REQUEST['end_time'];
   $_fields['break_time'] = $_REQUEST['break_time'];
   $_fields['total_time'] =  $_REQUEST['total_time'];
   $_fields['notes'] =  $_REQUEST['notes'];
   
   
   qi("tb_timesheet", $_fields);
   _R('timesheet');

    
}

$jsInclude = 'new_timesheet.js.php';
_cg("page_title", "New TimeSheet");


            