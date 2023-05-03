<?php
session_start();
include "php/confige.php";

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE email = '$email' and pass = '$pass' ";
    $res = mysqli_query($conn,$sql);
    if(! $res) die("Couldn't select data from table: " . mysqli_error($conn));

    if( mysqli_num_rows($res) > 0){
        $row = mysqli_fetch_assoc($res);
        $_SESSION['user_id'] = $row['user_id']; // $_SESSION[anything] ==> (anything) i will use it in another pages
        
        // change status to make it active
        $sqlStatus = "UPDATE users SET userStatus = 'Active now' WHERE user_id = {$_SESSION['user_id']}";
        $res2 = mysqli_query($conn, $sqlStatus);
        if(! $res2) die("Couldn't change the status: " . mysqli_error($conn));

        echo '<script>location = "php/users.php"</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/chat.css">
</head>
<body class="d-flex justify-content-center align-items-center">

    <!-- ===== Login =========== -->
    <div class="container position-relative d-flex justify-content-center align-items-center">
        <div class="register rounded">
            <i class="position-absolute"></i>
            <i class="position-absolute"></i>
            <i class="position-absolute"></i>

            <form action="" method="POST" class="d-flex justify-content-center align-items-center">
                <h2 class="fw-bold">Login</h2>
                <?php
                if(isset( $_POST['submit'])){
                    $row = mysqli_fetch_assoc($res);
                    if(!(mysqli_num_rows($res) > 0) || empty($email) || empty($pass)){
                        echo "<div class='alert alert-danger'>Not valid name or password</div>";
                    }
                }
                ?>
                <div class="inputBox position-relative w-100">
                    <input type="email" name="email" placeholder="Email" class="position-relative w-100 p-3 pt-2 pb-2 rounded" required>
                </div>
                <div class="inputBox position-relative w-100">
                    <input type="password" name="pass" placeholder="Password" class="position-relative w-100 p-3 pt-2 pb-2 rounded" required>
                </div>
                <div class="inputBox position-relative w-100 text-center">
                    <input type="submit" name="submit" value="Login" class="position-relative w-100 p-2 rounded text-white">
                </div>
                <div class="links position-relative w-100 d-flex align-items-center">
                    <a href="#" class="fw-bold">Forget Password</a>
                    <a href="php/sign.php" class="fw-bold">Signup</a>
                </div>
            </form>
        </div>
    </div>
    
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
</body>
</html>