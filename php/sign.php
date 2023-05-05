<?php
session_start();
include "confige.php";
?>

<?php
$passFormate = "password must contains: <br>
- at least one number <br>
- at least one letter <br>
- at least one of these !@#$% <br>
- and should be at least 8 characters";
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

    <!-- ===== Sign =========== -->
    <div class="container position-relative d-flex justify-content-center align-items-center">
        <div class="register rounded mt-3 mb-3">

            <form action="#" method="POST"  enctype="multipart/form-data" class="d-flex justify-content-center align-items-center">
                <h2 class="fw-bold">Signup</h2>
                <?php
                // error Alert 
                if( isset( $_POST['submit'] ) ){
                    $email = $_POST['email'];
                    $file_name = $_FILES['image']['name'];
                    $img_explode = explode('.', $file_name);
                    $img_ext = end($img_explode);
                    $extension = ['png', 'jpg', 'jpeg'];
                    // check if email is exist on db
                    $sqlEmail = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");

                    if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['email']) || empty($_POST['pass'])){
                        echo "<div class='alert alert-danger'>The fields shouldn't be empty</div>";
                    }
                    // check if email is exist
                    elseif(!empty($_POST['email']) && mysqli_num_rows($sqlEmail) > 0){
                        echo "<div class='alert alert-danger'>".$_POST['email']." is already exist</div>";
                    }
                    elseif(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/',$_POST['pass'])){
                        echo "<div class='alert alert-danger'>$passFormate</div>";
                    }
                    // check extention of image
                    else if(in_array($img_ext, $extension) === false){
                        echo "<div class='alert alert-danger'>please select an image - png, jpg, jpeg</div>";
                    }
                    else{
                        echo '<script>location = "./users.php"</script>';
                    }
                }    
                ?>
                <div class="inputBox position-relative w-100">
                    <input type="text" name="fname" placeholder="First Name" minlength="3" class="position-relative w-100 p-3 pt-2 pb-2 rounded" required>
                </div>
                <div class="inputBox position-relative w-100">
                    <input type="text" name="lname" placeholder="Last Name" minlength="3" class="position-relative w-100 p-3 pt-2 pb-2 rounded" required>
                </div>
                <div class="inputBox position-relative w-100">
                    <input type="email" name="email" placeholder="Email" class="position-relative w-100 p-3 pt-2 pb-2 rounded" required>
                </div>
                <div class="inputBox position-relative w-100">
                    <input type="password" name="pass" placeholder="Password" class="position-relative w-100 p-3 pt-2 pb-2 rounded" required>
                </div>
                <div class="inputBox position-relative w-100">
                    <input type="file" name="image" class="position-relative w-100 p-3 pt-2 pb-2 rounded" accept="image/*" required>
                </div>
                <div class="inputBox position-relative w-100 text-center">
                    <input type="submit" name="submit" value="Sign" id="sign" class="position-relative p-2 rounded text-white">
                </div>
                <div class="links position-relative d-flex align-items-center">
                    <a href="../index.php" class="fw-bold">Already have account? Login</a>
                </div>
            </form>
        </div>
    </div>
    
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/all.min.js"></script>
</body>
</html>


<?php 

if( isset( $_POST['submit'] ) ){

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $status = "";

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($pass)){

        if(isset( $_FILES['image'] )){
            $file_name = $_FILES['image']['name'];
            $file_size =$_FILES['image']['size'];
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type'];

            $img_explode = explode('.', $file_name);
            $img_ext = end($img_explode);

            $extension = ['png', 'jpg', 'jpeg'];

            // check email is exist before or not
            $sqlEmail = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if(mysqli_num_rows($sqlEmail) > 0){
                echo "";
            }
            // check password
            else if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,}$/',$pass)){
                $passFormate = "password must contains:
                - at least one number
                - at least one letter
                - at least one character !@#$%
                - and should be at least 8 characters";
            }
            else if(in_array($img_ext, $extension) === true){
                $time = time();
                $img_name = $time.$file_name;
                
                move_uploaded_file($file_tmp,"../images/".$img_name);
                
                $status = 'Active now';

                $sql = "INSERT INTO users (fname, lname, email, pass, userImage, userStatus) VALUES ('$fname', '$lname', '$email', '$pass','$img_name', '$status')";
                $res = mysqli_query($conn, $sql);
                if( ! $res) die("Data isn't accepted" . mysqli_error($conn));

                $sql2 = "SELECT * FROM users WHERE email = '$email' AND pass = '$pass'";
                $res2 = mysqli_query($conn, $sql2);
                if(mysqli_num_rows($res2)> 0){
                    $row = mysqli_fetch_assoc($res2);
                    $_SESSION['user_id'] = $row['user_id'];
                }
                else echo "error". mysqli_error($conn);
            }
        }

        
        mysqli_close($conn);
    }
}

?>