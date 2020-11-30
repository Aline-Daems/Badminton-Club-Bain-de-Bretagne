<?php
  $userQuery="SELECT * FROM users WHERE userId =?";
  $userResult=$bdd->prepare($userQuery);
  $userResult->execute([$_SESSION['userId']]);
  $user=$userResult->fetch(PDO::FETCH_ASSOC);
?>
        <div class="user-container">
          <div class="name">Name :</div>
          <div class="mail">Email :</div>
          <div class="signature2">Signature :</div>
          <div class="username"><?= $user['username'] ?></div>
          <div class="userEmail"><?= $user['userEmail'] ?></div>
          <div class="signatureTxt"><?= $user['userSignature'] ?></div>
          <div class="w-25 picGravatar"><?php include 'include/user_gravatar.php' ;?></div>
          <div class="modifName"><a href="#">Modify your username</a></div>
          <div class="modifEmail"><a href="#">Modify your password</a></div>
          <div class="modfiSignature"><a href="#">Modify your signature</a></div>
          <div class="ModifGravatar">
            <p>To display your own avatar, please connect your profile with the same email address used on <a href="https://www.gravatar.com" target="_blank">gravatar.com</a></p>
            <p><a href="destroy_session.php">Log out</a></p>
          </div>
        </div>