<?php
@include 'admin/config.php';

// Nombre de photos
$sql = 'SELECT COUNT(*) as count FROM photos';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo 'Nombre de lignes : ' . $row['count'];
} else {
    echo '0 résultats';
}

// ++++++++++++++++++++++

$sql2 = 'SELECT COUNT(*) as count FROM administrateurs WHERE nom = "Professeur"';
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
    echo '<br> Nombre administrateurs : ' . $row2['count'];
} else {
    echo '<br> Pas administrateur';
}

// ++++++++++++++++++++++

$sql3 = "SELECT * FROM informations";
if ($result3=mysqli_query($conn,$sql3)) {
    $rowcount3=mysqli_num_rows($result3);
    echo "<br> Le nombre total de lignes est : ".$rowcount3; 
}

// ++++++++++++++++++++++

$conn->close();
?>

