<?php
    include "../classes/user.php";
    $user = new User();
    $user_details = $user->getUser($_SESSION['user_id']);

    //check if the photo is null
    $prof_pic = ($user_details['photo'] == NULL)?"profile.jpg": $user_details['photo'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Profile</title>
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
            <h1 class="mb-4">Profile</h1>
            <?php
                if(isset($_SESSION['success']) && isset($_SESSION['message'])){

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
            <div class="card">
                <img src="../assets/images/<?=$prof_pic;?>" alt="profile picture" class="card-img-top">
                <div class="card-body">
                    <h2 class="h4 card-title mb-0"><?=$_SESSION['first_name']." ".$_SESSION['last_name'];?></h2>
                    <small class="text-muted card-text fst-italic">@<?=$_SESSION['username'];?></small>
                </div>
                <div class="card-footer bg-white">
                    <form action="../actions/profile-upload.php" method="post" enctype="multipart/form-data">
                        <div class="input-group">
                            <input type="file" class="form-control form-control-sm" id="photo" name="photo" aria-describedby="uploadFile" aria-label="Upload">
                            <button class="btn btn-success btn-sm" type="submit" name="btn_upload" id="uploadFile">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
