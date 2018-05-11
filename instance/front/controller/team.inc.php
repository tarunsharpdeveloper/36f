<?php

if (!isset($_SESSION['user'])) {
    _R('login');
}
$team = q("select * from tb_team");
if (isset($_REQUEST['isAddTeam'])) {

    $data = array();
    parse_str($_REQUEST['ladelData'], $data);
//    d($data);
//    die;
    $location = $data['selectLocations'];
//    foreach ($location as $value) {
//        $area_of_work .= $value . ',';
//    }
//    $area_of_work = rtrim($area_of_work, ',');
    $locID = array_values($data['hidLocaid']);
    $fields = array();
    $fields['location_id'] = $data['hidLocaid'];
    $fields['name'] = $data['a_name'];
    $fields['company_id'] = $_SESSION['company']['id'];
    $st1 = qi("tb_team", $fields);
    $newTeamID = qs("select id from tb_team where location_id IN ('{$data['hidLocaid']}' ) and  company_id='{$_SESSION['company']['id']}'  and name='{$data['a_name']}' ");
    foreach ($location as $loc) {

        $fields = array();
        $fields['location_id'] = $loc;
        $fields['team_id'] = $newTeamID['id'];
        qi("tb_team_locations", $fields);
    }

    if (!empty($st1)) {
        $success = "1";
        $msg = "Record Inserted Successfull";
    } else {
        $success = "0";
        $msg = "Record Not Inserted Successfull";
    }
    echo json_encode(array("success" => $success, "msg" => $msg));
    die();
}
if (isset($_REQUEST['iseditTeam'])) {

    $data = array();
    parse_str($_REQUEST['ladelData'], $data);
//    d($data);
//    die;
    $id = $data['teamID'];
    $location = $data['selectLocations'];
//    foreach ($location as $value) {
//        $area_of_work .= $value . ',';
//    }
//    $area_of_work = rtrim($area_of_work, ',');
    qd("tb_team_locations", "team_id='$id'");
    $locID = array_values($data['hidLocaid']);
    $fields = array();
    $fields['location_id'] = $data['hidLocaid'];
    $fields['name'] = $data['e_name'];
    $fields['company_id'] = $_SESSION['company']['id'];
    $st1 = qu("tb_team", $fields, "id='$id'");
    $newTeamID = qs("select id from tb_team where location_id IN ('{$data['hidLocaid']}' ) and  company_id='{$_SESSION['company']['id']}'  and name='{$data['e_name']}' ");
    foreach ($location as $loc) {

        $fields = array();
        $fields['location_id'] = $loc;
        $fields['team_id'] = $newTeamID['id'];
        qi("tb_team_locations", $fields);
    }

    if (!empty($st1)) {
        $success = "1";
        $msg = "Record Updated Successfull";
    } else {
        $success = "0";
        $msg = "Record Not Inserted Successfull";
    }
    echo json_encode(array("success" => $success, "msg" => $msg));
    die();
}
if (isset($_REQUEST['teamDelete'])) {
    $id = $_REQUEST['id'];
    qd("tb_team_locations", "team_id='$id'");
    $st1 = qd("tb_team", "id='$id'");
    if (!empty($st1)) {
        $success = "1";
        $msg = "Record Deleted Successfull";
    } else {
        $success = "0";
        $msg = "Sorry! Something Wrong";
    }
    echo json_encode(array("success" => $success, "msg" => $msg));
    die();
}
if (isset($_REQUEST['tablerefresh'])) {
    include _PATH . 'instance/front/tpl/team_data.php';
    die;
}
if (isset($_REQUEST['bindTeams'])) {
    $id = $_REQUEST['id'];
    $team = qs("select * from tb_team where id='$id'");
    $loc_team = q("SELECT * FROM `tb_team_locations` where team_id='{$team['id']}'");
    echo json_encode(array("team" => $team, "locTeam" => $loc_team));
    die;
}
$jsInclude = 'team.js.php';
_cg("page_title", "Team");

//select * from tb_team t,tb_team_locations tl where tl.team_id=t.id and t.id=79 
