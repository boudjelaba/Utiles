<?php
/* Inclure le fichier */
include 'config.php';
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



if(isset($_POST['Modifier']))
{
    // $id = mysqli_real_escape_string($con, $_POST['id']);
    $id = $id_admin;

    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $mail = mysqli_real_escape_string($conn, $_POST['mail']);
    // $mdp = mysqli_real_escape_string($con, $_POST['mdp']);
    $mdp = mysqli_real_escape_string($conn, md5($_POST['mdp']));
    // $date_ins = mysqli_real_escape_string($con, $_POST['date_ins']);
    // $image = mysqli_real_escape_string($con, $_POST['image']);

    $query = "UPDATE administrateurs SET nom='$nom', mail='$mail', mot_de_passe='$mdp'/*, date_ins='$date_ins', image='$image'*/ WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Compte mis à jour avec succès";
        header("Location: compte.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Compte non modifié";
        header("Location: compte.php");
        exit(0);
    }

}
?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/styleR.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />

    <title>Modification de compte</title>

    <style>

      :root{
        --form-height:620px;
        --form-width: 960px;
        --left-color: #005670;
        --right-color: #F2A900;
        --Rouge-carnus: #860111;
      }

      .containerc{
        width: var(--form-width);
        height: var(--form-height);
        position: relative;
        margin: auto;
        box-shadow: 2px 10px 40px rgba(22,20,19,0.4);
        border-radius: 10px;
        margin-top: 60px;
        margin-bottom: 60px;
      }

      .overlay{
        width: 100%; 
        height: 100%;
        position: absolute;
        z-index: 100;
        background-color: var(--left-color);
        border-radius: 10px;
        color: white;
        clip: rect(0, 345px, var(--form-height), 0);
      }

      .overlay .sign-in, .overlay .sign-up{
        --padding: 0px;
        width: calc(345px - var(--padding) * 2);
        height: 100%;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        padding: 0px var(--padding);
        text-align: center;
      }

      .overlay .sign-in{
        float: left;
      }

      .overlay .sign-up{
        float:right;
      }

      .overlay h1{
        margin: 0px 5px;
        font-size: 2.1rem;
        margin-top: -40px;
        margin-bottom: 30px;
      }

      .overlay h2{
        margin: 0px 5px;
        font-size: 1.4rem;
        margin-bottom: 10px;
      }

      .overlay h4{
        margin: 0px 5px;
        font-size: 1rem;
        margin-bottom: 60px;
      }

      .overlay p{
        margin: 20px 0px 30px;
        font-weight: 200;
      }

      .switch-button, .control-button{
        cursor: pointer;
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 140px;
        height: 40px;
        font-size: 14px;
        text-transform: uppercase;
        background: none;
        border-radius: 20px;
        color: white;
      }

      .switch-button{
        border: 2px solid;
      }

      .control-button{
        border: none;
        margin-top: 15px;
      }

      .switch-button:focus, .control-button:focus{
        outline:none;
      }

      .control-button.up{
        background-color: var(--left-color);
      }

      .control-button.return{
        background-color: var(--right-color);
      }

      .form{
        width: 100%; 
        height: 100%;
        position: absolute;
        border-radius: 10px;
      }

      .form .sign-up{
        --padding: 0px;
        position:absolute;
        width: calc(var(--form-width) - 325px - var(--padding) * 2);
        height: 100%;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        padding: 0px var(--padding);
      }

      .form .sign-up{
        right: 0;
      }

      .form .sign-up h1{
        color: var(--left-color);
        margin: 0;
      }

      .small{
        font-size: 13px;
        color: grey;
        font-weight: 200;
        margin: 5px;
      }

      #sign-up-form input{
        margin: 12px;
        font-size: 14px;
        padding: 15px;
        width: 320px;
        font-weight: 400;
        border: none;
        background-color: #e4e4e494;
        font-family: 'Helvetica Neue', sans-serif;
        letter-spacing: 1.5px;
        padding-left: 20px;
      }

      /* ++++++++++++++++++ */
      .circular--portrait { 
          position: relative; 
          width: 160px; 
          height: 160px; 
          overflow: hidden;
          margin-left: auto;
          margin-right: auto;
          margin-bottom: 1.5em;
          border-radius: 50%; 
          box-shadow: 0 13px 26px rgba(0, 0, 0, 0.2), 0 3px 6px rgba(0, 0, 0, 0.2);
      } 
      .circular--portrait img { 
          width: 100%; 
          height: auto; 
      }

      .buttonf {
        display: inline-block;
        padding: 8px 10px;
        cursor: pointer;
        border-radius: 5px;
        background-color: #8ebf4255;
        font-size: 12px;
        color: gray;
        margin-bottom: 25px;
        width: 340px;
        font-size: 17px;
    }

    input[type=file]::file-selector-button {
        margin-right: 8px;
        border: none;
        border-radius: 2px;
        background: #1d6355;
        padding: 8px 12px;
        color: #fff;
        cursor: pointer;
      }

      label {
        background: rgb(207 232 220); 
        border: none;
        border-radius: 2px;
        color: #1d6355;
        display: inline-block;
        outline: none;
        padding: 0.1em;
        position: relative;
        vertical-align: middle;
        width: 130px;
        line-height: 30px;
      }

      a {
          font-weight: 500;
          font-size: 14px;
          color: white;
          text-decoration: none;
      }

    </style>
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

    <div class="containerc">
        <?php include('compteMessage.php'); ?>
      <div class="overlay" id="overlay">
        <div class="sign-in" id="sign-in">
            <?php
            if(isset($_GET['id']))
            {
                $id_admin = mysqli_real_escape_string($conn, $_GET['id']);
                $query = "SELECT * FROM administrateurs WHERE id='$id_admin' ";
                $query_run = mysqli_query($conn, $query);

                if(mysqli_num_rows($query_run) > 0)
                {
                    $administr = mysqli_fetch_array($query_run);
                    ?>
          <h1>Informations</h1>
          <div class="circular--portrait" style="background-image: url('../images/admin2.jpeg');background-position: 5% 65%; background-size: cover;">
          </div>
          <h2><?=$administr['nom'];?></h2>
          <h4><?=$administr['mail'];?></h4>
          <button class="control-button return" id="slide-right-button"><a href="compte.php">Retour</a></button>
        </div>
      </div>
      <div class="form" id="sign-up">
        <div class="sign-up" id="sign-up-info">
          <h1>Modification de compte</h1>
          <h1><i class="fa-solid fa-user-gear"></i></h1>
          <p class="small">Vous pouvez modifier ces informations</p>
          <form id="sign-up-form" method="POST">

            <br><label for="file" class="label-file"><i class="fa-solid fa-user"></i>&nbsp; Nom</label>
            <input name="nom" type="text" placeholder="<?=$administr['nom'];?>"/>

            <br><label for="file" class="label-file"><i class="fa-solid fa-envelope"></i>&nbsp; Mail</label>
            <input name="mail" type="email" placeholder="<?=$administr['mail'];?>"/>

            <br><label for="file" class="label-file"><i class="fa-solid fa-lock"></i>&nbsp; Mot de passe</label>
            <input name="mdp" type="password" placeholder="<?=$administr['mdp'];?>"/>

            <button type="submit" name="Modifier" class="control-button up">Valider</button>
          </form>
                  <?php
              }
              else
              {
                  echo "<h4>Pas de compte correspondant</h4>";
              }
          }
          ?>
        </div>
      </div>
    </div>


    <footer class="footer">
         <div class="container">
          <div class="row">
            <div class="footer-col">
              <h4>Carnus</h4>
              <ul>
                <li><a href="https://www.carnus.fr/formations/bts-cybersecurite-informatique-et-reseaux-electronique-option-informatique-et-reseaux/" target="_blank">BTS CIEL</a></li>
                <li><a href="https://carnus.fr" target="_blank">carnus.fr</a></li>
              </ul>
            </div>
            <div class="footer-col">
              <h4>Sites</h4>
              <ul>
                <li><a href="../public/accueil.php">Accéder au site</a></li>
                <li><a href="https://www.ecoledirecte.com/login?cameFrom=%2FAccueil">Ecole directe</a></li>
              </ul>
            </div>
            <div class="footer-col">
              <h4>Contact</h4>
              <ul>
                <li><a href="mailto:lycee@carnus.fr"><i class="fa-solid fa-envelope"></i>&nbsp;lycee@carnus.fr</a></li>
                <li><a href="tel:+33565733700"><i class="fa-solid fa-phone"></i>&nbsp;05 65 73 37 00</a></li>
              </ul>
            </div>
            <div class="footer-col">
              <h4>Nos réseaux</h4>
              <div class="social-links">
                <a href="https://www.facebook.com/lyceecarnus/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/instacharlescarnusrodez/" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com/company/charlescarnusrodez/?viewAsMember=true" target="_blank"><i class="fab fa-linkedin-in"></i></a>
              </div>
            </div>
          </div>
         </div>
      </footer>

</body>
</html>