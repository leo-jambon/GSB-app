<html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$pseudo = $_POST['pseudo'];
$mdp = $_POST['mdp'];
$dsn = 'mysql:host=localhost;dbname=test1;port=3306;charset=utf8';

try {
$pdo = new PDO($dsn, 'root' , '');
}
catch (PDOException $exception) {
 mail('fauxmail@votremail.com', 'PDOException', $exception->getMessage());
 exit('Erreur de connexion à la base de données');
}

// Requête pour tester la connexion

$query = $pdo->query("SELECT id FROM `visiteur` where login = '".$pseudo."'");
$query2 = $pdo->query("SELECT id FROM `visiteur` where mdp = '".$mdp."'");

$resultat = $query->fetchAll();
$resultat2 = $query2->fetchAll();



$lelogin = null;
foreach ($resultat as $key => $variable)
{
    $lelogin = $resultat[$key]['id'];
}

$lemdp = null;
foreach ($resultat2 as $key2 => $variable2)
{
    $lemdp = $resultat2[$key2]['id'];
}



    
    if($lelogin == $lemdp and $lelogin != null and $lemdp != null){
    print ("connecter");
}
else{
    include("login.php");
    echo '<script>alert("login ou mot de passe incorect")</script>';
}



}
?>

</html>