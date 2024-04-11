<?php
session_start();
include('connection.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
$vezeteknev = "";
$keresztnev = "";
$telefonszam = "";

// Alapértelmezett értékek beállítása a session-ben tárolt adatok alapján
$vezeteknev = isset($_SESSION["firstusername"]) ? $_SESSION["firstusername"] : $vezeteknev;
$keresztnev = isset($_SESSION["secondusername"]) ? $_SESSION["secondusername"] : $keresztnev;
$email = isset($_SESSION["email"]) ? $_SESSION["email"] : $email;
$telefonszam = isset($_SESSION["number"]) ? $_SESSION["number"] : $telefonszam;

// Felhasználó adatainak lekérése az adatbázisból
$sql = "SELECT vezeteknev, keresztnev, email_cim, telefonszam FROM felhasznalo WHERE felhasznalo_id = ?";
$stmt = $db::$conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['felhasznalo_id']);
$stmt->execute();
$result = $stmt->get_result();

// Ellenőrzés, hogy sikerült-e a lekérdezés és ha igen, beállítjuk a változókat
if ($result !== false && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $vezeteknev = isset($row['vezeteknev']) ? $row['vezeteknev'] : $vezeteknev;
    $keresztnev = isset($row['keresztnev']) ? $row['keresztnev'] : $keresztnev;
    $email = isset($row['email_cim']) ? $row['email_cim'] : $email;
    $telefonszam = isset($row['telefonszam']) ? $row['telefonszam'] : $telefonszam;
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

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

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

        <div class="container">
            <form id="form">
                <h1 id="heading">Jelenlegi Adatok</h1>
                <i class="fas fa-user"></i>
                <input type="text" id="firstusername" name="firstusername" value="<?php echo $vezeteknev; ?>" readonly><br>
                <i class="fas fa-user"></i>
                <input type="text" id="secondusername" name="secondusername" value="<?php echo $keresztnev; ?>" readonly><br>
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly ><br>
                <i class="fas fa-phone"></i>
                <input type="text" id="number" name="number" pattern="[0-9]+" value="<?php echo $telefonszam; ?>" readonly><br>
            </form>
        </div>
    </div>

</body>

</html>

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
