<?php

$table_list=array('manifest_airlines','manifest_airports','manifest_approve_log','manifest_cancellation_policy','manifest_carphotos','manifest_client_addresses',
'manifest_events','manifest_expensetype','manifest_fbo','manifest_mail_click_detail','manifest_page_impression','manifest_poi','manifest_quote_history',
'manifest_request_change','manifest_reservation','manifest_reservation_cars','manifest_reservation_expenses','manifest_reservation_notes',
'manifest_reservation_passengers','manifest_reservation_trip_route','manifest_servicetype','manifest_sub_users','manifest_user');

EXPORT_TABLES(DB_HOST,DB_UNAME,DB_PASSWORD,DB_NAME,$table_list);

function EXPORT_TABLES($host,$user,$pass,$name,  $tables=false, $backup_name=false ){
    $mysqli = new mysqli($host,$user,$pass,$name); $mysqli->select_db($name); $mysqli->query("SET NAMES 'utf8'");
    $queryTables = $mysqli->query('SHOW TABLES'); while($row = $queryTables->fetch_row()) { $target_tables[] = $row[0]; }   if($tables !== false) { $target_tables = array_intersect( $target_tables, $tables); }
    foreach($target_tables as $table){
        $result = $mysqli->query('SELECT * FROM '.$table);  $fields_amount=$result->field_count;  $rows_num=$mysqli->affected_rows;     $res = $mysqli->query('SHOW CREATE TABLE '.$table); $TableMLine=$res->fetch_row();
        $content = (!isset($content) ?  '' : $content) . "\n\n".$TableMLine[1].";\n\n";
        for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
            while($row = $result->fetch_row())  { //when started (and every after 100 command cycle):
                if ($st_counter%100 == 0 || $st_counter == 0 )  {$content .= "\nINSERT INTO ".$table." VALUES";}
                    $content .= "\n(";
                    for($j=0; $j<$fields_amount; $j++)  { $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); if (isset($row[$j])){$content .= '"'.$row[$j].'"' ; }else {$content .= '""';}     if ($j<($fields_amount-1)){$content.= ',';}      }
                    $content .=")";
                //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) {$content .= ";";} else {$content .= ",";} $st_counter=$st_counter+1;
            }
        } $content .="\n\n\n";
    }
    $backup_name = $backup_name ? $backup_name : $name."___(".date('Y-m-d')."_".date('H-i-s').")__rand".rand(1,11111111).".sql";
    header('Content-Type: application/octet-stream');   header("Content-Transfer-Encoding: Binary"); header("Content-disposition: attachment; filename=\"".$backup_name."\"");  echo $content; exit;
}
die;
?>