<?php

/** 
Author: Cresson Thomas - Lonni Besançon
Purpose: ajouté ou supprimé un coureur
Name: ajoutSuppressionCoureur.php
Date: 07/01/2014
Last Modif : 	Lonni 09/01/2014
				- Ajout commentaire

Comments :
	- 	Pour ajouter un evenement, mettre en parametre GET 'add'
	-	Pour supprimer, ne rien mettre
	- 	Pour l'ordre des paramètre POST :
				$_POST["nomVille"] = 
				$_POST["debutEvenement"] = 
				$_POST["finEvenement"] = 
				$_POST["adresse"] = 
				$_POST["organisateur"] = 
	

**/

require_once("constantes.php");

$connexion = mysql_connect($host, $user, $password);
mysql_select_db($dbName);

if(isset($_GET["add"])){
	$insertValues = "";
	
	
	foreach($_POST as $key => $value){
		$insertValues .= "'".htmlentities($value)."',";
	}
	
	$insertValues = substr($insertValues, 0, strlen($insertValues)-1);
	
	$query = "INSERT INTO events(NomVille, DebutEvenement, FinEvenement, Adresse, Organisateur) VALUES(".$insertValues.")";
	
	$result = mysql_query($query, $connexion);
}

else{
	$_POST["nomVille"] = "Du Terou";
	$ville = htmlentities($_POST["nomVille"]);
	
	$queryDelete = "DELETE FROM events WHERE nomVille='".$ville."'";
	$queryUpdateCities = "UPDATE cities SET NbKm=0 WHERE NomVille='".$ville."'";
	$queryUpdateCoureurs = "UPDATE users SET NbKm=0 WHERE NomVille='".$ville."'";
	
	$result = mysql_query($queryUpdateCities, $connexion);	
	$result = mysql_query($queryUpdateCoureurs, $connexion);
	$result = mysql_query($queryDelete, $connexion);
}

echo $result;

mysql_close($connexion);

return $result;

?>