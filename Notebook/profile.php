<?php
    session_start();
    include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="styling.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
    #container{
        margin-top:120px;
    }

    #notePad, #allNotes, #done{
        display: none;
    }
    .buttons{
        margin-bottom: 20px;
    }
    textarea{
        width: 100%;
        max-width: 100%;
        font-size: 16px;
        line-height: 1.5em;
        border-left-width: 20px;
        border-color: #CA3DD9;
        color: #CA3DD9;
        background-color: #FBEFFF;
        padding: 10px;
    }
    tr{
        cursor: pointer;
    }
</style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-image: linear-gradient(-90deg, #43cea2, #185a9d);">
        <!-- brand -->
        <a class="navbar-brand" href="mainpage.php">Notes Keep</a>
        <!-- toggler collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="mainpage.php">My notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Help</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
            </ul>
            <ul class="navbar-nav float-right">
            <li><a  href="mainpage.php" class="nav-link" style="color:white;">Logged in as <b><?php echo $_SESSION['username'];?></b></a></li>
                <li><a  href="index.php?logout=1" class="nav-link" style="color:white;">Log out</a></li>
                
            </ul>
        </div>

    </nav>
    <!-- container -->
    <div class="container" id="container">
        <div class="row">
            <div class="col-md-12">
                <h2>General Account Settings:</h2>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed table-bordered">
                        <tr data-target="#updateusername" data-toggle="modal">
                            <td>Username</td>
                            <td>value</td>
                        </tr>
                        <tr data-target="#updateemail" data-toggle="modal">
                            <td>Email</td>
                            <td>value</td>
                        </tr>
                        <tr data-target="#updatepassword" data-toggle="modal">
                            <td>Password</td>
                            <td>hidden</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

<!-- update username -->
<form method="post" id="updatepasswordform">
    <div class="modal" id="updateusername" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="myModalLabel" >Edit Username: </h4>
                    <button class="close float-right" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                <!-- login message from php file -->
                    <div id="loginmessage"></div>
                    
                    <div class="form-group">
                        <label for="loginemail">Username:</label>
                        <input type="text" class="form-control" name ="username" id="username" maxlength="30" value="username value">
                    </div>                   
                </div>
                <div class="modal-footer">
                    <input class="btn btn-success" name="updateusername" type="submit" value="Submit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- update email -->
<form method="post" id="updateuseremailform">
    <div class="modal" id="updateemail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="myModalLabel" >Enter new email: </h4>
                    <button class="close float-right" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                <!-- login message from php file -->
                    <div id="loginmessage"></div>
                    
                    <div class="form-group">
                        <label for="loginemail">Email:</label>
                        <input type="text" class="form-control" name ="email" id="email" maxlength="30" value="email value">
                    </div>                   
                </div>
                <div class="modal-footer">
                    <input class="btn btn-success" name="updateusername" type="submit" value="Submit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- update password -->
<form method="post" id="updatepasswordform">
    <div class="modal" id="updatepassword" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="myModalLabel" >Enter Current and New password: </h4>
                    <button class="close float-right" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                <!-- login message from php file -->
                    <div id="loginmessage"></div>
                    
                    <div class="form-group">
                        <label for="currentpassword" class="sr-only">Your Current Password:</label>
                        <input type="password" class="form-control" name ="currentpassword" id="currentpassword" maxlength="30" placeholder="Your Current Password">
                    </div> 
                    <div class="form-group">
                        <label for="password" class="sr-only">Choose a password:</label>
                        <input type="password" class="form-control" name ="password" id="password" maxlength="30" placeholder="Choose a password">
                    </div> 
                    <div class="form-group">
                        <label for="password2" class="sr-only">Confirm Password:</label>
                        <input type="password" class="form-control" name ="password2" id="password2" maxlength="30" placeholder="Confirm Password">
                    </div>                   
                </div>
                <div class="modal-footer">
                    <input class="btn btn-success" name="updateusername" type="submit" value="Submit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- footer -->
    <div class="footer">
        <div class="container">
            <p>
                flamybakwasss copyright &copy; 2019-<?php $today=date("y"); echo $today?>
            </p>
        </div>
    </div>
</body>
</html>