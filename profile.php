<?php
    error_reporting(E_ALL ^ E_NOTICE);
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Profile Page </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
      include 'master.php';
      $sql = "SELECT * FROM tbluser WHERE id = :id";
      $params = [':id' => $_SESSION['id']];
      $results = $db->executeSelectQuery($con, $sql, $params);
    ?>
    <div class="container text-center">
        <h1>Welcome to the Profile page</h1>
    </div>
    <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <form role="form" action="#" method="post">
                  <div class="row">
                      <div class="col-xs-6 col-sm-6 col-md-6">
                          <div class="form-group">
                              <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $results[0]['firstName']; ?>" disabled />
                          </div>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6">
                          <div class="form-group">
                              <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $results[0]['lastName']; ?>" disabled />
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <input type="text" name="address" id="address" class="form-control" value="<?php echo $results[0]['streetAddr']; ?>" disabled />
                  </div>
                  <div class="row">
                      <div class="col-xs-6 col-sm-6 col-md-6">
                          <div class="form-group">
                              <input type="tel" name="phone" id="phone" class="form-control" maxlength="12" value="<?php echo $results[0]['city']; ?>" disabled />
                          </div>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6">
                          <div class="form-group">
                              <input type="tel" name="phone" id="phone" class="form-control" maxlength="12" value="<?php echo $results[0]['state']; ?>" disabled />
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-xs-6 col-sm-6 col-md-6">
                          <div class="form-group">
                              <input type="tel" name="phone" id="phone" class="form-control" maxlength="12" value="<?php echo $results[0]['zipcode']; ?>" disabled />
                          </div>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6">
                          <div class="form-group">
                            <?php
                            $ssn = substr($results[0]['ssn'], 0, 3).'-'.substr($results[0]['ssn'], 3, 2).'-'.substr($results[0]['ssn'],5);
                             ?>
                              <input type="text" name="ssn" id="ssn" class="form-control" maxlength="11" value="<?php echo $ssn; ?>" disabled />
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-xs-6 col-sm-6 col-md-6">
                          <div class="form-group">
                            <?php
                            $homephone = '('.substr($results[0]['homephone'], 0, 3).') '.substr($results[0]['homephone'], 3, 3).'-'.substr($results[0]['homephone'],5);
                             ?>
                              <input type="text" name="homephone" id="homephone" class="form-control" maxlength="11" value="<?php echo $homephone; ?>" disabled />
                          </div>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6">
                          <div class="form-group">
                            <?php
                            $cellphone = '('.substr($results[0]['cellphone'], 0, 3).') '.substr($results[0]['cellphone'], 3, 3).'-'.substr($results[0]['cellphone'],5);
                             ?>
                              <input type="text" name="cellphone" id="cellphone" class="form-control" maxlength="11" value="<?php echo $cellphone; ?>" disabled />
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <input type="text" name="email" id="email" class="form-control" value="<?php echo $results[0]['email']; ?>" disabled />
                  </div>

              </form>
          </div>
      </div>
      <?php include 'footer.php'; ?>
</body>
<script type="text/javascript">document.getElementById("Profile").className="active";</script>
</html>
