<?php
session_start();
if(isset($_SESSION['user_id'])){
    include "confige.php";
    $going_id = mysqli_real_escape_string($conn, $_POST['goingId']); 
    $coming_id = mysqli_real_escape_string($conn, $_POST['comingId']); 
    $messageOutput = '';
     
    $sqlGetMsg = "SELECT * FROM messages 
    LEFT JOIN users ON users.user_id = messages.coming_msg_id
    WHERE (going_msg_id = $going_id AND coming_msg_id = $coming_id) 
    OR (going_msg_id = $coming_id AND coming_msg_id = $going_id) 
    ORDER BY msg_id";
    
    $resGetMsg = mysqli_query($conn, $sqlGetMsg);
    if(!$resGetMsg) die("Couldn't get data : " . mysqli_error($conn));
    
    
    if(mysqli_num_rows($resGetMsg) > 0){
        while($row = mysqli_fetch_assoc($resGetMsg)){
            if($row['going_msg_id'] == $going_id){
                $messageOutput .= "
                <div class='chat goingMsg d-flex'>
                    <div class='details'>
                        <p>".$row['msg']."</p>
                    </div>
                </div>
                ";
            }else{
                $messageOutput .= "
                <div class='chat comingMsg d-flex'>
                    <img src='../images/".$row['userImage']."' alt='user-coming'>
                    <div class='details'>
                        <p>".$row['msg']."</p>
                    </div>
                </div>
                ";
            }
        }
        echo $messageOutput;
    }

}
else{
    header("Location:../index.php");
}
?>