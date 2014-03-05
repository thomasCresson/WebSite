<?php
	if($_SESSION['admin'] != 1) exit(-1);
?>
<div style="width:100%;height:200px;">
    <?php
      $db = mysql_select_db ($array_db['db_projet'],$cxn);
      $sql = "SELECT ID,nom,url,logo FROM sponsors ORDER BY nom;";
      $request = mysql_query($sql) or die(MYSQL_QUERY_ERROR.mysql_error());
      $size=200;
      $size=100/mysql_num_rows($request);
      while ($vystup = mysql_fetch_array($request))
      {
	echo '<a href="index.php?page=sponsor_management&sponsor='.$vystup['ID'].'">';
	echo '<div style="float:left;height:200px;width:'.$size.'%;background-color:purple;">';
	  echo '<img src="./images/'.$vystup['logo'].'.png" width="100%" height="100%">';
	echo '</div>';
	echo '</a>';
      }
    ?>
</div>

<?php
  if($_GET['sponsor']) 
    $sponsor = strip_tags($_GET['sponsor']);
  else
    $sponsor=0;
    
  if(!($sponsor>0))
    $sponsor=0;
    
  if($sponsor>0) {
    echo '<div style="width:100%;height:10px;background-color:#458AB3;margin-top:20px;margin-bottom:20px;"></div>';
    // requete sql
    $request = mysql_query("SELECT id,nom,logo,url FROM sponsors WHERE ID = '".$sponsor."'") or die(MYSQL_QUERY_ERROR.mysql_error());
    $row_sponsor = mysql_fetch_array($request);
    echo '<div style="width:80%;height:140px;">';
    if(mysql_num_rows($request) == 1)
    {
      echo '<form action="index.php?page=sponsor_management_modify" method="post">';
    
	echo '
	  <div style="width:100%;height:120px;">
	    <div style="float:left;width:20%;height:120px;">
	      <img src="./images/'.$row_sponsor['logo'].'.png" width="100%" height="100%">
	    </div>
	    <div style="float:right;width:80%;height:120px;">
	      <input type="text" style="width:100%;margin-bottom:10px;" name="login" value="'.$row_sponsor['nom'].'" /><br />
	      <input type="text" style="width:100%;margin-bottom:10px;" name="login" value="'.$row_sponsor['url'].'" /><br />
	      <input type="text" style="width:100%;margin-bottom:10px;" name="login" value="'.$row_sponsor['logo'].'" />
	    </div>
	  </div>
	';
	echo '<div style="width:100%;height:20px;">
	  <input id="bouton_menu" style="width:49%;float:left;" type="submit" value="Modifier" />
	  <a href="index.php?page=sponsor_management_delete"><div id="bouton_menu" style="width:49%;float:right;">Supprimer</div></a>
	</div>';
	      
	echo '</form>';
      }
      else echo 'Aucun sponsor ne possède cet identifiant';
    echo '</div>';
    
    echo '<div style="width:100%;height:10px;background-color:#458AB3;margin-top:20px;margin-bottom:20px;"></div>';
  }
?>

<div style="width:100%;height:10px;background-color:#458AB3;margin-top:20px;margin-bottom:20px;"></div>

<div style="width:90%;height:250px;">
  Ajout d'un nouveau sponsor<br /><br />
  <form action="index.php?page=sponsor_management" method="post">
    Nom<br />
    <input type="text" style="width:100%;margin-bottom:10px;" name="Nom" value="" /><br />
    URL<br />
    <input type="text" style="width:100%;margin-bottom:10px;" name="URL" value="" /><br />
    Logo<br />
    <input type="text" style="width:100%;margin-bottom:10px;" name="Logo" value="" /><br />
    <input id="bouton_connexion" type="image" style="margin-left:5px;width:100%;height:28px;background:none;box-shadow: none;" style="width:39px;height:28px;" width="100%" height="100%" src="./images/ok.png" />
  </form>
</div>