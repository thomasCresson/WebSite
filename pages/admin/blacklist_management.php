<?php
	echo '<div style="height:200px">';
	if($_SESSION['admin'] != 1) exit(-1);
	
	echo 'Liste des comptes blacklistés';
	require('./scripts/afficherBlacklist.php');
	 
	require('./scripts/afficherPendingBlackList.php');

	echo '<div class="sep"></div>';

	echo 'Bannir un utilisateur';
	echo '<form action="index.php?page=ajouter_a_blacklist" method="post">
		<label>Numéro de tél.</label>
		<input name="tel" value="">
		<input name="ban" id="bouton_menu" type="submit" value="Bannir" />
	</form>';
	echo '</div>';
?>