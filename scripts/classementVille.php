<?php

<<<<<<< HEAD
/** 
Author: Cresson Thomas - Lonni Besançon
Purpose: récupéré le classement des villes
Name: classementVille.php
Date: 07/01/2014
**/

require_once("constantes.php");
$db = mysql_select_db ($array_db['db_projet'],$cxn);

$query = "SELECT * FROM cities ORDER BY NbKm DESC ";

if(isset($_GET["limit"]))
	$query .= "LIMIT 3";

$result = mysql_query($query) or die(MYSQL_QUERY_ERROR.mysql_error());
$return = format_return($result);

echo $return;

?>
=======
	/** 
	Author: Cresson Thomas - Lonni Besançon
	Purpose: récupéré le classement des villes
	Name: classementVille.php
	Date: 07/01/2014
	**/

	require_once(($site==1?"./config.php":"../config.php"));
	$db = mysql_select_db ($array_db['db_projet'],$cxn);

	$query = "SELECT * FROM cities ORDER BY NbKm DESC ";

	if(isset($_GET["limit"]))
		$query .= "LIMIT 3";

	$result = mysql_query($query) or die(MYSQL_QUERY_ERROR.mysql_error());
	$return = format_return($result);

	if($site!=1)
		return $return;
	echo $return;
?>
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
