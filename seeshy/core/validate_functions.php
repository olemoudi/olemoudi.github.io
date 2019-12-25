<?php

include_once('core.php');

function searchMeetings($db, $dow, $lat, $lng, $meeting_id, $radius=null) {	
	global $MEETING_SEARCH_RADIUS;
	if ($radius == null) {
		$radius = $MEETING_SEARCH_RADIUS;
	}
	
	return $db->searchMeetings($dow, $lat, $lng, $meeting_id, $radius);
}

function updateHits($db, $data) {
	$db->updateHits($data['user_id']);
	return $db->last_id;
}

function hitPlace($db, $place_id) {
	$db->hitPlace($place_id);
	return $db->last_id;
}


function addScore($db, $score) {
	return	$db->addScore($score);
}

function validate_display($msg) {
	echo "<h1>".$msg."</h1>";
}

function getPending($db, $token) {
	return $db->getPending($token);
}

function addSelf($db, $data) {	
	$result = $db->addPerson($data['ssex'], $data['sage'], $data['shair'], $data['sheight']);
	if ($result) {
		return $db->last_id;
	} else {
		return false;
	}
}

function addTarget($db, $data) {	
	$result = $db->addPerson($data['tsex'], $data['tage'], $data['thair'], $data['theight']);
	if ($result) {
		return $db->last_id;
	} else {
		return false;
	}
}

function addUser($db, $data, $self_id, $target_id) {
	$result = $db->addUser($data['email'], $self_id, $target_id, $data['tmsg'], $data['locale']);
	if ($result) {
		return $db->last_id;
	} else {
		return false;
	}
}

function addMeeting($db, $data, $user_id) {
	$result = $db->addMeeting($data['lat'], $data['lng'], $user_id, $data['dow'], $data['time'], $data['talk'], $data['periodic']);
	if ($result) {
		return $db->last_id;
	} else {
		return false;
	}
}

function delPending($db, $token) {
	return $db->delPending($token);
}

// gets userdata from database returns assoc array

function getUserData($db, $meeting) {

	$data = $meeting;
	$user  = $db->getUserById($data['user_id']);
	$data = array_merge($data, $user);
	
	$self =  $db->getPerson($user['self_id']);		
	$data['ssex'] = $self['sex'];
	$data['sage'] = $self['age'];
	$data['shair'] = $self['hair'];
	$data['sheight'] = $self['height'];
	
	$target = $db->getPerson($user['target_id']);
	$data['tsex'] = $target['sex'];
	$data['tage'] = $target['age'];
	$data['thair'] = $target['hair'];
	$data['theight'] = $target['height'];
		
	return $data;	
}

function getHandicap($type, $param) {

	$h = 0;
	switch($type) {
		
		case "meeting_count":
		
			$h = min(40, floor(pow(2, $param-2)));
			
			break;
			
		case "meeting_dow":
		
			// mask of difference through XOR
			$mask = ((int)$param[0]) ^ ((int)$param[1]);

			$c = 0; // number of diff bits
			
			// count the number of 1s in the mask
			while($mask) {
				$c += $mask & 1;
				$mask = $mask >> 1;
			}

			$h = 10 * $c;
			
			break;
			
		case "candidate":
		
			$h = 10 * $param;
			break;
			
		default:
		
			break;
			
	}
	
	return $h;
}


function setUserMatched($db, $data) {
	return	$db->updateUserStatus($data['user_id'], '2');
	
}




function createMatch($boy, $girl, $score, $db) {
	$token1 = sha1($boy['email'] . mt_rand() . time());
	$token2 = sha1($girl['email'] . mt_rand() . time());
	$db->addMatch($token1, $token2, $boy, $girl, $score);
	setUserMatched($db, $boy);
	setUserMatched($db, $girl);
	sendMatchEmail($boy['email'], '1', $token1, $boy['tmsg']);
	sendMatchEmail($girl['email'], '2', $token2, $girl['tmsg']);
} 

