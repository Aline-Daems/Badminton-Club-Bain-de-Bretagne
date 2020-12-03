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
        <div class="ModifGravatar">
            <p>To display your own avatar, please connect your profile with the same email address used on <a href="https://www.gravatar.com" target="_blank">gravatar.com</a></p>
            
        </div>

<?php include "modifSignatureCreator.php"; ?>
