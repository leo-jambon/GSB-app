<?php 
if(!isset($_SESSION)){
    session_start();
}
include 'bar.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(!isset($_POST['Repas']) or !isset($_POST['Nuit']) or !isset($_POST['Etape']) or !isset($_POST['Km']) or $_POST['Km'] == null or $_POST['Etape'] == null
        or $_POST['Nuit'] == null or $_POST['Repas'] == null){
    }
    
        
    
    
    $dsn = 'mysql:host=localhost; dbname=test1; port=3306; charset=utf8';
    
    try {
        $pdo = new PDO($dsn, 'root' , '');
    }
    catch (PDOException $exception) {
        exit('Erreur de connexion ‡ la base de donnÈes');
    }
    
    $query = $pdo->query ("select idVisiteur , mois from `fichefrais` where idVisiteur = '".$_SESSION["id"]."' and mois =  '".date('Ym')."'   ");
    
    $query2 = $pdo->query ("select idVisiteur , mois from `lignefraisforfait` where idVisiteur = '".$_SESSION["id"]."' and mois =  '".date('Ym')."'   ");
    
    $query3 = $pdo->query ("select idVisiteur , mois from `lignefraishorsforfait` where idVisiteur = '".$_SESSION["id"]."' and mois =  '".date('Ym')."'   ");
    
    $resultat = $query->fetchAll();
    $resultat2 = $query2->fetchAll();
    $resultat3 = $query3->fetchAll();
    //existe l'id et le mois dans fichefrais
    $existe = null;
    $existe2 = null;
    //existe l'id et le mois dans lignefraisforfait
    $existe3 = null;
    $existe4 = null;
    //existe l'id et le mois dans lignefriashorsforfait
    $existe5 = null;
    $existe6 = null;
    foreach ($resultat as $key => $variable)
    {
        $existe = $resultat[$key]["idVisiteur"];
        $existe2 = $resultat[$key]["mois"];
    }
    foreach ($resultat2 as $key => $variable2)
    {
        $existe3 = $resultat2[$key]["idVisiteur"];
        $existe4 = $resultat2[$key]["mois"];
    }
    foreach ($resultat3 as $key => $variable3)
    {
        $existe5 = $resultat3[$key]["idVisiteur"];
        $existe6 = $resultat3[$key]["mois"];
    }
    if(strlen($existe) == 0 and strlen($existe2) == 0){
        $sqlexiste = ("insert into fichefrais (`idVisiteur`,`mois`) VALUES ('".$_SESSION["id"]."','".date('Ym')."')");
        $stmte = $pdo->prepare($sqlexiste);
        $stmte->execute();
    }
    
    if($_POST['valider'] == "valider"){
        
        if(strlen($existe3) == 0 and strlen($existe4) == 0){
            
        
        $sql = ("insert into lignefraisforfait VALUES ('".$_SESSION["id"]."','".date('Ym')."','ETP','".$_POST['Etape']."')");
        $stmt= $pdo->prepare($sql);
        $stmt->execute();
        $sql2 = ("insert into lignefraisforfait VALUES ('".$_SESSION["id"]."','".date('Ym')."','KM','".$_POST['Km']."')");
        $stmt2= $pdo->prepare($sql2);
        $stmt2->execute();
        $sql3 = ("insert into lignefraisforfait VALUES ('".$_SESSION["id"]."','".date('Ym')."','NUI','".$_POST['Nuit']."')");
        $stmt3= $pdo->prepare($sql3);
        $stmt3->execute();
        $sql4 = ("insert into lignefraisforfait VALUES ('".$_SESSION["id"]."','".date('Ym')."','REP','".$_POST['Repas']."')");
        $stmt4= $pdo->prepare($sql4);
        $stmt4->execute();
        }
        else{
            $sql5 = ("UPDATE lignefraisforfait SET quantite = '".$_POST['Etape']."' WHERE idVisiteur = '".$_SESSION["id"]."' and mois = '".date('Ym')."' and idFraisForfait = 'ETP' ");
            $stmt5= $pdo->prepare($sql5);
            $stmt5->execute();
            
            $sql6 = ("UPDATE lignefraisforfait SET quantite = '".$_POST['Km']."' WHERE idVisiteur = '".$_SESSION["id"]."' and mois = '".date('Ym')."' and idFraisForfait = 'Km' ");
            $stmt6= $pdo->prepare($sql6);
            $stmt6->execute();
            
            $sql7 = ("UPDATE lignefraisforfait SET quantite = '".$_POST['Nuit']."' WHERE idVisiteur = '".$_SESSION["id"]."' and mois = '".date('Ym')."' and idFraisForfait = 'Nui' ");
            $stmt7= $pdo->prepare($sql7);
            $stmt7->execute();
            
            $sql8 = ("UPDATE lignefraisforfait SET quantite = '".$_POST['Repas']."' WHERE idVisiteur = '".$_SESSION["id"]."' and mois = '".date('Ym')."' and idFraisForfait = 'Rep' ");
            $stmt8= $pdo->prepare($sql8);
            $stmt8->execute();
        }
        
        
        
    }
    else{
        if(isset($_POST['Libelle']) and isset($_POST['montant'])){
         $sql = ("insert into lignefraishorsforfait (`idVisiteur`,`mois`,`libelle`,`montant`)  VALUES ('".$_SESSION["id"]."','".date('Ym')."','".$_POST['Libelle']."','".$_POST['montant']."')");
         $stmt= $pdo->prepare($sql);
         $stmt->execute();
         }
         
        /* if(strlen($existe5) == 0 and strlen($existe6) == 0){
        $sql = ("insert into lignefraishorsforfait (`idVisiteur`,`mois`,`libelle`,`montant`)  VALUES ('".$_SESSION["id"]."','".date('Ym')."','".$_POST['Libelle']."','".$_POST['montant']."')");
        $stmt= $pdo->prepare($sql);
        $stmt->execute();
        }
        else{
            $sql2 = ("UPDATE lignefraishorsforfait SET libelle = '".$_POST['Libelle']."' , montant = '".$_POST['montant']."' WHERE idVisiteur = '".$_SESSION["id"]."' and mois = '".date('Ym')."'");
            $stmt2= $pdo->prepare($sql2);
            $stmt2->execute();
        } */
        
       
    }
    $_POST['Repas'] = null;
    $_POST['Nuit'] = null;
    $_POST['Etape'] = null;
    $_POST['Km'] = null;

    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="visit.css">
    <link rel="stylesheet" href="animations.css">


