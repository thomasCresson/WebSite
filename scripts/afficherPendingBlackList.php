<?php

	/** 
	Author: Benoit TESTU
	Purpose: récupéré les propositions de blacklistage
	Name: afflicherPendingBlackList.php
	Date: 07/01/2014
	**/

	require_once(($site==1?"./config.php":"../config.php"));
	$db = mysql_select_db ($array_db['db_projet'],$cxn);
	$sql = "SELECT prenom,nom,users.tel FROM events,users WHERE users.tel=events.organisateur ORDER BY nom;";
	$request = mysql_query($sql) or die(MYSQL_QUERY_ERROR.mysql_error());
	while ($vystup = mysql_fetch_array($request))
	{
		$sql_organisateur = "SELECT prenom,nom,pendingBlacklist.tel,raison FROM pendingBlacklist,users WHERE organisateur='".$vystup['tel']."' and pendingBlacklist.tel=users.tel;";
		$request_organisateur = mysql_query($sql_organisateur) or die(MYSQL_QUERY_ERROR.mysql_error());
		if(mysql_num_rows($request_organisateur)<1) continue;
		echo '<div style="width:100%;height:10px;background-color:#458AB3;margin-top:20px;margin-bottom:20px;"></div>';
		echo 'Liste des comptes proposés par '.$vystup['prenom'].' '.$vystup['nom'].' au blacklistage';
		
		  echo '<table style="background-color:#555555;width:80%;">';
		  while ($data = mysql_fetch_array($request_organisateur))
		  {
			echo '<td style="background-color:#555555;">'.$data['prenom'].'</td>
			  <td style="background-color:#555555;">'.$data['nom'].'</td>
			  <td style="background-color:#555555;">'.$data['tel'].'</td>
			  <td style="background-color:#555555;">"'.$data['raison'].'"</td>
			  <td style="background-color:#555555;">
				<form action="index.php?page=ajouter_a_blacklist" method="post">
				  <label name="tel" value="'.$data['tel'].'">
				  <input id="bouton_menu" type="submit" value="Bannir" />
				</form>
			  </td>';
			echo '<tr>';
		  }
		  echo '</table>';
		
	}
?>
