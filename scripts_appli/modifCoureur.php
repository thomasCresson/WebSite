<?php
	require_once("../config.php");
	$db = mysql_select_db ($array_db['db_projet'],$cxn);
	
	$oldPass = $_POST["oldPass"];
	unset($_POST["oldPass"]);
	$tel = $_POST["tel"];
	unset($_POST["tel"]);
	
	$queryPass = "select pass from users where tel='".$tel."'";
	$queryOldPass = "select SHA2('".$oldPass."', 0)";
	
	$result = mysql_query($queryPass);
	$result1 = mysql_query($queryOldPass);
	
	$row = mysql_fetch_row($result);
	$row1 = mysql_fetch_row($result1);
	
	if(!$row[0] == $row1[0]){
		$return = -1;
	}
	
	else{
		$queryOrga = "select nomville from event where organisateur='".$tel."'";
		$result = mysql_query($queryOrga);
		$row = mysql_fetch_row($result);
		$isOrga = $row[0] != "";
		
		if($isOrga){
			if($_POST["villeEvent"] != $_POST["villeOrigine"]){
				$return = -2;
			}
		}
		
		if(!isset($return)){
			$insertValues = "";
			
			foreach($_POST as $key => $value){
				$insertValues .= $key."='".htmlentities($value)."',";
			}
			
			$insertValues = substr($insertValues, 0, strlen($insertValues)-1);
			
			$queryUpdate = "update users set ".$insertValues." where tel='".$tel."'";
			mysql_query($queryUpdate);
			$return = mysql_affected_rows();
		}
	}
	
	echo $return;
	mysql_close($cxn);
?>