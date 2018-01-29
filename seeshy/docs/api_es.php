<?php
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Content-Language" content="es" />
<meta name="keywords" content="seeshy, api" />
<meta name="language" content="spanish español castellano" />
<meta name="description" content="seeshy API oficial" lang="es">
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

<p>Aunque seeshy a&uacute;n no soporta una API completa, es posible redirigir una b&uacute;squeda autom&aacute;ticamente a un lugar concreto utilizando los siguientes par&aacute;metros:</p>

<ul>
<li>lat: la latitud del lugar</li>
<li>lng: la longitud del lugar</li>
<li>desc (opcional): un nombre para el lugar</li>
</ul>

<p>La URL tendr&aacute; la siguiente pinta:</p>

http://seeshy.com/buscar?lat=xxxxxxx&lng=yyyyyyyyy&desc=Un%20nombre

<p>Por ejemplo:</p>

<a href="http://seeshy.com/buscar?lat=40.7587938364554&lng=-73.9853990077972&desc=Times%20Square%20NYC">http://seeshy.com/buscar?lat=40.7587938364554&lng=-73.9853990077972&desc=Times%20Square%20NYC</a>

<p>Puedes usar la <a href="http://code.google.com/intl/es-ES/apis/maps/">API de Google Maps</a> para extraer las coordenadas de cada lugar.</p>


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
