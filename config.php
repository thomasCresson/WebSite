<?php
<<<<<<< HEAD
/* Identifiants MySQL */
/*$array_db = array(
	"host"			=> "37.59.51.145",		// Hôte MySQL
	"user"			=> "merle",		// Nom d'utilisateur MySQL
	"pass"			=> "Pwipwi77",			// Mot de passe de l'uilisateur MySQL
	"db_projet" 		=> "projet_gl",
);*/

$array_db = array(
	"host"			=> "localhost",		// Hôte MySQL
	"user"			=> "root",		// Nom d'utilisateur MySQL
	"pass"			=> "",			// Mot de passe de l'uilisateur MySQL
	"db_projet" 		=> "gl",
=======

/** 
Author: Cresson Thomas - Lonni Besançon - Benoit Testu
Purpose: fichier contenant les constantes et fonctions utiles pour le traitement bd
Name: constantes.php
Date: 07/01/2014
**/

$step = 2;

function format_return($result){
 $return = "";
 while($row = mysql_fetch_row($result)){
  foreach($row as $element){
   $return .= $element.',';
  }
  
  $return = substr(0, strlen($return) - 1);
  $return .= "\n";
 }
 $return = substr(0, strlen($return) - 1);
 return $return;
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


/* Identifiants MySQL */
$array_db = array(
	"host"			=> "37.59.51.145",		// Hôte MySQL
	"user"			=> "projet_gl",		// Nom d'utilisateur MySQL
	"pass"			=> "Polytech2014",			// Mot de passe de l'uilisateur MySQL
	"db_projet" 		=> "projet_gl",
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
);

/* Connexion || NE PAS TOUCHER */
$cxn = mysql_connect($array_db['host'],$array_db['user'],$array_db['pass']);
if (!$cxn) {
   die('Erreur : ' . mysql_error()); // Affichage de l'erreur
}
?>
