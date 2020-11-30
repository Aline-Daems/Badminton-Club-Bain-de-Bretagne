<?php 
/*Récupére les infos utilisateurs*/ 
if (isset($_POST['validateone'])){
   /*----------Récupère le username-----------*/
    /*vide === empty*/ 
    if (!empty($_POST['userName']) AND !empty($_POST['pass'])){
        $userName = htmlspecialchars($_POST['userName']);
        /*htmlspecialchars = permet de sécuriser*/ 
        $pass = hashPwd($_POST['pass']);
        // $pass = sha1($_POST['pass']);
        $check_presence_user = $bdd->prepare('SELECT * FROM users WHERE username = ? AND pwd = ?');
        /* "*" veut dire tous les champs*/ 
        /*Permet de vérifier si l'utilisateur existe dans la base de donnée*/ 
        /* "*" permet de trouver tout ce qui concorde avec la demande*/ 
        $check_presence_user->execute(array($userName, $pass));
        /*permet de vérifier si l'utilisateur existe*/ 

        /*-----------------PERMET A L'UTILISATEUR DE SE CONNECTER-------------------*/
        if ($check_presence_user->rowCount() > 0){
            $infoUser = $check_presence_user->fetch();
            /*Va permettre à l'utilidateur de rester connécté et de récupérer ses infos*/
            $_SESSION['pass'] = $infoUser['pwd'];
            $_SESSION['userId'] = $infoUser['userId'];
            $_SESSION['userName'] = $infoUser['username'];
            $succesMessageaside = "Welcome ".$_SESSION['userName'];

          } else{
            $errorMessageaside ="Incorrect username or password";
        }
    } else{
        $errorMessageaside ="Please complete all fields";
    }
}
?>

    <aside class="col-md-3 col-12">
                    <!-----------SEARCH-------------->
                <!-- <form action="" method="POST">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form> -->
                  <!-----------Message-------------->
                <?php if (isset($errorMessageaside)) { ?> <p style="color: red;"><?= $errorMessageaside ?></p> <?php } ?>
                <?php if (isset($succesMessageaside)) { ?> <p style="color: green;"><?= $succesMessageaside ?></p> <?php } ?>
                    <!-----------USERNAME-------------->
                    <h3 class="titlelogin">Login</h3>
                <form action="profile.php" method="POST" name="aside">
                  </br>
                  <div class="w-100 col-auto">
                    <label>Username</label>
                    <div class="input-group mb-2">
                      <input type="text" name="userName" class="form-control" id="inlineFormInputGroup" placeholder="Username" maxlength="16">
                    </div>
                    <!-----------PASSWORD-------------->
                    <label>Password</label>
                    <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
              
                    <div class="form-group form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Remember me</label>
                    </div>
                    <button type="submit" name="validateone" class="btn btn-success"><strong>Login</strong></button>
                  </div>
                </form>
                </br>
            <!-----------NEW MEMBER-------------->
            <h3 class="Become">Become a member</h3>
            <button type="submit" name="becomeaMembre" class="w-100 btn btn-success">
            <?php echo "<a href='register.php'> <strong>Sign up</strong> ! </a>" ?>
            </button>
            </br>
            </br>
            <h3 class="Become">My profile</h3>
            <button type="submit" name="myProfil" class="w-100 btn btn-success">
            <?php echo "<a href='profile.php'> <strong>Complete your profile !</strong> </a>" ?>
            </button>

      <!-----------LAST POSTS -------------->
          <h3 class="titlelastPost">Last Post</h3> 
          <?php
          $lastPost = $bdd->prepare('SELECT postContent, postTopicId FROM posts ORDER BY postId DESC LIMIT 4');
          $lastPost->execute();

          while ($post = $lastPost->fetch(PDO::FETCH_ASSOC)){
            $lastTopic = $bdd->prepare('SELECT topicTitle FROM topics WHERE topicId = ?');
            $lastTopic->execute([$post['postTopicId']]);
            $topicTitle=$lastTopic->fetch(PDO::FETCH_ASSOC);
          ?>
              <div class="card bg-light mb-3 lastpost">
                <div class="card-header headergreen">
                <strong>
                  <a>
                <?=$topicTitle['topicTitle'];?> 
                </strong>
                </div>
                <div class="card-body">
                <p class="card-text">
                <?= $post['postContent']; ?>
                <br />
                </p>
                </div>
              </div>
          <?php
          }
        ?>

        <!-----------LAST ACTIVE USERS -------------->
<h3 class="newmember">New member</h3> 
          <?php
          $userId = $bdd->prepare('SELECT * FROM users ORDER BY userId DESC LIMIT 3');
          $userId->execute();
          while ($userpost = $userId->fetch(PDO::FETCH_ASSOC)){
          ?>
              <div class="card bg-light mb-3 lastpost">
                <div class="card-body">
                <p class="card-text gravatarimg">
                <h4><?= $userpost['username']; ?></h4>
                <br />
                <?php
                        $email = $userpost["userEmail"]; 
                        $default = "https://cdn1.iconfinder.com/data/icons/sport-avatar-7/64/05-sports-badminton-sport-avatar-player-512.png";
                        $size = 120;
                        $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                ?>
                        <!-- img with the URL created -->
                        <img class="avatar" src="<?php echo $grav_url; ?>" alt="picture" />
                </p>
                </div>
              </div>
          <?php
          }
        ?>