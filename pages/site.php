<div id="scroller_container" style="width=90%">
	<div id="scroller">
	
	<?php
      
	  $db = mysql_select_db ($array_db['db_projet'],$cxn);
      $sql = "SELECT nom,url,logo FROM sponsors ORDER BY nom;";
      $request = mysql_query($sql) or die(MYSQL_QUERY_ERROR.mysql_error());

      while ($vystup = mysql_fetch_array($request))
      {
		echo '<div style="float:left;height:75px;width:100px;background-color:white; margin-left:100px;">';
		  echo '<a href = "http://'.$vystup['url'].'" target="_blank"> <img src="./images/'.$vystup['logo'].'.png" width="100%" height="100%"/></a>';
		echo '</div>';
      }
	  
	  
    ?>
	</div>
</div>
     <script type="text/javascript">
      $(document).ready(function(){
      $jScroller.config.refresh = 10;
       // Add Scroller Object
       $jScroller.add("#scroller_container","#scroller","left",1);

       // Start Autoscroller
	   $jScroller.start();
	  });
     </script>

<div class='sep'></div>

<div style="width:100%;height:25px;">
  <div style="width:98%;height:25px;">
    <a href="index.php?page=accueil"><div id="bouton_menu" style="float:left; margin-left: 30px">Accueil</div></a>
	
		
	<a href="http://www.facebook.com/federationpolytech"><img src="./images/fb_prt.png" width="25px" height="25px" style="float:right; margin-left:10px"></a>
	<a href="http://twitter.com/Fede_Polytech"><img src="./images/tw_prt.png" width="25px" height="25px" style="float:right; margin-left:10px"></a>
	
	<?php
	echo '<div style="float:right; font-size:12px; margin-left:150px; margin-top: 5px">Suivez-nous sur les réseaux sociaux ! </div>';
	?>
	
    <?php
      if($type_account>0)
	echo '<div style="float:right; font-size: 24px">Bienvenue Xordu !</div>';
      else 
	echo '<div style="float:right; font-size: 24px">Bienvenue Visiteur !</div>';
    ?>
    

  </div>
</div>

<div class='sep'></div>

<div style="width:100%;height:25px;">
  <div style="width:98%;height:25px;">
	
	<a href="index.php?page=classement"><div id="bouton_menu" style="float:left;margin-left:30px;">Classement</div></a>
	<a href="index.php?page=apropos"><div id="bouton_menu" style="float:left;margin-left:30px;">A Propos</div></a>
    
    <?php
      if($type_account==0)
	echo '<a href="index.php?page=connexion"><div id="bouton_menu" style="float:right;">Connexion</div></a>';
      else 
	echo '<a href="index.php?page=deconnexion"><div id="bouton_menu" style="float:right;">Déconnexion</div></a>';
    ?>
	
	<?php
      if($type_account==2)
	 {
	echo '<a href="index.php?page=organisation"><div id="bouton_menu" style="float:left;margin-left:30px;">Organisation</div></a>';
	echo '<a href="index.php?page=organisation_blacklist_submit"><div id="bouton_menu" style="float:left;margin-left:30px;">Blacklist</div></a>';
	}
    ?>
  </div>
</div>

<div class='sep'></div>

<?php
  include('part.php');
?>

<footer style="line-height:20px; background-color:white">

		<div class='sep'></div>

		<?php
			echo '<a href="index.php?page=connexion_admin"><div id="bouton_menu" style="">Administration</div></a>';
		?>
		<div class='sep'></div>
		<div style="width:50%; float:left" >
			<a href="http://fede-polytech.org/">Fédération des Elèves du Réseau Polytech</a><br />
            C/O Polytech Lille<br />
            Avenue Paul Langevin<br />
            59655 - Villeneuve d'Ascq Cedex        
		</div>
        <div style="width:50%; float:right">
			<a href="http://www.polytech-reseau.org" target="_blank">Réseau Polytech</a><br />
            <a href="mailto:contact@fede-polytech.org">contact@fede-polytech.org</a><br />
            <a href="http://facebook.fede-polytech.org" target="_blank">Facebook</a><br />
            <a href="http://twitter.fede-polytech.org" target="_blank">Twitter</a><br />
		</div>
        <div>&copy; 2014 - Tous droits réservés.</div>
</footer>

<div class='sep'></div>
