<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login-page</title>
    <!-- == css == -->
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="animations.css">
  
    <!-- == javascript == -->
    <script src="scriptLogin.js" defer></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js" defer></script>
    
</head>

<body>

<a href ="../accueil.php"><button  style = "top:2% ; left:2%; position:absolute">X</button></a>
<p style = "top:3% ; left:2%; position:absolute;color : white">client - login : dandre , mdp : oppg5</br>comtable - login : ltusseau , mdp : ktp3s</p>

<?php 
if(isset($_SESSION)){
    session_destroy();
}
if(!isset($_SESSION)){
    session_start();
    $_SESSION['l&mI'] = "";
    $_SESSION['CI'] = "";
    
}
?>

    <div class="l-form">
        
        <form action="connexion.php" class="form" method="post">
        <h1>Connectez-vous !</h1>
        <br>
        <div class="slot"></div>
             <img id="logo" class="btn-confettis" src="images/gsb.png">
 
           
               
            <div class="form__div">
               
                <input name="pseudo" value="" id="input1" type="text" class="form__input" placeholder=" ">
                <label for="" class="form__label">Pseudo</label>
            </div>

            <div class="form__div">
                
                <input name="mdp" value="" id="input2" type="password" class="form__input" placeholder=" ">
                <label  for="" class="form__label">Mot de passe</label>
                <?php 
 if($_SESSION['l&mI'] == 'oui'){
        echo '<h2>login or mdp pas bon gros</h2>';
    }
    ?>
            </div>
            <!-- ===captcha -->
            <img class="captcha" src="image.php" onclick="this.src='image.php?' + Math.random();" alt=""
                style="cursor:pointer;"><br /> 
            <!-- ===fin captcha -->
          
            <div class="form__div">
                <input id="input3" type="password" class="form__input" name = "captcha" placeholder=" ">
                <label for="" class="form__label">Captcha</label>
                <?php 
    
    if ($_SESSION['CI'] == 'oui'){
        echo '<h2>pas bon catcha gros</h2>';
    }
    
    ?>
            </div>

            <input type="submit" class="form__button" name="connexion" value="Connexion">
        </form>
    </div>
</body>
</body>

</html>