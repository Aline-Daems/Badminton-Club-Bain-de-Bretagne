<?php session_start() ; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("include/head.php"); ?>
    <link rel="stylesheet" href="sass/posts.css">
</head>
<body>

    <!-- HEADER  -->
    <?php include("include/header.php"); ?>
    
    <!-- PAGE CONTENT  -->
    <main class="background">
        <!-- NAV BAR  -->
        <?php $topicId = $_GET["id"]; 
                $topicQuery = "SELECT topicTitle, topicAuthorId, isLocked FROM topics WHERE topicId = ?";
                $topicResult = $bdd->prepare($topicQuery);
                $topicResult->execute(array($topicId));
                $topic = $topicResult->fetch(PDO::FETCH_ASSOC);
        
        if($topic){ 
             include("include/breadcrumb.php");
            }
        ?>
        <div class="container-fluid row align-items-start">
            <!-- CATEGORIES -->
            <?php if (! empty($_GET['id'])){
                include("include/ContentPost.php");
            }else{ 
                header('Location: index.php');
            } ?>
            <!-- ASIDE -->
            <?php include("include/aside.php"); ?>
        </div>
    </main>
    <!-- FOOTER  -->
    <?php include("include/footer.php"); ?>
    <script>
        var simplemde = new SimpleMDE({ element: document.getElementById("postMessage") });
        var simplemdeTwo = new SimpleMDE({ element: document.getElementById("editPost") });
    </script>
</body>
</html>

