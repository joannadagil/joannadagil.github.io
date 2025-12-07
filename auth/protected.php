<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Protected</title>
<link rel="stylesheet" href="../index.css">
</head>
<body>

<h1>Witaj, <?= $_SESSION['user'] ?>!</h1>

<p>To jest strona dostępna tylko dla zalogowanych.</p>

<a class="action-btn" href="logout.php">Logout</a>

</body>
</html>
