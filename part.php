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
  case 'classementCourse':
    include('./pages/classementCourse.php');
  break;
  case 'apropos':
    include('./pages/apropos.php');
  break;
    case 'organisation_blacklist_submit':
    include('./pages/organisation_blacklist_submit.php');
  break;  case 'event_modify':
    include('./pages/event_modify.php');
  case 'display_profil':
	include('./pages/display_profil.php');
	break;
  case 'organisation':
	include('./pages/organisation.php');
	break;
  case 'event_modify':
	 include('./pages/event_modify.php');
	 break;
  default:
    include('./pages/accueil.php');
  break;
}
?>