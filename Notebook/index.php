<?php
session_start();
include('connection.php');
//logout
include("logout.php");
//remember me
include("remember.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Note app</title>
    <link rel="stylesheet" href="styling.css">
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

    <nav class="navbar navbar-expand-md navbar-dark" style="background-image: linear-gradient(-90deg, #43cea2, #185a9d);">
        <!-- brand -->
        <a class="navbar-brand" href="#">Notes Keep</a>
        <!-- toggler collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Help</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li>
                    <a class="nav-link" href="#loginModal" data-toggle="modal">Login</a>
                </li>
            </ul>
        </div>

    </nav>
    <div class="jumbotron" id="myContainer">
    <h1>Keep Your notes online</h1>
    <p>Don't keep you notes on pocket</p>
    <p>Keep it online, easy to access.</p>
    <button type="button" class="btn btn-lg btn-success signup" data-target="#signupModal" data-toggle="modal">Sign Up</button>
</div>

<!-- login form -->
<form method="post" id="loginform">
    <div class="modal" id="loginModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="myModalLabel">Login: </h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                <!-- login message from php file -->
                    <div id="loginmessage"></div>
                    
                    <div class="form-group">
                        <label for="loginemail" class="sr-only">Email:</label>
                        <input type="text" class="form-control" name ="loginemail" id="loginemail" placeholder="Email" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="loginpassword" class="sr-only">Password:</label>
                        <input type="password" class="form-control" name ="loginpassword" id="loginpassword" placeholder="Password" maxlength="30">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="rememberme" id="rememberme">
                            Remember me
                        </label>
                        <a class="pull-right" style="cursor: pointer" data-dismiss="modal" data-target="#forgotpasswordModal" data-toggle="modal">Forget Password?</a>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <input class="btn btn-success" name="login" type="submit" value="Login">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-light pull-left" data-dismiss="modal" data-target="#signupModal" data-toggle="modal">Register</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- sign up form -->
<form method="post" id="signupform">
    <div class="modal" id="signupModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="myModalLabel">Sign Up today and Start using our online Notes app!</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                <!-- sign up message from php file -->
                    <div id="signupmessage"></div>

                    <div class="form-group">
                        <label for="username" class="sr-only">Username:</label>
                        <input type="text" class="form-control" name ="username" id="username" placeholder="Username" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="email" class="sr-only">Email:</label>
                        <input type="text" class="form-control" name ="email" id="email" placeholder="Email Address" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">Choose a password:</label>
                        <input type="password" class="form-control" name ="password" id="password" placeholder="Choose a Password" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="password2" class="sr-only">Confirm password:</label>
                        <input type="password" class="form-control" name ="password2" id="password2" placeholder="Confirm Password" maxlength="30">
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-success" name="signup" type="submit" value="Sign up">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- forget password form -->
<form method="post" id="forgotpasswordform">
    <div class="modal" id="forgotpasswordModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="myModalLabel">Forgot Password? Enter your email address:</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                <!-- forgot password message from php file -->
                    <div id="forgotpasswordmessage"></div>
                    
                    <div class="form-group">
                        <label for="forgotemail" class="sr-only">Email:</label>
                        <input type="text" class="form-control" name ="forgotemail" id="forgotemail" placeholder="Email" maxlength="30">
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-success" name="forgotpassword" type="submit" value="Submit">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-light pull-left" data-dismiss="modal" data-target="#signupModal" data-toggle="modal">Register</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- footer -->
    <div class="footer">
            <p>
                flamybakwasss copyright &copy; 2019-<?php $today=date("y"); echo $today?>
            </p>
    </div>

    <script src="index.js"></script>
</body>
</html>