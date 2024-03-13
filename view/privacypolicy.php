<?php 

    session_start();

include 'functions.php'; ?>

<!DOCTYPE html>
<html lang="hu">
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


    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">

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
                                <p class="mb-0">info@example.com</p>
                            </div>
                            <div class="h-100 d-inline-flex align-items-center py-2">
                                <i class="fa fa-phone-alt text-primary me-2"></i>
                                <p class="mb-0">+012 345 6789</p>
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

<body>
    <header>
        <h1>Adatvédelmi irányelvek</h1>
    </header>
    <main>
        <section id="adatok">
            <h2>Milyen adatokat gyűjtünk</h2>
            <p>Az oldalunkon látogatóinkról anonim, összesített adatokat gyűjtünk, mint például a látogatók száma és az oldalak megtekintési statisztikái. 
A szálloda weboldala látogatása során automatikusan gyűjtött adatok közé tartoznak a látogatók IP-címe, a böngésző típusa, az oldalak megtekintésének időpontja és az általuk használt eszközök információi, amelyeket a webanalitikai eszközök segítségével rögzítünk az oldal teljesítményének elemzése és fejlesztése céljából.</p>
        </section>
        <section id="hasznalat">
            <h2>Adatok felhasználása</h2>
            <p>A gyűjtött adatokat csak az oldalunk fejlesztésére és javítására használjuk fel. Ezeket az adatokat harmadik felekkel nem osztjuk meg.</p>
        </section>
        <section id="vedelem">
            <h2>Adatvédelem</h2>
            <p>A szálloda elkötelezett az Ön személyes adatainak védelme iránt, és az adatvédelmi gyakorlatában szigorúan betartja a helyi adatvédelmi törvényeket. Személyes információit bizalmasan kezeljük, és kizárólag a szolgáltatásaink nyújtása érdekében használjuk fel, harmadik felekkel való megosztás nélkül.</p>
        </section>
        <section id="cookie">
            <h2>Sütik</h2>
            <p>A hotel weboldala sütiket használ azáltal, hogy információt gyűjt a felhasználók böngészési szokásairól és preferenciáiról, hogy személyre szabottabb élményt nyújthasson. Ezek a sütik lehetővé teszik számunkra, hogy megjegyezzük, hogy mely oldalakat tekintette meg a felhasználó, és milyen beállításokat választott. Ezenkívül harmadik fél sütiket is használhatunk, például a hirdetések célzása vagy a weboldalunk teljesítményének elemzése érdekében. Ezek a sütik nem gyűjtenek személyes adatokat.</p>
        </section>
    </main>
    <footer>
        <p>© 2024 Minden jog fenntartva.</p>
    </footer>
</body>
</html>