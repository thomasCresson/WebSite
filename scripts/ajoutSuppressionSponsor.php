<?php

/** 
Author: Cresson Thomas - Lonni Besançon
Purpose: ajouté ou supprimé un coureur
Name: ajoutSuppressionCoureur.php
Date: 07/01/2014
**/

require_once("constantes.php");

$connexion = mysql_connect($host, $user, $password);
mysql_select_db($dbName);

if(isset($_GET["add"])){
	$insertValues = "";
	
	$_POST["nom"] = "lol";
	$_POST["URL"] = "coucou.fr";
	$_POST["logo"] = "ta maman";
	
	foreach($_POST as $key => $value){
		$insertValues .= "'".htmlentities($value)."',";
	}
	
	$insertValues = substr($insertValues, 0, strlen($insertValues)-1);
	
	$query = "INSERT INTO sponsors(Nom, URL, Logo) VALUES(".$insertValues.")";
	
	$result = mysql_query($query, $connexion);
}

else{
	$_POST["nom"] = "lol";
	$nom = htmlentities($_POST["nomVille"]);
	
	$queryDelete = "DELETE FROM sponsors WHERE Nom='".$nom."'";
	
	$result = mysql_query($queryDelete, $connexion);
}

echo $result;

mysql_close($connexion);

return $result;

?>