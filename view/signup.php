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
    <link rel="icon" href="../img/logo.jpg" type="image/jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-9ndCyUaIbzAi2FU">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/loginandregister.css">

   
    
</head>
<body>

<div class="col-lg-3 bg-dark d-none d-lg-block">
                    <a href="index.php" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                        <h1 class="m-0 text-primary text-uppercase">HappyHotel</h1>
                    </a>
                </div>

    <div id="form">
        <h1 id="heading">Regisztráció<h1>
        <form name="form" method="post">
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
            <div id="atvalt" class="signup-link">Már van fiókod? <a href="#" id="showLoginForm">Belépés</a>
            </div>
            <input type="submit" id="btn" value="Regisztráció" name="submit" required><br><br>
        </form>
    </div>


    <div id="loginForm" style="display: none;">
        <h1 id="heading">Bejelentkezés<h1>
        <form name="loginform" method="post" action="belepes.php">

            <i class="fa-solid fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="Add meg az email címed..." required><br><br>

            <i class="fa-solid fa-lock"></i>
            <input type="password" id="pass" name="pass" placeholder="Add meg a jelszavad..." required><br><br>
            <div class="signup-link">Nincs még fiókod? <a href="#" id="showForm">Regisztráció</a></div>
            <input type="submit" id="btn" value="Bejelentkezés" name="submit" required><br><br>
        </form>
    </div>
    <script>
    // Az eseménykezelő hozzáadása a "Belépés" linkhez
    document.getElementById("showLoginForm").addEventListener("click", function(event) {
        event.preventDefault(); // Az alapértelmezett link művelet megakadályozása

        // A regisztrációs kártya elrejtése
        document.getElementById("form").style.display = "none";
        
        // A belépési kártya megjelenítése
        document.getElementById("loginForm").style.display = "block";
    });
</script>

<script>
    document.getElementById("showForm").addEventListener("click", function(event) {
    event.preventDefault(); // Az alapértelmezett link művelet megakadályozása

    // Az oldal újratöltése
    location.reload();
});

</script>
    <script>
        function isvalid(){
            var email = document.from.email.value;
            var pass = document.from.pass.value;
        }
        <?php
$msg = "";
if (
    !isset($_POST["firstusername"]) &&
    !isset($_POST["secondusername"]) &&
    !isset($_POST["email"]) &&
    !isset($_POST["number"]) &&
    !isset($_POST["pass"]) &&
    !isset($_POST["cpass"]) &&
    $_POST["pass"] !== $_POST["cpass"]
) {
    $msg = "A jelszavak nem egyeznek";
} else {
    $msg = "csatlakoztál";

    $hashed_password = hash('sha256', $_POST["pass"]);
    $sql = "INSERT INTO `felhasznalo`(`vezeteknev`, `keresztnev`, `email_cim`, `telefonszam`, `jelszo`) 
            VALUES ('".$_POST["firstusername"]."','".$_POST["secondusername"]."','".$_POST["email"]."','".$_POST["number"]."','".$hashed_password."');";

    $result = DataBase::$conn->query($sql);

    if (!$result) {
        $msg = "Hiba történt a regisztráció során";
    }
}
?>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3"><><>

</body>
</html> 