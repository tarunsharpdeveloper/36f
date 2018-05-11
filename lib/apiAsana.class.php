<?php

/*
 * Class file for asana api integration
 * http://developers.asana.com — here is all the info you need to review.
 *
 * api key: lbToJaK.0h1vux8YRG3p9DaKZcsmqLHB : Brilliant
 * 
 * Keys for Raj: ( Test Account )
 * public $key = "2Ba7cu7K.GHUSdSlRGgZFjOtAsXIS76a";
 * public $workspace = "9170437901315";
 * 
 */

class apiAsana extends Asana {

    public $prod_key = "lbToJaK.0h1vux8YRG3p9DaKZcsmqLHB";
    public $prod_workspace = "4080396604871";
    public $dev_key = "2Ba7cu7K.GHUSdSlRGgZFjOtAsXIS76a";
    public $dev_workspace = "9170437901315";
    public $project_ids = array("dd" => '234139149874442', "cd" => '234139149874443', "c_level" => '234139149874444');

    public function __construct() {
        
    }

    /**
     * 
     * Return all the users in system for asana 
     * Managers + Mechanics for all cities
     * 
     */
    public function asanaEmailsByCity() {
        $db = db::__d();
        $query = "select * from asana_users ";
        $users = $db->format_data($db->query($query), 'city_code', 'role');
        return $users;
    }

