<div style="width:100%;height:25px;">
  <div style="width:98%;height:25px;">
    <a href="index.php?page=accueil"><div id="bouton_menu" style="float:left;">Accueil</div></a>
    <div style="float:right;">Bienvenue sur le panneau d'administration</div>
  </div>
</div>

<<<<<<< HEAD
<div class='sep'></div>

<div style="width:100%;height:35px;">
  <div style="width:98%;height:35px;">
      <ul id="sddm">
      <li style="width:15%;"><a href="#" 
=======
<div style="width:100%;height:10px;background-color:#458AB3;margin-top:10px;margin-bottom:10px;"></div>

<div style="width:100%;height:25px;">
  <div style="width:98%;height:25px;">
      <ul id="sddm">
      <li style="width:20%;"><a href="#" 
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
	  onmouseover="mopen('m1')" 
	  onmouseout="mclosetime()">Gestion de la page d'accueil</a>
	  <div id="m1" style="width:17%;"
	      onmouseover="mcancelclosetime()" 
	      onmouseout="mclosetime()">
	  <a href="index.php?page=text_management">Modifier texte d'accueil</a>
	  <a href="index.php?page=sponsor_management">Gérer les sponsors</a>
	  </div>
      </li>
<<<<<<< HEAD
      <li style="width:15%;"><a href="#" 
=======
      <li style="width:20%;"><a href="#" 
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
	  onmouseover="mopen('m2')" 
	  onmouseout="mclosetime()">Gestion des évènements</a>
	  <div id="m2" style="width:17%;"
	      onmouseover="mcancelclosetime()" 
	      onmouseout="mclosetime()">
<<<<<<< HEAD
	  <a href="index.php?page=creerEvenement">Créer un évènement</a>
	  <a href="index.php?page=gererEvenement">Gérer un évènement</a>
	  </div>
      </li>
      <li style="width:15%;"><a href="index.php?page=blacklist_management">Gestion de la blacklist</a></li>
	  <li style="width:15%;"><a href="index.php?page=alias_management">Se connecter comme</a></li>
      <li style="width:15%;"><a href="index.php?page=password_admin">Changer MDP</a></li>
=======
	  <a href="index.php?page=creer_evenement">Créer un évènement</a>
	  <a href="index.php?page=gerer_evenement">Gérer un évènement</a>
	  </div>
      </li>
      <li style="width:15%;"><a href="index.php?page=blacklist_management">Gestion de la blacklist</a></li>
      <li style="width:15%;"><a href="index.php?page=alias_management">Se connecter comme</a></li>
      <li style="width:15%;"><a href="index.php?page=password_admin">Changer MdP</a></li>
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c
      <li style="width:15%;"><a href="index.php?page=deconnexion_admin">Deconnexion</a></li>
  </ul>
  <div style="clear:both"></div>
  </div>
</div>

<<<<<<< HEAD
<div class='sep'></div>
=======
<div style="width:100%;height:10px;background-color:#458AB3;margin-top:10px;margin-bottom:20px;"></div>
>>>>>>> 3d5404dc803e0cef8cbbe87c184a88c6b73a194c

<?php
  include('part_admin.php');
?>

<script type="text/javascript">
  // Copyright 2006-2007 javascript-array.com

  var timeout	= 500;
  var closetimer	= 0;
  var ddmenuitem	= 0;

  // open hidden layer
  function mopen(id)
  {	
	  // cancel close timer
	  mcancelclosetime();

	  // close old layer
	  if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';

	  // get new layer and show it
	  ddmenuitem = document.getElementById(id);
	  ddmenuitem.style.visibility = 'visible';

  }
  // close showed layer
  function mclose()
  {
	  if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
  }

  // go close timer
  function mclosetime()
  {
	  closetimer = window.setTimeout(mclose, timeout);
  }

  // cancel close timer
  function mcancelclosetime()
  {
	  if(closetimer)
	  {
		  window.clearTimeout(closetimer);
		  closetimer = null;
	  }
  }

  // close layer when click-out
  document.onclick = mclose; 
</script>