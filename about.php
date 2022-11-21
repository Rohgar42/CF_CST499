<?php
    error_reporting(E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> About Page </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
    <?php require 'master.php'; ?>
    <div class="container text-center">
        <h1>Welcome to the About page</h1>
        <p>Apple π University is here to educate young brains and to empty the pockets of their parents.</p>
        <p>This is the cheepest university in the USA to get your degree from.</p>
    </div>
    <?php require_once 'footer.php'; ?>
</body>
</html>
