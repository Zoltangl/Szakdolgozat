<?php

// Bejelentkezés funkció
function login($email) {
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;
}

// Kijelentkezés funkció
function logout() {
    // Session változók törlése
    session_unset();
    session_destroy();
}

// Ellenőrizze, hogy a felhasználó be van-e jelentkezve
function is_logged_in() {
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}
?>
