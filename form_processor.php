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
//
// echo("<pre>");
// print_r($_POST);
// echo("</pre><br/>");
// exit(0);

      if ($_POST['user_password'] === $_POST['user_password_confirm']) {

        $sql = "INSERT INTO tbluser (firstName, lastName, streetAddr, city, state, zipcode, email, homephone, cellphone, ssn, password, role, notifyFlag)
                  VALUES (:firstName, :lastName, :streetAddress, :city, :state, :zipcode, :email, :homephone, :cellphone, :ssn, :password, :role, :notifyFlag)";
        $params = [
            ':firstName' => $_POST['user_f_name'],
            ':lastName' => $_POST['user_l_name'],

            ':streetAddress' => $_POST['user_address'],
            ':city' => $_POST['user_city'],
            ':state' => $_POST['user_state'],
            ':zipcode' => $_POST['user_zipcode'],

            ':email' => $_POST['user_email'],
            ':homephone' => $_POST['user_homephone'],
            ':cellphone' => $_POST['user_cellphone'],
            ':ssn' => $_POST['user_ssn'],

            ':password' => $_POST['user_password'],
            ':role' => 0,
            ':notifyFlag' => 0

        ];
        // echo("<pre>");
        // print_r($params);
        // echo("</pre><br/>");
        // exit(0);
        try {
            //$db = static::connectToPdo();
            //$result = Database::executeQuery($db, $sql, $params);
            $result = $db->executeQuery($con, $sql, $params);
        } catch (PDOException $e) {
            //$errors[] = "ERROR: " . $e->getMessage() . " (" . $e->getCode() . ")";
            echo "ERROR : " . $e->getMessage() . " (" . $e->getCode() . ")<br>";
//            return false;
        }
//
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
        <input type="hidden" name="user_city" value="<?php echo($_POST['user_city']); ?>">
        <input type="hidden" name="user_state" value="<?php echo($_POST['user_state']); ?>">
        <input type="hidden" name="user_zipcode" value="<?php echo($_POST['user_zipcode']); ?>">
        <input type="hidden" name="user_email" value="<?php echo($_POST['user_email']); ?>">
        <input type="hidden" name="user_homephone" value="<?php echo($_POST['user_homephone']); ?>">
        <input type="hidden" name="user_cellphone" value="<?php echo($_POST['user_cellphone']); ?>">
        <input type="hidden" name="user_ssn" value="<?php echo($_POST['user_ssn']); ?>">
        <!-- password should be passed back blank -->
        <input type="hidden" name="user_password" value="<?php echo($_POST['']); ?>">
        <input type="submit" value="Continue">
      </form>
    </div>
    <?php

      } ?>
    <?php require_once 'footer.php'; ?>
</body>
</html>
