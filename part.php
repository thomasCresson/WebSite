<?php
if($_GET['page']) $page = strip_tags($_GET['page']);
else $page="home";

switch($page) {
  case 'deconnexion':
    include('./pages/deconnexion.php');
  break;
  case 'connexion':
    include('./pages/connexion.php');
  break;
  case 'deconnexion_admin':
    include('./pages/deconnexion_admin.php');
  break;
  case 'connexion_admin':
    include('./pages/connexion_admin.php');
  break;
  case 'classement':
    include('./pages/classement.php');
  break;
  default:
    include('./pages/accueil.php');
  break;
}
?>