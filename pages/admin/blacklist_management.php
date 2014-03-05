<?php
	if($_SESSION['admin'] != 1) exit(-1);
	
	/** 
	Author: Benoit TESTU
	Purpose: gerer la blacklist
	Name: blacklist_management.php
	Date: 05/03/2014
	**/
	
	echo 'Liste des comptes blacklistés';
	include('./scripts/afficherBlacklist.php');
	 
	include('./scripts/afficherPendingBlackList.php');

	echo '<div style="width:100%;height:10px;background-color:#458AB3;margin-top:20px;margin-bottom:20px;"></div>';
	echo 'Bannir un utilisateur';
	echo '<form action="index.php?page=ajouter_a_blacklist" method="post">
		<label>Numéro de tél.</label>
		<input name="tel" value="">
		<input name="ban" id="bouton_menu" type="submit" value="Bannir" />
	</form>';
?>