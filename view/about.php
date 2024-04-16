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
                                <li><a class="dropdown-item" href="foglalasaim.php">Edit Profile</a></li>
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
       <link href="lib/animate/animate.min.css" rel="stylesheet">
       <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
       <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
   
       <!-- Customized Bootstrap Stylesheet -->
       <link href="css/bootstrap.min.css" rel="stylesheet">
   
       <!-- Template Stylesheet -->
       <link href="css/style.css" rel="stylesheet">
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


        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/fejlec2.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Rólunk</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Kezdőlap</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Rólunk</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        

       <!-- About Start -->
       <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h6 class="section-title text-start text-primary text-uppercase">Rólunk</h6>
                        <h1 class="mb-4">Üdvözöljük a <span class="text-primary text-uppercase">HappyHotelben</span></h1>
                        <p class="mb-4">
                        Üdvözöljük a HappyHotel exkluzív világában, ahol a luxus és kényelem harmóniája megteremti az ideális pihenés és kikapcsolódás légkörét. Engedje meg, hogy büszkén bemutassuk Önnek szállodánk páratlan szolgáltatásait és felejthetetlen élményeit.

A HappyHotel egyedülálló hangulatú benti bárjában exkluzív koktélokat és ínycsiklandó falatokat kínálunk, ahol Ön kellemes légkörben pihenhet és élvezheti a kiváló minőségű italokat.

Emellett szállodánk büszkélkedhet egy lenyűgöző benti és kinti medencével, ahol az egész évben garantáltan kellemes időt tölthet. Fedezze fel a medencék nyugtató vízének örömét, és élvezze a napsütést a szabad ég alatt vagy a luxus kényelemét a fedett medence mellett.

Ha aktív pihenésre vágyik, látogasson el edzőtermünkbe, ahol modern felszerelésekkel és személyi edzőkkel várjuk Önt. Itt lehetősége van frissítő edzésekre vagy éppen intenzív edzéssorozatokra, hogy megőrizze vitalitását és formáját még utazása alatt is.

A HappyHotel nem csupán egy szálláshely, hanem egy élmény, amelyet az egyedülálló helyi kultúra és gasztronómia is kiegészít. Fedezze fel városunk lenyűgöző látnivalóit és programlehetőségeit, majd térjen vissza szállodánkba, ahol mindig otthon érezheti magát a barátságos és professzionális kiszolgálásunkkal.

Tegye felejthetetlenné az idei nyaralást vagy üzleti útját a HappyHotelben, és hagyja, hogy élményeink örökre az emlékezetében éljenek tovább. Várjuk Önt szeretettel, hogy megoszthassuk Önnel a luxus és kényelem varázsát, amely a HappyHotel szívében rejlik.
                        
                    </div>
                    <div class="col-lg-6">
    <div class="row g-2">
        <div class="col-6">
            <div class="d-flex justify-content-start align-items-center h-100">
                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="img/aboutswimmingpool.jpg" style="margin-top: 25%;">
            </div>
        </div>
        <div class="col-6">
            <div class="d-flex justify-content-start align-items-center h-100">
                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.3s"  src="img/abouthotel.jpg">
            </div>
        </div>
        <div class="col-6">
            <div class="d-flex justify-content-start align-items-center h-100">
                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="img/aboutbar.jpg">
            </div>
        </div>
        <div class="col-6">
            <div class="d-flex justify-content-start align-items-center h-100">
                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="img/aboutmedence.jpg">
            </div>
        </div>
    </div>
</div>
</div>
                </div>
            </div>
        </div>
        <!-- About End -->
        

        <!-- Footer Start -->
        <?php include('footer.php')?>
        <!-- Footer End -->

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
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>