<?php
    // transformer les champs postés par le formulaire en variables
    $form = isset($_GET['form']) ? $_GET['form'] : null;
    $elem = isset($_GET['elem']) ? $_GET['elem'] : null;

  // Section de configuration

  $bgcolor="dddddd" ;        // Couleur de fond
  $daybgcolor="aaaaaa" ;     // Couleur des jours de la semaine
  $dombgcolor="eeeeee" ;     // Couleur du jour sélectionné
  $dayholcolor="cccccc" ;     // Couleur des WE

  // Mois
  $month[0] = "Janvier" ;
  $month[1] = "Février" ;
  $month[2] = "Mars" ;
  $month[3] = "Avril" ;
  $month[4] = "Mai" ;
  $month[5] = "Juin" ;
  $month[6] = "Juillet" ;
  $month[7] = "Août" ;
  $month[8] = "Septembre" ;
  $month[9] = "Octobre" ;
  $month[10] = "Novembre" ;
  $month[11] = "Décembre" ;

  // Première lettre des jours de la semaine
  $day[0] = "D" ;
  $day[1] = "L" ;
  $day[2] = "M" ;
  $day[3] = "M" ;
  $day[4] = "J" ;
  $day[5] = "V" ;
  $day[6] = "S" ;

  $error01 = "Erreur : date invalide"

?>
<html>
<head>
<style>
 #general
 {
  font-family: Arial;
  font-size: 10pt;
 }

 a:link,a:active,a:visited
 {
        text-decoration:none;
        color:#000000;
 }

 a:hover
 {
        text-decoration:underline;
        color:#000000;
 }

</style>
<script language='JavaScript'>
 window.resizeTo(200,300) ;
 function modifier (jour)
 {
  window.location.href = "calendrier.php?form=<?echo $form;?>&elem=<?echo $elem;?>&mois=" + document.forms["calendrier"].elements['month'].options[document.forms["calendrier"].elements['month'].selectedIndex].value + "&jour=" + jour +"&annee=" + document.forms["calendrier"].elements['year'].options[document.forms["calendrier"].elements['year'].selectedIndex].value

 }
<?
  if (!isset($jour))
       $jour = date("j") ;

  if (!isset($mois))
       $mois = date("m") ;

  if (!isset($annee))
       $annee = date("Y") ;

    // nombre de jours par mois
  $nbjmonth[0] = 31 ;
  $nbjmonth[1] = ($annee%4==0?($annee%100==0?($annee%400?29:28):29):28) ;
  $nbjmonth[2] = 31 ;
  $nbjmonth[3] = 30 ;
  $nbjmonth[4] = 31 ;
  $nbjmonth[5] = 30 ;
  $nbjmonth[6] = 31;
  $nbjmonth[7] = 31 ;
  $nbjmonth[8] = 30 ;
  $nbjmonth[9] = 31 ;
  $nbjmonth[10] = 30 ;
  $nbjmonth[11] = 31 ;

  if(!checkdate($mois,$jour,$annee))
  {
   echo "alert('$error01')\n" ;
   $jour = date("j") ;
   $mois = date("m") ;
   $annee = date("Y") ;
  }

  // Calcul du jour julien et du numéro du jour
  $HR = 0;
  $GGG = 1;
  if( $annee < 1582 ) $GGG = 0;
  if( $annee <= 1582 && $mois < 10 ) $GGG = 0;
  if( $annee <= 1582 && $mois == 10 && 1 < 5 ) $GGG = 0;
  $JD = -1 * floor(7 * (floor(($mois + 9) / 12) + $annee) / 4);
  $S = 1;
  if (($mois - 9)<0) $S=-1;
  $A = abs($mois - 9);
  $J1 = floor($mois + $S * floor($A / 7));
  $J1 = -1 * floor((floor($J1 / 100) + 1) * 3 / 4);
  $JD = $JD + floor(275 * $mois / 9) + 1 + ($GGG * $J1);
  $JD = $JD + 1721027 + 2 * $GGG + 367 * $annee - 0.5;



  /*$tmp = ((int)(($mois>2?$annee:$annee-1)/100)) ;
  $jj = (int)((((int)(365.25*($mois>2?$annee:$annee-1))) + ((int)(30.6001*($mois>2?$mois+1:$mois+13))) + $jour + 1720994.5 + ($annee > 1582 && $mois > 10 && $jour > 15?2-$tmp+((int)($tmp/4)):0))) ;
  $jj = (int)(($jj) % 7)*/
  $jj = (($JD+.5)%7) ;
