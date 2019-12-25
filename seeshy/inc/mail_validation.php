<html xmlns="http://www.w3.org/1999/xhtml">
<body>

  	<style type="text/css">
    	html,body { padding:0; margin:0; }
    	body { margin:40px 1em 1em 40px; }
    	body,html,p,div { font-family:"lucida grande",tahoma,arial,sans-serif; }
    	img { border:none; }
    	h1,h2,h3 { font-family:helvetica,arial,sans-serif; }
    	#logo {  margin-bottom: 50px;}
		#footer { color:#999; margin-top: 25px; }
		#footer a:link { color:#999; }
		#footer a:hover { color:#249; }
		#footer hr { margin-bottom: 5px; }
  	</style>

<div id="logo"><a href="/"><img src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/img/<?php echo $LOGO_FILE ;?>" alt="seeshy logo" /></a></div>
<div id="content">
<?php echo $VALIDATION_EMAIL_INTROTEXT; ?>
<p>Has recibido esta notificación de <a href="http://www.seeshy.com">seeshy.com</a> porque tú o alguna otra persona ha solicitado realizar una búsqueda utilizando este email como método de contacto. Para que la solicitud de búsqueda sea correctamente validada, necesitamos confirmar tu email.</p>

<p>Para ello, simplemente necesitamos que pulses en el siguiente enlace:</p>

<h3>
<a href="http://www.seeshy.com/validate.php?token=firuierowieorioeifsdkfjdsklfjdslkfjdsf" target="_blank">http://www.seeshy.com/validate.php?token=firuierowieorioeifsdkfjdsklfjdslkfjdsf</a>
</h3>

Si tu dirección no es validada en las próximas <strong>48 horas</strong>, procederemos a dar de baja tu solicitud de búsqueda.


</div>
<div id="footer">
<hr />
      <small class="light">
      <a href="mailto:contact@seeshy.com">contact@seeshy.com</a> | <?php echo $FOLLOW_US; ?> <strong><a href="http://www.twitter.com/seeshy">Twitter</a></strong> | Copyright 2009 seeshy.com 

      </small>
      
</div>




</body>
</html>