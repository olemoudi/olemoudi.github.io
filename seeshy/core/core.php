<?php

include_once('core/constants.php');


function checkForError($var) {
	global $DOMAIN, $LOGO_FILE, $ERROR_FILE, $ERROR_PAGE_INTROTEXT_HTML, $VALIDATE_PAGE_TITLE, $FOLLOW_US;
	if ($var === false) {
		include('inc/general_error.php');
		die();
	}
}

function onMaintenance() {
	global $ADMIN_IPS, $MAINTENANCE;
	
	$result = $MAINTENANCE;
	$client_ip = $_SERVER['REMOTE_ADDR'];
	
	if (in_array($client_ip, $ADMIN_IPS)) {
		
		$result = FALSE;
		
	}
	
	return $result;
}


	
function validIP($db) {
	global $IP_HITS_BEFORE_BLACKLIST;
	
	$result = true;
	
	// sorry proxies out there :(
	$ips = $db->getIPHits($_SERVER['REMOTE_ADDR']);
	
	if ($ips) {
	
		hitIP($db, $ips[0]['ip']);
				
		if (($ips[0]['blacklisted'] != true) && ($ips[0]['hits'] >= $IP_HITS_BEFORE_BLACKLIST)) {
		
			// uncomment after release 
			blacklistIP($db, $ips[0]['ip']);
			$result = false;
			
		} 
		
		if ($ips[0]['blacklisted'] == true) {
			$result = false;
		}
		
		
	} else {
		
		$db->addIP($_SERVER['REMOTE_ADDR']);
		
		$result = true;
		
	}
	
	return $result;
}

function hitIP($db, $ip) {
	return $db->hitIP($ip);
}

function blacklistIP($db, $ip) {
	return $db->blacklistIP($ip);
}


function setLang() {
	global $LOCALE, $DEFAULT_LOCALE, $ES_LOCALE, $DOMAIN, $DEFAULT_DOMAIN, $EN_DOMAIN, $ES_DOMAIN, $EN_SUBDOMAIN, $ES_SUBDOMAIN, $SUBDOMAIN;
	
	$domain = $DEFAULT_DOMAIN;
	$locale = $DEFAULT_LOCALE;
	$l = "en";
	
	if  ( isset( $_SERVER["HTTP_ACCEPT_LANGUAGE"] ) && !isset($_COOKIE['sslang'])) {
		//explode languages into array
        $langs = explode(",",strtolower( $_SERVER["HTTP_ACCEPT_LANGUAGE"] ));
        // $langs = ' fr-ch;q=0.3, da, en-us;q=0.8, en;q=0.5, fr;q=0.3';
        
        $l = 'en';
        
        foreach ($langs as $lang) {
        	switch (substr($lang, 0, 2)) {
        		case "en":
        			$l = "en";
					$locale = $DEFAULT_LOCALE;
					$domain = $DEFAULT_DOMAIN;					
        			break 2;
        		case "es":
        			$l = "es";
					$locale = $ES_LOCALE;
					$domain = $ES_DOMAIN;					
        			break 2;
        		default: 
        			$l = "en";
					$locale = $DEFAULT_LOCALE;
					$domain = $DEFAULT_DOMAIN;					
        			break;
        	}
        }
		
    } elseif (isset($_COOKIE['sslang'])) {
	
		switch ($_COOKIE['sslang']) {
			case "en":
				$locale = $DEFAULT_LOCALE;
				$domain = $DEFAULT_DOMAIN;
				break;
			case "es":				
				$locale = $ES_LOCALE;
				$domain = $ES_DOMAIN;
				break;
			default: 
				$locale = $DEFAULT_LOCALE;
				$domain = $DEFAULT_DOMAIN;
				break;
		}
		
	} 
	
	if (isset($_GET['hl'])) {
    
    	$l = "en";
		switch ($_GET['hl']) {
			case "en":
				$l = "en";
				break;
			case "es":
				$l = "es";
				break;
			default: 
				$l = "en";
				break;
		}
		setcookie("sslang", $l, time() + (86400 * 7) , "", 'seeshy.com');    
    	
    } 
	
	// get subdomain
	$strings = explode('.', $_SERVER['HTTP_HOST']);
	$subdomain = $strings[0];

	switch ($subdomain) {
		case $EN_SUBDOMAIN:
			$locale = $DEFAULT_LOCALE;
			$domain = $DEFAULT_DOMAIN;
			break;
		case $ES_SUBDOMAIN:
			$locale = $ES_LOCALE;
			$domain = $ES_DOMAIN;
			break;
		default: 
			break;
	}	
	
	 
	$LOCALE = $locale;
	$DOMAIN = $domain;
	$LANGUAGE = $l;
	if ($DOMAIN != $domain) {
		$DOMAIN = $domain;
		header('Location: http://'.$domain);
	} 	
}

