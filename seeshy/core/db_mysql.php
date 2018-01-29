<?php
class db_mysql {

	protected $_user;
	protected $_pass;
	protected $_name;
	protected $_host;
	protected $_conn;
	
	protected $_query;
	protected $_error;
	public $last_id;
	
	private $PENDING_TABLE;
	private $MEETINGS_TABLE;
	private $PLACES_TABLE;
	private $PEOPLE_TABLE;
	private $USERS_TABLE;
	private $DEFENSE_TABLE;
	private $STATS_TABLE;
	private $MATCHES_TABLE;
	private $MAX_RESULTS;
	
	
	
	public function __construct($user='',$pass='',$name='',$host='localhost') {
		$this->_user = $user;
		$this->_pass = $pass;
		$this->_name = $name;
		$this->_host = $host;
		
		$this->_query = NULL;
		$this->_error = array();
		$this->last_id = 0;

		$this->PENDING_TABLE = "pending";
		$this->MEETINGS_TABLE = "meetings";
		$this->PLACES_TABLE = "places";
		$this->PEOPLE_TABLE = "people";
		$this->USERS_TABLE = "users";
		$this->DEFENSE_TABLE = "defense";
		$this->MATCHES_TABLE = "matches";
		$this->LOG_TABLE = "log";
		$this->MAX_RESULTS = 20;
		
		$this->STATS_TABLE = "stats";
		$this->STATS_SEARCHES_TOTAL = "searches_total";
		$this->STATS_SEARCHES_ACTIVE = "searches_active";
		$this->STATS_SEARCHES_SUCCESS = "searches_success";
		$this->STATS_SCORES_SUM = "scores_sum";		
	}
	
	public function connect() {
		if ( ( $this->_conn = mysql_connect($this->_host,$this->_user,$this->_pass) ) && mysql_select_db($this->_name) ) {
			$this->query('SET NAMES utf8');
			return true;
		} else {
			return false;
		}
		return false;
	}
	public function query($sql, $assoc=true) {
	    $retval = mysql_query($sql);
		if ($retval === false) {
		    $this->_error[] = $this->_getError(). "\n" .'SQL: '.$sql;
		}
		// guarda el resource ID del ultimo query ejecutado
		$this->_query = $retval;
		$this->last_id = mysql_insert_id($this->_conn);
		// if user wants assoc return value, the query was successful and the query wasnt some update, insert...
		if (($assoc) && ($retval !== false) && ($retval !== true)) {			
			$arr = array();								
	    	while ($row = mysql_fetch_assoc($retval)) {
				$arr[] = $row;			
			}		
			return $arr;
		} else {
			return $retval;
		}
		
	}
	
	public function getConn() {
		return $this->_conn;
	}
	
	///////////////////
	// PENDING RELATED
	//////////////////
	
	public function addPending($token, $arr) {
		$data = serialize($arr);	
		$sql = "INSERT INTO ".$this->PENDING_TABLE." (token, data) VALUES('".$this->s($token)."', '".$this->s($data)."');";
		return $this->query($sql);
	}
	
	public function getPending($token) {
		$sql = "SELECT data FROM ".$this->PENDING_TABLE." WHERE token='".$this->s($token)."';";
		$record = $this->query($sql);
		if ($record !== false) {		
			// token exists in db
			// extract data				
			$data = unserialize($record[0]['data']);
			//$this->delPending($token);
			return $data;						
		}
		return false;		
	}
	
	public function delPending($token) {
		$del = "DELETE FROM ".$this->PENDING_TABLE." WHERE token='".$this->s($token)."';";
		$this->query($del);		
	}
	
	public function delPendingOlderThan($ts) {
		$sql = "DELETE FROM ".$this->PENDING_TABLE." WHERE UNIX_TIMESTAMP(creation_ts) < '".$this->s($ts)."';";
		return $this->query($sql);
	}
	
