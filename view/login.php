<?php
session_start();

include('connection.php');

// Alapértelmezett érték a profil megjelenítéséhez
$profile_display = "<a href='signup.php' class='nav-item nav-link'>Register/Login</a>";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $email = $_POST["email"];
    $jelszo = $_POST["pass"];

    $sql = "SELECT * FROM felhasznalo WHERE email_cim = ?";
    $stmt = $db::$conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Ellenőrizd, hogy a lekérdezés eredménye üres-e vagy sem
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Ellenőrizd, hogy a $row tömb tartalmazza-e a 'jelszo' kulcsot, mielőtt hozzáférnél hozzá
        if (isset($row['jelszo']) && password_verify($jelszo, $row['jelszo'])) {
            // Bejelentkezés sikerült
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email; // Vagy $_SESSION['felhasznalo_id'] = $row['id'] ha van ilyen mező a felhasznalo táblában
            $profile_display = '<div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Profile
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                                        <li><a class="dropdown-item" href="edit_profile.php">Edit Profile</a></li>
                                        <li><a id="logout_link" class="dropdown-item" href="logout.php">Log Out</a></li>
                                    </ul>
                                </div>';
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Hibás jelszó!";
        }
    } else {
        $error_message = "Nincs ilyen felhasználó!";
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
        <?php include 'header.php'; ?>
        <!-- Header End -->


</head>
<body>

<h2>A foglaláshoz előbb jelentkezzen be, vagy Regisztráljon!</h2>

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