////////////////////////////////////////////////////////////////////////////////
// lo de pablo
//////////////////////////////////////////////////////

/*Caracteres a Reemplazar
á	&#225;
é	&#233;
í	&#237;
ó	&#243;
ú	&#250;
Á	&#193;
É	&#201;
Í	&#205;
Ó	&#211;
Ú	&#218;
ñ	&#241;
Ñ	&#209;
¡	&#161;
¿	&#191;
(espacio)	&nbsp;
*/

function makeSafeEntities($str, $convertTags = 0, $encoding = "") {
  if (is_array($arrOutput = $str)) {
    foreach (array_keys($arrOutput) as $key)
      $arrOutput[$key] = makeSafeEntities($arrOutput[$key],$encoding);
    return $arrOutput;
    }
  else if (!empty($str)) {
    $str = makeUTF8($str,$encoding);
    $str = mb_convert_encoding($str,"HTML-ENTITIES","UTF-8");
    $str = makeAmpersandEntities($str);
    if ($convertTags)
      $str = makeTagEntities($str);
    $str = correctIllegalEntities($str);
    return $str;
    }
  }

// Convert str to UTF-8 (if not already), then convert to HTML numbered decimal entities.
// If selected, it first converts any illegal chars to safe named (and numbered) entities
// as in makeSafeEntities(). Unlike mb_convert_encoding(), mb_encode_numericentity() will
// NOT skip any already existing entities in the string, so use a regex to skip them.
function makeAllEntities($str, $useNamedEntities = 0, $encoding = "") {
  if (is_array($str)) {
    foreach ($str as $s)
      $arrOutput[] = makeAllEntities($s,$encoding);
    return $arrOutput;
    }
  else if (!empty($str)) {
    $str = makeUTF8($str,$encoding);
    if ($useNamedEntities)
      $str = mb_convert_encoding($str,"HTML-ENTITIES","UTF-8");
    $str = makeTagEntities($str,$useNamedEntities);
    // Fix backslashes so they don't screw up following mb_ereg_replace
    // Single quotes are fixed by makeTagEntities() above
    $str = mb_ereg_replace('\\\\',"&#92;", $str);
    mb_regex_encoding("UTF-8");
    $str = mb_ereg_replace("(?>(&(?:[a-z]{0,4}\w{2,3};|#\d{2,5};)))|(\S+?)",
                          "'\\1'.mb_encode_numericentity('\\2',array(0x0,0x2FFFF,0,0xFFFF),'UTF-8')", $str, "ime");
    $str = correctIllegalEntities($str);
    return $str;
    }
  }

// Convert common characters to named or numbered entities
function makeTagEntities($str, $useNamedEntities = 1) {
  // Note that we should use &apos; for the single quote, but IE doesn't like it
  $arrReplace = $useNamedEntities ? array('&#39;','&quot;','&lt;','&gt;') : array('&#39;','&#34;','&#60;','&#62;');
  return str_replace(array("'",'"','<','>'), $arrReplace, $str);
  }

