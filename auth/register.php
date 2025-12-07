<?php
include "../db.php";

$message = "";

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Regex: minimum 8 znaków, jedna wielka litera, jedna cyfra
    if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
        $message = "Hasło musi mieć min. 8 znaków, 1 dużą literę i 1 cyfrę.";
    } else {
        // HASHOWANIE
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO auth_users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hash);
        $stmt->execute();

        $message = "Konto utworzone! Możesz się zalogować.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Register</title>
<link rel="stylesheet" href="../index.css">
</head>
<body>

<h1>REGISTER</h1>

<?php if ($message): ?>
<p><?= $message ?></p>
<?php endif; ?>

<form method="post">
    <label>Username:</label>
    <input type="text" name="username" required>

    <label>Password:</label>
    <input type="text" name="password" id="password" required>

    <div id="password-status" 
        style="margin-top: 10px; margin-bottom: 20px; font-weight: 600;">
    </div>

    <input type="submit" name="register" value="Register">
</form>

<p>Masz konto? <a href="index.php">Zaloguj się</a></p>

<script>
document.getElementById("password").addEventListener("input", function() {

    let password = this.value;

    // AJAX request
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "validate.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        let response = JSON.parse(this.responseText);
        let statusDiv = document.getElementById("password-status");

        if (password.length === 0) {
            statusDiv.innerHTML = "";
            return;
        }

        if (response.valid) {
            statusDiv.style.color = "green";
            statusDiv.innerHTML = "Hasło jest poprawne";
        } else {
            statusDiv.style.color = "red";
            statusDiv.innerHTML = "Hasło musi mieć 8 znaków, jedną dużą literę i cyfrę";
        }
    };

    xhr.send("password=" + encodeURIComponent(password));
});
</script>


</body>
</html>
