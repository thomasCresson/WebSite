<?php

/** 
Author: Cresson Thomas - Lonni Besançon
Purpose: récupéré le nombre total de kms parcourus
Name: kmTotal.php
Date: 07/01/2014
Last Modif : 	Lonni
				- Ajout commentaires

Comments
	- 	Pour l'ajout d'un coureur, ajouter en paramèter GET add
	- 	Pour la suppression ne rien mettre 
	-	Les valeurs nécessaires à l'ajout/suppression sont des param POST
	-	Pour l'ordre des paramètres POST :

				$_POST["tel"] = 
				$_POST["prenom"] = 
				$_POST["nom"] = 
				$_POST["email"] = 
				$_POST["pass"] = 
				$_POST["villeOrigine"] = 
	

**/

require_once("constantes.php");

$connexion = mysql_connect($host, $user, $password);
mysql_select_db($dbName);

if(isset($_GET["add"])){
	$insertValues = "";
	
	foreach($_POST as $key => $value){
		if($key == "pass"){
			$value = "SHA2('".htmlentities($value)."',0),";
			$insertValues .= $value;
		}
		
		else{
			$insertValues .= "'".htmlentities($value)."',";
		}
	}
	
	$insertValues .= "'".random(20)."'";
	
	$query = "INSERT INTO users(Tel, Prenom, Nom, Email, Pass, VilleOrigine, Confirmation) VALUES(".$insertValues.")";
	
	$result = mysql_query($query, $connexion);
}

else{
	$_POST["tel"] = "20";
	$tel = htmlentities($_POST["tel"]);
	$queryVilleKm = "SELECT VilleEvent, NbKm FROM users WHERE Tel='".$tel."'";
	$queryDelete = "DELETE FROM users WHERE Tel='".$tel."'";
	
	$result = mysql_query($queryVilleKm, $connexion);
	
	$row = mysql_fetch_row($result);
	$villeEvent = $row[0];
	$nbKmCoureur = $row[1];
	$queryVille = "SELECT NbKm FROM cities WHERE NomVille='".$villeEvent."'";
	
	$result = mysql_query($queryVille, $connexion);
	
	$nbKmVille = mysql_fetch_row($result)[0] - $nbKmCoureur;
	
	$queryUpdateEvent = "UPDATE cities SET NbKm=".$nbKmVille." WHERE NomVille='".$villeEvent."'";
	
	$result = mysql_query($queryUpdateEvent, $connexion);
	$result = mysql_query($queryDelete, $connexion);
}

echo $result;

mysql_close($connexion);

return $result;

?>