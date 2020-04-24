<?php   
    require_once("Database.php");
    if((isset($_POST['mdpactuel'])) && (isset($_POST['newmdp'])) && (isset($_POST['newmdp2'])) && (isset($_POST['email']))){
        $mdpact=$_POST['mdpactuel'];
        $newmdp=$_POST['newmdp'];
        $newmdpconf=$_POST['newmdp2'];
        $email=$_POST['email'];
        $token=$_GET['token'];


        $conect=new Database("localhost","userBDD","root","");
        $bdd=$conect->PDOConnexion();


       
        $req=$bdd->prepare("SELECT email FROM User WHERE token = ? ");
        $req->execute([$token]);
        $emailverif=$req->fetch();
        

        if(($newmdp==$newmdpconf) AND ($email==$emailverif['email'])){
            $req=$bdd->prepare("SELECT * FROM User WHERE email = ? AND mdp = ?");
            $req->execute([$email,$mdpact]);
            $count=$req->rowCount();
            if($count==1){
                $req=$bdd->prepare("UPDATE User SET mdp = ? WHERE email = ?");
                $req->execute([$newmdp,$email]);
                echo "Le mot de passe a bien été changé <br>";
                echo '<a href="index.php">retourner a lacceuil</a>';
            }else{
                echo "erreur rééssayé";
                echo '<a href="index.php">acceuil</a>';
            }
        }else{
            
            echo "erreur rééssayé";
            echo '<a href="index.php">acceuil</a>';
        }
    }else{
        echo "erreur rééssayé";
        echo '<a href="index.php">acceuil</a>';
    }

?>