<?php
include "db.php";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $passConfirm = $_POST['passwordConfirm'];
    if ($pass == $passConfirm) {
        $password = password_hash($pass, PASSWORD_BCRYPT);
        $level = "admin";
        echo $password;
        $q = "INSERT INTO users VALUES (NULL, ?, ?)";
        $stmt = $conn->prepare($q);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
?>
        <form action="login.php" id="regForm" method="POST">
            <input type="hidden" name="registerSuccess" value="">
        </form>
        <script>
            document.getElementById("regForm").submit()
        </script>
    <?php
    } else {
    ?>
        <form action="register.php" id="regFail" method="POST">
            <input type="hidden" name="unmatched" value="">
        </form>
        <script>
            document.getElementById("regFail").submit()
        </script>
<?php
        echo "Pass doesn't match";
    }
}
?>