
<div style="width:100%;height:25px;">
  <div style="width:98%;height:25px;">
    <a href="index.php?page=accueil"><div id="bouton_menu" style="float:left;">Accueil</div></a>
    <?php
      if($type_account>0)
	echo '<div style="float:right;">Bienvenue Xordu !</div>';
      else 
	echo '<div style="float:right;">Bienvenue Visiteur !</div>';
    ?>
    
  </div>
</div>

<div style="width:100%;height:10px;background-color:#458AB3;margin-top:10px;margin-bottom:10px;"></div>

<div style="width:100%;height:25px;">
  <div style="width:98%;height:25px;">
    <?php
      if($type_account>0)
	echo '<a href="index.php?page=profil"><div id="bouton_menu" style="float:left;margin-right:5px;">Profil</div></a>';
    ?>
    <a href="index.php?page=classement"><div id="bouton_menu" style="float:left;margin-right:5px;">Classement</div></a>
    
    <?php
      if($type_account==0)
	echo '<a href="index.php?page=connexion"><div id="bouton_menu" style="float:right;">Connexion</div></a>';
      else 
	echo '<a href="index.php?page=deconnexion"><div id="bouton_menu" style="float:right;">Déconnexion</div></a>';
    ?>
  </div>
</div>

<div style="width:100%;height:10px;background-color:#458AB3;margin-top:10px;margin-bottom:20px;"></div>

<?php
  include('part.php');
?>

<div style="width:100%;height:10px;background-color:#458AB3;margin-top:20px;margin-bottom:20px;"></div>

<?php
  if($type_account>0)
    echo '<a href="index.php?page=connexion_admin"><div id="bouton_menu" style="">Administration</div></a>';
?>