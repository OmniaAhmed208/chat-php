<?php 

$serverName = 'localhost';
$user = 'root';
$password = '';
$dbName = 'chatPHP';

$conn = mysqli_connect($serverName, $user, $password, $dbName);

if( ! $conn){
    die('No Connection' . mysqli_error);
}
// echo "db connected";


// //______Create database_______
// $dbCreation = "create database $dbName";

// //______Execute query code________ 
// $useDB = mysqli_query($conn, $dbCreation);
// if( ! $useDB){
//     die("couldn't create database".  mysqli_error);
// }

// //______Use database______
// mysqli_select_db($conn, $dbName);
// echo "database created: <span style='color:red'>.$dbName.</span>";


// //______Create Table______
// $sqlTable1 = 'CREATE TABLE users (
//                 user_id INT NOT NULL AUTO_INCREMENT,
//                 fname VARCHAR(20) NOT NULL,
//                 lname VARCHAR(20) NOT NULL,
//                 email VARCHAR(20) NOT NULL,
//                 pass VARCHAR(255) NOT NULL,
//                 userImage VARCHAR(255) NOT NULL,
//                 userStatus VARCHAR(20) NOT NULL,
//                 primary key ( user_id )
//                 )';

// $execution = mysqli_query($conn, $sqlTable1);

// if( ! $execution){
//     die("couldn't create table". mysqli_error);
// }
// echo "<br> table created :)";

// _______________________
// $sqlTable2 = 'CREATE TABLE messages (
//                 msg_id INT NOT NULL AUTO_INCREMENT,
//                 going_msg_id INT NOT NULL,
//                 coming_msg_id INT NOT NULL,
//                 msg VARCHAR(1000) NOT NULL,
//                 primary key ( msg_id )
//                 )';

// $res = mysqli_query($conn, $sqlTable2);

// if( ! $res){
//     die("couldn't create table". mysqli_error);
// }
// echo "<br> table created :)";

// mysqli_close($conn);
?>