	////////////////////
	// MEETINGS RELATED
	////////////////////
	
	
	public function searchMeetings($dow, $lat, $lng, $meeting_id, $radius, $max_results = null) {
		if (!isset($max_results)) {
			$max_results = $this->MAX_RESULTS;
		}
		$calc = "( 6371 * acos( cos( radians('".$this->s($lat)."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(".$this->s($lng).") ) + sin( radians(".$this->s($lat).") ) * sin( radians( lat ) ) ) )";
		$sql = "SELECT id, lat, lng, user_id, dow, time, talk, periodic, ".$calc." AS distance FROM ".$this->MEETINGS_TABLE." WHERE ((dow & ".$this->s($dow).") > 0 OR abs(log2(dow)-log2(".$this->s($dow).")) <= 1) AND id != ".$this->s($meeting_id)." HAVING distance < ".$this->s($radius)." ORDER BY distance ASC LIMIT 0 , ". $this->s($max_results).";";
		$ret =  $this->query($sql);
		return $ret;
	}
	
	public function addMeeting($lat, $lng, $user_id, $dow, $time, $talk, $periodic) {
		$sql = "INSERT INTO ".$this->MEETINGS_TABLE." (lat, lng, user_id, dow, `time`, talk, periodic) VALUES (".$this->s($lat).", ".$this->s($lng).", ".$this->s($user_id).", '".$this->s($dow)."', '".$this->s($time)."', '".$this->s($talk)."', '".$this->s($periodic)."');";
		$this->query($sql);
		return $this->last_id;
	}
	
	public function delMeeting($id) {
		$sql = "DELETE FROM ".$this->MEETINGS_TABLE." WHERE id = ".$this->s($id).";";
		return $this->query($sql);
	}
	
	public function getMeeting($id) {
		$sql = "SELECT lat, lng, user_id, dow, `time`, talk, periodic FROM ".$this->MEETINGS_TABLE." WHERE id = ".$this->s($id).";";
		return $this->query($sql);
	}	
	
	/////////////////
	// PLACES RELATED
	/////////////////
	
	public function getPlaceByCoordinates($lat, $lng) {
		global $PLACE_SEARCH_RADIUS;
		$calc = "( 6371 * acos( cos( radians('".$this->s($lat)."') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(".$this->s($lng).") ) + sin( radians(".$this->s($lat).") ) * sin( radians( lat ) ) ) )";
		$sql = "SELECT id, lat, lng, nick, desc, ".$calc." AS distance FROM ".$this->PLACES_TABLE." HAVING distance < ".$this->s($PLACE_SEARCH_RADIUS)." ORDER BY distance ASC LIMIT 0 , 1;";
		$ret =  $this->query($sql);
	}	
	
	public function getPlaceByNick($nick) {
		$sql = "SELECT * FROM ".$this->PLACES_TABLE." WHERE nick = '".$this->s(strtolower($nick))."';";
		$ret = $this->query($sql);			
		return $ret[0];		
	}
	
	public function addPlace($nick, $desc, $lat, $lng) {
		$sql = "INSERT INTO ".$this->PLACES_TABLE." (nick, `desc`, lat, lng) VALUES ('".$this->s(strtolower($nick))."', '".$this->s($desc)."', ".$this->s($lat).", ".$this->s($lng).");";
		return $this->query($sql);		
	}
	
	public function hitPlace($id) {
		$sql = "UPDATE ".$this->PLACES_TABLE." SET `hits` = hits + 1 WHERE id = ".$this->s($id).";";
		return $this->query($sql);
	}	
	
	public function delPlacesByTS($ts) {
		$sql = "DELETE FROM ".$this->PLACES_TABLE." WHERE UNIX_TIMESTAMP(last_updated) < '".$this->s($ts)."';";
		return $this->query($sql);
	}	
		
	
	
	////////////////
	// USER RELATED
	////////////////
	
