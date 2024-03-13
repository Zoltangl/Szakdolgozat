<?php
include('connection.php');


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $profile_display = "<a href='profile.php' class='nav-item nav-link'>Profile</a>";
} else {
    $profile_display = "<a href='signup.php' class='nav-item nav-link'>Register/Login</a>";
}


$db = new DataBase();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $email = $_POST["email"];
    $jelszo = $_POST["pass"];

    $sql = "SELECT * FROM felhasznalo WHERE email_cim = '$email'";
    $result = $db::$conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($jelszo, $row['jelszo'])) {
            $_SESSION['loggedin'] = true;
            header("Location: index.php");
            echo "<p>Sikeres bejelentkezés!</p>"; 
            exit(); 
        } else {
            echo "<p>Hibás jelszó!</p>";
        }
    } else {
        echo "<p>Nincs ilyen felhasználó!</p>";
    }
}


$db->closeConnection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>HappyHotel</title>
    <link rel="icon" href="img/logo.jpg" type="image/jpg">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
    <form id="form" method="POST">
        <h1 id="heading">Bejelentkezés</h1>
        <i class="fa-solid fa-envelope"></i>
        <input type="email" id="email" name="email" placeholder="Add meg az email címed..." required><br>
        <i class="fa-solid fa-lock"></i>
        <input type="password" id="pass" name="pass" placeholder="Add meg a jelszavad..." required><br>
        <input type="submit" id="btn" value="Bejelentkezés" name="submit" required><br>

        <!-- A "Belépés" link -->
        <div class="signup-link">Még nincs fiókod? <a href="signup.php">Regisztráció</a></div>
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
