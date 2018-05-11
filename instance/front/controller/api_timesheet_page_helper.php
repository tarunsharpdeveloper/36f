<?php

$fields = array();
$current_time = time();
switch ($_REQUEST['doc_helper']) {
    case "error":
        $fields['result'] = "error";
        $fields['msg'] = "INVALID_USER_ID";
        break;
    case "invalid_month":
        $fields['result'] = "error";
        $fields['msg'] = "INVALID_MONTH_ID";
        break;
    case "no_shift_data":
        $fields['result'] = "error";
        $fields['msg'] = "NO_SHIFT_DATA_FOUND";
        break;
    case "month_summary":
        $fields['result'] = 'success';
        $fields['monthly_summary'] = array();
        $fields['monthly_summary']['total_pending_time'] = '0';
        $fields['monthly_summary']['total_approved_time'] = '0';
        $fields['monthly_summary']['pending_ot'] = '0';
        $fields['monthly_summary']['approved_ot'] = '0';
        $fields['monthly_summary']['pending_bad_boy'] = '0';
        $fields['monthly_summary']['approved_bad_boy'] = '0';
        $fields['daily_data'] = array();
        $fields['daily_data'][] = array(
            'date' => '1396-9-20',
            'location' => 'test location',
            'team' => 'test team',
            "start_time" => '10:23',
            "end_time" => '19:58',
            "overtime" => "0",
            "badboy" => "0",
            "status" => "PENDING",
            "holiday" => array(
                'is_holiday' => '1',
                'farsi_name' => 'مرخصی بیماری',
            ),
            "timeout" => array(
                "is_timeout" => "0",
                "code" => "0",
                "farsi_name" => ""
            ),
            "is_abandon" => "1",
            "is_weekend" => "0"
        );
        $fields['daily_data'][] = array(
            'date' => '1396-9-21',
            'location' => 'test location',
            'team' => 'test team',
            "start_time" => '10:23',
            "end_time" => '19:58',
            "overtime" => "0",
            "badboy" => "0",
            "status" => "PENDING",
            "holiday" => array(
                'is_holiday' => '0',
                'farsi_name' => '',
            ),
            "timeout" => array(
                "is_timeout" => "0",
                "code" => "0",
                "farsi_name" => ""
            ),
            "is_abandon" => "0",
            "is_weekend" => "1"
        );
        $fields['daily_data'][] = array(
            'date' => '1396-9-22',
            'location' => 'test location',
            'team' => 'test team',
            "start_time" => '10:23',
            "end_time" => '19:58',
            "overtime" => "0",
            "badboy" => "0",
            "status" => "PENDING",
            "holiday" => array(
                'is_holiday' => '0',
                'farsi_name' => '',
            ),
            "timeout" => array(
                "is_timeout" => "1",
                "code" => "3",
                "farsi_name" => "مرخصی استعلاجی"
            ),
            "is_abandon" => "0",
            "is_weekend" => "0"
        );
        $fields['daily_data'][] = array(
            'date' => '1396-9-22',
            'location' => 'test location',
            'team' => 'test team',
            "start_time" => '10:23',
            "end_time" => '19:58',
            "overtime" => "0",
            "badboy" => "0",
            "total_time" => 8 * 60 * 60,
            "status" => "PENDING",
            "holiday" => array(
                'is_holiday' => '0',
                'farsi_name' => '',
            ),
            "timeout" => array(
                "is_timeout" => "0",
                "code" => "0",
                "farsi_name" => ""
            ),
            "is_abandon" => "1",
            "is_weekend" => "0"
        );
        break;
    case "daily_summary":
        $fields['result'] = 'success';
        $fields['daily_data'] = array(
            'date' => '1396-9-22',
            'location' => 'test location',
            'team' => 'test team',
            "start_time" => '10:23',
            "end_time" => '19:58',
            "overtime" => "0",
            "total_time" => 8 * 60 * 60,
            "badboy" => "0",
            "status" => "PENDING",
            "holiday" => array(
                'is_holiday' => '0',
                'farsi_name' => '',
            ),
            "timeout" => array(
                "is_timeout" => "0",
                "code" => "0",
                "farsi_name" => ""
            ),
            "is_abandon" => "1",
            "is_weekend" => "0"
        );

        break;
    default:
        $fields['result'] = "error";
        $fields['msg'] = "INVALID_USER_ID";
        break;
}

echo _api_response($fields);
die;
