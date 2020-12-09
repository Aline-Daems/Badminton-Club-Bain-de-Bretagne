<?php
  $userQuery="SELECT * FROM users WHERE userId =?";
  $userResult=$bdd->prepare($userQuery);
  $userResult->execute([$_SESSION['userId']]);
  $user=$userResult->fetch(PDO::FETCH_ASSOC);

  if(isset($_POST['buttonPictureSubmit'])){  // Modify Profile Picture button
    $selectedChoice = $_POST['buttonPicture'];
    if($selectedChoice == 'uploaded'){
      $newPictureQuery = "UPDATE users SET userPicture = 1 WHERE userId = ?";
      $newPictureResult = $bdd->prepare($newPictureQuery);
      $newPictureResult->execute([$_SESSION['userId']]);
      header("Location: profile.php");
      exit(0);
    } else if($selectedChoice == 'gravatar'){  // gravatar
      $newPictureQuery = "UPDATE users SET userPicture = 0 WHERE userId = ?";
      $newPictureResult = $bdd->prepare($newPictureQuery);
      $newPictureResult->execute([$_SESSION['userId']]);
      header("Location: profile.php");
      exit(0);
    }
  }
?>

        
        <div class="card m-4">
          <div class="row row-cols-2">
            <div class="col-3 p-5 d-flex align-items-center">
              <form method="post">
                <ul style="list-style-type:none">
                  <?php 
                    if($user['userPicture'] == 0){ ?>
                    <li><div class="picGravatar"><?php include 'include/user_gravatar.php' ;?></div></li>
                  <?php } else { ?>
                    <li><div><img class="avatar" src="uploads/images/<?= $user['userId'];?>.png" alt=""></div></li>
                  <?php } ?>
                  <li><input value="gravatar" type="radio" class="m-2 control-input" id="buttonPicture1" name="buttonPicture"> </input>Gravatar   <label class="control-label" for="buttonPicture1"><span class="fas fa-info-circle tooltip-profile" data-placement="top" data-toggle="tooltip" data-html="true" title="gravatar" data-content="If you want to use Gravatar for your profile picture, please connect your profile with the same email address used on <a href='https://www.gravatar.com' target='_blank'>gravatar.com</a>"> </span></label></li>
                  <li><input value="uploaded" type="radio" class="m-2 control-input" id="buttonPicture2" name="buttonPicture"></input><label class="control-label" for="buttonPicture2">Uploaded Picture</label></li>
                  <li><button name="buttonPictureSubmit" id="buttonPictureSubmit" class="btn-success justify-content-center rounded mt-3 d-flex align-self-center p-1 w-50">Submit</button></li>
                </ul>
              </form>
            </div>
            <div class="col card-body">
              <p class="mb-3">Name : <?= $user['username'] ?></p>
              <p class="mb-3">Email : <?= $user['userEmail'] ?></p>
              <p class="mb-3">Signature : </p>
              <?= Michelf\MarkdownExtra::defaultTransform($user["userSignature"]); ?>
            </div>
          </div>
        </div>
        
        
      