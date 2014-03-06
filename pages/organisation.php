<?php
	// requete sql
	$db = mysql_select_db ($array_db['db_projet'],$cxn);
	$request = mysql_query("SELECT * FROM events WHERE Organisateur = '".$_SESSION['username']."'") or die(MYSQL_QUERY_ERROR.mysql_error());
	$row_orga = mysql_fetch_array($request);
	echo '<div style="width:80%;height:360px; line-height:20px ">';
	if(mysql_num_rows($request) == 1)
	{
		$requestParcours = mysql_query("SELECT * FROM parcours WHERE NomVille = '".$row_orga['NomVille']."'") or die(MYSQL_QUERY_ERROR.mysql_error());
		$row_parcours = mysql_fetch_array($requestParcours);
			if(mysql_num_rows($requestParcours) == 1)
		{
			$requestNameOrganisateur = mysql_query("SELECT Nom FROM users WHERE Tel = '".$_SESSION['username']."'") or die(MYSQL_QUERY_ERROR.mysql_error());
			$row_name = mysql_fetch_array($requestNameOrganisateur);
				if(mysql_num_rows($requestNameOrganisateur) == 1)
			{
		
			echo '
			<div style="width:100%;height:270px;">		
				<span>Ville : '.$row_orga['NomVille'].'</span>
				<br/>
				<span>Nom : '.$row_orga['NomEVent'].'</span>
				<br/>
				<span>Début de la course : '.$row_orga['DebutEvenement'].'</span>
				<br/>
				<span>Fin de la course : '.$row_orga['FinEvenement'].'</span>
				<br/>
				<span>Lieu de rencontre : '.$row_orga['Adresse'].'</span>
				<br/>
				<span>Heure de rencontre : '.$row_orga['HeureMeeting'].'</span>
				<br/>
				<span>Nom Organisateur : '.$row_name['Nom'].'</span>
				<br/>
				<span>Tél Organisateur : '.$row_orga['Organisateur'].'</span>
				<br/>
				<span>Point de départ : lat '.$row_parcours['Latitude'].'; long '.$row_parcours['Longitude'].'</span>
				<br/>
				<span>Kms / tour : '.$row_parcours['Longueur'].'</span>
				<br/>
				<span>Durée Minimum : '.$row_parcours['DureeMin'].'</span>
				<br/>
				<span>Durée Maximum : '.$row_parcours['DureeMax'].'</span>
				<br/>
				<span>Informations complémentaires : '.$row_orga['Infos'].'</span>
				<br/>
				<span></span>
				<br/>
				<a href = "index.php?page=event_modify"> <div style="width:100%;height:20px;"><input id="bouton_menu" style="width:20%;float:center;" background-colo:white; margin-bottom: 20px;type="submit" value="Modifier" /></div></a>
			</div>
			';
			}
		}
	}
	echo'</div>';
?>