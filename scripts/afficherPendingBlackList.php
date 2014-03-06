<?php
	if($_SESSION['admin'] != 1) exit(-1);

	/** 
	Author: Benoit TESTU
	Purpose: récupéré les propositions de blacklistage
	Name: afflicherPendingBlackList.php
	Date: 07/01/2014
	**/
	require_once("./config.php");
<<<<<<< HEAD
	/*$db = mysql_select_db ($array_db['db_projet'],$cxn);
	$sql = "SELECT prenom,nom,users.tel FROM events,users WHERE users.tel=events.organisateur ORDER BY nom;";
	$request = mysql_query($sql) or die(MYSQL_QUERY_ERROR.mysql_error());
	echo '<div class="sep"></div>';
=======
	$db = mysql_select_db ($array_db['db_projet'],$cxn);
	$sql = "SELECT prenom,nom,users.tel FROM events,users WHERE users.tel=events.organisateur ORDER BY nom;";
	$request = mysql_query($sql) or die(MYSQL_QUERY_ERROR.mysql_error());
	echo '<div style="width:100%;height:10px;background-color:#458AB3;margin-top:20px;margin-bottom:20px;"></div>';
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
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
<<<<<<< HEAD
		echo 'Aucun ajout à la blacklist n\'est souhaité pour le moment';*/
		$db = mysql_select_db ($array_db['db_projet'],$cxn);
		//$request = mysql_query("SELECT * FROM users LEFT JOIN pendingblacklist ON pendingblacklist.Tel = users.Tel WHERE (pendingblacklist.Tel IS NULL AND VilleEvent = '".$row['VilleEvent']."' AND Tel != '".$_SESSION["username"]."')");
		$request = mysql_query("SELECT * FROM users WHERE (users.Tel IN (SELECT Tel FROM pendingblacklist))") or die(MYSQL_QUERY_ERROR.mysql_error());
		//$request = mysql_query("SELECT * FROM users WHERE (VilleEvent = '".$row['VilleEvent']."' AND Tel != '".$_SESSION["username"]."')") or die(MYSQL_QUERY_ERROR.mysql_error());
		echo '<form action="./scripts/choix_bouton.php" method="post">';
			echo '<div style="width:80%;height:350px;overflow:scroll">';
				echo '<table border="1">
					<caption>Liste des demandes de blacklist </caption>
					<tr>
						<th> Nom </th>
						<th> Prénom </th>
						<th> Ville de participation </th>
						<th> Sélection </th>
					</tr>
					';
					while($row = mysql_fetch_array($request)){
						echo '<tr>
							<td>'.$row["Nom"].'</a></td> 
							<td>'. $row["Prenom"]. '</td> 
							<td>'. $row["VilleEvent"]. '</td> 
							<td><input type = "checkbox" value"unchecked" name="demande[]">
							<input type="hidden" name="tel" value="'.$row["Tel"].'"/></td>
							<input type="hidden" name="add" value="lol">
						</tr>';
					}
				echo '</table>';
			echo '</div>';
			echo '<div style="width:100%;height:20px;">
					<input id="bouton_menu" style="width:49%;float:left; background-color:white" type="submit" name="btnAction" value="Refuser" />
				</div>';
			echo '<div style="width:100%;height:20px;">
					<input id="bouton_menu" style="width:49%;float:right; background-color:white" type="submit" name="btnAction" value="Accepter" />
			</div>';
		echo '</form>';
=======
		echo 'Aucun ajout à la blacklist n\'est souhaité pour le moment';
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
?>
