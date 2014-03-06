<?php
	if($_SESSION['admin'] != 1) exit(-1);

	/** 
	Author: Benoit TESTU
	Purpose: récupéré les propositions de blacklistage
	Name: afflicherPendingBlackList.php
	Date: 07/01/2014
	**/
	require_once("./config.php");
	$db = mysql_select_db ($array_db['db_projet'],$cxn);
	$sql = "SELECT prenom,nom,users.tel FROM events,users WHERE users.tel=events.organisateur ORDER BY nom;";
	$request = mysql_query($sql) or die(MYSQL_QUERY_ERROR.mysql_error());
	echo '<div style="width:100%;height:10px;background-color:#458AB3;margin-top:20px;margin-bottom:20px;"></div>';
	$count=0;
	while ($vystup = mysql_fetch_array($request))
	{
		$sql_organisateur = "SELECT prenom,nom,organisateur,pendingBlacklist.tel,raison FROM pendingBlacklist,users WHERE organisateur='".$vystup['tel']."' AND pendingBlacklist.tel=users.tel;";
		$request_organisateur = mysql_query($sql_organisateur) or die(MYSQL_QUERY_ERROR.mysql_error());
		if(mysql_num_rows($request_organisateur)==0) continue;
		$count++;
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
				  <input name="organisateur" id="bouton_menu" type="hidden" value="'.$data['organisateur'].'" />
				  <input name="tel" id="bouton_menu" type="hidden" value="'.$data['tel'].'" />
				  <input name="ban" id="bouton_menu" type="submit" value="Bannir" />
				  <input name="unpending" id="bouton_menu" type="submit" value="Refuser" />
				</form>
			  </td>';
			echo '<tr>';
		  }
		  echo '</table>';
		
	}
	if($count==0)
		echo 'Aucun ajout à la blacklist n\'est souhaité pour le moment';
?>
