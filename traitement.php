<?php

require_once("Database.php");
require_once("User.php");
$conect=new Database("localhost","userBDD","root","");
$bdd=$conect->PDOConnexion();


$email = !empty($_POST['email']) ? $_POST['email'] : NULL;
$pass = !empty($_POST['pass']) ? $_POST['pass'] : NULL;
$user1 = new User($email,$pass);
$user1->verifConect($bdd);



?>
