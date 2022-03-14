<?php
  include "../classes/user.php";

  $user = new User();

  if(isset($_POST['btn_upload'])){
    
    $file_name = $_FILES['photo']['name'];
    $tmp_dir = $_FILES['photo']['tmp_name']; //instead of $_POST[]

    $user->uploadFile($_SESSION['user_id'], $file_name, $tmp_dir);
  }
?>
