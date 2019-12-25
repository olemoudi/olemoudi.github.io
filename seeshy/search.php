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
<meta name="description" content="<?=$META_DESC?>" lang="<?=$LANGUAGE?>">

<title><?php echo $SEARCH_TITLE;?></title>
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
    <li><a href="/<?=$SEARCH_LINK?>" class="selected"><?php echo $NAV_SEARCH ;?></a></li>
     <li><a href="/hotspots"><?php echo "Hotspots" ;?></a></li>
	 <li><a href="/info"><?php echo $NAV_FAQ ;?></a></li>
    </ul>
  </div>
  
  <div id="content">
  <img id="peek_left" src="/img/peek_left.png" alt="seeshy peeker" />
  <img id="peek_right" src="/img/peek_right.png" alt="seeshy peeker" />
   <?php if (!onMaintenance()) : ?>
   <?php if ($MAINTENANCE) {echo "<h1><blink>MANTENIMIENTO ACTIVADO</blink></h1>";} ?>
  <div id="formwrapper">
    <div class="formpart start" id="where">    
    <a name="where"></a> 
    	<h3>1. <em><?php echo $WHERE_STEPTITLE ;?></em></h3>
        <div class="part" id="map">
        <h4><?php echo $WHERE_LOCQUESTION ;?></h4> <span title="<?php echo $WHERE_LOCHELP ;?>
         " class="help"><img class="helpimg" src="/img/help.png" alt="help icon" /><?php //echo $HELP_LINK ;?>      </span>
        <div id="map_canvas"></div>
        <div id="searchcontrol"></div>


        <div id="map_search">
            <input type="text" value="<?php echo $WHERE_MAPINPUT ;?>" id="search_text" onclick="prepareInput();" onkeypress="onEnter(event)">             
            <a href="#where" class="big button" onclick="goToAddress()"
                id="search_button"><?php echo $WHERE_MAPBUTTON ;?></a>         
               
        </div>        
        </div>
		<div id="place_button_container">
		      <a class="bigger button" href="#when" onclick="placeReady();"
            id="place_button"><?php echo $WHERE_THISISIT;?></a>
			</div>
    </div> 
            <form action="/clerk.php" method="post" id="form">
			<?php include('inc/auto_search.php'); ?>
    <div class="formpart hidden" id="when">  
    <a name="when"></a>  
    	<h3>2. <em><?php echo $WHEN_STEPTITLE ;?></em></h3>
        
        <div class="part" id="dow">
        <h4><?php echo $WHEN_DOW_QUESTION ;?></h4> 
        <span title="<?php echo $WHEN_DOW_HELP ;?>" class="help"><img class="helpimg" src="/img/help.png" alt="help icon" /><?php //echo $HELP_LINK ;?>      </span>
        <ul>
        <li><a href="#when" id="1" onclick="selectDow(this);"><?php echo $WHEN_DOW_MONDAY ;?></a></li>
        <li><a href="#when" id="2" onclick="selectDow(this);"><?php echo $WHEN_DOW_TUESDAY ;?></a></li>
        <li><a href="#when" id="3" onclick="selectDow(this);"><?php echo $WHEN_DOW_WEDNESDAY ;?></a></li>
        <li><a href="#when" id="4" onclick="selectDow(this);"><?php echo $WHEN_DOW_THURSDAY ;?></a></li>
        <li><a href="#when" id="5" onclick="selectDow(this);"><?php echo $WHEN_DOW_FRIDAY ;?></a></li>
        <li><a href="#when" id="6" onclick="selectDow(this);"><?php echo $WHEN_DOW_SATURDAY ;?></a></li>
        <li><a href="#when" id="7" onclick="selectDow(this);"><?php echo $WHEN_DOW_SUNDAY ;?></a></li>
        </ul>
        <input class="seeshyinput" type="hidden" name="dow" id="dow_input" value="0" />
        </div>        
        
        <div class="part" id="time">
          <a name="time"></a>
        <h4><?php echo $WHEN_TIME_QUESTION ;?></h4> <span title="<?php echo $WHEN_TIME_HELP ;?>" class="help"><img class="helpimg" src="/img/help.png" alt="help icon" /><?php //echo $HELP_LINK ;?>      </span>
        <ul>
        <li><a href="#when" id="1" onclick="selectOption(this,'time');"><?php echo $WHEN_TIME_6AM9AM ;?></a></li>
        <li><a href="#when" id="2" onclick="selectOption(this,'time');"><?php echo $WHEN_TIME_10AM1PM ;?></a></li>
        <li><a href="#when" id="3" onclick="selectOption(this,'time');"><?php echo $WHEN_TIME_2PM5PM ;?></a></li>
        <li><a href="#when" id="4" onclick="selectOption(this,'time');"><?php echo $WHEN_TIME_6PM9PM ;?></a></li>
        <li><a href="#when" id="5" onclick="selectOption(this,'time');"><?php echo $WHEN_TIME_10PM1AM ;?></a></li>
        <li><a href="#when" id="6" onclick="selectOption(this,'time');"><?php echo $WHEN_TIME_2AM5AM  ;?></a></li>
        </ul>
        <input class="seeshyinput" type="hidden" name="time" id="time_input" value="0" />
        </div>
                   
        <div class="part" id="periodic">
        <a name="periodic"></a> 
        <h4><?php echo $WHEN_PERIODIC_QUESTION ;?></h4> <span title="<?php echo $WHEN_PERIODIC_HELP ;?>" class="help"><img class="helpimg" src="/img/help.png" alt="help icon" /><?php //echo $HELP_LINK ;?>      </span>
        <ul>
        <li><a href="#periodic" id="1" onclick="selectOption(this,'periodic');"><?php echo $WHEN_PERIODIC_YES ;?></a></li>
        <li><a href="#periodic" id="2" onclick="selectOption(this,'periodic');"><?php echo $WHEN_PERIODIC_NO ;?></a></li>
        </ul>
        <input class="seeshyinput" type="hidden" name="periodic" id="periodic_input" value="0" />
        </div>        
           	
    </div>
    <div class="formpart hidden" id="who">
    <a name="who"></a> 
    	<h3>3. <em><?php echo $PERSON_STEPTITLE ;?></em></h3>
        
        
        <div class="part" id="tsex">
        <a name="tsex"></a> 
        <h4><?php echo $PERSON_SEX_QUESTION ;?></h4> <span title="<?php echo $PERSON_SEX_HELP ;?>" class="help"><img class="helpimg" src="/img/help.png" alt="help icon" /><?php //echo $HELP_LINK ;?>      </span>
        <ul>
        <li><a href="#who" id="1" onclick="selectOption(this,'tsex');"><?php echo $PERSON_SEX_MAN ;?></a></li>
        <li><a href="#who" id="2" onclick="selectOption(this,'tsex');"><?php echo $PERSON_SEX_WOMAN ;?></a></li>
        </ul>
        <input class="seeshyinput" type="hidden" name="tsex" id="tsex_input" value="0" />        
        </div>

        <div class="part" id="tage">
        <a name="tage"></a> 
        <h4><?php echo $PERSON_AGE_QUESTION ;?></h4> <span title="<?php echo $PERSON_AGE_HELP ;?>" class="help"><img class="helpimg" src="/img/help.png" alt="help icon" /><?php //echo $HELP_LINK ;?>      </span>
        <ul>
        <li><a href="#who" id="1" onclick="selectOption(this,'tage');"><?php echo $PERSON_AGE_1619 ;?></a></li>
        <li><a href="#who" id="2" onclick="selectOption(this,'tage');"><?php echo $PERSON_AGE_2024 ;?></a></li>
        <li><a href="#who" id="3" onclick="selectOption(this,'tage');"><?php echo $PERSON_AGE_2529 ;?></a></li>
        <li><a href="#who" id="4" onclick="selectOption(this,'tage');"><?php echo $PERSON_AGE_3035 ;?></a></li>
        <li><a href="#who" id="5" onclick="selectOption(this,'tage');"><?php echo $PERSON_AGE_3640 ;?></a></li>
        <li><a href="#who" id="6" onclick="selectOption(this,'tage');"><?php echo $PERSON_AGE_4150 ;?></a></li>
        <li><a href="#who" id="7" onclick="selectOption(this,'tage');"><?php echo $PERSON_AGE_MORE50 ;?></a></li>
        </ul>
        <input class="seeshyinput" type="hidden" name="tage" id="tage_input" value="0" />
        </div> 
        
        <div class="part" id="thair">
        <a name="thair"></a> 
        <h4><?php echo $PERSON_HAIR_QUESTION ;?></h4> <span title="<?php echo $PERSON_HAIR_HELP ;?>" class="help"><img class="helpimg" src="/img/help.png" alt="help icon" /><?php //echo $HELP_LINK ;?>      </span>
        <ul>
        <li><a href="#tage" id="1" onclick="selectOption(this,'thair');"><?php echo $PERSON_HAIR_BALD ;?></a></li>
        <li><a href="#tage" id="2" onclick="selectOption(this,'thair');"><?php echo $PERSON_HAIR_GREY ;?></a></li>
        <li><a href="#tage" id="3" onclick="selectOption(this,'thair');"><?php echo $PERSON_HAIR_BLOND ;?></a></li>        
        <li><a href="#tage" id="4" onclick="selectOption(this,'thair');"><?php echo $PERSON_HAIR_DARK ;?></a></li>
        <li><a href="#tage" id="5" onclick="selectOption(this,'thair');"><?php echo $PERSON_HAIR_RED ;?></a></li>
        <li><br /><br /><a href="#who" id="6" onclick="selectOption(this,'thair');"><?php echo $PERSON_HAIR_OTHER ;?></a></li>        
        </ul>
        <input class="seeshyinput" type="hidden" name="thair" id="thair_input" value="0" />
        </div>

        <div class="part" id="theight">
        <a name="theight"></a> 
        <h4><?php echo $PERSON_HEIGHT_QUESTION ;?>.</h4> <span title="<?php echo $PERSON_HEIGHT_HELP ;?>" class="help"><img class="helpimg" src="/img/help.png" alt="help icon" /><?php //echo $HELP_LINK ;?>      </span>
        <ul>
        <li><a href="#theight" id="1" onclick="selectOption(this,'theight');"><?php echo $PERSON_HEIGHT_SHORT ;?></a></li>
        <li><a href="#theight" id="2" onclick="selectOption(this,'theight');"><?php echo $PERSON_HEIGHT_BELOWAVG ;?></a></li>
        <li><a href="#theight" id="3" onclick="selectOption(this,'theight');"><?php echo $PERSON_HEIGHT_AVG ;?></a></li>        
        <li><a href="#theight" id="4" onclick="selectOption(this,'theight');"><?php echo $PERSON_HEIGHT_ABOVEAVG ;?></a></li>
        <li><a href="#theight" id="5" onclick="selectOption(this,'theight');"><?php echo $PERSON_HEIGHT_TALL ;?></a></li>
        </ul>
        <input class="seeshyinput" type="hidden" name="theight" id="theight_input" value="0" />
        </div>
        
           
                           
    </div>
    <div class="formpart hidden" id="you">
    <a name="you"></a> 
    	<h3>4. <em><?php echo $YOU_STEPTITLE ;?></em></h3>

        <div class="part" id="ssex">
        <h4><?php echo $YOU_SEX_QUESTION ;?></h4> <span title="<?php echo $YOU_SEX_HELP ;?>" class="help"><img class="helpimg" src="/img/help.png" alt="help icon" /><?php //echo $HELP_LINK ;?>      </span>
        <ul>
        <li><a href="#you" id="1" onclick="selectOption(this,'ssex');"><?php echo $PERSON_SEX_MAN ;?></a></li>
        <li><a href="#you" id="2" onclick="selectOption(this,'ssex');"><?php echo $PERSON_SEX_WOMAN ;?></a></li>
        </ul>
        <input class="seeshyinput" type="hidden" name="ssex" id="ssex_input" value="0" />
        </div>

        <div class="part" id="sage">
         <a name="sage"></a> 
        <h4><?php echo $YOU_AGE_QUESTION ;?></h4> <span title="<?php echo $YOU_AGE_HELP ;?>" class="help"><img class="helpimg" src="/img/help.png" alt="help icon" /><?php //echo $HELP_LINK ;?>      </span>
        <ul>
        <li><a href="#you" id="1" onclick="selectOption(this,'sage');"><?php echo $PERSON_AGE_1619 ;?></a></li>
        <li><a href="#you" id="2" onclick="selectOption(this,'sage');"><?php echo $PERSON_AGE_2024 ;?></a></li>
        <li><a href="#you" id="3" onclick="selectOption(this,'sage');"><?php echo $PERSON_AGE_2529 ;?></a></li>
        <li><a href="#you" id="4" onclick="selectOption(this,'sage');"><?php echo $PERSON_AGE_3035 ;?></a></li>
        <li><a href="#you" id="5" onclick="selectOption(this,'sage');"><?php echo $PERSON_AGE_3640 ;?></a></li>
        <li><a href="#you" id="6" onclick="selectOption(this,'sage');"><?php echo $PERSON_AGE_4150 ;?></a></li>
        <li><a href="#you" id="7" onclick="selectOption(this,'sage');"><?php echo $PERSON_AGE_MORE50 ;?></a></li>
        </ul>
        <input class="seeshyinput" type="hidden" name="sage" id="sage_input" value="0" />
        </div> 
        
        <div class="part" id="shair">
        <a name="shair"></a> 
        <h4><?php echo $YOU_HAIR_QUESTION ;?></h4> <span title="<?php echo $YOU_HAIR_HELP ;?>" class="help"><img class="helpimg" src="/img/help.png" alt="help icon" /><?php //echo $HELP_LINK ;?>      </span>
        <ul>
        <li><a href="#sage" id="1" onclick="selectOption(this,'shair');"><?php echo $PERSON_HAIR_BALD ;?></a></li>
        <li><a href="#sage" id="2" onclick="selectOption(this,'shair');"><?php echo $PERSON_HAIR_GREY ;?></a></li>
        <li><a href="#sage" id="3" onclick="selectOption(this,'shair');"><?php echo $PERSON_HAIR_BLOND ;?></a></li>        
        <li><a href="#sage" id="4" onclick="selectOption(this,'shair');"><?php echo $PERSON_HAIR_DARK ;?></a></li>
        <li><a href="#sage" id="5" onclick="selectOption(this,'shair');"><?php echo $PERSON_HAIR_RED ;?></a></li>
        <li><br /><br /><a href="#you" id="6" onclick="selectOption(this,'shair');"><?php echo $PERSON_HAIR_OTHER ;?></a></li> 
        </ul>
        <input  class="seeshyinput" type="hidden" name="shair" id="shair_input" value="0" />
        </div>

        <div class="part" id="sheight">
        <a name="sheight"></a> 
        <h4><?php echo $YOU_HEIGHT_QUESTION ;?></h4> <span title="<?php echo $YOU_HEIGHT_HELP ;?>" class="help"><img class="helpimg" src="/img/help.png" alt="help icon" /><?php //echo $HELP_LINK ;?>      </span>
        <ul>
        <li><a href="#sheight" id="1" onclick="selectOption(this,'sheight');"><?php echo $PERSON_HEIGHT_SHORT ;?></a></li>
        <li><a href="#sheight" id="2" onclick="selectOption(this,'sheight');"><?php echo $PERSON_HEIGHT_BELOWAVG ;?></a></li>
        <li><a href="#sheight" id="3" onclick="selectOption(this,'sheight');"><?php echo $PERSON_HEIGHT_AVG ;?></a></li>        
        <li><a href="#sheight" id="4" onclick="selectOption(this,'sheight');"><?php echo $PERSON_HEIGHT_ABOVEAVG ;?></a></li>
        <li><a href="#sheight" id="5" onclick="selectOption(this,'sheight');"><?php echo $PERSON_HEIGHT_TALL ;?></a></li>
        </ul>
        <input class="seeshyinput" type="hidden" name="sheight" id="sheight_input" value="0" />
        </div>
                
    </div>
    <div class="formpart hidden last" id="contact">
    <a name="contact"></a> 
    	<h3>5. <em><?php echo $CONTACT_STEPTITLE ;?></em></h3>
        
        <div id="talk" class="part">
