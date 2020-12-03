<?php
	if(isset($_POST['userSubmit'])){  // Modifier la signature
		$newSignatureQuery = "UPDATE users SET userSignature = ? WHERE userId = ?";
		$newSignatureResult = $bdd->prepare($newSignatureQuery);
		$newSignatureResult->execute([$_POST['userSignature'], $_SESSION['userId']]);
		header("Location: profile.php");
	}
	if(isset($_POST['validatetwo'])){ // Modifier le mot de passe
		$pwd = hashPwd($_POST['pwd']);
		if ($_POST['pwd'] != $_POST['pwd-confirm']) {
			$errorMessageChange3 ="Password not identical";
		} elseif (empty($_POST["pwd-confirm"])){
			$errorMessage4 ="Empty Password Confirmation";
		} else {
			$newPwdQuery = "UPDATE users SET pwd = ? WHERE userId = ?";
			$newPwdResult = $bdd->prepare($newPwdQuery);
			$newPwdResult->execute([$_POST['pwd'], $_SESSION['userId']]);
			header("Location: profile.php");
		}
	} 
	if(isset($_POST['usernameSubmit'])){ // Modifier le pseudo
		$queryusername = $bdd->prepare("SELECT username FROM users WHERE username = ?");
		$queryusername->execute([$_POST['username']]); 
		if(strlen($_POST['username']) >= 16){
			$errorMessageChange = "Username too long, (maximum 16 characters).";
		} elseif($queryusername->fetch()) {
			$errorMessageChange1 = "Username already taken !";
		} else {
			$newUsernameQuery = "UPDATE users SET username = ? WHERE userId = ?";
			$newUsernameResult = $bdd->prepare($newUsernameQuery);
			$newUsernameResult->execute([$_POST['username'], $_SESSION['userId']]);
			header("Location: profile.php");
		}
	}

	?>

<div class="card m-4">
	<p class="h2 text-center mt-3">Modifiez vos données</p>
	

	<form method="post" class="card rounded m-3 d-flex flex-column p-3">
			<label for="username" class="h4 p-2 mt-4">Modifiez votre pseudo</label>
			<div>
				
				<input class="w-25" placeholder="Votre Pseudo" maxlength="16" id="username" name="username"></input> 
				<span id="counter" class="indicator">0/16</span>
				<button value="submit" name="usernameSubmit" id="usernameSubmit" class="btn-success rounded col-1">Valider</button>
				<?php if (isset($errorMessageChange)) { ?> <p style="color: red;"><?= $errorMessageChange ; ?></p> <?php } ?>
				<?php if (isset($errorMessageChange1)) { ?> <p style="color: red;"><?= $errorMessageChange1 ; ?></p> <?php } ?>
			</div>
	</form>

	<form method="post" class="card rounded m-3 d-flex flex-column p-3">
			<label for="password" class="h4 p-2 mt-4">Modifiez votre password</label>
			<div>
				<input type="password" class="w-25 password-input" placeholder="Votre Password" maxlength="40"  id="pwd" name="pwd"></input>
			</div>
			<label for="password" class="h4 p-2 mt-4">Confirm Password:</label><br>
			<div>
				<input type="password" placeholder="Confirmez votre Password" name="pwd-confirm" id="pwd-confirm" class=" w-25 form-control password-input" maxlength="40">
			</div>
			<button value="submit" name="validatetwo" id="validatetwo" class="btn-success rounded col-1 mt-3">Valider</button>
			<?php if (isset($errorMessageChange4)) { ?> <p style="color: red;"><?= $errorMessageChange4 ; ?></p> <?php } ?>
			
			
	</form>

	<form method="post" class="card rounded m-3 d-flex flex-column p-3">
			<label for="userSignature" class="h4 p-2 mt-4">Modifiez votre signature</label>
			<input maxlength="1000" id="userSignature" name="userSignature"></input>
			<button value="submit" name="userSubmit" id="userSubmit" class="btn-success rounded col-1 mt-3 align-self-center">Valider</button>
	</form>
	
</div>


