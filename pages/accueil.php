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


  
</div>