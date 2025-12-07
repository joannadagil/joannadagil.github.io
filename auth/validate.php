<?php

header("Content-Type: application/json");

// Odbierz hasło z AJAX
$password = $_POST['password'] ?? "";

// Regex jak w rejestracji
$valid = preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password);

// Zwróć wynik w JSON
echo json_encode([
    "valid" => $valid ? true : false
]);
