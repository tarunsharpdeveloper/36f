<?php

//_errors_on();
/*
 http://45.79.140.218/wz_dev/dev/v1/api/errands_edit?errands_id=ER864131&from_date_time=۱۳۹۶-۱۲-۱۲&to_date_time=&start_time=۰۲:۰۰&end_time=۲۲:۰۰&transportation_method=&company_id=4&day_request_submitted=&requested_by=&manager_comments=&starting_point=&token_36five=36five&absence_type=2&food_authorization=0&subject=Testing&destination=&errands_type=1&lodging=&employee_comments=&overnight_compensation=0&user_id=300 
  http://45.79.140.218/wz_dev/v1/api/errands_add
  ["transportation_method":
  "تاکسی",
  "company_id": "4",
  "day_request_submitted": "2018-01-19",
  "requested_by": "Jayesh",
  "manager_comments": "",
  "from_date_time": "2018-01-19 15:00:00",
  "starting_point": "Rajkot",
  "to_date_time": "2018-01-19 15:30:00",
  "food_authorization": "1",
  "subject": "Test",
  "destination": "Ahmedabad",
  "errands_type": "2",
  "lodging": "Stay on hotel",
  "employee_comments": "This is first errand request",
  "overnight_compensation": "1",
  "employee_id": "300"]

 */

$toDateTimeAvailable = 1;
if (trim($_REQUEST['to_date_time']) == '') {
    $toDateTimeAvailable = 0;
}

$currentDate = date('Y-m-d');
$setErrandType = '';
if (isset($_REQUEST['errands_type']) && $_REQUEST['errands_type'] == 1) {
    $setErrandType = 'local';
} else if (isset($_REQUEST['errands_type']) && $_REQUEST['errands_type'] == 2) {
    $setErrandType = 'out of town';
}

$setOvernightCompensation = '';
if (isset($_REQUEST['overnight_compensation']) && $_REQUEST['overnight_compensation'] == 1) {
    $setOvernightCompensation = 'yes';
} else if (isset($_REQUEST['overnight_compensation']) && $_REQUEST['overnight_compensation'] == 0) {
    $setOvernightCompensation = 'no';
}

$setFoodAuthorization = '';
if (isset($_REQUEST['food_authorization']) && $_REQUEST['food_authorization'] == 1) {
    $setFoodAuthorization = 'yes';
} else if (isset($_REQUEST['food_authorization']) && $_REQUEST['food_authorization'] == 0) {
    $setFoodAuthorization = 'no';
}


$setTransportationMethod = '';
if (isset($_REQUEST['transportation_method']) && $_REQUEST['transportation_method'] == 1) {
    $setTransportationMethod = 'taxi';
} else if (isset($_REQUEST['transportation_method']) && $_REQUEST['transportation_method'] == 2) {
    $setTransportationMethod = 'bus';
} else if (isset($_REQUEST['transportation_method']) && $_REQUEST['transportation_method'] == 3) {
    $setTransportationMethod = 'train';
} else if (isset($_REQUEST['transportation_method']) && $_REQUEST['transportation_method'] == 4) {
    $setTransportationMethod = 'plane';
} else if (isset($_REQUEST['transportation_method']) && $_REQUEST['transportation_method'] == 5) {
    $setTransportationMethod = 'ajans';
} else if (isset($_REQUEST['transportation_method']) && $_REQUEST['transportation_method'] == 6) {
    $setTransportationMethod = 'BRT';
} else if (isset($_REQUEST['transportation_method']) && $_REQUEST['transportation_method'] == 7) {
    $setTransportationMethod = 'metro';
} else if (isset($_REQUEST['transportation_method']) && $_REQUEST['transportation_method'] == 8) {
    $setTransportationMethod = 'personal car';
}



$unique_id = _e($_REQUEST['errands_id'], 0);

if (isset($_REQUEST['unique_id'])) {
    $unique_id = $_REQUEST['unique_id'];
}

$fields = array();

if (!$unique_id) {
    $fields['success'] = '0';
    $fields['msg'] = 'INVALID_ERRANDS_ID';
    echo _api_response($fields);
    die;
}

//$errandId
$getErrandId = qs("SELECT id FROM errands WHERE unique_id = '{$unique_id}' ORDER BY id DESC LIMIT 0,1");

if (!empty($getErrandId)) {
    $errandIdVal = $getErrandId["id"];
    $errandRecDetail = qs("SELECT * FROM errands WHERE id = '{$errandIdVal}'");
}

