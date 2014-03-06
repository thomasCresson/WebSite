<<<<<<< HEAD
<div style="width:100%;height:800px;">

<div style="float:left;width:50%;height:800px;">

	<img src="./images/Logo3.png" height="100px" style="margin-bottom:20px">
    <div id="title">
		Qu’est-ce que le PRT ?
    </div>
    <div style="width:70%; margin-bottom:20px; text-align: justify; line-height:20px">
		Le <b>"Polytech Roule pour le Téléthon" </b> est un événement sportif à caractère humanitaire organisé par <b>la Fédé Polytech</b>. 
		Le jour du Téléthon, dans chaque ville du réseau Polytech (<b>17 au total</b>), les BDE mettent en place un parcours vélo et incitent les étudiants à venir faire du vélo avec pour devise <b>1km = 1€</b> pour le Téléthon. 
		Le but est de parcourir la distance permettant de <b>relier toutes les écoles du réseau</b>. 
    </div>
	
	<img src="./images/tour_de_france.png" height="300px" style="margin-bottom:20px">
</div>

<div style="float:left;width:50%;height:800px;">
	<div id="title">
		Objectif
    </div>
	<div class="digit" style="font-size:80px; margin-bottom:20px">
		2660 KM
    </div>
	<div id="title">
		Avancement
	</div>
	<div class="digit" style="margin-bottom:20px; font-size:80px;">
		<?php
	 $db = mysql_select_db ($array_db['db_projet'],$cxn);
	$request = mysql_query("SELECT * FROM cities ORDER BY NbKm DESC") or die(MYSQL_QUERY_ERROR.mysql_error());
	$total = 0;
	while($row_city = mysql_fetch_array($request)){
		$total = $total + $row_city["NbKm"];
	}
	echo $total.' KM';
	?>
     </div>
	 <?php
	 $db = mysql_select_db ($array_db['db_projet'],$cxn);
	$request = mysql_query("SELECT * FROM cities ORDER BY NbKm DESC LIMIT 3") or die(MYSQL_QUERY_ERROR.mysql_error());
	echo'<div id="title"> Podium Classement National </div>';
	echo '<div style="width:80%;height:140px;">';
		$rang = 1;
		echo '<table border="1">
			<tr>
				<th> Rang </th>
				<th> Ville </th>
				<th> Code postal </th>
				<th> Kilomètres validés </th>
			</tr>
			';
			while($row_city = mysql_fetch_array($request)){
				echo '<tr>
					<td>'. $rang.'</td> 
					<td><a href = "index.php?page=classementCourse&nomVille='.$row_city["NomVille"].'">'.$row_city["NomVille"].'</a></td> 
					<td>'. $row_city["CP"]. '</td> 
					<td>'. $row_city["NbKm"].'</td>
				</tr>';
				$rang++;

			}
		echo '</table>';
	echo '</div>';
      ?> 

</div>


=======

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
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
  
</div>