// Convert ampersands to named or numbered entities.
// Use regex to skip any that might be part of existing entities.
function makeAmpersandEntities($str, $useNamedEntities = 1) {
  return preg_replace("/&(?![A-Za-z]{0,4}\w{2,3};|#[0-9]{2,5};)/m", $useNamedEntities ? "&amp;" : "&#38;", $str);
  }

// Convert illegal HTML numbered entities in the range 128 - 159 to legal couterparts
function correctIllegalEntities($str) {
  $chars = array(
    128 => '&#8364;',
    130 => '&#8218;',
    131 => '&#402;',
    132 => '&#8222;',
    133 => '&#8230;',
    134 => '&#8224;',
    135 => '&#8225;',
    136 => '&#710;',
    137 => '&#8240;',
    138 => '&#352;',
    139 => '&#8249;',
    140 => '&#338;',
    142 => '&#381;',
    145 => '&#8216;',
    146 => '&#8217;',
    147 => '&#8220;',
    148 => '&#8221;',
    149 => '&#8226;',
    150 => '&#8211;',
    151 => '&#8212;',
    152 => '&#732;',
    153 => '&#8482;',
    154 => '&#353;',
    155 => '&#8250;',
    156 => '&#339;',
    158 => '&#382;',
    159 => '&#376;');
  foreach (array_keys($chars) as $num)
    $str = str_replace("&#".$num.";", $chars[$num], $str);
  return $str;
  }

// Compare to native utf8_encode function, which will re-encode text that is already UTF-8
function makeUTF8($str,$encoding = "") {
  if (!empty($str)) {
    if (empty($encoding) && isUTF8($str))
      $encoding = "UTF-8";
    if (empty($encoding))
      $encoding = mb_detect_encoding($str,'UTF-8, ISO-8859-1');
    if (empty($encoding))
      $encoding = "ISO-8859-1"; //  if charset can't be detected, default to ISO-8859-1
    return $encoding == "UTF-8" ? $str : @mb_convert_encoding($str,"UTF-8",$encoding);
    }
  }

// Much simpler UTF-8-ness checker using a regular expression created by the W3C:
// Returns true if $string is valid UTF-8 and false otherwise.
// From http://w3.org/International/questions/qa-forms-utf-8.html
function isUTF8($str) {
   return preg_match('%^(?:
         [\x09\x0A\x0D\x20-\x7E]           // ASCII
       | [\xC2-\xDF][\x80-\xBF]            // non-overlong 2-byte
       | \xE0[\xA0-\xBF][\x80-\xBF]        // excluding overlongs
       | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} // straight 3-byte
       | \xED[\x80-\x9F][\x80-\xBF]        // excluding surrogates
       | \xF0[\x90-\xBF][\x80-\xBF]{2}     // planes 1-3
       | [\xF1-\xF3][\x80-\xBF]{3}         // planes 4-15
       | \xF4[\x80-\x8F][\x80-\xBF]{2}     // plane 16
   )*$%xs', $str);
  }

function tildes($texto) {
	return makeSafeEntities($texto);
}


/*
 * Copyright (c) 2002,2003 Free Software Foundation
 * developed under the custody of the
 * Open Web Application Security Project
 * (http://www.owasp.org)
 *
 * This file is part of the PHP Filters.
 * PHP Filters is free software; you can redistribute it and/or modify it 
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * PHP Filters is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 * 
 * If you are not able to view the LICENSE, which should
 * always be possible within a valid and working PHP Filters release,
 * please write to the Free Software Foundation, Inc.,
 * 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 * to get a copy of the GNU General Public License or to report a
 * possible license violation.
 */
