<div class="container-fluid col-12 col-md-9 p-5">

<div class="rules"> <p class="Text-Rules">Forum Rules </p></div> 

	<?php 
		$topicId = $_GET["id"];
		$postErrorMessage=" ";

		if(isset($_POST["postCreation"])){

			$message = htmlspecialchars($_POST['message']);

			if(empty($message)) {
				$postErrorMessage = "You must write a message !";
			} else {
				$newPostQuery = "INSERT INTO posts (postUserId, postTopicId, postContent) VALUES (?, ?, ?)";
				$newPostResult = $bdd->prepare($newPostQuery);
				$newPostResult->execute([$_SESSION["userId"], $topicId, $message]);

				unset($message);
				header("Location: posts.php?id=$topicId");
			}

		}
	?>

	<p class="text-danger"><?= $postErrorMessage?></p>
	<form method="post" class="d-flex flex-column p-3">
		<label for="message" class="p-2 mt-4">Message</label>
		<textarea maxlength="2000" id="topicMessage" name="message"></textarea>
	
		<button type="submit" name="postCreation" id="postCreation" class="btn-success rounded-pill w-25 m-3 mt-4 align-self-center">Create new post</button>
	</form>

</div>
