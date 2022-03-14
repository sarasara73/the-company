<?php
    include "../classes/user.php";

    $userObj = new User();

    $users = $userObj->getAllUsersExcept($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dashboard</title>
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
                <a class="nav-link" href="profile.php"><?= $_SESSION['first_name']." ".$_SESSION['last_name']; ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../actions/logout.php">Logout</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <div class="container">
        <div class="w-75 mx-auto mt-4">
            <h1>User's List</h1>
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
            <table class="table table-bordered table-striped mt-3">
                <thead class="bg-dark text-white">
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                        if($users){
                            while($user = $users->fetch_assoc()){
                    ?>
                            <tr>
                                <td><?=$user['user_id'];?></td>
                                <td><?=$user['first_name'];?></td>
                                <td><?=$user['last_name'];?></td>
                                <td><?=$user['username'];?></td>
                                <td><a class = "btn btn-outline-warning" href="edit-user.php?user_id=<?=$user['user_id'];?>"><i class="fas fa-edit"></i></a></td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$user['user_id'];?>">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>

                                <!-- Modal -->
                                <div class="modal fade" id="delete<?=$user['user_id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Warning</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-center fst-italic text-muted">Are you sure you want to delete the record <span class="fw-bold"><?=$user['first_name']." (".$user['last_name']." (".$user['username'].")";?></span>?</p>
                                    </div>
                                    <div class="modal-footer">
                                         <a class="btn btn-danger" href="../actions/delete.php?user_id=<?=$user['user_id'];?>">Delete record</a>
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </tr>
                    <?php

                            }
                        } else{
                    ?>
                    <tr>
                        <td colspan="6" class="text-center fst-italic">No records to display</td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