if (!empty($errandRecDetail)) {
    if ($currentDate >= date('Y-m-d', strtotime($errandRecDetail["from_date_time"]))) {
        $fields['success'] = '0';
        $fields['msg'] = '.تغییر برای درخواست مورد نظر امکان پذیر نیست. در صورت نیاز با منابع انسانی سازمان تماس بگیرید';
        echo _api_response($fields);
        die;
    }
}


$_REQUEST['start_time'] = _e($_REQUEST['start_time'], "00:00:00");
$_REQUEST['end_time'] = _e($_REQUEST['end_time'], "00:00:00");
$from_date_shamsey = _persianToDigits("{$_REQUEST['from_date_time']} {$_REQUEST['start_time']}");
$from_date_shamseyArr = explode(" ", $from_date_shamsey);
$convert_from_time = trim($from_date_shamseyArr[1]);
if (strlen(trim($convert_from_time)) == 5) {
    $convert_from_time = $convert_from_time . ":00";
}

$_REQUEST['to_date_time'] = $_REQUEST['to_date_time'] == '' ? $_REQUEST['from_date_time'] : $_REQUEST['to_date_time'];
$to_date_shamsey = _persianToDigits("{$_REQUEST['to_date_time']} {$_REQUEST['end_time']}");
$to_date_shamseyArr = explode(" ", $to_date_shamsey);
$convert_to_time = trim($to_date_shamseyArr[1]);
if (strlen(trim($convert_to_time)) == 5) {
    $convert_to_time = $convert_to_time . ":00";
}


$converted_eng_from = _j2g_full($from_date_shamsey);
$converted_eng_fromArr = explode(" ", $converted_eng_from);
$converted_eng_to = _j2g_full($to_date_shamsey);
$converted_eng_toArr = explode(" ", $converted_eng_to);

/*
$_REQUEST['from_date_time'] = trim($converted_eng_fromArr[0]) . " " . $convert_from_time;
if ($toDateTimeAvailable == 0) {
    $_REQUEST['to_date_time'] = trim($converted_eng_fromArr[0]) . " " . $convert_to_time;
} else {
    $_REQUEST['to_date_time'] = trim($converted_eng_toArr[0]) . " " . $convert_to_time;
}
*/
$_REQUEST['from_date_time'] = $converted_eng_from;
$_REQUEST['to_date_time'] = $converted_eng_to;         

if (!$_REQUEST['from_date_time']) {
    $fields['success'] = '0';
    $fields['msg'] = 'INVALID_FROM_DATE';
    echo _api_response($fields);
    die;
}

if (!$_REQUEST['to_date_time']) {
    $fields['success'] = '0';
    $fields['msg'] = 'INVALID_TO_DATE';
    echo _api_response($fields);
    die;
}


$db_fields = array();

$companyName = '';
$companyId = _e($_REQUEST['company_id'], 0);
if ($companyId > 0) {
    $companyName = employeeDetail::getCompanyNameFromCopmanyId($companyId);
}
$employeeId = _e($_REQUEST['employee_id'], 0);
$employeeArr = employeeDetail::GetEmployeeNameAndEmail($employeeId);


$absence_type = $_REQUEST['absence_type'] == '1' ? "hourly" : 'entireDay';

$fromDate = date('Y-m-d H:i:s', strtotime(trim(_e($_REQUEST['from_date_time'], time()))));
$toDate = date('Y-m-d H:i:s', strtotime(trim(_e($_REQUEST['to_date_time'], time()))));
$fromDateCompare = date("Y-m-d H:i:s", strtotime($_REQUEST['from_date_time']));
$toDateCompare = date("Y-m-d H:i:s", strtotime($_REQUEST['to_date_time']));
$date1 = date_create($fromDateCompare);
$date2 = date_create($toDateCompare);
$diff = date_diff($date1, $date2);
if ($diff->invert == 1) {

    $nextDay = date('Y-m-d H:i:s', strtotime("+1 day", strtotime($toDateCompare)));   
    $toDate = $nextDay;
    $toDateCompare = $nextDay;
    $nextDate = date_create($nextDay);
    $diff = date_diff($date1, $nextDate);
}

//$db_fields['status'] = 'NEW_REQUESTED';
$db_fields['errands_type'] = _e($setErrandType, '');
$db_fields['subject'] = _e($_REQUEST['subject'], '');

