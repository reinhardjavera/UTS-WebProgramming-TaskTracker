<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    include('login_handler.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">

<body class="body-login-register">
    <div class="form-bg">
        <div class="container">
            <h1 class="app-title">Task Tracker</h1>
            <div class="row justify-content-center">

                <?php
                if (isset($_POST['loginFailed'])) {
                ?>
                    <div class="p-3 mb-2 bg-warning text-dark rounded" id="failLogin">
                        Login failed. Username not found or password is incorrect.
                    </div>
                <?php
                }
                ?>

                <?php
                if (isset($_POST['registerSuccess'])) {
                ?>
                    <div class="alert alert-success" role="alert" id="successRegister">
                        Your Registration Was Successful!
                    </div>
                <?php
                }
                ?>

                <div class="col-md-offset-3 col-md-6">
                    <form class="form-horizontal" action="login.php" method="post">
                        <span class="heading">Log In</span>
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Username">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="form-group help">
                            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                            <i class="fa fa-lock"></i>
                        </div>
                        <div class="form-group">
                            <p>Don't have an account? <a href="register.php">Register here!</a></p>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="login" value="login" class="btn btn-default">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>