</head>

<body>
    
        

        
    <div class="main">
        <div class="card">
            <FORM method="post">
                <h2>El√©ments compris dans les frais</h2>
                <br />
                <?php 
                echo date("F Y");
                
                ?>
                <br>
                <br />
                Repas midi: <SELECT class="select-scrollbar" name="Repas" size="1">
                    <?php
                    for ($i = 1; $i <= 99; $i++) {
                        echo "<OPTION>$i";
                    }
                    ?>
                </SELECT>
                Nuitees: <SELECT class="select-scrollbar" name="Nuit" size="1">
                    <?php
                    for ($i = 1; $i <= 99; $i++) {
                        echo "<OPTION>$i";
                    }
                    ?>
                </SELECT><br /><br />
                Etape: <SELECT class="select-scrollbar" name="Etape" size="1">
                    <?php
                    for ($i = 1; $i <= 99; $i++) {
                        echo "<OPTION>$i";
                    }
                    ?>
                </SELECT>
                Km: <SELECT class="select-scrollbar" name="Km" size="1">
                    <?php
                    for ($i = 1; $i <= 999; $i++) {
                        echo "<OPTION>$i";
                    }
                    ?>
                </SELECT>
                <br /><br />
                <div class="slot"></div>
                <button class="button_valider raise" type="submit" name="valider" value="valider">valider</button>
                <!-- <input  class="button_valider" type="submit" name="valider" value="valider"  /> -->
            </FORM>
        </div>
        <div class="card">
            <FORM method="post">

                <h2>Nouvel √©l√©ments Hors Frais</h2>
                <br />
                <?php 
                echo date("F Y");
                
                ?>
                <br /><br />
                Libelle: <input class="select-text" type="text" name="Libelle" value="" />
                montant: <input class="select-text" type="text" name="montant" value="" />

                <br /><br />
                <div class="slot"></div>
                <button class="button_valider raise" type="submit" name="valider" value="valider2">valider</button>
                <!-- <input class="button_valider" type="submit" name="valider" value="valider"  /> -->



            </FORM>
        </div>
    </div>
    <!-- ======= scripts ====== -->
    
</body>

</html>