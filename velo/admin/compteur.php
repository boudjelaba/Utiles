<?php
require_once 'config.php';

// Nombre de photos
$sql1 = "SELECT * FROM photos";
if ($resultat = mysqli_query($conn,$sql1)) {
    $nbre_photos = mysqli_num_rows($resultat);
    // echo "<br> Le nombre total de photos est : ".$nbre_photos; 
}

// Nombre d'informations
$sql2 = "SELECT * FROM informations";
if ($resultat2 = mysqli_query($conn,$sql2)) {
    $nbre_infos = mysqli_num_rows($resultat2);
    // echo "<br> Le nombre total d'informations est : ".$nbre_infos; 
}


$conn->close();
?>

