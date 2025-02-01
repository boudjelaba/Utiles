<?php
@include '../admin/config.php';
//require_once("../admin/config.php");
//@include '../admin/compteur.php';

$sql2 = "SELECT * FROM informations";
if ($resultat2 = mysqli_query($conn,$sql2)) {
    $nbre_infos = mysqli_num_rows($resultat2); 
}
$t = $nbre_infos*5;
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
	<link rel="stylesheet" href="../css/style_info.css">

	<!-- <meta http-equiv="refresh" content="<?php echo $t ?>;URL= meteo.php"> -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script> 
	<title>Informations</title>
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

		<div id="leftcolumn">
			<h3>Portes ouvertes</h3>
			<p>Etudiants de 2ème année</p>
		</div>


		<div id="content">
				<div class="demo-cont">
				  <!-- slider start -->
				  <div class="fnc-slider example-slider">
				    <div class="fnc-slider__slides">

			    	<?php
			    		$select_info = mysqli_query($conn, "SELECT * FROM `informations`");
			    		if(mysqli_num_rows($select_info) > 0){
			    			while($row = mysqli_fetch_assoc($select_info)){
			    	?>
				      <!-- slide 1 start -->
				      <div class="fnc-slide m--blend-green m--active-slide">
				        <div class="fnc-slide__inner">
				          <div class="fnc-slide__mask">
				            <div class="fnc-slide__mask-inner"></div>
				          </div>
				          <div class="fnc-slide__content">
				            <h2 class="fnc-slide__heading">
				              <div class="fnc-slide__heading-line">
				                <span><?php echo $row['titre']; ?></span>
				              </div>
				            </h2>
				            <div class="fnc-slide__heading-line">
				              <span><?php echo $row['détails']; ?></span>
				            </div>
				          </div>
				        </div>
				      </div>
				      <!-- slide end -->
				      <?php
				         };    
				         }else{
				            echo "<div class='empty'>Aucune information ajoutée</div>";
				         };
				      ?>
				    </div>

				    <nav class="fnc-nav">
				      <div class="fnc-nav__bgs">

				      	<?php
				      	$x = $nbre_infos-1;
				      		$select_info1 = mysqli_query($conn, "SELECT * FROM `informations` LIMIT 1");
				      		if(mysqli_num_rows($select_info1) > 0){
				      			while($row1 = mysqli_fetch_assoc($select_info1)){
				      	?>
				      	<div class="fnc-nav__bg m--navbg-blue m--active-nav-bg"></div>
				      	<?php
				      	   };    
				      	      }else{
				      	         echo "<div class='empty'>Aucune information ajoutée</div>";
				      	      };
				      	?>

				        <?php
				        $x = $nbre_infos-1;
				        	$select_infoT = mysqli_query($conn, "SELECT * FROM informations LIMIT $x OFFSET 1");
				        	if(mysqli_num_rows($select_infoT) > 0){
				        		while($rowT = mysqli_fetch_assoc($select_infoT)){
				        ?>
				           <div class="fnc-nav__bg m--navbg-blue"></div>
				           <?php
				              };    
				              }else{
				                 echo "<div class='empty'>Aucune information ajoutée</div>";
				              };
				           ?>
				      </div>
				      <div class="fnc-nav__controls">
				      	<?php
				      		$select_infoB = mysqli_query($conn, "SELECT * FROM `informations`");
				      		if(mysqli_num_rows($select_infoB) > 0){
				      			while($rowB = mysqli_fetch_assoc($select_infoB)){
				      	?>
				        <button class="fnc-nav__control">
				          <?php echo $rowB['filière']; ?>
				          <span class="fnc-nav__control-progress"></span>
				        </button>
				        <?php
				           };    
				           }else{
				              echo "<div class='empty'>Aucune information ajoutée</div>";
				           };
				        ?>
				      </div>
				    </nav>
				  </div>
				  <!-- slider end -->

				</div>
		</div>

		<div id="rightcolumn">
			<table>
				<!-- <colgroup>
					<col span="1" style="width: 100%;">
				</colgroup> -->
				<!-- <tr>
					<th>
						Ecole directe
					</th>
				</tr> -->
				<!-- <tr class="blank_row">
					<td>&nbsp;</td>
				</tr> -->
				<tr>
					<td>
						<div class="footer-col1">
							<h4><i class="fa-solid fa-graduation-cap"></i> Ecole directe</h4>
							<div class="eqrcode"></div>
						</div>
					</td>
				</tr>
			</table>
		</div>
		
	</div>


<!-- <footer class="footer">
  	 bas de page
  </footer> -->


