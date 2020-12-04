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
          <p class="picGravatar"><?php include 'include/user_gravatar.php' ;?></p>
        </div>
        <?php include "profile_editor.php"; ?>
            

