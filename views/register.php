<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Register</title>
</head>
<body>
  <?php
    if(isset($_SESSION['seccess']) && isset($_SESSION['message'])){

      //(condition) ? True: False:
      $class = ($_SESSION['success']==1)?"success":"danger";
      $message = $_SESSION['message'];
      unset($_SESSION['success']);
      unset($_SESSION['message']);

  ?>
  <div class="alert alert-<?=$class;?>">
    <?= $message; ?>
  </div>
  <?php
    }
  ?>
  <form action="../actions/register.php" method="post">
    <label for="first-name">First Name</label>
    <input type="text" name="first_name" id="first-name" required placeholder="John">

    <label for="last-name">Last Name</label>
    <input type="text" name="last_name" id="last-name" required placeholder="Doe">

    <label for="username">Username</label>
    <input type="text" name="username" id="username" required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>
    <input type="submit" value="submit" name="btn_submit">
  </form>
  <a href="index.php">Login</a>
</body>
</html>
