<?php
    error_reporting(E_ALL ^ E_NOTICE);
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
      if (!empty($_POST)) {
        $sql = "SELECT * FROM tbluser WHERE email = :user_email";
        $params = [':user_email' => $_POST['email']];
        $results = $db->executeSelectQuery($con, $sql, $params);
        if ($_POST['password'] == $results[0]['password']) {
          $successMsg = "Login Successfil";
          $_SESSION = $results[0];
          $_SESSION['username'] = $results[0]['firstName'];
          $_SESSION['id'] = $results[0]['id'];
          header('Refresh: 0; URL=index.php');
        } else {
          $errMsg = "Invalid email or password entered.";
        }
      }
  ?>
    <div class="container text-center">
        <h1>Welcome to the Login page</h1>
        <?php
            if ($errMsg) {
                echo("<h4>ERROR: ".$errMsg."</h4><br>");
            } elseif ($successMsg) {
                echo("<h4>".$successMsg."</h4><br>");
            }
            ?>
    </div>
  <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
      <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title text-center">Please enter your login information:</h3>
          </div>
          <div class="panel-body">
              <form role="form" action="./login.php" method="post">
                  <div class="form-group">
                      <input type="email" name="email" id="email" class="form-control input-sm" maxlength="50" placeholder="Email Address" required />
                  </div>
                  <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                              <input type="password" name="password" id="password" class="form-control input-sm" minlength="8" placeholder="Password" required />
                          </div>
                      </div>
                  </div>
                  <input type="submit" value="Login" class="btn btn-info btn-block">
              </form>
          </div>
      </div>
  </div>
  <script type="text/javascript">document.getElementById("Login").className="active";</script>
</html>
