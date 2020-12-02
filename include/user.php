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
          <p class="signatureTxt"><?= $user['userSignature'] ?></p>
          <p class="w-25 picGravatar"><?php include 'include/user_gravatar.php' ;?></p>
          <p class="modifName"></p>
          <p class="modifEmail"></p>
          <p class="modifSignature"></p>
          <p><a href="destroy_session.php">Log out</a></p>
          
        </div>
        <div class="ModifGravatar">
            <p>To display your own avatar, please connect your profile with the same email address used on <a href="https://www.gravatar.com" target="_blank">gravatar.com</a></p>
            
        </div>

<?php include "modifSignatureCreator.php"; ?>