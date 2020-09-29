<?php
    session_start();
    include('connection.php');

    $missingUsername='<p><strong>Please enter a username!</strong></p>';
$missingEmail = '<p><strong>Please enter a valid email address!</strong></p>';
global $errors;
if(empty($_POST["forgotemail"])){
    $errors .= $missingEmail;
}else{
    $email = filter_var($_POST["forgotemail"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $missingEmail;
    }
}
// if error print error
if($errors){
    $resultMessage = '<div class="alert alert-danger">'.$errors.'</div>';
    echo $resultMessage;
    exit;
}

$email = mysqli_real_escape_string($link, $email);
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!!</div>';
    // echo '<div class="alert alert-danger">'.mysqli_error($link).'</div>';
    exit;
}
$count = mysqli_num_rows($result);
if($count != 1){
    echo '<div class="alert alert-dancer">That email doesn\'t exist on our database!</div>';
    exit;
}
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$user_id = $row['user_id'];
$key =
bin2hex(openssl_random_pseudo_bytes(16));
$time = time();
$status = 'pending';
$sql = "INSERT INTO forgotpassword(`user_id`,`key1`,`time`,`status`) VALUES ('$user_id','$key','$time','$status')";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error inserting the users detailes in the database!</div>';
    echo '<div class="alert alert-danger">'.mysqli_error($link).'</div>';
    exit;
}
//send email with link to resetpassword.php with user id and activation code
$message = "Please click on this link to reset your password:\n\n";
$message .= "http://localhost/notebook/resetpassword.php?user_id=$user_id&key=$key";
if(mail($email, 'Reset your password', $message, 'From: Flumybakwaas@gmail.com')){
    echo "<div class='alert alert-success'>An email has been sent to $email. Please click on the link to reset your password!</div>";
}else{
    echo 'failed';
}

?>