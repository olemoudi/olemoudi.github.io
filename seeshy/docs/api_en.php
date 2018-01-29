<?php
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Content-Language" content="en" />
<meta name="keywords" content="seeshy, api" />
<meta name="language" content="english" />
<meta name="description" content="seeshy official api" lang="en">
<title>seeshy.com - API</title>
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
<a href="/"><img src="http://seeshy.com/img/logo.png" alt="seeshy logo" /></a></div>
<div id="content">

<h1>seeshy.com API</h1>

<p>Although a full API is not available yet, it is possible to automatically redirect searches to a particular place without creating custom links using the following parameters:</p>

<ul>
<li>lat: the latitude of the place</li>
<li>lng: the longitude of the place</li>
<li>desc (optional): a display name for the place</li>
</ul>

<p>The actual URL will look like:</p>

http://seeshy.com/search?lat=xxxxxxx&lng=yyyyyyyyy&desc=Some%20Title

<p>For Example:</p>

<a href="http://seeshy.com/search?lat=40.7587938364554&lng=-73.9853990077972&desc=Times%20Square%20NYC">http://seeshy.com/search?lat=40.7587938364554&lng=-73.9853990077972&desc=Times%20Square%20NYC</a>

<p>You can use <a href="http://code.google.com/intl/en-EN/apis/maps/">Google Maps API</a> to retrieve coordinates for each place</p>


</div>
<hr />
<?php include('inc/footer.php'); ?>
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
</body>
</html>

<?php ob_end_flush(); ?>
