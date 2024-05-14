<?php
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

?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/styleR.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />

    <title>Gestion de compte</title>

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
          margin-top: 80px;
          margin-bottom: 80px;
        }

        .overlay{
          width: 100%; 
          height: 100%;
          position: absolute;
          z-index: 100;
          background-color: var(--left-color);
          border-radius: 10px;
          color: white;
          clip: rect(0, 325px, var(--form-height), 0);
        }

        .overlay .sign-in, .overlay .sign-up{
          --padding: 0px;
          width: calc(325px - var(--padding) * 2);
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

        a {
            font-weight: 500;
            font-size: 14px;
            color: white;
            text-decoration: none;
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
          font-size: 1em;
          padding: 15px;
          width: 300px;
          font-weight: 600;
          border: none;
          font-family: 'Helvetica Neue', sans-serif;
          letter-spacing: 1.5px;
          padding-left: 10px;
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
            width: 170px;
            line-height: 30px;
        }

        /*****************/

        .close {
            float: right;
            font-size: 21px;
            font-weight: bold;
            line-height: 1;
            text-shadow: 0 1px 0 #fff;
            opacity: .5;
            color: red;
        }

        .close:hover,.close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
            opacity: .5;
        }

        button.close {
            padding: 0;
            cursor: pointer;
            background: transparent;
            border: 0;
            -webkit-appearance: none;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert h4 {
            margin-top: 0;
            color: inherit;
        }

        .alert .alert-link {
            font-weight: bold;
        }

        .alert>p,.alert>ul {
            margin-bottom: 0;
        }

        .alert>p+p {
            margin-top: 5px;
        }

        .alert-dismissable {
            padding-right: 35px;
        }

        .alert-dismissable .close {
            position: relative;
            top: -2px;
            right: -21px;
            color: inherit;
        }

        .alert-success {
            background-color: #dff0d8;
            border-color: #d6e9c6;
            color: #3c763d;
        }

        .alert-success hr {
            border-top-color: #c9e2b3;
        }

        .alert-success .alert-link {
            color: #2b542c;
        }

        .alert-warning {
            background-color: #fcf8e3;
            border-color: #faebcc;
            color: #8a6d3b;
        }

        .alert-warning hr {
            border-top-color: #f7e1b5;
        }

        .alert-warning .alert-link {
            color: #66512c;
        }

        .alert {
            border-radius: 0;
            -webkit-border-radius: 0;
            box-shadow: 0 1px 2px rgba(0,0,0,0.11);
        }

        .alert .sign {
            font-size: 20px;
            vertical-align: middle;
            margin-right: 5px;
            text-align: center;
            width: 25px;
            display: inline-block;
        }

        .alert-success {
            background-color: #dbf6d3;
            border-color: #aed4a5;
            color: #569745;
        }

        .alert-warning {
            background-color: #fcf8e3;
            border-color: #f1daab;
            color: #c09853;
        }

        .alert-white {
            background-image: linear-gradient(to bottom,#FFFFFF,#F9F9F9);
            border-top-color: #d8d8d8;
            border-bottom-color: #bdbdbd;
            border-left-color: #cacaca;
            border-right-color: #cacaca;
            color: #404040;
            padding-left: 61px;
            position: relative;
            background: #b0c4de88;
        }

        .alert-white .icon {
            text-align: center;
            width: 45px;
            height: 100%;
            position: absolute;
            top: -1px;
            left: -1px;
            border: 1px solid #bdbdbd;
        }

        .alert-white .icon:after {
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            display: block;
            content: '';
            width: 10px;
            height: 10px;
            border: 1px solid #bdbdbd;
            position: absolute;
            border-left: 0;
            border-bottom: 0;
            top: 50%;
            right: -6px;
            margin-top: -5px;
            background: #fff;
        }

        .alert-white.rounded {
            border-radius: 3px;
            -webkit-border-radius: 3px;
        }

        .alert-white.rounded .icon {
            border-radius: 3px 0 0 3px;
            -webkit-border-radius: 3px 0 0 3px;
        }

        .alert-white .icon i {
            font-size: 20px;
            color: #FFF;
            left: 12px;
            margin-top: -10px;
            position: absolute;
            top: 50%;
        }

        .alert-white.alert-warning .icon,.alert-white.alert-warning .icon:after {
            border-color: #d68000;
            background: #fc9700;
        }

        .alert-white.alert-success .icon,.alert-white.alert-success .icon:after {
            border-color: #54a754;
            background: #60c060;
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

<?php include('compteMessage.php'); ?>

    <div class="containerc">

        <?php 
        $select_admin = mysqli_query($conn, "SELECT * FROM `administrateurs` WHERE id = '$id_admin'") or die('La requête a échoué');
        if(mysqli_num_rows($select_admin) > 0){
            $fetch_admin = mysqli_fetch_assoc($select_admin);     
        ?>

      <div class="overlay" id="overlay">
        <div class="sign-in" id="sign-in">
          <h1>Informations</h1>
          <div class="circular--portrait" style="background-image: url('../images/admin2.jpeg');background-position: 5% 65%; background-size: cover;">
          </div>
          <h2><?= $fetch_admin['nom']; ?></h2>
          <h4><?= $fetch_admin['mail']; ?></h4>
          <button class="control-button return" id="slide-right-button"><a href="index.php">Accueil</a></button>
        </div>
      </div>
      <div class="form" id="sign-up">
        <div class="sign-up" id="sign-up-info">
          <h1>Informations détaillées</h1>
          <h1><i class="fa-solid fa-id-card"></i></h1>
          <form id="sign-up-form">

            <br><label for="file" class="label-file"><i class="fa-solid fa-user"></i>&nbsp; Nom</label>
            <input type="text" placeholder="<?= $fetch_admin['nom']; ?>" disabled />

            <br><label for="file" class="label-file"><i class="fa-solid fa-envelope"></i>&nbsp; Adresse mail</label>
            <input type="email" placeholder="<?= $fetch_admin['mail']; ?>" disabled />

            <br><label for="file" class="label-file"><i class="fa-solid fa-lock"></i>&nbsp; Mot de passe</label>
            <input type="password" placeholder="<?= $fetch_admin['mot_de_passe']; ?>" disabled />

            <br><label for="file" class="label-file"><i class="fa-solid fa-calendar-days"></i>&nbsp; Date d'inscription</label>
            <input type="text" placeholder="<?= $fetch_admin['date_ins']; ?>" disabled />

            <p class="small" style="text-align: center;">Vous pouvez modifier ces informations</p>

            <button class="control-button up"><a href="compteEdit.php?id=<?= $fetch_admin['id']; ?>">Modifier</a></button>


          </form>
          <?php
                  }
              else
              {
                  echo "<h5> Pas d'enregistrement correspondant </h5>";
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