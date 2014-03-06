<<<<<<< HEAD
<?php
	// requete sql
	$db = mysql_select_db ($array_db['db_projet'],$cxn);
	$request = mysql_query("SELECT cities.NomVille, cities.CP, cities.NbKm FROM cities JOIN events ON cities.NomVille=events.NomVille ORDER BY NbKm DESC") or die(MYSQL_QUERY_ERROR.mysql_error());
	
	echo'<div id="title"> Classement National </div>';
	echo '<div style="width:80%;height:250px;overflow:scroll">';
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

=======
<?php 
    echo 'classement coureurs<br/>';
    include('./scripts/classementCoureurs.php');
    echo 'classement villes<br/>';
    include('./scripts/classementVille.php');
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
?>