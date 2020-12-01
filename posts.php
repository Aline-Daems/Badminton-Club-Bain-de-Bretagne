<?php session_start() ; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("include/head.php"); ?>
</head>
<body>

    <!-- HEADER  -->
    <?php include("include/header.php"); ?>
    <!-- START OF PAGE CONTENT  -->

    <main class="background">
    <!-- NAV BAR  -->
    <?php include("include/breadcrumb.php"); ?>
    <div class="container-fluid row align-items-start">

      <!-- CATEGORIES -->
      <?php include("include/ContentPost.php"); ?>

      <!-- aside -->
      <?php include("include/aside.php"); ?>
      </div>
</main>
    <!-- END OF PAGE CONTENT -->



<!-- FOOTER  -->
<?php include("include/footer.php"); ?>

</body>
</html>
