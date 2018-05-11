<?php

/**
 * team Class
 * 
 * Class to team related functions
 * 
 * @author Hardik Panchal 
 * @version 1.0
 * @package Whozoor
 * 
 */
class team {

    public function __construct() {
        
    }

    # get the team name

    public static function getTeamName($teamId) {
        $teamName = '';
        $data = qs("select name from  tb_team where id = '{$teamId}'");
        if(!empty($data)){
           $teamName = $data['name']; 
        }
        return $teamName; 
    }
    
    public static function getTeamManagerId($teamId){
        $managerId = 0;
        $res = qs("SELECT id FROM tb_employee WHERE team_id = '{$teamId}' AND LOWER(access_level) = 'manager' ORDER BY id DESC LIMIT 0,1");
        if(!empty($res)){
            $managerId = $res['id'];
        }
        return $managerId;
    }
    
    public static function getTeamSupervisorId($teamId){
        $supervisorId = 0;
        $res = qs("SELECT id FROM tb_employee WHERE team_id = '{$teamId}' AND LOWER(access_level) = 'supervisor' ORDER BY id DESC LIMIT 0,1");
        if(!empty($res)){
            $supervisorId = $res['id'];
        }
        return $supervisorId; 
    }

    

}
