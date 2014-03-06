<?php
	if($_SESSION['admin'] != 1) exit(-1);
	
	/** 
	Author: Benoit TESTU
	Purpose: changer le mot de passe de l'administrateur
	Name: change_password.php
	Date: 05/03/2014
	**/
	
	if(isset($_POST["new"])) {
		try {
			$db = mysql_select_db ($array_db['db_projet'],$cxn);
		
			$current = mysql_real_escape_string(htmlentities($_POST['current']));
			$new = mysql_real_escape_string(htmlentities($_POST['new']));
			$new2 = mysql_real_escape_string(htmlentities($_POST['new2']));
			
			
			$query = "SELECT pass as pass FROM users WHERE tel='0000000000'";
			$request = mysql_query($query) or die(MYSQL_QUERY_ERROR.mysql_error());
			$result = mysql_fetch_array($request);
			$old_pass=$result['pass'];
			
			$passwordquery = "select password('".$current."')" ; 
			$result_sha = mysql_query($passwordquery);
			$row_sha = mysql_fetch_row($result_sha) ; 
			$current_sha = $row_sha[0] ;
			
			if($current_sha!=$old_pass) {
				throw new Exception('Le mot de passe saisi est incorrect');
			}
			
			if($new!=$new2) {
				throw new Exception('Les mots de passe ne correspondent pas');
			}
			
			$query = "UPDATE users SET pass=password('".$new."') WHERE tel='0000000000'";
			$request = mysql_query($query) or die(MYSQL_QUERY_ERROR.mysql_error());
			
			throw new Exception('Le mot de passe de l\'administrateur a été changé');
		} catch (Exception $e) {
			echo $e->getMessage(),"<br/><br/><a href='index.php?page=password_admin'>Retour</a>";
		}
	}
	else {
		echo '
		<form action="index.php?page=password_admin" method="post">
			<div>
				<label for="current">Password actuel :</label>
				<input type="password" name="current"/>
			</div>
			<div>
				<label for="new">Nouveau Password :</label>
				<input type="password" name="new"/>
			</div>
			<div>
				<label for="new2">Repeter Password :</label>
				<input type="password" name="new2"/>
			</div>
			<input name="mdp" id="bouton_menu" type="submit" value="Changer le mot de passe" />
		</form>
		';
	}
?>