<?php

$gego_date = explode("-", date("Y-m-d"));
$jala_date = gregorian_to_jalali($gego_date[0], $gego_date[1], $gego_date[2]);
if ($_REQUEST['secondSection'] == '1') {
//    d($_SESSION);
    parse_str($_REQUEST['data'], $arr);
//    d($arr);
    $fields = array();
    $fields['fname'] = $arr['firstname'];
    $fields['lname'] = $arr['lastname'];
    $fields['email'] = $arr['email'];
    $fields['mobile'] = $arr['mobile'];
    $fields['dob'] = $arr['pyear'] . "-" . $arr['pmonth'] . "-" . $arr['pdate'];
    $fields['birth_cert'] = $arr['BCN'];
    $fields['bod_issue_no'] = $arr['BCI'];
    $fields['ID_no'] = $arr['IDN'];
    $fields['gender'] = $arr['gender'];
    if ($arr['gender'] == 'male') {
        $fields['military_status'] = $arr['military'];
    }
    $fields['address'] = $arr['address'];
    $fields['city'] = $arr['city'];
    $fields['home_phone'] = $arr['phone'];
    $fields['marital_status'] = $arr['marital'];
    $fields['state'] = $arr['state'];
    $fields['post_code'] = $arr['postcode'];
    $fields['last_degree'] = $arr['degree'];
    $fields['veteran'] = $arr['veteran'];
    $fields['em_phone'] = $arr['EPhone'];
    $fields['em_contact_name'] = $arr['ECName'];
    $fields['fathers_name'] = $arr['father'];
    $fields['relation'] = $arr['relation'];
    $fields['monthly_salary'] = str_replace(",", "", $arr['monthlySalary']);
    $fields['terminate_date'] = $arr['Tyear'] . "-" . $arr['Tmonth'] . "-" . $arr['Tdate'];
    $fields['hired_on'] = $arr['Hyear'] . "-" . $arr['Hmonth'] . "-" . $arr['Hdate'];
    $fields['employee_no'] = $arr['employeeNumber'];
    $fields['access_level'] = $arr['accessLevel'];
    $fields['contract_type'] = $arr['contractType'];
    foreach ($arr['location'] as $value) {
        $localtion = $localtion . $value . ",";
    }
    $fields['location'] = rtrim($localtion, ',');
    foreach ($arr['team'] as $value) {
        $team = $team . $value . ",";
    }
    $fields['team_id'] = rtrim($team, ',');
    $fields['work_shuttle'] = $arr['workShuttle'];
//    d($fields);
    $condition = 'id=' . $_SESSION['user']['id'];
    qu('tb_employee', _escapeArray($fields), $condition);
    unset($fields);
    $fields['position'] = $arr['position'];
    $condition = 'id=' . $_SESSION['company']['id'];
    qu('tb_company_works', _escapeArray($fields), $condition);
    $_SESSION['user'] = qs("select  * from tb_employee where id=" . $_SESSION['user']['id']);
    $_SESSION['company'] = qs("select  * from tb_company_works where id=" . $_SESSION['company']['id']);
    die;
}
if (!isset($_SESSION['user'])) {
    _R('login');
}

$jsInclude = 'myaccount.js.php';
_cg("page_title", "Me Home");


