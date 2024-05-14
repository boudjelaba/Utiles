<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300">
	<link rel="stylesheet" href="../css/meteoKB.css">

	<meta http-equiv="refresh" content="8;URL= accueil.php">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

  <style type="text/css">

    .Conteneur{
/*    	position: relative;*/
    	width: 100%;
    	height: 100%;
    	display:flex;
    	flex-direction:column;
    	white-space: nowrap;
    	overflow: hidden;
    	box-sizing: border-box;
    }

    /* Texte défilant */
    .messagedefilant {
    	margin: auto;
    	display: inline-block;
      	width: 100%;
      	font-size: 1.4rem;
      	color: rgb(0,68,88);
    }

    b{ font-weight: 600; }

    	
    .messagedefilant div {
      position: absolute;
      transform: translateY(-50%);
      min-width: 100%;
    }

    .messagedefilant div span {
      left:0;
    }
    	
    /* Animation */
    .messagedefilant div span:first-child {
      animation: defilement 20s infinite linear; /* Vitesse de défillement !!! les 2 vitesses doivent être identique !!! */
    }
     
    .messagedefilant div span:last-child {
      position: absolute;
      animation: defilement2 20s infinite linear; /* Vitesse de défillement !!! les 2 vitesses doivent être identique !!! */
    }
     
    @keyframes defilement {
      0% { margin-left: 0; }
      100% { margin-left: -100%; }
    }
     
    @keyframes defilement2 {
      0% { margin-left: 100%; }
      100% { margin-left: 0%; }
    }
    </style>


	<title>Météo</title>
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


	<div class="container">
		<div class="weather-side">
			<div class="weather-gradient"></div>
			<div class="weather-container">			
				<table class="table2">
					<colgroup>
						<col span="1" style="width: 10%;">
						<col span="1" style="width: 53%;">
						<col span="1" style="width: 37%;">
					</colgroup>
					<tr>
						<th colspan="3">Local à vélos</th>
					</tr>
					<tr>
						<td><i class="fa-solid fa-sun"></i></td>
						<td>Soleil</td>
						<td>Test1 Wh/m<sup>2</sup></td>
					</tr>
					<tr>
						<td><i class="fa-solid fa-temperature-low"></i></td>
						<td>Température</td>
						<td>Test2 °C</td>
					</tr>
					<tr>
						<td><i class="fa-solid fa-droplet"></i></td>
						<td>Humidité</td>
						<td>Test3 %</td>
					</tr>
					<tr>
						<td><i class="fa-solid fa-wind"></i></td>
						<td>Vitesse du vent</td>
						<td>Test km/h</td>
					</tr>
					<tr>
						<td><i class="fa-regular fa-compass"></i></td>
						<td>Direction du vent</td>
						<td>Test</td>
					</tr>
					<tr>
						<td><i class="fa-solid fa-solar-panel"></i></td>
						<td>Panneau solaire</td>
						<td>Test</td>
					</tr>
					<tr>
						<td><i class="fa-solid fa-battery-full"></i></td>
						<td>Batterie</td>
						<td>Test %</td>
					</tr>
					<tr>
						<td><i class="fa-solid fa-bicycle"></i></td>
						<td>Vélos</td>
						<td>
							Test
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<br>
							<img src="../images/logo_m.png" width="50%" alt="">
						</td>
					</tr>
				</table>
			</div>
		</div>


		<div class="info-side">
			<div class="today-info-container">
				<div class="today-info">
					<div class="date-container">
						<table>
							<tr>
								<td>
									<h2 class="date-dayname"></h2>
									<span class="date-day"></span>
									<i class="fa-solid fa-location-dot"></i>
									<span class="location"></span>
								</td>
								<td>
									&nbsp;
								</td>
								<td>
									<i class="fa-solid fa-sun"></i><i class="fa-solid fa-up-long"></i> <span class="sunrise"></span>
									<br><br>
									<i class="fa-solid fa-sun"></i><i class="fa-solid fa-down-long"></i></i> <span class="sunset"></span>
								</td>
							</tr>
						</table>
					</div>

					<div class="weather-icon">
						<span class="value"></span>
						<div class="clear"></div>
					</div>
					<div class="weather-desc">
						<span class="value"></span>
						<div class="clear"></div>
					</div>

					<hr style="height:2px;border-width:0;color:#F2A900;background-color:#F2A900; opacity:0.7;margin-left:-2px;margin-top:0px;margin-bottom: 6px;">

					<div class="weather-temp">
						<span class="title" style="font-variant: small-caps;"><i class="fa-solid fa-temperature-low"></i> Température</span>
						<span class="value"></span>
						<div class="clear"></div>
					</div>

					<div class="humidity">
						<span class="title" style="font-variant: small-caps;"><i class="fa-solid fa-droplet"></i> Humidité</span>
						<span class="value"></span>
						<div class="clear"></div>
					</div>

					<div class="wind">
						<span class="title" style="font-variant: small-caps;"><i class="fa-solid fa-wind"></i> Vitesse du vent</span>
						<span class="value"></span>
						<div class="clear"></div>
					</div>

					<div class="direction">
						<span class="title" style="font-variant: small-caps;"><i class="fa-regular fa-compass"></i> Direction du vent</span>
						<span class="value"></span>
						<div class="clear"></div>
					</div>

				</div>
			</div>

			<div class="week-container">
				<ul class="week-list">
				    <li>
                <span class="day-name"></span>
                <span class="day-temp"></span>
                <span class="day-icon"></span>
            </li>
            <li>
                <span class="day-name"></span>
                <span class="day-temp"></span>
                <span class="day-icon"></span>
            </li>
            <li>
                <span class="day-name"></span>
                <span class="day-temp"></span>
                <span class="day-icon"></span>
            </li>
            <li>
                <span class="day-name"></span>
                <span class="day-temp"></span>
                <span class="day-icon"></span>
            </li>
            <div class="clear"></div>
        </ul>
    </div>
</div>

</div>


<footer class="footer">
	<div class="marquee-rtl" id="marqueeContainer">
	</div>
</footer>


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
	<script src="../js/actu.js"></script>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


<!-- Text défilant -->
<!-- Text défilant -->
<!-- Text défilant -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	<script language="javascript">
		function marqueelike() {
			$('.messagedefilant').each(function() {
				var texte = $(this).html();
				$(this).html('<div><span>' + texte + '</span><span>' + texte + '</span></div>');
			});
		}

		$(window).on('load', function() {
			marqueelike();
		});
	</script>

</body>
</html>