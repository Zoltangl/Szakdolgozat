<?php
session_start();
include('connection.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}



// Az aktuális felhasználó azonosítója
$current_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$current_user_id) {
    echo "Hiba: Felhasználói azonosító nem található.";
    exit();
}

// SQL lekérdezés a foglalások lekéréséhez
$sql = "SELECT foglalas_id, mettol, meddig, szoba_id, fizetes_mod, kedvezmeny_id 
        FROM foglalas 
        WHERE felhasznalo_id = $current_user_id";

$result = $conn->query($sql);

if (!$result) {
    echo "Hiba a lekérdezés során: " . $conn->error;
    exit();
}

if ($result->num_rows > 0) {
    // Táblázat fejléc
    echo "<table border='1'>";
    echo "<tr><th>Foglalás ID</th><th>Mettől</th><th>Meddig</th><th>Szoba ID</th><th>Fizetés módja</th><th>Kedvezmény ID</th></tr>";
    
    // Adatok megjelenítése
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["foglalas_id"] . "</td>";
        echo "<td>" . $row["mettol"] . "</td>";
        echo "<td>" . $row["meddig"] . "</td>";
        echo "<td>" . $row["szoba_id"] . "</td>";
        echo "<td>" . $row["fizetes_mod"] . "</td>";
        echo "<td>" . $row["kedvezmeny_id"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nincs foglalás.";
}

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
