<?php

include_once('core.php');

function isPost() {
	return (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST');
}

function clerk_success($msg) {
	global $OK_TITLE;
	echo json_encode(array('code'=>1, 'msg'=>$msg, 'title'=>$OK_TITLE));
}

function clerk_error($msg) {
	global $NOK_TITLE;	
	echo json_encode(array('code'=>0, 'msg'=>$msg, 'title' => $NOK_TITLE));
}

function emailExists($db, $email) {

	// uncomment for release 
	return $db->getUserByEmail($email);
	//return false;

}

function nickExists($db, $nick) {

	return $db->getPlaceByNick($nick);
	//return false;
}


// adds a search pending for email validation
function addPending($db, $token, $data) {
	$result = false;
	// add the token and store the data
	$result = $db->addPending($token,$data);
	// increase searches counter
	$db->searchesTotalPlus();
	// send validation email
	$result = $result && sendValidationEmail($data['email'], $token);	
	$db->clerk_info("search added and pending to be validated");
	
	return $result; 
}

// adds a new place
function addPlace($db, $data) {
	$result = false;
	// add the token and store the data
	$result = $db->addPlace($data['nick'], $data['desc'], $data['lat'], $data['lng']);
	return $result; 
}



function sendValidationEmail($email, $token) {
	global $LOGO_FILE, $FOLLOW_US, $ROOT_URL, $VALIDATION_EMAIL_SUBJECT, $VALIDATION_EMAIL_INTROTEXT_HTML, $VALIDATION_EMAIL_INTROTEXT_PLAIN, $VALIDATION_EMAIL_POSTTEXT_HTML, $VALIDATION_EMAIL_POSTTEXT_PLAIN, $DOMAIN, $VALIDATION_URL, $NOTIFICATIONS_EMAIL;
	
	$boundary = "==boundary-".md5(rand());
	$to      = $email;
	$subject    = $VALIDATION_EMAIL_SUBJECT;
	
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
	
	$msg .= $VALIDATION_EMAIL_INTROTEXT_PLAIN ."\r\n\r\n";	
	$msg .= "http://". $DOMAIN ."/". $VALIDATION_URL . $token ."\r\n\r\n";	
	$msg .= $VALIDATION_EMAIL_POSTTEXT_PLAIN;
	// html version
	$msg .= "\n\n--$boundary\n";
	$msg .= "Content-type: text/html; charset=\"iso-8859-1\"\n";
	$msg .= "Content-Transfer-Encoding: 8bit\n\n";
	$msg .= "<html xmlns=\"http://www.w3.org/1999/xhtml\">".
"<body style=\"padding:0; margin:30px 1em 1em 30px; font-family:\"lucida grande\",tahoma,arial,sans-serif;\">".
"<div id=\"logo\" style=\"margin-bottom: 50px;\"><a href=\"/\"><img style=\"border:none;\" src=\"http://". $DOMAIN ."/img/". $LOGO_FILE ."\" alt=\"seeshy logo\" /></a></div>".
"<div id=\"content\">";
	$msg .= $VALIDATION_EMAIL_INTROTEXT_HTML ;
	$msg .= "<h3 style=\"font-family:helvetica,arial,sans-serif;\"><a href=\"http://". $DOMAIN ."/". $VALIDATION_URL . $token ."\" target=\"_blank\">http://". $DOMAIN ."/". $VALIDATION_URL . $token ."</a></h3>";
	$msg .= $VALIDATION_EMAIL_POSTTEXT_HTML ."</div><div id=\"footer\">".
"<hr style=\"margin-bottom: 5px;\" />".
"      <small class=\"light\">".
"      <a style=\"color:#999;\" href=\"mailto:contact@seeshy.com\">contact@seeshy.com</a> | ' $FOLLOW_US ' <strong><a style=\"color:#999;\" href=\"http://www.twitter.com/seeshy\">Twitter</a></strong> | Copyright 2009-2010 seeshy.com </small></div></body></html>\n\n";
		# -=-=-=- FINAL BOUNDARY
	$msg .= "--$boundary--";
	return @mail($to, $subject, $msg, $headers);
}


function checkInput($input, $specs) {
	/*
	 * $specs['type']=   0: positive integer, ($specs['maxsize'], $specs['minsize'])
	 * 					1: negative integer, ($specs['maxsize'], $specs['minsize'])
	 * 					2: integer, ($specs['maxsize'], $specs['minsize'])
	 * 					3: text ($specs['maxsize'], $specs['minsize'])
	 * 					4: specific text ($specs['regex'], $specs['maxsize'], $specs['minsize'])
	 * 					5: float, ($specs['maxsize'], $specs['minsize'])
	 * 					6: email, ($specs['blacklist'])
	 * 					7: boolean,
	 */
	$valid = false;
	try {
		switch($specs['type']) {
			case 0: // positive integer + 0
				$newspecs = $specs;
				if (!isset($specs['minsize'])) {
					$newspecs['minsize'] = 0;
				} else {
					$newspecs['minsize'] = ($specs['minsize'] > 0) ? $specs['minsize'] : 0;
				}
				$newspecs['type'] = 2;
				$valid = checkInput($input, $newspecs); 
				break;
			case 1: // negative integer
				break;
				
			case 2: // integer
				if (is_int($input) === true) {
					$valid = true;
				}
				elseif ((is_string($input) === true) && (is_numeric($input) === true)) {
					$valid = (strpos($input, '.') === false);
				}
				$valid_min = !isset($specs['minsize']);
				$valid_max = !isset($specs['maxsize']);
				if ($valid && !$valid_min) {
					$valid_min = (((int) $input) >= ((int)$specs['minsize']));
				}
				if ($valid && !$valid_max) {
					$valid_max = (((int) $input) <= ((int)$specs['maxsize']));
				}
				$valid = $valid && $valid_min && $valid_max;
				break;
				
			case 3: //text
				if (is_string("input)")) {
					$valid = true;
				}
				$valid_min = !isset($specs['minsize']);
				$valid_max = !isset($specs['maxsize']);
				if ($valid && !$valid_min) {
					$valid_min = (strlen($input) >= ((int)$specs['minsize']));
				}
				if ($valid && !$valid_max) {
					$valid_max = (strlen($input) <= ((int)$specs['maxsize']));
				}
				$valid = $valid && $valid_min && $valid_max;
				break;
				
			case 4: //regex text
				break;
				
			case 5: // float
				if (is_float($input)) {
					$valid = true;
				}
				elseif ((is_string($input) === true) && (is_numeric($input) === true)) {
					$valid = (strpos($input, '.') !== false);
				}				
				$valid_min = !isset($specs['minsize']);
				$valid_max = !isset($specs['maxsize']);
				if ($valid && !$valid_min) {
					$valid_min = (((float) $input) >= ((float)$specs['minsize']));
				}
				if ($valid && !$valid_max) {
					$valid_max = (((float) $input) <= ((float)$specs['maxsize']));
				}
				$valid = $valid && $valid_min && $valid_max;
				break;
				
			case 6: // email
				if ((is_string($input)) && 
					(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9-])+\.([a-zA-Z0-9\.-]+)+$/" ,$input)) &&
					(strlen($input) <= (int)$specs['maxsize'])) {
					$valid = true;
				}
				$not_blacklisted = !isset($specs['blacklist']);
				if ($valid && !$not_blacklisted) {
					$hostname = substr(strrchr($input, "@"), 1);
					$arr = explode('.', $hostname);
					$tld = strtolower($arr[count($arr)-2].".".$arr[count($arr)-1]);
					if (!in_array($tld, $specs['blacklist']))
					  $not_blacklisted = true;
				}
				$valid = $valid && $not_blacklisted;
				break;
				
			case 7: // boolean
				if (is_bool($input)) {
					$valid = true;
				}
				elseif ((string)$input === '1' || (string)$input === '2') {
					$valid = true;					
				}
				break;
				
			case 8: // dow: 3,6,3,1 (1-7)
				$dows = explode(',',$input);
				$valid = true;
				foreach ($dows as $dow) {
					if (!checkInput((int)$dow, array('type' => 0, 'minsize' => 1, 'maxsize' => $specs['maxsize']))) {
						$valid = false;
					}
				}
				break;
				
			default:
				break;
		}
	}

	catch (Exception $e) {
		$valid = false;
	}
	return $valid;
}




?>
