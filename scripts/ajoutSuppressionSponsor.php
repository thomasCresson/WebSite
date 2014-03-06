<?php

/** 
Author: Cresson Thomas - Lonni Besançon
Purpose: ajouté ou supprimé un coureur
Name: ajoutSuppressionCoureur.php
Date: 07/01/2014
**/

require_once("../config.php");

mysql_select_db($array_db['db_projet']);

if(isset($_POST["add"])){
	$insertValues = "";
	
	unset($_POST["add"]);
	unset($_POST["x"]);
	unset($_POST["y"]);
	
	foreach($_POST as $key => $value){
		echo $key."\n";
		$insertValues .= "'".htmlentities($value)."',";
	}
	
	$insertValues = substr($insertValues, 0, strlen($insertValues)-1);
	
	$query = "INSERT INTO sponsors(Nom, URL, Logo) VALUES(".$insertValues.")";
	
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
	
?>