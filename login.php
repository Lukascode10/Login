

<?php

session_start();

if (isset($_SESSION['user_id'])) {
  header('Location: /login');
}
require 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
  $records->bindParam(':email', $_POST['email']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $message = '';

  if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
    $_SESSION['user_id'] = $results['id'];
    header("Location: /login");
  } else {
    $message = 'Sorry, those credentials do not match';
  }
}

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>

        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <?php require"header/header.php"?>

        <h1>Login</h1>

        <span> or <a href="signup.php"> Signup</a></span>

        <?php if(!empty($message)): ?>
        <p> <?= $message ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <input name="email" type="text" placeholder="Enter your email" required>
            <input name="password" type="password" placeholder="Enter your Password" required>
            <input type="submit" value="Send">
        </form>

    </body>
</html>