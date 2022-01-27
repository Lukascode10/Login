
<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <?php require"header/header.php"?>

        <?php if(!empty($user)): ?>

        <br> Welcome. <?= $user['email']; ?>
        <br>You are Successfully Logged In
        <br>
        <br><a href="logout.php"> Logout </a>
        <?php else: ?>

        <h1>Login o SignUp</h1>

        <a href="login.php">login</a> o
        <a href="signup.php">SignUp</a>

        <?php endif; ?>

    </body>
</html>