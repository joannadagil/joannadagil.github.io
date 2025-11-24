<?php
$fname    = $_POST['fname']    ?? '';
$lname    = $_POST['lname']    ?? '';
$birth    = $_POST['birth']    ?? '';
$mood     = $_POST['mood']     ?? '';
$comments = $_POST['comments'] ?? '';

$yes = isset($_POST['yes']) ? 'yes checked' : 'yes not checked';
$no  = isset($_POST['no'])  ? 'no checked'  : 'no not checked';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Form results</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>

<form>
<h1>results from form</h1>

<br>

<label>First name:</label>
<p> <?php echo htmlspecialchars($fname); ?></p>

<label>Last name:</label>
<p> <?php echo htmlspecialchars($lname); ?></p>

<label>Date of birth: </label>
<p><?php echo htmlspecialchars($birth); ?></p>


<label>Yes / No:</label>
<p>
    <?php echo htmlspecialchars($yes); ?><br>
    <?php echo htmlspecialchars($no); ?>
</p>


<label>How much (0-10):</label>
<p> <?php echo htmlspecialchars($mood); ?></p>

<label>Additional comments:</label>
<p>
    <?php echo nl2br(htmlspecialchars($comments)); ?>
</p>

<a href="form.html">Back to form</a>

</form>

</body>
</html>