<h4><?php echo $CONTACT_TALK_QUESTION ;?></h4> <span title="<?php echo $CONTACT_TALK_HELP ;?>" class="help"><img class="helpimg" src="/img/help.png" alt="help icon" /><?php //echo $HELP_LINK ;?></span>        
        <ul>
        <li><a href="#tmsg" id="2" onclick="selectOption(this,'talk');"><?php echo $CONTACT_TALK_YES ;?></a></li>
        <li><a href="#tmsg" id="1" onclick="selectOption(this,'talk');"><?php echo $CONTACT_TALK_NO ;?></a></li>
        <input class="seeshyinput" type="hidden" name="talk" id="talk_input" value="0" />
        </ul>
        </div>

        <div class="part" id="tmsg">
        <h4><?php echo $CONTACT_MSG_QUESTION ;?></h4> <span title="<?php echo $CONTACT_MSG_HELP ;?>" class="help"><img class="helpimg" src="/img/help.png" alt="help icon" /><?php //echo $HELP_LINK ;?>      </span>
        <ul>
        <li><textarea id="tmsg_input" name="tmsg" onclick="clearTAOnce(this);"><?php echo $CONTACT_MSG_INPUT ;?></textarea><div id="charlimitinfo"></div></li>
        </ul>
		
        </div>

        <div class="part" id="email">
        <h4><?php echo $CONTACT_EMAIL_QUESTION ;?></h4> <span title="<?php echo $CONTACT_EMAIL_HELP ;?>" class="help"><img class="helpimg" src="/img/help.png" alt="help icon" /><?php //echo $HELP_LINK ;?>      </span>
        <ul>
        <li><input class="seeshyinput" type="text" value="<?php echo $CONTACT_EMAIL_INPUT ;?>" name="email" id="email_input" onclick="clearEmailOnce(this)"></li>
        </ul>
        </div>     
        <div class="part" id="agree">
