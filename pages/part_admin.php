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
<<<<<<< HEAD
=======
  
  
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
  case 'text_management':
    include('./pages/admin/text_management.php');
  break;
  case 'sponsor_management':
    include('./pages/admin/sponsor_management.php');
  break;
<<<<<<< HEAD
  case 'ajouter_a_blacklist':
	include('./scripts/ajoutSuppressionBlackList.php');
  break;
=======
  
  case 'ajouter_a_blacklist':
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
  case 'retirer_de_blacklist':
    include('./scripts/ajoutSuppressionBlackList.php');
  break;
  case 'blacklist_management':
    include('./pages/admin/blacklist_management.php');
  break;
<<<<<<< HEAD
  case 'creerEvenement':
    include('./pages/admin/creerEvenement.php');
  break;
  case 'gererEvenement':
	include('./pages/admin/gererEvenement.php');
  break;
  case 'alias_management':
	include('./pages/admin/alias_management.php');
  break;
  case 'password_admin':
	include('./pages/admin/change_password.php');
  break;
 case 'resultat_creation_event':
	include('./pages/admin/resultat_creation_event.php');
  break;
=======
  
  case 'creer_evenement':
    include('./pages/admin/creerEvenement.php');
  break;
  case 'gerer_evenement':
	include('./pages/admin/gererEvenement.php');
  break;
  
  case 'alias_management':
	include('./pages/admin/alias_management.php');
  break;
  
  case 'password_admin':
	include('./pages/admin/change_password.php');
  break;
  
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
  default:
    include('./pages/accueil_admin.php');
  break;
}
?>