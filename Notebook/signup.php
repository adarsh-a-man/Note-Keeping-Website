<?php
session_start();
// connect to the database
include('connection.php');

$missingUsername='<p><strong>Please enter a username!</strong></p>';
$missingEmail = '<p><strong>Please enter a valid email address!</strong></p>';
$invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';
$missingPassword ='<p><strong>Please enter a password!</strong></p>';
$invalidPassword = '<p><strong>Your password should be at least 6 characters long and include one capital letter and one number!</strong></p>';
$differentPassword ='<p><strong>Passwords don\'t match!</strong></p>';
$missingPassword2='<p><strong>Please confirm your password</strong></p>';
global $errors, $username, $password, $email;
if(empty($_POST["username"])){
    $errors .= $missingUsername;
}else{
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
}
if(empty($_POST["email"])){
    $errors .= $missingEmail;
}else{
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidEmail;
    }
}

// get passwords
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

//no errors
$username = mysqli_real_escape_string($link, $username);
$email = mysqli_real_escape_string($link, $email);
$password = mysqli_real_escape_string($link, $password);
// $password = md5($password);
$password = hash('sha256', $password);

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!!</div>';
    exit;
}
$results = mysqli_num_rows($result);
if($results){
    echo '<div class="alert alert-danger">That username is already registered. Do you want to log in?</div>';
    exit;
}

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!!</div>';
    // echo '<div class="alert alert-danger">'.mysqli_error($link).'</div>';
    exit;
}
$results = mysqli_num_rows($result);
if($results){
    echo '<div class="alert alert-dancer">That email is already registered. Do you want to log in?</div>';
    exit;
}

// create a unique activation code
$activationKey =
bin2hex(openssl_random_pseudo_bytes(16));

$sql = "INSERT INTO `users`(`username`, `email`, `password`, `activation`) VALUES ('$username', '$email', '$password', '$activationKey')";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error inserting the users detailes in the database!</div>';
    echo '<div class="alert alert-danger">'.mysqli_error($link).'</div>';
    exit;
}
//here we are using local host mail server steps are give in a youtube video
$message = "Please click on this link to activate your account:\n\n";
$message .= "http://localhost/notebook/activate.php?email=".urlencode($email). "&key=$activationKey";
if(mail($email, 'Confirm your Registration', $message, 'From: Flumybakwaas@gmail.com')){
    echo "<div class='alert alert-success'>Thank you for registring! A confirmation email has been sent to $email. Please click on the activation link to activate your account.!</div>";
}else{
    echo 'failed';
}
?>