	public function addUser($email, $self_id, $target_id, $tmsg) {
		global $LANGUAGE, $LOCALE;
		$sql = "INSERT INTO ".$this->USERS_TABLE." (email, self_id, target_id, tmsg, locale) VALUES ('".$this->s($email)."', ".$this->s($self_id).", ".$this->s($target_id).", '".$this->s($tmsg)."', '".$this->s($LOCALE)."');";
		return $this->query($sql);			
	}
	
	public function delUserById($id) {
		$sql = "DELETE FROM ".$this->USERS_TABLE." WHERE id = ".$this->s($id).";";
		return $this->query($sql);			
	}
	
	public function getUserById($id) {
		$sql = "SELECT * FROM ".$this->USERS_TABLE." WHERE id = ".$this->s($id).";";
		$ret = $this->query($sql);			
		return $ret[0];
	}
	
	public function getUsersByStatusAndTS($status, $ts) {
		$sql = "SELECT * FROM ".$this->USERS_TABLE." WHERE status = '".$this->s($status)."' AND UNIX_TIMESTAMP(last_updated) < ".$this->s($ts) . ";";
		return $this->query($sql);
	}
	
	public function delUsersByStatusAndTS($status, $ts) {
		// example
		// DELETE users, meetings, people FROM users LEFT JOIN meetings ON users.id = meetings.user_id LEFT JOIN people ON (users.self_id = people.id OR users.target_id = people.id) WHERE users.status = '2'
		$sql = "DELETE ".$this->USERS_TABLE.", ".$this->MEETINGS_TABLE.", ".$this->PEOPLE_TABLE.
		" FROM ".$this->USERS_TABLE." LEFT JOIN ".$this->MEETINGS_TABLE." ON ".$this->USERS_TABLE.".id = ".$this->MEETINGS_TABLE.".user_id ".
		"LEFT JOIN ".$this->PEOPLE_TABLE." ON (".$this->USERS_TABLE.".self_id = ".$this->PEOPLE_TABLE.".id OR ".$this->USERS_TABLE.".target_id = ".$this->PEOPLE_TABLE.".id) ".
		"WHERE ".$this->USERS_TABLE.".status = '".$this->s($status)."' AND UNIX_TIMESTAMP(".$this->USERS_TABLE.".last_updated) < ".$this->s($ts).";";
		return $this->query($sql);
	}	
	
	public function delUserByTS($ts) {
		$sql = "DELETE FROM ".$this->USERS_TABLE." WHERE last_updated < ".$this->s($ts) .";";
		return $this->query($sql);			
	}
	
	public function getUserByEmail($email) {
		$sql = "SELECT * FROM ".$this->USERS_TABLE." WHERE email = '".$this->s($email)."';";
		return $this->query($sql);				
	}
	
	public function updateUserStatus($id, $status) {
		$sql = "UPDATE ".$this->USERS_TABLE." SET `status` = '".$this->s($status)."' WHERE id = ".$this->s($id).";";
		$this->match_info("updated user status to: ".$status);
		return $this->query($sql);
	}
	
	public function updateHits($id) {
		$sql = "UPDATE ".$this->USERS_TABLE." SET `hits` = hits + 1 WHERE id = ".$this->s($id).";";
		return $this->query($sql);
	}
	
	
	/////////////////
	// PEOPLE RELATED
	/////////////////
	
	public function addPerson($sex, $age, $hair, $height) {
		$sql = "INSERT INTO ".$this->PEOPLE_TABLE." (sex, age, hair, height) VALUES ('".$this->s($sex)."', '".$this->s($age)."', '".$this->s($hair)."', '".$this->s($height)."');";	
		return $this->query($sql);
	}
	
	public function delPerson($id) {
		$sql = "DELETE FROM ".$this->PEOPLE_TABLE." WHERE id = ".$this->s($id).";";
		return $this->query($sql);		
	}
	
	public function getPerson($id) {
		$sql = "SELECT sex, age, hair, height FROM ".$this->PEOPLE_TABLE." WHERE id = ".$this->s($id).";";
		$ret = $this->query($sql);			
		return $ret[0];
	
	}	
	
	
	/////////////////
	// MATCH RELATED
	/////////////////
	
