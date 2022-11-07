<?php
error_reporting(E_ALL ^ E_NOTICE);
if (!empty($_POST)) {
  $uemail = $_POST['user_email'];
  $upwd = $_POST['user_pwd'];
  $ufname = $_POST['user_f_name'];
  $ulname= $_POST['user_l_name'];
  $uaddress = $_POST['user_address'];
  $uphone = $_POST['user_phone'];
  $usalary = $_POST['user_salary'];
  $ussn= $_POST['user_ssn'];

} else {
  $uemail = "";
  $upwd = "";
  $ufname = "";
  $ulname = "";
  $uaddress = "";
  $uphone = "";
  $usalary = "";
  $ussn= "";
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
                            <input type="text" name="user_f_name" id="user_f_name" class="form-control" placeholder="First Name" required autofocus />
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" name="user_l_name" id="user_l_name" class="form-control" placeholder="Last Name" required />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="email" name="user_email" id="user_email" class="form-control input-sm" maxlength="50" placeholder="Email Address" required />
                </div>
                <div class="form-group">
                    <input type="text" name="user_address" id="user_address" class="form-control" placeholder="Mailing Address" required />
                </div>

                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="tel" name="user_phone" id="user_phone" class="form-control" maxlength="12" placeholder="Phone Number" required />
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" name="user_ssn" id="user_ssn" class="form-control" maxlength="11" placeholder="Social Security Number" required />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="number" name="user_salary" id="user_salary" class="form-control" placeholder="Salary" required />
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            &nbsp;
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="user_pwd" id="user_pwd" class="form-control input-sm" minlength="8" placeholder="Password" required />
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" minlength="8" placeholder="Confirm Password" required />
                        </div>
                    </div>
                </div>
                <input type="submit" value="Register" class="btn btn-info btn-block">
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