function sendMatchEmail($email, $suffix, $token, $tmsg) {
	
	
	global $LOGO_FILE, $FOLLOW_US, $ROOT_URL, $MATCH_EMAIL_SUBJECT, $MATCH_EMAIL_INTROTEXT_HTML, $MATCH_EMAIL_INTROTEXT_PLAIN, $MATCH_EMAIL_POSTTEXT_HTML, $MATCH_EMAIL_POSTTEXT_PLAIN, $DOMAIN, $MATCH_URL, $NOTIFICATIONS_EMAIL, $MATCH_EMAIL_REMEMBER_MSG_HTML, $MATCH_EMAIL_REMEMBER_MSG_PLAIN;
	
	$boundary = "==boundary-".md5(rand());
	$to      = $email;
	$subject    = $MATCH_EMAIL_SUBJECT;
	
	$headers = "From: ". $NOTIFICATIONS_EMAIL . "\n";
	$headers .= "Reply-To: ". $NOTIFICATIONS_EMAIL . "\r\n" ;
	$headers .= 'X-Mailer: PHP/5 \r\n';
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: multipart/alternative; boundary=\"$boundary\"\n";
	$msg .= "This is a multi-part message in MIME format.\n\n";
	// text version
	$msg .= "--$boundary\n";
	$msg .= "Content-type: text/plain; charset=\"iso-8859-1\"\n";
	$msg .= "Content-Transfer-Encoding: 8bit\n\n";
	
	$msg .= $MATCH_EMAIL_INTROTEXT_PLAIN ."\r\n\r\n";
	$msg .= "http://". $DOMAIN ."/". $MATCH_URL . $suffix . "=" . $token ."\r\n\r\n";	
	$msg .= $MATCH_EMAIL_REMEMBER_MSG_PLAIN . "\r\n\r\n";
	$msg .= "\"" .$tmsg."\"\r\n\r\n";
	// html version
	$msg .= "\n\n--$boundary\n";
	$msg .= "Content-type: text/html; charset=\"iso-8859-1\"\n";
	$msg .= "Content-Transfer-Encoding: 8bit\n\n";
	$msg .= "<html xmlns=\"http://www.w3.org/1999/xhtml\">".
"<body style=\"padding:0; margin:30px 1em 1em 30px; font-family:\"lucida grande\",tahoma,arial,sans-serif;\">".
"<div id=\"logo\" style=\"margin-bottom: 50px;\"><a href=\"/\"><img style=\"border:none;\" src=\"http://". $DOMAIN ."/img/". $LOGO_FILE ."\" alt=\"seeshy logo\" /></a></div>".
"<div id=\"content\">";
	$msg .= $MATCH_EMAIL_INTROTEXT_HTML ;
	$msg .= "<h3 style=\"font-family:helvetica,arial,sans-serif;\"><a href=\"http://". $DOMAIN ."/". $MATCH_URL . $suffix . "=" . $token ."\" target=\"_blank\">http://". $DOMAIN ."/". $MATCH_URL . $suffix . "=" . $token ."</a></h3>";
	$msg .= $MATCH_EMAIL_REMEMBER_MSG_HTML . "<br/>";
	$msg .= "<blockquote style=\"font-size: 1.2em; margin: 1em 2em; color: #6FBCFF; padding: 10px; padding-left: 50px;
 text-align: left;\">".$tmsg."</blockquote>";
	$msg .= "</div><div id=\"footer\">".
"<hr style=\"margin-bottom: 5px;\" />".
"      <small class=\"light\">".
"      <a style=\"color:#999;\" href=\"mailto:contact@seeshy.com\">contact@seeshy.com</a> | $FOLLOW_US <strong><a style=\"color:#999;\" href=\"http://www.twitter.com/seeshy\">Twitter</a></strong> | Copyright 2009-2010 seeshy.com </small></div></body></html>\n\n";
		# -=-=-=- FINAL BOUNDARY
	$msg .= "--$boundary--";
	@mail($to, $subject, $msg, $headers);		
	

}


// evals score from 2 arrays from the modulus of their intersection

function shyScore($boy, $girl) {
	global $ATIME_RANGE;

	$score = 100;
	
	// place and zone id
	
	
	$v1 = array($boy['time'],
				//$boy['duration'],
				$boy['periodic'],
				$boy['ssex'],
				$boy['sage'],
				$boy['shair'],
				$boy['sheight'],
				$boy['tsex'],
				$boy['tage'],
				$boy['thair'],
				$boy['theight'],
				$boy['talk']);
				
	$v2 = array($girl['time'],
				//$girl['duration'],
				$girl['periodic'],
				$girl['tsex'],
				$girl['tage'],
				$girl['thair'],
				$girl['theight'],
				$girl['ssex'],
				$girl['sage'],
				$girl['shair'],
				$girl['sheight'],
				$girl['talk']);

	// deal breakers
	$breakers =  array(
						// sex!
						abs($v1[2] - $v2[2])*4,
						abs($v1[6] - $v2[6])*4,
						// age
						abs($v1[3] - $v2[3]),
						abs($v1[7] - $v2[7]),
						// height
						abs($v1[5] - $v2[5]),
						abs($v1[9] - $v2[9])
					);
	 if (max($breakers) > 2) {
	 
	 	$score = 0;
	 	
	 } else {
	
				
		// get diff vector
	
		$diffq = array( pow(10 * min(abs($v1[0] - $v2[0]), floor($ATIME_RANGE/2)), 2), // time 3.16u 3max
						//pow(10 * abs($v1[1] - $v2[1]), 2), // duration 3.16u 2max
						pow(20 * abs($v1[1] - $v2[1]), 2), // periodic 4.47u 1max
						pow(10000 * abs($v1[2] - $v2[2]), 2), // tsex 100u 1max
						pow(20 * abs($v1[3] - $v2[3]), 2), // tage 4.47u 6max
						pow(10 * abs($v1[4] - $v2[4]), 2), // thair 3.16u 4max
						pow(10 * abs($v1[5] - $v2[5]), 2), // theight 3.16u 4max
						pow(10000 * abs($v1[6] - $v2[6]), 2), // ssex 100u 1max
						pow(20 * abs($v1[7] - $v2[7]), 2), // sage 4.47u 6max
						pow(10 * abs($v1[8] - $v2[8]), 2), // shair 3.16u 4max
						pow(10 * abs($v1[9] - $v2[9]), 2), // sheight	3.16u 4max
						pow(20 * abs($v1[9] - $v2[9]), 2) // talk	3.16u 4max
		);	

	
	
	
		// euclidean norm
		//print_r($diffq);
		//print sqrt(array_sum($diffq))."\n";
		$score -= sqrt(array_sum($diffq));
		
	}
	
	return $score;
}


?>
