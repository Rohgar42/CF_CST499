<?php
    error_reporting(E_ALL ^ E_NOTICE);
    isset($_SESSION) ? null : session_start();
    if ((isset($_GET['Logout'])) && ($_GET['Logout'] == 1)) {
      $_SESSION = "";
      $_POST = "";
      session_destroy();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Home Page </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<?php require 'master.php'; ?>

<div class="container text-center">
    <?php
    if (isset($_SESSION['username'])) {
        echo('<h1>Welcome to the Student Portal '.$_SESSION['username'].'</h1>');
    } else {
        echo('<h1>Welcome to the Student Portal Home Page.</h1>
              <p>To log in, please click the Login link in the menu above. </p>
              <p>If you don`t have a login? Click the Registration link in the menu above.</p>');
    }
    ?>
</div>

<?php require_once 'footer.php'; ?>

</body>
<script type="text/javascript">document.getElementById("index").className="active";</script>
</html>
