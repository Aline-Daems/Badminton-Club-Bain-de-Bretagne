<div class="container-fluid col-12 col-md-9">

	<?php
	 	if (!empty($_GET['code'])){
			$urlCode = $_GET['code'];
		}		
		if (isset($urlCode)){ 
			if ($urlCode == "007"){
			$boardQuery = "SELECT * FROM boards";
			}
		}else{
			$boardQuery = "SELECT * FROM boards WHERE boardsId != 5";
		}
		$boardResult = $bdd->query($boardQuery);
		while ($boardRow = $boardResult->fetch()) {
	?>
		<h2><?= $boardRow["boardsName"]; ?></h2>
		<div class="row">
		<?php
			$forumQuery = "SELECT * FROM forums WHERE forumBoardId = ?";
			$forumResult = $bdd->prepare($forumQuery);
			$forumResult->execute(array($boardRow["boardsId"]));
			while ($forumRow = $forumResult->fetch()) {

				/* SELECTING LAST TOPIC OF THE FORUM */
				$lastTopicQuery = "SELECT topicCreationDate FROM topics WHERE topicForumId = ? ORDER BY topicId DESC LIMIT 1";
				$lastTopicResult = $bdd->prepare($lastTopicQuery);
				$lastTopicResult->execute(array($forumRow["forumId"]));
				$lastTopic = $lastTopicResult->fetch();

				/* SELECTING THE TOTAL OF POSTS OF THE FORUM */
				$totalTopicQuery = "SELECT COUNT(*) AS 'total' FROM topics WHERE topicForumId = ?";
				$totalTopicResult = $bdd->prepare($totalTopicQuery);
				$totalTopicResult->execute(array($forumRow["forumId"]));
				$totalTopic = $totalTopicResult->fetch();
		?>
		<section class="col-12 col-md-4" style="max-width: 540px;">
			<div class="card mb-3">
				<a href="forum.php?id=<?= $forumRow["forumId"]; ?>" class="card-body profile">
					<div class="row no-gutters">
						<div class="col-3">
							<img src="pictures/logo.png<?= $forumRow["forumPicSrc"]; ?>" class="card-img" alt="...">
						</div>
						<div class="col-9">
							<h5 class="card-title"><?= $forumRow["forumName"]; ?></h5>
							<p class="card-text"><?= $forumRow["forumDesc"]; ?></p>
						</div>
					</div>
					<div class="row">
						<p class="text-muted">
							<?= $totalTopic["total"]; ?> topics
							<br>
							Last topic created  
							<?php 
								$currentDate = strtotime(date("Y-m-d H:i:s"));
								$postDate = strtotime(date($lastTopic['topicCreationDate']));
								$seconds_ago = ($currentDate - $postDate);
								if ($seconds_ago >= 31536000) {
									echo intval($seconds_ago / 31536000) . " year(s) ago";
								} else if ($seconds_ago >= 2419200) {
									echo intval($seconds_ago / 2419200) . " month(s) ago";
								} else if ($seconds_ago >= 86400) {
									echo intval($seconds_ago / 86400) . " day(s) ago";
								} else if ($seconds_ago >= 3600) {
									echo intval($seconds_ago / 3600) . " hour(s) ago";
								} else if ($seconds_ago >= 60) {
									echo intval($seconds_ago / 60) . " minute(s) ago";
								} else {
									echo "Less than a minute ago";
								}
							?>
						</p>
					</div>
				</a>
			</div>
		</section>
		<?php        
			}
		?>
		</div>
	<?php
		}
	?>

</div>
