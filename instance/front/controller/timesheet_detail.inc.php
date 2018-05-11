<?php

//function getWednesdays($y, $m) {
//    return new DatePeriod(
//            new DateTime("first sunday of $y-$m"), DateInterval::createFromDateString('next sunday'), new DateTime("last day of $y-$m")
//    );
//}
//
//foreach (getWednesdays(2017, 10) as $wednesday) {
//    $field = array();
//    $field['leave_date'] = $wednesday->format("Y-m-d");
//    $field['reason'] = $wednesday->format("l");
//    qi('timesheet_leave', _escapeArray($field));
//    $wednesday->format("l, Y-m-d\n");
//}
//die;
//d($_SESSION);
$companyID = $_SESSION['company']['id'];
$location = q("select * from tb_location where company_id='{$companyID}'");

if ($_REQUEST['loadEmp'] == '1') {
    $id = $_REQUEST['id'];
    $employee = q("select * from tb_employee where location='{$id}'");
    foreach ($employee as $value) {
        ?>
        <div onclick="getDetail('<?= $value['id'] ?>')">
            <h3><b><?= $value['fname'] . " " . $value['lname'] ?></b></h3>
            <?= $value['access_level'] ?>
        </div>
        <hr>
        <?php
    }
    die;
}
if ($_REQUEST['loadTimesheet'] == 1) {
    $data = q("SELECT * FROM `timesheet_summary` where emp_id='" . $_REQUEST['id'] . "'");
    include_once _PATH . 'instance/front/tpl/timesheet_summary_detail.php';
    die;
}

$jsInclude = "timesheet_detail.js.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

