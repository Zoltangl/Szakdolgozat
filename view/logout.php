<?php
session_start();

// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Ha be van jelentkezve, állítsuk vissza a bejelentkezési változót false-ra
    $_SESSION['loggedin'] = false;
    // Töröljük a munkamenetet
    session_unset();
    session_destroy();
    // Átirányítás az index.php fájlra a kijelentkezés után
    header("Location: login.php");
    exit();
} else {
    // Ha a felhasználó már kijelentkezett, csak átirányítjuk az index.php fájlra
    header("Location: login.php");
    exit();
}
?>