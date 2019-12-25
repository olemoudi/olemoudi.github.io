<?php

ob_start();

if (!isset($_GET['token'])) {
	die();
}

include_once('core/constants.php');
include('core/validate_functions.php');

if (onMaintenance()) {
	
	include('inc/maintenance.php');
	
} else {

	// connect to db
	include($DB_CONFIG);
	include('core/db_mysql.php');			
	$db = new db_mysql($db_username, $db_password, $db_database, $db_host);
	checkForError($db->connect());
	// get user data
	$data = getPending($db, $_GET['token']);
	
	// if user actually exists do the magic
	if ($data !== false) {
		$db->val_debug("processing validation");
		// add self
		$self_id = addSelf($db, $data);		
		
		// add target
		$target_id = addTarget($db, $data);
	
		// add user
		$user_id = addUser($db, $data, $self_id, $target_id);
		
		// add meeting	
		$meeting_id = addMeeting($db, $data, $user_id);
		
		checkForError($self_id && $target_id && $user_id && $meeting_id);
		
		$data['user_id'] = $user_id;

		
		
		
		if (isset($data['place_id']) && $data['place_id'] != 0) {
			hitPlace($db, $data['place_id']);
			$db->val_debug("place ".$data['place_id']." hitted");
			//$MEETING_SEARCH_RADIUS = $PLACE_SEARCH_RADIUS;
		}
		
		
		$handicap = 0;
		
		
		// search meetings around
		$meetings = searchMeetings($db, $data['dow'], $data['lat'], $data['lng'], $meeting_id);
		checkForError($meetings);
		$meeting_count = count($meetings);
			
		
		if ($meeting_count != 0) {
			$db->val_debug($meeting_count . " meetings found");
			// get handicap for meeting crowded zones
			$handicap += getHandicap("meeting_count", $meeting_count);
	
			// create arrays with scores for each meeting and keep track of index
			$scores = array(); 
			$users = array();
			$i = 0;
			
			foreach ($meetings as $meeting) {
				// analyze meeting creator
				$candidate_data = getUserData($db, $meeting);
				checkForError($candidate_data);
				// status 3 and 4 are for matched candidates
				if (((int)$candidate_data['status'])  <= 2 ) {
				
					// calculate match score
					$score = shyScore($data, $candidate_data);
					
					// calculate handicaps for candidate
					$handicap += getHandicap("meeting_dow", array($meeting['dow'], $data['dow']));
					$handicap += getHandicap("candidate", $candidate_data['hits']);
					$db->val_debug("meeting params { score: ".$score ." , handicap: ". $handicap . "}");
					// discard low scores
					if ($score > ($MATCH_THRESHOLD + $handicap)) {
						$scores[''.$i] = $score;
						$users[] = $candidate_data;
						// increase user popularity
						updateHits($db, $candidate_data);
						// stats
						addScore($db, $score);
						$i++;  		
					}
				}
			}
			// sort scores array
			rsort($scores, SORT_NUMERIC);
			reset($scores);
	
			// pick best score
			foreach ($scores as $user_index => $score) {
				$match_data = $users[$user_index];
				checkForError(createMatch($data, $match_data, $score, $db));
				$db->val_info("best match found with score: ".$score);
				break; // only best
			}
			
		}
		// del pending
		delPending($db, $_GET['token']);
		$db->val_info("email validation complete");	
		include('inc/validate_output.php');			
			
		
		
	} else {
		$db->val_error("bad token used");
		//validate_display("bad token");
		include('inc/validate_output.php');	
	
	}
	
}

ob_end_flush(); 
?>
