<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div id="resultmessage"></div>
    <?php
session_start(); 
include('connection.php');
if(!isset($_GET['user_id']) || !isset($_GET['key'])){
    echo '<div class="alert alert-danger">There was an error. Please click on the reset link you received by email.</div>'; exit;
}

$user_id = $_GET['user_id'];
$key = $_GET['key'];
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
echo "
<form class='container' method=post id='passwordreset'>
<input type='hidden' name=key value=$key>
<input type='hidden' name=user_id value=$user_id>
<div class='form-group'>
    <label for='password'>Enter your new password: </label>
    <input type='password' name='password' id='password' placeholder='Enter Password' class='form-control'>
</div>
<div class='form-group'>
    <label for='password2'>Re-enter password: </label>
    <input type='password' name='password2' id='password2' placeholder='Re-enter Password' class='form-control'>
</div>
<input type='submit' name='resetpassword' class='btn btn-success btn-lg value='Reset Password'>
</form>
"


?>

<script>
    $("#passwordreset").submit(function (event) {
  // prevent default php processing
  event.preventDefault();
  var datatopost = $(this).serializeArray();
  // console.log(datatopost);
  $.ajax({
    url: "storeresetpassword.php",
    type: "POST",
    data: datatopost,
    success: function (data) {
    
        $('#resultmessage').html(data);
      
    },
    error: function () {
      $("#signupmessage").html(
        "<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later</div>"
      );
    },
  });
});
</script>
</body>
</html>