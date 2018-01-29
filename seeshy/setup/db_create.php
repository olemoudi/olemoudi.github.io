<?php

// connect to db
//include('../cfg/config_alfa.php');
include('../cfg/config.php');

include('../core/db_mysql.php');			
$db = new db_mysql($db_username, $db_password, $db_database, $db_host);
$db->connect();

if($db->createDB()) {
	print "<h1>SUCCESS</h1>";
} else {
	print "<h1>FAIL: </h1>";
	print_r($db->_getError());
}

?>
