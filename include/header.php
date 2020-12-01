<div class="image">

<!-- TEXT MAIN IMAGE -->
<h1 class="Title"> BADMINTON CLUB BAIN DE BRETAGNE </h1>
<div class="logcontainer">
    <?php if (empty($_SESSION['userId']))
    {
    ?>
<a href="register.php" class="login"> <i class="far fa-arrow-alt-circle-right"></i> Register </a> 
<a href="#login" class="login"> <i class="far fa-user"></i> Login </a> 
    <?php 
    }else{
    ?>
    <a href='profile.php' class="login"><i class="far fa-user"></i>  <strong>My profile</strong> </a>
    <?php 
    }
    ?>
</div>
</div>