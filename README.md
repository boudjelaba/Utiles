# Utiles :

```php
 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php 
	echo "Partie 1 <br>";
	function detect_browser() {
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$browser        = "Inconnu";
		$browser_array = array( '/mobile/i'    => 'Handheld Browser',
					'/firefox/i'   => 'Firefox',
					'/safari/i'    => 'Safari',
					'/chrome/i'    => 'Chrome',
					'/edg/i'      => 'Edge',
					'/opera/i'     => 'Opera'
		);
		foreach ($browser_array as $regex => $value)
		if (preg_match($regex, $user_agent))
			$browser = $value;
		return $browser;
	}
	echo detect_browser();
	echo "<br>";

	/**
	 * Récupérer l'adresse IP
	 */
	function get_ip() {
		// IP si internet partagé
		if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			return $_SERVER['HTTP_CLIENT_IP'];
		}
		// IP derrière un proxy
		elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		// Sinon : IP normale
		else {
			return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
		}
	}
	echo get_ip();
	echo "<br>";

	function detect_os() {
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$os_platform  = "Inconnu";
		$os_array     = array(  '/windows nt 10/i'      =>  'Windows 10',
					'/windows nt 6.3/i'     =>  'Windows 8.1',
					'/windows nt 6.2/i'     =>  'Windows 8',
					'/windows nt 6.1/i'     =>  'Windows 7',
					'/macintosh|mac os x/i' =>  'Mac OS X',
					'/mac_powerpc/i'        =>  'Mac OS 9',
					'/linux/i'              =>  'Linux',
					'/ubuntu/i'             =>  'Ubuntu',
					'/iphone/i'             =>  'iPhone',
					'/ipad/i'               =>  'iPad',
					'/android/i'            =>  'Android',
					'/webos/i'              =>  'Mobile'
		);
		foreach ($os_array as $regex => $value)
		if (preg_match($regex, $user_agent))
			$os_platform = $value;
		return $os_platform;
	}
	echo detect_os();
	echo "<br>";

	?>



	<?php
	echo "<br><br>Partie 2<br>";
	echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";

	$browser = get_browser(null, true);
	print_r($browser);
	echo "<br>";
	echo $browser;
	echo "<br>";
	?>

	<!-- // Récente -->

	<?php
	echo "<br>";
	echo "Partie 3<br>";
	echo php_uname();
	echo "<br>";
	echo PHP_OS;
	echo "<br>";
	?>

	<?php
	echo "<br>";
	echo "Partie 3<br> S : ";
	echo php_uname("s");
	echo "<br> N : ";
	echo php_uname("n");
	echo "<br> R : ";
	echo php_uname("r");
	echo "<br> V : ";
	echo php_uname("v");
	echo "<br> M : ";
	echo php_uname("m");
	echo "<br>";
	?>

	<?php
	echo "<br> Partie 4<br>";
	$dir = "/";
	echo "Espace libre :" . disk_free_space($dir);
	echo "<br>";
	echo "Espace total :" .disk_total_space($dir);
	?>

</body>
</html>
```
