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
  
  
  case 'text_management':
    include('./pages/admin/text_management.php');
  break;
  case 'sponsor_management':
    include('./pages/admin/sponsor_management.php');
  break;
  
  
  case 'blacklist_management':
    include('./pages/admin/blacklist_management.php');
  break;
  
  default:
    include('./pages/accueil_admin.php');
  break;
}
?>