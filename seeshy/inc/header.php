<div id="stats">
<div class="column">
<script type="text/javascript"><!--
google_ad_client = "pub-6661252404042718";
google_ad_slot = "2491761281";
google_ad_width = 234;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
	<div class="column" id="numbers">
	    <ul>
	    <?php
			// connect to db
			include($DB_CONFIG);
			include('core/db_mysql.php');
			$db = new db_mysql($db_username, $db_password, $db_database, $db_host);
			$db->connect();
	    ?>
        	<li><a href="http://<?=$EN_DOMAIN?>/?hl=en"><img src="/img/usa.png" alt="usa flag" /></a></li>
		    <li><span class="number"><?php echo number_format($db->getSearchesTotal(), 0, ',', '.'); ?></span></li>
			<li><span class="number"><?php echo number_format($db->getSearchesActive(), 0, ',', '.');?></span></li>
		    <li><span class="number"><?php echo number_format($db->getSearchesSuccess(), 0, ',', '.');?></span></li>
            
           <?php mysql_close($db->getConn()); ?>
            
	    </ul>
    </div>
    <div class="column" id="units">
        <ul>
        	<li><a href="http://<?=$ES_DOMAIN?>/?hl=es"><img src="/img/spain.png" alt="spain flag" /></a></li>
		    <li><span class="units"><?php echo $TOTAL_SEARCHES ;?></span></li>
			<li><span class="units"><?php echo $ACTIVE_SEARCHES ;?></span></li>
		    <li><span class="units"><?php echo $SUCCESSFUL_SEARCHES ;?></span></li>
            
	    </ul>
    </div>
</div> 
<div id="header">
  	<div id="logo">
    <a href="/"><img src="/img/<?php echo $LOGO_FILE ;?>" alt="seeshy logo" /></a>
    </div>
</div>
