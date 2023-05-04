<?php
session_start();
if(isset($_SESSION['user_id'])){
    include "confige.php";
    $going_id = mysqli_real_escape_string($conn, $_POST['goingId']); 
    $coming_id = mysqli_real_escape_string($conn, $_POST['comingId']); 
    $message = mysqli_real_escape_string($conn, $_POST['message']); 

    if(!empty($message)){
        $sqlMsg = "INSERT INTO messages 
        (going_msg_id, coming_msg_id, msg) VALUES ({$going_id}, {$coming_id}, '{$message}')";

        $resMsg = mysqli_query($conn, $sqlMsg);
        if(!$resMsg) die("Couldn't insert data : " . mysqli_error($conn));
    }
}
else{
    header("Location:../index.php");
}
?>

<!-- we made it by Ajax toooooooooo remove the input value after send it (because it is send twise to database) -->