<?php

include_once('core.php');

function getMatch($db, $token, $suffix) {
	return $db->getMatch($token, $suffix);
}

function setPossibleMatch($db, $token, $suffix) {
	return	$db->setPossibleMatch($token, $suffix);
}

function getUserById($db, $id)	{
	$user  = $db->getUserById($id);
	return $user;
}

function waitForOther($db, $user_id, $token, $suffix) {
	
	return (setPossibleMatch($db, $token, $suffix) && $db->updateUserStatus($user_id, '3'));	
}

function setUserSuccess($db, $user_id) {
	return $db->updateUserStatus($user_id, '4');
}


function sendSuccessEmail($recipient, $target_email) {
	global $LOGO_FILE, $FOLLOW_US, $ROOT_URL, $SUCCESS_EMAIL_SUBJECT, $SUCCESS_EMAIL_INTROTEXT_HTML, $SUCCESS_EMAIL_INTROTEXT_PLAIN, $SUCCESS_EMAIL_POSTTEXT_HTML, $SUCCESS_EMAIL_POSTTEXT_PLAIN, $DOMAIN,  $NOTIFICATIONS_EMAIL;
		
	$boundary = "==boundary-".md5(rand());
	$to      = $recipient;
	$subject    = $SUCCESS_EMAIL_SUBJECT;
	
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
	
	$msg .= $SUCCESS_EMAIL_INTROTEXT_PLAIN ."\r\n\r\n";	
	$msg .= $target_email."\r\n\r\n";	
	$msg .= $SUCCESS_EMAIL_POSTTEXT_PLAIN;
	// html version
	$msg .= "\n\n--$boundary\n";
	$msg .= "Content-type: text/html; charset=\"iso-8859-1\"\n";
	$msg .= "Content-Transfer-Encoding: 8bit\n\n";
	$msg .= "<html xmlns=\"http://www.w3.org/1999/xhtml\">".
"<body style=\"padding:0; margin:30px 1em 1em 30px; font-family:\"lucida grande\",tahoma,arial,sans-serif;\">".
"<div id=\"logo\" style=\"margin-bottom: 50px;\"><a href=\"/\"><img style=\"border:none;\" src=\"http://". $DOMAIN ."/img/". $LOGO_FILE ."\" alt=\"seeshy logo\" /></a></div>".
"<div id=\"content\">";
	$msg .= $SUCCESS_EMAIL_INTROTEXT_HTML ;
	$msg .= "<h3 style=\"font-family:helvetica,arial,sans-serif;\"><a href=\"mailto://". $target_email ."\">".$target_email."</a></h3>";
	$msg .= $SUCCESS_EMAIL_POSTTEXT_HTML ."</div><div id=\"footer\">".
"<hr style=\"margin-bottom: 5px;\" />".
"      <small class=\"light\">".
"      <a style=\"color:#999;\" href=\"mailto:contact@seeshy.com\">contact@seeshy.com</a> | $FOLLOW_US <strong><a style=\"color:#999;\" href=\"http://www.twitter.com/seeshy\">Twitter</a></strong> | Copyright 2009-2010 seeshy.com </small></div></body></html>\n\n";
		# -=-=-=- FINAL BOUNDARY
	$msg .= "--$boundary--";
	return @mail($to, $subject, $msg, $headers);		
}

?>
