<?php
session_start();

$resmail = htmlspecialchars($_POST['resmail']);

require 'class/Database.class.php';
require 'class/user.class.php';


$pdo = new Database();
$user = new user();


if (!empty($resmail)) {
// TOKEN
$resetToken = $user->random(60);

// RÉCUPÉRATION DE L'ID
$recupReset = $pdo->recupReset($resmail);


$id = $recupReset[0];

$email = $recupReset[1];



$pdo->updateToken($resetToken, $id);



$message = "<a href='http://adriieen.sockeh.fr/new/confirmReset.php?id=".$id."&token=".$resetToken."'>ResetPassword</a>";

// ENVOI DU MAIL
$pdo->mailResetToken($email, 'ResetPassword', $message);


header('Location: ../index.php');

}else {
    $pdo->oublieError("Veuillez remplir tous les champs !");
}

