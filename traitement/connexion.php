<?php
session_start();
///////////////////////////////////////////////////////// CLASSES  /////////////////////////////////////////////////////////
require_once 'class/Database.class.php';
$pdo = new Database();
// SI LE FORM N'EST PAS VIDE
if (!empty($_POST)) {
    
    // ENCODAGE DES CHAMPS
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $passconnect = htmlspecialchars($_POST['passconnect']);
    
    // SI UN DES CHAMPS ET VIDE
    if (!empty($mailconnect) AND !empty($passconnect)) {
        // INSTANTIATION DE LA CLASS DATABASE
        
        
        $verifAccount = $pdo->verifAccount($mailconnect, $passconnect);
        
        // SI LE COMPTE EXISTE
        if ($verifAccount) {
            
            $pdo->sessionCo($mailconnect);   
            
            header('Location: ../profil.php');
            
        }else {
            $pdo->conError("Identifiant ou Mot de passe incorrect !");
        }
        }else {
            $pdo->conError("Veuillez remplir tous les champs !");
        }
}else {
    echo 'Erreur form';
}