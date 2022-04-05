<?php 
include 'bar.php';
?>
<html>
<head>

</head>
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

$query = $pdo->query ("select nom , prenom , rang from `utilisateur` where id = '".$_SESSION["id"]."'");
$query2 = $pdo->query ("select marque , cv  from `voiture` where iduser = '".$_SESSION["id"]."'");

$resultat = $query->fetchAll();
$resultat2 = $query2->fetchAll();
$marque = null;
$cv = null;
foreach ($resultat2 as $key2 => $variable2)
{
    $marque = $resultat2[$key2]["marque"];
    $cv = $resultat2[$key2]["cv"];
}

foreach ($resultat as $key => $variable)
{
    $nom = $resultat[$key]["nom"];
    $prenom = $resultat[$key]["prenom"];
    $rang = $resultat[$key]["rang"];
}


if(isset($_POST['validation'])){
    
    
    if(strlen($marque) == 0 and strlen($cv) == 0){
        $sql = ("insert into voiture (cv,marque,iduser) VALUES ('".$_POST["cv"]."','".$_POST["marque"]."','".$_SESSION["id"]."')");
        $stmt= $pdo->prepare($sql);
        $stmt->execute();
    }
    else{
        
        $sql5 = ("UPDATE voiture SET cv = '".$_POST["cv"]."', marque = '".$_POST["marque"]."' where iduser = '".$_SESSION["id"]."'");
        $stmt5= $pdo->prepare($sql5);
        $stmt5->execute();
    }
    
    
    
}

$query = $pdo->query ("select nom , prenom , rang from `utilisateur` where id = '".$_SESSION["id"]."'");
$query2 = $pdo->query ("select marque , cv  from `voiture` where iduser = '".$_SESSION["id"]."'");

$resultat = $query->fetchAll();
$resultat2 = $query2->fetchAll();
$marque = null;
$cv = null;
foreach ($resultat2 as $key2 => $variable2)
{
    $marque = $resultat2[$key2]["marque"];
    $cv = $resultat2[$key2]["cv"];
}

foreach ($resultat as $key => $variable)
{
    $nom = $resultat[$key]["nom"];
    $prenom = $resultat[$key]["prenom"];
    $rang = $resultat[$key]["rang"];
}
if($rang == 0){
    $status = "visiteur";
}
else{
    $status = "comtable";
}

echo "<center><p>bienvenue  ". $nom ."  ". $prenom ."  </p></center></br>";
echo "<center><p>votre status est :  ". $status ."  </p></center></br>";

if(strlen($marque) != 0 and strlen($cv) != 0){
 echo'<center><span class="tag is-primary">
  vous avez enregistrer une voiture dont la marque est : '.$marque.' et les cv s eleve a : '.$cv.'
</span></center></br>';
}
    else{
        echo'<center><span class="tag is-danger">
  vous avez pas enregistrer une voiture
</span></center></br>';
    }


?>
<form action="accueil.php" method="post">
<center>
<div class="container">
  <div class="notification is-primary">
    <input name ="marque"  class="input is-link" type="text" placeholder="marque de votre voiture"><br></br>
    <input name ="cv"  class="input is-link" type="text" placeholder="chevaux de votre voiture"><br></br>
    <button name ="validation" value = "validation" type="submit" class="button is-link">enregistrer ou modifier</button>
  </div>
</div>
</center>
</form>
</body>
</html>