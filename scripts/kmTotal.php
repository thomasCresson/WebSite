<?php

/** 
Author: Cresson Thomas - Lonni Besançon
Purpose: récupéré le nombre total de kms parcourus
Name: kmTotal.php
Date: 07/01/2014
**/

require_once("constantes.php");

$connexion = mysql_connect($host, $user, $password);
mysql_select_db($dbName);

$query = "SELECT SUM(NbKm) FROM cities";

$result = mysql_query($query, $connexion);

echo $result;

mysql_close($connexion);

return $result;

?>