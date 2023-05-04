<?php
session_start();
include "confige.php";

if(!isset($_SESSION['user_id'])){
    header("Location:../index.php");
}

$user_id_other = mysqli_real_escape_string($conn, $_GET['user_id']); // where user_id in url = rondom num id

$sql = "SELECT * FROM users WHERE user_id = $user_id_other";
mysqli_select_db( $conn, $dbName);
$res = mysqli_query($conn, $sql);
if(! $res) die("Couldn't select data from table: " . mysqli_error($conn));

if(mysqli_num_rows($res) > 0){
    $row = mysqli_fetch_assoc($res);
}

?>


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
                        <img src="../images/<?php echo $row['userImage']; ?>" alt="user">
                        <div class="details">
                            <span class="fw-bold"><?php echo $row['fname']. ' ' .$row['lname']; ?></span>
                            <p><?php echo $row['userStatus']; ?></p>
                        </div>
                    </div>
                </header>

                <div class="chat-box">
                </div>

                <form action="" method="POST" class="typing d-flex" autocomplete="off">
                    <input type="hidden" name="goingId" value="<?php echo $_SESSION['user_id']?>">
                    <input type="hidden" name="comingId" value="<?php echo $user_id_other?>"> 
                    <input type="text" name="message" placeholder="Type a message here..." class="inputField">
                    <button type="submit" name="submit"><i class="fab fa-telegram-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/all.min.js"></script>
    <script src="../js/chat.js"></script>
</body>
</html>

<?php mysqli_close($conn); ?>
