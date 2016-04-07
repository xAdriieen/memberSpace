<?php
session_start();

require 'class/user.class.php';
require 'class/Database.class.php';

$pdo = new Database();
$user = new user();

$password = htmlspecialchars($_POST['password']);
$confirm = htmlspecialchars($_POST['confirm']);



//var_dump($_SESSION);
$id = $_SESSION['id'];
if($password == $confirm) {
    $password = $user->crypt($password);
$echo = $pdo->passwordUpdate($password, $id);

}else{
    $pdo->passError("Les mots de passe ne correspondent pas !");
}