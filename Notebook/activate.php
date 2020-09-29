<?php
session_start(); 
include('connection.php');
if(!isset($_GET['email']) || !isset($_GET['key'])){
    echo '<div class="alert alert-danger">There was an error. Please click on the activation you received by email.</div>'; exit;
}

$email = $_GET['email'];
$key = $_GET['key'];

$email = mysqli_real_escape_string($link, $email);
$key = mysqli_real_escape_string($link, $key);

$sql = "UPDATE users SET activation='activated' WHERE (email='$email' AND activation = '$key') LIMIT 1";
$result = mysqli_query($link, $sql);
if(mysqli_affected_rows($link) == 1){
    echo '<div class="alert alert-success">Your account have been activated.</div>';
    echo '<a href="index.php" type="button" class="btn btn-lg btn-success">Log in</a>';
}else{
    echo '<div class="alert alert-danger">Your account could not be activated. Please try again later.</div>';
}
?>