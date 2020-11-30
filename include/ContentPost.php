
<div class="container-fluid col-12 col-md-9">


<?php $topicId = $_GET["id"]; ?>

<?php 
    $TopicTitleQuery = "SELECT topicTitle FROM topics WHERE topicId = ?";
    $TopicTitleResult = $bdd->prepare($TopicTitleQuery);
    $TopicTitleResult->execute(array($topicId));
    $TopicTitle = $TopicTitleResult->fetch(PDO::FETCH_ASSOC);
?>

<div class="Topic-title"> <p><?= $TopicTitle["topicTitle"]; ?></p></div>

<div class="rules"> <p class="Text-Rules">Forum Rules </p></div> 

<div class="buttons">

    <?php
        $lastPosterQuery =
            "SELECT postUserId 
            FROM posts 
            WHERE postTopicId = ?
            ORDER BY postId DESC 
            LIMIT 1";
        $lastPosterResult = $bdd->prepare($lastPosterQuery);
        $lastPosterResult->execute(array($topicId));
        $lastPoster = $lastPosterResult->fetch(PDO::FETCH_ASSOC);
        if(isset($_SESSION["userId"]) 
            AND $_SESSION["userId"] != $lastPoster["postUserId"] 
            AND !$topic["isLocked"]){
    ?>
        <a href="newPost.php?id=<?= $topicId; ?>" class="btn btn-primary reply"><i class="fas fa-reply"></i>
            Post Reply
        </a>
    <?php
        } else {
    ?>
        <button class="btn btn-secondary reply" disabled><i class="fas fa-reply"></i>
            Post Reply
        </button>
    <?php
        }
    ?>
    <button class="setting"><i class="fas fa-wrench"></i> </button>
    <form>
        <div>
            
            <input type="text" id="search" name="search" value="Search this topic ..." class="search">
        </div>
    </form>
    <button class="setting"> <i class="fas fa-search"></i></button>
    <button class="setting"> <i class="fas fa-cog"></i></button>  
</div>  <!--END OF BUTTONS-->

<?php
			$postQuery = "SELECT * FROM posts WHERE postTopicId = ?";
			$postResult = $bdd->prepare($postQuery);
			$postResult->execute(array($topicId));
            while ($postRow = $postResult->fetch(PDO::FETCH_ASSOC)) {
			
				$authorQuery = "SELECT * FROM users WHERE userId = ?";
				$authorResult = $bdd->prepare($authorQuery);
				$authorResult->execute(array($postRow["postUserId"]));
                $author = $authorResult->fetch(PDO::FETCH_ASSOC);
?>

    <div class="rounded border container comments">
    
		<div class="row bg-success align-items-center">
			<p class="col-8 m-0 date"> <?= $postRow["postDate"]; ?></p>
        </div> <!--END OF GREEN BOX WITH DATE-->
        
		<div class="row border-top align-items-center p-1 box-comments">
            <div class="avatar-border">

                <div class="avatar-profile">
                    <div class="avatar">
                        <?php 
                        //call gravatar with the email from the poster-user
                        $email = $author["userEmail"]; 
                        $default = "https://cdn1.iconfinder.com/data/icons/sport-avatar-7/64/05-sports-badminton-sport-avatar-player-512.png";
                        $size = 120;
                        $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                        ?>
                        <!-- img with the URL created -->
                        <img class="avatar" src="<?php echo $grav_url; ?>" alt="picture" />
                       
                    </div>
                </div>   <!--END OF AVATAR PROFILE-->
        
            <p class="col-2 m-0"> 
                <a  class="profile" href="profile.php?id=<?= $author["userId"]; ?>"><?= $author["username"]; ?></a>
            </p>

            </div>   <!-- END OF AVATAR BOX -->
            <div class="content">
            <p class="col-8 m-0" <?= $postRow["postId"]; ?>><?= $postRow["postContent"]; ?></p>
        
        
            <p class="signature"><?= $author["userSignature"]; ?> </p>
            </div> <!-- END OF CONTENT BOX-->
        </div> <!-- END OF BOX COMMENTS -->
    </div>   <!--END OF CONTAINER COMMENTS--> 
        <?php        
            }
        ?>
</div> 
