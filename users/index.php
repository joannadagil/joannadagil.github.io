<?php include "../db.php"; 

$edit_mode = false;
$edit_user = [
    "imie" => "",
    "nazwisko" => "",
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

        // usunięcie rekordu
        $conn->query("DELETE FROM users WHERE id=$id");
    }
}
?>


<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Users</title>
<link rel="stylesheet" href="../index.css">
</head>
<body>

<h1>USERS</h1>

<form action="index.php" method="post">
    <label>Name:</label>
    <input type="text" name="imie" value="<?= $edit_user['imie'] ?>">

    <label>Surname:</label>
    <input type="text" name="nazwisko" value="<?= $edit_user['nazwisko'] ?>">

    <label>Date of birth:</label>
    <input type="date" name="data_urodzenia" value="<?= $edit_user['data_urodzenia'] ?>" required>

    <input type="submit" name="submit" value="Submit">
</form>

<?php
// Dodawanie rekordu
if (isset($_POST['submit'])) {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $data = $_POST['data_urodzenia'];

    $conn->query("INSERT INTO users (imie, nazwisko, data_urodzenia)
                  VALUES ('$imie', '$nazwisko', '$data')");
}

// Pobieranie danych
$result = $conn->query("SELECT * FROM users");
?>

<br><br>

<form style="max-width:900px;">
<table border="1" width="100%" style="border-collapse: collapse;">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Date of bitrh</th>
        <th>Actions</th>
    </tr>

<?php
while($row = $result->fetch_assoc()):
?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['imie'] ?></td>
        <td><?= $row['nazwisko'] ?></td>
        <td><?= $row['data_urodzenia'] ?></td>
        <td>
            <a class="action-btn btn" 
                href="index.php?edit_id=<?= $row['id'] ?>">
                Edit
            </a>

            <a class="action-btn btn" 
                href="delete.php?id=<?= $row['id'] ?>" 
                onclick="return confirm('Usunąć?')">
                Delete
            </a>
        </td>
    </tr>
<?php endwhile; ?>
</table>
</form>

</body>
</html>
