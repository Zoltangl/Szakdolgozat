<?php

include('connection.php');

// Változók inicializálása
$pass_error = '';
$tel_error = '';
$vezeteknev = '';
$keresztnev = '';
$email = '';
$telefonszam = '';

// Ellenőrizze, hogy az űrlap elküldésekor POST-ot használnak-e
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ellenőrizze és mentse az űrlapból érkező adatokat
    $vezeteknev = $_POST["firstusername"];
    $keresztnev = $_POST["secondusername"];
    $email = $_POST["email"];
    $telefonszam = $_POST["number"];
    $jelszo = $_POST["pass"];
    $jelszo_megerositese = $_POST["cpass"];

    // Ellenőrizze a jelszó hosszát, kisbetűtartalmát és nagybetűtartalmát
    if (strlen($jelszo) < 4 || !preg_match('/[a-z]/', $jelszo) || !preg_match('/[A-Z]/', $jelszo)) {
        $pass_error = 'A jelszónak legalább 4 karakter hosszúnak kell lennie, tartalmaznia kell legalább egy kisbetűt és egy nagybetűt!';
    } elseif ($jelszo !== $jelszo_megerositese) { // Ellenőrizze a jelszó és a jelszó megerősítése egyezőségét
        $pass_error = 'A jelszó és a jelszó megerősítése nem egyezik!';
    }

    // Ellenőrizze a telefonszám hosszát
    if (strlen($telefonszam) !== 9) {
        $tel_error = 'A telefonszám 9 karakterből kell álljon!';
    }

    // Ellenőrzések után folytatjuk csak a mentéssel, ha nincs hiba
    if (empty($pass_error) && empty($tel_error)) {
        // Adatbáziskapcsolat létrehozása
        $conn = new mysqli("localhost", "c31gulcsikZ", "zqd73iNH#Q", "c31gulcsikZ_db");

        // Jelszó hashelése
        $jelszo_hashelt = password_hash($jelszo, PASSWORD_DEFAULT);

        // SQL lekérdezés előkészítése és végrehajtása
        $sql = "INSERT INTO felhasznalo (vezeteknev, keresztnev, email_cim, telefonszam, jelszo) 
        VALUES ('$vezeteknev', '$keresztnev', '$email', '$telefonszam', '$jelszo_hashelt')";

        if ($conn->query($sql) === TRUE) {
            // Sikeres adatbázisba való felvitel után átirányítás az index.php oldalra
            header("Location: login.php");
            exit(); // Fontos, hogy a header() függvény után azonnal leállítsuk a további kimenetet
        } else {
            echo "<p>Hiba az adatok felvétele közben: " . $conn->error . "</p>";
        }
        
        // Adatbáziskapcsolat bezárása
        $conn->close();
    }
}

?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8">
    <title>HappyHotel</title>
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="icon" href="img/logo.jpg" type="image/jpg">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.css" rel="stylesheet">


    
    <!-- Favicon -->
    <link href="img/logo.jpg" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" >

    <!-- Libraries Stylesheet -->
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

 

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/register.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Header Start -->
        <?php include 'header.php'; ?>
        <!-- Header End -->


</head>
<body>

<div class="container">
            <form id="form" method="POST">
                <h1 id="heading">Regisztráció</h1>
                <i class="fa-solid fa-user"></i>
                <input type="text" id="firstusername" name="firstusername" placeholder="Add meg a Vezetékneved..." value="<?php echo $vezeteknev; ?>" required><br>
                <i class="fa-solid fa-user"></i>
                <input type="text" id="secondusername" name="secondusername" placeholder="Add meg a Keresztneved..." value="<?php echo $keresztnev; ?>" required><br>
                <i class="fa-solid fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="Add meg az email címed..." value="<?php echo $email; ?>" required><br>
                <i class="fa-solid fa-phone"></i>
                <input type="text" id="number" name="number" placeholder="Add meg a telefonszámod... (+36)" pattern="[0-9]+" value="<?php echo $telefonszam; ?>" required title="Csak szám megadása lehetséges"><br>
                <span style="color:red;"><?php echo $tel_error; ?></span><br>
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="pass" name="pass" placeholder="Add meg a jelszavad..." required><br>
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="cpass" name="cpass" placeholder="Jelszó megerősítése..." required><br>
                <span style="color:red;"><?php echo $pass_error; ?></span><br>
                <input type="submit" id="btn" value="Regisztráció" name="Submit" onclick="return validateForm()"><br>

                <!-- A "Belépés" link -->
                <div class="signup-link">Már van fiókod? <a href="login.php">Belépés</a></div>
            </form>
        </div>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script>
        function validateForm() {
            var pass = document.getElementById('pass').value;
            var cpass = document.getElementById('cpass').value;
            var tel = document.getElementById('number').value;

            var passError = "<?php echo $pass_error; ?>";
            var telError = "<?php echo $tel_error; ?>";

            if (passError !== '' || telError !== '') {
                document.getElementById('pass_error').innerHTML = passError;
                document.getElementById('tel_error').innerHTML = telError;
                return false;
            }

            if (pass !== cpass) {
                document.getElementById('pass_error').innerHTML = 'A jelszó és a jelszó megerősítése nem egyezik!';
                return false;
            }

            return true;
        }
    </script>
</body>

</html>
