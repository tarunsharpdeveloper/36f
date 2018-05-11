<?php

$location = "-1";
$company_id = "275";


$company_locations = q(" select * from  tb_location where company_id = '{$company_id}' ");

$db = Db::__d();
$query = "select * from  tb_team where company_id = '{$company_id}' ";
//d($query);
$company_teams = $db->format_data($db->query($query), 'id');
//d($company_teams);die;

if ($location != '-1') {
    $team = q("select * from tb_team where location_id='{$location}'");
    $emp = q("select * from tb_employee  where location='{$location}'");
} else {
    $company = "275";
    $team = q("select * from tb_team where company_id='{$company}'");
    $emp = q("select * from tb_employee where team_id in (SELECT id FROM `tb_team` where company_id = '{$company}')");
}
$team_wise_emp = [];
foreach ($emp as $each_emp) {
    $team_wise_emp[$each_emp['team_id']][] = $each_emp;
}
//d($team_wise_emp);die;
$jsInclude = "temp_summary.js.php";
?>