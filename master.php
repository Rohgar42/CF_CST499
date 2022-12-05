<?php
    error_reporting(E_ALL ^ E_NOTICE);
   if (session_status() == PHP_SESSION_NONE) {
     ini_set('session.use_only_cookies','1');
     session_start();
   }
   // if (isset($_SESSION['username'])) {
   //   echo "Welcome: " . $_SESSION['username'];
   // }
    include "Database.php";
    $db = new Database;
    $con = $db->connectToDb();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="jumbotron">
    <div class="container text-center">
        <h1>Apple π University</h1>
    </div>
</div>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li id="index"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li id="AboutUs"><a href="about.php"><span class="glyphicon glyphicon-exclamation-sign"></span> AboutUs</a></li>
                <li id="ContactUs"><a href="contact.php"><span class="glyphicon glyphicon-earphone"></span> ContactUs</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                    // ini_set('session.use_only_cookies','1');
                    // session_start();
                    if (isset($_SESSION['username'])) {
                        echo('<li id="Enroll"><a href="enroll.php"><span class="glyphicon glyphicon-education"></span> Enroll</a></li>');
                        echo('<li id="Profile"><a href="profile.php"><span class="glyphicon glyphicon-briefcase"></span> Profile</a></li>');
                        echo('<li id="Logout"><a href="index.php?Logout=1"><span class="glyphicon glyphicon-off"></span> Logout</a></li>');

                    } else {
                        echo('<li id="Login"><a href="login.php"><span class="glyphicon glyphicon-user"></span> Login</a></li>');
                        echo('<li id="Registration"><a href="registration.php"><span class="glyphicon glyphicon-pencil"></span> Registration</a></li>');
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>
</body>
</html>
