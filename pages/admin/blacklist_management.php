<?php
	echo 'Liste des comptes blacklistés';
	include('./scripts/afficherBlacklist.php');
	 
	include('./scripts/afficherPendingBlackList.php');

	echo '<div style="width:100%;height:10px;background-color:#458AB3;margin-top:20px;margin-bottom:20px;"></div>';
	echo 'Bannir un utilisateur';
	echo '<form action="index.php?page=ajouter_a_blacklist" method="post">
		Numéro de tél.
		<input name="tel" value="">
		<input id="bouton_menu" type="submit" value="Bannir" />
	</form>';
?>