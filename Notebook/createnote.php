<?php
session_start();
include('connection.php');
$user_id = $_SESSION['user_id'];
//get user id
$time = time();
//get the current time
$sql = "INSERT INTO notes (`user_id`, `note`, `time`) VALUES ('$user_id', '', '$time')";
$result = mysqli_query($link, $sql);
if(!$result){
    echo 'error';
}else{
    echo mysqli_insert_id($link);
}
//run a query to create new note

?>