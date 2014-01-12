
<div style="width:100%;height:200px;">
  
  <div style="float:left;width:50%;height:200px;">
    <img src="./images/telethon.png" width="100%" height="100%">
  </div>
  <div style="float:right;width:50%;height:200px;">
    <div id="title">Réseaux sociaux</div>
    <div style="width:60%;height:100px;">
      
      <div style="float:left;width:50%;height:100px;">
	<img src="./images/facebook.png" width="100%" height="100%">
      </div>
      <div style="float:right;width:50%;height:100px;">
	<img src="./images/twitter.png" width="100%" height="100%">
      </div>
    </div>
    
  </div>
</div>

<div style="width:100%;height:10px;background-color:#458AB3;margin-top:20px;margin-bottom:20px;"></div>

<div id="title">Nos partenaires</div>
<div style="width:100%;height:200px;">
    <?php
      $db = mysql_select_db ($array_db['db_projet'],$cxn);
      $sql = "SELECT nom,url,logo FROM sponsors ORDER BY nom;";
      $request = mysql_query($sql) or die(MYSQL_QUERY_ERROR.mysql_error());
      $size=200;
      $size=100/mysql_num_rows($request);
      while ($vystup = mysql_fetch_array($request))
      {
	echo '<div style="float:left;height:200px;width:'.$size.'%;background-color:purple;">';
	  echo '<img src="./images/'.$vystup['logo'].'.png" width="100%" height="100%">';
	echo '</div>';
      }
    ?>
</div>

<div style="width:100%;height:10px;background-color:#458AB3;margin-top:20px;margin-bottom:20px;"></div>

<div style="width:100%;height:400px;">
  <div style="float:left;width:50%;height:400px;">
    <div style="width:60%;height:20%;">
      <div id="title">
	Objectif<br/><br/>
	<?php echo '2556km'; ?> 
      </div>
    </div>
    <div style="width:60%;height:80%;">
      <img src="./images/tour_de_france.png" width="100%" height="100%">
    </div>
   </div>
  
  <div style="float:right;width:50%;height:400px;">
    <div style="width:60%;height:30%;">
      <div id="title">
	Avancement<br/><br/>
	<?php echo '2556km';?>
     </div>
    </div>
    <div style="width:60%;height:70%;">
      <?php 
	  $rank=0;
	  $db = mysql_select_db ($array_db['db_projet'],$cxn);
	  $sql = "SELECT NomVille,NbKm FROM cities ORDER BY NbKm;";
	  $request = mysql_query($sql) or die(MYSQL_QUERY_ERROR.mysql_error());
	  echo '<table style="background-color:#555555;width:100%;">';
	  while ($vystup = mysql_fetch_array($request))
	  {
	    $rank++;
	    echo '<td style="background-color:#666666;">'.$rank.'</td>
		  <td style="background-color:#555555;">'.$vystup['NomVille'].'</td>
		  <td style="background-color:#555555;">'.$vystup['NbKm'].' kms</td>';
	    echo '<tr>';
	  }
	  echo '</table>';
      ?> 
    </div>
  </div>
  
</div>