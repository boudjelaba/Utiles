<?php
/* Inclure le fichier config */
require_once "admin/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		[data-component="slideshow"] .slide {
			display: none;
			text-align: left;
		}

		[data-component="slideshow"] .slide h2{
			font-size: 18px;
			font-weight: 600;
			margin-bottom: 10px;
			color: darkblue;
			text-transform: uppercase;
		}

		[data-component="slideshow"] .slide h3{
			font-size: 16px;
			font-weight: 600;
			margin-bottom: 10px;
		}
		[data-component="slideshow"] .slide span{
			font-size: 14px;
			font-weight: 500;
		}

		[data-component="slideshow"] .slide.active {
			display: block;
		}
	</style>
</head>
<body>
	<div id="slideshow-example" data-component="slideshow">
		<div role="list">

			<?php
				$select_info = mysqli_query($conn, "SELECT * FROM `informations`");
				if(mysqli_num_rows($select_info) > 0){
					while($row = mysqli_fetch_assoc($select_info)){
			?>

			   <div class="slide">
			   	<h2><?php echo $row['Filière']; ?></h2>
			   	<h3><?php echo $row['titre']; ?></h3>
			   	<span><?php echo $row['détails']; ?></span>	
			   </div>

			   <?php
			      };    
			      }else{
			         echo "<div class='empty'>Aucune information ajoutée</div>";
			      };
			   ?>
		</div>
	</div>

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
</body>
</html> 