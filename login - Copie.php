<html><body><center class="body">
<?php 
if(!isset($_SESSION)){
    session_start();
}
?>

<table class="autourlogin" id ='imgback'>
<tr ><td>
<form action="connexion.php" method="post" >
    Pseudo: <br /><input type="text" name="pseudo" value="" />
    <br />
    Mot de passe: <br /><input type="password" name="mdp" value="" />
    <br /><br />
    </td></tr>
 
    <tr class="test2"><td>
    <input type="submit" name="connexion" value="Connexion" class="connexion" />
    <br /><br />
    <center>
    <input type="text" name="captcha"/>
    <img src="image.php" onclick="this.src='image.php?' + Math.random();" alt="captcha" style="cursor:pointer;">
    </center>
</form></td></tr>
</table>
</center></body></html>
<style type="text/css">
html, body {
  width: 100%;
  height:100%;
}

body {
    background: linear-gradient(-45deg, #2ECCFA, #666C6A, #4877D4, #23d5ab);
    background-size: 400% 400%;
    animation: gradient 15s ease infinite;
}

@keyframes gradient {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}


#imgback{
background-image:url(logoo.png);
background-repeat:no-repeat;
background-position:right top;
background-size: 100px;
}

.connexion{
text-align: center;
text-shadow: 2px 2px 5px black;
background-color : #8181F7;
font-size: 2em;
font-weight: bold;
width: 400px;
height: 80px;
}
.connexion:hover {
transform: scale(1.1);
text-align: center;
text-shadow: 2px 2px 5px black;
background-color : #8181F7;
font-size: 2em;
font-weight: bold;
width: 400px;
height: 80px;
}
.login {
margin-top : 20%;
}
.autourlogin {
box-shadow: 10px 5px 5px black;
width: 450px;
height: 350px;
border: 10px solid #ccc;
border-radius: 40px 40px 40px 40px;
background: #eee; 
margin-top : 14%;
padding: 15px 25px;
}   

</style>