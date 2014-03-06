<?php

/** 
Author: Cresson Thomas - Lonni Besançon
Purpose: update du texte d'accueil
Name: updateAccueil.php
Date: 07/01/2014
**/

require_once("../config.php");
$db = mysql_select_db ($array_db['db_projet'],$cxn);

$tel = htmlentities($_POST["tel"]);
$queryVilleKm = "SELECT villeorigine, VilleEvent, NbKm FROM users WHERE Tel='".$tel."'";
$result = mysql_query($queryVilleKm);
$row = mysql_fetch_row($result);

$villeOrigine = $row[0];
$villeEvent = $row[1];
$nbKmCoureur = $row[2];

$queryNbKmParcours = "select longueur from parcours where nomville='".$villeEvent."'";
$result = mysql_query($queryNbKmParcours);

$row = mysql_fetch_row($result);
$nbKmTour = $row[0];
$nbKmCoureur += $nbKmTour;

$queryVille = "SELECT NbKm FROM cities WHERE NomVille='".$villeOrigine."'";
$result = mysql_query($queryVille);
$row = mysql_fetch_row($result);
$nbKmVille = $row[0] + $nbKmTour;

$queryUpdateEvent = "UPDATE cities SET NbKm=".$nbKmVille." WHERE NomVille='".$villeOrigine."'";
$queryUpdateCoureur = "UPDATE users SET NbKm=".$nbKmCoureur." WHERE Tel='".$tel."'";

mysql_query($queryUpdateEvent);
mysql_query($queryUpdateCoureur);

$result = mysql_affected_rows();

echo $result;

mysql_close($cxn);

?>