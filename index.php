<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
       <link href="css/sign.css" rel="stylesheet" type="text/css"/>
       <script type="text/javascript" src="//code.jquery.com/jquery-2.2.0.min.js"></script>
       <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
       <script src="js/sign.js" type="text/javascript"></script>
       <script src="js/ajax.js" type="text/javascript"></script>
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <meta charset="utf-8">
    </head>
    <body onload="replacement4()">
        <div class="opa"></div>
        <div id="triangle" class="triangle"></div>
        <div id="triangle2" class="triangle2"></div>
        
        
        <!--<div id="logo" class="logo"><img src="img/openn.png"></div>-->
        
        <!--******************* CONNEXION *******************-->
        <form id="formulaire" class="formulaire" action="traitement/connexion.php" method="POST">
            <?php
            if(isset($_SESSION['conError'])){
                $error = $_SESSION['conError'];
                echo '<p id="error">'.$error.'</p>';
                echo '<style type="text/css">.formu{border: 2px solid #CC3715;}</style>';
            }
            
            ?>
            <input id="mailconnect" class="formu" type="email" name="mailconnect" placeholder="Adresse eMail" required>
            <input id="passconnect" class="formu" type="password" name="passconnect" placeholder="Mot de passe" required>
            <button onclick="con()" class="boutons boutons1" type="button">Se connecter</button>
            <input  type="button" onclick="inscription()" class="boutons boutons2" value="S'enregistrer">
            <button onclick="oublie()" class="boutons boutons3" type="button">Mot de passe oublié</button>
        </form>
        
        <!--******************* INSCRIPTION *******************-->
        <form id="formulaire2" class="formulaire2" action="traitement/inscription.php" method="POST">
            <?php
            if(isset($_SESSION['subError'])){
                $error = $_SESSION['subError'];
                echo '<p id="error2">'.$error.'</p>';
                echo '<style type="text/css">#formulaire{display: none;}#formulaire2{display:block;}.formu2{border: 2px solid #CC3715;}</style>';
            }
        ?>
            <input id="pseudo" class="formu2" type="text" name="pseudo" placeholder="Pseudonyme" required>
            <input id="email" class="formu2" type="email" name="email" placeholder="Adresse eMail"  required>
            <input id="password" class="formu2" type="password" name="pass" placeholder="Mot de passe" required>
            <input id="confirm" class="formu2" type="password" name="confpass" placeholder="Confirmation mot de passe" required>
            <button onclick="subb()" class="boutons boutons1" type="button">S'enregistrer</button>
            <input type="button" onclick="connexion()" class="boutons boutons2" value="Se connecter">
        </form>
        
        
        
        
        <form id="oublie" class="formulaire3" action="traitement/resetForm.php" method="POST">
            <?php
            if(isset($_SESSION['oublieError'])){
                $error = $_SESSION['oublieError'];
                echo '<p id="error3">'.$error.'</p>';
                echo '<style type="text/css">#formulaire{display: none;}#oublie{display:block;}.formu3{border: 2px solid #CC3715;}</style>';
            }
        ?>
            <input id="email" class="formu3" name="resmail" placeholder="Adresse eMail">
            <button onclick="con2()" class="boutons boutons3" type="button">Envoyer</button>
            <button onclick="" class="boutons boutons4" type="button">Retour</button>
        </form>
        
        <?php
        session_destroy();
        ?>
    </body>
</html>