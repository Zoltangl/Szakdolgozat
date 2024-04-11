<?php
session_start();
include('connection.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

$vezeteknev = isset($_SESSION["firstusername"]) ? $_SESSION["firstusername"] : '';
$keresztnev = isset($_SESSION["secondusername"]) ? $_SESSION["secondusername"] : '';
$email = isset($_SESSION["email"]) ? $_SESSION["email"] : '';
$telefonszam = isset($_SESSION["number"]) ? $_SESSION["number"] : '';
$felhasznalo_id = isset($_SESSION['felhasznalo_id']) ? $_SESSION['felhasznalo_id'] : '';

// Lekérdezzük az adatokat az adatbázisból a bejelentkezett felhasználóhoz (kivéve a jelszó mezőt)
$sql = "SELECT vezeteknev, keresztnev, email_cim, telefonszam FROM felhasznalo WHERE felhasznalo_id = ?";
$stmt = $db::$conn->prepare($sql);
$stmt->bind_param("i", $felhasznalo_id);
$stmt->execute();
$result = $stmt->get_result();

// Ellenőrizzük, hogy sikerült-e az adatok lekérése
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $firstusername = $row['vezeteknev'];
    $secondusername = $row['keresztnev'];
    $email = $row['email_cim'];
    $phone = $row['telefonszam'];
}
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

        <?php include('header.php');?>


</head>
<body>



<div class="container">
    <form id="form">
        <h1 id="heading">Jelenlegi Adatok</h1>
        <i class="fa-solid fa-user"></i>
        <input type="text" id="firstusername" name="firstusername" readonly required><br>
        <i class="fa-solid fa-user"></i>
        <input type="text" id="secondusername" name="secondusername" readonly required><br>
        <i class="fa-solid fa-envelope"></i>
        <input type="email" id="email" name="email" readonly required><br>
        <i class="fa-solid fa-phone"></i>
        <input type="text" id="number" name="number" pattern="[0-9]+" readonly required title="Csak szám megadása lehetséges"><br>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('firstusername').value = "<?php echo isset($vezeteknev) ? $vezeteknev : ''; ?>";
        document.getElementById('secondusername').value = "<?php echo isset($keresztnev) ? $keresztnev : ''; ?>";
        document.getElementById('email').value = "<?php echo isset($email) ? $email : ''; ?>";
        document.getElementById('number').value = "<?php echo isset($telefonszam) ? $telefonszam : ''; ?>";
    });
</script>

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