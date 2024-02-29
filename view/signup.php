<?php
require ('connection.php');
$db = new DataBase;
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1">
    <title>HappyHotel</title>
    <link rel="icon" href="img/logo.jpg" type="image/jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-9ndCyUaIbzAi2FU">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="css/loginandregister.css">

   
    
</head>
<body>

<div class="col-lg-3 bg-dark d-none d-lg-block">
                    <a href="index.php" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                        <h1 class="m-0 text-primary text-uppercase">HappyHotel</h1>
                    </a>
                </div>

    <div id="form">
        <h1 id="heading">Regisztráció<h1>
        <form name="form" method="post" action="index.php">
            <i class="fa-solid fa-user"></i>
            <input type="text" id="firstusername" name="firstusername" placeholder="Add meg a Vezetékneved..." required><br><br>

            <i class="fa-solid fa-user"></i>
            <input type="text" id="secondusername" name="secondusername" placeholder="Add meg a Keresztneved..." required><br><br>

            <i class="fa-solid fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="Add meg az email címed..." required><br><br>

            <i class="fa-solid fa-phone"></i>
            <input type="text" id="number" name="number" placeholder="Add meg a telefonszámod... (+36)" pattern="[0-9]+" required title="Csak szám megadása lehetséges"><br><br>

            <i class="fa-solid fa-lock"></i>
            <input type="password" id="pass" name="pass" placeholder="Add meg a jelszavad..." required><br><br>

            <i class="fa-solid fa-lock"></i>
            <input type="password" id="cpass" name="cpass" placeholder="Jelszó megerősítése..." required><br><br>

            <div style="text-align: center;">
            <input type="submit" id="btn" value="Regisztráció" name="submit" required><br><br>
        </div>
        </form>

    <!-- A "Belépés" link -->
    <div style="text-align: center;">
        <div id="atvalt" class="signup-link">Már van fiókod? <a href="login.php">Belépés</a></div>
    </div>
</div>





<?php


if(isset($_POST['submit'])) {
    // Űrlapadatok ellenőrzése
    $firstusername = $_POST['firstusername'];
    $secondusername = $_POST['secondusername'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    // Adatbázis kapcsolat létrehozása
    $db = new DataBase();

    // Jelszó ellenőrzése
    if($pass != $cpass) {
        echo "A két jelszó nem egyezik!";
    } else {
        // Jelszó hashelése
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        // SQL Injection elleni védelem
        $firstusername = $db::$conn->real_escape_string($firstusername);
        $secondusername = $db::$conn->real_escape_string($secondusername);
        $email = $db::$conn->real_escape_string($email);
        $number = $db::$conn->real_escape_string($number);

        // SQL parancs előkészítése és végrehajtása
        $sql = "INSERT INTO users (firstusername, secondusername, email, number, pass) VALUES ('$firstusername', '$secondusername', '$email', '$number', '$hashed_pass')";

        if ($db::$conn->query($sql) === TRUE) {
            echo "Sikeres regisztráció!";
        } else {
            echo "Hiba a regisztráció során: " . $db::$conn->error;
        }
    }

    // Adatbázis kapcsolat lezárása
    $db::$conn->close();
}
?>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3"><><>

</body>
</html> 