    /**
     * push tasks from  asana_tasks_queue 
     * to asana
     */
    public function pushTasks() {
        $query = "select * from  asana_tasks_queue where addedToAsana = '0' ";
        $tasksToAdd = q($query);

        // get asana system users;
        $asanaSystemUsers = $this->asanaEmailsByCity();


        $asana = new Asana($this->prod_key);

        // get all asana users
        $asanaUsers = $asana->getUsers("?opt_fields=name,email");
        $asanaUsers = json_decode($asanaUsers, true);

        if (empty($asanaUsers)) {
            _l("no asana usrs");
            return false;
        }

        // get all users from asana
        // update his asana user id into our system db ( just in case we need in future )
        $asanaUsersByEmail = array();
        foreach ($asanaUsers['data'] as $each_user) {
            $asanaUsersByEmail[$each_user['email']] = $each_user['id'];
            qu("asana_users", array('asanaUserId' => $each_user['id']), "  email = '{$each_user['email']}' ");
        }

        $project_id = $this->project_ids['repair'];

        foreach ($tasksToAdd as $each_tasks) {

            $followersEmails = $asanaSystemUsers[$each_tasks['carCityCode']]['Manager'];
            $dueDate = date("Y-m-d", strtotime("+1 Day"));

            # who is owner of the task
            switch (strtolower($each_tasks['typeOfTask'])) {
                case "maintenance":
                    $cityMechanic = $asanaUsersByEmail[$asanaSystemUsers[$each_tasks['carCityCode']]['Mechanics'][0]['email']];
                    $project_id = $each_tasks['carCityCode'] == 'CA' ? $this->project_ids['maintenance'] : $this->project_ids['garageNY'];
                    break;
                case "low_fuel":
                    $cityMechanic = 'rs@go-brilliant.com';
                    //$project_id = $this->project_ids['maintenance'];
                    $project_id = $this->project_ids['garageNY'];
					
                    $cityMechanic = $asanaUsersByEmail[$asanaSystemUsers[$each_tasks['carCityCode']]['Mechanics'][0]['email']];
                    $project_id = $each_tasks['carCityCode'] == 'CA' ? $this->project_ids['repair'] : $this->project_ids['garageNY'];					
					
                    break;
                case "repair":
                    $cityMechanic = $asanaUsersByEmail[$asanaSystemUsers[$each_tasks['carCityCode']]['Mechanics'][0]['email']];
                    $project_id = $each_tasks['carCityCode'] == 'CA' ? $this->project_ids['repair'] : $this->project_ids['garageNY'];
                    break;
                case "billing":
                    $cityMechanic = $asanaUsersByEmail[$asanaSystemUsers[$each_tasks['carCityCode']]['Billing'][0]['email']];
                    print "billing" . $project_id = $this->project_ids['billing'];
                    break;
                case "comments":
                    $cityMechanic = $asanaUsersByEmail[$asanaSystemUsers['NY']['Comments'][0]['email']]; // for billing always NY: Centralized
                    $project_id = $this->project_ids['comments'];
                    $followersEmails = $asanaSystemUsers[$each_tasks['carCityCode']]['CommentsManager'];
                    break;
                case "maint_alert":
                    $cityMechanic = $asanaUsersByEmail[$asanaSystemUsers[$each_tasks['carCityCode']]['Mechanics'][0]['email']]; // for billing always NY: Centralized
                    $project_id = $each_tasks['carCityCode'] == 'CA' ? $this->project_ids['maintenance'] : $this->project_ids['garageNY'];
                    break;
                case "special_requests":
                    $cityMechanic = $asanaUsersByEmail[$asanaSystemUsers[$each_tasks['carCityCode']]['TripRequests'][0]['email']]; // for billing always NY: Centralized
                    $project_id = $each_tasks['carCityCode'] == 'CA' ? $this->project_ids['specialRequest'] : $this->project_ids['garageNY'];
                    $followersEmails = $asanaSystemUsers[$each_tasks['carCityCode']]['TripRequestsManager'];
                    $tripTime = getTripTime($each_tasks['tripCode']);
                    $dueDate = date("Y-m-d H:i:s", strtotime($tripTime));
                    break;
                case "maint_alert":
                    $cityMechanic = $asanaUsersByEmail[$asanaSystemUsers[$each_tasks['carCityCode']]['Mechanics'][0]['email']]; // for billing always NY: Centralized
                    $project_id = $each_tasks['carCityCode'] == 'CA' ? $this->project_ids['maintenance'] : $this->project_ids['garageNY'];
                    break;
                default:
                    $cityMechanic = "temp@go-brilliant.com";
                    $project_id = $this->project_ids['repair'];
            }



            $followers = array();
            foreach ($followersEmails as $each_follower) {
                $followers[] = $asanaUsersByEmail[$each_follower['email']];
            }
            $followers = array_filter($followers);


            if (!$cityMechanic) {
                qu("asana_tasks_queue", array("addedToAsana" => '2', 'asanaTaskId' => 'MECHANIC_NOT_FOUND'), " id = '{$each_tasks['id']}' ");
                _l('Mechanic Not Found');
                continue;
            }

            if (!$each_tasks['asanaTaskId']) {
                $result = $asana->createTask(array(
                    "workspace" => $this->prod_workspace,
                    "name" => $each_tasks['subject'],
                    "notes" => $each_tasks['description'],
                    "assignee" => $cityMechanic,
                    "due_on" => $dueDate,
                    "followers" => $followers
                ));

                if ($asana->responseCode == "201" && !is_null($result)) {
                    $resultJson = json_decode($result);
                    $taskId = $resultJson->data->id;
                    $asana->addProjectToTask($taskId, $project_id);
                    _l("Task Created: {$taskId}");
                    qu("asana_tasks_queue", array("addedToAsana" => '1', 'asanaTaskId' => $taskId), " id = '{$each_tasks['id']}' ");
                } else {
                    echo "Error while trying to connect to Asana, response code: {$asana->responseCode}";
                }
            } else {
                _l("Task already exists. {$each_tasks['asanaTaskId']}");
                $result = $asana->updateTask($each_tasks['asanaTaskId'], array(
                    "workspace" => $this->prod_workspace,
                    "notes" => $each_tasks['description']
                ));
                qu("asana_tasks_queue", array("addedToAsana" => '1'), " id = '{$each_tasks['id']}' ");
            }
        }
        _l("Asana Tasks Push: End of the file..");
    }

}

?>
