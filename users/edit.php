<?php
include "db.php";

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id=$id");
$user = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $pesel = $_POST['pesel'];
    $data = $_POST['data_urodzenia'];

    $conn->query("UPDATE users SET 
                  imie='$imie',
                  nazwisko='$nazwisko',
                  pesel='$pesel',
                  data_urodzenia='$data'
                  WHERE id=$id");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Edycja</title>
<link rel="stylesheet" href="form.css">
</head>
<body>

<h1>Edytuj użytkownika</h1>

<form method="post">
    <label>Imię:</label>
    <input type="text" name="imie" value="<?= $user['imie'] ?>">

    <label>Nazwisko:</label>
    <input type="text" name="nazwisko" value="<?= $user['nazwisko'] ?>">

    <label>PESEL:</label>
    <input type="text" name="pesel" value="<?= $user['pesel'] ?>">

    <label>Data urodzenia:</label>
    <input type="date" name="data_urodzenia" value="<?= $user['data_urodzenia'] ?>">

    <input type="submit" name="update" value="Zapisz zmiany">
</form>

</body>
</html>
