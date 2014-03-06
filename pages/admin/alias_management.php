<?php
	/** 
	Author: Benoit TESTU
	Purpose: se connecter sous un compte organisateur
	Name: alias_management.php
	Date: 05/03/2014
	**/

	if($_SESSION['admin'] != 1) exit(-1);
	
	if(isset($_POST["alias"])) {
		// on recupere l'organisateur
		list($organisateur_name,$organisateur_tmp) = split(" - ", $_POST['organisateur'], 2);
		$organisateur=mysql_real_escape_string(htmlentities($organisateur_tmp));
			
		$_SESSION['admin'] = 0;
		$_SESSION['login'] = TRUE;
		$_SESSION['id'] = $organisateur;
		$Idp = $_SESSION['id'];
		$_SESSION['username'] = $organisateur;
		$_SESSION['type']= 1;
		echo "Vous êtes maintenant connecté sous l\'identité de '".$organisateur_name."'","<br/><br/><a href='index.php'>Retour</a>";
	}
	else {
		echo 'Connexion en tant qu\'organisateur';
		echo '<form action="index.php?page=alias_management" method="post">
			<label>Prendre l\'identité de : </label>
			<SELECT id="organisateur" name="organisateur" size="1">';
			$db = mysql_select_db ($array_db['db_projet'],$cxn);
			$sql = "SELECT nom,prenom,tel FROM users WHERE tel!='0000000000' AND (EXISTS (SELECT nomville FROM events WHERE organisateur=users.tel)) AND !(EXISTS (SELECT tel FROM blacklist WHERE blacklist.tel=users.tel)) ORDER BY nom,prenom;";
			$request = mysql_query($sql) or die(MYSQL_QUERY_ERROR.mysql_error());
			while ($vystup = mysql_fetch_array($request))
			{
				echo '<OPTION>'.$vystup['nom'].' '.$vystup['prenom'].' - '.$vystup['tel'].'</option>';
			}
			echo '</SELECT>
			<input name="alias" id="bouton_menu" type="submit" value="Alias" />
		</form>';
	}
?>