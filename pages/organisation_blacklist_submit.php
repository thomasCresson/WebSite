<?php

	// requete sql
	$db = mysql_select_db ($array_db['db_projet'],$cxn);
	$request_event = mysql_query("SELECT VilleEvent FROM users WHERE Tel = '".$_SESSION["username"]."'") or die(MYSQL_QUERY_ERROR.mysql_error());
	$row = mysql_fetch_array($request_event);
	if(mysql_num_rows($request_event) == 1){
		//$request = mysql_query("SELECT * FROM users LEFT JOIN pendingblacklist ON pendingblacklist.Tel = users.Tel WHERE (pendingblacklist.Tel IS NULL AND VilleEvent = '".$row['VilleEvent']."' AND Tel != '".$_SESSION["username"]."')");
		$request = mysql_query("SELECT * FROM users WHERE (users.Tel NOT IN (SELECT Tel FROM pendingblacklist) AND VilleEvent = '".$row['VilleEvent']."' AND Tel != '".$_SESSION["username"]."')") or die(MYSQL_QUERY_ERROR.mysql_error());
		//$request = mysql_query("SELECT * FROM users WHERE (VilleEvent = '".$row['VilleEvent']."' AND Tel != '".$_SESSION["username"]."')") or die(MYSQL_QUERY_ERROR.mysql_error());
		echo '<form action="./scripts/ajoutSuppressionPendingBlacklist.php?add=" method="post">';
			echo '<div style="width:80%;height:350px;overflow:scroll">';
				echo '<table border="1">
					<caption>Liste des participants à votre course </caption>
					<tr>
						<th> Nom </th>
						<th> Prénom </th>
						<th> Ville de Rattachement </th>
						<th> Sélection </th>
					</tr>
					';
					while($row_user = mysql_fetch_array($request)){
						echo '<tr>
							<td>'.$row_user["Nom"].'</a></td> 
							<td>'. $row_user["Prenom"]. '</td> 
							<td>'. $row_user["VilleOrigine"]. '</td> 
							<td><input type = "checkbox" value"unchecked" name="demande[]">
							<input type="hidden" name="tel" value="'.$row_user["Tel"].'"/></td>
						</tr>';
					}
				echo '</table>';
			echo '</div>';
			echo '<div style="width:100%;height:20px;">
					<input id="bouton_menu" style="width:49%;float:center; background-color:white" type="submit" value="Demande de blacklist des sélectionnés" />
				</div>';
		echo '</form>';	
	}
?>