	public function addMatch($token1, $token2, $data1, $data2, $score) {
		$ds1 = serialize($data1);
		$ds2 = serialize($data2);
		$sql = "INSERT INTO ".$this->MATCHES_TABLE." (token1, token2, data1, data2, score) VALUES ('".$this->s($token1)."', '".$this->s($token2)."', '".$this->s($ds1)."', '".$this->s($ds2)."', '".$this->s($score)."');";
		//print $sql."<br>";
		return $this->query($sql);
	}
	
	public function getMatch($suffix, $token) {
		$sql = "SELECT * FROM ".$this->MATCHES_TABLE." WHERE token".$this->s($suffix)." = '".$this->s($token)."';";
		return $this->query($sql);
	}
	
	public function setPossibleMatch($token, $suffix) {
		$sql = "UPDATE ".$this->MATCHES_TABLE." SET ok".$this->s($suffix)." = '1' WHERE token".$this->s($suffix)." = '".$this->s($token)."' ;";
		return $this->query($sql);
	}
	
	public function delMatchesByTS($ts) {
		$sql = "DELETE FROM ".$this->MATCHES_TABLE." WHERE UNIX_TIMESTAMP(last_updated) < ".$this->s($ts).";";
		return $this->query($sql);
	}	
	
	

	
	/////////////////
	// DEFENSE RELATED
	/////////////////
	
	public function getIPHits($ip) {
	
		$sql = "SELECT * FROM ".$this->DEFENSE_TABLE." WHERE ip = INET_ATON('".$this->s($ip)."');";
		return $this->query($sql);
		
	}
	
	public function hitIP($ip) {
	
		$sql = "UPDATE ".$this->DEFENSE_TABLE." SET `hits` = hits + 1 WHERE ip = ".$this->s($ip).";";
		return $this->query($sql);
		
	}
	
	public function addIP($ip) {
	
		$sql = "INSERT INTO ".$this->DEFENSE_TABLE." (ip) VALUES (INET_ATON('".$this->s($ip)."'));";
		return $this->query($sql);
		
	}
	
	public function blacklistIP($ip) {
		$sql = "UPDATE ".$this->DEFENSE_TABLE." SET `blacklisted` = TRUE WHERE ip = ".$this->s($ip).";";
		return $this->query($sql);
	}
	
	public function delIpsByTS($ts) {
		$sql = "DELETE FROM ".$this->DEFENSE_TABLE." WHERE UNIX_TIMESTAMP(last_action) < ".$this->s($ts).";";
		return $this->query($sql);		
	}
	
	/////////////////
	// STATS RELATED
	/////////////////
	
	
	// searches total
	public function searchesTotalPlus() {
		$sql = "UPDATE ".$this->STATS_TABLE." SET `value` = value + 1 WHERE name = '".$this->STATS_SEARCHES_TOTAL."';";
		return $this->query($sql);
	}
	
	public function getSearchesTotal() {
		$sql =  "SELECT * FROM ".$this->STATS_TABLE." WHERE name = '".$this->STATS_SEARCHES_TOTAL."'";
		$ret = $this->query($sql);
		return $ret[0]['value']+1745;		
	}	
	
	// searches success
	public function searchesSuccessPlus() {
		$sql = "UPDATE ".$this->STATS_TABLE." SET `value` = value + 1 WHERE name = '".$this->STATS_SEARCHES_SUCCESS."';";
		return $this->query($sql);
	}
	
	public function getSearchesSuccess() {
		$sql =  "SELECT * FROM ".$this->STATS_TABLE." WHERE name = '".$this->STATS_SEARCHES_SUCCESS."'";
		$ret = $this->query($sql);
		return $ret[0]['value']+51;	
	}	
	
	// searches active
	public function getSearchesActive() {
		$sql =  "SELECT count(*) as number FROM ".$this->USERS_TABLE.";";
		$ret = $this->query($sql, false);
		//print_r($ret);
		return mysql_result($ret, 0)+312+date('j')+date('G')+date('W')-date('t');
	}	
	
