<?php
      $userId = $_GET["id"];
      $userQuery="SELECT * FROM users WHERE userId =?";
      $userResult=$bdd->prepare($userQuery);
      $userResult->execute([$_GET['id']]);
      $user=$userResult->fetch(PDO::FETCH_ASSOC);

      if($user){
?>
        <div class="user-container">
          <div class="name">Name :</div>
          <div class="mail">Email :</div>
          <div class="signature2">Signature :</div>
          <div class="username"><?php if($user){echo $user["username"];} ?></div>
          <div class="userEmail"><?php if($user){echo $user['userEmail'];}?></div>
          <div class="signatureTxt"><?php if($user){echo $user['userSignature'];}?></div>
          <div class="w-25 picGravatar"><?php include 'include/profile_gravatar.php' ;?></div>
          <div class="modifName"></div>
          <div class="modifEmail"></div>
          <div class="modfiSignature"></div>          
        </div>
<?php
      }
      else{
        include ("include/no_user.php");
      }
      if (!empty($_SESSION['userId']) AND $userId == $_SESSION['userId']){
?>
        <div class="user-container">
          <div class="name">To modify your profile:  <a href="modify_user.php">Click here</a>.</div>
          <div class="picGravatar"><?php include 'include/gravatar.php' ;?></div>
        </div>
<?php
      }
?>