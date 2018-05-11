<?php

$apiAsana = new authAsana();
$token_data = qs("select * from tb_asana_token");
$token = $token_data['access_token'];
$authorization_code = $token_data['authorization_code'];
$error = 0;
$ticket_detail = qs("select * from tb_ticket where id='{$ticket_id}' AND task_id!='0'");

if ($get_comment == 1) {
    if (!empty($ticket_detail)) {
        $data1 = $apiAsana->GetTaskComment($token, $ticket_detail['task_id']);
        $data2 = json_decode($data1, true);

        if (!isset($data2['data'])) {
            if (isset($data2['errors'][0]['message']) && stripos($data2['errors'][0]['message'], "expired") !== FALSE) {
                $new_token = $apiAsana->refreshToken($authorization_code);
                if (isset($new_token['access_token'])) {
                    $token = $new_token['access_token'];
                    $data1 = $apiAsana->GetTaskComment($token, $ticket_detail['task_id']);
                    $data2 = json_decode($data1, true);
                    if (!isset($data2['data'])) {
                        $error = 1;
                        writeLog($data1);
                    }
                } else {
                    writeLog($new_token);
                    $error = 1;
                }
            } else {
                writeLog($data1);
                $error = 1;
            }
        }
        if ($error == 0 && isset($data2['data'])) {
            foreach ($data2['data'] as $each_comment) {
                if ($each_comment['type'] != 'comment' ||  !stripos($each_comment['text'], "[final-decision]"))
                    continue;
                $comment = qs("select * from tb_ticket_comments where comment_id='{$each_comment['id']}'");
                if (empty($comment)) {
                    $fields = array();
                    $fields['ticket_id'] = $ticket_id;
                    $fields['username'] = $each_comment['created_by']['name'];
                    $fields['comment_id'] = $each_comment['id'];
                    $fields['comments'] = str_ireplace("[final-decision]", "", $each_comment['text']);
                    $fields['added_on'] = $each_comment['created_at'];
                    qi("tb_ticket_comments", _escapeArray($fields));
                }
            }
        }
    }
} else {
    if (!empty($ticket_detail)) {
        $comment_asana = "[from-cs-agent]".$comment;
        $comment_body = array("data" => array("task" => $ticket_detail['task_id'], "text" => _escape($comment_asana)));
        $data1 = $apiAsana->CreateTaskComment($token, $ticket_detail['task_id'], $comment_body);
        $data2 = json_decode($data1, true);
        if (isset($data2['data']['id'])) {
            $is_push = '1';
            $comment_id = $data2['data']['id'];
        }
    }
}
?>