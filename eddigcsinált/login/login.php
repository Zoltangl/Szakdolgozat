<?php
include("connection.php");
session_start();



// Ellenőrzés a kapcsolat létrehozásakor
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Bejelentkezési adatok ellenőrzése
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ellenőrizze az e-mail címet és a jelszót az adatbázisban
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Sikeres bejelentkezés
        $_SESSION['loggedin'] = true;
        header("Location: welcome.php"); // Átirányítás a sikeres belépés oldalra
        exit();
    } else {
        echo "Hibás felhasználónév vagy jelszó!";
    }
}

$conn->close();
?>
