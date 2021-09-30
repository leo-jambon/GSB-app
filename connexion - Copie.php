<html>

 
 
<?php
if(!isset($_SESSION)){
    session_start();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
$_SESSION['prenom'] = $_POST['pseudo'];
$_SESSION['mdp'] = $_POST['mdp'];
$dsn = 'mysql:host=localhost;dbname=test1;port=3306;charset=utf8';

try {
$pdo = new PDO($dsn, 'root' , '');
}
catch (PDOException $exception) {
 mail('fauxmail@votremail.com', 'PDOException', $exception->getMessage());
 exit('Erreur de connexion à la base de données');
}

// Requête pour tester la connexion

$query = $pdo->query("SELECT id FROM `visiteur` where login = '".$_SESSION['prenom']."'");
$query2 = $pdo->query("SELECT id FROM `visiteur` where mdp = '".$_SESSION['mdp']."'");
$query3 = $pdo->query("SELECT rang FROM `visiteur` where login = '".$_SESSION['prenom']."' and mdp = '".$_SESSION['mdp']."'");

$resultat = $query->fetchAll();
$resultat2 = $query2->fetchAll();
$resultat3 = $query3->fetchAll();


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

$lerang = null;
foreach ($resultat3 as $key3 => $variable3)
{
    $lerang = $resultat3[$key3]['rang'];
}



$repetelogin = null;
if(isset($_POST['captcha'])){
    if($_POST['captcha']==$_SESSION['code']){
        if($lelogin == $lemdp and $lelogin != null and $lemdp != null){
            if($lerang == 0){
                
                print ("connectee en tant que visiteur medical");
                print("<form action='login.php' method='post' ><input type='submit' href='login.php' /></form>");
                
                
            }
            
            
            else{
                print ("connectee en tant que comptable");
                
            }
            
        }
        else{
                include("login.php");
            
            
            echo '<script>alert("catcha pas bon bro")</script>';
        }
        
    } else {
        
            include("login.php");
            echo '<script>alert("login ou mot de passe incorect")</script>';
    }
}





}
?>

</html>