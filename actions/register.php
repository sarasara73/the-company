<?php
  include "../classes/user.php";

  $user = new User();

  if(isset($_POST['btn_submit'])){

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user->createUser($first_name, $last_name, $username, $password);

  }
