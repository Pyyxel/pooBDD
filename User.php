<?php
    class User{
        private $email;
        private $pass;

        public function __construct($email,$pass){
            $this->email=$email;
            $this->pass=$pass;
        }

        public function verifConect($bdd){
            $req=$bdd->prepare("SELECT * FROM User WHERE email = ? AND mdp = ?");
            $req->execute([$this->email,$this->pass]);
        
            $count = $req->rowCount();
            
            if($count > 0)
            {
                session_start();
                $_SESSION['email'] = $this->email;
                $_SESSION['pass'] = $this->pass;
                
                header("location:tab-admin/index.php");
            }
            else
            {
                
            //Mauvais identifiant ou mauvais tout cours
            header("location:index.php");
            }
        }

        public function inscription($bdd){
            if((!empty($this->email)) && (!empty($this->pass))){
                $req=$bdd->prepare("SELECT * FROM User WHERE email = ?");
                $req->execute([$this->email]);
                $count= $req->rowCount();
                var_dump($count);
                if ($count==0){
                    $req=$bdd->prepare("INSERT INTO User SET email = ?, mdp = ?");
                    $req->execute([$this->email,$this->pass]);
                    echo "Inscription reussie";
                    echo '<a href="index.php">conectez vous</a>';
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