<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/chat.css">
</head>
<body class="d-flex justify-content-center align-items-center">

    <!-- ===== Users =========== -->
    <div class="container position-relative d-flex justify-content-center align-items-center">
        <div class="page rounded bg-white">
            <div class="users">
                <header class="d-flex align-items-center">
                    <div class="content d-flex">
                        <img src="../img/flowers-1.jpg" alt="user">
                        <div class="details">
                            <span class="fw-bold">name1 name2</span>
                            <p>Active Now</p>
                        </div>
                    </div>
                    <form action="<?php $_PHP_SELF ?>" method="POST">
                        <input type="submit" name="logout" value="Logout" class="btn btn-primary">
                    </form>
                </header>

                <div class="search mt-3 mb-3 d-flex justify-content-center">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                    <i class="fa fa-search btn btn-primary"></i>
                </div>

                <div class="users-list">
                    <a href="" class="d-flex align-items-center mb-4">
                        <div class="content d-flex">
                            <img src="../img/portrait-korean-man-1.jpg" alt="">
                            <div class="details">
                                <span class="fw-bold">Ahmed</span>
                                <p>this is the test Message</p>
                            </div>
                        </div>
                        <div class="status-dot"><i class="fa fa-circle"></i></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/all.min.js"></script>
</body>
</html>