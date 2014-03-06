<?php
	require_once("../config.php");
	$db = mysql_select_db ($array_db['db_projet'],$cxn);
	
	$query = "SELECT * FROM blacklist where tel='".$_POST["tel"]."'";
	$result = mysql_query($query);
	
	$return = format_return($result);
	
	echo $return;
	mysql_close($cxn);
?>