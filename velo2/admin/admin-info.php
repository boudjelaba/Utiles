<?php

@include 'config.php';

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

if(isset($_POST['Ajout_info'])){
   $info_filiere = $_POST['info_filiere'];
   $info_nom = $_POST['info_nom'];
   $info_details = $_POST['info_details'];

   $insert_query = mysqli_query($conn, "INSERT INTO `informations`(filière, titre, détails) VALUES('$info_filiere', '$info_nom', '$info_details')") or die('Erreur de Requête');

   if($insert_query){
      $message[] = 'Info ajoutée avec succès';
   }else{
      $message[] = 'Ajout impossible de cette info';
   }
};

if(isset($_GET['delete'])){
   $supprimer_id = $_GET['delete'];
   $supprimer_query = mysqli_query($conn, "DELETE FROM `informations` WHERE id = $supprimer_id ") or die('Erreur de requête');
   if($supprimer_query){
      header('location:admin-info.php');
      $message[] = 'Information supprimée';
   }else{
      header('location:admin-info.php');
      $message[] = 'Impossible de supprimer cette information';
   };
};

if(isset($_POST['update_info'])){
   $update_info_id = $_POST['update_info_id'];
   $update_info_filiere = $_POST['update_info_filiere'];
   $update_info_nom = $_POST['update_info_nom'];
   $update_info_details = $_POST['update_info_details'];

   $update_query = mysqli_query($conn, "UPDATE `informations` SET filière ='$update_info_filiere', titre = '$update_info_nom', détails = '$update_info_details' WHERE id = '$update_info_id'");

   if($update_query){
      $message[] = 'Information mise à jour avec succès';
      header('location:admin-info.php');
   }else{
      $message[] = 'Mise à jour impossible de cette information';
      header('location:admin-info.php');
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
   <link rel="stylesheet" href="../css/style2.css">
   <link rel="stylesheet" href="../css/styleR.css">
   <link
     href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
     rel="stylesheet"
   />
</head>
<body>

   <header>
      <!-- <a href="https://carnus.fr" target="_blank"><img src="logo_m.png" alt="logo"></a> -->
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
               <span class="nav-item active">
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

  
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<div class="container">

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>Ajouter une nouvelle information</h3>

   <select name="info_filiere" class="box">
     <option value="">Choisir une filière</option>
     <option value="Toutes les filières">Toutes les filières</option>
     <option value="BTS CIEL">BTS CIEL</option>
     <option value="BTS MCO">BTS MCO</option>
     <option value="BTS GPME">BTS GPME</option>
     <option value="BTS ELT">BTS ELT</option>
     <option value="DTS IMRT">DTS IMRT</option>
   </select>

   <input type="text" name="info_nom" placeholder="entrer le titre de l'information" class="box" required>
   <!-- <input type="text" name="info_details" placeholder="entrer les détails de l'information" class="box" required> -->

   <textarea name="info_details" placeholder="Détails de l'information..." class="box" required style="height:200px"></textarea>

   <input type="submit" value="Ajouter l'information" name="Ajout_info" class="btn">
</form>

</section>

<section class="display-product-table">

   <table>

      <thead>
         <th>Filière</th>
         <th>Titre</th>
         <th>Détails</th>
         <th>Date</th>
         <th>Action</th>
      </thead>

      <tbody>
         <?php
         
            $select_info = mysqli_query($conn, "SELECT * FROM `informations`");
            if(mysqli_num_rows($select_info) > 0){
               while($row = mysqli_fetch_assoc($select_info)){
         ?>

         <tr>
            <td><?php echo $row['filière']; ?></td>
            <td><?php echo $row['titre']; ?></td>
            <td><?php echo $row['détails']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td>
               <a href="admin-info.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('êtes vous sûr de vouloir supprimer cette information ?');"> <i class="fas fa-trash"></i> Supprimer </a>
               <a href="admin-info.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> Modifier </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>Aucune information ajoutée</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `informations` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_info_id" value="<?php echo $fetch_edit['id']; ?>">

      <!-- <input type="text" class="box" required name="update_info_filiere" value="<?php echo $fetch_edit['filière']; ?>"> -->

      <select name="update_info_filiere" class="box">
        <option value="<?php echo $fetch_edit['filière']; ?>" selected><?php echo $fetch_edit['filière']; ?></option>
        <option value="T">Toutes les filières</option>
        <option value="BTS CIEL">BTS CIEL</option>
        <option value="BTS MCO">BTS MCO</option>
        <option value="BTS GPME">BTS GPME</option>
        <option value="BTS ELT">BTS ELT</option>
        <option value="DTS IMRT">DTS IMRT</option>
      </select>

      <input type="text" class="box" required name="update_info_nom" value="<?php echo $fetch_edit['titre']; ?>">
      <input type="text" class="box" required name="update_info_details" value="<?php echo $fetch_edit['détails']; ?>">
      <input type="submit" value="Mettre à jour cette information" name="update_info" class="btn">
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
<script src="../js/script_info.js"></script>

</body>
</html>