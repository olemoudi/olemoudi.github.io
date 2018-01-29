<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$MATCH_PAGE_TITLE_NO?></title>
  	<style type="text/css">
    	html,body { padding:0; margin:0; }
    	body { padding:0; margin:30px 1em 1em 30px; font-family:"lucida grande",tahoma,arial,sans-serif; }
    	body,html,p,div { font-family:"lucida grande",tahoma,arial,sans-serif; }
    	img { border:none; }
		h1,h2,h3,h4 { font-family:helvetica,arial,sans-serif; }
    	#logo {  margin-bottom: 50px;}
		#footer { color:#999; margin-top: 25px; }
		#footer a:link { color:#999; }
		#footer a:hover { color:#249; }
		#footer hr { margin-bottom: 5px; }
  	</style>


<body>

<div id="logo">
<a href="/"><img src="http://<?=$DOMAIN?>/img/<?=$LOGO_FILE?>" alt="seeshy logo" /></a>
</div>
<div id="content">
<?=$MATCH_NO_INTROTEXT_HTML?>

<a href="http://<?=$DOMAIN?>/<?=$MATCH_URL?><?=$boysuffix?>=<?=$token?>">http://<?=$DOMAIN?>/<?=$MATCH_URL?><?=$boysuffix?>=<?=$token?></a>

</div>
<hr />
<?php include('footer.php'); ?>
</body>
</html>