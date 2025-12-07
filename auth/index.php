<?php
session_start();
include "../db.php";

$message = "";

// domyślne do formularza — zgodnie z wymaganiem
$default_username = "root";
$default_password = "root";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM auth_users WHERE username=? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $username;
            header("Location: protected.php");
            exit;
        } else {
            $message = "Nieprawidłowe hasło.";
        }

    } else {
        $message = "Użytkownik nie istnieje.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="../index.css">
</head>
<body>

<h1>LOGIN</h1>

<?php if ($message): ?>
<p><?= $message ?></p>
<?php endif; ?>

<form method="post">
    <label>Username:</label>
    <input type="text" name="username" value="<?= $default_username ?>">

    <label>Password:</label>
    <input type="text" name="password" value="<?= $default_password ?>">

    <input type="submit" name="login" value="Login">
</form>

<p>Nie masz konta? <a href="register.php">Zarejestruj się</a></p>

</body>
</html>
