<?php
	// requete sql
	$db = mysql_select_db ($array_db['db_projet'],$cxn);
	$request = mysql_query("SELECT * FROM events WHERE Organisateur = '".$_SESSION['username']."'") or die(MYSQL_QUERY_ERROR.mysql_error());
	$row_orga = mysql_fetch_array($request);
	echo '<div style="width:80%;height:460px;">';
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
				echo '<form action="./scripts/ajoutSuppressionEvent.php?site=1" method="post">';
			
					echo '
					  <div style="width:100%;height:360px;">
						<div style="float:left;width:40%;height:120px;">
						  Ville Evènement <input type="text" style="width:100%;margin-bottom:10px;" name="ville" value="'.$row_orga['NomVille'].'" readonly /><br />
						  Nom Evènement <input type="text" style="width:100%;margin-bottom:10px;" name="nom" value="'.$row_orga['NomEvent'].'" /><br />
						  Début Evènement <input type="text" style="width:100%;margin-bottom:10px;" name="debut" value="'.$row_orga['DebutEvenement'].'" /><br />
						  Fin Evènement <input type="text" style="width:100%;margin-bottom:10px;" name="fin" value="'.$row_orga['FinEvenement'].'" /><br />
						  Lieu de rencontre <input type="text" style="width:100%;margin-bottom:10px;" name="adresse" value="'.$row_orga['Adresse'].'" /><br />
						  Heure de rencontre <input type="text" style="width:100%;margin-bottom:10px;" name="meet" value="'.$row_orga['HeureMeeting'].'" /><br />
						  Nom organisateur <input type="text" style="width:100%;margin-bottom:10px;" name="orga" value="'.$row_name['Nom'].'" readonly/><br />
						  Tél organisateur <input type="text" style="width:100%;margin-bottom:10px;" name="tel" value="'.$row_orga['Organisateur'].'" readonly/><br />
						</div>
						<div style="float:right;width:40%;height:120px;">
						  Latitude du Point de départ<input type="text" style="width:100%;margin-bottom:10px;" name="latitude" value="'.$row_parcours['Latitude'].'" />
						  Longitude du Point de départ <input type="text" style="width:100%;margin-bottom:10px;" name="longitude" value="'.$row_parcours['Longitude'].'" /><br />
						  Kms par tour <input type="text" style="width:100%;margin-bottom:10px;" name="longueur" value="'.$row_parcours['Longueur'].'" /><br />
						  Durée minimum <input type="text" style="width:100%;margin-bottom:10px;" name="min" value="'.$row_parcours['DureeMin'].'" /><br />
						  Durée maximum <input type="text" style="width:100%;margin-bottom:10px;" name="max" value="'.$row_parcours['DureeMax'].'" /><br />
						  Informations complémentaires <input type="text" style="width:100%;margin-bottom:10px;" name="info" value="'.$row_orga['Infos'].'" /><br />
						</div>
						<input type="hidden" name="modif" value="coucou"/>
					  </div>
					  
					';
					
					
					echo '<div style="width:100%;height:20px;">';
					  echo'<input id="bouton_menu" style="width:49%;float:center; margin-top : 60px; background-color:white" type="submit" value="Enregistrer" />';
					echo '</div>';
				  
				echo '</form>';
			}
		}
	}
	echo '</div>';
?>