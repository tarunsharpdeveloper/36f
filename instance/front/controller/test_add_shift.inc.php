<?php

if ($_REQUEST['submitData'] == '1') {

    $parm = array();
    $shift = array();
    parse_str($_REQUEST['data'], $parm);

    # Unique id
    $employees = qs("SELECT * From tb_employee where id='{$parm['employee']}'");
    $company = qs("SELECT * FROM `tb_company_works` where id='{$employees['work_at']}'");

    $random_id = substr(md5(microtime()), rand(0, 26), 5);
    $unique_id = array();
    $unique_id[] = str_replace(" ", "_", $company['name']);
    $unique_id[] = str_replace(" ", "_", $employees['fname'] . "_" . $employees['lname']);
    $unique_id[] = strtotime(date('Y-m-d', strtotime($parm['shift_end_date'])));
    // $unique_id[] = $id_reason;
    $unique_id[] = $random_id;
    $unique_id = array_filter($unique_id);
    $unique_id = implode("_", $unique_id);

    $shift['unique_id'] = $unique_id;
    $shift['user_id'] = $parm['employee'];
//    $shift['unique_id'] = $random_id;
    $shift['start_date'] = date("Y-m-d", strtotime($parm['shift_start_date']));
    $shift['start_time'] = $parm['shift_start_time'];
    $shift['end_date'] = date("Y-m-d", strtotime($parm['shift_end_date']));
    $shift['end_time'] = $parm['shift_end_time'];
    $shift['area_of_work'] = $employees['location'];
    $startDate = date("Y-m-d H:i:s", strtotime($shift['start_date'] . " " . $shift['start_time']));
    $endDate = date("Y-m-d H:i:s", strtotime($shift['end_date'] . " " . $shift['end_time']));
    $first = new DateTime($endDate);
    $second = new DateTime($startDate);
    $diff = $first->diff($second);

    $h = $diff->h >= 1 ? $diff->h : "00";
    $i = $diff->i >= 1 ? $diff->i : "00";
    $s = $diff->s >= 1 ? $diff->s : "00";

    $start_date_time = strtotime($shift['start_date'] . " " . $shift['start_time']);
    $end_date_time = strtotime($shift['end_date'] . " " . $shift['end_time']);
    $difference = $end_date_time - $start_date_time;

    $his = seconds_to_his($difference);
    
    $shift['total_hour'] = $his;

    qi("tb_assign_shift", _escapeArray($shift));

    $shift_list = q("select tb_employee.fname,tb_employee.lname,tb_assign_shift.* from tb_assign_shift join tb_employee on tb_assign_shift.user_id=tb_employee.id order by tb_assign_shift.id desc limit 0,20");
    include _PATH . "instance/front/tpl/test_add_shift_data.php";
    die;
}

$shift_list = q("select tb_employee.mobile, tb_employee.fname,tb_employee.lname,tb_assign_shift.* from tb_assign_shift join tb_employee on tb_assign_shift.user_id=tb_employee.id order by tb_assign_shift.id desc limit 0,20");

$employee = q("select * from tb_employee where mobile!=''");

$jsInclude = "test_add_shift.js.php";
_cg("page_tilte", "Add Shift");
?>