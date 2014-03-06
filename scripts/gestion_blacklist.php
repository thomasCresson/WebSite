<?php

/** 
Author: Maëlle CHAPTAL
Purpose: ajouter ou supprimer un coureur de la demande de blacklist
Name: ajoutSuppressionPendingBlacklist.php
Date: 05/03/2014
**/

if(isset($_GET["pending"])){
	require_once("../config.php");

	mysql_select_db($array_db['db_projet']);
	
	if(isset($_GET["add"])){
		$tel = htmlentities($_POST["tel"]);
		
		$query = "INSERT INTO pendingblacklist(Tel) VALUES('".$tel."')";

		$result = mysql_query($query, $cxn);
		
		ob_start(); 
		$url = '../index.php?page=organisation_blacklist_submit'; 
		while (ob_get_status()) 
		{
			ob_end_clean();
		}
		header( "Location: $url" );
	}

	else{
		$tel = htmlentities($_POST["tel"]);
		
		$queryDelete = "DELETE FROM pendingblacklist WHERE Tel='".$tel."'";

		$result = mysql_query($queryDelete, $cxn);
		
		ob_start(); 
		$url = '../index.php?page=blacklist_management'; 
		while (ob_get_status()) 
		{
			ob_end_clean();
		}
		header( "Location: $url" );
	}
}
else{
	require_once("constantes.php");

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

}

	
?>