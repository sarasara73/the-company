<?php
    include "../classes/user.php";
    $user_id = $_GET['user_id'];
    $userObj = new User();
    $user_details = $userObj->getUser($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit User</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">The Company</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="profile.php"><?=$_SESSION['first_name']." ".$_SESSION['last_name'];?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../actions/logout.php">Logout</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <div class="container">
        <div class="w-25 mx-auto mt-5">
            <h1 class="text-center mb-4">Edit User</h1>
            <form action="../actions/edit-user.php" method="post">
                <input type="number" name="user_id" value="<?=$user_details['user_id'];?>" hidden>
                <label for="first-name" class="form-label">First Name</label>
                <input type="text" name="first_name" id="first-name" required class="form-control mb-3" value="<?=$user_details['first_name'];?>">
                <label for="last-name" class="form-label">Last Name</label>
                <input type="text" name="last_name" id="last-name" required class="form-control mb-3" value="<?=$user_details['last_name'];?>">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control mb-3" required value="<?=$user_details['username'];?>">
                <div class="row">
                    <div class="col pe-1">
                        <input type="submit" value="Save" name="btn_submit" class="btn btn-warning btn-sm w-100">
                    </div>
                    <div class="col ps-1">
                        <a href="dashboard.php" class="btn btn-outline-dark btn-sm w-100">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
