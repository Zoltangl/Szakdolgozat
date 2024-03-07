<?php
include('connection.php');

// Adatbáziskapcsolat létrehozása
$conn = new mysqli("localhost", "c31gulcsikZ", "zqd73iNH#Q", "c31gulcsikZ_db");

// Változók inicializálása
$pass_error = '';

// Ellenőrizze, hogy az űrlap elküldésekor POST-ot használnak-e
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ellenőrizze és mentse az űrlapból érkező adatokat
    $vezeteknev = $_POST["firstusername"];
    $keresztnev = $_POST["secondusername"];
    $email = $_POST["email"];
    $telefonszam = $_POST["number"];
    $jelszo = $_POST["pass"];
    $jelszo_megerositese = $_POST["cpass"];

    // Ellenőrizze a jelszó és a jelszó megerősítése egyezőségét
    if ($jelszo !== $jelszo_megerositese) {
        $pass_error = 'A jelszó és a jelszó megerősítése nem egyezik!';
        $_POST['pass'] = ''; // Törli a jelszó mező tartalmát
        $_POST['cpass'] = ''; // Törli a jelszó megerősítése mező tartalmát
    } else {
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
    }
}

// Adatbáziskapcsolat bezárása
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

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
        <div class="container-fluid bg-dark px-0">
            <div class="row gx-0">
                <div class="col-lg-3 bg-dark d-none d-lg-block">
                    <a href="index.php" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                        <h1 class="m-0 text-primary text-uppercase">HappyHotel</h1>
                    </a>
                </div>
                <div class="col-lg-9">
                    <div class="row gx-0 bg-white d-none d-lg-flex">
                        <div class="col-lg-7 px-5 text-start">
                            <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                                <i class="fa fa-envelope text-primary me-2"></i>
                                <p class="mb-0">HappyHotel@gmail.com</p>
                            </div>
                            <div class="h-100 d-inline-flex align-items-center py-2">
                                <i class="fa fa-phone-alt text-primary me-2"></i>
                                <p class="mb-0">+36 30 542 6782</p>
                            </div>
                        </div>
                        <div class="col-lg-5 px-5 text-end">
                            <div class="d-inline-flex align-items-center py-2">
                                <a class="me-3" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                <a class="me-3" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                                <a class="me-3" href="https://hu.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                <a class="me-3" href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                        <a href="index.php" class="navbar-brand d-block d-lg-none">
                            <h1 class="m-0 text-primary text-uppercase">HappyHotel</h1>
                        </a>
                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="index.php" class="nav-item nav-link active">Home</a>
                                <a href="about.php" class="nav-item nav-link">About</a>
                                <a href="service.php" class="nav-item nav-link">Services</a>
                                <a href="room.php" class="nav-item nav-link">Rooms</a>
                                <a href="kedvezmenyeink.php" class="nav-item nav-link">Kedvezményeink</a>

                                <a href="booking.php" class="nav-item nav-link">Booking</a>
                                <a href="signup.php" class="nav-item nav-link">Registration/Login</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Header End -->


</head>
<body>

<div class="container">
    <form id="form"  method="POST">
        <h1 id="heading">Regisztráció</h1>
        <i class="fa-solid fa-user"></i>
        <input type="text" id="firstusername" name="firstusername" placeholder="Add meg a Vezetékneved..." required><br>
        <i class="fa-solid fa-user"></i>
        <input type="text" id="secondusername" name="secondusername" placeholder="Add meg a Keresztneved..." required><br>
        <i class="fa-solid fa-envelope"></i>
        <input type="email" id="email" name="email" placeholder="Add meg az email címed..." required><br>
        <i class="fa-solid fa-phone"></i>
        <input type="text" id="number" name="number" placeholder="Add meg a telefonszámod... (+36)" pattern="[0-9]+" required title="Csak szám megadása lehetséges"><br>
        <i class="fa-solid fa-lock"></i>
        <input type="password" id="pass" name="pass" placeholder="Add meg a jelszavad..." required><br>
        <i class="fa-solid fa-lock"></i>
        <input type="password" id="cpass" name="cpass" placeholder="Jelszó megerősítése..." required><br>
        <span style="color:red;"><?php echo $pass_error; ?></span><br>
        <input type="submit" id="btn" value="Regisztráció" name="Submit" required><br>

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
</body>

</html>