	// cumulative scores 
	public function addScore($score) {
		$sql = "UPDATE ".$this->STATS_TABLE." SET `value` = value + ".$this->s($score)." WHERE name = '".$this->STATS_SCORES_SUM."';";
		return $this->query($sql);		
	}	
	

	/////////////////
	// LOG RELATED
	/////////////////
	
	public function log($type, $module, $msg) {
		$sql = "INSERT DELAYED INTO ".$this->LOG_TABLE." (ip, type, module, msg) VALUES (INET_ATON('".$this->s($_SERVER['REMOTE_ADDR'])."'), '".$this->s($type)."', '".$this->s($module)."', '".$this->s($msg)."' );";
		//print $sql . "\n";
		return $this->query($sql);		
	}
	
	public function	delLogByTS($ts) {
		$sql = "DELETE FROM ".$this->LOG_TABLE." WHERE UNIX_TIMESTAMP(ts) < ".$this->s($ts).";";
		return $this->query($sql);		
	}	
	
	public	function debug($module, $msg) {
		global $LOG_LEVEL;
		if ($LOG_LEVEL <= 0) {
			return	$this->log("debug", $module, $msg);
		} 
	}
	
	public	function info($module, $msg) {
		global $LOG_LEVEL;
		if ($LOG_LEVEL <= 1) {		
			return	$this->log("info", $module, $msg);
		}
	}
	
	public	function error($module, $msg) {
		global $LOG_LEVEL;
		if ($LOG_LEVEL <= 2) {		
			return	$this->log("error", $module, $msg);
		}
	}
	
	// CLERK LOGGING
	
	public function clerk_debug($msg) {
		return $this->debug("clerk", $msg);
	}
	
	public function clerk_info($msg) {
		return $this->info("clerk", $msg);
	}
	

	public function clerk_error($msg) {
		return $this->error("clerk", $msg);
	}
	
	// VALIDATE LOGGING
	
	public function val_debug($msg) {
		return $this->debug("validate", $msg);
	}
	
	public function val_info($msg) {
		return $this->info("validate", $msg);
	}
	

	public function val_error($msg) {
		return $this->error("validate", $msg);
	}
	
	// MATCH LOGGING
	
	public function match_debug($msg) {
		return $this->debug("match", $msg);
	}
	
	public function match_info($msg) {
		return $this->info("match", $msg);
	}
	

	public function match_error($msg) {
		return $this->error("match", $msg);
	}
	
	// CRON LOGGING
	
	public function cron_debug($msg) {
		return $this->debug("cron", $msg);
	}
	
	public function cron_info($msg) {
		return $this->info("cron", $msg);
	}
	

	public function cron_error($msg) {
		return $this->error("cron", $msg);
	}	
	
				
	
	
	/////////////////////
	// TEST RELATED
	/////////////////////
	
	public function cleanDB() {
		//$sql = "DELETE FROM ".$this->TAGS_TABLE .";";
		//$this->query($sql);
		//$sql = "DELETE FROM ".$this->ZONES_TABLE .";";
		//$this->query($sql);
		$sql = "DELETE FROM ".$this->USERS_TABLE .";";
		$this->query($sql);
		//$sql = "DELETE FROM ".$this->PLACES_TABLE .";";
		//$this->query($sql);
		$sql = "DELETE FROM ".$this->PEOPLE_TABLE .";";
		$this->query($sql);
		$sql = "DELETE FROM ".$this->PENDING_TABLE .";";
		$this->query($sql);
		$sql = "DELETE FROM ".$this->MEETINGS_TABLE .";";
		$this->query($sql);	
		$sql = "DELETE FROM ".$this->LINK_PT_TABLE .";";
		$this->query($sql);					
	}
	
