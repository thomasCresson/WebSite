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

require_once("../config.php");
$db = mysql_select_db ($array_db['db_projet'],$cxn);

//$_POST["add"] = "";

if(isset($_POST["add"])){
	$insertValues = "";
	
	unset($_POST["add"]);
	
	/*$_POST["tel"] = "0123456789";
	$_POST["prenom"] = "toto";
	$_POST["nom"] = "cresson";
	$_POST["email"] = "coucouTuVeuxVoirMaBite@hotmail.com";
	$_POST["pass"] = "azertyuiop";
	$_POST["villeOrigin"] = "Jackson";
	*/
	foreach($_POST as $key => $value){
		if($key == "pass"){
			$value = "password('".htmlentities($value)."'),";
			$insertValues .= $value;
		}
		
		else{
			$insertValues .= "'".htmlentities($value)."',";
		}
	}
	
	$confirm = random(20);
	$insertValues .= "'".$confirm."'";
	
	$query = "INSERT INTO users(Tel, Prenom, Nom, Email, Pass, VilleOrigine, Confirmation) VALUES(".$insertValues.")";
	
	
	
	mysql_query($query);
	
	$result = mysql_affected_rows();
	
	if($result > 0){
		$message = "You've been registered to PRT!!!\r\nTo confirm and finish the registration click on the following link:\r\n http://localhost/WebSite/index.php?page=confirm&tel=".$_POST["tel"]."&conf=".$confirm;
		$headers = 'From: webmaster@noreply.com';
		mail($_POST["email"], 'PRT REGISTRATION (NO REPLY)', $message, $headers);
	}
}

else if(isset($_POST["tel"])){
	//$_POST["tel"] = "0123456789";
	$tel = htmlentities($_POST["tel"]);
	$queryVilleKm = "SELECT VilleEvent, NbKm FROM users WHERE Tel='".$tel."'";
	$queryDelete = "DELETE FROM users WHERE Tel='".$tel."'";
	
	$result = mysql_query($queryVilleKm);
	
	$row = mysql_fetch_row($result);
	$villeEvent = $row[0];
	$nbKmCoureur = $row[1];
	$queryVille = "SELECT NbKm FROM cities WHERE NomVille='".$villeEvent."'";
	
	$result = mysql_query($queryVille);
	$row = mysql_fetch_row($result);
	$nbKmVille = $row[0] - $nbKmCoureur;
	
	$queryUpdateEvent = "UPDATE cities SET NbKm=".$nbKmVille." WHERE NomVille='".$villeEvent."'";
	
	mysql_query($queryUpdateEvent);
	mysql_query($queryDelete);
	$result = mysql_affected_rows();
}

echo $result;

mysql_close($cxn);

?>