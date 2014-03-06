<?php
  session_start();
  error_reporting(0);

  htmlspecialchars($input);
  htmlentities($input);
  addslashes($input);

  require_once ('config.php');

  /* Prise en compte des variables */
  $session_id = mysql_real_escape_string($_SESSION['id']);
  $session_username = mysql_real_escape_string(htmlentities($_SESSION['username']));
  $ip = getenv("REMOTE_ADDR");

  // on doit determiner de quel type est le visiteur
  // 0 - invité
  // 1 - user
  // 2 - organisateur
  // 3 - admin
  $type_account=$_SESSION['type'];
  $admin=$_SESSION['admin'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta name="google-site-verification" content="XXX" />
    <meta name="description" content="projet gl">
    <meta name="keywords" content="gl-tag">
    <meta name="robots" content="index">
    <meta name="REVISIT-AFTER" content="always">
    <meta http-equiv="Content-Language" content="fr">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>PRT - GL</title>
    <link rel="icon" type="image/ico" href="./images/ico_prt.png" />
    <script type="text/javascript" src="js/swfobject/swfobject.js"></script> 
    <link href="style.css"	title="Défaut" rel="stylesheet" type="text/css" media="screen" />
	
	<script type="text/javascript" src="js/jquery-1.x.js"></script>
	<script type="text/javascript" src="js/jscroller-0.4.js"></script>
	
	
  </head>
  <body>
    <div align="center">
	
	<div class='sep'></div>
	
		<div style="width:1024px; background-color:white;">
	 
			<div id="banner" style="width:100%;height:300px;position:relative;z-index:2;">
			  <img src="./images/header_prt2.png" width="100%" height="100%"/>
			</div>

		<div style="width:90%;height:2px;background-color:#004A75;margin-top:10px;margin-bottom:10px;"></div>
		
			<?php
			switch($admin) {
			  case 1:
				include('./pages/site_admin.php');
			  break;
			  default:
				include('./pages/site.php');
			  break;
			}
			?>
			
		</div>
	
	</div>
  </body>
</html>