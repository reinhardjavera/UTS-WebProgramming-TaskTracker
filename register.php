<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<body class="body-login-register">
    <div class="form-bg">
        <div class="container">
            <h1 class="app-title">Task Tracker</h1>
            <div class="row justify-content-center">

                <?php
                if (isset($_POST['unmatched'])) { ?>
                    <div class="alert alert-danger" role="alert" id="unmatchedPass">
                        Password and Confirm Password do not match
                    </div>
                <?php
                }
                ?>

                <div class="col-md-offset-3 col-md-6">
                    <form class="form-horizontal" action="register_handler.php" method="post">
                        <span class="heading">Registration</span>
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" id="form-control" placeholder="Username" required>
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" id="form-control" placeholder="Password" required>
                            <i class="fa fa-lock"></i>
                        </div>
                        <div class="form-group">
                            <input type="password" name="passwordConfirm" class="form-control" id="" placeholder="Confirm Password" required>
                            <i class="fa fa-key"></i>
                        </div>
                        <div class="form-group">
                            <p>Already have an account? <a href="login.php">Log In here!</a></p>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="register" value="register" class="btn btn-default" id="btn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>