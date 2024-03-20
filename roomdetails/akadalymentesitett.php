<?php
session_start();
include('connection.php');



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
    <link rel="icon" href="../img/logo.jpg" type="image/jpg">
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

    <!-- Libraries Stylesheet -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
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

        <?php include ('../header.php'); ?>


        
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h6 class="section-title text-start text-primary text-uppercase">rooms</h6>
                        <h1 class="mb-4">Üdvözöljük a <span class="text-primary text-uppercase">HappyHotel</span> akadálymentesített szobájában!</h1>
                        <p class="mb-4">
                       <p> Üdvözöljük a HappyHotel Akadálymentesített Szobájában! Ez a szoba azoknak szól, akiknek fontos a könnyű hozzáférés és a kényelmes tartózkodás, függetlenül a mozgáskorlátozottságuktól vagy speciális igényeiktől. A szoba tervezésénél és kialakításánál elsődleges szempont volt, hogy minden vendégünk számára megfelelő legyen, és lehetővé tegye számukra a teljes önállóságot és kényelmet.

                        Az Akadálymentesített Szoba minden részlete azért van kialakítva, hogy megkönnyítse a vendégek mozgását és mindennapi tevékenységeit. A tágas térben könnyen manőverezhető, és lehetőség van a kerekesszék kényelmes használatára. A kényelmes ágy, a magasabb pozícióban elhelyezett fogasok és kapcsolók, valamint a széles ajtók mind hozzájárulnak a vendégek kényelméhez és kényelméhez.

                        Az Akadálymentesített Szoba fürdőszobája is teljesen kialakítva van a vendégek könnyebb használatára. Az alacsony küszöbű zuhanyzó, a tolóajtók és a megfelelően elhelyezett fogantyúk lehetővé teszik a mozgáskorlátozott vendégek számára, hogy biztonságosan és kényelmesen használják a fürdőszobai létesítményeket.

                        Az Akadálymentesített Szoba teljes mértékben összhangban áll a modern technológia és kényelmi szolgáltatások igényeivel. A vendégek számára elérhető a vezeték nélküli internet-hozzáférés, a síkképernyős TV, valamint más olyan funkciók, amelyek lehetővé teszik számukra, hogy otthonosan érezzék magukat.

                        A HappyHotel Akadálymentesített Szobája egy ideális választás mindazoknak, akik kényelmes és biztonságos szállásra vágynak, anélkül, hogy kompromisszumot kellene kötniük a kényelem vagy az élvezet terén. Legyen szó üzleti vagy személyes utazásról, ez a szoba minden vendégünk számára otthont és kényelmet biztosít, miközben lehetővé teszi számukra, hogy a lehető legteljesebben élvezzék a tartózkodást.</p>
                        <div class="row g-3 pb-4">
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-bed fa-2x text-primary mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up">2</h2>
                                        <p class="mb-0">bed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-bath fa-2x text-primary mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up">1</h2>
                                        <p class="mb-0">Shower & Bath</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-wifi fa-2x text-primary mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up">30</h2><h2>mb/s</h2>
                                        <p class="mb-0">Wifi Speed</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-primary py-3 px-5 mt-2" href="../room.php">Explore More</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="../img/akadalymentesitett.jpg" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="../img/crippleeloszoba.jpg">
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
        <?php include('../footer.php')?>


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/counterup/counterup.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>