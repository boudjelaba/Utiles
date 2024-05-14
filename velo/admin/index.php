<?php 
	require_once("config.php");
	//include 'config.php';
	@include 'compteur.php';

	session_start();
	$id_admin = $_SESSION['id_admin'];

	if(!isset($id_admin)){
	   header('location:login.php');
	};

	if(isset($_GET['logout'])){
	   unset($id_admin);
	   session_destroy();
	   header('location:login.php');
	};
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link
	  href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
	  rel="stylesheet"
	/>
	<!--  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.core.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" />
	<link rel="stylesheet" href="../css/stylecal.css" />
	<!--  -->
	<!-- <link rel="stylesheet" href="../css/meteoKB.css"> -->
	<link rel="stylesheet" href="../css/styleR.css">
	<!-- <meta http-equiv="refresh" content="5;URL= admin-image.php"> -->
	<title>Tableau de bord </title>
</head>
<body>

	<!--***************************************
	Calendrier Calendrier Calendrier Calendrier
	↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ -->
	<script src="../js/script1.js"></script>

	<header>
		<!-- <a href="https://carnus.fr" target="_blank"><img src="logo_m.png" alt="logo"></a> -->
		<img src="../images/logo2.pdf" width="150px" alt="logo">
		<nav>
			<ul class="nav_links">

				<li>
					<span class="nav-item active">
						<a href="index.php">
							<span class="icon">
								<i class="fa-regular fa-house"></i>
							</span>
							&nbsp; Accueil
						</a>
					</span>
				</li>
				<li>
					<span class="nav-item">
						<a href="admin-image.php">
							<span class="icon">
								<i class="fa-solid fa-photo-film"></i>
							</span>
							&nbsp; Images
						</a>
					</span>
				</li>
				<li>
					<span class="nav-item">
						<a href="admin-info.php">
							<span class="icon">
								<i class="fa-solid fa-newspaper"></i>
							</span>
							&nbsp; Infos
						</a>
					</span>
				</li>
				<li>
					<span class="nav-item">
						<a href="../public/accueil.php" target="_blank">
							<span class="icon">
								<i class="fa-solid fa-globe"></i>
							</span>
							&nbsp; Accéder Au Site
						</a>
					</span>
				</li>

		</nav>


		<section class="cta">
			<!-- <div class="imgcirc" style="background-image: url('<?php if(isset($_SESSION['id_admin'])){ echo $_SESSION['image'];}
				else echo "../images/image.jpg";?>'); background-position: 5% 65%; background-size: cover;">
			</div> -->

			<div class="imgcirc" style="background-image: url('<?php if(isset($_SESSION['id_admin'])){ echo "../images/admin2.jpeg";}
				else echo "../images/image.jpg";?>'); background-position: 5% 65%; background-size: cover;">
			</div>
			<ul>
				<?php if(isset($_SESSION['id_admin'])){ echo 
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



<!-- <?php 
	echo $nbre_infos;
	echo '<br>';
	echo $nbre_photos;
?> -->


	<section2>
		<div class="wrapper">
			<div class="c-monthyear">
				<div class="c-month">
					<span id="prev" class="prev fa fa-angle-left" aria-hidden="true"></span>
					<div id="c-paginator">
						<span class="c-paginator__month">JANVIER</span>
						<span class="c-paginator__month">FEVRIER</span>
						<span class="c-paginator__month">MARS</span>
						<span class="c-paginator__month">AVRIL</span>
						<span class="c-paginator__month">MAI</span>
						<span class="c-paginator__month">JUIN</span>
						<span class="c-paginator__month">JUILLET</span>
						<span class="c-paginator__month">AOUT</span>
						<span class="c-paginator__month">SEPTEMBRE</span>
						<span class="c-paginator__month">OCTOBRE</span>
						<span class="c-paginator__month">NOVEMBRE</span>
						<span class="c-paginator__month">DECEMBRE</span>
					</div>
					<span id="next" class="next fa fa-angle-right" aria-hidden="true"></span>
				</div>
				<span class="c-paginator__year">2024</span>
			</div>
			<div class="c-sort">
				<a class="o-btn c-today__btn" href="javascript:;">AUJOURD'HUI</a>
			</div>
		</div>
	</section2>

	<div class="wrapper">
		<div class="c-calendar">
			<div class="c-calendar__style c-aside">

				<div class="hero">
				  <div class="calendars">
				    <div class="left">
				      <div class="herop" id="date1" style="color:darkgrey;">12</div>
				      <div class="herop" id="jour1" style="color:darkgrey;">Mardi</div>
				    </div>
				    <div class="right">
				      <div class="herop" id="mois1" style="color:white;">Mars</div>
				      <div class="herop" id="annee1" style="color:white;">2024</div>
				    </div>
				  </div>
				</div>

				<div class="c-aside__day">
					<span class="c-aside__num"></span> <span class="c-aside__month"></span>
				</div>

				<div class="c-aside__eventList">
				</div>
			</div>
			<div class="c-cal__container c-calendar__style">
				<script>
	      // Année actuelle
					year = 2024;

	      // 1er jour de semaine de la nouvelle année
					today = new Date("January 1, " + year);
					start_day = today.getDay() + 1;
					fill_table("Janvier", 31, "01");
					fill_table("Février", 29, "02");
					fill_table("Mars", 31, "03");
					fill_table("Avril", 30, "04");
					fill_table("Mai", 31, "05");
					fill_table("Juin", 30, "06");
					fill_table("Juillet", 31, "07");
					fill_table("Août", 31, "08");
					fill_table("Septembre", 30, "09");
					fill_table("Octobre", 31, "10");
					fill_table("Novembre", 30, "11");
					fill_table("Décembre", 31, "12");
				</script>
			</div>

		</div>

	</div>


	<!--***************************************
	Calendrier Calendrier Calendrier Calendrier
	↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ -->
	<script src="../js/script2.js"></script>

	<!--***************************************
	Date Date Date Date Date Date Date Date
	↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ -->
	<script src="../js/date2.js"></script>






	</body>
</html>