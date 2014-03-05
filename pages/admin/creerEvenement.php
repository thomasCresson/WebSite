<?php
	if($_SESSION['admin'] != 1) exit(-1);
	
	if(isset($_POST["ajout_event"])){
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
			
			// on vérifie qu'il n'y a pas d'evenement dans cette ville
			$query_has_event = "SELECT nomville FROM events WHERE nomville='".$ville."'";
			$result_has_event = mysql_query($query_has_event) or die(MYSQL_QUERY_ERROR.mysql_error());
			if(mysql_num_rows($result_has_event) > 0) {
				throw new Exception('La ville '.$ville.' dispose deja d\'un event');
			}
			
			// on recupere l'organisateur
			if(empty($_POST["organisateur"])){
				throw new Exception('Aucun organisateur n\'a été saisie');
			}
			list($organisateur_name,$organisateur_tmp) = split(" - ", $_POST['organisateur'], 2);
			$organisateur=mysql_real_escape_string(htmlentities($organisateur_tmp));
			
			// l'operateur ne doit pas avoir d'event
			$query_organisateur_event = "SELECT organisateur FROM events WHERE organisateur='".$organisateur."'";
			$result_organisateur_event = mysql_query($query_organisateur_event) or die(MYSQL_QUERY_ERROR.mysql_error());
			if(mysql_num_rows($result_organisateur_event) > 0) {
				throw new Exception('L\'organisateur '.$organisateur_name.' dispose deja d\'un event');
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
			$query_create="INSERT INTO events (nomville,debutevenement,finevenement,adresse,infos,organisateur) VALUES ('".$ville."','".$date_debut."','".$date_fin."','".$addresse."','".$infos."','".$organisateur."')";
			$result_create = mysql_query($query_create) or die(MYSQL_QUERY_ERROR.mysql_error());
			throw new Exception('L\'évènement du '.$date_debut.' au '.$date_fin.' a été créé dans la ville de '.$ville.'');
		} catch (Exception $e) {
			echo $e->getMessage(),"<br/><br/><a href='index.php?page=creer_evenement'>Retour</a>";
		}
	}
	else {
		?>
		<form name='form_event' action="index.php?page=creer_evenement" method="post">
			<div>
				<label for="ville">Ville :</label>
				<SELECT id="ville" name="ville" size="1">
				<?php
					$db = mysql_select_db ($array_db['db_projet'],$cxn);
					$sql = "SELECT nomville FROM cities ORDER BY nomville;";
					$request = mysql_query($sql) or die(MYSQL_QUERY_ERROR.mysql_error());
					while ($vystup = mysql_fetch_array($request))
					{
						echo '<OPTION>'.$vystup['nomville'].'';
					}
				?>
				</SELECT>
			</div>
			<div>
				<label for="organisateur">Organisateur :</label>
				<SELECT id="organisateur" name="organisateur" size="1">
				<?php
					$db = mysql_select_db ($array_db['db_projet'],$cxn);
					$sql = "SELECT nom,prenom,tel FROM users WHERE tel!='0000000000' AND !(EXISTS (SELECT nomville FROM events WHERE organisateur=users.tel)) AND !(EXISTS (SELECT tel FROM blacklist WHERE blacklist.tel=users.tel)) ORDER BY nom,prenom;";
					$request = mysql_query($sql) or die(MYSQL_QUERY_ERROR.mysql_error());
					echo '<OPTION value="Aucun - 0000000000">Aucun</option>';
					while ($vystup = mysql_fetch_array($request))
					{
						echo '<OPTION>'.$vystup['nom'].' '.$vystup['prenom'].' - '.$vystup['tel'].'';
					}
				?>
				</SELECT>
			</div>
			<div>
				<label for="adresse">Adresse :</label>
				<textarea id="adresse" name="adresse"></textarea>
			</div>
			<div>
				<label for="date_debut">Date de début :</label>
				<input type='text' name='date_debut'>
				<input type='button' value='...' onClick="window.open('calendrier.php?form=form_event&elem=date_debut','Calendrier','width=200,height=240')">
			</div>
			<div>
				<label for="heure_debut">Heure de début :</label>
				<input type='text' name='heure_debut'>
			</div>
			<div>
				<label for="date_fin">Date de fin :</label>
				<input type='text' name='date_fin'>
				<input type='button' value='...' onClick="window.open('calendrier.php?form=form_event&elem=date_fin','Calendrier','width=200,height=240')">
			</div>
			<div>
				<label for="heure_debut">Heure de fin :</label>
				<input type='text' name='heure_fin'>
			</div>
			<div>
				<label for="info">Infos :</label>
				<textarea id="info" name="info"></textarea>
			</div>
			<input name="ajout_event" id="bouton_menu" type="submit" value="Créer l'évènement" />
		</form>
		<?php
	}
?>

