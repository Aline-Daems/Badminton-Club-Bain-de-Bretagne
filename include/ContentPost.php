
<div class="container-fluid col-12 col-md-9">


<?php $topicId = $_GET["id"]; ?>

<?php 
    $topicQuery = "SELECT topicTitle, topicAuthorId, isLocked FROM topics WHERE topicId = ?";
    $topicResult = $bdd->prepare($topicQuery);
    $topicResult->execute(array($topicId));
    $topic = $topicResult->fetch(PDO::FETCH_ASSOC);
?>

<div class="Topic-title"> <p><?= $topic["topicTitle"]; ?></p></div>

<!-- BOUTON FORUM RULES -->
<?php include "include/forum_rules.php"; ?> 

<div class="buttons d-flex align-items-stretch">

    <!-- NEW POST BUTTON -->
    <?php
        $lastPosterQuery =
            "SELECT postUserId 
            FROM posts 
            WHERE postTopicId = ?
            ORDER BY postId DESC 
            LIMIT 1";
        $lastPosterResult = $bdd->prepare($lastPosterQuery);
        $lastPosterResult->execute(array($topicId));
        $lastPosterId = 0;
        while($lastPoster = $lastPosterResult->fetch(PDO::FETCH_ASSOC)){
            $lastPosterId = $lastPoster["postUserId"];
        }
        if(isset($_SESSION["userId"])
            AND isset($lastPoster)
            AND $_SESSION["userId"] != $lastPosterId
            AND !$topic["isLocked"]){
    ?>
        <a href="newPost.php?id=<?= $topicId; ?>" class="btn btn-primary reply"><i class="fas fa-reply"></i>
            Post Reply
        </a>
    <?php
        } else {
    ?>
        <button class="btn btn-secondary p-0" disabled><i class="fas fa-reply"></i>
            Post Reply
        </button>
    <?php
        }
    ?>

    <!-- LOCK TOPIC BUTTON -->
    <?php
        /*BUTTON SCRIPT*/
		if(isset($_POST["lockTopic"])){
            $lockQuery = "UPDATE topics SET isLocked = ? WHERE topicId = ?";
            $lockResult = $bdd->prepare($lockQuery);
            if($topic["isLocked"]){
                $lockResult->execute([0,$topicId]);
            }else{
                $lockResult->execute([1,$topicId]);
            }
            header("Location: posts.php?id=$topicId");
        }

        if(isset($_SESSION["userId"]) 
            AND $topic["topicAuthorId"]==$_SESSION["userId"]
            AND !$topic["isLocked"]){
    ?>
        <form method="post">
            <button class="btn btn-primary reply" type="submit" name="lockTopic">
                Lock Topic
            </button>
        </form>
    <?php
        } elseif(isset($_SESSION["userId"]) 
            AND $topic["topicAuthorId"]==$_SESSION["userId"]
            AND $topic["isLocked"]){
    ?>
        <form method="post">
            <button class="btn btn-primary reply" type="submit" name="lockTopic">
                Unlock Topic
            </button>
        </form>
    <?php
        }
    ?>

    <form class="row ml-3 mr-3">
        <div>
            <input type="text" id="search" name="search" placeholder="Search this topic ..." class="search">
        </div>
        <button class="setting"><img class="settingIcon" src="pictures/icons/search.svg" alt="search"></button>
    </form>
    <button class="setting"><img class="settingIcon" src="pictures/icons/settings.svg" alt="settings"></button>
</div>  <!--END OF BUTTONS-->

<?php
			$postQuery = "SELECT * FROM posts WHERE postTopicId = ?";
			$postResult = $bdd->prepare($postQuery);
			$postResult->execute(array($topicId));
            while ($postRow = $postResult->fetch(PDO::FETCH_ASSOC)) {
			
				$authorQuery = "SELECT * FROM users WHERE userId = ?";
				$authorResult = $bdd->prepare($authorQuery);
				$authorResult->execute(array($postRow["postUserId"]));
                while($author = $authorResult->fetch(PDO::FETCH_ASSOC)){
?>

    <div class="rounded  border container comments">
    
		<div class="rounded-top row bg-success align-items-center">
			<p class="col-8 m-0 date"> <?= $postRow["postDate"]; ?></p>
        </div> <!--END OF GREEN BOX WITH DATE-->
        
		<div class="row rounded box-comments">
            <div class="avatar-border rounded">

                <div class="avatar-profile">
                    <div class="avatar mb-3">
                        <?php 
                        //call gravatar with the email from the poster-user
                        $email = $author["userEmail"]; 
                        $default = "https://cdn1.iconfinder.com/data/icons/sport-avatar-7/64/05-sports-badminton-sport-avatar-player-512.png";
                        $size = 120;
                        $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                        ?>
                        <!-- img with the URL created -->
                        <img class="avatar rounded-lg" src="<?php echo $grav_url; ?>" alt="picture" />
                    
                    </div>
                </div>   <!--END OF AVATAR PROFILE-->

            <!--- PSEUDO ET TODO : RANK" ---> 
            <div class="d-flex align-items-center col-12 justify-content-center">
                <a  class="profile m-0" href="profile.php?id=<?= $author["userId"]; ?>"><?= $author["username"]; ?></a>
            </div>
            
            

            </div>   <!-- END OF AVATAR BOX -->
            <div class="content p-2" style="position:relative;">
            <p class="col-12 m-0 divider p-2" <?= $postRow["postId"]; ?>><?= Michelf\MarkdownExtra::defaultTransform($postRow['postContent']); ?></p>
        
            <div class="text-center">
                <p class="signature mt-4"><?=  Michelf\MarkdownExtra::defaultTransform($author["userSignature"]); ?> </p>
            </div>
            
            </div> <!-- END OF CONTENT BOX-->
        </div> <!-- END OF BOX COMMENTS -->
    </div>   <!--END OF CONTAINER COMMENTS--> 
        <?php
                }
            }
        ?>
</div>

