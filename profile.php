<?php
    error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    // echo("<pre>Session:");
    // print_r($_SESSION);
    // echo("</pre><br>");
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
    <?php include 'master.php'; ?>
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
                                <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $_SESSION['firstName']; ?>" disabled />
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $_SESSION['lastName']; ?>" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control input-sm" maxlength="50" value="<?php echo $_SESSION['email']; ?>" disabled />
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" id="address" class="form-control" value="<?php echo $_SESSION['address']; ?>" disabled />
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="tel" name="phone" id="phone" class="form-control" maxlength="12" value="<?php echo $_SESSION['phone']; ?>" disabled />
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                              <?php
                              $ssn = substr($_SESSION['SSN'], 0, 3).'-'.substr($_SESSION['SSN'], 3, 2).'-'.substr($_SESSION['SSN'],5);
                               ?>
                                <input type="text" name="ssn" id="ssn" class="form-control" maxlength="11" value="<?php echo $ssn; ?>" disabled />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="salary" id="salary" class="form-control" value="$<?php echo $_SESSION['salary']; ?>" disabled />
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="password" id="password" class="form-control input-sm" minlength="8" value="<?php echo $_SESSION['password']; ?>" disabled />
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <?php include 'footer.php'; ?>

</body>
</html>
