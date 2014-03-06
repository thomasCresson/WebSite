<?php
	if($_SESSION['admin'] != 1) exit(-1);

	/** 
	Author: Benoit TESTU
	Purpose: récupéré la blacklist
	Name: afflicherBlackList.php
	Date: 07/01/2014
	**/

<<<<<<< HEAD
	require_once(($site==1?"./config.php":"./config.php"));
=======
	require_once(($site==1?"./config.php":"../config.php"));
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
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
				<input name="tel" id="bouton_menu" type="hidden" value="'.$vystup['tel'].'" />
				<input name="deban" id="bouton_menu" type="submit" value="Débannir" />
			</form>
		  </td>';
		echo '<tr>';
	  }
	  echo '</table>';
?>
