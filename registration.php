<?php
error_reporting(E_ALL ^ E_NOTICE);
if (!empty($_POST)) {
  $ufname = $_POST['user_f_name'];
  $ulname= $_POST['user_l_name'];

  $uaddress = $_POST['user_address'];
  $ucity = $_POST['user_city'];
  $ustate = $_POST['user_state'];
  $uzip = $_POST['user_zipcode'];

  $uemail = $_POST['user_email'];
  $uphone = $_POST['user_homephone'];
  $ucell = $_POST['user_cellphone'];
  $ussn= $_POST['user_ssn'];

  $upwd = $_POST['user_password'];

} else {
  $ufname = "";
  $ulname = "";

  $uaddress = "";
  $ucity = "";
  $ustate = "";
  $uzip = "";

  $uemail = "";
  $uphone = "";
  $ucell = "";
  $ussn = "";

  $upwd = "";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Registration Page </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
<?php include 'master.php';
$str = "select * FROM tbluser";
$output = $db->executeSelectQuery($con, $str);
//print_r($output);
?>
<div class="container text-center">
    <h1>Welcome to the Registration page</h1>
</div>
<div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Please create an account:</h3>
        </div>
        <div class="panel-body">
           <form role="form" action="form_processor.php" method="post">
              <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <div class="text-left">
                        <label for="user_f_name">First Name</label>
                      </div>
                      <input type="text" name="user_f_name" id="user_f_name" class="form-control input-sm" placeholder="First Name" required autofocus />
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <div class="text-left">
                        <label for="user_l_name">Last Name</label>
                      </div>
                      <input type="text" name="user_l_name" id="user_l_name" class="form-control input-sm" placeholder="Last Name" required />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="text-left">
                    <label for="user_address" class="">Street Address</label>
                  </div>
                  <input type="text" name="user_address" id="user_address" class="form-control input-sm" placeholder="Street Address" required />
                </div>
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <div class="text-left">
                        <label for="user_city" class="">City</label>
                      </div>
                      <input type="text" name="user_city" id="user_city" class="form-control input-sm" maxlength="30" placeholder="City" required />
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <div class="text-left">
                        <label for="user_state" class="">State</label>
                      </div>
                      <input type="text" name="user_state" id="user_state" class="form-control input-sm" maxlength="30" placeholder="State" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <div class="text-left">
                        <label for="user_zipcode" class="">Zip Code</label>
                      </div>
                      <input type="text" name="user_zipcode" id="user_zipcode" class="form-control input-sm" maxlength="10" placeholder="Zip Code" required />
                    </div>
                  </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <div class="text-left">
                        <label for="user_ssn" class="">SSN</label>
                      </div>
                      <input type="text" name="user_ssn" id="user_ssn" class="form-control input-sm" pattern="(!^\d{3}-\d{2}-\d{4}$" maxlength="11" placeholder="Social Security Number" required />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <div class="text-left">
                        <label for="user_homephone" class="">Home Phone</label>
                      </div>
                      <input type="tel" name="user_homephone" id="user_homephone" class="form-control input-sm" pattern="(!^\d{3}-\d{3}-\d{4}$" maxlength="20" placeholder="Home Phone" required />
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <div class="text-left">
                        <label for="user_cellphone" class="">Cell Phone</label>
                      </div>
                      <input type="tel" name="user_cellphone" id="user_cellphone" class="form-control input-sm" pattern="(!^\d{3}-\d{3}-\d{4}$" maxlength="20" placeholder="Cell Phone" required />
                    </div>
                  </div>
                </div>
                  <div class="form-group">
                    <div class="text-left">
                      <label for="user_email" class="">Email Address</label>
                    </div>
                  <input type="email" name="user_email" id="user_email" class="form-control input-sm" maxlength="50" placeholder="Email Address" required />
                  </div>
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="password" name="user_password" id="user_password" class="form-control input-sm" minlength="8" placeholder="Password" required>
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="password" name="user_password_confirm" id="user_password_confirm" class="form-control input-sm" minlength="8" placeholder="Confirm Password" required>
                    </div>
                  </div>
                </div>
                <input type="submit" value="Register" class="btn btn-info btn-block">
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<script type="text/javascript">document.getElementById("Registration").className="active";</script>
</body>
</html>
