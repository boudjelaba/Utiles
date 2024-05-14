<?php
@include '../admin/config.php';
//require_once("../admin/config.php");
//@include '../admin/compteur.php';
$sql1 = "SELECT * FROM photos";
if ($resultat = mysqli_query($conn,$sql1)) {
    $nbre_photos = mysqli_num_rows($resultat); 
}
$ti = $nbre_photos*5;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300">
	<link rel="stylesheet" href="../css/meteoKB.css">

	<meta http-equiv="refresh" content="<?php echo $ti ?>;URL= infos.php">

	<script src= 
	"https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script> 

	<title>Images</title>
</head>

<!-- https://api.openweathermap.org/data/2.5/forecast?lon=2.57&lat=44.35&appid=54a57bc234ad752a4f59e59cd372201d&units=metric&lang=fr -->

<body>
	<header>
		<img src="../images/logo2.pdf" width="150px" alt="logo">
		<nav>
			<ul class="nav_links">
				<li>
					<span class="nav-item" style="color:#F2A900;font-size:1.2rem;">
					<i class="fa-solid fa-envelope"></i>&nbsp;lycee@carnus.fr</span>
				</li>
				<li>
					<span class="nav-item" style="color:#F2A900;font-size:1.2rem;">
					<i class="fa-solid fa-phone"></i>&nbsp;05 65 73 37 00</span>
				</li>
				<li>
					<span class="nav-item">
						<span id="jour1" style="color:#F2A900;font-size:1.6rem;padding-left: 2rem;">Mardi</span>
						<span id="date1" style="color:#F2A900;font-size:1.6rem;">12</span>
						<span id="mois1" style="color:#F2A900;font-size:1.6rem;">Mars</span>
						<span id="annee1" style="color:#F2A900; font-size:1.6rem;">2024</span>
					</span>
				</li>
				<li>
					<span class="nav-item">
						<span class="display-time" style="color:#F2A900; font-size: 1.6rem;padding-left: 2rem;"></span>
					</span>
				</li>
		</nav>
			<section class="cta">
				<div class="imgcirc" style="background-image: url('../images/image.jpg'); background-position: 5% 65%; background-size: cover;">
				</div>
			</section>
			</ul>
	</header>


	<div id="wrapper">

		<div id="content1">
			<div id="slideshow-example" data-component="slideshow">
				<?php
					$select_images = mysqli_query($conn, "SELECT image FROM `photos`");
					if(mysqli_num_rows($select_images) > 0){
						WHILE ($row = mysqli_fetch_assoc($select_images)){
				?>

				<div role="list">
					<div class="slide">
						<img src="../admin/img/<?php echo $row['image']; ?>" alt="">
					</div>
				</div>
				<?php
				   };    
				   }else{
				      echo "<div class='empty'>Aucune image ajoutée</div>";
				   };
				?>
			</div>
		</div>


		<div id="rightcolumn1">
			<table>
				<colgroup>
					<col span="1" style="width: 50%;">
					<col span="1" style="width: 50%;">
				</colgroup>
				<tr>
					<th colspan="2">
						Nos réseaux
					</th>
				</tr>
				<tr class="blank_row">
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td>
						<div class="footer-col">
							<h4><i class="fab fa-facebook-f"></i></h4>
							<div class="fqrcode"></div>
						</div>
					</td>
					<td>
						<div class="footer-col">
							<h4><i class="fab fa-instagram"></i></h4>
							<div class="iqrcode"></div>
						</div>
					</td>
				</tr>
				<tr class="blank_row">
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td>
						<div class="footer-col">
							<h4><i class="fab fa-linkedin-in"></i></h4>
							<div class="lqrcode"></div> 
						</div>
					</td>
					<td>
						<div class="footer-col">
							<h4><i class="fa-solid fa-house"></i></h4>
							<div class="hqrcode"></div> 
						</div>
					</td>
				</tr>
			</table>		
		</div>	
	</div>



<script>
	let fqrcode = new QRCode(document.querySelector(".fqrcode"),
		{
			width: 128,
			height: 128,
			colorDark : "#0165E1",
			colorLight : "#F2A90022"
		});
	fqrcode.makeCode("https://www.facebook.com/lyceecarnus/");
	let iqrcode = new QRCode(document.querySelector(".iqrcode"),
		{
			width: 128,
			height: 128,
			colorDark : "#F56040",
			colorLight : "#F2A90022"
		});
	iqrcode.makeCode("https://www.instagram.com/instacharlescarnusrodez/");
	let lqrcode = new QRCode(document.querySelector(".lqrcode"),
		{
			width: 128,
			height: 128,
			colorDark : "#0A66C2",
			colorLight : "#F2A90022"
		});
	lqrcode.makeCode("https://fr.linkedin.com/school/charlescarnusrodez/");

	let hqrcode = new QRCode(document.querySelector(".hqrcode"),
		{
			width: 128,
			height: 128,
			colorDark : "rgb(0,68,88)",
			colorLight : "#F2A90022"
		});
	hqrcode.makeCode("https://carnus.fr");
</script>


<script>
	var slideshows = document.querySelectorAll('[data-component="slideshow"]');
	slideshows.forEach(initSlideShow);

	function initSlideShow(slideshow) {

		var slides = document.querySelectorAll(`#${slideshow.id} [role="list"] .slide`);

		var index = 0, time = 5000;
		slides[index].classList.add('active');

		setInterval( () => {
			slides[index].classList.remove('active');
			
			index++;
			if (index === slides.length) index = 0;

			slides[index].classList.add('active');

		}, time);
	}
</script>

  <script src="../js/meteoKB.js"></script>
  <script src="../js/date.js"></script>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</body>
</html>