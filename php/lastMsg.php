<?php
// ____________ get the last message in the chat
$sqlLastMsg = "SELECT * FROM messages WHERE (coming_msg_id = {$row['user_id']} OR going_msg_id = {$row['user_id']}) 
AND (coming_msg_id = {$_SESSION['user_id']} OR going_msg_id = {$_SESSION['user_id']})
ORDER BY msg_id DESC LIMIT 1";

$resLastMsg = mysqli_query($conn, $sqlLastMsg);
if(! $resLastMsg) die("Couldn't select data from table: " . mysqli_error($conn));

$rowMsg = mysqli_fetch_assoc($resLastMsg);
$you="";
if(mysqli_num_rows($resLastMsg) > 0 ){
    $msg = $rowMsg['msg'];
($_SESSION['user_id'] == $rowMsg['going_msg_id']) ? $you = "You: " : $you="";
}
else{
    $msg = "No message available";
}

(strlen($msg) > 25) ? $msg = substr($msg, 0, 25).'...' : $msg = $msg ;
?>