<?php
  session_start();
  require_once "database.php";

  class User extends Database{

    public function createUser($first_name, $last_name, $username, $password){
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO users(first_name, last_name, username, password)VALUES('$first_name','$last_name','$username','$hashed_password')";

      $result = $this->conn->query($sql);

      if($result){
        $_SESSION['success'] = 1;
        $_SESSION['message'] = "Registration Successful";
        header("Location: ../views/index.php");
      } else{
        $_SESSION['success'] = 0;
        $_SESSION['message'] = "An error occured. Kindly try again";
        header("Locatiion: ../views/register.php");
      }
  }


    public function login($username, $password){
      $sql = "SELECT * FROM users WHERE username = '$username'";
      $result = $this->conn->query($sql);

      if($result){
        if($result->num_rows==1){
          $user_details = $result->fetch_assoc();
          $verify_password = password_verify($password, $user_details['password']);

          if($verify_password){
            $_SESSION['user_id'] = $user_details['user_id'];
            $_SESSION['first_name'] = $user_details['first_name'];
            $_SESSION['last_name'] = $user_details['last_name'];
            $_SESSION['username'] = $user_details['username'];
            header("Location:../views/dashboard.php");
          } else{
            $_SESSION['success'] = 0;
            $_SESSION['message'] = "Incorrect Password.";
            header("Location:../views/index.php");
          }

        } else{
          $_SESSION['success'] = 0;
          $_SESSION['message'] = "Username doesn't exist.";
          header("Location:../views/index.php");
        }

      } else{
        $_SESSION['success'] = 0;
        $_SESSION['message'] = "An error occured. Failed to login.";
        header("Location:../views/index.php");
      }
    }

    public function getAllUsersExcept($user_id){
      $sql = "SELECT * FROM users WHERE user_id != $user_id";
      $result = $this->conn->query($sql);

      if($result && $result->num_rows > 0){
        return $result;
      } else{
        return FALSE;
      }
    }

    public function getUser($user_id){
      $sql = "SELECT * FROM users WHERE user_id=$user_id";
      $result = $this->conn->query($sql);

      if($result && $result->num_rows == 1){
        return $result->fetch_assoc();
      } else{
        return FALSE;
      }
    }

    public function updateUser($user_id, $first_name, $last_name, $username){
      $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', username = '$username' WHERE user_id = $user_id";
      $result = $this->conn->query($sql);

      if($result){
        $_SESSION['success'] = 1;
        $_SESSION['message'] = "The record has been successfully updated.";
        header("Location:../views/dashboard.php");
      } else{
        $_SESSION['success'] = 0;
        $_SESSION['message'] = "An error occured. Faled to update the record. Try again";
        header("Location:../views/dashboard.php");
      }
    }

    public function deleteUser($user_id){
      $sql = "DELETE FROM users WHERE user_id = $user_id";
      $result = $this->conn->query($sql);

      if($result){
        $_SESSION['success'] = 1;
        $_SESSION['message'] = "The record has been successfully deleted.";
        header("Location:../views/dashboard.php");
      } else{
        $_SESSION['success'] = 0;
        $_SESSION['message'] = "An error occured. Failed to delete the record. Kindly try again.";
        header("Location:../views/dashboard.php");
      }
    }

    public function uploadFile($user_id, $file_name, $tmp_dir){
      $sql = "UPDATE users SET photo = '$file_name' WHERE user_id = $user_id";
      $result = $this->conn->query($sql);

      if($result){
        //move the file to /assets/images
        $destination = "../assets/images/".$file_name;
        $result = move_uploaded_file($tmp_dir, $destination);

        if($result){
          $_SESSION['success']= 1;
          $_SESSION['message']= "You have successfully uploaded your picture.";
          header("Location:../views/profile.php");
        } else{
          $_SESSION['success']= 0;
          $_SESSION['message']= "An error occured. Failed to upload profile picture.";
          header("Location:../views/profile.php");
        }
    }
  }
  }
?>
