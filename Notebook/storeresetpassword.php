<?php
    session_start();
    include('connection.php');

    if(!isset($_POST['user_id']) || !isset($_POST['key'])){
    echo '<div class="alert alert-danger">There was an error. Please click on the reset link you received by email.</div>'; exit;
}

$user_id = $_POST['user_id'];
$key = $_POST['key'];
$time = time() - 86400;
$user_id = mysqli_real_escape_string($link, $user_id);
$key = mysqli_real_escape_string($link, $key);

$sql = "SELECT user_id FROM forgotpassword WHERE key1 = '$key' AND user_id = '$user_id' AND time>'$time' AND status='pending'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!!</div>';
    // echo $key;
    exit;
}

//if combination does not exist show error
$count = mysqli_num_rows($result);
if($count != 1){
    echo '<div class="alert alert-dancer">Please try again!</div>';
    exit;
}
$missingPassword ='<p><strong>Please enter a password!</strong></p>';
$invalidPassword = '<p><strong>Your password should be at least 6 characters long and include one capital letter and one number!</strong></p>';
$differentPassword ='<p><strong>Passwords don\'t match!</strong></p>';
$missingPassword2='<p><strong>Please confirm your password</strong></p>';
global $errors;

//get password
if(empty($_POST["password"])){
    $errors .= $missingPassword;
}elseif(!(strlen($_POST["password"])>6 and preg_match('/[A-Z]/', $_POST["password"])
and preg_match('/[0-9]/', $_POST["password"])
)
){
    $errors .= $invalidPassword;
}else{
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    if(empty($_POST["password2"])){
        $errors .= $missingPassword2;
    }else{
        $password2 = filter_var($_POST["password2"], FILTER_SANITIZE_STRING);
        if($password!=$password2){
            $errors .= $differentPassword;
        }
    }
}
// if error print error
if($errors){
    $resultMessage = '<div class="alert alert-danger">'.$errors.'</div>';
    echo $resultMessage;
    exit;
}

//prepare variable for the query
$password = mysqli_real_escape_string($link, $password);
// $password = md5($password);
$password = hash('sha256', $password);
$user_id = mysqli_real_escape_string($link, 
$user_id);

$sql = "UPDATE users SET password='$password' WHERE user_id='$user_id'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">There was a problem storing the new password in the database!!</div>';
    exit;
}
//set the key status to used in the forgot password table to prevent the key from being used twice
$sql="UPDATE forgotpassword SET status='used' WHERE key1='$key' AND user_id='$user_id'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!!</div>';
    exit;
}else{
    echo '<div class="alert alert-success">Your password has been update successfully!<a href="index.php">Login</a></div>';
}
?>