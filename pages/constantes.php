<?php

/** 
Author: Cresson Thomas - Lonni Besançon
Purpose: fichier contenant les constantes et fonctions utiles pour le traitement bd
Name: constantes.php
Date: 07/01/2014
**/

$step = 2;

function format_return($result){
	
	$return = '<table style="background-color:#555555;width:95%;">';
	while($row = mysql_fetch_row($result)){
		foreach($row as $element){
			$return .= '<td style="background-color:#555555;">'.$element.'</td>';
		}
		
		$return .= '<tr>';
	}
	return $return.'</table>';
}

function random($car) {
	$string = "";
	$chaine = "abcdefghijklmnpqrstuvwxy0123456789";
	
	srand((double)microtime()*1000000);
	
	for($i=0; $i<$car; $i++) {
		$string .= $chaine[rand()%strlen($chaine)];
	}
	
	return $string;
}
?>