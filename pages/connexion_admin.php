<?php
echo '<div style="width:100%;height:200px;">';
echo '<div id="title" >Formulaire de connexion au compte admin <br/></div>';
if (isset($_POST['password'])) {
	$password = mysql_real_escape_string(htmlentities($_POST['password']));
	$db = mysql_select_db ($array_db['db_projet'],$cxn);
	$passwordquery = "select password('".$password."')" ; 
	$result = mysql_query($passwordquery);
	$row = mysql_fetch_row($result) ; 
	$password = $row[0] ;
	//$account_password = mysql_query("SELECT * FROM `users` WHERE `pass` = SHA1(CONCAT(UPPER('$login'),':',UPPER('$password')))");
	$account_password = mysql_query("SELECT * FROM `users` WHERE `pass` = '".$password."' and tel='0000000000'") or die(MYSQL_QUERY_ERROR.mysql_error());
	
	if(mysql_num_rows($account_password) > 0)
	{
		$_SESSION['admin'] = 1;
				
		echo '
		<script language="javascript"> 
			document.location.href="index.php?page=accueil" 
		</script>';
	}else
	{
		echo '
		<script language="javascript"> 
			alert("Erreur : Le mot de passe choisi est invalide ...");
			document.location.href="index.php?page=connexion_admin" 
		</script>';
	}
}
 else if($admin==1) {
	echo '
		<script language="javascript"> 
			document.location.href="index.php?page=accueil"
		</script>';			
  }
  else {
    echo '
	  <div style="width:179px;height:40px;padding-top:5px;">
		  <form action="index.php?page=connexion_admin" method="post">
		    <input type="password" style="width:100%;margin-bottom:10px;"  name="password" value="admin"/>
		    <input id="bouton_connexion" type="image" style="margin-left:5px;width:100%;height:28px;background:none;box-shadow: none;" style="width:39px;height:28px;" width="100%" height="100%" src="./images/ok.png" />
		  </form>
	  </div>';
  }
echo '</div>';
?>