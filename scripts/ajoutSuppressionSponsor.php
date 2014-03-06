<?php

/** 
Author: Cresson Thomas - Lonni Besançon
Purpose: ajouté ou supprimé un coureur
Name: ajoutSuppressionCoureur.php
Date: 07/01/2014
**/

<<<<<<< HEAD
require_once("../config.php");

mysql_select_db($array_db['db_projet']);

if(isset($_POST["add"])){
	$insertValues = "";
	
	unset($_POST["add"]);
	unset($_POST["x"]);
	unset($_POST["y"]);
	
	foreach($_POST as $key => $value){
		echo $key."\n";
=======
require_once("constantes.php");

$connexion = mysql_connect($host, $user, $password);
mysql_select_db($dbName);

if(isset($_GET["add"])){
	$insertValues = "";
	
	$_POST["nom"] = "lol";
	$_POST["URL"] = "coucou.fr";
	$_POST["logo"] = "ta maman";
	
	foreach($_POST as $key => $value){
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
		$insertValues .= "'".htmlentities($value)."',";
	}
	
	$insertValues = substr($insertValues, 0, strlen($insertValues)-1);
	
	$query = "INSERT INTO sponsors(Nom, URL, Logo) VALUES(".$insertValues.")";
	
<<<<<<< HEAD
	$result = mysql_query($query, $cxn);
	echo $query;
}

else{
	$nom = htmlentities($_POST["nom"]);
	$queryDelete = "DELETE FROM sponsors WHERE ID=".$nom;
	$result = mysql_query($queryDelete, $cxn);
	echo $nom;
}

mysql_close($cxn);

if(!isset($_GET['site']))
	return $result;
else
	header('Location: ../index.php?page=sponsor_management');
	
=======
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

>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
?>