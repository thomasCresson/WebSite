<?php
	if($_SESSION['admin'] != 1) exit(-1);

    $db = mysql_select_db ($array_db['db_projet'],$cxn);
	  
	if (isset($_POST['text']))
	{
		$text = mysql_real_escape_string(htmlentities($_POST['text']));
		$query = "UPDATE variables SET value='".$text."' WHERE id='texte_accueil'";
		$result = mysql_query($query) or die(MYSQL_QUERY_ERROR.mysql_error());
		
		echo 'Texte d\'accueil mis a jour<br/><br/><a href=\'index.php?page=text_management\'>Retour</a>'; 
		
	}
	else {
		$query = "SELECT value FROM variables WHERE id='texte_accueil'";
		$request = mysql_query($query) or die(MYSQL_QUERY_ERROR.mysql_error());
		$result = mysql_fetch_array($request);
		$text=$result['value'];
		
		echo '<form action="index.php?page=text_management" method="post">
			<textarea name="text" style="width:95%;height:200px;border: 1px solid #5970B2; resize:none;">'.$text.'</textarea>
			<input id="bouton_submit" type="image" style="margin-left:5px;width:100%;height:28px;background:none;box-shadow: none;" style="width:39px;height:28px;" width="100%" height="100%" src="./images/ok.png" />
		</form>';
	}
?>