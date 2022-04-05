<?php 
include 'bar.php';
?>
<html>
<body>


<?php

if(!isset($_SESSION)){
    session_start();
}
$dsn = 'mysql:host=localhost; dbname=test1; port=3306; charset=utf8';

try {
    $pdo = new PDO($dsn, 'root' , '');
}
catch (PDOException $exception) {
    exit('Erreur de connexion à la base de données');
}





$query = $pdo->query ("select quantite , mois from `lignefraisforfait` where idVisiteur = '".$_SESSION["id"]."'");
$query2 = $pdo->query ("select libelle , mois , montant from `lignefraishorsforfait` where idVisiteur = '".$_SESSION["id"]."'");

$resultat = $query->fetchAll();
$resultat2 = $query2->fetchAll();
$quantite = array();
$lebelle = array();
$mois = array();
$mois2 = array();
$montant = array();
foreach ($resultat as $key => $variable)
{
    array_push($quantite, $resultat[$key]["quantite"]);
    array_push($mois, $resultat[$key]["mois"]);
}
foreach ($resultat2 as $key2 => $variable2)
{
    array_push($lebelle, $resultat2[$key2]["libelle"]);
    array_push($mois2, $resultat2[$key2]["mois"]);
    array_push($montant, $resultat2[$key2]["montant"]);
}


if(isset($_POST["modifetp"]) && isset($_POST["modifkm"]) && isset($_POST["modifnui"]) && isset($_POST["modifrep"]) && isset($_POST["buttonmodif"])){
    
    $sql5 = ("UPDATE lignefraisforfait SET quantite = '".$_POST["modifetp"]."' WHERE idVisiteur = '".$_SESSION["id"]."' and mois = '".$mois[$_POST["buttonmodif"]-1]."' and idFraisForfait = 'ETP' ");
    $stmt5= $pdo->prepare($sql5);
    $stmt5->execute();
    
    $sql6 = ("UPDATE lignefraisforfait SET quantite = '".$_POST["modifkm"]."' WHERE idVisiteur = '".$_SESSION["id"]."' and mois = '".$mois[$_POST["buttonmodif"]-1]."' and idFraisForfait = 'Km' ");
    $stmt6= $pdo->prepare($sql6);
    $stmt6->execute();
    
    $sql7 = ("UPDATE lignefraisforfait SET quantite = '".$_POST["modifnui"]."' WHERE idVisiteur = '".$_SESSION["id"]."' and mois = '".$mois[$_POST["buttonmodif"]-1]."' and idFraisForfait = 'Nui' ");
    $stmt7= $pdo->prepare($sql7);
    $stmt7->execute();
    
    $sql8 = ("UPDATE lignefraisforfait SET quantite = '".$_POST["modifrep"]."' WHERE idVisiteur = '".$_SESSION["id"]."' and mois = '".$mois[$_POST["buttonmodif"]-1]."' and idFraisForfait = 'Rep' ");
    $stmt8= $pdo->prepare($sql8);
    $stmt8->execute();
}

if(isset($_POST["button"]) && isset($mois[$_POST['button']-1])){
    $pdo->query ("delete from lignefraisforfait where mois = '".$mois[$_POST['button']-1]."' and idVisiteur = '".$_SESSION["id"]."'");
    $pdo->query ("delete from fichefrais where mois = '".$mois[$_POST['button']-1]."' and idVisiteur = '".$_SESSION["id"]."'");
    
}
if(isset($_POST["button2"]) && isset($mois2[$_POST['button2']])){
    $pdo->query ("delete from lignefraishorsforfait where montant = '".$montant[$_POST['button2']]."' and libelle = '".$lebelle[$_POST['button2']]."' and idVisiteur = '".$_SESSION["id"]."' and mois = '".$mois2[$_POST['button2']]."'");
}



$query = $pdo->query ("select quantite , mois from `lignefraisforfait` where idVisiteur = '".$_SESSION["id"]."'");
$query2 = $pdo->query ("select libelle , mois , montant from `lignefraishorsforfait` where idVisiteur = '".$_SESSION["id"]."'");
$query3 = $pdo->query ("select cv  from `voiture` where iduser = '".$_SESSION["id"]."'");