$db_fields['from_date_time'] = date("Y-m-d H:i:s", strtotime($_REQUEST['from_date_time']));
$db_fields['to_date_time'] = $toDateCompare; 
$db_fields['day_request_submitted'] = _e($_REQUEST['day_request_submitted'], '');
$db_fields['requested_by'] = _e($_REQUEST['requested_by'], 0);
$db_fields['starting_point'] = _e($_REQUEST['starting_point'], '');
$db_fields['destination'] = _e($_REQUEST['destination'], '');
$db_fields['overnight_compensation'] = trim($setOvernightCompensation);
$db_fields['food_authorization'] = trim($setFoodAuthorization);
$db_fields['transportation_method'] = trim($setTransportationMethod);
$db_fields['lodging'] = _e($_REQUEST['lodging'], '');
$db_fields['expences'] = _e(trim($_REQUEST['expences']), 0);
$db_fields['absence_type'] = $absence_type;



$totalDaysMins = 0;

$emp_id = _e($_REQUEST['user_id'], 0);
$empWorkingHours = employeeDetail::GetEmployeePerDayWorkingHours($emp_id);

$leave = 0;
for ($i = 0; $i < ($diff->days + 1); $i++) {
    $sdate = '';
    $sdate = date("Y-m-d", strtotime("+" . $i . " Days", strtotime($fromDate)));
    $checkLeave = qs("select * from timesheet_leave where leave_date='{$sdate}' ");
    if (!empty($checkLeave)) {
        $leave++;
    }
}
$total_days = 0;
$total_days = ($diff->days + 1);
$total_days = $total_days - $leave;
$total_days_applied = $total_days;

if ($diff->days == 0) {
    $total_minutes_new = ($diff->i + ($diff->h * 60));
    if ($total_minutes_new == 0) {
        $total_minutes_new = ($empWorkingHours * ($total_days_applied));  
    }
} else {
    if (($diff->days + 1) > 0) {
        $totalDaysMins = ($empWorkingHours * $total_days_applied);
    }
    $total_minutes_new = $totalDaysMins + ($diff->i + ($diff->h * 60));
}

$db_fields['total_days'] = $total_minutes_new;
$db_fields['total_days_applied'] = $total_days_applied;
$db_fields['added_by_id'] = $emp_id;
$db_fields['employee_comments'] = _e($_REQUEST['employee_comments'], '');


qu("errands", _escapeArray($db_fields), " unique_id = '{$unique_id}'  ");

$fields['success'] = '1';
$fields['msg'] = 'UPDATED SUCCESSFULLY';  
$fields['data'] = $unique_id;


/* Start Notification entry code */
/*
  Admin
  Manager
  Supervisor
 */

/*
  $adminId = 0;
  if ($_REQUEST['company_id'] > 0) {
  $adminId = employeeDetail::getAdminIdFromCopmanyId($_REQUEST['company_id']);
  }

  $employeeInfo = array();
  $display_name = '';
  if ($_REQUEST['employee_id'] > 0) {
  $employeeInfo = employeeDetail::GetEmployeeNameAndEmail($_REQUEST['employee_id']);
  $display_name = $employeeInfo['full_name'];
  }


  $persianDate = new persian_date();
  $persianNumbers = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
  $persianMonthName = '';
  $persianDayName = '';
  $persianMonthName = $persianDate->to_date($db_fields['from_date_time'], 'M');
  $persianDayName = $persianDate->to_date($db_fields['from_date_time'], 'd');
  $persianNoDate = '';
  $persianNumbers1 = substr($persianDayName, 0, 1);
  $persianNumbers2 = substr($persianDayName, 1, 1);
  if ($persianNumbers1 != '') {
  $persianNoDate .= $persianNumbers[$persianNumbers1];
  }
  if ($persianNumbers2 != '') {
  $persianNoDate .= $persianNumbers[$persianNumbers2];
  }

  $notifyField = array();
  $notifyField['emp_id'] = $adminId;
  $notifyField['company_id'] = _e($_REQUEST['company_id'], 0);
  $notifyField['type_add_edit'] = 'add';
  $notifyField['module_name'] = 'errand';
  $notifyField['module_rec_id'] = $id;

  $notifyField['display_text'] = '<div><div style="float:left;width:auto;height:1px;">' . $display_name . ' want to new errand request at, </div><div style="float:left;margin-left:6px;"><div style="float:left;">' . $persianMonthName . '</div><div style="float:right;margin-left:6px;">' . $persianNoDate . '</div><div class="clearfix"></div></div><div class="clearfix"></div></div>';
  //$notifyField['display_text'] = $display_name.' want to new errand request at '.date("M d,Y", ($db_fields['from_date_time']));
  $notifyField['add_edit_by_userid'] = _e($_REQUEST['employee_id'], 0);
  qi('tb_notifications', _escapeArray($notifyField));
 */
/* End Notification entry code */


_api_response($fields);
die;
