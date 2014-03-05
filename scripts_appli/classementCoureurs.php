<?php

/**
Author: Cresson Thomas - Lonni Besançon
Purpose: récupéré le classement des coureurs
Name: classementVille.php
Date: 07/01/2014
Last Modif : Lonni 09/01/2014
Ajout des commentaires sur l'utilisattion
Décommenter de la ligne if(isset($_GET["ville"])) à la else
Copier/Coller du code pour les valeurs des variables $begin et $end

Comments :
- Pour avoir le classement de tous les coureurs il ne faut pas passer de paramète en GET
- Pour avoir le classement en fonction d'un coureur (classement centré sur lui) il faut passer son téléphone en GET
(implique une variable de session pour le site et récupérer le téléphone pour le mobile)
- Pour avoir le classement en fonction d'un coureur dans sa ville, il faut passer son téléphone et ville (sans valeur) en GET
une requête récupère automatiquement sa ville pour permettre de faire le bon affichage.
**/

require_once("../config.php");
$db = mysql_select_db ($array_db['db_projet'],$cxn);

if(isset($_GET["tel"])){
$tel = $_GET["tel"];
if(isset($_GET["ville"])){
$query_ville = "SELECT VilleEvent, NbKm FROM users WHERE Tel=".$tel;
$result = mysql_query($query_ville) or die(MYSQL_QUERY_ERROR.mysql_error());
$row = mysql_fetch_row($result);
$ville = $row[0];

echo $ville;

$query_position = "SELECT users.Tel, users.NbKm FROM users LEFT OUTER JOIN blacklist ON users.Tel=blacklist.Tel WHERE blacklist.Tel IS NULL AND users.VilleEvent=".$ville." ORDER BY NbKm DESC";

$result = mysql_query($query_position) or die(MYSQL_QUERY_ERROR.mysql_error());

$position = 1;

do{
   $row = mysql_fetch_row($result); 
   
   if($row[0] == $tel)
    break;
   
   $position++;
}while($row[0] != $tel);

$max = $position;

while(mysql_fetch_row($result)){
$max++;
}

$begin = $step;
$begin_modified = false;
$end = $step;

while($position - $begin <= 1){
$begin--;
$end++;
$begin_modified = true;
}

while($position + $end >= $max){
$end--;
if(!$begin_modified){
$begin++;
$begin_modified = $position - $begin <= 1;
}
}

if($begin < 0)
$begin = 0;

if($end < 0)
$end = 0;

if($position != $max)
$position--;

if($position != 0)
$end--;

echo $position;
echo $begin;
echo $end;

$query = "SELECT users.Prenom, users.Nom, users.NbKm FROM users LEFT OUTER JOIN blacklist ON users.Tel=blacklist.Tel WHERE blacklist.Tel IS NULL AND users.VilleEvent=".$ville." ORDER BY NbKm DESC LIMIT ".($position-$begin).",".($position+$end);
}

else{
$query_position = "SELECT users.Tel, users.NbKm FROM users LEFT OUTER JOIN blacklist ON users.Tel=blacklist.Tel WHERE blacklist.Tel IS NULL ORDER BY NbKm DESC";

$result = mysql_query($query_position, $connexion);

$position = 1;

do{
   $row = mysql_fetch_row($result); 
   
   if($row[0] == $tel)
    break;
   
   $position++;
}while($row[0] != $tel);
 
$max = $position;

while(mysql_fetch_row($result)){
$max++;
}

echo " POSITION: ".$position;
echo " MAX: ".$max;

$begin = $step;
$begin_modified = false;
$end = $step;

while($position - $begin <= 1){
$begin--;
$end++;
$begin_modified = true;
}

while($position + $end >= $max){
$end--;
if(!$begin_modified){
$begin++;
$begin_modified = $position - $begin <= 1;
}
}

if($begin < 0)
$begin = 0;

if($end < 0)
$end = 0;

if($position != $max)
$position--;

if($position != 0)
$end--;

echo $position;
echo $begin;
echo $end;



$query = "SELECT users.Prenom, users.Nom, users.NbKm FROM users LEFT OUTER JOIN blacklist ON users.Tel=blacklist.Tel WHERE blacklist.Tel IS NULL ORDER BY NbKm DESC LIMIT ".($position-$begin).",".($position+$end);
}
}

else{
$query = "SELECT users.Prenom, users.Nom, users.NbKm FROM users LEFT OUTER JOIN blacklist ON users.Tel=blacklist.Tel WHERE blacklist.Tel IS NULL ORDER BY NbKm DESC";
}
$result = mysql_query($query) or die(MYSQL_QUERY_ERROR.mysql_error());
$return = format_return($result);
echo $return;
return $return;
?>