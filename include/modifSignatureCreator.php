<?php
if(isset($_POST['userSubmit'])){
	$newSignatureQuery = "UPDATE users SET userSignature = ? WHERE userID = ?";
	$newSignatureResult = $bdd->prepare($newSignatureQuery);
	$newSignatureResult->execute([$_POST['userSignature'], $_SESSION['userId']]);
	header("Location: profile.php");
}
?>
<div class="card m-4">
	<p class="h2 text-center mt-3">Modifiez vos données</p>

	<form method="post" class="d-flex flex-column p-3">
			<label for="username" class="h4 p-2 mt-4">Modifiez votre pseudo</label>
			<div>
				<input class="w-25" placeholder="Votre Pseudo" maxlength="1000" id="username" name="username"></input>
				<button value="submit" name="userSubmit" id="userSubmit" class="btn-success rounded">Valider</button>
			</div>
			
	</form>

	<form method="post" class="d-flex flex-column p-3">
			<label for="username" class="h4 p-2 mt-4">Modifiez votre password</label>
			<div>
				<input class="w-25" placeholder="Votre Password" maxlength="1000" id="username" name="username"></input>
				<button value="submit" name="userSubmit" id="userSubmit" class="btn-success rounded">Valider</button>
			</div>
			
	</form>

	<form method="post" class="d-flex flex-column p-3">
			<label for="userSignature" class="h4 p-2 mt-4">Modifiez votre signature</label>
			<input maxlength="1000" id="userSignature" name="userSignature"></input>
			<button value="submit" name="userSubmit" id="userSubmit" class="btn-success rounded-pill w-25 m-3 mt-4 align-self-center">Valider</button>
	</form>

</div>


