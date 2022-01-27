
<?php

require 'database.php';

$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':email', $_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $stmt->bindParam(':password', $password);

  if ($stmt->execute()) {
    $message = '¡Congratulations!  Successfully created new user';
  } else {
    $message = 'Sorry there must have been an issue creating your account';
  }
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>registro</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <?php require"header/header.php"?>

        <?php if(!empty($message)): ?>
        <p> <?= $message ?></p>
        <?php endif; ?>

        <h1>SingUp</h1>

        <span> or <a href="login.php"> Login </a></span>
            
        <form action="signup.php" method="POST">
            <input name="email" type="text" placeholder="Enter your email" required>
            <input name="password" type="password" placeholder="Enter your Password" required>
            <input name="confirm_password" type="password" placeholder="Confirm Password" required>
            <input type="submit" value="Send">
        </form>
    </body>
</html>