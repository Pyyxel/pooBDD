<?php
    class User{
        private $email;
        private $pass;
        private $token;
        private $valid;

        public function __construct($email,$pass){
            $this->email=$email;
            $this->pass=$pass;
            $this->token=substr(str_shuffle(str_repeat("0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN", 40)), 0, 40);
            $this->valid=0;
        }

        

        public function verifToken($bdd){
            $bool=false;
            $req=$bdd->prepare("SELECT valid FROM User WHERE email = ?");
            $req->execute([$this->email]);
            $valid=$req->fetch();
            if($valid['valid']==1){
                $bool=true;
            }
            return $bool;
        }


        public function verifConect($bdd){
            $req=$bdd->prepare("SELECT * FROM User WHERE email = ? AND mdp = ?");
            $req->execute([$this->email,$this->pass]);
            $donnee=$req->fetch();
            
            $count = $req->rowCount();
            var_dump($this->verifToken($bdd));
            if($count > 0){
                if($this->verifToken($bdd)){
                    session_start();
                    $this->valid=1;
                    $_SESSION['email'] = $this->email;
                    $_SESSION['pass'] = $this->pass;
                    $_SESSION['valid']= $this->valid;
                    header("location:tab-admin/index.php");
                }else{
                    $_SESSION['email'] = $this->email;
                    $_SESSION['pass'] = $this->pass;
                    echo "verifiez la confirmation de votre adresse mail <br>";
                    echo '<a href="index.php">Retournez a lacceuil</a>';
                }
            }else{
                
                //Mauvais identifiant ou mauvais tout cours
                header("location:index.php");
            }
        }

        public function inscription($bdd){
            if((!empty($this->email)) && (!empty($this->pass))){
                $req=$bdd->prepare("SELECT * FROM User WHERE email = ?");
                $req->execute([$this->email]);
                $count= $req->rowCount();
                if ($count==0){
                    $req=$bdd->prepare("INSERT INTO User SET email = ?, mdp = ?, token = ?");
                    $req->execute([$this->email,$this->pass,$this->token]);
                    echo "Inscription reussie <br> verifiez votre mail";
                }else{
                    echo "mail deja pris";
                    echo '<a href="inscription.php">Réésayez</a>';
                }
                
            }else{
                echo "erreur";
            }
        }
        
       
    }

       
            
?>  