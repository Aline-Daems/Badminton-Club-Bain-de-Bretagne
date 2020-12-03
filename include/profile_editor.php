<?php 
	
	if(isset($_POST['userSubmit'])){  // Modify signature
		$newSignatureQuery = "UPDATE users SET userSignature = ? WHERE userId = ?";
		$newSignatureResult = $bdd->prepare($newSignatureQuery);
		$newSignatureResult->execute([$_POST['userSignature'], $_SESSION['userId']]);
		$_SESSION["successMessageSignature"] = "Informations updated";
		header("Location: profile.php");
		exit(0);
	}

	if(isset($_POST['validatetwo'])){ // Modify Password
		$pwd = hashPwd($_POST['pwd']);
		if ($_POST['pwd'] != $_POST['pwd-confirm']) {
			$errorMessageChange3 ="Password not identical";
		} elseif (empty($_POST["pwd-confirm"])){
			$errorMessage4 ="Empty Password Confirmation";
		} else {
			$newPwdQuery = "UPDATE users SET pwd = ? WHERE userId = ?";
			$newPwdResult = $bdd->prepare($newPwdQuery);
			$_SESSION["succesMessagePassword"] = "Informations updated";
			$newPwdResult->execute([$pwd, $_SESSION['userId']]);
			header("Location: profile.php");
			exit(0);
		}
	} 

	if(isset($_POST['usernameSubmit'])){ // Modify pseudo
		$queryusername = $bdd->prepare("SELECT username FROM users WHERE username = ?");
		$queryusername->execute([$_POST['username']]); 
		if(strlen($_POST['username']) >= 16){
			$errorMessageChange = "Username too long, (maximum 16 characters).";
		} elseif($queryusername->fetch()) {
			$errorMessageChange1 = "Username already taken !";
		} else {
			$newUsernameQuery = "UPDATE users SET username = ? WHERE userId = ?";
			$_SESSION["sucessMessageUsername"] = "Informations updated";
			$newUsernameResult = $bdd->prepare($newUsernameQuery);
			$newUsernameResult->execute([$_POST['username'], $_SESSION['userId']]);
			header("Location: profile.php");
			exit(0);
		}
	}
	?>

<div class="card m-4">
	<p class="h2 text-center mt-3">Change your informations</p>
	
	<!-- Changer le pseudo  -->
	<form method="post" class="card rounded m-3 d-flex flex-column p-3"> 
	<?php if (isset($_SESSION["sucessMessageUsername"])){ ?> <p style="color: green;"> <?php echo $_SESSION["sucessMessageUsername"]; ?> </p> <?php unset($_SESSION["sucessMessageUsername"]); } ?>
			<label for="username" class="h4 p-2 mt-4">Change your username</label>
			<div>
				<input class="w-25" placeholder="Votre Pseudo" maxlength="16" id="username" name="username"></input> 
				<span id="counter" class="indicator">0/16</span>
				<?php if (isset($errorMessageChange)) { ?> <p style="color: red;"><?= $errorMessageChange ; ?></p> <?php } ?>
				<?php if (isset($errorMessageChange1)) { ?> <p style="color: red;"><?= $errorMessageChange1 ; ?></p> <?php } ?>
			</div>
			<button value="submit" name="usernameSubmit" id="usernameSubmit" class="btn-success rounded w-25 mt-3">Submit</button>
			
	</form>

	<!-- Changer le password  -->
	<form method="post" class="card rounded m-3 d-flex flex-column p-3">
	<?php if (isset($_SESSION["succesMessagePassword"])){ ?> <p style="color: green;"> <?php  echo $_SESSION["succesMessagePassword"]; ?> </p> <?php unset($_SESSION["succesMessagePassword"]); } ?>
			<label for="password" class="h4 p-2 mt-4">Change your password</label>
			<div>
				<input type="password" class="w-25 password-input" placeholder="Votre Password" maxlength="40"  id="pwd" name="pwd"></input>
			</div>
			<label for="password" class="h4 p-2 mt-4">Confirm Password </label><br>
			<div>
				<input type="password" placeholder="Confirmez votre Password" name="pwd-confirm" id="pwd-confirm" class=" w-25 form-control password-input" maxlength="40">
			</div>
			<button value="submit" name="validatetwo" id="validatetwo" class="btn-success rounded w-25 mt-3">Submit</button>
			<?php if (isset($errorMessageChange3)) { ?> <p style="color: red;"><?= $errorMessageChange3 ; ?></p> <?php } ?>
			<?php if (isset($errorMessageChange4)) { ?> <p style="color: red;"><?= $errorMessageChange4 ; ?></p> <?php } ?>
	</form>

	<!-- Changer la signature  -->
	<form method="post" class="card rounded m-3 d-flex flex-column p-3">
	<?php if (isset($_SESSION["successMessageSignature"])){ ?> <p style="color: green;"> <?php  echo $_SESSION["successMessageSignature"]; ?> </p> <?php unset($_SESSION["successMessageSignature"]); } ?>
			<label for="userSignature" class="h4 p-2 mt-4">Change your signature</label>
			<input maxlength="1000" id="userSignature" name="userSignature"></input>
			<button value="submit" name="userSubmit" id="userSubmit" class="btn-success rounded  mt-3 align-self-center w-25">Submit</button>
			
	</form> 
	
</div>


