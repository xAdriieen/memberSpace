<?php
session_start();
    // IDENTIFIANTS DATABASE
require_once 'ident.php';

class Database {

    ///////////////////////////////////////////////////////// PROPRIETÉS /////////////////////////////////////////////////////////
    
    // DONNÉES DE CONNEXION À LA DATABASE
    private $_host = DB_HOST;
    private $_user = DB_USER;
    private $_pass = DB_PASS;
    private $_pdo;
    
    // TABLE MEMBRES DATABASE
    private $_tableMembres;
    
    ///////////////////////////////////////////////////////// MÉTHODES /////////////////////////////////////////////////////////
    
    // INSTANTIATION DE LA CONNEXION À LA BASE
    public function __construct() {
            $this->_pdo = new PDO($this->_host, $this->_user, $this->_pass);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_tableMembres = "membres";
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// INSCRIPTIONS /////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // SI LE PSEUDO EXISTE DÉJÀ
    public function userExist($pseudo, $email) {
        $req = $this->_pdo->prepare("SELECT * FROM $this->_tableMembres WHERE username = '".$pseudo."' OR email = '".$email."' LIMIT 1");
        $req->execute();
        return $req->rowCount();
    }
    
    // INSCRIPTION DES DONNÉES DU MEMBRE DANS LA BASE
    public function insertUser($pseudo, $email, $passconnect) {
        $req = $this->_pdo->prepare("INSERT INTO $this->_tableMembres (username, email, password) VALUES(?, ?, ?)");
        $req->execute(array($pseudo, $email, $passconnect));
    }
    
    // SESSIONS INSCRIPTION
    public function sessionSub($pseudo, $email) {
        $_SESSION['username'] = $pseudo;
        $_SESSION['email'] = $email;
    }
    
    // ERREUR INSCRIPTION
    public function subError($error) {
        $_SESSION['subError'] = $error;
        header("Location: ../index.php");
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// CONNEXION /////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // VERIFICATION COMPTE CONNEXION
    public function verifAccount($mailconnect, $passconnect) {
        $req = $this->_pdo->prepare("SELECT * FROM $this->_tableMembres WHERE email='".$mailconnect."' LIMIT 1");
        $req->execute();
        $result = $req->fetch(PDO::FETCH_OBJ);
        return password_verify($passconnect, $result->password);
    }
    
    // SESSIONS CONNEXION
    public function sessionCo($mailconnect) {
        $req = $this->_pdo->prepare("SELECT * FROM $this->_tableMembres WHERE email='".$mailconnect."' LIMIT 1");
        $req->execute();
        $result = $req->fetch(PDO::FETCH_OBJ);
        $_SESSION['username'] = $result->username;
        $_SESSION['email'] = $mailconnect;
    }
    
    // ERREURS CONNEXION
    public function conError($error) {
        $_SESSION['conError'] = $error;
        header("Location: ../index.php");
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// RESETPASS /////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // RÉCUPÉRATION ID DU MEMBRE
    public function recupReset($resmail) {
        $req = $this->_pdo->prepare("SELECT * FROM $this->_tableMembres WHERE email='".$resmail."'");
        $req->execute();
        $result = $req->fetch(PDO::FETCH_OBJ);
        return array($result->id_membre, $result->email);
    }
    
    // DEFINITION DU TOKEN DANS LA TABLE
    public function updateToken($token, $id) {
        $req = $this->_pdo->prepare("UPDATE $this->_tableMembres SET resetToken='".$token."' WHERE id_membre='".$id."' ");
        $req->execute();
    }
    
    // ENVOI DU MAIL AVEC LIEN CONTENANT TOKEN ET ID
    public function mailResetToken($email, $subject, $message) {
        mail($email, $subject, $message);
    }
    
    // SI TOKEN(MAIL) == TOKEN(TABLE)
   public function verifToken($id) {
       $req = $this->_pdo->prepare("SELECT * FROM $this->_tableMembres WHERE id_membre='".$id."'");
       $req->execute();
       $result = $req->fetch(PDO::FETCH_OBJ);
       $_SESSION['username'] = $result->username;
       $_SESSION['email'] = $result->email;
       return $result->resetToken;
   }
    
   // CHANGEMENT DU MOT DE PASSE
   public function passwordUpdate($password, $id) {
       $req = $this->_pdo->prepare("UPDATE $this->_tableMembres SET password='".$password."' WHERE id_membre='".$id."'");
       $req->execute();
   }
   
   //  ERREUR OUBLIE
   public function oublieError($error) {
        $_SESSION['oublieError'] = $error;
        header("Location: ../index.php");
    }
    
}