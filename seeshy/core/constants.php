<?php

// language 
include_once('core/core.php');


// SITE GLOBALS

$DEFAULT_LOCALE = "english.php";
$ES_LOCALE = "spanish.php";
$DEFAULT_DOMAIN = "seeshy.com";
$EN_DOMAIN = "en.seeshy.com";
$ES_DOMAIN = "es.seeshy.com";
$EN_SUBDOMAIN = "en";
$ES_SUBDOMAIN = "es";

$DOMAIN = $DEFAULT_DOMAIN;
$SUBDOMAIN = $EN_SUBDOMAIN;
$LOCALE = $DEFAULT_LOCALE;
setLang();

include('locale/'. $LOCALE);

$MAINTENANCE = FALSE;
$LOG_LEVEL = 0; // 0 = debug, 1 = info, 2 = error
$ERROR_FILE = "chillmonkey.jpg";

//$ROOT_URL = 'http://seeshy.com/';
$DB_CONFIG = 'cfg/config.php';
//$DB_CONFIG = 'cfg/config_alfa.php';

$ADMIN_IPS = array(gethostbyname('ole.homelinux.org'), gethostbyname('irouter.gsi.dit.upm.es'));


// ADMIN

$IP_HITS_BEFORE_BLACKLIST = 20;
$IP_BLACKLIST_INTERVAL = 172800; // 48h x 3600s

// CRONJOBS

// remove pending requests after 48h
$PENDING_DELETE_PERIOD = 48 * 3600; // 48 h

// remove stauts 1 users after 15 days
$USER_DELETE_PERIOD = 15 * 24 * 3600;


// CONSTANTS

$VALIDATION_URL = 'validate.php?token=';
$MATCH_URL = 'match.php?token';

$NOTIFICATIONS_EMAIL ='seeshy <noreply@seeshy.com>';

// max ranges
// in_array($arr, range(1, $DOW_RANGE))
$DOW_RANGE = 128;
$ATIME_RANGE = 6;
//$DURATION_RANGE = 3;
$PERIODIC_RANGE = 2;
$SEX_RANGE = 2;
$AGE_RANGE = 7;
$HAIR_RANGE = 6;
$HEIGHT_RANGE = 5;

$TALK_RANGE = 2;
$TMSG_MAXSIZE = 700;
$TMSG_MINSIZE = 4;
$NICK_MINSIZE = 4;
$DESC_MINSIZE = 4;
$NICK_MAXSIZE = 40;
$DESC_MAXSIZE = 70;
$EMAIL_MAXSIZE = 70;

// search constants

$MEETING_SEARCH_RADIUS = 0.5; // kilometers
$PLACE_SEARCH_RADIUS = 0.005; // 5 meters
$MATCH_THRESHOLD = 50;



$LOCATION = array( 	'lat' => array ('type' => 5), // float
					'lng' => array ('type' => 5) // float
);

$TIME = array( 'periodic' => array ('type' => 2, 'minsize' => 1, 'maxsize' => $PERIODIC_RANGE), // int
			  	'dow' => array('type' => 2, 'minsize' => 1, 'maxsize' => $DOW_RANGE), // int
				'time' => array('type' => 2, 'minsize' => 1, 'maxsize' => $ATIME_RANGE) // int
				//'duration' => array('type' => 2, 'minsize' => 1, 'maxsize' => $DURATION_RANGE) //int
);

$SELF = array( 'ssex' => array ('type' => 2, 'minsize' => 1, 'maxsize' => $SEX_RANGE), // int
			  	'sage' => array('type' => 2, 'minsize' => 1, 'maxsize' => $AGE_RANGE), // int
				'shair' => array('type' => 2, 'minsize' => 1, 'maxsize' => $HAIR_RANGE), // int
				'sheight' => array('type' => 2, 'minsize' => 1, 'maxsize' => $HEIGHT_RANGE) // int
);

$TARGET = array( 'tsex' => array ('type' => 2, 'minsize' => 1, 'maxsize' => $SEX_RANGE), // int
			  	'tage' => array('type' => 2, 'minsize' => 1, 'maxsize' => $AGE_RANGE), // int
				'thair' => array('type' => 2, 'minsize' => 1, 'maxsize' => $HAIR_RANGE), // int
				'theight' => array('type' => 2, 'minsize' => 1, 'maxsize' => $HEIGHT_RANGE) // int
);

$TALK = array('talk' => array('type' => 2, 'minsize' => 1, 'maxsize' => $TALK_RANGE)); //int

$TMSG =	array('tmsg' => array ('type' => 3, 'minsize' => $TMSG_MINSIZE, 'maxsize' => $TMSG_MAXSIZE)); // text

$PLACE_ID = array('place_id' => array ('type' => 2, 'minsize' => 0, 'optional' => True)); // text


