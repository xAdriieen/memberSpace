<?php
session_start();
///////////////////////////////////////////////////////// CLASSES  /////////////////////////////////////////////////////////
require 'class/Database.class.php';
require 'class/user.class.php';

// INSTANTIATION DES CLASSES
$pdo = new Database();
$sub = new user();

// SI LE FORM N'EST PAS VIDE
if (!empty($_POST)) {
    
    // ENCODAGE DES CHAMPS
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['pass']);
    $confirm = htmlspecialchars($_POST['confpass']);
    
    // SI UN OU PLUSIEURS CHAMPS VIDE
    if (!empty($pseudo) OR !empty($email) OR !empty($password) OR !empty($confirm)) {
        
        // REGEX PSEUDO
        if ($sub->regPseudo($pseudo)) {
            
        // REGEX MAIL
        if ($sub->regMail($email)) {
            
        // CONFIRMATION MOT DE PASSE
        if ($password == $confirm) {
            
           // CRYPTAGE DU MOT DE PASSE
           $password = $sub->crypt($password);
            
            // SI LE PSEUDO EXISTE DÉJÀ
            $userExist = $pdo->userExist($pseudo, $email);
            
            if ($userExist == 0) {
                
                    // INCRIPTION DES CHAMPS DANS LA BASE
                    $pdo->insertUser($pseudo, $email, $password);
                    
                    // DEFINITION DES SESSIONS
                    $pdo->sessionSub($pseudo, $email);
                    
                    header('Location: ../profil.php');

        }else {
            $pdo->subError("Email ou Pseudonyme déjà utilisé(e) !");
        }
        }else {
            $pdo->subError("Les mots de passe ne correspondent pas !");
        }
        }else {
            $pdo->subError("Le format de l'email n'est pas valide !");
        }
        }else {
            $pdo->subError("Le format du Pseudonyme n'est pas valide !");
        }
        }else {
            $pdo->subError("Veuillez remplir tous les champs !");
        }
             
}