<?php
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
		$tel = htmlentities($_POST["tel"]);
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
			
			// on banni l'utilisateur
			$query_bannir = "INSERT INTO blacklist(Tel) VALUES('".$tel."')";
			$result_bannir = mysql_query($query_bannir) or die(MYSQL_QUERY_ERROR.mysql_error());
			
			// on retranche son kilometrage
			$query_substract = "UPDATE cities SET NbKm=NbKm-".$km." WHERE NomVille='".$villeEvent."'";
			$result_bannir = mysql_query($query_substract) or die(MYSQL_QUERY_ERROR.mysql_error());
			
			// on le retire des propositions de blacklistage
			$query_bannir = "DELETE FROM pendingBlacklist WHERE tel='".$tel."'";
			$result_bannir = mysql_query($query_bannir) or die(MYSQL_QUERY_ERROR.mysql_error());
			
			// on met a jour les events qui dependaient de l'organisateur
			$query_event = "UPDATE events SET organisateur='0000000000' WHERE organisateur='".$tel."'";
			$result_event = mysql_query($query_event) or die(MYSQL_QUERY_ERROR.mysql_error());
			
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
	}
} catch (Exception $e) {
    echo $e->getMessage(),"<br/><br/><a href='index.php?page=blacklist_management'>Retour</a>";
}
?>