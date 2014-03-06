<?php
<<<<<<< HEAD
echo '<div style="width:100%;height:200px;">';
echo '<div id="title" > Formulaire de connexion a un compte utilisateur <br/> </div>';
=======

echo '<div style="width:100%;height:200px;">';
echo 'Formulaire de connexion a un compte utilisateur <br/>';
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
if(!$_SESSION['login']) $_SESSION['login'] = FALSE;
	if (isset($_POST['login']))
	{
		if(!empty($_POST['login']) AND !empty($_POST['password']))
		{
			$login = mysql_real_escape_string(htmlentities($_POST['login']));
			$password = mysql_real_escape_string(htmlentities($_POST['password']));
					
<<<<<<< HEAD
			/* Sélection de la base de données des comptes */			
=======
			/* Sélection de la base de données des comptes */
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
			$db = mysql_select_db ($array_db['db_projet'],$cxn);
			$passwordquery = "select password('".$password."')" ; 
			$result = mysql_query($passwordquery);
			$row = mysql_fetch_row($result) ; 
			$password = $row[0] ;
<<<<<<< HEAD
=======
			
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
			$account_username = mysql_query("SELECT * FROM `users` WHERE `tel` = '".$login."'") or die(MYSQL_QUERY_ERROR.mysql_error());
			$row_account_username = mysql_fetch_array($account_username);
			$account_banned_id = mysql_query("SELECT * FROM `blacklist` WHERE `tel` = '".$row_account_username['tel']."'");
			$row_account_banned_id = mysql_fetch_array($account_banned_id);
			
			if(mysql_num_rows($row_account_banned_id) == 0)
			{
				if(mysql_num_rows($account_username) > 0)
				{
					//$account_password = mysql_query("SELECT * FROM `users` WHERE `pass` = SHA1(CONCAT(UPPER('$login'),':',UPPER('$password')))");
					 $account_password = mysql_query("SELECT * FROM `users` WHERE `pass` = '".$password."' and tel='".$login."'") or die(MYSQL_QUERY_ERROR.mysql_error());

					if(mysql_num_rows($account_password) > 0)
					{
						$_SESSION['login'] = TRUE;
<<<<<<< HEAD
						$_SESSION['id'] = $row_account_username['tel'];
=======
						$_SESSION['id'] = $row_account_username['id'];
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
						$Idp = $_SESSION['id'];
						$_SESSION['username'] = $login;
						// on teste si il est organisateur
						$organisateur_request = mysql_query("SELECT * FROM `events` WHERE `organisateur` = '".$login."'") or die(MYSQL_QUERY_ERROR.mysql_error());
<<<<<<< HEAD
						if(mysql_num_rows($organisateur_request) > 0)
=======
						if(mysql_num_rows($organisateur_request) == 0)
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
						  $_SESSION['type']= 2;
						else
						  $_SESSION['type']= 1;
								
<<<<<<< HEAD
						     
						header('Location: index.php?page=display_profil&tel='.$login);     

=======
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
						echo '
						<script language="javascript"> 
							document.location.href="index.php?page=home" 
						</script>';
<<<<<<< HEAD
						
=======
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
					}else
					{
						echo '
						<script language="javascript"> 
							alert("Erreur : Le pseudo ou le mot de passe choisis est invalide ...");
							document.location.href="index.php?page=connexion" 
						</script>';
					}
				}else
				{
					echo '
					<script language="javascript"> 
						alert("Erreur : Le pseudo ou le mot de passe choisis est invalide ...");
						document.location.href="index.php?page=connexion" 
					</script>';
				}
			}else
			{
				echo '
				<script language="javascript"> 
					alert("Compte banni!");
<<<<<<< HEAD
					document.location.href="index.php?page=accueil" 
=======
					document.location.href="index.php?page=Accueil" 
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
				</script>';
			}
		}else
		{
			echo '
			<script language="javascript"> 
				alert("Erreur : Tous les champs ne sont pas remplis !");
				document.location.href="index.php?page=connexion" 
			</script>';
		}
	}else
	{
		echo '
			<div style="width:179px;height:40px;padding-top:5px;">
				<form action="index.php?page=connexion" method="post">
				  <input type="text" style="width:100%;margin-bottom:10px;" name="login" value="username" /><br />
<<<<<<< HEAD
				  <input type="password" style="width:100%;margin-bottom:10px;"  name="password" />
=======
				  <input type="password" style="width:100%;margin-bottom:10px;"  name="password" value="password" />
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
				  <input id="bouton_connexion" type="image" style="margin-left:5px;width:100%;height:28px;background:none;box-shadow: none;" style="width:39px;height:28px;" width="100%" height="100%" src="./images/ok.png" />
				</form>
				<a href="index.php?page=recover">Forgotten password ?</a>
			</div>';
	}
echo '</div>';
?>
