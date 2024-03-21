<?php
session_start();
require('connection.php');

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
// Lekérdezzük a szoba tipusokat az adatbázisból
$sql = "SELECT nev, ar FROM szoba_tipusok";
$result = DataBase::$conn->query($sql);
// Ellenőrizzük, hogy van-e eredmény
if ($result->num_rows > 0) {
    // Létrehozunk egy üres tömböt a szoba tipusok tárolására
    $szoba_tipusok = array();
    // Minden sor esetén hozzáadjuk a szoba tipust a tömbhöz
    while ($row = $result->fetch_assoc()) {
        $szoba_tipusok[] = $row;
    }
} else {
    echo "Nincsenek adatok a szoba tipusok táblában.";
}



// Alapértelmezett érték a profil megjelenítéséhez
$profile_display = "<a href='signup.php' class='nav-item nav-link'>Registration/Login</a>";

// Ellenőrizzük a felhasználó bejelentkezési állapotát
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Bejelentkezett felhasználóknak megjelenítjük a "Profile" menüpontot
    $profile_display = '<div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Profile
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                                <li><a class="dropdown-item" href="edit_profile.php">Edit Profile</a></li>
                                <li><a id="logout_link" class="dropdown-item" href="logout.php">Log Out</a></li>
                            </ul>
                        </div>';
}

// Ellenőrizzük, hogy volt-e kijelentkezési kérés
if (isset($_GET['logout'])) {
    // Ha volt, csak állítsuk vissza a bejelentkezési változót false-ra
    $_SESSION['loggedin'] = false;
    // Átirányítás az index.php fájlra a kijelentkezés után
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>HappyHotel</title>
    <link rel="icon" href="img/logo.jpg" type="image/jpg">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  



<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

<!-- Customized Bootstrap Stylesheet -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="css/style.css" rel="stylesheet">
<link href="css\confirm.css" rel="stylesheet">
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

        <?php include 'header.php'; ?>
       
        <!-- Booking Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Room Booking</h6>
                    <h1 class="mb-5">Book A <span class="text-primary text-uppercase">Luxury Room</span></h1>
                </div>
                <div class="row g-5">
                    <div class="col-lg-6" id="szoba_kepek">
                        <div class="row g-3">
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="img/csaladi.jpg" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="img/csoportroom.jpg">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="img/egyagyas.jpg">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="img/egyszemluxus.jpg">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <form>
                                <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" id="checkin" placeholder="Check In" data-target="#date3" data-toggle="datetimepicker" />
                                        <label for="checkin">Mettől</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating date" id="date4" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" id="checkout" placeholder="Check Out" data-target="#date4" data-toggle="datetimepicker" />
                                        <label for="checkout">Meddig</label>
                                    </div>
                                </div>
                                    <select name="szoba_tipus" id="szoba_tipus">
                                        <?php
                                        if (!empty($szoba_tipusok)) {
                                            foreach ($szoba_tipusok as $szoba_tipus) {
                                                echo "<option value='{$szoba_tipus['nev']}'>{$szoba_tipus['nev']} - {$szoba_tipus['ar']} Ft</option>";
                                            }
                                        } else {
                                            echo "<option disabled selected>Nincs elérhető szoba típus</option>";
                                        }
                                        ?>
                                    </select>
                                        
                                    <select name="kedvezmeny" id="kedvezmeny">
                                        <?php
                                        $sql = "SELECT neve, szazalek FROM kedvezmenyek";
                                        $result = DataBase::$conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='{$row['neve']}'>{$row['neve']} - {$row['szazalek']}%</option>";
                                            }
                                        } else {
                                            echo "<option disabled selected>Nincs elérhető kedvezmény</option>";
                                        }
                                        ?>
                                    </select>
                                    <a>Választott opciók: </a>
                                    <input type="text" id="valasztottOpciok" value="" placeholder="" readonly />
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" id="bookNowButton" data-toggle="modal" data-target="#exampleModal">Book Now</button>
                        
                                    </div>
                                   
                                          <!-- Modal -->
                                            <div class="modal" id="exampleModal" tabindex="-1" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Foglalásom</h5>
                                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Foglalási információk...
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                 document.getElementById("bookNowButton").addEventListener("click", function(event) {
                                                // Az alapértelmezett működés megakadályozása
                                                event.preventDefault();
                                                                                        
                                                // Modális ablak megjelenítése
                                                var modal = document.getElementById("exampleModal");
                                                modal.style.display = "block";
                                            });
                                        
                                            // A modális ablak inicializálása
                                            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                                        
                                            // A bezáró gombhoz hozzá kell adni a modális ablak bezárását kezelő eseményfigyelőt
                                            var closeButton = document.querySelector('.modal-header .btn-close');
                                            closeButton.addEventListener('click', function () {
                                                myModal.hide(); // A modális ablak elrejtése
                                            });
                                        </script>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script>
$(function () {
    // Aktuális dátum lekérése
    var currentDate = new Date();

    // Datetimepicker inicializálása
    $('#date3').datetimepicker({
        minDate: currentDate, // Múltbeli dátumok megakadályozása
        useCurrent: false // Az aktuális dátum automatikus beállításának letiltása
    });
    
    $('#date4').datetimepicker({
        minDate: currentDate, // Múltbeli dátumok megakadályozása
        useCurrent: false // Az aktuális dátum automatikus beállításának letiltása
    });
});
</script>
        <script>



    function copySelectedOptions() {
        var select1 = document.getElementById("szoba_tipus");
        var select2 = document.getElementById("kedvezmeny");
        var emptyField = document.getElementById("valasztottOpciok");

        var selectedOptions1 = select1.options[select1.selectedIndex].text;
        var selectedOptions2 = select2.options[select2.selectedIndex].text;

        emptyField.value = selectedOptions1 + " - " + selectedOptions2;
    }

    
    document.getElementById("szoba_tipus").addEventListener("change", copySelectedOptions);
    document.getElementById("kedvezmeny").addEventListener("change", copySelectedOptions);

    
</script>


        <!-- Booking End -->

        <?php include('footer.php')?>
        
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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