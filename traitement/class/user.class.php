<?php

session_start();

class user {
    
    ///////////////////////////////////////////////////////// MÉTHODES /////////////////////////////////////////////////////////
    
    // CRYPTAGE DU MOT DE PASSE
    public function crypt($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }
    
    // FORMAT PSEUDO
    public function regPseudo($pseudo) {
        return preg_match('#^[a-zA-Z0-9-_.]{3,}$#', $pseudo);
    }
    
    // FORMAT EMAIL
    public function regMail($email) {
        return preg_match('#^[a-zA-Z0-9-_.]+@[a-zA-Z0-9-_]{2,}\.[a-z]{2,}$#', $email);
    }
    
    // SI AUCUNE SESSION
    public function mustSession() {
        if (empty($_SESSION['email'])) {
//            header('Location: 404.php');
            echo '<br><br><br><br><br>PAS DE SESSION';
        }
    }
    
    
    // GENERATE TOKEN
    public function random($lenght){
        $alphabet= "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $lenght)), 0, $lenght);
   }
   
   
   
   
   
   
   
}