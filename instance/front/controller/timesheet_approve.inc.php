<?php

//d(!isset($_SESSION['user']));
//die;
if (!isset($_SESSION['user'])) {
    _R('login');
}

//echo getTimeOffDisplayId()."<br>";
//echo getErrandsDisplayId();
//exit;

$limit = 25;
$offset = !empty($_GET['page']) ? (($_GET['page'] - 1) * $limit) : 0;

if (checkAccessLevel($_SESSION['user']['access_level'], 'timesheet', 'view')) {

    $Tid = $_REQUEST['user_id'] != '' ? "sci.user_id='" . $_REQUEST['user_id'] . "'" : '1=1';
    $Tqry = "SELECT count(sci.id) as Total 
		FROM tb_shift_time sci 
		LEFT JOIN tb_employee e ON(sci.user_id=e.id)
		WHERE {$Tid} ";

    $Tsubq = qs($Tqry);

    $pagConfig = array(
        'baseURL' => 'timesheet_approve',
        'totalRows' => $Tsubq['Total'],
        'perPage' => $limit
    );
    $pagination = new Pagination($pagConfig);

    $id = $_REQUEST['user_id'] != '' ? "sci.user_id='" . $_REQUEST['user_id'] . "'" : '1=1';
    $qry = "SELECT sci.*,e.fname as empFname,e.lname as empLname 
		FROM tb_shift_time sci 
		LEFT JOIN tb_employee e ON(sci.user_id=e.id)
		WHERE {$id} ORDER BY sci.id DESC LIMIT {$offset},{$limit}";

    $subq = q($qry);
}

function getStatusOfEmployee($status_code) {
    if ($status_code == "0") {
        return "Pending";
    }
    if ($status_code == "1") {
        return "Approved";
    }
    if ($status_code == "2") {
        return "Rejected";
    }
}

$jsInclude = 'timesheet_approve.js.php';
_cg("page_title", "timesheet_approve");


