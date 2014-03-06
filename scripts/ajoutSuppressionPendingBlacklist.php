<?php

/** 
Author: Maëlle CHAPTAL
Purpose: ajouter ou supprimer un coureur de la demande de blacklist
Name: ajoutSuppressionPendingBlacklist.php
Date: 05/03/2014
**/

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


	
?>