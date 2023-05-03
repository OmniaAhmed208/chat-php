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

    <!-- ===== Chat =========== -->
    <div class="container position-relative d-flex justify-content-center align-items-center">
        <div class="page pageChat rounded bg-white">
            <div class="chat">
                <header class="d-flex align-items-center">
                    <div class="content d-flex">
                        <a href="users.php"><i class="fa fa-arrow-left text-black"></i></a>
                        <img src="../img/flowers-1.jpg" alt="user">
                        <div class="details">
                            <span class="fw-bold">Omnia Ahmed</span>
                            <p>Active Now</p>
                        </div>
                    </div>
                </header>

                <div class="chat-box">
                    <div class="chat goingMsg d-flex">
                        <div class="details">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                    <div class="chat comingMsg d-flex">
                        <img src="../img/portrait-korean-man-1.jpg" alt="user-coming">
                        <div class="details">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                </div>

                <form action="" class="typing d-flex">
                    <input type="text" placeholder="Type a message here...">
                    <button><i class="fab fa-telegram-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/all.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script> -->
    <script src="../js/chat.js"></script>
</body>
</html>