///////////////////////////////////////
// sanitize.inc.php
// Sanitization functions for PHP
// by: Gavin Zuchlinski, Jamie Pratt, Hokkaido
// webpage: http://libox.net
// Last modified: December 21, 2003
//
// Many thanks to those on the webappsec list for helping me improve these functions
///////////////////////////////////////
// Function list:
// sanitize_paranoid_string($string) -- input string, returns string stripped of all non
//           alphanumeric
// sanitize_system_string($string) -- input string, returns string stripped of special
//           characters
// sanitize_sql_string($string) -- input string, returns string with slashed out quotes
// sanitize_html_string($string) -- input string, returns string with html replacements
//           for special characters
// sanitize_int($integer) -- input integer, returns ONLY the integer (no extraneous
//           characters
// sanitize_float($float) -- input float, returns ONLY the float (no extraneous
//           characters)
// sanitize($input, $flags) -- input any variable, performs sanitization
//           functions specified in flags. flags can be bitwise
//           combination of PARANOID, SQL, SYSTEM, HTML, INT, FLOAT, LDAP,
//           UTF8
//
//
///////////////////////////////////////
//
// 20031121 jp - added defines for magic_quotes and register_globals, added ; to replacements
//               in sanitize_sql_string() function, created rudimentary testing pages
// 20031221 gz - added nice_addslashes and changed sanitize_sql_string to use it
//
/////////////////////////////////////////

define("PARANOID", 1);
define("SQL", 2);
define("SYSTEM", 4);
define("HTML", 8);
define("INT", 16);
define("FLOAT", 32);
define("LDAP", 64);
define("UTF8", 128);

// get register_globals ini setting - jp
$register_globals = (bool) ini_get('register_gobals');
if ($register_globals == TRUE) { define("REGISTER_GLOBALS", 1); } else { define("REGISTER_GLOBALS", 0); }

// get magic_quotes_gpc ini setting - jp
$magic_quotes = (bool) ini_get('magic_quotes_gpc');
if ($magic_quotes == TRUE) { define("MAGIC_QUOTES", 1); } else { define("MAGIC_QUOTES", 0); }

// addslashes wrapper to check for gpc_magic_quotes - gz
function nice_addslashes($string)
{
  // if magic quotes is on the string is already quoted, just return it
  if(MAGIC_QUOTES)
    return $string;
  else
    return addslashes($string);
}

