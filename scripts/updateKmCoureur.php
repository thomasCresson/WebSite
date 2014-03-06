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
$tel = htmlentities($_POST["tel"]);
$queryVilleKm = "SELECT VilleEvent, NbKm FROM users WHERE Tel='".$tel."'";


$result = mysql_query($queryVilleKm, $connexion);

$row = mysql_fetch_row($result);
$villeEvent = $row[0];
$nbKmCoureur = $row[1] + $_GET["km"];
$queryVille = "SELECT NbKm FROM cities WHERE NomVille='".$villeEvent."'";

$result = mysql_query($queryVille, $connexion);

$nbKmVille = mysql_fetch_row($result)[0] + $_GET["km"];

$queryUpdateEvent = "UPDATE cities SET NbKm=".$nbKmVille." WHERE NomVille='".$villeEvent."'";
$queryUpdateCoureur = "UPDATE users SET NbKm=".$nbKmCoureur." WHERE Tel='".$tel."'";

$result = mysql_query($queryUpdateEvent, $connexion);
$result = mysql_query($queryUpdateCoureur, $connexion);

echo $result;

mysql_close($connexion);

return $result;

?>