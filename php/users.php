<?php 
session_start();
include "confige.php";

if( !isset( $_SESSION['user_id']) ){
    header("Location:../index.php");
}

$sql = "SELECT * FROM users";
mysqli_select_db( $conn, $dbName);
$res = mysqli_query($conn, $sql);
if(! $res) die("Couldn't select data from table: " . mysqli_error($conn));

if(isset($_POST['logout'])){
    session_destroy();

    $sqlStatus = "UPDATE users SET userStatus = 'Offline' WHERE user_id = {$_SESSION['user_id']}";
    $res2 = mysqli_query($conn, $sqlStatus);
    if(! $res2) die("Couldn't change the status: " . mysqli_error($conn));

    header("Location:../index.php");

}

$userSession = '';
$allUsers = '';
$userStatus = '';

if(mysqli_num_rows($res) == 1 && mysqli_num_rows($res) < 2){ // only one user in the all system
    $allUsers = "<p class='text-center fs-5' style='color: #585c5f'>No users are available to chat :(</p>";
    while($row = mysqli_fetch_assoc($res)){
        if($_SESSION['user_id'] == $row['user_id']) {
            $userSession .= "
                <img src='../images/{$row['userImage']}' alt='user'>
                <div class='details'>
                    <span class='fw-bold'>{$row['fname']} {$row['lname']}</span>
                    <p>{$row['userStatus']}</p>
                </div>
                ";
        }
    }
}
elseif(mysqli_num_rows($res) > 1){
    while($row = mysqli_fetch_assoc($res)){
        // check status of the user
        if($row['userStatus'] == 'Active now'){
            $userStatus = "<div class='status-dot'><i class='fa fa-circle'></i></div>";
        }
        else{
            $userStatus = "<div class='status-dot offline'><i class='fa fa-circle'></i></div>";
        }

        // show userSession only on the top then in else statement all users except userSession
        if($_SESSION['user_id'] == $row['user_id']) {
            $userSession .= "
                <img src='../images/{$row['userImage']}' alt='user'>
                <div class='details'>
                    <span class='fw-bold'>{$row['fname']} {$row['lname']}</span>
                    <p>{$row['userStatus']}</p>
                </div>
            ";
        }
        else{
            $allUsers .= "
                <a href='chat.php?user_id={$row['user_id']}' class='d-flex align-items-center mb-4' id='user'>
                    <div class='content d-flex'>
                        <img src='../images/{$row['userImage']}' alt='user'>
                        <div class='details'>
                            <span class='fw-bold'>{$row['fname']} {$row['lname']}</span>
                            <p>this is the test Message</p>
                        </div>
                    </div>
                    {$userStatus}
                </a>
            ";
        } 
    }  
}

// _____________ search _________________

if(isset($_POST['submit'])){
    $search = $_POST['search'];
    // $allUsers = '';

    $sqlSearch = "SELECT * FROM users WHERE fname LIKE '%{$search}%' OR lname LIKE '%{$search}%' ";
    $resSearch = mysqli_query($conn, $sqlSearch);
    if(!$resSearch) die("Couldn't get the data: " . mysqli_error($conn));
        
    if(empty($search)){
        while($row = mysqli_fetch_assoc($res)){
            $allUsers = "
                <a href='chat.php?user_id={$row['user_id']}' class='d-flex align-items-center mb-4' id='user'>
                    <div class='content d-flex'>
                        <img src='../images/{$row['userImage']}' alt='user'>
                        <div class='details'>
                            <span class='fw-bold'>{$row['fname']} {$row['lname']}</span>
                            <p>this is the test Message</p>
                        </div>
                    </div>
                    {$userStatus}
                </a>
            ";
        }
    }
    elseif(mysqli_num_rows($resSearch) > 0){ // user search exist
        $allUsers = '';
        $userStatus='';
        
        while($row = mysqli_fetch_array($resSearch)){
            if($row['userStatus'] == 'Active now'){
                $userStatus = "<div class='status-dot'><i class='fa fa-circle'></i></div>";
            }
            else{
                $userStatus = "<div class='status-dot offline'><i class='fa fa-circle'></i></div>";
            }

            if($_SESSION['user_id'] != $row['user_id']){
                $allUsers .= "
                    <a href='chat.php?user_id={$row['user_id']}' class='d-flex align-items-center mb-4' id='user'>
                        <div class='content d-flex'>
                            <img src='../images/{$row['userImage']}' alt='user'>
                            <div class='details'>
                                <span class='fw-bold'>{$row['fname']} {$row['lname']}</span>
                                <p>this is the test Message</p>
                            </div>
                        </div>
                        {$userStatus}
                    </a>
                ";
            }
        }
    }
    else{
        $allUsers = "<p class='text-center fs-5' style='color: #585c5f'>No found user related to your search</p>";
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
                        <?php echo $userSession ;?>
                    </div>
                    <form action="<?php $_PHP_SELF ?>" method="POST">
                        <input type="submit" name="logout" value="Logout" class="btn btn-primary">
                    </form>
                </header>

                <form action="<?php $_PHP_SELF ?>" method="POST" class="search mt-3 mb-3 d-flex justify-content-center">
                    <input name="search" class="form-control" type="search" placeholder="Search" aria-label="Search">
                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search btn btn-primary"></i></button>
                </form>

                <div class="users-list">
                    <?php echo $allUsers ;?>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/all.min.js"></script>
    <script src="../js/search.js"></script>
</body>
</html>


<?php mysqli_close($conn); ?>