?>
</script>
</head>
<?
  echo "<body bgcolor='#$bgcolor' onUnLoad=''>\n" ;

  echo "<center><form name='calendrier'>\n" ;
  echo "<table width='170' cellspacing='0' cellspading='0' border='0'><tr>\n" ;

  // Affichage de la sélection du mois et de l'année
  echo "<td><select name='month' onChange=\"modifier($jour)\">\n" ;

  for ($i=0;$i<12;$i++)
  {
   echo "<option value='".($i+1)."'".($mois==($i+1)?" selected":"").">".$month[$i]."</option>\n" ;
  }

  echo "</select></td>\n" ;

  echo "<td align='right'><select name='year' onChange=\"modifier($jour)\">\n" ;

  $y = date("Y") ;
  for ($i=$y-10;$i<$y+10;$i++)
  {
   echo "<option value='$i'".($annee==($i)?" selected":"").">$i</option>\n" ;
  }

  echo "</select></td></tr><tr><td colspan='2'>&nbsp;</td></tr>\n" ;

  echo "<tr><td colspan='2'><table width='100%' cellspacing='0' cellspading='0' border='0'>\n" ;
  echo "<tr>\n" ;

  // Affichage des jours
  for($i=0;$i<7;$i++)
  {
   echo "<td width='14%' bgcolor='#$daybgcolor'><font id='general'>".$day[$i]."</font></td>" ;
  }

  echo "</tr>\n<tr><td colspan='7'> </td></tr>\n<tr>\n" ;

  // Première ligne des jours
  $j = $jj ;//date ("w", mktime (0,0,0,$mois,1,$annee)) ;
  $dom = 1 ;
  for ($i=0;$i<7;$i++)
  {
   if ($j<=$i)
   {
        echo "<td".($dom==$jour?" bgcolor='#$dombgcolor'":"")."><a href='javascript&#058;modifier($dom)'><font id='general'>".$dom++."</font></a></td>\n" ;
   }
   else
       echo "<td>&nbsp;</td>\n" ;
  }

  echo "</tr>\n" ;
  // Le reste
  for ($i=0;$i<5;$i++)
  {
   echo "<tr>\n" ;
   for ($j=0;$j<7;$j++)  
   {    
        $j_inac = ($j==0 || $j==6) ;
       
        if($dom < $nbjmonth[($mois-1)])
         echo "<td".($dom==$jour?" bgcolor='#$dombgcolor'":($j_inac ?" bgcolor='#$dayholcolor'":""))."><a href='javascript&#058;modifier($dom)'><font id='general'>".$dom++."</font></a></td>\n" ;
    else if (checkdate($mois,$dom,$annee))
         echo "<td".($dom==$jour?" bgcolor='#$dombgcolor'":($j_inac ?" bgcolor='#$dayholcolor'":""))."><a href='javascript&#058;modifier($dom)'><font id='general'>".$dom++."</font></a></td>\n" ;
    else
         echo "<td>&nbsp;</td>\n" ;

   }
   echo "</tr>\n" ;
  }

  echo "\n<tr><td colspan='10' align='center'><input type='button' onclick='window.opener.document.forms[\"$form\"].elements[\"$elem\"].value=\"$annee-$mois-$jour\";window.close()' value='Valider'>&nbsp;&nbsp;<input onclick='window.close()' type='button' value='Annuler'></td></tr></table>\n" ;

  echo "\n</tr></table>\n" ;

  echo "</td></tr></table>" ;
  echo "</form></center>" ;

  echo "</body>\n" ;
?>
</html>
 