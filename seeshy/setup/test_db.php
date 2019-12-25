<?php

// connect to db
//include('../cfg/config_alfa.php');
include('../cfg/config.php');

include('../core/db_mysql.php');			
$db = new db_mysql($db_username, $db_password, $db_database, $db_host);
$db->connect();

$sql =  "SELECT count(*) as number FROM users;";
$ret = $db->query($sql, false);
//print_r($ret);
print $ret['number'][0];
//return $ret[0]['number']+642+date('j');


?>
