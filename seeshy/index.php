<?php
ob_start();
include_once('core/constants.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Content-Language" content="<?=$META_CONTENT?>" />
<meta name="keywords" content="seeshy" />
<meta name="language" content="<?=$META_LANGUAGE?>" />
<meta name="description" content="<?=$META_DESC?>" lang="<?=$LANGUAGE?>">
<title><?php echo $INDEX_TITLE;?></title>
<link rel="image_src" href="http://seeshy.com/img/logo.png" /> 
<link rel="shortcut icon" href="http://seeshy.com/favicon.ico">
<link href="/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">

<?php include('inc/header.php'); ?>
 
  <div id="navbar">
  	<ul>
    <li><a href="/" class="selected"><?php echo $NAV_HOME ;?></a></li>
    <li><a href="<?=$SEARCH_LINK?>" ><?php echo $NAV_SEARCH ;?></a></li>
     <li><a href="/hotspots"><?php echo "Hotspots" ;?></a></li>
	 <li><a href="/info"><?php echo $NAV_FAQ ;?></a></li>
    </ul>
  </div>
  
  
  <div id="content">
	<div id="formwrapper">
    <div class="formpart" id="intro">
	<div id="claim">
	<a title="<?=$LANGUAGE?>" href="#comic">
	<img src="/img/claim_<?=$LANGUAGE?>.png" alt="seeshy claim"/>
	</a>
	</div>
    <div id="comic">
	<a name="comic" />
    <img src="/img/comic.jpg" alt="seeshy comic"/>
    </div>
    <a class="bigger button green" href="info"><?php echo $MOREINFO_MSG ;?></a> 
    <a class="bigger button" href="<?=$SEARCH_LINK?>"><?php echo $SEARCHNOW_MSG ;?></a>  
    </div>
    <div class="formpart" id="social">
    <ul>
    <li><a title="Twitter" id="twitter" href="http://twitter.com/home?status=%23seeshy <?php echo $TWITTER_STATUS ;?>" target="_blank"><img alt="twitter icon" src="/img/twitter_icon.png" /></a></li>
    <li><a title="Facebook" href="http://www.facebook.com/share.php?u=http://seeshy.com" target="_blank"><img alt="Facebook" src="/img/facebook_icon.png" /></a></li>
    <li><a title="StumbleUpon" href="http://www.stumbleupon.com/submit?url=http://seeshy.com&title=<?php echo $STUMBLE_TITLE ;?>"  target="_blank"><img alt="stumble upon" src="/img/stumble_icon.png" /></a></li>
    <li><a title="Reddit" href="http://reddit.com/submit?url=http://seeshy.com&title=<?php echo $REDDIT_TITLE ;?>" target="_blank"><img alt="reddit" src="/img/reddit_icon.png" /></a></li>
    <li><a title="Digg" href="http://digg.com/submit?url=http%3A%2F%2Fseeshy.com&title=<?php echo $DIGG_TITLE ;?>" target="_blank"><img alt="digg" src="/img/digg_icon.png" /></a></li>
    <li><a title="Delicious" href="http://delicious.com/save" onclick="window.open('http://delicious.com/save?v=5&noui&jump=close&url='+encodeURIComponent(location.href)+'&title='+encodeURIComponent(document.title), 'delicious','toolbar=no,width=550,height=550'); return false;"><img src="/img/delicious_icon.png" /></a></li>
    <li><a title ="Meneame" href="http://meneame.net/login.php?return=/submit.php?url=http%3A%2F%2Fseeshy.com/" target="_blank"><img alt="meneame" src="/img/meneame_icon.png" /></a></li>       
    </ul>
    </div> 
  
    </div>
</div>
      <?php include('inc/footer.php'); ?>
</div>

<!-- key for seeshy.com -->
<script type="text/javascript"
        src="http://www.google.com/jsapi?key=ABQIAAAA85ylp1UewmZp3aYs10kd5hRe1WR8q2QNlMitlJUU65Bqe_wDTxSnpSANccHQmVLBmEq65oK-LXbJmQ"></script>
		<script type="text/javascript">
  google.load("maps", "2");
  //google.load("search", "1");
</script>

<script type="text/javascript" src="/js/seeshy.complete.packed.js"></script>

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