$BLACKLIST = array('10minutemail.com',
'2prong.com',
'4warding.com',
'6url.com',
'afrobacon.com',
'bugmenot.com',
'bumpymail.com',
'centermail.com',
'centermail.net',
'choicemail1.com',
'deadspam.com',
'despam.it',
'despammed.com',
'discardmail.com',
'discardmail.de',
'disposeamail.com',
'dodgeit.com',
'dontreg.com',
'dontsendmespam.de',
'dumpandjunk.com',
'dumpmail.de',
'e4ward.com',
'emaildienst.de',
'emailias.com',
'emailto.de',
'emailxfer.com',
'emz.net',
'enterto.com',
'front14.org',
'getonemail.com',
'ghosttexter.de',
'gishpuppy.com',
'greensloth.com',
'guerrillamail.com',
'guerrillamail.net',
'h8s.org',
'haltospam.com',
'hatespam.org',
'hidemail.de',
'iheartspam.org',
'ipoo.org',
'jetable.com',
'jetable.net',
'jetable.org',
'kasmail.com',
'killmail.com',
'killmail.net',
'klassmaster.net',
'link2mail.net',
'lortemail.dk',
'mail2rss.org',
'mail333.com',
'mailblocks.com',
'maileater.com',
'mailexpire.com',
'mailfreeonline.com',
'mailmoat.com',
'mailnull.com',
'mailshell.com',
'mailsiphon.com',
'mailzilla.com',
'meinspamschutz.de',
'messagebeamer.de',
'mintemail.com',
'myspamless.com',
'mytrashmail.com',
'neomailbox.com',
'nervmich.net',
'nervtmich.net',
'netmails.com',
'netmails.net',
'netzidiot.de',
'nobulk.com',
'noclickemail.com',
'nospamfor.us',
'nurfuerspam.de',
'oneoffemail.com',
'oopi.org',
'outlawspam.com',
'pancakemail.com',
'poofy.org',
'pookmail.com',
'privacy.net',
'punkass.com',
'rejectmail.com',
'safersignup.de',
'shortmail.net',
'sibmail.com',
'slaskpost.se',
'sneakemail.com',
'sofort-mail.de',
'spam.la',
'spamavert.com',
'spambob.com',
'spambob.net',
'spambob.org',
'spambox.us',
'spamcon.org',
'spamday.com',
'spamex.com',
'spamfree24.com',
'spamfree24.net',
'spamfree24.org',
'spamgourmet.com',
'spamhole.com',
'spamify.com',
'spaminator.de',
'spamslicer.com',
'spaml.com',
'spammotel.com',
'spamoff.de',
'spamtrail.com',
'tempemail.net',
'tempinbox.com',
'temporarily.de',
'temporaryforwarding.com',
'temporaryinbox.com',
'trashmail.com',
'trashmail.net',
'trashmail.org',
'trashmail.de',
'trash-mail.de',
'twinmail.de',
'venompen.com',
'wegwerfadresse.de',
'wh4f.org',
'willselfdestruct.com',
'wuzup.net',
'wwwnew.eu',
'xemaps.com',
'xents.com',
'xmaily.com',
'yep.it',
'yopmail.com',
'zoemail.org',
'fakeinformation.com',
'fastacura.com',
'fastchevy.com',
'fastchrysler.com',
'fastkawasaki.com',
'fastmazda.com',
'fastmitsubishi.com',
'fastnissan.com',
'fastsubaru.com',
'fastsuzuki.com',
'fasttoyota.com',
'fastyamaha.com',
'fux0ringduh.com',
'klassmaster.com',
'mailin8r.com',
'mailinator.com',
'mailinater.com',
'mailinator2.com',
'sogetthis.com',
'675hosting.com',
'675hosting.net',
'675hosting.org',
'75hosting.com',
'75hosting.net',
'75hosting.org',
'ajaxapp.net',
'amiri.net',
'amiriindustries.com',
'emailmiser.com',
'etranquil.com',
'etranquil.net',
'etranquil.org',
'gowikibooks.com',
'gowikicampus.com',
'gowikicars.com',
'gowikifilms.com',
'gowikigames.com',
'gowikimusic.com',
'gowikinetwork.com',
'gowikitravel.com',
'gowikitv.com',
'iwi.net',
'myspaceinc.com',
'myspaceinc.net',
'myspaceinc.org',
'myspacepimpedup.com',
'ourklips.com',
'pimpedupmyspace.com',
'rklips.com',
'turual.com',
'upliftnow.com',
'uplipht.com',
'viditag.com',
'viewcastmedia.com',
'viewcastmedia.net',
'viewcastmedia.org',
'wetrainbayarea.com',
'wetrainbayarea.org',
'xagloo.com ',
'uggsrock.com'
 );
$EMAIL = array('email' => array('type' => 6, 'maxsize' => $EMAIL_MAXSIZE, 'blacklist' => $BLACKLIST)); // email
	
$LAT = array('lat' => array ('type' => 5)); 
$LNG = array('lng' => array ('type' => 5));
$NICK = array('nick' => array ('type' => 3, 'minsize' => $NICK_MINSIZE, 'maxsize' => $NICK_MAXSIZE)); // text 
$DESC = array('desc' => array ('type' => 3, 'minsize' => $DESC_MINSIZE, 'maxsize' => $DESC_MAXSIZE)); // text



ini_set('display_errors', false);
ini_set('display_startup_errors', false);
ini_set('register_long_arrays', false);
ini_set('register_globals', false);
ini_set('post_max_size', '8M');


?>
