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


require_once("../config.php");

mysql_select_db($array_db['db_projet']);


if(isset($_POST["add"])){
	// on verifie que la ville existe
			if(empty($_POST['ville'])){
				throw new Exception('Aucune ville n\'a été saisie');
			}
			$ville = mysql_real_escape_string(htmlentities($_POST['ville']));
			$query_is_ville = "SELECT nomville FROM cities WHERE nomville='".$ville."'";
			$result_is_ville = mysql_query($query_is_ville) or die(MYSQL_QUERY_ERROR.mysql_error());
			if(mysql_num_rows($result_is_ville) == 0) {
				throw new Exception('La ville '.$ville.' n\'existe pas');
			}
			
			// on vérifie qu'il n'y a pas d'evenement dans cette ville
			$query_has_event = "SELECT nomville FROM events WHERE nomville='".$ville."'";
			$result_has_event = mysql_query($query_has_event) or die(MYSQL_QUERY_ERROR.mysql_error());
			if(mysql_num_rows($result_has_event) > 0) {
				throw new Exception('La ville '.$ville.' dispose deja d\'un event');
			}
			
			// on recupere l'organisateur
			if(empty($_POST['organisateur'])){
				throw new Exception('Aucun organisateur n\'a été saisie');
			}
			//list($organisateur_name,$organisateur_tmp) = split(" - ", $_POST['organisateur'], 2);
			//$organisateur=mysql_real_escape_string(htmlentities($organisateur_tmp));
			$organisateur=mysql_real_escape_string(htmlentities($_POST['organisateur']));
			
			if($organisateur!='0000000000') {
				// l'operateur ne doit pas avoir d'event
				$query_organisateur_event = "SELECT organisateur FROM events WHERE organisateur='".$organisateur."'";
				$result_organisateur_event = mysql_query($query_organisateur_event) or die(MYSQL_QUERY_ERROR.mysql_error());
				if(mysql_num_rows($result_organisateur_event) > 0) {
					throw new Exception('Cet organisateur dispose deja d\'un event');
				}
			
				// l'organisateur doit avoir villeorigine=villeevent=ville
				$query_orga_ville = "SELECT villeorigine FROM users WHERE tel='".$organisateur."'" ; 
				$result_orga_ville = mysql_query($query_orga_ville);
				$row_orga_ville = mysql_fetch_array($result_orga_ville) ; 
				$ville_origine = $row_orga_ville[0] ;
				$query_orga_ville = "SELECT villeevent FROM users WHERE tel='".$organisateur."'" ; 
				$result_orga_ville = mysql_query($query_orga_ville);
				$row_orga_ville = mysql_fetch_array($result_orga_ville) ;
				$ville_participation = $row_orga_ville[0] ;
				if($ville_origine!=$ville) {
					throw new Exception('La ville d\'origine de l\'organisateur doit etre egale a la ville de l\'évènement');
				}
				if($ville_participation!=$ville) {
					throw new Exception('La ville de participation de l\'organisateur doit etre egale a la ville de l\'évènement');
				}
			}
			
			// l'organisateur ne doit pas etre banni
			$query_organisateur_ban = "SELECT tel FROM blacklist WHERE tel='".$organisateur."'";
			$result_organisateur_ban = mysql_query($query_organisateur_ban) or die(MYSQL_QUERY_ERROR.mysql_error());
			if(mysql_num_rows($result_organisateur_ban) > 0) {
				throw new Exception('L\'utilisateur que vous souhaitez mettre en organisateur est sur blacklist.');
			}
			
			$format_heure = '%H:%M:%S';
			$format = '%Y-%m-%d %H:%M:%S';
			$strf = strftime($format);
			
			// on verifie que l'heure de rencontre est bien au format HH:MM:SS
			/*$heure_meeting = mysql_real_escape_string(htmlentities($_POST['meet']));
			if (!strptime($heure_meeting, $format_heure))
			{
				throw new Exception('L\'heure de rencontre "'.$heure_meeting.'" n\'est pas au format HH:MM:SS');
			}
			
			// on verifie que la date de debut est bien au format YYYY-MM-DD HH:MM:SS
			$date_debut = mysql_real_escape_string(htmlentities($_POST['date_debut'])).' '.mysql_real_escape_string(htmlentities($_POST['heure_debut']));
			if (!strptime($date_debut, $format))
			{
				throw new Exception('La date de début "'.$date_debut.'" n\'est pas au format YYYY-MM-DD HH:MM:SS');
			}
			
			// on verifie que la date de fin est bien au format YYYY-MM-DD HH:MM:SS
			$date_fin = mysql_real_escape_string(htmlentities($_POST['date_fin'])).' '.mysql_real_escape_string(htmlentities($_POST['heure_fin']));
			if (!strptime($date_fin, $format))
			{
				throw new Exception('La date de fin "'.$date_fin.'" n\'est pas au format YYYY-MM-DD HH:MM:SS');
			}
			
			// on verifie que la date de fin est posterieure a la date de debut
			if(strtotime($date_debut) >= strtotime($date_fin))
			{
				throw new Exception('La date de fin n\'est pas postérieure à la date de départ');
			}
			
			// on vérifie que la date de debut est posterieure a aujourd'hui
			if(strtotime($date_debut) <= strtotime($strf))
			{
				throw new Exception('La date de départ n\'est pas postérieure à la date actuelle');
			}*/
			
			// on vérifie que l'adresse est pas nulle
			if(empty($_POST['adresse'])){
				throw new Exception('Aucune adresse n\'a été saisie');
			}
			
			// on verifie les injections SQL dans addresse
			$adresse = mysql_real_escape_string(htmlentities($_POST['adresse']));
			
			// on vérifie que les infos ne sont pas nulles
			if(empty($_POST['info'])){
				throw new Exception('Aucune info n\'a été saisie');
			}
			
			// on verifie les injections SQL dans infos
			$infos = mysql_real_escape_string(htmlentities($_POST['info']));
			
			// on vérifie que le nom de l'event est pas nulle
			if(empty($_POST['nom'])){
				throw new Exception('Aucune info n\'a été saisie');
			}
			
			// on verifie les injections SQL dans le nom
			$nom = mysql_real_escape_string(htmlentities($_POST['nom']));
			
	$query_create = "INSERT INTO events(NomVille, NomEvent, HeureMeeting, DebutEvenement, FinEvenement, Adresse, Organisateur) VALUES( '".$_POST['ville']."','".$_POST["ville"]."','".$_POST['meet']."','".$_POST['debut']."','".$_POST['fin']."','".$_POST['adresse']."','".$_POST['organisateur']."')";
	
	$result_create = mysql_query($query_create, $cxn);
	
	$query_create_parcours = "INSERT INTO parcours(NomVille, Longueur, DureeMax, DureeMin, Latitude, Longitude) VALUES(".$_POST["ville"].",".$_POST["longueur"].",".$_POST["max"].",".$_POST["min"].",".$_POST["latitude"].",".$_POST["longitude"].")";
	
	$result_create_parcours = mysql_query($query_create_parcours, $cxn);
	
	//echo $result;
	ob_start(); 
	$url = 'Location: ../pages/admin/resultat_creation_event.php'; 
	echo $url;
	while (ob_get_status()) 
	{
		ob_end_clean();
	}
	header( "Location: $url" );
	
}
else if(isset($_POST["modif"])){

	unset($_POST["modif"]);
	unset($_POST["x"]);
	unset($_POST["y"]);
	
	$query = 'UPDATE events SET NomEvent = "'.$_POST["nom"].'", HeureMeeting = "'.$_POST["meet"].'", DebutEvenement = "'.$_POST["debut"].'", FinEvenement = "'.$_POST["fin"].'", adresse = "'.$_POST["adresse"].'" WHERE NomVille = "'.$_POST["ville"].'"'; 

	$result = mysql_query($query, $cxn);
	
	$query = 'UPDATE parcours SET Longueur = "'.$_POST["longueur"].'", DureeMax = "'.$_POST["max"].'", DureeMin = "'.$_POST["min"].'", Latitude = "'.$_POST["latitude"].'", Longitude = "'.$_POST["longitude"].'" WHERE NomVille = "'.$_POST["ville"].'"'; 

	$result = mysql_query($query, $cxn);
	
	echo $result;
}

else{
	$_POST["ville"] = "Du Terou";
	$ville = htmlentities($_POST["ville"]);
	
	$queryDelete = "DELETE FROM events WHERE NomVille='".$ville."'";
	$queryUpdateCities = "UPDATE cities SET NbKm=0 WHERE NomVille='".$ville."'";
	$queryUpdateCoureurs = "UPDATE users SET NbKm=0 WHERE NomVille='".$ville."'";
	
	$result = mysql_query($queryUpdateCities, $cxn);	
	$result = mysql_query($queryUpdateCoureurs, $cxn);
	$result = mysql_query($queryDelete, $cxn);
	echo $result;
}



	
?>

