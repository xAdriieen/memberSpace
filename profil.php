<?php
session_start();

require 'traitement/class/user.class.php';

// INSTANTIATION DE LA CLASSE INSCRIPTION
$sub = new user();

// CONDITION POUR SESSION
$sub->mustSession();

?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/profil.css" rel="stylesheet" type="text/css"/>
        <script src="js/sign.js" type="text/javascript"></script>
    </head>
    <body onload="replacement()">
        
        <div id="triangle" class="triangle"></div>
        <div id="triangle2" class="triangle2"></div>
        
        <header id="headerr">
            <img class="imguser" src="img/user.jpg">
        </header>
        
        
        <section class="section1">
            <?php // echo $_SESSION['username'], $_SESSION['email'];    ?>
            
            
            <br><br>
            
            <a href="traitement/deconnexion.php">Deconnexion</a>
            
        </section>
    </body>
</html>