<?php
	require 'config.php';
	require 'constantes.php';
	$db = mysql_select_db ($array_db['db_projet'],$cxn);

		if(isset($_GET["nomVille"])){
		$city = $_GET["nomVille"];		
			
			$query = "SELECT users.Tel, users.Prenom, users.Nom, users.VilleEvent, users.NbKm FROM users LEFT OUTER JOIN blacklist ON users.Tel=blacklist.Tel WHERE blacklist.Tel IS NULL AND users.VilleOrigine='".$city."' ORDER BY NbKm DESC ";
			$result = mysql_query($query) or die(MYSQL_QUERY_ERROR.mysql_error());
			
			echo '<div id="title"> Classement des participants de la ville '.$city.' </div>';
			echo '<div style="width:80%;height:400px;overflow:scroll">';
				echo '<table border="1">
					<tr>
						<th> Rang </th>
						<th> Nom </th>
						<th> Prénom </th>
						<th> Ville de participation </th>
						<th> Kilomètres validés </th>
					</tr>
					';
					$rang = 1;
					while($row = mysql_fetch_array($result)){
						echo '<tr> 
							<td>'. $rang.'</td> 
							<td><a href = "index.php?page=display_profil&tel='.$row["Tel"].'">'.$row["Nom"].'</a></td> 
							<td>'. $row["Prenom"]. '</td> 
							<td>'. $row["VilleEvent"]. '</td> 
							<td>'. $row["NbKm"].'</td>
							
						</tr>';
						$rang++;
					}
				echo '</table>';
			echo '</div>';

}

?>