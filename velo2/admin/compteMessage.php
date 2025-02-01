<?php
    if(isset($_SESSION['message'])) :
?>

    <!-- <div class='content'> -->

    <div class="alert alert-success alert-white rounded">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa-solid fa-rectangle-xmark"></i></button>
        <div class="icon"><i class="fa-solid fa-square-check"></i></div>
        <strong>Bonjour !</strong> <?= $_SESSION['message']; ?>
    </div>

    <!-- </div> -->

<?php 
    unset($_SESSION['message']);
    endif;
?>