<script>
	let eqrcode = new QRCode(document.querySelector(".eqrcode"),
		{
			width: 148,
			height: 148,
			colorDark : "rgb(0,68,88)",
			colorLight : "#F2A900"
		});
	eqrcode.makeCode("https://www.ecoledirecte.com/login?cameFrom=%2FAccueil");
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

	<script>
		(function() {

		  var $$ = function(selector, context) {
		    var context = context || document;
		    var elements = context.querySelectorAll(selector);
		    return [].slice.call(elements);
		  };

		  function _fncSliderInit($slider, options) {
		    var prefix = ".fnc-";

		    var $slider = $slider;
		    var $slidesCont = $slider.querySelector(prefix + "slider__slides");
		    var $slides = $$(prefix + "slide", $slider);
		    var $controls = $$(prefix + "nav__control", $slider);
		    var $controlsBgs = $$(prefix + "nav__bg", $slider);
		    var $progressAS = $$(prefix + "nav__control-progress", $slider);

		    var numOfSlides = $slides.length;
		    var curSlide = 1;
		    var sliding = false;
		    var slidingAT = +parseFloat(getComputedStyle($slidesCont)["transition-duration"]) * 1000;
		    var slidingDelay = +parseFloat(getComputedStyle($slidesCont)["transition-delay"]) * 1000;

		    var autoSlidingActive = false;
		    var autoSlidingTO;
		    var autoSlidingDelay = 5000; // default autosliding delay value
		    var autoSlidingBlocked = false;

		    var $activeSlide;
		    var $activeControlsBg;
		    var $prevControl;

		    function setIDs() {
		      $slides.forEach(function($slide, index) {
		        $slide.classList.add("fnc-slide-" + (index + 1));
		      });

		      $controls.forEach(function($control, index) {
		        $control.setAttribute("data-slide", index + 1);
		        $control.classList.add("fnc-nav__control-" + (index + 1));
		      });

		      $controlsBgs.forEach(function($bg, index) {
		        $bg.classList.add("fnc-nav__bg-" + (index + 1));
		      });
		    };

		    setIDs();

		    function afterSlidingHandler() {
		      $slider.querySelector(".m--previous-slide").classList.remove("m--active-slide", "m--previous-slide");
		      $slider.querySelector(".m--previous-nav-bg").classList.remove("m--active-nav-bg", "m--previous-nav-bg");

		      $activeSlide.classList.remove("m--before-sliding");
		      $activeControlsBg.classList.remove("m--nav-bg-before");
		      $prevControl.classList.remove("m--prev-control");
		      $prevControl.classList.add("m--reset-progress");
		      var triggerLayout = $prevControl.offsetTop;
		      $prevControl.classList.remove("m--reset-progress");

		      sliding = false;
		      var layoutTrigger = $slider.offsetTop;

		      if (autoSlidingActive && !autoSlidingBlocked) {
		        setAutoslidingTO();
		      }
		    };

		    function performSliding(slideID) {
		      if (sliding) return;
		      sliding = true;
		      window.clearTimeout(autoSlidingTO);
		      curSlide = slideID;

		      $prevControl = $slider.querySelector(".m--active-control");
		      $prevControl.classList.remove("m--active-control");
		      $prevControl.classList.add("m--prev-control");
		      $slider.querySelector(prefix + "nav__control-" + slideID).classList.add("m--active-control");

		      $activeSlide = $slider.querySelector(prefix + "slide-" + slideID);
		      $activeControlsBg = $slider.querySelector(prefix + "nav__bg-" + slideID);

		      $slider.querySelector(".m--active-slide").classList.add("m--previous-slide");
		      $slider.querySelector(".m--active-nav-bg").classList.add("m--previous-nav-bg");

		      $activeSlide.classList.add("m--before-sliding");
		      $activeControlsBg.classList.add("m--nav-bg-before");

		      var layoutTrigger = $activeSlide.offsetTop;

		      $activeSlide.classList.add("m--active-slide");
		      $activeControlsBg.classList.add("m--active-nav-bg");

		      setTimeout(afterSlidingHandler, slidingAT + slidingDelay);
		    };



		    function controlClickHandler() {
		      if (sliding) return;
		      if (this.classList.contains("m--active-control")) return;
		      if (options.blockASafterClick) {
		        autoSlidingBlocked = true;
		        $slider.classList.add("m--autosliding-blocked");
		      }

		      var slideID = +this.getAttribute("data-slide");

		      performSliding(slideID);
		    };

		    $controls.forEach(function($control) {
		      $control.addEventListener("click", controlClickHandler);
		    });

		    function setAutoslidingTO() {
		      window.clearTimeout(autoSlidingTO);
		      var delay = +options.autoSlidingDelay || autoSlidingDelay;
		      curSlide++;
		      if (curSlide > numOfSlides) curSlide = 1;

		      autoSlidingTO = setTimeout(function() {
		        performSliding(curSlide);
		      }, delay);
		    };

		    if (options.autoSliding || +options.autoSlidingDelay > 0) {
		      if (options.autoSliding === false) return;
		      
		      autoSlidingActive = true;
		      setAutoslidingTO();
		      
		      $slider.classList.add("m--with-autosliding");
		      var triggerLayout = $slider.offsetTop;
		      
		      var delay = +options.autoSlidingDelay || autoSlidingDelay;
		      delay += slidingDelay + slidingAT;
		      
		      $progressAS.forEach(function($progress) {
		        $progress.style.transition = "transform " + (delay / 1000) + "s";
		      });
		    }
		    
		    $slider.querySelector(".fnc-nav__control:first-child").classList.add("m--active-control");

		  };

		  var fncSlider = function(sliderSelector, options) {
		    var $sliders = $$(sliderSelector);

		    $sliders.forEach(function($slider) {
		      _fncSliderInit($slider, options);
		    });
		  };

		  window.fncSlider = fncSlider;
		}());


		fncSlider(".example-slider", {autoSlidingDelay: 3000});

		var $demoCont = document.querySelector(".demo-cont");

		[].slice.call(document.querySelectorAll(".fnc-slide__action-btn")).forEach(function($btn) {
		  $btn.addEventListener("click", function() {
		    $demoCont.classList.toggle("credits-active");
		  });
		});

		document.querySelector(".js-activate-global-blending").addEventListener("click", function() {
		  document.querySelector(".example-slider").classList.toggle("m--global-blending-active");
		});
	</script>


    <script src="../js/meteoKB.js"></script>
    <script src="../js/date.js"></script>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</body>
</html>