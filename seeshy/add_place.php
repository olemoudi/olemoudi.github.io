<?php
//session_start();

include_once('core/constants.php');
include('core/clerk_functions.php');

// check POST

if (!isPost()) {
	
	clerk_error($NO_POST);
	
} elseif (!onMaintenance()) { 
	
	// connect to db
	include($DB_CONFIG);
	include('core/db_mysql.php');			
	$db = new db_mysql($db_username, $db_password, $db_database, $db_host);
	$db->connect();	
	
	// check for flooders
	if (validIP($db)) {
		$db->clerk_debug("valid ip adding place");
		// common parameters for any type of request
		$common = array_merge($LAT, $LNG, $NICK, $DESC);

		$valid_request = true;
		$fail_param = "";
		foreach ($common as $param => $specs) {
			// check if the param does not exist when not optional OR exists but it is not a valid input
			if ((!isset($_POST[$param]) && $specs['optional'] !== True) || (isset($_POST[$param]) && !checkInput($_POST[$param], $specs))) {
				$valid_request = false;
				$db->clerk_debug("invalid POST request { param: ". $param . ", value: " . $_POST[$param] );
				$fail_param = $param;
				break; // stop checking 
			} 
		}
		
		if (!preg_match("/^([a-zA-Z0-9_-]){4,50}$/" ,$_POST['nick'] )) {
			$valid_request = false;
			$db->clerk_debug("invalid nick:" . $_POST['nick'] );
			$fail_param = 'nick';
			clerk_error($INVALID_NICK);
			die();
		}

		if ($valid_request) {
			$db->clerk_debug("valid POST request for add place");
			$data = array();
			// trim input, just to be sure.
			foreach ($common as $param => $specs) {
				//$data[$param] = htmlentities(trim($_POST[$param]), ENT_QUOTES);
				$data[$param] = tildes(trim($_POST[$param]));
			}	


			// check nick already exists in the db
			if (!nickExists($db, $data['nick'])) {				
				$db->clerk_debug("valid nick used");
				// fill request and send email
				if(addPlace($db, $data)) {
					clerk_success($ADDPLACE_SUCCESS);
					$db->clerk_info("successfully added place");
				} else {
					$db->clerk_error("error adding place");
					clerk_error($UNEXPECTED_ERROR);
				}
		
			} else {
				$db->clerk_error("nick for place already exists in the db");
				clerk_error($NICK_ALREADY_EXISTS);
			}

		} else {
			clerk_error($INVALID_REQUEST . ": ".$fail_param);
	
		}
	} else {
		$db->clerk_error("blacklisted ip trying to place search");
	}
} else {
	clerk_error($MAINTENANCE_JSON_ERROR);
}

?>
