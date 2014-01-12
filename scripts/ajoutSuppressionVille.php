<?php

/** 
Author: Cresson Thomas - Lonni Besançon
Purpose: ajouté ou supprimé un coureur
Name: ajoutSuppressionCoureur.php
Date: 07/01/2014
Last Modif : Lonni 09/01/2014

Comments :
	- Pour ajouter une ville, mettre en paramètre GET 'add'
	- Pour supprimer, ne rien mettre
	- Ordre des paramètres POST :

			$_POST["nomVille"] = "NKM";
			$_POST["CP"] = "121212";
	
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
	
	$query = "INSERT INTO cities(nomVille, CP) VALUES(".$insertValues.")";
	
	$result = mysql_query($query, $connexion);
}

else{
	$_POST["nomVille"] = "NKM";
	$ville = htmlentities($_POST["nomVille"]);
	
	
	$queryDelete = "DELETE FROM cities WHERE nomVille='".$ville."'";
	$querySelect = "SELECT tel FROM users WHERE VilleOrigine='".$ville."' OR VilleEvent='".$ville."'";
	
	$result = mysql_query($querySelect, $connexion);
	
	if(!mysql_fetch_row($result))
		$result = mysql_query($queryDelete, $connexion);
}

echo $result;

mysql_close($connexion);

return $result;

?>