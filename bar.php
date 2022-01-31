<?php 
if(!isset($_SESSION)){
    session_start();
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="visit.css">
    <link rel="stylesheet" href="animation.css">
    <link rel="stylesheet" href="animation2.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
    <script src="scriptI.js" defer></script>
</head>
<body>
    
       
     <header>
    
      <div class="slot"></div>
        <button id="main-logo" class="btn-confettis raise"> <img src="images/gsb100px.png"></button>
        
        <nav>
            <ul>
                <li>

                    <a href = 'accueil.php' class="raise"><img id="logo1" class="mini-logo" src="images/desktop.svg">Acceuil</a>
                    <a href = 'insertion.php'><img id="logo2" class="mini-logo" src="images/clipboard.svg">Remplir une fiche de frais</a>
                    
                    <?php 
                   if($_SESSION['rang'] == 0){
                       echo "<a href = 'consultation.php'><img id='logo3' class='mini-logo' src='images/eye.svg'>Consulter mes fiches de frais</a>";
                   }
                   else{
                       echo "<a href = 'consultationComtable.php'><img id='logo3' class='mini-logo' src='images/eye.svg'>Consulter mes fiches de frais</a>";
                   }
                   ?>
                    
                    <a href = 'login_page.php'><img id="logo4" class="mini-logo" src="images/sign-out-alt.svg">Déconnexion</a>
                </li>

            </ul>
        </nav>
</header>
</html>
