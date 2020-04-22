<?php

require_once("Database.php");
require_once("User.php");
$conect=new Database("localhost","userBDD","root","");
$bdd=$conect->PDOConnexion();


$email =$_POST['email'];
$pass =$_POST['pass'];
$user1 = new User($email,$pass);
$user1->inscription($bdd);



?>