$resultat = $query->fetchAll();
$resultat2 = $query2->fetchAll();
$resultat3 = $query3->fetchAll();
$quantite = array();
$lebelle = array();
$mois = array();
$mois2 = array();
$montant = array();
$cv = array();
foreach ($resultat as $key => $variable)
{
    array_push($quantite, $resultat[$key]["quantite"]);
    array_push($mois, $resultat[$key]["mois"]);
}
foreach ($resultat2 as $key2 => $variable2)
{
    array_push($lebelle, $resultat2[$key2]["libelle"]);
    array_push($mois2, $resultat2[$key2]["mois"]);
    array_push($montant, $resultat2[$key2]["montant"]);
}
foreach ($resultat3 as $key3 => $variable3)
{
    array_push($cv , $resultat3[$key3]["cv"]);
}

/* for ($i = 0;count($quantite);$i++){
    
} */
$un = 0;
$deux = 1;
$trois = 2;
$quatre = 3;

    echo '<center>
<table class="table">
  <thead>
    <tr>
      <th>ETAPE</th>
      <th>KM</th>
      <th>NUIT</th>
      <th>REPAS</th>
      <th>DATE</th>
      <th>montant rembouser</th>
    </tr>
  </thead>';
for($nbrquantite =4;count($quantite) >= $nbrquantite;$nbrquantite = $nbrquantite +4 ){
    if($cv[0] <= 3){
        $renbousementkm = $quantite[$deux] * 0.456;
    }
    if($cv[0] == 4){
        
        $renbousementkm = $quantite[$deux] * 0.523;
    }
    if($cv[0] == 5){
        $renbousementkm = $quantite[$deux] * 0.548;
    }
    if($cv[0] == 6){
        $renbousementkm = $quantite[$deux] * 0.574;
    }
    if($cv[0] > 6){
        $renbousementkm = $quantite[$deux] * 0.601;
    }
    $renbousementnuit = $quantite[$trois] * 40;
    $renbousementrepas = $quantite[$quatre] *15;
    $renbousement = $renbousementkm+$renbousementnuit+$renbousementrepas;
    
  echo '<tbody>
    <tr>
      <td>'.$quantite[$un].'</td>
      <td>'.$quantite[$deux].'</td>
      <td>'.$quantite[$trois].'</td>
      <td>'.$quantite[$quatre].'</td>
      <td>'.$mois[$quatre].'</td>
      <td>'.$renbousement.'</td>

      <form action="consultation.php" method="post">

      <td><button name ="button" type="submit" value="'.$nbrquantite.'">supprimer</button></td>
      </form>
    </tr>

    <tr>
';
  if(date('Ym') <= $mois[$quatre]){;
  echo'
      <form action="consultation.php" method="post">
      <td><input name ="modifetp"></input></td>
      <td><input name ="modifkm"></input></td>
      <td><input name ="modifnui"></input></td>
      <td><input name ="modifrep"></input></td>
      <td></td>
      
      <td><button name ="buttonmodif" type="submit" value="'.$nbrquantite.'">modifier</button></td>
      </form>
   ';};echo'
    </tr>
<tr></tr>



  </tbody>
';
  $un = $un + 4;
  $deux = $deux + 4;
  $trois = $trois + 4;
  $quatre = $quatre + 4;}'
</table>
</center>';
  
  
  
  echo '<center>
<table class="table">
  <thead>
    <tr>
      <th>lebelle</th>
      <th>mois</th>
      <th>montant</th>
    </tr>
  </thead>';
  for($nbrquantite2 =0;count($lebelle) > $nbrquantite2;$nbrquantite2++ ){
      
      echo '<tbody>
    <tr>
      <td>'.$lebelle[$nbrquantite2].'</td>
      <td>'.$mois2[$nbrquantite2].'</td>
      <td>'.$montant[$nbrquantite2].' euro</td>
      <form action="consultation.php" method="post">
      <td><button name ="button2" type="submit" value="'.$nbrquantite2.'">supprimer</button></td>
      </form>
          
    </tr>
          
  </tbody>
';
      $un = $un + 4;
      $deux = $deux + 4;
      $trois = $trois + 4;
      $quatre = $quatre + 4;}'
</table>
</center>';

    
?>





</body>
</html>
