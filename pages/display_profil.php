

<?php
	// requete sql
	$db = mysql_select_db ($array_db['db_projet'],$cxn);
	
	if(isset($_GET["tel"])){
		$tel = $_GET["tel"];
		$request = mysql_query("SELECT * FROM users WHERE Tel = '".$tel."'") or die(MYSQL_QUERY_ERROR.mysql_error());
		$row_user = mysql_fetch_array($request);
		echo '<div style="width:80%;height:140px;">';
		if(mysql_num_rows($request) == 1)
		{

		echo '
		<div style="width:100%;height:120px;">		
			<span>Téléphone : '.$row_user['Tel'].'</span>
			<br/>
			<span>Nom : '.$row_user['Nom'].'</span>
			<br/>
			<span>Prénom : '.$row_user['Prenom'].'</span>
			<br/>
			<span>Email : '.$row_user['Email'].'</span>
			<br/>
			<span>Ville de rattachement : '.$row_user['VilleOrigine'].'</span>
			<br/>
			<span>Ville de participation : '.$row_user['VilleEvent'].'</span>
			<br/>
			<p> Pour modifier vos informations veuillez vous connecter depuis votre smartphone. Merci! </p>
		</div>
		';
		echo '</div>';
	}
	else{
		echo 'hihihi';
	}
  }
?>