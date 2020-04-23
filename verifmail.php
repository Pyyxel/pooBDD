<?php 

    require_once("User.php");
    require_once("Database.php");
    
    $token=$_GET['token'];
    $conect=new Database("localhost","userBDD","root","");
    $bdd=$conect->PDOConnexion();


    $req=$bdd->prepare("SELECT * FROM User WHERE token = ?");
    $req->execute([$token]);
    $count = $req->rowCount();
    if($count>0){
        $req=$bdd->prepare("UPDATE User SET valid = ? WHERE token = ?");
        $req->execute([1,$token]);
        echo "Le mail a bien été validé connectez vous pour acceder a la page admin <br>";
        echo '<a href="index.php">COnectez vous</a>';
    }


?>