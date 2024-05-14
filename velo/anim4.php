<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		* {
		  box-sizing: border-box;
		}

		body {
		  margin: 0 auto;
		  display: flex;
		  align-items: center;
		  justify-content: center;
/*		  min-height: 100vh;*/
		  background-color: white;
		  color: #3c3c50;
		  font-family: "Montserrat";
		  font-weight: 800;
		  font-size: 3em;
/*		  overflow: hidden;*/
		}

		section {
		  position: relative;
		  z-index: 1;
		}
		section::after {
		  text-transform: uppercase;
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  transform: translate(-50%, -50%);
		  font-size: 2.5em;
		  letter-spacing: 0.5em;
		  content: attr(data-identity);
		  color: #EAEAF2;
		  z-index: -1;
		  -webkit-animation: animLetterSpacing 4500ms infinite ease-in-out;
		          animation: animLetterSpacing 4500ms infinite ease-in-out;
		}

		.pen__lines-wrapper {
		  position: fixed;
		  top: 0;
		  left: 0;
		  width: 100%;
		  height: 100%;
		  z-index: -1;
		  display: flex;
		}

		.pen__line {
		  flex: 1;
		  border-right: solid 1px #EAEAF2;
		  opacity: 0.8;
		  position: relative;
		}

		span {
		  font-family: "Libre baskerville";
		  font-style: italic;
		  display: inline-block;
		  color: #ff0333;
		}

		@-webkit-keyframes animLetterSpacing {
		  0% {
		    letter-spacing: 2.5em;
		    opacity: 0;
		  }
		  40% {
		    opacity: 1;
		    letter-spacing: 0.5em;
		  }
		  70% {
		    letter-spacing: 0.75em;
		  }
		  100% {
		    letter-spacing: 2.5em;
		  }
		}

		@keyframes animLetterSpacing {
		  0% {
		    letter-spacing: 2.5em;
		    opacity: 0;
		  }
		  40% {
		    opacity: 1;
		    letter-spacing: 0.5em;
		  }
		  70% {
		    letter-spacing: 0.75em;
		  }
		  100% {
		    letter-spacing: 2.5em;
		  }
		}
	</style>
</head>
<body>
	<?php
	// $fruit = ["BTS" => 1, "DTS" => 2, "X" => 3];
	// $i = 1;
	// foreach ($fruit as $item => $total) {
	//  echo $item;
	//  if ($i !== count($fruit)) {
	//     echo ", ";
	//  }
	//  $i++;
	// }
	?>

	<?php
	// $arr = array(
	//     "BTS2",
	//     "DTS2",
	//     "X2"
	// );
	// for ($i = 0; $i < count($arr); $i++) {
	//     echo $arr[$i];
	// }
	?>
	<?php
	// $arr = array(
	//     "BTS",
	//     "DTS",
	//     "X"
	// );
	// $i = 0;
	// while ( $i < count($arr) ) {
	// 	for ($j=0; $j < 5; $j++) { 
	// 		echo $arr[$i];
	// 	}
	//     $i++;
	// }
	?>

	

	<section data-identity="Batman">
		<blockquote>
			<!-- BTS -->
			<span></span>
		</blockquote>
	</section>
	<div class="pen__lines-wrapper">
	 <div class="pen__line"></div>
	 <div class="pen__line"></div>
	 <div class="pen__line"></div>
	 <div class="pen__line"></div>
	 <div class="pen__line"></div>
	 <div class="pen__line"></div>
	 <div class="pen__line"></div>
	 <!-- <div class="pen__line"></div>
	 <div class="pen__line"></div>
	 <div class="pen__line"></div> -->
	</div>

	<script>
		var index = 0;
		var data= ["CIEL", "MCO", "GPME", "ERA", "ELT", "IMRT", "CARNUS Enseignement Supérieur"];

		var span= document.querySelector('span');
		var section= document.querySelector('section');

		function init() {
		  let txt = document.createTextNode(data[index]);
		  section.dataset.identity = data[index];
		  span.innerText = txt.textContent;
		  index++;
		}

		init();

		setInterval(
		  function(){
		    let txt = document.createTextNode(data[index]);
		    section.dataset.identity = data[index];
		    span.innerText = txt.textContent;
		    index++;
		    index = index < data.length ?  index++ : 0 ;
		  }
		, 4501);


	</script>
</body>
</html>