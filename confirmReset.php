<?php
session_start();
require 'traitement/class/Database.class.php';


$pdo = new Database();

$id = $_GET['id'];
$token = $_GET['token'];
   

$resetToken = $pdo->verifToken($id);

if ($token == $resetToken) {
    $_SESSION['id'] = $id;
    header('Location: resetpassword.php');
    
}else {
    
    echo 'connard';
    
}