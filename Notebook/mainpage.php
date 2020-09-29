<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Notes</title>
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
        font-size: 20px;
        line-height: 1.5em;
        border-left-width: 20px;
        border-color: 	#2E8B57;
        color: 	#2E8B57;
        background-color: #90EE90;
        padding: 10px;
    }
    .noteheader{
        border: 1px solid grey;
        border-radius: 10px;
        margin-bottom: 10px;
        cursor: pointer;
        padding: 0 10px;
        background: linear-gradient(#FFFFFF, #ECEAE7);
    }
    .text{
        font-size: 20px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
    .timetext{
        font-size: 15px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
    .delete{
        display: none;
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
                <li class="nav-item active">
                    <a class="nav-link" href="mainpage.php">My notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Help</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
                <li class="nav-item">
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
        <!-- alert message -->
        <div id="alert" class="alert alert-danger collapse">
            <a class="close" data-dismiss="#alert">
                &times;
            </a>
            <p id="alertContent"></p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="buttons">
                    <button id="addNote" type="button" class="btn btn-info btn-lg">
                    Add Note</button>
                    <button id="edit" type="button" class="btn btn-success btn-lg float-right">
                    Edit</button>
                    <button id="done" type="button" class="btn btn-info btn-lg float-right">
                    Done</button>
                    <button id="allNotes" type="button" class="btn btn-info btn-lg">
                    All Notes</button>
                </div>
                <div id="notePad">
                    <textarea rows="10"></textarea>
                </div>
                <div id="notes" class="notes">
                <!-- Ajax call to PHP file -->
                </div>
            </div>
        </div>
    </div>


<!-- footer -->
    <div class="footer">
        <div class="container">
            <p>
                flamybakwasss copyright &copy; 2019-<?php $today=date("y"); echo $today?>
            </p>
        </div>
    </div>

    <script src="mynotes.js"></script>
</body>
</html>