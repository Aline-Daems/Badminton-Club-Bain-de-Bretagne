<?php
	session_start();
	include("bdd.php");
	//Variable déclarée plus haut ---> $postRow["postDate"]; $lastPostId = $postRow['postId']; $lastPostMs = $postRow['postContent'];
	//postEditCreation bouton du textaera sur editPost
	$newEditPost = $_POST['editPost'];
	
	$lastPostId = $_SESSION["lastPostId"];
	unset($_SESSION["lastPostId"]);
	$topicId = $_SESSION["topicId"];
	unset($_SESSION["topicId"]);

	if(empty($newEditPost)) {
		$postErrorMessage = "You must write a message !";
	} else {
		$postEditQuery = "UPDATE posts SET postContent='$newEditPost' WHERE postId=$lastPostId";
		$postEdit = $bdd->prepare($postEditQuery);
		$postEdit->execute(); 
	}
	header("Location: ../posts.php?id=$topicId");
	
?>