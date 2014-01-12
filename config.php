<?php
/* Identifiants MySQL */
$array_db = array(
	"host"			=> "37.59.51.145",		// Hôte MySQL
	"user"			=> "merle",		// Nom d'utilisateur MySQL
	"pass"			=> "Pwipwi77",			// Mot de passe de l'uilisateur MySQL
	"db_projet" 		=> "projet_gl",
);

/* Connexion || NE PAS TOUCHER */
$cxn = mysql_connect($array_db['host'],$array_db['user'],$array_db['pass']);
if (!$cxn) {
   die('Erreur : ' . mysql_error()); // Affichage de l'erreur
}
?>
