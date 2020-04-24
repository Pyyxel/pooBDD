<?php
	require_once("Database.php");
	$tokenmdp=$_GET['token'];
	$conect=new Database("localhost","userBDD","root","");
    $bdd=$conect->PDOConnexion();
    $req=$bdd->prepare("SELECT * FROM User WHERE token=?");
    $req->execute([$tokenmdp]);
	$count=$req->rowCount();
    if($count==1){
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>

        <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form" action="traitementchangermdp.php?token=<?php echo $tokenmdp?>" method="post">

					<span class="login100-form-title p-b-48">
						<img src="images/logo.jpg" alt="Logo Agence Automobile Ardennaise" height="100px" style="top:3px;">
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="email"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="mdpactuel">
						<span class="focus-input100" data-placeholder="mdp actuel"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="newmdp">
						<span class="focus-input100" data-placeholder="nouveau mdp"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="newmdp2">
						<span class="focus-input100" data-placeholder="confirmation du nouveau mdp"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								changer le mot de passe
							</button>
						</div>
					</div>
				</form>
			</div>


</body>
</html>
<?php    
    }else{
		echo "le lien a été  envoyé dans la boite mail";	
	}
    
?>