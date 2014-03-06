<?php
	if($_SESSION['admin'] != 1) exit(-1);
	
	/** 
	Author: Benoit TESTU
	Purpose: gerer la modification d'evenement
	Name: gererEvenement.php
	Date: 05/03/2014
	**/
	
	/* Menu pour choisir l'evenement que l'on souhaite modifier */
	echo 'Choisissez un evenement';
	$db = mysql_select_db ($array_db['db_projet'],$cxn);
	$sql = "SELECT nomville,debutevenement,finevenement,organisateur FROM events ORDER BY finevenement";
	$request = mysql_query($sql) or die(MYSQL_QUERY_ERROR.mysql_error());
	
<<<<<<< HEAD
	echo '<form name="modify_event" action="index.php?page=gererEvenement" method="post">';
=======
	echo '<form name="modify_event" action="index.php?page=gerer_evenement" method="post">';
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
		echo'<SELECT id="ville" name="ville" size="1">';
		while ($vystup = mysql_fetch_array($request))
		{
			echo '<OPTION>'.$vystup['nomville'].' - '.$vystup['debutevenement'].' au '.$vystup['finevenement'].'';
		}
	echo '<input name="affichage_event" id="bouton_menu" type="submit" value="Modifier l\'évènement" />';
	echo '</form>';
	
	
	/* Traitement de la requete de modification d'un evenement */
	if(isset($_POST["modify_event"])) {
		echo '<div style="width:100%;height:10px;background-color:#458AB3;margin-top:20px;margin-bottom:20px;"></div>';

		try {
			$db = mysql_select_db ($array_db['db_projet'],$cxn);	

			// on verifie que la ville existe
			if(empty($_POST["ville"])){
				throw new Exception('Aucune ville n\'a été saisie');
			}
			$ville = mysql_real_escape_string(htmlentities($_POST['ville']));
			$query_is_ville = "SELECT nomville FROM cities WHERE nomville='".$ville."'";
			$result_is_ville = mysql_query($query_is_ville) or die(MYSQL_QUERY_ERROR.mysql_error());
			if(mysql_num_rows($result_is_ville) == 0) {
				throw new Exception('La ville '.$ville.' n\'existe pas');
			}
			
			// on recupere l'organisateur
			if(empty($_POST["organisateur"])){
				throw new Exception('Aucun organisateur n\'a été saisie');
			}
			list($organisateur_name,$organisateur_tmp) = split(" - ", $_POST['organisateur'], 2);
			$organisateur=mysql_real_escape_string(htmlentities($organisateur_tmp));
			
			if($organisateur!='0000000000') {
				// l'operateur ne doit pas avoir d'event
				$query_organisateur_event = "SELECT organisateur FROM events WHERE organisateur='".$organisateur."'";
				$result_organisateur_event = mysql_query($query_organisateur_event) or die(MYSQL_QUERY_ERROR.mysql_error());
				if(mysql_num_rows($result_organisateur_event) > 0) {
					throw new Exception('L\'organisateur '.$organisateur_name.' dispose deja d\'un event');
				}
			
				// l'organisateur doit avoir villeorigine=villeevent=ville
				$query_orga_ville = "SELECT VilleOrigine,VilleEvent FROM users WHERE tel='".$organisateur."'" ; 
				$result_orga_ville = mysql_query($query_orga_ville) or die(MYSQL_QUERY_ERROR.mysql_error());
				$row_orga_ville = mysql_fetch_array($result_orga_ville) ; 
				$ville_origine = $row_orga_ville['VilleOrigine'];
				$ville_participation = $row_orga_ville['VilleEvent'];
				if($ville_origine!=$ville) {
					throw new Exception('La ville d\'origine de l\'organisateur doit etre egale a la ville de l\'évènement : '.mysql_num_rows($result_orga_ville));
				}
				if($ville_participation!=$ville) {
					throw new Exception('La ville de participation de l\'organisateur doit etre egale a la ville de l\'évènement');
				}
			}
			
			// l'organisateur ne doit pas etre banni
			$query_organisateur_ban = "SELECT tel FROM blacklist WHERE tel='".$organisateur."'";
			$result_organisateur_ban = mysql_query($query_organisateur_ban) or die(MYSQL_QUERY_ERROR.mysql_error());
			if(mysql_num_rows($result_organisateur_ban) > 0) {
				throw new Exception('L\'utilisateur '.$organisateur.' est banni');
			}
			
			$format = '%Y-%m-%d %H:%M:%S';
			$strf = strftime($format);

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
			if(strtotime($date_debut) <= strtotime(strftime($format)))
			{
				throw new Exception('La date de départ n\'est pas postérieure à la date actuelle');
			}
			
			// on vérifie que l'adresse ne sont pas nulles
			if(empty($_POST["adresse"])){
				throw new Exception('Aucune adresse n\'a été saisie');
			}
			
			// on verifie les injections SQL dans addresse
			$adresse = mysql_real_escape_string(htmlentities($_POST['adresse']));
			
			// on vérifie que les infos ne sont pas nulles
			if(empty($_POST["info"])){
				throw new Exception('Aucune info n\'a été saisie');
			}
			
			// on verifie les injections SQL dans infos
			$infos = mysql_real_escape_string(htmlentities($_POST['info']));
			
			// on créé l'evenement
			$query_create="UPDATE events SET debutevenement='".$date_debut."',finevenement='".$date_fin."',adresse='".$adresse."',infos='".$infos."',organisateur='".$organisateur."' WHERE nomville='".$ville."';";
			$result_create = mysql_query($query_create) or die(MYSQL_QUERY_ERROR.mysql_error());
			throw new Exception('L\'évènement de la ville '.$ville.' a été modifié');
		} catch (Exception $e) {
			echo $e->getMessage(),"<br/><br/><a href='index.php?page=gerer_evenement'>Retour</a>";
		}
	}
	/* Affichage du formulaire de modification d'un evenement */
	else if(isset($_POST["affichage_event"])&&isset($_POST["ville"])){
		$ville = mysql_real_escape_string(htmlentities($_POST['ville']));
		list($ville,$dates) = split(" -", $ville, 2);
		$query_info = "SELECT nomville,debutevenement,finevenement,organisateur,adresse,infos FROM events WHERE nomville='".$ville."'";
		$request_info = mysql_query($query_info) or die(MYSQL_QUERY_ERROR.mysql_error());
		$result_info = mysql_fetch_array($request_info);
		
		$adresse=$result_info['adresse'];
		$infos=$result_info['infos'];
		$organisateur=$result_info['organisateur'];
		list($date_debut,$heure_debut) = split(" ", $result_info['debutevenement'], 2);
		list($date_fin,$heure_fin) = split(" ", $result_info['finevenement'], 2);
		?>
		<form name='form_event' action="index.php?page=gerer_evenement" method="post">
			<div>
				<label for="ville">Ville :</label>
				<label><?php echo $ville; ?></label>
				<input name="ville" type="hidden" value="<?php echo $ville; ?>" />
			</div>
			<div>
				<label for="organisateur">Organisateur :</label>
				<SELECT id="organisateur" name="organisateur" size="1">
				<?php
					$db = mysql_select_db ($array_db['db_projet'],$cxn);
					$sql = "SELECT nom,prenom,tel FROM users WHERE tel!='0000000000' AND !(EXISTS (SELECT tel FROM blacklist WHERE blacklist.tel=users.tel)) ORDER BY nom,prenom;";
					$request = mysql_query($sql) or die(MYSQL_QUERY_ERROR.mysql_error());
					echo '<OPTION value="Aucun - 0000000000">Aucun</option>';
					while ($vystup = mysql_fetch_array($request))
					{
						if($vystup['tel']==$organisateur) $selected="selected";
						else $selected="";
						echo '<OPTION '.$selected.'>'.$vystup['nom'].' '.$vystup['prenom'].' - '.$vystup['tel'].'</option>';
					}
				?>
				</SELECT>
			</div>
			<div>
				<label for="adresse">Adresse :</label>
				<textarea id="adresse" name="adresse"><?php echo $adresse; ?></textarea>
			</div>
			<div>
				<label for="date_debut">Date de début :</label>
				<input type='text' name='date_debut' value="<?php echo $date_debut; ?>">
				<input type='button' value='...' onClick="window.open('calendrier.php?form=form_event&elem=date_debut','Calendrier','width=200,height=240')">
			</div>
			<div>
				<label for="heure_debut">Heure de début :</label>
				<input type='text' name='heure_debut' value="<?php echo $heure_debut; ?>">
			</div>
			<div>
				<label for="date_fin">Date de fin :</label>
				<input type='text' name='date_fin' value="<?php echo $date_fin; ?>">
				<input type='button' value='...' onClick="window.open('calendrier.php?form=form_event&elem=date_fin','Calendrier','width=200,height=240')">
			</div>
			<div>
				<label for="heure_debut">Heure de fin :</label>
				<input type='text' name='heure_fin' value="<?php echo $heure_fin; ?>">
			</div>
			<div>
				<label for="info">Infos :</label>
				<textarea id="info" name="info"><?php echo $infos; ?></textarea>
			</div>
			<input name="modify_event" id="bouton_menu" type="submit" value="Modifier l'évènement" />
		</form>
		<?php
	}
?>