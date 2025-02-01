<?php

@include 'config.php';
//require_once("config.php");

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

if(isset($_POST['Ajout_image'])){
   $i_nom = $_POST['i_nom'];
   $i_description = $_POST['i_description'];
   $pathinfo = pathinfo($_FILES['i_image']['name']);
   $base = $pathinfo['filename'];
   $base = preg_replace("/[^\w-]/", "_", $base);
   $filename = $base . "." . $pathinfo["extension"];
   $destination = __DIR__ . "/img/" . $filename;
   $i = 1;
   while(file_exists($destination)) {
      $filename = $base . "($i)." . $pathinfo["extension"];
      $destination = __DIR__ . "/img/" . $filename;
      $i++;
   }
   if ( ! move_uploaded_file($_FILES['i_image']['tmp_name'], $destination)) {
      $message[] = "Impossible de déplacer le fichier";
   } else {
      $message[] = "Fichier transféré avec succès";
   }
   $insert_query = mysqli_query($conn, "INSERT INTO `photos`(titre, description, image) VALUES('$i_nom', '$i_description', '$filename')") or die('Erreur de Requête');
   if($insert_query){
      $message[] = 'Image ajoutée à la base de données avec succès';
   }else{
      $message[] = 'Ajout à la base de données impossible de cette image';
   }
};


if(isset($_GET['delete'])){
   $supp_id = $_GET['delete'];
   $supp_res = mysqli_query($conn,"SELECT * from photos WHERE id=$supp_id limit 1") or die('Erreur de requête');
   if($supp_row=mysqli_fetch_array($supp_res))
   {
      $deleteimage = $supp_row['image']; 
   }
   $supp_folder="img/";
   unlink($supp_folder.$deleteimage);
   $supp_result = mysqli_query($conn,"DELETE from photos WHERE id=$supp_id") or die('Erreur de requête');
   if($supp_result){
      header('location:admin-image.php');
      $message[] = 'Image supprimée';
   }else{
      header('location:admin-image.php');
      $message[] = 'Impossible de supprimer cette image';
   };
};



if(isset($_POST['update_image'])) {
   $u_i_id = $_POST['u_i_id'];
   $u_i_nom = $_POST['u_i_nom'];
   $u_i_desc = $_POST['u_i_desc'];
   // echo $u_i_id;
   // echo $u_i_nom;
   // echo $u_i_desc;
   $folder = "img/";
   $image_file = $_FILES['u_i_image']['name'];
   $file = $_FILES['u_i_image']['tmp_name'];
   $path = $folder . $image_file;
   $target_file = $folder.basename($image_file);
   $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
   if($file!=''){
      if ($_FILES["u_i_image"]["size"] > 2500000) {
         $error[] = 'Image trop grande.';
      }
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
         $error[] = 'Uniquement les formats JPG, JPEG, PNG & GIF sont autorisés';
      }
   }
   if(!isset($error)) {
      if($file!='') {
         $u_res = mysqli_query($conn, "SELECT * from photos WHERE id=$u_i_id limit 1");
         echo $u_i_id;
         echo "<br>11111<br>";
         if($u_row=mysqli_fetch_array($u_res)) {
            $deleteimage = $u_row['image'];
         }
         unlink($folder.$deleteimage);
         move_uploaded_file($file,$target_file);
         echo $u_i_nom;
         echo "<br>22222<br>";
         echo $image_file;
         echo "<br>22222-1<br>";
         //$u_result = mysqli_query($conn, "UPDATE `photos` SET titre='$u_i_nom', description='$u_i_desc', image='$image_file' WHERE id='$u_i_id'")  or die('Erreur de Requête');
         $u_result = mysqli_query($conn, "UPDATE `photos` SET titre='$u_i_nom', description='$u_i_desc', image='$image_file' WHERE id=$u_i_id")  or die('Erreur de Requête');
         // $u_result = mysqli_query($conn, "UPDATE `photos` SET(titre, description, image) VALUES('$u_i_nom', '$u_i_desc', '$image_file') WHERE id='$u_i_id'") or die('Erreur de Requête');
         if ($u_result) {
            echo $u_i_desc;
            echo "<br>33333<br>";
         } else {
            echo $u_i_desc;
            echo "<br>44444<br>";
         }
      }
      else {
         $u_result = mysqli_query($conn,"UPDATE photos SET titre='$u_i_nom', description='$u_i_desc' WHERE id=$u_i_id")  or die('Erreur de Requête');
         if ($u_result) {
            echo $u_i_desc;
            echo "33333";
         } else {
            echo $u_i_desc;
            echo "44444";
         }
      }
      if($u_result) {
         header("location:admin-image.php");
      }
      else {
         echo 'Erreur inconnue!';
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tableau de bord et administration</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- <link rel="stylesheet" href="../css/style2.css"> -->
   <link rel="stylesheet" href="../css/styleR.css">
   <link
     href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
     rel="stylesheet"
   />
   <title>Tableau de bord </title>
</head>
<body>

   <header>
      <img src="../images/logo2.pdf" width="150px" alt="logo">
      <nav>
         <ul class="nav_links">
            <li>
               <span class="nav-item">
                  <a href="index.php">
                     <span class="icon">
                        <i class="fa-regular fa-house"></i>
                     </span>
                     &nbsp; Accueil
                  </a>
               </span>
            </li>
            <li>
               <span class="nav-item active">
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

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};
?>

<div class="container">
   <!-- Formulaire d'ajout d'images -->
<section>
   <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
      <h3>Ajouter une nouvelle image</h3>
      <input type="text" name="i_nom" placeholder="entrer le nom de l'image" class="box" required>
      <input type="text" name="i_description" placeholder="entrer la description de l'image" class="box" required>
      <input type="file" name="i_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
      <input type="submit" value="Ajouter l'image" name="Ajout_image" class="btn">
   </form>
</section>

<!-- Affichage des images -->
<section class="display-product-table">
   <table>
      <thead>
         <th>Image</th>
         <th>Titre de l'image</th>
         <th>Description de l'image</th>
         <th>Action</th>
      </thead>
      <tbody>
         <?php        
            $select_images = mysqli_query($conn, "SELECT * FROM `photos`");
            if(mysqli_num_rows($select_images) > 0){
               while($row = mysqli_fetch_assoc($select_images)){
         ?>
         <tr>
            <td><img src="img/<?php echo $row['image']; ?>" width="200" alt=""></td>
            <td><?php echo $row['titre']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td>
               <a href="admin-image.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('êtes vous sûr de vouloir supprimer cette image ?');"> <i class="fas fa-trash"></i> Supprimer </a>
               <a href="admin-image.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> Mettre à jour </a>
            </td>
         </tr>
         <?php
            };    
            }else{
               echo "<div class='empty'>Aucune image ajoutée</div>";
            };
         ?>
      </tbody>
   </table>
</section>

<!-- Fenêtre de modification de l'image -->
<section class="edit-form-container">
   <?php  
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `photos` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <img src="img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <input type="hidden" name="u_i_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="u_i_nom" value="<?php echo $fetch_edit['titre']; ?>">
      <input type="text" class="box" required name="u_i_desc" value="<?php echo $fetch_edit['description']; ?>">
      <input type="file" class="box" required name="u_i_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="Mettre à jour cette image" name="update_image" class="btn">
      <input type="reset" value="Annuler" id="close-edit" class="option-btn">
   </form>
   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>
</section>
</div>


<!-- custom js file link  -->
<script src="../js/script.js"></script>

</body>
</html>