<h4><?php echo $CONTACT_TERMS_QUESTION ;?></h4> <a href="/docs/<?php echo $CONTACT_TERMS_LINK ;?>" target="_blank" class="help" style="cursor: pointer;" alt="<?=$CONTACT_TERMS_ALT?>"><?php echo $CONTACT_TERMS_MSG ;?></a>       
        <ul>
        <li><a href="#agree" id="1" onclick="selectOption(this,'agree');"><?php echo $CONTACT_TERMS_YES ;?></a></li>
        <li><a href="#agree" id="0" onclick="selectOption(this,'agree');"><?php echo $CONTACT_TERMS_NO ;?></a></li>
        <input class="seeshyinput" type="hidden" name="agree" id="agree_input" value="0" />
        </ul>

        </div>              
        <div class="part" id="send">
            
            <a class="huge button" onclick="validateAndSend();"
            id="send_button"><?php echo $CONTACT_SUBMIT_READY ;?></a>            
        </div>
    </div>
    </form>  
    <div class="formpart hidden" id="social">
    <h4><?php echo $SHARE_SEARCH_MSG ;?></h4>
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
    <?php else : ?>
    <center><h2><?php echo $MAINTENANCE_MSG ;?> </h2></center>
    <?php endif; ?>          
  </div>

 <?php include('inc/footer.php'); ?></div>

<div id="error_msgs" class="hidden">
<a id="title" value="<?php echo $MISSING_TITLE ;?>" />
<a id="formwrapper" value="<?php echo $MISSING_FORMWRAPPER ;?>" />
<a id="when" value="<?php echo $MISSING_WHEN ;?>" />
<a id="who" value="<?php echo $MISSING_WHO ;?>" />
<a id="you" value="<?php echo $MISSING_YOU ;?>" />
<a id="talk" value="<?php echo $MISSING_TALK ;?>" />
<a id="tmsg" value="<?php echo $MISSING_TMSG ;?>" />
<a id="email" value="<?php echo $MISSING_EMAIL ;?>" />
<a id="agree" value="<?php echo $MISSING_AGREE ;?>" />
<a id="mapinfo" value="<?php echo $WHERE_MAPBUBBLE ;?>" />
<a id="chars_remaining" value="<?php echo $CHARS_REMAINING ;?>" />
<a id="chars_limit" value="<?php echo $CHARS_LIMIT ;?>" />
<a id="chars_unit" value="<?php echo $CHARS_UNIT ;?>" />
<a id="chars_max" value="<?php echo $TMSG_MAXSIZE ;?>" />
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
