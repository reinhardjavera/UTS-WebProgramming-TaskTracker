<?php
session_start();
if (isset($_POST['login'])) {
    include('db.php'); // File koneksi database
    $username = $_POST['username'];
    $password = $_POST['password'];


    // Memakai password_hash dan password_verify
    // select password dulu berdasarkan username, lalu password dicompare mmemakai password_verify

    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();
    $assoc = $res->fetch_assoc();
    if ($res->num_rows == 1) {
        if (password_verify($password, $assoc['password'])) {
            $id = $assoc['id'];
            $sql = "SELECT id, username FROM users WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_id'] = $row['id'];
                header("Location: index.php");
            } else {
?>
                <form action="login.php" id="regForm" method="POST">
                    <input type="hidden" name="loginFailed" value="">
                </form>
                <script>
                    document.getElementById("regForm").submit()
                </script>
            <?php
            }
        } else {
            ?>
            <form action="login.php" id="regForm" method="POST">
                <input type="hidden" name="loginFailed" value="">
            </form>
            <script>
                document.getElementById("regForm").submit()
            </script>
        <?php
        }
    } else {
        ?>
        <form action="login.php" id="regForm" method="POST">
            <input type="hidden" name="loginFailed" value="">
        </form>
        <script>
            document.getElementById("regForm").submit()
        </script>
<?php
    }
} else {
    header("Location: login.php");
}