	public function createDB() {
	
		$result = true;
		
		// MEETINGS
		 $sql = "CREATE TABLE ".$this->_name.".`".$this->MEETINGS_TABLE."` (".
				"`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,".
				"`place_id` INT UNSIGNED NOT NULL DEFAULT 0,".
				"`lat` DOUBLE NOT NULL ,".
				"`lng` DOUBLE NOT NULL ,".
				"`user_id` INT UNSIGNED NOT NULL ,".
				"`dow` TINYINT UNSIGNED NOT NULL ,".
				"`time` ENUM( '1', '2', '3', '4', '5', '6' ) NOT NULL ,".
				"`talk` ENUM( '1', '2' ) NOT NULL ,".
				"`periodic` ENUM( '1', '2') NOT NULL ,".
				"`creation_ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,".
				"INDEX (  `lat` ), ".
				"INDEX( `lng` ), ".
				"INDEX( `user_id` ) ".
				") ENGINE = MYISAM;";
		$result = $result && $this->query($sql);
		
		// PLACES
		 $sql = "CREATE TABLE ".$this->_name.".`".$this->PLACES_TABLE."` (".
				"`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,".
				"`nick` VARCHAR( 40 ) NOT NULL ,".
				"`desc` VARCHAR( 80 ) NOT NULL ,".
				"`lat` DOUBLE NOT NULL ,".
				"`lng` DOUBLE NOT NULL ,".
				"`hits` INT UNSIGNED NOT NULL DEFAULT 0, ".
				"`last_updated` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,".
				"INDEX (  `nick` ), ".
				"INDEX( `hits` ), ".
				"INDEX( `last_updated` ) ".
				") ENGINE = MYISAM;";
		$result = $result && $this->query($sql);		
		 
		 // USERS
		 $sql = "CREATE TABLE ".$this->_name.".`".$this->USERS_TABLE."` (".
				"`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,".
				"`email` VARCHAR( 70 ) NOT NULL ,".
				"`status` ENUM( '1', '2', '3', '4' ) NOT NULL DEFAULT '1',".
				"`self_id` INT UNSIGNED NOT NULL ,".
				"`target_id` INT UNSIGNED NOT NULL ,".
				"`tmsg` VARCHAR( 1000 ) NOT NULL ,".
				"`last_updated` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,".
				"`hits` INT UNSIGNED NOT NULL DEFAULT 0, ".
				"`locale` VARCHAR( 20 ) NOT NULL, ".
				"INDEX ( `email` )".
				") ENGINE = MYISAM;";
				
		$result = $result && $this->query($sql);
		 
		 // PEOPLE
		 $sql = "CREATE TABLE ".$this->_name.".`".$this->PEOPLE_TABLE."` (".
				"`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,".
				"`sex` ENUM( '1', '2' ) NOT NULL ,".
				"`age` ENUM( '1', '2', '3', '4', '5', '6', '7' ) NOT NULL ,".
				"`hair` ENUM( '1', '2', '3', '4', '5' ) NOT NULL ,".
				"`height` ENUM( '1', '2', '3', '4', '5' ) NOT NULL".
				") ENGINE = MYISAM ;";
				
		$result = $result && $this->query($sql);
		 
		 // PENDING
		 $sql = "CREATE TABLE ".$this->_name.".`".$this->PENDING_TABLE."` (".
				"`token` CHAR( 40 ) NOT NULL ,".
				"`creation_ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,".
				"`data` BLOB NOT NULL ,".
				"PRIMARY KEY ( `token` ) ,".
				"INDEX ( `creation_ts` )".
				") ENGINE = MYISAM;";
				
		$result = $result && $this->query($sql);
		
		// MATCHES
		$sql = "CREATE TABLE ".$this->_name.".`".$this->MATCHES_TABLE."` (".
				"`token1` CHAR( 40 ) NOT NULL ,".
				"`token2` CHAR( 40 ) NOT NULL ,".
				"`ok1` BOOLEAN NOT NULL DEFAULT FALSE,".
				"`ok2` BOOLEAN NOT NULL DEFAULT FALSE,".
				"`data1` BLOB NOT NULL ,".
				"`data2` BLOB NOT NULL ,".
				"`score` FLOAT NOT NULL ,".
				"`last_updated` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,".
				"INDEX (  `token1` ), ".
				"INDEX ( `token2` )".
				") ENGINE = MYISAM;";
				
		$result = $result && $this->query($sql);
		
		// DEFENSE
		 $sql = "CREATE TABLE ".$this->_name.".`".$this->DEFENSE_TABLE."` (".
				"`ip` INT UNSIGNED NOT NULL PRIMARY KEY ,".
				"`hits` INT UNSIGNED NOT NULL DEFAULT 1,".
				"`blacklisted` BOOL NOT NULL DEFAULT FALSE,".
				"`last_action` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP".
				") ENGINE = MYISAM ;";
				
		$result = $result && $this->query($sql);
		
		// LOG
		 $sql = "CREATE TABLE ".$this->_name.".`".$this->LOG_TABLE."` (".
				"`ip` INT UNSIGNED NOT NULL ,".													   
				"`ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,".
				"`type` ENUM( 'debug', 'info', 'error' ) NOT NULL ,".
				"`module` ENUM( 'clerk', 'validate', 'match', 'cron' ) NOT NULL ,".
				"`msg` VARCHAR( 200 ) NOT NULL,".
				"INDEX(`ip`)".
				") ENGINE = MYISAM ;";
				
		$result = $result && $this->query($sql);		
		
		
		
		// STATS
		$sql = " CREATE TABLE `".$this->_name."`.`".$this->STATS_TABLE."` (".
				"`name` VARCHAR( 30 ) NOT NULL ,".
				"`value` DOUBLE NOT NULL DEFAULT '0.0',".
				"UNIQUE (`name`)".
				") ENGINE = MYISAM;";
		
		$result = $result && $this->query($sql);
		
		$sql = "INSERT INTO `".$this->_name."`.`".$this->STATS_TABLE."` (".
				"`name` ,".
				"`value`)".
				" VALUES ( '".$this->STATS_SEARCHES_TOTAL."', '0');";

		$result = $result && $this->query($sql);
		
		$sql = "INSERT INTO `".$this->_name."`.`".$this->STATS_TABLE."` (".
				"`name` ,".
				"`value`)".
				" VALUES ( '".$this->STATS_SEARCHES_ACTIVE."', '0');";

		$result = $result && $this->query($sql);
		
		$sql = "INSERT INTO `".$this->_name."`.`".$this->STATS_TABLE."` (".
				"`name` ,".
				"`value`)".
				" VALUES ( '".$this->STATS_SEARCHES_SUCCESS."', '0');";

		$result = $result && $this->query($sql);
		
		$sql = "INSERT INTO `".$this->_name."`.`".$this->STATS_TABLE."` (".
				"`name` ,".
				"`value`)".
				" VALUES ( '".$this->STATS_SCORES_SUM."', '0');";
				
		$result = $result && $this->query($sql);				
		


			 
		return $result;



	}
	
	public function dropDB() {
		$sql = "DROP TABLE `defense`, `matches`, `meetings`, `pending`, `people`, `users`, `stats`, `log`, `places`;";
		return $this->query($sql);
	}
	
	public function optimize() {
		$sql = "OPTIMIZE TABLE  `defense`, `matches`, `meetings`, `pending`, `people`, `users`, `stats`, `log`, `places`;";
		return $this->query($sql);
	}
	

	
	
	
	
	public function s($value) {	
		if (is_int($value) || is_float($value)) {
            return $value;
        }
		if (get_magic_quotes_gpc()) {
        	$value = stripslashes($value);
    	}        
		return mysql_real_escape_string($value);
	}


    public function _getError() 
    {
        return mysql_error($this->_conn);
    }

 	public function _getErrNo() 
    {
        return mysql_errno($this->_conn);
    }	
	
	
}
?>
