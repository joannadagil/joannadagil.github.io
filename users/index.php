<?php include "db.php"; 

$edit_mode = false;
$edit_user = [
    "imie" => "",
    "nazwisko" => "",
    "pesel" => "",
    "data_urodzenia" => ""
];

if (isset($_GET['edit_id'])) {
    $edit_mode = true;
    $id = $_GET['edit_id'];

    // pobranie danych
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();

    if ($user) {
        $edit_user = $user;

        // usuń rekord, żeby uniknąć duplikatu
        $conn->query("DELETE FROM users WHERE id=$id");
    }
}
?>


<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Lista użytkowników</title>
<link rel="stylesheet" href="index.css">
</head>
<body>

<h1>Lista użytkowników</h1>

<form action="index.php" method="post">
    <label>Imię:</label>
    <input type="text" name="imie" value="<?= $edit_user['imie'] ?>">

    <label>Nazwisko:</label>
    <input type="text" name="nazwisko" value="<?= $edit_user['nazwisko'] ?>">

    <label>PESEL:</label>
    <input type="text" name="pesel" maxlength="11" value="<?= $edit_user['pesel'] ?>">

    <label>Data urodzenia:</label>
    <input type="date" name="data_urodzenia" value="<?= $edit_user['data_urodzenia'] ?>" required>

    <input type="submit" name="submit" value="<?= $edit_mode ? 'Zapisz zmiany' : 'Dodaj użytkownika' ?>">
</form>

<?php
// Dodawanie rekordu
if (isset($_POST['submit'])) {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $pesel = $_POST['pesel'];
    $data = $_POST['data_urodzenia'];

    $conn->query("INSERT INTO users (imie, nazwisko, pesel, data_urodzenia)
                  VALUES ('$imie', '$nazwisko', '$pesel', '$data')");
}

// Pobieranie danych
$result = $conn->query("SELECT * FROM users");
?>

<br><br>

<form style="max-width:900px;">
<table border="1" width="100%" style="border-collapse: collapse;">
    <tr>
        <th>ID</th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>PESEL</th>
        <th>Data urodzenia</th>
        <th>Akcje</th>
    </tr>

<?php
while($row = $result->fetch_assoc()):
?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['imie'] ?></td>
        <td><?= $row['nazwisko'] ?></td>
        <td><?= $row['pesel'] ?></td>
        <td><?= $row['data_urodzenia'] ?></td>
        <td>
            <a class="action-btn btn" 
                href="index.php?edit_id=<?= $row['id'] ?>">
                Edytuj
            </a>

            <a class="action-btn btn" 
                href="delete.php?id=<?= $row['id'] ?>" 
                onclick="return confirm('Usunąć?')">
                Usuń
            </a>
        </td>
    </tr>
<?php endwhile; ?>
</table>
</form>

</body>
</html>
