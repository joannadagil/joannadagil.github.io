<?php
$host = "localhost";
$user = "root";     // twój user
$pass = "root";         // twoje hasło
$dbname = "users_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
