<?php
	session_start();
	if($_SESSION['admin'] != 1) exit(-1);
	
	/** 
	Author: Benoit TESTU
	Purpose: gerer la creation d'evenement
	Name: creerEvenement.php
	Date: 05/03/2014
	**/


	echo '<form action="./scripts/ajoutSuppressionEvent.php" method="post">';
			
		echo '
			<div style="width:100%;height:360px;">
				<div style="float:left;width:40%;height:120px;">
					 Ville Evènement <input type="text" style="width:100%;margin-bottom:10px;" name="ville" value="" /><br />
					  Nom Evènement <input type="text" style="width:100%;margin-bottom:10px;" name="nom" value="" /><br />
					  Début Evenement<input type="text" style="width:100%;margin-bottom:10px;" name="debut" value="" /><br />
					  Fin Evenement <input type="text" style="width:100%;margin-bottom:10px;" name="fin" value="" /><br />
					  Lieu de rencontre <input type="text" style="width:100%;margin-bottom:10px;" name="adresse" value="" /><br />
					  Heure de rencontre <input type="text" style="width:100%;margin-bottom:10px;" name="meet" value="" /><br />
					  Tél organisateur <input type="text" style="width:100%;margin-bottom:10px;" name="organisateur" value="" /><br />						</div>
				<div style="float:right;width:40%;height:120px;">
					  Latitude du Point de départ<input type="text" style="width:100%;margin-bottom:10px;" name="latitude" value="" />
					  Longitude du Point de départ <input type="text" style="width:100%;margin-bottom:10px;" name="longitude" value="" /><br />
					  Kms par tour <input type="text" style="width:100%;margin-bottom:10px;" name="longueur" value="" /><br />						  Durée minimum <input type="text" style="width:100%;margin-bottom:10px;" name="min" value="" /><br />
					  Durée maximum <input type="text" style="width:100%;margin-bottom:10px;" name="max" value="" /><br />
					  Informations complémentaires <input type="text" style="width:100%;margin-bottom:10px;" name="info" value="" /><br />
				</div>
				<input type="hidden" name="add" value="coucou"/>
		  </div>
					  
		';
					
					
	echo '<div style="width:100%;height:20px;">';
	  echo'<input id="bouton_menu" style="width:49%;float:center; margin-top : 60px; background-color:white" type="submit" value="Creer evenement" />';
	echo '</div>';
				  
	echo '</form>';

?>

