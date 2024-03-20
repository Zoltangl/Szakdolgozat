<?php
session_start();
?>

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
        <?php include 'header.php'; ?>
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