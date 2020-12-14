
  <?php
  // connection to the base (db4free.net)
  $bdd = new PDO('mysql:host=remotemysql.com;dbname=pBmET2RNBp;charset=utf8mb4', 'pBmET2RNBp', getenv("database-pwd"), array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  ?>


