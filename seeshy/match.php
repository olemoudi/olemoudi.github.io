<?php
ob_start();

	
include_once('core/constants.php');
include('core/match_functions.php');
// connect to db
include($DB_CONFIG);
include('core/db_mysql.php');			
$db = new db_mysql($db_username, $db_password, $db_database, $db_host);
checkForError($db->connect());

$boysuffix = null;
$girlsuffix = null;
$token = null;
if (isset($_GET['token1'])) {
	$boysuffix = '1';
	$girlsuffix = '2';
	$token = $_GET['token1'];
} elseif (isset($_GET['token2'])) {
	$boysuffix = '2';
	$girlsuffix = '1';
	$token = $_GET['token2'];
} else {
	die();
}

$match = getMatch($db, $boysuffix, $token);
checkForError($match);

if ($_GET['confirm'] == 'yes') {
	

	if ($match !== false) {
		
		$boydata = unserialize($match[0]['data'.$boysuffix]);
		$girldata = unserialize($match[0]['data'.$girlsuffix]);
		
		$user_data = $db->getUserById($boydata['user_id']);
		checkForError($user_data);
			
		if (((int)($user_data['status']))  > 2 ) {
			$db->match_info("we failed");
			include('inc/match_output_already.php');
			
		} else {
		
			$db->match_debug("match found");
			if ($match[0]['ok'.$girlsuffix] == true) {
				$db->match_info("full match completed");
				checkForError(waitForOther($db, $boydata['user_id'], $token, $boysuffix));
				$db->searchesSuccessPlus();
				checkForError(sendSuccessEmail($boydata['email'], $girldata['email']));
				checkForError(sendSuccessEmail($girldata['email'], $boydata['email']));
				setUserSuccess($db, $boydata['user_id']);
				setUserSuccess($db, $girldata['user_id']);
	
			} else {
				$db->match_info("half match completed");
				waitForOther($db, $boydata['user_id'], $token, $boysuffix);
			}
			include('inc/match_output_yes.php');
		}
	} else {
		$db->match_error("no match found");		
	}
	
} elseif ($_GET['confirm'] == 'no') {
	
	include('inc/match_output_no.php');	
		
} else {
	
	$girldata = unserialize($match[0]['data'.$girlsuffix]);
	
	/*$tmp = unserialize($match[0]['data'.$boysuffix]);
	$user_data = $db->getUserById($tmp['user_id']);
	checkForError($user_data);
		
	if (((int)($user_data['status']))  > 2 ) {
		$db->match_info("we failed 2");
		include('inc/match_output_already.php');
		
	} else { */
			
		$tmsg = $girldata['tmsg'];
		include('inc/match_output_prompt.php');	
	//}
}

ob_end_flush(); 
?>
