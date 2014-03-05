<?php

	/** 
	Author: Benoit TESTU
	Purpose: récupéré la blacklist
	Name: afflicherBlackList.php
	Date: 07/01/2014
	**/

	require_once(($site==1?"./config.php":"../config.php"));
	$db = mysql_select_db ($array_db['db_projet'],$cxn);
	  $sql = "SELECT prenom,nom,users.tel FROM users,blacklist WHERE users.tel=blacklist.tel ORDER BY nom;";
	  $request = mysql_query($sql) or die(MYSQL_QUERY_ERROR.mysql_error());
	  echo '<table style="background-color:#555555;width:80%;">';
	  while ($vystup = mysql_fetch_array($request))
	  {
		echo '<td style="background-color:#555555;">'.$vystup['prenom'].'</td>
		  <td style="background-color:#555555;">'.$vystup['nom'].'</td>
		  <td style="background-color:#555555;">'.$vystup['tel'].'</td>
		  <td style="background-color:#555555;">
			<form action="index.php?page=retirer_de_blacklist" method="post">
			  <label name="tel" value="'.$vystup['tel'].'">
			  <input id="bouton_menu" type="submit" value="Débannir" />
			</form>
		  </td>';
		echo '<tr>';
	  }
	  echo '</table>';
?>
