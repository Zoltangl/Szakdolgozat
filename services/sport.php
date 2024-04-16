<?php
session_start();
include('../connection.php');



$profile_display = "<a href='signup.php' class='nav-item nav-link'>Registration/Login</a>";

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $profile_display = '<div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Profil
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                                <li><a class="dropdown-item" href="../foglalasaim.php">Foglalásaim megtekintése</a></li>
                                <li><a id="logout_link" class="dropdown-item" href="../logout.php">Kijelentkezés</a></li>
                            </ul>
                        </div>';
}

if (isset($_GET['logout'])) {
    $_SESSION['loggedin'] = false;
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

        <?php include('../mappheader.php');?>


        <!-- Page Header Start -->
        <?php include('../sportpageheader.php')?>
        <!-- Page Header End -->


        

        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h6 class="section-title text-start text-primary text-uppercase">HappyHotel</h6>
                        <h1 class="mb-4">Sport & Edzőterem</h1>
                        <p class="mb-4">
                        Üdvözöljük a hotelünk sportrészlegén, ahol kivételes lehetőségeket kínálunk az aktív pihenésre és a fitnesz életmód élvezetére. Élvezze a sport és a rekreáció széles skáláját, amelyet kínálunk, hogy minden vendégünk megtalálja a neki legmegfelelőbb tevékenységet.</p>
                        <p class = "mb4">
                            Üdvözöljük a hotelünk sportrészlegén, ahol kivételes lehetőségeket kínálunk az aktív pihenésre és a fitnesz életmód élvezetére. Élvezze a sport és a rekreáció széles skáláját, amelyet kínálunk, hogy minden vendégünk megtalálja a neki legmegfelelőbb tevékenységet.

                            Külső kosárlabdapályánk lehetővé teszi, hogy a vendégek kint élvezzék a kosárlabda játék izgalmait, miközben a friss levegő és a gyönyörű környezet közepette fejleszthetik ügyességüket és összhangjukat. A kosárlabdapálya mindig rendelkezésre áll, így bármikor kijöhet és játszhat egy meccset barátaival vagy családjával.

                            Ha inkább benti sportolást választana, akkor kiválóan használhatja felszerelt benti kosárlabdapályánkat. A kényelmes és modern létesítmények lehetővé teszik, hogy bármikor kosárlabdázhasson, függetlenül az időjárástól vagy a napszaktól.

                            Konditermünk pedig a fitnesz szerelmeseinek teremtett paradicsom. Felszerelésünk és gépeink segítségével minden vendégünk megtalálja a számára megfelelő edzésformát és nehézségi szintet. A konditerem reggel 6-tól este 10-ig áll rendelkezésre, így mindenki megtalálhatja az időt, hogy egészségére és jólétére összpontosítson.

                            Legyen szó akár az edzésről, a kosárlabdáról vagy csak a testmozgásról való élvezetről, hotelünk sportrészlege kiváló helyszín minden vendégünk számára, hogy felfedezze és élvezze a sport és a rekreáció világát. Hajrá, kezdjen el ma egy új kalandot az egészség és az aktív életmód felé!</p>
                        <div class="row g-3 pb-4">
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-dumbbell fa-2x text-primary mb-2"></i>
                                        <h2 class="mb-1">06:00  22:00</h2>
                                        <p class="mb-0">Edzőterem nyitvatartás</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-music fa-2x text-primary mb-2"></i>
                                        <p class="mb-0">Zene</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up">35</h2>
                                        <p class="mb-0">Férőhely</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="../img/gym.jpg" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="../img/tenisz.jpg">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="../img/kosar.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
        

        <?php include('../mappfooter.php');?>

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