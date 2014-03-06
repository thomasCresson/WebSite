<?php

/** 
Author: Cresson Thomas - Lonni Besançon
Purpose: ajouté ou supprimé un coureur
Name: ajoutSuppressionCoureur.php
Date: 07/01/2014
**/



require_once("../pages/constantes.php");
require_once("../config.php");

mysql_select_db($array_db['db_projet']);

if(isset($_GET["add"])){
	$tel = htmlentities($_POST["tel"]);
	
	$queryVilleKm = "SELECT VilleEvent, NbKm FROM users WHERE Tel='".$tel."'";
	$query = "INSERT INTO blacklist(Tel) VALUES('".$tel."')";
	$query2 = "DELETE FROM pendingblacklist WHERE Tel='".$tel."'";
	
	$result = mysql_query($queryVilleKm, $cxn);
	
	$row = mysql_fetch_row($result);
	$villeEvent = $row[0];
	$nbKmCoureur = $row[1];
	
	$queryVille = "SELECT NbKm FROM cities WHERE NomVille='".$villeEvent."'";
	
	$result = mysql_query($queryVille, $cxn);
	
	$nbKmVille = mysql_fetch_row($result)[0] - $nbKmCoureur;
	
	$queryUpdateEvent = "UPDATE cities SET NbKm=".$nbKmVille." WHERE NomVille='".$villeEvent."'";
	
	$result = mysql_query($queryUpdateEvent, $cxn);
	$result = mysql_query($query, $cxn);
	
	ob_start(); 
	$url = '../index.php?page=blacklist_management'; 
	while (ob_get_status()) 
	{
		ob_end_clean();
	}
	header( "Location: $url" );
}

else{
	$_POST["tel"] = "20";
	$tel = htmlentities($_POST["tel"]);
	
	$queryVilleKm = "SELECT VilleEvent, NbKm FROM users WHERE Tel='".$tel."'";
	$queryDelete = "DELETE FROM blacklist WHERE Tel='".$tel."'";
	
	$result = mysql_query($queryVilleKm, $cxn);
	
	$row = mysql_fetch_row($result);
	$villeEvent = $row[0];
	$nbKmCoureur = $row[1];
	
	$queryVille = "SELECT NbKm FROM cities WHERE NomVille='".$villeEvent."'";
	
	$result = mysql_query($queryVille, $cxn);
	
	$nbKmVille = mysql_fetch_row($result)[0] + $nbKmCoureur;
	
	$queryUpdateEvent = "UPDATE cities SET NbKm=".$nbKmVille." WHERE NomVille='".$villeEvent."'";
	
	$result = mysql_query($queryUpdateEvent, $cxn);
	$result = mysql_query($queryDelete, $cxn);
	
	ob_start(); 
	$url = '../index.php?page=blacklist_management'; 
	while (ob_get_status()) 
	{
		ob_end_clean();
	}
	header( "Location: $url" );
}



?>