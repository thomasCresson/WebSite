<?php
	require_once("../config.php");
	$db = mysql_select_db ($array_db['db_projet'],$cxn);
	
	$tel = $_GET["tel"];
	
	$query = "select tel, nom, prenom, villeevent, villeorigine, nbkm from users where tel='".$tel."'";
	$result = mysql_query($query);
	
	$return = format_return($result);
	
	echo $return;
	
	mysql_close($cxn);
?>