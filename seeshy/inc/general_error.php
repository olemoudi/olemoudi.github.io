
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$VALIDATE_PAGE_TITLE?></title>
  	<style type="text/css">
    	html,body { padding:0; margin:0; }
    	body { padding:0; margin:30px 1em 1em 30px; font-family:"lucida grande",tahoma,arial,sans-serif; }
    	body,html,p,div { font-family:"lucida grande",tahoma,arial,sans-serif; }
    	img { border:none; }
		h1,h2,h3,h4 { font-family:helvetica,arial,sans-serif; }
    	#logo {  margin-bottom: 50px;}
		#footer { color:#999; margin-top: 10px; }
		#footer a:link { color:#999; }
		#footer a:hover { color:#249; }
		#footer hr { margin-bottom: 1px; margin-top:5px; }
  	</style>


<body>

<div id="logo">
<a href="/"><img src="http://<?=$DOMAIN?>/img/<?=$LOGO_FILE?>" alt="seeshy logo" /></a></div>
<div id="content">

<img src="http://<?=$DOMAIN?>/img/<?=$ERROR_FILE?>" alt="chill monkey" />

<?=$ERROR_PAGE_INTROTEXT_HTML?>

</div>
<hr />
<?php include('footer.php'); ?>
<!--
<div id="footer">

<small class="light">
<a href="mailto:contact@seeshy.com">contact@seeshy.com</a> | <?=$FOLLOW_US?>  <strong><a href="http://www.twitter.com/seeshy">Twitter</a></strong> | Copyright 2009-2010 seeshy.com </small>
</div>-->
</body>
</html>