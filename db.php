<?php
$servername = "localhost";
$username = "root";
$password = "BM-;al1xn-=e";
$dbname = "todo_list";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
