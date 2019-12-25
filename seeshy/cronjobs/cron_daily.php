<?php
include('config.php');
include('db_mysql.php');

$PENDING_DELETE_PERIOD = 48 * 3600; // 48 hours
$USER_DELETE_PERIOD = 15 * 24 * 3600; // 15 days
$USER4_DELETE_PERIOD = 30; // 30 segs
$LOG_DELETE_PERIOD = 2 * $USER_DELETE_PERIOD; // 30 days
$PLACE_DELETE_PERIOD = 9 * 30 * 24 * 3600; // 270 days
$LOG_LEVEL = 0;
	
// connect to db
	
$db = new db_mysql($db_username, $db_password, $db_database, $db_host);
$db->connect();

$db->cron_info('Daily cronjob started at: ' .date('l jS \of F Y h:i:s A'));

$time = time();

// remove pending requests after 48h
$db->delPendingOlderThan($time - $PENDING_DELETE_PERIOD);
$db->cron_info('Deleted pending requests');
print "Deleted pending requests\r\n";


// remove status 1 users after 15 days

$users = $db->getUsersByStatusAndTS('1', $time - $USER_DELETE_PERIOD);

foreach($users as $user) {
	sendCronNotification($user['email'], $user['locale'], 1);	
}

$db->delUsersByStatusAndTS('1', $time - $USER_DELETE_PERIOD);

$db->cron_info('Deleted '. count($users) . " status 1 users");
print 'Deleted '. count($users) . " status 1 users\r\n";



// remove status 2 users after 15 days
$users = $db->getUsersByStatusAndTS('2', $time - $USER_DELETE_PERIOD);

foreach($users as $user) {
	sendCronNotification($user['email'], $user['locale'], 2);	
}
$db->delUsersByStatusAndTS('2', $time - $USER_DELETE_PERIOD);

$db->cron_info('Deleted '. count($users) . " status 2 users");
print 'Deleted '. count($users) . " status 2 users\r\n";



// remove status 3 users after 15 days
$users = $db->getUsersByStatusAndTS('3', $time - $USER_DELETE_PERIOD);

foreach($users as $user) {
	sendCronNotification($user['email'], $user['locale'], 2);	
}
$db->delUsersByStatusAndTS('3', $time - $USER_DELETE_PERIOD);

$db->cron_info('Deleted '. count($users) . " status 3 users");
print 'Deleted '. count($users) . " status 3 users\r\n";



// remove status 4 users after 15 days
$users = $db->getUsersByStatusAndTS('4', $time - $USER4_DELETE_PERIOD);
$db->delUsersByStatusAndTS('4', $time - $USER4_DELETE_PERIOD);

$db->cron_info('Deleted '. count($users) . " status 4 users");
print 'Deleted '. count($users) . " status 4 users\r\n";



// del matches
$db->delMatchesByTS($time - $USER_DELETE_PERIOD);
$db->cron_info('Deleted matches');
print "deleted matches \r\n";


// del ips
$db->delIpsByTS($time - $PENDING_DELETE_PERIOD);
$db->cron_info('Deleted ips');
print "deleted ips\r\n";

// del places
$db->delPlacesByTS($time - $PLACE_DELETE_PERIOD);
$db->cron_info('Deleted places');
print "deleted places\r\n";

// del log
$db->delLogByTS($time - $LOG_DELETE_PERIOD);
$db->cron_info('Deleted logs');
print "deleted logs\r\n";

// optimize
$db->optimize();
$db->cron_info('Tables optimized');
print "Tables optimized\r\n";

function sendCronNotification($email, $locale, $status) {
	
	$NOTIFICATIONS_EMAIL = "noreply@seeshy.com";
	if ($locale == "spanish.php") {
		$LOGO_FILE = "logo_es.png";
		$FAIL_EMAIL_SUBJECT = "seeshy - lo sentimos pero...";
		$FAIL_EMAIL_INTROTEXT_PLAIN = "Sentimos informarte de que la búsqueda que realizaste en seeshy.com no ha llegado a buen puerto. Transcurridos 15 días desde la última actualización, la persona que buscas no ha dado señales de vida. En las próximas horas daremos de baja tu solicitud de búsqueda y podrás volver a intentarlo si así lo deseas.\r\n\r\n Gracias por confiar en seeshy";
		$FAIL_EMAIL_INTROTEXT_HTML = "<p>Sentimos informarte de que la búsqueda que realizaste en seeshy.com no ha llegado a buen puerto. Transcurridos 15 días desde la última actualización, la persona que buscas no ha dado señales de vida. En las próximas horas daremos de baja tu solicitud de búsqueda y podrás volver a intentarlo si así lo deseas.</p><p> Gracias por confiar en seeshy</p>";
	} 
	else {

		$LOGO_FILE = "logo.png";
		$FAIL_EMAIL_SUBJECT = "seeshy - we are sorry but...";
		$FAIL_EMAIL_INTROTEXT_PLAIN = "We are sorry to inform you that your search did not turn out happily. After 15 days since the last update, the person you were looking for has not appeared in our radars. In the next few hours we will delete your search request and you will be able to retry if you like to. \r\n\r\n Thanks for using seeshy.";
		$FAIL_EMAIL_INTROTEXT_HTML = "<p>We are sorry to inform you that your search did not turn out happily. After 15 days since the last update, the person you were looking for has not appeared in our radars. In the next few hours we will delete your search request and you will be able to retry if you like to.</p><p> Thanks for using seeshy</p>";
	}
	
	
	$boundary = "==boundary-".md5(rand());
	$to      = $email;
	$subject    = $FAIL_EMAIL_SUBJECT;
	
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
	
	$msg .= $FAIL_EMAIL_INTROTEXT_PLAIN ."\r\n\r\n";	
	// html version
	$msg .= "\n\n--$boundary\n";
	$msg .= "Content-type: text/html; charset=\"iso-8859-1\"\n";
	$msg .= "Content-Transfer-Encoding: 8bit\n\n";
	$msg .= "<html xmlns=\"http://www.w3.org/1999/xhtml\">".
"<body style=\"padding:0; margin:30px 1em 1em 30px; font-family:\"lucida grande\",tahoma,arial,sans-serif;\">".
"<div id=\"logo\" style=\"margin-bottom: 50px;\"><a href=\"/\"><img style=\"border:none;\" src=\"http://www.seeshy.com/img/". $LOGO_FILE ."\" alt=\"seeshy logo\" /></a></div>".
"<div id=\"content\">";
	$msg .= $FAIL_EMAIL_INTROTEXT_HTML ;
	$msg .= "</div><div id=\"footer\">".
"<hr style=\"margin-bottom: 5px;\" />".
"      <small class=\"light\">".
"      <a style=\"color:#999;\" href=\"mailto:contact@seeshy.com\">contact@seeshy.com</a> | $FOLLOW_US <strong><a style=\"color:#999;\" href=\"http://www.twitter.com/seeshy\">Twitter</a></strong> | Copyright 2009-2010 seeshy.com </small></div></body></html>\n\n";
		# -=-=-=- FINAL BOUNDARY
	$msg .= "--$boundary--";
	return @mail($to, $subject, $msg, $headers);		
	
}




?>
