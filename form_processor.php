<?php
    error_reporting(E_ALL ^ E_NOTICE);
     // echo("<pre>");
     // print_r($_POST);
     // echo("</pre><br>");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Login Page </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
      require 'master.php';
      if ($_POST['user_pwd'] == $_POST['password_confirmation']) {
        $sql = "INSERT INTO tbluser (firstName, lastName, address, phone, ssn, salary, email, password) VALUES (?,?,?,?,?,?,?,?)";
        $params = [
          $_POST['user_l_name'],
          $_POST['user_address'],
          $_POST['user_f_name'],
          $_POST['user_phone'],
          $_POST['user_ssn'],
          $_POST['user_salary'],
          $_POST['user_email'],
          $_POST['user_pwd']
        ];
        $result = $db->executeQuery($con, $sql, $params);
    } else {
      $result = false;
    }
      if ($result === true) {
    ?>
    <div class="container text-center">
      <p>Registration succesful!</p>
      <form action="/login.php" method="post">
        <input type="submit" value="Login">
      </form>
    </div>
    <?php
      } else { ?>
    <div class="container text-center">
      <p>Registration failed!</p>
      <form action="/registration.php" method="post">
        <input type="hidden" name="user_f_name" value="<?php echo($_POST['user_f_name']); ?>">
        <input type="hidden" name="user_l_name" value="<?php echo($_POST['user_l_name']); ?>">
        <input type="hidden" name="user_address" value="<?php echo($_POST['user_address']); ?>">
        <input type="hidden" name="user_phone" value="<?php echo($_POST['user_phone']); ?>">
        <input type="hidden" name="user_ssn" value="<?php echo($_POST['user_ssn']); ?>">
        <input type="hidden" name="user_salary" value="<?php echo($_POST['user_salary']); ?>">
        <input type="hidden" name="user_email" value="<?php echo($_POST['user_email']); ?>">
        <!-- password should be passed back blank -->
        <input type="hidden" name="user_pwd" value="<?php echo($_POST['']); ?>">

        <input type="submit" value="Continue">
      </form>
    </div>
    <?php

      } ?>
    <?php require_once 'footer.php'; ?>
</body>
</html>