// internal function for utf8 decoding
// thanks to Hokkaido for noticing that PHP's utf8_decode function is a little
// screwy, and to jamie for the code
function my_utf8_decode($string)
{
return strtr($string,
  "???????¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ",
  "SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
}

// paranoid sanitization -- only let the alphanumeric set through
function sanitize_paranoid_string($string, $min='', $max='')
{
  $string = preg_replace("/[^a-zA-Z0-9]/", "", $string);
  $len = strlen($string);
  if((($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
    return FALSE;
  return $string;
}

// sanitize a string in prep for passing a single argument to system() (or similar)
function sanitize_system_string($string, $min='', $max='')
{
  $pattern = '/(;|\||`|>|<|&|^|"|'."\n|\r|'".'|{|}|[|]|\)|\()/i'; // no piping, passing possible environment variables ($),
                           // seperate commands, nested execution, file redirection,
                           // background processing, special commands (backspace, etc.), quotes
                           // newlines, or some other special characters
  $string = preg_replace($pattern, '', $string);
  $string = '"'.preg_replace('/\$/', '\\\$', $string).'"'; //make sure this is only interpretted as ONE argument
  $len = strlen($string);
  if((($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
    return FALSE;
  return $string;
}

// sanitize a string for SQL input (simple slash out quotes and slashes)
function sanitize_sql_string($string, $min='', $max='')
{
  $string = nice_addslashes($string); //gz
  $pattern = "/;/"; // jp
  $replacement = "";
  $len = strlen($string);
  if((($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
    return FALSE;
  return preg_replace($pattern, $replacement, $string);
}

// sanitize a string for SQL input (simple slash out quotes and slashes)
function sanitize_ldap_string($string, $min='', $max='')
{
  $pattern = '/(\)|\(|\||&)/';
  $len = strlen($string);
  if((($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
    return FALSE;
  return preg_replace($pattern, '', $string);
}


// sanitize a string for HTML (make sure nothing gets interpretted!)
function sanitize_html_string($string)
{
  $pattern[0] = '/\&/';
  $pattern[1] = '/</';
  $pattern[2] = "/>/";
  $pattern[3] = '/\n/';
  $pattern[4] = '/"/';
  $pattern[5] = "/'/";
  $pattern[6] = "/%/";
  $pattern[7] = '/\(/';
  $pattern[8] = '/\)/';
  $pattern[9] = '/\+/';
  $pattern[10] = '/-/';
  $replacement[0] = '&amp;';
  $replacement[1] = '&lt;';
  $replacement[2] = '&gt;';
  $replacement[3] = '<br>';
  $replacement[4] = '&quot;';
  $replacement[5] = '&#39;';
  $replacement[6] = '&#37;';
  $replacement[7] = '&#40;';
  $replacement[8] = '&#41;';
  $replacement[9] = '&#43;';
  $replacement[10] = '&#45;';
  return preg_replace($pattern, $replacement, $string);
}

// make int int!
function sanitize_int($integer, $min='', $max='')
{
  $int = intval($integer);
  if((($min != '') && ($int < $min)) || (($max != '') && ($int > $max)))
    return FALSE;
  return $int;
}

// make float float!
function sanitize_float($float, $min='', $max='')
{
  $float = floatval($float);
  if((($min != '') && ($float < $min)) || (($max != '') && ($float > $max)))
    return FALSE;
  return $float;
}

// glue together all the other functions
function sanitize($input, $flags, $min='', $max='')
{
  if($flags & UTF8) $input = my_utf8_decode($input);
  if($flags & PARANOID) $input = sanitize_paranoid_string($input, $min, $max);
  if($flags & INT) $input = sanitize_int($input, $min, $max);
  if($flags & FLOAT) $input = sanitize_float($input, $min, $max);
  if($flags & HTML) $input = sanitize_html_string($input, $min, $max);
  if($flags & SQL) $input = sanitize_sql_string($input, $min, $max);
  if($flags & LDAP) $input = sanitize_ldap_string($input, $min, $max);
  if($flags & SYSTEM) $input = sanitize_system_string($input, $min, $max);
  return $input;
}

function check_paranoid_string($input, $min='', $max='')
{
  if($input != sanitize_paranoid_string($input, $min, $max))
    return FALSE;
  return TRUE;
}

function check_int($input, $min='', $max='')
{
  if($input != sanitize_int($input, $min, $max))
    return FALSE;
  return TRUE;
}

function check_float($input, $min='', $max='')
{
  if($input != sanitize_float($input, $min, $max))
    return FALSE;
  return TRUE;
}

function check_html_string($input, $min='', $max='')
{
  if($input != sanitize_html_string($input, $min, $max))
    return FALSE;
  return TRUE;
}

function check_sql_string($input, $min='', $max='')
{
  if($input != sanitize_sql_string($input, $min, $max))
    return FALSE;
  return TRUE;
}

function check_ldap_string($input, $min='', $max='')
{
  if($input != sanitize_string($input, $min, $max))
    return FALSE;
  return TRUE;
}

function check_system_string($input, $min='', $max='')
{
  if($input != sanitize_system_string($input, $min, $max, TRUE))
    return FALSE;
  return TRUE;
}

// glue together all the other functions
function check($input, $flags, $min='', $max='')
{
  $oldput = $input;
  if($flags & UTF8) $input = my_utf8_decode($input);
  if($flags & PARANOID) $input = sanitize_paranoid_string($input, $min, $max);
  if($flags & INT) $input = sanitize_int($input, $min, $max);
  if($flags & FLOAT) $input = sanitize_float($input, $min, $max);
  if($flags & HTML) $input = sanitize_html_string($input, $min, $max);
  if($flags & SQL) $input = sanitize_sql_string($input, $min, $max);
  if($flags & LDAP) $input = sanitize_ldap_string($input, $min, $max);
  if($flags & SYSTEM) $input = sanitize_system_string($input, $min, $max, TRUE);
  if($input != $oldput)
    return FALSE;
  return TRUE;
}
?>


