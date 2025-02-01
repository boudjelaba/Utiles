<?php
	require('config.php');

	//Début +++++++++++++++++++++++
	$nom = $mail = $mdp = "";
	$nom_err = $mail_err = $mdp_err = "";
	//Fin +++++++++++++++++++++++++

	if(isset($_POST['submit'])){
		//Début +++++++++++++++++++++++
		/* Validation du nom */
		$input_nom = trim($_POST["nom"]);
		if(empty($input_nom)){
		    $nom_err = "Entrer un nom.";
		    $message[] = 'Entrer un nom.';
		} elseif(!filter_var($input_nom, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
		    $nom_err = "Entrer un nom valide.";
		    $message[] = 'Entrer un nom valide.';
		} else{
		    $nom = stripslashes($input_nom);
		    $nom = mysqli_real_escape_string($conn, $nom);
		}
		//Fin +++++++++++++++++++++++++

		// $nom = stripslashes($_POST['nom']);
		// $nom = mysqli_real_escape_string($conn, $nom);

		//Début +++++++++++++++++++++++
		/* Validation du mail */
		$input_mail = trim($_POST["mail"]);
		if(empty($input_mail)){
		    $mail_err = "Entrer une adresse mail.";
		    $message[] = 'Entrer une adresse mail.';     
		} elseif(filter_var($input_mail,FILTER_VALIDATE_EMAIL)) {
		    $mail = stripslashes($input_mail);
		    $mail = mysqli_real_escape_string($conn, $mail);
		}
		//Fin +++++++++++++++++++++++++
		// $mail = stripslashes($_POST['mail']);
		// $mail = mysqli_real_escape_string($conn, $mail);

		//Début +++++++++++++++++++++++
		/* Validation du mot de passe */
		$input_mdp = trim($_POST["mdp"]);
		if(empty($input_mdp)){
		    $mdp_err = "Entrer un mot de passe.";
		    $message[] = 'Entrer un mot de passe.';     
		} else{
		    $mdp = stripslashes($input_mdp);
		    $mdp = mysqli_real_escape_string($conn, md5($mdp));
		}
		//Fin +++++++++++++++++++++++++
		// $mdp = stripslashes($_POST['mdp']);
		// $mdp = mysqli_real_escape_string($conn, md5($mdp));

		/* verifiez les erreurs avant enregistrement */
		if(empty($nom_err) && empty($mail_err) && empty($mdp_err)){
			$select = mysqli_query($conn, "SELECT * FROM `administrateurs` WHERE mail = '$mail' AND mot_de_passe = '$mdp'") or die('Erreur de requête');
			if(mysqli_num_rows($select) > 0){
				$message[] = 'Cet utilisateur existe déjà!';
			}else{
				mysqli_query($conn, "INSERT INTO `administrateurs`(nom, mail, mot_de_passe) VALUES('$nom', '$mail', '$mdp')") or die('Erreur de requête');
				$message[] = 'Compte créé avec succès!';
				header('location:login.php');
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<link rel="stylesheet" href="../css/styleR.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
	  href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap"
	  rel="stylesheet"
	/>
	<link
	  href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
	  rel="stylesheet"
	/>
	<title>Création de compte</title>
	<style>
		.MessageErreur {
		    background-color: #e66262;
		    border: #AA4502 1px solid;
		    padding: 5px 10px;
		    color: #FFFFFF;
		    border-radius: 3px;
		}
	</style>
</head>

<body>
	<!-- +++++++++++++++++ -->
	<header>
		<!-- <a href="https://carnus.fr" target="_blank"><img src="logo1.pdf" alt="logo"></a> -->
		<img src="../images/logo2.pdf" alt="logo">
		<nav>
			<ul class="nav_links">
				<li>
					<span class="nav-item active">
						<a href="../public/accueil.php">
							<span class="icon">
								<i class="fa-regular fa-house"></i>
							</span>
							&nbsp; Accéder Au Site
						</a>
					</span>
				</li>

			<!-- </ul> -->
		</nav>

		<section class="cta">
			<div class="imgcirc" style="background-image: url('<?php if(isset($_SESSION['utilisateur'])){ echo $_SESSION['image'];}
				else echo "../images/image.jpg";?>'); background-position: 5% 65%; background-size: cover;">
			</div>
			<ul>
				<?php if(isset($_SESSION['utilisateur'])){ echo 
					'<a href="compte.php">
					<li class="sub-item">
					<span class="material-icons-outlined">
					grid_view </span>
					<p>Mon compte</p>
					</li></a>
					<a href="compte.php">
					<li class="sub-item">
						<span class="material-icons-outlined"> manage_accounts </span>
						<p>Modifier Profile</p>
					</li></a>
					<a href="logout.php">
					<li class="sub-item">
						<span class="material-icons-outlined"> logout </span>
						<p>Déconnexion</p>
					</li></a>' ;}
				else { echo 
					'<a href="login.php">
					<li class="sub-item">
					<span class="material-icons-outlined"> login </span>
					<p>Se connecter</p>
					</li></a>
					
					<a href="register.php">
					<li class="sub-item">
						<span class="material-icons-outlined"> person_add </span>
						<p>Créer un compte</p>
					</li></a>
					' ;} ?>
			</ul>
		</section>
			</ul>
	</header>

	<!-- +++++++++++++++++ -->

	<?php
	if(isset($message) && isset($_POST['submit'])){
		foreach($message as $message){
			echo '<div class="MessageErreur" onclick="this.remove();">'.$message.'</div>';
		}
	}
	?>
	

	<form class="box" action="" method="post">
		<h1 class="box-logo box-title"><a href="https://carnus.fr/" target="_blank"><img src="../images/logo_m.png" width="240px" alt=""></a></h1>
		<h1 class="box-title">Inscription <i class="fa-solid fa-user-plus"></i></h1>
		<input type="text" class="box-input" name="nom" placeholder="Nom"  />
		<input type="email" class="box-input" name="mail" placeholder="Adresse Mail"  />
		<input type="password" class="box-input" name="mdp" placeholder="Mot de passe"  />
		<input type="submit" name="submit" value="Envoyer" class="box-button" />
		<p class="box-register">Vous avez un compte ? <a href="login.php">Se connecter</a></p>
	</form>


	<footer class="footer">
	  	 <div class="container">
	  	 	<div class="row">
	  	 		<div class="footer-col">
	  	 			<h4>Carnus</h4>
	  	 			<ul>
	  	 				<li><a href="https://www.carnus.fr/formations/bts-cybersecurite-informatique-et-reseaux-electronique-option-informatique-et-reseaux/" target="_blank">BTS CIEL</a></li>
	  	 				<li><a href="https://carnus.fr" target="_blank">carnus.fr</a></li>
	  	 			</ul>
	  	 		</div>
	  	 		<div class="footer-col">
	  	 			<h4>Sites</h4>
	  	 			<ul>
	  	 				<li><a href="../public/accueil.php">Accéder au site</a></li>
	  	 				<li><a href="https://www.ecoledirecte.com/login?cameFrom=%2FAccueil">Ecole directe</a></li>
	  	 			</ul>
	  	 		</div>
	  	 		<div class="footer-col">
	  	 			<h4>Contact</h4>
	  	 			<ul>
	  	 				<li><a href="mailto:lycee@carnus.fr"><i class="fa-solid fa-envelope"></i>&nbsp;lycee@carnus.fr</a></li>
	  	 				<li><a href="tel:+33565733700"><i class="fa-solid fa-phone"></i>&nbsp;05 65 73 37 00</a></li>
	  	 			</ul>
	  	 		</div>
	  	 		<div class="footer-col">
	  	 			<h4>Nos réseaux</h4>
	  	 			<div class="social-links">
	  	 				<a href="https://www.facebook.com/lyceecarnus/" target="_blank"><i class="fab fa-facebook-f"></i></a>
	  	 				<a href="https://www.instagram.com/instacharlescarnusrodez/" target="_blank"><i class="fab fa-instagram"></i></a>
	  	 				<a href="https://www.linkedin.com/company/charlescarnusrodez/?viewAsMember=true" target="_blank"><i class="fab fa-linkedin-in"></i></a>
	  	 			</div>
	  	 		</div>
	  	 	</div>
	  	 </div>
	  </footer>

</body>
</html>