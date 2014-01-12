<?php

/** 
Author: Cresson Thomas - Lonni Besançon
Purpose: update du texte d'accueil
Name: updateAccueil.php
Date: 07/01/2014

Comments :
	- 	Le texte d'accueil est passé en POST
**/

require_once("constantes.php");

$connexion = mysql_connect($host, $user, $password);
mysql_select_db($dbName);

$query = "UPDATE txtAccueil SET Accueil=".$_POST["accueil"];

$result = mysql_query($query, $connexion);

echo $result;

mysql_close($connexion);

return $result;

?>