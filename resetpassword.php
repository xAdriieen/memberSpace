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
      
        
        <!--******************* INSCRIPTION *******************-->
        
        
        <style type="text/css">
            .formulaire3 {
                display: block;
            }
            .formu3 {
                display: block;
            }
            .boutons4 {
                float: none;
            }
        </style>
        
        
        <form id="oublie" class="formulaire3" action="traitement/reset.php" method="POST">
            <input id="pseudo" class="formu3" type="password" name="password" placeholder="Nouveau mot de passe">
            <input id="email" type="password" class="formu3" name="confirm" placeholder="Confirmez le nouveau mot de passe">
            <button  class="boutons boutons4" type="submit">Modifier</button>
        </form>
        
        <?php
        ?>
    </body>
</html>