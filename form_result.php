<?php
// Dla bezpieczeństwa (żeby nie było ostrzeżeń, gdy ktoś wejdzie bez formularza)
$fname    = $_POST['fname']    ?? '';
$lname    = $_POST['lname']    ?? '';
$birth    = $_POST['birth']    ?? '';
$mood     = $_POST['mood']     ?? '';
$comments = $_POST['comments'] ?? '';

// Checkboxy – sprawdzamy, czy zostały zaznaczone
$yes = isset($_POST['yes']) ? 'yes checked' : 'yes not checked';
$no  = isset($_POST['no'])  ? 'no checked'  : 'no not checked';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Your data</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>

<h1>Your data from the form</h1>

<p><strong>First name:</strong> <?php echo htmlspecialchars($fname); ?></p>
<p><strong>Last name:</strong> <?php echo htmlspecialchars($lname); ?></p>
<p><strong>Date of birth:</strong> <?php echo htmlspecialchars($birth); ?></p>

<p><strong>Yes / No:</strong><br>
    <?php echo htmlspecialchars($yes); ?><br>
    <?php echo htmlspecialchars($no); ?>
</p>

<p><strong>Mood (0–10):</strong> <?php echo htmlspecialchars($mood); ?></p>

<p><strong>Additional comments:</strong><br>
    <?php echo nl2br(htmlspecialchars($comments)); ?>
</p>

<a href="form.html">Back to form</a>

</body>
</html>
