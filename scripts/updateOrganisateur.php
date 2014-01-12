<?php

/** 
Author: Cresson Thomas - Lonni Besançon
Purpose: update du texte d'accueil
Name: updateAccueil.php
Date: 07/01/2014
**/

require_once("constantes.php");

$connexion = mysql_connect($host, $user, $password);
mysql_select_db($dbName);

$_POST["tel"] = "20";
$_POST["villeEvent"] = "Du Terou"
$tel = htmlentities($_POST["tel"]);
$villeEvent = htmlentities($_POST["villeEvent"]);

$queryUpdateOrganisateur = "UPDATE events SET organisateur='".$tel."' WHERE NomVille='".$villeEvent."'";

$result = mysql_query($queryUpdateOrganisateur, $connexion);

echo $result;

mysql_close($connexion);

return $result;

?>