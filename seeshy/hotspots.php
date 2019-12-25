<?php
ob_start();
include_once('core/constants.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Content-Language" content="<?=$META_CONTENT?>" />
<meta name="language" content="<?=$META_LANGUAGE?>" />
<meta name="keywords" content="seeshy" />
<meta name="description" content="<?=$META_HS_DESC?>" lang="<?=$LANGUAGE?>">

<title><?php echo $ADDPLACE_TITLE;?></title>
<link href="/css/style.css" rel="stylesheet" type="text/css" />

<link rel="image_src" href="http://seeshy.com/img/logo.png" /> 
<link rel="shortcut icon" href="http://seeshy.com/favicon.ico">
</head>

<body>
<div id="wrapper">

<?php include('inc/header.php'); ?>

  <div id="navbar">
  	<ul>
    <li><a href="/"><?php echo $NAV_HOME ;?></a></li>
    <li><a href="/<?=$SEARCH_LINK?>"><?php echo $NAV_SEARCH ;?></a></li>
     <li><a href="/hotspots" class="selected"><?php echo "Hotspots" ;?></a></li>
	 <li><a href="/info"><?php echo $NAV_FAQ ;?></a></li>
    </ul>
  </div>
  
  <div id="content">
   <?php if (!onMaintenance()) : ?>
   <?php if ($MAINTENANCE) {echo "<h1><blink>MANTENIMIENTO ACTIVADO</blink></h1>";} ?>
  <div id="formwrapper">
    <div class="formpart start" id="hsintro">    
    <a name="hsintro"></a> 
    	<h3><em><?php echo $HS_WHATIS ;?></em></h3>
	<div class="explanation">	
	<p><?=$HS_EXPLAIN?></p>
	</div>
	
    	<h3><em><?php echo $HS_CLAIM ;?></em></h3>
		<center><span class="pretty_url">http://seeshy.com/<?=$SEARCH_LINK?>/<span class="nick"><?=$HS_SHORT_EXAMPLE?></span></span></center>
		<div class="explanation">
		<?=$HS_MORE?>
	</div>
	
        <div class="part" id="map">
        <h3>1. <em><?php echo $HS_LOCATE ;?></em></h3>
        <div id="map_canvas"></div>
        <div id="searchcontrol"></div>


        <div id="map_search">
            <input type="text" value="<?php echo $WHERE_MAPINPUT ;?>" id="search_text" onclick="prepareInput();" onkeypress="onEnter(event)">             
            <a href="#where" class="big button" onclick="goToAddress()"
                id="search_button"><?php echo $WHERE_MAPBUTTON ;?></a>         
               
        </div>        
        </div>
		<div id="place_button_container">
		      <a class="bigger button" href="#details" onclick="placeReady();"
            id="place_button"><?php echo $WHERE_THISISIT ;?></a>
			</div>
    </div> 
    <form action="/add_place.php" method="post" id="form">
			<?php include('inc/auto_search.php'); ?>
    <div class="formpart hidden" id="details">  
    <a name="details"></a>  
	

	<h3>2. <em><?php echo $HS_CREATE ;?></em></h3>

        
        <div class="part" id="nick">
        <h4><?php echo $HS_NICK_INS ;?></h4> 
        
		<ul>
		<li><span id="nick_url" class="pretty_url">http://seeshy.com/<?=$SEARCH_LINK?>/</span>&nbsp;<input type="text" class="seeshyinput" value="" name="nick" id="nick_text" maxlength="39" onclick="this.value = '';" onkeypress="javascript:void(0);"> <span><label for="nick"> <?=$HS_NICK_EXAMPLE?></label></span></li>
		</ul>
        </div> 
		
        <div class="part" id="desc">
        <h4><?php echo $HS_DESC_INS ;?></h4>         
		<ul>
		<li><input type="text" class="seeshyinput" value="" name="desc" id="desc_text" maxlength="70" onclick="this.value = '';" onkeypress="javascript:void(0);">  <span><label for="desc"><?=$HS_DESC_EXAMPLE?></label></span></li>
		</ul>
        </div>  
		
	        <div class="part" id="send">
            
            <a class="huge button" onclick="sendPlace();"
            id="send_button"><?php echo $CREATE_LINK ;?></a>            
        </div>
    
           	
    </div>


    </form>  
    <div class="formpart hidden" id="social">
	<h4><?php echo $HS_RESULT_LINK ;?></h4>
	<br/><br/>
	<center><span class="pretty_url"><a id="href_result_place" class="pretty_a" href="http://seeshy.com/<?=$SEARCH_LINK?>/#NICK#" title="hotspot" target="_blank">http://seeshy.com/<?=$SEARCH_LINK?>/<span id="link_result_place" class="nick">xxx</span></a></span></center>
	<br/>
	
    <h4><?php echo $SHARE_HS_MSG ;?></h4>
    <ul>
    <li><a title="Twitter" id="twitter" href="http://twitter.com/home?status=%23seeshy%20http%3A%2F%2Fseeshy.com%2F<?=$SEARCH_LINK?>%2F#NICK#" <?php echo $TWITTER_STATUS ;?>" target="_blank"><img alt="twitter icon" src="/img/twitter_icon.png" /></a></li>
    <li><a title="Facebook" id="facebook" href="http://www.facebook.com/share.php?u=http%3A%2F%2Fseeshy.com%2F<?=$SEARCH_LINK?>%2F#NICK#" target="_blank"><img alt="Facebook" src="/img/facebook_icon.png" /></a></li>
    <li><a title="StumbleUpon" id="stumbleupon" href="http://www.stumbleupon.com/submit?url=http%3A%2F%2Fseeshy.com%2F<?=$SEARCH_LINK?>%2F#NICK#&title=<?php echo $STUMBLE_TITLE ;?>"  target="_blank"><img alt="stumble upon" src="/img/stumble_icon.png" /></a></li>
    <li><a title="Reddit" id="reddit" href="http://reddit.com/submit?url=http%3A%2F%2Fseeshy.com%2F<?=$SEARCH_LINK?>%2F#NICK#&title=<?php echo $REDDIT_TITLE ;?>" target="_blank"><img alt="reddit" src="/img/reddit_icon.png" /></a></li>
    <li><a title="Digg" id="digg" href="http://digg.com/submit?url=http%3A%2F%2Fseeshy.com%2F<?=$SEARCH_LINK?>%2F#NICK#&title=<?php echo $DIGG_TITLE ;?>" target="_blank"><img alt="digg" src="/img/digg_icon.png" /></a></li>
    <li><a title="Delicious" id="delicious" href="http://delicious.com/save" onclick="window.open('http://delicious.com/save?v=5&noui&jump=close&url='+encodeURIComponent('http://seeshy.com/<?=$SEARCH_LINK?>/'+$('#link_result_place').html())+'&title='+encodeURIComponent('seeshy '+$('#desc_text').attr('value')), 'delicious','toolbar=no,width=550,height=550'); return false;"><img src="img/delicious_icon.png" /></a></li>
    <li><a title ="Meneame" id="meneame" href="http://meneame.net/login.php?return=/submit.php?url=http%3A%2F%2Fseeshy.com%2F<?=$SEARCH_LINK?>%2F/#NICK#" target="_blank"><img alt="meneame" src="/img/meneame_icon.png" /></a></li>       
    </ul>
    </div>     
    </div>
    <?php else : ?>
    <center><h2><?php echo $MAINTENANCE_MSG ;?> </h2></center>
    <?php endif; ?>          
  </div>

 <?php include('inc/footer.php'); ?></div>

<div id="error_msgs" class="hidden">
<a id="title" value="<?php echo $MISSING_TITLE_HS ;?>" />
<a id="mapinfo" value="<?php echo $WHERE_MAPBUBBLE ;?>" />
<a id="bad_nick" value="<?php echo $INVALID_NICK ;?>" />
<a id="bad_desc" value="<?php echo $INVALID_DESC ;?>" />
<a id="submit_working" value="<?php echo $CONTACT_SUBMIT_WORKING ;?>" />
<a id="submit_retry" value="<?php echo $CONTACT_SUBMIT_RETRY ;?>" />
<a id="submit_done" value="<?php echo $CONTACT_SUBMIT_DONE ;?>" />
</div>


<!-- key for seeshy.com -->

<script type="text/javascript"
        src="http://www.google.com/jsapi?key=ABQIAAAA85ylp1UewmZp3aYs10kd5hRe1WR8q2QNlMitlJUU65Bqe_wDTxSnpSANccHQmVLBmEq65oK-LXbJmQ"></script>

   
        
<script type="text/javascript">
  google.load("maps", "2");
  //google.load("search", "1");
</script>
	
	<script type="text/javascript" src="js/seeshy.complete.packed.js"></script>   
	

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-12395983-1");
pageTracker._setDomainName(".seeshy.com");
pageTracker._trackPageview();
} catch(err) {}</script>
	
	
<!-- Feedback -->

<script type="text/javascript" charset="utf-8">
  var is_ssl = ("https:" == document.location.protocol);
  var asset_host = is_ssl ? "https://s3.amazonaws.com/getsatisfaction.com/" : "http://s3.amazonaws.com/getsatisfaction.com/";
  document.write(unescape("%3Cscript src='" + asset_host + "javascripts/feedback-v2.js' type='text/javascript'%3E%3C/script%3E"));
</script>

<script type="text/javascript" charset="utf-8">
  var feedback_widget_options = {};

  feedback_widget_options.display = "overlay";  
  feedback_widget_options.company = "seeshy";
  feedback_widget_options.placement = "left";
  feedback_widget_options.color = "#0074DD";
  feedback_widget_options.style = "idea";

  var feedback_widget = new GSFN.feedback_widget(feedback_widget_options);
</script>	
	
	
</body>
</html>
<?php ob_end_flush(); ?>
