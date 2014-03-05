<?php

/** 
Author: Cresson Thomas - Lonni Besançon
Purpose: ajouté ou supprimé un coureur
Name: ajoutSuppressionCoureur.php
Date: 07/01/2014
**/

require_once("./config.php");

$connexion = mysql_connect($host, $user, $password);
mysql_select_db($dbName);

if(isset($_GET["add"])){
	$_POST["tel"] = "20";
	$tel = htmlentities($_POST["tel"]);
	
	$queryVilleKm = "SELECT VilleEvent, NbKm FROM users WHERE Tel='".$tel."'";
	$query = "INSERT INTO blacklist(Tel) VALUES('".$tel."')";
	
	$result = mysql_query($queryVilleKm, $connexion);
	
	$row = mysql_fetch_row($result);
	$villeEvent = $row[0];
	$nbKmCoureur = $row[1];
	
	$queryVille = "SELECT NbKm FROM cities WHERE NomVille='".$villeEvent."'";
	
	$result = mysql_query($queryVille, $connexion);
	
	$nbKmVille = mysql_fetch_row($result)[0] - $nbKmCoureur;
	
	$queryUpdateEvent = "UPDATE cities SET NbKm=".$nbKmVille." WHERE NomVille='".$villeEvent."'";
	
	$result = mysql_query($queryUpdateEvent, $connexion);
	$result = mysql_query($query, $connexion);
}

else{
	$_POST["tel"] = "20";
	$tel = htmlentities($_POST["tel"]);
	
	$queryVilleKm = "SELECT VilleEvent, NbKm FROM users WHERE Tel='".$tel."'";
	$queryDelete = "DELETE FROM blacklist WHERE Tel='".$tel."'";
	
	$result = mysql_query($queryVilleKm, $connexion);
	
	$row = mysql_fetch_row($result);
	$villeEvent = $row[0];
	$nbKmCoureur = $row[1];
	
	$queryVille = "SELECT NbKm FROM cities WHERE NomVille='".$villeEvent."'";
	
	$result = mysql_query($queryVille, $connexion);
	
	$nbKmVille = mysql_fetch_row($result)[0] + $nbKmCoureur;
	
	$queryUpdateEvent = "UPDATE cities SET NbKm=".$nbKmVille." WHERE NomVille='".$villeEvent."'";
	
	$result = mysql_query($queryUpdateEvent, $connexion);
	$result = mysql_query($queryDelete, $connexion);
}

echo $result;

mysql_close($connexion);

return $result;

?>