<?php
ob_start();
include_once('core/constants.php');
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?=$META_DESC?>" lang="<?=$LANGUAGE?>">
<meta name="Content-Language" content="<?=$META_CONTENT?>" />
<meta name="keywords" content="seeshy" />
<meta name="language" content="<?=$META_LANGUAGE?>" />
<title><?php echo $INFO_TITLE;?></title>
<link rel="image_src" href="http://seeshy.com/img/logo.png" /> 
<link rel="shortcut icon" href="http://seeshy.com/favicon.ico">
<link href="/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">

<?php include('inc/header.php'); ?>
 
  <div id="navbar">
  	<ul>
    <li><a href="/"><?php echo $NAV_HOME ;?></a></li>
    <li><a href="/<?=$SEARCH_LINK?>"><?php echo $NAV_SEARCH ;?></a></li>
	<li><a href="/hotspots"><?php echo "Hotspots" ;?></a></li>
     <li><a href="/info"  class="selected"><?php echo $NAV_FAQ ;?></a></li>
    </ul>
  </div>
  
  
  <div id="content">
	<div id="faqwrapper">
    <div class="faqpart">
    <h3 class="center"><em><?=$FAQ_INTRO_QUESTION?></em></h3>
        <h4 class="center"><?=$FAQ_INTRO_SUBQUESTION1?></h4>
        <h4 class="center"><?=$FAQ_INTRO_SUBQUESTION2?></h4>
        <h4 class="center"><?=$FAQ_INTRO_SUBQUESTION3?></h4>
        <img style="float:left; padding: 5px; padding-right: 20px;" src="/img/prompt.png" alt="icon doubt" /><?=$FAQ_INTRO_ANSWER_P1?><img style="float:right; padding: 15px;" src="/img/happy.png" alt"happy couple" /><?=$FAQ_INTRO_ANSWER_P2?><br />
    <h3 class="center"><em><?=$FAQ_INTRO_QUESTION_MOAR?></em></h3>
    <?=$FAQ_INTRO_MOAR_TEXT?><center><a class="email" href=""></a></center> 	
    <?php
	 $list = "<ul id=\"faqlist\">";
	 $content = "";
	 $i = 1;
	 foreach ($FAQS as $FAQ) {
		 $list .= "<li><a href=\"#".$i."\">".$FAQ[0]."</a></li>";
		 $content .= "<div id=\"".$i."\" class=\"faqpart\">";
		 $content .= "<h3 class=\"center\"><em>".$FAQ[0]."</em></h3>";
		 $content .= $FAQ[1];
		 $content .= "</div>";
		 $i++;
	 }
	 $list .="</ul></div>";
	 echo $list;
	 echo $content;
	 ?>    

    </div>
    </div>
      <?php include('inc/footer.php'); ?>
      </div></div>

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
