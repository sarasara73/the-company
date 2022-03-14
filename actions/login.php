<?php
  include "../classes/user.php";

  $user = new User();

  //form handling
  if(isset($_POST['btn_submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    //process: call login method from user class
    $user->login($username, $password);
  }

?>
