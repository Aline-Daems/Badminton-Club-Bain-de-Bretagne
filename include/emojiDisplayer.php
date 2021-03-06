<?php


	function isIncrementedByUser($users){
		if(isset($_SESSION["userId"])){
			foreach($users as &$user){
				if($user == $_SESSION["userId"]){
					return TRUE;
				}
			}
		}
		return FALSE;
	}

	function displayEmojis($postId, $bdd){

		$emojisQuery = "SELECT * FROM emotes WHERE emotePostId = ?";
		$emojisRequest = $bdd->prepare($emojisQuery);
		$emojisRequest->execute([$postId]);
	
		$emojiArray = Array();
		while ($reaction = $emojisRequest->fetch(PDO::FETCH_ASSOC)) {
			foreach($emojiArray as $key => $emoji){
				if($emoji->emote == $reaction["emote"]){
					array_push($emojiArray[$key]->users, $reaction["emoteUserId"]);
					$inserted = 1;
					break;
				}
			}
			if(!isset($inserted)){
				array_push($emojiArray, (object)[
					"emote" => $reaction["emote"],
					"users" => Array($reaction["emoteUserId"]),
				]);
			}
		}

		if(!empty($emojiArray)){
			for ($i=0; $i < count($emojiArray); $i++) { 
				?>
				<div class="rounded-pill <?= isIncrementedByUser($emojiArray[$i]->users) ? "bg-success" : "bg-secondary" ?> ml-3 p-2">
					<p class="m-0 p-0"><?= $emojiArray[$i]->emote; ?> <?= count($emojiArray[$i]->users) ?></p>
				</div>
				<?php
			}
		}
	}

?>