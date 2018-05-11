<?php

if (isset($companyId) && $companyId > 0) {
    $unsetEmployee = q("SELECT id,
                               access_level,
                               designated_approver,
                               work_at,
                               location,
                               team_id 
                          FROM tb_employee WHERE designated_approver = 0 AND work_at = '{$companyId}' AND access_level !='Admin' AND access_level !='admin'");
    foreach ($unsetEmployee as $eachEmployee):
        $setDesignatedApprover = 0;
        if (strtolower($eachEmployee['access_level']) == 'employee') {
            $setDesignatedApprover = team::getTeamManagerId($eachEmployee['team_id']);
            if ($setDesignatedApprover == 0) {
                $setDesignatedApprover = team::getTeamSupervisorId($eachEmployee['team_id']);
            }
            /*
            if ($setDesignatedApprover == 0) {
                $setDesignatedApprover = employeeDetail::getAdminIdFromCopmanyId($companyId);
            }
            */
        } else if (strtolower($eachEmployee['access_level']) == 'manager' || strtolower($eachEmployee['access_level']) == 'supervisor') {
            /*
            if ($setDesignatedApprover == 0) {
                $setDesignatedApprover = employeeDetail::getAdminIdFromCopmanyId($companyId);
            }
            */
        }
        $fieldUpdateDesignated = array();
        if($setDesignatedApprover > 0){
             $fieldUpdateDesignated['designated_approver'] = $setDesignatedApprover;
             qu("tb_employee", $fieldUpdateDesignated, " id = '{$eachEmployee['id']}'");
        }
    endforeach;
}
?>