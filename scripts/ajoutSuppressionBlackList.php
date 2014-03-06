<?php
<<<<<<< HEAD

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



=======
	if($_SESSION['admin'] != 1) exit(-1);

/** 
Author: Benoit TESTU
Purpose: ajouté ou supprimé un utilisateur dans la blacklist
Name: ajoutSuppressionBlackList.php
Date: 07/01/2014
**/
try {
	$db = mysql_select_db ($array_db['db_projet'],$cxn);

	if(isset($_POST["tel"])){
		$tel = mysql_real_escape_string(htmlentities($_POST["tel"]));
		if(isset($_POST["ban"])){
			// on récupere les kilometrages de l'utilisateur
			$query_km = "SELECT nom,prenom,VilleEvent,NbKm FROM users WHERE Tel='".$tel."'";
			$result_km = mysql_query($query_km) or die(MYSQL_QUERY_ERROR.mysql_error());
			if(mysql_num_rows($result_km) == 0) {
				throw new Exception('Aucun utilisateur ne dispose du numéro de telephore'.$tel.'');
			}
			$array_km=mysql_fetch_array($result_km);
			$km= $array_km['NbKm'];
			$villeEvent=$array_km['VilleEvent'];
			
			// on vérifie que l'utilisateur n'est pas deja banni
			$query_is_ban = "SELECT tel FROM blacklist WHERE Tel='".$tel."'";
			$result_is_ban = mysql_query($query_is_ban) or die(MYSQL_QUERY_ERROR.mysql_error());
			if(mysql_num_rows($result_is_ban) > 0) {
				throw new Exception('L\'utilisateur '.$array_km['prenom'].' '.$array_km['nom'].' est deja banni');
			}
			
			// on verifie qu'il n'est pas organisateur
			$query_is_organisateur = "SELECT organisateur FROM events WHERE organisateur='".$tel."'";
			$result_is_organisateur = mysql_query($query_is_organisateur) or die(MYSQL_QUERY_ERROR.mysql_error());
			if(mysql_num_rows($result_is_organisateur) > 0) {
				throw new Exception('L\'utilisateur '.$array_km['prenom'].' '.$array_km['nom'].' est un organisateur');
			}
			
			// on banni l'utilisateur
			$query_bannir = "INSERT INTO blacklist(Tel) VALUES('".$tel."')";
			$result_bannir = mysql_query($query_bannir) or die(MYSQL_QUERY_ERROR.mysql_error());
			
			// on retranche son kilometrage
			$query_substract = "UPDATE cities SET NbKm=NbKm-".$km." WHERE NomVille='".$villeEvent."'";
			$result_bannir = mysql_query($query_substract) or die(MYSQL_QUERY_ERROR.mysql_error());
			
			// on le retire des propositions de blacklistage
			$query_bannir = "DELETE FROM pendingBlacklist WHERE tel='".$tel."'";
			$result_bannir = mysql_query($query_bannir) or die(MYSQL_QUERY_ERROR.mysql_error());
			
			throw new Exception('Vous avez banni l\'utilisateur '.$array_km['prenom'].' '.$array_km['nom'].''); 
		}
		if(isset($_POST["deban"])){
			// on récupere les kilometrages de l'utilisateur
			$query_km = "SELECT prenom,nom,VilleEvent,NbKm FROM users WHERE Tel='".$tel."'";
			$result_km = mysql_query($query_km) or die(MYSQL_QUERY_ERROR.mysql_error());
			if(mysql_num_rows($result_km) == 0) {
				throw new Exception('Aucun utilisateur ne dispose du numéro de telephore'.$tel.'');
			}
			$array_km=mysql_fetch_array($result_km);
			$km= $array_km['NbKm'];
			$villeEvent=$array_km['VilleEvent'];
			
			// on vérifie que l'utilisateur est banni
			$query_is_ban = "SELECT tel FROM blacklist WHERE Tel='".$tel."'";
			$result_is_ban = mysql_query($query_is_ban) or die(MYSQL_QUERY_ERROR.mysql_error());
			if(mysql_num_rows($result_is_ban) == 0) {
				throw new Exception('L\'utilisateur '.$array_km['prenom'].' '.$array_km['nom'].' n\'est pas banni');
			}
			
			// on debanni l'utilisateur
			$query_debannir = "DELETE FROM blacklist WHERE tel='".$tel."'";
			$result_debannir = mysql_query($query_debannir) or die(MYSQL_QUERY_ERROR.mysql_error());
			
			// on reajoute son kilometrage
			$query_substract = "UPDATE cities SET NbKm=NbKm+".$km." WHERE NomVille='".$villeEvent."'";
			$result_bannir = mysql_query($query_substract) or die(MYSQL_QUERY_ERROR.mysql_error());
			
			throw new Exception('Vous avez débanni l\'utilisateur '.$array_km['prenom'].' '.$array_km['nom'].'');
		}
		if(isset($_POST["unpending"])){
			// on récupere le nom de l'utilsateur
			$query_km = "SELECT prenom,nom FROM users WHERE Tel='".$tel."'";
			$result_km = mysql_query($query_km) or die(MYSQL_QUERY_ERROR.mysql_error());
			if(mysql_num_rows($result_km) == 0) {
				throw new Exception('Aucun utilisateur ne dispose du numéro de telephore'.$tel.'');
			}
			$array_km=mysql_fetch_array($result_km);
			
			// on recupere l'organisateur
			$organisateur = mysql_real_escape_string(htmlentities($_POST["organisateur"]));
			// on supprime la ligne concernée
			$query = "DELETE FROM pendingBlacklist WHERE organisateur='".$organisateur."' AND tel='".$tel."'";
			$result= mysql_query($query) or die(MYSQL_QUERY_ERROR.mysql_error());
			
			throw new Exception('L\'utilisateur '.$array_km['prenom'].' '.$array_km['nom'].' a été retiré des demandes de blacklistage de '.$organisateur.'');
		}
	}
} catch (Exception $e) {
    echo $e->getMessage(),"<br/><br/><a href='index.php?page=blacklist_management'>Retour</a>";
}
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
?>