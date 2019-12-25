<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once('core/constants.php'); include_once('core/core.php'); ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$MATCH_PROMPT_TITLE?></title>
<style type="text/css">
	html,body { padding:0; margin:0; }
	body { padding:0; margin:30px 1em 1em 30px; font-family:"lucida grande",tahoma,arial,sans-serif; }
	body,html,p,div { font-family:"lucida grande",tahoma,arial,sans-serif; }
	img { border:none; }
	h1,h2,h3,h4 { font-family:helvetica,arial,sans-serif; }
	#logo {  margin-bottom: 50px;}
	#content { text-align: center; }
	#content img { margin-bottom: 25px; }
	#footer { color:#999; margin-top: 20px; }
	hr { margin-top: 25px;}
	#footer a:link { color:#999; }
	#footer a:hover { color:#249; }
	#footer hr { margin-bottom: 5px; }
	blockquote { font-size: 1.2em; margin: 1em 3em; color: #6FBCFF; padding: 30px; padding-left: 50px;
background: transparent url(img/quote.gif) no-repeat; text-align: left;}
	big { font-size: 1.2em; }
	a {
	outline: none;
	}

	.button {
		background: #222 url(../img/button-overlay.png) repeat-x;
		padding: 5px 10px 6px;
		color: #fff;
		text-decoration: none;
		font-weight: bold;
		line-height: 1;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
		text-shadow: 0 -1px 1px rgba(0, 0, 0, 0.25);
		border-bottom: 1px solid rgba(0, 0, 0, 0.25);
		cursor: pointer;	
	}
	
	.button:active {
		position: relative;
		top: 2px;
	}
	
	
	.big {
		font-size: 14px;
		margin: 10px;
		background-color: #68b7ff;
		padding-top: 15px;
		padding-right: 40px;
		padding-bottom: 15px;
		padding-left: 40px;	
	}
	
	.green {
		background-color: #97E077;
	}
	
	.red {
		background-color: #FF5B5B;
	}	
	
	.red:hover {
	background-color: #FF2020;
}

	.green:hover {
	background-color: #5ECC2F;
}
</style>



<body>

<div id="header">
  	<div id="logo">
    <a href="/"><img src="http://<?=$DOMAIN?>/img/<?=$LOGO_FILE?>" alt="seeshy logo" /></a>
    <!--<span id="see" class="seeshy">see</span><span id="shy" class="seeshy">shy</span> <span id="beta">Beta</span><br/>
    <span id="tagline">being shy made easy</span>-->
    </div>
</div>

<div id="content">
<?=$MATCH_PROMPT_INTROTEXT_HTML?>

<blockquote><?=utf8_decode($tmsg)?></blockquote>


<?=$MATCH_PROMPT_POSTTEXT_HTML?>
<img src="http://<?=$DOMAIN?>/img/prompt.png" alt="seeshy logo" /><br/>
<a class="big button red" href="http://<?=$DOMAIN?>/<?=$MATCH_URL?><?=$boysuffix?>=<?=$token?>&confirm=no"><?php echo $MATCH_NO ;?></a> 
<a class="big button green" href="http://<?=$DOMAIN?>/<?=$MATCH_URL?><?=$boysuffix?>=<?=$token?>&confirm=yes"><?php echo $MATCH_YES ;?></a>  

</div>
<hr />
<?php include('footer.php'); ?>
</body>
</html>