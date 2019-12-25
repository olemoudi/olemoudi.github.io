<?php

$output = '';
$lat = 0;
$lng = 0;
$place_id = 0;
$desc = $WHERE_MAPBUBBLE;
$script="";
	             
if (isset($_GET['lat']) && isset($_GET['lng'])) {
		

	$lat = $_GET['lat'];
	$lng = $_GET['lng'];
	if (isset($_GET['desc']) && strlen($_GET['desc']) < 100) {
		$desc = "<center><h3>".sanitize_html_string($_GET['desc'])."</h3></center>";
	}
	
} elseif (isset($_GET['nick'])) {
	
	// connect to db
	//include($DB_CONFIG);
	//include('core/db_mysql.php');
	$db = new db_mysql($db_username, $db_password, $db_database, $db_host);
	$db->connect();
	
	$place = $db->getPlaceByNick($_GET['nick']);
	
	if ($place) {
		
		$lat = $place['lat'];
		$lng = $place['lng'];
		$place_id = $place['id'];
		$desc = "<center><h3>".$place['desc'] . "</h3><h4>(".$_GET['nick'].")"."</h4><br/><h4>".$place['hits']." ".$TOTAL_SEARCHES."</h4></center>";
		$script =  "<script>document.getElementsByName('description')[0].setAttribute('content', '".$place['desc']."');</script>" ;
		
	}
	
	
}

$lat = htmlspecialchars($lat, ENT_QUOTES);
$lng = htmlspecialchars($lng, ENT_QUOTES);
$place_id = htmlentities($place_id, ENT_QUOTES);
$desc = htmlentities($desc, ENT_QUOTES);

?>
	
<input class="seeshyinput" type="hidden" id="map_lat" name="lat" value="<?=$lat?>" />
<input class="seeshyinput" type="hidden" id="map_lng" name="lng" value="<?=$lng?>" />
<input type="hidden" id="place_id" name="place_id" value="<?=$place_id?>" />
<input type="hidden" id="place_desc" name="place_desc" value="<?=$desc?>" />
<?=$script?>


