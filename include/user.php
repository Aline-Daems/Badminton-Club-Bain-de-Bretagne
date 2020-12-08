<?php
  $userQuery="SELECT * FROM users WHERE userId =?";
  $userResult=$bdd->prepare($userQuery);
  $userResult->execute([$_SESSION['userId']]);
  $user=$userResult->fetch(PDO::FETCH_ASSOC);
?>
        <div class="user-container">
          <p class="name">Name :</p>
          <p class="mail">Email :</p>
          <p class="signature2">Signature :</p>
          <p class="username"><?= $user['username'] ?></p>
          <p class="userEmail"><?= $user['userEmail'] ?></p>
          <div class="signatureTxt">
            <?= Michelf\MarkdownExtra::defaultTransform($user["userSignature"]); ?>
          </div>
          <?php 
            if($user['userPicture'] == 0){ ?>
              <div class="picGravatar"><?php include 'include/user_gravatar.php' ;?></div>
          <?php } else {// A COMPLETER ?>
            <div><img src="uploads/images/" alt=""></div>
          <?php } ?>
        </div>

            

