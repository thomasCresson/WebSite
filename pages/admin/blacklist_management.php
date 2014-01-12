<?php
  echo 'Liste des comptes blacklistés';
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
      
  echo '<div style="width:100%;height:10px;background-color:#458AB3;margin-top:20px;margin-bottom:20px;"></div>';
    
  
  echo 'Proposition de blacklistage';
  $db = mysql_select_db ($array_db['db_projet'],$cxn);
  $sql = "SELECT prenom,nom,users.tel FROM events WHERE users.tel=events.organisateur ORDER BY nom;";
  $request = mysql_query($sql) or die(MYSQL_QUERY_ERROR.mysql_error());
  echo '<table style="background-color:#555555;width:80%;">';
  while ($vystup = mysql_fetch_array($request))
  {
    
    echo 'Liste des comptes proposés par '.$vystup['prenom'].' '.$vystup['nom'].' au blacklistage';
  }
?>